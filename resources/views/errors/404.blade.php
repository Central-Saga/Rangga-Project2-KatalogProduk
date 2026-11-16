@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="relative min-h-[calc(100vh-8rem)] overflow-hidden bg-gradient-to-br from-slate-50 via-indigo-50/30 to-purple-50/30">
        {{-- Decorative Blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>
            <div class="absolute left-1/2 top-1/2 h-64 w-64 -translate-x-1/2 -translate-y-1/2 rounded-full bg-rose-100/30 blur-3xl"></div>
        </div>

        <div class="relative mx-auto flex min-h-[calc(100vh-8rem)] max-w-2xl flex-col items-center justify-center px-4 py-16 text-center">

            {{-- Icon Empty Box --}}
            <div class="relative mb-8">
                {{-- Glow --}}
                <div class="absolute inset-0 scale-150 rounded-full bg-indigo-400/20 blur-2xl"></div>

                {{-- Icon --}}
                <div class="relative flex h-24 w-24 items-center justify-center rounded-3xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-xl shadow-indigo-300/50 ring-4 ring-white">
                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                {{-- Small floating badges --}}
                <div class="absolute -right-3 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-amber-400 text-white shadow-lg ring-2 ring-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01"/>
                    </svg>
                </div>
            </div>

            {{-- 404 Text --}}
            <p class="bg-gradient-to-r from-indigo-600 via-purple-600 to-rose-500 bg-clip-text text-8xl font-black tracking-tighter text-transparent sm:text-9xl">
                404
            </p>

            {{-- Title --}}
            <h1 class="mt-4 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                Halaman Tidak Ditemukan
            </h1>

            {{-- Subtitle --}}
            <p class="mx-auto mt-3 max-w-md text-sm leading-relaxed text-slate-600 sm:text-base">
                Maaf, halaman atau produk yang Anda cari tidak tersedia.
                Mungkin sudah dipindahkan, dihapus, atau URL-nya salah ketik.
            </p>

            {{-- Actions --}}
            <div class="mt-8 flex flex-col gap-2 sm:flex-row">
                <a href="{{ route('home') }}"
                   class="group inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Ke Beranda
                </a>

                <a href="{{ route('catalog.index') }}"
                   class="group inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Lihat Katalog
                </a>
            </div>

            {{-- Quick Links --}}
            <div class="mt-10 w-full">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-px flex-1 bg-slate-200"></div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Atau coba ini</span>
                    <div class="h-px flex-1 bg-slate-200"></div>
                </div>

                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach ([
                        ['Lacak Pesanan', 'Cek status pesanan Anda', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'orders.track'],
                        ['Keranjang', 'Lihat keranjang belanja', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0', 'cart.index'],
                    ] as [$title, $desc, $icon, $route])
                        @if (Route::has($route))
                            <a href="{{ route($route) }}"
                               class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 text-left shadow-sm transition-all hover:border-indigo-200 hover:shadow-md">
                                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-colors group-hover:bg-indigo-100 group-hover:text-indigo-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-800 group-hover:text-indigo-600">{{ $title }}</p>
                                    <p class="text-xs text-slate-500">{{ $desc }}</p>
                                </div>
                                <svg class="h-4 w-4 flex-shrink-0 text-slate-300 transition-all group-hover:translate-x-0.5 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection