@php($product = $product ?? null)

<div class="space-y-6">
    {{-- Section: Informasi Dasar --}}
    <div>
        <div class="mb-4 flex items-center gap-2">
            <div class="h-5 w-1 rounded-full bg-indigo-600"></div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Informasi Dasar</h3>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            {{-- Nama Produk --}}
            <div class="sm:col-span-2">
                <label for="name" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                    Nama Produk <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}" required
                        placeholder="Contoh: Kaos Polos Katun Premium"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                               @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                </div>
                @error('name')
                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label for="category_id" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                    Kategori <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <select name="category_id" id="category_id" required
                        class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-10 text-sm text-slate-800 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                               @error('category_id') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((int) old('category_id', $product?->category_id) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('category_id')
                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <label for="slug" class="text-sm font-semibold text-slate-700">Slug</label>
                    <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
                </div>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $product?->slug) }}"
                        placeholder="akan-dibuat-otomatis"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 font-mono text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                               @error('slug') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                </div>
                @error('slug')
                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section: Harga & Stok --}}
    <div class="border-t border-slate-100 pt-6">
        <div class="mb-4 flex items-center gap-2">
            <div class="h-5 w-1 rounded-full bg-emerald-500"></div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Harga & Stok</h3>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            {{-- Harga --}}
            <div>
                <label for="price" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                    Harga <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-sm font-semibold text-slate-400">Rp</span>
                    </div>
                    <input type="number" name="price" id="price" value="{{ old('price', $product?->price ?? 0) }}" min="0" step="1000" required
                        placeholder="0"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                               @error('price') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                </div>
                @error('price')
                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Stok --}}
            <div>
                <label for="stock" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
                    Stok <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product?->stock ?? 0) }}" min="0" required
                        placeholder="0"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm font-semibold text-slate-800 placeholder-slate-400 shadow-sm transition-all
                               focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                               @error('stock') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
                </div>
                @error('stock')
                    <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section: Deskripsi --}}
    <div class="border-t border-slate-100 pt-6">
        <div class="mb-4 flex items-center gap-2">
            <div class="h-5 w-1 rounded-full bg-amber-500"></div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Deskripsi</h3>
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between">
                <label for="description" class="text-sm font-semibold text-slate-700">Deskripsi Produk</label>
                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
            </div>
            <textarea name="description" id="description" rows="4"
                placeholder="Jelaskan detail produk: bahan, ukuran, warna, dll..."
                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all
                       focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                       @error('description') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">{{ old('description', $product?->description) }}</textarea>
            @error('description')
                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    {{-- Section: Foto Produk --}}
    <div class="border-t border-slate-100 pt-6">
        <div class="mb-4 flex items-center gap-2">
            <div class="h-5 w-1 rounded-full bg-purple-500"></div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Foto Produk</h3>
        </div>

        <div>
            <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-4 transition-colors hover:border-indigo-300 hover:bg-indigo-50/30">
                <div class="flex flex-col items-center gap-4 sm:flex-row">
                    {{-- Preview --}}
                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl border-2 border-white bg-slate-100 shadow-sm ring-1 ring-slate-200">
                        @if ($product)
                            @include('partials.product-image', ['product' => $product])
                        @else
                            <div class="grid h-full w-full place-items-center text-slate-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 6.75h19.5" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Input --}}
                    <div class="flex-1 text-center sm:text-left">
                        <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/webp"
                            class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white file:shadow-sm file:transition-all hover:file:bg-indigo-700 file:cursor-pointer">
                        <p class="mt-2 text-xs text-slate-500">
                            📷 Format: <span class="font-medium">jpg, jpeg, png, webp</span>
                            · Maks: <span class="font-medium">2 MB</span>
                            @if ($product?->image)
                                <br><span class="text-amber-600">Kosongkan jika tidak ingin mengganti foto.</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @error('image')
                <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    {{-- Section: Status --}}
    <div class="border-t border-slate-100 pt-6">
        <div class="mb-4 flex items-center gap-2">
            <div class="h-5 w-1 rounded-full bg-sky-500"></div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Status</h3>
        </div>

        <label class="group flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition-all hover:border-indigo-300 hover:bg-indigo-50/30">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product?->is_active ?? true))
                class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-4 focus:ring-indigo-100">
            <div class="flex-1">
                <p class="text-sm font-semibold text-slate-800 group-hover:text-indigo-700">Tampilkan produk di katalog</p>
                <p class="text-xs text-slate-500">Jika dinonaktifkan, produk tidak akan muncul di halaman pelanggan.</p>
            </div>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </label>
    </div>
</div>