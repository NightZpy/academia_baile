<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        array_push($this->except, parse_url(route('pluranza.competitors.store'))['path']);
        \Debugbar::info($request);
        \Debugbar::info($request->file('song'));
        \Debugbar::info($request->hasFile('song'));
        \Debugbar::info(['Request is: ' => $request->is($this->except[0])]);
        if ($this->shouldPassThrough($request) || $this->isReading($request) || $this->tokensMatch($request)) {
            \Debugbar::info($request->file('song'));
            return $this->addCookieToResponse($request, $next($request));
        }
        flash()->error('Tu sessión para el formulario ha expirado, intentalo de nuevo.');
        return redirect()->back();
        #throw new TokenMismatchException;
    }

    protected function shouldPassThrough($request)
    {
        \Debugbar::info(['excepts' => $this->except]);
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                \Debugbar::info(['except' => $except,'Is: ' => $request->is($except)]);
                return true;
            }
            \Debugbar::info(['no-except' => $except,'Is: ' => $request->is($except)]);
        }

        return false;
    }
}
