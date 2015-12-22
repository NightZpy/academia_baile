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
        // Using Closure based composers...
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $academy = auth()->user()->academy;
                $view->with(compact('academy'));
            }
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
