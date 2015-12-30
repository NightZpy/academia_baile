@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Actualizar categoría
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
                    {!! Form::model($competitionType, array(
                                        'url' => route('pluranza.competition-types.update', $competitionType->id),
                                        'method' => 'PATCH',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                        )) !!}
                        @include('pluranza.competition-types.partials._form')
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-4">
                                {!! Form::submit('Actualizar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop