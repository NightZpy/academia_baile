<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" lang="es"> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="es"
	  xmlns:og="http://ogp.me/ns#"
	  xmlns:fb="http://www.facebook.com/2008/fbml"><!--<![endif]-->
<head lang="es">
	@include('public.layout.includes._head')
</head>
{{-- <body class="cssAnimate ct-headroom--scrollUpMenu  salsa"> --}}
<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">
	@include('partials._analytics')
	@include('public.layout.includes._loader')
	@include('public.layout.includes._menu-movil')
 	<div id="ct-js-wrapper" class="ct-pageWrapper">
		@include('partials._configuration-incomplete')
		@yield('content')
	 	<!-- Back to top -->	 	
	 	<a href="#" id="toTop" style="display: block;"><i class="fa fa-chevron-up"></i></a>
	</div>
	@include('public.layout.includes._js')
</body>
</html>