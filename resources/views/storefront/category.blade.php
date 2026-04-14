@extends('layouts.storefront')

@section('title', $category->name.' — '.config('app.name'))

@section('content')
    <div class="relative overflow-hidden border-b border-amber-950/12 bg-stone-900 text-white">
        <div class="absolute inset-0 opacity-40">
            @if ($category->image_path)
                <img src="{{ asset('storage/'.$category->image_path) }}" alt="" class="h-full min-h-[200px] w-full object-cover sm:min-h-[240px]" loading="eager">
            @else
                <div class="h-full min-h-[200px] w-full bg-gradient-to-br from-stone-800 via-stone-900 to-amber-950 sm:min-h-[240px]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-b sm:bg-gradient-to-r from-stone-950/95 via-stone-950/82 to-stone-900/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:scroll-mt-28 sm:px-6 sm:py-14 lg:px-8 scroll-mt-24">
            <nav class="mb-6 text-sm font-medium text-stone-300" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-1 gap-y-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" aria-label="{{ __('Home') }}" class="inline-flex items-center gap-1 rounded-lg px-1 py-1 transition hover:text-amber-200 touch-manipulation min-h-11 sm:min-h-0">
                            <x-storefront-icon name="home" class="h-4 w-4 shrink-0 opacity-80" />
                            <span class="hidden sm:inline" aria-hidden="true">{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="inline-flex items-center text-stone-500" aria-hidden="true">
                        <x-storefront-icon name="chevron-right" class="mx-0.5 h-4 w-4" />
                    </li>
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}#categories" class="rounded-lg px-1 py-1 transition hover:text-amber-200 touch-manipulation min-h-11 inline-flex items-center sm:min-h-0">{{ __('Categories') }}</a>
                    </li>
                    <li class="inline-flex items-center text-stone-500" aria-hidden="true">
                        <x-storefront-icon name="chevron-right" class="mx-0.5 h-4 w-4" />
                    </li>
                    <li class="inline-flex min-w-0 max-w-full items-center font-semibold text-white">
                        <span class="truncate">{{ $category->name }}</span>
                    </li>
                </ol>
            </nav>
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-8">
                <div class="max-w-2xl min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-amber-200/90 sm:text-xs">{{ __('Collection') }}</p>
                    <h1 class="font-display mt-2 text-2xl font-semibold tracking-tight sm:mt-3 sm:text-4xl lg:text-5xl">{{ $category->name }}</h1>
                    @if ($category->description)
                        <p class="mt-4 text-base leading-relaxed text-stone-200/95 sm:mt-5 sm:text-lg">{{ $category->description }}</p>
                    @endif
                </div>
                <a href="{{ route('home') }}#catalog" class="inline-flex w-full min-h-12 touch-manipulation items-center justify-center gap-2 rounded-2xl border-2 border-white/35 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/15 sm:w-auto sm:shrink-0">
                    <x-storefront-icon name="shopping-bag" class="h-5 w-5 text-white/90" />
                    {{ __('Browse all products') }}
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8">
        <div class="mb-8 sm:mb-10">
            @include('storefront.partials.catalog-filters', [
                'formAction' => route('storefront.category', $category),
                'categories' => null,
                'lockedCategory' => $category,
                'clearUrl' => route('storefront.category', $category),
            ])
        </div>

        @if ($products->isEmpty())
            <p class="storefront-parquet rounded-3xl border border-amber-950/15 px-6 py-12 text-center text-stone-600 sm:px-8 sm:py-16">{{ __('No products in this category match your filters.') }}</p>
        @else
            <div class="grid grid-cols-1 gap-5 min-[480px]:grid-cols-2 sm:gap-6 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    @include('storefront.partials.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-10 sm:mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    @if (request()->hasAny(['q', 'min_price', 'max_price']))
        <script>
            window.scrollTo({ top: document.querySelector('.mb-8')?.offsetTop ?? 0, behavior: 'smooth' });
        </script>
    @endif
@endsection
