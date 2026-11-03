@extends('layouts.site')

@section('title', 'Page not found')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>That page is not on IndianKredit.</h1>
            <p class="lead-copy">The link may be old. The home page still has every product.</p>
            <a class="btn btn-yellow" href="{{ route('home') }}">Back home</a>
        </div>
    </section>
@endsection
