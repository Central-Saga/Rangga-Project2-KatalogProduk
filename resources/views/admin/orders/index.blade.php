@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
    {{-- Page Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-slate-800">Kelola Pesanan</h1>
                <p class="text-sm text-slate-500">
                    Total <span class="font-semibold text-slate-700">{{ $orders->total() }}</span> pesanan terdaftar
                </p>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="mb-5 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="p-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                {{-- Search --}}
                <div class="relative flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari kode / nama / no. HP..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                </div>

                {{-- Status Filter --}}
                <div class="sm:w-56">
                    <select name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm transition-all
                                   focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                        <option value="">Semua status</option>
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-slate-700 focus:outline-none focus:ring-4 focus:ring-slate-200">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                    @if (request()->hasAny(['q', 'status']))
                        <a href="{{ route('admin.orders.index') }}"
                           class="inline-flex items-center gap-1.5 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition-all hover:bg-slate-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/70 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-3.5">Kode</th>
                        <th class="px-5 py-3.5">Pemesan</th>
                        <th class="px-5 py-3.5">Tanggal</th>
                        <th class="px-5 py-3.5 text-right">Total</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr class="group transition-colors hover:bg-slate-50/70">

                            {{-- Kode --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2 py-1 font-mono text-xs font-semibold text-indigo-700">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $order->order_code }}
                                </span>
                            </td>

                            {{-- Pemesan --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 text-xs font-bold uppercase text-white shadow-sm">
                                        {{ mb_substr($order->customer_name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate font-medium text-slate-800 group-hover:text-indigo-600">
                                            {{ $order->customer_name }}
                                        </p>
                                        <p class="text-xs text-slate-400">{{ $order->customer_phone }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Tanggal --}}
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                <div class="flex items-center gap-1.5 text-xs">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $order->created_at->format('d/m/Y') }}
                                    <span class="text-slate-400">·</span>
                                    {{ $order->created_at->format('H:i') }}
                                </div>
                            </td>

                            {{-- Total --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right font-semibold text-slate-800">
                                {{ $order->formatted_total }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $order->status_badge }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    {{ $order->status_label }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->order_code) }}"
                                   class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-2.5 py-1.5 text-xs font-medium text-slate-600 transition-all hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto flex max-w-xs flex-col items-center">
                                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-700">
                                        @if (request()->hasAny(['q', 'status']))
                                            Tidak ada pesanan yang cocok
                                        @else
                                            Belum ada pesanan
                                        @endif
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        @if (request()->hasAny(['q', 'status']))
                                            Coba ubah kata kunci atau filter status.
                                        @else
                                            Pesanan dari pelanggan akan muncul di sini.
                                        @endif
                                    </p>
                                    @if (request()->hasAny(['q', 'status']))
                                        <a href="{{ route('admin.orders.index') }}"
                                           class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-700">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            Reset Filter
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($orders->hasPages())
        <div class="mt-5">{{ $orders->links() }}</div>
    @endif
@endsection