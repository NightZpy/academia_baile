@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Pagos @if(isset($academy)) de <i> {{ $academy->name }}</i> @endif
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._errors')
                </div>
            </div>
            @role(['admin', 'director'])
            @route('pluranza.payments.by-academy')
                @include('pluranza.payments.partials._header')
            @endroute
            @endrole
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-1 col-md-10">
                    @include('partials._table')
                </div>
            </div>
        </div>
    </section>
@stop