@if ($product->image_url)
    <img src="{{ $product->image_url }}"
         alt="{{ $product->name }}"
         loading="lazy"
         class="h-full w-full object-cover">
@else
    {{-- Placeholder Premium --}}
    <div class="relative flex h-full w-full flex-col items-center justify-center overflow-hidden bg-gradient-to-br from-indigo-50 via-slate-50 to-purple-50 text-slate-400">
        {{-- Decorative subtle pattern --}}
        <div class="pointer-events-none absolute inset-0 opacity-40">
            <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-indigo-200/50 blur-2xl"></div>
            <div class="absolute -bottom-8 -left-8 h-32 w-32 rounded-full bg-purple-200/50 blur-2xl"></div>
        </div>

        {{-- Content --}}
        <div class="relative flex flex-col items-center gap-2 px-4 text-center">
            {{-- Icon in a subtle circle --}}
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/80 text-indigo-400 shadow-sm ring-1 ring-indigo-100 backdrop-blur">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 6.75h19.5M2.25 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25V6.75M2.25 6.75V4.5a.75.75 0 0 1 .75-.75h18a.75.75 0 0 1 .75.75v2.25" />
                </svg>
            </div>

            {{-- Label --}}
            @if ($product->category?->name)
                <span class="rounded-full bg-white/80 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-indigo-600 ring-1 ring-indigo-100 backdrop-blur">
                    {{ $product->category->name }}
                </span>
            @else
                <span class="rounded-full bg-white/80 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-slate-500 ring-1 ring-slate-100 backdrop-blur">
                    Tanpa Foto
                </span>
            @endif
        </div>
    </div>
@endif