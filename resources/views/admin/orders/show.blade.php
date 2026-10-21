@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <a href="{{ route('admin.orders.index') }}" class="mb-4 inline-block text-sm font-medium text-slate-500 hover:text-indigo-600">&larr; Kembali ke daftar pesanan</a>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-500">Kode Pesanan</p>
                        <p class="text-xl font-extrabold tracking-wide text-slate-900">{{ $order->order_code }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WITA</p>
                    </div>
                    <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold ring-1 ring-inset {{ $order->status_badge }}">{{ $order->status_label }}</span>
                </div>

                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Nama Pemesan</dt>
                        <dd class="font-medium text-slate-800">{{ $order->customer_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">No. HP/WhatsApp</dt>
                        <dd class="font-medium text-slate-800">{{ $order->customer_phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Email</dt>
                        <dd class="font-medium text-slate-800">{{ $order->customer_email ?: '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs uppercase tracking-wide text-slate-500">Alamat Pengiriman</dt>
                        <dd class="font-medium text-slate-800">{{ $order->address }}</dd>
                    </div>
                    @if ($order->notes)
                        <div class="sm:col-span-2">
                            <dt class="text-xs uppercase tracking-wide text-slate-500">Catatan</dt>
                            <dd class="font-medium text-slate-800">{{ $order->notes }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white">
                <h2 class="border-b border-slate-100 px-6 py-4 font-bold text-slate-900">Item Pesanan</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-6 py-3">Produk</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Qty</th>
                                <th class="px-6 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="px-6 py-3 text-slate-800">{{ $item->product_name }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-slate-600">{{ $item->formatted_price }}</td>
                                    <td class="px-6 py-3 text-slate-600">{{ $item->quantity }}</td>
                                    <td class="px-6 py-3 text-right font-medium text-slate-800">{{ $item->formatted_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-slate-200">
                                <td colspan="3" class="px-6 py-3 text-right font-semibold text-slate-700">Total</td>
                                <td class="px-6 py-3 text-right text-lg font-bold text-slate-900">{{ $order->formatted_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div>
            <div class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-6">
                <h2 class="font-bold text-slate-900">Ubah Status Pesanan</h2>
                <p class="mt-1 text-sm text-slate-500">Pelanggan akan melihat perubahan ini di halaman lacak pesanan.</p>
                <form action="{{ route('admin.orders.status', $order->order_code) }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="status" class="mb-1 block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white hover:bg-indigo-700">Simpan Status</button>
                </form>

                <div class="mt-5 border-t border-slate-100 pt-4 text-sm">
                    <a href="{{ route('orders.show', $order->order_code) }}" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-700">Lihat halaman lacak &rarr;</a>
                </div>
            </div>
        </div>
    </div>
@endsection
