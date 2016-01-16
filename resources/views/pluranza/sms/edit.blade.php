@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Actualizar a: <i>{{ $dancer->fullName }}</i>
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::model($dancer,
                                    array(
                                        'url' => route('pluranza.dancers.update', $dancer->id),
                                        'method' => 'PATCH',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                        )) !!}
                        @include('pluranza.dancers.partials._form')
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
                @if ($dancer->photo->url())
                initialPreview: "<img src='{{ $dancer->photo->url() }}' class='file-preview-image' alt='{{ $dancer->photo->originalFileName() }}' title='{{ $dancer->photo->originalFileName() }}'>",
                @endif
                previewFileType: "image",
                removeClass: "btn btn-xs btn-danger text-uppercase ct-u-size14",
                removeLabel: " Eliminar",
                removeIcon: '<i class="fa fa-trash"></i>'
            });

        } catch(e) {
            alert('fileinput.js no soporta navegadores antiguos!');
        }
    }

    $('[name="biography"]').simplyCountable({
        counter:            '.biography-counter',
        countType:          'characters',
        maxCount:           1024,
        strictMax:          true,
        countDirection:     'down',
        safeClass:          'safe',
        overClass:          'over',
        thousandSeparator:  '.',
        onOverCount:        function(count, countable, counter){},
        onSafeCount:        function(count, countable, counter){},
        onMaxCount:         function(count, countable, counter){}
    });

    jQuery(document).ready(function() {
        handleBootstrapFileInput();
    });
</script>
@endpush