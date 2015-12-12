@include('layout.includes._js')
<!-- Jquery Cascading Dropdown -->
{!! Html::script('/assets/plugins/cascadingdropdown/jquery.cascadingdropdown.js') !!}
<!-- BOOTSTRAP FILEUPLOAD -->
{!! HTML::script('/assets/plugins/fileinput/fileinput.min.js') !!}
{!! HTML::script('/assets/plugins/fileinput/fileinput_locale_es.js') !!}

{!! Html::script('/assets/js/custom.js') !!}

<script>
    jQuery(document).ready(function() {
        // Custom inits
        CustomApp.init();
    });
</script>