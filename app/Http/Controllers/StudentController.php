<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('student.dashboard.index');
    }
    public function settings()
    {
        return view('student.settings.index');
    }
    // faq screen pages start

    public function faqIndex()
    {
        return view('parent.faq.index');
    }
    // faq screen pages end
    // Home work screen pages start
    public function homeworklist()
    {
        return view('student.homework.hmeworklist');
    }
    // Home work screen pages end
    // Exam schedule
    public function examSchedule()
    {
        return view('student.exam.schedule');
    }
    // report card
    public function reportCard()
    {
        return view('student.report_card.index');
    }
    // event screen
    public function events()
    {
        return view('student.events.index');
    }
    // library screen
    public function bookList()
    {
        return view('student.library.book');
    }
    public function bookIssued()
    {
        return view('student.library.issued_book');
    }
}
