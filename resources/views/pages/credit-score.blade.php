@extends('layouts.site')

@section('title', 'Credit score')
@section('description', 'Preview the IndianKredit credit score screen. The number shown is a sample.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Credit score</span></nav>
            <h1>Check your credit score</h1>
            <p class="lead-copy">A live check needs a bureau, your consent, and your identity. This page does not ask for PAN. It shows the result layout with a sample number.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <button class="btn btn-yellow" type="button" id="show-sample-score">Show a sample score</button>
                    <div class="score-panel mt-4" id="sample-score" hidden>
                        <p class="kicker">Sample figure</p>
                        <div class="big">742</div>
                        <p>This is not your score. A real result will name the bureau and the date of the pull.</p>
                        <ul class="check-list">
                            <li>Payment history on the report</li>
                            <li>How much of your limits you use</li>
                            <li>Recent enquiries</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <article class="plain-card">
                        <h2 class="h4">What we will not do</h2>
                        <p>We will not show a gauge and call it your report. We will not ask you to pay a stranger to “fix” a score.</p>
                        <a class="btn btn-line" href="{{ route('blog.show', 'what-a-score-check-uses') }}">Read how a check works</a>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
