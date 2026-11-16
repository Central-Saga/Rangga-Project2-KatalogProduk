@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        {{-- Progress Steps --}}
        <div class="mb-6 flex items-center justify-center gap-1.5 text-xs sm:gap-2 sm:text-sm">
            <a href="{{ route('cart.index') }}"
               class="flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1.5 font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200 transition-colors hover:bg-emerald-100 sm:px-3">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 text-[10px] text-white sm:text-xs">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                Keranjang
            </a>
            <span class="h-px w-6 bg-slate-300 sm:w-10"></span>
            <span class="flex items-center gap-1.5 rounded-full bg-indigo-600 px-2.5 py-1.5 font-semibold text-white shadow-sm shadow-indigo-200 sm:px-3">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-white/25 text-[10px] sm:text-xs">2</span>
                Checkout
            </span>
            <span class="h-px w-6 bg-slate-300 sm:w-10"></span>
            <span class="flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1.5 text-slate-500 sm:px-3">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-slate-300 text-[10px] text-white sm:text-xs">3</span>
                Selesai
            </span>
        </div>

        {{-- Page Header --}}
        <div class="mb-6">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Checkout</h1>
                    <p class="text-sm text-slate-500">Lengkapi data pemesan dan alamat pengiriman Anda.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Kolom Kiri: Form Data --}}
                <div class="space-y-4 lg:col-span-2">

                    {{-- Card: Data Pemesan --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-900">Data Pemesan</h2>
                        </div>

                        <div class="p-5">
                            <div class="grid gap-5 sm:grid-cols-2">
                                {{-- Nama --}}
                                <div>
                                    <label for="customer_name" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                        Nama Lengkap <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="customer_name" id="customer_name"
                                            value="{{ old('customer_name') }}" required
                                            placeholder="Masukkan nama lengkap"
                                            class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                                   focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                                   @error('customer_name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                                    </div>
                                    @error('customer_name')
                                        <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label for="customer_phone" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                        No. HP/WhatsApp <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <input type="tel" name="customer_phone" id="customer_phone"
                                            value="{{ old('customer_phone') }}" required
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                                   focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                                   @error('customer_phone') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                                    </div>
                                    @error('customer_phone')
                                        <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="sm:col-span-2">
                                    <div class="mb-2 flex items-center justify-between">
                                        <label for="customer_email" class="flex items-center gap-1 text-sm font-semibold text-slate-700">
                                            Email
                                        </label>
                                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
                                    </div>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input type="email" name="customer_email" id="customer_email"
                                            value="{{ old('customer_email') }}"
                                            placeholder="email@example.com"
                                            class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                                   focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                                   @error('customer_email') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                                    </div>
                                    <p class="mt-1.5 text-xs text-slate-500">Kami akan mengirim update pesanan ke email ini.</p>
                                    @error('customer_email')
                                        <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card: Alamat & Catatan --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-600 text-white shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-900">Alamat & Catatan</h2>
                        </div>

                        <div class="space-y-5 p-5">
                            {{-- Alamat --}}
                            <div>
                                <label for="address" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                    Alamat Pengiriman <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute left-3 top-3">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <textarea name="address" id="address" rows="3" required
                                        placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota, kode pos"
                                        class="w-full resize-none rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                               @error('address') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">{{ old('address') }}</textarea>
                                </div>
                                <p class="mt-1.5 text-xs text-slate-500">Pastikan alamat lengkap untuk mempercepat pengiriman.</p>
                                @error('address')
                                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Catatan --}}
                            <div>
                                <div class="mb-2 flex items-center justify-between">
                                    <label for="notes" class="flex items-center gap-1 text-sm font-semibold text-slate-700">
                                        Catatan untuk Penjual
                                    </label>
                                    <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
                                </div>
                                <div class="relative">
                                    <div class="pointer-events-none absolute left-3 top-3">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <textarea name="notes" id="notes" rows="2"
                                        placeholder="Contoh: Tolong bubble wrap, kirim setelah jam 5 sore, dll."
                                        class="w-full resize-none rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                               @error('notes') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">{{ old('notes') }}</textarea>
                                </div>
                                @error('notes')
                                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Ringkasan --}}
                <div>
                    <div class="sticky top-24 space-y-4">

                        {{-- Summary Card --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <h2 class="font-bold text-slate-900">Ringkasan</h2>
                                    </div>
                                    <span class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200">
                                        {{ $cart['count'] }} item
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                {{-- Item List --}}
                                <ul class="divide-y divide-slate-100">
                                    @foreach ($cart['items'] as $item)
                                        <li class="flex items-start gap-3 py-3 first:pt-0 last:pb-0">
                                            <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg border border-slate-200 bg-slate-100">
                                                @include('partials.product-image', ['product' => $item['product']])
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="line-clamp-1 text-sm font-medium text-slate-800">
                                                    {{ $item['product']->name }}
                                                </p>
                                                <p class="mt-0.5 text-xs text-slate-500">
                                                    {{ $item['quantity'] }} × {{ $item['product']->formatted_price }}
                                                </p>
                                            </div>
                                            <span class="whitespace-nowrap text-sm font-semibold text-slate-800">
                                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="my-4 border-t border-dashed border-slate-200"></div>

                                {{-- Rincian --}}
                                <dl class="space-y-2 text-sm">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Subtotal</dt>
                                        <dd class="font-medium text-slate-800">Rp {{ number_format($cart['total'], 0, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-slate-500">Ongkir</dt>
                                        <dd class="text-xs font-medium text-emerald-600">Dihitung admin</dd>
                                    </div>
                                </dl>

                                <div class="my-4 border-t border-dashed border-slate-200"></div>

                                <div class="flex items-end justify-between">
                                    <dt class="text-sm font-semibold text-slate-700">Total</dt>
                                    <dd class="text-2xl font-extrabold tracking-tight text-indigo-600">
                                        Rp {{ number_format($cart['total'], 0, ',', '.') }}
                                    </dd>
                                </div>

                                {{-- Submit Button --}}
                                <button type="submit"
                                        class="group mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Buat Pesanan
                                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>

                                <a href="{{ route('cart.index') }}"
                                   class="mt-3 inline-flex w-full items-center justify-center gap-1.5 text-sm font-medium text-slate-500 transition-colors hover:text-indigo-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Kembali ke keranjang
                                </a>

                                <p class="mt-4 flex items-center justify-center gap-1 text-xs text-slate-400">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Data Anda aman & terenkripsi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection