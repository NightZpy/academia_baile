@extends('pluranza.main')

@section('content')
    @include('partials._flash')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 text-center ct-titleBox">
                    <h4 class="text-uppercase ct-u-paddingTop30">
                        Registrarse en <i>Pluranza 2016</i>
                    </h4>
                </div>
            </div>

            <div class="row ct-u-paddingTop25">
                @include('partials._flash')
                @include('partials._errors')
                {!! Form::open(array(
                                    'url' => route('pluranza.academies-participants.store'),
                                    'method' => 'post',
                                    'accept-charset' => 'UTF-8'
                                    )) !!}

                <div class="row">
                    <div class="col-sm-4">
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
                            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                            {!! Form::text('email', old('email'), array('placeholder' => 'Email de la Academia', 'class' => 'form-control input-sm', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                            {!! Form::text('phone', old('phone'), array('placeholder' => 'Teléfono de la Academia', 'class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-offset-9 col-sm-3">
                        {!! Form::submit('Enviar Informaci&#243;n', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop