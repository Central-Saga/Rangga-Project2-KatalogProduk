<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Support\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->when($request->input('q'), function ($query, $q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->when($request->input('category_id'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        unset($data['image']);

        $data['slug'] = Slug::unique(
            Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('name')),
            'products'
        );
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        unset($data['image']);

        $data['slug'] = Slug::unique(
            Str::slug($request->filled('slug') ? $request->input('slug') : $request->input('name')),
            'products',
            $product->id
        );
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    protected function saveImage($file): string
    {
        $directory = public_path('uploads/products');

        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0775, true, true);
        }

        $filename = 'prod_'.time().'_'.Str::lower(Str::random(8)).'.'.strtolower($file->getClientOriginalExtension());
        $file->move($directory, $filename);

        return 'uploads/products/'.$filename;
    }

    protected function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
