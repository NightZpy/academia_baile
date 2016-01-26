<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\User;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $redirectTo = 'usuarios/login';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('users.login');
        $this->middleware('guest');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users,email', 'g-recaptcha-response' => 'required|captcha']);
        $user = User::whereEmail($request->get('email'))->whereVerified(1)->count();
        if (!$user) {
            flash()->error('¡Verifica primero tu correo electrónico!');
            return redirect()->back();
        }
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('PURANZA 2016: Recuperación de contraseña.');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                flash()->success('Correo de recuperación enviado exitosamente, revise su buzón.');
                return redirect()->back()->with('status', trans($response));


            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6|alpha_num',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                flash()->success('Contraseña cambiada exitosamente.');
                return redirect($this->redirectPath())->with('status', trans($response));

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    protected function resetPassword($user, $password)
    {
        $user->password = $password;
        $user->save();

        //Auth::login($user);
    }
}
