@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h5 class="text-center ct-u-paddingTop30">
                        Registrar competidores para la competencia <strong>({{ $competitionType->name }})</strong>, para <i>{{ $academy->name }}</i>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._flash')
                    @include('partials._errors')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::open(array(
                                        'url' => route('pluranza.competitors.store'),
                                        'method' => 'POST',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                    )) !!}
                        {!! Form::hidden('academy_id', $academy->id) !!}
                        {!! Form::hidden('competition_type_id', $competitionType->id) !!}
                        <div class="row competitor-select">
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
                                    {!! Form::text('name', (isset($name) ? $name : old('name')), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group {{ ($errors->has('category_id') ? 'has-error' : '') }}">
                                    @if ($errors->has('category_id'))
                                        <label class="control-label" for="category_id">
                                            <ul>
                                                @foreach($errors->get('category_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('category_id', (isset($categories) ? $categories : array()), old('category_id'), ['placeholder' => 'Selecciona un género', 'class' => 'form-control input-sm category-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group {{ ($errors->has('level_id') ? 'has-error' : '') }}">
                                    @if ($errors->has('level_id'))
                                        <label class="control-label" for="level_id">
                                            <ul>
                                                @foreach($errors->get('level_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('level_id', array(), old('level_id'), ['placeholder' => 'Selecciona un nivel', 'class' => 'form-control input-sm level-select']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if (strtolower($competitionType->name) == 'pareja')
                                <div class="col-sm-4">
                                    <div class="form-group {{ ($errors->has('dancer_id[female]') ? 'has-error' : '') }}">
                                        @if ($errors->has('dancer_id'))
                                            <label class="control-label" for="dancer_id['female']">
                                                <ul>
                                                    @foreach($errors->get('dancer_id')['female'] as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            </label>
                                        @endif
                                        {!! Form::select('dancer_id[female]', (isset($dancers['female']) ? $dancers['female'] : array()), old('dancer_id["female"]'), ['placeholder' => 'Selecciona bailarina', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group {{ ($errors->has('dancer_id[masculine]') ? 'has-error' : '') }}">
                                        @if ($errors->has('dancer_id'))
                                            <label class="control-label" for="dancer_id['masculine']">
                                                <ul>
                                                    @foreach($errors->get('dancer_id')['masculine'] as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            </label>
                                        @endif
                                        {!! Form::select('dancer_id[masculine]', (isset($dancers['masculine']) ? $dancers['masculine'] : array()), old('dancer_id["masculine"]'), ['placeholder' => 'Selecciona bailarín', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-4">
                                    <div class="form-group {{ ($errors->has('dancer_id') ? 'has-error' : '') }}">
                                        @if ($errors->has('dancer_id'))
                                            <label class="control-label" for="dancer_id">
                                                <ul>
                                                    @foreach($errors->get('dancer_id') as $error)
                                                        <li>{!! $error !!}</li>
                                                    @endforeach
                                                </ul>
                                            </label>
                                        @endif
                                        @if (strtolower($competitionType->name) == 'solista')
                                            {!! Form::select('dancer_id[]', (isset($dancers) ? $dancers : array()), ( isset($dancerId) AND $dancerId > 0 ? $dancerId : old('dancer_id')), ['placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                        @else
                                            {!! Form::select('dancer_id[]', (isset($dancers) ? $dancers : array()), ( isset($dancerId) AND $dancerId > 0 ? $dancerId : old('dancer_id')), ['multiple' => 'multiple', 'placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-9 col-sm-3">
                                {!! Form::submit('Guardar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@include('pluranza.competitors.partials._select-competition-category-script-new')