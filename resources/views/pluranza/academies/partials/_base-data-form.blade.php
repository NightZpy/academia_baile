<div class="form">
    <div class="text-right ct-u-colorLighterGray ct-u-size20 ct-u-paddingBottom5">
        {{--<span class="ct-u-colorLighterGrey ct-u-cursorPointer" data-toggle="modal" data-target="#myModal">Ingresar</span>--}}
        <a class="btn btn-xs btn-gray ct-u-colorLighterGrey ct-u-cursorPointer" href="{{ route('users.login') }}">Ingresar</a>
    </div>
    <div class="text-left">
        <h3 class="ct-u-marginBoth0 ct-u-paddingTop5 ct-u-marginTopMinus10 ct-u-size24 ct-fw-400">REGÍSTRATE EN <i>PLURANZA 2016</i></h3>
    </div>
    @include('partials._errors')
    {!! Form::open(array('url' => route('pluranza.academies.store'), 'method' => 'post', 'class' => 'ct-u-paddingTop25 ct-u-form-control--Default ct-loginForm', 'accept-charset' => 'UTF-8')) !!}
        <div class="form-group">
            {!! Form::text('name', old('name'), array('placeholder' => 'Nombre de la Academia', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::text('phone', old('phone'), array('placeholder' => 'Tel&eacute;fono de contacto', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        {{--<div class="form-group">--}}
            {{--{!! Form::text('phone_confirmation', old('phone_confirmation'), array('placeholder' => 'Confirmar el tel&eacute;fono', 'class' => 'form-control input-sm', 'required' => 'required')) !!}--}}
        {{--</div>--}}
        <div class="form-group">
            {!! Form::email('email', old('email'), array('placeholder' => 'Email', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::email('email_confirmation', old('email_confirmation'), array('placeholder' => 'Confirmar Email', 'class' => 'form-control input-sm', 'required' => 'required')) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
        </div>
    <div class="form-group">
        {!! Form::password('password_confirmation', ['placeholder' => 'Confirmar contraseña', 'class' => 'form-control input-sm', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! app('captcha')->display() !!}
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