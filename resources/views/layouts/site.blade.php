<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $fullTitle = $pageTitle !== '' ? $pageTitle.' — '.config('site.name') : config('site.name').' — '.config('site.tagline');
        $pageDescription = trim($__env->yieldContent('description'));
    @endphp
    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $pageDescription !== '' ? $pageDescription : config('site.description') }}">
    <meta name="theme-color" content="#ffe14a">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
    <a class="skip-link" href="#content">Skip to content</a>
    @include('partials.header')
    <main id="content">
        @if (session('status'))
            <div class="container">
                <div class="status-banner" role="status">{{ session('status') }}</div>
            </div>
        @endif
        @yield('content')
    </main>
    @include('partials.footer')
    <div class="mobile-apply d-lg-none">
        <a class="btn btn-yellow w-100" href="{{ route('apply') }}">Apply Now</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
