@php($category = $category ?? null)
<div class="space-y-4">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nama Kategori <span class="text-rose-500">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name', $category?->name) }}" required
            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
        @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="slug" class="mb-1 block text-sm font-medium text-slate-700">Slug (opsional)</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $category?->slug) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 font-mono text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
        <p class="mt-1 text-xs text-slate-400">Biarkan kosong untuk dibuat otomatis dari nama.</p>
        @error('slug')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="description" class="mb-1 block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea name="description" id="description" rows="3"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('description', $category?->description) }}</textarea>
        @error('description')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
    </div>
</div>
