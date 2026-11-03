@extends('layouts.site')

@section('title', 'About')
@section('description', 'IndianKredit is the app layer for loans, digital gold, insurance, and a credit-score check.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>About</span></nav>
            <h1>One app for the money tasks that usually take five.</h1>
            <p class="lead-copy">IndianKredit is the screen people open for a small loan, a larger personal loan, a gold holding, and basic cover. Regulated partners do the lending, the metal, and the insurance. Their names will be listed when those agreements exist.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <article class="plain-card h-100">
                        <h2 class="h4">The app layer</h2>
                        <p class="mb-0">IndianKredit keeps the journey in one place: apply, read the offer, track a due date, buy a small gold amount, or look at cover.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="plain-card h-100">
                        <h2 class="h4">The partners</h2>
                        <p class="mb-0">A loan is disbursed by a lender. Gold is allotted by a metal partner. A policy is issued by an insurer. IndianKredit does not invent those licences.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="plain-card h-100">
                        <h2 class="h4">This website</h2>
                        <p class="mb-0">You are on the frontend. Forms confirm that the screen works. They do not open an account or move money.</p>
                    </article>
                </div>
            </div>
            <div class="section-head mt-5">
                <h2>Desks we are building for</h2>
            </div>
            <div class="job-grid">
                @foreach (['Product' => 'Screens, words, and the order of a task.', 'Credit' => 'The checklist between an application and a partner decision.', 'Care' => 'People who explain an offer without rushing it.'] as $desk => $text)
                    <article class="job-card">
                        <h3 class="h5">{{ $desk }}</h3>
                        <p class="mb-0">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
