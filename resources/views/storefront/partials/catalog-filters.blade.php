@props([
    'formAction',
    'categories' => null,
    'lockedCategory' => null,
    'clearUrl',
])

@php
    if ($lockedCategory) {
        $hasFilters = request()->filled('q') || request()->filled('min_price') || request()->filled('max_price');
    } else {
        $hasFilters = request()->filled('category_id') || request()->filled('q') || request()->filled('min_price') || request()->filled('max_price');
    }
    $searchColClass = ($categories && ! $lockedCategory) ? 'lg:col-span-3' : 'lg:col-span-4';
@endphp

<form method="GET" action="{{ $formAction }}" class="rounded-3xl border border-amber-950/12 bg-[#fdfbf7]/95 p-4 shadow-[0_20px_50px_-36px_rgba(28,25,23,0.45)] backdrop-blur-sm sm:p-7">
    <div class="mb-4 flex flex-col gap-3 sm:mb-5 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-2.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-900 sm:h-10 sm:w-10" aria-hidden="true">
                <x-storefront-icon name="funnel" class="h-5 w-5" />
            </span>
            <h2 class="font-display text-lg font-semibold text-stone-900 sm:text-xl">{{ __('Find the right piece') }}</h2>
        </div>
        @if ($hasFilters)
            <a href="{{ $clearUrl }}" class="inline-flex w-fit items-center gap-1.5 text-sm font-semibold text-amber-900 underline-offset-4 transition hover:text-amber-950 hover:underline touch-manipulation min-h-11 py-2">
                <x-storefront-icon name="x-mark" class="h-4 w-4" />
                {{ __('Clear all filters') }}
            </a>
        @endif
    </div>
    <div class="grid grid-cols-1 gap-4 min-[480px]:grid-cols-2 lg:grid-cols-12 lg:items-end">
        @if ($categories && ! $lockedCategory)
            <div class="min-[480px]:col-span-2 lg:col-span-3">
                <label for="catalog_category_id" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-stone-500">{{ __('Category') }}</label>
                <select name="category_id" id="catalog_category_id"
                    class="min-h-11 w-full touch-manipulation rounded-2xl border border-amber-950/15 bg-white px-3 py-2.5 text-sm font-medium text-stone-900 shadow-inner shadow-stone-900/5 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-600/25">
                    <option value="">{{ __('All categories') }}</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected((string) request('category_id') === (string) $cat->id)>{{ $cat->name }} ({{ $cat->products_count }})</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="{{ $searchColClass }} min-[480px]:col-span-2">
            <label for="catalog_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-stone-500">{{ __('Search by name') }}</label>
            <div class="relative">
                <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-stone-400" aria-hidden="true">
                    <x-storefront-icon name="magnifying-glass" class="h-5 w-5" />
                </span>
                <input type="search" name="q" id="catalog_q" value="{{ request('q') }}" placeholder="{{ __('Product name…') }}"
                    class="min-h-11 w-full touch-manipulation rounded-2xl border border-amber-950/15 bg-white py-2.5 pl-10 pr-3 text-sm shadow-inner shadow-stone-900/5 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-600/25">
            </div>
        </div>
        <div class="lg:col-span-2">
            <label for="min_price" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-stone-500">{{ __('Min price') }}</label>
            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0" min="0" step="0.01"
                class="min-h-11 w-full touch-manipulation rounded-2xl border border-amber-950/15 bg-white px-3 py-2.5 text-sm tabular-nums shadow-inner shadow-stone-900/5 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-600/25">
        </div>
        <div class="lg:col-span-2">
            <label for="max_price" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-stone-500">{{ __('Max price') }}</label>
            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" min="0" step="0.01"
                class="min-h-11 w-full touch-manipulation rounded-2xl border border-amber-950/15 bg-white px-3 py-2.5 text-sm tabular-nums shadow-inner shadow-stone-900/5 outline-none transition focus:border-amber-700 focus:ring-2 focus:ring-amber-600/25">
        </div>
        <div class="min-[480px]:col-span-2 {{ $lockedCategory ? 'lg:col-span-4' : 'lg:col-span-2' }} flex">
            <button type="submit" class="inline-flex min-h-12 w-full touch-manipulation items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-amber-700 to-amber-800 px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-amber-950/20 transition hover:from-amber-600 hover:to-amber-700">
                <x-storefront-icon name="funnel" class="h-5 w-5 text-white/95" />
                {{ __('Apply') }}
            </button>
        </div>
    </div>
</form>
