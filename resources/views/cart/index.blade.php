@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        {{-- Page Header --}}
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Keranjang Belanja</h1>
                    @if (!empty($cart['items']))
                        <p class="text-sm text-slate-500">
                            {{ $cart['count'] }} produk dalam keranjang Anda
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @if (empty($cart['items']))
            {{-- Empty State --}}
            <div class="overflow-hidden rounded-3xl border-2 border-dashed border-slate-200 bg-white shadow-sm">
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-indigo-50 to-purple-50 text-indigo-500">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Keranjang Anda masih kosong</h2>
                    <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">
                        Yuk pilih produk favorit Anda terlebih dahulu dan mulai berbelanja.
                    </p>
                    <a href="{{ route('catalog.index') }}"
                       class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Mulai Belanja
                    </a>
                </div>
            </div>
        @else
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Kolom Kiri: Daftar Item --}}
                <div class="lg:col-span-2">

                    {{-- Cart Items Card --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        {{-- Header --}}
                        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <h2 class="font-bold text-slate-900">Produk di Keranjang</h2>
                            </div>
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                {{ $cart['count'] }} item
                            </span>
                        </div>

                        {{-- Table --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="border-b border-slate-100 bg-white text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    <tr>
                                        <th class="px-5 py-3">Produk</th>
                                        <th class="px-5 py-3 text-right">Harga</th>
                                        <th class="px-5 py-3 text-center">Jumlah</th>
                                        <th class="px-5 py-3 text-right">Subtotal</th>
                                        <th class="px-5 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($cart['items'] as $item)
                                        <tr class="group transition-colors hover:bg-slate-50/60">

                                            {{-- Produk --}}
                                            <td class="px-5 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm">
                                                        @include('partials.product-image', ['product' => $item['product']])
                                                    </div>
                                                    <div class="min-w-0">
                                                        <a href="{{ route('catalog.show', $item['product']) }}"
                                                           class="line-clamp-1 font-semibold text-slate-800 transition-colors hover:text-indigo-600">
                                                            {{ $item['product']->name }}
                                                        </a>
                                                        <p class="mt-0.5 text-xs text-slate-500">
                                                            {{ $item['product']->category?->name ?? 'Tanpa kategori' }}
                                                        </p>
                                                        @if ($item['product']->stock <= 5)
                                                            <p class="mt-1 inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">
                                                                <span class="h-1 w-1 rounded-full bg-amber-500"></span>
                                                                Stok tersisa {{ $item['product']->stock }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Harga --}}
                                            <td class="whitespace-nowrap px-5 py-4 text-right text-slate-600">
                                                {{ $item['product']->formatted_price }}
                                            </td>

                                            {{-- Quantity --}}
                                            <td class="px-5 py-4">
                                                <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center justify-center gap-1.5">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex items-center overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" max="{{ $item['product']->stock }}"
                                                            class="w-14 border-0 bg-transparent px-2 py-1.5 text-center text-sm font-semibold text-slate-800 focus:outline-none focus:ring-0
                                                                   [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                                    </div>
                                                    <button type="submit" title="Perbarui jumlah"
                                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition-all hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>

                                            {{-- Subtotal --}}
                                            <td class="whitespace-nowrap px-5 py-4 text-right font-bold text-slate-900">
                                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                            </td>

                                            {{-- Delete --}}
                                            <td class="px-5 py-4 text-right">
                                                <form action="{{ route('cart.destroy', $item['product']) }}" method="POST"
                                                      onsubmit="return confirm('Hapus {{ $item['product']->name }} dari keranjang?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus dari keranjang"
                                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-rose-200 bg-white text-rose-500 transition-all hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Bottom Actions --}}
                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                        <a href="{{ route('catalog.index') }}"
                           class="group inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 transition-colors hover:text-indigo-700">
                            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Lanjut belanja
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan seluruh keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-600 shadow-sm transition-all hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Ringkasan --}}
                <div>
                    <div class="sticky top-24 space-y-4">

                        {{-- Summary Card --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <h2 class="font-bold text-slate-900">Ringkasan Pesanan</h2>
                                </div>
                            </div>

                            <div class="p-5">
                                <dl class="space-y-3 text-sm">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Total item</dt>
                                        <dd class="font-medium text-slate-800">{{ $cart['count'] }} produk</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Subtotal</dt>
                                        <dd class="font-medium text-slate-800">Rp {{ number_format($cart['total'], 0, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Ongkir</dt>
                                        <dd class="text-xs font-medium text-emerald-600">Dihitung saat checkout</dd>
                                    </div>
                                </dl>

                                <div class="my-4 border-t border-dashed border-slate-200"></div>

                                <div class="flex items-end justify-between">
                                    <dt class="text-sm font-semibold text-slate-700">Total</dt>
                                    <dd class="text-2xl font-extrabold tracking-tight text-indigo-600">
                                        Rp {{ number_format($cart['total'], 0, ',', '.') }}
                                    </dd>
                                </div>

                                <a href="{{ route('checkout.create') }}"
                                   class="group mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Lanjut ke Checkout
                                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <p class="mt-3 flex items-center justify-center gap-1 text-xs text-slate-400">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Transaksi aman & terpercaya
                                </p>
                            </div>
                        </div>

                        {{-- Trust Badge --}}
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="space-y-2.5">
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <div class="flex h-6 w-6 items-center justify-center rounded-md bg-emerald-100 text-emerald-600">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    Pembayaran aman
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <div class="flex h-6 w-6 items-center justify-center rounded-md bg-sky-100 text-sky-600">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    Pengiriman cepat
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <div class="flex h-6 w-6 items-center justify-center rounded-md bg-purple-100 text-purple-600">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    Dukungan 24/7
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection