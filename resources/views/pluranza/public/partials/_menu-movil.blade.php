<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Inicio</a></li>
        <li><a href="{{ route('pluranza.academies.home') }}"    class="ct-js-btnScroll--mobile">Academias</a></li>
        <li><a href="{{ route('pluranza.dancers.home') }}"      class="ct-js-btnScroll--mobile">Bailarines</a></li>
        <li><a href="{{ route('pluranza.competitors.home') }}"  class="ct-js-btnScroll--mobile">Competidores</a></li>
        @if(!Auth::check() AND isset($configuration) AND !empty($configuration->rules_file_name))
            <li>
                <a target="_blank" href="{{ $configuration->rules->url() }}" class="ct-js-btnScroll--mobile">
                    Reglas de competencia                            
                </a>
            </li>
        @endif
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>