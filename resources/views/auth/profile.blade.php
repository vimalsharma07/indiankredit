@extends('layouts.site')

@section('title', 'Your details')
@section('description', 'Add your PAN and date of birth, or skip and explore IndianKredit.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><span>Account</span></nav>
            <h1>A few details</h1>
            <p class="lead-copy">PAN and date of birth are optional. You can skip this and look around.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form class="form-card" method="post" action="{{ route('profile.save') }}">
                        @csrf
                        @include('auth.errors')
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="pan">PAN</label>
                                <input class="form-control" id="pan" name="pan" value="{{ old('pan', $user->pan) }}" maxlength="10" placeholder="ABCDE1234F" autocapitalize="characters">
                            </div>
                            <div class="col-12">
                                <label for="dob">Date of birth</label>
                                <input class="form-control" id="dob" name="dob" type="date" value="{{ old('dob', optional($user->dob)->format('Y-m-d')) }}" max="{{ now()->subDay()->toDateString() }}">
                            </div>
                            <div class="col-12 d-flex flex-wrap gap-2">
                                <button class="btn btn-yellow" type="submit">Save and continue</button>
                            </div>
                        </div>
                    </form>
                    <form class="mt-3" method="post" action="{{ route('profile.skip') }}">
                        @csrf
                        <button class="btn btn-line" type="submit">Skip and explore</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
