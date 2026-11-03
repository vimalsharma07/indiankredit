@extends('layouts.site')

@section('title', 'Refer and earn')
@section('description', 'Refer a friend to IndianKredit and earn when they take a product.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Refer and earn</span></nav>
            <h1>Share IndianKredit.</h1>
            <p class="lead-copy">Share your link. When a friend completes an application, the reward is credited to your account.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">1</span><h2 class="h5 mt-3">Copy your link</h2><p class="mb-0">Share the link below. Signups from it are tracked to you.</p></article></div>
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">2</span><h2 class="h5 mt-3">They apply</h2><p class="mb-0">A friend completes an application with your link.</p></article></div>
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">3</span><h2 class="h5 mt-3">You earn</h2><p class="mb-0">The reward is added to your account after their application is completed.</p></article></div>
            </div>
            <div class="form-card mt-4">
                <p class="kicker">Your link</p>
                <p class="refer-code" id="refer-link">{{ route('apply', ['ref' => 'FRIEND']) }}</p>
                <button class="btn btn-yellow" type="button" data-copy-target="#refer-link">Copy link</button>
            </div>
        </div>
    </section>
@endsection
