@php    $img = $product->images->first();
@endphp
<article class="group flex flex-col h-full rounded-2xl border border-zinc-200/90 bg-white shadow-sm overflow-hidden hover:shadow-lg hover:border-violet-200/90 hover:-translate-y-0.5 transition duration-300">
    <a href="{{ route('storefront.product', $product) }}" class="relative aspect-[4/3] overflow-hidden bg-zinc-100 shrink-0">
        @if ($img)
            <img src="{{ asset('storage/'.$img->path) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition duration-500 ease-out">
        @else
            <div class="flex h-full min-h-[10rem] items-center justify-center text-zinc-400 text-sm font-medium">{{ __('No image') }}</div>
        @endif
    </a>
    <div class="flex flex-1 flex-col p-4 sm:p-5">
        <p class="text-[11px] font-bold text-violet-600 uppercase tracking-wider">{{ $product->category->name }}</p>
        <h3 class="mt-1.5 text-base font-bold text-zinc-900 leading-snug line-clamp-2">
            <a href="{{ route('storefront.product', $product) }}" class="hover:text-violet-600 transition">{{ $product->name }}</a>
        </h3>
        <p class="mt-3 text-xl font-extrabold tabular-nums text-zinc-900 tracking-tight">
            {{ number_format((float) $product->price, 2) }}
            <span class="text-sm font-semibold text-zinc-500">{{ config('app.currency') }}</span>
        </p>
        <a href="{{ route('storefront.product', $product) }}" class="mt-4 inline-flex items-center justify-center rounded-xl bg-zinc-900 py-2.5 text-sm font-semibold text-white hover:bg-zinc-800 transition sm:mt-auto">
            {{ __('View details') }}
        </a>
    </div>
</article>
