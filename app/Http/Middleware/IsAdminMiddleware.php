<?php

namespace App\Http\Middleware;

use Closure;

class IsAdminMiddleware
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
        if (!\Auth::check())
            return redirect()->route('index');

        if (!\Auth::user()->isAdmin())
            return redirect()->route('index');

        return $next($request);
    }
}
