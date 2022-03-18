<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Task;
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
    
    // static page controller end
    // forum screen pages start
    public function forumIndex()
    {
        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data); 
        //dd($forum_list);
          return view('teacher.forum.index', [
            'forum_list' => $forum_list['data']
        ]);
        
    }
    public function forumPageSingleTopic()
    {
        return view('teacher.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames=Helper::GetMethod(config('constants.api.usernames_autocomplete'));
        //dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data);
        // dd($forum_list);
        return view('teacher.forum.page-create-topic', [
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
        return view('teacher.forum.page-single-user', [
            'forum_post_user_crd' => $forum_post_user_crd['data'],
            'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            'forum_post_user_allreplies' =>$forum_post_user_allreplies['data'],
            'forum_threadslist' =>$forum_threadslist['data']
        ]);
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
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_user_category_list'), $data);

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
       
        return view('teacher.forum.page-single-topic', [
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
        $data = [
            'teacher_id' => session()->get('user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view('teacher.attendance.index', [
            'teacher_class' => $response['data']
        ]);
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
    public function homework()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view(
            'teacher.homework.index',
            [
                'class' => $response['data'],
            ]
        );
    }

    public function evaluationReport()
    {
        

        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);


        // dd($response);
        // $getclass = Helper::GetMethod(config('constants.api.class_list'));
        return view(
            'teacher.homework.evaluation_report',
            [
                'class' => $response['data'],
            ]
        );
    }

    //add Homework
    public function addHomework(Request $request)
    {
        $created_by = session()->get('user_id');

        $file = $request->file('file');
        $path = $file->path();
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        $extension = $file->getClientOriginalExtension();

        $data = [
            'title' => $request->title,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'date_of_homework' => $request->date_of_homework,
            'date_of_submission' => $request->date_of_submission,
            'schedule_date' => $request->schedule_date,
            'description' => $request->description,
            'file' => $base64,
            'file_extension' => $extension,
            'created_by' => $created_by,
        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.homework_add'), $data);
        // dd($response);
        return $response;
    }
    
    // get Homework
    public function getHomework(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
        ];

        $homework = Helper::PostMethod(config('constants.api.homework_list'), $data);

        // dd($homework);
        if($homework['code']=="200") {
            $response ="";
            $row=1;
            if($homework['data']['homework']) {
                foreach($homework['data']['homework'] as $work)
                {
                    $total_students = $homework['data']['total_students'];
                    if($work['students_completed']==Null)
                    {
                        $completed = 0;
                        $incompleted = $total_students;
                    }else{
                        $completed = $work['students_completed'];
                        $incompleted = $total_students-$completed;
                    }
                    
                    $response.= '<tr>
                                    <td>'.$row.'</td>
                                    <td>'.$work['title'].'</td>
                                    <td>'.$work['date_of_homework'].'</td>
                                    <td>'.$work['date_of_submission'].'</td>
                                    <td>'.$completed.'/'.$incompleted.'</td>
                                    <td>'.$homework['data']['total_students'].'</td>
                                    <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="'.$work['id'].'" data-target=".firstModal"><i class="fas fa-bars"></i> Details</a></td>
                                </tr>';
                    $row++;
                }
            }else{
                    $response.= '<tr>
                                    <td colspan="7"> No Data Available</td>
                                </tr>';
            }
    
            $homework['table'] = $response;
            
        }
        return $homework;
    }
    // view Homework
    public function viewHomework(Request $request)
    {
        $data = [
            'homework_id' => $request->homework_id,
            'status' => $request->status,
            'evaluation' => $request->evaluation,
        ];

        
        $homework = Helper::PostMethod(config('constants.api.homework_view'), $data);
        
        
        if($homework['code']=="200")
        {
            $response ="";
            $complete=0;
            $incomplete=0;
            $checked = 0;
            $unchecked = 0;
            if($homework['data'])
            {
                $row=1;
                foreach($homework['data'] as $work)
                {
                    $check = "";
                    $disabled = "";
                    if($work['score_name']=="Marks") {
                        $score_name = '<select  class="form-control" required="" name="homework['.$row.'][score_name]">
                                                <option Selected>Marks</option>
                                                <option>Grade</option>
                                                <option>Text</option>
                                            </select>';
                    }elseif($work['score_name']=="Grade") {
                        $score_name = '<select  class="form-control" required="" name="homework['.$row.'][score_name]">
                                            <option>Marks</option>
                                            <option Selected>Grade</option>
                                            <option>Text</option>
                                        </select>';
                    }elseif($work['score_name']=="Text") {
                        $score_name = '<select  class="form-control" required="" name="homework['.$row.'][score_name]">
                                                <option>Marks</option>
                                                <option>Grade</option>
                                                <option Selected>Text</option>
                                            </select>';
                    }else{
                        $score_name = '<select  class="form-control" required="" name="homework['.$row.'][score_name]">
                                                <option>Marks</option>
                                                <option>Grade</option>
                                                <option>Text</option>
                                            </select>';
                    }
                        
                    if($work['evaluation_id']==Null) {
                       $disabled = "disabled";
                    }

                    if($work['correction']=="1") {
                        $check = "checked";
                        $checked++;
                    }else {
                        $unchecked++;
                    }

                    if($work['status']=="1") {
                        $status = '<button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Completed</button>';
                        $complete++;
                    }else {
                        $status= '<button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button>';
                        $incomplete++;
                    }
                    
                    
                    $response.= '<tr>
                                    <input type="hidden" value="'.$work['evaluation_id'].'" name="homework['.$row.'][homework_evaluation_id]">
                                    <td>'.$row.'</td>
                                    <td>'.$work['first_name'].' '.$work['last_name'].'</td>
                                    <td>'.$work['register_no'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="score_name">Status</label>
                                            '.$score_name.'
                                        </div>
                                        <input type="text" class="form-control" name="homework['.$row.'][score_value]" value="'.$work['score_value'].'" aria-describedby="inputGroupPrepend" >

                                    </td>
                                    <td><input type="text" class="form-control" name="homework['.$row.'][teacher_remarks]"  value="'.$work['teacher_remarks'].'" aria-describedby="inputGroupPrepend" ></td>
                                    <td>
                                        <i data-feather="file-text" class="icon-dual"></i>
                                        <span class="ml-2 font-weight-semibold"><a  href="'.asset('student/homework/').'/'.$work['file'].'" download class="text-reset">'.$work['file'].'</a></span>
                                    </td>
                                    <td>'.$work['remarks'].'</td>
                                    <td>
                                        <div class="checkbox checkbox-primary mb-3">
                                            <input  type="checkbox"  '.$check.$disabled.'  name="homework['.$row.'][correction]">
                                            <label for="correction"></label>
                                        </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            }else{
                    $response.= '<tr>
                                    <td colspan="9"> No Data Available</td>
                                </tr>';
            }
            $homework['table'] = $response;
            $homework['complete'] = $complete;
            $homework['incomplete'] = $incomplete;
            $homework['checked'] = $checked;
            $homework['unchecked'] = $unchecked;
            
            
        }
        
        return $homework;
    }

    //submit Evaluation
    public function evaluation(Request $request)
    {
        $evaluated_by = session()->get('user_id');
        $data = [
            'homework' => $request->homework,
            'evaluated_by' => $evaluated_by,
        ];
        $response = Helper::PostMethod(config('constants.api.homework_evaluate'), $data);
        // dd($response);
        return $response;
    }

     

    public function homeworkEdit()
    {
        return view('teacher.homework.edit');
    }
    public function addDepartment(Request $request)
    {
        $data = [
            'name' => $request->department_name
        ];
        $response = Helper::PostMethod(config('constants.api.department_add'), $data);
        return $response;
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
        // dd($request);
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

     // subject by Class
     public function subjectByClass(Request $request)
     {
        $data = [
            'section_id' => $request->section_id,
            'class_id' => $request->class_id,
            'teacher_id' => session()->get('ref_user_id')
        ];
         $subject = Helper::PostMethod(config('constants.api.teacher_subject'),$data);
         return $subject;
     }
 
     // Section by Class
     public function sectionByClass(Request $request)
     {
         $data = [
             'class_id' => $request->class_id,
             'teacher_id' => session()->get('ref_user_id')
         ];
         $section = Helper::PostMethod(config('constants.api.teacher_section'), $data);
         return $section;
     }
    
}
