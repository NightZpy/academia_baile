<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Closure;

class OwnPayment
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
        if (\Auth::check() && !\Auth::user()->ownerOfPayment($request->id) || !\Entrust::role('admin'))
            abort(404);
        return $next($request);
    }
}