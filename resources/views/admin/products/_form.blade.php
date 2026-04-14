<div>
    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Category') }} <span class="text-red-500">*</span></label>
    <select name="category_id" id="category_id" required
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition bg-white">
        <option value="">{{ __('Select category') }}</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Name') }} <span class="text-red-500">*</span></label>
    <input type="text" name="name" id="name" required value="{{ old('name', $product->name ?? '') }}"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
    @error('name')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Description') }}</label>
    <textarea name="description" id="description" rows="4"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="phone_number" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Phone number') }} <span class="text-red-500">*</span></label>
    <input type="text" name="phone_number" id="phone_number" required value="{{ old('phone_number', $product->phone_number ?? '') }}" placeholder="+1 555 0100"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition font-mono">
    @error('phone_number')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@if ($product && $product->images->isNotEmpty())
    <div>
        <p class="block text-sm font-medium text-slate-700 mb-2">{{ __('Current images') }}</p>
        <p class="text-xs text-slate-500 mb-3">{{ __('Check images to remove. You must keep at least one unless you upload replacements.') }}</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach ($product->images as $img)
                <label class="group relative rounded-xl border border-slate-200 overflow-hidden cursor-pointer hover:border-red-300 transition">
                    <img src="{{ asset('storage/'.$img->path) }}" alt="" class="aspect-square w-full object-cover">
                    <span class="absolute inset-x-0 bottom-0 bg-slate-900/70 px-2 py-1.5 text-[10px] text-white flex items-center gap-2">
                        <input type="checkbox" name="remove_image_ids[]" value="{{ $img->id }}" class="rounded border-slate-400 text-red-600 focus:ring-red-500">
                        {{ __('Remove') }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>
@endif

<div>
    <label for="images" class="block text-sm font-medium text-slate-700 mb-1.5">
        @if ($product)
            {{ __('Add more images') }} <span class="text-slate-400 font-normal">({{ __('optional') }})</span>
        @else
            {{ __('Images') }} <span class="text-red-500">*</span>
        @endif
    </label>
    <input type="file" name="images[]" id="images" accept="image/*" {{ $product ? '' : 'required' }} multiple
        class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-violet-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-violet-700 hover:file:bg-violet-100 cursor-pointer">
    @error('images')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3 pt-2">
    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-violet-500 hover:to-indigo-500 transition">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('dashboard.products.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
</div>
