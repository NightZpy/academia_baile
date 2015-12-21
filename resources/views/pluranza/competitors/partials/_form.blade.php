{!! Form::hidden('academy_id', $academy->id) !!}
<div class="row">
    <div class="col-sm-3">
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
            {!! Form::select('category_id', $categories, ( $categoryId > 0 ? $categoryId : old('category_id')), ['placeholder' => 'Selecciona un estado', 'class' => 'form-control input-sm estate-select']) !!}
        </div>
    </div>
    <div class="col-sm-3">
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
            {!! Form::select('level_id', $levels, ( $levelId > 0 ? $levelId : old('level_id')), ['placeholder' => 'Selecciona un municipio', 'class' => 'form-control input-sm municipality-select']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group {{ ($errors->has('competition_type_id') ? 'has-error' : '') }}">
            @if ($errors->has('competition_type_id'))
                <label class="control-label" for="competition_type_id">
                    <ul>
                        @foreach($errors->get('competition_type_id') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::select('competition_type_id', $competitionTypes, ( $competitionTypeId > 0 ? $competitionTypeId : old('competition_type_id')), ['placeholder' => 'Selecciona una parroquia', 'class' => 'form-control input-sm parish-select']) !!}
        </div>
    </div>
    <div class="col-sm-3">
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
            {!! Form::select('dancer_id', $dancers, ( $dancerId > 0 ? $dancerId : old('dancer_id')), ['placeholder' => 'Selecciona una parroquia', 'class' => 'form-control input-sm parish-select']) !!}
        </div>
    </div>
</div>