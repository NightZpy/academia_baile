@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Categorías
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop10">
                <div class="col-md-10">
                    <a href="{{ route('pluranza.competition-types.new') }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
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