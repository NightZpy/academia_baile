<nav class="navbar yamm white" role="navigation" data-startnavbar="0" data-offset="114"><!-- NavBar [begin] -->
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="row">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <img src="/assets/images/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12">
                    <ul class="nav navbar-nav navbar-right ct-navbar--fadeIn">
                        <li class="onepage"><a href="{{ route('pluranza.home') }}" class="ct-js-btnScroll">Inicio</a></li>
                        <li class="onepage"><a href="#" class="ct-js-btnScroll">Editar</a></li>
                        <li class="onepage"><a href="#" class="ct-js-btnScroll">Miembros</a></li>
                        <li class="onepage"><a href="#" class="ct-js-btnScroll">Resultados</a></li>
                        @if(Auth::user())
                            <li class="onepage"><a href="{{ route('users.logout') }}" class="ct-js-btnScroll">Salir</a></li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</nav><!-- NavBar [end] -->