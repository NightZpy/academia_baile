<div class="row">
    <div class="col-sm-offset-2 col-sm-2">
        <div class="form-group {{ ($errors->has('max_competitors') ? 'has-error' : '') }}">
            @if ($errors->has('max_competitors'))
                <label class="control-label" for="max_competitors">
                    <ul>
                        @foreach($errors->get('max_competitors') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="max_competitors">
                Número máximo de competidores
            </label>
            {!! Form::text('max_competitors', old('max_competitors'), array('placeholder' => 'Número máximo de competidores', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ ($errors->has('rules') ? 'has-error' : '') }}">
            @if ($errors->has('rules'))
                <label class="control-label" for="rules">
                    <ul>
                        @foreach($errors->get('rules') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="rules">
                Reglas (Archivo PDF)
            </label>
            {!! Form::file('rules', array('placeholder' => 'Reglas', 'class' => 'file-upload')) !!}
        </div>
    </div>
</div>