@extends('layouts.admin')

@section('title', __('Edit product'))
@section('heading', __('Edit product'))
@section('subheading', $product->name)

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('dashboard.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-sm space-y-6">
            @csrf
            @method('PUT')
            @include('admin.products._form', [
                'product' => $product,
                'categories' => $categories,
                'submitLabel' => __('Save changes'),
            ])
        </form>
    </div>
@endsection
