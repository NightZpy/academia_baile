@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Registrar bailarín en <i>{{ $academy->name }}</i>
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    @include('partials._flash')
                    {!! Form::open(array(
                                        'url' => route('pluranza.dancers.store'),
                                        'method' => 'post',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                        )) !!}
                        @include('pluranza.dancers.partials._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop