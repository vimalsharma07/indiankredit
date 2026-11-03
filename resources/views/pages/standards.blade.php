@extends('layouts.site')

@section('title', 'Standards')
@section('description', 'The product rules IndianKredit is designed around.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Standards</span></nav>
            <h1>Built to stay readable.</h1>
            <p class="lead-copy">These are the rules every IndianKredit screen follows.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="principle-grid">
                @foreach (config('site.principles') as $item)
                    <article class="plain-card">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <h2 class="h5 mt-3">{{ $item['title'] }}</h2>
                        <p class="mb-0">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
            <article class="plain-card mt-4">
                <h2 class="h4">How an offer is shown</h2>
                <p class="mb-0">Interest, fees, and the total payable are on the offer before you accept. Repayment stays in the app or on the official repayment page.</p>
            </article>
        </div>
    </section>
@endsection
