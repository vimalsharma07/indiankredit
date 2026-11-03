@extends('layouts.site')

@section('title', 'Create account')
@section('description', 'Create an IndianKredit account and verify your email.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Register</span></nav>
            <h1>Create your account</h1>
            <p class="lead-copy">We email a 6-digit code before the account is ready.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('register.store') }}">
                        @csrf
                        @include('auth.errors')
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name">Full name</label>
                                <input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="80" autocomplete="name">
                            </div>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="120" autocomplete="email">
                            </div>
                            <div class="col-12">
                                <label for="phone">Mobile</label>
                                <input class="form-control" id="phone" name="phone" inputmode="numeric" value="{{ old('phone') }}" required maxlength="10" placeholder="10-digit mobile" autocomplete="tel">
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password" required minlength="8" autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation">Confirm password</label>
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-yellow" type="submit">Send code</button>
                                <p class="fine mt-3 mb-0">Already registered? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
