@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">
        <nav class="mb-4 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('catalog.index') }}" class="hover:text-indigo-600">Katalog</a>
            <span class="mx-1">/</span>
            <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700">{{ $product->name }}</span>
        </nav>

        <div class="grid gap-8 lg:grid-cols-2">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                <div class="aspect-square">
                    @include('partials.product-image', ['product' => $product])
                </div>
            </div>

            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">{{ $product->category->name }}</p>
                <h1 class="mt-1 text-3xl font-extrabold text-slate-900">{{ $product->name }}</h1>

                <p class="mt-4 text-3xl font-bold text-slate-900">{{ $product->formatted_price }}</p>

                <div class="mt-4 flex items-center gap-4 text-sm">
                    @if ($product->stock > 5)
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 font-medium text-emerald-700">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Stok tersedia ({{ $product->stock }})
                        </span>
                    @elseif ($product->stock > 0)
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1 font-medium text-amber-700">
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span> Stok terbatas ({{ $product->stock }})
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1 font-medium text-rose-700">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span> Stok habis
                        </span>
                    @endif
                </div>

                <div class="prose prose-sm mt-5 max-w-none text-slate-600">
                    <p>{!! nl2br(e($product->description ?? 'Belum ada deskripsi produk.')) !!}</p>
                </div>

                <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-6 flex flex-wrap items-end gap-3">
                    @csrf
                    <div>
                        <label for="quantity" class="mb-1 block text-sm font-medium text-slate-700">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ max(1, $product->stock) }}"
                            class="w-24 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <button type="submit" @disabled($product->stock <= 0)
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272" />
                        </svg>
                        {{ $product->stock <= 0 ? 'Stok habis' : 'Tambah ke Keranjang' }}
                    </button>
                    <a href="{{ route('cart.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100">Lihat Keranjang</a>
                </form>
            </div>
        </div>

        @if ($related->count())
            <section class="mt-14">
                <h2 class="mb-5 text-2xl font-bold text-slate-900">Produk Serupa</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
