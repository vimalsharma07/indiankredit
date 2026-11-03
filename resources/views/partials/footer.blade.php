<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                @include('partials.brand', ['compact' => true, 'class' => 'text-white mb-3'])
                <p class="mt-3 mb-2">{{ config('site.tagline') }}</p>
                <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
            </div>
            @foreach (config('site.menu') as $group)
                <div class="col-6 col-lg-2">
                    <h2>{{ $group['title'] }}</h2>
                    <ul>
                        @foreach ($group['links'] as $link)
                            <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="row g-4 mt-2">
            <div class="col-6 col-lg-3">
                <h2>Calculators</h2>
                <ul>
                    @foreach (config('site.calculators') as $slug => $calculator)
                        <li><a href="{{ route('calculators.show', $slug) }}">{{ $calculator['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h2>Company</h2>
                <ul>
                    @foreach (config('site.company') as $link)
                        <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                    @endforeach
                    <li><a href="{{ route('blog') }}">Blogs</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h2>Legal</h2>
                <ul>
                    @foreach (config('site.legal_links') as $link)
                        <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-base">
            <p class="mb-0">© {{ date('Y') }} {{ config('site.name') }}. Frontend preview for layout and pages.</p>
            <p class="mb-0">Not a loan offer, insurance contract, or investment advice. Partner names and live rates come later.</p>
        </div>
    </div>
</footer>
