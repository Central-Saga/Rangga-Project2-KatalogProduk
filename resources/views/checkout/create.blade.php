@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="text-2xl font-bold text-slate-900">Checkout</h1>
        <p class="text-sm text-slate-500">Isi data pemesan dan alamat pengiriman. Pesanan akan tersimpan dengan kode order unik.</p>

        <form action="{{ route('checkout.store') }}" method="POST" class="mt-6 grid gap-6 lg:grid-cols-3">
            @csrf
            <div class="space-y-4 lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h2 class="mb-4 text-lg font-bold text-slate-900">Data Pemesan</h2>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="customer_name" class="mb-1 block text-sm font-medium text-slate-700">Nama lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('customer_name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="mb-1 block text-sm font-medium text-slate-700">Nomor HP/WhatsApp <span class="text-rose-500">*</span></label>
                            <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('customer_phone')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="customer_email" class="mb-1 block text-sm font-medium text-slate-700">Email (opsional)</label>
                            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('customer_email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="address" class="mb-1 block text-sm font-medium text-slate-700">Alamat pengiriman <span class="text-rose-500">*</span></label>
                            <textarea name="address" id="address" rows="3" required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('address') }}</textarea>
                            @error('address')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="notes" class="mb-1 block text-sm font-medium text-slate-700">Catatan (opsional)</label>
                            <textarea name="notes" id="notes" rows="2"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('notes') }}</textarea>
                            @error('notes')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h2 class="text-lg font-bold text-slate-900">Ringkasan Pesanan</h2>
                    <ul class="mt-4 divide-y divide-slate-100 text-sm">
                        @foreach ($cart['items'] as $item)
                            <li class="flex justify-between gap-3 py-2">
                                <span class="text-slate-600">{{ $item['product']->name }} <span class="text-slate-400">&times;{{ $item['quantity'] }}</span></span>
                                <span class="font-medium text-slate-800">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 flex justify-between border-t border-slate-200 pt-3 text-base">
                        <span class="font-semibold text-slate-700">Total</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($cart['total'], 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" class="mt-5 w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white hover:bg-indigo-700">
                        Buat Pesanan
                    </button>
                    <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-sm font-medium text-slate-500 hover:text-indigo-600">Kembali ke keranjang</a>
                </div>
            </div>
        </form>
    </div>
@endsection
