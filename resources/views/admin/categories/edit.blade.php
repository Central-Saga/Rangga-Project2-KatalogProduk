@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <div class="mx-auto max-w-xl">
        <a href="{{ route('admin.categories.index') }}" class="mb-4 inline-block text-sm font-medium text-slate-500 hover:text-indigo-600">&larr; Kembali</a>
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                @include('admin.categories._form')
                <div class="flex justify-end gap-2 border-t border-slate-100 pt-4">
                    <a href="{{ route('admin.categories.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">Batal</a>
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
