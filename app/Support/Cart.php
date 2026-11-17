<?php

namespace App\Support;

use App\Models\Product;

class Cart
{
    protected const KEY = 'cart';

    public static function all(): array
    {
        return session()->get(self::KEY, []);
    }

    public static function add(int $productId, int $qty = 1): void
    {
        $cart = self::all();
        $cart[$productId] = ($cart[$productId] ?? 0) + max(1, $qty);
        session()->put(self::KEY, $cart);
    }

    public static function update(int $productId, int $qty): void
    {
        $cart = self::all();
        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $qty;
        }
        session()->put(self::KEY, $cart);
    }

    public static function remove(int $productId): void
    {
        $cart = self::all();
        unset($cart[$productId]);
        session()->put(self::KEY, $cart);
    }

    public static function clear(): void
    {
        session()->forget(self::KEY);
    }

    public static function count(): int
    {
        return (int) array_sum(self::all());
    }

    /**
     * @return array{items: array<int, array{product: Product, quantity: int, subtotal: int}>, total: int, count: int}
     */
    public static function detailed(): array
    {
        $cart = self::all();

        if (empty($cart)) {
            return ['items' => [], 'total' => 0, 'count' => 0];
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = [];
        $total = 0;
        $count = 0;

        foreach ($cart as $id => $qty) {
            $product = $products->get((int) $id);

            if (! $product) {
                continue;
            }

            $quantity = (int) $qty;
            $subtotal = $product->price * $quantity;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
            $count += $quantity;
        }

        return ['items' => $items, 'total' => $total, 'count' => $count];
    }
}
