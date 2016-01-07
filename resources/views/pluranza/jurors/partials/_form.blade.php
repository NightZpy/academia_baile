<div class="row">
    <h5 class="text-center ct-titleBox">Obligatorio <b class="red">(*)</b></h5>
</div>
@include('partials._errors-min')
{!! Form::hidden('academy_id', $academy->id) !!}
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('name') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('name'))
                <label class="control-label" for="name">
                    <ul>
                        @foreach($errors->get('name') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Nombre <b class="red">(*)</b>
            </label>
            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('last_name') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('last_name'))
                <label class="control-label" for="last_name">
                    <ul>
                        @foreach($errors->get('last_name') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Apellido <b class="red">(*)</b>
            </label>
            {!! Form::text('last_name', old('last_name'), array('placeholder' => 'Apellido', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('ci') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('ci'))
                <label class="control-label" for="ci">
                    <ul>
                        @foreach($errors->get('ci') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Cédula <b class="red">(*)</b>
            </label>
            {!! Form::text('ci', old('ci'), array('placeholder' => 'Cédula', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-5">
        <label class="control-label" for="song">
            Género <b class="red">(*)</b>
        </label>
        <?php
            $femaleActive = $maleActive = '';
            if ((isset($dancer) AND $dancer->gender == 'f') OR old('gender') == 'f'):
                $femaleActive = 'active';
            elseif ((isset($dancer) AND $dancer->gender == 'm') OR old('gender') == 'm'):
                $maleActive = 'active';
            endif
        ?>
        <div class="btn-group" data-toggle="buttons" role="group">
            <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14 {{ $femaleActive }}">
                {!! Form::radio('gender', 'f', null, ['id' => 'gemder_female']) !!}
                Femenino
            </label>
            <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14 {{ $maleActive  }}">
                {!! Form::radio('gender', 'm', null, ['id' => 'gemder_male']) !!}
                Masculino
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('email') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('email'))
                <label class="control-label" for="email">
                    <ul>
                        @foreach($errors->get('email') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Email (Si deseas que llegue un correo de invitación al bailarín)
            </label>
            {!! Form::text('email', old('email'), array('placeholder' => 'Email', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('phone') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('phone'))
                <label class="control-label" for="phone">
                    <ul>
                        @foreach($errors->get('phone') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Teléfono
            </label>
            {!! Form::text('phone', old('phone'), array('placeholder' => 'Teléfono', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('birth_date') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('birth_date'))
                <label class="control-label" for="birth_date">
                    <ul>
                        @foreach($errors->get('birth_date') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Fecha de nacimiento <b class="red">(*)</b>
            </label>
            {!! Form::date('birth_date', old('birth_date'), array('placeholder' => 'Fecha de fundaci&#243;n', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('facebook') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('facebook'))
                <label class="control-label" for="facebook">
                    <ul>
                        @foreach($errors->get('facebook') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Dirección URL de Facebook
            </label>
            {!! Form::text('facebook', old('facebook'), array('placeholder' => 'URL de Facebook', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('twitter') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('twitter'))
                <label class="control-label" for="twitter">
                    <ul>
                        @foreach($errors->get('twitter') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Dirección URL de Twitter
            </label>
            {!! Form::text('twitter', old('twitter'), array('placeholder' => 'URL de Twitter', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('instagram') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('instagram'))
                <label class="control-label" for="instagram">
                    <ul>
                        @foreach($errors->get('instagram') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Dirección URL de Instagram
            </label>
            {!! Form::text('instagram', old('instagram'), array('placeholder' => 'URL de Instagram', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4  text-center">
        <div class="btn-group" data-toggle="buttons" role="group">
            <?php
                $active = '';
                if ((isset($dancer) AND $dancer->director) OR old('director')):
                    $active = 'active';
                endif
            ?>
            <label class="btn btn-sm btn-default btn-circle text-uppercase ct-u-size14 {{ $active }}">
                {!! Form::checkbox('director', null, old('director'), array('class' => 'form-control input-sm')) !!}
                Director
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('biography') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('biography'))
                <label class="control-label" for="biography">
                    <ul>
                        @foreach($errors->get('biography') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                ¡Queremos saber quien baila, cuentanos sobre él!
            </label>
            {!! Form::textarea('biography', old('biography'), array('placeholder' => '¿Quién es?', 'class' => 'form-control input-sm')) !!}
            @route('pluranza.jurors.edit')
                <b class="biography-counter background-red white"></b> caracteres restantes.
            @endroute
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('photo') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('photo'))
                <label class="control-label" for="photo">
                    <ul>
                        @foreach($errors->get('photo') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Foto en buena resolución (No mayor a 1mb)
            </label>
            {!! Form::file('photo', array('placeholder' => 'Foto', 'class' => 'file-upload')) !!}
        </div>
    </div>
</div>

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
