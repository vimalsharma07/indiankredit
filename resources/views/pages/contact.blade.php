@extends('layouts.site')

@section('title', 'Contact')
@section('description', 'Write to IndianKredit. Messages stay on this preview until the inbox is connected.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Contact</span></nav>
            <h1>Contact us</h1>
            <p class="lead-copy">Email <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a> once the mailbox is live. The form below checks the screen only.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @include('partials.contact-form')
                </div>
            </div>
        </div>
    </section>
@endsection
