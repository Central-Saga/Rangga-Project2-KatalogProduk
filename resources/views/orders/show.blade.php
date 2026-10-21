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
        <nav class="mb-4 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700">Pesanan {{ $order->order_code }}</span>
        </nav>

        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-500">Kode Pesanan</p>
                    <p class="text-2xl font-extrabold tracking-wide text-slate-900">{{ $order->order_code }}</p>
                    <p class="mt-1 text-sm text-slate-500">Dibuat {{ $order->created_at->translatedFormat('d F Y, H:i') }} WITA</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold ring-1 ring-inset {{ $order->status_badge }}">
                        {{ $order->status_label }}
                    </span>
                    <p class="mt-2 text-xs text-slate-500">Simpan kode ini untuk melacak pesanan.</p>
                </div>
            </div>

            <div class="mt-8">
                @if ($cancelled)
                    <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                        Pesanan ini <strong>dibatalkan</strong>. Silakan hubungi admin bila ada pertanyaan.
                    </div>
                @else
                    <ol class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        @foreach ($steps as $key => $label)
                            @php $index = array_search($key, $flow, true); $done = $currentIndex !== false && $index <= $currentIndex; @endphp
                            <li class="flex flex-1 items-center gap-3">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full text-sm font-bold {{ $done ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-500' }}">
                                    {{ $index + 1 }}
                                </span>
                                <span class="text-sm font-medium {{ $done ? 'text-slate-900' : 'text-slate-400' }}">{{ $label }}</span>
                                @if (! $loop->last)
                                    <span class="hidden h-0.5 flex-1 {{ $index < $currentIndex ? 'bg-indigo-600' : 'bg-slate-200' }} sm:block"></span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-bold text-slate-900">Data Pemesan</h2>
                <dl class="mt-3 space-y-2 text-sm">
                    <div><dt class="text-slate-500">Nama</dt><dd class="font-medium text-slate-800">{{ $order->customer_name }}</dd></div>
                    <div><dt class="text-slate-500">No. HP/WhatsApp</dt><dd class="font-medium text-slate-800">{{ $order->customer_phone }}</dd></div>
                    @if ($order->customer_email)
                        <div><dt class="text-slate-500">Email</dt><dd class="font-medium text-slate-800">{{ $order->customer_email }}</dd></div>
                    @endif
                    <div><dt class="text-slate-500">Alamat</dt><dd class="font-medium text-slate-800">{{ $order->address }}</dd></div>
                    @if ($order->notes)
                        <div><dt class="text-slate-500">Catatan</dt><dd class="font-medium text-slate-800">{{ $order->notes }}</dd></div>
                    @endif
                </dl>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-bold text-slate-900">Rincian Pesanan</h2>
                <ul class="mt-3 divide-y divide-slate-100 text-sm">
                    @foreach ($order->items as $item)
                        <li class="flex justify-between gap-3 py-2">
                            <span class="text-slate-600">
                                {{ $item->product_name }}
                                <span class="text-slate-400">&times;{{ $item->quantity }}</span>
                            </span>
                            <span class="font-medium text-slate-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3 flex justify-between border-t border-slate-200 pt-3 text-base">
                    <span class="font-semibold text-slate-700">Total</span>
                    <span class="font-bold text-slate-900">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('catalog.index') }}" class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">Belanja lagi</a>
            <a href="{{ route('orders.track') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100">Lacak pesanan lain</a>
        </div>
    </div>
@endsection
