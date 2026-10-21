@php($product = $product ?? null)
<article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
    <a href="{{ route('catalog.show', $product) }}" class="relative block aspect-[4/3] overflow-hidden bg-slate-100">
        <div class="h-full w-full transition duration-500 group-hover:scale-[1.04]">
            @include('partials.product-image', ['product' => $product])
        </div>
        @if ($product->stock <= 0)
            <span class="absolute left-3 top-3 rounded-full bg-rose-600 px-2.5 py-1 text-[11px] font-semibold text-white shadow-sm">Stok habis</span>
        @elseif ($product->stock <= 5)
            <span class="absolute left-3 top-3 rounded-full bg-amber-500 px-2.5 py-1 text-[11px] font-semibold text-white shadow-sm">Sisa {{ $product->stock }}</span>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-4">
        <p class="text-[11px] font-medium uppercase tracking-wider text-indigo-600">{{ $product->category?->name }}</p>
        <h3 class="mt-1 line-clamp-2 text-sm font-semibold leading-snug text-slate-900">
            <a href="{{ route('catalog.show', $product) }}" class="transition hover:text-indigo-700">{{ $product->name }}</a>
        </h3>
        <div class="mt-auto pt-3">
            <div class="flex items-baseline justify-between gap-2">
                <p class="text-lg font-semibold tracking-tight text-slate-900">{{ $product->formatted_price }}</p>
                <p class="text-[11px] text-slate-400">stok {{ $product->stock }}</p>
            </div>

            <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-3 flex gap-2">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit" @disabled($product->stock <= 0)
                    class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-lg bg-slate-900 px-3 py-2 text-sm font-semibold text-white transition hover:bg-indigo-600 disabled:cursor-not-allowed disabled:bg-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ $product->stock <= 0 ? 'Habis' : 'Keranjang' }}
                </button>
                <a href="{{ route('catalog.show', $product) }}" class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">Detail</a>
            </form>
        </div>
    </div>
</article>
