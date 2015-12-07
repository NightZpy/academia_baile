@extends('pluranza.admin.main')

@section('content')
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
                        'role' => 'form',
                        'files' => true
                    ])
                !!}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="name">Name error</label>
                            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="email">Email error</label>
                            {!! Form::text('email', old('email'), array('placeholder' => 'Email de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="email">Phone error</label>
                            {!! Form::text('phone', old('phone'), array('placeholder' => 'Teléfono de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">Address error</label>
                                {!! Form::textarea('address', old('address'), array('placeholder' => 'Dirección de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Estate error</label>
                                    {!! Form::select('estate_id', $estates, old('estate_id') || $estateId, ['placeholder' => 'Selecciona un estado', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Municipality error</label>
                                    {!! Form::select('municipality_id', $municipalities, old('municipality_id') || $municipalityId, ['placeholder' => 'Selecciona un municipio', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Parish error</label>
                                    {!! Form::select('parish_id', $parishes, old('parish_id') || $parishId, ['placeholder' => 'Selecciona una parroquia', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">City error</label>
                                    {!! Form::select('city_id', $cities, old('city_id') || $cityId, ['placeholder' => 'Selecciona una ciudad', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="email">History error</label>
                            {!! Form::textarea('history', old('history'), array('placeholder' => 'Breve historia de la academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">foundation error</label>
                                {!! Form::date('foundation', old('foundation') || \Carbon\Carbon::now(), array('placeholder' => 'Fecha de fundación', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="email">logo error</label>
                                {!! Form::file('logo', array('placeholder' => 'Logo de la Academia')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="name">Name error</label>
                            {!! Form::text('facebook', old('facebook'), array('placeholder' => 'Facebook de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="email">Email error</label>
                            {!! Form::text('twitter', old('twitter'), array('placeholder' => 'Twitter de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="email">Phone error</label>
                            {!! Form::text('instagram', old('instagram'), array('placeholder' => 'Instagram de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop