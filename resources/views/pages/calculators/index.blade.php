@extends('layouts.site')

@section('title', 'Calculators')
@section('description', 'EMI, SIP, and fixed deposit calculators. Figures are illustrative.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Calculators</span></nav>
            <h1>Calculators</h1>
            <p class="lead-copy">The maths runs in your browser. Change the rate and see the shape of a payment. None of these is an offer.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="calc-grid">
                @foreach (config('site.calculators') as $slug => $calculator)
                    <a class="calc-card-link" href="{{ route('calculators.show', $slug) }}">
                        <p class="kicker">{{ strtoupper($calculator['type']) }}</p>
                        <h2 class="h4">{{ $calculator['name'] }}</h2>
                        <p class="mb-0">{{ $calculator['text'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
