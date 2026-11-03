@extends('layouts.site')

@section('title', 'Apply')
@section('description', 'Apply for an IndianKredit loan, gold, investment, or cover.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Apply</span></nav>
            <h1>Apply now</h1>
            <p class="lead-copy">Tell us the product and the amount. We review it and share an offer before you accept.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <form class="form-card" method="post" action="{{ route('apply.submit') }}">
                        @csrf
                        @include('partials.honeypot')
                        @if ($errors->any())
                            <div class="alert alert-warning" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name">Full name</label>
                                <input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="80">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" id="mobile" name="mobile" inputmode="numeric" value="{{ old('mobile') }}" required maxlength="10" placeholder="10-digit mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <input class="form-control" id="city" name="city" value="{{ old('city') }}" required maxlength="60">
                            </div>
                            <div class="col-md-6">
                                <label for="product">Product</label>
                                <select class="form-select" id="product" name="product" required>
                                    @foreach (config('site.products') as $key => $item)
                                        @continue (!empty($item['coming_soon']))
                                        <option value="{{ $key }}" data-hint="{{ $item['card_stat'] }}" data-min="{{ $item['amount_min'] }}" data-max="{{ $item['amount_max'] }}" @selected(old('product', request('product')) === $key)>{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="amount">Amount (₹)</label>
                                <input class="form-control" id="amount" name="amount" type="number" value="{{ old('amount', 10000) }}" required min="10" max="500000">
                                <p class="fine mb-0" id="amount-hint"></p>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-yellow" type="submit">Continue</button>
                                <p class="fine mt-2 mb-0">We will contact you on this mobile with the next step.</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <aside class="side-card theme-yellow">
                        <span class="kicker">What happens next</span>
                        <ol class="mt-3">
                            <li>We receive your application.</li>
                            <li>A lending partner reviews your details.</li>
                            <li>Your offer shows interest and fees before you accept.</li>
                        </ol>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
