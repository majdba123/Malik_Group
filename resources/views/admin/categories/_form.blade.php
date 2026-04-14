<div>
    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Name') }} <span class="text-red-500">*</span></label>
    <input type="text" name="name" id="name" required value="{{ old('name', $category->name ?? '') }}"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
    @error('name')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Description') }}</label>
    <textarea name="description" id="description" rows="4"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="image" class="block text-sm font-medium text-slate-700 mb-1.5">
        {{ __('Image') }}
        @if (! $category)
            <span class="text-red-500">*</span>
        @else
            <span class="text-slate-400 font-normal">({{ __('optional — leave empty to keep current') }})</span>
        @endif
    </label>
    @if ($category && $category->image_path)
        <div class="mb-3 flex items-center gap-4">
            <img src="{{ asset('storage/'.$category->image_path) }}" alt="" class="h-20 w-20 rounded-xl object-cover ring-2 ring-slate-100">
            <p class="text-xs text-slate-500">{{ __('Current cover') }}</p>
        </div>
    @endif
    <input type="file" name="image" id="image" accept="image/*" {{ ! $category ? 'required' : '' }}
        class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-violet-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-violet-700 hover:file:bg-violet-100 cursor-pointer">
    @error('image')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3 pt-2">
    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-violet-500 hover:to-indigo-500 transition">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('dashboard.categories.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
</div>
