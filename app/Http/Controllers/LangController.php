<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
class LangController extends Controller
{
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        $hour = time() + 3600 * 24 * 30;
        Cookie::queue(Cookie::make('locale', $request->lang, $hour));
        return redirect()->back();
    }
    
}
