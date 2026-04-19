@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="storefront-pagination">
        <div class="flex flex-col items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-center text-sm font-medium text-stone-700 sm:text-left">
                @if ($paginator->firstItem())
                    <span class="tabular-nums">{{ $paginator->firstItem() }}</span>
                    –
                    <span class="tabular-nums">{{ $paginator->lastItem() }}</span>
                    {{ __('of') }}
                    <span class="tabular-nums font-semibold text-stone-900">{{ $paginator->total() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                <span class="text-stone-500">{{ __('results') }}</span>
                <span class="mt-1 block text-xs tabular-nums text-stone-500 sm:mt-0 sm:ml-2 sm:inline">
                    ({{ __('Page :current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }})
                </span>
            </p>

            <div class="flex items-center justify-center gap-3 sm:justify-end">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex min-h-12 min-w-12 items-center justify-center rounded-2xl border border-amber-950/20 bg-stone-100/80 text-stone-400" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="inline-flex min-h-12 min-w-12 touch-manipulation items-center justify-center rounded-2xl border border-amber-950/20 bg-white text-stone-800 shadow-sm transition hover:border-amber-800/40 hover:bg-amber-50/50 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2"
                        aria-label="{{ __('pagination.previous') }}">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @endif

                <span class="min-w-[5.5rem] text-center text-sm font-bold tabular-nums text-stone-900" aria-current="page">
                    {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="inline-flex min-h-12 min-w-12 touch-manipulation items-center justify-center rounded-2xl border border-amber-950/20 bg-white text-stone-800 shadow-sm transition hover:border-amber-800/40 hover:bg-amber-50/50 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2"
                        aria-label="{{ __('pagination.next') }}">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @else
                    <span class="inline-flex min-h-12 min-w-12 items-center justify-center rounded-2xl border border-amber-950/20 bg-stone-100/80 text-stone-400" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
