@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    {{-- Back Link --}}
    <a href="{{ route('admin.orders.index') }}"
       class="group mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 transition-colors hover:text-indigo-600">
        <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Pesanan
    </a>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- Card Info Pesanan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                {{-- Header dengan gradient --}}
                <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-6 py-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Kode Pesanan</p>
                                <p class="mt-0.5 font-mono text-xl font-extrabold tracking-wide text-slate-900">
                                    {{ $order->order_code }}
                                </p>
                                <p class="mt-1 flex items-center gap-1 text-xs text-slate-500">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $order->created_at->translatedFormat('d F Y, H:i') }} WITA
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-sm font-semibold ring-1 ring-inset {{ $order->status_badge }}">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>

                {{-- Detail Pelanggan --}}
                <div class="p-6">
                    <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-500">Informasi Pelanggan</h3>
                    <dl class="grid gap-5 sm:grid-cols-2">
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <dt class="text-xs uppercase tracking-wide text-slate-500">Nama Pemesan</dt>
                                <dd class="truncate font-medium text-slate-800">{{ $order->customer_name }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <dt class="text-xs uppercase tracking-wide text-slate-500">No. HP/WhatsApp</dt>
                                <dd class="font-medium text-slate-800">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}"
                                       target="_blank"
                                       class="text-emerald-600 transition-colors hover:text-emerald-700 hover:underline">
                                        {{ $order->customer_phone }}
                                    </a>
                                </dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 sm:col-span-2">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <dt class="text-xs uppercase tracking-wide text-slate-500">Email</dt>
                                <dd class="font-medium text-slate-800">{{ $order->customer_email ?: '-' }}</dd>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 sm:col-span-2">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <dt class="text-xs uppercase tracking-wide text-slate-500">Alamat Pengiriman</dt>
                                <dd class="font-medium text-slate-800">{{ $order->address }}</dd>
                            </div>
                        </div>
                        @if ($order->notes)
                            <div class="flex items-start gap-3 sm:col-span-2">
                                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <dt class="text-xs uppercase tracking-wide text-slate-500">Catatan</dt>
                                    <dd class="rounded-lg bg-amber-50 px-3 py-2 text-sm font-medium text-amber-900">{{ $order->notes }}</dd>
                                </div>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- Card Item Pesanan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/70 px-6 py-4">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <h2 class="font-bold text-slate-900">Item Pesanan</h2>
                    <span class="ml-auto rounded-full bg-slate-200 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                        {{ $order->items->count() }} item
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-100 bg-white text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-3">Produk</th>
                                <th class="px-6 py-3 text-right">Harga</th>
                                <th class="px-6 py-3 text-center">Qty</th>
                                <th class="px-6 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($order->items as $item)
                                <tr class="transition-colors hover:bg-slate-50/70">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 text-xs font-bold uppercase text-white shadow-sm">
                                                {{ mb_substr($item->product_name, 0, 2) }}
                                            </div>
                                            <span class="font-medium text-slate-800">{{ $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-slate-600">{{ $item->formatted_price }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex min-w-[2rem] justify-center rounded-md bg-slate-100 px-2 py-1 font-mono text-xs font-semibold text-slate-700">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right font-semibold text-slate-800">{{ $item->formatted_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-slate-200 bg-slate-50/70">
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-bold uppercase tracking-wider text-slate-600">Total Pembayaran</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-lg font-extrabold text-indigo-600">{{ $order->formatted_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan (Sticky) --}}
        <div>
            <div class="sticky top-24 space-y-4">

                {{-- Card Ubah Status --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-100 bg-gradient-to-r from-amber-50/70 to-orange-50/70 px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500 text-white shadow-sm">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <h2 class="font-bold text-slate-900">Ubah Status</h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.orders.status', $order->order_code) }}" method="POST" class="space-y-4 p-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status Pesanan</label>
                            <select name="status" id="status"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm transition-all
                                           focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                           @error('status') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                                @foreach ($statuses as $key => $label)
                                    <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="inline-flex w-full items-center justify-center gap-1.5 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Status
                        </button>
                        <p class="text-center text-xs text-slate-400">
                            Pelanggan akan melihat perubahan ini di halaman lacak pesanan.
                        </p>
                    </form>
                </div>

                {{-- Card Link Lacak --}}
                <div class="overflow-hidden rounded-2xl border border-indigo-200 bg-gradient-to-br from-indigo-50 to-purple-50 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-800">Halaman Lacak</p>
                            <p class="mt-0.5 text-xs text-slate-600">Lihat tampilan pelanggan untuk pesanan ini.</p>
                            <a href="{{ route('orders.show', $order->order_code) }}"
                               target="_blank"
                               class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                                Buka Halaman
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection