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
        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));
        //dd($forum_list);
        return view('student.forum.index', [
            'forum_list' => $forum_list['data']
        ]);
    }
    public function forumPageSingleTopic(){
        return view('student.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        $category = Helper::GetMethod(config('constants.api.category'));

        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));

        return view('student.forum.page-create-topic', [
            'category' => $category['data'],
            'forum_list' => $forum_list['data']
        ]);
    }
    public function forumPageSingleUser(){
        $user_id = session()->get('user_id');
        $data = [
            'user_id' => $user_id
        ];
        $forum_post_user_crd = Helper::GETMethodWithData(config('constants.api.forum_post_user_created'), $data);
        $forum_categorypost_user_crd = Helper::GETMethodWithData(config('constants.api.forum_categorypost_user_created'), $data);
        $forum_post_user_allreplies = Helper::GETMethodWithData(config('constants.api.forum_posts_user_repliesall'), $data);
        //$forum_threadslist = Helper::GetMethod(config('constants.api.forum_threadslist'));
        $forum_userthreadslist = Helper::GETMethodWithData(config('constants.api.forum_userthreadslist'), $data);
        //dd($forum_categorypost_user_crd);
        return view('student.forum.page-single-user', [
            'forum_post_user_crd' => $forum_post_user_crd['data'],
            'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            'forum_post_user_allreplies' =>$forum_post_user_allreplies['data'],
            'forum_userthreadslist' =>$forum_userthreadslist['data']
        ]);
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
        $listcategoryvs = Helper::GetMethod(config('constants.api.listcategoryvs'));
        return view('student.forum.page-categories', [
            'listcategoryvs' => $listcategoryvs['data']
        ]);
    }
    public function forumPageCategoriesSingle($categId, $user_id, $category_names){
        session()->put('session_category_names', $category_names);
        $data = [
            'categId' => $categId,
            'user_id' => $user_id
        ];
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_single_categ'), $data);

        return view('student.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
    }
    public function forumPageTabs(){
        return view('student.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('student.forum.page-tabs-guidelines');
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
            'imagesorvideos' => $request->inputTopicTitle,
            'threads_status'=>1
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
        return view('student.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            'forum_list' => $forum_list['data']

        ]);
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
