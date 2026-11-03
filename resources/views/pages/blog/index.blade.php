@extends('layouts.site')

@section('title', 'Blog')
@section('description', 'Notes on reading a loan offer, starting digital gold, and credit scores.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Blog</span></nav>
            <h1>Our recent blogs</h1>
            <p class="lead-copy">Because a money decision deserves a plain explanation first.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="post-grid">
                @foreach (config('site.posts') as $index => $post)
                    <article class="post-card">
                        <a href="{{ route('blog.show', $post['slug']) }}">
                            <div class="post-cover cover-{{ $index % 3 }}">{{ $post['kicker'] }}</div>
                            <p class="who">{{ $post['date'] }}</p>
                            <h2 class="h4">{{ $post['title'] }}</h2>
                            <p>{{ $post['excerpt'] }}</p>
                            <strong>Read more</strong>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
