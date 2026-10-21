<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = Cart::detailed();

        if (empty($cart['items'])) {
            return redirect()->route('catalog.index')
                ->with('error', 'Keranjang masih kosong. Silakan pilih produk terlebih dahulu.');
        }

        return view('checkout.create', ['cart' => $cart]);
    }

    public function store(\App\Http\Requests\CheckoutRequest $request)
    {
        $cart = Cart::detailed();

        if (empty($cart['items'])) {
            return redirect()->route('catalog.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $data = $request->validated();

        $order = DB::transaction(function () use ($cart, $data) {
            $order = Order::create([
                'order_code' => $this->generateOrderCode(),
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'customer_email' => $data['customer_email'] ?? null,
                'address' => $data['address'],
                'notes' => $data['notes'] ?? null,
                'total' => 0,
                'status' => 'menunggu_konfirmasi',
            ]);

            $total = 0;

            foreach ($cart['items'] as $item) {
                $product = Product::lockForUpdate()->find($item['product']->id);

                if (! $product || ! $product->is_active) {
                    throw ValidationException::withMessages([
                        'cart' => "Produk \"{$item['product']->name}\" sudah tidak tersedia.",
                    ]);
                }

                if ($product->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok \"{$product->name}\" tidak mencukupi. Tersisa {$product->stock}.",
                    ]);
                }

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            $order->update(['total' => $total]);

            return $order;
        });

        Cart::clear();

        return redirect()->route('orders.show', $order->order_code)
            ->with('success', "Pesanan berhasil dibuat! Kode pesanan Anda: {$order->order_code}");
    }

    protected function generateOrderCode(): string
    {
        do {
            $code = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }
}
