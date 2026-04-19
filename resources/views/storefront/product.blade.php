@extends('layouts.storefront')

@section('title', $product->name.' — '.config('app.name'))

@section('content')
    @php
        $images = $product->images;
        $main = $images->first();
        $galleryUrls = $images->map(fn ($i) => asset('storage/'.$i->path))->values()->all();
        $telHref = preg_replace('/[^0-9+]/', '', $product->phone_number);
    @endphp

    <article class="relative overflow-hidden border-b border-amber-950/10 bg-[#fdfbf7]/90 backdrop-blur-sm">
        <div class="pointer-events-none absolute inset-0 h-44 bg-gradient-to-b from-amber-100/50 via-transparent to-transparent sm:h-52"></div>
        <div class="relative mx-auto max-w-7xl px-[max(1rem,env(safe-area-inset-left))] py-5 pr-[max(1rem,env(safe-area-inset-right))] sm:scroll-mt-28 sm:px-6 sm:py-6 lg:px-8 lg:py-8 scroll-mt-24">
            <nav class="flex flex-wrap items-center gap-x-1 gap-y-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" aria-label="{{ __('Home') }}" class="inline-flex min-h-11 touch-manipulation items-center gap-1.5 rounded-full bg-white/90 px-3 py-2 font-semibold text-stone-600 shadow-sm ring-1 ring-amber-950/10 transition hover:bg-amber-50 hover:text-amber-950 sm:min-h-0 sm:py-1">
                    <x-storefront-icon name="home" class="h-4 w-4 shrink-0" />
                    <span class="hidden sm:inline" aria-hidden="true">{{ __('Home') }}</span>
                </a>
                <span class="inline-flex items-center text-stone-300" aria-hidden="true">
                    <x-storefront-icon name="chevron-right" class="h-4 w-4" />
                </span>
                <a href="{{ route('storefront.category', $product->category) }}" class="inline-flex min-h-11 max-w-[100%] touch-manipulation items-center rounded-full bg-white/90 px-3 py-2 font-semibold text-stone-600 shadow-sm ring-1 ring-amber-950/10 transition hover:bg-amber-50 hover:text-amber-950 sm:min-h-0 sm:max-w-[16rem] sm:py-1">
                    <span class="truncate">{{ $product->category->name }}</span>
                </a>
                <span class="inline-flex items-center text-stone-300" aria-hidden="true">
                    <x-storefront-icon name="chevron-right" class="h-4 w-4" />
                </span>
                <span class="inline-flex min-h-11 w-full max-w-full items-center rounded-full bg-stone-900 px-3 py-2 text-xs font-bold text-amber-50 sm:min-h-0 sm:w-auto sm:max-w-[min(100%,28rem)] sm:py-1">
                    <span class="truncate">{{ $product->name }}</span>
                </span>
            </nav>
        </div>
    </article>

    <div class="mx-auto max-w-7xl px-[max(1rem,env(safe-area-inset-left))] py-6 pr-[max(1rem,env(safe-area-inset-right))] sm:px-6 sm:py-8 lg:px-8 lg:py-14">
        <div class="grid gap-8 items-start sm:gap-10 lg:grid-cols-12 lg:gap-12 xl:gap-16">
            {{-- Gallery --}}
            <div class="lg:col-span-7 space-y-4 sm:space-y-5 lg:sticky lg:top-[4.75rem]">
                @if ($main)
                    <button type="button"
                        class="js-lightbox-trigger group relative w-full overflow-hidden rounded-3xl border border-amber-950/12 bg-stone-100 shadow-[0_28px_70px_-40px_rgba(28,25,23,0.55)] ring-1 ring-black/5 transition hover:ring-amber-600/40 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2"
                        data-src="{{ asset('storage/'.$main->path) }}"
                        data-alt="{{ $product->name }}">
                        <span class="block aspect-square sm:aspect-[5/4]">
                            <img id="product-main-image" src="{{ asset('storage/'.$main->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]">
                        </span>
                        <span class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60 sm:opacity-100"></span>
                        <span class="pointer-events-none absolute bottom-3 right-3 inline-flex items-center gap-2 rounded-full bg-white/95 px-3 py-2 text-[11px] font-bold text-stone-900 shadow-lg backdrop-blur-sm sm:bottom-4 sm:right-4 sm:px-4 sm:text-xs sm:opacity-0 sm:group-hover:opacity-100 sm:transition sm:duration-300">
                            <x-storefront-icon name="arrows-pointing-out" class="h-4 w-4 text-amber-700" />
                            {{ __('Full screen') }}
                        </span>
                    </button>
                    @if ($images->count() > 1)
                        <div class="storefront-thumb-scroller -mx-1 flex gap-2 overflow-x-auto px-1 pb-1 sm:mx-0 sm:grid sm:grid-cols-4 sm:gap-2 sm:overflow-visible sm:px-0 sm:pb-0 md:grid-cols-5">
                            @foreach ($images as $img)
                                <button type="button"
                                    class="product-thumb group relative aspect-square w-[4.75rem] shrink-0 overflow-hidden rounded-2xl border-2 bg-stone-100 shadow-sm transition hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 touch-manipulation sm:aspect-square sm:w-auto sm:min-w-0 {{ $loop->first ? 'border-amber-700 ring-2 ring-amber-600/30' : 'border-transparent ring-1 ring-amber-950/15' }}"
                                    data-full-src="{{ asset('storage/'.$img->path) }}"
                                    data-alt="{{ $product->name }}"
                                    aria-label="{{ __('Photo :n', ['n' => $loop->iteration]) }}">
                                    <img src="{{ asset('storage/'.$img->path) }}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="flex aspect-square flex-col items-center justify-center gap-2 rounded-3xl border-2 border-dashed border-amber-950/20 bg-stone-50 text-stone-500">
                        <x-storefront-icon name="photo" class="h-12 w-12 text-stone-400" />
                        <span class="text-sm font-medium">{{ __('No images') }}</span>
                    </div>
                @endif
            </div>

            {{-- Details --}}
            <div class="lg:col-span-5 space-y-6 sm:space-y-8">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full bg-amber-100/90 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] text-amber-950">
                        <x-storefront-icon name="tag" class="h-3.5 w-3.5 text-amber-900/80" />
                        {{ $product->category->name }}
                    </p>
                    <h1 class="font-display mt-3 text-2xl font-semibold tracking-tight text-stone-900 sm:mt-4 sm:text-4xl lg:text-[2.5rem] lg:leading-tight">{{ $product->name }}</h1>
                    <div class="mt-6 flex flex-wrap items-baseline gap-2 border-b border-amber-950/10 pb-6">
                        <span class="text-4xl font-bold tabular-nums tracking-tight text-stone-900 sm:text-5xl">{{ number_format((float) $product->price, 2) }}</span>
                        <span class="text-lg font-semibold text-stone-500">{{ config('app.currency') }}</span>
                    </div>
                </div>

                @if ($product->description)
                    <div class="rounded-3xl border border-amber-950/10 bg-gradient-to-br from-white to-amber-50/40 p-5 shadow-sm sm:p-8">
                        <h2 class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-stone-500">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-stone-900 text-amber-100">
                                <x-storefront-icon name="document" class="h-4 w-4" />
                            </span>
                            {{ __('About this product') }}
                        </h2>
                        <div class="mt-4 text-base leading-relaxed text-stone-700 whitespace-pre-wrap">{{ $product->description }}</div>
                    </div>
                @endif

                <div class="space-y-3">
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-stone-500">{{ __('Actions') }}</p>
                    <div class="grid gap-3 sm:grid-cols-1">
                        <a href="tel:{{ $telHref }}"
                            class="group flex min-h-[3.5rem] touch-manipulation items-center gap-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-4 text-white shadow-lg shadow-emerald-600/25 transition hover:from-emerald-500 hover:to-teal-500 hover:shadow-xl sm:px-5">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/20 ring-2 ring-white/30 transition group-hover:scale-105 sm:h-12 sm:w-12">
                                <x-storefront-icon name="phone" class="h-6 w-6" />
                            </span>
                            <span class="min-w-0 flex-1 text-left">
                                <span class="block text-xs font-semibold uppercase tracking-wide text-emerald-100/90">{{ __('Call now') }}</span>
                                <span class="block truncate text-lg font-bold font-mono tracking-wide">{{ $product->phone_number }}</span>
                            </span>
                            <x-storefront-icon name="chevron-right" class="h-5 w-5 shrink-0 text-white/80" />
                        </a>
                        <a href="{{ route('storefront.category', $product->category) }}"
                            class="flex min-h-[3.5rem] touch-manipulation items-center gap-4 rounded-2xl border-2 border-amber-950/12 bg-white px-4 py-4 font-bold text-stone-800 shadow-sm transition hover:border-amber-800/25 hover:bg-amber-50/60 sm:px-5">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-900 sm:h-12 sm:w-12">
                                <x-storefront-icon name="tag" class="h-6 w-6" />
                            </span>
                            <span class="min-w-0 flex-1 text-left text-sm sm:text-base">{{ __('View more in :category', ['category' => $product->category->name]) }}</span>
                            <x-storefront-icon name="arrow-right" class="h-5 w-5 shrink-0 text-stone-400" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox --}}
    <div id="product-lightbox" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-3 pt-[max(0.75rem,env(safe-area-inset-top))] pb-[max(0.75rem,env(safe-area-inset-bottom))] sm:p-8" role="dialog" aria-modal="true" aria-labelledby="lightbox-title" data-gallery='@json($galleryUrls)'>
        <div id="product-lightbox-backdrop" class="absolute inset-0 bg-stone-950/92 backdrop-blur-md transition-opacity"></div>
        <button type="button" id="product-lightbox-close" class="absolute z-10 flex h-12 w-12 touch-manipulation items-center justify-center rounded-full bg-white text-stone-900 shadow-xl ring-2 ring-amber-950/15 transition hover:bg-amber-50 hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 right-[max(0.75rem,env(safe-area-inset-right))] top-[max(0.75rem,env(safe-area-inset-top))] sm:right-6 sm:top-6 sm:h-12 sm:w-12" aria-label="{{ __('Close image') }}">
            <x-storefront-icon name="x-mark" class="h-6 w-6" />
        </button>
        @if (count($galleryUrls) > 1)
            <button type="button" id="product-lightbox-prev" class="absolute z-10 flex h-12 w-12 touch-manipulation items-center justify-center rounded-full bg-white/95 text-stone-900 shadow-xl ring-2 ring-amber-950/15 transition hover:bg-amber-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 left-[max(0.5rem,env(safe-area-inset-left))] top-1/2 -translate-y-1/2 sm:left-6 sm:h-12 sm:w-12" aria-label="{{ __('Previous image') }}">
                <x-storefront-icon name="chevron-right" class="h-6 w-6 rotate-180" />
            </button>
            <button type="button" id="product-lightbox-next" class="absolute z-10 flex h-12 w-12 touch-manipulation items-center justify-center rounded-full bg-white/95 text-stone-900 shadow-xl ring-2 ring-amber-950/15 transition hover:bg-amber-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 right-[max(0.5rem,env(safe-area-inset-right))] top-1/2 -translate-y-1/2 sm:right-6 sm:h-12 sm:w-12" aria-label="{{ __('Next image') }}">
                <x-storefront-icon name="chevron-right" class="h-6 w-6" />
            </button>
        @endif
        <div class="relative z-[1] max-h-[90vh] max-w-[min(100%,1200px)] w-full px-12 sm:px-16">
            <p id="lightbox-title" class="sr-only">{{ __('Product image') }}</p>
            <img id="product-lightbox-img" src="" alt="" class="mx-auto max-h-[85vh] w-auto max-w-full rounded-2xl object-contain shadow-2xl ring-1 ring-white/10">
        </div>
    </div>

    @push('scripts')
        <script>
            (function () {
                var lb = document.getElementById('product-lightbox');
                var lbImg = document.getElementById('product-lightbox-img');
                var lbClose = document.getElementById('product-lightbox-close');
                var lbBackdrop = document.getElementById('product-lightbox-backdrop');
                var lbPrev = document.getElementById('product-lightbox-prev');
                var lbNext = document.getElementById('product-lightbox-next');
                var mainImg = document.getElementById('product-main-image');
                if (!lb || !lbImg || !lbClose) return;

                var gallery = [];
                try {
                    gallery = JSON.parse(lb.getAttribute('data-gallery') || '[]');
                } catch (e) {
                    gallery = [];
                }
                var lbIndex = 0;

                function syncIndexFromSrc(src) {
                    var i = gallery.indexOf(src);
                    lbIndex = i >= 0 ? i : 0;
                }

                function openLightbox(src, alt) {
                    syncIndexFromSrc(src);
                    if (gallery.length && !gallery[lbIndex]) lbIndex = 0;
                    var show = gallery.length ? gallery[lbIndex] : src;
                    lbImg.src = show;
                    lbImg.alt = alt || '';
                    lb.classList.remove('hidden');
                    lb.classList.add('flex');
                    document.body.classList.add('lightbox-open');
                }

                function lightboxStep(delta) {
                    if (gallery.length < 2) return;
                    lbIndex = (lbIndex + delta + gallery.length) % gallery.length;
                    lbImg.src = gallery[lbIndex];
                }

                function closeLightbox() {
                    lb.classList.add('hidden');
                    lb.classList.remove('flex');
                    lbImg.src = '';
                    document.body.classList.remove('lightbox-open');
                }

                document.querySelectorAll('.js-lightbox-trigger').forEach(function (el) {
                    el.addEventListener('click', function () {
                        openLightbox(el.getAttribute('data-src'), el.getAttribute('data-alt'));
                    });
                });

                document.querySelectorAll('.product-thumb').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var src = btn.getAttribute('data-full-src');
                        var alt = btn.getAttribute('data-alt') || '';
                        if (mainImg && src) mainImg.src = src;
                        document.querySelectorAll('.product-thumb').forEach(function (b) {
                            b.classList.remove('border-amber-700', 'ring-2', 'ring-amber-600/30');
                            b.classList.add('border-transparent', 'ring-1', 'ring-amber-950/15');
                        });
                        btn.classList.add('border-amber-700', 'ring-2', 'ring-amber-600/30');
                        btn.classList.remove('border-transparent', 'ring-1', 'ring-amber-950/15');
                    });
                    btn.addEventListener('dblclick', function () {
                        var src = btn.getAttribute('data-full-src');
                        var alt = btn.getAttribute('data-alt') || '';
                        if (src) openLightbox(src, alt);
                    });
                });

                lbClose.addEventListener('click', closeLightbox);
                if (lbBackdrop) lbBackdrop.addEventListener('click', closeLightbox);
                if (lbPrev) lbPrev.addEventListener('click', function (e) { e.stopPropagation(); lightboxStep(-1); });
                if (lbNext) lbNext.addEventListener('click', function (e) { e.stopPropagation(); lightboxStep(1); });

                document.addEventListener('keydown', function (e) {
                    if (!lb.classList.contains('hidden')) {
                        if (e.key === 'Escape') closeLightbox();
                        if (e.key === 'ArrowLeft') lightboxStep(-1);
                        if (e.key === 'ArrowRight') lightboxStep(1);
                    }
                });
            })();
        </script>
    @endpush
@endsection
