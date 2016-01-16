@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h5 class="text-center ct-u-paddingTop30">
                        Editar @if(isset($exhibition)) <i> {{ $exhibition->name }}</i> @endif
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._errors')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8 exhibition-select">
                    {!! Form::model($exhibition, array(
                                        'url' => route('pluranza.exhibitions.update', $exhibition->id),
                                        'method' => 'PATCH',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                        'files' => true
                                    )) !!}
                        @include('pluranza.exhibitions.partials._form')
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
                @if ($exhibition->song->url())
                initialPreview: "<audio controls><source src='{{ $exhibition->song->url() }}' type='audio/mp3' class='file-preview-other' title='{{ $exhibition->song_name }}'></audio>",
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

    jQuery(document).ready(function() {
        fileInput = handleBootstrapFileInput();
    });
</script>
@endpush