<nav class="navbar yamm" role="navigation" data-startnavbar="0" data-offset="114"><!-- NavBar [begin] -->
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="row">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="/assets/images/logo-pluranza.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <ul class="nav navbar-nav navbar-right ct-navbar--fadeIn">
                        <li class="onepage"><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll">Inicio</a></li>

                        @if(Entrust::hasRole('director'))
                            <li class="onepage"><a href="{{ route('pluranza.academies.edit', $academy->id) }}" class="ct-js-btnScroll">Editar</a></li>
                            <li class="onepage"><a href="{{ route('pluranza.dancers.by-academy', $academy->id) }}" class="ct-js-btnScroll">Miembros</a></li>
                            <li class="onepage"><a href="{{ route('pluranza.competitors.by-academy', $academy->id) }}" class="ct-js-btnScroll">Competidores</a></li>
                            <li class="onepage"><a href="#" class="ct-js-btnScroll">Resultados</a></li>
                        @endif

                        @if(Entrust::hasRole('admin'))
                            <li class="dropdown" role="presentation">
                                <a href="staff.html" class="dropdown-toggle">Academias<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('categories.home') }}">Miembros</a></li>
                                    <li><a href="{{ route('levels.home') }}">Competidores</a></li>
                                    <li><a href="{{ route('pluranza.competition-types.home') }}">Tipos de competencias</a></li>
                                    <li><a href="{{ route('pluranza.competition-categories.home') }}">Categorías en competencia</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle">Configuración<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('categories.home') }}">Categorías</a></li>
                                    <li><a href="{{ route('levels.home') }}">Niveles</a></li>
                                    <li><a href="{{ route('pluranza.competition-types.home') }}">Tipos de competencias</a></li>
                                    <li><a href="{{ route('pluranza.competition-categories.home') }}">Categorías en competencia</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    @include('pluranza.public.partials._sign-area')
                </div>
            </div>
        </div>
    </div>
</nav><!-- NavBar [end] -->