<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->admin = User::where('email', 'admin@katalog.test')->firstOrFail();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $this->post('/login', [
            'email' => 'admin@katalog.test',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->post('/login', [
            'email' => 'admin@katalog.test',
            'password' => 'salah',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_open_dashboard_and_modules(): void
    {
        foreach (['/admin', '/admin/produk', '/admin/kategori', '/admin/pesanan', '/admin/laporan', '/admin/testimoni'] as $url) {
            $this->actingAs($this->admin)->get($url)->assertOk();
        }
    }

    public function test_admin_can_create_category(): void
    {
        $this->actingAs($this->admin)
            ->post('/admin/kategori', ['name' => 'Kategori Baru'])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['slug' => 'kategori-baru']);
    }

    public function test_admin_can_create_product(): void
    {
        $category = Category::firstOrFail();

        $this->actingAs($this->admin)
            ->post('/admin/produk', [
                'category_id' => $category->id,
                'name' => 'Produk Uji Baru',
                'price' => 150000,
                'stock' => 5,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', ['slug' => 'produk-uji-baru', 'price' => 150000]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'order_code' => 'INV-TEST-0001',
            'customer_name' => 'Uji',
            'customer_phone' => '0812',
            'address' => 'Alamat uji',
            'total' => 100000,
            'status' => 'menunggu_konfirmasi',
        ]);

        $this->actingAs($this->admin)
            ->patch('/admin/pesanan/' . $order->order_code . '/status', ['status' => 'diproses'])
            ->assertRedirect(route('admin.orders.show', $order->order_code));

        $this->assertSame('diproses', $order->fresh()->status);
    }

    public function test_admin_can_approve_testimonial(): void
    {
        $testimonial = Testimonial::create([
            'name' => 'Tester',
            'message' => 'Pesan testimoni yang cukup panjang.',
            'rating' => 5,
            'is_approved' => false,
        ]);

        $this->actingAs($this->admin)
            ->patch('/admin/testimoni/' . $testimonial->id . '/approve')
            ->assertRedirect();

        $this->assertTrue($testimonial->fresh()->is_approved);
    }

    public function test_logout_works(): void
    {
        $this->actingAs($this->admin)
            ->post('/logout')
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
