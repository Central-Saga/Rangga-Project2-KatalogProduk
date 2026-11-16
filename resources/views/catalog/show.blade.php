@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-5 flex flex-wrap items-center gap-1.5 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="transition-colors hover:text-indigo-600">Beranda</a>
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('catalog.index') }}" class="transition-colors hover:text-indigo-600">Katalog</a>
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            @if ($product->category)
                <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
                   class="transition-colors hover:text-indigo-600">
                    {{ $product->category->name }}
                </a>
                <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            @endif
            <span class="line-clamp-1 font-medium text-slate-700">{{ $product->name }}</span>
        </nav>

        <div class="grid gap-8 lg:grid-cols-2">

            {{-- Kolom Kiri: Gambar --}}
            <div class="lg:sticky lg:top-24 lg:self-start">
                <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-slate-50 to-slate-100 shadow-sm">
                    <div class="aspect-square overflow-hidden">
                        @include('partials.product-image', ['product' => $product])
                    </div>
                </div>

                {{-- Trust Badges di bawah gambar --}}
                <div class="mt-4 grid grid-cols-3 gap-2">
                    <div class="rounded-xl border border-slate-200 bg-white p-3 text-center shadow-sm">
                        <div class="mx-auto mb-1 flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-[10px] font-semibold text-slate-600">100% Original</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-3 text-center shadow-sm">
                        <div class="mx-auto mb-1 flex h-7 w-7 items-center justify-center rounded-lg bg-sky-100 text-sky-600">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="text-[10px] font-semibold text-slate-600">Kirim Cepat</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-3 text-center shadow-sm">
                        <div class="mx-auto mb-1 flex h-7 w-7 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <p class="text-[10px] font-semibold text-slate-600">Bayar Aman</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Info & Aksi --}}
            <div>
                {{-- Kategori Badge --}}
                @if ($product->category)
                    <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
                       class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200 transition-colors hover:bg-indigo-100">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        {{ $product->category->name }}
                    </a>
                @endif

                {{-- Nama Produk --}}
                <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                    {{ $product->name }}
                </h1>

                {{-- Rating (Opsional — pakai jika ada field rating) --}}
                {{-- <div class="mt-2 flex items-center gap-2 text-sm text-slate-500">
                    ⭐⭐⭐⭐⭐ (4.8) · 120 terjual
                </div> --}}

                {{-- Harga Besar --}}
                <div class="mt-5 flex flex-wrap items-baseline gap-3">
                    <p class="text-3xl font-extrabold tracking-tight text-indigo-600 sm:text-4xl">
                        {{ $product->formatted_price }}
                    </p>
                </div>

                {{-- Status Stok --}}
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    @if ($product->stock > 5)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Stok tersedia
                        </span>
                        <span class="text-xs text-slate-500">Tersisa <span class="font-semibold text-slate-700">{{ $product->stock }}</span> pcs</span>
                    @elseif ($product->stock > 0)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Stok terbatas
                        </span>
                        <span class="text-xs text-slate-500">Segera pesan! Tersisa <span class="font-semibold text-amber-700">{{ $product->stock }}</span> pcs</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 ring-1 ring-inset ring-rose-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                            Stok habis
                        </span>
                    @endif
                </div>

                {{-- Divider --}}
                <div class="my-6 border-t border-dashed border-slate-200"></div>

                {{-- Deskripsi --}}
                <div>
                    <h2 class="mb-2 flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-slate-700">
                        <span class="h-4 w-1 rounded-full bg-indigo-600"></span>
                        Deskripsi Produk
                    </h2>
                    <div class="prose prose-sm max-w-none text-slate-600 leading-relaxed">
                        <p>{!! nl2br(e($product->description ?? 'Belum ada deskripsi produk.')) !!}</p>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="my-6 border-t border-dashed border-slate-200"></div>

                {{-- Form Beli --}}
                <form action="{{ route('cart.store', $product) }}" method="POST"
                      class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50/50 p-4">
                    @csrf

                    <div class="flex flex-wrap items-end gap-3">
                        {{-- Qty --}}
                        <div>
                            <label for="quantity" class="mb-2 block text-sm font-semibold text-slate-700">
                                Jumlah
                            </label>
                            <div class="inline-flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                                {{-- Minus --}}
                                <button type="button" onclick="decrementQty(this)"
                                        aria-label="Kurangi jumlah"
                                        class="flex h-10 w-10 items-center justify-center text-slate-500 transition-colors hover:bg-slate-50 hover:text-indigo-600 disabled:cursor-not-allowed disabled:opacity-40"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
                                    </svg>
                                </button>

                                <input type="number" name="quantity" id="quantity" value="1"
                                    min="1" max="{{ max(1, $product->stock) }}"
                                    onchange="validateQty(this, {{ $product->stock }})"
                                    class="w-14 border-x border-slate-200 bg-white py-2.5 text-center text-sm font-bold text-slate-800 focus:outline-none focus:ring-0
                                           [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">

                                {{-- Plus --}}
                                <button type="button" onclick="incrementQty(this, {{ $product->stock }})"
                                        aria-label="Tambah jumlah"
                                        class="flex h-10 w-10 items-center justify-center text-slate-500 transition-colors hover:bg-slate-50 hover:text-indigo-600 disabled:cursor-not-allowed disabled:opacity-40"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Subtotal Preview --}}
                        <div class="flex-1 text-right sm:text-left">
                            <p class="text-xs font-medium text-slate-500">Subtotal</p>
                            <p class="text-lg font-extrabold text-indigo-600" id="subtotalPreview">
                                {{ $product->formatted_price }}
                            </p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap gap-2">
                        <button type="submit" @disabled($product->stock <= 0)
                            class="group inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:shadow-none">
                            @if ($product->stock > 0)
                                <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tambah ke Keranjang
                            @else
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Stok Habis
                            @endif
                        </button>

                        <a href="{{ route('cart.index') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:text-slate-900">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17"/>
                            </svg>
                            Lihat Keranjang
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Produk Serupa --}}
        @if ($related->count())
            <section class="mt-16">
                <div class="mb-6 flex items-center gap-2">
                    <span class="h-6 w-1 rounded-full bg-indigo-600"></span>
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Produk Serupa</h2>
                    <span class="ml-auto rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                        {{ $related->count() }} produk
                    </span>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    {{-- Scripts --}}
    @push('scripts')
    <script>
        const productPrice = {{ $product->price }};
        const productStock = {{ $product->stock }};

        function formatRupiah(num) {
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        function updateSubtotal() {
            const input = document.getElementById('quantity');
            const qty = parseInt(input.value) || 1;
            document.getElementById('subtotalPreview').textContent = formatRupiah(productPrice * qty);
        }

        function incrementQty(btn, max) {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value) || 0;
            if (current < max) {
                input.value = current + 1;
                updateSubtotal();
            }
        }

        function decrementQty(btn) {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value) || 0;
            if (current > 1) {
                input.value = current - 1;
                updateSubtotal();
            }
        }

        function validateQty(input, max) {
            let val = parseInt(input.value) || 1;
            if (val < 1) val = 1;
            if (val > max) val = max;
            input.value = val;
            updateSubtotal();
        }

        // Update subtotal saat qty berubah
        document.getElementById('quantity')?.addEventListener('input', updateSubtotal);
    </script>
    @endpush
@endsection