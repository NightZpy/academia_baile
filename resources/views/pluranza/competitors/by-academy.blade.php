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
            @if($competitionTypes)
                <div class="row ct-u-paddingTop25">
                    {!! Form::model($academy,
                        [
                            'route' => ['pluranza.competitors.new', $academy->id],
                            'method' => 'GET',
                            'role' => 'form',
                            'files' => true
                        ])
                    !!}
                    {!! Form::hidden('academy_id', $academy->id) !!}
                    <div class="col-md-8">
                        <div class="btn-group pull-right {{ ($errors->has('competition_type_id') ? 'has-error' : '') }}" data-toggle="buttons" role="group">
                            @if ($errors->has('competition_type_id'))
                                <label class="control-label" for="competition_type_id">
                                    <ul>
                                        @foreach($errors->get('competition_type_id') as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </label>
                            @endif
                            @foreach($competitionTypes as $competitionType)
                                <label class="btn btn-sm btn-default
                                 btn-circle text-uppercase ct-u-size14">
                                    {!! Form::radio('competition_type_id', $competitionType->id, null,  ['id' => 'competition_type_id']) !!}
                                    {!! $competitionType->name !!}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Agregar', [ 'class' => 'btn btn-sm btn-danger btn-circle pull-right text-uppercase ct-u-size14']) !!}
                    </div>
                </div>
            @endif
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-2 col-md-8">
                    @include('partials._table')
                </div>
            </div>
        </div>
    </section>
@stop

@push('styles')
<style>

label.btn.btn-sm.btn-default {
    background-color: ;
    color: white;
}

label.btn.btn-sm.btn-default.active {
    background-color: red;
    font-weight: bold;
}
</style>
@endpush