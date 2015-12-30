<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll--mobile">Inicio</a></li>
        @role('admin')
        <li class="dropdown" role="presentation">
            <a href="#" class="dropdown-toggle">Academias<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('pluranza.academies.home') }}" class="ct-js-btnScroll--mobile">Todas</a></li>
                <li><a href="{{ route('pluranza.dancers.home') }}" class="ct-js-btnScroll--mobile">Bailarines</a></li>
                <li><a href="{{ route('pluranza.competitors.home') }}" class="ct-js-btnScroll--mobile">Competidores</a></li>
                <li><a href="{{ route('pluranza.payments.home') }}" class="ct-js-btnScroll--mobile">Pagos</a></li>
            </ul>
        </li>
        <li class="dropdown" role="presentation">
            <a href="#" class="dropdown-toggle">Configuración<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('categories.home') }}" class="ct-js-btnScroll--mobile">Géneros</a></li>
                <li><a href="{{ route('pluranza.competition-types.home') }}" class="ct-js-btnScroll--mobile">Categorías</a></li>
                <li><a href="{{ route('levels.home') }}" class="ct-js-btnScroll--mobile">Niveles</a></li>
                <li><a href="{{ route('pluranza.competition-categories.home') }}" class="ct-js-btnScroll--mobile">Costos por inscripción</a></li>
                <li><a href="{{ route('configurations.new') }}" class="ct-js-btnScroll--mobile">Reglas</a></li>
            </ul>
        </li>
        @endrole
        @role('director')
        <li>
            <a href="{{ route('pluranza.academies.edit', $academy->id) }}" class="ct-js-btnScroll--mobile">
                Editar
                @if(!$academy->isDataComplete)
                    <span class="badge background-color-red"><i class="fa fa-exclamation-triangle"></i></span>
                @endif
            </a>
        </li>
        <li><a href="{{ route('pluranza.dancers.by-academy', $academy->id) }}" class="ct-js-btnScroll--mobile">Miembros</a></li>
        <li><a href="{{ route('pluranza.competitors.by-academy', $academy->id) }}" class="ct-js-btnScroll--mobile">Competidores</a></li>
        @endrole

        @role('dancer')

        @endrole

        @if(Auth::check())
            <li>
                <a target="_blank" href="{{ $configuration->rules->url() }}" class="ct-js-btnScroll--mobile">
                    Reglas de competencia
                    <span class="badge background-color-red"><i class="fa fa-bell"></i></span>
                </a>
            </li>
            {{--<li class="dropdown" role="presentation">
                <a href="#" class="dropdown-toggle">Perfil<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('categories.home') }}" class="ct-js-btnScroll--mobile">Géneros</a></li>
                </ul>
            </li>--}}
        @endif
        {{--<li><a href="#" class="ct-js-btnScroll--mobile">Resultados</a></li>--}}
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>