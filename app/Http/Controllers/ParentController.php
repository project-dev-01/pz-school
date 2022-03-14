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
        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));
        //dd($forum_list);
        return view('parent.forum.index', [
            'forum_list' => $forum_list['data']
        ]);
    }
    public function forumPageSingleTopic(){
        return view('parent.forum.page-single-topic');
    }
    public function forumPageCreateTopic(){
        $category = Helper::GetMethod(config('constants.api.category'));

        $forum_list = Helper::GetMethod(config('constants.api.forum_list'));

        return view('parent.forum.page-create-topic', [
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
        return view('parent.forum.page-single-user', [
            'forum_post_user_crd' => $forum_post_user_crd['data'],
            'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            'forum_post_user_allreplies' =>$forum_post_user_allreplies['data'],
            'forum_userthreadslist' =>$forum_userthreadslist['data']
        ]);
     
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
        $listcategoryvs = Helper::GetMethod(config('constants.api.listcategoryvs'));
        return view('parent.forum.page-categories', [
            'listcategoryvs' => $listcategoryvs['data']
        ]);
    }
    public function forumPageCategoriesSingle($categId, $user_id, $category_names){
        session()->put('session_category_names', $category_names);
        $data = [
            'categId' => $categId,
            'user_id' => $user_id
        ];
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_user_category_list'), $data);

        return view('parent.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
    }
    public function forumPageTabs(){
        return view('parent.forum.page-tabs');
    }
    public function forumPageTabGuidelines(){
        return view('parent.forum.page-tabs-guidelines');
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
        return view('parent.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            'forum_list' => $forum_list['data']

        ]);
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
