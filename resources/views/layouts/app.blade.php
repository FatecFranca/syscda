<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CDA') }}</title>

    <!-- Scripts -->
    @if (isset($js) && $js)
        <script type="text/javascript" src="/js/{{$js}}.js"></script>
    @endif
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    @if (isset($css) && $css)
        <link rel="stylesheet" href="/css/{{$css}}.css"/>
    @endif
    @yield('css')
</head>
<body>

    @include('components.navbar')
    <div class="container-fluid">
        <div class="row">

            @if (Auth::check())
                @include('components.sidebar')
            @endif

            <main role="main" class="mainContent">

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
