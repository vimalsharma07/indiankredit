@extends('layouts.site')

@section('title', 'Refer and earn')
@section('description', 'Share an IndianKredit link. Rewards are not live on this preview.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Refer and earn</span></nav>
            <h1>Share IndianKredit.</h1>
            <p class="lead-copy">A referral reward will be a published amount with a clear rule. This page shows the sharing step only.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">1</span><h2 class="h5 mt-3">Copy your link</h2><p class="mb-0">The code below is a sample. It does not track signups yet.</p></article></div>
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">2</span><h2 class="h5 mt-3">They apply</h2><p class="mb-0">A friend uses the same application screen you did.</p></article></div>
                <div class="col-md-4"><article class="plain-card h-100"><span class="step-no">3</span><h2 class="h5 mt-3">A reward, later</h2><p class="mb-0">The amount and the condition will be written here before anyone is paid.</p></article></div>
            </div>
            <div class="form-card mt-4">
                <p class="kicker">Sample link</p>
                <p class="refer-code" id="refer-link">{{ route('apply', ['ref' => 'FRIEND']) }}</p>
                <button class="btn btn-yellow" type="button" data-copy-target="#refer-link">Copy link</button>
            </div>
        </div>
    </section>
@endsection
