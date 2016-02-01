@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="row ct-u-paddingTop10">
            <div class="col-md-12 ct-titleBox">
                <h4 class="text-center text-uppercase ct-u-paddingTop30">
                    <i>{{ $academy->name }}</i>
                </h4>
            </div>
        </div>
        {{-- <div class="container ct-u-paddingTop5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="ct-titleBox text-uppercase ct-u-paddingTop40">
                        @if($academy->competitors)
                            Bailarín
                        @endif
                        @if($academy->director)
                             Director
                        @endif
                        @if($academy->academy->independent)
                             Independiente
                        @endif
                    </h5>
                </div>
            </div>
        </div> --}}
        <div class="container ct-u-paddingBoth60">
            <div class="row">
                <div class="col-md-12">
                    <div class="ct-personBox ct-personBox-single ct-personBox--leftSide">
                        <div class="ct-personBox-image">
                            <img src="{{ $academy->logo->url('medium') }}" alt="{{ $academy->name }}">
                        </div>
                        <article class="ct-personBox-content">                            
                            {{-- <h5 class="ct-personBox-name ct-u-colorMotive ct-u-size24">
                                
                            </h5> --}}
                            @if ($academy->estate)
                            <div class="ct-personBox-place ct-u-colorLightGrey">
                                <p>{{ $academy->estate->name }}, 
                                @if ($academy->city) 
                                    {{ $academy->city->name }}
                                @else
                                    {{ $academy->municipality->name }}
                                @endif
                                </p>
                            </div>
                            @endif
                            <div class="ct-personBox-description">
                                @if($academy->dancers->count())
                                    <p class="ct-u-paddingTop20">
                                        <strong>Bailarines: </strong><a class="ct-js-btnScroll" target="_blank" href="{{ route('pluranza.dancers.by-academy', $academy->id) }}">Ver</a>
                                    </p>
                                @endif
                                @if($academy->competitors->count())
                                    <p class="ct-u-paddingTop20">
                                        <strong>Competidores: </strong><a class="ct-js-btnScroll" target="_blank" href="{{ route('pluranza.competitors.by-academy', $academy->id) }}">Ver</a>
                                    </p>
                                @endif
                                <p class="ct-u-paddingTop20">
                                    <strong>Tiene:</strong> {{ $academy->age }} años.
                                </p>
                                {{--<p>
                                    <strong>Géneros:</strong> Cuban National Ballet School, National School of Arts – Vincentia de la Torre
                                </p>--}}
                                {{--<p>
                                    <strong>Otras academías:</strong> Ballet de Camagüey, National Ballet of Cuba
                                </p>--}}
                                @if($academy->history)
                                    <p class="text-justify-xs">
                                        <strong>Acerca:</strong> {{ $academy->history }}.
                                    </p>
                                 @endif
                                @if($academy->facebook)
                                    <p class="ct-u-paddingTop20">
                                        <strong>Facebook: </strong><a class="ct-js-btnScroll" target="_blank" href="{{ $academy->facebook }}">Ver</a>
                                    </p>
                                @endif
                                @if($academy->twitter)
                                    <p class="ct-u-paddingTop20">
                                        <strong>Twitter: </strong><a class="ct-js-btnScroll" target="_blank" href="{{ $academy->twitter }}">Ver</a>
                                    </p>
                                @endif
                                @if($academy->instagram)
                                    <p class="ct-u-paddingTop20">
                                        <strong>Instagram: </strong><a class="ct-js-btnScroll" target="_blank" href="{{ $academy->instagram }}">Ver</a>
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