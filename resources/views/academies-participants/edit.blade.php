<div class="row">
    <div class="col-md-12">
        <h5 class="ct-titleBox text-uppercase ct-u-paddingTop30">
            Academia {!! $academieParticipant->name !!}
        </h5>
    </div>
</div>

<div class="row ct-u-paddingTop50">
    <div class="col-sm-12">
        {!! Form::model($academieParticipant,
            [
                'route' => ['academies-participants.update', $academieParticipant->id],
                'method' => 'post',
                'role' => 'form'
            ])
        !!}
            <div class="form-group">
                <label class="control-label" for="name">Name error</label>
                {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>