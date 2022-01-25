<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    //
    public function index()
    {
        return view('parent.dashboard.index');
    }
    public function settings()
    {
        return view('parent.settings.index');
    }
     // faq screen pages start

     public function faqIndex()
     {
         return view('parent.faq.index');
     }
     // faq screen pages end
}
