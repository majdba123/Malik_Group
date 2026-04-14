@extends('layouts.admin')

@section('title', __('Categories'))
@section('heading', __('Categories'))
@section('subheading', __('Name, cover image, and description'))

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <p class="text-sm text-slate-600">{{ __('Organize products into clear groups.') }}</p>
        <a href="{{ route('dashboard.categories.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-violet-600/20 hover:from-violet-500 hover:to-indigo-500 transition">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            {{ __('Add category') }}
        </a>
    </div>

    <div class="rounded-2xl border border-slate-200/80 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Image') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Name') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 hidden md:table-cell">{{ __('Description') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($category->image_path)
                                    <img src="{{ asset('storage/'.$category->image_path) }}" alt="" class="h-14 w-14 rounded-xl object-cover ring-2 ring-slate-100 shadow-sm">
                                @else
                                    <div class="h-14 w-14 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-xs">{{ __('None') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $category->name }}</p>
                                <p class="text-xs text-slate-500 md:hidden mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($category->description ?? '', 80) }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 hidden md:table-cell max-w-md">
                                <span class="line-clamp-2">{{ $category->description ?: '—' }}</span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <a href="{{ route('dashboard.categories.edit', $category) }}" class="text-sm font-semibold text-violet-600 hover:text-violet-500 mr-4">{{ __('Edit') }}</a>
                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm(@json(__('Delete this category?')));">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-500">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-slate-500">
                                <p class="font-medium text-slate-700">{{ __('No categories yet') }}</p>
                                <p class="text-sm mt-1">{{ __('Create your first category to attach products.') }}</p>
                                <a href="{{ route('dashboard.categories.create') }}" class="mt-4 inline-flex text-sm font-semibold text-violet-600">{{ __('Add category') }} →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
