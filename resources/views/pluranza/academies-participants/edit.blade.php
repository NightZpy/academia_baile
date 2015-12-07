@extends('pluranza.admin.main')

@section('content')
    <div class="clearfix"></div>
    <div class="row">
        <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
            <div class="container">
                <div class="row ct-u-paddingTop100">
                    <div class="col-md-12">
                        <h5 class="ct-titleBox text-uppercase ct-u-paddingTop30">
                            Academia <i>{!! $academieParticipant->name !!}</i>
                        </h5>
                    </div>
                </div>

                <div class="row ct-u-paddingTop25">
                    {!! Form::model($academieParticipant,
                        [
                            'route' => ['academies-participants.update', $academieParticipant->id],
                            'method' => 'post',
                            'role' => 'form'
                        ])
                    !!}
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Name error</label>
                                {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="email">Email error</label>
                            {!! Form::text('email', old('email'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@stop