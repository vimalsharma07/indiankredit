@extends('layouts.site')

@section('title', 'Standards')
@section('description', 'The product rules IndianKredit is designed around.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Standards</span></nav>
            <h1>Built to stay readable.</h1>
            <p class="lead-copy">Awards and registrations will be published when they are real. Until then, these are the rules the screens follow.</p>
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
                <h2 class="h4">What we will not print early</h2>
                <p class="mb-0">No borrowed award list, no unnamed “RBI registered” badge, and no customer quote presented as a real review. When a partner, a certificate, or a bureau integration is live, this page gets the name and the date.</p>
            </article>
        </div>
    </section>
@endsection
