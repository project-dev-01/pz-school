<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use DataTables;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Excel;
use DateTime;
use DateTimeZone;
use App\Exports\StaffAttendanceExport;
use App\Exports\StudentAttendanceExport;

class AdminController extends Controller
{
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
        return view('admin.forum.index', [
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('admin.forum.page-single-topic');
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
        // dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        // dd($forum_list);
        return view('admin.forum.page-create-topic', [
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
        $forum_threadslist = Helper::GetMethod(config('constants.api.forum_threadslist'));
        // dd($forum_threadslist);
        return view('admin.forum.page-single-user', [
            // 'forum_post_user_crd' => $forum_post_user_crd['data'],
            // 'forum_categorypost_user_crd' => $forum_categorypost_user_crd['data'],
            // 'forum_post_user_allreplies' => $forum_post_user_allreplies['data'],
            // 'forum_threadslist' => $forum_threadslist['data']
            'forum_post_user_crd' => !empty($forum_post_user_crd['data']) ? $forum_post_user_crd['data'] : [],
            'forum_categorypost_user_crd' => !empty($forum_categorypost_user_crd['data']) ? $forum_categorypost_user_crd['data'] : [],
            'forum_post_user_allreplies' => !empty($forum_post_user_allreplies['data']) ? $forum_post_user_allreplies['data'] : [],
            'forum_threadslist' => !empty($forum_threadslist['data']) ? $forum_threadslist['data'] : []
        ]);
    }
    public function forumPageSingleThreads()
    {
        return view('admin.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('admin.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('admin.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('admin.forum.page-single-categories');
    }
    public function forumPageCategories()
    {
        $adminlistcategoryvs = Helper::GetMethod(config('constants.api.adminlistcategoryvs'));
        // dd($listcategoryvs);      
        return view('admin.forum.page-categories', [
            'adminlistcategoryvs' => $adminlistcategoryvs['data']
        ]);
    }
    // forum category vs single
    public function forumPageCategoriesSingle($categId, $user_id, $category_names)
    {
        session()->put('session_category_names', $category_names);
        $data = [
            'categId' => $categId,
            'user_id' => $user_id
        ];
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_single_categ'), $data);

        return view('admin.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
    }
    public function forumPageTabs()
    {
        return view('admin.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('admin.forum.page-tabs-guidelines');
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
            'threads_status' => 2
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
        return view('admin.forum.page-single-topic', [
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
    public function crtimgeastore(Request $request)
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
    //
    public function index()
    {
        // dd(session('school_name_url'));
        $user_id = session()->get('user_id');
        $data = [
            'user_id' => $user_id
        ];
        $get_to_do_list_dashboard = Helper::GETMethodWithData(config('constants.api.get_to_do_list_dashboard'), $data);
        $greetings = Helper::greetingMessage();
        $employee_count = Helper::GetMethod(config('constants.api.employee_count'));
        $student_count = Helper::GetMethod(config('constants.api.student_count'));
        $parent_count = Helper::GetMethod(config('constants.api.parent_count'));
        $teacher_count = Helper::GetMethod(config('constants.api.teacher_count'));
        $count['employee_count'] = $employee_count['data'];
        $count['student_count'] = $student_count['data'];
        $count['parent_count'] = $parent_count['data'];
        $count['teacher_count'] = $teacher_count['data'];
        //  dd($get_to_do_list_dashboard);
        return view(
            'admin.dashboard.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
                'greetings' => $greetings,
                'count' => $count
            ]
        );
        // return view('admin.dashboard.index');
    }
    public function settings()
    {
        return view('admin.settings.index');
    }
    public function settingsLogo()
    {
        return view('admin.settings.logo');
    }

    public function classes()
    {
        return view('admin.classes.index');
    }

    // update profile info
    public function updateProfileInfo(Request $request)
    {
        // dd($request->address);

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'address' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile info has been update successfuly.']);
            }
        }
    }

    // update profile picture
    public function updatePicture(Request $request)
    {

        $path = 'users/images/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        //Upload new image
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (\File::exists(public_path($path . $oldPicture))) {
                    \File::delete(public_path($path . $oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }

    // change password
    public function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'ReEnter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }


    // get class details
    public function getClassList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.class_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editClassBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteClassBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }


    // users page
    public function users()
    {
        return view('admin.users.index');
    }

    // get users details
    public function getUserList(Request $request)
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.role_id', '!=', 1)
            ->get(['users.id', 'users.name', 'users.role_id', 'roles.role_name', 'roles.role_slug']);
        // dd($users);
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteUserBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }
    // show user page
    public function addUsers()
    {
        $roleDetails = Role::select('role_id', 'role_name')->where('role_id', '!=', 1)->get();
        return view('admin.users.add', ['roleDetails' => $roleDetails]);
    }
    // add roleUser
    public function addRoleUser(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'role_name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users',
            // 'student_id' => 'unique:users',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->role_id = $request->role_name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->citizenship = $request->citizenship;
            $user->occupation = $request->occupation;
            $user->student_id = $request->student_id;
            $user->address = $request->address;
            $user->age = $request->age;

            $query = $user->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New User has been successfully saved']);
            }
        }
    }

    // DELETE User Details
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $query = User::find($id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'User has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    // get section
    public function section()
    {
        return view('admin.section.index');
    }

    // get sections 
    public function getSectionList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.section_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSectionBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSectionBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // section allocations
    public function showSectionAllocation()
    {
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getSections = Helper::GetMethod(config('constants.api.section_list'));
        return view('admin.section_allocation.allocation', ['classDetails' => $getClasses['data'], 'sectionDetails' => $getSections['data']]);
    }


    // get sections allocation
    public function getSectionAllocationList(Request $request)
    {


        $response = Helper::GetMethod(config('constants.api.allocate_section_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSectionAlloBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSectionAlloBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // get TeacherAllocation
    public function showTeacherAllocation()
    {
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getAllTeacherList = Helper::GetMethod(config('constants.api.get_all_teacher_list'));
        return view('admin.assign_teacher.index', ['classDetails' => $getClasses['data'], 'getAllTeacherList' => $getAllTeacherList['data']]);
    }


    // get Teacher Allocation List

    public function getTeacherAllocationList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.assign_teacher_list'), $data);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editClsTeacherBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteClsTeacherBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // get showSubjectsIndex
    public function showSubjectsIndex()
    {
        return view('admin.subjects.index');
    }

    // get subjects
    public function getSubjectsList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.subject_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSubjectBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSubjectBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get showClassAssignSubIndex
    public function showClassAssignSubIndex()
    {
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getSubjectList = Helper::GetMethod(config('constants.api.subject_list'));
        return view('admin.assign_class_subject.index', ['classDetails' => $getClasses['data'], 'getSubjectList' => $getSubjectList['data']]);
    }
    public function ClassAssignSubList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.class_assign_list'), $data);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editAssiClassSubBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteAssiClassSubBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get showClassAssignSubTeacherIndex
    public function showClassAssignSubTeacherIndex()
    {
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getAllTeacherList = Helper::GetMethod(config('constants.api.get_all_teacher_list'));

        return view('admin.assign_class_subject_teacher.index', [
            'classDetails' => $getClasses['data'],
            'getAllTeacherList' => $getAllTeacherList['data'],
        ]);
    }
    public function ClassAssignSubTeacherList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.teacher_assign_sub_list'), $data);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editAssiClassSubTeacBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteAssiClassSubTeacBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // index Event Type
    public function eventType()
    {
        return view('admin.event_type.index');
    }

    public function addEventType(Request $request)
    {
        $data = [
            'name' => $request->name,
            'color' => $request->color,
        ];
        $response = Helper::PostMethod(config('constants.api.event_type_add'), $data);
        return $response;
    }
    public function getEventTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.event_type_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('color', function ($row) {
                return '<span style="color:' . $row['color'] . '" >' . $row['color'] . '</span>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEventTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getEventTypeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.event_type_details'), $data);
        return $response;
    }
    public function updateEventType(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'color' => $request->color,
        ];

        $response = Helper::PostMethod(config('constants.api.event_type_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteEventType(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.event_type_delete'), $data);
        return $response;
    }

    // index Event 
    public function event()
    {
        return view('admin.event.index');
    }
    // create Event 
    public function createEvent()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettype = Helper::GetMethod(config('constants.api.event_type_list'));
        $getgroup = Helper::GetMethod(config('constants.api.group_list'));

        // dd($gettype);
        return view(
            'admin.event.add',
            [
                'class' => $getclass['data'],
                'type' => $gettype['data'],
                'group' => $getgroup['data'],
            ]
        );
    }
    // edit Event 
    public function editEvent($id)
    {

        $data = [
            'id' => $id,
        ];
        $event = Helper::PostMethod(config('constants.api.event_details'), $data);

        // dd($event);
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettype = Helper::GetMethod(config('constants.api.event_type_list'));
        $getgroup = Helper::GetMethod(config('constants.api.group_list'));

        // dd($gettype);
        return view(
            'admin.event.edit',
            [
                'class' => $getclass['data'],
                'type' => $gettype['data'],
                'event' => $event['data'],
                'group' => $getgroup['data'],
            ]
        );
    }


    public function addEvent(Request $request)
    {

        if ($request->class) {
            $class = implode(",", $request->class);
        } else {
            $class = "";
        }

        if ($request->group) {
            $group = implode(",", $request->group);
        } else {
            $group = "";
        }

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'audience' => $request->audience,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'event_class' => $class,
            'class' => $request->class,
            'event_group' => $group,
            'group' => $request->group,
            'section' => $request->section,
            'all_day' => $request->all_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'holiday' => $request->holiday,
            'description' => $request->description
        ];
        $response = Helper::PostMethod(config('constants.api.event_add'), $data);
        // dd($response);
        return $response;
    }

    public function getEventList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.event_list'));
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
            ->addColumn('publish', function ($row) {

                $status = $row['status'];
                if ($status == 1) {
                    $result = "checked";
                } else {
                    $result = "";
                }
                return '<input type="checkbox" ' . $result . ' data-id="' . $row['id'] . '"  id="publishEventBtn">';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" id="viewEventBtn"><i class="fe-eye"></i></a>
                                <a href="' . route('admin.event.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventBtn"><i class="fe-trash-2"></i></a>
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
    // Update event 
    public function updateEvent(Request $request)
    {


        if ($request->class) {
            $class = implode(",", $request->class);
        } else {
            $class = "";
        }
        if ($request->group) {
            $group = implode(",", $request->group);
        } else {
            $group = "";
        }

        $data = [
            'id' => $request->id,
            'title' => $request->title,
            'type' => $request->type,
            'audience' => $request->audience,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'event_class' => $class,
            'class' => $request->class,
            'event_group' => $group,
            'group' => $request->group,
            'section' => $request->section,
            'all_day' => $request->all_day,
            'holiday' => $request->holiday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description
        ];
        $response = Helper::PostMethod(config('constants.api.event_update'), $data);
        return $response;
    }
    // DELETE event 
    public function deleteEvent(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.event_delete'), $data);
        return $response;
    }

    // publish event
    public function publishEvent(Request $request)
    {
        $data = [
            'id' => $request->id,
            'status' => $request->status
        ];
        $response = Helper::PostMethod(config('constants.api.event_publish'), $data);
        return $response;
    }

    public function admission()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettransport = Helper::GetMethod(config('constants.api.transport_route_list'));
        $gethostel = Helper::GetMethod(config('constants.api.hostel_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $parent = Helper::GetMethod(config('constants.api.parent_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));

        // dd($gethostel);
        return view(
            'admin.admission.index',
            [
                'class' => $getclass['data'],
                'transport' => $gettransport['data'],
                'hostel' => $gethostel['data'],
                'session' => $session['data'],
                'semester' => $semester['data'],
                'parent' => $parent['data'],
                'religion' => $religion['data'],
                'races' => $races['data'],
                'relation' => $relation['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
        // return view('admin.admission.index');
    }

    public function import()
    {
        return view('admin.admission.import');
    }

    public function parent()
    {
        return view('admin.parent.index');
    }

    public function employee()
    {
        return view('admin.employee.index');
    }

    public function homework()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        return view(
            'admin.homework.index',
            [
                'class' => $getclass['data'],
                'session' => $session['data'],
                'semester' => $semester['data'],
            ]
        );
    }


    // get department
    public function department()
    {
        // echo "nsdds";exit;
        return view('admin.department.index');
    }

    // get Designation 
    public function Designation()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view(
            'admin.designation.index',
            [
                'branches' => $getBranches['data']
            ]
        );
    }

    //add Designation
    public function addDesignation(Request $request)
    {

        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.designation_add'), $data);
        return $response;
    }
    // get Designation 
    public function getDesignationList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.designation_list'));

        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editDesignationBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteDesignationBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get designation row details
    public function getDesignationDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.designation_details'), $data);
        return $response;
    }
    // update designation
    public function updateDesignation(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.designation_update'), $data);
        return $response;
    }

    // delete designation
    public function deleteDesignation(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.designation_delete'), $data);
            return $response;
        }
    }

    // get Category
    public function getCategory()
    {
        return view('admin.hostel.category');
    }

    // get Branch
    public function branch()
    {
        return view('admin.branch.index');
    }

    // index hostel
    public function hostel()
    {
        $getcategory = Helper::GetMethod(config('constants.api.hostel_category_list'));

        $getEmployee = Helper::GetMethod(config('constants.api.employee_list'), []);
        // dd($getEmployee);
        return view(
            'admin.hostel.index',
            [
                'category' => $getcategory['data'],
                'warden' => !empty($getEmployee) ? $getEmployee['data'] : $getEmployee,
            ]
        );
    }

    public function addHostel(Request $request)
    {
        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'watchman' => $request->watchman,
            'address' => $request->address,
            'remarks' => $request->remarks
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_add'), $data);
        return $response;
    }
    public function getHostelList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHostelBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_details'), $data);
        return $response;
    }
    public function updateHostel(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'category' => $request->category,
            'watchman' => $request->watchman,
            'address' => $request->address,
            'remarks' => $request->remarks
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_update'), $data);
        return $response;
    }
    // DELETE hostel Details
    public function deleteHostel(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_delete'), $data);
        return $response;
    }

    // index Hostel Room
    public function hostelRoom()
    {
        $block = Helper::GetMethod(config('constants.api.hostel_block_list'));
        $hostel = Helper::GetMethod(config('constants.api.hostel_list'));
        return view('admin.hostel_room.index', [
            'hostel' => $hostel['data'],
            'block' => $block['data']
        ]);
    }
    public function addHostelRoom(Request $request)
    {
        $data = [
            'name' => $request->name,
            'hostel_id' => $request->hostel_id,
            'no_of_beds' => $request->no_of_beds,
            'block' => $request->block,
            'floor' => $request->floor,
            'bed_fee' => $request->bed_fee,
            'remarks' => $request->remarks
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_room_add'), $data);
        return $response;
    }
    public function getHostelRoomList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_room_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHostelRoomBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelRoomBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelRoomDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_room_details'), $data);
        return $response;
    }
    public function updateHostelRoom(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'hostel_id' => $request->hostel_id,
            'no_of_beds' => $request->no_of_beds,
            'block' => $request->block,
            'floor' => $request->floor,
            'bed_fee' => $request->bed_fee,
            'remarks' => $request->remarks
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_room_update'), $data);
        return $response;
    }
    // DELETE hostel Details
    public function deleteHostelRoom(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_room_delete'), $data);
        return $response;
    }

    // index Hostel Category
    public function hostelCategory()
    {
        return view('admin.hostel_category.index');
    }

    public function addHostelCategory(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_category_add'), $data);
        return $response;
    }
    public function getHostelCategoryList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_category_list'));

        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHostelCategoryBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelCategoryBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelCategoryDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_category_details'), $data);
        return $response;
    }
    public function updateHostelCategory(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_category_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteHostelCategory(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_category_delete'), $data);
        return $response;
    }

    public function book()
    {
        return view('admin.library.book');
    }
    public function bookCategory()
    {
        return view('admin.library.book_category');
    }
    public function issuedBook()
    {
        return view('admin.library.issued_book');
    }
    public function issueReturn()
    {
        return view('admin.library.issue_return');
    }
    // exam routes
    public function examIndex()
    {
        return view('admin.exam_term.index');
    }
    public function examMarkDistribution()
    {
        return view('admin.exam_mark_distribution.index');
    }
    // public function exam()
    // {
    //     return view('admin.exam.index');
    // }
    // get Employee
    public function listEmployee()
    {
        return view('admin.employee.list');
    }
    //add employee
    public function addEmployee(Request $request)
    {
        $status = "1";
        if (isset($request->status) &&  $request->status == "undefined") {
            $status = "0";
        }

        $file = $request->file('photo');

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
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            // 'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'short_name' => $request->short_name,
            'employment_status' => $request->employment_status,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'birthday' => $request->birthday,
            'mobile_no' => $request->mobile_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'photo' => $base64,
            'file_extension' => $extension,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'skip_bank_details' => $request->skip_bank_details,
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'status' => $status,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'ifsc_code' => $request->ifsc_code,
            'account_no' => $request->account_no,
            'salary_grade' => $request->salary_grade,
            'staff_position' => $request->staff_position,
            'staff_category' => $request->staff_category,
            'nric_number' => $request->nric_number,
            'passport' => $request->passport,
            'staff_qualification_id' => $request->staff_qualification_id,
            'stream_type_id' => $request->stream_type_id,
            'race' => $request->race,
            'skip_medical_history' => $request->skip_medical_history,
            'height' => $request->height,
            'weight' => $request->weight,
            'allergy' => $request->allergy,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'post_code' => $request->post_code

        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.employee_add'), $data);
        return $response;
    }


    // get Employee 
    public function getEmpList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.employee_list'));

        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                <a href="' . route('admin.employee.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEmployeeBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // edit Employee row details
    public function editEmployee(Request $request, $id)
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));

        $data = [
            'status' => 1
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        //    dd($roles);
        $res = [
            'id' => $id,
        ];
        $department = Helper::PostMethod(config('constants.api.emp_department'), []);
        $designation = Helper::PostMethod(config('constants.api.emp_designation'), []);
        $staff = Helper::PostMethod(config('constants.api.employee_details'), $res);
        $qualifications = Helper::GetMethod(config('constants.api.get_qualifications'));
        $staff_categories = Helper::GetMethod(config('constants.api.staff_categories'));
        $staff_positions = Helper::GetMethod(config('constants.api.staff_positions'));
        $stream_types = Helper::GetMethod(config('constants.api.stream_types'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        // dd($staff['data']['user']);
        return view(
            'admin.employee.edit',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
                'employee' => $staff['data']['staff'],
                'bank' => $staff['data']['bank'],
                'department' => $department['data'],
                'designation' => $designation['data'],
                'role' => $staff['data']['user'],
                'qualifications' => $qualifications['data'],
                'staff_categories' => $staff_categories['data'],
                'staff_positions' => $staff_positions['data'],
                'stream_types' => $stream_types['data'],
                'religion' => $religion['data'],
                'races' => $races['data'],
            ]
        );
    }

    // show employee
    public function showEmployee()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));

        $data = [
            'status' => "0"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $emp_department = Helper::PostMethod(config('constants.api.emp_department'), []);
        $emp_designation = Helper::PostMethod(config('constants.api.emp_designation'), []);
        $qualifications = Helper::GetMethod(config('constants.api.get_qualifications'));
        $staff_categories = Helper::GetMethod(config('constants.api.staff_categories'));
        $staff_positions = Helper::GetMethod(config('constants.api.staff_positions'));
        $stream_types = Helper::GetMethod(config('constants.api.stream_types'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        return view(
            'admin.employee.index',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
                'emp_department' => !empty($emp_department) ? $emp_department['data'] : $emp_department,
                'emp_designation' => !empty($emp_designation) ? $emp_designation['data'] : $emp_designation,
                'qualifications' => $qualifications['data'],
                'staff_categories' => $staff_categories['data'],
                'staff_positions' => $staff_positions['data'],
                'stream_types' => $stream_types['data'],
                'religion' => $religion['data'],
                'races' => $races['data'],
            ]
        );
    }
    // update Employee
    public function updateEmployee(Request $request)
    {
        $status = "1";
        if (isset($request->status) &&  $request->status == "undefined") {
            $status = "0";
        }

        $file = $request->file('photo');

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
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            // 'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'short_name' => $request->short_name,
            'employment_status' => $request->employment_status,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'birthday' => $request->birthday,
            'mobile_no' => $request->mobile_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'photo' => $base64,
            'status' => $status,
            'file_extension' => $extension,
            'email' => $request->email,
            'password' => $request->password,
            'role_user_id' => $request->role_user_id,
            'skip_bank_details' => $request->skip_bank_details,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'ifsc_code' => $request->ifsc_code,
            'account_no' => $request->account_no,
            'salary_grade' => $request->salary_grade,
            'staff_position' => $request->staff_position,
            'staff_category' => $request->staff_category,
            'nric_number' => $request->nric_number,
            'passport' => $request->passport,
            'staff_qualification_id' => $request->staff_qualification_id,
            'stream_type_id' => $request->stream_type_id,
            'race' => $request->race,
            'skip_medical_history' => $request->skip_medical_history,
            'old_photo' => $request->old_photo,
            'height' => $request->height,
            'weight' => $request->weight,
            'allergy' => $request->allergy,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'post_code' => $request->post_code
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.employee_update'), $data);
        return $response;
    }

    // delete Employee
    public function deleteEmployee(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.employee_delete'), $data);
            return $response;
        }
    }

    // subject by Class
    public function subjectByClass(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $subject = Helper::PostMethod(config('constants.api.subject_by_class'), $data);
        return $subject;
    }

    // Section by Class
    public function sectionByClass(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,

        ];
        $section = Helper::PostMethod(config('constants.api.section_by_class'), $data);
        return $section;
    }
    public function examByClassSec(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,

        ];
        $section = Helper::PostMethod(config('constants.api.exam_by_classSection'), $data);
        return $section;
    }

