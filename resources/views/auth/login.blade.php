@extends('layouts.app')

@section('title', 'Masuk Admin')

@section('content')
    <div class="mx-auto flex max-w-md flex-col justify-center px-4 py-16">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="text-center">
                <div class="mx-auto grid h-12 w-12 place-items-center rounded-xl bg-indigo-600 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <h1 class="mt-4 text-2xl font-bold text-slate-900">Masuk Dashboard</h1>
                <p class="mt-1 text-sm text-slate-500">Halaman khusus admin katalog.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    @error('password')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    Ingat saya
                </label>
                <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white hover:bg-indigo-700">Masuk</button>
            </form>

            <div class="mt-6 rounded-xl bg-slate-50 p-4 text-xs text-slate-500">
                <p class="font-semibold text-slate-600">Akun demo:</p>
                <p>Email: <span class="font-mono">admin@katalog.test</span></p>
                <p>Password: <span class="font-mono">password</span></p>
            </div>
        </div>
    </div>
@endsection
