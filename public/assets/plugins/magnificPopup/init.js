(function ($) {
    "use strict";
    $(document).ready(function(){
        if(jQuery().magnificPopup){

            $('.ct-videoPopup').magnificPopup({
                items: {
                    src: './assets/videos/ballet2.mp4'
                },
                type: 'iframe', // this is default type
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });

            $('.ct-gallery-popup').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: 'The image #%curr% could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>Ballet</small>';
                    }
                }
            });

            $('.ct-js-magnificPopupImage').magnificPopup({
                type: 'image',
                removalDelay: 300,
                mainClass: 'mfp-fade',
                fixedContentPos: false // for removing overflow-y: hidden from HTML
            });

        }

    })

}(jQuery));


