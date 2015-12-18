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
</div>
<div class="row">
    <div class="col-sm-6">
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
            {!! Form::textarea('description', old('description'), array('placeholder' => 'Descripción', 'class' => 'form-control input-sm')) !!}
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