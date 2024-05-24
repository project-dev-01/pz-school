<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Task;
use DataTables;
use Excel;
use PDF;
use App\Exports\ParentAttendanceExport;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Route;

class ParentController extends Controller
{
    //
    public function index(Request $request)
    {
        // $currentRouteName = Route::currentRouteName();
        // $pagedata = [
        //     'currentRouteName' => $currentRouteName,
        //     'role_id' => session()->get('role_id'),
        //     'school_roleid' => session()->get('school_roleid'),
        //     'branch_id' => config('constants.branch_id')
        // ];

        // $accessRoutes = Helper::PostMethod(config('constants.api.getschoolroleaccessroute'), $pagedata);
        // $accessPermission = isset($accessRoutes['data']['read']) ? $accessRoutes['data']['read'] : null;

        // // Check if accessPermission is null
        // if ($accessPermission === null) {
        //     // Return an empty response or render an empty view
        //     return view('empty_page'); // Replace 'empty_page' with the name of your empty view
        // }
        $myArray = session()->get('hidden_week_ends');
        $delimiter = ','; // Delimiter you want between array items
        $hiddenWeekends = implode($delimiter, $myArray);
        $user_id = session()->get('user_id');
        $student_id = session()->get('student_id');
        $parent_id = session()->get('ref_user_id');
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
        $greetings = Helper::greetingMessage();
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $exam_by_student = Helper::GETMethodWithData(config('constants.api.exam_by_student'), $data);
        $all_exam_subject_scores = Helper::PostMethod(config('constants.api.all_exam_subject_scores'), $data);
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'parent.dashboard.index',
            [
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'get_homework_list_dashboard' => isset($get_homework_list_dashboard['data']) ? $get_homework_list_dashboard['data'] : [],
                'get_std_names_dashboard' => isset($get_std_names_dashboard['data']) ? $get_std_names_dashboard['data'] : [],
                'all_exam_subject_scores' => isset($all_exam_subject_scores['data']) ? $all_exam_subject_scores['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'greetings' => isset($greetings) ? $greetings : "",
                'exams' => isset($exam_by_student['data']) ? $exam_by_student['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
                'hiddenWeekends' => isset($hiddenWeekends) ? $hiddenWeekends : "",
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
            'total_leave' => $request->total_leave,
            'change_lev_type' => $request->change_lev_type,
            'reason_id' => $request->reason,
            'reason_text' => $request->reason_text,
            'remarks' => $request->remarks,
            'status' => $status,
            'file' => $base64,
            'file_extension' => $extension
        ];
        $response = Helper::PostMethod(config('constants.api.std_leave_apply'), $data);        
        return $response;
    }

    

    // student leave update
    public function student_updateleave(Request $request)
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
            'id' => $request->id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'parent_id' => $parent_id,
            'frm_leavedate' => $request->frm_leavedate,
            'to_leavedate' => $request->to_leavedate,
            'total_leave' => $request->total_leave,
            'change_lev_type' => $request->change_lev_type,
            'reason_id' => $request->reason,
            'reason_text' => $request->reason_text,
            'remarks' => $request->remarks,
            'status' => $status,
            'file' => $base64,
            'file_extension' => $extension
        ];

        $response = Helper::PostMethod(config('constants.api.std_leave_update'), $data);
               
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
        $parent_id = [
            'parent_id' => session()->get('ref_user_id'),
            'student_id' => session()->get('student_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.studentleave_list'), $parent_id);
        // $response = Helper::GETMethodWithData(config('constants.api.studentleave_list'),$parent_id);
        // return $response;
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $upload_lang = __('messages.upload');
                if ($row['status'] == "Approve") {
                    return 'N/A';
                } else {
                    $edit = route('admin.application.edit', $row['id']);
                    return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-warning waves-effect waves-light" data-id="' . $row['id'] . '" id="editLeaveBtn" ><i class="fe-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteLeaveBtn"><i class="fe-trash-2"></i></a>
                             </div>';
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    //Delete Student Leave
    public function student_deleteleave(Request $request)
    {
        $data = [
            'id' => $request->id
        ];
        $response = Helper::PostMethod(config('constants.api.studentleave_delete'), $data);
        // $response = Helper::PostMethod(config('constants.api.application_delete'), $data);
        return $response;
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
                'user_details' => isset($staff_profile_info['data']) ? $staff_profile_info['data'] : []
            ]
        );
    }

    public function studentProfile()
    {

        $student_id = session()->get('student_id');
        $data = [
            'id' => isset($student_id) ? $student_id : '',
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
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        
        $data = [
            'department_id' => isset($student['data']['student']['department_id']) ? $student['data']['student']['department_id'] : 0,
        ];
        $grade_list_by_department = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
        
        $prev = isset($student['data']['student']['previous_details']) ? json_decode($student['data']['student']['previous_details']) : "";
        // $student['data']['student']['school_name'] = isset($prev->school_name) ? $prev->school_name : "";
        $student['data']['student']['qualification'] = isset($prev->qualification) ? $prev->qualification : "";
        $student['data']['student']['remarks'] = isset($prev->remarks) ? $prev->remarks : "";
        $department = Helper::GetMethod(config('constants.api.department_list'));

        // dd($student);
        return view(
            'parent.student.profile',
            [
                'id' => isset($student_id) ? $student_id : 0,
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
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'role' => isset($student['data']['user']) ? $student['data']['user'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'grade_list_by_department' => isset($grade_list_by_department['data']) ? $grade_list_by_department['data'] : [],
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
                'regex:/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/'
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
        $en = config('constants.image_url') . '/common-asset/parentfaq/Suzen User Manual (Parent Portal)_v1.0.0_EN.pdf';
        $jap = config('constants.image_url') . '/common-asset/parentfaq/Suzen User Manual (Parent Portal)_v1.0.0_JP.pdf';
        return view(
            'parent.faq.index',
            [
                'data' => isset($data) ? $data : [],
                'en' => $en,
                'jap' => $jap
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
                'schedule_exam_list' => isset($response['data']) ? $response['data'] : []
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
                'allexams' => isset($allexams['data']) ? $allexams['data'] : []
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
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        );

        $timetable = Helper::PostMethod(config('constants.api.timetable_parent'), $data);
        return view(
            'parent.time_table.index',
            [
                'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : 0,
                'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : 0,
                'days' => isset($days) ? $days : [],
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
                'subjects' => isset($subjects['data']) ? $subjects['data'] : [],
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
                'subject' => isset($get_student_by_all_subjects['data']) ? $get_student_by_all_subjects['data'] : [],
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
                    $evaluation_date = (isset($work['evaluation_date'])) ? date('F j , Y', strtotime($work['evaluation_date'])) : "-";
                    if ($work['status'] == 1) {
                        $status = "Completed";
                        $top = "( Completed )";
                    } else {
                        $status = "InCompleted";
                        $top = "";
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
                    $homework_status = "";
                    if ($work['homework_status'] == 1) {
                        $homework_status = "( Not Submitted )";
                    } else if ($work['homework_status'] == 0) {
                        $homework_status = "( Submitted )";
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
        $data = [
            'parent_id' => session()->get('ref_user_id'),
            'to_id' => session()->get('ref_user_id'),
            'role' => "Parent"
        ];

        $parentData = [
            'id' => session()->get('ref_user_id'),
            'student_id' => session()->get('student_id'),
            'academic_session_id' => session()->get('academic_session_id'),
            'role' => "Parent"
        ];
        // dd($parentData);
        $group_list = Helper::GETMethodWithData(config('constants.api.chat_parentgroup_list'), $data);
        $parent_list = Helper::GETMethodWithData(config('constants.api.chat_parent_list'), $parentData);
        $teacher_list = Helper::GETMethodWithData(config('constants.api.parent_chat_teacher_list'), $parentData);
        // dd($teacher_list);
        return view('parent.chat.index', [
            'teacher_list' => isset($teacher_list['data']) ? $teacher_list['data'] : [],
            'parent_list' => isset($parent_list['data']) ? $parent_list['data'] : [],
            'group_list' => isset($group_list['data']) ? $group_list['data'] : [],
            'name' => session()->get('name'),
            'role' => "Parent",
            'tid' => session()->get('ref_user_id'),
            'user_id' => session()->get('user_id')
        ]);
        return view('parent.chat.index');
    }
    //Get Teacher List
    public function teacherlist()
    {
        $data = [
            'parent_id' => session()->get('ref_user_id'),
            'to_id' => session()->get('ref_user_id'),
            'role' => "Parent"
        ];
        $response = Helper::GETMethodWithData(config('constants.api.chat_teacher_list'), $data);

        return $response;
    }
    public function savechat(Request $request)
    {
        //dd ($request->all());
        try {
            // Your code here
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
            $response = Helper::PostMethod(config('constants.api.pchat'), $data);
            // $response = Helper::GetMethod(config('constants.api.chat_teacher_list'));
            //dd($response);
            return $response;
        } catch (TokenMismatchException $e) {
            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }
    }
    public function deletechat(Request $request)
    {
        $data = [
            'chat_id' => $request->chat_id
        ];
        // dd($data);       
        $response = Helper::PostMethod(config('constants.api.pdelchat'), $data);
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


            $response = Helper::PostMethod(config('constants.api.pchatlists'), $data);
            //dd($response);
            return $response;
        } catch (TokenMismatchException $e) {
            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => 'CSRF token mismatch'], 419);
        }
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
                'get_student_by_all_subjects' => isset($get_student_by_all_subjects['data']) ? $get_student_by_all_subjects['data'] : [],
                'get_class_section_by_student' => isset($get_class_section_by_student['data']) ? $get_class_section_by_student['data'] : []
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
    //
    public function studentLeaves(Request $request)
    {
        $parent_ids = [
            'parent_id' => session()->get('ref_user_id'),
        ];
        $get_std_names_dashboard = Helper::GETMethodWithData(config('constants.api.get_students_parentdashboard'), $parent_ids);
        $get_student_leave_types = Helper::GetMethod(config('constants.api.get_student_leave_types'));
       
        return view(
            'parent.leave_application.index',
            [
                'get_student_leave_types' => isset($get_student_leave_types['data']) ? $get_student_leave_types['data'] : [],
                'get_std_names_dashboard' => isset($get_std_names_dashboard['data']) ? $get_std_names_dashboard['data'] : [],
            ]
        );
    }

    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        return Excel::download(new ParentAttendanceExport(1, $request->student, $request->subject, $request->date), 'Student_Attendance.xlsx');
    }

    public function getProfileDetails(Request $request)
    {
        $student_data = [
            'id' => session()->get('student_id')
        ];
        $student = Helper::PostMethod(config('constants.api.student_details'), $student_data);
        $mother_id = isset($student['data']['student']['mother_id']) ? $student['data']['student']['mother_id'] : "";
        $father_id = isset($student['data']['student']['father_id']) ? $student['data']['student']['father_id'] : "";
        $guardian_relation = isset($student['data']['student']['relation']) ? $student['data']['student']['relation'] : "";
        $sibling = isset($student['data']['student']) ? $student['data']['student'] : "";

        $guardian_data = [
            'id' => session()->get('ref_user_id')
        ];
        $mother = [];
        if ($mother_id) {
            $mother_data = [
                'id' => $mother_id
            ];
            $mother = Helper::PostMethod(config('constants.api.parent_details'), $mother_data);
        }
        $father = [];
        if ($father_id) {
            $father_data = [
                'id' => $father_id
            ];
            $father = Helper::PostMethod(config('constants.api.parent_details'), $father_data);
        }
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $response = Helper::PostMethod(config('constants.api.parent_details'), $guardian_data);
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // dd($mother);
        return view(
            'parent.settings.profile-edit',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'education' => isset($education['data']) ? $education['data'] : [],
                'mother' => isset($mother['data']['parent']) ? $mother['data']['parent'] : [],
                'father' => isset($father['data']['parent']) ? $father['data']['parent'] : [],
                'guardian' => isset($response['data']['parent']) ? $response['data']['parent'] : [],
                'childs' => isset($response['data']['childs']) ? $response['data']['childs'] : [],
                'user' => isset($response['data']['user']) ? $response['data']['user'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'guardian_relation' => isset($guardian_relation) ? $guardian_relation : "",
                'sibling' => isset($sibling) ? $sibling : "",
            ]
        );
    }
    public function updateProfile(Request $request)
    {
        $mother_visa_base64 = "";
        $mother_visa_extension = "";
        $mother_visa_file = $request->file('visa_mother_photo');
        if ($mother_visa_file) {
            $mother_visa_path = $mother_visa_file->path();
            $mother_visa_data = file_get_contents($mother_visa_path);
            $mother_visa_base64 = base64_encode($mother_visa_data);
            $mother_visa_extension = $mother_visa_file->getClientOriginalExtension();
        }

        $mother_passport_base64 = "";
        $mother_passport_extension = "";
        $mother_passport_file = $request->file('passport_mother_photo');
        if ($mother_passport_file) {
            $mother_passport_path = $mother_passport_file->path();
            $mother_passport_data = file_get_contents($mother_passport_path);
            $mother_passport_base64 = base64_encode($mother_passport_data);
            $mother_passport_extension = $mother_passport_file->getClientOriginalExtension();
        }

        $father_visa_base64 = "";
        $father_visa_extension = "";
        $father_visa_file = $request->file('visa_father_photo');
        if ($father_visa_file) {
            $father_visa_path = $father_visa_file->path();
            $father_visa_data = file_get_contents($father_visa_path);
            $father_visa_base64 = base64_encode($father_visa_data);
            $father_visa_extension = $father_visa_file->getClientOriginalExtension();
        }

        $father_passport_base64 = "";
        $father_passport_extension = "";
        $father_passport_file = $request->file('passport_father_photo');
        if ($father_passport_file) {
            $father_passport_path = $father_passport_file->path();
            $father_passport_data = file_get_contents($father_passport_path);
            $father_passport_base64 = base64_encode($father_passport_data);
            $father_passport_extension = $father_passport_file->getClientOriginalExtension();
        }

        $image_principal_base64 = "";
        $image_principal_extension = "";
        $image_principal_file = $request->file('japanese_association_membership_image_principal');
        if ($image_principal_file) {
            $image_principal_path = $image_principal_file->path();
            $image_principal_data = file_get_contents($image_principal_path);
            $image_principal_base64 = base64_encode($image_principal_data);
            $image_principal_extension = $image_principal_file->getClientOriginalExtension();
        }
        $japanese_association_membership_image_supplimental_base64 = "";
        $japanese_association_membership_image_supplimental_extension = "";
        $file = $request->file('japanese_association_membership_image_supplimental');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $japanese_association_membership_image_supplimental_base64 = base64_encode($data);
            $japanese_association_membership_image_supplimental_extension = $file->getClientOriginalExtension();
        }
        $fullNames = $request->input('full_name', []);
        $siblingdob = $request->input('siblingdob', []);
        $relationship = $request->input('relationship', []);
        $data = [

            'mother_id' => $request->mother_id,
            "mother_last_name_furigana" => $request->mother_last_name_furigana,
            "mother_middle_name_furigana" => $request->mother_middle_name_furigana,
            "mother_first_name_furigana" => $request->mother_first_name_furigana,
            "mother_last_name_english" => $request->mother_last_name_english,
            "mother_middle_name_english" => $request->mother_middle_name_english,
            "mother_first_name_english" => $request->mother_first_name_english,
            "mother_nationality" => $request->mother_nationality,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            "mother_middle_name" => $request->mother_middle_name,
            'mother_phone_number' => $request->mother_phone_number,
            'mother_occupation' => $request->mother_occupation,
            'mother_email' => $request->mother_email,
            'visa_mother_photo' => $mother_visa_base64,
            'mother_visa_file_extension' => $mother_visa_extension,
            'passport_mother_photo' => $mother_passport_base64,
            'mother_passport_file_extension' => $mother_passport_extension,

            'father_id' => $request->father_id,
            "father_last_name_furigana" => $request->father_last_name_furigana,
            "father_middle_name_furigana" => $request->father_middle_name_furigana,
            "father_first_name_furigana" => $request->father_first_name_furigana,
            "father_last_name_english" => $request->father_last_name_english,
            "father_middle_name_english" => $request->father_middle_name_english,
            "father_first_name_english" => $request->father_first_name_english,
            "father_nationality" => $request->father_nationality,
            'father_first_name' => $request->father_first_name,
            'father_last_name' => $request->father_last_name,
            "father_middle_name" => $request->father_middle_name,
            'father_phone_number' => $request->father_phone_number,
            'father_occupation' => $request->father_occupation,
            'father_email' => $request->father_email,
            'passport_father_photo' => $father_passport_base64,
            'father_passport_file_extension' => $father_passport_extension,
            'visa_father_photo' => $father_visa_base64,
            'father_visa_file_extension' => $father_visa_extension,

            'guardian_id' => $request->guardian_id,
            "guardian_last_name_furigana" => $request->guardian_last_name_furigana,
            "guardian_middle_name_furigana" => $request->guardian_middle_name_furigana,
            "guardian_first_name_furigana" => $request->guardian_first_name_furigana,
            "guardian_last_name_english" => $request->guardian_last_name_english,
            "guardian_middle_name_english" => $request->guardian_middle_name_english,
            "guardian_first_name_english" => $request->guardian_first_name_english,
            "guardian_nationality" => $request->guardian_nationality,
            'guardian_first_name' => $request->guardian_first_name,
            'guardian_last_name' => $request->guardian_last_name,
            "guardian_middle_name" => $request->guardian_middle_name,
            'guardian_phone_number' => $request->guardian_phone_number,
            'guardian_occupation' => $request->guardian_occupation,
            'guardian_email' => $request->guardian_email,

            'guardian_relation' => $request->guardian_relation,
            'guardian_company_name_japan' => $request->guardian_company_name_japan,
            'guardian_company_name_local' => $request->guardian_company_name_local,
            'guardian_company_phone_number' => $request->guardian_company_phone_number,
            'guardian_employment_status' => $request->guardian_employment_status,
            'image_principal_photo' => $image_principal_base64,
            'image_principal_file_extension' => $image_principal_extension,
            'image_principal_old_photo' => $request->japanese_association_membership_image_principal_old,
            'japanese_association_membership_image_supplimental' => $japanese_association_membership_image_supplimental_base64,
            'japanese_association_membership_image_supplimental_file_extension' => $japanese_association_membership_image_supplimental_extension,
            "japanese_association_membership_image_supplimental_old" => $request->japanese_association_membership_image_supplimental_old,
            'school_roleid' => isset($request->school_roleid) ? $request->school_roleid : '',
            'japan_postalcode' => $request->japan_postalcode,
            'japan_contact_no' => $request->japan_contact_no,
            'japan_emergency_sms' => $request->japan_emergency_sms,
            'japan_address' => $request->japan_address,
            'stay_category' => $request->stay_category,
            'student_id' => $request->student_id,
            'full_name' => $fullNames,
            'sblingdob' => $siblingdob,
            'relationship' => $relationship,
            'role_id' => session()->get('role_id')
        ];
        // dd($data);
        // return $data;
        $response = Helper::PostMethod(config('constants.api.parent_update'), $data);
        return $response;
    }

    public function feesIndex()
    {

        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $payment_status = Helper::GetMethod(config('constants.api.payment_status_list'));
        $fees_group_list = Helper::GETMethodWithData(config('constants.api.fees_group_list'), $data);

        return view(
            'parent.fees.index',
            [
                'payment_status' => isset($payment_status['data']) ? $payment_status['data'] : [],
                'fees_group_list' => isset($fees_group_list['data']) ? $fees_group_list['data'] : []
            ]
        );
    }
    public function feesView($id, $group_id)
    {
        $data = [
            'student_id' => $id,
            'group_id' => $group_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        $student_fees_history = Helper::PostMethod(config('constants.api.parent_fees_history'), $data);
        $banks = Helper::GetMethod(config('constants.api.bank_account_list'));
        return view(
            'parent.fees.view',
            [
                'student_fees_history' => isset($student_fees_history['data']) ? $student_fees_history['data'] : [],
                'banks' => isset($banks['data']) ? $banks['data'] : [],
            ]
        );
    }

    public function feesInvoice($id, $group_id)
    {
        $data = [
            'student_id' => $id,
            'group_id' => $group_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $parentData = [
            'parent_id' => session()->get('ref_user_id')
        ];
        // dd($data);
        $parent = Helper::PostMethod(config('constants.api.parent_profile_info'), $parentData);
        $student_fees_history = Helper::PostMethod(config('constants.api.parent_fees_history'), $data);

        $date = date('Y-m-d');
        return view(
            'parent.fees.invoice',
            [
                'student_fees_history' => isset($student_fees_history['data']) ? $student_fees_history['data'] : [],
                'parent' => isset($parent['data']) ? $parent['data'] : [],
                'date' => isset($date) ? $date : "",
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'student_id' => isset($id) ? $id : "",
                'group_id' => isset($group_id) ? $group_id : "",
            ]
        );
    }

    public static function paidStatusDetails($args)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id'),
        ];
        $response = Helper::PostMethod(config('constants.api.fees_status_check'), $data);
        // current date
        $now = date('Y-m-d');
        $paid_date = isset($args['paid_date']) ? $args['paid_date'] : null;
        $current_semester = isset($response['data']['current_semester']) ? $response['data']['current_semester'] : [];
        $all_semester = isset($response['data']['all_semester']) ? $response['data']['all_semester'] : [];
        $year_details = isset($response['data']['year_details']) ? $response['data']['year_details'] : [];
        $paidSts = "";
        $labelmode = "";
        // amount paid
        if ((isset($args['due_date'])) && (isset($paid_date))) {
            // paid status id 1 mean paid
            if ($args['payment_status_id'] == 1 && isset($args['paid_date'])) {
                $type_amount = round($args['paid_amount']);
            } else {
                $type_amount = round(0);
            }
            $balance = ($args['amount'] - $type_amount);
            $balance = number_format($balance, 2, '.', '');
            if ($balance == 0) {
                $paidSts = 'paid';
                $labelmode = 'badge-success';
            } else {
                $paidSts = 'unpaid';
                $labelmode = 'badge-danger';
            }
        }
        // amount unpaid or delay
        if ((isset($args['due_date'])) && ($paid_date === null || trim($paid_date) === '')) {
            // yearly payment
            if ($args['payment_mode_id'] == 1) {
                $year_start_date = isset($year_details['0']['year_start_date']) ? $year_details['0']['year_start_date'] : null;
                $start_date = date('Y-m-d', strtotime($year_start_date));
                $year_end_date = isset($year_details['0']['year_end_date']) ? $year_details['0']['year_end_date'] : null;
                $end_date = date('Y-m-d', strtotime($year_end_date));
                if ($start_date <= $now && $now <= $end_date) {
                    // match between semester date
                    if ($args['due_date'] <= $now) {
                        $paidSts = 'delay';
                        $labelmode = 'badge-secondary';
                    } else {
                        $paidSts = 'unpaid';
                        $labelmode = 'badge-danger';
                    }
                } else {
                    // not match between semester date
                    $paidSts = 'unpaid';
                    $labelmode = 'badge-danger';
                }
            }
            // semester payment
            if ($args['payment_mode_id'] == 2) {

                $id = isset($current_semester['id']) ? $current_semester['id'] : 0;
                $key = array_search($id, array_column($all_semester, 'id'));
                if ((!empty($key)) || ($key === 0)) {
                    // get which semester running now
                    $get_semester = $all_semester[$key];
                    $sem_start_date = isset($get_semester['start_date']) ? $get_semester['start_date'] : null;
                    $start_date = date('Y-m-d', strtotime($sem_start_date));
                    $sem_end_date = isset($get_semester['end_date']) ? $get_semester['end_date'] : null;
                    $end_date = date('Y-m-d', strtotime($sem_end_date));
                    if ($start_date <= $now && $now <= $end_date) {
                        // match between semester date
                        if ($args['due_date'] <= $now) {
                            $paidSts = 'delay';
                            $labelmode = 'badge-secondary';
                        } else {
                            $paidSts = 'unpaid';
                            $labelmode = 'badge-danger';
                        }
                    } else {
                        // not match between semester date
                        $paidSts = 'unpaid';
                        $labelmode = 'badge-danger';
                    }
                } else {
                    // if semester finish
                    $paidSts = 'unpaid';
                    $labelmode = 'badge-danger';
                }
            }
            // monthly payment
            if ($args['payment_mode_id'] == 3) {
                $query_date = date('Y-m-d', strtotime($args['due_date']));
                // First day of the month.
                $start_date = date('Y-m-01', strtotime($query_date));
                // Last day of the month.
                $end_date = date('Y-m-t', strtotime($query_date));
                if ($start_date <= $now && $now <= $end_date) {
                    // match between semester date
                    if ($args['due_date'] <= $now) {
                        $paidSts = 'delay';
                        $labelmode = 'badge-secondary';
                    } else {
                        $paidSts = 'unpaid';
                        $labelmode = 'badge-danger';
                    }
                } else {
                    // not match between semester date
                    $paidSts = 'unpaid';
                    $labelmode = 'badge-danger';
                }
            }
        }
        $ret_res = [
            'paidSts' => $paidSts,
            'labelmode' => $labelmode
        ];
        return $ret_res;
    }

    public function feesDownload($id, $group_id, Request $request)
    {


        $data = [
            'student_id' => $id,
            'group_id' => $group_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $parentData = [
            'parent_id' => session()->get('ref_user_id')
        ];
        $tudentData  = [
            'id' => $id
        ];
        $date = date('Y-m-d');
        // dd($data);

        $student = Helper::PostMethod(config('constants.api.student_details'), $tudentData);
        $parent = Helper::PostMethod(config('constants.api.parent_profile_info'), $parentData);
        $student_fees_history = Helper::PostMethod(config('constants.api.parent_fees_history'), $data);
        $customPaper = array(0, 0, 800.00, 1200.00);
        // return view('parent.fees.download',
        //     [
        //         'student_fees_history' => isset($student_fees_history['data']) ? $student_fees_history['data'] : [],
        //         'parent' => isset($parent['data']) ? $parent['data'] : [],
        //         'date' => isset($date) ? $date : "",
        //         'school_name' => config('constants.school_name'),
        //         'school_image' => config('constants.school_image'),
        //         'parent_name' => session()->get('name'),
        //         'student_name' =>  isset($student['data']) ? $student['data']['student']['name'] : "",
        //     ]);
        $pdf = PDF::loadView(
            'parent.fees.download',
            [
                'student_fees_history' => isset($student_fees_history['data']) ? $student_fees_history['data'] : [],
                'parent' => isset($parent['data']) ? $parent['data'] : [],
                'date' => isset($date) ? $date : "",
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'parent_name' => session()->get('name'),
                'student_name' =>  isset($student['data']) ? $student['data']['student']['name'] : "",
            ]
        )->setPaper($customPaper);

        // filename
        $now = now();
        $name = strtotime($now);
        $fileName = __('messages.invoice') . $name . ".pdf";
        return $pdf->download($fileName);


        // $customPaper = array(0, 0, 1000.00, 567.00);
        // $pdf->set_paper($customPaper);
        // $pdf->loadHTML($output);
        // return view('parent.fees.download');
    }
    public function buletin_board()
    {
        return view('parent.bulletin_board.index');
    }
    public function getBuletinBoardParentList(Request $request)
    {
        $data = [
            'parent_id' => session()->get('ref_user_id'),
            'role_id' => session()->get('role_id'),
            'student_id' => session()->get('student_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_parent'), $data);
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
    public function bulletinStar(Request $request)
    {
        $data = [
            'id' => $request->id,
            'parentImp' => $request->parentImp,
            'role_id' => session()->get('role_id'),
            'user_id' => session()->get('ref_user_id'),
            'updated_by' => session()->get('ref_user_id'),
            'created_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bulletin_star'), $data);
        return $response;
    }
    public function getBuletinBoardImpParentList(Request $request)
    {
        $data = [
            'parent_id' => session()->get('ref_user_id'),
            'role_id' => session()->get('role_id'),
            'student_id' => session()->get('student_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.get_bulletin_imp_parent'), $data);
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

    // Update Student 
    public function updateStudent(Request $request)
    {
        // $rules = [
        //     'nationality' => 'required|string|max:50',
        //     'dual_nationality' => 'nullable|string|max:50|different:nationality',
        // ];

        // // Define custom error messages
        // $messages = [
        //     'dual_nationality.different' => 'The dual nationality cannot be the same as the nationality.',
        // ];

        // Validate the request
        // $validatedData = $request->validate($rules, $messages);


        // Set dual nationality based on checkbox
        $dual_nationality = $request->filled('has_dual_nationality_checkbox') ? $request->input('dual_nationality') : null;

        $visa_base64 = "";
        $visa_extension = "";
        $visa_file = $request->file('visa_photo');
        if ($visa_file) {
            $visa_path = $visa_file->path();
            $visa_data = file_get_contents($visa_path);
            $visa_base64 = base64_encode($visa_data);
            $visa_extension = $visa_file->getClientOriginalExtension();
        }

        $passport_base64 = "";
        $passport_extension = "";
        $passport_file = $request->file('passport_photo');
        if ($passport_file) {
            $passport_path = $passport_file->path();
            $passport_data = file_get_contents($passport_path);
            $passport_base64 = base64_encode($passport_data);
            $passport_extension = $passport_file->getClientOriginalExtension();
        }
        $nric_base64 = "";
        $nric_extension = "";
        $nric_file = $request->file('nric_photo');
        if ($nric_file) {
            $nric_path = $nric_file->path();
            $nric_data = file_get_contents($nric_path);
            $nric_base64 = base64_encode($nric_data);
            $nric_extension = $nric_file->getClientOriginalExtension();
        }

        // Set dual nationality based on checkbox
        // $dual_nationality = $request->has('has_dual_nationality_checkbox') ? $request->dual_nationality : null;
        $data = [
            'passport' => $request->txt_passport,
            'nric' => $request->txt_nric,
            // 'blood_group' => $request->blooddgrp,
            'religion' => $request->txt_religion,
            // 'race' => $request->txt_race,
            'country' => $request->drp_country,
            'post_code' => $request->drp_post_code,
            // 'mobile_no' => $request->txt_mobile_no,
            'city' => $request->drp_city,
            'state' => $request->drp_state,
            // 'current_address' => $request->txtarea_paddress,
            // 'permanent_address' => $request->txtarea_permanent_address,
            'student_id' => $request->student_id,
            'passport_expiry_date' => $request->passport_expiry_date,
            // 'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            "middle_name" => $request->mname,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'dual_nationality' => $dual_nationality,
            'nric_old_photo' => $request->nric_old_photo,
            'passport_old_photo' => $request->passport_old_photo,
            'visa_old_photo' => $request->visa_old_photo,
            'nric_photo' => $nric_base64,
            'nric_file_extension' => $nric_extension,
            'school_name' => $request->txt_prev_schname,
            'school_country' => $request->school_country,
            'school_city' => $request->school_city,
            'school_state' => $request->school_state,
            'school_postal_code' => $request->school_postal_code,
            "address_unit_no" => $request->address_unit_no,
            "address_condominium" => $request->address_condominium,
            "address_street" => $request->address_street,
            "address_district" => $request->address_district,
            "visa_type" => $request->visa_type,
            "visa_type_others" => $request->visa_type_others,
            "school_enrollment_status" => $request->school_enrollment_status,
            "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
            "japanese_association_membership_number_student" => $request->japanese_association_membership_number_student,
            'parent_id' => session()->get('ref_user_id'),

        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.parent_student_update'), $data);
        // dd($response);
        return $response;
    }
    public function applicationIndex()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // dd($student);
        return view(
            'parent.application.index',
            [
                'grade' => isset($getclass['data']) ? $getclass['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function applicationList(Request $request)
    {
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "academic_year" => $request->academic_year,
            "academic_grade" => $request->academic_grade,
            "created_by" => session()->get('ref_user_id'),
            "role" => session()->get('role_id'),
        ];
        $response = Helper::GETMethodWithData(config('constants.api.application_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('status', function ($row) {

                $status = $row['status'];
                if ($status == "Approved") {
                    $result = "success";
                } else if ($status == "Send Back") {
                    $result = "warning";
                } else if ($status == "Applied") {
                    $result = "info";
                } else if ($status == "Reject") {
                    $result = "danger";
                } else {
                    $result = "";
                }

                return '<span class="badge badge-soft-' . $result . ' p-1">' . $status . '</span>';
            })
            ->addColumn('phase_2_status', function ($row) {

                $status = $row['phase_2_status'];
                if ($status == "Approved") {
                    $result = "success";
                } else if ($status == "Send Back") {
                    $result = "warning";
                } else if ($status == "Applied") {
                    $result = "info";
                } else if ($status == "Reject") {
                    $result = "danger";
                } else {
                    $result = "";
                }

                return '<span class="badge badge-soft-' . $result . ' p-1">' . $status . '</span>';
            })
            ->addColumn('actions', function ($row) {
                $edit = route('parent.application.edit', $row['id']);
                return '<div class="button-list">
                <a href="' . $edit . '" class="btn btn-warning waves-effect waves-light" ><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" id="viewApplicationBtn"><i class="fe-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteApplicationBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions', 'status', 'phase_2_status'])
            ->make(true);
    }

    public function applicationCreate()
    {

        $data = [
            'email' => session()->get('email'),
        ];
        $application = Helper::PostMethod(config('constants.api.get_application_guardian_details'), $data);

        // dd($application);
        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        return view(
            'parent.application.add',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'contact' => isset($contactDetails['data']) ? $contactDetails['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'guardian' => isset($application['data']) ? $application['data'] : [],
                'email' => session()->get('email'),
            ]
        );
    }
    public function applicationAdd(Request $request)
    {

        $type = "Admission";


        // Set type based on the last date of withdrawal
        // $type = "Admission";
        // if ($request->last_date_of_withdrawal) {
        //     $type = "Re-Admission";
        // }

        $type = $request->filled('last_date_of_withdrawal') ? 'Re-Admission' : 'Admission';

        // Set dual nationality based on checkbox
        $dual_nationality = $request->filled('has_dual_nationality_checkbox') ? $request->input('dual_nationality') : null;
        if ($request->last_date_of_withdrawal) {
            $type = "Re-Admission";
        }

        // Set dual nationality based on checkbox
        // $dual_nationality = $request->has('has_dual_nationality_checkbox') ? $request->dual_nationality : null;
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            // 'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            // 'address_1' => $request->address_1,
            // 'address_2' => $request->address_2,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            // 'academic_grade' => $request->academic_grade,
            // 'academic_year' => $request->academic_year,
            // 'grade' => $request->grade,
            // 'school_year' => $request->school_year,
            'school_last_attended' => $request->school_last_attended,
            // 'school_address_1' => $request->school_address_1,
            // 'school_address_2' => $request->school_address_2,
            'school_country' => $request->school_country,
            'school_city' => $request->school_city,
            'school_state' => $request->school_state,
            'school_postal_code' => $request->school_postal_code,
            'father_first_name' => $request->father_first_name,
            'father_last_name' => $request->father_last_name,
            'father_phone_number' => $request->father_phone_number,
            'father_occupation' => $request->father_occupation,
            'father_email' => $request->father_email,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone_number' => $request->mother_phone_number,
            'mother_occupation' => $request->mother_occupation,
            'mother_email' => $request->mother_email,
            'guardian_first_name' => $request->guardian_first_name,
            'guardian_last_name' => $request->guardian_last_name,
            'guardian_phone_number' => $request->guardian_phone_number,
            'guardian_occupation' => $request->guardian_occupation,
            'guardian_email' => $request->guardian_email,
            'guardian_relation' => $request->guardian_relation,
            're_admission' => $request->re_admission,
            'last_date_of_withdrawal' => $request->last_date_of_withdrawal,
            'created_by' => session()->get('ref_user_id'),
            'created_by_role' => session()->get('role_id'),
            "type" => $type,

            "middle_name" => $request->middle_name,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            "dual_nationality" => $dual_nationality,
            "school_enrollment_status" => $request->school_enrollment_status,
            "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
            "mother_middle_name" => $request->mother_middle_name,
            "mother_last_name_furigana" => $request->mother_last_name_furigana,
            "mother_middle_name_furigana" => $request->mother_middle_name_furigana,
            "mother_first_name_furigana" => $request->mother_first_name_furigana,
            "mother_last_name_english" => $request->mother_last_name_english,
            "mother_middle_name_english" => $request->mother_middle_name_english,
            "mother_first_name_english" => $request->mother_first_name_english,
            "mother_nationality" => $request->mother_nationality,
            "father_middle_name" => $request->father_middle_name,
            "father_last_name_furigana" => $request->father_last_name_furigana,
            "father_middle_name_furigana" => $request->father_middle_name_furigana,
            "father_first_name_furigana" => $request->father_first_name_furigana,
            "father_last_name_english" => $request->father_last_name_english,
            "father_middle_name_english" => $request->father_middle_name_english,
            "father_first_name_english" => $request->father_first_name_english,
            "father_nationality" => $request->father_nationality,
            "guardian_middle_name" => $request->guardian_middle_name,
            "guardian_last_name_furigana" => $request->guardian_last_name_furigana,
            "guardian_middle_name_furigana" => $request->guardian_middle_name_furigana,
            "guardian_first_name_furigana" => $request->guardian_first_name_furigana,
            "guardian_last_name_english" => $request->guardian_last_name_english,
            "guardian_middle_name_english" => $request->guardian_middle_name_english,
            "guardian_first_name_english" => $request->guardian_first_name_english,
            "guardian_company_name_japan" => $request->guardian_company_name_japan,
            "guardian_company_name_local" => $request->guardian_company_name_local,
            "guardian_company_phone_number" => $request->guardian_company_phone_number,
            "guardian_employment_status" => $request->guardian_employment_status,
            "expected_academic_year" => $request->expected_academic_year,
            "expected_grade" => $request->expected_grade,
            "expected_enroll_date" => $request->expected_enroll_date,
            "remarks" => $request->remarks,

            "status" => "Parent",
            "parent_id" => session()->get('ref_user_id')
        ];

        $response = Helper::PostMethod(config('constants.api.application_add'), $data);
        // dd($response);
        return $response;
    }


    public function applicationEdit($id)
    {


        $data = [
            'id' => $id,
        ];
        // dd($data);
        $application = Helper::PostMethod(config('constants.api.application_details'), $data);
        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // dd($application['data']['guardian_first_name']);
        return view(
            'parent.application.edit',
            [
                'application' => isset($application['data']) ? $application['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
            ]
        );
    }
    public function applicationUpdate(Request $request)
    {

        // Set dual nationality based on checkbox
        $dual_nationality = $request->filled('has_dual_nationality_checkbox') ? $request->input('dual_nationality') : null;

        $status = $request->status;
        if($request->status=="Send Back"){
            $status = "Applied";
        }
        
        $phase_2_status = $request->phase_2_status;
        if ($request->status == "Approved") {
            if ($request->phase_2_status == null) {

                $phase_2_status = "Applied";
            }
        }
        
        if($request->phase_2_status=="Send Back"){
            $phase_2_status = "Applied";
        }
        $trail_start_date = null;
        $trail_end_date = null;
        if ($request->enrollment == "Trail Enrollment") {
            $trail_start_date = $request->trail_start_date;
            $trail_end_date = $request->trail_end_date;
        }
        $official_date = null;
        if ($request->enrollment == "Official Enrollment") {
            $official_date = $request->official_date;
        }
        // Set dual nationality based on checkbox
        // $dual_nationality = $request->has('has_dual_nationality_checkbox') ? $request->dual_nationality : null;

        $visa_base64 = "";
        $visa_extension = "";
        $visa_file = $request->file('visa_photo');
        if ($visa_file) {
            $visa_path = $visa_file->path();
            $visa_data = file_get_contents($visa_path);
            $visa_base64 = base64_encode($visa_data);
            $visa_extension = $visa_file->getClientOriginalExtension();
        }

        $passport_base64 = "";
        $passport_extension = "";
        $passport_file = $request->file('passport_photo');
        if ($passport_file) {
            $passport_path = $passport_file->path();
            $passport_data = file_get_contents($passport_path);
            $passport_base64 = base64_encode($passport_data);
            $passport_extension = $passport_file->getClientOriginalExtension();
        }

        $nric_base64 = "";
        $nric_extension = "";
        $nric_file = $request->file('nric_photo');
        if ($nric_file) {
            $nric_path = $nric_file->path();
            $nric_data = file_get_contents($nric_path);
            $nric_base64 = base64_encode($nric_data);
            $nric_extension = $nric_file->getClientOriginalExtension();
        }

        $image_principal_base64 = "";
        $image_principal_extension = "";
        $image_principal_file = $request->file('japanese_association_membership_image_principal');
        if ($image_principal_file) {
            $image_principal_path = $image_principal_file->path();
            $image_principal_data = file_get_contents($image_principal_path);
            $image_principal_base64 = base64_encode($image_principal_data);
            $image_principal_extension = $image_principal_file->getClientOriginalExtension();
        }

        $image_supplimental_base64 = "";
        $image_supplimental_extension = "";
        $image_supplimental_file = $request->file('japanese_association_membership_image_supplimental');
        if ($image_supplimental_file) {
            $image_supplimental_path = $image_supplimental_file->path();
            $image_supplimental_data = file_get_contents($image_supplimental_path);
            $image_supplimental_base64 = base64_encode($image_supplimental_data);
            $image_supplimental_extension = $image_supplimental_file->getClientOriginalExtension();
        }


        $passport_father_base64 = "";
        $passport_father_extension = "";
        $passport_father_file = $request->file('passport_father_photo');
        if ($passport_father_file) {
            $passport_father_path = $passport_father_file->path();
            $passport_father_data = file_get_contents($passport_father_path);
            $passport_father_base64 = base64_encode($passport_father_data);
            $passport_father_extension = $passport_father_file->getClientOriginalExtension();
        }

        $passport_mother_base64 = "";
        $passport_mother_extension = "";
        $passport_mother_file = $request->file('passport_mother_photo');
        if ($passport_mother_file) {
            $passport_mother_path = $passport_mother_file->path();
            $passport_mother_data = file_get_contents($passport_mother_path);
            $passport_mother_base64 = base64_encode($passport_mother_data);
            $passport_mother_extension = $passport_mother_file->getClientOriginalExtension();
        }

        $visa_father_base64 = "";
        $visa_father_extension = "";
        $visa_father_file = $request->file('visa_father_photo');
        if ($visa_father_file) {
            $visa_father_path = $visa_father_file->path();
            $visa_father_data = file_get_contents($visa_father_path);
            $visa_father_base64 = base64_encode($visa_father_data);
            $visa_father_extension = $visa_father_file->getClientOriginalExtension();
        }

        $visa_mother_base64 = "";
        $visa_mother_extension = "";
        $visa_mother_file = $request->file('visa_mother_photo');
        if ($visa_mother_file) {
            $visa_mother_path = $visa_mother_file->path();
            $visa_mother_data = file_get_contents($visa_mother_path);
            $visa_mother_base64 = base64_encode($visa_mother_data);
            $visa_mother_extension = $visa_mother_file->getClientOriginalExtension();
        }
        $data = [
            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'academic_grade' => $request->academic_grade,
            'academic_year' => $request->academic_year,
            'grade' => $request->grade,
            'school_year' => $request->school_year,
            'school_last_attended' => $request->school_last_attended,
            'school_country' => $request->school_country,
            'school_city' => $request->school_city,
            'school_state' => $request->school_state,
            'school_postal_code' => $request->school_postal_code,
            'father_first_name' => $request->father_first_name,
            'father_last_name' => $request->father_last_name,
            'father_phone_number' => $request->father_phone_number,
            'father_occupation' => $request->father_occupation,
            'father_email' => $request->father_email,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone_number' => $request->mother_phone_number,
            'mother_occupation' => $request->mother_occupation,
            'mother_email' => $request->mother_email,
            'guardian_first_name' => $request->guardian_first_name,
            'guardian_last_name' => $request->guardian_last_name,
            'guardian_phone_number' => $request->guardian_phone_number,
            'guardian_occupation' => $request->guardian_occupation,
            'guardian_email' => $request->guardian_email,
            'guardian_relation' => $request->guardian_relation,
            'status' => $status,
            'passport' => $request->passport,
            'nric' => $request->nric,
            'passport_expiry_date' => $request->passport_expiry_date,
            // 'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'phase_2_status' => $phase_2_status,
            'enrollment' => $request->enrollment,
            'trail_start_date' => $trail_start_date,
            'trail_end_date' => $trail_end_date,
            'official_date' => $official_date,
            'phase_1_reason' => $request->phase_1_reason,
            'phase_2_reason' => $request->phase_2_reason,
            'role_id' => session()->get('role_id'),


            "middle_name" => $request->middle_name,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            "dual_nationality" => $dual_nationality,
            "school_enrollment_status" => $request->school_enrollment_status,
            "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
            "mother_middle_name" => $request->mother_middle_name,
            "mother_last_name_furigana" => $request->mother_last_name_furigana,
            "mother_middle_name_furigana" => $request->mother_middle_name_furigana,
            "mother_first_name_furigana" => $request->mother_first_name_furigana,
            "mother_last_name_english" => $request->mother_last_name_english,
            "mother_middle_name_english" => $request->mother_middle_name_english,
            "mother_first_name_english" => $request->mother_first_name_english,
            "mother_nationality" => $request->mother_nationality,
            "father_middle_name" => $request->father_middle_name,
            "father_last_name_furigana" => $request->father_last_name_furigana,
            "father_middle_name_furigana" => $request->father_middle_name_furigana,
            "father_first_name_furigana" => $request->father_first_name_furigana,
            "father_last_name_english" => $request->father_last_name_english,
            "father_middle_name_english" => $request->father_middle_name_english,
            "father_first_name_english" => $request->father_first_name_english,
            "father_nationality" => $request->father_nationality,
            "guardian_middle_name" => $request->guardian_middle_name,
            "guardian_last_name_furigana" => $request->guardian_last_name_furigana,
            "guardian_middle_name_furigana" => $request->guardian_middle_name_furigana,
            "guardian_first_name_furigana" => $request->guardian_first_name_furigana,
            "guardian_last_name_english" => $request->guardian_last_name_english,
            "guardian_middle_name_english" => $request->guardian_middle_name_english,
            "guardian_first_name_english" => $request->guardian_first_name_english,
            "guardian_company_name_japan" => $request->guardian_company_name_japan,
            "guardian_company_name_local" => $request->guardian_company_name_local,
            "guardian_company_phone_number" => $request->guardian_company_phone_number,
            "guardian_employment_status" => $request->guardian_employment_status,
            "expected_academic_year" => $request->expected_academic_year,
            "expected_grade" => $request->expected_grade,
            "expected_enroll_date" => $request->expected_enroll_date,
            "remarks" => $request->remarks,

            // "nric_photo" => $request->nric_photo,
            // "japanese_association_membership_image_principal" => $request->japanese_association_membership_image_principal,
            // "japanese_association_membership_image_supplimental" => $request->japanese_association_membership_image_supplimental,

            "address_unit_no" => $request->address_unit_no,
            "address_condominium" => $request->address_condominium,
            "address_street" => $request->address_street,
            "address_district" => $request->address_district,
            "visa_type" => $request->visa_type,
            "visa_type_others" => $request->visa_type_others,
            "japanese_association_membership_number_student" => $request->japanese_association_membership_number_student,
            "phase2_remarks" => $request->phase2_remarks,

            'nric_photo' => $nric_base64,
            'nric_file_extension' => $nric_extension,
            'image_principal_photo' => $image_principal_base64,
            'image_principal_file_extension' => $image_principal_extension,
            'image_supplimental_photo' => $image_supplimental_base64,
            'image_supplimental_file_extension' => $image_supplimental_extension,
            'visa_father_photo' => $visa_father_base64,
            'visa_father_file_extension' => $visa_father_extension,
            'visa_mother_photo' => $visa_mother_base64,
            'visa_mother_file_extension' => $visa_mother_extension,
            'passport_mother_photo' => $passport_mother_base64,
            'passport_mother_file_extension' => $passport_mother_extension,
            'passport_father_photo' => $passport_father_base64,
            'passport_father_file_extension' => $passport_father_extension,

            'visa_old_photo' => $request->visa_old_photo,
            'passport_old_photo' => $request->passport_old_photo,
            'image_principal_old_photo' => $request->japanese_association_membership_image_principal_old,
            'image_supplimental_old_photo' => $request->japanese_association_membership_image_supplimental_old,
            'nric_old_photo' => $request->nric_old_photo,
            'passport_father_old_photo' => $request->passport_father_old_photo,
            'passport_mother_old_photo' => $request->passport_mother_old_photo,
            'visa_father_old_photo' => $request->visa_father_old_photo,
            'visa_mother_old_photo' => $request->visa_mother_old_photo,
            'stay_category' => $request->stay_category,
        ];
        // }
        // return $data;
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.application_update'), $data);

        return $response;
    }
    public function updateInfo(Request $request)
    {
        // if($request->ajax()){

        // }
        return view('parent.settings.update_list');
    }


    public function getParentUpdateInfoList(Request $request)
    {

        $data = [
            "status" => "Parent",
            "student_id" => session()->get('student_id'),
            "parent_id" => session()->get('ref_user_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.parent_student_update_info_list'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $color = "";
                if ($row['status'] == "Admin") {

                    $color = "warning";
                    $row['status_parent'] = "Pending";
                } else {

                    if ($row['status_parent'] == "Accept") {
                        $color = "success";
                    } else if ($row['status_parent'] == "Reject") {
                        $color = "danger";
                    } else if ($row['status_parent'] == "Remand") {
                        $color = "info";
                    }
                }
                return '<div class="button-list">
                
                <span class="badge badge-soft-' . $color . ' p-1">' . $row['status_parent'] . '</span>
            </div>';
            })
            ->addColumn('actions', function ($row) {
                $type = "";
                if (isset($row['student_id'])) {
                    $type = "Student";
                } else if (isset($row['parent_id'])) {
                    $type = "Parent";
                }
                return '<div class="button-list">
                    <a data-toggle="modal" data-target="#updateViewModal" data-id="' . $row['id'] . '" data-type="' . $type . '" id="updateViewModalDetails" class="btn btn-info waves-effect waves-light"><i class="fe-eye"></i></a>
                        </div>';
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }
    public function viewParentUpdateInfo($id)
    {
        $data = [
            'id' => $id,
        ];
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $response = Helper::PostMethod(config('constants.api.parent_update_info_view'), $data);
        // dd($response);
        return $response;
        // return view(
        //     'parent.update_view',
        //     [
        //         'religion' => isset($religion['data']) ? $religion['data'] : [],
        //         'races' => isset($races['data']) ? $races['data'] : [],
        //         'education' => isset($education['data']) ? $education['data'] : [],
        //         'parent' => isset($response['data']['profile']) ? $response['data']['profile'] : [],
        //         'changes' => isset($response['data']['parent']) ? $response['data']['parent'] : [],
        //     ]
        // );
    }

    // index Termination 
    public function termination()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // dd($student);
        return view(
            'parent.termination.index',
            [
                'grade' => isset($getclass['data']) ? $getclass['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    // create Termination 
    public function createTermination()
    {
        return view('parent.termination.add');
    }
    // edit Termination 
    public function editTermination(Request $request, $id)
    {

        $data = [
            'id' => $id,
        ];
        $termination = Helper::PostMethod(config('constants.api.termination_details'), $data);

        // dd($termination);
        return view(
            'parent.termination.edit',
            [
                'termination' => isset($termination['data']) ? $termination['data'] : [],
            ]
        );
    }
    public function addTermination(Request $request)
    {
        $data = [
            'student_id' => $request->student_id,
            'date' => $request->date,
            'schedule_date_of_termination' => $request->schedule_date_of_termination,
            'reason_for_transfer' => $request->reason_for_transfer,
            'transfer_destination_school_name' => $request->transfer_destination_school_name,
            'transfer_destination_tel' => $request->transfer_destination_tel,
            'parent_phone_number_after_transfer' => $request->parent_phone_number_after_transfer,
            'parent_email_address_after_transfer' => $request->parent_email_address_after_transfer,
            'parent_address_after_transfer' => $request->parent_address_after_transfer,
            "termination_status" => "Applied",
            "created_by" => session()->get('ref_user_id'),
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.termination_add'), $data);
        // dd($response);
        return $response;
    }

    public function getTerminationList(Request $request)
    {

        $data = [
            "parent_id" => session()->get('ref_user_id'),
            "academic_year" => $request->academic_year,
            "academic_grade" => $request->academic_grade,

        ];
        $response = Helper::GETMethodWithData(config('constants.api.termination_list'), $data);
        // dd($data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('termination_status', function ($row) {
                $color = "";
                if ($row['termination_status'] == "Approved") {
                    $color = "success";
                } else if ($row['termination_status'] == "Rejected") {
                    $color = "danger";
                } else if ($row['termination_status'] == "Pending") {
                    $color = "warning";
                } else if ($row['termination_status'] == "Applied") {
                    $color = "info";
                } else if ($row['termination_status'] == "Send Back") {
                    $color = "warning";
                }
                return '<div class="button-list">
                
                <span class="badge badge-soft-' . $color . ' p-1">' . $row['termination_status'] . '</span>
            </div>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('parent.termination.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTerminationBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['actions', 'termination_status'])
            ->make(true);
    }
    public function getTerminationDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.termination_details'), $data);
        return $response;
    }
    // Update Termination 
    public function updateTermination(Request $request)
    {


        $termination_notification = "No";
        $delete_google_address = "No";
        if ($request->delete_google_address == "on") {
            $delete_google_address = "Yes";
        }
        // dd($request);
        $termination_status = $request->termination_status;
        if ($request->termination_status == "Approved") {
            if ($request->old_date_of_termination != $request->date_of_termination) {
                $termination_status = "Applied";
                $termination_notification = "Yes";
            }
        } else {
            $data = [
                'id' => $request->id,
            ];
            $new = [];
            $new['schedule_date_of_termination'] = $request->schedule_date_of_termination;
            $new['reason_for_transfer'] = $request->reason_for_transfer;
            $new['transfer_destination_school_name'] = $request->transfer_destination_school_name;
            $new['transfer_destination_tel'] = $request->transfer_destination_tel;
            $new['parent_phone_number_after_transfer'] = $request->parent_phone_number_after_transfer;
            $new['parent_email_address_after_transfer'] = $request->parent_email_address_after_transfer;
            $new['parent_address_after_transfer'] = $request->parent_address_after_transfer;
            $new['school_fees_payment_status'] = $request->school_fees_payment_status;
            $new['termination_status'] = $request->termination_status;
            $new['delete_google_address'] = $delete_google_address;
            $new['remarks'] = $request->remarks;
            // dd($new);
            $termination = Helper::PostMethod(config('constants.api.termination_details'), $data);

            // dd($termination['data']['id']);
            $old = [];
            $old['schedule_date_of_termination'] = $termination['data']['schedule_date_of_termination'];
            $old['reason_for_transfer'] = $termination['data']['reason_for_transfer'];
            $old['transfer_destination_school_name'] = $termination['data']['transfer_destination_school_name'];
            $old['transfer_destination_tel'] = $termination['data']['transfer_destination_tel'];
            $old['parent_phone_number_after_transfer'] = $termination['data']['parent_phone_number_after_transfer'];
            $old['parent_email_address_after_transfer'] = $termination['data']['parent_email_address_after_transfer'];
            $old['parent_address_after_transfer'] = $termination['data']['parent_address_after_transfer'];
            $old['school_fees_payment_status'] = $termination['data']['school_fees_payment_status'];
            $old['termination_status'] = $termination['data']['termination_status'];
            $old['delete_google_address'] = $termination['data']['delete_google_address'];
            $old['remarks'] = $termination['data']['remarks'];
            $output  = array_diff($new, $old);
            if (count($output) > 0) {
                $termination_status = "Applied";
            }
        }
        $data = [
            'id' => $request->id,
            'student_id' => $request->student_id,
            'control_number' => $request->control_number,
            'date' => $request->date,
            'schedule_date_of_termination' => $request->schedule_date_of_termination,
            'reason_for_transfer' => $request->reason_for_transfer,
            'transfer_destination_school_name' => $request->transfer_destination_school_name,
            'transfer_destination_tel' => $request->transfer_destination_tel,
            'parent_phone_number_after_transfer' => $request->parent_phone_number_after_transfer,
            'parent_email_address_after_transfer' => $request->parent_email_address_after_transfer,
            'parent_address_after_transfer' => $request->parent_address_after_transfer,
            'school_fees_payment_status' => $request->school_fees_payment_status,
            'termination_status' => $termination_status,
            'delete_google_address' => $delete_google_address,
            'remarks' => $request->remarks,
            'date_of_termination' => $request->date_of_termination,
            'termination_notification' => $termination_notification,
            "created_by" => session()->get('ref_user_id'),
            'role_id' => session()->get('role_id'),
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.termination_update'), $data);
        // dd($response);
        return $response;
    }
    // DELETE Termination 
    public function deleteTermination(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.termination_delete'), $data);
        return $response;
    }
    public function studentMedicalRecord()
    {
        $data= [
            'student_id' => session()->get('student_id')
        ];
        $response = Helper::PostMethod(config('constants.api.get_student_medical_record'), $data);
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $allergies_name_list = Helper::GetMethod(config('constants.api.get_allergies_name_list'));
        $student_id = session()->get('student_id');
        $parent_id = session()->get('ref_user_id');
        return view(
            'parent.student_medical.index',
            [
                'grade' => isset($getclass['data']) ? $getclass['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'student_id' => isset($student_id) ? $student_id : 0,
                'parent_id' => isset($parent_id) ? $parent_id : 0,               
                'studentmedical' => isset($response['data']['student']) ? $response['data']['student'] : [],                
                'allergies_name'=> isset($allergies_name_list['data']) ? $allergies_name_list['data'] : [],                
                'allergies_details' => isset($response['data']['allergies']) ? $response['data']['allergies'] : [],
            ]
        );
    }
    public function studentMedicalRecordAdd(Request $request)
    { 
        $data = [
            'student_id' =>  $request->student_id,
            'parent_id' => $request->parent_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'normal_temp' => $request->normal_temp,
            'hospital_name'=> $request->hospital_name,
            'doctor_name' => $request->doctor_name,
            'company_name'=> $request->company_name,
            'insurance' => $request->insurance,
            'allergies' => $request->allergies,
            'remark_allergen'=> $request->remark_allergen,
            'anaphylactic'=> $request->anaphylactic,
            'epinephrine' => $request->epinephrine,
            'other_medicines' => $request->other_medicines,
            'heart_problem' => $request->heart_problem,
            'epilepsy' => $request->epilepsy,
            'measles'=> $request->measles,
            'kawasaki_disease' => $request->kawasaki_disease,
            'febrile_convulsion' => $request->febrile_convulsion,
            'chicken_pox' => $request->chicken_pox,
            'scoliosis' => $request->scoliosis,
            'tuberculosis' => $request->tuberculosis,
            'mumps' =>  $request->mumps,
            'kidney_problems' => $request->kidney_problems,
            'others' => $request->others,
            'rubella' => $request->rubella,
            'diabetes' => $request->diabetes,
            'dengue_fever' => $request->dengue_fever,
            'operated_disease' => $request->operated_disease,
            'injury' => $request->injury,
            'illness' => $request->illness,
            'japanese_encephalitis' => $request->japanese_encephalitis,
            'streptococcus_pneumoniae' => $request->streptococcus_pneumoniae,
            'triple_antigen' => $request->triple_antigen,
            'hib' => $request->hib,
            'quadruple_antigen' => $request->quadruple_antigen,
            'covid' => $request->covid,
            'bcg' => $request->bcg,
            'rabies_vaccine' => $request->rabies_vaccine,
            'measles' => $request->measles,
            'tetanus' => $request->tetanus,
            'chicken_pox_imm' => $request->chicken_pox_imm,
            'mumps_imm' => $request->mumps_imm,
            'doctors_advised' => $request->advised_doctors,
            'develops_fever' => $request->develops_fever,
            'frequent_headaches' => $request->frequent_headaches,
            'dyspepsia' => $request->dyspepsia,
            'constipates' => $request->constipates,
            'vomits' => $request->vomits,
            'faints' => $request->faints,
            'dizziness' => $request->dizziness,
            'nettle_rash' => $request->nettle_rash,
            'prone_car_sickness' => $request->prone_car_sickness,
            'poor_hearing' => $request->poor_hearing,
            'otitis_media' => $request->otitis_media,
            'bleeds_nose' => $request->bleeds_nose,
            'nasal_congestion_nose' => $request->nasal_congestion_nose,
            'throat_swollen' => $request->throat_swollen,
            'squinted_eyes' => $request->squinted_eyes,
            'eye_irritation' => $request->eye_irritation,
            'glasses_lenses' => $request->glasses_lenses,
            'wrong_colour' => $request->wrong_colour,
            'sensistive_tooth' => $request->sensistive_tooth,
            'bleed_from_gum' => $request->bleed_from_gum,
            'pain_sound_jaw_joint' => $request->pain_sound_jaw_joint,
            'orthodontics' => $request->orthodontics,
            'medicine_to_take_daily' => $request->medicine_to_take_daily,
            'date' => $request->date,
            'remarks' => $request->remarks,


        ];
        $response = Helper::PostMethod(config('constants.api.student_medical_record_add'), $data);
        return $response;
    }
    public function checkpermissions(Request $request)
    {
        $pagedata = [
            //'menu_id' => "27",
            'menu_id' => $request->menu_id,
            'role_id' => session()->get('role_id'),
            'school_roleid' => session()->get('school_roleid'),
            'branch_id' => config('constants.branch_id')
        ];
        $page = Helper::PostMethod(config('constants.api.getschoolroleaccess'), $pagedata);
        return $page;
    }
    public function page403(Request $request)
    {
        return view('admin.dashboard.403');
    }
}
