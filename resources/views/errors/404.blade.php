<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" lang="es"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="es"> <!--<![endif]-->
<head lang="es">
    @include('public.layout.includes._head')
</head>
{{-- <body class="cssAnimate ct-headroom--scrollUpMenu  salsa"> --}}
<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">
@include('public.layout.includes._loader')
<div id="ct-js-wrapper" class="ct-pageWrapper">
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff" style="background-color: rgb(255, 255, 255);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="ct-titleBox text-uppercase ct-u-paddingTop40">
                        Error 404: Página no encontrada
                    </h5>
                </div>
            </div>
            <div class="row ct-u-paddingTop100 ct-u-paddingBottom40">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h3>¡Creo que estás bailando fuera de tiempo!</h3>
                        <br>
                        <span class="ct-404error ct-u-colorMotive">
                            <span class="animated activate bounce" data-fx="bounce" data-time="250">4</span>
                            <span class="animated activate bounce" data-fx="bounce" data-time="300">0</span>
                            <span class="animated activate bounce" data-fx="bounce" data-time="350">4</span>
                        </span>
                        <h4 class="text-uppercase animated ct-u-colorGrey" data-fx="fadeInUp" data-time="400">Est?p?ina no puede ser encontrada.</h4>
                        <a href="{{ URL::previous() }}" class="ct-js-btnScroll btn btn-primary ct-u-paddingTop10">Volver a bailar a tiempo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('public.layout.includes._js')
</body>
</html>