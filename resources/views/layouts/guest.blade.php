<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Sign in')) — {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/malik-favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased" style="font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;">
    <div class="relative flex min-h-full flex-col justify-center overflow-hidden bg-slate-950 px-[max(1rem,env(safe-area-inset-left))] py-12 pr-[max(1rem,env(safe-area-inset-right))] pb-[max(2rem,env(safe-area-inset-bottom))] pt-[max(3rem,env(safe-area-inset-top))] sm:px-6 lg:px-8">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(120,119,198,0.35),rgba(255,255,255,0))] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[480px] h-[480px] bg-violet-600/20 rounded-full blur-3xl pointer-events-none translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute top-1/4 left-0 w-72 h-72 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none -translate-x-1/2"></div>
        <div class="relative sm:mx-auto sm:w-full sm:max-w-md">
            @yield('content')
        </div>
    </div>
</body>
</html>
