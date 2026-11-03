@extends('layouts.site')

@section('title', 'Reset password')
@section('description', 'Set a new IndianKredit password with the email code.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Reset password</span></nav>
            <h1>Choose a new password</h1>
            <p class="lead-copy">Enter the code sent to {{ session('otp.email') }}.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('password.update') }}">
                        @csrf
                        @include('auth.errors')
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="code">Email code</label>
                                <input class="form-control" id="code" name="code" inputmode="numeric" maxlength="6" required autocomplete="one-time-code">
                            </div>
                            <div class="col-md-6">
                                <label for="password">New password</label>
                                <input class="form-control" id="password" name="password" type="password" required minlength="8" autocomplete="new-password">
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation">Confirm password</label>
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-yellow" type="submit">Update password</button>
                            </div>
                        </div>
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
