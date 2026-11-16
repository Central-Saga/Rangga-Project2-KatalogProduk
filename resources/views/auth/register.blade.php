@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-50 via-indigo-50/30 to-purple-50/30">
        {{-- Background Decorative Blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>
        </div>

        <div class="relative mx-auto flex min-h-screen max-w-md flex-col justify-center px-4 py-12">

            {{-- Register Card --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">

                {{-- Header --}}
                <div class="relative border-b border-slate-100 bg-gradient-to-br from-indigo-50 via-white to-purple-50 px-8 pb-8 pt-10 text-center">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-indigo-100/60 blur-2xl"></div>

                    <div class="relative">
                        {{-- Icon --}}
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-300/50 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>

                        <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900">
                            Buat Akun Baru
                        </h1>
                        <p class="mt-1.5 text-sm text-slate-500">
                            Daftar untuk mempermudah proses checkout.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="p-8">
                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                                    placeholder="Nama lengkap Anda"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100 @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Email <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    placeholder="email@example.com"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100 @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Password <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" required
                                    placeholder="Minimal 8 karakter"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-11 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100 @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                            </div>
                            @error('password')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label for="password_confirmation" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Konfirmasi Password <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    placeholder="Ulangi password Anda"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-11 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="group mt-2 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-300/50 transition-all hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-300/60 focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftar Sekarang
                        </button>
                    </form>

                    {{-- Login Link --}}
                    <p class="mt-6 text-center text-sm text-slate-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Katalog Produk · Panel Pelanggan
            </p>
        </div>
    </div>
@endsection