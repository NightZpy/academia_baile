<div class="form">
    <div class="text-right ct-u-colorLighterGray ct-u-size16">
        <span class="ct-u-colorLighterGrey ct-u-cursorPointer" data-toggle="modal" data-target="#myModal">Ingresar</span>
    </div>
    <div class="text-left">
        <h3 class="ct-u-marginBoth0 ct-u-marginTopMinus10 ct-u-size24 ct-fw-400">Obten información</h3>
    </div>
    <form method="post" action="{{ route('academies-participants.store') }}" class="ct-u-paddingTop25 ct-u-form-control--Default ct-loginForm">
        <div class="form-group">
            <input type="text" name="name" class="form-control input-sm" placeholder="Nombre" required="required">
        </div>
        <div class="form-group">
            <input type="text" name="phone" class="form-control input-sm"  placeholder="Teléfono de contacto" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control input-sm"  placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="email-confirm" class="form-control input-sm"  placeholder="Confirmar Email" required="required">
        </div>
        <button type="submit" class="btn btn-xs btn-primary btn-block text-uppercase ct-u-size14">Registrar</button>
        {{--<div class="help-block ct-u-size12 ct-u-colorLighterGray ct-u-paddingTop20">
            By signing up with 1step, you agree to our
            <a href="">Terms of OurService</a>
            and
            <a href="">Privacy Policy.</a>
        </div>--}}
    </form>
</div>