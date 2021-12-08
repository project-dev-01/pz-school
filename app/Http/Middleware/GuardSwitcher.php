<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuardSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $defaultGuard = null) {
        if (in_array($defaultGuard, array_keys(config("auth.guards")))) {
           config(["auth.defaults.guard" => $defaultGuard]);
        }
        return $next($request);
    }
}
