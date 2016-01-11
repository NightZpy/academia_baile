@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Enviar SMS
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop5">
                <div class="col-md-offset-1 col-md-10">
                    {!! Form::open(array(
                        'url' => route('pluranza.academies.smsProccess'),
                        'method' => 'post',
                        'accept-charset' => 'UTF-8',
                        'role' => 'form'
                    )) !!}
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="btn-group" data-toggle="buttons" role="group">
                                    <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14">
                                        {!! Form::radio('type', 'all', null, ['id' => 'all']) !!}
                                        A todos
                                    </label>
                                    <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14">
                                        {!! Form::radio('type', 'unverified', null, ['id' => 'unverified']) !!}
                                        Sin verificar
                                    </label>
                                    <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14">
                                        {!! Form::radio('type', 'custom', null, ['id' => 'custom']) !!}
                                        Personalizado
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-4">
                                <div class="form-group {{ ($errors->has('academies[]') ? 'has-error background-error-color' : '') }}">
                                    @if ($errors->has('academies[]'))
                                        <label class="control-label" for="academies[]">
                                            <ul>
                                                @foreach($errors->get('academies[]') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label" for="song">
                                        Academias <b class="red">(*)</b>
                                    </label>
                                    {!! Form::select('academies[]', (isset($academies) ? $academies : array()), old('academies[]'), ['placeholder' => 'Selecciona academias', 'class' => 'form-control input-sm', 'multiple' => 'multiple']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="form-group {{ ($errors->has('message') ? 'has-error background-error-color' : '') }}">
                                    @if ($errors->has('message'))
                                        <label class="control-label" for="message">
                                            <ul>
                                                @foreach($errors->get('message') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    <label class="control-label" for="song">
                                        ¡Mensaje a enviar!
                                    </label>
                                    {!! Form::textarea('message', old('message'), array('placeholder' => '¡Mensaje!', 'class' => 'form-control input-sm')) !!}
                                        <b class="message-counter background-red white"></b> caracteres restantes (3 SMS Max.).
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-9 col-sm-3">
                                {!! Form::submit('Guardar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@push('styles')
<style>
    label.btn.btn-sm.btn-default {
        background-color: black;
        color: white;
    }

    label.btn.btn-sm.btn-default.active {
        background-color: grey;
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
<script>
    $('[name="message"]').simplyCountable({
        counter:            '.message-counter',
        countType:          'characters',
        maxCount:           417,
        strictMax:          true,
        countDirection:     'down',
        safeClass:          'safe',
        overClass:          'over',
        thousandSeparator:  '.',
        onOverCount:        function(count, countable, counter){},
        onSafeCount:        function(count, countable, counter){},
        onMaxCount:         function(count, countable, counter){}
    });
</script>
@endpush