<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        // if (session()->has('locale')) {
        //     App::setLocale(session()->get('locale'));
        // }
        $availableLangs  = array('en', 'japanese');
        $userLangs = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if (session()->has('locale')) {
            App::setlocale(session()->get('locale'));
        } else if (in_array($userLangs, $availableLangs)) {
            App::setLocale($userLangs);
            $request->session()->put('locale', $userLangs);
        } else {
            App::setLocale('en');
            $request->session()->put('locale', 'en');
        }
        return $next($request);
    }
}
