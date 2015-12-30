@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row ct-u-paddingTop10">
                        <div class="col-md-12 text-center ct-titleBox">
                            <h4 class="text-uppercase ct-u-paddingTop30">
                                Enviar correo de recuperación
                            </h4>
                        </div>
                    </div>
                    <div class="row ct-u-paddingTop25">
                        {!! Form::open(
                            [
                                'route' => ['users.password.send-reset'],
                                'method' => 'POST',
                                'role' => 'form'
                            ])
                        !!}
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
                                <button type="submit" class="btn btn-xs btn-primary btn-block text-uppercase">Enviar enlace de recuperación</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop