<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertOk()->assertSee('Katalog Produk');
    }

    public function test_catalog_page_loads_with_filters(): void
    {
        $this->get('/produk')->assertOk();
        $this->get('/produk?category=elektronik&q=smartphone&sort=price_asc')->assertOk();
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::active()->firstOrFail();

        $this->get('/produk/' . $product->slug)
            ->assertOk()
            ->assertSee($product->name);
    }

    public function test_inactive_product_returns_404(): void
    {
        $product = Product::firstOrFail();
        $product->update(['is_active' => false]);

        $this->get('/produk/' . $product->slug)->assertNotFound();
    }

    public function test_checkout_redirects_when_cart_is_empty(): void
    {
        $this->get('/checkout')->assertRedirect(route('catalog.index'));
    }

    public function test_full_checkout_creates_order_and_decrements_stock(): void
    {
        $product = Product::active()->firstOrFail();
        $initialStock = $product->stock;

        $response = $this->withSession(['cart' => [$product->id => 2]])
            ->post('/checkout', [
                'customer_name' => 'Pelanggan Uji',
                'customer_phone' => '081200000000',
                'customer_email' => 'uji@example.com',
                'address' => 'Jl. Pengujian No. 1',
                'notes' => 'Tolong cepat',
            ]);

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Pelanggan Uji',
            'total' => $product->price * 2,
            'status' => 'menunggu_konfirmasi',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertSame($initialStock - 2, $product->fresh()->stock);

        $order = \App\Models\Order::firstOrFail();
        $response->assertRedirect(route('orders.show', $order->order_code));
    }

    public function test_checkout_validates_required_fields(): void
    {
        $product = Product::active()->firstOrFail();

        $this->withSession(['cart' => [$product->id => 1]])
            ->post('/checkout', [])
            ->assertSessionHasErrors(['customer_name', 'customer_phone', 'address']);
    }

    public function test_order_can_be_tracked_by_code(): void
    {
        $product = Product::active()->firstOrFail();

        $this->withSession(['cart' => [$product->id => 1]])
            ->post('/checkout', [
                'customer_name' => 'Pelacak',
                'customer_phone' => '081233333333',
                'address' => 'Jl. Lacak',
            ]);

        $order = \App\Models\Order::firstOrFail();

        $this->get('/pesanan/' . $order->order_code)
            ->assertOk()
            ->assertSee($order->order_code);
    }

    public function test_unknown_order_code_is_rejected(): void
    {
        $this->post('/lacak-pesanan', ['order_code' => 'INV-TIDAK-ADA'])
            ->assertSessionHas('error');
    }
}
