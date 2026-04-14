<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full antialiased bg-zinc-50 text-zinc-900" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-3 focus:py-2 focus:shadow-lg">{{ __('Skip to content') }}</a>

    <header class="sticky top-0 z-50 border-b border-zinc-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-600 to-indigo-600 text-sm font-bold text-white shadow-lg shadow-violet-500/25">MG</span>
                <span class="font-bold tracking-tight text-zinc-900 hidden min-[400px]:inline">{{ config('app.name') }}</span>
            </a>
            <nav class="flex items-center gap-2 sm:gap-4 text-sm font-semibold">
                <a href="{{ route('home') }}#categories" class="text-zinc-600 hover:text-violet-600 transition hidden sm:inline">{{ __('Categories') }}</a>
                <a href="{{ route('home') }}#featured" class="text-zinc-600 hover:text-violet-600 transition hidden sm:inline">{{ __('New arrivals') }}</a>
                <a href="{{ route('home') }}#catalog" class="text-zinc-600 hover:text-violet-600 transition">{{ __('Shop') }}</a>
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="rounded-lg bg-zinc-900 px-3 py-2 text-white hover:bg-zinc-800 transition text-xs sm:text-sm">{{ __('Admin') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="rounded-lg border border-zinc-200 bg-white px-3 py-2 text-zinc-700 hover:bg-zinc-50 transition text-xs sm:text-sm">{{ __('Sign in') }}</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="border-t border-zinc-200 bg-white mt-16">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-zinc-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
            <a href="{{ route('home') }}#catalog" class="font-semibold text-violet-600 hover:text-violet-500">{{ __('Browse catalog') }}</a>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
