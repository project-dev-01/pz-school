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
        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));
        return view('teacher.forum.index', [
            'forum_list' => $forum_list['data']
        ]);
        // return view('teacher.forum.index');
    }
    public function forumPageSingleTopic()
    {
        return view('teacher.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        $category = Helper::GetMethod(config('constants.api.category'));

        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));

        return view('teacher.forum.page-create-topic', [
            'category' => $category['data'],
            'forum_list' => $forum_list['data']
        ]);
        //return view('teacher.forum.page-create-topic');
    }
    public function forumPageSingleUser()
    {
        $user_id = session()->get('user_id');
        $data = [
            'user_id' => $user_id
        ];
        $forum_post_user_crd = Helper::GETMethodWithData(config('constants.api.forum_post_user_created'), $data);
        $forum_categorypost_user_crd = Helper::GETMethodWithData(config('constants.api.forum_categorypost_user_created'), $data);
        //dd($forum_categorypost_user_crd);
        return view('teacher.forum.page-single-user', [
            'forum_post_user_crd' => $forum_post_user_crd['data'],
            'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data']
        ]);
        // return view('teacher.forum.page-single-user');
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
        $listcategoryvs = Helper::GetMethod(config('constants.api.listcategoryvs'));
        return view('teacher.forum.page-categories', [
            'listcategoryvs' => $listcategoryvs['data']
        ]);
        // return view('teacher.forum.page-categories');
    }
    public function forumPageCategoriesSingle($categId, $user_id, $category_names)
    {
        session()->put('session_category_names', $category_names);
        $data = [
            'categId' => $categId,
            'user_id' => $user_id
        ];
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_single_categ'), $data);

        return view('teacher.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
        //  return view('teacher.forum.page-categories-single');
    }
    public function forumPageTabs()
    {
        return view('teacher.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('teacher.forum.page-tabs-guidelines');
    }
    // forum create post 
    public function createpost(Request $request)
    {
        $data = [
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $request->inputTopicTags,
            'imagesorvideos' => $request->inputTopicTitle
        ];
        $response = Helper::PostMethod(config('constants.api.forum_cpost'), $data);
        return $response;
    }
    // Forum single topic with value pass
    public function forumPageSingleTopicwithvalue($id, $user_id)
    {
        $data = [
            'id' => $id,
            'user_id' => $user_id,
        ];
        $singlepost_repliesData = [
            'created_post_id' => $id,
            'user_id' => $user_id,
        ];
        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));
        $forum_singlepost = Helper::GETMethodWithData(config('constants.api.forum_single_post'), $data);
        $forum_singlepost_replies = Helper::GETMethodWithData(config('constants.api.forum_single_post_replies'), $data);
        //dd($forum_singlepost_replies);         
        return view('teacher.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            'forum_list' => $forum_list['data']

        ]);
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
            'teacher_class' => $response['data']
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
            "subject_id" => $request->subject_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_student_attendance'), $data);
        return $response;
    }
    function getShortTest(Request $request)
    {
        $data = [
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
        ];
        $response = Helper::PostMethod(config('constants.api.get_short_test'), $data);
        return $response;
    }
    function addShortTest(Request $request)
    {

        $data = [
            "short_test" => $request->short_test,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_short_test'), $data);
        return $response;
    }
    function addDailyReport(Request $request)
    {
        $data = [
            "daily_report" => $request->daily_report,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_daily_report'), $data);
        return $response;
    }
    function addDailyReportRemarks(Request $request)
    {
        $data = [
            "daily_report_remarks" => $request->daily_report_remarks,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_daily_report_remarks'), $data);
        return $response;
    }
}
