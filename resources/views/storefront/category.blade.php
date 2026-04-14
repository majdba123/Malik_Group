@extends('layouts.storefront')

@section('title', $category->name.' — '.config('app.name'))

@section('content')
    <div class="border-b border-zinc-200/80 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="text-sm font-medium text-zinc-500 mb-4" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-violet-600 transition">{{ __('Home') }}</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('home') }}#categories" class="hover:text-violet-600 transition">{{ __('Categories') }}</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="text-zinc-900 font-semibold">{{ $category->name }}</li>
                </ol>
            </nav>
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-900">{{ $category->name }}</h1>
                    @if ($category->description)
                        <p class="mt-4 text-lg text-zinc-600 leading-relaxed">{{ $category->description }}</p>
                    @endif
                </div>
                <a href="{{ route('home') }}#catalog" class="inline-flex w-fit items-center rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm font-bold text-zinc-800 hover:bg-zinc-50 transition">{{ __('Browse all products') }}</a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-10">
            @include('storefront.partials.catalog-filters', [
                'formAction' => route('storefront.category', $category),
                'categories' => null,
                'lockedCategory' => $category,
                'clearUrl' => route('storefront.category', $category),
            ])
        </div>

        @if ($products->isEmpty())
            <p class="rounded-2xl border border-zinc-200 bg-zinc-50 px-6 py-14 text-center text-zinc-600">{{ __('No products in this category match your filters.') }}</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    @include('storefront.partials.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    @if (request()->hasAny(['q', 'min_price', 'max_price']))
        <script>
            window.scrollTo({ top: document.querySelector('.mb-10')?.offsetTop ?? 0, behavior: 'smooth' });
        </script>
    @endif
@endsection
