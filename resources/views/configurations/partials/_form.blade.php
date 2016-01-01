<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('title') ? 'has-error' : '') }}">
            @if ($errors->has('title'))
                <label class="control-label" for="title">
                    <ul>
                        @foreach($errors->get('title') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="title">
                Titulo (Máximo 64 caracteres)*
            </label>
            {!! Form::text('title', old('title'), array('placeholder' => 'Título corto', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('long_title') ? 'has-error' : '') }}">
            @if ($errors->has('long_title'))
                <label class="control-label" for="long_title">
                    <ul>
                        @foreach($errors->get('long_title') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="long_title">
                Titulo Largo (Máximo 128 caracteres)*
            </label>
            {!! Form::text('long_title', old('long_title'), array('placeholder' => 'Título largo', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
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
                Número máximo de competidores (Sólo números enteros)*
            </label>
            {!! Form::text('max_competitors', old('max_competitors'), array('placeholder' => 'Número máximo de competidores', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('slogan') ? 'has-error' : '') }}">
            @if ($errors->has('slogan'))
                <label class="control-label" for="slogan">
                    <ul>
                        @foreach($errors->get('slogan') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="slogan">
                Eslogan (Máximo 128 caracteres)*
            </label>
            {!! Form::text('slogan', old('slogan'), array('placeholder' => 'Eslogan', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('description') ? 'has-error' : '') }}">
            @if ($errors->has('description'))
                <label class="control-label" for="description">
                    <ul>
                        @foreach($errors->get('description') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="description">
                Descripción (Máximo 512 caracteres)(*)
            </label>
            {!! Form::textarea('description', old('description'), array('placeholder' => 'Descripción', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
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