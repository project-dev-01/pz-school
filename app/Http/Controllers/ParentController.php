<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Task;
use DataTables;

class ParentController extends Controller
{
    //
    public function index(Request $request)
    {
        // $request->session()->put('children_id', "1");

        $user_id = session()->get('user_id');
        $student_id = session()->get('student_id');
        $parent_id = session()->get('ref_user_id');

        $data = [
            'user_id' => $user_id,
            'student_id' => $student_id
        ];
        $parent_ids = [
            'parent_id' => $parent_id,
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_teacher'), $data);
        $get_homework_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_homework_list_dashboard'), $data);
        $get_std_names_dashboard = Helper::GETMethodWithData(config('constants.api.get_students_parentdashboard'), $parent_ids);
        $get_leave_reasons_dashboard = Helper::GetMethod(config('constants.api.get_leave_reasons'));
        // dd($get_std_names_dashboard);
        return view(
            'parent.dashboard.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
                'get_homework_list_dashboard' => $get_homework_list_dashboard['data'],
                'get_std_names_dashboard' => $get_std_names_dashboard['data'],
                'get_leave_reasons_dashboard' => $get_leave_reasons_dashboard['data'],
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
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile"><i class="fe-edit"></i></a>
                            </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
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
        $datas = array();
        $allexams = Helper::PostMethod(config('constants.api.all_exams_list'), $datas);
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
        $data = [
            'parent_id' => $parent,
            'children_id' => $children_id
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
        if ($timetable['code'] == "200") {
            return view(
                'parent.time_table.index',
                [
                    'timetable' => $timetable['data']['timetable'],
                    'details' => $timetable['data']['details'],
                    'days' => $days,
                    'max' => $timetable['data']['max']

                ]
            );
        } else {
            return view(
                'parent.time_table.index',
                [
                    'timetable' => "",
                ]
            );
        }
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
        return view('parent.forum.page-create-topic', [
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
        $user_id = session()->get('user_id');
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
        $rollid_tags = $request->tags;
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
            'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 1
        ];
        //dd($data);
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
        return view('parent.forum.page-single-topic', [
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
        $student = session()->get('student_id');
        $data = [
            'student_id' => $student,
        ];
        $homework = Helper::PostMethod(config('constants.api.homework_student'), $data);

        //  dd($homework);
        return view(
            'parent.homework.list',
            [
                'homework' => $homework['data']['homeworks'],
                'subject' => $homework['data']['subjects'],
                'count' => $homework['data']['count'],
            ]
        );
    }



    //Filter  Homework
    public function filterHomework(Request $request)
    {
        $student = session()->get('student_id');
        $data = [
            'status' => $request->status,
            'subject' => $request->subject,
            'student_id' => $student,
        ];


        $homework = Helper::PostMethod(config('constants.api.homework_student_filter'), $data);
        if ($homework['code'] == "200") {
            $response = "";
            if ($homework['data']) {
                foreach ($homework['data']['homeworks'] as $work) {
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
                                <a href="~/resources/views/Guide.pdf" download>
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
    
                                    <input type="file" class="custom-file-input" id="">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                        </div>';
                    }
                    $response .= '<form class="submitHomeworkForm" method="post"   enctype="multipart/form-data" autocomplete="off">
                    ' . csrf_field() . '
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>
                                <div>
                                    <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#English" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-caret-square-down"></i>' . $work['subject_name'] . ' - ' . date('j F Y', strtotime($work['date_of_homework'])) . ' ' . $top . '
                                    </a>
                                </div>
                                </p>
                                <div class="collapse" id="English">
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
                                                    <div class="col-md-3">' . date('F j , Y', strtotime($work['evaluation_date'])) . '</div>
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
                                                        <a href="~/resources/views/Guide.pdf" download>
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
        $data = [
            'student_id' => session()->get('student_id')
        ];
        $get_student_by_all_subjects = Helper::PostMethod(config('constants.api.get_student_by_all_subjects'), $data);
        $get_class_section_by_student = Helper::PostMethod(config('constants.api.get_class_section_by_student'), $data);
        
        // dd($get_class_section_by_student['data']['student_id']);
        return view(
            'parent.analyticrep.analyticreport',
            [
                'get_student_by_all_subjects' => $get_student_by_all_subjects['data'],
                'get_class_section_by_student' => $get_class_section_by_student['data']
            ]
        );
    }
}
