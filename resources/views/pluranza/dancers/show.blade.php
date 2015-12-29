@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="row ct-u-paddingTop10">
            <div class="col-md-12 ct-titleBox">
                <h4 class="text-center text-uppercase ct-u-paddingTop30">
                    Perfil de <i>{{ $dancer->fullName }}</i>
                </h4>
            </div>
        </div>
        <div class="container ct-u-paddingTop5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="ct-titleBox text-uppercase ct-u-paddingTop40">
                        @if($dancer->competitors)
                            Bailarín
                        @endif
                        @if($dancer->director)
                             Director
                        @endif
                        @if($dancer->academy->independent)
                             Independiente
                        @endif
                    </h5>
                </div>
            </div>
        </div>
        <div class="container ct-u-paddingBoth60">
            <div class="row">
                <div class="col-md-12">
                    <div class="ct-personBox ct-personBox-single ct-personBox--leftSide">
                        <div class="ct-personBox-image">
                            <img src="{{ $dancer->photo->url('medium') }}" alt="{{ $dancer->fullName }}">
                        </div>
                        <article class="ct-personBox-content">
                            {{--<h5 class="ct-personBox-name ct-u-colorMotive ct-u-size24">
                                {{ $dancer->fullName }}
                            </h5>--}}
                            {{--<div class="ct-personBox-place ct-u-colorLightGrey">
                                <p>La Habana, Cuba</p>
                            </div>--}}
                            <div class="ct-personBox-description">
                                <p class="ct-u-paddingTop20">
                                    <strong>Tiene:</strong> {{ $dancer->age }} años.
                                </p>
                                {{--<p>
                                    <strong>Géneros:</strong> Cuban National Ballet School, National School of Arts – Vincentia de la Torre
                                </p>--}}
                                {{--<p>
                                    <strong>Otras academías:</strong> Ballet de Camagüey, National Ballet of Cuba
                                </p>--}}
                                <p>
                                    <strong>Baila en: </strong> {{ $dancer->academy->name }}.
                                </p>
                                @if($dancer->biography  )
                                    <p class="text-justify-xs">
                                        <strong>Acerca:</strong> {{ $dancer->biography }}.
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