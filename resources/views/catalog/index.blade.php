@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">
        <nav class="mb-4 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700">Katalog</span>
        </nav>

        <div class="flex flex-col gap-6 lg:flex-row">
            <aside class="lg:w-64 lg:shrink-0">
                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <h2 class="mb-3 text-sm font-bold uppercase tracking-wide text-slate-500">Kategori</h2>
                    <ul class="space-y-1 text-sm">
                        <li>
                            <a href="{{ route('catalog.index', array_filter(request()->except('category', 'page'))) }}"
                               class="block rounded-lg px-3 py-2 {{ ! request('category') ? 'bg-indigo-50 font-semibold text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
                                Semua Kategori
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('catalog.index', array_merge(array_filter(request()->except('page')), ['category' => $category->slug])) }}"
                                   class="block rounded-lg px-3 py-2 {{ request('category') === $category->slug ? 'bg-indigo-50 font-semibold text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <div class="flex-1">
                <form method="GET" action="{{ route('catalog.index') }}" class="mb-5 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                            class="w-full rounded-lg border border-slate-300 py-2 pl-9 pr-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <select name="sort" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="newest" @selected(request('sort', 'newest') === 'newest')>Terbaru</option>
                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga terendah</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga tertinggi</option>
                        <option value="name" @selected(request('sort') === 'name')>Nama A-Z</option>
                    </select>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Cari</button>
                </form>

                <p class="mb-4 text-sm text-slate-500">
                    Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk
                    @if (request('q')) untuk pencarian &ldquo;{{ request('q') }}&rdquo;@endif
                </p>

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
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                        <p class="font-semibold text-slate-700">Produk tidak ditemukan.</p>
                        <p class="mt-1 text-sm text-slate-500">Coba kata kunci lain atau pilih kategori berbeda.</p>
                        <a href="{{ route('catalog.index') }}" class="mt-4 inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Reset filter</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
