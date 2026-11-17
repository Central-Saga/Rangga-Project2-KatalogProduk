<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'products' => fn ($query) => $query->where('is_active', true),
        ])->orderBy('name')->get();

        $featured = Product::active()
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $testimonials = Testimonial::approved()
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'products' => Product::active()->count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
        ];

        return view('home', compact('categories', 'featured', 'testimonials', 'stats'));
    }
}
