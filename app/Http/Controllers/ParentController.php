<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;

class ParentController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->session()->put('children_id', "1");
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
    public function taskIndex()
    {
        return view('parent.task.index');
    }
    public function timeTable(Request $request)
    {
        $parent = User::find($request->session()->get('user_id'));
        // dd($parent);
        $data = [
            'parent_id' => $parent['user_id']
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
        
        $timetable = Helper::PostMethod(config('constants.api.timetable_parent'), $data);
        // dd($timetable);
        // dd(isset($timetable['data']['timetable']) ? count($timetable['data']['timetable']) : 0);
        // isset($etable['data']['timetable']) ? count($etable['data']['timetable']) : 0;
        return view(
            'parent.time_table.index',
            [
                'timetable' => isset($timetable['data']['timetable']) ? count($timetable['data']['timetable']) : 0,
                'details' => isset($timetable['data']['timetable']) ? count($timetable['data']['timetable']) : 0,
                'days' => $days,
                'max' => isset($timetable['data']['max']) ? count($timetable['data']['max']) : 0
            ]
        );
    }
    // forum screen pages start
    public function forumIndex(){
        return view('parent.forum.index');
    }
    public function forumPageSingleTopic(){
        return view('parent.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        return view('parent.forum.page-create-topic');
    }
    public function forumPageSingleUser(){
        return view('parent.forum.page-single-user');
    }
    public function forumPageSingleThreads(){
        return view('parent.forum.page-single-threads');
    }
    public function forumPageSingleReplies(){
        return view('parent.forum.page-single-replies');
    }
    public function forumPageSingleFollowers(){
        return view('parent.forum.page-single-followers');
    }
    public function forumPageSingleCategories(){
        return view('parent.forum.page-single-categories');
    }
    public function forumPageCategories(){
        return view('parent.forum.page-categories');
    }
    public function forumPageCategoriesSingle(){
        return view('parent.forum.page-categories-single');
    }
    public function forumPageTabs(){
        return view('parent.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('parent.forum.page-tabs-guidelines');
    }
    
     // faq screen pages end

    //attendance
     public function attendance()
    {
        $data = [
            'ref_user_id' => session()->get('ref_user_id')
        ];

        $subjects = Helper::PostMethod(config('constants.api.get_child_subjects'), $data);
        return view(
            'parent.attendance.index',
            [
                'subjects' => $subjects['data']
            ]
        );
    }

     // Home work screen pages start
     public function homeworklist()
     {
         return view('parent.homework.hmeworklist');
     }
     //Children
     public function children()
     {

        if(session()->has('children_id')){
            session()->pull('children_id');
        }
        return view('parent.dashboard.children');
     }
     public function chatShow()
    {
        return view('parent.chat.index');
    }
    public function homeworkredirect()
    {
        return view('parent.homework.hmeworklist');
    }
    public function analytic()
    {
        return view('parent.analyticrep.analyticreport');
    }
}
