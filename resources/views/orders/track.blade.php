@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
    <div class="relative min-h-[calc(100vh-8rem)] overflow-hidden bg-gradient-to-br from-slate-50 via-indigo-50/30 to-purple-50/30">
        {{-- Decorative Blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-200/40 blur-3xl"></div>
        </div>

        <div class="relative mx-auto flex min-h-[calc(100vh-8rem)] max-w-2xl flex-col justify-center px-4 py-12">

            {{-- Main Card --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">

                {{-- Header dengan gradient --}}
                <div class="relative border-b border-slate-100 bg-gradient-to-br from-indigo-50 via-white to-purple-50 px-8 pb-8 pt-10 text-center">
                    {{-- Decorative circle blur --}}
                    <div class="absolute right-0 top-0 h-32 w-32 translate-x-12 -translate-y-12 rounded-full bg-indigo-200/50 blur-3xl"></div>

                    <div class="relative">
                        {{-- Icon --}}
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-300/50 ring-4 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>

                        {{-- Title --}}
                        <h1 class="mt-5 text-2xl font-extrabold tracking-tight text-slate-900">
                            Lacak Pesanan Anda
                        </h1>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-600">
                            Masukkan kode pesanan untuk melihat status terkini. Kode pesanan dapat ditemukan pada halaman konfirmasi atau email konfirmasi Anda.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="p-8">
                    <form action="{{ route('orders.track.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="order_code" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                                Kode Pesanan
                                <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input type="text" name="order_code" id="order_code"
                                    value="{{ old('order_code') }}"
                                    placeholder="INV-20261019-A1B2"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-3 font-mono text-sm uppercase tracking-wide text-slate-800 placeholder-slate-400 shadow-sm transition-all
                                           focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                                           @error('order_code') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                            </div>
                            <p class="mt-1.5 flex items-center gap-1 text-xs text-slate-500">
                                <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kode pesanan berformat <span class="font-mono font-semibold text-slate-600">INV-XXXXXX-XXXX</span>
                            </p>
                            @error('order_code')
                                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-300/50 transition-all
                                       hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-300/60
                                       focus:outline-none focus:ring-4 focus:ring-indigo-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                            </svg>
                            Lacak Pesanan
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="my-6 flex items-center gap-3">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        <span class="text-xs font-medium text-slate-400">Butuh bantuan?</span>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>

                    {{-- Help Info --}}
                    <div class="rounded-xl border border-indigo-200 bg-indigo-50/50 p-4">
                        <div class="flex items-start gap-2">
                            <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md bg-indigo-100 text-indigo-600">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-indigo-900">Kode tidak ditemukan?</p>
                                <p class="mt-1 text-xs text-indigo-700">
                                    Hubungi admin kami untuk bantuan lebih lanjut
                                    <a href="mailto:admin@katalog.test" class="font-semibold text-indigo-600 hover:text-indigo-700 hover:underline">
                                        admin@katalog.test
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-slate-500">
                    Belum punya pesanan?
                    <a href="{{ route('catalog.index') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                        Mulai belanja
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection