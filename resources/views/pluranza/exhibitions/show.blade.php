@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="row ct-u-paddingTop100">
            <div class="col-md-12 ct-titleBox">
                <h4 class="text-center text-uppercase ct-u-paddingTop30">
                    <i>Perfil</i>
                </h4>
            </div>
        </div>
        <div class="container ct-u-paddingTop5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="ct-titleBox text-uppercase ct-u-paddingTop40">
                        Bailarin, director
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
                            <h5 class="ct-personBox-name ct-u-colorMotive ct-u-size24">
                                {{ $dancer->fullName }}
                            </h5>
                            <div class="ct-personBox-place ct-u-colorLightGrey">
                                <p>La Habana, Cuba</p>
                            </div>
                            <div class="ct-personBox-description">
                                <p class="ct-u-paddingTop20">
                                    <strong>Se unió a {{ $academy->name }}:</strong> 2013
                                </p>
                                <p>
                                    <strong>Géneros:</strong> Cuban National Ballet School, National School of Arts – Vincentia de la Torre
                                </p>
                                <p>
                                    <strong>Otras academías:</strong> Ballet de Camagüey, National Ballet of Cuba
                                </p>
                                <p class="text-justify-xs">
                                    <strong>Acerca:</strong> Cras quis dolor sollicitudin, fringilla augue et, tempus purus. Donec ut magna em
                                    get libero tincidunt vestibulum vel et risus. Nulla mollis pharetra accumsan. Donec et congus
                                    ue augue, nec maximus metus. Curabitur justo erat, gravida et consequat nec, posuere velian
                                    libero. Sed sagittis nibh a nunc scelerisque, sit amet eleifend lacus egestas. Suspendisse dictu
                                    am velit, molestie nec augue in, rutrum varius nisl. Duis efficitur sed purus sit amet finibus et
                                    sed volutpat dictum dui, eu mollis lacus tincidunt sit amet.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop