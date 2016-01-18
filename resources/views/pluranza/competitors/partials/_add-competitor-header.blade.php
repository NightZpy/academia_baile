@role(['admin', 'director'])
    @if(isset($competitionTypes))
        <div class="row ct-u-paddingTop25">
            @route('pluranza.competitors.by-academy')
                {!! Form::open(
                    [
                        'route' =>  ['pluranza.competitors.new.by-academy', $currentAcademy->id],
                        'method' => 'GET',
                        'role' => 'form',
                        'files' => true
                    ])
                !!}
                @if($currentAcademy)
                    {!! Form::hidden('academy_id', $currentAcademy->id) !!}
                @endif
                <div class="col-md-offset-2 col-md-6">
                    <div class="btn-group pull-right {{ ($errors->has('competition_type_id') ? 'has-error' : '') }}" data-toggle="buttons" role="group">
                        @foreach($competitionTypes as $competitionType)
                            <label class="btn btn-sm btn-default
                                                 btn-circle text-uppercase ct-u-size14">
                                {!! Form::radio('competition_type_id', $competitionType->id, null,  ['id' => 'competition_type_id']) !!}
                                {!! $competitionType->name !!}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2">
                    {!! Form::submit('Agregar', [ 'class' => 'btn btn-sm btn-danger btn-circle pull-right text-uppercase ct-u-size14 ']) !!}
                </div>
                @else
                    @role('admin')
                    {!! Form::open(
                        [
                            'route' =>  'pluranza.competitors.new',
                            'method' => 'GET',
                            'role' => 'form',
                            'files' => true
                        ])
                    !!}
                    @if($currentAcademy)
                        {!! Form::hidden('academy_id', $currentAcademy->id) !!}
                    @endif
                    <div class="col-md-offset-2 col-md-6">
                        <div class="btn-group pull-right {{ ($errors->has('competition_type_id') ? 'has-error' : '') }}" data-toggle="buttons" role="group">
                            @foreach($competitionTypes as $competitionType)
                                <label class="btn btn-sm btn-default
                                                 btn-circle text-uppercase ct-u-size14">
                                    {!! Form::radio('competition_type_id', $competitionType->id, null,  ['id' => 'competition_type_id']) !!}
                                    {!! $competitionType->name !!}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Agregar', [ 'class' => 'btn btn-sm btn-danger btn-circle pull-right text-uppercase ct-u-size14 ']) !!}
                    </div>
                @endrole
            @endroute
        </div>
    @endif
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
@endrole