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
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('phones') ? 'has-error' : '') }}">
            @if ($errors->has('phones'))
                <label class="control-label" for="phones">
                    <ul>
                        @foreach($errors->get('phones') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('phones', old('phones'), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ ($errors->has('address') ? 'has-error' : '') }}">
            @if ($errors->has('address'))
                <label class="control-label" for="address">
                    <ul>
                        @foreach($errors->get('address') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::textarea('address', old('address'), array('placeholder' => 'Descripción', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>