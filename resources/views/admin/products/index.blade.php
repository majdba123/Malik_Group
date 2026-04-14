@extends('layouts.admin')

@section('title', __('Products'))
@section('heading', __('Products'))
@section('subheading', __('Linked to categories with gallery and phone'))

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <p class="text-sm text-slate-600">{{ __('Each product belongs to one category.') }}</p>
        <a href="{{ route('dashboard.products.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-violet-600/20 hover:from-violet-500 hover:to-indigo-500 transition">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            {{ __('Add product') }}
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200/80 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Preview') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Product') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 hidden lg:table-cell">{{ __('Category') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 hidden md:table-cell">{{ __('Phone') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        @php $thumb = $product->images->first(); @endphp
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($thumb)
                                    <img src="{{ asset('storage/'.$thumb->path) }}" alt="" class="h-14 w-14 rounded-xl object-cover ring-2 ring-slate-100 shadow-sm">
                                @else
                                    <div class="h-14 w-14 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-xs">{{ __('—') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $product->images->count() }} {{ __('photos') }}</p>
                                <p class="text-xs text-slate-500 lg:hidden mt-1">{{ $product->category->name }} · {{ $product->phone_number }}</p>
                            </td>
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell text-sm text-slate-700 font-mono">{{ $product->phone_number }}</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <a href="{{ route('dashboard.products.edit', $product) }}" class="text-sm font-semibold text-violet-600 hover:text-violet-500 mr-4">{{ __('Edit') }}</a>
                                <form action="{{ route('dashboard.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm(@json(__('Delete this product and all images?')));">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-500">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-slate-500">
                                <p class="font-medium text-slate-700">{{ __('No products yet') }}</p>
                                <p class="text-sm mt-1">{{ __('Add at least one category, then create a product with images.') }}</p>
                                <a href="{{ route('dashboard.products.create') }}" class="mt-4 inline-flex text-sm font-semibold text-violet-600">{{ __('Add product') }} →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
