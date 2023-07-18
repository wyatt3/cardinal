<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @routes
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="prefetch" href="/storage/img/hero1.jpg" />
    <link rel="prefetch" href="/storage/img/hero2.jpg" />
    <link rel="prefetch" href="/storage/img/hero3.jpg" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav-bar name="{{ config('app.name') }}"></nav-bar>
        @yield('content')
        <footer class="py-5 bg-dark row">
            <div class="text-white text-center col-12 col-lg-4 m-0">
                <i class="bi bi-telephone-fill"></i><a class="text-white mx-1" href="tel:435-764-7542">435-764-7542</a>
            </div>
            <div class="text-white text-center col-12 col-lg-4 m-0">
                <p class="my-2">Copyright &copy; {{ config('app.name') }} {{ date('Y') }}</p>
            </div>
            <div class="text-white text-center col-12 col-lg-4 m-0">
                <i class="bi bi-envelope-fill"></i><a class="text-white mx-1" href="mailto:roger@cardinal-surveying.com">roger@cardinal-surveying.com</a>
            </div>
        </footer>
    </div>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</body>

</html>