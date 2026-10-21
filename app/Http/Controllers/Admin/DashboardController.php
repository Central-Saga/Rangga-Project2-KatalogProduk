<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'pending_orders' => Order::where('status', 'menunggu_konfirmasi')->count(),
            'revenue' => (int) Order::where('status', 'selesai')->sum('total'),
            'revenue_month' => (int) Order::whereNotIn('status', ['dibatalkan'])
                ->whereBetween('created_at', [now()->startOfMonth(), now()])
                ->sum('total'),
            'pending_testimonials' => Testimonial::where('is_approved', false)->count(),
        ];

        $recentOrders = Order::latest()->take(5)->get();

        $lowStock = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        $statusBreakdown = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStock', 'statusBreakdown'));
    }
}
