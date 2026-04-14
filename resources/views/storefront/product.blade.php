@extends('layouts.storefront')

@section('title', $product->name.' — '.config('app.name'))

@section('content')
    @php
        $images = $product->images;
        $main = $images->first();
        $telHref = preg_replace('/[^0-9+]/', '', $product->phone_number);
    @endphp

    <article class="relative overflow-hidden border-b border-zinc-200/90 bg-white">
        <div class="absolute inset-0 bg-gradient-to-b from-violet-50/80 via-transparent to-transparent pointer-events-none h-48 sm:h-56"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
            <nav class="flex flex-wrap items-center gap-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-3 py-1 font-semibold text-zinc-600 transition hover:bg-violet-100 hover:text-violet-800">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    {{ __('Home') }}
                </a>
                <span class="text-zinc-300" aria-hidden="true">/</span>
                <a href="{{ route('storefront.category', $product->category) }}" class="rounded-full bg-zinc-100 px-3 py-1 font-semibold text-zinc-600 transition hover:bg-violet-100 hover:text-violet-800">{{ $product->category->name }}</a>
                <span class="text-zinc-300" aria-hidden="true">/</span>
                <span class="max-w-[200px] truncate rounded-full bg-zinc-900 px-3 py-1 text-xs font-bold text-white sm:max-w-md">{{ $product->name }}</span>
            </nav>
        </div>
    </article>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-14">
        <div class="grid gap-10 lg:grid-cols-12 lg:gap-12 xl:gap-16 items-start">
            {{-- Gallery --}}
            <div class="lg:col-span-7 space-y-5 lg:sticky lg:top-24">
                @if ($main)
                    <button type="button"
                        class="js-lightbox-trigger group relative w-full overflow-hidden rounded-3xl border border-zinc-200/90 bg-zinc-100 shadow-xl shadow-zinc-200/50 ring-1 ring-black/5 transition hover:ring-violet-300/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 focus-visible:ring-offset-2"
                        data-src="{{ asset('storage/'.$main->path) }}"
                        data-alt="{{ $product->name }}">
                        <span class="block aspect-square sm:aspect-[5/4]">
                            <img id="product-main-image" src="{{ asset('storage/'.$main->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]">
                        </span>
                        <span class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60 sm:opacity-100"></span>
                        <span class="pointer-events-none absolute bottom-4 right-4 inline-flex items-center gap-2 rounded-full bg-white/95 px-4 py-2 text-xs font-bold text-zinc-900 shadow-lg backdrop-blur-sm sm:opacity-0 sm:group-hover:opacity-100 sm:transition sm:duration-300">
                            <svg class="h-4 w-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            {{ __('Full screen') }}
                        </span>
                    </button>
                    @if ($images->count() > 1)
                        <div class="grid grid-cols-4 gap-2 sm:grid-cols-5 sm:gap-3">
                            @foreach ($images as $img)
                                <button type="button"
                                    class="product-thumb group relative aspect-square overflow-hidden rounded-2xl border-2 bg-zinc-100 shadow-sm transition hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 {{ $loop->first ? 'border-violet-600 ring-2 ring-violet-500/30' : 'border-transparent ring-1 ring-zinc-200/80' }}"
                                    data-full-src="{{ asset('storage/'.$img->path) }}"
                                    data-alt="{{ $product->name }}"
                                    aria-label="{{ __('Photo :n', ['n' => $loop->iteration]) }}">
                                    <img src="{{ asset('storage/'.$img->path) }}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="flex aspect-square items-center justify-center rounded-3xl border-2 border-dashed border-zinc-300 bg-zinc-50 text-zinc-500">{{ __('No images') }}</div>
                @endif
            </div>

            {{-- Details --}}
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full bg-violet-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-violet-800">{{ $product->category->name }}</p>
                    <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-zinc-900 sm:text-4xl lg:text-[2.5rem] lg:leading-tight">{{ $product->name }}</h1>
                    <div class="mt-6 flex flex-wrap items-baseline gap-2 border-b border-zinc-200/90 pb-6">
                        <span class="text-4xl font-black tabular-nums tracking-tight text-zinc-900 sm:text-5xl">{{ number_format((float) $product->price, 2) }}</span>
                        <span class="text-lg font-bold text-zinc-500">{{ config('app.currency') }}</span>
                    </div>
                </div>

                @if ($product->description)
                    <div class="rounded-3xl border border-zinc-200/90 bg-gradient-to-br from-white to-zinc-50/80 p-6 shadow-sm sm:p-8">
                        <h2 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-zinc-500">
                            <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-zinc-900 text-white">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            </span>
                            {{ __('About this product') }}
                        </h2>
                        <div class="mt-4 text-base leading-relaxed text-zinc-700 whitespace-pre-wrap">{{ $product->description }}</div>
                    </div>
                @endif

                <div class="space-y-3">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-500">{{ __('Actions') }}</p>
                    <div class="grid gap-3 sm:grid-cols-1">
                        <a href="tel:{{ $telHref }}"
                            class="group flex items-center gap-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-5 py-4 text-white shadow-lg shadow-emerald-600/25 transition hover:from-emerald-500 hover:to-teal-500 hover:shadow-xl">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/20 ring-2 ring-white/30 transition group-hover:scale-105">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </span>
                            <span class="min-w-0 flex-1 text-left">
                                <span class="block text-xs font-semibold uppercase tracking-wide text-emerald-100/90">{{ __('Call now') }}</span>
                                <span class="block truncate text-lg font-bold font-mono tracking-wide">{{ $product->phone_number }}</span>
                            </span>
                            <svg class="h-5 w-5 shrink-0 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('storefront.category', $product->category) }}"
                            class="flex items-center gap-4 rounded-2xl border-2 border-zinc-200 bg-white px-5 py-4 font-bold text-zinc-800 shadow-sm transition hover:border-violet-200 hover:bg-violet-50/50">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </span>
                            <span class="flex-1 text-left text-base">{{ __('View more in :category', ['category' => $product->category->name]) }}</span>
                            <svg class="h-5 w-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox --}}
    <div id="product-lightbox" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-4 sm:p-8" role="dialog" aria-modal="true" aria-labelledby="lightbox-title">
        <div id="product-lightbox-backdrop" class="absolute inset-0 bg-zinc-950/90 backdrop-blur-md transition-opacity"></div>
        <button type="button" id="product-lightbox-close" class="absolute right-3 top-3 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-white text-zinc-900 shadow-xl ring-2 ring-zinc-200/80 transition hover:bg-zinc-100 hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 sm:right-6 sm:top-6 sm:h-12 sm:w-12" aria-label="{{ __('Close image') }}">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="relative z-[1] max-h-[90vh] max-w-[min(100%,1200px)] w-full">
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
                var mainImg = document.getElementById('product-main-image');
                if (!lb || !lbImg || !lbClose) return;

                function openLightbox(src, alt) {
                    lbImg.src = src;
                    lbImg.alt = alt || '';
                    lb.classList.remove('hidden');
                    lb.classList.add('flex');
                    document.body.classList.add('lightbox-open');
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
                            b.classList.remove('border-violet-600', 'ring-2', 'ring-violet-500/30');
                            b.classList.add('border-transparent', 'ring-1', 'ring-zinc-200/80');
                        });
                        btn.classList.add('border-violet-600', 'ring-2', 'ring-violet-500/30');
                        btn.classList.remove('border-transparent', 'ring-1', 'ring-zinc-200/80');
                    });
                    btn.addEventListener('dblclick', function () {
                        var src = btn.getAttribute('data-full-src');
                        var alt = btn.getAttribute('data-alt') || '';
                        if (src) openLightbox(src, alt);
                    });
                });

                lbClose.addEventListener('click', closeLightbox);
                if (lbBackdrop) lbBackdrop.addEventListener('click', closeLightbox);
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !lb.classList.contains('hidden')) closeLightbox();
                });
            })();
        </script>
    @endpush
@endsection
