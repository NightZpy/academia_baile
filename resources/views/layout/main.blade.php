<!DOCTYPE html>
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="es"> <!--<![endif]-->
<head lang="es">
@include('layout.includes._head')
</head>
{{-- <body class="cssAnimate ct-headroom--scrollUpMenu  salsa"> --}}
<body class="cssAnimate ct-headroom--fixedMenu onepager salsa">
	@include('layout.includes._loader')
	@include('layout.includes._menu-movil')
 	<div id="ct-js-wrapper" class="ct-pageWrapper">
 		@include('layout.includes._header')
		<div class="clearfix"></div>
	 	@include('layout.includes._slider')
	 	{{-- @include('layout.sections.classes') --}}
	 	@include('layout.sections.join-us')	 	
	 	@include('layout.sections.videos')	 		 	
	 	{{-- @include('layout.sections.awesome-classes') --}}
	 	@include('layout.sections.academy-show') {{-- instructors --}}
	 	{{-- @include('layout.sections.testimonials') --}}
	 	@include('layout.sections.blog')	 		 	
	 	@include('layout.sections.social-networks')
	 	{{-- @include('layout.sections.contact-us') --}}
	 	@include('layout.includes._footer')
	 	@include('layout.includes._modal-login-form')
	 	<!-- Back to top -->	 	
	 	<a href="#" id="toTop" style="display: block;"><i class="fa fa-chevron-up"></i></a>
	</div>
	@include('layout.includes._js')	
</body>
</html>