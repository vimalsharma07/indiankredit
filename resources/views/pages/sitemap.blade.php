@extends('layouts.site')

@section('title', 'Sitemap')
@section('description', 'Every page on the IndianKredit website.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Sitemap</span></nav>
            <h1>Sitemap</h1>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4">
                @foreach (config('site.menu') as $group)
                    <div class="col-6 col-lg-3">
                        <h2 class="h5">{{ $group['title'] }}</h2>
                        <ul>
                            @foreach ($group['links'] as $link)
                                <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                <div class="col-6 col-lg-3">
                    <h2 class="h5">Company</h2>
                    <ul>
                        @foreach (config('site.company') as $link)
                            <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                        @endforeach
                        <li><a href="{{ route('blog') }}">Blogs</a></li>
                        <li><a href="{{ route('apply') }}">Apply</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h2 class="h5">Calculators</h2>
                    <ul>
                        @foreach (config('site.calculators') as $slug => $calculator)
                            <li><a href="{{ route('calculators.show', $slug) }}">{{ $calculator['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h2 class="h5">Legal</h2>
                    <ul>
                        @foreach (config('site.legal_links') as $link)
                            <li><a href="{{ route($link['route']) }}">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
