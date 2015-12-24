<div class="row">
    <div class="col-sm-4">
        <div class="form-group {{ ($errors->has('amount') ? 'has-error' : '') }}">
            @if ($errors->has('amount'))
                <label class="control-label" for="amount">
                    <ul>
                        @foreach($errors->get('amount') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <div class="input-group">
                <span class="input-group-addon">Bs.</span>
                {!! Form::text('amount', (isset($amount) ? $amount : old('amount')), array('placeholder' => 'Monto', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
                <span class="input-group-addon">.00</span>
            </div>
        </div>
        <div class="form-group {{ ($errors->has('reference_code') ? 'has-error' : '') }}">
            @if ($errors->has('reference_code'))
                <label class="control-label" for="reference_code">
                    <ul>
                        @foreach($errors->get('reference_code') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::text('reference_code', (isset($reference_code) ? $reference_code : old('reference_code')), array('placeholder' => 'Código de referencia', 'class' => 'form-control input-sm')) !!}
        </div>
        <div class="form-group {{ ($errors->has('date') ? 'has-error' : '') }}">
            @if ($errors->has('date'))
                <label class="control-label" for="date">
                    <ul>
                        @foreach($errors->get('date') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::date('date', (isset($date) ? $date : old('date')), array('placeholder' => 'Fecha', 'class' => 'form-control input-sm')) !!}
        </div>
        <div class="form-group {{ ($errors->has('competitor_id') ? 'has-error' : '') }}">
            @if ($errors->has('competitor_id'))
                <label class="control-label" for="competitor_id">
                    <ul>
                        @foreach($errors->get('competitor_id') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            <label for="competidor_id">(Sólo si se paga un competidor en específico)</label>
            {!! Form::select('competitor_id', (isset($competitors) ? $competitors : array()), (isset($payment) AND $payment->competitor_id > 0 ? $payment->competitor_id : old('competitor_id')), ['placeholder' => 'Selecciona un competidor', 'class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="col-sm-offset-2 col-sm-6">
        <div class="form-group {{ ($errors->has('voucher') ? 'has-error' : '') }}">
            @if ($errors->has('voucher'))
                <label class="control-label" for="voucher">
                    <ul>
                        @foreach($errors->get('voucher') as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </label>
            @endif
            {!! Form::file('voucher', array('placeholder' => 'Voucher', 'class' => 'file-upload')) !!}
        </div>
    </div>
</div>