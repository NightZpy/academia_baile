<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Inicio</a></li>
        <li><a href="{{ route('pluranza.academies-participants.edit', $academyParticipant->id) }}" class="ct-js-btnScroll--mobile">Editar</a></li>
        <li><a href="{{ route('pluranza.dancers.home', $academyParticipant->id) }}" class="ct-js-btnScroll--mobile">Miembros</a></li>
        <li><a href="#" class="ct-js-btnScroll--mobile">Resultados</a></li>
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>