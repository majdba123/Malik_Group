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

<form method="GET" action="{{ $formAction }}" class="rounded-2xl border border-zinc-200/90 bg-white p-4 sm:p-6 shadow-sm">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-4">
        <h2 class="text-lg font-bold text-zinc-900">{{ __('Find products') }}</h2>
        @if ($hasFilters)
            <a href="{{ $clearUrl }}" class="text-sm font-semibold text-violet-600 hover:text-violet-500 w-fit">{{ __('Clear all filters') }}</a>
        @endif
    </div>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-12 lg:items-end">
        @if ($categories && ! $lockedCategory)
            <div class="lg:col-span-3">
                <label for="catalog_category_id" class="block text-xs font-bold uppercase tracking-wide text-zinc-500 mb-1.5">{{ __('Category') }}</label>
                <select name="category_id" id="catalog_category_id"
                    class="w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm font-medium text-zinc-900 shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                    <option value="">{{ __('All categories') }}</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected((string) request('category_id') === (string) $cat->id)>{{ $cat->name }} ({{ $cat->products_count }})</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="{{ $searchColClass }}">
            <label for="catalog_q" class="block text-xs font-bold uppercase tracking-wide text-zinc-500 mb-1.5">{{ __('Search by name') }}</label>
            <input type="search" name="q" id="catalog_q" value="{{ request('q') }}" placeholder="{{ __('Product name…') }}"
                class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
        </div>
        <div class="lg:col-span-2">
            <label for="min_price" class="block text-xs font-bold uppercase tracking-wide text-zinc-500 mb-1.5">{{ __('Min price') }}</label>
            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0" min="0" step="0.01"
                class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 text-sm tabular-nums shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
        </div>
        <div class="lg:col-span-2">
            <label for="max_price" class="block text-xs font-bold uppercase tracking-wide text-zinc-500 mb-1.5">{{ __('Max price') }}</label>
            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" min="0" step="0.01"
                class="w-full rounded-xl border border-zinc-300 px-3 py-2.5 text-sm tabular-nums shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
        </div>
        <div class="sm:col-span-2 {{ $lockedCategory ? 'lg:col-span-4' : 'lg:col-span-2' }} flex gap-2">
            <button type="submit" class="flex-1 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-4 py-2.5 text-sm font-bold text-white shadow-md shadow-violet-500/20 hover:from-violet-500 hover:to-indigo-500 transition">
                {{ __('Apply') }}
            </button>
        </div>
    </div>
</form>
