@extends('layouts.site')

@section('title', $document['title'])
@section('description', $document['description'])

@section('content')
    <section class="page-hero">
        <div class="container article">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>{{ $document['title'] }}</span></nav>
            <h1>{{ $document['title'] }}</h1>
            <p class="lead-copy">{{ $document['intro'] }}</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container article prose">
            @foreach ($document['sections'] as $section)
                <h2>{{ $section['title'] }}</h2>
                <p>{{ $section['body'] }}</p>
            @endforeach
        </div>
    </section>
@endsection
