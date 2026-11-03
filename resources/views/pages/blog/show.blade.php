@extends('layouts.site')

@section('title', $post['title'])
@section('description', $post['excerpt'])

@section('content')
    <section class="page-hero">
        <div class="container article">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a><span>/</span>
                <a href="{{ route('blog') }}">Blog</a><span>/</span>
                <span>{{ $post['kicker'] }}</span>
            </nav>
            <p class="kicker mt-3">{{ $post['kicker'] }} · {{ $post['date'] }}</p>
            <h1>{{ $post['title'] }}</h1>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container article">
            @foreach ($post['body'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
            @if (!empty($post['points']))
                <ul class="check-list">
                    @foreach ($post['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            @endif
            <p class="fine">This note is general information, not a recommendation to borrow, buy gold, or invest.</p>
            <a class="btn btn-line" href="{{ route('blog') }}">All blogs</a>
        </div>
    </section>
@endsection
