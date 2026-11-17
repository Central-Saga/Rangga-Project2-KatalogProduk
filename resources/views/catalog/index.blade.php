@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-4 flex items-center gap-1.5 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="transition-colors hover:text-indigo-600">Beranda</a>
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-slate-700">Katalog</span>
        </nav>

        {{-- Page Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Katalog Produk</h1>
            <p class="mt-1 text-sm text-slate-500">
                Temukan produk favorit Anda dengan mudah.
            </p>
        </div>

        <div class="flex flex-col gap-6 lg:flex-row">

            {{-- Sidebar Kategori --}}
            <aside class="lg:w-64 lg:shrink-0">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    {{-- Header Kategori --}}
                    <div class="flex items-center gap-2 border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-4 py-3">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Kategori</h2>
                    </div>

                    {{-- List Kategori --}}
                    <ul class="p-2">
                        <li>
                            <a href="{{ route('catalog.index', array_filter(request()->except('category', 'page'))) }}"
                               class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-colors
                                      {{ ! request('category')
                                          ? 'bg-indigo-50 font-semibold text-indigo-700'
                                          : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                <span>Semua Kategori</span>
                                @if (! request('category'))
                                    <svg class="h-4 w-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                @endif
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('catalog.index', array_merge(array_filter(request()->except('page')), ['category' => $category->slug])) }}"
                                   class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition-colors
                                          {{ request('category') === $category->slug
                                              ? 'bg-indigo-50 font-semibold text-indigo-700'
                                              : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800' }}">
                                    <span class="truncate">{{ $category->name }}</span>
                                    @if (request('category') === $category->slug)
                                        <svg class="h-4 w-4 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Konten Utama --}}
            <div class="min-w-0 flex-1">

                {{-- Search & Filter Bar --}}
                <form method="GET" action="{{ route('catalog.index') }}"
                      class="mb-5 overflow-hidden rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                        {{-- Search --}}
                        <div class="relative flex-1">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                       focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                        </div>

                        {{-- Sort --}}
                        <div class="relative sm:w-48">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                </svg>
                            </div>
                            <select name="sort"
                                    class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-800 shadow-sm transition-all
                                           focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                                <option value="newest" @selected(request('sort', 'newest') === 'newest')>Terbaru</option>
                                <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga terendah</option>
                                <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga tertinggi</option>
                                <option value="name" @selected(request('sort') === 'name')>Nama A-Z</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                    </div>

                    {{-- Active Filters --}}
                    @if (request()->hasAny(['q', 'category']) && (request('q') || request('category')))
                        <div class="mt-3 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3">
                            <span class="text-xs font-medium text-slate-500">Filter aktif:</span>
                            @if (request('category'))
                                @php $activeCategory = $categories->firstWhere('slug', request('category')); @endphp
                                @if ($activeCategory)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ $activeCategory->name }}
                                    </span>
                                @endif
                            @endif
                            @if (request('q'))
                                <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                    "{{ request('q') }}"
                                </span>
                            @endif
                            <a href="{{ route('catalog.index') }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-rose-600 hover:text-rose-700">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </a>
                        </div>
                    @endif
                </form>

                {{-- Info Hasil --}}
                <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-semibold text-slate-700">{{ $products->count() }}</span>
                        dari <span class="font-semibold text-slate-700">{{ $products->total() }}</span> produk
                        @if (request('q'))
                            untuk pencarian <span class="font-semibold text-indigo-600">&ldquo;{{ request('q') }}&rdquo;</span>
                        @endif
                    </p>
                </div>

                {{-- Produk Grid --}}
                @if ($products->count())
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($products as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="overflow-hidden rounded-3xl border-2 border-dashed border-slate-200 bg-white shadow-sm">
                        <div class="px-6 py-16 text-center">
                            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-indigo-50 to-purple-50 text-indigo-500">
                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Produk tidak ditemukan</h2>
                            <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">
                                Coba kata kunci lain atau pilih kategori berbeda.
                            </p>
                            <a href="{{ route('catalog.index') }}"
                               class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset Filter
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection