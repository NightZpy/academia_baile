@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Hospedaje
                    </h4>
                </div>
            </div>
            @foreach($lodgings as $lodging)
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <h6 class="ct-fw-400 ct-u-colorMotive ct-u-paddingTop10">{{ $lodging->name }}</h6>
                        <ul class="ct-list--paddingLeft15">
                            <li><strong>Télefonos:</strong> <i>{{ $lodging->phones }}</i></li>
                            <li><strong>Web:</strong> <i><a href="{{ $lodging->web }}">{{ $lodging->web }}</a></i></li>
                            <li><strong>Dirección:</strong> <i><p>
                                {{ $lodging->address }}</i>
                            </p></li>
                        </ul>
                    </div>
                </div>
                <hr class="ct-divider-Lighter--height20">
            @endforeach
        </div>
    </section>
@stop