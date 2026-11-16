<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; // <-- TAMBAHAN BARU
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/produk/{product}', [CatalogController::class, 'show'])->name('catalog.show');

/*
|--------------------------------------------------------------------------
| Keranjang Belanja
|--------------------------------------------------------------------------
*/
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/keranjang', [CartController::class, 'clear'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| Checkout & Pesanan
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/lacak-pesanan', [OrderTrackingController::class, 'index'])->name('orders.track');
Route::post('/lacak-pesanan', [OrderTrackingController::class, 'track'])->name('orders.track.submit');
Route::get('/pesanan/{order}', [OrderTrackingController::class, 'show'])->name('orders.show');

/*
|--------------------------------------------------------------------------
| Testimoni Publik
|--------------------------------------------------------------------------
*/
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');

/*
|--------------------------------------------------------------------------
| Dokumentasi (PRD & ERD)
|--------------------------------------------------------------------------
*/
Route::get('/dokumentasi', [DocumentationController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Autentikasi (Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login (Admin & Pelanggan)
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // Register (Hanya Pelanggan Baru)
    Route::get('/daftar', [RegisterController::class, 'create'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Admin (protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', CategoryController::class)
        ->parameters(['kategori' => 'category'])
        ->names('categories');

    Route::resource('produk', ProductController::class)
        ->parameters(['produk' => 'product'])
        ->names('products');

    Route::get('pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('pesanan/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('pesanan/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    Route::get('laporan', [ReportController::class, 'index'])->name('reports.index');

    Route::get('testimoni', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::patch('testimoni/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::delete('testimoni/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
});