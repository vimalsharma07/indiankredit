@php
    $offeringRoutes = collect(config('site.menu'))->flatMap(fn ($group) => collect($group['links'])->pluck('route'))->all();
    $companyRoutes = collect(config('site.company'))->pluck('route')->all();
@endphp
<header class="site-header">
    <div class="nav-wrap">
        <div class="container">
            <nav class="site-nav navbar navbar-expand-lg" aria-label="Primary">
                <div class="nav-bar">
                    @include('partials.brand')
                    <button class="nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#site-nav" aria-controls="site-nav" aria-expanded="false" aria-label="Open menu">
                        <span></span>
                        <span></span>
                    </button>
                    <div class="collapse navbar-collapse" id="site-nav">
                        <ul class="nav-cluster">
                            <li class="dropdown mega-drop">
                                <a class="nav-pill {{ request()->routeIs($offeringRoutes) ? 'is-active' : '' }}" href="#" id="offerings-menu" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    Offerings <i class="bi bi-chevron-down caret"></i>
                                </a>
                                <div class="dropdown-menu mega" aria-labelledby="offerings-menu">
                                    <div class="mega-panel">
                                        <div class="row g-2">
                                            @foreach (config('site.menu') as $group)
                                                <div class="col-6 col-lg-3 mega-col">
                                                    <p class="mega-title">{{ $group['title'] }}</p>
                                                    @foreach ($group['links'] as $link)
                                                        <a class="mega-link" href="{{ route($link['route']) }}">
                                                            <span class="mega-icon"><i class="bi {{ $link['icon'] }}"></i></span>
                                                            <span>
                                                                <strong>{{ $link['label'] }}</strong>
                                                                <small>{{ $link['text'] }}</small>
                                                            </span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="mega-foot" href="{{ route('calculators') }}">
                                            <span class="mega-icon"><i class="bi bi-calculator"></i></span>
                                            <span>
                                                <strong>Calculators</strong>
                                                <small>EMI, SIP, and fixed deposits</small>
                                            </span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="nav-pill {{ request()->routeIs('blog', 'blog.show') ? 'is-active' : '' }}" href="{{ route('blog') }}" @if (request()->routeIs('blog', 'blog.show')) aria-current="page" @endif>Blogs</a>
                            </li>
                            <li class="dropdown">
                                <a class="nav-pill {{ request()->routeIs($companyRoutes) ? 'is-active' : '' }}" href="#" id="company-menu" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    Company <i class="bi bi-chevron-down caret"></i>
                                </a>
                                <ul class="dropdown-menu company-menu" aria-labelledby="company-menu">
                                    @foreach (config('site.company') as $link)
                                        <li>
                                            <a class="dropdown-item" href="{{ route($link['route']) }}">
                                                <i class="bi {{ $link['icon'] }}"></i>
                                                {{ $link['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="nav-actions">
                            <a class="repay-link" href="{{ route('repayment') }}">
                                <i class="bi bi-credit-card"></i>
                                Repay
                            </a>
                            @auth
                                <a class="repay-link" href="{{ route('profile.setup') }}">Account</a>
                                <form class="nav-logout" method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="repay-link" type="submit">Log out</button>
                                </form>
                            @else
                                <a class="repay-link" href="{{ route('login') }}">Log in</a>
                            @endauth
                            <a class="btn btn-yellow nav-apply" href="{{ route('apply') }}">
                                Apply Now <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
