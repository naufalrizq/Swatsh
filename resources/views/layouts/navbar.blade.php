<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/stylesHome.css" rel="stylesheet" />
    
    {{-- bates timpaan--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <!-- Styles -->
   
</head>

<body>
    <div id="app">
    <header class="masthead">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 text-dark" id="mainNav">
            <div class="container px-4 px-lg-5">
              <a class="navbar-brand" href="{{ '/' }}">
                <img src="{{ asset('/storage/images/logo.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                SWATSH
              </a>
              {{-- <form class="form-inline">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lb active" role="button" aria-pressed="true">Daftar</a>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lb active" role="button" aria-pressed="true">Masuk</a>
              </form> --}}
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            {{ isset($slot) ? $slot : null }}
        </main>
    </div>
    @livewireScripts
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    @stack('scripts')
</body>

</html>
