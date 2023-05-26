<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Task;
use DataTables;
use Excel;
use App\Exports\ParentAttendanceExport;

class ParentController extends Controller
{
    //
    public function index(Request $request)
    {
        //  session()->pull('role_id');
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
        // session()->pull('password_changed_at');
        // $req->session()->flush();
        // $request->session()->put('children_id', "1");

        $user_id = session()->get('user_id');
        $student_id = session()->get('student_id');
        $parent_id = session()->get('ref_user_id');

        // dd($student_id);
        $data = [
            'user_id' => $user_id,
            'student_id' => isset($student_id) ? $student_id : 0,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $parent_ids = [
            'parent_id' => $parent_id,
        ];

        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $get_homework_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_homework_list_dashboard'), $data);
        $get_std_names_dashboard = Helper::GETMethodWithData(config('constants.api.get_students_parentdashboard'), $parent_ids);
        $get_leave_reasons_dashboard = Helper::GetMethod(config('constants.api.absent_reason_list'));
        $greetings = Helper::greetingMessage();
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        // dd($get_to_do_list_dashboard);
        $exam_by_student = Helper::GETMethodWithData(config('constants.api.exam_by_student'), $data);
        $all_exam_subject_scores = Helper::PostMethod(config('constants.api.all_exam_subject_scores'), $data);


        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($get_to_do_list_dashboard);
        return view(
            'parent.dashboard.index',
            [
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'get_homework_list_dashboard' => isset($get_homework_list_dashboard['data']) ? $get_homework_list_dashboard['data'] : [],
                'get_std_names_dashboard' => isset($get_std_names_dashboard['data']) ? $get_std_names_dashboard['data'] : [],
                'get_leave_reasons_dashboard' => isset($get_leave_reasons_dashboard['data']) ? $get_leave_reasons_dashboard['data'] : [],
                'all_exam_subject_scores' => isset($all_exam_subject_scores['data']) ? $all_exam_subject_scores['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'greetings' => isset($greetings) ? $greetings : "",
                'exams' => isset($exam_by_student['data']) ? $exam_by_student['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            ]
        );
    }
    // student leave 
    public function student_applyleave(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        } else {
            $base64 = null;
            $extension = null;
        }
        $status = "Pending";
        $parent_id = session()->get('ref_user_id');
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'parent_id' => $parent_id,
            'frm_leavedate' => $request->frm_leavedate,
            'to_leavedate' => $request->to_leavedate,
            'reasons' => $request->reason,
            'reason_text' => $request->reason_text,
            'remarks' => $request->remarks,
            'status' => $status,
            'file' => $base64,
            'file_extension' => $extension
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.std_leave_apply'), $data);
        return $response;
    }
    // reupload file
    public function reUploadLeaveFile(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        } else {
            $base64 = null;
            $extension = null;
        }
        $data = [
            'id' => $request->id,
            'document' => $request->document,
            'file' => $base64,
            'file_extension' => $extension
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.leave_reupload_file'), $data);
        return $response;
    }
    // student leave list
    public function getstudentleave_list()
    {
        $parentid = session()->get('ref_user_id');
        $parent_id = [
            'parent_id' => $parentid,
        ];
        $response = Helper::PostMethod(config('constants.api.studentleave_list'), $parent_id);
        // $response = Helper::GETMethodWithData(config('constants.api.studentleave_list'),$parent_id);

        // return $response;
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $upload_lang = __('messages.upload');
                if ($row['status'] != "Approve") {
                    return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile">Hello</a>
            </div>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function settings()
    {
        $data = [
            'parent_id' => session()->get('ref_user_id')
        ];
        $staff_profile_info = Helper::PostMethod(config('constants.api.parent_profile_info'), $data);
        return view(
            'parent.settings.index',
            [
                'user_details' => $staff_profile_info['data']
            ]
        );
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
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
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
            'parent_id' => "required",
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
                'parent_id' => $request->parent_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address
            ];
            $response = Helper::PostMethod(config('constants.api.update_parent_profile_info'), $data);
            return $response;
        }
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
            'parent.faq.index',
            [
                'data' => $data,
            ]
        );
    }

    public function examSchedule()
    {
        $student_id = session()->get('student_id');
        $data = [
            'student_id' => isset($student_id) ? $student_id : 0,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_student_parent'), $data);
        // dd($response);
        return view(
            'parent.exam.schedule',
            [
                'schedule_exam_list' => $response['data']
            ]
        );
    }

    public function viewExamTimetable(Request $request)
    {
        $no_data_available_lang = __('messages.no_data_available');
        $data = [
            'student_id' => session()->get('student_id'),
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
    public function reportCard()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $allexams = Helper::PostMethod(config('constants.api.all_exams_list'), $data);
        return view(
            'parent.report_card.index',
            [
                'allexams' => $allexams['data']
            ]
        );
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
        $parent = session()->get('ref_user_id');
        $children_id = session()->get('student_id');
        // dd($children_id);
        $data = [
            'parent_id' => $parent,
            'children_id' => $children_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
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
        return view(
            'parent.time_table.index',
            [
                'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : 0,
                'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : 0,
                'days' => $days,
                'max' => isset($timetable['data']['max']) ? $timetable['data']['max'] : 0

            ]
        );
    }
    // forum screen pages start
    public function forumIndex()
    {
        // $user_id = session()->get('user_id');
        // $data = [
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        //dd($forum_list);
        return view('parent.forum.index', [
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('parent.forum.page-single-topic');
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
        return view('parent.forum.page-create-topic', [
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
        return view('parent.forum.page-edit-topic', [
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
        return view('parent.forum.page-single-user', [
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
        return view('parent.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('parent.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('parent.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('parent.forum.page-single-categories');
    }
    public function forumPageCategories()
    {
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $listcategoryvs = Helper::GETMethodWithData(config('constants.api.listcategoryvs'), $data);
        return view('parent.forum.page-categories', [
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
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_user_category_list'), $data);

        return view('parent.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
    }
    public function forumPageTabs()
    {
        return view('parent.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('parent.forum.page-tabs-guidelines');
    }
    // forum create post 
    public function createpost(Request $request)
    {
        $current_user = session()->get('role_id');
        $rollid_tags = implode(",", $request->tags);
        $tags_add_also_currentroll = $rollid_tags . ',' . $current_user;
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
        //dd($data);
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
        return view('parent.forum.page-single-topic', [
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

    //attendance
    public function attendance()
    {
        $student_id = session()->get('student_id');
        $data = [
            'student_id' => isset($student_id) ? $student_id : 0,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        // $subjects = Helper::PostMethod(config('constants.api.get_child_subjects'), $data);
        // dd($subjects);
        return view(
            'parent.attendance.index',
            [
                'subjects' => $subjects['data'],
                'student_id' =>  session()->get('student_id')
            ]
        );
    }

    // Home work screen pages start
    public function homeworklist()
    {
        $student_id = session()->get('student_id');
        $data = [
            'student_id' => isset($student_id) ? $student_id : 0,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $homework = Helper::PostMethod(config('constants.api.homework_student'), $data);
        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);


        // dd($homework);
        return view(
            'parent.homework.list',
            [
                'homework' => isset($homework['data']['homeworks']) ? $homework['data']['homeworks'] : [],
                'subject' => $get_student_by_all_subjects['data'],
                'count' => isset($homework['data']['count']) ? $homework['data']['count'] : 0,
            ]
        );
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

        $student = session()->get('student_id');
        $data = [
            'status' => $request->status,
            'subject' => $request->subject,
            'student_id' => $student,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        // dd($data);

        $homework = Helper::PostMethod(config('constants.api.homework_student_filter'), $data);
        if ($homework['code'] == "200") {
            $response = "";
            if ($homework['data']) {
                foreach ($homework['data']['homeworks']  as $key => $work) {
                    if ($work['status'] == 1) {
                        $status = "Completed";
                        $top = "( Completed )";
                    } else {
                        $status = "InCompleted";
                        $top = "";
                    }


                    if ($work['status'] == 1) {
                        $file = '<div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">' . $attachment_file . ': </div>
                            <div class="col-md-3">
                                <a href="~/resources/views/Guide.pdf" download>
                                    <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                </a>
                            </div>
                        </div>
                    </div>';
                    } else {
                        $file = '';
                    }
                    $response .= '<form class="submitHomeworkForm" id="form' . $key . '" method="post"   enctype="multipart/form-data" autocomplete="off">
                    ' . csrf_field() . '
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>
                                <div>
                                    <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#hw-' . $key . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-caret-square-down"></i>' . $work['subject_name'] . ' - ' . date('j F Y', strtotime($work['date_of_homework'])) . ' ' . $top . '
                                    </a>
                                </div>
                                </p>
                                <div class="collapse" id="hw-' . $key . '">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $title_lang . ' :</div>
                                                    <div class="col-md-3">' . $work['title'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $status_lang . ' :</div>
                                                    <div class="col-md-3">' . $status . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $date_of_homework_lang . ' :</div>
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['date_of_homework'])) . '</div>
                                                </div>
                                            </div>

                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $date_of_submission_lang . ' :</div>
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['date_of_submission'])) . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $evalution_date_lang . ' :</div>
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['evaluation_date'])) . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $remarks_lang . ' :</div>
                                                    <div class="col-md-3">' . $work['description'] . '</div>
                                                </div>
                                            </div>
                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $rank_out_of_5_lang . ' :</div>
                                                    <div class="col-md-3">' . $work['rank'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $document_lang . ' :</div>
                                                    <div class="col-md-3">
                                                        <a href="~/resources/views/Guide.pdf" download>
                                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br />
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 font-weight-bold">' . $submission_process_here_lang . ' :- </div>

                                        </div><br>
                                        <input type="hidden" name="homework_id" value="' . $work['id'] . '">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">' . $note_lang . ' : </div>
                                                    <div class="col-md-5">
                                                        <textarea  name="remarks" rows="4" cols="25">' . $work['remarks'] . '</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            ' . $file . '
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
    //Children
    public function children()
    {

        if (session()->has('student_id')) {
            session()->pull('student_id');
        }
        return view('parent.dashboard.children');
    }
    public function chatShow()
    {
        return view('parent.chat.index');
    }
    public function analytic()
    {
        $student_id = session()->get('student_id');
        $data = [
            'student_id' => isset($student_id) ? $student_id : 0,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        $get_class_section_by_student = Helper::PostMethod(config('constants.api.get_class_section_by_student'), $data);

        // dd($data);
        return view(
            'parent.analyticrep.analyticreport',
            [
                'get_student_by_all_subjects' => $get_student_by_all_subjects['data'],
                'get_class_section_by_student' => $get_class_section_by_student['data']
            ]
        );
    }

    public function getEventList(Request $request)
    {
        $data = [
            'student_id' => session()->get('student_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.event_list_student'), $data);
        // dd($response);
        return DataTables::of($response['data'])
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
    //
    public function studentLeaves(Request $request)
    {
        // $request->session()->put('children_id', "1");

        $user_id = session()->get('user_id');
        $student_id = session()->get('student_id');
        $parent_id = session()->get('ref_user_id');

        $data = [
            'user_id' => $user_id,
            'student_id' => $student_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $parent_ids = [
            'parent_id' => $parent_id,
        ];
        // dd($data);

        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $get_homework_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_homework_list_dashboard'), $data);
        $get_std_names_dashboard = Helper::GETMethodWithData(config('constants.api.get_students_parentdashboard'), $parent_ids);
        $get_leave_reasons_dashboard = Helper::GetMethod(config('constants.api.absent_reason_list'));
        $greetings = Helper::greetingMessage();
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        // dd($get_homework_list_dashboard);
        $exam_by_student = Helper::GETMethodWithData(config('constants.api.exam_by_student'), $data);
        $all_exam_subject_scores = Helper::PostMethod(config('constants.api.all_exam_subject_scores'), $data);


        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($all_exam_subject_scores['data']);
        return view(
            'parent.leave_application.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
                'get_homework_list_dashboard' => $get_homework_list_dashboard['data'],
                'get_std_names_dashboard' => $get_std_names_dashboard['data'],
                'get_leave_reasons_dashboard' => $get_leave_reasons_dashboard['data'],
                'all_exam_subject_scores' => $all_exam_subject_scores['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'greetings' => $greetings,
                'exams' => $exam_by_student['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            ]
        );
    }

    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        return Excel::download(new ParentAttendanceExport(1, $request->student, $request->subject, $request->date), 'Student_Attendance.xlsx');
    }
}
