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
    <label for="price" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Price') }} <span class="text-red-500">*</span></label>
    <input type="number" name="price" id="price" required min="0" step="0.01" value="{{ old('price', $product?->price ?? '0.00') }}"
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition tabular-nums">
    <p class="mt-1 text-xs text-slate-500">{{ __('Displayed on the public site as :currency', ['currency' => config('app.currency')]) }}</p>
    @error('price')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Status') }} <span class="text-red-500">*</span></label>
    <select name="status" id="status" required
        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition bg-white">
        <option value="{{ \App\Models\Product::STATUS_PENDING }}" @selected(old('status', $product->status ?? \App\Models\Product::STATUS_PENDING) === \App\Models\Product::STATUS_PENDING)>{{ __('Pending') }}</option>
        <option value="{{ \App\Models\Product::STATUS_ACTIVE }}" @selected(old('status', $product->status ?? '') === \App\Models\Product::STATUS_ACTIVE)>{{ __('Active') }}</option>
    </select>
    @error('status')
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
    <label class="block text-sm font-medium text-slate-700 mb-1.5">
        @if ($product)
            {{ __('Add more images') }} <span class="text-slate-400 font-normal">({{ __('optional') }})</span>
        @else
            {{ __('Images') }} <span class="text-red-500">*</span>
        @endif
    </label>
    <div id="product-images-dropzone-wrap" class="relative min-h-[11rem] rounded-2xl border-2 border-dashed border-slate-300 bg-gradient-to-b from-slate-50 to-white transition hover:border-violet-400 hover:from-violet-50/40 hover:to-white focus-within:border-violet-500 focus-within:ring-2 focus-within:ring-violet-500/20">
        <input type="file" name="images[]" id="product-images-input" accept="image/*,image/jpeg,image/png,image/gif,image/webp" {{ $product ? '' : 'required' }} multiple
            class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0">
        <div class="pointer-events-none flex min-h-[11rem] flex-col items-center justify-center gap-2 px-6 py-8 text-center">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </span>
            <p class="text-sm font-semibold text-slate-800">{{ __('Drop images here or click to browse') }}</p>
            <p class="text-xs text-slate-500 max-w-sm">{{ __('Add up to :n images at once (up to :total per product). Use Ctrl+click (Windows) or Cmd+click (Mac) to select several. JPEG, PNG, WebP, GIF — max 4 MB each.', ['n' => \App\Models\Product::MAX_IMAGES_PER_UPLOAD, 'total' => \App\Models\Product::MAX_IMAGES]) }}</p>
        </div>
    </div>
    <div id="product-images-file-hint" class="mt-2 hidden rounded-xl border border-emerald-200/80 bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-900"></div>
    @error('images')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            (function () {
                var wrap = document.getElementById('product-images-dropzone-wrap');
                var input = document.getElementById('product-images-input');
                var hint = document.getElementById('product-images-file-hint');
                if (!wrap || !input) return;

                function updateHint() {
                    if (!hint) return;
                    var n = input.files ? input.files.length : 0;
                    if (n === 0) {
                        hint.classList.add('hidden');
                        return;
                    }
                    hint.classList.remove('hidden');
                    hint.textContent = @json(__('Selected images')) + ': ' + n;
                }

                input.addEventListener('change', updateHint);

                ['dragenter', 'dragover'].forEach(function (ev) {
                    wrap.addEventListener(ev, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        wrap.classList.add('border-violet-500', 'bg-violet-50/50');
                    });
                });
                ['dragleave', 'drop'].forEach(function (ev) {
                    wrap.addEventListener(ev, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        wrap.classList.remove('border-violet-500', 'bg-violet-50/50');
                    });
                });
                wrap.addEventListener('drop', function (e) {
                    var dropped = e.dataTransfer && e.dataTransfer.files ? e.dataTransfer.files : null;
                    if (!dropped || dropped.length === 0) return;
                    var dt = new DataTransfer();
                    if (input.files && input.files.length) {
                        for (var i = 0; i < input.files.length; i++) dt.items.add(input.files[i]);
                    }
                    for (var j = 0; j < dropped.length; j++) {
                        if (dropped[j].type.indexOf('image/') === 0) dt.items.add(dropped[j]);
                    }
                    input.files = dt.files;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    updateHint();
                });
            })();
        </script>
    @endpush
@endonce

<div class="flex items-center gap-3 pt-2">
    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-violet-500 hover:to-indigo-500 transition">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('dashboard.products.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
</div>
