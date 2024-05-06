<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use DataTables;
use App\Models\User;
use App\Models\Task;

class StudentController extends Controller
{
    //
    public function index()
    {
        //     session()->pull('role_id');
        // session()->pull('token');
        // session()->pull('picture');
        // session()->pull('name');
        // session()->pull('email');
        // session()->pull('role_name');
        // session()->pull('user_id');
        // session()->pull('branch_id');
        // session()->pull('ref_user_id');
        // session()->pull('student_id');
        // session()->pull('school_name');
        // session()->pull('school_logo');
        // session()->pull('all_child');
        // session()->pull('academic_session_id');
        // // session()->pull('password_changed_at');
        // $req->session()->flush();
        // echo "ff";exit;
        $myArray = session()->get('hidden_week_ends');
        $delimiter = ','; // Delimiter you want between array items
        $hiddenWeekends = implode($delimiter, $myArray);
        $user_id = session()->get('user_id');
        $student_id = session()->get('ref_user_id');
        $data = [
            'user_id' => $user_id,
            'student_id' => $student_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $get_homework_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_homework_list_dashboard'), $data);
        $greetings = Helper::greetingMessage();
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        // dd($get_homework_list_dashboard);
        $exam_by_student = Helper::GETMethodWithData(config('constants.api.exam_by_student'), $data);
        $all_exam_subject_scores = Helper::PostMethod(config('constants.api.all_exam_subject_scores'), $data);


        // $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'student.dashboard.index',
            [
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'get_homework_list_dashboard' => isset($get_homework_list_dashboard['data']) ? $get_homework_list_dashboard['data'] : [],
                'greetings' => isset($greetings) ? $greetings : "",
                'all_exam_subject_scores' => isset($all_exam_subject_scores['data']) ? $all_exam_subject_scores['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'exams' => isset($exam_by_student['data']) ? $exam_by_student['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
                'hiddenWeekends' => isset($hiddenWeekends) ? $hiddenWeekends : ""
            ]
        );
    }
    function addDailyReportRemarks(Request $request)
    {
        $data = [
            "student_remarks" => $request->student_remarks,
            "student_id" => session()->get('ref_user_id'),
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
            "date" => $request->date,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_daily_report_by_student'), $data);
        return $response;
    }
    public function settings()
    {

        $data = [
            'student_id' => session()->get('ref_user_id')
        ];
        $student_profile_info = Helper::PostMethod(config('constants.api.student_profile_info'), $data);
        return view(
            'student.settings.index',
            [
                'user_details' => isset($student_profile_info['data']) ? $student_profile_info['data'] : []
            ]
        );
    }
    // faq screen pages start

    public function faqIndex()
    {

        $data = [
            'email' => session()->get('email'),
            'name' => session()->get('name'),
            'role_name' => session()->get('role_name')

        ];
        return view(
            'student.faq.index',
            [
                'data' => isset($data) ? $data : [],
            ]
        );
    }
    // faq screen pages end
    // Home work screen pages start
    public function homeworklist()
    {
        $student = session()->get('ref_user_id');
        $data = [
            'student_id' => $student,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student'), $data);

        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        return view(
            'student.homework.list',
            [
                'homework' => isset($homework['data']['homeworks']) ? $homework['data']['homeworks'] : [],
                'subject' => isset($get_student_by_all_subjects['data']) ? $get_student_by_all_subjects['data'] : [],
                'count' => isset($homework['data']['count']) ? $homework['data']['count'] : 0,
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
            'student_name' => session()->get('name'),
            'file' => $base64,
            'file_extension' => $extension,
        ];

        $response = Helper::PostMethod(config('constants.api.homework_submit'), $data);
        return $response;
    }

    //Filter  Homework
    public function filterHomework(Request $request)
    {
        $title_lang = __('messages.title');
        $status_lang = __('messages.status');
        $date_of_homework_lang = __('messages.date_of_homework');
        $date_of_submission_lang = __('messages.date_of_submission');
        $evalution_date_lang = __('messages.evalution_date');
        $remarks_lang = __('messages.remarks');
        $rank_out_of_5_lang = __('messages.rank_out_of_5');
        $document_lang = __('messages.document');
        $submission_process_here_lang = __('messages.submission_process_here');
        $note_lang = __('messages.note');
        $attachment_file = __('messages.attachment_file');
        $submit_lang = __('messages.submit');
        $choose_file_lang = __('messages.choose_file');

        $student = session()->get('ref_user_id');
        $data = [
            'status' => $request->status,
            'subject' => $request->subject,
            'student_id' => $student,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student_filter'), $data);
        // dd($homework);
        if ($homework['code'] == "200") {
            $response = "";
            if ($homework['data']) {
                foreach ($homework['data']['homeworks'] as $key => $work) {
                    $evaluation_date = (isset($work['evaluation_date'])) ? date('F j , Y', strtotime($work['evaluation_date'])) : "-";
                    if ($work['status'] == 1) {
                        $status = "Completed";
                        $top = "( Completed )";
                    } else {
                        $status = "InCompleted";
                        $top = "";
                    }
                    $homework_status = "";
                    if ($work['homework_status'] == 1) {
                        $homework_status = "( Not Submitted )";
                    } else if ($work['homework_status'] == 0) {
                        $homework_status = "( Submitted )";
                    }
                    if ($work['document']) {
                        $document = '
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $document_lang . '</span><a href="' . config('constants.image_url') . '/' . config('constants.branch_id') . '/teacher/homework/' . $work['document'] . '" download>
                                        <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                    </a></p>
                            </div>
                        </div>';
                    } else {
                        $document = '<div class="col-md-6">
                        <div class="row">
                            <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $document_lang . '</span></p>
                        </div>';
                    }
                    if ($work['file']) {
                        $file = '<div class="col-md-6">
                                    <div class="col-md-6 font-weight-bold">' . $attachment_file . '<span class="text-danger">*</span>: </div>
                                        <div class="col-md-6">
                                            <a href="' . config('constants.image_url') . '/' . config('constants.branch_id') . '/student/homework/' . $work['file'] . '" download>
                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                    } else {
                        $file = '<div class="col-md-6">
                                <div class="col-md-6 font-weight-bold">' . $attachment_file . '<span class="text-danger">*</span> : </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="">
                                            <input type="file" id="homework_file" class="custom-file-input homework_file" name="file">
                                            <label class="custom-file-label" for="document">' . $choose_file_lang . '</label>
                                            <span id="file_name"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                ' . $submit_lang . '
                            </button>
                        </div>';
                    }
                    $response .= '<form class="submitHomeworkForm" id="form' . $key . '" action="' . route('student.homework.submit') . '" method="post"   enctype="multipart/form-data" autocomplete="off">
                    ' . csrf_field() . '
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>
                                <div>
                                    <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#hw-' . $key . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-caret-square-down"></i>' . $work['subject_name'] . ' - ' . date('j F Y', strtotime($work['date_of_homework'])) . ' ' . $top . ' ' . $homework_status . ' 
                                    </a>
                                </div>
                                </p>
                                <div class="collapse" id="hw-' . $key . '">
                                    <div class="card card-body">
                                    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $title_lang . '</span>' . $work['title'] . '</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $status_lang . '</span>' . $status . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $date_of_homework_lang . '</span>' . date('F j , Y', strtotime($work['date_of_homework'])) . '</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $date_of_submission_lang . '</span>' . date('F j , Y', strtotime($work['date_of_submission'])) . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $evalution_date_lang . '</span>' . $evaluation_date . '</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $remarks_lang . '</span>' . $work['description'] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <p class="col-md-12"><span class="font-weight-semibold homework-list">' . $rank_out_of_5_lang . ' </span>' . $work['rank'] . '</p>
                                                </div>
                                            </div>
                                            ' . $document . '
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 font-weight-bold" >' . $submission_process_here_lang . ' :- </div>

                                        </div><br>
                                        <input type="hidden" name="homework_id" value="' . $work['id'] . '">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="col-md-12"><span class="font-weight-semibold">' . $note_lang . ' <span class="text-danger">*</span></span><textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="Enter the text..." name="remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="255" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                                ' . $work['remarks'] . '</textarea></p>

                                            </div>
                                            ' . $file . '
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
        $data = [
            'student_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_student_parent'), $data);
        return view(
            'student.exam.schedule',
            [
                'schedule_exam_list' => isset($response['data']) ? $response['data'] : []
            ]
        );
    }

    public function viewExamTimetable(Request $request)
    {
        $no_data_available_lang = __('messages.no_data_available');
        $data = [
            'student_id' => session()->get('ref_user_id'),
            'exam_id' => $request->exam_id
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_get_student_parent'), $data);

        // dd($response);  
        if ($response['code'] == "200") {

            $output = "";
            $row = 1;
            if ($response['data']['exam']) {
                foreach ($response['data']['exam'] as $exam) {

                    if ($exam['distributor_type'] == "1") {
                        $type = "Internal";
                    } elseif ($exam['distributor_type'] == "2") {
                        $type = "External";
                    } else {
                        $type = "NILL";
                    }
                    $output .= '<tr>
                                    <td>' . $exam['subject_name'] . '</td>
                                    <td>' . $exam['paper_name'] . '</td>
                                    <td>' . $exam['exam_date'] . '</td>
                                    <td>' . $exam['time_start'] . '</td>
                                    <td>' . $exam['time_end'] . '</td>
                                    <td>' . $exam['hall_no'] . '</td>
                                    <td>' . $exam['distributor'] . ' (' . $type . ') ' . '</td>
                                </tr>';
                    $row++;

                    $class_section = $exam['class_name'] . '(' . $exam['section_name'] . ')';
                }
            } else {
                $output .= '<tr>
                                <td colspan="7" class="text-center"> ' . $no_data_available_lang . '</td>
                            </tr>';
            }

            $response['table'] = $output;
            $response['class_section'] = $class_section;
        }

        // dd($response);
        return $response;
    }
    // report card
    public function reportCard()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $allexams = Helper::PostMethod(config('constants.api.all_exams_list'), $data);
        return view(
            'student.report_card.index',
            [
                'allexams' => isset($allexams['data']) ? $allexams['data'] : []
            ]
        );
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
    public function forumIndex()
    {
        // $user_id= session()->get('user_id');  
        // $data = [            
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        //dd($forum_list);
        return view('student.forum.index', [
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('student.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        $id = session()->get('user_id');
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'), $data);
        //dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        // dd($forum_list);
        return view('student.forum.page-create-topic', [
            'category' => $category['data'],
            //'forum_list' => $forum_list['data'],
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => $usernames['data'],
            'user_id' => $id
        ]);
    }
    public function forumPageEditTopic($id)
    {
        // $user_id = session()->get('user_id');
        // $data = [
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id,
            'id' => $id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'), $data);
        // dd($usernames);
        $forum_edit = Helper::GETMethodWithData(config('constants.api.forum_edit'), $data);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        // dd($forum_edit);
        return view('student.forum.page-edit-topic', [
            'category' => $category['data'],
            'forum_edit' => !empty($forum_edit['data']) ? $forum_edit['data'] : [],
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => $usernames['data']
        ]);
    }
    public function forumPageSingleUser()
    {
        $user_id = session()->get('user_id');
        $data = [
            'user_id' => $user_id
        ];
        $forum_post_user_crd = Helper::GETMethodWithData(config('constants.api.forum_post_user_created'), $data);
        $forum_categorypost_user_crd = Helper::GETMethodWithData(config('constants.api.forum_categorypost_user_created'), $data);
        $forum_post_user_allreplies = Helper::GETMethodWithData(config('constants.api.forum_posts_user_repliesall'), $data);
        $forum_userthreadslist = Helper::GETMethodWithData(config('constants.api.forum_userthreadslist'), $data);
        // dd($forum_threadslist);
        return view('student.forum.page-single-user', [
            // 'forum_post_user_crd' => $forum_post_user_crd['data'],
            // 'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            // 'forum_post_user_allreplies' => $forum_post_user_allreplies['data'],
            // 'forum_threadslist' => $forum_threadslist['data']
            'forum_post_user_crd' => !empty($forum_post_user_crd['data']) ? $forum_post_user_crd['data'] : [],
            'forum_categorypost_user_crd' => !empty($forum_categorypost_user_crd['data']) ? $forum_categorypost_user_crd['data'] : [],
            'forum_post_user_allreplies' => !empty($forum_post_user_allreplies['data']) ? $forum_post_user_allreplies['data'] : [],
            'forum_userthreadslist' => !empty($forum_userthreadslist['data']) ? $forum_userthreadslist['data'] : []
        ]);
    }
    public function forumPageSingleThreads()
    {
        return view('student.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('student.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('student.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('student.forum.page-single-categories');
    }
    public function forumPageCategories()
    {
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $listcategoryvs = Helper::GETMethodWithData(config('constants.api.listcategoryvs'), $data);
        return view('student.forum.page-categories', [
            'listcategoryvs' => $listcategoryvs['data']
        ]);
    }
    public function forumPageCategoriesSingle($categId, $user_id, $category_names)
    {
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
    public function forumPageTabs()
    {
        return view('student.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('student.forum.page-tabs-guidelines');
    }
    // forum create post 
    public function createpost(Request $request)
    {
        $current_user = session()->get('role_id');
        $rollid_tags = implode(",", $request->tags);
        $adminid = 2;
        $tags_add_also_currentroll = $rollid_tags . ',' . $current_user . ',' . $adminid;
        $data = [
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $tags_add_also_currentroll,
            // 'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 1
        ];
        $response = Helper::PostMethod(config('constants.api.forum_cpost'), $data);
        return $response;
    }
    // forum update post 
    public function updatepost(Request $request)
    {
        $current_user = session()->get('role_id');
        $rollid_tags = implode(",", $request->tags);
        $adminid = 2;
        $tags_add_also_currentroll = $rollid_tags . ',' . $current_user . ',' . $adminid;
        $data = [
            'id' => $request->id,
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $tags_add_also_currentroll,
            // 'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 2
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.forum_updatepost'), $data);
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
        // $user_id = session()->get('user_id');
        // $usdata = [
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $usdata = [
            'user_id' => $user_id
        ];

        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $usdata);
        $forum_singlepost = Helper::GETMethodWithData(config('constants.api.forum_single_post'), $data);
        $forum_singlepost_replies = Helper::GETMethodWithData(config('constants.api.forum_single_post_replies'), $data);
        //dd($forum_singlepost_replies);         
        return view('student.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []

        ]);
    }
    public function imagestore(Request $request)
    {
        $base64 = "";
        $extension = "";
        $file = $request->file('upload');
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();

            $data = [
                'filename' => pathinfo($filenamewithextension, PATHINFO_FILENAME),
                'photo' => $base64,
                'file_extension' => $extension,
            ];
            // dd($data);

            $response = Helper::PostMethod(config('constants.api.forum_image_store'), $data);
            // $response = Helper::PostMethod(config('constants.api.forum_image_store'), $data);
            echo json_encode([

                'default' => config('constants.image_url') . $response['path'] . $response['file_name'],

                '500' =>  config('constants.image_url') . $response['path'] . $response['file_name'],

            ]);
        }
    }
    // faq screen pages end
    public function homeworkredirect()
    {
        return view('student.homework.hmeworklist');
    }
    public function analytic()
    {
        $data = [
            'student_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        $get_class_section_by_student = Helper::PostMethod(config('constants.api.get_class_section_by_student'), $data);

        // dd($get_class_section_by_student['data']['student_id']);
        return view(
            'student.analyticrep.analyticreport',
            [
                'get_student_by_all_subjects' => isset($get_student_by_all_subjects['data']) ? $get_student_by_all_subjects['data'] : [],
                'get_class_section_by_student' => isset($get_class_section_by_student['data']) ? $get_class_section_by_student['data'] : []
            ]
        );
    }

    public function timetable(Request $request)
    {
        $data = [
            'student_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $days = array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        );
        // dd($request);
        $timetable = Helper::PostMethod(config('constants.api.timetable_student'), $data);
        // dd($timetable);
        return view(
            'student.timetable.index',
            [
                'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : 0,
                'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : 0,
                'days' => isset($days) ? $days : [],
                'max' => isset($timetable['data']['max']) ? $timetable['data']['max'] : 0

            ]
        );
    }

    public function getEventList(Request $request)
    {
        $data = [
            'student_id' => session()->get('ref_user_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.event_list_student'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('classname', function ($row) {
                $audience = $row['audience'];
                if ($audience == 1) {
                    return "Everyone";
                } else if ($audience == 2) {
                    return "<b>Grade </b>: " . $row['class_name'];
                } else if ($audience == 3) {
                    return "<b>Group </b>: " . $row['group_name'];
                }
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" id="viewEventBtn"><i class="fe-eye"></i></a>
                        </div>';
            })
            ->rawColumns(['classname', 'publish', 'actions'])
            ->make(true);
    }
    public function getEventDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.event_details'), $data);
        return $response;
    }
    // change password
    public function changeNewPassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'id' => "required",
            'old' => "required",
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/'
            ],
            'confirmed' => 'required|same:password|min:8'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'old' => $request->old,
                'password' => $request->password,
                'confirmed' => $request->confirmed
            ];
            $response = Helper::PostMethod(config('constants.api.change_password'), $data);
            return $response;
        }
    }
    // update te profile
    public function updateProfileInfo(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'id' => "required",
            'student_id' => "required",
            'first_name' => "required",
            'email' => "required",
            'mobile_no' => "required",
            'address' => "required",
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address
            ];
            $response = Helper::PostMethod(config('constants.api.update_student_profile_info'), $data);
            return $response;
        }
    }
    public function buletin_board()
    {
        return view('student.bulletin_board.index');
    }
    public function getBuletinBoardStudentList(Request $request)
    {
        $data = [
            'role_id' => session()->get('role_id'),
            'student_id' => session()->get('ref_user_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_student'), $data);
        //dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $image_url = !empty($row['file']) ? config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $row['file'] : '';
                $description = htmlspecialchars($row['discription'], ENT_QUOTES, 'UTF-8'); // Encoding with quotes
                $encoded_data = json_encode([
                    'image_url' => $image_url,
                    'title' => $row['title'],
                    'description' => $description,
                ]);
                return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="openFilePopup(' . htmlspecialchars($encoded_data, ENT_QUOTES, 'UTF-8') . ')"><i class="fe-eye"></i></a>
                    <a href="' . config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $row['file'] . '" class="btn btn-danger waves-effect waves-light">
                    <i class="fe-download" data-toggle="tooltip" title="Click to download..!"></i>
                </a>
                </div>';
            })
            ->rawColumns(['publish', 'actions'])
            ->make(true);
    }
    public function bulletinStar(Request $request)
    {
        $data = [
            'id' => $request->id,
            'parentImp' => $request->parentImp,
            'role_id' => session()->get('role_id'),
            'user_id' =>  session()->get('ref_user_id'),
            'updated_by' => session()->get('ref_user_id'),
            'created_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bulletin_star_student'), $data);
        return $response;
    }
    public function getBuletinBoardImpStudentList(Request $request)
    {
        $data = [
            'role_id' => session()->get('role_id'),
            'student_id' => session()->get('ref_user_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_imp_student'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $image_url = !empty($row['file']) ? config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $row['file'] : '';
                $description = htmlspecialchars($row['discription'], ENT_QUOTES, 'UTF-8'); // Encoding with quotes
                $encoded_data = json_encode([
                    'image_url' => $image_url,
                    'title' => $row['title'],
                    'description' => $description,
                ]);
                return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="openFilePopup(' . htmlspecialchars($encoded_data, ENT_QUOTES, 'UTF-8') . ')"><i class="fe-eye"></i></a>
                    <a href="' . config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $row['file'] . '" class="btn btn-danger waves-effect waves-light">
                    <i class="fe-download" data-toggle="tooltip" title="Click to download..!"></i>
                </a>
                </div>';
            })
            ->rawColumns(['publish', 'actions'])
            ->make(true);
    }
    public function page403(Request $request)
    {
        return view('student.dashboard.403');
    }
}
