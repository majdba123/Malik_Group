@extends('layouts.guest')

@section('title', __('Administrator sign in'))

@section('content')
    <div class="mb-10 text-center">
        <div class="mb-5 inline-block rounded-2xl bg-white px-5 py-3 shadow-xl shadow-black/30 ring-1 ring-white/20">
            <x-brand-logo variant="dark" class="mx-auto h-10 w-auto max-w-[15rem] sm:h-11" />
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-white">{{ __('Administrator sign in') }}</h1>
        <p class="mt-2 text-sm text-slate-400">{{ __('Use your admin credentials to access the dashboard.') }}</p>
    </div>

    <div class="rounded-2xl border border-slate-800/80 bg-slate-900/60 backdrop-blur-xl p-8 shadow-2xl shadow-black/40">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                    class="block w-full rounded-xl border border-slate-700 bg-slate-950/50 px-4 py-3 text-white placeholder-slate-500 shadow-inner focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition text-sm">
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="block w-full rounded-xl border border-slate-700 bg-slate-950/50 px-4 py-3 text-white placeholder-slate-500 shadow-inner focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition text-sm">
            </div>
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" value="1"
                    class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-violet-600 focus:ring-violet-500/30">
                <label for="remember" class="ml-2 text-sm text-slate-400">{{ __('Remember me') }}</label>
            </div>
            <button type="submit"
                class="flex w-full justify-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-600/25 hover:from-violet-500 hover:to-indigo-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition">
                {{ __('Sign in') }}
            </button>
        </form>
    </div>
    <p class="mt-8 text-center text-xs text-slate-500">{{ __('Restricted access. Public registration is disabled.') }}</p>
@endsection
