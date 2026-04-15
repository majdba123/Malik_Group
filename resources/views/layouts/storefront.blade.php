<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('images/malik-favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="storefront-body min-h-full antialiased text-stone-900 font-sans">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-3 focus:py-2 focus:shadow-lg">{{ __('Skip to content') }}</a>

    <header class="sticky top-0 z-50 border-b border-amber-950/10 bg-[#fdfbf7]/90 backdrop-blur-xl shadow-[0_1px_0_rgba(255,255,255,0.6)_inset] supports-[padding:max(0px)]:pt-[env(safe-area-inset-top)]">
        <div class="mx-auto flex min-w-0 max-w-7xl items-center justify-between gap-2 px-[max(0.75rem,env(safe-area-inset-left))] py-2.5 pr-[max(0.75rem,env(safe-area-inset-right))] sm:gap-4 sm:px-6 sm:py-3 lg:px-8">
            <a href="{{ route('home') }}" class="group flex min-w-0 max-w-[min(100%,14rem)] items-center gap-2 sm:max-w-none sm:gap-3 shrink touch-manipulation sm:shrink-0">
                <x-brand-logo variant="dark" class="h-8 w-auto shrink-0 text-stone-900 sm:h-9 md:h-10" />
                <span class="hidden min-[420px]:flex min-w-0 flex-col leading-tight border-l border-amber-950/15 pl-2.5 sm:pl-3">
                    <span class="sr-only">{{ config('app.name') }}</span>
                    <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-amber-800/85 leading-none">{{ __('Furniture & interiors') }}</span>
                </span>
            </a>
            <nav class="flex min-w-0 max-w-[62%] min-[400px]:max-w-[68%] items-center justify-end gap-0.5 overflow-x-auto sm:max-w-none sm:gap-1 sm:overflow-visible [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:text-sm text-[13px] font-semibold" aria-label="{{ __('Primary') }}">
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
            <div class="flex flex-col items-center gap-4 text-center sm:items-start sm:text-left">
                <div class="rounded-xl bg-white/95 px-4 py-2.5 shadow-lg shadow-black/25 ring-1 ring-white/10">
                    <x-brand-logo variant="dark" class="h-9 w-auto sm:h-10" />
                </div>
                <p class="text-stone-500">&copy; {{ date('Y') }}. {{ __('All rights reserved.') }}</p>
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
