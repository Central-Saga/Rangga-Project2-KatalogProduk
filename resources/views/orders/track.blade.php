@extends('layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
    <div class="mx-auto max-w-2xl px-4 py-16">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
            <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <h1 class="mt-4 text-2xl font-bold text-slate-900">Lacak Pesanan</h1>
            <p class="mt-1 text-sm text-slate-500">Masukkan kode pesanan Anda (contoh: INV-20261019-A1B2) untuk melihat status terkini.</p>

            <form action="{{ route('orders.track.submit') }}" method="POST" class="mx-auto mt-6 flex max-w-md flex-col gap-3 sm:flex-row">
                @csrf
                <input type="text" name="order_code" value="{{ old('order_code') }}" placeholder="Kode pesanan"
                    class="flex-1 rounded-lg border border-slate-300 px-3 py-2 text-sm uppercase tracking-wide focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Lacak</button>
            </form>
            @error('order_code')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
    </div>
@endsection
