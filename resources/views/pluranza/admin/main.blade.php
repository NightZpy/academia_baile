<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Pluranza 2016 @yield('title', '')</title>
    @include('pluranza.admin.partials._css')
    @include('layout.includes._js-head')
</head>
<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">
    @include('layout.includes._loader')
    @include('layout.includes._menu-movil')
    <div id="ct-js-wrapper" class="ct-pageWrapper">
        @include('pluranza.admin.partials._header')
        <div class="clearfix"></div>
        @yield('content')
        @include('layout.includes._footer')
        <!-- Back to top -->
        <a href="#" id="toTop" style="display: block;"><i class="fa fa-chevron-up"></i></a>
    </div>
    @include('layout.includes._js')
</body>
</html>