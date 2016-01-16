<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Closure;

class OwnExhibition
{

    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check() || (!\Auth::user()->ownerOfExhibition($request->id)) && !\Entrust::hasRole('admin'))
            abort(404);
        return $next($request);
    }
}