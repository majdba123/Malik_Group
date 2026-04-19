@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="admin-pagination">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="order-2 text-center text-xs text-slate-600 sm:order-1 sm:text-left sm:text-sm">
                @if ($paginator->firstItem())
                    <span class="tabular-nums font-medium text-slate-800">{{ $paginator->firstItem() }}</span>–<span class="tabular-nums font-medium text-slate-800">{{ $paginator->lastItem() }}</span>
                    {{ __('of') }}
                    <span class="tabular-nums font-semibold text-slate-900">{{ $paginator->total() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                <span class="text-slate-500">{{ __('results') }}</span>
                <span class="mt-1 block text-slate-500 sm:mt-0 sm:ml-1 sm:inline">({{ __('Page :current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }})</span>
            </p>

            <div class="order-1 flex w-full items-center justify-between gap-2 sm:order-2 sm:w-auto sm:justify-end">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex min-h-11 min-w-11 flex-1 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-400 sm:flex-none sm:px-3">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="inline-flex min-h-11 min-w-11 flex-1 touch-manipulation items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 sm:flex-none">
                        {!! __('pagination.previous') !!}
                    </a>
                @endif
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="inline-flex min-h-11 min-w-11 flex-1 touch-manipulation items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-violet-300 hover:bg-violet-50 hover:text-violet-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-500 sm:flex-none">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span class="inline-flex min-h-11 min-w-11 flex-1 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-400 sm:flex-none sm:px-3">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </div>
        </div>

        <div class="mt-4 hidden min-w-0 justify-center sm:flex md:justify-end">
            <span class="inline-flex max-w-full flex-wrap justify-center gap-1 rounded-2xl border border-slate-200 bg-white p-1 shadow-sm">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg text-slate-300" aria-hidden="true">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100" aria-label="{{ __('pagination.previous') }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex min-h-10 items-center px-2 text-sm font-medium text-slate-500">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg bg-violet-600 px-2 text-sm font-bold text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg px-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100" aria-label="{{ __('pagination.next') }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @else
                    <span class="inline-flex min-h-10 min-w-10 items-center justify-center rounded-lg text-slate-300" aria-hidden="true">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif
