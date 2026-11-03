@extends('layouts.site')

@section('title', 'Log in')
@section('description', 'Log in to your IndianKredit account.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Log in</span></nav>
            <h1>Log in</h1>
            <p class="lead-copy">Use the email and password from your account.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('login.store') }}">
                        @csrf
                        @include('auth.errors')
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            <div class="col-12">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" id="remember" name="remember" type="checkbox" value="1">
                                    <label class="form-check-label" for="remember">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-yellow" type="submit">Log in</button>
                                <p class="fine mt-3 mb-0">
                                    <a href="{{ route('password.forgot') }}">Forgot password</a>
                                    <span> · </span>
                                    <a href="{{ route('register') }}">Create an account</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
