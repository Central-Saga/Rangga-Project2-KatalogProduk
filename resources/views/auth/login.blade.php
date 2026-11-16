@extends('layouts.app')

@section('title', 'Masuk Admin')

@section('content')
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-50 via-indigo-50/30 to-purple-50/30">
        {{-- Background Decorative Blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>
        </div>

        <div class="relative mx-auto flex min-h-screen max-w-md flex-col justify-center px-4 py-12">

            {{-- Login Card --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">

                {{-- Header dengan gradient --}}
                <div class="relative border-b border-slate-100 bg-gradient-to-br from-indigo-50 via-white to-purple-50 px-8 pb-8 pt-10 text-center">
                    {{-- Decorative circle --}}
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-indigo-100/60 blur-2xl"></div>

                    <div class="relative">
                        {{-- Icon --}}
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-300/50 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>

                        {{-- Title --}}
                        <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900">
                            Selamat Datang Kembali
                        </h1>
                        <p class="mt-1.5 text-sm text-slate-500">
                            Masuk ke akun Anda
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="p-8">
                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Email
                                <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                    placeholder="admin@katalog.test"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                           focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                           @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="password" class="flex items-center gap-1 text-sm font-semibold text-slate-700">
                                    Password
                                    <span class="text-rose-500">*</span>
                                </label>
                            </div>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" required
                                    placeholder="Masukkan password"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-11 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                           focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                           @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                                {{-- Toggle Password --}}
                                <button type="button" onclick="togglePassword()" tabindex="-1"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 transition-colors hover:text-slate-600">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember --}}
                        <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" value="1"
                                   class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-4 focus:ring-indigo-100">
                            Ingat saya di perangkat ini
                        </label>

                        {{-- Submit --}}
                        <button type="submit"
                                class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-300/50 transition-all
                                       hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-300/60
                                       focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk
                        </button>
                    </form>

                    {{-- LINK DAFTAR BARU --}}
                    <p class="mt-6 text-center text-sm text-slate-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                            Daftar di sini
                        </a>
                    </p>

                    {{-- Divider --}}
                    <div class="my-6 flex items-center gap-3">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        <span class="text-xs font-medium text-slate-400">atau</span>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>

                    {{-- Demo Account --}}
                    <div class="rounded-xl border border-dashed border-indigo-200 bg-indigo-50/50 p-4">
                        <div class="flex items-start gap-2">
                            <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-indigo-100 text-indigo-600">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-indigo-900">Akun Demo (Admin)</p>
                                <div class="mt-1.5 space-y-1 text-xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-indigo-700">Email</span>
                                        <code class="rounded bg-white px-1.5 py-0.5 font-mono text-[11px] text-indigo-800 ring-1 ring-indigo-200">
                                            admin@katalog.test
                                        </code>
                                    </div>
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-indigo-700">Password</span>
                                        <code class="rounded bg-white px-1.5 py-0.5 font-mono text-[11px] text-indigo-800 ring-1 ring-indigo-200">
                                            password
                                        </code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Text --}}
            <p class="mt-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Katalog Produk · Panel Admin
            </p>
        </div>
    </div>

    {{-- Toggle Password Script --}}
    @push('scripts')
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';

            icon.innerHTML = isPassword
                ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    </script>
    @endpush
@endsection