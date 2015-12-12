<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Inicio</a></li>
        <li><a href="{{ route('pluranza.academies-participants.edit', $academieParticipant->id) }}" class="ct-js-btnScroll--mobile">Editar</a></li>
        <li><a href="{{ route('pluranza.academies-participants.members') }}" class="ct-js-btnScroll--mobile">Miembros</a></li>
        <li><a href="{{ route('pluranza.academies-participants.results') }}" class="ct-js-btnScroll--mobile">Resultados</a></li>
    </ul>
</div>