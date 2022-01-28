<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //
    public function index()
    {
        return view('teacher.dashboard.index');
    }
    public function settings()
    {
        return view('teacher.settings.index');
    }
    // static page controller start
    public function admission()
    {
        return view('teacher.admission.index');
    }
    public function studentIndex()
    {
        return view('teacher.student.student');
    }
    public function parent()
    {
        return view('teacher.parent.index');
    }
    public function studentEntry()
    {
        return view('teacher.attendance.student');
    }
    public function examEntry()
    {
        return view('teacher.attendance.exam');
    }
    public function homework()
    {
        return view('teacher.homework.index');
    }

    // static page controller end
    // forum screen pages start
    public function forumIndex(){
        return view('teacher.forum.index');
    }
    public function forumPageSingleTopic(){
        return view('teacher.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        return view('teacher.forum.page-create-topic');
    }
    public function forumPageSingleUser(){
        return view('teacher.forum.page-single-user');
    }
    public function forumPageSingleThreads(){
        return view('teacher.forum.page-single-threads');
    }
    public function forumPageSingleReplies(){
        return view('teacher.forum.page-single-replies');
    }
    public function forumPageSingleFollowers(){
        return view('teacher.forum.page-single-followers');
    }
    public function forumPageSingleCategories(){
        return view('teacher.forum.page-single-categories');
    }
    public function forumPageCategories(){
        return view('teacher.forum.page-categories');
    }
    public function forumPageCategoriesSingle(){
        return view('teacher.forum.page-categories-single');
    }
    public function forumPageTabs(){
        return view('teacher.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('teacher.forum.page-tabs-guidelines');
    }    
    // forum screen pages end

    // faq screen pages start

    public function faqIndex()
    {
        return view('teacher.faq.index');
    }
    public function classroomManagement()
    {
        return view('teacher.classroom.management');
    }
    // faq screen pages end

    
    public function testResult()
    {
        return view('teacher.testresult.index');
    }
    public function chatShow()
    {
        return view('teacher.chat.index');
    }
    public function taskIndex()
    {
        return view('teacher.task.index');
    }
    // static page controller end


}
