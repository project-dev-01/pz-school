<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\URL;

class isParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('role_id')) {
            if ($request->session()->get('role_id') == 5) {
                return $next($request);
            }
        } else {
            return redirect()->route('parent.login');
        }
        abort(403);
    }
}
