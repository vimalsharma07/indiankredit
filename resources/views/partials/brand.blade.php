<a class="brand {{ $class ?? '' }}" href="{{ route('home') }}">
    <span class="brand-mark" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="22" height="22">
            <text x="16" y="21.5" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="13" font-weight="700" fill="#000080">IK</text>
        </svg>
    </span>
    <span class="brand-copy">
        <span class="brand-name"><span class="brand-saffron">In</span><span class="brand-white">di</span><span class="brand-green">an</span><span class="brand-kredit">Kredit</span></span>
        @unless (!empty($compact))
            <span class="brand-tag">Loans, gold, cover</span>
        @endunless
    </span>
</a>
