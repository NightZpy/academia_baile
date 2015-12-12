<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página web administrativa del Festival Pluranza 2016">
    <meta name="author" content="Presentatenlaweb">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon2.png">
    <link rel="apple-touch-icon" href="/favicon2.png">
    <title>Pluranza 2016 @yield('title', '')</title>
    @include('pluranza.admin.partials._css')
    @include('layout.includes._js-head')
</head>
{{-- <body class="cssAnimate ct-headroom--scrollUpMenu  salsa"> --}}
<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">
    @include('layout.includes._loader')
    @if(Auth::user() AND Auth::user()->academieParticipant)
        @include('pluranza.admin.partials._menu-movil')
    @else
        @include('pluranza.public.partials._menu-movil')
    @endif
    <div id="ct-js-wrapper" class="ct-pageWrapper">
        @if(Auth::user()->academieParticipant)
            @include('pluranza.admin.partials._header')
        @else
            @include('pluranza.public.partials._header')
        @endif
        @yield('content')
        @include('layout.includes._footer')
        <!-- Back to top -->
        <a href="#" id="toTop" style="display: block;"><i class="fa fa-chevron-up"></i></a>
    </div>
    @include('pluranza.admin.partials._js')
</body>
</html>
