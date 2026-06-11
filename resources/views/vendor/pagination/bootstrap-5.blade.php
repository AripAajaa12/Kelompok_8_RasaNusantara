@if ($paginator->hasPages())
<nav style="display:flex;justify-content:center;gap:6px;margin-top:24px;flex-wrap:wrap;">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">‹</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;">‹</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream-semi);font-size:13px;">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid #c9a84c;color:#c9a84c;font-size:13px;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;">›</a>
    @else
        <span style="padding:7px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">›</span>
    @endif
</nav>
@endif
