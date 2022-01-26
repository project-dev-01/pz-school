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

     public function examSchedule()
    {
        return view('parent.exam.schedule');
    }
    
    public function reportCard()
    {
        return view('parent.report_card.index');
    }
    public function events()
    {
        return view('parent.events.index');
    }
    public function bookList()
    {
        return view('parent.library.book');
    }
    public function bookIssued()
    {
        return view('parent.library.issued_book');
    }
     // faq screen pages end
}
