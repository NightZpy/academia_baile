@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Actualizar configuración base
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._flash')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::model($configuration, array(
                                        'url' => route('configurations.update', $configuration->id),
                                        'method' => 'PATCH',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                        )) !!}
                        @include('configurations.partials._form')
                        <div class="row">
                            <div class="col-sm-offset-9 col-sm-3">
                                {!! Form::submit('Actualizar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
<script>
    var handleBootstrapFileInput = function() {
        try {
            $(".file-upload").fileinput({
                'showUpload': false,
                'showRemove': false,
                @if ($configuration->rules->url())
                initialPreview: "<object data='{{ route('home') . $configuration->rules->url() }}' type='application/pdf' width='160px' height='160px' internalinstanceid='68'>" +
                "<param name='movie' value='{{ $configuration->rules->originalFileName() }}'>" +
                "<param name='controller' value='true'>" +
                "<param name='allowFullScreen' value='true'>" +
                "<param name='allowScriptAccess' value='always'>" +
                "<param name='autoPlay' value='false'>" +
                "<param name='autoStart' value='false'>" +
                "<param name='quality' value='high'>" +
                "<div class='file-preview-other'>" +
                "<i class='glyphicon glyphicon-file'>''</i>" +
                "</div>" +
                "</object>",
                @endif
                previewFileType: "any",
                removeClass: "btn btn-xs btn-danger text-uppercase ct-u-size14",
                removeLabel: " Eliminar",
                removeIcon: '<i class="fa fa-trash"></i>'
            });

        } catch(e) {
            alert('fileinput.js no soporta navegadores antiguos!');
        }
    }

    jQuery(document).ready(function() {
        handleBootstrapFileInput();
    });
</script>
@endpush