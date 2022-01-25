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
    // LEAVE MANAGEMENT START
    public function applyleave()
    {
        return view('staff.leave_management.applyleave');
    }
    // forum screen pages start
    public function forumIndex(){
        return view('staff.forum.index');
    }
    public function forumPageSingleTopic(){
        return view('staff.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        return view('staff.forum.page-create-topic');
    }
    public function forumPageSingleUser(){
        return view('staff.forum.page-single-user');
    }
    public function forumPageSingleThreads(){
        return view('staff.forum.page-single-threads');
    }
    public function forumPageSingleReplies(){
        return view('staff.forum.page-single-replies');
    }
    public function forumPageSingleFollowers(){
        return view('staff.forum.page-single-followers');
    }
    public function forumPageSingleCategories(){
        return view('staff.forum.page-single-categories');
    }
    public function forumPageCategories(){
        return view('staff.forum.page-categories');
    }
    public function forumPageCategoriesSingle(){
        return view('staff.forum.page-categories-single');
    }
    public function forumPageTabs(){
        return view('staff.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('staff.forum.page-tabs-guidelines');
    }    
    // forum screen pages end

    // faq screen pages start

    public function faqIndex()
    {
        return view('staff.faq.index');
    }
    // faq screen pages end
}
