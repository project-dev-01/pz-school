<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageManager
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
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        if (session()->has('locale')) {
            App::setLocale($setLang);
        } else {
            App::setLocale($setLang);
            $request->session()->put('locale', $setLang);
        }
        return $next($request);
    }
}
