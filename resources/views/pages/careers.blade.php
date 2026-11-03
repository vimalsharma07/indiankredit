@extends('layouts.site')

@section('title', 'Careers')
@section('description', 'Roles IndianKredit expects to hire for.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Careers</span></nav>
            <h1>Roles we are shaping.</h1>
            <p class="lead-copy">These are the jobs the product needs. Applications open when hiring is connected. Until then, send a note.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="job-grid">
                @foreach (config('site.jobs') as $job)
                    <article class="job-card">
                        <h2 class="h5">{{ $job['title'] }}</h2>
                        <p class="who">{{ $job['place'] }}</p>
                        <p>{{ $job['text'] }}</p>
                        <a class="btn btn-line" href="{{ route('contact', ['topic' => 'careers']) }}">Write to us</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
