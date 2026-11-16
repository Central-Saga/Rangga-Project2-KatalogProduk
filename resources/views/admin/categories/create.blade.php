@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="mx-auto max-w-xl">
        {{-- Back Link --}}
        <a href="{{ route('admin.categories.index') }}"
           class="group mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 transition-colors hover:text-indigo-600">
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Kategori
        </a>

        {{-- Card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-indigo-50/70 to-purple-50/70 px-6 py-5">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-lg font-bold text-slate-800">Tambah Kategori Baru</h1>
                        <p class="mt-0.5 text-sm text-slate-500">Lengkapi informasi kategori produk di bawah ini.</p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    @include('admin.categories._form')
                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-end gap-2 border-t border-slate-100 bg-slate-50/60 px-6 py-4">
                    <a href="{{ route('admin.categories.index') }}"
                       class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:text-slate-900">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-100">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>

        {{-- Hint --}}
        <p class="mt-4 text-center text-xs text-slate-400">
            Field bertanda <span class="font-semibold text-rose-500">*</span> wajib diisi.
        </p>
    </div>
@endsection