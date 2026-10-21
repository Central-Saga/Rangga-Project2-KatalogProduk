@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="relative overflow-hidden border-b border-slate-200 bg-white">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-40 right-0 h-[32rem] w-[32rem] rounded-full bg-indigo-100/60 blur-3xl"></div>
            <div class="absolute -left-24 top-24 h-72 w-72 rounded-full bg-slate-100 blur-3xl"></div>
        </div>

        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-medium text-slate-600 shadow-sm">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Belanja online tanpa ribet
                </span>

                <h1 class="mt-6 text-4xl font-semibold leading-[1.08] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Katalog produk &amp;<br class="hidden sm:block">
                    <span class="text-indigo-600">pesanan online.</span>
                </h1>

                <p class="mt-5 max-w-lg text-base leading-relaxed text-slate-600">
                    Pilih produk, masukkan ke keranjang, checkout langsung di website, lalu pantau status
                    pesanan dengan kode order. Rapi, cepat, dan tercatat di database.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-600">
                        Jelajahi katalog
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('orders.track') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                        Lacak pesanan
                    </a>
                </div>

                <dl class="mt-10 grid max-w-md grid-cols-3 divide-x divide-slate-200 border-t border-slate-200 pt-6">
                    <div class="pr-4">
                        <dt class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Produk</dt>
                        <dd class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['products'] }}</dd>
                    </div>
                    <div class="px-4">
                        <dt class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Kategori</dt>
                        <dd class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['categories'] }}</dd>
                    </div>
                    <div class="pl-4">
                        <dt class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Pesanan</dt>
                        <dd class="mt-1 text-2xl font-semibold text-slate-900">{{ $stats['orders'] }}</dd>
                    </div>
                </dl>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                @foreach ($featured->take(4) as $product)
                    <a href="{{ route('catalog.show', $product) }}"
                       class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg {{ $loop->first ? 'sm:row-span-1' : '' }}">
                        <div class="aspect-square overflow-hidden bg-slate-100">
                            <div class="h-full w-full transition duration-500 group-hover:scale-[1.04]">
                                @include('partials.product-image', ['product' => $product])
                            </div>
                        </div>
                        <div class="p-3.5">
                            <p class="text-[11px] font-medium uppercase tracking-wider text-indigo-600">{{ $product->category?->name }}</p>
                            <p class="mt-0.5 line-clamp-1 text-sm font-medium text-slate-900">{{ $product->name }}</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $product->formatted_price }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto grid max-w-6xl gap-6 px-4 py-12 sm:grid-cols-3">
            @php
                $steps = [
                    ['title' => 'Pilih produk', 'desc' => 'Telusuri katalog, filter kategori, dan cari produk yang Anda butuhkan.', 'icon' => 'M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z'],
                    ['title' => 'Checkout di website', 'desc' => 'Isi data pemesan dan alamat pengiriman, lalu pesanan tersimpan otomatis.', 'icon' => 'M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12A1.125 1.125 0 0 1 19.749 22H4.251a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z'],
                    ['title' => 'Lacak pesanan', 'desc' => 'Gunakan kode order untuk melihat status pesanan secara real-time.', 'icon' => 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z'],
                ];
            @endphp
            @foreach ($steps as $index => $step)
                <div class="flex gap-4">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl border border-slate-200 bg-slate-50 text-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                        </svg>
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">
                            <span class="mr-1 text-slate-400">0{{ $index + 1 }}</span>{{ $step['title'] }}
                        </p>
                        <p class="mt-1 text-sm leading-relaxed text-slate-500">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-14">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-indigo-600">Telusuri</p>
                <h2 class="mt-1 text-2xl font-semibold text-slate-900">Kategori produk</h2>
                <p class="mt-1 text-sm text-slate-500">Temukan produk berdasarkan kategori yang tersedia.</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
            @foreach ($categories as $category)
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                   class="group rounded-xl border border-slate-200 bg-white p-4 transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-sm">
                    <p class="font-medium text-slate-900 transition group-hover:text-indigo-700">{{ $category->name }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ $category->products_count }} produk</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-16">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-indigo-600">Koleksi</p>
                <h2 class="mt-1 text-2xl font-semibold text-slate-900">Produk terbaru</h2>
                <p class="mt-1 text-sm text-slate-500">Pilihan produk yang baru ditambahkan.</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="shrink-0 text-sm font-medium text-indigo-600 transition hover:text-indigo-700">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featured as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="border-y border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-4 py-10 sm:flex-row sm:items-center">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-indigo-600">Transparan</p>
                <h2 class="mt-1 text-xl font-semibold text-slate-900">Dokumentasi proyek: PRD &amp; ERD</h2>
                <p class="mt-1 max-w-xl text-sm text-slate-500">
                    Kebutuhan produk, alur sistem, dan rancangan basis data tersedia lengkap di halaman dokumentasi.
                </p>
            </div>
            <a href="{{ route('docs') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                Buka dokumentasi
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

    <section class="bg-slate-100/70 py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="max-w-2xl">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-indigo-600">Ulasan</p>
                <h2 class="mt-1 text-2xl font-semibold text-slate-900">Testimoni pelanggan</h2>
                <p class="mt-1 text-sm text-slate-500">Testimoni yang sudah disetujui admin akan tampil di sini.</p>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($testimonials as $testimonial)
                    <figure class="flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-200' }}" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.48 3.5a.562.562 0 0 1 1.04 0l2.125 5.111 5.53.442a.563.563 0 0 1 .32.988l-4.213 3.61 1.286 5.38a.563.563 0 0 1-.84.61L12 17.22l-4.728 2.903a.563.563 0 0 1-.84-.61l1.286-5.38-4.213-3.61a.563.563 0 0 1 .32-.988l5.53-.442L11.48 3.5Z" />
                                </svg>
                            @endfor
                        </div>
                        <blockquote class="mt-3 flex-1 text-sm leading-relaxed text-slate-600">&ldquo;{{ $testimonial->message }}&rdquo;</blockquote>
                        <figcaption class="mt-4 border-t border-slate-100 pt-3 text-sm font-semibold text-slate-900">{{ $testimonial->name }}</figcaption>
                    </figure>
                @empty
                    <p class="text-sm text-slate-500">Belum ada testimoni yang disetujui.</p>
                @endforelse
            </div>

            <div class="mt-8 grid gap-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:grid-cols-2 md:p-8">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Kirim testimoni Anda</h3>
                    <p class="mt-1 text-sm leading-relaxed text-slate-500">
                        Bagikan pengalaman belanja Anda. Testimoni akan tampil setelah disetujui admin.
                    </p>
                </div>
                <form action="{{ route('testimonials.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label for="t_name" class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
                            <input type="text" name="name" id="t_name" value="{{ old('name') }}" required
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="t_email" class="mb-1 block text-sm font-medium text-slate-700">Email (opsional)</label>
                            <input type="email" name="email" id="t_email" value="{{ old('email') }}"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @error('email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="t_rating" class="mb-1 block text-sm font-medium text-slate-700">Rating</label>
                        <select name="rating" id="t_rating" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} Bintang</option>
                            @endfor
                        </select>
                        @error('rating')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="t_message" class="mb-1 block text-sm font-medium text-slate-700">Pesan</label>
                        <textarea name="message" id="t_message" rows="3" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-600">Kirim testimoni</button>
                </form>
            </div>
        </div>
    </section>
@endsection
