<div class="row ct-u-paddingTop10">
    <div class="col-md-offset-2 col-md-8">
        <div class="col-md-4">
            <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--important">
                <div class="ct-pricingBox-title">
                    <h5 class="text-uppercase">Debe</h5>
                </div>
                <div class="ct-pricingBox-pricing">
                    <span class="ct-pricingBox-price">{{ $academY->debtBs }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--important">
                <div class="ct-pricingBox-title">
                    <h5 class="text-uppercase">Cancelado</h5>
                </div>
                <div class="ct-pricingBox-pricing">
                    <span class="ct-pricingBox-price">{{ $academY->paidBs }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center ct-pricingBox ct-pricingBox--standard ct-pricingBox--standart">
                <div class="ct-pricingBox-title">
                    <h5 class="text-uppercase">Total</h5>
                </div>
                <div class="ct-pricingBox-pricing">
                    <span class="ct-pricingBox-price">{{ $academY->totalBs }}</span>
                </div>
                <div class="btn-group text-center ct-u-paddingTop15">
                    <a href="{{ route('pluranza.payments.new', $academY->id) }}" class="ct-js-btnScroll btn btn-xs btn-danger btn-circle text-uppercase ct-u-size14 pull-left"><i class="fa fa-money fa-2x"></i> Pagar</a>
                    <a href="{{ route('pluranza.payments.by-academy', $academY->id) }}" class="ct-js-btnScroll btn btn-xs btn-danger btn-circle text-uppercase ct-u-size14 pull-left"><i class="fa fa-money fa-2x"></i> Pagos</a>
                </div>
            </div>
        </div>
    </div>
</div>