{!! Form::hidden('academy_id', $academy->id) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('name') ? 'has-error' : '') }}">
            @if ($errors->has('name'))
                <label class="control-label" for="name">
                    <ul>
                        @foreach($errors->get('name') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('last_name') ? 'has-error' : '') }}">
            @if ($errors->has('last_name'))
                <label class="control-label" for="last_name">
                    <ul>
                        @foreach($errors->get('last_name') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('last_name', old('last_name'), array('placeholder' => 'Apellido', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('ci') ? 'has-error' : '') }}">
            @if ($errors->has('ci'))
                <label class="control-label" for="ci">
                    <ul>
                        @foreach($errors->get('ci') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('ci', old('ci'), array('placeholder' => 'Cédula', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('email') ? 'has-error' : '') }}">
            @if ($errors->has('email'))
                <label class="control-label" for="email">
                    <ul>
                        @foreach($errors->get('email') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('email', old('email'), array('placeholder' => 'Email', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('phone') ? 'has-error' : '') }}">
            @if ($errors->has('phone'))
                <label class="control-label" for="phone">
                    <ul>
                        @foreach($errors->get('phone') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('phone', old('phone'), array('placeholder' => 'Teléfono', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('birth_date') ? 'has-error' : '') }}">
            @if ($errors->has('birth_date'))
                <label class="control-label" for="birth_date">
                    <ul>
                        @foreach($errors->get('birth_date') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::date('birth_date', old('birth_date'), array('placeholder' => 'Fecha de fundaci&#243;n', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('facebook') ? 'has-error' : '') }}">
            @if ($errors->has('facebook'))
                <label class="control-label" for="facebook">
                    <ul>
                        @foreach($errors->get('facebook') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('facebook', old('facebook'), array('placeholder' => 'Facebook de la Academia', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('twitter') ? 'has-error' : '') }}">
            @if ($errors->has('twitter'))
                <label class="control-label" for="twitter">
                    <ul>
                        @foreach($errors->get('twitter') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('twitter', old('twitter'), array('placeholder' => 'Twitter de la Academia', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('instagram') ? 'has-error' : '') }}">
            @if ($errors->has('instagram'))
                <label class="control-label" for="instagram">
                    <ul>
                        @foreach($errors->get('instagram') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('instagram', old('instagram'), array('placeholder' => 'Instagram de la Academia', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group {{ ($errors->has('independent') ? 'has-error' : '') }}">
            <label class="control-label" for="independent">
                ¿Independiente?
                @if ($errors->has('independent'))
                    <ul>
                        @foreach($errors->get('independent') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                @endif
            </label>
            {!! Form::checkbox('independent', null, old('independent'), array('class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group {{ ($errors->has('director') ? 'has-error' : '') }}">
            <label class="control-label" for="director">
                ¿Director?
                @if ($errors->has('director'))
                    <ul>
                        @foreach($errors->get('director') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                @endif
            </label>
            {!! Form::checkbox('director', null, old('director'), array('class' => 'form-control input-sm')) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ ($errors->has('photo') ? 'has-error' : '') }}">
            @if ($errors->has('photo'))
                <label class="control-label" for="photo">
                    <ul>
                        @foreach($errors->get('photo') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::file('photo', array('placeholder' => 'Foto', 'class' => 'file-upload')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-9 col-sm-3">
        {!! Form::submit('Actualizar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
    </div>
</div>