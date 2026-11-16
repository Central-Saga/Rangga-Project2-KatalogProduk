@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <div class="mx-auto max-w-2xl">
        {{-- Back Link --}}
        <a href="{{ route('admin.products.index') }}"
           class="group mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 transition-colors hover:text-indigo-600">
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Produk
        </a>

        {{-- Card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-100 bg-gradient-to-r from-amber-50/70 to-orange-50/70 px-6 py-5">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm shadow-amber-200">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h1 class="text-lg font-bold text-slate-800">Edit Produk</h1>
                        <p class="mt-0.5 truncate text-sm text-slate-500">
                            Memperbarui: <span class="font-medium text-slate-700">{{ $product->name }}</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6">
                    @include('admin.products._form')
                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-between gap-2 border-t border-slate-100 bg-slate-50/60 px-6 py-4">
                    <p class="hidden text-xs text-slate-500 sm:block">
                        Terakhir diperbarui {{ $product->updated_at?->diffForHumans() ?? '-' }}
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.products.index') }}"
                           class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition-all hover:bg-slate-50 hover:text-slate-900">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-amber-200 transition-all hover:bg-amber-600 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-amber-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perbarui Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Hint --}}
        <p class="mt-4 text-center text-xs text-slate-400">
            Field bertanda <span class="font-semibold text-rose-500">*</span> wajib diisi.
        </p>
    </div>
@endsection