@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Total Produk</p>
            <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['products'] }}</p>
            <p class="mt-1 text-xs text-slate-400">{{ $stats['categories'] }} kategori</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Total Pesanan</p>
            <p class="mt-1 text-3xl font-bold text-slate-900">{{ $stats['orders'] }}</p>
            <p class="mt-1 text-xs text-amber-600">{{ $stats['pending_orders'] }} menunggu konfirmasi</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Pendapatan (Selesai)</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-400">Total keseluruhan</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Pendapatan Bulan Ini</p>
            <p class="mt-1 text-2xl font-bold text-slate-900">Rp {{ number_format($stats['revenue_month'], 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-400">Tanpa pesanan dibatalkan</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                <h2 class="font-bold text-slate-900">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat semua</a>
            </div>
            @if ($recentOrders->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-5 py-3">Kode</th>
                                <th class="px-5 py-3">Pemesan</th>
                                <th class="px-5 py-3">Total</th>
                                <th class="px-5 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentOrders as $order)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-3">
                                        <a href="{{ route('admin.orders.show', $order->order_code) }}" class="font-medium text-indigo-600 hover:text-indigo-700">{{ $order->order_code }}</a>
                                    </td>
                                    <td class="px-5 py-3 text-slate-700">{{ $order->customer_name }}</td>
                                    <td class="px-5 py-3 text-slate-700">{{ $order->formatted_total }}</td>
                                    <td class="px-5 py-3">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $order->status_badge }}">{{ $order->status_label }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="px-5 py-8 text-center text-sm text-slate-500">Belum ada pesanan.</p>
            @endif
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="font-bold text-slate-900">Status Pesanan</h2>
                <ul class="mt-3 space-y-2 text-sm">
                    @foreach (\App\Models\Order::STATUSES as $key => $label)
                        <li class="flex items-center justify-between">
                            <span class="text-slate-600">{{ $label }}</span>
                            <span class="font-semibold text-slate-900">{{ (int) ($statusBreakdown[$key] ?? 0) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold text-slate-900">Stok Menipis</h2>
                    <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Kelola</a>
                </div>
                @if ($lowStock->count())
                    <ul class="mt-3 space-y-2 text-sm">
                        @foreach ($lowStock as $product)
                            <li class="flex items-center justify-between gap-2">
                                <span class="line-clamp-1 text-slate-600">{{ $product->name }}</span>
                                <span class="shrink-0 rounded-full bg-amber-50 px-2 py-0.5 text-xs font-semibold text-amber-700">{{ $product->stock }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-sm text-slate-500">Semua stok aman.</p>
                @endif
            </div>

            @if ($stats['pending_testimonials'] > 0)
                <a href="{{ route('admin.testimonials.index') }}" class="block rounded-2xl border border-amber-200 bg-amber-50 p-5">
                    <p class="font-bold text-amber-800">{{ $stats['pending_testimonials'] }} testimoni menunggu</p>
                    <p class="text-sm text-amber-700">Klik untuk meninjau &amp; menyetujui.</p>
                </a>
            @endif
        </div>
    </div>
@endsection
