@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
    @php
        $tabs = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'all' => 'Semua',
        ];
        $tabCounts = [
            'pending' => $testimonials->where('is_approved', false)->count() ?? 0,
            'approved' => $testimonials->where('is_approved', true)->count() ?? 0,
            'all' => $testimonials->total(),
        ];
    @endphp

    {{-- Page Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-slate-800">Kelola Testimoni</h1>
                <p class="text-sm text-slate-500">
                    Total <span class="font-semibold text-slate-700">{{ $testimonials->total() }}</span> testimoni masuk
                </p>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="mb-5 overflow-hidden rounded-2xl border border-slate-200 bg-white p-1.5 shadow-sm">
        <div class="flex flex-wrap gap-1">
            @foreach ($tabs as $key => $label)
                <a href="{{ route('admin.testimonials.index', ['filter' => $key]) }}"
                   class="group inline-flex flex-1 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium transition-all
                          {{ $filter === $key
                              ? 'bg-indigo-600 text-white shadow-sm shadow-indigo-200'
                              : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ $label }}
                    <span class="inline-flex min-w-[1.5rem] items-center justify-center rounded-full px-1.5 py-0.5 text-xs font-bold transition-colors
                                 {{ $filter === $key
                                     ? 'bg-white/20 text-white'
                                     : 'bg-slate-100 text-slate-600 group-hover:bg-slate-200' }}">
                        {{ $tabCounts[$key] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Testimoni List --}}
    <div class="space-y-4">
        @forelse ($testimonials as $testimonial)
            <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-all hover:border-indigo-200 hover:shadow-md">
                <div class="p-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">

                        {{-- Left: Content --}}
                        <div class="min-w-0 flex-1">
                            {{-- Rating + Status Badge --}}
                            <div class="flex flex-wrap items-center gap-3">
                                <div class="inline-flex items-center gap-0.5 rounded-lg bg-amber-50 px-2 py-1 ring-1 ring-inset ring-amber-100">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-3.5 w-3.5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-300' }}"
                                             viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M11.48 3.5a.562.562 0 0 1 1.04 0l2.125 5.111 5.53.442a.563.563 0 0 1 .32.988l-4.213 3.61 1.286 5.38a.563.563 0 0 1-.84.61L12 17.22l-4.728 2.903a.563.563 0 0 1-.84-.61l1.286-5.38-4.213-3.61a.563.563 0 0 1 .32-.988l5.53-.442L11.48 3.5Z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-1.5 text-xs font-bold text-amber-700">{{ $testimonial->rating }}.0</span>
                                </div>

                                @if ($testimonial->is_approved)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        Menunggu
                                    </span>
                                @endif
                            </div>

                            {{-- Message --}}
                            <p class="mt-3 text-sm leading-relaxed text-slate-700">
                                "{{ $testimonial->message }}"
                            </p>

                            {{-- Meta Info --}}
                            <div class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500">
                                <div class="flex items-center gap-1.5">
                                    <div class="flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 text-[10px] font-bold uppercase text-white">
                                        {{ mb_substr($testimonial->name, 0, 2) }}
                                    </div>
                                    <span class="font-semibold text-slate-800">{{ $testimonial->name }}</span>
                                </div>
                                @if ($testimonial->email)
                                    <span class="flex items-center gap-1">
                                        <svg class="h-3 w-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $testimonial->email }}
                                    </span>
                                @endif
                                <span class="flex items-center gap-1">
                                    <svg class="h-3 w-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $testimonial->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="flex shrink-0 items-center gap-2">
                            <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-semibold transition-all
                                            {{ $testimonial->is_approved
                                                ? 'border border-slate-300 bg-white text-slate-600 hover:bg-slate-50'
                                                : 'bg-emerald-600 text-white shadow-sm shadow-emerald-200 hover:bg-emerald-700' }}">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if ($testimonial->is_approved)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @endif
                                    </svg>
                                    {{ $testimonial->is_approved ? 'Batalkan' : 'Setujui' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                  onsubmit="return confirm('Hapus testimoni dari \'{{ $testimonial->name }}\'? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-rose-200 bg-white px-3 py-1.5 text-xs font-medium text-rose-600 transition-all hover:border-rose-300 hover:bg-rose-50">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="overflow-hidden rounded-2xl border-2 border-dashed border-slate-200 bg-white shadow-sm">
                <div class="p-12 text-center">
                    <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-700">
                        @if ($filter === 'pending')
                            Tidak ada testimoni yang menunggu
                        @elseif ($filter === 'approved')
                            Belum ada testimoni disetujui
                        @else
                            Belum ada testimoni
                        @endif
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        @if ($filter === 'pending')
                            Semua testimoni sudah diproses. Kerja bagus! 🎉
                        @else
                            Testimoni dari pelanggan akan muncul di sini.
                        @endif
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($testimonials->hasPages())
        <div class="mt-5">{{ $testimonials->links() }}</div>
    @endif
@endsection