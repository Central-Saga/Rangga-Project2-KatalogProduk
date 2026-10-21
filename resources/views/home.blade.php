@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-14 md:grid-cols-2">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                    Belanja online tanpa ribet
                </span>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight text-slate-900 sm:text-5xl">
                    Katalog Produk &amp; Pesanan Online
                </h1>
                <p class="mt-4 max-w-lg text-slate-600">
                    Pilih produk, masukkan ke keranjang, checkout lewat website, lalu lacak status pesanan
                    Anda hanya dengan kode order. Semua tercatat rapi di database.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        Jelajahi Katalog
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('orders.track') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">
                        Lacak Pesanan
                    </a>
                </div>
                <dl class="mt-8 flex gap-8">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Produk</dt>
                        <dd class="text-2xl font-bold text-slate-900">{{ $stats['products'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Kategori</dt>
                        <dd class="text-2xl font-bold text-slate-900">{{ $stats['categories'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Pesanan</dt>
                        <dd class="text-2xl font-bold text-slate-900">{{ $stats['orders'] }}</dd>
                    </div>
                </dl>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($featured->take(4) as $product)
                    <a href="{{ route('catalog.show', $product) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div class="aspect-square">
                            @include('partials.product-image', ['product' => $product])
                        </div>
                        <div class="bg-white p-3">
                            <p class="line-clamp-1 text-sm font-medium text-slate-800">{{ $product->name }}</p>
                            <p class="text-sm font-bold text-indigo-600">{{ $product->formatted_price }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-12">
        <div class="mb-6 flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Kategori</h2>
                <p class="text-sm text-slate-500">Telusuri produk berdasarkan kategori.</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
            @foreach ($categories as $category)
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="rounded-xl border border-slate-200 bg-white p-4 text-center shadow-sm transition hover:border-indigo-300 hover:shadow-md">
                    <p class="font-semibold text-slate-800">{{ $category->name }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $category->products_count }} produk</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-12">
        <div class="mb-6 flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Produk Terbaru</h2>
                <p class="text-sm text-slate-500">Pilihan produk yang baru ditambahkan.</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featured as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="border-t border-slate-200 bg-white py-12">
        <div class="mx-auto max-w-6xl px-4">
            <h2 class="text-2xl font-bold text-slate-900">Testimoni Pelanggan</h2>
            <p class="text-sm text-slate-500">Testimoni yang sudah disetujui admin akan tampil di sini.</p>

            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($testimonials as $testimonial)
                    <figure class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="flex text-amber-400">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-300' }}" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.48 3.5a.562.562 0 0 1 1.04 0l2.125 5.111 5.53.442a.563.563 0 0 1 .32.988l-4.213 3.61 1.286 5.38a.563.563 0 0 1-.84.61L12 17.22l-4.728 2.903a.563.563 0 0 1-.84-.61l1.286-5.38-4.213-3.61a.563.563 0 0 1 .32-.988l5.53-.442L11.48 3.5Z" />
                                </svg>
                            @endfor
                        </div>
                        <blockquote class="mt-3 text-sm text-slate-700">&ldquo;{{ $testimonial->message }}&rdquo;</blockquote>
                        <figcaption class="mt-3 text-sm font-semibold text-slate-900">{{ $testimonial->name }}</figcaption>
                    </figure>
                @empty
                    <p class="text-sm text-slate-500">Belum ada testimoni yang disetujui.</p>
                @endforelse
            </div>

            <div class="mt-8 grid gap-6 rounded-2xl border border-slate-200 bg-slate-50 p-6 md:grid-cols-2">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Kirim Testimoni Anda</h3>
                    <p class="mt-1 text-sm text-slate-500">Bagikan pengalaman belanja Anda. Testimoni akan tampil setelah disetujui admin.</p>
                </div>
                <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label for="t_name" class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
                            <input type="text" name="name" id="t_name" value="{{ old('name') }}" required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="t_email" class="mb-1 block text-sm font-medium text-slate-700">Email (opsional)</label>
                            <input type="email" name="email" id="t_email" value="{{ old('email') }}"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="t_rating" class="mb-1 block text-sm font-medium text-slate-700">Rating</label>
                        <select name="rating" id="t_rating" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} Bintang</option>
                            @endfor
                        </select>
                        @error('rating')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="t_message" class="mb-1 block text-sm font-medium text-slate-700">Pesan</label>
                        <textarea name="message" id="t_message" rows="3" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Kirim Testimoni</button>
                </form>
            </div>
        </div>
    </section>
@endsection
