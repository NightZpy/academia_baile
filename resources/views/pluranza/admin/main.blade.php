<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pluranza 2016 - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
    @yield('content')
    @include('layout.includes._footer')
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
</body>
</html>