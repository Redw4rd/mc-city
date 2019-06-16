<?php

namespace App\Http\Middleware;

use Closure;

class AuthAfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (\Auth::check()) {
            return redirect()->intended(route('index'));
        }

        return $next($request);
    }
}
