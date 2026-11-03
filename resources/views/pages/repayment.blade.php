@extends('layouts.site')

@section('title', 'Loan repayment')
@section('description', 'Repay an IndianKredit loan with your loan reference and mobile number.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Loan repayment</span></nav>
            <h1>Loan repayment</h1>
            <p class="lead-copy">Enter the loan reference and the mobile number on the application. We send the repayment steps to that number.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('repayment.submit') }}">
                        @csrf
                        @include('partials.honeypot')
                        @if ($errors->any())
                            <div class="alert alert-warning" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="account">Loan reference</label>
                            <input class="form-control" id="account" name="account" value="{{ old('account') }}" required maxlength="30">
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile</label>
                            <input class="form-control" id="mobile" name="mobile" inputmode="numeric" value="{{ old('mobile') }}" required maxlength="10">
                        </div>
                        <button class="btn btn-yellow" type="submit">Look up</button>
                        <p class="fine mt-2 mb-0">Pay only in the app or on this page. Never to a personal UPI ID.</p>
                    </form>
                </div>
                <div class="col-lg-6">
                    <article class="plain-card h-100">
                        <h2 class="h4">When repayment is connected</h2>
                        <ul class="check-list">
                            <li>Due date and amount on the loan itself</li>
                            <li>A receipt after a successful payment</li>
                            <li>No request for OTP, PIN, or a staff account</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
