<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang={{ app()->getLocale() }}>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', config('app.description'))">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    @stack('styles')
</head>
<body>

<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-container">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <p>{{__('Loading')}}...</p>
    </div>
</div>
<div class="page">
    @yield('header')
    @yield('hero-section')
    @yield('content')

    @include('partials.footer')
</div>

@include('cookie-consent::index')

<!-- JavaScript -->
<script src="{{ asset('js/core.min.js') }}"></script>

<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
@stack('scripts')
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
