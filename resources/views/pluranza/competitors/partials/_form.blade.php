<div class="row">
    <h5 class="text-center ct-titleBox">Obligatorio (*)</h5>
</div>
{!! Form::hidden('academy_id', $academy->id) !!}
@if (isset($competitionType))
    {!! Form::hidden('competition_type_id',  $competitionType->id) !!}
@elseif (isset($competitor))
    {!! Form::hidden('competition_type_id',  $competitor->competitionType->id) !!}
@endif
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
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
            <label class="control-label" for="song">
                Nombre con el que se identificarán (*)
            </label>
            {!! Form::text('name', (isset($name) ? $name : old('name')), array('placeholder' => 'Nombre', 'class' => 'form-control input-sm')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('category_id') ? 'has-error' : '') }}">
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
                Género de baile (*)
            </label>
            {!! Form::select('category_id', (isset($categories) ? $categories : array()), ( isset($competitor) AND $competitor->category->id > 0 ? $competitor->category->id : old('category_id')), ['placeholder' => 'Selecciona un género', 'class' => 'form-control input-sm category-select']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('level_id') ? 'has-error' : '') }}">
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
                Nivel de competición (*)
            </label>
            {!! Form::select('level_id', (isset($levels) ? $levels : array()), ( isset($competitor) AND $competitor->level->id > 0 ? $competitor->level->id : old('level_id')), ['placeholder' => 'Selecciona un nivel', 'class' => 'form-control input-sm level-select']) !!}
        </div>
    </div>
</div>
<div class="row">
    @if ( (isset($competitor) AND strtolower($competitor->competitionType->name) == 'pareja') OR (isset($competitionType) AND $competitionType->name == 'pareja'))
        <div class="col-sm-offset-4 col-sm-4">
            <div class="form-group {{ ($errors->has('dancer_id[female]') ? 'has-error' : '') }}">
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
                    Bailarina (*)
                </label>
                {!! Form::select('dancer_id[female]', (isset($dancers['female']) ? $dancers['female'] : array()), ( isset($competitor) AND $competitor->dancers()->female()->count() > 0 ? $competitor->dancers()->female()->pluck('id') : old('dancer_id[female]')), ['placeholder' => 'Selecciona bailarina', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('dancer_id[masculine]') ? 'has-error' : '') }}">
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
                Bailarín (*)
            </label>
            {!! Form::select('dancer_id[masculine]', (isset($dancers['masculine']) ? $dancers['masculine'] : array()), ( isset($competitor) AND $competitor->dancers()->masculine()->count() > 0 ? $competitor->dancers()->masculine()->pluck('id') : old('dancer_id[masculine]')), ['placeholder' => 'Selecciona bailarín', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    </div>
    @else
        <div class="col-sm-offset-4 col-sm-4">
            <div class="form-group {{ ($errors->has('dancer_id') ? 'has-error' : '') }}">
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
                        Bailarín o Bailarina (*)
                    </label>
                    {!! Form::select('dancer_id[]', (isset($dancers) ? $dancers : array()), ( isset($dancerId) AND $dancerId > 0 ? $dancerId : old('dancer_id')), ['placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                @else
                    <label class="control-label" for="song">
                        Bailarines (*)
                    </label>
                    {!! Form::select('dancer_id[]', (isset($dancers) ? $dancers : array()), ( isset($dancerId) AND $dancerId > 0 ? $dancerId : old('dancer_id')), ['multiple' => 'multiple', 'placeholder' => 'Selecciona los bailarines', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
                @endif
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="form-group {{ ($errors->has('song_name') ? 'has-error' : '') }}">
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
        <div class="form-group {{ ($errors->has('song') ? 'has-error' : '') }}">
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
                Canción (Archivo .mp3)
            </label>
            {!! Form::file('song', array('placeholder' => 'Canción', 'class' => 'file-upload')) !!}
        </div>
    </div
</div>