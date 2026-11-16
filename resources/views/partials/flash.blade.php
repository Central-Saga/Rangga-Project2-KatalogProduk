@if (session('success') || session('error') || session('warning') || session('info') || $errors->has('cart'))
    <div class="mx-auto max-w-6xl px-4 pt-4">
        <div class="space-y-3">

            {{-- Success --}}
            @if (session('success'))
                <div data-flash class="group relative flex items-start gap-3 overflow-hidden rounded-xl border border-emerald-200 bg-gradient-to-r from-emerald-50 to-white px-4 py-3.5 text-sm text-emerald-800 shadow-sm transition-all duration-300">
                    {{-- Left accent bar --}}
                    <span class="absolute inset-y-0 left-0 w-1 bg-emerald-500"></span>

                    {{-- Icon --}}
                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 pt-0.5">
                        <p class="font-semibold leading-tight">Berhasil!</p>
                        <p class="mt-0.5 text-emerald-700">{{ session('success') }}</p>
                    </div>

                    {{-- Close --}}
                    <button type="button" onclick="this.closest('[data-flash]').remove()" class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md text-emerald-500 opacity-0 transition-all hover:bg-emerald-100 hover:text-emerald-700 group-hover:opacity-100">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Auto-dismiss progress bar --}}
                    <span class="absolute bottom-0 left-0 h-0.5 bg-emerald-500" style="animation: shrinkWidth 5s linear forwards;"></span>
                </div>
            @endif

            {{-- Error --}}
            @if (session('error'))
                <div data-flash class="group relative flex items-start gap-3 overflow-hidden rounded-xl border border-rose-200 bg-gradient-to-r from-rose-50 to-white px-4 py-3.5 text-sm text-rose-800 shadow-sm">
                    <span class="absolute inset-y-0 left-0 w-1 bg-rose-500"></span>

                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0 pt-0.5">
                        <p class="font-semibold leading-tight">Terjadi Kesalahan</p>
                        <p class="mt-0.5 text-rose-700">{{ session('error') }}</p>
                    </div>

                    <button type="button" onclick="this.closest('[data-flash]').remove()" class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md text-rose-500 opacity-0 transition-all hover:bg-rose-100 hover:text-rose-700 group-hover:opacity-100">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Warning --}}
            @if (session('warning'))
                <div data-flash class="group relative flex items-start gap-3 overflow-hidden rounded-xl border border-amber-200 bg-gradient-to-r from-amber-50 to-white px-4 py-3.5 text-sm text-amber-800 shadow-sm">
                    <span class="absolute inset-y-0 left-0 w-1 bg-amber-500"></span>

                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0 pt-0.5">
                        <p class="font-semibold leading-tight">Perhatian</p>
                        <p class="mt-0.5 text-amber-700">{{ session('warning') }}</p>
                    </div>

                    <button type="button" onclick="this.closest('[data-flash]').remove()" class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md text-amber-500 opacity-0 transition-all hover:bg-amber-100 hover:text-amber-700 group-hover:opacity-100">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Info --}}
            @if (session('info'))
                <div data-flash class="group relative flex items-start gap-3 overflow-hidden rounded-xl border border-sky-200 bg-gradient-to-r from-sky-50 to-white px-4 py-3.5 text-sm text-sky-800 shadow-sm">
                    <span class="absolute inset-y-0 left-0 w-1 bg-sky-500"></span>

                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-sky-100 text-sky-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0 pt-0.5">
                        <p class="font-semibold leading-tight">Informasi</p>
                        <p class="mt-0.5 text-sky-700">{{ session('info') }}</p>
                    </div>

                    <button type="button" onclick="this.closest('[data-flash]').remove()" class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md text-sky-500 opacity-0 transition-all hover:bg-sky-100 hover:text-sky-700 group-hover:opacity-100">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Cart Errors --}}
            @if ($errors->has('cart'))
                <div data-flash class="group relative flex items-start gap-3 overflow-hidden rounded-xl border border-rose-200 bg-gradient-to-r from-rose-50 to-white px-4 py-3.5 text-sm text-rose-800 shadow-sm">
                    <span class="absolute inset-y-0 left-0 w-1 bg-rose-500"></span>

                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0 pt-0.5">
                        <p class="font-semibold leading-tight">Keranjang Bermasalah</p>
                        <p class="mt-0.5 text-rose-700">{{ $errors->first('cart') }}</p>
                    </div>

                    <button type="button" onclick="this.closest('[data-flash]').remove()" class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-md text-rose-500 opacity-0 transition-all hover:bg-rose-100 hover:text-rose-700 group-hover:opacity-100">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Auto-dismiss script (hanya untuk success & info) --}}
    @once
        @push('scripts')
        <script>
            // Auto-dismiss untuk success & info setelah 5 detik
            document.querySelectorAll('[data-flash]').forEach(el => {
                // Hanya auto-dismiss jika bukan error/warning (kecuali cart yang error)
                const isError = el.classList.contains('border-rose-200') || el.classList.contains('border-amber-200');
                if (!isError) {
                    setTimeout(() => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(-10px)';
                        setTimeout(() => el.remove(), 300);
                    }, 5000);
                }
            });
        </script>
        @endpush
    @endonce

    {{-- CSS keyframes --}}
    @once
        @push('styles')
        <style>
            @keyframes shrinkWidth {
                from { width: 100%; }
                to { width: 0%; }
            }
        </style>
        @endpush
    @endonce
@endif