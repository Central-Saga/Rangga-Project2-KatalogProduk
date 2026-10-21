@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode / nama / no. HP..."
            class="w-full max-w-xs rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
        <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            <option value="">Semua status</option>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Filter</button>
        @if (request()->hasAny(['q', 'status']))
            <a href="{{ route('admin.orders.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">Reset</a>
        @endif
    </form>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Kode</th>
                        <th class="px-5 py-3">Pemesan</th>
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Total</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-medium text-slate-800">{{ $order->order_code }}</td>
                            <td class="px-5 py-3">
                                <p class="text-slate-700">{{ $order->customer_name }}</p>
                                <p class="text-xs text-slate-400">{{ $order->customer_phone }}</p>
                            </td>
                            <td class="px-5 py-3 whitespace-nowrap text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3 whitespace-nowrap text-slate-700">{{ $order->formatted_total }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $order->status_badge }}">{{ $order->status_label }}</span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.orders.show', $order->order_code) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-sm text-slate-500">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $orders->links() }}</div>
@endsection
