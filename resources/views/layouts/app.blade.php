<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'entral saga shopping                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ') &middot; {{ config('app.name') }}</title>
    <meta name="description" content="Katalog produk online dengan sistem pesanan dan pelacakan status pesanan.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-slate-50 text-slate-700 antialiased">
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4">
            <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-slate-900 text-white shadow-sm transition group-hover:bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12A1.125 1.125 0 0 1 19.749 22H4.251a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                    </svg>
                </span>
                <span class="leading-tight">
                    <span class="block text-sm font-semibold tracking-tight text-slate-900">{{ config('app.name') }}</span>
                    <span class="block text-[11px] text-slate-500">Katalog &amp; Pesanan Online</span>
                </span>
            </a>

            <div class="hidden items-center gap-1 text-sm font-medium md:flex">
                @php
                    $links = [
                        ['route' => 'home', 'label' => 'Beranda', 'match' => 'home'],
                        ['route' => 'catalog.index', 'label' => 'Katalog', 'match' => 'catalog.*'],
                        ['route' => 'orders.track', 'label' => 'Lacak Pesanan', 'match' => 'orders.track'],
                        ['route' => 'docs', 'label' => 'Dokumentasi', 'match' => 'docs'],
                    ];
                @endphp
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="rounded-lg px-3 py-2 transition {{ request()->routeIs($link['match']) ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:text-slate-900' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span class="hidden sm:inline">Keranjang</span>
                    @if (\App\Support\Cart::count() > 0)
                        <span class="absolute -right-2 -top-2 grid h-5 min-w-5 place-items-center rounded-full bg-indigo-600 px-1 text-xs font-semibold text-white shadow-sm">{{ \App\Support\Cart::count() }}</span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Dashboard</a>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Daftar</a>
                        @endif
                    </div>
                @endauth
            </div>
        </nav>

        <div class="flex gap-1 overflow-x-auto border-t border-slate-100 px-4 pb-2 md:hidden">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="shrink-0 rounded-lg px-3 py-1.5 text-sm font-medium {{ request()->routeIs($link['match']) ? 'bg-slate-100 text-slate-900' : 'text-slate-500' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </header>

    <main class="flex-1">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="border-t border-slate-800 bg-slate-950 text-slate-400">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 sm:grid-cols-2 lg:grid-cols-4">
            <div class="sm:col-span-2">
                <div class="flex items-center gap-2.5">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-white/10 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12A1.125 1.125 0 0 1 19.749 22H4.251a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                        </svg>
                    </span>
                    <span class="text-sm font-semibold text-white">{{ config('app.name') }}</span>
                </div>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">
                    Katalog produk dengan sistem pesanan dan pelacakan status &mdash; tanpa WhatsApp.
                    Seluruh proses belanja dan pemesanan dilakukan langsung di website.
                </p>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jelajahi</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="transition hover:text-white">Katalog Produk</a></li>
                    <li><a href="{{ route('orders.track') }}" class="transition hover:text-white">Lacak Pesanan</a></li>
                    <li><a href="{{ route('cart.index') }}" class="transition hover:text-white">Keranjang</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Proyek</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('docs') }}" class="transition hover:text-white">Dokumentasi &amp; ERD</a></li>
                    <li><a href="{{ route('docs') }}#kebutuhan-fungsional" class="transition hover:text-white">Fitur</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">Masuk Admin</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-2 px-4 py-5 text-xs text-slate-500 sm:flex-row">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Dibuat untuk tugas V2 SMK.</p>
                <p>Belanja &middot; Pesan &middot; Lacak &mdash; semua online.</p>
            </div>
        </div>
    </footer>
</body>
</html>
