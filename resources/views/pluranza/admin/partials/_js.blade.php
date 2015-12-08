@include('layout.includes._js')
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
{!! Html::script('/assets/js/custom.js') !!}

<script>
    jQuery(document).ready(function() {
        // Custom inits
        CustomApp.init();
    });
</script>