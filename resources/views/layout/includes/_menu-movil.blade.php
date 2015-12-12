<div class="ct-menuMobile">
    <ul class="ct-menuMobile-navbar">
        <li><a href="#home" class="ct-js-btnScroll--mobile">Inicio</a></li>
        <li><a href="#join-us" class="ct-js-btnScroll--mobile">Únete</a></li>
        <li><a href="#videos" class="ct-js-btnScroll--mobile">Videos</a></li>
        <li><a href="#academy-show" class="ct-js-btnScroll--mobile">Academias</a></li>
        <li><a href="#blog" class="ct-js-btnScroll--mobile">Blog</a></li>
        @if(Auth::user())
            <li><a href="{{ route('users.logout') }}" class="ct-js-btnScroll--mobile">Salir</a></li>
        @endif
    </ul>
</div>