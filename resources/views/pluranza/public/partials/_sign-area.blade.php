@if(Auth::user())
    <a href="{{ route('users.logout') }}" class="btn btn-sm btn-danger btn-circle"><i class="fa fa-sign-out fa-2x"></i> Salir</a>
@else
    <a href="{{ route('users.login') }}" class="btn btn-sm btn-danger btn-circle"><i class="fa fa-sign-in fa-2x"></i> Ingresar</a>
@endif