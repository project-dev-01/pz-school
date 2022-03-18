<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Task;
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
        $student = session()->get('ref_user_id');
        $data = [
            'student_id' => $student,
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student'), $data);
        // dd($homework);
        return view(
            'student.homework.list',
            [
                'homework' => $homework['data']['homeworks'],
                'subject' => $homework['data']['subjects'],
                'count' => $homework['data']['count'],
            ]
        );
    }
    //Submit  Homework
    public function submitHomework(Request $request)
    {
        $student = session()->get('ref_user_id');

        $file = $request->file('file');

        // dd($request);
        $path = $file->path();
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        $extension = $file->getClientOriginalExtension();
        $data = [
            'homework_id' => $request->homework_id,
            'remarks' => $request->remarks,
            'student_id' => $student,
            'file' => $base64,
            'file_extension' => $extension,
        ];
        
        $response = Helper::PostMethod(config('constants.api.homework_submit'), $data);
        
        return $response;
    }

    //Filter  Homework
    public function filterHomework(Request $request)
    {
        $student = session()->get('ref_user_id');
        $data = [
            'status' => $request->status,
            'subject' => $request->subject,
            'student_id' => $student,
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student_filter'), $data);
        // dd($homework);
        if($homework['code']=="200")
        {
            $response ="";
            if($homework['data'])
            {
                foreach($homework['data']['homeworks'] as $work)
                {
                    if($work['status'] == 1) 
                    {
                        $status = "Completed";
                        $top = "( Completed )";
                    }else{
                        $status = "InCompleted";
                        $top= "";
                    }

                    
                    if($work['status'] == 1)
                    {
                        $file='<div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Attachment File: </div>
                            <div class="col-md-3">
                                <a href="'.asset('student/homework/').'/'.$work['file'].'" download>
                                    <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                </a>
                            </div>
                        </div>
                    </div>';

                    }else{
                            $file = '<div class="col-md-4">
                            <div class="row">
                                <div class="col-md-5 font-weight-bold">Attachment File: </div>
                                <div class="col-md-5">
    
                                    <input type="file" class="custom-file-input" name="file">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Submit
                            </button>
                        </div>';
                    }
                    $response.= '<form class="submitHomeworkForm" action="'.route('student.homework.submit').'" method="post"   enctype="multipart/form-data" autocomplete="off">
                    '.csrf_field() .'
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>
                                <div>
                                    <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#English" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-caret-square-down"></i>'.$work['subject_name'].' - '. date('j F Y', strtotime($work['date_of_homework'])) .' '.$top.'
                                    </a>
                                </div>
                                </p>
                                <div class="collapse" id="English">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Title :</div>
                                                    <div class="col-md-3">'.$work['title'].'</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Status :</div>
                                                    <div class="col-md-3">'.$status.'</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                                    <div class="col-md-3">'.date('F j , Y', strtotime($work['date_of_homework'])).'</div>
                                                </div>
                                            </div>

                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                                    <div class="col-md-3">'.date('F j , Y', strtotime($work['date_of_submission'])).'</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                                    <div class="col-md-3">'.date('F j , Y', strtotime($work['evaluation_date'])).'</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Remarks :</div>
                                                    <div class="col-md-3">'.$work['description'].'</div>
                                                </div>
                                            </div>
                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Rank Out Of 5 :</div>
                                                    <div class="col-md-3">'.$work['rank'].'</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Document :</div>
                                                    <div class="col-md-3">
                                                        <a href="'.asset('teacher/homework/').'/'.$work['document'].'" download>
                                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br />
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 font-weight-bold">Submission Process Here :- </div>

                                        </div><br>
                                        <input type="hidden" name="homework_id" value="'.$work['id'].'">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Note : </div>
                                                    <div class="col-md-5">
                                                        <textarea  name="remarks" rows="4" cols="25">'.$work['remarks'].'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            '.$file.'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </form>';
                }
            }
            $homework['list'] = $response;
            $homework['subject'] = $homework['data']['subject'];
        }
        
        return $homework;
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
        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data); 
        //dd($forum_list);
          return view('student.forum.index', [
            'forum_list' => $forum_list['data']
        ]);
       
    }
    public function forumPageSingleTopic(){
        return view('student.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames=Helper::GetMethod(config('constants.api.usernames_autocomplete'));
        //dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data);
        // dd($forum_list);
        return view('student.forum.page-create-topic', [
            'category' => $category['data'],
            'forum_list' => $forum_list['data'],
            'usernames' => $usernames['data']
        ]);  
    }
    public function forumPageSingleUser()
    {
        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        $forum_post_user_crd = Helper::GETMethodWithData(config('constants.api.forum_post_user_created'), $data);
        $forum_categorypost_user_crd = Helper::GETMethodWithData(config('constants.api.forum_categorypost_user_created'), $data);
        $forum_post_user_allreplies = Helper::GETMethodWithData(config('constants.api.forum_posts_user_repliesall'), $data);
        $forum_threadslist = Helper::GetMethod(config('constants.api.forum_threadslist'));
       // dd($forum_threadslist);
        return view('student.forum.page-single-user', [
            'forum_post_user_crd' => $forum_post_user_crd['data'],
            'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            'forum_post_user_allreplies' =>$forum_post_user_allreplies['data'],
            'forum_threadslist' =>$forum_threadslist['data']
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
            'tags' => $request->tags,
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
        $user_id= session()->get('user_id');  
        $usdata = [            
            'user_id' => $user_id
        ];
       
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$usdata);
        $forum_singlepost = Helper::GETMethodWithData(config('constants.api.forum_single_post'), $data);
        $forum_singlepost_replies = Helper::GETMethodWithData(config('constants.api.forum_single_post_replies'), $data);
        //dd($forum_singlepost_replies);         
        return view('student.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            'forum_list' => $forum_list['data']

        ]);
    }
    public function imagestore(Request $request)
    {
        //dd($request);     
        $task=new Task();
        $task->id=0;
        $task->exists=true;
        $image = $task->addMediaFromRequest('upload')->toMediaCollection('images');
        $geturl=$image->getUrl();
        //  dd($image->getUrl());
        return response()->json(['url'=>$image->getUrl()]);
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
                'timetable' => $timetable['data']['timetable'],
                'details' => $timetable['data']['details'],
                'days' => $days,
                'max' => $timetable['data']['max']

            ]
        );
    }
     
}
