<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="storefront-body min-h-full antialiased text-stone-900 font-sans">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-3 focus:py-2 focus:shadow-lg">{{ __('Skip to content') }}</a>

    <header class="sticky top-0 z-50 border-b border-amber-950/10 bg-[#fdfbf7]/90 backdrop-blur-xl shadow-[0_1px_0_rgba(255,255,255,0.6)_inset]">
        <div class="mx-auto flex min-w-0 max-w-7xl items-center justify-between gap-2 px-3 py-2.5 sm:gap-4 sm:px-6 sm:py-3 lg:px-8">
            <a href="{{ route('home') }}" class="group flex min-w-0 items-center gap-2.5 sm:gap-3 shrink-0 touch-manipulation">
                <span class="relative flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-900 via-stone-800 to-stone-900 text-xs font-bold tracking-widest text-amber-100 shadow-lg shadow-amber-950/25 ring-2 ring-amber-200/40 transition group-hover:ring-amber-300/60">
                    <span class="absolute inset-0 rounded-2xl opacity-30 bg-[url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2780%27 height=%2780%27%3E%3Cfilter id=%27g%27%3E%3CfeTurbulence type=%27fractalNoise%27 baseFrequency=%270.8%27 numOctaves=%272%27/%3E%3C/filter%3E%3Crect width=%2780%27 height=%2780%27 filter=%27url(%23g)%27 opacity=%270.35%27/%3E%3C/svg%3E')]"></span>
                    <span class="relative font-display text-sm font-semibold">MG</span>
                </span>
                <span class="hidden min-[400px]:flex min-w-0 flex-col leading-tight">
                    <span class="font-display truncate text-base sm:text-lg font-semibold tracking-tight text-stone-900">{{ config('app.name') }}</span>
                    <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-amber-800/80">{{ __('Furniture & interiors') }}</span>
                </span>
            </a>
            <nav class="flex min-w-0 max-w-[65%] items-center justify-end gap-0.5 overflow-x-auto sm:max-w-none sm:gap-1 sm:overflow-visible [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:text-sm text-[13px] font-semibold" aria-label="{{ __('Primary') }}">
                <a href="{{ route('home') }}#categories" aria-label="{{ __('Categories') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-xl px-2.5 py-2.5 min-h-11 min-w-11 justify-center sm:min-w-0 text-stone-600 transition hover:bg-amber-950/5 hover:text-amber-950 touch-manipulation sm:px-3">
                    <x-storefront-icon name="squares-2x2" class="h-5 w-5 sm:h-[1.125rem] sm:w-[1.125rem]" />
                    <span class="hidden sm:inline" aria-hidden="true">{{ __('Categories') }}</span>
                </a>
                <a href="{{ route('home') }}#featured" aria-label="{{ __('New arrivals') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-xl px-2.5 py-2.5 min-h-11 min-w-11 justify-center sm:min-w-0 text-stone-600 transition hover:bg-amber-950/5 hover:text-amber-950 touch-manipulation sm:px-3">
                    <x-storefront-icon name="sparkles" class="h-5 w-5 sm:h-[1.125rem] sm:w-[1.125rem]" />
                    <span class="hidden md:inline" aria-hidden="true">{{ __('New arrivals') }}</span>
                    <span class="hidden sm:inline md:hidden" aria-hidden="true">{{ __('New') }}</span>
                </a>
                <a href="{{ route('home') }}#catalog" aria-label="{{ __('Shop') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-xl px-2.5 py-2.5 min-h-11 min-w-11 justify-center sm:min-w-0 text-stone-700 transition hover:bg-amber-950/5 hover:text-amber-950 touch-manipulation sm:px-3">
                    <x-storefront-icon name="shopping-bag" class="h-5 w-5 sm:h-[1.125rem] sm:w-[1.125rem]" />
                    <span class="hidden sm:inline" aria-hidden="true">{{ __('Shop') }}</span>
                </a>
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('dashboard') }}" class="inline-flex shrink-0 items-center justify-center rounded-xl bg-stone-900 px-3 py-2.5 min-h-11 text-white shadow-md shadow-stone-900/15 transition hover:bg-stone-800 touch-manipulation text-xs sm:text-sm">{{ __('Admin') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-flex shrink-0 items-center justify-center rounded-xl border border-amber-950/15 bg-white/90 px-3 py-2.5 min-h-11 text-stone-800 shadow-sm transition hover:border-amber-800/25 hover:bg-white touch-manipulation text-xs sm:text-sm">{{ __('Sign in') }}</a>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="relative mt-20 border-t border-amber-950/15 bg-gradient-to-b from-stone-900 via-stone-900 to-stone-950 text-stone-300">
        <div class="pointer-events-none absolute inset-0 opacity-[0.07] bg-[url('data:image/svg+xml,%3Csvg width=%2760%27 height=%2760%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cpath d=%27M30 0L60 30 30 60 0 30z%27 fill=%27none%27 stroke=%27%23fff%27 stroke-width=%271%27/%3E%3C/svg%3E')] bg-[length:60px_60px]"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:py-12 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6 text-sm">
            <div class="text-center sm:text-left">
                <p class="font-display text-lg text-stone-100">{{ config('app.name') }}</p>
                <p class="mt-1 text-stone-500">&copy; {{ date('Y') }}. {{ __('All rights reserved.') }}</p>
            </div>
            <a href="{{ route('home') }}#catalog" class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-600/15 px-4 py-3 min-h-11 font-semibold text-amber-200 ring-1 ring-amber-500/30 transition hover:bg-amber-500/20 touch-manipulation w-full sm:w-auto">
                <x-storefront-icon name="shopping-bag" class="h-5 w-5 text-amber-300/90" />
                {{ __('Browse catalog') }}
            </a>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
