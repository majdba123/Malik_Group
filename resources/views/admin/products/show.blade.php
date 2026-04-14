@extends('layouts.admin')

@section('title', $product->name)
@section('heading', $product->name)
@section('subheading', __('Product details'))

@section('content')
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <a href="{{ route('dashboard.products.index', collect(request()->only(['category_id', 'status']))->filter()->all()) }}"
            class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900">
            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('Back to products') }}
        </a>
        <span class="text-slate-300">|</span>
        <a href="{{ route('dashboard.products.edit', $product) }}" class="inline-flex items-center rounded-lg bg-violet-600 px-3 py-1.5 text-sm font-semibold text-white hover:bg-violet-500 transition">{{ __('Edit') }}</a>
    </div>

    <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-4">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-4 sm:p-6 shadow-sm">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500 mb-4">{{ __('Gallery') }} ({{ $product->images->count() }})</h2>
                @if ($product->images->isEmpty())
                    <p class="text-sm text-slate-500 py-8 text-center">{{ __('No images uploaded.') }}</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach ($product->images as $img)
                            <a href="{{ asset('storage/'.$img->path) }}" target="_blank" rel="noopener noreferrer" class="group relative aspect-square overflow-hidden rounded-xl ring-2 ring-slate-100 hover:ring-violet-300 transition">
                                <img src="{{ asset('storage/'.$img->path) }}" alt="" class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-4">
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Status') }}</dt>
                        <dd class="mt-1">
                            @if ($product->isActive())
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">{{ __('Active') }}</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-900">{{ __('Pending') }}</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Price') }}</dt>
                        <dd class="mt-1 text-lg font-bold tabular-nums text-slate-900">{{ number_format((float) $product->price, 2) }} {{ config('app.currency') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Category') }}</dt>
                        <dd class="mt-1">
                            <a href="{{ route('dashboard.products.index', ['category_id' => $product->category_id]) }}" class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-800 hover:bg-slate-200 transition">{{ $product->category->name }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Phone') }}</dt>
                        <dd class="mt-1 text-lg font-mono font-semibold text-slate-900">{{ $product->phone_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ __('Description') }}</dt>
                        <dd class="mt-1 text-sm text-slate-700 whitespace-pre-wrap">{{ $product->description ?: '—' }}</dd>
                    </div>
                    <div class="pt-2 border-t border-slate-100 text-xs text-slate-400">
                        {{ __('Created') }} {{ $product->created_at->format('Y-m-d H:i') }}
                        · {{ __('Updated') }} {{ $product->updated_at->format('Y-m-d H:i') }}
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
