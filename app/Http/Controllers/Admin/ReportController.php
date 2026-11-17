<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ], [
            'to.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.',
        ]);

        $from = $request->date('from') ?? now()->startOfMonth();
        $to = $request->date('to') ?? now();

        $range = [$from->copy()->startOfDay(), $to->copy()->endOfDay()];

        $base = Order::whereBetween('created_at', $range);
        $valid = (clone $base)->whereNotIn('status', ['dibatalkan']);

        $summary = [
            'orders' => (clone $base)->count(),
            'completed' => (clone $base)->where('status', 'selesai')->count(),
            'cancelled' => (clone $base)->where('status', 'dibatalkan')->count(),
            'revenue' => (int) (clone $valid)->sum('total'),
        ];

        $byStatus = (clone $base)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $topProducts = OrderItem::query()
            ->select('product_name', DB::raw('SUM(quantity) as qty'), DB::raw('SUM(subtotal) as revenue'))
            ->whereHas('order', fn ($query) => $query
                ->whereBetween('created_at', $range)
                ->whereNotIn('status', ['dibatalkan']))
            ->groupBy('product_name')
            ->orderByDesc('qty')
            ->take(5)
            ->get();

        $daily = (clone $base)
            ->select(
                DB::raw('date(created_at) as day'),
                DB::raw('count(*) as orders'),
                DB::raw("sum(case when status <> 'dibatalkan' then total else 0 end) as revenue")
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $maxDailyRevenue = max(1, (int) $daily->max('revenue'));

        return view('admin.reports.index', [
            'from' => $from,
            'to' => $to,
            'summary' => $summary,
            'byStatus' => $byStatus,
            'topProducts' => $topProducts,
            'daily' => $daily,
            'maxDailyRevenue' => $maxDailyRevenue,
            'statuses' => Order::STATUSES,
        ]);
    }
}
