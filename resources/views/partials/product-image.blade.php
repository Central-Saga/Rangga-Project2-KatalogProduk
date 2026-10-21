@if ($product->image_url)
    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
@else
    <div class="flex h-full w-full flex-col items-center justify-center gap-2 bg-gradient-to-br from-indigo-100 via-slate-100 to-slate-200 text-indigo-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 6.75h19.5M2.25 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25V6.75M2.25 6.75V4.5a.75.75 0 0 1 .75-.75h18a.75.75 0 0 1 .75.75v2.25" />
        </svg>
        <span class="text-xs font-medium uppercase tracking-wide">{{ $product->category?->name ?? 'Produk' }}</span>
    </div>
@endif
