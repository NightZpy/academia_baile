<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="#join-us" class="ct-js-btnScroll--mobile">Inicio</a></li>
        {{--<li><a href="#join-us" class="ct-js-btnScroll--mobile">Pluranza 2016: Únete</a></li>--}}
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Pluranza 2016</a></li>
        {{--<li><a href="#videos" class="ct-js-btnScroll--mobile">Vídeos</a></li>--}}
        {{--<li><a href="#academy-show" class="ct-js-btnScroll--mobile">Academias</a></li>--}}
        {{--<li><a href="#blog" class="ct-js-btnScroll--mobile">Blog</a></li>--}}
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>