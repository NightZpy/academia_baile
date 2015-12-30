<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Inicio</a></li>
        <li><a href="{{ route('pluranza.academies.home') }}"    class="ct-js-btnScroll--mobile">Academias</a></li>
        <li><a href="{{ route('pluranza.dancers.home') }}"      class="ct-js-btnScroll--mobile">Bailarines</a></li>
        <li><a href="{{ route('pluranza.competitors.home') }}"  class="ct-js-btnScroll--mobile">Competidores</a></li>
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>