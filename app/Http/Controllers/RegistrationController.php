<?php

namespace App\Http\Controllers;

use App\Mailers\AppMailer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class RegistrationController extends Controller
{
    /**
     * Create a new registration instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the register page.
     *
     * @return \Response
     */
    public function register()
    {
        return view('auth.register');
    }
    /**
     * Perform the registration.
     *
     * @param  Request   $request
     * @param  AppMailer $mailer
     * @return \Redirect
     */
    public function postRegister(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $user = User::create($request->all());
        $mailer->sendEmailConfirmationTo($user);
        flash('Se ha registrado con éxito. Información con detalles ha sido enviada al correo electronico especificado!');
        return redirect()->back();
    }
    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirm($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        flash('Tu correo ha sido confirmado. Ya puedes ingresar!');
        return redirect()->route('users.login');
    }

    public function confirmPluranza($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        flash('Tu correo ha sido confirmado. Ya puedes ingresar!');
        return redirect()->route('pluranza.index');
    }
}
