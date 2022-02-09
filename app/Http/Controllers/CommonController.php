<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function updateSettingSession(Request $request)
    {
        // dd($request);
        if (session()->has('picture') && $request->picture) {
            session()->pull('picture');
            $request->session()->put('picture', $request->picture);
            return true;
        } else {
            return false;
        }
    }
    public function showApplicationForm()
    {
        return view('school-application-form');
    }
    
}
