<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página web administrativa del Festival Pluranza 2016">
    <meta name="author" content="Presentatenlaweb">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon-pluranza.png">
    <link rel="apple-touch-icon" href="/favicon-pluranza.png">
    <title>Pluranza 2016 @yield('title', '')</title>
    @include('pluranza.admin.partials._css')
    <style>
        .navbar.yamm.navbar-scroll-top {
            position: fixed;
            top: 0;
            width: 100%;
            left: 0;
            z-index: 999;
            color: inherit;
            background-color: black;
            -webkit-box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid #ffffff;
            padding-top: 0;
            padding-bottom: 0;
        }

        .navbar-nav > li > a {
            color: white;
        }
    </style>
    @include('public.layout.includes._js-head')
</head>
{{-- <body class="cssAnimate ct-headroom--scrollUpMenu  salsa"> --}}
{{--<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">--}}
<body class="cssAnimate ct-headroom--fixedMenu ct-navbar--top salsa">
    @include('public.layout.includes._loader')
    @if(Auth::user() AND Auth::user()->academy)
        @include('pluranza.admin.partials._menu-movil')
    @else
        @include('pluranza.public.partials._menu-movil')
    @endif
    <div id="ct-js-wrapper" class="ct-pageWrapper">
        @if(Auth::user() AND Auth::user()->academy)
            @include('pluranza.admin.partials._header')
        @else
            @include('pluranza.public.partials._header')
        @endif
        @include('partials._academy-incomplete')
        @include('partials._flash')
        @yield('content')
        @include('public.layout.includes._footer')
    </div>
    @include('pluranza.admin.partials._js')
</body>
</html>
