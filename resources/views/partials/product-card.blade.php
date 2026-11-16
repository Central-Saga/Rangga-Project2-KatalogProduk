@php($product = $product ?? null)

<article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-100/50">

    {{-- Image Container --}}
    <a href="{{ route('catalog.show', $product) }}" class="relative block aspect-[4/3] overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="h-full w-full transition-transform duration-500 ease-out group-hover:scale-105">
            @include('partials.product-image', ['product' => $product])
        </div>

        {{-- Overlay Gradient saat hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

        {{-- Badge Stok Habis --}}
        @if ($product->stock <= 0)
            <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-rose-600 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-lg shadow-rose-300/50 ring-2 ring-white/50">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Stok Habis
            </span>
        {{-- Badge Stok Menipis --}}
        @elseif ($product->stock <= 5)
            <span class="absolute left-3 top-3 inline-flex items-center gap-1 rounded-full bg-amber-500 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-lg shadow-amber-300/50 ring-2 ring-white/50">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-white"></span>
                Sisa {{ $product->stock }}
            </span>
        @endif

        {{-- Quick View Button saat hover --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-4 py-2 text-xs font-semibold text-slate-900 shadow-lg backdrop-blur-sm">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat Detail
            </span>
        </div>
    </a>

    {{-- Content --}}
    <div class="flex flex-1 flex-col p-4">

        {{-- Category Badge --}}
        @if ($product->category)
            <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}"
               class="inline-flex w-fit items-center gap-1 rounded-md bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-indigo-700 transition-colors hover:bg-indigo-100">
                <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                {{ $product->category->name }}
            </a>
        @endif

        {{-- Product Name --}}
        <h3 class="mt-2 line-clamp-2 text-sm font-bold leading-snug text-slate-900">
            <a href="{{ route('catalog.show', $product) }}" class="transition-colors hover:text-indigo-600">
                {{ $product->name }}
            </a>
        </h3>

        {{-- Price & Stock --}}
        <div class="mt-auto pt-3">
            <div class="flex items-baseline justify-between gap-2">
                <p class="text-lg font-extrabold tracking-tight text-indigo-600">
                    {{ $product->formatted_price }}
                </p>
                @if ($product->stock > 0)
                    <p class="flex items-center gap-1 text-[11px] font-medium text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        {{ $product->stock }} stok
                    </p>
                @else
                    <p class="flex items-center gap-1 text-[11px] font-medium text-rose-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                        Habis
                    </p>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="mt-3 flex gap-2">
                <form action="{{ route('cart.store', $product) }}" method="POST" class="flex flex-1">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" @disabled($product->stock <= 0)
                        class="group/btn inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl px-3 py-2.5 text-sm font-semibold transition-all
                               {{ $product->stock > 0
                                   ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200 hover:bg-indigo-700 hover:shadow-md'
                                   : 'cursor-not-allowed bg-slate-200 text-slate-400' }}">
                        @if ($product->stock > 0)
                            <svg class="h-4 w-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Keranjang
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Habis
                        @endif
                    </button>
                </form>
                <a href="{{ route('catalog.show', $product) }}"
                   class="inline-flex items-center justify-center gap-1 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-medium text-slate-600 transition-all hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</article>