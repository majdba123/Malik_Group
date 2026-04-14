@extends('layouts.admin')

@section('title', __('New product'))
@section('heading', __('New product'))
@section('subheading', __('Photos, details, and category'))

@section('content')
    @if ($categories->isEmpty())
        <div class="rounded-2xl border border-amber-200 bg-amber-50 px-6 py-4 text-amber-900 text-sm mb-8">
            {{ __('You need at least one category before adding products.') }}
            <a href="{{ route('dashboard.categories.create') }}" class="font-semibold underline ml-1">{{ __('Create a category') }}</a>
        </div>
    @endif

    <div class="max-w-2xl">
        <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-sm space-y-6 {{ $categories->isEmpty() ? 'opacity-50 pointer-events-none' : '' }}">
            @csrf
            @include('admin.products._form', [
                'product' => null,
                'categories' => $categories,
                'submitLabel' => __('Create product'),
            ])
        </form>
    </div>
@endsection
