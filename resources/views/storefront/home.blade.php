@extends('layouts.storefront')

@section('title', config('app.name').' — '.__('Shop'))

@section('content')
    {{-- Hero: furniture interior backdrop --}}
    <section class="relative min-h-[min(68vh,480px)] sm:min-h-[min(72vh,520px)] overflow-hidden border-b border-amber-950/15">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&amp;fit=crop&amp;w=2000&amp;q=80"
                alt=""
                width="2000"
                height="1333"
                fetchpriority="high"
                decoding="async"
                class="storefront-hero-img h-full min-h-[68vh] w-full object-cover sm:min-h-0 scale-105 motion-safe:transition-transform motion-safe:duration-[20s] sm:hover:scale-100"
            >
            <div class="absolute inset-0 bg-gradient-to-b sm:bg-gradient-to-r from-stone-950/94 via-stone-900/82 to-stone-800/60"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_90%_60%_at_70%_20%,rgba(217,119,6,0.12),transparent_55%)]"></div>
        </div>
        <div class="relative mx-auto flex min-h-[min(68vh,480px)] sm:min-h-[min(72vh,520px)] max-w-7xl flex-col justify-center px-[max(1rem,env(safe-area-inset-left))] py-10 pr-[max(1rem,env(safe-area-inset-right))] sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="max-w-2xl">
                <div class="mb-6 drop-shadow-[0_2px_24px_rgba(0,0,0,0.45)] sm:mb-8">
                    <x-brand-logo variant="light" class="h-10 w-auto sm:h-12 md:h-14" />
                </div>
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-amber-200/90 sm:text-xs">{{ __('Showroom') }}</p>
                <h1 class="font-display mt-4 text-[clamp(1.5rem,5.5vw,3.75rem)] font-semibold leading-[1.12] tracking-tight text-white sm:mt-5 lg:text-6xl">
                    {{ __('Pieces that make a room feel finished') }}
                </h1>
                <p class="mt-5 max-w-xl text-base leading-relaxed text-stone-200/95 sm:mt-6 sm:text-lg">
                    {{ __('Sofas, dining, bedroom, and office—curated with warm materials, honest pricing, and details you will notice every day.') }}
                </p>
                <div class="mt-8 flex w-full max-w-md flex-col gap-3 sm:mt-10 sm:max-w-none sm:flex-row sm:flex-wrap sm:gap-4">
                    <a href="#categories" class="inline-flex min-h-12 w-full touch-manipulation items-center justify-center gap-2 rounded-2xl bg-amber-500 px-5 py-3.5 text-sm font-semibold text-stone-950 shadow-lg shadow-amber-950/25 transition hover:bg-amber-400 sm:w-auto sm:min-h-0 sm:px-7">
                        <x-storefront-icon name="squares-2x2" class="h-5 w-5 text-stone-900/90" />
                        {{ __('Explore categories') }}
                    </a>
                    <a href="#catalog" class="inline-flex min-h-12 w-full touch-manipulation items-center justify-center gap-2 rounded-2xl border-2 border-white/35 bg-white/10 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/15 sm:w-auto sm:px-7">
                        <x-storefront-icon name="shopping-bag" class="h-5 w-5 text-white/95" />
                        {{ __('Shop all') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section id="categories" class="relative mx-auto max-w-7xl px-[max(1rem,env(safe-area-inset-left))] py-12 pr-[max(1rem,env(safe-area-inset-right))] sm:scroll-mt-28 sm:py-16 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="mb-8 flex flex-col gap-4 sm:mb-12 sm:flex-row sm:items-end sm:justify-between">
            <div class="flex gap-3 sm:gap-4">
                <span class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-900 ring-1 ring-amber-950/10 sm:h-12 sm:w-12" aria-hidden="true">
                    <x-storefront-icon name="squares-2x2" class="h-5 w-5 sm:h-6 sm:w-6" />
                </span>
                <div class="min-w-0">
                    <h2 class="font-display text-2xl font-semibold tracking-tight text-stone-900 sm:text-3xl lg:text-4xl">{{ __('Shop by room') }}</h2>
                    <p class="mt-2 max-w-xl text-sm text-stone-600 sm:mt-3 sm:text-base">{{ __('Choose a collection—each category is styled like a walk through our floor.') }}</p>
                </div>
            </div>
        </div>
        @if ($categories->isEmpty())
            <p class="storefront-parquet rounded-3xl border border-dashed border-amber-950/20 px-6 py-12 text-center text-stone-600 shadow-inner sm:px-8 sm:py-16">
                {{ __('Categories will appear here once added in the admin panel.') }}
            </p>
        @else
            <div class="grid grid-cols-1 gap-4 min-[480px]:grid-cols-2 sm:gap-5 lg:grid-cols-4 lg:gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('storefront.category', $category) }}" class="group flex flex-col overflow-hidden rounded-3xl border border-amber-950/10 bg-[#fdfbf7]/90 shadow-[0_18px_50px_-28px_rgba(28,25,23,0.45)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:border-amber-800/25 hover:shadow-[0_24px_60px_-24px_rgba(120,53,15,0.35)] touch-manipulation">
                        <div class="relative aspect-[16/11] overflow-hidden bg-stone-200 sm:aspect-[4/3]">
                            @if ($category->image_path)
                                <img src="{{ asset('storage/'.$category->image_path) }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-amber-100/80 to-stone-200 text-amber-800/50">
                                    <x-storefront-icon name="photo" class="h-12 w-12 sm:h-14 sm:w-14" />
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/55 via-stone-950/10 to-transparent opacity-80 transition duration-300 group-hover:opacity-95"></div>
                            <span class="absolute bottom-3 left-3 right-3 font-display text-base font-semibold text-white drop-shadow-sm sm:bottom-4 sm:text-lg">{{ $category->name }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-4 sm:p-5">
                            <p class="text-sm leading-snug text-stone-600 line-clamp-2">{{ \Illuminate\Support\Str::limit($category->description ?? '', 88) }}</p>
                            <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-amber-900 sm:mt-4">
                                {{ $category->products_count }} {{ __('products') }}
                                <x-storefront-icon name="chevron-right" class="h-3.5 w-3.5 opacity-80" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Latest 5 --}}
    <section id="featured" class="relative border-y border-amber-950/10 storefront-parquet scroll-mt-24 sm:scroll-mt-28">
        <div class="mx-auto max-w-7xl px-[max(1rem,env(safe-area-inset-left))] py-12 pr-[max(1rem,env(safe-area-inset-right))] sm:py-16 sm:px-6 lg:px-8">
            <div class="mb-8 flex gap-3 sm:mb-12 sm:gap-4">
                <span class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white text-amber-900 shadow-sm ring-1 ring-amber-950/10 sm:h-12 sm:w-12" aria-hidden="true">
                    <x-storefront-icon name="sparkles" class="h-5 w-5 sm:h-6 sm:w-6" />
                </span>
                <div>
                    <h2 class="font-display text-2xl font-semibold tracking-tight text-stone-900 sm:text-3xl lg:text-4xl">{{ __('Just in from the workshop') }}</h2>
                    <p class="mt-2 text-sm text-stone-600 sm:mt-3 sm:text-base">{{ __('The five most recently added active pieces.') }}</p>
                </div>
            </div>
            @if ($featured->isEmpty())
                <p class="rounded-3xl border border-dashed border-amber-950/20 bg-white/60 px-6 py-12 text-center text-stone-600 sm:px-8 sm:py-16">{{ __('No active products to show yet.') }}</p>
            @else
                <div class="grid grid-cols-1 gap-5 min-[480px]:grid-cols-2 sm:gap-6 lg:grid-cols-3 xl:grid-cols-5">
                    @foreach ($featured as $product)
                        @include('storefront.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Catalog + filters --}}
    <section id="catalog" class="mx-auto max-w-7xl px-[max(1rem,env(safe-area-inset-left))] py-12 pr-[max(1rem,env(safe-area-inset-right))] sm:scroll-mt-28 sm:py-16 sm:px-6 lg:px-8 scroll-mt-24">
        <div class="mb-8 flex gap-3 sm:mb-10 sm:gap-4">
            <span class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-900 ring-1 ring-amber-950/10 sm:h-12 sm:w-12" aria-hidden="true">
                <x-storefront-icon name="shopping-bag" class="h-5 w-5 sm:h-6 sm:w-6" />
            </span>
            <div>
                <h2 class="font-display text-2xl font-semibold tracking-tight text-stone-900 sm:text-3xl lg:text-4xl">{{ __('bY catalog') }}</h2>
                <p class="mt-2 text-sm text-stone-600 sm:mt-3 sm:text-base">{{ __('Filter by category, price, or name—find the right piece for your space.') }}</p>
            </div>
        </div>
        <div class="mb-8 sm:mb-10">
            @include('storefront.partials.catalog-filters', [
                'formAction' => route('home'),
                'categories' => $categories,
                'lockedCategory' => null,
                'clearUrl' => route('home'),
            ])
        </div>
        @if ($products->isEmpty())
            <p class="storefront-parquet rounded-3xl border border-amber-950/15 px-6 py-12 text-center text-stone-600 sm:px-8 sm:py-16">{{ __('No products match your filters. Try adjusting search or price.') }}</p>
        @else
            <div id="catalog-results" class="scroll-mt-28 sm:scroll-mt-32">
                <div class="grid grid-cols-1 gap-5 min-[480px]:grid-cols-2 sm:gap-6 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $product)
                        @include('storefront.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-10 border-t border-amber-950/10 pt-8 sm:mt-12 sm:pt-10">
                    {{ $products->links('pagination.storefront') }}
                </div>
            </div>
        @endif
    </section>

    @if (request()->hasAny(['category_id', 'q', 'min_price', 'max_price']) || (request()->filled('page') && (int) request('page') > 1))
        <script>
            (function () {
                var el = document.getElementById('catalog-results') || document.getElementById('catalog');
                el?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            })();
        </script>
    @endif
@endsection
