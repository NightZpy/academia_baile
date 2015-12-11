@include('layout.includes._js')
{!! Html::script('/assets/plugins/cascadingdropdown/jquery.cascadingdropdown.js') !!}
{!! Html::script('/assets/js/custom.js') !!}

<script>
    jQuery(document).ready(function() {
        // Custom inits
        CustomApp.init();
    });
</script>