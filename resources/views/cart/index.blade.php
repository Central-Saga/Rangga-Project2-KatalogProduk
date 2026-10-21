@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8">
        <h1 class="text-2xl font-bold text-slate-900">Keranjang Belanja</h1>

        @if (empty($cart['items']))
            <div class="mt-6 rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <p class="font-semibold text-slate-700">Keranjang Anda masih kosong.</p>
                <p class="mt-1 text-sm text-slate-500">Yuk pilih produk favorit Anda terlebih dahulu.</p>
                <a href="{{ route('catalog.index') }}" class="mt-4 inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Mulai Belanja</a>
            </div>
        @else
            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">Produk</th>
                                    <th class="px-4 py-3">Harga</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                    <th class="px-4 py-3">Subtotal</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($cart['items'] as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                                    @include('partials.product-image', ['product' => $item['product']])
                                                </div>
                                                <div>
                                                    <a href="{{ route('catalog.show', $item['product']) }}" class="font-medium text-slate-800 hover:text-indigo-700">{{ $item['product']->name }}</a>
                                                    <p class="text-xs text-slate-500">{{ $item['product']->category?->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-slate-700">{{ $item['product']->formatted_price }}</td>
                                        <td class="px-4 py-3">
                                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" max="{{ $item['product']->stock }}"
                                                    class="w-16 rounded-lg border border-slate-300 px-2 py-1 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                                <button type="submit" class="rounded-lg border border-slate-300 px-2 py-1 text-xs font-medium text-slate-600 hover:bg-slate-100">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap font-semibold text-slate-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <form action="{{ route('cart.destroy', $item['product']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-700" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <a href="{{ route('catalog.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">&larr; Lanjut belanja</a>
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-rose-600 hover:text-rose-700">Kosongkan keranjang</button>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-5">
                        <h2 class="text-lg font-bold text-slate-900">Ringkasan</h2>
                        <dl class="mt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-slate-500">Total item</dt>
                                <dd class="font-medium text-slate-800">{{ $cart['count'] }} produk</dd>
                            </div>
                            <div class="flex justify-between border-t border-slate-100 pt-2 text-base">
                                <dt class="font-semibold text-slate-700">Total</dt>
                                <dd class="font-bold text-slate-900">Rp {{ number_format($cart['total'], 0, ',', '.') }}</dd>
                            </div>
                        </dl>
                        <a href="{{ route('checkout.create') }}" class="mt-5 block rounded-xl bg-indigo-600 px-4 py-3 text-center font-semibold text-white hover:bg-indigo-700">
                            Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