    // get subject and Teacher
    public function getSubject(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'day' => $request->day,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $timetable = Helper::PostMethod(config('constants.api.timetable_subject'), $data);
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        if ($timetable['code'] == "200") {


            $response = "";
            if ($timetable['data']['timetable']) {

                $row = 0;
                foreach ($timetable['data']['timetable'] as $table) {

                    $subject = "";
                    foreach ($timetable['data']['subject'] as $sub) {
                        if ($sub['id'] == $table['subject_id']) {
                            $subject .= '<option value="' . $sub['id'] . '" Selected >' . $sub['name'] . '</option>';
                        } else {
                            $subject .= '<option value="' . $sub['id'] . '"  >' . $sub['name'] . '</option>';
                        }
                    }
                    $teacher = "";
                    $bulk = "";
                    if ($table['bulk_id']) {

                        $bulk = "disabled";

                        $all = "";
                        foreach (explode(',', $table['teacher_id']) as $info) {
                            if ($info == "0") {
                                $all =  "Selected";
                            }
                        }
                        $teacher .= '<option value="0" ' . $all . '> All </option>';
                    }

                    $checked = "";
                    if ($table['break'] == "1") {
                        $checked = "checked";
                    }

                    foreach ($timetable['data']['teacher'] as $teach) {
                        $selected = "";
                        foreach (explode(',', $table['teacher_id']) as $info) {
                            if ($teach['id'] == $info) {
                                $selected = "Selected";
                            }
                            $teacher .= '<option value="' . $teach['id'] . '"   ' . $selected . '>' . $teach['name'] . '</option>';
                        }
                    }
                    // dd($table);
                    $response .=  '<tr class="iadd">';
                    $response .=  '<input type="hidden"  name="timetable[' . $row . '][id]" value="' . $table['id'] . '" ' . $bulk . '>';
                    $response .=  '<td>';
                    $response .=  '<div class="checkbox-replace">';
                    $response .=  '<label class="i-checks">';
                    $response .=  '<input type="checkbox"  name="timetable[' . $row . '][break]" ' . $checked . ' ' . $bulk . ' ><i></i>';
                    $response .=  '</label>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%">';
                    $response .=  '<div class="form-group">';
                    if (isset($table['break_type'])) {
                        $response .=  '<select class="form-control subject subByTeacher" data-id="' . $row . '" name="timetable[' . $row . '][subject]" disabled hidden="hidden" ' . $bulk . '>';
                        $response .=  '<option value="">Select Subject</option>';
                        $response .=  $subject;
                        $response .=  '</select>';
                        $response .= '<input class="form-control break_type"  type="text" name="timetable[' . $row . '][break_type]" value="' . (isset($table['break_type']) ? $table['break_type'] : "") . '" ' . $bulk . '></input> ';
                    } else {
                        $response .=  '<select class="form-control subject subByTeacher" data-id="' . $row . '" name="timetable[' . $row . '][subject]" ' . $bulk . '>';
                        $response .=  '<option value="">Select Subject</option>';
                        $response .=  $subject;
                        $response .=  '</select>';
                        $response .= '<input class="form-control break_type"  type="text" name="timetable[' . $row . '][break_type]" value="' . (isset($table['break_type']) ? $table['break_type'] : "") . '" disabled hidden="hidden" ' . $bulk . '></input> ';
                    }

                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%" >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select  class="form-control select2-multiple teacher" id="teacher' . $row . '" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[' . $row . '][teacher][]" ' . $bulk . '>';
                    $response .=  '<option value="">Select Teacher</option>';
                    $response .=  $teacher;
                    $response .=  '</select>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%" >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control time_start_class" required type="time" name="timetable[' . $row . '][time_start]" value="' . $table['time_start'] . '" ' . $bulk . '>';
                    $response .=  '</div></td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control time_end_class" required type="time" name="timetable[' . $row . '][time_end]"  value="' . $table['time_end'] . '" ' . $bulk . '>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select class="form-control class_room"  name="timetable[' . $row . '][class_room]" ' . $bulk . '>';
                    $response .=  '<option value="">Select Hall</option>';
                    foreach ($hall_list['data'] as $list) {
                        if ($list['id'] == $table['class_room']) {
                            $response .= '<option value="' . $list['id'] . '" selected>' . $list['hall_no'] . '</option>';
                        } else {
                            $response .= '<option value="' . $list['id'] . '">' . $list['hall_no'] . '</option>';
                        }
                    }
                    $response .=  '</select>';
                    $response .=  '</div>';
                    // if ($bulk == "") {
                    //     $response .=  '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
                    // }
                    $response .=  '</td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    if ($bulk == "") {
                        $response .=  '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
                    }
                    $response .=  '</div>';

                    $response .=  '</td>';
                    // $response .=  '<td width="20%"> <div class="input-group"><input type="remarks"  name="timetable[' . $row . '][class_room]" value="' . $table['class_room'] . '" class="form-control" ><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></div></td>';

                    $response .=  '</tr>';
                    $row++;
                }
                $timetable['data']['timetable'] = $response;
                $timetable['data']['length'] = $row;
            } else {
                $timetable['data']['timetable'] = $response;
            }
        }

