@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Grupos en competición de: <i>{{ $academy->name }}</i>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._flash')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-8">
                    @foreach($competitionTypes as $competitionType)
                        <div class="form-group pull-right">
                            <label class="control-label" for="instagram">
                        	    {!! Form::radio('competition_type_id', $competitionType->id, null,  ['id' => 'competition_type_id']) !!}
                                {!! $competitionType->name !!}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-2">
                    @if($competitionTypes)
                        <a href="{{ route('pluranza.competitors.new', $academy->id) }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                    @endif
                </div>
            </div>
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-2 col-md-8">
                    @include('partials._table')
                </div>
            </div>
        </div>
    </section>
@stop