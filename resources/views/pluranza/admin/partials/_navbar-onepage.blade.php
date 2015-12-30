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
                        @role('admin')
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle">Academias<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="onepage"><a href="{{ route('pluranza.academies.home') }}" class="ct-js-btnScroll">Todas</a></li>
                                    <li class="onepage"><a href="{{ route('pluranza.dancers.home') }}" class="ct-js-btnScroll">Bailarines</a></li>
                                    <li class="onepage"><a href="{{ route('pluranza.competitors.home') }}" class="ct-js-btnScroll">Competidores</a></li>
                                    <li class="onepage"><a href="{{ route('pluranza.payments.home') }}" class="ct-js-btnScroll">Pagos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle">Configuración<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="onepage"><a href="{{ route('categories.home') }}" class="ct-js-btnScroll">Géneros</a></li>
                                    <li class="onepage"><a href="{{ route('pluranza.competition-types.home') }}" class="ct-js-btnScroll">Categorías</a></li>
                                    <li class="onepage"><a href="{{ route('levels.home') }}" class="ct-js-btnScroll">Niveles</a></li>
                                    <li class="onepage"><a href="{{ route('pluranza.competition-categories.home') }}" class="ct-js-btnScroll">Costos por inscripción</a></li>
                                    <li class="onepage"><a href="{{ route('configurations.new') }}" class="ct-js-btnScroll">Reglas</a></li>
                                </ul>
                            </li>
                        @endrole

                        @role('director')
                            <li class="onepage">
                                <a href="{{ route('pluranza.academies.edit', $academy->id) }}" class="ct-js-btnScroll">
                                    Editar
                                    @if(!$academy->isDataComplete)
                                        <span class="badge background-color-red"><i class="fa fa-exclamation-triangle"></i></span>
                                    @endif
                                </a>
                            </li>
                            <li class="onepage"><a href="{{ route('pluranza.dancers.by-academy', $academy->id) }}" class="ct-js-btnScroll">Miembros</a></li>
                            <li class="onepage"><a href="{{ route('pluranza.competitors.by-academy', $academy->id) }}" class="ct-js-btnScroll">Competidores</a></li>
                        @endrole

                        @role('dancer')

                        @endrole

                        @if(Auth::check())
                            {{--<li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle">Perfil<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="onepage"><a href="{{ route('categories.home') }}" class="ct-js-btnScroll">Géneros</a></li>
                                </ul>
                            </li>--}}
                        @endif
                        {{--<li class="onepage"><a href="#" class="ct-js-btnScroll">Resultados</a></li>--}}
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