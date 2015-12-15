@if(Auth::user())
    <li><a href="{{ route('users.logout') }}" class="ct-js-btnScroll--mobile">Salir</a></li>
@else
    <li><a href="{{ route('users.login') }}" class="ct-js-btnScroll--mobile">Ingresar</a></li>
@endif