@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Registrarse en <i>Pluranza 2016</i>
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    @include('partials._flash')
                    {!! Form::open(array(
                                        'url' => route('pluranza.academies.store'),
                                        'method' => 'post',
                                        'accept-charset' => 'UTF-8'
                                        )) !!}

                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group {{ ($errors->has('name') ? 'has-error' : '') }}">
                                @if ($errors->has('name'))
                                    <label class="control-label" for="name">
                                        <ul>
                                            @foreach($errors->get('name') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-5">
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
                                {!! Form::text('email', old('email'), array('placeholder' => 'Email de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ ($errors->has('email_confirmation') ? 'has-error' : '') }}">
                                @if ($errors->has('email'))
                                    <label class="control-label" for="email_confirmation">
                                        <ul>
                                            @foreach($errors->get('email_confirmation') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::text('email_confirmation', old('email_confirmation'), array('placeholder' => 'Confirmar email', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-5">
                            <div class="form-group {{ ($errors->has('phone') ? 'has-error' : '') }}">
                                @if ($errors->has('phone'))
                                    <label class="control-label" for="phone">
                                        <ul>
                                            @foreach($errors->get('phone') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::text('phone', old('phone'), array('placeholder' => 'Tel&eacute;fono de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ ($errors->has('phone_confirmation') ? 'has-error' : '') }}">
                                @if ($errors->has('phone_confirmation'))
                                    <label class="control-label" for="phone_confirmation">
                                        <ul>
                                            @foreach($errors->get('phone_confirmation') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::text('phone_confirmation', old('phone_confirmation'), array('placeholder' => 'Confirmar tel&eacute;fono', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-5">
                            <div class="form-group {{ ($errors->has('password') ? 'has-error' : '') }}">
                                @if ($errors->has('password'))
                                    <label class="control-label" for="password">
                                        <ul>
                                            @foreach($errors->get('password') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::password('password', array('placeholder' => 'Contrase&ntilde;a', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ ($errors->has('password_confirmation') ? 'has-error' : '') }}">
                                @if ($errors->has('password_confirmation'))
                                    <label class="control-label" for="phone_confirmation">
                                        <ul>
                                            @foreach($errors->get('password_confirmation') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::password('password_confirmation', array('placeholder' => 'Confirmar contrase&ntilde;a', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-8 col-md-3">
                            {!! Form::submit('Enviar Informaci&#243;n', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop