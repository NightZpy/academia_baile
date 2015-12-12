<div class="ct-u-owlWrapper">
    <div class="ct-shadowBox-repositioned">
        @if(!Auth::user())
            <div class="ct-shadowBox ct-backgroundContent" data-type="color" data-bg-color="rgba(255, 255, 255, .4)" data-snap-ignore="true">
                @include('pluranza.academies-participants.partials._base-data-form')
            </div>
        @endif
        @if(Auth::user()->academieParticipant)
            <div class="ct-shadowBox ct-backgroundContent">
                <h1>Ingresar a sitio de PLURANZA</h1>
            </div>
        @endif
    </div>
    <!-- Main Carousel -->
    <div class="ct-js-owl ct-u-owl ct-mainCarousel ct-mainCarousel--arrowsMiddle" data-single="true" data-height="844" data-animations="true" data-navigation="true" data-pagination="false" data-bg="true" data-snap-ignore="true">
        <div class="item" data-bg="/assets/images/demo-content/salsa-mainCarousel-slide3.jpg" data-position="50% 50%">
            <!-- 1' OwlSlider item -->
        </div>
        <div class="item" data-bg="/assets/images/demo-content/salsa-mainCarousel-slide2.jpg" data-position="50% 50%">
            <!-- 2' OwlSlider item -->
        </div>
        <div class="item" data-bg="/assets/images/demo-content/salsa-mainCarousel-slide1.jpg" data-position="50% 50%">
            <!-- 3' OwlSlider item -->
        </div>
    </div>
</div>