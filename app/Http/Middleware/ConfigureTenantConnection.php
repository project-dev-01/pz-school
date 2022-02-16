<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConfigureTenantConnection
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
        if (session()->has('role_id') && session()->has('db_name')) {
            $db_name = $request->session()->get('db_name');
            $db_username = $request->session()->get('db_username');
            $db_password = $request->session()->get('db_password');
            config([
                'database.connections.tenant' => [
                    'driver' => 'mysql',
                    // I don’t know what column names you use, but…
                    'host' => 'localhost',
                    // 'port' => '',
                    'database' => $db_name,
                    'username' => $db_username,
                    'password' => $db_password,
                ],
            ]);
            return $next($request);
            // if ($role_id == 2) {
            //     return $next($request);
            // }
        } else {
            return redirect()->route('admin.login');

        }
        abort(403);
        // return $next($request);
    }
}
