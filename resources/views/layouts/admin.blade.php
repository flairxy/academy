<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="https://unpkg.com/vue-paypal-checkout@2.0.0/dist/vue-paypal-checkout.min.js"></script> --}}


    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendor.bundle49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/base.css') }}" rel="stylesheet">
</head>

<body class="page-user">
    <div id="app">
        @include('layouts.admin_navbar')
        <div class="page-content">
            @yield('content')
        </div>
        <!-- .page-content -->

        <!-- .footer-bar -->
        @include('layouts.footer')
    </div>
</body>
<script src="{{ asset('assets/js/jquery.bundle49f7.js?ver=104') }}"></script>
<script src="{{ asset('assets/js/script49f7.js?ver=104') }}"></script>
<script src="{{ asset('js/vue-app.js') }}"></script>

</html>
