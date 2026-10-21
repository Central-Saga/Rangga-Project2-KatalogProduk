@php($product = $product ?? null)
<div class="space-y-4">
    <div class="grid gap-4 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nama Produk <span class="text-rose-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}" required
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="category_id" class="mb-1 block text-sm font-medium text-slate-700">Kategori <span class="text-rose-500">*</span></label>
            <select name="category_id" id="category_id" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((int) old('category_id', $product?->category_id) === $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="slug" class="mb-1 block text-sm font-medium text-slate-700">Slug (opsional)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $product?->slug) }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 font-mono text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            @error('slug')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="price" class="mb-1 block text-sm font-medium text-slate-700">Harga (Rp) <span class="text-rose-500">*</span></label>
            <input type="number" name="price" id="price" value="{{ old('price', $product?->price ?? 0) }}" min="0" step="1000" required
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            @error('price')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="stock" class="mb-1 block text-sm font-medium text-slate-700">Stok <span class="text-rose-500">*</span></label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product?->stock ?? 0) }}" min="0" required
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            @error('stock')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="sm:col-span-2">
            <label for="description" class="mb-1 block text-sm font-medium text-slate-700">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('description', $product?->description) }}</textarea>
            @error('description')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="sm:col-span-2">
            <label for="image" class="mb-1 block text-sm font-medium text-slate-700">Foto Produk</label>
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg border border-slate-200 bg-slate-100">
                    @if ($product)
                        @include('partials.product-image', ['product' => $product])
                    @else
                        <div class="grid h-full w-full place-items-center text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 6.75h19.5" /></svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/webp"
                        class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-1 text-xs text-slate-400">Format jpg, jpeg, png, webp. Maks 2 MB.{{ $product?->image ? ' Kosongkan jika tidak ingin mengganti.' : '' }}</p>
                </div>
            </div>
            @error('image')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
        </div>

        <div class="sm:col-span-2">
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product?->is_active ?? true)) class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                Tampilkan produk di katalog (aktif)
            </label>
        </div>
    </div>
</div>
