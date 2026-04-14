@extends('layouts.storefront')

@section('title', config('app.name').' — '.__('Shop'))

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-zinc-200/80 bg-gradient-to-br from-zinc-900 via-violet-950 to-indigo-950">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-90"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8 lg:py-28">
            <div class="max-w-2xl">
                <p class="text-sm font-bold uppercase tracking-widest text-violet-300">{{ __('Curated catalog') }}</p>
                <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">{{ __('Discover quality products') }}</h1>
                <p class="mt-6 text-lg text-violet-100/90 leading-relaxed">{{ __('Browse by category, filter by price, and explore our latest arrivals—all in one responsive storefront.') }}</p>
                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="#categories" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-violet-900 shadow-lg hover:bg-violet-50 transition">{{ __('Explore categories') }}</a>
                    <a href="#catalog" class="inline-flex items-center justify-center rounded-xl border-2 border-white/30 bg-white/10 px-6 py-3.5 text-sm font-bold text-white backdrop-blur-sm hover:bg-white/15 transition">{{ __('Shop all') }}</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section id="categories" class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-zinc-900">{{ __('Shop by category') }}</h2>
                <p class="mt-2 text-zinc-600 max-w-xl">{{ __('Tap a category to see every active listing in that collection.') }}</p>
            </div>
        </div>
        @if ($categories->isEmpty())
            <p class="rounded-2xl border border-dashed border-zinc-300 bg-zinc-50 px-6 py-12 text-center text-zinc-600">{{ __('Categories will appear here once added in the admin panel.') }}</p>
        @else
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 lg:gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('storefront.category', $category) }}" class="group flex flex-col overflow-hidden rounded-2xl border border-zinc-200/90 bg-white shadow-sm transition hover:shadow-xl hover:border-violet-200 hover:-translate-y-1">
                        <div class="relative aspect-[4/3] overflow-hidden bg-zinc-100">
                            @if ($category->image_path)
                                <img src="{{ asset('storage/'.$category->image_path) }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-violet-100 to-indigo-100 text-violet-400">
                                    <svg class="h-14 w-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </div>
                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="font-bold text-zinc-900 group-hover:text-violet-600 transition">{{ $category->name }}</h3>
                            <p class="mt-1 text-sm text-zinc-500 line-clamp-2">{{ \Illuminate\Support\Str::limit($category->description ?? '', 72) }}</p>
                            <span class="mt-3 text-xs font-bold text-violet-600">{{ $category->products_count }} {{ __('products') }} →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Latest 5 --}}
    <section id="featured" class="border-y border-zinc-200/80 bg-white scroll-mt-24">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-zinc-900">{{ __('Latest arrivals') }}</h2>
                <p class="mt-2 text-zinc-600">{{ __('The five most recently added active products.') }}</p>
            </div>
            @if ($featured->isEmpty())
                <p class="rounded-2xl border border-dashed border-zinc-300 bg-zinc-50 px-6 py-12 text-center text-zinc-600">{{ __('No active products to show yet.') }}</p>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                    @foreach ($featured as $product)
                        @include('storefront.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Catalog + filters --}}
    <section id="catalog" class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-zinc-900">{{ __('All products') }}</h2>
            <p class="mt-2 text-zinc-600">{{ __('Filter by category, price range, or search by product name.') }}</p>
        </div>
        <div class="mb-10">
            @include('storefront.partials.catalog-filters', [
                'formAction' => route('home'),
                'categories' => $categories,
                'lockedCategory' => null,
                'clearUrl' => route('home'),
            ])
        </div>
        @if ($products->isEmpty())
            <p class="rounded-2xl border border-zinc-200 bg-zinc-50 px-6 py-14 text-center text-zinc-600">{{ __('No products match your filters. Try adjusting search or price.') }}</p>
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
    </section>

    @if (request()->hasAny(['category_id', 'q', 'min_price', 'max_price']))
        <script>
            document.getElementById('catalog')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        </script>
    @endif
@endsection
