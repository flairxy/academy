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

    <link href="{{ asset('assets/css/style49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendor.bundle49f7.css?ver=104') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/base.css') }}" rel="stylesheet">
</head>
<style type="text/css">
    * {
        box-sizing: border-box;
    }

    body {
        display: flex;
        background: #c3c3c3;
        min-height: 100vh;
        justify-content: center;
        align-items: center;
    }

    .pay-area {
        display: block;
        width: 300px;
        padding: 35px;
        background: #ffffff;
    }

    input {
        display: block;
        width: 100%;
        padding: 5px 15px;
    }

    button {
        padding: 5px 10px;
        background: #3c3c3c;
        cursor: pointer;
        color: #ffffff;
    }

    .m-2 {
        margin: 20px auto;
        display: block;
    }

    .error {
        color: red;
        font-size: small;
    }

    .success {
        color: green;
    }
</style>

<body class="page-user">
    <div class="page-content">
        <div class="container">
            <div>
                <img height="60" src="{{ asset('paypal-logo.png') }}">
                @if (session('error') || session('success'))
                <p class="{{ session('error') ? 'error':'success' }}">
                    {{ session('error') ?? session('success') }}
                </p>
                @endif
                <form method="POST" action="{{ route('create-payment') }}">
                    @csrf
                    <div class="m-2">
                        <input type="text" name="amount" placeholder="Amount">
                        @if ($errors->has('amount'))
                        <span class="error"> {{ $errors->first('amount') }} </span>
                        @endif
                    </div>
                    <button>Pay Now</button>
                </form>
            </div>
        </div>
    </div>
    <!-- .page-content -->

    <!-- .footer-bar -->
    @include('layouts.footer')
</body>
<script src="{{ asset('assets/js/jquery.bundle49f7.js?ver=104') }}">
</script>
<script src="{{ asset('assets/js/script49f7.js?ver=104') }}"></script>

</html>
