<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard()->check()) return redirect(RouteServiceProvider::HOME);
        if (Auth::guard('company')->check()) return redirect(RouteServiceProvider::COMPANIES_HOME);

        return $next($request);
    }
}
