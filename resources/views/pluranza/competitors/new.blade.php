@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h5 class="text-center ct-u-paddingTop30">
                        Registrar competidores para la competencia <strong>({{ $competitionType->name }})</strong>, para <i>{{ $academy->name }}</i>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._errors')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8 competitor-select">
                    {!! Form::open(array(
                                        'url' => route('pluranza.competitors.store'),
                                        'method' => 'POST',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                    )) !!}
                        @include('pluranza.competitors.partials._form')
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