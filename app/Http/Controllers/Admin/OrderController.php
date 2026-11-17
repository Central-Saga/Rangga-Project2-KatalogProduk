<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->when($request->input('status'), fn ($query, $status) => $query->where('status', $status))
            ->when($request->input('q'), function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('order_code', 'like', "%{$q}%")
                        ->orWhere('customer_name', 'like', "%{$q}%")
                        ->orWhere('customer_phone', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => Order::STATUSES,
        ]);
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => Order::STATUSES,
        ]);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $order->update(['status' => $request->validated()['status']]);

        return redirect()->route('admin.orders.show', $order->order_code)
            ->with('success', 'Status pesanan berhasil diperbarui menjadi "'.$order->status_label.'".');
    }
}
