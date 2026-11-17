@php($category = $category ?? null)

<div class="space-y-6">
    {{-- Nama Kategori --}}
    <div>
        <label for="name" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
            Nama Kategori
            <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <input type="text" name="name" id="name"
                value="{{ old('name', $category?->name) }}"
                required
                placeholder="Contoh: Elektronik, Fashion, Makanan..."
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all duration-200
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

    {{-- Slug --}}
    <div>
        <div class="mb-2 flex items-center justify-between">
            <label for="slug" class="flex items-center gap-1 text-sm font-semibold text-slate-700">
                Slug
                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
            </label>
        </div>
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </div>
            <input type="text" name="slug" id="slug"
                value="{{ old('slug', $category?->slug) }}"
                placeholder="akan-dibuat-otomatis"
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-3 font-mono text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all duration-200
                       focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                       @error('slug') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">
        </div>
        <p class="mt-1.5 text-xs text-slate-500">Kosongkan untuk dibuat otomatis dari nama kategori.</p>
        @error('slug')
            <p class="mt-1.5 flex items-center gap-1 text-xs font-medium text-rose-600">
                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="mb-2 flex items-center gap-1 text-sm font-semibold text-slate-700">
            Deskripsi
            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-500">Opsional</span>
        </label>
        <textarea name="description" id="description" rows="3"
            placeholder="Tambahkan deskripsi singkat tentang kategori ini..."
            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all duration-200
                   focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-100
                   @error('description') border-rose-300 focus:border-rose-500 focus:ring-rose-100 @enderror">{{ old('description', $category?->description) }}</textarea>
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