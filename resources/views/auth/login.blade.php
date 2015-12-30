@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="row ct-u-paddingTop10">
                        <div class="col-md-12 text-center ct-titleBox">
                            <h4 class="text-uppercase ct-u-paddingTop30">
                                Ingresar
                            </h4>
                        </div>
                    </div>
                    <div class="row ct-u-paddingTop25">
                        {!! Form::open(
                            [
                                'route' => ['users.login'],
                                'method' => 'POST',
                                'role' => 'form'
                            ])
                        !!}
                            <div class="form-group {{ ($errors->has('email') ? 'has-error' : '') }}">
                                @if ($errors->has('email'))
                                    <label class="control-label" for="email">
                                        <ul>
                                            @foreach($errors->get('email') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::text('email', old('email'), array('placeholder' => 'Email del usuario', 'class' => 'form-control input-sm')) !!}
                            </div>
                            <div class="form-group {{ ($errors->has('password') ? 'has-error' : '') }}">
                                @if ($errors->has('password'))
                                    <label class="control-label" for="email">
                                        <ul>
                                            @foreach($errors->get('password') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                            </div>
                            <button type="submit" class="btn btn-xs btn-primary btn-block text-uppercase">Ingresar</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <div class="help-block ct-u-size20 ct-u-colorLighterGray">
                            <a class="text-left" href="{{ route('users.password.reset') }}"class="ct-js-btnScroll">&iexcl;Recuperar contrase&ntilde;a!</a>
                            <a class="text-right" href="{{ route('pluranza.academies.new') }}"class="ct-js-btnScroll">¡Registrarse!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop