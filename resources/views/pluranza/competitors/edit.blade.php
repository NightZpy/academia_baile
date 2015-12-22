@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Actualizar a: <i>{{ $competitor->name }}</i>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._flash')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::model($competitor,
                                    array(
                                        'url' => route('pluranza.competitors.update', $competitor->id),
                                        'method' => 'PATCH',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                        )) !!}

                        <div class="row competitor-select">
                            <div class="col-sm-3">
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
                                    {!! Form::text('name', old('name'), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                                    {!! Form::select('category_id', (isset($categories) ? $categories : array()), ( isset($categoryId) AND $categoryId > 0 ? $categoryId : old('category_id')), ['placeholder' => 'Selecciona una categoría', 'class' => 'form-control input-sm category-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                                    {!! Form::select('level_id', (isset($levels) ? $levels : array()), ( isset($levelId) AND $levelId > 0 ? $levelId : old('level_id')), ['placeholder' => 'Selecciona un nivel', 'class' => 'form-control input-sm level-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group {{ ($errors->has('competition_type_id') ? 'has-error' : '') }}">
                                    @if ($errors->has('competition_type_id'))
                                        <label class="control-label" for="competition_type_id">
                                            <ul>
                                                @foreach($errors->get('competition_type_id') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('competition_type_id', (isset($competitionTypes) ? $competitionTypes : array()), ( isset($competitionTypeId) AND $competitionTypeId > 0 ? $competitionTypeId : old('competition_type_id')), ['placeholder' => 'Selecciona un tipo', 'class' => 'form-control input-sm competition-type-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                                    {!! Form::select('dancer_id[]', (isset($dancers) ? $dancers : array()), ( isset($dancerId) AND $dancerId > 0 ? $dancerId : old('dancer_id')), ['multiple' => 'multiple', 'placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-9 col-sm-3">
                                {!! Form::submit('Actualizar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@include('pluranza.competitors.partials._select-competition-category-script-edit')