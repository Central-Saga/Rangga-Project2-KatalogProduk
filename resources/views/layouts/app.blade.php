<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Katalog Produk') &middot; {{ config('app.name') }}</title>
    <meta name="description" content="Katalog produk online dengan sistem pesanan dan pelacakan status pesanan.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-slate-50 text-slate-800 antialiased">
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 backdrop-blur">
        <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-slate-900">
                <span class="grid h-9 w-9 place-items-center rounded-lg bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12A1.125 1.125 0 0 1 19.749 22H4.251a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                    </svg>
                </span>
                <span class="text-lg">{{ config('app.name') }}</span>
            </a>

            <div class="hidden items-center gap-1 text-sm font-medium md:flex">
                <a href="{{ route('catalog.index') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('catalog.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Katalog</a>
                <a href="{{ route('orders.track') }}" class="rounded-lg px-3 py-2 {{ request()->routeIs('orders.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">Lacak Pesanan</a>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span class="hidden sm:inline">Keranjang</span>
                    @if (\App\Support\Cart::count() > 0)
                        <span class="absolute -right-2 -top-2 grid h-5 min-w-5 place-items-center rounded-full bg-indigo-600 px-1 text-xs font-semibold text-white">{{ \App\Support\Cart::count() }}</span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-700">Masuk Admin</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-2 px-4 py-6 text-sm text-slate-500 sm:flex-row">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Dibuat untuk tugas V2 SMK.</p>
            <p>Belanja &middot; Pesan &middot; Lacak &mdash; semua online.</p>
        </div>
    </footer>
</body>
</html>
