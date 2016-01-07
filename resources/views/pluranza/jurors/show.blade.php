@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="row ct-u-paddingTop10">
            <div class="col-md-12 ct-titleBox">
                <h4 class="text-center text-uppercase ct-u-paddingTop30">
                    Perfil de <i>{{ $jury->fullName }}</i>
                </h4>
            </div>
        </div>
        <div class="container ct-u-paddingTop5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="ct-titleBox text-uppercase ct-u-paddingTop40">
                        Jurado
                    </h5>
                </div>
            </div>
        </div>
        <div class="container ct-u-paddingBoth60">
            <div class="row">
                <div class="col-md-12">
                    <div class="ct-personBox ct-personBox-single ct-personBox--leftSide">
                        <div class="ct-personBox-image">
                            <img src="{{ $jury->photo->url('medium') }}" alt="{{ $jury->fullName }}">
                        </div>
                        <article class="ct-personBox-content">                            
                            <div class="ct-personBox-description">
                                <p class="ct-u-paddingTop20">
                                    <strong>Tiene:</strong> {{ $jury->age }} años.
                                </p>
                                <p>
                                    <strong>Evaluará en: </strong> {{ $jury->categoriesList }}.
                                </p>
                                @if($jury->biography)
                                    <p class="text-justify-xs">
                                        <strong>Acerca:</strong> {{ $jury->biography }}.
                                    </p>
                                 @endif
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop