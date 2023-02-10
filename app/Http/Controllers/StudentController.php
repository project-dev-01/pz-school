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
        
        
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'student.dashboard.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
                'get_homework_list_dashboard' => $get_homework_list_dashboard['data'],
                'greetings' => $greetings,
                'all_exam_subject_scores' => $all_exam_subject_scores['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'exams' => $exam_by_student['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
            ]
        );
    }
    // public function index(Request $request)
    // {
    //     // $request->session()->put('children_id', "1");

    //     $user_id = session()->get('user_id');
    //     $student_id = session()->get('student_id');
    //     $parent_id = session()->get('ref_user_id');

    //     $data = [
    //         'user_id' => $user_id,
    //         'student_id' => $student_id,
    //         'academic_session_id' => session()->get('academic_session_id')
    //     ];
    //     $parent_ids = [
    //         'parent_id' => $parent_id,
    //     ];
    //     // dd($data);

    //     $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
    //     $get_homework_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_homework_list_dashboard'), $data);
    //     $get_std_names_dashboard = Helper::GETMethodWithData(config('constants.api.get_students_parentdashboard'), $parent_ids);
    //     $get_leave_reasons_dashboard = Helper::GetMethod(config('constants.api.absent_reason_list'));
    //     $greetings = Helper::greetingMessage();
    //     $semester = Helper::GetMethod(config('constants.api.semester'));
    //     $session = Helper::GetMethod(config('constants.api.session'));
    //     // dd($get_homework_list_dashboard);
    //     $exam_by_student = Helper::GETMethodWithData(config('constants.api.exam_by_student'), $data);
    //     $all_exam_subject_scores = Helper::PostMethod(config('constants.api.all_exam_subject_scores'), $data);
        
        
    //     $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
    //     // dd($all_exam_subject_scores['data']);
    //     return view(
    //         'parent.dashboard.index',
    //         [
    //             'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
    //             'get_homework_list_dashboard' => $get_homework_list_dashboard['data'],
    //             'get_std_names_dashboard' => $get_std_names_dashboard['data'],
    //             'get_leave_reasons_dashboard' => $get_leave_reasons_dashboard['data'],
    //             'all_exam_subject_scores' => $all_exam_subject_scores['data'],
    //             'semester' => $semester['data'],
    //             'session' => $session['data'],
    //             'greetings' => $greetings,
    //             'exams' => $exam_by_student['data'],
    //             'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
    //             'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : "",
    //         ]
    //     );
    // }
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
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student'), $data);

        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        return view(
            'student.homework.list',
            [
                'homework' => $homework['data']['homeworks'],
                'subject' => $get_student_by_all_subjects['data'],
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


                    if ($work['status'] == 1) {
                        $file = '<div class="col-md-4">
                        <div class="row">
                            <div class="col-md-5 font-weight-bold">Attachment File: </div>
                            <div class="col-md-3">
                                <a href="' . asset('student/homework/') . '/' . $work['file'] . '" download>
                                    <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                </a>
                            </div>
                        </div>
                    </div>';
                    } else {
                        $file = '<div class="col-md-4">
                            <div class="row">
                                <div class="col-md-5 font-weight-bold">Attachment File: </div>
                                <div class="col-md-5">
                                    <input type="file"  name="file">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Submit
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
                                        <i class="fas fa-caret-square-down"></i>' . $work['subject_name'] . ' - ' . date('j F Y', strtotime($work['date_of_homework'])) . ' ' . $top . '
                                    </a>
                                </div>
                                </p>
                                <div class="collapse" id="hw-' . $key . '">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Title :</div>
                                                    <div class="col-md-3">' . $work['title'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Status :</div>
                                                    <div class="col-md-3">' . $status . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['date_of_homework'])) . '</div>
                                                </div>
                                            </div>

                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['date_of_submission'])) . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                                    <div class="col-md-3">' . $evaluation_date . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Remarks :</div>
                                                    <div class="col-md-3">' . $work['description'] . '</div>
                                                </div>
                                            </div>
                                        </div><br />
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Rank Out Of 5 :</div>
                                                    <div class="col-md-3">' . $work['rank'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Document :</div>
                                                    <div class="col-md-3">
                                                        <a href="' . asset('teacher/homework/') . '/' . $work['document'] . '" download>
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
                                        <input type="hidden" name="homework_id" value="' . $work['id'] . '">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-5 font-weight-bold">Note : </div>
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
                'schedule_exam_list' => $response['data']
            ]
        );
    }

    public function viewExamTimetable(Request $request)
    {

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
                                <td colspan="7" class="text-center"> No Data Available</td>
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
                'allexams' => $allexams['data']
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
        return view('student.forum.page-create-topic', [
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
        $user_id = session()->get('user_id');
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
                'get_student_by_all_subjects' => $get_student_by_all_subjects['data'],
                'get_class_section_by_student' => $get_class_section_by_student['data']
            ]
        );
    }

    public function timetable(Request $request)
    {

        // dd($student);
        $data = [
            'student_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
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
        if ($timetable['code'] == "200") {
            return view(
                'student.timetable.index',
                [
                    'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : 0,
                    'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : 0,
                    'days' => $days,
                    'max' => isset($timetable['data']['max']) ? $timetable['data']['max'] : 0

                ]
            );
        } else {
            return view(
                'student.timetable.index',
                [
                    'timetable' => "",
                ]
            );
        }
    }

    public function getEventList(Request $request)
    {
        $data = [
            'student_id' => session()->get('ref_user_id')
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
}
