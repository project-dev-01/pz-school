<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    //
    public function index()
    {
        return view('admin.dashboard.index');
    }
    // setting show
    public function settings()
    {
        return view('admin.settings.index');
    }
}
