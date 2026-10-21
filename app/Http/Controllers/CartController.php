<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::detailed();

        return view('cart.index', ['cart' => $cart]);
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:999'],
        ]);

        $quantity = (int) ($data['quantity'] ?? 1);

        if (! $product->is_active) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        $existing = Cart::all()[$product->id] ?? 0;

        if ($existing + $quantity > $product->stock) {
            return back()->with('error', "Stok \"{$product->name}\" tidak mencukupi (tersisa {$product->stock}).");
        }

        Cart::add($product->id, $quantity);

        return back()->with('success', "{$product->name} ditambahkan ke keranjang.");
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:999'],
        ]);

        $quantity = (int) $data['quantity'];

        if ($quantity > $product->stock) {
            return back()->with('error', "Stok \"{$product->name}\" hanya tersisa {$product->stock}.");
        }

        Cart::update($product->id, $quantity);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        Cart::remove($product->id);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        Cart::clear();

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
