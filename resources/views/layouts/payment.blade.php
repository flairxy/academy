<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendor.bundle49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/base.css') }}" rel="stylesheet">
</head>

<body class="page-user">
    @include('layouts.payment_navbar')
    <div class="page-content">
        @yield('content')
    </div>
    <!-- .footer-bar -->
    @include('layouts.footer')
</body>
@yield('script')
<script src="{{ asset('assets/js/jquery.bundle49f7.js?ver=104') }}"></script>
<script src="{{ asset('assets/js/script49f7.js?ver=104') }}"></script>
<script src="{{ asset('js/vue-app.js') }}"></script>

</html>
