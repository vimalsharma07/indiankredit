@extends('layouts.site')

@section('title', 'Credit score')
@section('description', 'Check your credit score with IndianKredit.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Credit score</span></nav>
            <h1>Check your credit score</h1>
            <p class="lead-copy">Share your mobile number. We pull the bureau score with your consent and send the result to you.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('credit-score.submit') }}">
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
                        <div class="mb-3">
                            <label for="name">Full name</label>
                            <input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="80">
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile</label>
                            <input class="form-control" id="mobile" name="mobile" inputmode="numeric" value="{{ old('mobile') }}" required maxlength="10">
                        </div>
                        <button class="btn btn-yellow" type="submit">Check my score</button>
                        <p class="fine mt-2 mb-0">The result names the bureau and the date of the check.</p>
                    </form>
                </div>
                <div class="col-lg-6">
                    <article class="plain-card">
                        <h2 class="h4">What the report includes</h2>
                        <ul class="check-list">
                            <li>Payment history</li>
                            <li>How much of your limits you use</li>
                            <li>Recent enquiries</li>
                        </ul>
                        <a class="btn btn-line" href="{{ route('blog.show', 'what-a-score-check-uses') }}">Read how a check works</a>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
