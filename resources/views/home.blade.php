@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-indigo-50/40 to-purple-50/40 py-16 lg:py-24">
        {{-- Decorative blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                
                {{-- KOLOM KIRI: Teks --}}
                <div class="text-center lg:text-left">
                    <span class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/80 px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm backdrop-blur">
                        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-indigo-500"></span>
                        Belanja Online Tanpa Ribet
                    </span>

                    <h1 class="mt-6 text-4xl font-black leading-[1.1] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Katalog Produk<br>
                        <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-rose-500 bg-clip-text text-transparent">
                            Pesanan Online
                        </span>
                    </h1>

                    <p class="mt-6 mx-auto max-w-lg text-base leading-relaxed text-slate-600 sm:text-lg lg:mx-0">
                        Pilih produk, masukkan ke keranjang, dan checkout langsung di website. Pantau status pesanan dengan kode order — tanpa perlu WhatsApp.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                        <a href="{{ route('catalog.index') }}"
                           class="group inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-300/50 transition-all hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-300/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                            Jelajahi Katalog
                        </a>
                        <a href="{{ route('orders.track') }}"
                           class="group inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Lacak Pesanan
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="mt-10 grid grid-cols-3 gap-4 border-t border-slate-200/70 pt-6">
                        @foreach ([
                            ['value' => $stats['products'] ?? 247, 'label' => 'Produk', 'color' => 'indigo'],
                            ['value' => $stats['categories'] ?? 15, 'label' => 'Kategori', 'color' => 'purple'],
                            ['value' => $stats['orders'] ?? 89, 'label' => 'Pesanan', 'color' => 'rose'],
                        ] as $stat)
                            <div>
                                <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $stat['value'] }}</p>
                                <p class="mt-0.5 flex items-center justify-center lg:justify-start gap-1 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    <span class="h-1.5 w-1.5 rounded-full bg-{{ $stat['color'] }}-500"></span>
                                    {{ $stat['label'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- KOLOM KANAN: Grid Gambar Produk --}}
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                    {{-- Decorative circle --}}
                    <div class="absolute -inset-4 rounded-3xl bg-gradient-to-br from-indigo-200/30 to-purple-200/30 blur-2xl"></div>

                    <div class="relative grid grid-cols-2 gap-3 sm:gap-4">
                        @foreach ($featured->take(4) as $product)
                            <a href="{{ route('catalog.show', $product) }}"
                               class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-100/50">
                                <div class="aspect-square overflow-hidden bg-slate-50">
                                    <div class="h-full w-full transition-transform duration-500 group-hover:scale-105">
                                        @include('partials.product-image', ['product' => $product])
                                    </div>
                                </div>
                                <div class="p-3">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-600">
                                        {{ $product->category?->name }}
                                    </p>
                                    <p class="mt-0.5 line-clamp-1 text-xs font-semibold text-slate-800">
                                        {{ $product->name }}
                                    </p>
                                    <p class="mt-1 text-sm font-extrabold text-indigo-600">
                                        {{ $product->formatted_price }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Sisa kode section bawah (How It Works, Categories, dll) tetap sama... --}}
    {{-- Silakan copy-paste bagian bawah dari kode sebelumnya --}}

@endsection