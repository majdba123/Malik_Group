@extends('layouts.admin')

@section('title', __('Dashboard'))
@section('heading', __('Dashboard'))
@section('subheading', __('Overview of your catalog'))

@section('content')
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-10">
        <div class="relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
            <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-violet-500/10 blur-2xl"></div>
            <p class="text-sm font-medium text-slate-500">{{ __('Categories') }}</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($categoryCount) }}</p>
            <a href="{{ route('dashboard.categories.index') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-violet-600 hover:text-violet-500">
                {{ __('Manage') }}
                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
            <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-indigo-500/10 blur-2xl"></div>
            <p class="text-sm font-medium text-slate-500">{{ __('Products') }}</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($productCount) }}</p>
            <a href="{{ route('dashboard.products.index') }}" class="mt-4 inline-flex items-center text-sm font-semibold text-violet-600 hover:text-violet-500">
                {{ __('Manage') }}
                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="sm:col-span-2 lg:col-span-1 rounded-2xl border border-dashed border-slate-300 bg-slate-50/80 p-6 flex flex-col justify-center">
            <p class="text-sm font-semibold text-slate-800">{{ __('Quick start') }}</p>
            <p class="mt-1 text-sm text-slate-600">{{ __('Create a category first, then add products with photos and contact details.') }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('dashboard.categories.create') }}" class="inline-flex items-center rounded-lg bg-slate-900 px-3 py-2 text-xs font-semibold text-white hover:bg-slate-800">{{ __('New category') }}</a>
                <a href="{{ route('dashboard.products.create') }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">{{ __('New product') }}</a>
                <a href="{{ route('dashboard.site-footer.edit') }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">{{ __('Site footer') }}</a>
            </div>
        </div>
    </div>
@endsection
