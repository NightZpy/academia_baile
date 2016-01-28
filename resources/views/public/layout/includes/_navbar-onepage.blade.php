<nav class="navbar yamm white navbar-public-white" role="navigation" data-startnavbar="0" data-offset="114"><!-- NavBar [begin] -->
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="row">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="navbar-header">
                        <a class="navbar-brand ct-js-btnScroll" href="{{ route('home') }}">
                            <img src="/assets/images/logo.png" alt="Al Compás - Academia de Baile">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <ul class="nav navbar-nav navbar-right ct-navbar--fadeIn">
                        <li class="onepage"><a href="#join-us" class="ct-js-btnScroll">Inicio</a></li>
                        {{--<li class="onepage"><a href="#join-us" class="ct-js-btnScroll">Pluranza 2016: Únete</a></li>--}}
                        <li class="onepage"><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll">Pluranza 2016</a></li>
                        <li class="onepage">
                            <a target="_blank" href="{{ $configuration->rules->url() }}" class="ct-js-btnScroll">
                                Reglas de competencia                            
                            </a>
                        </li>>
                        {{--<li class="onepage"><a href="#videos" class="ct-js-btnScroll">Vídeos</a></li>--}}
                        {{--<li class="onepage"><a href="#academy-show" class="ct-js-btnScroll">Academias</a></li>--}}
                        {{--<li class="onepage"><a href="#blog" class="ct-js-btnScroll" >Blog</a></li>--}}
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