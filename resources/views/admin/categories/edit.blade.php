@extends('layouts.admin')

@section('title', __('Edit category'))
@section('heading', __('Edit category'))
@section('subheading', $category->name)

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('dashboard.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            @csrf
            @method('PUT')
            @include('admin.categories._form', ['category' => $category, 'submitLabel' => __('Save changes')])
        </form>
    </div>
@endsection
