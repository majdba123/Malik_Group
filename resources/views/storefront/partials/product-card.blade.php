@php
    $imgs = $product->images;
    $first = $imgs->first();
    $imgCount = $imgs->count();
@endphp
<article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-amber-950/10 bg-[#fdfbf7]/95 shadow-[0_20px_50px_-32px_rgba(28,25,23,0.5)] backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:border-amber-800/20 hover:shadow-[0_28px_60px_-28px_rgba(120,53,15,0.28)]">
    <a href="{{ route('storefront.product', $product) }}" class="relative aspect-[16/11] shrink-0 overflow-hidden bg-stone-200 touch-manipulation min-[480px]:aspect-[4/3]">
        @if ($imgCount > 1)
            <div class="product-card-gallery flex h-full w-full snap-x snap-mandatory overflow-x-auto overscroll-x-contain [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                @foreach ($imgs as $img)
                    <img src="{{ asset('storage/'.$img->path) }}" alt="{{ $product->name }}" loading="lazy" class="h-full min-w-full flex-[0_0_100%] snap-center object-cover transition duration-700 ease-out group-hover:scale-[1.04]">
                @endforeach
            </div>
            <span class="pointer-events-none absolute bottom-2 left-2 inline-flex items-center rounded-full bg-stone-950/75 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-amber-50 shadow-md backdrop-blur-sm sm:bottom-3 sm:left-3 sm:px-2.5 sm:text-[11px]" aria-hidden="true">
                {{ $imgCount }} {{ $imgCount === 1 ? __('photo') : __('photos') }}
            </span>
        @elseif ($first)
            <img src="{{ asset('storage/'.$first->path) }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]">
        @else
            <div class="flex h-full min-h-[11rem] flex-col items-center justify-center gap-2 bg-gradient-to-br from-stone-100 to-amber-50 text-stone-400">
                <x-storefront-icon name="photo" class="h-10 w-10" />
                <span class="text-xs font-medium text-stone-500">{{ __('No image') }}</span>
            </div>
        @endif
        <span class="pointer-events-none absolute inset-0 bg-gradient-to-t from-stone-950/25 to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></span>
    </a>
    <div class="flex flex-1 flex-col p-4 sm:p-5">
        <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-amber-900/90">{{ $product->category->name }}</p>
        <h3 class="font-display mt-2 text-[1.125rem] font-semibold leading-snug text-stone-900 line-clamp-2 sm:text-lg">
            <a href="{{ route('storefront.product', $product) }}" class="transition hover:text-amber-900 touch-manipulation">{{ $product->name }}</a>
        </h3>
        <p class="mt-3 text-lg font-bold tabular-nums tracking-tight text-stone-900 sm:mt-4 sm:text-xl">
            {{ number_format((float) $product->price, 2) }}
            <span class="text-sm font-semibold text-stone-500">{{ config('app.currency') }}</span>
        </p>
        <a href="{{ route('storefront.product', $product) }}" class="mt-4 inline-flex min-h-12 touch-manipulation items-center justify-center gap-2 rounded-2xl bg-stone-900 px-4 py-3 text-sm font-semibold text-amber-50 shadow-md shadow-stone-900/20 transition hover:bg-amber-950 sm:mt-auto">
            {{ __('View details') }}
            <x-storefront-icon name="arrow-right" class="h-4 w-4 opacity-90" />
        </a>
    </div>
</article>
