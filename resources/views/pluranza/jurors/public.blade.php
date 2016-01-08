@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Jurados Invitados
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-10">
                    @role(['admin'])
                        <a href="{{ route('pluranza.jurors.home') }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                    @endroute
                </div>
            </div>            
        </div>
        <div class="container">
            @foreach ($categories as $category)
            <div class="row ct-u-paddingTop5">
                <div class="col-md-12">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        {{ $category->name }}
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop30">
                <div class="col-md-12">
                    <div class="row ct-u-paddingTop30 ct-u-paddingBottom70">
                        <div class="ct-js-owl ct-u-owl ct-twoLinesCarousel ct-carouselNavigation--arrowsTopRight owl-carousel owl-theme" data-single="false" data-navigation="true" data-pagination="false" data-items="5" data-autoplay="false" data-snap-ignore="true" style="opacity: 1; display: block;">
                            <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2736px; left: 0px; display: block; transform: translate3d(0px, 0px, 0px);"><div class="owl-item active" style="width: 228px;"><div class="item"><!-- Item 2A, Item 2B -->
                            <div class="ct-owlCarousel-twoLinesWrapper">
                                @foreach ($category->jurors as $jury)
                                    <a href="{{ route ('pluranza.jurors.show', $jury->id) }}" class="ct-personBox ct-personBox--primary ct-js-btnScroll personBox-a-margin-side">
                                        <figure class="ct-personBox-image">
                                            <img src="{{ $jury->photo->url('public') }}" alt="{{ $jury->fullName }}">
                                            <figcaption>
                                            <div class="ct-personBox-name">{{ $jury->fullName }}</div>
                                            <span class="ct-personBox-linkHelper">Ver</span>
                                            </figcaption>
                                        </figure>
                                    </a>
                                @endforeach
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"></div><div class="owl-next"></div></div></div></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@stop