        // dd($timetable);
        return $timetable;
    }

    public function getBulkSubject(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'day' => $request->day,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $timetable = Helper::PostMethod(config('constants.api.timetable_subject_bulk'), $data);
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        if ($timetable['code'] == "200") {


            $response = "";
            if ($timetable['data']['timetable']) {

                $row = 0;
                foreach ($timetable['data']['timetable'] as $table) {

                    $checked = "";
                    if ($table['break'] == "1") {
                        $checked = "checked";
                    }

                    $teacher = "";
                    $all = "";
                    foreach (explode(',', $table['teacher_id']) as $info) {
                        if ($info == "0") {
                            $all =  "Selected";
                        }
                    }
                    $teacher .= '<option value="0" ' . $all . '> All </option>';
                    foreach ($timetable['data']['teacher'] as $teach) {
                        $selected = "";
                        foreach (explode(',', $table['teacher_id']) as $info) {
                            if ($teach['id'] == $info) {
                                $selected = "Selected";
                            }
                            $teacher .= '<option value="' . $teach['id'] . '"   ' . $selected . '>' . $teach['name'] . '</option>';
                        }
                    }
                    $response .=  '<tr class="iadd">';
                    $response .=  '<input type="hidden"  name="timetable[' . $row . '][id]" value="' . $table['id'] . '">';
                    $response .=  '<td>';
                    $response .=  '<div class="checkbox-replace">';
                    $response .=  '<label class="i-checks">';
                    $response .=  '<input type="checkbox"  name="timetable[' . $row . '][break]" ' . $checked . ' ><i></i>';
                    $response .=  '</label>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%">';
                    $response .=  '<div class="form-group">';
                    $response .= '<input class="form-control break_type"  type="text" name="timetable[' . $row . '][break_type]" value="' . (isset($table['break_type']) ? $table['break_type'] : "") . '" ></input> ';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%"  > ';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select  class="form-control select2-multiple teacher" id="teacher' . $row . '" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[' . $row . '][teacher][]">';
                    $response .=  '<option value="">Select Teacher</option>';
                    $response .=  $teacher;
                    $response .=  '</select>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%" >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control" required type="time" name="timetable[' . $row . '][time_start]" value="' . $table['time_start'] . '">';
                    $response .=  '</div></td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control" required type="time" name="timetable[' . $row . '][time_end]"  value="' . $table['time_end'] . '">';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select class="form-control"  name="timetable[' . $row . '][class_room]" >';
                    $response .=  '<option value="">Select Hall</option>';
                    foreach ($hall_list['data'] as $list) {
                        if ($list['id'] == $table['class_room']) {
                            $response .= '<option value="' . $list['id'] . '" selected>' . $list['hall_no'] . '</option>';
                        } else {
                            $response .= '<option value="' . $list['id'] . '">' . $list['hall_no'] . '</option>';
                        }
                    }
                    $response .=  '</select>';
                    $response .=  '</div><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
                    $response .=  '</td>';
                    // $response .=  '<td width="20%"> <div class="input-group"><input type="remarks"  name="timetable[' . $row . '][class_room]" value="' . $table['class_room'] . '" class="form-control" ><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></div></td>';

                    $response .=  '</tr>';
                    $row++;
                }
                $timetable['data']['timetable'] = $response;
                $timetable['data']['length'] = $row;
            } else {
                $timetable['data']['timetable'] = $response;
            }
        }
        // dd($timetable);
        return $timetable;
    }



    // create Timetable
    public function createTimetable(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($semester);
        return view(
            'admin.timetable.add',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'hall_list' => $hall_list['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    // Promotion
    public function Promotion(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        // dd($semester);
        return view(
            'admin.promotion.index',
            [
                'classes' => $getclass['data'],
                'session' => $session['data'],
                'semester' => $semester['data'],
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
    function PromotionAdd(Request $request)
    {
        $data = [
            "promotion" => $request->promotion,
            "promote_year" => $request->promote_year,
            "promote_class_id" => $request->promote_class_id,
            "promote_section_id" => $request->promote_section_id,
            "promote_semester_id" => $request->promote_semester_id,
            "promote_session_id" => $request->promote_session_id,
            "year" => $request->year
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.promotion_add'), $data);
        return $response;
    }
    // add Timetable
    public function addTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'timetable' => $request->timetable,
            'academic_session_id' => session()->get('academic_session_id')

        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.timetable_add'), $data);
        // dd($response);
        return $response;
    }

    // create bulk Timetable
    public function createBulkTimetable(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($semester);
        return view(
            'admin.timetable.bulk_add',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'hall_list' => $hall_list['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    // add Bulk Timetable
    public function addBulkTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'timetable' => $request->timetable,
            'academic_session_id' => session()->get('academic_session_id')

        ];
        $response = Helper::PostMethod(config('constants.api.timetable_add_bulk'), $data);
        return $response;
    }

    // index Timetable
    public function timetable(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'admin.timetable.index',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
            ]
        );
    }
    // copy Timetable
    public function timetableCopy(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'admin.timetable_copy.index',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
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
            'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday'
        );

        if ($timetable['code'] == "200") {
            $max = $timetable['data']['max'];

            $response = "";
            $response .= '<tr><td class="center" style="color:#ed1833;">Day/Period</td>';
            for ($i = 1; $i <= $max; $i++) {
                $response .= '<td class="centre">' . $i . '</td>';
            }
            $response .= '</tr>';
            foreach ($days as $day) {

                if (!isset($timetable['data']['week'][$day]) && ($day == "saturday" || $day == "sunday")) {
                } else {

                    $response .= '<tr><td class="center" style="color:#ed1833;">' . strtoupper($day) . '</td>';
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

    // edit Timetable
    public function editTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $timetable = Helper::PostMethod(config('constants.api.timetable_edit'), $data);
        // 
        // dd($timetable);
        if ($timetable['code'] == "200") {
            return view(
                'admin.timetable.edit',
                [
                    'timetable' => $timetable['data']['timetable'],
                    'details' => $timetable['data']['details'],
                    'teacher' => $timetable['data']['teacher'],
                    'subject' => $timetable['data']['subject'],
                    'hall_list' => $timetable['data']['exam_hall']
                ]
            );
        } else {
            return view(
                'admin.timetable.edit',
                [
                    'timetable' => NULL
                ]
            );
        }
    }
    // edit Timetable copy
    public function editTimetableCopy(Request $request)
    {
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $timetable = Helper::PostMethod(config('constants.api.timetable_edit'), $data);
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // dd($timetable);
        if ($timetable['code'] == "200") {
            return view(
                'admin.timetable_copy.edit',
                [
                    'timetable' => $timetable['data']['timetable'],
                    'details' => $timetable['data']['details'],
                    'teacher' => $timetable['data']['teacher'],
                    'subject' => $timetable['data']['subject'],
                    'hall_list' => $timetable['data']['exam_hall'],
                    'semester' => $semester['data'],
                    'session' => $session['data'],
                    'academic_year_list' => $academic_year_list['data'],
                    'classnames' => $getclass['data']
                ]
            );
        } else {
            return view(
                'admin.timetable.edit',
                [
                    'timetable' => NULL,
                    'semester' => $semester['data'],
                    'session' => $session['data'],
                    'academic_year_list' => $academic_year_list['data'],
                    'classnames' => $getclass['data']
                ]
            );
        }
    }
    public function updateTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'timetable' => $request->timetable,
            'academic_session_id' => session()->get('academic_session_id')

        ];
        // dd($data);
        $timetable = Helper::PostMethod(config('constants.api.timetable_update'), $data);

        return $timetable;
    }
    public function timetableCopySave(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'timetable' => $request->timetable,
            'academic_session_id' => $request->year

        ];
        // dd($data);
        $timetable = Helper::PostMethod(config('constants.api.timetable_copy'), $data);
        return $timetable;
    }
    public function studentEntry()
    {
        return view('admin.attendance.student');
    }
    public function employeeEntry()
    {

        $getdepartment = Helper::GetMethod(config('constants.api.department_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'admin.attendance.employee',
            [
                'department' => $getdepartment['data'],
                'session' => $session['data']
            ]
        );
    }
    public function examEntry()
    {
        return view('admin.attendance.exam');
    }
    public function studentIndex()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'admin.student.student',
            [
                'classes' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
            ]
        );
    }
    public function faqIndex()
    {
        return view('admin.faq.index');
    }
    public function taskIndex()
    {

        $allocate_section_list = Helper::GetMethod(config('constants.api.allocate_section_list'));
        return view(
            'admin.task.index',
            [
                'allocate_section_list' => $allocate_section_list['data'],
            ]
        );
    }
    public function studentLeaveShow()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        return view('admin.student_leave.index', [
            'classes' => $getclass['data']
        ]);
    }
    // public function getStudentLeaveList(Request $request)
    // {
    //     $data = [
    //         'class_id' => $request->class_id,
    //         'section_id' => $request->section_id
    //     ];
    //     // dd($data);
    //     $response = Helper::PostMethod(config('constants.api.get_all_student_leaves'), $data);
    //     return DataTables::of($response['data'])
    //         ->addIndexColumn()
    //         // ->addColumn('actions', function ($row) {
    //         //     return '<div class="button-list">
    //         //                     <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteToDoListBtn">Delete</a>
    //         //             </div>';
    //         // })

    //         // ->rawColumns(['actions'])
    //         ->make(true);
    // }
    //add todolist
    public function addToDoList(Request $request)
    {
        // $created_by = session()->get('user_id');

        // $file = $request->file('file');
        // $path = $file->path();
        // $data = file_get_contents($path);
        // $base64 = base64_encode($data);
        // $extension = $file->getClientOriginalExtension();
        $files = [];
        if ($request->hasfile('file')) {
            foreach ($request->file('file') as $file) {

                $object = new \stdClass();
                $path = $file->path();
                $data = file_get_contents($path);
                $base64 = base64_encode($data);
                $extension = $file->getClientOriginalExtension();

                $object->extension = $extension;
                $object->base64 = $base64;
                array_push($files, $object);
            }
        }
        // print_r($files);
        // exit;
        $data = [
            'title' => $request->title,
            'due_date' => $request->due_date,
            'assign_to' => $request->assign_to,
            'priority' => $request->priority,
            'check_list' => $request->check_list,
            'task_description' => $request->task_description,
            'file' => $files,
        ];

        $response = Helper::PostMethod(config('constants.api.add_to_do_list'), $data);
        // // dd($response);
        return $response;
    }
    public function getToDoList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.get_to_do_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteToDoListBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function evaluationReport()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        return view(
            'admin.homework.evaluation_report',
            [
                'class' => $getclass['data'],
                'session' => $session['data'],
                'semester' => $semester['data'],
            ]
        );
    }
    //add Homework
    public function addHomework(Request $request)
    {


        $file = $request->file('file');
        $path = $file->path();
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        $extension = $file->getClientOriginalExtension();

        $created_by = session()->get('user_id');
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
                                    <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-homework_id="' . $work['id'] . '" data-target=".firstModal"><i class="fas fa-bars"></i> <span style="color: white">Details</span></a></td>
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

        // dd($homework);
        return $homework;
    }
    // view Homework
    public function viewHomework(Request $request)
    {
        $data = [
            'homework_id' => $request->homework_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $homework = Helper::PostMethod(config('constants.api.homework_view'), $data);
        // dd($homework);

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
                        $status = '<button type="button" class="btn btn-success btn-rounded waves-effect waves-light" style="border:none;">Completed</button>';
                        $complete++;
                    } else {
                        $status = '<button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" style="border:none;">Incomplete</button>';
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
										<input type="text" class="form-control" name="homework[' . $row . '][teacher_remarks]"  value="' . $work['teacher_remarks'] . '" aria-describedby="inputGroupPrepend" ></td>
                                    </div>
									</div>
									</div>
									<td>
                                        <i data-feather="file-text" class="icon-dual"></i>
                                        <span class="ml-2 font-weight-semibold"><a  href="' . asset('public/student/homework/') . '/' . $work['file'] . '" download class="text-reset">' . $work['file'] . '</a></span>
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
        return view('admin.homework.edit');
    }
    public function addDepartment(Request $request)
    {
        $data = [
            'name' => $request->department_name
        ];
        $response = Helper::PostMethod(config('constants.api.department_add'), $data);
        return $response;
    }
    public function getDepartmentList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.department_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editDepartmentBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteDepartmentBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getDepartmentDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.department_details'), $data);
        return $response;
    }
    public function updateDepartment(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.department_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteDepartment(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.department_delete'), $data);
        return $response;
    }
    // Qualifications
    public function qualification_view()
    {
        //dd('resp');
        return view('admin.qualifications.index');
    }
    public function getqualification_list()
    {
        $response = Helper::GetMethod(config('constants.api.qualification_list'));

        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editqualifyBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deletequalifyBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function qualification_add(Request $request)
    {
        $data = [
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.qualification_add'), $data);

        return $response;
    }
    public function qualification_update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.qualifications_update'), $data);
        return $response;
    }
    public function qualification_delete(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.qualifications_delete'), $data);
            return $response;
        }
    }
    public function getQualificationsDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.qualifications_details'), $data);
        return $response;
    }
    // staff categoryes
    public function staffcategories_view()
    {
        return view('admin.staffCategories.index');
    }
    public function staffcategories_add(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.staffcategory_add'), $data);

        return $response;
    }
    public function staffcategories_edit(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.staffcategory_update'), $data);
        return $response;
    }
    public function staffcategories_delete(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.staffcategory_delete'), $data);
            return $response;
        }
    }
    public function staffcategories_list()
    {
        $response = Helper::GetMethod(config('constants.api.staffcategory_list'));

        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editstaffcategoryBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deletstaffcategoryBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getstaffcategoriesDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.staffcategory_details'), $data);
        return $response;
    }
    //staff category end 

    // get Exam Term
    public function examTerm()
    {
        // $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        // return 1;
        return view('admin.exam_term.list');
    }

    //add examTerm
    public function addExamTerm(Request $request)
    {

        $data = [
            'name' => $request->name,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.exam_term_add'), $data);
        return $response;
    }
    // get ExamTerm 
    public function getExamTermList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.exam_term_list'), $data);
        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editExamTermBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteExamTermBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get ExamTerm row details
    public function getExamTermDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_term_details'), $data);
        return $response;
    }
    // update ExamTerm
    public function updateExamTerm(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'academic_session_id' => session()->get('academic_session_id')
        ];

        $response = Helper::PostMethod(config('constants.api.exam_term_update'), $data);
        return $response;
    }

    // delete ExamTerm
    public function deleteExamTerm(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.exam_term_delete'), $data);
            return $response;
        }
    }

    // get Exam Hall
    public function examHall()
    {
        return view('admin.exam_hall.list');
    }

    //add examHall
    public function addExamHall(Request $request)
    {

        $data = [
            'hall_no' => $request->hall_no,
            'no_of_seats' => $request->no_of_seats
        ];
        $response = Helper::PostMethod(config('constants.api.exam_hall_add'), $data);
        return $response;
    }
    // get ExamHall 
    public function getExamHallList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.exam_hall_list'));
        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editExamHallBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteExamHallBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get ExamHall row details
    public function getExamHallDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_hall_details'), $data);
        return $response;
    }
    // update ExamHall
    public function updateExamHall(Request $request)
    {

        $data = [
            'id' => $request->id,
            'hall_no' => $request->hall_no,
            'no_of_seats' => $request->no_of_seats
        ];

        $response = Helper::PostMethod(config('constants.api.exam_hall_update'), $data);
        return $response;
    }

    // delete ExamHall
    public function deleteExamHall(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.exam_hall_delete'), $data);
            return $response;
        }
    }

    // get Exam 
    public function exam()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $term = Helper::GETMethodWithData(config('constants.api.exam_term_list'), $data);
        return view('admin.exam.list', ['term' => $term['data']]);
    }

    //add exam
    public function addExam(Request $request)
    {
        $data = [
            'name' => $request->name,
            'term_id' => $request->term_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'remarks' => $request->remarks
        ];
        $response = Helper::PostMethod(config('constants.api.exam_add'), $data);
        return $response;
    }
    // get Exam 
    public function getExamList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.exam_list'), $data);
        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editExamBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteExamBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get Exam row details
    public function getExamDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_details'), $data);
        return $response;
    }
    // update Exam
    public function updateExam(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'term_id' => $request->term_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'remarks' => $request->remarks
        ];

        $response = Helper::PostMethod(config('constants.api.exam_update'), $data);
        return $response;
    }

    // delete Exam
    public function deleteExam(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.exam_delete'), $data);
            return $response;
        }
    }

    public function timeTableViewExam()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'admin.exam_timetable.schedule',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function timeTableSetExamWise()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $getexam = Helper::GETMethodWithData(config('constants.api.exam_list'), $data);

        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));

        return view(
            'admin.exam_timetable.add_schedule',
            [
                'class' => $getclass['data'],
                'exam' => $getexam['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    public function timetableExam(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.exam_timetable_list'), $data);
        // dd($response);

        if ($response['code'] == "200") {
            $output = "";
            $row = 1;
            if ($response['data']) {
                foreach ($response['data'] as $exam) {
                    $output .= '<tr>
                                    <td>' . $row . '</td>
                                    <td>' . $exam['name'] . '</td>
                                    <td>
                                    <div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-toggle="modal" data-target="#examTimeTable" data-exam_id="' . $exam['exam_id'] . '" id=""><i class="fe-eye"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $exam['exam_id'] . '" id="deleteExamTimetableBtn"><i class="fe-trash-2"></i></a>
                                    </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                    <td colspan="3" class="text-center"> No Data Available</td>
                                </tr>';
            }

            $response['table'] = $output;
        }

        // dd($homework);
        return $response;
    }

    public function getExamTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'exam_id' => $request->exam_id,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.exam_timetable_get'), $data);
        $teacher = Helper::PostMethod(config('constants.api.teacher_list'), $data);
        // dd($response);
        // dd($teacher);
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $hall = "";
        if ($response['code'] == "200") {
            $output = "";
            $row = 1;
            if ($response['data']['exam']) {
                foreach ($response['data']['exam'] as $exam) {

                    // dd($exam['hall_id']);
                    // dd($exam['paper_id']);
                    // dd($exam['paper_name']);

                    $hall = "";
                    $dist = "";
                    $dist_type1 = "";
                    $dist_type2 = "";
                    $paperList = "";
                    foreach ($hall_list['data'] as $list) {
                        if ($list['id'] == $exam['hall_id']) {
                            $hall .= '<option value="' . $list['id'] . '" selected>' . $list['hall_no'] . '</option>';
                        } else {
                            $hall .= '<option value="' . $list['id'] . '">' . $list['hall_no'] . '</option>';
                        }
                    }
                    // if (isset($exam['paper_id'])) {
                    //     $paper_ids = explode(',', $exam['paper_id']);
                    //     $paper_names = explode(',', $exam['paper_name']);
                    //     if (!empty($paper_ids)) {
                    //         // timetable_paper_id
                    //         foreach ($paper_ids as $key => $val) {
                    //             if ($val == $exam['timetable_paper_id']) {
                    //                 $paperList .= '<option value="' . $val . '" selected>' . $paper_names[$key] . '</option>';
                    //             } else {
                    //                 $paperList .= '<option value="' . $val . '">' . $paper_names[$key] . '</option>';
                    //             }
                    //         }
                    //     }
                    // }

                    if ($exam['distributor_type'] == "1") {
                        $dist .= ' <select  class="form-control " name="exam[' . $row . '][distributor]">';
                        foreach ($teacher['data'] as $teach) {
                            $dist .= '<option value="">Select Teacher</option>';
                            if ($teach['id'] == $exam['distributor_id']) {
                                $dist .= '<option value="' . $teach['id'] . '" selected>' . $teach['name'] . '</option>';
                            } else {
                                $dist .= '<option value="' . $teach['id'] . '">' . $teach['name'] . '</option>';
                            }
                        }
                        $dist .= ' </select>';
                    } elseif ($exam['distributor_type'] == "2") {
                        $dist .= '<input type="text" name="exam[' . $row . '][distributor]" class="form-control"  value="' . $exam['distributor'] . '" placeholder="Distributor Name">';
                    } else {
                        $dist .= ' <select  class="form-control " name="exam[' . $row . '][distributor]">';
                        $dist .= '<option value="">Select Teacher</option>';
                        foreach ($teacher['data'] as $teach) {
                            $dist .= '<option value="' . $teach['id'] . '">' . $teach['name'] . '</option>';
                        }
                        $dist .= ' </select>';
                    }

                    if ($exam['distributor_type'] == "1") {

                        $dist_type1 = "Selected";
                    } elseif ($exam['distributor_type'] == "2") {

                        $dist_type2 = "Selected";
                    }

                    // dd($dist);
                    $output .= '<tr>
                                    <input type="hidden" value="' . $exam['id'] . '" name="exam[' . $row . '][timetable_exam_id]">
                                    <td>
                                        <div class="input-group mb-2">
                                            <input type="text" readonly class="form-control"  value="' . $exam['subject_name'] . '" >
                                            <input type="hidden" name="exam[' . $row . '][subject_id]"  value="' . $exam['subject_id'] . '" >
                                        </div>
                                    </td>';
                    $output .= '<td>
                                        <div class="input-group mb-2">
                                            <input type="text" readonly class="form-control"  value="' . $exam['paper_name'] . '" >
                                            <input type="hidden" name="exam[' . $row . '][paper_id]"  value="' . $exam['paper_id'] . '" >
                                        </div>
                                    </td>';
                    $output .= '<td >
                                        <div class="form-group mb-2">
                                            <input type="date" class="form-control" name="exam[' . $row . '][exam_date]"  value="' . $exam['exam_date'] . '">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <input type="time" class="form-control" name="exam[' . $row . '][time_start]" value="' . $exam['time_start'] . '">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <input type="time" class="form-control" name="exam[' . $row . '][time_end]"  value="' . $exam['time_end'] . '">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="exam[' . $row . '][hall_id]" placeholder="Select">
                                                        <option value="">Choose Hall</option>' . $hall . '</select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select  class="form-control distributor_type" data-id="' . $row . '" name="exam[' . $row . '][distributor_type]">
                                                        <option value="1" ' . $dist_type1 . '>Internal</option>
                                                        <option value="2" ' . $dist_type2 . '>External</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 distributor">
                                                    ' . $dist . '
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                <td colspan="7" class="text-center"> No Data Available</td>
                            </tr>';
            }

            $response['table'] = $output;
            $response['class_id'] = $request->class_id;
            $response['section_id'] = $request->section_id;
            $response['exam_id'] = $request->exam_id;
            $response['semester_id'] = $request->semester_id;
            $response['session_id'] = $request->session_id;
        }

        // dd($homework);
        return $response;
    }

    public function addExamTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'exam_id' => $request->exam_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'exam' => $request->exam,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_add'), $data);
        return $response;
    }

    public function viewExamTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'exam_id' => $request->exam_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_get'), $data);

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
                                <td colspan="5"> No Data Available</td>
                            </tr>';
            }

            $response['table'] = $output;
            $response['class_section'] = $class_section;
        }

        // dd($response);
        return $response;
    }

    public function deleteExamTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id'),
            'exam_id' => $request->exam_id
        ];

        $response = Helper::PostMethod(config('constants.api.exam_timetable_delete'), $data);
        // dd($response);

        if ($response['code'] == "200") {
            $output = "";
            $row = 1;
            if ($response['data']) {
                foreach ($response['data'] as $exam) {
                    $output .= '<tr>
                                    <td>' . $row . '</td>
                                    <td>' . $exam['name'] . '</td>
                                    <td>
                                    <div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-toggle="modal" data-target="#examTimeTable" data-exam_id="' . $exam['exam_id'] . '" id=""><i class="fe-eye"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $exam['exam_id'] . '" id="deleteExamTimetableBtn"><i class="fe-trash-2"></i></a>
                                    </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                    <td colspan="3" class="text-center"> No Data Available</td>
                                </tr>';
            }

            $response['table'] = $output;
        }

        // dd($homework);
        return $response;
    }

    public function markEntry()
    {
        return view('admin.exam_marks.mark_entry');
    }

    // get grade 
    public function grade()
    {
        $grade_category = Helper::GetMethod(config('constants.api.grade_category'));
        // dd($grade_category);

        return view('admin.grade.index', ['grade_category' => $grade_category['data']]);
    }

    //add Grade
    public function addGrade(Request $request)
    {

        $data = [
            'min_mark' => $request->min_mark,
            'max_mark' => $request->max_mark,
            'grade' => $request->grade,
            'grade_point' => $request->grade_point,
            'grade_category' => $request->grade_category,
            'notes' => $request->notes,
            'status' => $request->status
        ];


        $response = Helper::PostMethod(config('constants.api.grade_add'), $data);
        // dd($response);
        return $response;
    }
    // get Grade 
    public function getGradeList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.grade_list'));

        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editGradeBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteGradeBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get Grade row details
    public function getGradeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.grade_details'), $data);
        return $response;
    }
    // update Grade
    public function updateGrade(Request $request)
    {

        $data = [
            'id' => $request->id,
            'min_mark' => $request->min_mark,
            'max_mark' => $request->max_mark,
            'grade' => $request->grade,
            'grade_point' => $request->grade_point,
            'grade_category' => $request->grade_category,
            'notes' => $request->notes,
            'status' => $request->status
        ];

        $response = Helper::PostMethod(config('constants.api.grade_update'), $data);
        return $response;
    }

    // delete Grade
    public function deleteGrade(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $id
            ];
            $response = Helper::PostMethod(config('constants.api.grade_delete'), $data);
            return $response;
        }
    }

    // get Vehicle By Route
    public function vehicleByRoute(Request $request)
    {
        $data = [
            'route_id' => $request->route_id,

        ];
        $route = Helper::PostMethod(config('constants.api.vehicle_by_route'), $data);

        // dd($route);
        return $route;
    }

    // get Room By Hostel
    public function roomByHostel(Request $request)
    {
        $data = [
            'hostel_id' => $request->hostel_id,

        ];
        $hostel = Helper::PostMethod(config('constants.api.room_by_hostel'), $data);
        return $hostel;
    }


    // add admission
    public function addAdmission(Request $request)
    {
        $status = "0";
        if ($request->status) {
            $status = "1";
        }

        $base64 = "";
        $extension = "";
        $file = $request->file('photo');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }
        $data = [
            'year' => $request->year,
            'register_no' => $request->txt_regiter_no,
            'roll_no' => $request->txt_roll_no,
            'admission_date' => $request->admission_date,
            'category_id' => $request->categy,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'guardian_id' => $request->guardian_id,
            'relation' => $request->relation,
            'status' => $status,
            'passport' => $request->txt_passport,
            'nric' => $request->txt_nric,
            'gender' => $request->gender,
            'blood_group' => $request->blooddgrp,
            'birthday' => $request->dob,
            'religion' => $request->txt_religion,
            'race' => $request->txt_race,
            'country' => $request->drp_country,
            'post_code' => $request->drp_post_code,
            'mobile_no' => $request->txt_mobile_no,
            'city' => $request->drp_city,
            'state' => $request->drp_state,
            'photo' => $base64,
            'file_extension' => $extension,
            'current_address' => $request->txtarea_paddress,
            'permanent_address' => $request->txtarea_permanent_address,
            'email' => $request->txt_emailid,
            'route_id' => $request->drp_transport_route,
            'vehicle_id' => $request->drp_transport_vechicleno,
            'hostel_id' => $request->drp_hostelnam,
            'room_id' => $request->drp_roomname,
            'school_name' => $request->txt_prev_schname,
            'qualification' => $request->txt_prev_qualify,
            'remarks' => $request->txtarea_prev_remarks,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'session_id' => $request->session_id,
            'semester_id' => $request->semester_id,
            'password' => $request->txt_pwd,
            'confirm_password' => $request->txt_retype_pwd,

        ];

        // dd($extension);
        $response = Helper::PostMethod(config('constants.api.admission_add'), $data);
        // dd($response);
        return $response;
    }
    public function byclasss()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.exam_results.byclass',
            [
                'classnames' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
    }
    // exam master -> exam result start
    public function bysubject()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.exam_results.bysubject',
            [
                'classnames' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
    }
    public function bystudent()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.exam_results.bystudent',
            [
                'classnames' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
    }
    public function overall()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $allexams = Helper::PostMethod(config('constants.api.all_exams_list'), $data);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.exam_results.overall',
            [
                'classnames' => $getclass['data'],
                'allexams' => $allexams['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
    }

    public function examResult()
    {
        // data already use this api post so empty var sent
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.exam.result',
            [
                'classnames' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
                'academic_year_list' => $academic_year_list['data']
            ]
        );
    }
    public function testResult()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        //$get_exams = Helper::GetMethod(config('constants.api.get_testresult_exams'));
        // dd($response);
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($sem);
        return view('admin.testresult.index', [
            'classes' => $getclass['data'],
            'semester' => $semester['data'],
            'session' => $session['data'],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
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
            "academic_session_id" => session()->get('academic_session_id')
        ];

        $response = Helper::PostMethod(config('constants.api.add_student_marks'), $data);

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
        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $edit = route('admin.student.details', $row['id']);
                return '<div class="button-list">
                                 <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editStudentBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteStudentBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
        // if ($student['code'] == "200") {

        //     $output = "";
        //     $row = 1;
        //     if ($student['data']) {
        //         foreach ($student['data'] as $stu) {
        //             $edit = route('admin.student.details', $stu['id']);
        //             $output .= '<tr>
        //                             <td>' . $row . '</td>
        //                             <td>' . $stu['first_name'] . ' ' . $stu['last_name'] . '</td>
        //                             <td>' . $stu['register_no'] . '</td>
        //                             <td>' . $stu['roll_no'] . '</td>
        //                             <td>' . $stu['gender'] . '</td>
        //                             <td>' . $stu['email'] . '</td>
        //                             <td>' . $stu['mobile_no'] . '</td>
        //                             <td>
        //                                 <div class="button-list">
        //                                     <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
        //                                     <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $stu['id'] . '" id="deleteStudentBtn"><i class="fe-trash-2"></i></a>
        //                                 </div>
        //                             </td>

        //                         </tr>';
        //             $row++;
        //         }
        //     } else {
        //         $output .= '<tr>
        //                         <td colspan="8"> No Data Available</td>
        //                     </tr>';
        //     }
        //     $student['table'] = $output;
        // }
        // dd($output);  
        // return $student;
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
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));

        $prev = json_decode($student['data']['student']['previous_details']);
        $student['data']['student']['school_name'] = isset($prev->school_name) ? $prev->school_name : "";
        $student['data']['student']['qualification'] = isset($prev->qualification) ? $prev->qualification : "";
        $student['data']['student']['remarks'] = isset($prev->remarks) ? $prev->remarks : "";
        return view(
            'admin.student.edit',
            [
                'class' => $getclass['data'],
                'parent' => $parent['data'],
                'transport' => $gettransport['data'],
                'hostel' => $gethostel['data'],
                'session' => $session['data'],
                'semester' => $semester['data'],
                'student' => $student['data']['student'],
                'section' => $student['data']['section'],
                'vehicle' => $student['data']['vehicle'],
                'room' => $student['data']['room'],
                'religion' => $religion['data'],
                'races' => $races['data'],
                'relation' => $relation['data'],
                'academic_year_list' => $academic_year_list['data']

            ]
        );
    }


    // Update Student 
    public function updateStudent(Request $request)
    {
        $status = "0";
        if ($request->status) {
            $status = "1";
        }

        $base64 = "";
        $extension = "";
        $file = $request->file('photo');
        // dd($file);
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }


        $data = [
            'year' => $request->year,
            'parent_id' => $request->parent_id,
            'student_id' => $request->student_id,
            'old_photo' => $request->old_photo,
            'register_no' => $request->txt_regiter_no,
            'roll_no' => $request->txt_roll_no,
            'passport' => $request->txt_passport,
            'nric' => $request->txt_nric,
            'status' => $status,
            'admission_date' => $request->admission_date,
            'category_id' => $request->categy,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'guardian_id' => $request->guardian_id,
            'relation' => $request->relation,
            'gender' => $request->gender,
            'blood_group' => $request->blooddgrp,
            'birthday' => $request->dob,
            'mother_tongue' => $request->txt_mothertongue,
            'religion' => $request->txt_religion,
            'race' => $request->txt_race,
            'country' => $request->drp_country,
            'post_code' => $request->drp_post_code,
            'mobile_no' => $request->txt_mobile_no,
            'city' => $request->drp_city,
            'state' => $request->drp_state,
            'photo' => $base64,
            'file_extension' => $extension,
            'current_address' => $request->txtarea_paddress,
            'permanent_address' => $request->txtarea_permanent_address,
            'email' => $request->txt_emailid,
            'route_id' => $request->drp_transport_route,
            'vehicle_id' => $request->drp_transport_vechicleno,
            'hostel_id' => $request->drp_hostelnam,
            'room_id' => $request->drp_roomname,
            'school_name' => $request->txt_prev_schname,
            'qualification' => $request->txt_prev_qualify,
            'remarks' => $request->txtarea_prev_remarks,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'session_id' => $request->session_id,
            'semester_id' => $request->semester_id,

            'parent_id' => $request->txt_name,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,

        ];

        $response = Helper::PostMethod(config('constants.api.student_update'), $data);
        return $response;
    }

    // DELETE Student Details
    public function deleteStudent(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $student = Helper::PostMethod(config('constants.api.student_delete'), $data);

        // dd($student);
        if ($student['code'] == "200") {

            $output = "";
            $row = 1;
            if ($student['data']) {
                foreach ($student['data'] as $stu) {

                    $edit = route('admin.student.details', $stu['id']);
                    $output .= '<tr>
                                    <td>' . $row . '</td>
                                    <td>' . $stu['first_name'] . ' ' . $stu['last_name'] . '</td>
                                    <td>' . $stu['register_no'] . '</td>
                                    <td>' . $stu['roll_no'] . '</td>
                                    <td>' . $stu['gender'] . '</td>
                                    <td>' . $stu['email'] . '</td>
                                    <td>' . $stu['mobile_no'] . '</td>
                                    <td>
                                        <div class="button-list">
                                        <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $stu['id'] . '" id="deleteStudentBtn"><i class="fe-trash-2"></i></a>
                                        </div>
                                    </td>

                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                <td colspan="7"> No Data Available</td>
                            </tr>';
            }
            $student['table'] = $output;
        }
        return $student;
    }

    public function createParent()
    {

        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));

        return view(
            'admin.parent.add',
            [
                'religion' => $religion['data'],
                'races' => $races['data'],
                'education' => $education['data'],
            ]
        );
    }

    public function addParent(Request $request)
    {

        $status = "0";
        if ($request->status) {
            $status = "1";
        }

        $base64 = "";
        $extension = "";
        $file = $request->file('photo');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'passport' => $request->passport,
            'race' => $request->race,
            'religion' => $request->religion,
            'nric' => $request->nric,
            'status' => $status,
            'blood_group' => $request->blood_group,
            'occupation' => $request->occupation,
            'income' => $request->income,
            'education' => $request->education,
            'country' => $request->country,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'photo' => $base64,
            'file_extension' => $extension,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'twitter_url' => $request->twitter_url,
        ];
        $response = Helper::PostMethod(config('constants.api.parent_add'), $data);
        // dd($response);
        return $response;
    }
    public function getParentList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.parent_list'));
        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $edit = route('admin.parent.details', $row['id']);
                return '<div class="button-list">
                
                            <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" ="editParentBtn"><i class="fe-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteParentBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getParentDetails($id)
    {
        $data = [
            'id' => $id,
        ];
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $response = Helper::PostMethod(config('constants.api.parent_details'), $data);

        return view(
            'admin.parent.edit',
            [
                'religion' => $religion['data'],
                'races' => $races['data'],
                'education' => $education['data'],
                'parent' => $response['data']['parent'],
                'childs' => $response['data']['childs'],
            ]
        );
    }
    public function updateParent(Request $request)
    {
        // dd($request);
        $status = "0";
        if ($request->status) {
            $status = "1";
        }

        $base64 = "";
        $extension = "";
        $file = $request->file('photo');

        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }

        $data = [

            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'passport' => $request->passport,
            'race' => $request->race,
            'religion' => $request->religion,
            'nric' => $request->nric,
            'status' => $status,
            'blood_group' => $request->blood_group,
            'occupation' => $request->occupation,
            'income' => $request->income,
            'education' => $request->education,
            'country' => $request->country,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'old_photo' => $request->old_photo,
            'photo' => $base64,
            'file_extension' => $extension,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'twitter_url' => $request->twitter_url,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.parent_update'), $data);
        return $response;
    }
    // DELETE Parent Details
    public function deleteParent(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.parent_delete'), $data);
        return $response;
    }

    // index staff Position
    public function staffPosition()
    {
        return view('admin.staff_position.index');
    }

    public function addStaffPosition(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.staff_position_add'), $data);
        return $response;
    }
    public function getStaffPositionList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.staff_position_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editStaffPositionBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteStaffPositionBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getStaffPositionDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.staff_position_details'), $data);
        return $response;
    }
    public function updateStaffPosition(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.staff_position_update'), $data);
        return $response;
    }
    // DELETE staff position Details
    public function deleteStaffPosition(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.staff_position_delete'), $data);
        return $response;
    }

    // index Stream Type
    public function streamType()
    {
        return view('admin.stream_type.index');
    }

    public function addStreamType(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.stream_type_add'), $data);
        return $response;
    }
    public function getStreamTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.stream_type_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editStreamTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteStreamTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getStreamTypeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.stream_type_details'), $data);
        return $response;
    }
    public function updateStreamType(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.stream_type_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteStreamType(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.stream_type_delete'), $data);
        return $response;
    }

    // index religion
    public function religion()
    {
        return view('admin.religion.index');
    }

    public function addReligion(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.religion_add'), $data);
        return $response;
    }
    public function getReligionList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.religion_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editReligionBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteReligionBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getReligionDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.religion_details'), $data);
        return $response;
    }
    public function updateReligion(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.religion_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteReligion(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.religion_delete'), $data);
        return $response;
    }

    // index race
    public function race()
    {
        return view('admin.race.index');
    }

    public function addRace(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.race_add'), $data);
        return $response;
    }
    public function getRaceList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.race_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editRaceBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteRaceBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getRaceDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.race_details'), $data);
        return $response;
    }
    public function updateRace(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.race_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteRace(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.race_delete'), $data);
        return $response;
    }

    // index Leave Type
    public function leaveType()
    {
        return view('admin.leave_type.index');
    }

    public function addLeaveType(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.leave_type_add'), $data);
        return $response;
    }
    public function getLeaveTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.leave_type_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editLeaveTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteLeaveTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getLeaveTypeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.leave_type_details'), $data);
        return $response;
    }
    public function updateLeaveType(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.leave_type_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteLeaveType(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.leave_type_delete'), $data);
        return $response;
    }

    // index Transport Route
    public function transportRoute()
    {
        return view('admin.transport_route.index');
    }

    public function addTransportRoute(Request $request)
    {
        $data = [
            'name' => $request->name,
            'start_place' => $request->start_place,
            'stop_place' => $request->stop_place,
            'remarks' => $request->remarks
        ];
        $response = Helper::PostMethod(config('constants.api.transport_route_add'), $data);
        return $response;
    }
    public function getTransportRouteList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.transport_route_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editTransportRouteBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTransportRouteBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getTransportRouteDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_route_details'), $data);
        return $response;
    }
    public function updateTransportRoute(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'start_place' => $request->start_place,
            'stop_place' => $request->stop_place,
            'remarks' => $request->remarks
        ];

        $response = Helper::PostMethod(config('constants.api.transport_route_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteTransportRoute(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.transport_route_delete'), $data);
        return $response;
    }
    // LEAVE MANAGEMENT START
    // public function applyleave()
    // {
    //     return view('admin.leave_management.applyleave');
    // }
    public function applyleave()
    {
        $get_leave_types = Helper::GetMethod(config('constants.api.get_leave_types'));
        $get_leave_reasons = Helper::GetMethod(config('constants.api.get_leave_reasons'));
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $leave_taken_history = Helper::PostMethod(config('constants.api.leave_taken_history'), $data);
        // dd($leave_taken_history);
        return view('admin.leave_management.applyleave', [
            'get_leave_types' => $get_leave_types['data'],
            'get_leave_reasons' => $get_leave_reasons['data'],
            'leave_taken_history' => $leave_taken_history['data'],
        ]);
    }
    public function approvalleave()
    {
        return view('admin.leave_management.approvalleave');
    }

    public function allleaves()
    {
        return view('admin.leave_management.allleaves');
    }
    public function getAllLeaveList(Request $request)
    {
        $staff_data = [
            'leave_status' => $request->leave_status
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_history'), $staff_data);
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
    public function getAllLeaveReliefAssignment(Request $request)
    {
        $staff_data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.get_all_leave_relief_assignment'), $staff_data);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-staff_id="' . $row['staff_id'] . '" 
                                    data-from_date="' . $row['from_leave'] . '" data-to_date="' . $row['to_leave'] . '" id="reliefAssign">Relief Assign</a>
                            </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
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
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile">Upload</i></a>
            </div>';
                } else {
                    return '-';
                }
            })

            ->rawColumns(['actions'])
            ->make(true);
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
    public function assignLeaveApprover()
    {
        $get_all_staff_details = Helper::GetMethod(config('constants.api.get_all_staff_details'));
        return view('admin.leave_management.assign_leave_approval', [
            'get_all_staff_details' => $get_all_staff_details['data']
        ]);
    }
    public function reliefAssignment()
    {
        $get_all_staff_details = Helper::GetMethod(config('constants.api.get_all_staff_details'));
        return view('admin.leave_management.relief_assignment', [
            'get_all_staff_details' => $get_all_staff_details['data']
        ]);
    }
    // public function getAllStaffDetails(Request $request)
    // {
    //     $response = Helper::GetMethod(config('constants.api.get_all_staff_details'));
    //     return DataTables::of($response['data'])
    //         ->addIndexColumn()
    //         ->addColumn('actions', function ($row) {
    //             return '<div class="button-list">
    //                             <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editClassBtn">Update</a>
    //                     </div>';
    //         })
    //         ->rawColumns(['actions'])
    //         ->make(true);
    // }

    // get Employee Attendance List
    public function getEmployeeAttendanceList(Request $request)
    {
        $data = [
            'department' => $request->department,
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

        $session = Helper::GetMethod(config('constants.api.session'));
        $getdepartment = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.attendance.employee_report',
            [
                'department' => $getdepartment['data'],
                'session' => $session['data']
            ]
        );
    }

    // index Education
    public function education()
    {
        return view('admin.education.index');
    }

    public function addEducation(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.education_add'), $data);
        return $response;
    }
    public function getEducationList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.education_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEducationBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEducationBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getEducationDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.education_details'), $data);
        return $response;
    }
    public function updateEducation(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.education_update'), $data);
        return $response;
    }
    // DELETE education Details
    public function deleteEducation(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.education_delete'), $data);
        return $response;
    }
    public function classroomManagement()
    {
        $response = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view('admin.classroom.management', [
            'class' => $response['data'],
            'semester' => $semester['data'],
            'session' => $session['data'],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
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

    // index Transport Vehicle
    public function transportVehicle()
    {
        return view('admin.transport_vehicle.index');
    }

    public function addTransportVehicle(Request $request)
    {
        $data = [
            'vehicle_no' => $request->vehicle_no,
            'capacity' => $request->capacity,
            'insurance_renewal' => $request->insurance_renewal,
            'driver_phone' => $request->driver_phone,
            'driver_name' => $request->driver_name,
            'driver_license' => $request->driver_license,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_vehicle_add'), $data);
        return $response;
    }
    public function getTransportVehicleList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.transport_vehicle_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editTransportVehicleBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTransportVehicleBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getTransportVehicleDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_vehicle_details'), $data);
        return $response;
    }
    public function updateTransportVehicle(Request $request)
    {
        $data = [
            "id" => $request->id,
            'vehicle_no' => $request->vehicle_no,
            'capacity' => $request->capacity,
            'insurance_renewal' => $request->insurance_renewal,
            'driver_phone' => $request->driver_phone,
            'driver_name' => $request->driver_name,
            'driver_license' => $request->driver_license,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.transport_vehicle_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteTransportVehicle(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.transport_vehicle_delete'), $data);
        return $response;
    }

    // index Transport Stoppage
    public function transportStoppage()
    {
        return view('admin.transport_stoppage.index');
    }

    public function addTransportStoppage(Request $request)
    {
        $data = [
            'stop_position' => $request->stop_position,
            'stop_time' => $request->stop_time,
            'route_fare' => $request->route_fare,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_stoppage_add'), $data);
        return $response;
    }
    public function getTransportStoppageList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.transport_stoppage_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editTransportStoppageBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTransportStoppageBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getTransportStoppageDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_stoppage_details'), $data);
        return $response;
    }
    public function updateTransportStoppage(Request $request)
    {
        $data = [
            "id" => $request->id,
            'stop_position' => $request->stop_position,
            'stop_time' => $request->stop_time,
            'route_fare' => $request->route_fare,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.transport_stoppage_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteTransportStoppage(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.transport_stoppage_delete'), $data);
        return $response;
    }

    // index Transport Assign
    public function transportAssign()
    {
        $vehicle = Helper::GetMethod(config('constants.api.transport_vehicle_list'));
        $route = Helper::GetMethod(config('constants.api.transport_route_list'));
        $stoppage = Helper::GetMethod(config('constants.api.transport_stoppage_list'));

        return view(
            'admin.transport_assign.index',
            [
                'vehicle' => $vehicle['data'],
                'route' => $route['data'],
                'stoppage' => $stoppage['data'],
            ]
        );
    }

    public function addTransportAssign(Request $request)
    {
        $data = [
            'route_id' => $request->route_id,
            'stoppage_id' => $request->stoppage_id,
            'vehicle_id' => $request->vehicle_id,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_assign_add'), $data);
        return $response;
    }
    public function getTransportAssignList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.transport_assign_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editTransportAssignBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTransportAssignBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getTransportAssignDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.transport_assign_details'), $data);
        return $response;
    }
    public function updateTransportAssign(Request $request)
    {
        $data = [
            "id" => $request->id,
            'route_id' => $request->route_id,
            'stoppage_id' => $request->stoppage_id,
            'vehicle_id' => $request->vehicle_id,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.transport_assign_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteTransportAssign(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.transport_assign_delete'), $data);
        return $response;
    }

    // index Hostel Block
    public function hostelBlock()
    {
        $getEmployee = Helper::GetMethod(config('constants.api.employee_list'), []);

        $student = Helper::PostMethod(config('constants.api.student_list'), []);
        // dd($getEmployee);
        return view(
            'admin.hostel_block.index',
            [
                'warden' => !empty($getEmployee) ? $getEmployee['data'] : $getEmployee,
                'leader' => !empty($student) ? $student['data'] : $student,
            ]
        );
    }

    public function addHostelBlock(Request $request)
    {
        $data = [
            'block_name' => $request->block_name,
            'block_warden' => $request->block_warden,
            'total_floor' => $request->total_floor,
            'block_leader' => $request->block_leader
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_block_add'), $data);
        return $response;
    }
    public function getHostelBlockList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_block_list'));

        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHostelBlockBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelBlockBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelBlockDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_block_details'), $data);
        return $response;
    }
    public function updateHostelBlock(Request $request)
    {
        $data = [
            'id' => $request->id,
            'block_name' => $request->block_name,
            'block_warden' => $request->block_warden,
            'total_floor' => $request->total_floor,
            'block_leader' => $request->block_leader
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_block_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteHostelBlock(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_block_delete'), $data);
        return $response;
    }

    // index Hostel Floor
    public function hostelFloor()
    {
        $getEmployee = Helper::GetMethod(config('constants.api.employee_list'), []);
        $block = Helper::GetMethod(config('constants.api.hostel_block_list'));
        $student = Helper::PostMethod(config('constants.api.student_list'), []);
        // dd($getEmployee);
        return view(
            'admin.hostel_floor.index',
            [
                'warden' => !empty($getEmployee) ? $getEmployee['data'] : $getEmployee,
                'leader' => !empty($student) ? $student['data'] : $student,
                'block' => $block['data']
            ]
        );
    }

    public function addHostelFloor(Request $request)
    {
        $data = [
            'floor_name' => $request->floor_name,
            'block_id' => $request->block_id,
            'floor_warden' => $request->floor_warden,
            'floor_leader' => $request->floor_leader,
            'total_room' => $request->total_room
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_floor_add'), $data);
        return $response;
    }
    public function getHostelFloorList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_floor_list'));

        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHostelFloorBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelFloorBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelFloorDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_floor_details'), $data);
        return $response;
    }
    public function updateHostelFloor(Request $request)
    {
        $data = [
            'id' => $request->id,
            'floor_name' => $request->floor_name,
            'block_id' => $request->block_id,
            'floor_warden' => $request->floor_warden,
            'floor_leader' => $request->floor_leader,
            'total_room' => $request->total_room
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_floor_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteHostelFloor(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_floor_delete'), $data);
        return $response;
    }

    // index Group 
    public function group()
    {
        return view('admin.group.index');
    }
    // create Group 
    public function createGroup()
    {
        return view('admin.group.add');
    }
    // edit Group 
    public function editGroup(Request $request, $id)
    {

        $data = [
            'id' => $id,
        ];
        $group = Helper::PostMethod(config('constants.api.group_details'), $data);

        // dd($group);
        return view(
            'admin.group.edit',
            [
                'group' => $group['data']['group'],
                'parent' => $group['data']['parent'],
                'student' => $group['data']['student'],
                'staff' => $group['data']['staff'],
            ]
        );
    }
    public function addGroup(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'staff' => $request->staff_id,
            'student' => $request->student_id,
            'parent' => $request->parent_id
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.group_add'), $data);
        // dd($response);
        return $response;
    }

    public function getGroupList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.group_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('no_of_members', function ($row) {
                $group_staff = 0;
                $group_student = 0;
                $group_parent = 0;
                if ($row['staff']) {
                    $group_staff = count(explode(",", $row['staff']));
                }
                if ($row['student']) {
                    $group_student = count(explode(",", $row['student']));
                }
                if ($row['parent']) {
                    $group_parent = count(explode(",", $row['parent']));
                }
                $total = $group_staff + $group_student + $group_parent;
                return $total;
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('admin.group.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteGroupBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['classname', 'publish', 'actions'])
            ->make(true);
    }
    public function getGroupDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.group_details'), $data);
        return $response;
    }
    // Update group 
    public function updateGroup(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'staff' => $request->staff_id,
            'student' => $request->student_id,
            'parent' => $request->parent_id
        ];
        $response = Helper::PostMethod(config('constants.api.group_update'), $data);
        return $response;
    }
    // DELETE group 
    public function deleteGroup(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.group_delete'), $data);
        return $response;
    }
    // get Exam 
    public function examPaper()
    {
        // $term = Helper::GetMethod(config('constants.api.exam_term_list'));
        // dd($response)
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $grade_category = Helper::GetMethod(config('constants.api.grade_category'));
        $get_paper_type = Helper::GetMethod(config('constants.api.get_paper_type'));

        return view('admin.exam_paper.list', [
            'classDetails' => $getClasses['data'],
            'grade_category' => $grade_category['data'],
            'get_paper_type' => $get_paper_type['data']
        ]);
    }
    // get Exam paper list
    public function getExamPaperList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.exam_paper_list'), $data);
        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editExamPaperBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteExamPaperBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get grade category
    public function gradeCategory()
    {
        return view('admin.grade_category.list');
    }
    // get grade category
    public function getGradeCategoryList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.grade_category_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                  <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editGradeCategoryBtn"><i class="fe-edit"></i></a>
                                  <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteGradeCategoryBtn"><i class="fe-trash-2"></i></a>
                          </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // index Hostel Group 
    public function hostelGroup()
    {
        return view('admin.hostel_group.index');
    }
    // create HostelGroup 
    public function createHostelGroup()
    {

        $staff = Helper::GetMethod(config('constants.api.employee_list'));
        $student = Helper::PostMethod(config('constants.api.student_list'), []);
        // dd($staff);
        return view(
            'admin.hostel_group.add',
            [
                'student' => $student['data'],
                'staff' => $staff['data'],
            ]
        );
    }
    // edit HostelGroup 
    public function editHostelGroup(Request $request, $id)
    {

        $data = [
            'id' => $id,
        ];
        // dd($data);
        $hostel_group = Helper::PostMethod(config('constants.api.hostel_group_details'), $data);
        $staff = Helper::GetMethod(config('constants.api.employee_list'));
        $student = Helper::PostMethod(config('constants.api.student_list'), []);
        // dd($hostel_group);
        return view(
            'admin.hostel_group.edit',
            [
                'group' => $hostel_group['data'],
                'student' => $student['data'],
                'staff' => $staff['data'],
            ]
        );
    }
    public function addHostelGroup(Request $request)
    {
        $data = [
            'name' => $request->name,
            'incharge_staff' => $request->incharge_staff,
            'incharge_student' => $request->incharge_student,
            'student' => $request->student,
            'color' => $request->color
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_group_add'), $data);
        // dd($response);
        return $response;
    }

    public function getHostelGroupList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.hostel_group_list'));
        // dd($response);
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('admin.hostel_group.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHostelGroupBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getHostelGroupDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_group_details'), $data);
        return $response;
    }
    // Update HostelGroup 
    public function updateHostelGroup(Request $request)
    {

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'incharge_staff' => $request->incharge_staff,
            'incharge_student' => $request->incharge_student,
            'student' => $request->student,
            'color' => $request->color
        ];
        $response = Helper::PostMethod(config('constants.api.hostel_group_update'), $data);
        return $response;
    }
    // DELETE HostelGroup 
    public function deleteHostelGroup(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.hostel_group_delete'), $data);
        return $response;
    }

    public function staffAttendanceExcel(Request $request)
    {
        return Excel::download(new StaffAttendanceExport(1, $request->employee, $request->session, $request->date, $request->department), 'Staff_Attendance.xlsx');
    }

    // index absent Reason
    public function absentReason()
    {
        return view('admin.absent_reason.index');
    }

    public function addAbsentReason(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.absent_reason_add'), $data);
        return $response;
    }
    public function getAbsentReasonList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.absent_reason_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editAbsentReasonBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteAbsentReasonBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getAbsentReasonDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.absent_reason_details'), $data);
        return $response;
    }
    public function updateAbsentReason(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.absent_reason_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteAbsentReason(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.absent_reason_delete'), $data);
        return $response;
    }

    // index late Reason
    public function lateReason()
    {
        return view('admin.late_reason.index');
    }

    public function addLateReason(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.late_reason_add'), $data);
        return $response;
    }
    public function getLateReasonList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.late_reason_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editLateReasonBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteLateReasonBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getLateReasonDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.late_reason_details'), $data);
        return $response;
    }
    public function updateLateReason(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.late_reason_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteLateReason(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.late_reason_delete'), $data);
        return $response;
    }


    // index excused Reason
    public function excusedReason()
    {
        return view('admin.excused_reason.index');
    }

    public function addExcusedReason(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.excused_reason_add'), $data);
        return $response;
    }
    public function getExcusedReasonList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.excused_reason_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editExcusedReasonBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteExcusedReasonBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getExcusedReasonDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.excused_reason_details'), $data);
        return $response;
    }
    public function updateExcusedReason(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.excused_reason_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteExcusedReason(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.excused_reason_delete'), $data);
        return $response;
    }

    // index semester
    public function semester()
    {
        return view('admin.semester.index');
    }

    public function addSemester(Request $request)
    {
        $data = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'year' => $request->year
        ];
        $response = Helper::PostMethod(config('constants.api.semester_add'), $data);
        return $response;
    }
    public function getSemesterList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.semester_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSemesterBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSemesterBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getSemesterDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.semester_details'), $data);
        return $response;
    }
    public function updateSemester(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'year' => $request->year
        ];
        $response = Helper::PostMethod(config('constants.api.semester_update'), $data);
        return $response;
    }
    // DELETE User Details
    public function deleteSemester(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.semester_delete'), $data);
        return $response;
    }
    // academic year start
    public function academicYear()
    {
        return view('admin.acdemic_year.index');
    }
    // get Academic Year List
    public function getAcademicYearList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.academic_year_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editAcademicBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteAcademicBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // academic year end

    // start Global Setting
    public function globalSetting()
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        return view(
            'admin.global_setting.index',
            [
                'academic_year_list' => $academic_year_list['data'],
                'timezone' => $timezone_identifiers,
            ]
        );
    }

    public function addGlobalSetting(Request $request)
    {
        $data = [
            'year_id' => $request->year_id,
            'footer_text' => $request->footer_text,
            'timezone' => $request->timezone,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'youtube_url' => $request->youtube_url
        ];
        $response = Helper::PostMethod(config('constants.api.global_setting_add'), $data);
        return $response;
    }
    public function getGlobalSettingList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.global_setting_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editGlobalSettingBtn"><i class="fe-edit"></i></a>
                        </div>';
            })

            // <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteGlobalSettingBtn"><i class="fe-trash-2"></i></a>
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getGlobalSettingDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.global_setting_details'), $data);
        return $response;
    }
    public function updateGlobalSetting(Request $request)
    {
        $data = [
            'id' => $request->id,
            'year_id' => $request->year_id,
            'footer_text' => $request->footer_text,
            'timezone' => $request->timezone,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'youtube_url' => $request->youtube_url
        ];

        $response = Helper::PostMethod(config('constants.api.global_setting_update'), $data);
        return $response;
    }
    public function deleteGlobalSetting(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.global_setting_delete'), $data);
        return $response;
    }
    // end Global Setting
    public function studentAttendanceReport()
    {

        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        return view('admin.attendance.student_report', [
            'class' => $getclass['data'],
            'semester' => $semester['data'],
            'session' => $session['data'],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }

    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        return Excel::download(new StudentAttendanceExport(1, $request->class, $request->section, $request->subject, $request->semester, $request->session, $request->date), 'Student_Attendance.xlsx');
    }
    // copy academic
    public function acdemicCopyAssignTeacher(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.assign_teacher',
            [
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
    public function acdemicCopyGradeAssign(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.grade_assign',
            [
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
    public function acdemicCopySubjectTeacherAssign(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.subject_teacher_assign',
            [
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
    public function examMasterCopyExamSetup(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.exam_setup',
            [
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
    public function examMasterCopyExamPaper(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.exam_paper',
            [
                'academic_year_list' => $academic_year_list['data'],
            ]
        );
    }
}
