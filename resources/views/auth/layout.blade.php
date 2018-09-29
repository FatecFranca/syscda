<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @if (isset($js) && $js)
        <script type="text/javascript" src="/js/{{$js}}.js"></script>
    @endif
    @yield('js')

<!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ $css }}" rel="stylesheet">
    @if (isset($css) && $css)
        <link rel="stylesheet" href="/css/{{$css}}.css"/>
    @endif
    @yield('css')
</head>
<body>
<!-- criar componentes de header, e menu lateral-->
<main class="py-4">
    @yield('content')
</main>
</div>
</body>
</html>
