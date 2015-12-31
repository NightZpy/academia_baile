@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 text-center ct-titleBox">
                    <h4 class="text-uppercase ct-u-paddingTop30">
                        Academia <i>{!! $academy->name !!}</i>
                    </h4>
                </div>
            </div>

            <div class="row ct-u-paddingTop25">
                {!! Form::model($academy,
                    [
                        'route' => ['pluranza.academies.update', $academy->id],
                        'method' => 'PATCH',
                        'role' => 'form',
                        'files' => true
                    ])
                !!}
                <div class="row">
                    <h5 class="text-center ct-titleBox">Obligatorio (*)</h5>
                </div>
                <div class="col-sm-offset-1 col-sm-5">
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="form-group {{ ($errors->has('name') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('name'))
                                    <label class="control-label" for="name">
                                        <ul>
                                            @foreach($errors->get('name') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="logo">
                                    Nombre de la academia (Si es independiente, coloque su nombre)(*)
                                </label>
                                {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="form-group {{ ($errors->has('email') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('email'))
                                    <label class="control-label" for="email">
                                        <ul>
                                            @foreach($errors->get('email') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="logo">
                                    Correo electrónico (Obligatorio para contacto)(*)
                                </label>
                                {!! Form::text('email', old('email'), array('placeholder' => 'Email de la Academia', 'class' => 'form-control input-sm', 'disabled' => 'disabled', 'required' => 'required')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="form-group {{ ($errors->has('phone') ? 'has-error background-error-color' : '') }}">
                                @if ($errors->has('phone'))
                                    <label class="control-label" for="phone">
                                        <ul>
                                            @foreach($errors->get('phone') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="logo">
                                    Teléfono (Obligatorio para contacto)(*)
                                </label>
                                {!! Form::text('phone', old('phone'), array('placeholder' => 'Teléfono de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8  {{ ($errors->has('foundation') ?  'has-error background-error-color' : '') }}">
                            <div class="form-group">
                                @if ($errors->has('foundation'))
                                    <label class="control-label" for="foundation">
                                        <ul>
                                            @foreach($errors->get('foundation') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="logo">
                                    Fecha de fundación (Si es independiente: desde que baila)
                                </label>
                                {!! Form::date('foundation', ( $foundation > 0 ? $foundation : old('foundation')), array('placeholder' => 'Fecha de fundaciión', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="form-group {{ ($errors->has('history') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('history'))
                                    <label class="control-label" for="history">
                                        <ul>
                                            @foreach($errors->get('history') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="logo">
                                    Describe la travesía de tu academia en menos de 1024 carácteres.
                                </label>
                                {!! Form::textarea('history', old('history'), array('placeholder' => 'Breve historia de la academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="address-select">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('estate_id') ?  'has-error background-error-color' : '') }}">
                                    @if ($errors->has('estate_id'))
                                        <label class="control-label" for="estate_id">
                                            <ul>
                                                @foreach($errors->get('estate_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label ct-titleBox" for="estate_id">
                                        Estado donde se ubican (*)
                                    </label>
                                    {!! Form::select('estate_id', $estates, ( $estateId > 0 ? $estateId : old('estate_id')), ['placeholder' => 'Selecciona un estado', 'class' => 'form-control input-sm estate-select', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('municipality_id') ?  'has-error background-error-color' : '') }}">
                                    @if ($errors->has('municipality_id'))
                                        <label class="control-label" for="municipality_id">
                                            <ul>
                                                @foreach($errors->get('municipality_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label ct-titleBox" for="municipality_id">
                                        Municipio donde se ubican (*)
                                    </label>
                                    {!! Form::select('municipality_id', $municipalities, ( $municipalityId > 0 ? $municipalityId : old('municipality_id')), ['placeholder' => 'Selecciona un municipio', 'class' => 'form-control input-sm municipality-select']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('parish_id') ?  'has-error background-error-color' : '') }}">
                                    @if ($errors->has('parish_id'))
                                        <label class="control-label" for="parish_id">
                                            <ul>
                                                @foreach($errors->get('parish_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label" for="logo">
                                        Parroquia donde se ubican (Sino la consigue, puede dejar en blanco)
                                    </label>
                                    {!! Form::select('parish_id', $parishes, ( $parishId > 0 ? $parishId : old('parish_id')), ['placeholder' => 'Selecciona una parroquia', 'class' => 'form-control input-sm parish-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ ($errors->has('city_id') ?  'has-error background-error-color' : '') }}">
                                    @if ($errors->has('city_id'))
                                        <label class="control-label" for="city_id">
                                            <ul>
                                                @foreach($errors->get('city_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label" for="logo">
                                        Ciudad donde se ubican (Sino la consigue, puede dejar en blanco)
                                    </label>
                                    {!! Form::select('city_id', $cities, ( $cityId > 0 ? $cityId : old('city_id')), ['placeholder' => 'Selecciona una ciudad', 'class' => 'form-control input-sm city-select']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ ($errors->has('address') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('address'))
                                    <label class="control-label" for="address">
                                        <ul>
                                            @foreach($errors->get('address') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label ct-titleBox" for="address">
                                    Más detalles de la dirección
                                </label>
                                {!! Form::textarea('address', old('address'), array('placeholder' => 'Dirección de la Academia', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ ($errors->has('facebook') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('facebook'))
                                    <label class="control-label" for="facebook">
                                        <ul>
                                            @foreach($errors->get('facebook') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label" for="facebook">
                                    Dirección URL de Facebook
                                </label>
                                {!! Form::text('facebook', old('facebook'), array('placeholder' => 'URL de Facebook', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ ($errors->has('twitter') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('twitter'))
                                    <label class="control-label" for="twitter">
                                        <ul>
                                            @foreach($errors->get('twitter') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label" for="twitter">
                                    Dirección URL de Twitter
                                </label>
                                {!! Form::text('twitter', old('twitter'), array('placeholder' => 'URL de Twitter', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ ($errors->has('instagram') ?  'has-error background-error-color' : '') }}">
                                @if ($errors->has('instagram'))
                                    <label class="control-label" for="instagram">
                                        <ul>
                                            @foreach($errors->get('instagram') as $error)
                                                <li>{!! $error !!}</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                @endif
                                <label class="control-label" for="instagram">
                                    Dirección URL de Instagram
                                </label>
                                {!! Form::text('instagram', old('instagram'), array('placeholder' => 'URL de Instagram', 'class' => 'form-control input-sm')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="btn-group" data-toggle="buttons" role="group">
                                <?php
                                    $active = '';
                                    if ((isset($academy) AND $academy->independent) OR old('independent')):
                                        $active = 'active';
                                    endif
                                ?>
                                <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14 {{ $active }}">
                                    {!! Form::checkbox('independent', null, old('director'), array('class' => 'form-control input-sm')) !!}
                                    Independiente
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <div class="form-group {{ ($errors->has('logo') ?  'has-error background-error-color' : '') }}">
                            @if ($errors->has('logo'))
                                <label class="control-label" for="logo">
                                    <ul>
                                        @foreach($errors->get('logo') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            <label class="control-label ct-titleBox" for="logo">
                                Imagen del logo de la academia (No mayor a 1mb)
                            </label>
                            {!! Form::file('logo', array('placeholder' => 'Logo de la Academia', 'class' => 'file-upload')) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        {!! Form::submit('Actualizar Información', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop

@include('pluranza.academies.partials._select-address-script')

@push('styles')
<style>
    label.btn.btn-sm.btn-default {
        background-color: black;
        color: white;
    }

    label.btn.btn-sm.btn-default.active {
        background-color: grey;
        font-weight: bold;
    }
</style>
@endpush