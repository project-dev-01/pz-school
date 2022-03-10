<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;

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
    // forum screen pages start
    public function forumIndex(){
        return view('student.forum.index');
    }
    public function forumPageSingleTopic(){
        return view('student.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        return view('student.forum.page-create-topic');
    }
    public function forumPageSingleUser(){
        return view('student.forum.page-single-user');
    }
    public function forumPageSingleThreads(){
        return view('student.forum.page-single-threads');
    }
    public function forumPageSingleReplies(){
        return view('student.forum.page-single-replies');
    }
    public function forumPageSingleFollowers(){
        return view('student.forum.page-single-followers');
    }
    public function forumPageSingleCategories(){
        return view('student.forum.page-single-categories');
    }
    public function forumPageCategories(){
        return view('student.forum.page-categories');
    }
    public function forumPageCategoriesSingle(){
        return view('student.forum.page-categories-single');
    }
    public function forumPageTabs(){
        return view('student.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('student.forum.page-tabs-guidelines');
    }    
     // faq screen pages end
     public function homeworkredirect()
     {
         return view('student.homework.hmeworklist');
     }
     public function analytic()
     {
         return view('student.analyticrep.analyticreport');
     }

    public function timetable(Request $request)
    {

        $student = User::find($request->session()->get('user_id'));
        $data = [
            'student_id' => $student['user_id']
        ];

        $days = array(
            'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday'
        );
        // dd($request);
        $timetable = Helper::PostMethod(config('constants.api.timetable_student'), $data);
        // dd($timetable);
        return view(
            'student.timetable.index',
            [
                'timetable' => isset($timetable['data']['timetable']) ? count($timetable['data']['timetable']) : 0,
                'details' => isset($timetable['data']['timetable']) ? count($timetable['data']['timetable']) : 0,
                'days' => $days,
                'max' => isset($timetable['data']['max']) ? count($timetable['data']['max']) : 0

            ]
        );
    }
     
}
