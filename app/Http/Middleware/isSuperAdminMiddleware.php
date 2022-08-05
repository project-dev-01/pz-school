<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class isSuperAdminMiddleware
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
            // $school_name_url = $request->session()->get('school_name_url');
            // dd($school_name_url);
            URL::defaults([
                'school_name_url' =>  ""
            ]);
            if ($role_id == 1) {
                return $next($request);
            }
        } else {
            return redirect()->route('super_admin.login');
        }
        abort(403);
    }
}
