<section class="ct-u-paddingTop20 ct-u-paddingBottom100">
    <div class="container">
        <div class="row ct-u-paddingBottom40">
            <div class="col-md-12">
                <div class="ct-u-sectionHeader text-center ct-u-paddingBottom20">
                    <h2 class="ct-sectionTitle">{{ $configuration->title }} <br><span class="ct-fw-300">{{ $configuration->long_title }}</span></h2>

                    <p class="ct-u-size18 ct-u-paddingTop30 ct-u-paddingBottom20 text-justify-xs">
                        <span class="ct-u-colorMotive ct-fw-400">{{ $configuration->slogan }}</span><br>
                        <span class="ct-fw-300">{{ $configuration->description }}</span>
                    </p>
                    @if (!Auth::check())
                        <a href="{{ route('pluranza.academies.new') }}" class="btn btn-lg btn-primary text-uppercase ct-js-btnScroll">¡Inscribete aquí!</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ct-owlCarousel-frame center-block">
                    <div class="ct-owlCarousel-slideSpacer">
                        <div class="ct-js-owl owl-carousel ct-decorationCarousel ct-decorationCarousel--navBottomCenter owl-theme"
                             data-single="true" data-pagination="true" data-autoplay="true" data-navigation="false"
                             data-height="" data-stoponhover="true" data-snap-ignore="true"
                             style="opacity: 1; display: block;">
                            <div class="owl-wrapper-outer">
                                <div class="owl-wrapper"
                                     style="width: 5040px; left: 0px; display: block; transition: all 0ms ease; transform: translate3d(0px, 0px, 0px); transform-origin: 315px 50% 0px; perspective-origin: 315px 50%;">
                                    <div class="owl-item active" style="width: 630px;">
                                        <div class="item">
                                            <img src="./assets/images/demo-content/salsa-ipad-img1.jpg"
                                                 alt="Team Member 1">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 630px;">
                                        <div class="item">
                                            <img src="./assets/images/demo-content/salsa-ipad-img2.jpg"
                                                 alt="Team Member 2">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 630px;">
                                        <div class="item">
                                            <img src="./assets/images/demo-content/salsa-ipad-img3.jpg"
                                                 alt="Team Member 3">
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 630px;">
                                        <div class="item">
                                            <img src="./assets/images/demo-content/salsa-ipad-img4.jpg"
                                                 alt="Team Member 4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-controls clickable">
                                <div class="owl-pagination">
                                    <div class="owl-page active"><span class=""></span></div>
                                    <div class="owl-page"><span class=""></span></div>
                                    <div class="owl-page"><span class=""></span></div>
                                    <div class="owl-page"><span class=""></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>