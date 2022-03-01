<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

class TeacherController extends Controller
{
    //
    public function index()
    {
        return view('teacher.dashboard.index');
    }
    public function applyleave()
    {
        return view('teacher.leave_management.applyleave');
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
    public function forumIndex()
    {
        return view('teacher.forum.index');
    }
    public function forumPageSingleTopic()
    {
        return view('teacher.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        return view('teacher.forum.page-create-topic');
    }
    public function forumPageSingleUser()
    {
        return view('teacher.forum.page-single-user');
    }
    public function forumPageSingleThreads()
    {
        return view('teacher.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('teacher.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('teacher.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('teacher.forum.page-single-categories');
    }
    public function forumPageCategories()
    {
        return view('teacher.forum.page-categories');
    }
    public function forumPageCategoriesSingle()
    {
        return view('teacher.forum.page-categories-single');
    }
    public function forumPageTabs()
    {
        return view('teacher.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
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
        $data = [
            'teacher_id' => session()->get('user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view('teacher.classroom.management', [
            'teacher_class' => !empty($response['data']) ? $response['data'] : $$response
        ]);
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

    public function attendanceList()
    {
        return view('teacher.attendance.index');
    }
    public function byclasss()
    {
        return view('teacher.exam_results.byclass');
    }
    public function bysubject()
    {
        return view('teacher.exam_results.bysubject');
    }
    public function bystudent()
    {
        return view('teacher.exam_results.bystudent');
    }


    public function evaluationReport()
    {
        return view('teacher.homework.evaluation_report');
    }

    public function homeworkEdit()
    {
        return view('teacher.homework.edit');
    }
    public function analytic()
    {
        return view('teacher.analyticrep.analyticreport');
    }
    function classroomPost(Request $request)
    {
        // echo "<pre>";
        // print_r($request);

        $data = [
            "attendance" => $request->attendance,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
            "date" => $request->date
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_student_attendance'), $data);
        return $response;
    }
}
