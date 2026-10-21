@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-6 flex flex-wrap items-end gap-3 rounded-2xl border border-slate-200 bg-white p-4">
        <div>
            <label for="from" class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Dari tanggal</label>
            <input type="date" name="from" id="from" value="{{ $from->format('Y-m-d') }}"
                class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
        </div>
        <div>
            <label for="to" class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Sampai tanggal</label>
            <input type="date" name="to" id="to" value="{{ $to->format('Y-m-d') }}"
                class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
        </div>
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Terapkan</button>
        @error('to')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
    </form>

    <p class="mb-4 text-sm text-slate-500">
        Periode: <span class="font-medium text-slate-700">{{ $from->translatedFormat('d F Y') }}</span>
        &mdash; <span class="font-medium text-slate-700">{{ $to->translatedFormat('d F Y') }}</span>
    </p>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Total Pesanan</p>
            <p class="mt-1 text-3xl font-bold text-slate-900">{{ $summary['orders'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Pendapatan</p>
            <p class="mt-1 text-2xl font-bold text-emerald-600">Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Pesanan Selesai</p>
            <p class="mt-1 text-3xl font-bold text-slate-900">{{ $summary['completed'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Dibatalkan</p>
            <p class="mt-1 text-3xl font-bold text-rose-600">{{ $summary['cancelled'] }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-5">
            <h2 class="font-bold text-slate-900">Pendapatan Harian</h2>
            @if ($daily->count())
                <div class="mt-6 space-y-3">
                    @foreach ($daily as $row)
                        <div class="flex items-center gap-3 text-sm">
                            <span class="w-24 shrink-0 text-slate-500">{{ \Illuminate\Support\Carbon::parse($row->day)->format('d/m/Y') }}</span>
                            <div class="h-6 flex-1 overflow-hidden rounded-md bg-slate-100">
                                <div class="h-full rounded-md bg-indigo-500" style="width: {{ max(2, round($row->revenue / $maxDailyRevenue * 100)) }}%"></div>
                            </div>
                            <span class="w-16 shrink-0 text-right text-slate-500">{{ $row->orders }} ord</span>
                            <span class="w-32 shrink-0 text-right font-medium text-slate-800">Rp {{ number_format($row->revenue, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-4 text-sm text-slate-500">Tidak ada data pada periode ini.</p>
            @endif
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="font-bold text-slate-900">Pesanan per Status</h2>
                <ul class="mt-3 space-y-2 text-sm">
                    @foreach ($statuses as $key => $label)
                        <li class="flex items-center justify-between">
                            <span class="text-slate-600">{{ $label }}</span>
                            <span class="font-semibold text-slate-900">{{ (int) ($byStatus[$key] ?? 0) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h2 class="font-bold text-slate-900">Produk Terlaris</h2>
                @if ($topProducts->count())
                    <ul class="mt-3 space-y-3 text-sm">
                        @foreach ($topProducts as $product)
                            <li>
                                <div class="flex items-center justify-between gap-2">
                                    <span class="line-clamp-1 text-slate-700">{{ $product->product_name }}</span>
                                    <span class="shrink-0 font-semibold text-slate-900">{{ $product->qty }} pcs</span>
                                </div>
                                <p class="text-xs text-slate-400">Rp {{ number_format($product->revenue, 0, ',', '.') }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-3 text-sm text-slate-500">Belum ada penjualan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
