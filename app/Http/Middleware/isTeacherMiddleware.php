<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\URL;

class isTeacherMiddleware
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
            // URL::defaults([
            //     'school_name_url' =>  $school_name_url
            // ]);
            if ($role_id == 4) {
                return $next($request);
            }
        } else {
            return redirect()->route('admin.login');
        }
        abort(403);
    }
}
