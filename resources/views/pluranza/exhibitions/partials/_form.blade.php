<div class="row">
    <h5 class="text-center ct-titleBox">Obligatorio <b class="red">(*)</b></h5>
</div>
@include('partials._errors-min')
{!! Form::hidden('academy_id', $academY->id) !!}
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
                Nombre con el que se identificarán <b class="red">(*)</b>
            </label>
            {!! Form::text('name', (isset($name) ? $name : old('name')), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('dancer_id[]') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('dancer_id[]'))
                <label class="control-label" for="dancer_id[]">
                    <ul>
                        @foreach($errors->get('dancer_id[]') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="dancer_id[]">
                Bailarines <b class="red">(*)</b>
            </label>            
            {!! Form::select(
                'dancer_id[]', 
                $dancers, 
                $selectedDancers, 
                ['multiple' => 'multiple', 'placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('gender_id[]') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('gender_id[]'))
                <label class="control-label" for="gender_id[]">
                    <ul>
                        @foreach($errors->get('gender_id[]') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="gender_id[]">
                Géneros <b class="red">(*)</b>
            </label>            
            {!! Form::select(
                'gender_id[]', 
                $genres, 
                $selectedGenres, 
                ['multiple' => 'multiple', 'placeholder' => 'Selecciona los géneros', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('song_name') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('song_name'))
                <label class="control-label" for="song_name">
                    <ul>
                        @foreach($errors->get('song_name') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Nombre de la canción
            </label>
            {!! Form::text('song_name', (isset($song_name) ? $song_name : old('song_name')), array('placeholder' => 'Nombre del a canción', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('song') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('song'))
                <label class="control-label" for="song">
                    <ul>
                        @foreach($errors->get('song') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Canción <b class="red">(Archivo .mp3; tamaño máximo 20mb)</b>
            </label>
            {!! Form::file('song', array('placeholder' => 'Canción', 'class' => 'file-upload')) !!}
        </div>
    </div
</div>