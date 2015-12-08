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
                        <div class="form-group {{ ($errors->has('name') ? 'has-error' : 'has-success') }}">
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
                        <div class="form-group {{ ($errors->has('email') ? 'has-error' : 'has-success') }}">
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
                        <div class="form-group {{ ($errors->has('phone') ? 'has-error' : 'has-success') }}">
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
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <div class="form-group {{ ($errors->has('address') ? 'has-error' : 'has-success') }}">
                                @if ($errors->has('address'))
                                    <label class="control-label" for="address">
                                        <ul>
                                            @foreach($errors->get('address') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::textarea('address', old('address'), array('placeholder' => 'Direcci&#243;n de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('estate_id') ? 'has-error' : 'has-success') }}">
                                    @if ($errors->has('estate_id'))
                                        <label class="control-label" for="estate_id">
                                            <ul>
                                                @foreach($errors->get('estate_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('estate_id', $estates, old('estate_id') || $estateId, ['placeholder' => 'Selecciona un estado', 'class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('municipality_id') ? 'has-error' : 'has-success') }}">
                                    @if ($errors->has('municipality_id'))
                                        <label class="control-label" for="municipality_id">
                                            <ul>
                                                @foreach($errors->get('municipality_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('municipality_id', $municipalities, old('municipality_id') || $municipalityId, ['placeholder' => 'Selecciona un municipio', 'class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('parish_id') ? 'has-error' : 'has-success') }}">
                                    @if ($errors->has('parish_id'))
                                        <label class="control-label" for="parish_id">
                                            <ul>
                                                @foreach($errors->get('parish_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('parish_id', $parishes, old('parish_id') || $parishId, ['placeholder' => 'Selecciona una parroquia', 'class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('city_id') ? 'has-error' : 'has-success') }}">
                                    @if ($errors->has('city_id'))
                                        <label class="control-label" for="city_id">
                                            <ul>
                                                @foreach($errors->get('city_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('city_id', $cities, old('city_id') || $cityId, ['placeholder' => 'Selecciona una ciudad', 'class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ ($errors->has('history') ? 'has-error' : 'has-success') }}">
                            @if ($errors->has('history'))
                                <label class="control-label" for="history">
                                    <ul>
                                        @foreach($errors->get('history') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            {!! Form::textarea('history', old('history'), array('placeholder' => 'Breve historia de la academia', 'class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <div class="form-group {{ ($errors->has('foundation') ? 'has-error' : 'has-success') }}">
                                @if ($errors->has('foundation'))
                                    <label class="control-label" for="foundation">
                                        <ul>
                                            @foreach($errors->get('foundation') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::date('foundation', old('foundation') || \Carbon\Carbon::now(), array('placeholder' => 'Fecha de fundaci&#243;n', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ ($errors->has('logo') ? 'has-error' : 'has-success') }}">
                                @if ($errors->has('logo'))
                                    <label class="control-label" for="logo">
                                        <ul>
                                            @foreach($errors->get('logo') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                {!! Form::file('logo', array('placeholder' => 'Logo de la Academia')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group {{ ($errors->has('facebook') ? 'has-error' : 'has-success') }}">
                            @if ($errors->has('facebook'))
                                <label class="control-label" for="facebook">
                                    <ul>
                                        @foreach($errors->get('facebook') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            {!! Form::text('facebook', old('facebook'), array('placeholder' => 'Facebook de la Academia', 'class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ ($errors->has('twitter') ? 'has-error' : 'has-success') }}">
                            @if ($errors->has('twitter'))
                                <label class="control-label" for="twitter">
                                    <ul>
                                        @foreach($errors->get('twitter') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            {!! Form::text('twitter', old('twitter'), array('placeholder' => 'Twitter de la Academia', 'class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group {{ ($errors->has('instagram') ? 'has-error' : 'has-success') }}">
                            @if ($errors->has('instagram'))
                                <label class="control-label" for="instagram">
                                    <ul>
                                        @foreach($errors->get('instagram') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            {!! Form::text('instagram', old('instagram'), array('placeholder' => 'Instagram de la Academia', 'class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-9 col-sm-3">
                        {!! Form::submit('Actualizar Informaci&#243;n', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop