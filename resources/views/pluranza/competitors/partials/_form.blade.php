<div class="row">
    <h5 class="text-center ct-titleBox">Obligatorio <b class="red">(*)</b></h5>
</div>
@include('partials._errors-min')
{!! Form::hidden('academy_id', $academy->id) !!}
@if (isset($competitionType))
    {!! Form::hidden('competition_type_id',  $competitionType->id) !!}
@elseif (isset($competitor))
    {!! Form::hidden('competition_type_id',  $competitor->competitionType->id) !!}
@endif
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
        <div class="form-group {{ ($errors->has('category_id') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('category_id'))
                <label class="control-label" for="category_id">
                    <ul>
                        @foreach($errors->get('category_id') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Género de baile <b class="red">(*)</b>
            </label>
            {!! Form::select('category_id', (isset($categories) ? $categories : array()), ( isset($competitor) AND $competitor->category->id > 0 ? $competitor->category->id : old('category_id')), ['class' => 'form-control input-sm category-select']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('level_id') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('level_id'))
                <label class="control-label" for="level_id">
                    <ul>
                        @foreach($errors->get('level_id') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Nivel de competición <b class="red">(*)</b>
            </label>
            {!! Form::select('level_id', (isset($levels) ? $levels : array()), ( isset($competitor) AND $competitor->level->id > 0 ? $competitor->level->id : old('level_id')), ['class' => 'form-control input-sm level-select']) !!}
        </div>
    </div>
</div>
<div class="row">
    @if ( (isset($competitor) AND strtolower($competitor->competitionType->name) == 'pareja') OR
          (isset($competitionType) AND strtolower($competitionType->name) == 'pareja'))
        <div class="col-sm-offset-4 col-sm-4">
            <div class="form-group {{ ($errors->has('dancer_id[female]') ? 'has-error background-error-color' : '') }}">
                @if ($errors->has('dancer_id'))
                    <label class="control-label" for="dancer_id['female']">
                        <ul>
                            @foreach($errors->get('dancer_id')['female'] as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </label>
                @endif
                <label class="control-label" for="song">
                    Bailarina <b class="red">(*)</b>
                </label>
                {!! Form::select('dancer_id[female]', $dancers['female'], $selectedDancers['female'], ['class' => 'form-control input-sm', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('dancer_id[masculine]') ? 'has-error background-error-color' : '') }}">
            @if ($errors->has('dancer_id'))
                <label class="control-label" for="dancer_id['masculine']">
                    <ul>
                        @foreach($errors->get('dancer_id')['masculine'] as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label class="control-label" for="song">
                Bailarín <b class="red">(*)</b>
            </label>
            {!! Form::select('dancer_id[masculine]', $dancers['masculine'], $selectedDancers['masculine'], ['class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    </div>
    @else
        <div class="col-sm-offset-4 col-sm-4">
            <div class="form-group {{ ($errors->has('dancer_id') ? 'has-error background-error-color' : '') }}">
                @if ($errors->has('dancer_id'))
                    <label class="control-label" for="dancer_id">
                        <ul>
                            @foreach($errors->get('dancer_id') as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </label>
                @endif
                @if ((isset($competitor) AND strtolower($competitor->competitionType->name) == 'solista') OR  (isset($competitionType) AND strtolower($competitionType->name) == 'solista'))
                    <label class="control-label" for="song">
                        Bailarín o Bailarina <b class="red">(*)</b>
                    </label>
                    {!! Form::select('dancer_id[]', $dancers, $selectedDancers, ['class' => 'form-control input-sm', 'required' => 'required']) !!}
                @else
                    <label class="control-label" for="song">
                        Bailarines <b class="red">(*)</b>
                    </label>
                    {!! Form::select('dancer_id[]', $dancers, $selectedDancers, ['multiple' => 'multiple', 'class' => 'form-control input-sm select2', 'required' => 'required', 'style' => 'display: none']) !!}
                @endif
            </div>
        </div>
    @endif
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

@push('scripts')
{!! Html::script('/assets/plugins/ct-select2/js/select2.min.js') !!}

<script>
    $(".select2").select2({
        placeholder: "Selecciona",
    });
</script>

@endpush