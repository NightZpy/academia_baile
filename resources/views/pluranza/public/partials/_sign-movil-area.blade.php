@if(Auth::user())
    <li><a href="{{ route('users.logout') }}" class="ct-js-btnScroll--mobile text-uppercase ct-u-size14">Salir</a></li>
@else
    <li><a href="{{ route('users.login') }}" class="ct-js-btnScroll--mobile text-uppercase ct-u-size14">Ingresar</a></li>
@endif