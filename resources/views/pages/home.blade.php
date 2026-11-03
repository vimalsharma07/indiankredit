@extends('layouts.site')

@section('description', config('site.description'))

@section('content')
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <p class="eyebrow">Financial super app</p>
                    <h1>Har zaroorat ke liye,<br><span class="mark">ek clear plan.</span></h1>
                    <p class="lead-copy">Instant loans up to ₹20,000, personal loans up to ₹5 lakh, digital gold from ₹10, and simple cover — paperless, in one place.</p>
                    <div class="hero-actions">
                        <a class="btn btn-yellow" href="{{ route('apply') }}">Apply Now</a>
                        <a class="btn btn-line" href="#solutions">See products</a>
                    </div>
                    <div class="pill-row">
                        <a href="{{ route('instant-loan') }}">Loans</a>
                        <a href="{{ route('digital-gold') }}">Invest</a>
                        <a href="{{ route('insurance') }}">Insure</a>
                    </div>
                    <div class="hero-facts">
                        <div><strong>Minutes</strong><span>A short application</span></div>
                        <div><strong>Paperless</strong><span>KYC on the phone</span></div>
                        <div><strong>One app</strong><span>Borrow, save, cover</span></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="phone" aria-hidden="true">
                        <div class="phone-top"><span>9:41</span><span>IndianKredit</span></div>
                        <div class="phone-screen">
                            <div class="mini-card">
                                <span>Instant loan</span>
                                <strong>₹20,000</strong>
                                <span>Small-ticket shelf</span>
                            </div>
                            <div class="mini-card gold">
                                <span>Digital gold</span>
                                <strong>₹10</strong>
                                <span>Start with a small buy</span>
                            </div>
                            <div class="mini-card score">
                                <span>Credit score</span>
                                <strong>742</strong>
                                <span>Updated in the app</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="solutions">
        <div class="container">
            <div class="section-head">
                <p class="kicker">Products</p>
                <h2>Smart financial solutions for everyone</h2>
            </div>
            <div class="bento">
                @foreach (config('site.home_cards') as $key)
                    @php $product = config('site.products.'.$key); @endphp
                    <a class="solution-card theme-{{ $product['theme'] }}" href="{{ route($key) }}">
                        <span class="kicker">{{ $product['kicker'] }}</span>
                        <h3>{{ $product['card_title'] }}</h3>
                        <p>{{ $product['card_text'] }}</p>
                        <strong class="stat">{{ $product['card_stat'] }}</strong>
                        <span class="card-go">{{ $product['card_cta'] }} <i class="bi bi-arrow-right"></i></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section soft">
        <div class="container">
            <div class="section-head">
                <p class="kicker">In one place</p>
                <h2>All your financial services, one calm list</h2>
                <p>Borrow, invest, and protect without hopping across five brands.</p>
            </div>
            <div class="service-grid">
                @foreach (config('site.services') as $service)
                    <a class="icon-tile" href="{{ route($service['route']) }}">
                        <i class="bi {{ $service['icon'] }}"></i>
                        <strong>{{ $service['label'] }}</strong>
                        <span>{{ $service['text'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="score-banner">
                <div>
                    <p class="kicker">Free check</p>
                    <h2>Check your credit score</h2>
                    <p>See your bureau score in the app, with the bureau name and the date of the check.</p>
                    <a class="btn btn-yellow" href="{{ route('credit-score') }}">Check credit score</a>
                </div>
                <div class="gauge" aria-hidden="true"><span>742</span></div>
            </div>
        </div>
    </section>

    <section class="section soft">
        <div class="container">
            <div class="section-head">
                <p class="kicker">Standards</p>
                <h2>What you can count on</h2>
            </div>
            <div class="principle-grid">
                @foreach (config('site.principles') as $item)
                    <article class="plain-card">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <h3 class="h5 mt-3">{{ $item['title'] }}</h3>
                        <p class="mb-0">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <p class="kicker">Partners</p>
                <h2>Lending, gold, and cover partners</h2>
                <p>Loans, gold, insurance, and credit scores are fulfilled with regulated partners.</p>
            </div>
            <div class="partner-row">
                @foreach (['Lending partners' => 'Active', 'Gold partners' => 'Active', 'Insurers' => 'Active', 'Credit bureaus' => 'Active'] as $slot => $state)
                    <div class="partner-slot">
                        <div><strong>{{ $slot }}</strong><span>{{ $state }}</span></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section soft" id="stories">
        <div class="container">
            <div class="section-head">
                <p class="kicker">Customers</p>
                <h2>What people say</h2>
            </div>
            <div class="story-grid">
                @foreach (config('site.stories') as $story)
                    <article class="story-card">
                        <p>“{{ $story['quote'] }}”</p>
                        <p class="who mb-0">{{ $story['name'] }} · {{ $story['place'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="faq">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="section-head">
                        <p class="kicker">FAQs</p>
                        <h2>Questions, answered plainly</h2>
                    </div>
                    <a class="btn btn-line" href="{{ route('faq') }}">Read more</a>
                </div>
                <div class="col-lg-8">
                    <div class="accordion" id="home-faq">
                        @foreach (array_slice(config('site.faqs'), 0, 5) as $index => $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="home-h{{ $index }}">
                                    <button class="accordion-button {{ $index ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#home-c{{ $index }}" aria-expanded="{{ $index ? 'false' : 'true' }}" aria-controls="home-c{{ $index }}">
                                        {{ $faq['q'] }}
                                    </button>
                                </h3>
                                <div id="home-c{{ $index }}" class="accordion-collapse collapse {{ $index ? '' : 'show' }}" data-bs-parent="#home-faq">
                                    <div class="accordion-body">{{ $faq['a'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section soft">
        <div class="container">
            <div class="section-head">
                <p class="kicker">Journal</p>
                <h2>Our recent blogs</h2>
                <p>Short notes before you borrow, invest, or buy cover.</p>
            </div>
            <div class="post-grid">
                @foreach (config('site.posts') as $index => $post)
                    <article class="post-card">
                        <a href="{{ route('blog.show', $post['slug']) }}">
                            <div class="post-cover cover-{{ $index % 3 }}">{{ $post['kicker'] }}</div>
                            <h3>{{ $post['title'] }}</h3>
                            <p>{{ $post['excerpt'] }}</p>
                            <strong>Read more</strong>
                        </a>
                    </article>
                @endforeach
            </div>
            <a class="btn btn-line mt-4" href="{{ route('blog') }}">View more</a>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="close-band">
                <div>
                    <h2>Ready when you are.</h2>
                    <p class="mb-0">Apply for a loan, buy gold, or check your score.</p>
                    <div class="store-row mt-3">
                        <a class="store-badge" href="{{ route('apply') }}"><i class="bi bi-apple"></i><span><small>App Store</small><strong>Download</strong></span></a>
                        <a class="store-badge" href="{{ route('apply') }}"><i class="bi bi-google-play"></i><span><small>Google Play</small><strong>Download</strong></span></a>
                    </div>
                </div>
                <div class="hero-actions mb-0">
                    <a class="btn btn-yellow" href="{{ route('apply') }}">Apply Now</a>
                    <a class="btn btn-line" href="{{ route('calculators') }}">Calculators</a>
                </div>
            </div>
        </div>
    </section>
@endsection
