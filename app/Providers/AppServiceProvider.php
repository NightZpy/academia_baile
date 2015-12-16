<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::setEchoFormat('e(utf8_encode(%s))');

        //$data = ['email' => 'nightzpy@gmail.com', 'password' => '1234'];
        //Auth::attempt($this->getCredentials($data), false);
        //$academieParticipant = Auth::user()->academieParticipant;
        //view()->share(compact('academyParticipant'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') 
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        
    }

    protected function getCredentials($data)
    {
        return [
            'email'    => $data('email'),
            'password' => $data('password'),
            'verified' => data
        ];
    }
}
