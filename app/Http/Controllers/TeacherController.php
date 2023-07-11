<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Task;
use PhpParser\Node\Expr\FuncCall;
use DataTables;
use Excel;
use App\Exports\StaffAttendanceExport;
use App\Exports\StudentAttendanceExport;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Session\TokenMismatchException;

class TeacherController extends Controller
{
    //
    public function index()
    {
        // session()->pull('role_id');
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
        // session()->flush();
        // echo "ff";exit;
        $user_id = session()->get('user_id');
        $teacher_id = session()->get('ref_user_id');
        $data = [
            'user_id' => $user_id,
            'teacher_id' => $teacher_id,
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $greetings = Helper::greetingMessage();
        $teacher_count = Helper::GetMethod(config('constants.api.teacher_count'));
        $count['teacher_count'] = isset($teacher_count['data']) ? $teacher_count['data'] : 0;
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'teacher.dashboard.index',
            [
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'greetings' => isset($greetings) ? $greetings : [],
                'count' => isset($count) ? $count : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            ]
        );
    }
    public function applyleave()
    {
        $get_leave_reasons = Helper::GetMethod(config('constants.api.get_leave_reasons'));
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $get_leave_types = Helper::GETMethodWithData(config('constants.api.get_leave_types'), $data);
        $leave_taken_history = Helper::PostMethod(config('constants.api.leave_taken_history'), $data);
        return view('teacher.leave_management.applyleave', [
            'get_leave_types' => isset($get_leave_types['data']) ? $get_leave_types['data'] : [],
            'get_leave_reasons' => isset($get_leave_reasons['data']) ? $get_leave_reasons['data'] : [],
            'leave_taken_history' => isset($leave_taken_history['data']) ? $leave_taken_history['data'] : [],
        ]);
    }
    // staff leave 
    public function staffApplyLeave(Request $request)
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
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'leave_type' => $request->leave_type,
            'from_leave' => $request->from_leave,
            'to_leave' => $request->to_leave,
            'total_leave' => $request->total_leave,
            'academic_session_id' => $request->academic_session_id,
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'status' => $status,
            'document' => $base64,
            'file_extension' => $extension
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.staff_apply_leave'), $data);
        return $response;
    }
    public function getStaffLeaveList()
    {
        $staff_id = [
            'staff_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_history'), $staff_id);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $upload_lang = __('messages.upload');
                // if ($row['document'] != "Approve") {
                if (is_null($row['document'])) {
                    return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile">' . $upload_lang . '</a>
            </div>';
                } else {
                    return '-';
                }
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function studentLeaveShow()
    {

        $staff_data = [
            'teacher_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.class_teacher_classes'), $staff_data);
        return view('teacher.student_leave.index', [
            'classes' => isset($getclass['data']) ? $getclass['data'] : []
        ]);
    }
    public function allleaves()
    {
        return view('teacher.leave_management.allleaves');
    }
    public function getAllLeaveList(Request $request)
    {
        $staff_data = [
            'staff_id' => $request->staff_id,
            'leave_status' => $request->leave_status,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.leave_approval_history_by_staff'), $staff_data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $details_lang = __('messages.details');
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-staff_id="' . $row['staff_id'] . '" id="viewDetails">' . $details_lang . '</a>
                            </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function settings()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $staff_profile_info = Helper::PostMethod(config('constants.api.staff_profile_info'), $data);
        return view(
            'teacher.settings.index',
            [
                'user_details' => isset($staff_profile_info['data']) ? $staff_profile_info['data'] : []
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
                // 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
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
            'staff_id' => "required",
            'first_name' => "required",
            'email' => "required",
            'mobile_no' => "required",
            'present_address' => "required",
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'staff_id' => $request->staff_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'present_address' => $request->present_address
            ];
            $response = Helper::PostMethod(config('constants.api.update_profile_info'), $data);
            return $response;
        }
    }
    // static page controller start
    public function admission()
    {
        return view('teacher.admission.index');
    }
    public function studentIndex()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.student.student',
            [
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
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
        return view('teacher.forum.index', [
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('teacher.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        $id = session()->get('user_id');
        // $data = [
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'), $data);
        //dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        // dd($forum_list);
        return view('teacher.forum.page-create-topic', [
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
        return view('teacher.forum.page-edit-topic', [
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
        //dd($forum_userthreadslist);
        return view('teacher.forum.page-single-user', [
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
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id
        ];
        $listcategoryvs = Helper::GETMethodWithData(config('constants.api.listcategoryvs'), $data);
        //dd($listcategoryvs);
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

        return view('teacher.forum.page-single-topic', [
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
    // forum screen pages end

    // faq screen pages start

    public function faqIndex()
    {

        $data = [
            'email' => session()->get('email'),
            'name' => session()->get('name'),
            'role_name' => session()->get('role_name')

        ];
        return view(
            'teacher.faq.index',
            [
                'data' => isset($data) ? $data : [],
            ]
        );
    }
    public function classroomManagement()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('teacher.classroom.management', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            'teacher_classroom_class_id' => Cookie::get('teacher_classroom_class_id'),
            'teacher_classroom_section_id' => Cookie::get('teacher_classroom_section_id'),
            'teacher_classroom_subject_id' => Cookie::get('teacher_classroom_subject_id'),
            'teacher_classroom_date' => Cookie::get('teacher_classroom_date'),
            'teacher_classroom_semester' => Cookie::get('teacher_classroom_semester'),
            'teacher_classroom_session' => Cookie::get('teacher_classroom_session')
        ]);
    }
    // faq screen pages end
    public function testResult()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);

        //$get_exams = Helper::GetMethod(config('constants.api.get_testresult_exams'));
        // dd($response);     
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('teacher.testresult.index', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            //   'get_exams' => $get_exams['data']
        ]);
    }
    public function chatShow()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'to_id' => session()->get('ref_user_id'),
            'role' => "Teacher"
        ];

        $teacherData = [
            'id' => session()->get('ref_user_id'),
            'role' => "Teacher"
        ];
        $group_list = Helper::GETMethodWithData(config('constants.api.chat_group_list'), $data);
        $parent_list = Helper::GETMethodWithData(config('constants.api.chat_parent_list'), $teacherData);
        $teacher_list = Helper::GETMethodWithData(config('constants.api.chat_teacher_list'), $teacherData);
        // dd($parent_list);
        return view('teacher.chat.index', [
            'teacher_list' => isset($teacher_list['data']) ? $teacher_list['data'] : [],
            'parent_list' => isset($parent_list['data']) ? $parent_list['data'] : [],
            'group_list' => isset($group_list['data']) ? $group_list['data'] : [],
            'name' => session()->get('name'),
            'role' => "Teacher",
            'tid' => session()->get('ref_user_id'),
        ]);
        return view('teacher.chat.index');
    }
    //GetParent List
    public function parentlist()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'to_id' => session()->get('ref_user_id'),
            'role' => "Teacher"
        ];

        $response = Helper::GETMethodWithData(config('constants.api.chat_parent_list'), $data);
        return $response;
    }
    //Get Teacher List
    public function teacherlist()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'to_id' => session()->get('ref_user_id'),
            'role' => "Teacher"
        ];
        $response = Helper::GETMethodWithData(config('constants.api.chat_teacher_list'), $data);

        return $response;
    }

    // Save Chat

    public function savechat(Request $request)
    {
        try {

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
            $status = "Unread";
            $data = [
                'chat_fromid' => $request->chat_fromid,
                'chat_fromname' => $request->chat_fromname,
                'chat_fromuser' => $request->chat_fromuser,
                'chat_toid' => $request->chat_toid,
                'chat_toname' => $request->chat_toname,
                'chat_touser' => $request->chat_touser,
                'chat_content' => $request->chat_content,
                'chat_status' => $status,
                'chat_document' => $base64,
                'chat_file_extension' => $extension
            ];
            // dd($data);       
            $response = Helper::PostMethod(config('constants.api.tchat'), $data);
            // $response = Helper::GetMethod(config('constants.api.chat_teacher_list'));
            //dd($response);
            return $response;
        } catch (TokenMismatchException $e) {
            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }
    }
    // Save Chat

    public function deletechat(Request $request)
    {
        $data = [
            'chat_id' => $request->chat_id
        ];
        // dd($data);       
        $response = Helper::PostMethod(config('constants.api.tdelchat'), $data);
        // $response = Helper::GetMethod(config('constants.api.chat_teacher_list'));
        //dd($response);
        return $response;
    }
    // Delete Chat

    public function chatshowlist(Request $request)
    {
        try {
            $data = [
                'chat_fromid' => $request->chat_fromid,
                'chat_fromname' => $request->chat_fromname,
                'chat_fromuser' => $request->chat_fromuser,
                'chat_toid' => $request->chat_toid,
                'chat_toname' => $request->chat_toname,
                'chat_touser' => $request->chat_touser
            ];
            //dd($data);       


            $response = Helper::PostMethod(config('constants.api.chatlists'), $data);
            //dd($response);
            return $response;
        } catch (TokenMismatchException $e) {
            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }
    }
    public function chatgroupshowlist(Request $request)
    {

        $data = [
            'chat_fromid' => $request->chat_fromid,
            'chat_fromname' => $request->chat_fromname,
            'chat_fromuser' => $request->chat_fromuser,
            'chat_toid' => $request->chat_toid,
            'chat_toname' => $request->chat_toname,
            'chat_touser' => $request->chat_touser
        ];
        //dd($data);       


        $response = Helper::PostMethod(config('constants.api.chatlists'), $data);
        //dd($response);
        return $response;
    }

    public function taskIndex()
    {
        return view('teacher.task.index');
    }
    // static page controller end

    public function attendanceList()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];

        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view('teacher.attendance.index', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    // by classes
    public function byclasss()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.exam_results.byclass',
            [
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    // by subject 
    public function bysubject()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.exam_results.bysubject',
            [
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    // by student
    public function bystudent()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.exam_results.bystudent',
            [
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    // overall
    public function overall()
    {
        $datas = array();
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $allGrades = Helper::GetMethod(config('constants.api.tot_grade_master'));
        $allexams = Helper::PostMethod(config('constants.api.all_exams_list'), $datas);

        return view(
            'teacher.exam_results.overall',
            [
                'classnames' => $getclass['data'],
                'allexams' => $allexams['data'],
                'allGrades' => $allGrades['data'],
            ]
        );
    }
    // individual result
    public function examResult()
    {
        // data already use this api post so empty var sent
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);

        return view(
            'teacher.exam.result',
            [
                'classnames' => $getclass['data']
            ]
        );
    }
    public function paperWiseResult()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view('teacher.testresult.paper_wise_result', [
            'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function homework()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $class = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        return view(
            'teacher.homework.index',
            [
                'class' => isset($class['data']) ? $class['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
            ]
        );
    }
    public function evaluationReport()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));

        // dd($response);
        // $getclass = Helper::GetMethod(config('constants.api.class_list'));
        return view(
            'teacher.homework.evaluation_report',
            [
                'class' => isset($response['data']) ? $response['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'date_of_homework' => $request->date_of_homework,
            'date_of_submission' => $request->date_of_submission,
            'schedule_date' => $request->schedule_date,
            'description' => $request->description,
            'file' => $base64,
            'file_extension' => $extension,
            'created_by' => $created_by,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.homework_add'), $data);
        // dd($response);
        return $response;
    }

    // get Homework
    public function getHomework(Request $request)
    {
        $details_lang = __('messages.details');
        $no_data_available_lang = __('messages.no_data_available');
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $homework = Helper::PostMethod(config('constants.api.homework_list'), $data);

        // dd($homework);
        if ($homework['code'] == "200") {
            $response = "";
            $row = 1;
            if ($homework['data']['homework']) {
                foreach ($homework['data']['homework'] as $work) {
                    $total_students = $homework['data']['total_students'];
                    if ($work['students_completed'] == Null) {
                        $completed = 0;
                        $incompleted = $total_students;
                    } else {
                        $completed = $work['students_completed'];
                        $incompleted = $total_students - $completed;
                    }

                    $response .= '<tr>
                                    <td>' . $row . '</td>
                                    <td>' . $work['title'] . '</td>
                                    <td>' . $work['date_of_homework'] . '</td>
                                    <td>' . $work['date_of_submission'] . '</td>
                                    <td>' . $completed . '/' . $incompleted . '</td>
                                    <td>' . $homework['data']['total_students'] . '</td>
                                    <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $work['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> <span style="color: white">' . $details_lang . '</span></a></td>
                                </tr>';
                    $row++;
                }
            } else {
                $response .= '<tr>
                                    <td colspan="7"> ' . $no_data_available_lang . '</td>
                                </tr>';
            }

            $homework['table'] = $response;
        }
        return $homework;
    }
    // view Homework
    public function viewHomework(Request $request)
    {
        $marks_lang = __('messages.marks');
        $grade_lang = __('messages.grade');
        $text_lang = __('messages.text');
        $completed_lang = __('messages.completed');
        $incompleted_lang = __('messages.incompleted');

        $no_data_available_lang = __('messages.no_data_available');
        $data = [
            'homework_id' => $request->homework_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];


        $homework = Helper::PostMethod(config('constants.api.homework_view'), $data);


        if ($homework['code'] == "200") {
            $response = "";
            $complete = 0;
            $incomplete = 0;
            $checked = 0;
            $unchecked = 0;
            if ($homework['data']) {
                $row = 1;
                foreach ($homework['data'] as $work) {
                    $check = "";
                    $disabled = "";
                    if ($work['score_name'] == "Marks") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                                <option value="Marks" Selected>' . $marks_lang . '</option>
                                                <option value="Grade">' . $grade_lang . '</option>
                                                <option value="Text">' . $text_lang . '</option>
                                            </select>';
                    } elseif ($work['score_name'] == "Grade") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                            <option value="Marks">' . $marks_lang . '</option>
                                            <option value="Grade" Selected>' . $grade_lang . '</option>
                                            <option value="Text">' . $text_lang . '</option>
                                        </select>';
                    } elseif ($work['score_name'] == "Text") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                                <option value="Marks">' . $marks_lang . '</option>
                                                <option value="Grade">' . $grade_lang . '</option>
                                                <option value="Text" Selected>' . $text_lang . '</option>
                                            </select>';
                    } else {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                                <option value="Marks">' . $marks_lang . '</option>
                                                <option value="Grade">' . $grade_lang . '</option>
                                                <option value="Text">' . $text_lang . '</option>
                                            </select>';
                    }

                    if ($work['evaluation_id'] == Null) {
                        $disabled = "disabled";
                    }

                    if ($work['correction'] == "1") {
                        $check = "checked";
                        $checked++;
                    } else {
                        $unchecked++;
                    }

                    if ($work['status'] == "1") {
                        $status = '<button type="button" class="btn btn-success btn-rounded waves-effect waves-light" style="border:none;">' . $completed_lang . '</button>';
                        $complete++;
                    } else {
                        $status = '<button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" style="border:none;">' . $incompleted_lang . '</button>';
                        $incomplete++;
                    }


                    $response .= '<tr>
                                    <input type="hidden" value="' . $work['evaluation_id'] . '" name="homework[' . $row . '][homework_evaluation_id]">
                                    <td>' . $row . '</td>
                                    <td>' . $work['first_name'] . ' ' . $work['last_name'] . '</td>
                                    <td>' . $work['register_no'] . '</td>
                                    <td>' . $status . '</td>
									 <td>
                                        <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col-sm-6"> 
                                            ' . $score_name . '                                       
										</div>
                                            <div class="col-sm-6">                                                
											 <input type="text" class="form-control" name="homework[' . $row . '][score_value]" value="' . $work['score_value'] . '" aria-describedby="inputGroupPrepend" >
											</div>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
									<div class="form-group mb-2">
                                        <div class="row">
										 <div class="col-sm-12"> 
										<input type="text" class="form-control" name="homework[' . $row . '][teacher_remarks]"  value="' . $work['teacher_remarks'] . '" aria-describedby="inputGroupPrepend" >
                                    </div>
									</div>
									</div>
                                    <td>
                                        <i data-feather="file-text" class="icon-dual"></i>
                                        <span class="ml-2 font-weight-semibold"><a  href="' . asset('student/homework/') . '/' . $work['file'] . '" download class="text-reset">' . $work['file'] . '</a></span>
                                    </td>
                                    <td>' . $work['remarks'] . '</td>
                                    <td>
                                        <div class="checkbox checkbox-primary mb-3">
                                            <input  type="checkbox"  ' . $check . $disabled . ' id="' . $row . '" name="homework[' . $row . '][correction]">
                                            <label for="' . $row . '"></label>
                                        </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            } else {
                $response .= '<tr>
                                    <td colspan="9"> ' . $no_data_available_lang . '</td>
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
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        // dd(session()->get('ref_user_id'));
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('teacher.analyticrep.analyticreport', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            'teacher_analytic_class_id' => Cookie::get('teacher_analytic_class_id'),
            'teacher_analytic_section_id' => Cookie::get('teacher_analytic_section_id'),
            'teacher_analytic_subject_id' => Cookie::get('teacher_analytic_subject_id'),
            'teacher_analytic_student_id' => Cookie::get('teacher_analytic_student_id'),
            'teacher_analytic_semester' => Cookie::get('teacher_analytic_semester'),
            'teacher_analytic_session' => Cookie::get('teacher_analytic_session')
        ]);
        // return view('teacher.analyticrep.analyticreport', [
        //     'teacher_class' => $response['data']
        // ]);
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
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
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
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
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
            "subject_id" => $request->subject_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
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
            "subject_id" => $request->subject_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
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
            "subject_id" => $request->subject_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_daily_report_remarks'), $data);
        return $response;
    }
    // student leave update
    public function getstudentleave_update(Request $request)
    {
        $data = [
            "attendance" => $request->attendance,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id
        ];

        $response = Helper::PostMethod(config('constants.api.update_student_leave'), $data);
        return $response;
    }

    // subject by Class
    public function subjectByClass(Request $request)
    {
        $data = [
            'section_id' => $request->section_id,
            'class_id' => $request->class_id,
            'teacher_id' => session()->get('ref_user_id'),
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        $subject = Helper::PostMethod(config('constants.api.teacher_subject'), $data);
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
    public function subjectmarks(Request $request)
    {
        $data = [

            "subjectmarks" => $request->subjectmarks,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
            "paper_id" => $request->paper_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id,
            "grade_category" => $request->grade_category,
            "exam_id" => $request->exam_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $response = Helper::PostMethod(config('constants.api.add_student_marks'), $data);

        return $response;
    }
    public function getsubjectdivision(Request $request)
    {
        $data = [
            "subjectmarks" => $request->subjectmarks,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id
        ];
        $response = Helper::PostMethod(config('constants.api.get_subject_division'), $data);
        return $response;
    }
    public function subjectdivisionAdd(Request $request)
    {
        //    dd($request);
        $data = [
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
            "subjectdiv" => $request->subjectdiv,
            "exam_id" => $request->exam_id,

        ];
        // dd($data);
        // echo "<pre>";
        // print_r($data);
        // exit;
        $response = Helper::PostMethod(config('constants.api.add_subject_division'), $data);
        return $response;
    }


    public function employeeEntry()
    {
        $employee = session()->get('ref_user_id');
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.attendance.employee',
            [
                'employee' => isset($employee) ? $employee : "",
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
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
        $response = Helper::PostMethod(config('constants.api.staff_leave_reupload_file'), $data);
        return $response;
    }
    public function getEmployeeAttendanceList(Request $request)
    {
        $data = [
            'firstDay' => $request->firstDay,
            'lastDay' => $request->lastDay,
            'employee' => $request->employee,
            'session_id' => $request->session_id,
            'date' => $request->date,
        ];

        $attendance = Helper::GETMethodWithData(config('constants.api.employee_attendance_list'), $data);
        return $attendance;
    }

    // add Employee Attendance 
    public function addEmployeeAttendance(Request $request)
    {
        $data = [
            'employee' => $request->employee,
            'session_id' => $request->session_id,
            'attendance' => $request->attendance,
        ];

        $attendance = Helper::PostMethod(config('constants.api.employee_attendance_add'), $data);
        return $attendance;
    }

    public function reportEmployeeAttendance()
    {
        $employee = session()->get('ref_user_id');
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.attendance.employee_report',
            [
                'employee' => isset($employee) ? $employee : "",
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    public function staffAttendanceExcel(Request $request)
    {
        // dd($request);
        $employee_attendance_report = __('messages.employee_attendance_report');
        return Excel::download(new StaffAttendanceExport(1, $request->employee, $request->session, $request->date, $request->department), $employee_attendance_report . '.xlsx');
    }

    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        $attendance_report = __('messages.attendance_report');
        return Excel::download(new StudentAttendanceExport(1, $request->class, $request->section, $request->subject, $request->semester, $request->session, $request->date), $attendance_report . '.xlsx');
    }

    public function studentList(Request $request)
    {
        $data = [
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')

        ];
        $response = Helper::PostMethod(config('constants.api.student_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $view = route('teacher.student.details', $row['id']);
                return '<div class="button-list">
                                 <a href="' . $view . '" class="btn btn-blue waves-effect waves-light" id="viewStudentBtn"><i class="fe-eye"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // get Student  details
    public function getStudentDetails($id)
    {

        $data = [
            'id' => $id,
        ];

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettransport = Helper::GetMethod(config('constants.api.transport_route_list'));
        $gethostel = Helper::GetMethod(config('constants.api.hostel_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $student = Helper::PostMethod(config('constants.api.student_details'), $data);
        $parent = Helper::GetMethod(config('constants.api.parent_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));

        $prev = json_decode($student['data']['student']['previous_details']);
        $student['data']['student']['school_name'] = isset($prev->school_name) ? $prev->school_name : "";
        $student['data']['student']['qualification'] = isset($prev->qualification) ? $prev->qualification : "";
        $student['data']['student']['remarks'] = isset($prev->remarks) ? $prev->remarks : "";
        return view(
            'teacher.student.view',
            [
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'parent' => isset($parent['data']) ? $parent['data'] : [],
                'transport' => isset($gettransport['data']) ? $gettransport['data'] : [],
                'hostel' => isset($gethostel['data']) ? $gethostel['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'student' => isset($student['data']['student']) ? $student['data']['student'] : [],
                'section' => isset($student['data']['section']) ? $student['data']['section'] : [],
                'vehicle' => isset($student['data']['vehicle']) ? $student['data']['vehicle'] : [],
                'room' => isset($student['data']['room']) ? $student['data']['room'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],

            ]
        );
    }

    // index Timetable
    public function timetable(Request $request)
    {

        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'teacher.timetable.index',
            [
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    // get Timetable
    public function getTimetable(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        // dd($data);

        $timetable = Helper::PostMethod(config('constants.api.timetable_list'), $data);

        $days = array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        );

        if ($timetable['code'] == "200") {
            $max = $timetable['data']['max'];

            $response = "";
            $response .= '<tr><td class="center" style="color:#ed1833;">' . __('messages.day') . '/' . __('messages.period') . '</td>';
            for ($i = 1; $i <= $max; $i++) {
                $response .= '<td class="centre">' . $i . '</td>';
            }
            $response .= '</tr>';
            foreach ($days as $day) {

                if (!isset($timetable['data']['week'][$day]) && ($day == "saturday" || $day == "sunday")) {
                } else {

                    $response .= '<tr><td class="center" style="color:#ed1833;">' .  __('messages.' . $day) . '</td>';
                    $row = 0;
                    foreach ($timetable['data']['timetable'] as $table) {
                        if ($table['day'] == $day) {
                            $start_time = date('H:i', strtotime($table['time_start']));
                            $end_time = date('H:i', strtotime($table['time_end']));
                            $response .= '<td>';
                            if ($table['break'] == "1") {
                                $response .= '<b><div style="color:#2d28e9;display:inline-block;padding-right:10px;"> <i class="dripicons-bell"></i></div>' . (isset($table['break_type']) ? $table['break_type'] : "") . '</b><br>';
                                $response .= '<b><div style="color:#179614;display:inline-block;padding-right:10px;"><i class="icon-speedometer"></i></div>(' . $start_time . ' - ' . $end_time . ' )<b><br>';
                                if (isset($table['hall_no'])) {
                                    $response .= '<b><div style="color:#ff0000;display:inline-block;padding-right:10px;"> <i class="icon-location-pin"></i> </div>' . $table['hall_no'] . '</b><br>';
                                }
                            } else {
                                if ($table['subject_name']) {
                                    $subject = $table['subject_name'];
                                } else {
                                    $subject = (isset($table['break_type']) ? $table['break_type'] : "");
                                }
                                $response .= '<b><div style="color:#2d28e9;display:inline-block;padding-right:10px;"> <i class="icon-book-open"></i></div>' . $subject . '</b><br>';
                                $response .= '<b><div style="color:#179614;display:inline-block;padding-right:10px;"><i class="icon-speedometer"></i></div>(' . $start_time . ' - ' . $end_time . ' )<b><br>';
                                if ($table['teacher_name']) {
                                    $response .= '<b><div style="color:#28dfe9;display:inline-block;padding-right:10px;"> <i class=" fas fa-book-reader"></i></div>' . $table['teacher_name'] . '</b><br>';
                                }
                                if (isset($table['hall_no'])) {
                                    $response .= '<b><div style="color:#ff0000;display:inline-block;padding-right:10px;"> <i class="icon-location-pin"></i> </div>' . $table['hall_no'] . '</b><br>';
                                }
                            }
                            $response .= '</td>';
                            $row++;
                        }
                    }
                    while ($row < $max) {
                        $response .= '<td class="center">N/A</td>';
                        $row++;
                    }
                    $response .= '</tr>';
                }
            }

            $timetable['timetable'] = $response;
        }
        $timetable['class_id'] = $request->class_id;
        $timetable['section_id'] = $request->section_id;
        $timetable['semester_id'] = $request->semester_id;
        $timetable['session_id'] = $request->session_id;
        return $timetable;
    }
}
