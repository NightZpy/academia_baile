@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom60 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop100">
                <div class="col-md-12 ct-titleBox">
                    <h5 class="text-center ct-u-paddingTop30">
                        Registrar pago para <i>{{ $academy->name }}</i>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    @include('partials._flash')
                    @include('partials._errors')
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::open(array(
                                        'url' => route('pluranza.payments.store'),
                                        'method' => 'POST',
                                        'accept-charset' => 'UTF-8',
                                        'role' => 'form',
                                    )) !!}
                        {!! Form::hidden('academy_id', $academy->id) !!}
                        <div class="row competitor-select">
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
                                        {!! Form::text('amount', (isset($amount) ? $amount : old('amount')), array('placeholder' => 'Monto', 'class' => 'form-control input-sm')) !!}
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
                                <div class="form-group {{ ($errors->has('status') ? 'has-error' : '') }}">
                                    @if ($errors->has('status'))
                                        <label class="control-label" for="status">
                                            <ul>
                                                @foreach($errors->get('status') as $error)
                                                    <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </label>
                                    @endif
                                    {!! Form::select('status', (isset($status) ? $status : array()), old('status'), ['placeholder' => 'Selecciona un estatús', 'class' => 'form-control input-sm category-select']) !!}
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
                                    {!! Form::select('competitor_id', (isset($competitor_id) ? $competitor_id : array()), old('competitor_id'), ['placeholder' => 'Selecciona un competidor', 'class' => 'form-control input-sm category-select']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
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

                        <div class="row">
                            <div class="col-sm-offset-9 col-sm-3">
                                {!! Form::submit('Guardar', [ 'class' => 'btn btn-xs btn-primary btn-block text-uppercase ct-u-size14']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop