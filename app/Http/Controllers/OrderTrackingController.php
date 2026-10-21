<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('orders.track');
    }

    public function track(Request $request)
    {
        $data = $request->validate([
            'order_code' => ['required', 'string', 'max:50'],
        ], [
            'order_code.required' => 'Kode pesanan wajib diisi.',
        ]);

        $order = Order::where('order_code', strtoupper(trim($data['order_code'])))->first();

        if (! $order) {
            return back()
                ->withInput()
                ->with('error', 'Kode pesanan tidak ditemukan. Periksa kembali kode Anda.');
        }

        return redirect()->route('orders.show', $order->order_code);
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('orders.show', ['order' => $order]);
    }
}
