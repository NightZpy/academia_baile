<nav class="navbar yamm" role="navigation" data-startnavbar="0" data-offset="114"><!-- NavBar [begin] -->
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="row">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="col-lg-2 col-md-3 col-sm-2">
                    <div class="navbar-header">
                        <a class="navbar-brand ct-js-btnScroll" href="{{ route('home') }}">
                            <img src="/assets/images/logo-pluranza.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-8">
                    <ul class="nav navbar-nav navbar-right ct-navbar--fadeIn">
                        <li class="onepage"><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll">Inicio</a></li>
                        <li class="onepage"><a href="{{ route('pluranza.academies.home') }}" class="white-nav-bar-text ct-js-btnScroll">Academias</a></li>
                        <li class="onepage"><a href="{{ route('pluranza.dancers.home') }}" class="white-nav-bar-text ct-js-btnScroll">Bailarines</a></li>
                        {{-- <li class="onepage"><a href="{{ route('pluranza.competitors.home') }}" class="white-nav-bar-text ct-js-btnScroll">Competidores</a></li> --}}
                        {{--<li class="onepage"><a href="#" class="white-nav-bar-text ct-js-btnScroll">Exhibiciones</a></li>--}}
                        {{--<li class="onepage"><a href="#" class="white-nav-bar-text ct-js-btnScroll">Sede</a></li>--}}
                        {{--<li class="onepage"><a href="#" class="white-nav-bar-text ct-js-btnScroll">Hoteles</a></li>--}}
                        <li class="onepage"><a href="{{ route('pluranza.jurors.public') }}" class="white-nav-bar-text ct-js-btnScroll">Jurados</a></li>
                        @if(!Auth::check() AND isset($configuration) AND !empty($configuration->rules_file_name))
                            <li class="onepage">
                                <a target="_blank" href="https://drive.google.com/file/d/0BxViq4jyVK_XX2dpZFp4VWVrMHM/view?usp=sharing" class="ct-js-btnScroll">
                                    Reglas de competencia                            
                                </a>
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