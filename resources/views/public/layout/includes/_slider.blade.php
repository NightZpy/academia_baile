<br>
<div id="join-us" class="ct-u-owlWrapper">
    <div class="ct-shadowBox-repositioned">
        @if(!Auth::check())
            <script>alert('algo')</script>
            <div class="ct-shadowBox ct-backgroundContent" data-type="color" data-bg-color="rgba(255, 255, 255, .4)" data-snap-ignore="true">
                @include('pluranza.academies.partials._base-data-form')
            </div>
        @endif
        @if(Auth::user() AND Auth::user()->academy)
            {{--<div class="ct-shadowBox ct-backgroundContent">
                <h1>Ingresar a sitio de PLURANZA</h1>
            </div>--}}
        @endif
    </div>
    <!-- Main Carousel -->
    <div class="ct-js-owl ct-u-owl ct-mainCarousel ct-mainCarousel--arrowsMiddle" data-single="true" data-height="600"
         data-animations="true" data-navigation="true" data-bg="true" data-snap-ignore="false"
         data-autoPlaySpeed="7000">

        <div class="item" data-bg="/assets/images/content/slider/pluranza-main.jpg" data-position="50% 50%">
            <!-- 3' OwlSlider item -->
        </div>
        <div class="item" data-bg="/assets/images/content/slider/invitados.jpg" data-position="50% 50%">
            <!-- 3' OwlSlider item -->
        </div>
        <div class="item" data-bg="/assets/images/content/slider/orquestas.jpg" data-position="50% 50%">
            <!-- 3' OwlSlider item -->
        </div>
        <div class="item" data-bg="/assets/images/content/slider/alcompas.png" data-position="50% 50%">
            <!-- 1' OwlSlider item -->
        </div>
        {{--<div class="item" data-bg="/assets/images/content/slider/pluranza.png" data-position="50% 50%">
            <!-- 2' OwlSlider item -->
        </div>--}}
    </div>
</div>