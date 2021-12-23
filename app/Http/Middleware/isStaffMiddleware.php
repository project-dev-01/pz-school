<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isStaffMiddleware
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
            $role_id = $request->session()->get('role_id');
            if ($role_id == 3) {
                return $next($request);
            }
        } else {
            return redirect()->route('admin.login');
        }
        abort(403);
    }
}
