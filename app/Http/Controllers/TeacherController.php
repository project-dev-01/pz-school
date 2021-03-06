<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Task;
use PhpParser\Node\Expr\FuncCall;
use DataTables;

class TeacherController extends Controller
{
    //
    public function index()
    {
        $user_id = session()->get('user_id');
        $teacher_id = session()->get('ref_user_id');
        $data = [
            'user_id' => $user_id,
            'teacher_id' => $teacher_id
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        return view(
            'teacher.dashboard.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
            ]
        );
    }
    public function applyleave()
    {
        $get_leave_types = Helper::GetMethod(config('constants.api.get_leave_types'));
        $get_leave_reasons = Helper::GetMethod(config('constants.api.get_leave_reasons'));
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $leave_taken_history = Helper::PostMethod(config('constants.api.leave_taken_history'), $data);

        return view('teacher.leave_management.applyleave', [
            'get_leave_types' => $get_leave_types['data'],
            'get_leave_reasons' => $get_leave_reasons['data'],
            'leave_taken_history' => $leave_taken_history['data'],
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
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_history'), $staff_id);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                if ($row['status'] != "Approve") {
                    return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile"><i class="fe-edit"></i></a>
            </div>';
                } else {
                    return '-';
                }
            })

            ->rawColumns(['actions'])
            ->make(true);
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
        ];
        $response = Helper::PostMethod(config('constants.api.leave_approval_history_by_staff'), $staff_data);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-staff_id="' . $row['staff_id'] . '" id="viewDetails">Details</a>
                            </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
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
        // $user_id = session()->get('user_id');
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
        $user_id = session()->get('user_id');
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
        $rollid_tags = $request->tags;
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
            'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 1
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
        if ($request->hasFile('upload')) {

            //get filename with extension

            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension

            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension

            $extension = $request->file('upload')->getClientOriginalExtension();



            //filename to store

            $filenametostore = $filename . '_' . time() . '.' . $extension;



            //upload file

            $request->file('upload')->storeAs('public/forumupload', $filenametostore);



            echo json_encode([

                'default' => asset('storage/forumupload/' . $filenametostore),

                '500' =>  asset('storage/forumupload/' . $filenametostore)

            ]);
        }
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
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view('teacher.classroom.management', [
            'teacher_class' => $response['data'],
            'semester' => $semester['data'],
            'session' => $session['data']
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
        return view('teacher.testresult.index', [
            'teacher_class' => $response['data']
            //   'get_exams' => $get_exams['data']
        ]);
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
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view('teacher.attendance.index', [
            'teacher_class' => $response['data']
        ]);
    }
    // by classes
    public function byclasss()
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        $allGrades = Helper::GetMethod(config('constants.api.tot_grade_master'));

        return view(
            'teacher.exam_results.byclass',
            [
                'classnames' => $getclass['data'],
                'allGrades' => $allGrades['data']
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
        $allGrades = Helper::GetMethod(config('constants.api.tot_grade_master'));
        return view(
            'teacher.exam_results.bysubject',
            [
                'classnames' => $getclass['data'],
                'allGrades' => $allGrades['data']
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
        $allGrades = Helper::GetMethod(config('constants.api.tot_grade_master'));
        return view(
            'teacher.exam_results.bystudent',
            [
                'classnames' => $getclass['data'],
                'allGrades' => $allGrades['data']
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
                                    <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $work['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> Details</a></td>
                                </tr>';
                    $row++;
                }
            } else {
                $response .= '<tr>
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
                                                <option Selected>Marks</option>
                                                <option>Grade</option>
                                                <option>Text</option>
                                            </select>';
                    } elseif ($work['score_name'] == "Grade") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                            <option>Marks</option>
                                            <option Selected>Grade</option>
                                            <option>Text</option>
                                        </select>';
                    } elseif ($work['score_name'] == "Text") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                                <option>Marks</option>
                                                <option>Grade</option>
                                                <option Selected>Text</option>
                                            </select>';
                    } else {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                                <option>Marks</option>
                                                <option>Grade</option>
                                                <option>Text</option>
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
                        $status = '<button type="button" class="btn btn-outline-success btn-rounded waves-effect waves-light">Completed</button>';
                        $complete++;
                    } else {
                        $status = '<button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light">Incomplete</button>';
                        $incomplete++;
                    }


                    $response .= '<tr>
                                    <input type="hidden" value="' . $work['evaluation_id'] . '" name="homework[' . $row . '][homework_evaluation_id]">
                                    <td>' . $row . '</td>
                                    <td>' . $work['first_name'] . ' ' . $work['last_name'] . '</td>
                                    <td>' . $work['register_no'] . '</td>
                                    <td>' . $status . '</td>
                                    <td>
                                        <div class="form-group">
                                            <label for="score_name">Status</label>
                                            ' . $score_name . '
                                        </div>
                                        <input type="text" class="form-control" name="homework[' . $row . '][score_value]" value="' . $work['score_value'] . '" aria-describedby="inputGroupPrepend" >

                                    </td>
                                    <td><input type="text" class="form-control" name="homework[' . $row . '][teacher_remarks]"  value="' . $work['teacher_remarks'] . '" aria-describedby="inputGroupPrepend" ></td>
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
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        return view('teacher.analyticrep.analyticreport', [
            'teacher_class' => $response['data']
        ]);
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
            "session_id" => $request->session_id
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
            "session_id" => $request->session_id
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
            'teacher_id' => session()->get('ref_user_id')
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
            "exam_id" => $request->exam_id
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
        return view(
            'teacher.attendance.employee',
            [
                'employee' => $employee
            ]
        );
    }
    public function getEmployeeAttendanceList(Request $request)
    {
        $data = [
            'firstDay' => $request->firstDay,
            'lastDay' => $request->lastDay,
            'employee' => $request->employee,
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
            'attendance' => $request->attendance,
        ];

        $attendance = Helper::PostMethod(config('constants.api.employee_attendance_add'), $data);
        return $attendance;
    }

    public function reportEmployeeAttendance()
    {
        $employee = session()->get('ref_user_id');
        return view(
            'teacher.attendance.employee_report',
            [
                'employee' => $employee
            ]
        );
    }
}
