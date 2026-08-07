@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex items-center justify-center gap-2 bg-zinc-950 border border-white/10 p-2 rounded-2xl shadow-lg">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 border border-white/5 text-zinc-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 border border-white/5 text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-zinc-500">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-indigo-600 text-white font-bold shadow-md shadow-indigo-500/20">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 border border-white/5 text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors font-semibold">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 border border-white/5 text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 border border-white/5 text-zinc-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
