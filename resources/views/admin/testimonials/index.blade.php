@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
    @php
        $tabs = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'all' => 'Semua',
        ];
    @endphp

    <div class="mb-5 flex flex-wrap gap-2">
        @foreach ($tabs as $key => $label)
            <a href="{{ route('admin.testimonials.index', ['filter' => $key]) }}"
               class="rounded-lg px-3 py-1.5 text-sm font-medium {{ $filter === $key ? 'bg-indigo-600 text-white' : 'border border-slate-300 text-slate-600 hover:bg-slate-100' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="space-y-4">
        @forelse ($testimonials as $testimonial)
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-3">
                            <div class="flex text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-300' }}" viewBox="0 0 24 24" fill="currentColor"><path d="M11.48 3.5a.562.562 0 0 1 1.04 0l2.125 5.111 5.53.442a.563.563 0 0 1 .32.988l-4.213 3.61 1.286 5.38a.563.563 0 0 1-.84.61L12 17.22l-4.728 2.903a.563.563 0 0 1-.84-.61l1.286-5.38-4.213-3.61a.563.563 0 0 1 .32-.988l5.53-.442L11.48 3.5Z" /></svg>
                                @endfor
                            </div>
                            @if ($testimonial->is_approved)
                                <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Disetujui</span>
                            @else
                                <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Menunggu</span>
                            @endif
                        </div>
                        <p class="mt-2 text-slate-700">{{ $testimonial->message }}</p>
                        <p class="mt-2 text-sm text-slate-500">
                            <span class="font-medium text-slate-800">{{ $testimonial->name }}</span>
                            @if ($testimonial->email) &middot; {{ $testimonial->email }} @endif
                            &middot; {{ $testimonial->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded-lg px-3 py-1.5 text-xs font-semibold {{ $testimonial->is_approved ? 'border border-slate-300 text-slate-600 hover:bg-slate-100' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                                {{ $testimonial->is_approved ? 'Batalkan' : 'Setujui' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500">
                Tidak ada testimoni pada filter ini.
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $testimonials->links() }}</div>
@endsection
