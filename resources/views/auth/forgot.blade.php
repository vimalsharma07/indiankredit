@extends('layouts.site')

@section('title', 'Forgot password')
@section('description', 'Request an IndianKredit password reset code.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Forgot password</span></nav>
            <h1>Forgot password</h1>
            <p class="lead-copy">We will email a code if this address has an account.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('password.email') }}">
                        @csrf
                        @include('auth.errors')
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
                        <button class="btn btn-yellow mt-3" type="submit">Send code</button>
                        <p class="fine mt-3 mb-0"><a href="{{ route('login') }}">Back to log in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
