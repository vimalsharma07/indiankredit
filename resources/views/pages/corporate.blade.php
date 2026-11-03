@extends('layouts.site')

@section('title', 'Corporate')
@section('description', 'IndianKredit for employers: earned wage access and a channel partner path.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Corporate</span></nav>
            <h1>Partner with us</h1>
            <p class="lead-copy">Two paths: salary access for your team, or a channel partnership if you already advise customers.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <article class="plain-card h-100">
                        <p class="kicker">Employers</p>
                        <h2 class="h4">Earned wage access</h2>
                        <p>Staff draw a part of pay they have already earned. The employer stays in control of the limit and the payroll file.</p>
                    </article>
                </div>
                <div class="col-md-6">
                    <article class="plain-card h-100">
                        <p class="kicker">Distributors</p>
                        <h2 class="h4">Channel partner</h2>
                        <p>Introduce customers to the app. Commission rules will be written down before the first payout.</p>
                    </article>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @include('partials.contact-form', ['topic' => 'corporate'])
                </div>
            </div>
        </div>
    </section>
@endsection
