<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    //
    public function index()
    {
        return view('staff.dashboard.index');
    }
    public function settings()
    {
        return view('staff.settings.index');
    }
}
