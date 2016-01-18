@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Exhibiciones @if(isset($academy)) de <i> {{ $academy->name }}</i> @endif
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._errors')
                </div>
            </div>
            @role(['admin', 'director'])
                <div class="row ct-u-paddingTop25">
                    <div class="col-md-10">
                        @route('pluranza.exhibitions.by-academy')
                            <a href="{{ route('pluranza.exhibitions.new.by-academy', $academy->id) }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                        @else
                            @role(['admin'])
                                <a href="{{ route('pluranza.exhibitions.home') }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                            @endroute
                        @endroute
                    </div>
                </div>
            @endrole
            @include('pluranza.competitors.partials._add-competitor-header')
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-1 col-md-10">
                    @include('partials._table')
                </div>
            </div>
        </div>
    </section>
@stop