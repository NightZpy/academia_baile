<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Configuration;
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
        // Using Closure based composers...
        view()->composer('*', function ($view) {
            $configuration = Configuration::first();
            if (auth()->check()) {
                if (auth()->user()->academy) {
                    $currentAcademy = auth()->user()->academy;
                    $view->with(compact('currentAcademy'));
                    //flash()->error('¡Testing chars!');
                }
            }
            if(Configuration::count() >= 1)
                $view->with(compact('configuration'));
            // un comment
        });
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
