@role('admin', 'director')
    <div class="row ct-u-paddingTop10">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-4">
                <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--important">
                    <div class="ct-pricingBox-title">
                        <h5 class="text-uppercase">Debe</h5>
                    </div>
                    <div class="ct-pricingBox-pricing">
                        <span class="ct-pricingBox-price">{{ $academy->debtBs }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--important">
                    <div class="ct-pricingBox-title">
                        <h5 class="text-uppercase">Cancelado</h5>
                    </div>
                    <div class="ct-pricingBox-pricing">
                        <span class="ct-pricingBox-price">{{ $academy->paidBs }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--standart">
                    <div class="ct-pricingBox-title">
                        <h5 class="text-uppercase">Total</h5>
                    </div>
                    <div class="ct-pricingBox-pricing">
                        <span class="ct-pricingBox-price">{{ $academy->totalBs }}</span>
                    </div>
                    <div class="btn-group text-center ct-u-paddingTop15" data-toggle="buttons" role="group">
                        <a href="{{ route('pluranza.payments.new', $academy->id) }}" class="btn btn-xs btn-danger btn-circle text-uppercase ct-u-size14 pull-left"><i class="fa fa-money fa-2x"></i> Pagar</a>
                        <a href="{{ route('pluranza.payments.by-academy', $academy->id) }}" class="btn btn-xs btn-danger btn-circle text-uppercase ct-u-size14 pull-left"><i class="fa fa-money fa-2x"></i> Pagos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($competitionTypes)
        <div class="row ct-u-paddingTop25">
            {!! Form::model($academy,
                [
                    'route' => ['pluranza.competitors.new', $academy->id],
                    'method' => 'GET',
                    'role' => 'form',
                    'files' => true
                ])
            !!}
            {!! Form::hidden('academy_id', $academy->id) !!}
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