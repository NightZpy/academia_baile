@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row ct-u-paddingTop10">
                        <div class="col-md-12 text-center ct-titleBox">
                            <h4 class="text-uppercase ct-u-paddingTop30">
                                Ingrese nueva contraseña
                            </h4>
                        </div>
                    </div>
                    <div class="row ct-u-paddingTop25">
                        {!! Form::open(
                            [
                                'route' => ['users.password.reset-check-token'],
                                'method' => 'POST',
                                'role' => 'form'
                            ])
                        !!}
                            {!! Form::hidden('token', $token) !!}
                            <div class="row">
                                <div class="col-sm-offset-4 col-sm-4">
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
                                        {!! Form::text('email', old('email'), array('placeholder' => 'Email de recuperación', 'class' => 'form-control input-sm')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-offset-4 col-sm-4">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="form-group {{ ($errors->has('password_confirmation') ? 'has-error' : '') }}">
                                        @if ($errors->has('password_confirmation'))
                                            <label class="control-label" for="email">
                                                <ul>
                                                    @foreach($errors->get('password_confirmation') as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            </label>
                                        @endif
                                        {!! Form::password('password_confirmation', ['placeholder' => 'Confirmar contraseña', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <div class="form-group {{ ($errors->has('g-recaptcha-response') ? 'has-error background-error-color' : '') }}">
                                        @if ($errors->has('g-recaptcha-response'))
                                            <label class="control-label" for="g-recaptcha-response">
                                                <ul>
                                                    @foreach($errors->get('g-recaptcha-response') as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            </label>
                                        @endif
                                        {!! app('captcha')->display() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <button type="submit" class="btn btn-xs btn-primary btn-block text-uppercase">Enviar enlace de recuperación</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop