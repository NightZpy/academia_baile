<div class="form">
    <div class="text-right ct-u-colorLighterGray ct-u-size16">
        <span class="ct-u-colorLighterGrey ct-u-cursorPointer" data-toggle="modal" data-target="#myModal">Ingresar</span>
    </div>
    <div class="text-left">
        <h3 class="ct-u-marginBoth0 ct-u-marginTopMinus10 ct-u-size24 ct-fw-400">Obten informaci&#243;n</h3>
    </div>
    @include('partials._flash')
    @include('partials._errors')
    {!! Form::open(array('url' => route('pluranza.academies-participants.store'), 'method' => 'post', 'class' => 'ct-u-paddingTop25 ct-u-form-control--Default ct-loginForm', 'accept-charset' => 'UTF-8')) !!}
        <div class="form-group">
            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::text('phone', old('phone'), array('placeholder' => 'Tel&eacute;fono de contacto', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::text('phone_confirmation', old('phone_confirmation'), array('placeholder' => 'Confirmar el tel&eacute;fono', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email', old('email'), array('placeholder' => 'Email', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email_confirmation', old('email_confirmation'), array('placeholder' => 'Confirmar Email', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', ['placeholder' => 'Contrase&ntilde;a', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    <div class="form-group">
        {!! Form::password('password_confirmation', ['placeholder' => 'Confirmar contrase&ntilde;a', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
    </div>

        <button type="submit" class="btn btn-xs btn-primary btn-block text-uppercase ct-u-size14">Registrar</button>
        {{--<div class="help-block ct-u-size12 ct-u-colorLighterGray ct-u-paddingTop20">
            By signing up with 1step, you agree to our
            <a href="">Terms of OurService</a>
            and
            <a href="">Privacy Policy.</a>
        </div>--}}
    {!! Form::close() !!}
</div>