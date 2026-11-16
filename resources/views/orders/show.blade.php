@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $order->order_code)

@section('content')
    @php
        $steps = [
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
        ];
        $flow = array_keys($steps);
        $currentIndex = array_search($order->status, $flow, true);
        $cancelled = $order->status === 'dibatalkan';
    @endphp

    <div class="mx-auto max-w-4xl px-4 py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-5 flex items-center gap-1.5 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="transition-colors hover:text-indigo-600">Beranda</a>
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('orders.track') }}" class="transition-colors hover:text-indigo-600">Lacak Pesanan</a>
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-mono font-medium text-slate-700">{{ $order->order_code }}</span>
        </nav>

        {{-- Header Card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 via-white to-purple-50/70 px-6 py-5">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Kode Pesanan</p>
                            <p class="mt-0.5 font-mono text-xl font-extrabold tracking-wide text-slate-900">
                                {{ $order->order_code }}
                            </p>
                            <p class="mt-1 flex items-center gap-1 text-xs text-slate-500">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Dibuat {{ $order->created_at->translatedFormat('d F Y, H:i') }} WITA
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-sm font-semibold ring-1 ring-inset {{ $order->status_badge }}">
                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                            {{ $order->status_label }}
                        </span>
                        <p class="mt-2 flex items-center justify-end gap-1 text-xs text-slate-500">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Simpan kode ini untuk melacak pesanan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Progress Timeline --}}
            <div class="p-6">
                @if ($cancelled)
                    {{-- Cancelled State --}}
                    <div class="flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4">
                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-rose-500 text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-rose-900">Pesanan Dibatalkan</p>
                            <p class="mt-0.5 text-sm text-rose-800">
                                Pesanan ini telah dibatalkan. Silakan hubungi admin bila ada pertanyaan.
                            </p>
                        </div>
                    </div>
                @else
                    {{-- Horizontal Timeline --}}
                    <div class="relative">
                        {{-- Progress bar background --}}
                        <div class="absolute left-4 top-4 h-0.5 w-[calc(100%-2rem)] bg-slate-200 sm:left-0 sm:right-0 sm:top-4 sm:w-full"></div>

                        {{-- Progress bar fill --}}
                        @if ($currentIndex !== false && $currentIndex > 0)
                            <div class="absolute left-4 top-4 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-500 transition-all duration-500 sm:left-0"
                                 style="width: {{ ($currentIndex / (count($steps) - 1)) * 100 }}%"></div>
                        @endif

                        {{-- Steps --}}
                        <ol class="relative flex flex-col gap-6 sm:flex-row sm:justify-between sm:gap-0">
                            @foreach ($steps as $key => $label)
                                @php
                                    $index = array_search($key, $flow, true);
                                    $done = $currentIndex !== false && $index <= $currentIndex;
                                    $active = $index === $currentIndex;
                                @endphp
                                <li class="flex items-center gap-3 sm:flex-col sm:items-center sm:gap-2">
                                    <div class="relative flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full text-xs font-bold ring-4 ring-white
                                                {{ $done
                                                    ? ($active ? 'bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-300 animate-pulse' : 'bg-indigo-600 text-white')
                                                    : 'bg-slate-200 text-slate-500' }}">
                                        @if ($done && !$active)
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </div>
                                    <div class="sm:text-center">
                                        <p class="text-sm font-semibold {{ $done ? 'text-slate-900' : 'text-slate-400' }}">
                                            {{ $label }}
                                        </p>
                                        @if ($active)
                                            <p class="text-[10px] font-medium uppercase tracking-wider text-indigo-600">
                                                Saat ini
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
        </div>

        {{-- Detail Grid --}}
        <div class="mt-6 grid gap-6 md:grid-cols-2">

            {{-- Card: Data Pemesan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-2 border-b border-slate-100 bg-slate-50/60 px-5 py-3.5">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-sky-100 text-sky-600">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-sm font-bold text-slate-900">Data Pemesan</h2>
                </div>

                <dl class="divide-y divide-slate-100">
                    <div class="flex items-start gap-3 px-5 py-3">
                        <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-500">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Nama</dt>
                            <dd class="text-sm font-semibold text-slate-800">{{ $order->customer_name }}</dd>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 px-5 py-3">
                        <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-500">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">No. HP/WhatsApp</dt>
                            <dd class="text-sm font-semibold text-slate-800">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}"
                                   target="_blank"
                                   class="text-emerald-600 transition-colors hover:text-emerald-700 hover:underline">
                                    {{ $order->customer_phone }}
                                </a>
                            </dd>
                        </div>
                    </div>

                    @if ($order->customer_email)
                        <div class="flex items-start gap-3 px-5 py-3">
                            <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-500">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Email</dt>
                                <dd class="truncate text-sm font-semibold text-slate-800">{{ $order->customer_email }}</dd>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-start gap-3 px-5 py-3">
                        <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-500">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Alamat</dt>
                            <dd class="text-sm font-semibold text-slate-800">{{ $order->address }}</dd>
                        </div>
                    </div>

                    @if ($order->notes)
                        <div class="flex items-start gap-3 bg-amber-50/50 px-5 py-3">
                            <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-amber-100 text-amber-600">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <dt class="text-xs font-medium uppercase tracking-wide text-amber-700">Catatan</dt>
                                <dd class="text-sm font-medium text-amber-900">{{ $order->notes }}</dd>
                            </div>
                        </div>
                    @endif
                </dl>
            </div>

            {{-- Card: Rincian Pesanan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-5 py-3.5">
                    <div class="flex items-center gap-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Rincian Pesanan</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                        {{ $order->items->count() }} item
                    </span>
                </div>

                <ul class="divide-y divide-slate-100">
                    @foreach ($order->items as $item)
                        <li class="flex items-start gap-3 px-5 py-3">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 text-xs font-bold uppercase text-white shadow-sm">
                                {{ mb_substr($item->product_name, 0, 2) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="line-clamp-1 text-sm font-semibold text-slate-800">{{ $item->product_name }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <span class="whitespace-nowrap text-sm font-bold text-slate-800">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="border-t border-slate-200 bg-slate-50/60 px-5 py-3">
                    <div class="flex items-end justify-between">
                        <span class="text-sm font-semibold text-slate-700">Total Pembayaran</span>
                        <span class="text-lg font-extrabold text-indigo-600">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('catalog.index') }}"
               class="group inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md">
                <svg class="h-4 w-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Belanja Lagi
            </a>
            <a href="{{ route('orders.track') }}"
               class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:text-slate-900">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Lacak Pesanan Lain
            </a>
        </div>
    </div>
@endsection