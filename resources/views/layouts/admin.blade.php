<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Admin')) — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-slate-100 text-slate-900" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
    <div class="min-h-full lg:flex">
        <aside class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0 bg-slate-950 text-slate-300 border-r border-slate-800/80">
            <div class="flex h-16 shrink-0 items-center gap-2 px-6 border-b border-slate-800/80">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-violet-500 to-indigo-600 text-white text-sm font-bold shadow-lg shadow-violet-500/25">MG</span>
                <div>
                    <p class="text-sm font-semibold text-white tracking-tight">{{ config('app.name') }}</p>
                    <p class="text-xs text-slate-500">{{ __('Admin console') }}</p>
                </div>
            </div>
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white border border-white/10' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('dashboard.categories.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('dashboard.categories.*') ? 'bg-white/10 text-white border border-white/10' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    {{ __('Categories') }}
                </a>
                <a href="{{ route('dashboard.products.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('dashboard.products.*') ? 'bg-white/10 text-white border border-white/10' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    {{ __('Products') }}
                </a>
            </nav>
            <div class="p-3 border-t border-slate-800/80">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-400 hover:bg-red-500/10 hover:text-red-300 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        {{ __('Sign out') }}
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 lg:pl-64 flex flex-col min-h-screen min-w-0">
            <header class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-4 border-b border-slate-200/80 bg-white/80 backdrop-blur-md px-4 lg:px-8">
                <details class="relative lg:hidden group">
                    <summary class="list-none cursor-pointer flex items-center justify-center h-10 w-10 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </summary>
                    <div class="absolute left-0 mt-2 w-56 rounded-xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50 py-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">{{ __('Dashboard') }}</a>
                        <a href="{{ route('dashboard.categories.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">{{ __('Categories') }}</a>
                        <a href="{{ route('dashboard.products.index') }}" class="block px-4 py-2 text-sm hover:bg-slate-50">{{ __('Products') }}</a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 mt-2 pt-2">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">{{ __('Sign out') }}</button>
                        </form>
                    </div>
                </details>
                <div class="flex-1 min-w-0">
                    <h1 class="text-lg font-semibold text-slate-900 truncate tracking-tight">@yield('heading')</h1>
                    @hasSection('subheading')
                        <p class="text-sm text-slate-500 truncate">@yield('subheading')</p>
                    @endif
                </div>
                <div class="hidden sm:flex items-center gap-3 rounded-full bg-slate-100/80 pl-3 pr-1 py-1 border border-slate-200/80">
                    <div class="text-right">
                        <p class="text-xs font-medium text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-500">{{ __('Administrator') }}</p>
                    </div>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-violet-500 to-indigo-600 text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-10">
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200/80 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-red-200/80 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
