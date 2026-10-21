@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="mx-auto max-w-lg px-4 py-24 text-center">
        <p class="text-6xl font-extrabold text-indigo-600">404</p>
        <h1 class="mt-4 text-2xl font-bold text-slate-900">Halaman tidak ditemukan</h1>
        <p class="mt-2 text-slate-500">Maaf, halaman atau produk yang Anda cari tidak tersedia.</p>
        <div class="mt-6 flex justify-center gap-3">
            <a href="{{ route('home') }}" class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">Ke Beranda</a>
            <a href="{{ route('catalog.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-100">Lihat Katalog</a>
        </div>
    </div>
@endsection
