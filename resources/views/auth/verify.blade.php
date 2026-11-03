@extends('layouts.site')

@section('title', 'Verify email')
@section('description', 'Enter the IndianKredit email code to finish registration.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Verify email</span></nav>
            <h1>Check your email</h1>
            <p class="lead-copy">Enter the 6-digit code sent to {{ session('otp.email') }}.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('verify.store') }}">
                        @csrf
                        @include('auth.errors')
                        <label for="code">Email code</label>
                        <input class="form-control" id="code" name="code" inputmode="numeric" maxlength="6" required autocomplete="one-time-code" placeholder="6-digit code">
                        <button class="btn btn-yellow mt-3" type="submit">Verify and continue</button>
                    </form>
                    <form class="mt-3" method="post" action="{{ route('verify.resend') }}">
                        @csrf
                        <button class="btn btn-line" type="submit">Send a new code</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
