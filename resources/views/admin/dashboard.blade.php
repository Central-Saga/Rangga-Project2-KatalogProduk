@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                Selamat datang kembali 👋
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Berikut ringkasan toko Anda hari ini, {{ now()->translatedFormat('l, d F Y') }}.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.reports.index') }}"
               class="inline-flex items-center gap-1.5 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Laporan
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-1.5 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Produk
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Produk --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:border-indigo-200 hover:shadow-md">
            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-indigo-50 opacity-70 transition-transform group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-indigo-600 opacity-0 transition-opacity group-hover:opacity-100">
                        Lihat &rarr;
                    </a>
                </div>
                <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Total Produk</p>
                <p class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900">{{ number_format($stats['products'], 0, ',', '.') }}</p>
                <p class="mt-1 flex items-center gap-1 text-xs text-slate-500">
                    <svg class="h-3 w-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $stats['categories'] }} kategori
                </p>
            </div>
        </div>

        {{-- Total Pesanan --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:border-sky-200 hover:shadow-md">
            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-sky-50 opacity-70 transition-transform group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-sky-600 opacity-0 transition-opacity group-hover:opacity-100">
                        Lihat &rarr;
                    </a>
                </div>
                <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Total Pesanan</p>
                <p class="mt-1 text-3xl font-extrabold tracking-tight text-slate-900">{{ number_format($stats['orders'], 0, ',', '.') }}</p>
                <p class="mt-1 flex items-center gap-1 text-xs {{ $stats['pending_orders'] > 0 ? 'font-semibold text-amber-600' : 'text-slate-500' }}">
                    @if ($stats['pending_orders'] > 0)
                        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-amber-500"></span>
                        {{ $stats['pending_orders'] }} menunggu konfirmasi
                    @else
                        Semua pesanan diproses
                    @endif
                </p>
            </div>
        </div>

        {{-- Pendapatan Total --}}
        <div class="group relative overflow-hidden rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-100 opacity-70 transition-transform group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-emerald-700">Pendapatan (Selesai)</p>
                <p class="mt-1 text-2xl font-extrabold tracking-tight text-emerald-700">
                    Rp {{ number_format($stats['revenue'], 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-emerald-600/80">Total keseluruhan</p>
            </div>
        </div>

        {{-- Pendapatan Bulan Ini --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-all hover:border-purple-200 hover:shadow-md">
            <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-purple-50 opacity-70 transition-transform group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <span class="rounded-full bg-purple-100 px-2 py-0.5 text-[10px] font-bold uppercase text-purple-700">
                        {{ now()->translatedFormat('F') }}
                    </span>
                </div>
                <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Pendapatan Bulan Ini</p>
                <p class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900">
                    Rp {{ number_format($stats['revenue_month'], 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-slate-500">Tanpa pesanan dibatalkan</p>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">

        {{-- Pesanan Terbaru --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-bold text-slate-900">Pesanan Terbaru</h2>
                </div>
                <a href="{{ route('admin.orders.index') }}"
                   class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                    Lihat semua
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            @if ($recentOrders->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-100 bg-white text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3">Kode</th>
                                <th class="px-5 py-3">Pemesan</th>
                                <th class="px-5 py-3 text-right">Total</th>
                                <th class="px-5 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentOrders as $order)
                                <tr class="group transition-colors hover:bg-slate-50/70">
                                    <td class="px-5 py-3.5">
                                        <a href="{{ route('admin.orders.show', $order->order_code) }}"
                                           class="inline-flex items-center gap-1 rounded-md bg-indigo-50 px-2 py-1 font-mono text-xs font-semibold text-indigo-700 transition-colors hover:bg-indigo-100">
                                            {{ $order->order_code }}
                                        </a>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 text-[10px] font-bold uppercase text-white">
                                                {{ mb_substr($order->customer_name, 0, 2) }}
                                            </div>
                                            <span class="truncate font-medium text-slate-700">{{ $order->customer_name }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-3.5 text-right font-semibold text-slate-800">
                                        {{ $order->formatted_total }}
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $order->status_badge }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-5 py-16 text-center">
                    <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-700">Belum ada pesanan</p>
                    <p class="mt-1 text-xs text-slate-500">Pesanan dari pelanggan akan muncul di sini.</p>
                </div>
            @endif
        </div>

        {{-- Sidebar Kanan --}}
        <div class="space-y-6">

            {{-- Notifikasi Testimoni --}}
            @if ($stats['pending_testimonials'] > 0)
                <a href="{{ route('admin.testimonials.index') }}"
                   class="group block overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-5 shadow-sm transition-all hover:border-amber-300 hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm shadow-amber-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-amber-900">
                                {{ $stats['pending_testimonials'] }} testimoni menunggu
                            </p>
                            <p class="mt-0.5 text-xs text-amber-700">Klik untuk meninjau & menyetujui</p>
                        </div>
                        <svg class="h-4 w-4 flex-shrink-0 text-amber-600 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endif

            {{-- Status Pesanan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-100 text-sky-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h2 class="font-bold text-slate-900">Status Pesanan</h2>
                </div>
                <ul class="divide-y divide-slate-100">
                    @foreach (\App\Models\Order::STATUSES as $key => $label)
                        <li class="flex items-center justify-between px-5 py-3 transition-colors hover:bg-slate-50/60">
                            <span class="text-sm text-slate-600">{{ $label }}</span>
                            <span class="inline-flex min-w-[2rem] items-center justify-center rounded-md bg-slate-100 px-2 py-0.5 text-xs font-bold text-slate-700">
                                {{ (int) ($statusBreakdown[$key] ?? 0) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Stok Menipis --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h2 class="font-bold text-slate-900">Stok Menipis</h2>
                    </div>
                    <a href="{{ route('admin.products.index') }}"
                       class="text-xs font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                        Kelola
                    </a>
                </div>
                @if ($lowStock->count())
                    <ul class="divide-y divide-slate-100">
                        @foreach ($lowStock as $product)
                            <li class="flex items-center justify-between gap-2 px-5 py-3 transition-colors hover:bg-slate-50/60">
                                <span class="line-clamp-1 text-sm text-slate-700">{{ $product->name }}</span>
                                <span class="inline-flex flex-shrink-0 items-center gap-1 rounded-full px-2 py-0.5 text-xs font-bold
                                    {{ $product->stock <= 0 ? 'bg-rose-50 text-rose-700' : ($product->stock <= 3 ? 'bg-orange-50 text-orange-700' : 'bg-amber-50 text-amber-700') }}">
                                    @if ($product->stock <= 0)
                                        Habis
                                    @else
                                        {{ $product->stock }}
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-5 py-8 text-center">
                        <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">Semua stok aman</p>
                        <p class="mt-0.5 text-xs text-slate-500">Tidak ada produk yang perlu restock.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection