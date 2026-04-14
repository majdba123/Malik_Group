@extends('layouts.admin')

@section('title', __('New category'))
@section('heading', __('New category'))
@section('subheading', __('Add a category with cover image'))

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            @csrf
            @include('admin.categories._form', ['category' => null, 'submitLabel' => __('Create category')])
        </form>
    </div>
@endsection
