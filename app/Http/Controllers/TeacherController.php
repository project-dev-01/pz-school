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
        $myArray = session()->get('hidden_week_ends');
        $delimiter = ','; // Delimiter you want between array items
        $hiddenWeekends = implode($delimiter, $myArray);
        $user_id = session()->get('user_id');
        $teacher_id = session()->get('ref_user_id');
        $data = [
            'user_id' => $user_id,
            'teacher_id' => $teacher_id,
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $greetings = Helper::greetingMessage();
        $teacher_count = Helper::GetMethod(config('constants.api.teacher_count'));
        $student_leave_count = Helper::GetMethod(config('constants.api.student_leave_count'));
        $count['teacher_count'] = isset($teacher_count['data']) ? $teacher_count['data'] : 0;
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $staff_id = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $bulletinBorad_data = Helper::PostMethod(config('constants.api.bulletinBoard_teacher_Dashboard'), $staff_id);
       
        $shortcut_data = Helper::PostMethod(config('constants.api.shortcutLink_list'), $staff_id);
        $get_data_hide_unhide_dashboard = Helper::PostMethod(config('constants.api.get_data_hide_unhide_dashboard'), $staff_id);
        // dd($get_data_hide_unhide_dashboard);
        return view(
            'teacher.dashboard.index',
            [
                'get_data_hide_unhide_dashboard' => isset($get_data_hide_unhide_dashboard['data']) ? $get_data_hide_unhide_dashboard['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'greetings' => isset($greetings) ? $greetings : [],
                'count' => isset($count) ? $count : [],
                'total_count' => isset($student_leave_count['data']['total']) ? $student_leave_count['data']['total'] : 0,
                'approve_count' => isset($student_leave_count['data']['approve']) ? $student_leave_count['data']['approve'] : 0,
                'pending_count' => isset($student_leave_count['data']['pending']) ? $student_leave_count['data']['pending'] : 0,
                'reject_count' => isset($student_leave_count['data']['reject']) ? $student_leave_count['data']['reject'] : 0,
                'count' => isset($count) ? $count : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
                'hiddenWeekends' => isset($hiddenWeekends) ? $hiddenWeekends : "",
                'shortcut_links' => isset($shortcut_data['data']) ? $shortcut_data['data'] : [],
                'bulletinBorad_data' => isset($bulletinBorad_data['data']) ? $bulletinBorad_data['data'] : [],
            ]
        );
    }
    public function dashboardWidget()
    {
        // $data = [
        //     'academic_session_id' => session()->get('academic_session_id')
        // ];
        // $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // $semester = Helper::GetMethod(config('constants.api.semester'));
        // $term = Helper::GETMethodWithData(config('constants.api.exam_term_list'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $userid = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.get_settings_attendance_report'), $userid);
        $get_data_hide_unhide_dashboard = Helper::PostMethod(config('constants.api.get_data_hide_unhide_dashboard'), $userid);

        return view('teacher.settings.dashboard_widget', [

            'get_data_hide_unhide_dashboard' => isset($get_data_hide_unhide_dashboard['data']) ? $get_data_hide_unhide_dashboard['data'] : [],
            'get_settings_row' => isset($response['data']) ? $response['data'] : [],
            'department' => isset($department['data']) ? $department['data'] : [],
            // 'term' => isset($term['data']) ? $term['data'] : [],
            // 'semester' => isset($semester['data']) ? $semester['data'] : [],
            // 'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
        ]);
    }
    public function widgetAddUpdate(Request $request)
    {
        // echo "<pre>";
        // print_r($request);

        $data = [
            'staff_id' => session()->get('ref_user_id'),
            "unhide_data" => $request->unhide_data,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.hide_unhide_dashboard'), $data);
        return $response;
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
        if ($request->leave_request == "Days") {
            $from_leave = $request->from_leave;
            $to_leave = $request->to_leave;
            $total_leave_days = $request->total_leave;
        } else {
            $from_leave = $request->leave_date;
            $to_leave = $request->leave_date;
            $total_leave_days = 1;
        }
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'leave_type' => $request->leave_type,
            'from_leave' => $from_leave,
            'to_leave' => $to_leave,
            'total_leave' => $total_leave_days,
            'academic_session_id' => $request->academic_session_id,
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'leave_request' => $request->leave_request,
            'leave_date' => $request->leave_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $status,
            'level_one_status' => $status,
            'level_two_status' => $status,
            'level_three_status' => $status,
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
    public function studentApplyLeavebyStaff(Request $request)
    {
        // dd($request);
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
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'frm_leavedate' => $request->frm_leavedate,
            'to_leavedate' => $request->to_leavedate,
            'total_leave' => $request->total_leave,
            'change_lev_type' => $request->change_lev_type,
            'reason_id' => $request->reason,
            'remarks' => $request->remarks,
            'status' => $request->leave_status,
            'direct_approval_status' => "1",
            'direct_approval_by' => session()->get('ref_user_id'),
            'file' => $base64,
            'file_extension' => $extension
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.call_via_leave_approve'), $data);
        return $response;
    }
    public function studentLeaveShow()
    {

        $staff_data = [
            'teacher_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($staff_data);
        $nursing_or_homeroom = Helper::PostMethod(config('constants.api.nursing_or_homeroom'), $staff_data);
        $teacher_type = isset($nursing_or_homeroom['data']['teacher_type']) ? $nursing_or_homeroom['data']['teacher_type'] : null;
        if ($teacher_type == "nursing_teacher") {
            $getclass = Helper::PostMethod(config('constants.api.classes_list_by_department'), $staff_data);
        } else {
            $getclass = Helper::PostMethod(config('constants.api.class_teacher_classes'), $staff_data);
        }
        // dd($getclass);

        // $getclass = Helper::PostMethod(config('constants.api.class_teacher_classes'), $staff_data);

        // dd($getclass);
        // nursing_teacher
        // $department = Helper::GetMethod(config('constants.api.department_list'));
        $get_student_leave_types = Helper::GetMethod(config('constants.api.get_student_leave_types'));
        return view('teacher.student_leave.index', [
            'get_student_leave_types' => isset($get_student_leave_types['data']) ? $get_student_leave_types['data'] : [],
            'teacher_type' => $teacher_type,
            // 'department' => isset($department['data']) ? $department['data'] : [],
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
            'level_one_status' => $request->level_one_status,
            'level_two_status' => $request->level_two_status,
            'level_three_status' => $request->level_three_status,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.leave_approval_history_by_staff'), $staff_data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $details_lang = __('messages.details');
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['leave_id'] . '" data-assign_leave_approval_id="' . $row['id'] . '" data-staff_id="' . $row['staff_id'] . '" id="viewDetails">' . $details_lang . '</a>
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
        // $data = [
        //     'teacher_id' => session()->get('ref_user_id')
        // ];
        // $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $data = [
            'teacher_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.class_teacher_classes'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($getclass);
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
            'branch_id'=> config('constants.branch_id'),
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
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function studDailyAttendance()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $response = Helper::PostMethod(config('constants.api.class_teacher_classes'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('teacher.classroom.daily_attendance', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function studDailyAttendanceAdd(Request $request)
    {
        $data = [
            "attendance" => $request->attendance,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
        ];
        $response = Helper::PostMethod(config('constants.api.add_student_attendance_by_day'), $data);
        return $response;
    }
    public function classroomManagementNoSub()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('teacher.classroom.attendance', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    // faq screen pages end
    public function testResult()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
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
        $teacher_list = Helper::GETMethodWithData(config('constants.api.chat_teacher_list'), $teacherData);
        $subjectAssParent = [
            'teacher_id' => session()->get('ref_user_id'),
            'role' => "Teacher"
        ];
        $parent_list = Helper::GETMethodWithData(config('constants.api.get_teacher_assign_parent_list'), $subjectAssParent);

        // dd($teacher_list);
        return view('teacher.chat.index', [
            'teacher_list' => isset($teacher_list['data']) ? $teacher_list['data'] : [],
            'parent_list' => isset($parent_list['data']) ? $parent_list['data'] : [],
            'group_list' => isset($group_list['data']) ? $group_list['data'] : [],
            'name' => session()->get('name'),
            'role' => "Teacher",
            'tid' => session()->get('ref_user_id'),
            'user_id' => session()->get('user_id')
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
                'chat_touser' => $request->chat_touser,
                'chat_user_id' => $request->chat_user_id,
                'limit' => $request->limit
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
            'teacher_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $response = Helper::PostMethod(config('constants.api.class_teacher_classes'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $getclass = Helper::PostMethod(config('constants.api.class_teacher_classes'), $data);
        
        return view('teacher.attendance.index', [
            'teacher_class' => isset($response['data']) ? $response['data'] : [],
            'department' => isset($department['data']) ? $department['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : []
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
        $created_by = session()->get('ref_user_id');

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
    // public function getHomework(Request $request)
    // {
    //     $details_lang = __('messages.details');
    //     $no_data_available_lang = __('messages.no_data_available');
    //     $data = [
    //         'class_id' => $request->class_id,
    //         'section_id' => $request->section_id,
    //         'subject_id' => $request->subject_id,
    //         'semester_id' => $request->semester_id,
    //         'session_id' => $request->session_id,
    //         'academic_session_id' => session()->get('academic_session_id')
    //     ];

    //     $homework = Helper::PostMethod(config('constants.api.homework_list'), $data);

    //     // dd($homework);
    //     if ($homework['code'] == "200") {
    //         $response = "";
    //         $row = 1;
    //         if ($homework['data']['homework']) {
    //             foreach ($homework['data']['homework'] as $work) {
    //                 $total_students = $homework['data']['total_students'];
    //                 if ($work['students_completed'] == Null) {
    //                     $completed = 0;
    //                     $incompleted = $total_students;
    //                 } else {
    //                     $completed = $work['students_completed'];
    //                     $incompleted = $total_students - $completed;
    //                 }

    //                 $response .= '<tr>
    //                                 <td>' . $row . '</td>
    //                                 <td>' . $work['title'] . '</td>
    //                                 <td>' . $work['date_of_homework'] . '</td>
    //                                 <td>' . $work['date_of_submission'] . '</td>
    //                                 <td>' . $completed . '/' . $incompleted . '</td>
    //                                 <td>' . $homework['data']['total_students'] . '</td>
    //                                 <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $work['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> <span style="color: white">' . $details_lang . '</span></a></td>
    //                             </tr>';
    //                 $row++;
    //             }
    //         } else {
    //             $response .= '<tr>
    //                                 <td colspan="7"> ' . $no_data_available_lang . '</td>
    //                             </tr>';
    //         }

    //         $homework['table'] = $response;
    //     }
    //     return $homework;
    // }
    public function getHomework(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'teacher_id' => session()->get('ref_user_id')
        ];
        // dd($data);

        $homework = Helper::PostMethod(config('constants.api.homework_list'), $data);
        $datas = isset($homework['data']) ? $homework['data'] : [];
        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $details_lang = __('messages.details');
                return '<div class="button-list">
                <a href="javascript:void(0)" style="background-color: #6FC6CC;" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $row['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> <span style="color: white">' . $details_lang . '</span></a>
                    </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get get Evaluation List
    public function getEvaluationList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id'),
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.homework_all_list'), $data);
        $datas = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $details_lang = __('messages.details');
                return '<div class="button-list">
                <a href="javascript:void(0)" style="background-color: #6FC6CC;" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $row['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> <span style="color: white">' . $details_lang . '</span></a>
                    </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
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
            // 'semester_id' => $request->semester_id,
            // 'session_id' => $request->session_id,
            // 'academic_session_id' => session()->get('academic_session_id')
        ];


        $homework = Helper::PostMethod(config('constants.api.homework_view'), $data);


        if ($homework['code'] == "200") {
            $response = "";
            $complete = 0;
            $incomplete = 0;
            $checked = 0;
            $unchecked = 0;
            $notsubchecked = 0;
            $notsubunchecked = 0;
            if ($homework['data']) {
                $row = 1;
                foreach ($homework['data'] as $work) {
                    $check = "";
                    $notsubcheck = "";
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
                    if ($work['homework_status'] == "1") {
                        $notsubcheck = "checked";
                        $notsubchecked++;
                    } else {
                        $notsubunchecked++;
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
                                        <span class="ml-2 font-weight-semibold">
                                        <a  href="' . config('constants.image_url') . '/' . config('constants.branch_id') . '/student/homework/' . '/' . $work['file'] . '" download class="text-reset">' . $work['file'] . '</a>
                                        </span>                                    
                                    </td>
                                    <td>' . $work['remarks'] . '</td>
                                    <td>
                                        <div class="checkbox checkbox-primary mb-3">
                                            <input  type="hidden" value="' . $work['homework_id'] . '" name="homework[' . $row . '][homework_id]">
                                            <input  type="hidden" value="' . $work['student_id'] . '" name="homework[' . $row . '][student_id]">
                                            <input  type="checkbox" ' . $notsubcheck . ' id="studentID' . $work['student_id'] . '" name="homework[' . $row . '][student_check]">
                                            <label for="studentID' . $work['student_id'] . '"></label>
                                        </div>
                                    </td>
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
            $homework['notsubchecked'] = $notsubchecked;
            $homework['notsubunchecked'] = $notsubunchecked;
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
    function attendancePost(Request $request)
    {
        // echo "<pre>";
        // print_r($request);

        $data = [
            "attendance" => $request->attendance,
            "date" => $request->date,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_student_attendance_no_subject'), $data);
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
            'teacher_id' => session()->get('ref_user_id'),
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $section = Helper::PostMethod(config('constants.api.class_teacher_sections'), $data);
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
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
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
        $branch_id = session()->get('branch_id');
        $employee_attendance_report = __('messages.employee_attendance_report');
        return Excel::download(new StaffAttendanceExport($branch_id, $request->employee, $request->session, $request->date, $request->department), $employee_attendance_report . '.xlsx');
    }

    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        $branch_id = session()->get('branch_id');
        $attendance_report = __('messages.attendance_report');
        return Excel::download(new StudentAttendanceExport($branch_id, $request->class, $request->section, $request->subject, $request->pattern, $request->date,$request->type), $attendance_report . '.xlsx');
    }

    public function studentList(Request $request)
    {
        $data = [
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "academic_session_id" => session()->get('academic_session_id')

        ];
        $response = Helper::PostMethod(config('constants.api.teacher_student_list'), $data);
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

        if($id!==null || $id!==0)
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
        else
        {
            return redirect()->route('teacher.student')->with('errors', "Invalid Student");
        }
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

    public function byStudentRank()
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
            'teacher.exam_results.bystudentrank',
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

    public function allStudentRankList(Request $request)
    {
        $data = [
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "subject_id" => $request->subject_id,
            "semester_id" => $request->semester_id,
            "session_id" => $request->session_id,
            "exam_id" => $request->exam_id,
            "type" => $request->type,
            "academic_session_id" => $request->academic_year
        ];
        $response = Helper::PostMethod(config('constants.api.all_student_ranking'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('pass_fail', function ($row) {
                $pass_fail = 'Pass';
                if ($row['fail'] > 0) {
                    $pass_fail = 'Fail';
                }
                return $pass_fail;
            })
            ->make(true);
    }
    public function buletin_board()
    {
        return view('teacher.bulletin_board.index');
    }
    public function getBuletinBoardTeacherList(Request $request)
    {
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'role_id' => session()->get('role_id'),
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_teacher'), $data);
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
                    'files' => explode(',', $row['file']),
                ]);
                 // Check if file exists
                    if (!empty($row['file'])) {
                       
                        $downloadButton = ' <button class="btn btn-danger waves-effect waves-light download-all" data-files="' . htmlspecialchars($row['file'], ENT_QUOTES, 'UTF-8') . '">
                        <i class="fe-download" data-toggle="tooltip" title="Click to download all files..!"></i>
                    </button>';
                    } else {
                        $downloadButton = ''; // If file doesn't exist, set empty string
                    }
                return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="openFilePopup(' . htmlspecialchars($encoded_data, ENT_QUOTES, 'UTF-8') . ')"><i class="fe-eye"></i></a>'
                    . $downloadButton . 
               
                '</div>';
            })
            ->rawColumns(['publish', 'actions'])
            ->make(true);
    }
    public function bulletinStarTeacher(Request $request)
    {
        $data = [
            'id' => $request->id,
            'parentImp' => $request->parentImp,
            'role_id' => session()->get('role_id'),
            'user_id' => session()->get('ref_user_id'),
            'updated_by' => session()->get('ref_user_id'),
            'created_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bulletin_star_teacher'), $data);
        return $response;
    }
    public function getBuletinBoardImpTeacherList(Request $request)
    {
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'role_id' => session()->get('role_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_imp_teacher'), $data);
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
                    'files' => explode(',', $row['file']),
                ]);
                if (!empty($row['file'])) {
                    $downloadButton = ' <button class="btn btn-danger waves-effect waves-light download-all" data-files="' . htmlspecialchars($row['file'], ENT_QUOTES, 'UTF-8') . '">
                        <i class="fe-download" data-toggle="tooltip" title="Click to download all files..!"></i>
                    </button>';
                } else {
                    $downloadButton = ''; // If file doesn't exist, set empty string
                }
                return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="openFilePopup(' . htmlspecialchars($encoded_data, ENT_QUOTES, 'UTF-8') . ')"><i class="fe-eye"></i></a>'
                    .$downloadButton.
                '</div>';
            })
            ->rawColumns(['publish', 'actions'])
            ->make(true);
    }
    public function getBuletinBoardDashBoard(Request $request)
    {
        $staff_id = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bulletinBoard_teacher_Dashboard'), $staff_id);
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
                'files' => explode(',', $row['file']),
            ]);
            if (!empty($row['file'])) {
                $downloadButton = ' <button class="btn btn-danger waves-effect waves-light download-all" data-files="' . htmlspecialchars($row['file'], ENT_QUOTES, 'UTF-8') . '">
                    <i class="fe-download" data-toggle="tooltip" title="Click to download all files..!"></i>
                </button>';
            } else {
                $downloadButton = ''; // If file doesn't exist, set empty string
            }
            return '<div class="button-list">
                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="openFilePopup(' . htmlspecialchars($encoded_data, ENT_QUOTES, 'UTF-8') . ')"><i class="fe-eye"></i></a>'
                .$downloadButton.
            '</div>';
        })
        ->rawColumns(['publish', 'actions'])
        ->make(true);
    }
    //promotion
    public function PromotionBulkImport(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if (!$validator->passes()) {
            return back()->with(['errors' => $validator->errors()->toArray()['file']]);
        } else {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($request->file('file')));

            $data = [
                'file' => $base64,
                'fileName' => $filename,
                'extension' => $extension,
                'tempPath' => $tempPath,
                'fileSize' => $fileSize,
                'mimeType' => $mimeType,
            ];
            $response = Helper::PostMethod(config('constants.api.promotion_data_bulk'), $data);
            if ($response['code'] == 200) {

                return redirect()->route('teacher.promotion.studentlist')->with('success', ' Student Imported Successfully');
            } else {
                return redirect()->route('teacher.promotion.studentlist')->with('errors', $response['data']);
            }
        }
    }
    public function downloadPromotionCsv(Request $request)
    {
        // Fetch data based on the selected department, class, and section
        $data = [
            
            'class_id' => $request->input('download_class_id'),
            'section_id' => $request->input('download_section_id')
        ];

        $response = Helper::PostMethod(config('constants.api.promotion_download_csv'), $data);
        if (!$response || isset($response['error'])) {
            return response()->json(['error' => 'Error fetching data from the API. Please try again.'], 500);
        }
        $csvFileName = 'promotion_data.csv';
        // Check if it's an Ajax request
        if ($request->ajax()) {
            return response($response, 200)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename=' . $csvFileName);
        }
    }
    public function promotionBulkImportSave(Request $request)
    {
        $data = [
            'updatedData' => $request->input('updatedData')
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_bulk_import_save'), $data);
        // dd($response);
        return $response;
    }
    public function promotionBulkStudentList(Request $request)
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'teacher.promotion.studentList',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'teacher_class' => isset($response['data']) ? $response['data'] : [],
            ]
        );
    }
    public function promotionBulkDataStudentList(Request $request)
    {
        $data = [
            'grade_id' => $request->grade,
            'section_id' => $request->section,
            'sort_id' => $request->sort,
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_bulk_student_list'), $data);
        return $response;
    }
    public function promotionUnassignedStudentList(Request $request)
    {
        $data = [
            'grade_id' => $request->grade,
            'section_id' => $request->section
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_unassigned_student_list'), $data);
        return $response;
    }
    public function promotionTerminationStudentList(Request $request)
    {
        $data = [
            'grade_id' => $request->grade,
            'section_id' => $request->section
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_termination_student_list'), $data);
        return $response;
    }
    public function promotionPreparedDataAdd(Request $request)
    {

        $data = [
            'updatedData' => $request->input('updatedData')
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_prepared_Data_add'), $data);
        // dd($response);
        return $response;
    }
    public function promotionDataFreezed(Request $request)
    {
        return view('teacher.promotion.freezedStudentList');
    }
    public function promotionGetDataFreezed(Request $request)
    {
        $data = [
            'status' => $request->status
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_get_data_freezed'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {  
                 $status = $row['status'];  // Replace 'status' with the actual column name

                $disabledAttribute = $status != 2 ? 'disabled' : '';
                $selectedOption = $status == 2 ? 'selected' : '';
                $data_freezed = __('messages.data_freezed');
                $temporary_unlock =  __('messages.temporary_unlock');
                $none =  __('messages.none');

                return '<div class="form-group">
             <select class="form-control"><option value="">' . addslashes($none) . '</option>
             <option value="3" ' . $selectedOption . ' ' . $disabledAttribute . '>' . addslashes($data_freezed) . '</option>
             <option value="4">' . addslashes($temporary_unlock) . '</option></select>
           </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function promotionSaveStatusFreezed(Request $request)
    {

        $data = [
            'statusData' => $request->input('statusData')
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_Status_Data_add'), $data);
        // dd($response);
        return  $response;
    }
    public function promotionFinalData(Request $request)
    {
        $data = [
            'promotionFinalData' => $request->input('promotionData')
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_Final_Data_add'), $data);
        // dd($response);
        return  $response;
    }
    // index shortcutLinks 
    public function shortcutLinks()
    {
        return view('teacher.shortcut_links.index');
    }
    public function addShortcutLinks(Request $request)
    {
        $data = [
            'name' => $request->name,
            'link' => $request->link,
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.shortcutLink_add'), $data);
        return $response;
    }
    public function getShortcutLinksList(Request $request)
    {
        $staff_id = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.shortcutLink_list'), $staff_id);
        $data = isset($response['data']) ? $response['data'] : [];

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editShortCutBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteShortCutBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getShortcutLinksDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.shortcutLink_details'), $data);
        return $response;
    }
    public function updateShortcutLinks(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'link' => $request->link
        ];
        $response = Helper::PostMethod(config('constants.api.shortcutLink_update'), $data);
        return $response;
    }
    // DELETE shortcutLink Details
    public function deleteShortcutLinks(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.shortcutLink_delete'), $data);
        return $response;
    }
    public function studentInterviewNotesIndex()
    {

        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view(
            'teacher.student_interview_notes.index',
            [
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            ]
        );
    }
    public function createStudentInterviewNotes()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view(
            'teacher.student_interview_notes.add',
            [
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            ]
        );
    }
    public function addStudentInterviewNotes(Request $request)
    {

        $file = $request->file('interview_file');
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
            'title' => $request->title,
            'type' => $request->interview_type,
            'comment' => $request->description,
            'file' => $base64,
            'file_extension' => $extension,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' =>  $request->student_id,
            'created_by' => session()->get('ref_user_id'),
            'updated_by' => session()->get('ref_user_id'),

        ];
        $response = Helper::PostMethod(config('constants.api.student_interview_add'), $data);
        return $response;
    }
    public function getStudentInterviewData(Request $request)
    {
        $data = [
            'grade_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
        ];
        $response = Helper::PostMethod(config('constants.api.student_interview_list'), $data);
        return $response;
    }
    public function editStudentInterviewData(Request $request)
    {
        $data = [
            'id' => $request->id
        ];
        $response = Helper::PostMethod(config('constants.api.student_interview_edit'), $data);
        return $response;
    }
    public function updateStudentInterviewData(Request $request)
    {
        $data = [
            'id' => $request->id,
            'comment' => $request->comment,
            'type' => $request->type,
            'created_by' => session()->get('ref_user_id'),
            'updated_by' => session()->get('ref_user_id'),
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
        ];
        $response = Helper::PostMethod(config('constants.api.student_interview_update'), $data);
        return $response;
    }
    public function page403(Request $request)
    {
        return view('teacher.dashboard.403');
    }
}
