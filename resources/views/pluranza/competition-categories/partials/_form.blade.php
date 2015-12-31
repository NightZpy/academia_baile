<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <div class="form-group {{ ($errors->has('price') ? 'has-error' : '') }}">
            @if ($errors->has('price'))
                <label class="control-label" for="price">
                    <ul>
                        @foreach($errors->get('price') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Bs.</span>
                {!! Form::text('price', old('price'), array('placeholder' => 'Costo', 'class' => 'form-control input-sm', 'aria-label' => 'Costo (en Bolívares Venezolanos)')) !!}
            </div>
        </div>
    </div>
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
            <?php
                $categoryId = null;
                if (isset($competitionCategory) AND  $competitionCategory->category_id > 0 ):
                    $categoryId = $competitionCategory->category_id;
                endif;
            ?>
            {!! Form::select('category_id', $categories, $categoryId, ['placeholder' => 'Selecciona un género', 'class' => 'form-control input-sm']) !!}
        </div>
    </div>
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
            <?php
                $levelId = null;
                if (isset($competitionCategory) AND  $competitionCategory->level_id > 0 ):
                            $levelId = $competitionCategory->level_id;
                endif;
            ?>
            {!! Form::select('level_id', $levels, $levelId, ['placeholder' => 'Selecciona un nivel', 'class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="col-sm-offset-4 col-sm-4">
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
            {!! Form::select('competition_type_id', $competitionTypes, ( isset($competitionCategory) AND  $competitionCategory->competition_type_id > 0 ? $competitionCategory->competition_type_id : old('competition_type_id')), ['placeholder' => 'Selecciona una categoría', 'class' => 'form-control input-sm']) !!}
        </div>
    </div>
</div>
