@extends('layouts.site')

@section('title', $product['name'])
@section('description', $product['description'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>{{ $product['name'] }}</span>
            </nav>
        </div>
    </section>
    <section class="section pt-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <p class="kicker">{{ $product['kicker'] }}</p>
                    <h1 class="product-title">{{ $product['card_title'] }}</h1>
                    <p class="lead-copy">{{ $product['summary'] }}</p>

                    @if (!empty($product['plans']))
                        <div class="plan-grid mt-4">
                            @foreach ($product['plans'] as $plan)
                                <article class="plan-card">
                                    <h2 class="h5">{{ $plan['name'] }}</h2>
                                    <p class="mb-0">{{ $plan['text'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    @endif

                    <h2 class="h4 mt-5">How it works</h2>
                    <div class="step-list mt-3">
                        @foreach ($product['steps'] as $index => $step)
                            <article>
                                <span class="step-no">{{ $index + 1 }}</span>
                                <div>
                                    <strong>{{ $step['title'] }}</strong>
                                    <p class="mb-0">{{ $step['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <h2 class="h4 mt-5">Who it is for</h2>
                    <ul class="check-list mt-2">
                        @foreach ($product['eligibility'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>

                    <h2 class="h4 mt-4">What a live check asks for</h2>
                    <div class="chips mt-2">
                        @foreach ($product['documents'] as $item)
                            <span>{{ $item }}</span>
                        @endforeach
                    </div>

                    @if (!empty($product['example']))
                        <h2 class="h4 mt-5">Example only, not an offer</h2>
                        <table class="example-table">
                            @foreach ($product['example'] as $row)
                                <tr>
                                    <td>{{ $row[0] }}</td>
                                    <td>{{ $row[1] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if (!empty($product['faqs']))
                        <h2 class="h4 mt-5">On this product</h2>
                        <div class="accordion mt-2" id="product-faq">
                            @foreach ($product['faqs'] as $index => $faq)
                                <div class="accordion-item">
                                    <h3 class="accordion-header">
                                        <button class="accordion-button {{ $index ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#pf{{ $index }}">
                                            {{ $faq['q'] }}
                                        </button>
                                    </h3>
                                    <div id="pf{{ $index }}" class="accordion-collapse collapse {{ $index ? '' : 'show' }}" data-bs-parent="#product-faq">
                                        <div class="accordion-body">{{ $faq['a'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    <aside class="side-card theme-{{ $product['theme'] }}">
                        <span class="kicker">{{ $product['name'] }}</span>
                        <strong class="stat">{{ $product['card_stat'] }}</strong>
                        <ul>
                            @foreach ($product['points'] as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                        @if (!empty($product['coming_soon']))
                            <a class="btn btn-dark-pill w-100 mt-3" href="{{ route('contact', ['topic' => 'mutual-funds']) }}">Tell me when it opens</a>
                        @else
                            <a class="btn {{ $product['theme'] === 'ink' ? 'btn-yellow' : 'btn-dark-pill' }} w-100 mt-3" href="{{ route('apply', ['product' => $key]) }}">Apply Now</a>
                        @endif
                        @if (!empty($product['calculator']))
                            <a class="btn btn-line w-100 mt-2" href="{{ route('calculators.show', $product['calculator']) }}">Open calculator</a>
                        @endif
                        <p class="fine mt-3 mb-0 {{ $product['theme'] === 'ink' ? 'text-white-50' : '' }}">Interest and fees are shown on the offer, before you accept. This page does not quote a rate.</p>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
