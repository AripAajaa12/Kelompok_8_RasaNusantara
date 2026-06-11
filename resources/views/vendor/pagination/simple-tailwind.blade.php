@if ($paginator->hasPages())
<nav style="display:flex;justify-content:center;gap:8px;margin-top:32px;">
    @if ($paginator->onFirstPage())
        <span style="padding:8px 16px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">← Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:8px 16px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;transition:border-color .2s;" onmouseover="this.style.borderColor='#c9a84c'" onmouseout="this.style.borderColor='rgba(201,168,76,.15)'">← Prev</a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:8px 16px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;text-decoration:none;" onmouseover="this.style.borderColor='#c9a84c'" onmouseout="this.style.borderColor='rgba(201,168,76,.15)'">Next →</a>
    @else
        <span style="padding:8px 16px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:rgba(245,234,213,.3);font-size:13px;">Next →</span>
    @endif
</nav>
@endif
