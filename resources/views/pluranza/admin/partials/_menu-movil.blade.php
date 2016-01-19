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
        @if(!isset($configuration))
            <li class="dropdown background-color-red" role="presentation">
        @else
            <li class="dropdown" role="presentation">
        @endif
            <a href="#" class="dropdown-toggle">
                Configuración<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('categories.home') }}" class="ct-js-btnScroll--mobile">Géneros</a></li>
                <li><a href="{{ route('pluranza.competition-types.home') }}" class="ct-js-btnScroll--mobile">Categorías</a></li>
                <li><a href="{{ route('levels.home') }}" class="ct-js-btnScroll--mobile">Niveles</a></li>
                <li><a href="{{ route('pluranza.competition-categories.home') }}" class="ct-js-btnScroll--mobile">Costos por inscripción</a></li>
                @if(isset($configuration))
                    <li class="onepage"><a href="{{ route('configurations.edit', $configuration->id) }}" class="ct-js-btnScroll--mobile">Editar datos base de pluranza</a></li>
                @else
                    <li class="background-color-red">
                        <a href="{{ route('configurations.new') }}" class="ct-js-btnScroll--mobile">
                            Agregar datos base de pluranza
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @endrole
        @role('director')
            @if(!$currentAcademy->isDataComplete)
                <li class="background-color-red">
            @else
                <li>
            @endif
                <a href="{{ route('pluranza.academies.edit', $currentAcademy->id) }}" class="ct-js-btnScroll--mobile">
                    Editar
                </a>
            </li>
            <li><a href="{{ route('pluranza.dancers.by-academy', $currentAcademy->id) }}" class="ct-js-btnScroll--mobile">Miembros</a></li>
            <li><a href="{{ route('pluranza.competitors.by-academy', $currentAcademy->id) }}" class="ct-js-btnScroll--mobile">Competidores</a></li>
        @endrole

        @role('dancer')

        @endrole

        @if (Auth::check()) 
            <li class="dropdown" role="presentation">
                <a href="#" class="dropdown-toggle">
                    <span class="badge background-color-red"><i class="fa fa-bell"></i></span>
                    Importante
                    <b class="caret">
                    </b>
                </a>
                <ul class="dropdown-menu">
                    @if(isset($configuration) AND !empty($configuration->rules_file_name))
                        <li class="onepage">
                            <a target="_blank" href="{{ $configuration->rules->url() }}" class="ct-js-btnScroll">
                                Reglas de competencia                            
                            </a>
                        </li>
                    @endif
                    <li class="onepage">
                        <a target="_blank" href="{{ route('pluranza.bank-account') }}" class="ct-js-btnScroll">
                           Costos
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        {{--<li><a href="#" class="ct-js-btnScroll--mobile">Resultados</a></li>--}}
        @include('pluranza.public.partials._sign-movil-area')
    </ul>
</div>