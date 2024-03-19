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
use App\Exports\StudentListExport;
use App\Exports\FeesExpenseExport;
use App\Exports\StudentAttendanceExport;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

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
        $id = session()->get('user_id');
        // $data = [
        //     'user_id' => $user_id
        // ];
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id,
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'), $data);
        // dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        return view('admin.forum.page-create-topic', [
            'category' => isset($category['data']) ? $category['data'] : [],
            //'forum_list' => $forum_list['data'],
            'forum_list' => isset($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => isset($usernames['data']) ? $usernames['data'] : [],
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
        return view('admin.forum.page-edit-topic', [
            'category' => isset($category['data']) ? $category['data'] : [],
            'forum_edit' => isset($forum_edit['data']) ? $forum_edit['data'] : [],
            'forum_list' => isset($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => isset($usernames['data']) ? $usernames['data'] : [],
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

        $tags = implode(",", $request->tags);
        $adminid = 2;
        $rollid_tags = $adminid . ',' . $tags;
        // dd($rollid_tags);
        $data = [
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $rollid_tags,
            // 'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 2
        ];
        $response = Helper::PostMethod(config('constants.api.forum_cpost'), $data);
        return $response;
    }
    // forum update post 
    public function updatepost(Request $request)
    {
        $tags = implode(",", $request->tags);
        $adminid = 2;
        $rollid_tags = $adminid . ',' . $tags;
        $data = [
            'id' => $request->id,
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $rollid_tags,
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
        return view('admin.forum.page-single-topic', [
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
            echo json_encode([

                'default' => config('constants.image_url') . $response['path'] . $response['file_name'],

                '500' =>  config('constants.image_url') . $response['path'] . $response['file_name'],

            ]);
        }

        // if ($request->hasFile('upload')) {

        //     //get filename with extension

        //     $filenamewithextension = $request->file('upload')->getClientOriginalName();

        //     //get filename without extension

        //     $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        //     //get file extension

        //     $extension = $request->file('upload')->getClientOriginalExtension();



        //     //filename to store

        //     $filenametostore = $filename . '_' . time() . '.' . $extension;



        //     //upload file

        //     $request->file('upload')->storeAs('public/forumupload', $filenametostore);


        //     // dd($filenametostore);

        //     echo json_encode([

        //         'default' => asset('storage/app/forumupload/' . $filenametostore),

        //         '500' =>  asset('storage/app/forumupload/' . $filenametostore)

        //     ]);
        // }
    }

    // forum screen pages end
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
        // $req->session()->flush();
        // echo "ff";exit;
        // dd(session('school_name_url'));
        $myArray = session()->get('hidden_week_ends');
        $delimiter = ','; // Delimiter you want between array items
        $hiddenWeekends = implode($delimiter, $myArray);
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
        $staff_id = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $shortcut_data = Helper::PostMethod(config('constants.api.shortcutLink_list'), $staff_id);
        $bulletinBorad_data = Helper::GetMethod(config('constants.api.bulletinBoard_Dashboard'));

        $count['employee_count'] = isset($employee_count['data']) ? $employee_count['data'] : 0;
        $count['student_count'] = isset($student_count['data']) ? $student_count['data'] : 0;
        $count['parent_count'] = isset($parent_count['data']) ? $parent_count['data'] : 0;
        $count['teacher_count'] = isset($teacher_count['data']) ? $teacher_count['data'] : 0;
        // dd($get_to_do_list_dashboard);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $response = Helper::PostMethod(config('constants.api.get_settings_attendance_report'), $staff_id);
        $get_data_hide_unhide_dashboard = Helper::PostMethod(config('constants.api.get_data_hide_unhide_dashboard'), $staff_id);
        // dd($get_data_hide_unhide_dashboard);
        return view(
            'admin.dashboard.index',
            [
                'get_data_hide_unhide_dashboard' => isset($get_data_hide_unhide_dashboard['data']) ? $get_data_hide_unhide_dashboard['data'] : [],
                'get_to_do_list_dashboard' => isset($get_to_do_list_dashboard['data']) ? $get_to_do_list_dashboard['data'] : [],
                'greetings' => isset($greetings) ? $greetings : [],
                'count' => isset($count) ? $count : 0,
                'hiddenWeekends' => isset($hiddenWeekends) ? $hiddenWeekends : "",
                'shortcut_links' => isset($shortcut_data['data']) ? $shortcut_data['data'] : [],
                'bulletinBorad_data' => isset($bulletinBorad_data['data']) ? $bulletinBorad_data['data'] : [],
                'get_settings_row' => isset($response['data']) ? $response['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
            ]
        );
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
    public function settings()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $staff_profile_info = Helper::PostMethod(config('constants.api.staff_profile_info'), $data);
        return view(
            'admin.settings.index',
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
            // return $request;
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
    public function settingsLogo()
    {
        return view('admin.settings.logo');
    }

    public function classes()
    {
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.classes.index', [
            'department' => isset($department['data']) ? $department['data'] : []
        ]);
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        // $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getSections = Helper::GetMethod(config('constants.api.section_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.section_allocation.allocation',
            [
                // 'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
                'sectionDetails' => isset($getSections['data']) ? $getSections['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : []
            ]
        );
    }


    // get sections allocation
    public function getSectionAllocationList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.allocate_section_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        // $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getAllTeacherList = Helper::GetMethod(config('constants.api.get_all_teacher_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.assign_teacher.index',
            [
                // 'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'getAllTeacherList' => isset($getAllTeacherList['data']) ? $getAllTeacherList['data'] : []
            ]
        );
    }


    // get Teacher Allocation List

    public function getTeacherAllocationList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.assign_teacher_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        //return view('admin.subjects.index');
        $pdf_report = Helper::GetMethod(config('constants.api.getpdf_report'));
        return view(
            'admin.subjects.index',
            [

                'pdf_report' => isset($pdf_report['data']) ? $pdf_report['data'] : []

            ]
        );
    }

    // get subjects
    public function getSubjectsList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.subject_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.assign_class_subject.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
                'getSubjectList' => isset($getSubjectList['data']) ? $getSubjectList['data'] : []
            ]
        );
    }
    public function ClassAssignSubList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id'),
            'class_id' => $request->class_id,
            'section_id' => $request->section_id
        ];
        // dd($data);
        $response = Helper::GETMethodWithData(config('constants.api.class_assign_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $getAllTeacherList = Helper::GetMethod(config('constants.api.get_all_teacher_list'));
        return view('admin.assign_class_subject_teacher.index', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
            'getAllTeacherList' => isset($getAllTeacherList['data']) ? $getAllTeacherList['data'] : [],
        ]);
    }
    public function ClassAssignSubTeacherList(Request $request)
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.teacher_assign_sub_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'type' => isset($gettype['data']) ? $gettype['data'] : [],
                'group' => isset($getgroup['data']) ? $getgroup['data'] : [],
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
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettype = Helper::GetMethod(config('constants.api.event_type_list'));
        $getgroup = Helper::GetMethod(config('constants.api.group_list'));

        return view(
            'admin.event.edit',
            [
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'type' => isset($gettype['data']) ? $gettype['data'] : [],
                'group' => isset($getgroup['data']) ? $getgroup['data'] : [],
                'event' => isset($event['data']) ? $event['data'] : [],
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
            'student_holiday' => $request->student_holiday,
            'staff_holiday' => $request->staff_holiday,
            'created_by' => session()->get('ref_user_id')
        ];
        // dd($data);

        $response = Helper::PostMethod(config('constants.api.event_add'), $data);
        // dd($response);
        return $response;
    }

    public function getEventList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.event_list'));
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
            'student_holiday' => $request->student_holiday,
            'staff_holiday' => $request->staff_holiday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            'created_by' => session()->get('ref_user_id')
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
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // dd($form_field['data'][0]);
        $data = [
            'admission' => 1
        ];
        $application = Helper::GETMethodWithData(config('constants.api.application_list'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        // dd($application);
        return view(
            'admin.admission.index',
            [
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'transport' => isset($gettransport['data']) ? $gettransport['data'] : [],
                'hostel' => isset($gethostel['data']) ? $gethostel['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'parent' => isset($parent['data']) ? $parent['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'application' => isset($application['data']) ? $application['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : []
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

    public function parentUpdateInfo(Request $request)
    {
        // if($request->ajax()){

        // }
        return view('admin.parent.update_list');
    }

    public function studentUpdateInfo(Request $request)
    {
        // if($request->ajax()){

        // }
        return view('admin.student.update_list');
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.homework.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
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

        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
                'category' =>  isset($getcategory['data']) ? $getcategory['data'] : [],
                'warden' =>  isset($getEmployee['data']) ? $getEmployee['data'] : []
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
            'hostel' => isset($hostel['data']) ? $hostel['data'] : [],
            'block' => isset($block['data']) ? $block['data'] : []
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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

        $data = [
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            // 'designation_id' => $request->designation_id,
            // 'department_id' => $request->department_id,
            'teacher_type' => $request->teacher_type,
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
            // 'skip_bank_details' => $request->skip_bank_details,
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
            'post_code' => $request->post_code,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,
            'department_ids' => $request->department_ids,
            'department_start' => $request->department_start,
            'department_end' => $request->department_end,
            'designation_ids' => $request->designation_ids,
            'designation_start' => $request->designation_start,
            'designation_end' => $request->designation_end,
            'employee_type_ids' => $request->employee_type_ids,
            'employee_type_start' => $request->employee_type_start,
            'employee_type_end' => $request->employee_type_end,
            'job_title' => $request->job_title,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'passport_expiry_date' => $request->passport_expiry_date,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.employee_add'), $data);
        return $response;
    }


    // get Employee 
    public function getEmpList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.employee_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
    // present student termination_list 
    public function presentStudentTerminationList(Request $request)
    {
        // $response = Helper::GetMethod(config('constants.api.present_student_termination_list'));
        // $data = isset($response['data']) ? $response['data'] : [];
        // // return DataTables::of($data)->make(true);
        // return DataTables::of($data)

        //     ->addIndexColumn()
        //     ->make(true);
        // return config('constants.api.present_student_termination_list');
        $response = Helper::GetMethod(config('constants.api.present_student_termination_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        // return $data;
        // dd(config('constants.api.present_student_termination_list'));
        return DataTables::of($data)
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
        // $department = Helper::PostMethod(config('constants.api.emp_department'), []);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $designation = Helper::PostMethod(config('constants.api.emp_designation'), []);
        $staff = Helper::PostMethod(config('constants.api.employee_details'), $res);
        $qualifications = Helper::GetMethod(config('constants.api.get_qualifications'));
        $staff_categories = Helper::GetMethod(config('constants.api.staff_categories'));
        $staff_positions = Helper::GetMethod(config('constants.api.staff_positions'));
        $stream_types = Helper::GetMethod(config('constants.api.stream_types'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        $job_title_list = Helper::GetMethod(config('constants.api.job_title_list'));
        $employee_type_list = Helper::GetMethod(config('constants.api.employee_type_list'));
        return view(
            'admin.employee.edit',
            [
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'employee' => isset($staff['data']['staff']) ? $staff['data']['staff'] : [],
                'bank' => isset($staff['data']['bank']) ? $staff['data']['bank'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'designation' => isset($designation['data']) ? $designation['data'] : [],
                'role' => isset($staff['data']['user']) ? $staff['data']['user'] : [],
                'qualifications' => isset($qualifications['data']) ? $qualifications['data'] : [],
                'staff_categories' => isset($staff_categories['data']) ? $staff_categories['data'] : [],
                'staff_positions' => isset($staff_positions['data']) ? $staff_positions['data'] : [],
                'stream_types' => isset($stream_types['data']) ? $stream_types['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'job_title_list' => isset($job_title_list['data']) ? $job_title_list['data'] : [],
                'employee_type_list' => isset($employee_type_list['data']) ? $employee_type_list['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
            ]
        );
    }

    // show employee
    public function showEmployee()
    {
        // echo "jka";
        // exit;
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        $data = [
            'status' => "0"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        $emp_department = Helper::GetMethod(config('constants.api.department_list'));
        $emp_designation = Helper::PostMethod(config('constants.api.emp_designation'), []);
        $qualifications = Helper::GetMethod(config('constants.api.get_qualifications'));
        $staff_categories = Helper::GetMethod(config('constants.api.staff_categories'));
        $staff_positions = Helper::GetMethod(config('constants.api.staff_positions'));
        $stream_types = Helper::GetMethod(config('constants.api.stream_types'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $job_title_list = Helper::GetMethod(config('constants.api.job_title_list'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        $employee_type_list = Helper::GetMethod(config('constants.api.employee_type_list'));

        return view(
            'admin.employee.index',
            [
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'emp_department' => isset($emp_department['data']) ? $emp_department['data'] : [],
                'emp_designation' => isset($emp_designation['data']) ? $emp_designation['data'] : [],
                'qualifications' => isset($qualifications['data']) ? $qualifications['data'] : [],
                'staff_categories' => isset($staff_categories['data']) ? $staff_categories['data'] : [],
                'staff_positions' => isset($staff_positions['data']) ? $staff_positions['data'] : [],
                'stream_types' => isset($stream_types['data']) ? $stream_types['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'job_title_list' => isset($job_title_list['data']) ? $job_title_list['data'] : [],
                'employee_type_list' => isset($employee_type_list['data']) ? $employee_type_list['data'] : [],
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
        $data = [
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
            'id' => $request->id,
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            'releive_date' => $request->relieving_date,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'teacher_type' => $request->teacher_type,
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
            // 'skip_bank_details' => $request->skip_bank_details,
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
            'post_code' => $request->post_code,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,
            'department_ids' => $request->department_ids,
            'department_start' => $request->department_start,
            'department_end' => $request->department_end,
            'designation_ids' => $request->designation_ids,
            'designation_start' => $request->designation_start,
            'designation_end' => $request->designation_end,
            'employee_type_ids' => $request->employee_type_ids,
            'employee_type_start' => $request->employee_type_start,
            'employee_type_end' => $request->employee_type_end,
            'job_title' => $request->job_title,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'passport_expiry_date' => $request->passport_expiry_date,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'visa_old_photo' => $request->visa_old_photo,
            'passport_old_photo' => $request->passport_old_photo,
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
                'id' => $id,
                'deleted_by' => session()->get('ref_user_id')
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
        $select_teacher_lang = __('messages.select_teacher');
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
                    $response .=  '<option value="">' . $select_teacher_lang . '</option>';
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
        $select_teacher_lang = __('messages.select_teacher');
        $timetable = Helper::PostMethod(config('constants.api.timetable_subject_bulk'), $data);
        $hall_list_respone = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $hall_list = isset($hall_list_respone['data']) ? $hall_list_respone['data'] : [];
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
                    $response .=  '<option value="">' . $select_teacher_lang . '</option>';
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
                    foreach ($hall_list as $list) {
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        // dd($semester);
        return view(
            'admin.timetable.add',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'hall_list' => isset($hall_list['data']) ? $hall_list['data'] : [],
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.promotion.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $response = Helper::PostMethod(config('constants.api.promotion_add'), $data);
        return $response;
    }
    public function PromotionBulk(Request $request)
    {
        return view('admin.promotion.student');
    }
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
            // return $response;
            if ($response['code'] == 200) {

                return redirect()->route('admin.promotion.studentlist')->with('success', ' Employee Imported Successfully');
            } else {
                return redirect()->route('admin.promotion.studentlist')->with('errors', $response['data']);
            }
        }
    }
    public function downloadPromotionCsv(Request $request)
    {
        // Fetch data based on the selected department, class, and section
        $data = [
            'department_id' => $request->input('download_department_id'),
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
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.promotion.studentList',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : []
            ]
        );
    }
    public function promotionBulkDataStudentList(Request $request)
    {
        $data = [
            'department_id' => $request->department,
            'grade_id' => $request->grade,
            'section_id' => $request->section,
            'sort_id' => $request->sort
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_bulk_student_list'), $data);
        return $response;
    }
    public function promotionUnassignedStudentList(Request $request)
    {
        $data = [
            'department_id' => $request->department,
            'grade_id' => $request->grade,
            'section_id' => $request->section
        ];
        $response = Helper::PostMethod(config('constants.api.promotion_unassigned_student_list'), $data);
        return $response;
    }
    public function promotionTerminationStudentList(Request $request)
    {
        $data = [
            'department_id' => $request->department,
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
        return view('admin.promotion.freezedStudentList');
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
                return '<div class="form-group">
                <select class="form-control"><option value="0">None</option><option value="3">Data Freezed</option>
                <option value="4">Temporary Unlock</option></select>
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($semester);
        return view(
            'admin.timetable.bulk_add',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'hall_list' => isset($hall_list['data']) ? $hall_list['data'] : [],
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'admin.timetable.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    // copy Timetable
    public function timetableCopy(Request $request)
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.timetable_copy.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
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
        if (isset($timetable['data'])) {
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

                        $response .= '<tr><td class="center" style="color:#ed1833;">' . __('messages.' . $day) . '</td>';
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
        return view(
            'admin.timetable.edit',
            [
                'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : [],
                'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : [],
                'teacher' => isset($timetable['data']['teacher']) ? $timetable['data']['teacher'] : [],
                'subject' => isset($timetable['data']['subject']) ? $timetable['data']['subject'] : [],
                'hall_list' => isset($timetable['data']['exam_hall']) ? $timetable['data']['exam_hall'] : [],
            ]
        );
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
        return view(
            'admin.timetable_copy.edit',
            [
                'timetable' => isset($timetable['data']['timetable']) ? $timetable['data']['timetable'] : [],
                'details' => isset($timetable['data']['details']) ? $timetable['data']['details'] : [],
                'teacher' => isset($timetable['data']['teacher']) ? $timetable['data']['teacher'] : [],
                'subject' => isset($timetable['data']['subject']) ? $timetable['data']['subject'] : [],
                'hall_list' => isset($timetable['data']['exam_hall']) ? $timetable['data']['exam_hall'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : []
            ]
        );
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'admin.attendance.employee',
            [
                'department' => isset($getdepartment['data']) ? $getdepartment['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function examEntry()
    {
        return view('admin.attendance.exam');
    }
    public function healthLogbooksIndex()
    {
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $injury = Helper::GetMethod(config('constants.api.injury_list'));
        $illness = Helper::GetMethod(config('constants.api.illness_list'));
        $healthConsult = Helper::GetMethod(config('constants.api.healthConsult_list'));
        return view(
            'admin.health_logbooks.employee',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'injury' => isset($injury['data']) ? $injury['data'] : [],
                'illness' => isset($illness['data']) ? $illness['data'] : [],
                'healthConsult' => isset($healthConsult['data']) ? $healthConsult['data'] : []
            ]

        );
    }
    public function getHealthLogbooksData(Request $request)
    {
        $data = [
            'date' => $request->date_of_homework
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.health_logbooks'), $data);
        return $response;
    }
    public function addHealthLogbooksData(Request $request)
    {
        $data = [
            'temp' =>  $request->temp,
            'date' => $request->date,
            'weather' => $request->weather,
            'humidity' => $request->humidity,
            'event_notes_a' => $request->event_notes_a,
            'event_notes_b' => $request->event_notes_b

        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.health_logbooks_add'), $data);
        return $response;
    }
    public function addHealthLogbooksDataPartC(Request $request)
    {
        $data = [
            'healthlogID' =>  $request->healthlogID,
            'department_id' => $request->department_id,
            'grade_id' => $request->changeClassName,
            'section_id' => $request->sectionID,
            'student_id' => $request->student_id,
            'time' => $request->time,
            'tab'  => $request->tab,
            'tab_details' => $request->tab_details,
            'event_notes_c' => $request->event_notes_c,
            'selectedInjuryName' => $request->selectedInjuryName,
            'selectedPlace' => $request->selectedPlace,
            'selectedInjuryTreatment' => $request->selectedInjuryTreatment,
            'selectedPart' => $request->selectedPart,
            'selectedIllness' => $request->selectedIllness,
            'selectedIllnessTreatment' => $request->selectedIllnessTreatment,
            'selectedReasonTemp' => $request->selectedReasonTemp,
            'selectedMeal' => $request->selectedMeal,
            'selectedDefecation' => $request->selectedDefecation,
            'selectedTarget' => $request->selectedTarget,
            'selectedSlept_time' => $request->selectedSlept_time,
            'selectedHealth_treatment' => $request->selectedHealth_treatment,
            'date' => $request->date
        ];
        $response = Helper::PostMethod(config('constants.api.health_logbooks_partc_add'), $data);
        return $response;
    }
    public function deleteHealthLogbooksDataPartC(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.health_logbook_delete'), $data);
        return $response;
    }
    public function  editHealthLogbooksDataPartC(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.health_logbook_edit'), $data);
        return $response;
    }
    public function updateHealthLogbooksDataPartC(Request $request)
    {

        // Log the request payload to check if data is received
        // \Log::info($request->all());
        $data = [
            'healthlogID' =>  $request->id,
            'department_id' => $request->editdepartment_id,
            'grade_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' => $request->student_id,
            'time' => $request->time,
            'event_notes_c' => $request->event_notes_c,
            'tab'  => $request->tab,
            'tab_details' => $request->tab_details,
            'selectedInjuryName' => $request->selectedInjuryName,
            'selectedPlace' => $request->selectedPlace,
            'selectedInjuryTreatment' => $request->selectedInjuryTreatment,
            'selectedPart' => $request->selectedPart,
            'selectedIllness' => $request->selectedIllness,
            'selectedIllnessTreatment' => $request->selectedIllnessTreatment,
            'selectedReasonTemp' => $request->selectedReasonTemp,
            'selectedMeal' => $request->selectedMeal,
            'selectedDefecation' => $request->selectedDefecation,
            'selectedTarget' => $request->selectedTarget,
            'selectedSlept_time' => $request->selectedSlept_time,
            'selectedHealth_treatment' => $request->selectedHealth_treatment,
            'date' => $request->date
        ];

        $response = Helper::PostMethod(config('constants.api.health_logbook_update'), $data);
        return $response;
    }
    public function studentIndex()
    {
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $get_student_download_settings = Helper::PostMethod(config('constants.api.get_student_download_settings'), $data);
        // dd($session);
        return view(
            'admin.student.student',
            [
                'get_student_download_settings' => isset($get_student_download_settings['data']) ? $get_student_download_settings['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function studentSettings(Request $request)
    {
        $data = [
            'studentDetails' => $request->studentDetails,
            'parentDetails' => $request->parentDetails,
            'schoolDetails' => $request->schoolDetails,
            // 'academicDetails' => $request->academicDetails,
            // 'gradeAndClasses' => $request->gradeAndClasses,
            // 'gardeClassAcademic' => $request->gardeClassAcademic,
            // 'attendance' => $request->attendance,
            // 'attendanceAcademic' => $request->attendanceAcademic,
            // 'testResult' => $request->testResult,
            // 'testResultAcademic' => $request->testResultAcademic,
            'staff_id' => session()->get('ref_user_id')

        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.student_settings'), $data);
        return $response;
    }
    public function faqIndex()
    {
        $data = [
            'email' => session()->get('email'),
            'name' => session()->get('name'),
            'role_name' => session()->get('role_name')

        ];
        return view(
            'admin.faq.index',
            [
                'data' => isset($data) ? $data : [],
            ]
        );
    }
    public function taskIndex()
    {

        // $allocate_section_list = Helper::GetMethod(config('constants.api.allocate_section_list'));
        // return view(
        //     'admin.task.index',
        //     [
        //         'allocate_section_list' => $allocate_section_list['data'],
        //     ]
        // );
        return view('admin.task.index');
    }
    // create task 
    public function createTask()
    {
        $allocate_section_list = Helper::GetMethod(config('constants.api.allocate_section_list'));
        // dd($allocate_section_list);
        return view(
            'admin.task.add',
            [
                'allocate_section_list' => isset($allocate_section_list['data']) ? $allocate_section_list['data'] : []
            ]
        );
    }
    public function studentLeaveShow()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $get_student_leave_types = Helper::GetMethod(config('constants.api.get_student_leave_types'));
        return view('admin.student_leave.index', [
            'get_student_leave_types' => isset($get_student_leave_types['data']) ? $get_student_leave_types['data'] : [],
            'department' => isset($department['data']) ? $department['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : []
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
        // dd($response);
        return $response;
    }
    public function getToDoList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.get_to_do_list'));
        // dd($response['data']);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                // return '<div class="button-list">
                //                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteToDoListBtn"><i class="fe-trash-2"></i></a>
                //         </div>';
                return '<div class="button-list">
                            <a href="' . route('admin.task.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteToDoListBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // edit to do list
    public function editToDoList(Request $request, $id)
    {
        $res = [
            'id' => $id,
        ];
        $taskRow = Helper::PostMethod(config('constants.api.get_to_do_row'), $res);
        // dd($taskRow);
        $allocate_section_list = Helper::GetMethod(config('constants.api.allocate_section_list'));
        return view(
            'admin.task.edit',
            [
                'to_do_row' => isset($taskRow['data']) ? $taskRow['data'] : [],
                'allocate_section_list' => isset($allocate_section_list['data']) ? $allocate_section_list['data'] : []
            ]
        );
    }
    public function updateToDoList(Request $request)
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
            'id' => $request->id,
            'title' => $request->title,
            'due_date' => $request->due_date,
            'assign_to' => $request->assign_to,
            'priority' => $request->priority,
            'check_list' => $request->check_list,
            'old_file' => $request->old_file,
            'task_description' => $request->task_description,
            'old_updated_file' => $request->old_updated_file,
            'file' => $files,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.update_to_do_list'), $data);
        return $response;
    }
    public function evaluationReport()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.homework.evaluation_report',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
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


        $file = $request->file('file');
        $path = $file->path();
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        $extension = $file->getClientOriginalExtension();

        $created_by = session()->get('ref_user_id');
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

    //     // dd($homework);
    //     return $homework;
    // }
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
            'academic_session_id' => session()->get('academic_session_id')
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
        // dd($homework);

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
                                            <option value="Marks" >' . $marks_lang . '</option>
                                            <option value="Grade" Selected>' . $grade_lang . '</option>
                                            <option value="Text">' . $text_lang . '</option>
                                        </select>';
                    } elseif ($work['score_name'] == "Text") {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                            <option value="Marks" >' . $marks_lang . '</option>
                                            <option value="Grade">' . $grade_lang . '</option>
                                            <option value="Text" Selected>' . $text_lang . '</option>
                                            </select>';
                    } else {
                        $score_name = '<select  class="form-control" required="" name="homework[' . $row . '][score_name]">
                                            <option value="Marks" Selected>' . $marks_lang . '</option>
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
										<input type="text" class="form-control" name="homework[' . $row . '][teacher_remarks]"  value="' . $work['teacher_remarks'] . '" aria-describedby="inputGroupPrepend" ></td>
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
        // dd($data);
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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

        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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

        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
        return view('admin.exam.list', ['term' => isset($term['data']) ? $term['data'] : []]);
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_timetable.schedule',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_timetable.add_schedule',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'exam' => isset($getexam['data']) ? $getexam['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    public function timetableExam(Request $request)
    {
        $no_data_available_lang = __('messages.no_data_available');
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
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
                                    <td colspan="3" class="text-center"> ' . $no_data_available_lang . '</td>
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
        $select_hall = __('messages.select_hall');
        $select_teacher = __('messages.select_teacher');
        $internal = __('messages.internal');
        $external = __('messages.external');
        $no_data_available_lang = __('messages.no_data_available');
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
                            $dist .= '<option value="">' . $select_teacher . '</option>';
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
                        $dist .= '<option value="">' . $select_teacher . '</option>';
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
                                                        <option value=""> ' . $select_hall . '</option>' . $hall . '</select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select  class="form-control distributor_type" data-id="' . $row . '" name="exam[' . $row . '][distributor_type]">
                                                        <option value="1" ' . $dist_type1 . '>' . $internal . '</option>
                                                        <option value="2" ' . $dist_type2 . '>' . $external . '</option>
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
                                <td colspan="7" class="text-center"> ' . $no_data_available_lang . '</td>
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
        $no_data_available_lang = __('messages.no_data_available');
        $internal = __('messages.internal');
        $external = __('messages.external');
        // dd($response);  
        if ($response['code'] == "200") {

            $output = "";
            $row = 1;
            if ($response['data']['exam']) {
                foreach ($response['data']['exam'] as $exam) {

                    if ($exam['distributor_type'] == "1") {
                        $type = $internal;
                    } elseif ($exam['distributor_type'] == "2") {
                        $type = $external;
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
                                <td colspan="5"> ' . $no_data_available_lang . '</td>
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
        $no_data_available_lang = __('messages.no_data_available');
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
                                    <td colspan="3" class="text-center"> ' . $no_data_available_lang . '</td>
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

        return view('admin.grade.index', ['grade_category' => isset($grade_category['data']) ? $grade_category['data'] : []]);
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
            'score_type' => $request->score_type,
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

        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
            'score_type' => $request->score_type,
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


        $data = [
            'year' => $request->year,
            // 'register_no' => $request->txt_regiter_no,
            'roll_no' => $request->txt_roll_no,
            'admission_date' => $request->admission_date,
            'category_id' => $request->categy,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'middle_name' => $request->mname,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'guardian_id' => $request->guardian_id,
            'relation' => $request->relation,
            'status' => $status,
            'passport' => $request->passport,
            'nric' => $request->nric,
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
            'address_unit_no' => $request->address_unit_no,
            'address_condominium' => $request->address_condominium,
            'address_street' => $request->address_street,
            'address_district' => $request->address_district,
            'email' => $request->txt_emailid,
            'route_id' => $request->drp_transport_route,
            'vehicle_id' => $request->drp_transport_vechicleno,
            'hostel_id' => $request->drp_hostelnam,
            'room_id' => $request->drp_roomname,
            'school_name' => $request->txt_prev_schname,
            'qualification' => $request->txt_prev_qualify,
            'remarks' => $request->txtarea_prev_remarks,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'session_id' => $request->session_id,
            'semester_id' => $request->semester_id,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,
            'password' => $request->txt_pwd,
            'confirm_password' => $request->txt_retype_pwd,
            'sudent_application_id' => $request->sudent_application_id,
            'school_roleid' => $request->school_roleid,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'middle_name_english' => $request->middle_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'middle_name_furigana' => $request->middle_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            'passport_expiry_date' => $request->passport_expiry_date,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'nric_photo' => $nric_base64,
            'nric_file_extension' => $nric_extension,
            'image_principal_photo' => $image_principal_base64,
            'image_principal_file_extension' => $image_principal_extension,
            "dual_nationality" => $request->dual_nationality,
            "school_enrollment_status" => $request->school_enrollment_status,
            "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
            "visa_type" => $request->visa_type,
            "visa_type_others" => $request->visa_type_others,
            "japanese_association_membership_number_student" => $request->japanese_association_membership_number_student,
            'school_country' => $request->school_country,
            'school_city' => $request->school_city,
            'school_state' => $request->school_state,
            'school_postal_code' => $request->school_postal_code,
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
        ];

        // dd($data);
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.byclass',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.bysubject',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function byreport()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.byreport',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function bystudent()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.bystudent',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.overall',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'allexams' => isset($allexams['data']) ? $allexams['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam.result',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        // dd($sem);
        return view('admin.testresult.index', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function paperWiseResult()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.testresult.paper_wise_result', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }

    public function subjectmarks(Request $request)
    {
        $data = [
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
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
    public function byStudentRank()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.exam_results.bystudentrank',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
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
            "department_id" => $request->department_id,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "status" => $request->status,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.student_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

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
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $data = [
            'department_id' => isset($student['data']['student']['department_id']) ? $student['data']['student']['department_id'] : 0,
        ];
        $grade_list_by_department = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);
        $prev = json_decode($student['data']['student']['previous_details']);
        $student['data']['student']['school_name'] = isset($prev->school_name) ? $prev->school_name : "";
        $student['data']['student']['qualification'] = isset($prev->qualification) ? $prev->qualification : "";
        $student['data']['student']['remarks'] = isset($prev->remarks) ? $prev->remarks : "";
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        return view(
            'admin.student.edit',
            [
                'grade_list_by_department' => isset($grade_list_by_department['data']) ? $grade_list_by_department['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
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
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
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

        $data = [
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
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
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'session_id' => $request->session_id,
            'semester_id' => $request->semester_id,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,
            'parent_id' => $request->txt_name,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'school_roleid' => $request->school_roleid,
            "middle_name" => $request->middle_name,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            'passport_expiry_date' => $request->passport_expiry_date,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'nationality' => $request->nationality,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'visa_old_photo' => $request->visa_old_photo,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'passport_old_photo' => $request->passport_old_photo,
            'dual_nationality' => $request->dual_nationality,
            'nric_old_photo' => $request->nric_old_photo,
            'image_principal_old_photo' => $request->japanese_association_membership_image_principal_old,
            'nric_photo' => $nric_base64,
            'nric_file_extension' => $nric_extension,
            'image_principal_photo' => $image_principal_base64,
            'image_principal_file_extension' => $image_principal_extension,
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
        ];
        $response = Helper::PostMethod(config('constants.api.student_update'), $data);
        return $response;
    }

    // DELETE Student Details
    public function deleteStudent(Request $request)
    {
        $no_data_available_lang = __('messages.no_data_available');
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
                                <td colspan="7"> ' . $no_data_available_lang . '</td>
                            </tr>';
            }
            $student['table'] = $output;
        }
        return $student;
    }

    public function createParent()
    {
        $data = [
            'email' => session()->get('email'),
        ];
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        $application = Helper::PostMethod(config('constants.api.get_application_guardian_details'), $data);

        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.parent.add',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'education' => isset($education['data']) ? $education['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'contact' => isset($contactDetails['data']) ? $contactDetails['data'] : [],

                'guardian' => isset($application['data']) ? $application['data'] : [],
                'email' => session()->get('email'),
            ]
        );
    }

    public function addParent(Request $request)
    {

        $status = "0";
        if ($request->status) {
            $status = "1";
        }

        /*  $base64 = "";
        $extension = "";
        $file = $request->file('photo');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }*/

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
        /* $visa_base64 = "";
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
        }*/
        $japanese_association_membership_image_supplimental_base64 = "";
        $japanese_association_membership_image_supplimental_extension = "";
        $file = $request->file('japanese_association_membership_image_supplimental');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $japanese_association_membership_image_supplimental_base64 = base64_encode($data);
            $japanese_association_membership_image_supplimental_extension = $file->getClientOriginalExtension();
        }
        $data = [

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
            'passport_mother_photo' => $mother_passport_base64,
            'mother_passport_file_extension' => $mother_passport_extension,
            'mother_visa_file_extension' => $mother_visa_extension,
            /*'mother_nric' => $request->mother_nric,
            'mother_visa_number' => $request->mother_visa_number,
            'mother_visa_expiry_date' => $request->mother_visa_expiry_date,
            'mother_passport_number' => $request->mother_passport_number,
            'mother_passport_expiry_date' => $request->mother_passport_expiry_date,*/


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
            'visa_father_photo' => $father_visa_base64,
            'father_visa_file_extension' => $father_visa_extension,
            'passport_father_photo' => $father_passport_base64,
            'father_passport_file_extension' => $father_passport_extension,
            /*
            'father_nric' => $request->father_nric,
            'father_visa_number' => $request->father_visa_number,
            'father_visa_expiry_date' => $request->father_visa_expiry_date,     
            'father_passport_number' => $request->father_passport_number,       
            'father_passport_expiry_date' => $request->father_passport_expiry_date,*/

            'first_name' => $request->guardian_first_name,
            'last_name' => $request->guardian_last_name,
            'middle_name' => $request->guardian_middle_name,
            /*'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'occupation' => $request->occupation,
            'income' => $request->income,
            'education' => $request->education,
            'country' => $request->country,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address,
            'address_2' => $request->address_2,*/

            'status' => $status,
            'occupation' => $request->guardian_occupation,
            'mobile_no' => $request->guardian_phone_number,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,



            /* 'photo' => $base64,
           
            'file_extension' => $extension,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'twitter_url' => $request->twitter_url,
            'school_roleid' => $request->school_roleid,*/
            'first_name_english' => $request->guardian_first_name_english,
            'middle_name_english' => $request->guardian_middle_name_english,
            'last_name_english' => $request->guardian_last_name_english,
            'first_name_furigana' => $request->guardian_first_name_furigana,
            'middle_name_furigana' => $request->guardian_middle_name_furigana,
            'last_name_furigana' => $request->guardian_last_name_furigana,

            'school_roleid' => isset($request->school_roleid) ? $request->school_roleid : '',
            /*'nric' => $request->nric,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport' => $request->passport,     
            'passport_photo' => $passport_base64,              
            'passport_expiry_date' => $request->passport_expiry_date,
            'passport_file_extension' => $passport_extension,*/

            'guardian_relation' => $request->guardian_relation,
            'guardian_company_name_japan' => $request->guardian_company_name_japan,
            'guardian_company_name_local' => $request->guardian_company_name_local,
            'guardian_company_phone_number' => $request->guardian_company_phone_number,
            'guardian_employment_status' => $request->guardian_employment_status,
            'guardian_remarks' => $request->guardian_remarks,
            'japanese_association_membership_image_supplimental' => $japanese_association_membership_image_supplimental_base64,
            'japanese_association_membership_image_supplimental_file_extension' => $japanese_association_membership_image_supplimental_extension,

            'school_roleid' => isset($request->school_roleid) ? $request->school_roleid : '',
            'japan_postalcode' => $request->japan_postalcode,
            'japan_contact_no' => $request->japan_contact_no,
            'japan_emergency_sms' => $request->japan_emergency_sms,
            'japan_address' => $request->japan_address,
            'japan_staycategory' => $request->japan_staycategory,


        ];
        //  dd($data);
        $response = Helper::PostMethod(config('constants.api.parent_add'), $data);
        // dd($response);
        return $response;
    }
    public function getParentList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.parent_list'));
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $edit = route('admin.parent.details', $row['id']);
                return '<div class="button-list">
                
                            <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editParentBtn"><i class="fe-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteParentBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getParentUpdateInfoList(Request $request)
    {

        $data = [
            "status" => "Admin"
        ];
        $response = Helper::GETMethodWithData(config('constants.api.parent_update_info_list'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return '<div class="button-list">
                
                <span class="badge badge-soft-warning p-1">Pending</span>
            </div>';
            })
            ->addColumn('actions', function ($row) {
                $edit = route('admin.parent.update_info_view', $row['id']);
                return '<div class="button-list">
                
                            <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="ViewParentUpdateBtn"><i class="fe-edit"></i></a>
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
        return view(
            'admin.parent.update_view',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'education' => isset($education['data']) ? $education['data'] : [],
                'parent' => isset($response['data']['profile']) ? $response['data']['profile'] : [],
                'changes' => isset($response['data']['parent']) ? $response['data']['parent'] : [],
            ]
        );
    }



    public function getStudentUpdateInfoList(Request $request)
    {
        $data['status'] = "Admin";
        $response = Helper::GETMethodWithData(config('constants.api.student_update_info_list'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return '<div class="button-list">
                
                <span class="badge badge-soft-warning p-1">Pending</span>
            </div>';
            })
            ->addColumn('actions', function ($row) {
                $edit = route('admin.student.update_info_view', $row['id']);
                return '<div class="button-list">
                
                            <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="ViewStudentUpdateBtn"><i class="fe-edit"></i></a>
                        </div>';
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }
    public function viewStudentUpdateInfo($id)
    {
        $data = [
            'id' => $id,
        ];
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $response = Helper::PostMethod(config('constants.api.student_update_info_view'), $data);
        // dd($response);
        return view(
            'admin.student.update_view',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'education' => isset($education['data']) ? $education['data'] : [],
                'student' => isset($response['data']['profile']) ? $response['data']['profile'] : [],
                'changes' => isset($response['data']['student']) ? $response['data']['student'] : [],
            ]
        );
    }
    public function getParentDetails($id)
    {
        $data = [
            'id' => $id,
        ];
        $data1 = [
            'email' => session()->get('email'),
        ];
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $education = Helper::GetMethod(config('constants.api.education_list'));
        $response = Helper::PostMethod(config('constants.api.parent_details'), $data);

        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));

        $application = Helper::PostMethod(config('constants.api.get_application_guardian_details'), $data1);

        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        //dd($response);
        return view(
            'admin.parent.edit',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'education' => isset($education['data']) ? $education['data'] : [],
                'parent' => isset($response['data']['parent']) ? $response['data']['parent'] : [],
                'childs' => isset($response['data']['childs']) ? $response['data']['childs'] : [],
                'user' => isset($response['data']['user']) ? $response['data']['user'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'contact' => isset($contactDetails['data']) ? $contactDetails['data'] : [],

                'guardian' => isset($application['data']) ? $application['data'] : [],
                'email' => session()->get('email'),
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
        /* $file = $request->file('photo');

        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }
*/
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
        $japanese_association_membership_image_supplimental_base64 = "";
        $japanese_association_membership_image_supplimental_extension = "";
        $file = $request->file('japanese_association_membership_image_supplimental');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $japanese_association_membership_image_supplimental_base64 = base64_encode($data);
            $japanese_association_membership_image_supplimental_extension = $file->getClientOriginalExtension();
        }
        $data = [


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
            /*'mother_nric' => $request->mother_nric,
            'mother_visa_number' => $request->mother_visa_number,
            'mother_visa_expiry_date' => $request->mother_visa_expiry_date,
            'visa_mother_photo' => $mother_visa_base64,
            'mother_visa_file_extension' => $mother_visa_extension,
            'mother_passport_number' => $request->mother_passport_number, 
            'mother_passport_expiry_date' => $request->mother_passport_expiry_date,
            'passport_mother_photo' => $mother_passport_base64,           
            'mother_passport_file_extension' => $mother_passport_extension,           
            'passport_mother_photo_old' => $request->passport_mother_photo_old,
            'visa_mother_photo_old' => $request->visa_mother_photo_old,*/


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
            /*'father_nric' => $request->father_nric,
            'father_visa_number' => $request->father_visa_number,
            'father_visa_expiry_date' => $request->father_visa_expiry_date,
            'visa_father_photo' => $father_visa_base64,
            'father_visa_file_extension' => $father_visa_extension,            
            'father_passport_number' => $request->father_passport_number,
            'passport_father_photo' => $father_passport_base64,            
            'father_passport_expiry_date' => $request->father_passport_expiry_date,
            'father_passport_file_extension' => $father_passport_extension,            
            'passport_father_photo_old' => $request->passport_father_photo_old,
            'visa_father_photo_old' => $request->visa_father_photo_old,*/


            'id' => $request->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'status' => $status,
            'occupation' => $request->occupation,
            'mobile_no' => $request->guardian_phone_number,
            /*'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'passport' => $request->passport,
            'race' => $request->race,
            'religion' => $request->religion,
            'nric' => $request->nric,           
            'blood_group' => $request->blood_group,
            'income' => $request->income,
            'education' => $request->education,
            'country' => $request->country,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,            
            'address' => $request->address,
            'address_2' => $request->address_2,*/
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'old_photo' => $request->old_photo,
            'google2fa_secret_enable' => $request->google2fa_secret_enable,
            /*'photo' => $base64,
            'file_extension' => $extension,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'twitter_url' => $request->twitter_url,*/
            'first_name_english' => $request->first_name_english,
            'middle_name_english' => $request->middle_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'middle_name_furigana' => $request->middle_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            /*'passport_expiry_date' => $request->passport_expiry_date,
            'visa_number' => $request->visa_number,
            'visa_expiry_date' => $request->visa_expiry_date,
            'visa_photo' => $visa_base64,
            'visa_file_extension' => $visa_extension,
            'passport_photo' => $passport_base64,
            'passport_file_extension' => $passport_extension,
            'visa_old_photo' => $request->visa_old_photo,
            'passport_old_photo' => $request->passport_old_photo,*/

            'guardian_relation' => $request->guardian_relation,
            'guardian_company_name_japan' => $request->guardian_company_name_japan,
            'guardian_company_name_local' => $request->guardian_company_name_local,
            'guardian_company_phone_number' => $request->guardian_company_phone_number,
            'guardian_employment_status' => $request->guardian_employment_status,
            'guardian_remarks' => $request->guardian_remarks,
            'japanese_association_membership_image_supplimental' => $japanese_association_membership_image_supplimental_base64,
            'japanese_association_membership_image_supplimental_file_extension' => $japanese_association_membership_image_supplimental_extension,
            "japanese_association_membership_image_supplimental_old" => $request->japanese_association_membership_image_supplimental_old,
            'school_roleid' => isset($request->school_roleid) ? $request->school_roleid : '',
            'japan_postalcode' => $request->japan_postalcode,
            'japan_contact_no' => $request->japan_contact_no,
            'japan_emergency_sms' => $request->japan_emergency_sms,
            'japan_address' => $request->japan_address,
            'japan_staycategory' => $request->japan_staycategory,

            'role_id' => session()->get('role_id')
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.parent_update'), $data);
        return $response;
    }

    public function updateParentInfo(Request $request)
    {
        // dd($request);
        $response = Helper::PostMethod(config('constants.api.parent_update_info_update'), $request);
        // dd($response);
        return $response;
    }
    public function updateStudentInfo(Request $request)
    {
        $response = Helper::PostMethod(config('constants.api.student_update_info_update'), $request);
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
            'name' => $request->name,
            'short_name' => $request->short_name,
            'leave_days' => $request->leave_days,
            'gender' => $request->gender,
            "academic_session_id" => session()->get('academic_session_id'),
        ];
        $response = Helper::PostMethod(config('constants.api.leave_type_add'), $data);
        return $response;
    }
    public function getLeaveTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.leave_type_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editLeaveTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteLeaveTypeBtn"><i class="fe-trash-2"></i></a>
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" data-leave_days="' . $row['leave_days'] . '"data-short_name="' . $row['short_name'] . '"data-name="' . $row['name'] . '"data-gender="' . $row['gender'] . '" id="restoreLeaveTypeBtn"><i class="fe-rotate-cw"></i></a>
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
            'name' => $request->name,
            'short_name' => $request->short_name,
            'leave_days' => $request->leave_days,
            'gender' => $request->gender,
            "academic_session_id" => session()->get('academic_session_id'),
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

    // index staffLeaveAssign
    public function staffLeaveAssign()
    {

        $getdepartment = Helper::GetMethod(config('constants.api.department_list'));
        // dd($hostel_group);
        return view(
            'admin.staff_leave_assign.index',
            [
                'department' => isset($getdepartment['data']) ? $getdepartment['data'] : [],
            ]
        );
    }

    public function addStaffLeaveAssign(Request $request)
    {
        $data = [
            'staff_id' => $request->staff_id,
            'leave_type' => $request->leave_type,
            'leave_days' => $request->leave_days,
            'academic_session_id' => $request->academic_session_id,
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_assign_add'), $data);
        return $response;
    }
    public function getStaffLeaveAssignList(Request $request)
    {
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            'staff_id' => $request->employee,
            'department' => $request->department,
        ];
        $response = Helper::GETMethodWithData(config('constants.api.staff_leave_assign_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('admin.staff_leave_assign.edit', $row['staff_id']) . '"class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editStaffLeaveAssignBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteStaffLeaveAssignBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    public function staffLeaveAssignEdit($id, Request $request)
    {
        $data = [
            'staff_id' => $id,
            "academic_session_id" => session()->get('academic_session_id'),
        ];
        $leave_type = Helper::GetMethod(config('constants.api.leave_type_list'));
        $staff_leave_assign = Helper::PostMethod(config('constants.api.staff_leave_assign_details'), $data);
        return view(
            'admin.staff_leave_assign.edit',
            [
                'leave_type' => $leave_type['data'],
                'staff' => $staff_leave_assign['data']['staff'],
                'staff_leave' => $staff_leave_assign['data']['leave'],
            ]
        );
    }
    public function getStaffLeaveAssignDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_assign_details'), $data);
        return $response;
    }
    public function updateStaffLeaveAssign(Request $request)
    {
        $data = [
            'staff_id' => $request->staff_id,
            'leave_assign' => $request->leave,
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_assign_update'), $data);
        return $response;
    }
    // DELETE Leave type Details
    public function deleteStaffLeaveAssign(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.staff_leave_assign_delete'), $data);
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $get_leave_reasons = Helper::GetMethod(config('constants.api.get_leave_reasons'));
        $data = [
            'staff_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $get_leave_types = Helper::GETMethodWithData(config('constants.api.get_leave_types'), $data);
        $leave_taken_history = Helper::PostMethod(config('constants.api.leave_taken_history'), $data);
        return view('admin.leave_management.applyleave', [
            'get_leave_types' => isset($get_leave_types['data']) ? $get_leave_types['data'] : [],
            'get_leave_reasons' => isset($get_leave_reasons['data']) ? $get_leave_reasons['data'] : [],
            'leave_taken_history' => isset($leave_taken_history['data']) ? $leave_taken_history['data'] : [],
        ]);
    }
    public function leaveHistoryByStaffList(Request $request)
    {
        $data = [
            'department_id' => $request->department_id,
            'staff_id' => $request->staff_id,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $attendance = Helper::PostMethod(config('constants.api.leave_taken_history_by_staff'), $data);
        return $attendance;
    }
    public function leaveHistoryByStaff()
    {
        $getdepartment = Helper::GetMethod(config('constants.api.department_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'admin.leave_management.emp_leave_list',
            [
                'department' => isset($getdepartment['data']) ? $getdepartment['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
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
            'staff_id' => $request->staff_id,
            'level_one_status' => $request->level_one_status,
            'level_two_status' => $request->level_two_status,
            'level_three_status' => $request->level_three_status,
            'academic_session_id' => session()->get('academic_session_id')
        ];
        // dd($staff_data);
        // $response = Helper::PostMethod(config('constants.api.staff_leave_history'), $staff_data);
        $response = Helper::PostMethod(config('constants.api.leave_approval_history_by_staff'), $staff_data);
        // dd($response);
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
    public function getAllLeaveReliefAssignment(Request $request)
    {
        $staff_data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.get_all_leave_relief_assignment'), $staff_data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $rel_ass_lan = __('messages.relief_assign');
                return '<div class="button-list">
                                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-staff_id="' . $row['staff_id'] . '" 
                                    data-from_date="' . $row['from_leave'] . '" data-to_date="' . $row['to_leave'] . '" id="reliefAssign">' . $rel_ass_lan . '</a>
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
            'staff_id' => session()->get('ref_user_id'),
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.staff_leave_history'), $staff_id);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $upload_lang = __('messages.upload');
                // if ($row['status'] != "Approve") {
                // if ($row['document'] != "Approve") {
                if (is_null($row['document'])) {
                    return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile">' . $upload_lang . '</i></a>
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
    public function assignLeaveApprover()
    {
        $get_all_staff_details = Helper::GetMethod(config('constants.api.get_all_staff_details'));
        $all_staff_details = isset($get_all_staff_details['data']['staff_details']) ? $get_all_staff_details['data']['staff_details'] : [];
        $widget_details = isset($get_all_staff_details['data']['widget_details']) ? $get_all_staff_details['data']['widget_details'] : [];
        return view('admin.leave_management.assign_leave_approval', [
            'get_all_staff_details' => $all_staff_details,
            'total_staff' => isset($widget_details[0]['total_staff']) ? $widget_details[0]['total_staff'] : 0,
            'level_one_count' => isset($widget_details[0]['level_one_count']) ? $widget_details[0]['level_one_count'] : 0,
            'level_two_count' => isset($widget_details[0]['level_two_count']) ? $widget_details[0]['level_two_count'] : 0,
            'level_three_count' => isset($widget_details[0]['level_three_count']) ? $widget_details[0]['level_three_count'] : 0
        ]);
    }
    public function reliefAssignment()
    {
        $get_all_staff_details = Helper::GetMethod(config('constants.api.get_all_staff_details'));
        $all_staff_details = isset($get_all_staff_details['data']['staff_details']) ? $get_all_staff_details['data']['staff_details'] : [];
        return view('admin.leave_management.relief_assignment', [
            'get_all_staff_details' => $all_staff_details
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

        $session = Helper::GetMethod(config('constants.api.session'));
        $getdepartment = Helper::GetMethod(config('constants.api.department_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        return view(
            'admin.attendance.employee_report',
            [
                'department' => isset($getdepartment['data']) ? $getdepartment['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $class = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.classroom.management', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'class' => isset($class['data']) ? $class['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function studDailyAttendance()
    {
        $class = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.classroom.daily_attendance', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'class' => isset($class['data']) ? $class['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function classroomPost(Request $request)
    {
        // echo "<pre>";
        // print_r($request);

        $data = [
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
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
    public function studDailyAttendanceAdd(Request $request)
    {
        $data = [
            'login_userid' => session()->get('user_id'),
            'login_roleid' => session()->get('role_id'),
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
                'vehicle' => isset($vehicle['data']) ? $vehicle['data'] : [],
                'route' => isset($route['data']) ? $route['data'] : [],
                'stoppage' => isset($stoppage['data']) ? $stoppage['data'] : [],
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = [
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $getEmployee = Helper::GetMethod(config('constants.api.employee_list'), []);
        $student = Helper::PostMethod(config('constants.api.student_list'), $data);
        return view(
            'admin.hostel_block.index',
            [
                'warden' => !empty($getEmployee) ? $getEmployee['data'] : $getEmployee,
                'leader' => !empty($student) ? $student['data'] : $student
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = [
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $getEmployee = Helper::GetMethod(config('constants.api.employee_list'), []);
        $block = Helper::GetMethod(config('constants.api.hostel_block_list'));
        $student = Helper::PostMethod(config('constants.api.student_list'), $data);
        // dd($getEmployee);
        return view(
            'admin.hostel_floor.index',
            [
                'warden' => !empty($getEmployee) ? $getEmployee['data'] : $getEmployee,
                'leader' => !empty($student) ? $student['data'] : $student,
                'block' => isset($block['data']) ? $block['data'] : []
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
                'group' => isset($group['data']['group']) ? $group['data']['group'] : [],
                'parent' => isset($group['data']['parent']) ? $group['data']['parent'] : [],
                'student' => isset($group['data']['student']) ? $group['data']['student'] : [],
                'staff' => isset($group['data']['staff']) ? $group['data']['staff'] : [],
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $pdf_report = Helper::GetMethod(config('constants.api.getpdf_report'));
        return view('admin.exam_paper.list', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
            'grade_category' => isset($grade_category['data']) ? $grade_category['data'] : [],
            'get_paper_type' => isset($get_paper_type['data']) ? $get_paper_type['data'] : [],
            'pdf_report' => isset($pdf_report['data']) ? $pdf_report['data'] : []
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = [
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $student = Helper::PostMethod(config('constants.api.student_list'), $data);
        // dd($staff);
        return view(
            'admin.hostel_group.add',
            [
                'student' => isset($student['data']) ? $student['data'] : [],
                'staff' => isset($staff['data']) ? $staff['data'] : [],
            ]
        );
    }
    // edit HostelGroup 
    public function editHostelGroup(Request $request, $id)
    {

        $data = [
            'id' => $id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $hostel_group = Helper::PostMethod(config('constants.api.hostel_group_details'), $data);
        $staff = Helper::GetMethod(config('constants.api.employee_list'));
        $student = Helper::PostMethod(config('constants.api.student_list'), $data);
        // dd($hostel_group);
        return view(
            'admin.hostel_group.edit',
            [
                'group' => isset($hostel_group['data']) ? $hostel_group['data'] : [],
                'student' => isset($student['data']) ? $student['data'] : [],
                'staff' => isset($staff['data']) ? $staff['data'] : [],
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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

        $branch_id = session()->get('branch_id');
        $employee_attendance_report = __('messages.employee_attendance_report');
        return Excel::download(new StaffAttendanceExport($branch_id, $request->employee, $request->session, $request->date, $request->department), $employee_attendance_report . '.xlsx');
    }
    public function StudentListExcel(Request $request)
    {

        $branch_id = session()->get('branch_id');
        $staff_id = session()->get('ref_user_id');
        $student_list_report = __('messages.student_list');
        // dd($request);
        return Excel::download(new StudentListExport($branch_id, $staff_id, $request->student_name, $request->department_id, $request->class_id, $request->section_id, $request->session, $request->academic_year), $student_list_report . '.xlsx');
    }
    public function feesExpenseExcel(Request $request)
    {
        // dd($request);
        $branch_id = session()->get('branch_id');
        $expense_report = __('messages.fees_expense_report');
        return Excel::download(new FeesExpenseExport($branch_id, $request->department_id, $request->class_id, $request->section_id, $request->academic_session_id), $expense_report . '.xlsx');
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.semester.index',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : []

            ]
        );
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
    // studentAttendanceReport
    public function studentAttendanceReportStg()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $term = Helper::GETMethodWithData(config('constants.api.exam_term_list'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $userid = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.get_settings_attendance_report'), $userid);
        // dd($response);
        return view('admin.student_att_report_settings.index', [
            'get_settings_row' => isset($response['data']) ? $response['data'] : [],
            'department' => isset($department['data']) ? $department['data'] : [],
            'term' => isset($term['data']) ? $term['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
        ]);
        // admin.attendance.student_report
    }
    // start Global Setting
    public function globalSetting()
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $get_languages = Helper::GetMethod(config('constants.api.get_languages'));
        return view(
            'admin.global_setting.index',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                // 'timezone' => isset($timezone_identifiers) ? $timezone_identifiers : [],
                'get_languages' => isset($get_languages['data']) ? $get_languages['data'] : [],
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
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
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
            'language_id' => $request->language_id,
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
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $term = Helper::GETMethodWithData(config('constants.api.exam_term_list'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.attendance.student_report', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'term' => isset($term['data']) ? $term['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
        ]);
    }

    // studentAttendanceReportSubject
    public function studentAttendanceReportSubject()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.attendance.student_report_subject', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'term' => isset($term['data']) ? $term['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
        ]);
    }
    public function studentAttendanceExcel(Request $request)
    {
        // dd($request);
        $branch_id = session()->get('branch_id');
        $attendance_report = __('messages.attendance_report');
        return Excel::download(new StudentAttendanceExport($branch_id, $request->class, $request->section, $request->subject, $request->pattern, $request->date, $request->type), $attendance_report . '.xlsx');
    }
    // copy academic
    public function acdemicCopyAssignTeacher(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.assign_teacher',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function acdemicCopyGradeAssign(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.grade_assign',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function acdemicCopySubjectTeacherAssign(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.subject_teacher_assign',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function examMasterCopyExamSetup(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.exam_setup',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function examMasterCopyExamPaper(Request $request)
    {
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        return view(
            'admin.copy_acdemic_exam_module.exam_paper',
            [
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }

    // index soap
    public function soap()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $soap_category_list = Helper::GetMethod(config('constants.api.soap_category_list'));
        $soap_list = Helper::GetMethod(config('constants.api.soap_list'));
        $soap_subject_list = Helper::GetMethod(config('constants.api.soap_subject_list'));
        $soap_student_list = Helper::GETMethodWithData(config('constants.api.old_soap_student_list'), $data);
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
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.soap.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'soap_category_list' => isset($soap_category_list['data']) ? $soap_category_list['data'] : [],
                'soap_list' => isset($soap_list['data']) ? $soap_list['data'] : [],
                'soap_subject_list' => isset($soap_subject_list['data']) ? $soap_subject_list['data'] : [],
                'soap_student_list' => isset($soap_student_list['data']) ? $soap_student_list['data'] : [],
                'transport' => isset($gettransport['data']) ? $gettransport['data'] : [],
                'hostel' => isset($gethostel['data']) ? $gethostel['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'parent' => isset($parent['data']) ? $parent['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }

    // index Soap Category
    public function soapCategory()
    {
        return view('admin.soap_category.index');
    }

    public function addSoapCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
            'soap_type_id' => $request->soap_type_id,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_category_add'), $data);
        return $response;
    }
    public function getSoapCategoryList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.soap_category_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('soap_type_id', function ($row) {
                if ($row['soap_type_id'] == "1") {
                    return "Subjective";
                } elseif ($row['soap_type_id'] == "2") {
                    return "Objective";
                } elseif ($row['soap_type_id'] == "3") {
                    return "Assessment";
                } elseif ($row['soap_type_id'] == "4") {
                    return "Plan";
                } else {
                    return "";
                }
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSoapCategoryBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSoapCategoryBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getSoapCategoryDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_category_details'), $data);
        return $response;
    }
    public function updateSoapCategory(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'soap_type_id' => $request->soap_type_id,
        ];

        $response = Helper::PostMethod(config('constants.api.soap_category_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteSoapCategory(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.soap_category_delete'), $data);
        return $response;
    }

    // index Soap Category
    public function soapSubCategory()
    {
        return view('admin.soap_sub_category.index');
    }

    public function addSoapSubCategory(Request $request)
    {

        $base64 = "";
        $extension = "";
        $file = $request->file('photo');
        if ($file) {
            $path = $file->path();
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
            $extension = $file->getClientOriginalExtension();
        }
        // dd($data);
        $data = [
            'name' => $request->name,
            'soap_category_id' => $request->soap_category_id,
            'photo' => $base64,
            'file_extension' => $extension,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_sub_category_add'), $data);
        return $response;
    }
    public function getSoapSubCategoryList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.soap_sub_category_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSoapSubCategoryBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSoapSubCategoryBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getSoapSubCategoryDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_sub_category_details'), $data);
        return $response;
    }
    public function updateSoapSubCategory(Request $request)
    {
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
            'name' => $request->name,
            'soap_category_id' => $request->soap_category_id,
            'photo' => $base64,
            'old_photo' => $request->old_photo,
            'file_extension' => $extension,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_sub_category_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteSoapSubCategory(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.soap_sub_category_delete'), $data);
        return $response;
    }



    // index Soap Category
    public function soapNotes()
    {
        return view('admin.soap_notes.index');
    }

    public function addSoapNotes(Request $request)
    {
        $data = [
            'notes' => $request->notes,
            'soap_category_id' => $request->soap_category_id,
            'soap_sub_category_id' => $request->soap_sub_category_id,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_notes_add'), $data);
        return $response;
    }
    public function getSoapNotesList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.soap_notes_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSoapNotesBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSoapNotesBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getSoapNotesDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.soap_notes_details'), $data);
        return $response;
    }
    public function updateSoapNotes(Request $request)
    {
        $data = [
            'id' => $request->id,
            'notes' => $request->notes,
            'soap_category_id' => $request->soap_category_id,
            'soap_sub_category_id' => $request->soap_sub_category_id,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.soap_notes_update'), $data);
        return $response;
    }
    // DELETE event type Details
    public function deleteSoapNotes(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.soap_notes_delete'), $data);
        return $response;
    }

    public function addSoap(Request $request)
    {
        $data = [
            'notes' => $request->notes,
            'referred_by' => session()->get('ref_user_id'),
            'student_id' => $request->student_id,
            'soap_type_id' => $request->soap_type_id,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.soap_add'), $data);
        // dd($response);
        return $response;
    }
    // createEvent 
    public function createSoapSubject()
    {
        // dd($gettype);
        return view('admin.soap.subject.add');
    }
    // edit Event 
    public function editSoapSubject($id)
    {

        $data = [
            'id' => $id,
        ];
        $getsoapsubject = Helper::PostMethod(config('constants.api.soap_subject_details'), $data);
        return view(
            'admin.soap.subject.edit',
            [
                'soapsubject' => isset($getsoapsubject['data']) ? $getsoapsubject['data'] : [],
            ]
        );
    }


    public function addSoapSubject(Request $request)
    {
        $data = [
            'title' => $request->title,
            'header' => $request->header,
            'body' => $request->body,
            'soap_type_id' => $request->soap_type_id,
            'referred_by' => session()->get('ref_user_id'),
            'student_id' => session()->get('soap_student_id'),
        ];
        // dd(session()->get('soap_student_id'));
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.soap_subject_add'), $data);
        // dd($response);
        return $response;
    }

    public function getSoapSubjectList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.soap_subject_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('admin.soap_subject.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSoapSubjectBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['classname', 'publish', 'actions'])
            ->make(true);
    }
    // Update soap_subject 
    public function updateSoapSubject(Request $request)
    {
        $data = [
            'id' => $request->id,
            'title' => $request->title,
            'header' => $request->header,
            'body' => $request->body,
            'soap_type_id' => $request->soap_type_id,
            'referred_by' => session()->get('ref_user_id'),
            'student_id' => session()->get('soap_student_id')
        ];
        $response = Helper::PostMethod(config('constants.api.soap_subject_update'), $data);
        return $response;
    }
    // DELETE soap_subject 
    public function deleteSoapSubject(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.soap_subject_delete'), $data);
        return $response;
    }


    public function getSoapLogList(Request $request)
    {

        $data = [
            'student_id' => $request->student_id

        ];
        $response = Helper::PostMethod(config('constants.api.soap_log_list'), $data);
        // dd($response);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('soap_type', function ($row) {
                $soap_type = "";
                if ($row['soap_type'] == "1") {
                    $soap_type = "Subjective";
                } else if ($row['soap_type'] == "2") {
                    $soap_type = "Objective";
                } else if ($row['soap_type'] == "3") {
                    $soap_type = "Assessment";
                } else if ($row['soap_type'] == "4") {
                    $soap_type = "Plan";
                }
                return $soap_type;
            })
            ->make(true);
    }

    // index Payment Mode
    public function paymentMode()
    {
        return view('admin.payment_mode.index');
    }

    public function addPaymentMode(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.payment_mode_add'), $data);
        return $response;
    }
    public function getPaymentModeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.payment_mode_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editPaymentModeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deletePaymentModeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getPaymentModeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.payment_mode_details'), $data);
        return $response;
    }
    public function updatePaymentMode(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.payment_mode_update'), $data);
        return $response;
    }
    // DELETE Payment Mode Delete
    public function deletePaymentMode(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.payment_mode_delete'), $data);
        return $response;
    }

    // index Payment Status
    public function paymentStatus()
    {
        return view('admin.payment_status.index');
    }

    public function addPaymentStatus(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.payment_status_add'), $data);
        return $response;
    }
    public function getPaymentStatusList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.payment_status_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editPaymentStatusBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deletePaymentStatusBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getPaymentStatusDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.payment_status_details'), $data);
        return $response;
    }
    public function updatePaymentStatus(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.payment_status_update'), $data);
        return $response;
    }
    // DELETE Payment Status Delete
    public function deletePaymentStatus(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.payment_status_delete'), $data);
        return $response;
    }

    // index FeesType
    public function feesType()
    {
        // dd(session()->get('footer_text'));
        return view('admin.fees_type.index');
    }

    public function addFeesType(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $response = Helper::PostMethod(config('constants.api.fees_type_add'), $data);
        return $response;
    }
    public function getFeesTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.fees_type_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editFeesTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteFeesTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getFeesTypeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.fees_type_details'), $data);
        return $response;
    }
    public function updateFeesType(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name
        ];

        $response = Helper::PostMethod(config('constants.api.fees_type_update'), $data);
        return $response;
    }
    // DELETE Payment Status Delete
    public function deleteFeesType(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.fees_type_delete'), $data);
        return $response;
    }

    // student leave 
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
    // index Fees
    public function fees()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $fees_type = Helper::GetMethod(config('constants.api.fees_type_list'));
        $payment_status = Helper::GetMethod(config('constants.api.payment_status_list'));
        $fees_group_list = Helper::GETMethodWithData(config('constants.api.fees_group_list'), $data);
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.fees.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'fees_type' => isset($fees_type['data']) ? $fees_type['data'] : [],
                'payment_status' => isset($payment_status['data']) ? $payment_status['data'] : [],
                'fees_group_list' => isset($fees_group_list['data']) ? $fees_group_list['data'] : []
            ]
        );
    }
    public function feesImportExpense()
    {
        return view('admin.fees.expense_import');
    }
    public function feesExpenseIndex()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.fees.expense_list',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }

    public function feesExpenseUpdate(Request $request)
    {
        // dd($request);
        $value = "";
        if ($request->semester_1) {
            $name = "semester_1";
            $value = $request->semester_1;
        } else if ($request->semester_2) {
            $name = "semester_2";
            $value = $request->semester_2;
        } else if ($request->semester_3) {
            $name = "semester_3";
            $value = $request->semester_3;
        }
        $data = [
            'id' => $request->id,
            $name => $value,
            'student_id' => $request->student_id,
            'academic_year' => $request->academic_year
        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.fees_expense_update'), $data);
        return $response;
    }
    public function feesImportExpenseAdd(Request $request)
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
            // dd($data);
            $response = Helper::PostMethod(config('constants.api.import_expense'), $data);
            if ($response['code'] == 200) {

                return redirect()->route('admin.fees.import')->with('success', 'Expense Imported Successfully');
            } else {
                return redirect()->route('admin.fees.import')->with('errors', $response['data']);
            }
        }
    }

    public function editFees($id)
    {
        $data = [
            'student_id' => $id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $payment_mode = Helper::GetMethod(config('constants.api.payment_mode_list'));
        $payment_status = Helper::GetMethod(config('constants.api.payment_status_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $fees = Helper::PostMethod(config('constants.api.fees_details'), $data);
        $student_fees_history = Helper::PostMethod(config('constants.api.student_fees_history'), $data);
        $month = [["name" => 'January', 'id' => 1], ["name" => 'February', 'id' => 2], ["name" => 'March', 'id' => 3], ["name" => 'April', 'id' => 4], ["name" => 'May', 'id' => 5], ["name" => 'June', 'id' => 6], ["name" => 'July', 'id' => 7], ["name" => 'August', 'id' => 8], ["name" => 'September', 'id' => 9], ["name" => 'October', 'id' => 10], ["name" => 'November', 'id' => 11], ["name" => 'December', 'id' => 12]];
        // dd($fees);
        return view(
            'admin.fees.edit',
            [
                'student_id' => $id,
                'student' => isset($fees['data']['student']) ? $fees['data']['student'] : [],
                'fees' => isset($fees['data']['fees']) ? $fees['data']['fees'] : [],
                'student_fees_history' => isset($student_fees_history['data']) ? $student_fees_history['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'payment_mode' => isset($payment_mode['data']) ? $payment_mode['data'] : [],
                'payment_status' => isset($payment_status['data']) ? $payment_status['data'] : [],
                'month' => isset($month) ? $month : [],
            ]
        );
    }
    public function updateFees(Request $request)
    {
        if ($request->payment_mode) {
            $payment_mode = $request->payment_mode;
        } else {
            $payment_mode = $request->payment_mode_onload;
        }
        $data = [
            'academic_session_id' => session()->get('academic_session_id'),
            'student_id' => $request->student_id,
            'collect_by' => session()->get('ref_user_id'),
            'fees_type' => $request->fees_type,
            'allocation_id' => $request->allocation_id,
            'fees_group_id' => $request->fees_group_id,
            'payment_mode' => $payment_mode,
            'fees' => $request->fees[$payment_mode]
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.fees_update'), $data);
        // dd($response);
        return $response;
    }
    // index Fees
    public function feesAllocation()
    {
        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $fees_group_list = Helper::GETMethodWithData(config('constants.api.fees_group_list'), $data);

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        // $fees_group_list = Helper::GetMethod(config('constants.api.fees_group_list'));
        // dd($fees_group_list);
        return view(
            'admin.fees.fees_allocation',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'fees_group_list' => isset($fees_group_list['data']) ? $fees_group_list['data'] : []
            ]
        );
    }
    // index FeesGroup
    public function feesGroup()
    {
        return view('admin.fees_group.index');
    }

    public function createFeesGroup()
    {
        $payment_mode = Helper::GetMethod(config('constants.api.payment_mode_list'));
        $fees_type = Helper::GetMethod(config('constants.api.fees_type_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $month = [["name" => 'January', 'id' => 1], ["name" => 'February', 'id' => 2], ["name" => 'March', 'id' => 3], ["name" => 'April', 'id' => 4], ["name" => 'May', 'id' => 5], ["name" => 'June', 'id' => 6], ["name" => 'July', 'id' => 7], ["name" => 'August', 'id' => 8], ["name" => 'September', 'id' => 9], ["name" => 'October', 'id' => 10], ["name" => 'November', 'id' => 11], ["name" => 'December', 'id' => 12]];
        // order wise yearly semester monthly data
        // $Yearly = "";
        // $Semester = "";
        // $Monthly = "";
        // foreach ($payment_mode['data'] as $key => $fs) {
        //     $Yearly = $fs['name'];
        //     $Semester = $fs['name'];
        //     $Monthly = $fs['name'];
        // }

        // dd($payment_mode['data'][0]['name']);
        return view(
            'admin.fees_group.add',
            [
                'fees_type' => isset($fees_type['data']) ? $fees_type['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'month' => isset($month) ? $month : [],
                'Yearly' => isset($payment_mode['data'][0]['name']) ?  __('messages.' . strtolower($payment_mode['data'][0]['name']))  : '0',
                'Yearly_ID' => isset($payment_mode['data'][0]['id']) ? $payment_mode['data'][0]['id'] : '0',
                'Semester' => isset($payment_mode['data'][1]['name']) ? __('messages.' . strtolower($payment_mode['data'][1]['name'])) : '1',
                'Semester_ID' => isset($payment_mode['data'][1]['id']) ? $payment_mode['data'][1]['id'] : '1',
                'Monthly' => isset($payment_mode['data'][2]['name']) ? __('messages.' . strtolower($payment_mode['data'][2]['name'])) : '2',
                'Monthly_ID' => isset($payment_mode['data'][2]['id']) ? $payment_mode['data'][2]['id'] : '2',
            ]
        );
    }

    public function addFeesGroup(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.fees_group_add'), $data);
        // dd($response);
        return $response;
    }
    public function editFeesGroup($id)
    {
        $data = [
            'id' => $id,
        ];
        $payment_mode = Helper::GetMethod(config('constants.api.payment_mode_list'));
        // $fees_type = Helper::GetMethod(config('constants.api.fees_type_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));

        // $payment_mode = Helper::GetMethod(config('constants.api.payment_mode_list'));
        // $fees_type = Helper::GetMethod(config('constants.api.fees_type_list'));
        // $semester = Helper::GetMethod(config('constants.api.semester'));
        $month = [["name" => 'January', 'id' => 1], ["name" => 'February', 'id' => 2], ["name" => 'March', 'id' => 3], ["name" => 'April', 'id' => 4], ["name" => 'May', 'id' => 5], ["name" => 'June', 'id' => 6], ["name" => 'July', 'id' => 7], ["name" => 'August', 'id' => 8], ["name" => 'September', 'id' => 9], ["name" => 'October', 'id' => 10], ["name" => 'November', 'id' => 11], ["name" => 'December', 'id' => 12]];

        $fees_group = Helper::PostMethod(config('constants.api.fees_group_details'), $data);
        // dd($fees_group);
        // dd($fees_group['data']['fees_group_details']);
        // foreach($fees_type['data'] as $type) {
        //     if($fees_group['data']['fees_group_details']['fees_type_id']==$type['id']) {
        //         dd($fees_group['data']['fees_group_details']);
        //     }
        // }
        return view(
            'admin.fees_group.edit',
            [
                // 'fees_type' => $fees_type['data'],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'payment_mode' => isset($payment_mode['data']) ? $payment_mode['data'] : [],
                'month' => isset($month) ? $month : [],
                'Yearly' => isset($payment_mode['data'][0]['name']) ? __('messages.' . strtolower($payment_mode['data'][0]['name'])) : '0',
                'Yearly_ID' => isset($payment_mode['data'][0]['id']) ? $payment_mode['data'][0]['id'] : '0',
                'Semester' => isset($payment_mode['data'][1]['name']) ? __('messages.' . strtolower($payment_mode['data'][1]['name'])) : '1',
                'Semester_ID' => isset($payment_mode['data'][1]['id']) ? $payment_mode['data'][1]['id'] : '1',
                'Monthly' => isset($payment_mode['data'][2]['name']) ? __('messages.' . strtolower($payment_mode['data'][2]['name'])) : '2',
                'Monthly_ID' => isset($payment_mode['data'][2]['id']) ? $payment_mode['data'][2]['id'] : '2',
                'fees_type_fees_group_details' => isset($fees_group['data']['fees_group_details']) ? $fees_group['data']['fees_group_details'] : [],
                'fees_group' => isset($fees_group['data']['fees_group']) ? $fees_group['data']['fees_group'] : []
            ]
        );
    }
    public function getFeesGroupList(Request $request)
    {

        $data = [
            'academic_session_id' => session()->get('academic_session_id')
        ];
        $response = Helper::GETMethodWithData(config('constants.api.fees_group_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="' . route('admin.fees_group.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteFeesGroupBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function updateFeesGroup(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $response = Helper::PostMethod(config('constants.api.fees_group_update'), $data);
        // dd($response);
        return $response;
    }
    // DELETE Payment Status Delete
    public function deleteFeesGroup(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.fees_group_delete'), $data);
        return $response;
    }
    function addFeesAllocation(Request $request)
    {
        $data = [
            "delete_student_operations" => $request->delete_student_operations,
            "student_operations" => $request->student_operations,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "group_id" => $request->group_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.add_fees_allocation'), $data);
        return $response;
    }
    public function feesDelete(Request $request)
    {
        $data = [
            'student_id' => $request->id,
            'academic_session_id' => session()->get('academic_session_id'),
        ];
        $response = Helper::PostMethod(config('constants.api.fees_delete'), $data);
        return $response;
    }

    public function employeeImport(Request $request)
    {
        return view('admin.import.employee');
    }

    public function employeeImportAdd(Request $request)
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
            $response = Helper::PostMethod(config('constants.api.import_employee'), $data);
            if ($response['code'] == 200) {

                return redirect()->route('admin.employee.import')->with('success', ' Employee Imported Successfully');
            } else {
                return redirect()->route('admin.employee.import')->with('errors', $response['data']);
            }
        }
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

    public function parentImport(Request $request)
    {
        return view('admin.import.parent');
    }

    public function parentImportAdd(Request $request)
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
            $response = Helper::PostMethod(config('constants.api.import_parent'), $data);
            if ($response['code'] == 200) {

                return redirect()->route('admin.parent.import')->with('success', ' Parent Imported Successfully');
            } else {
                return redirect()->route('admin.parent.import')->with('errors', $response['data']);
            }
        }
    }

    public function studentImport(Request $request)
    {
        return view('admin.import.student');
    }

    public function studentImportAdd(Request $request)
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
            $response = Helper::PostMethod(config('constants.api.import_student'), $data);
            if ($response['code'] == 200) {

                return redirect()->route('admin.student.import')->with('success', ' Student Imported Successfully');
            } else {
                return redirect()->route('admin.student.import')->with('errors', $response['data']);
            }
        }
    }
    public function twoFA()
    {
        // $data = [
        //     'email' => session()->get('email'),
        //     'name' => session()->get('name'),
        //     'role_name' => session()->get('role_name')

        // ];
        // dd($data);
        return view(
            'admin.twofa.index'
            // [
            //     'data' => $data,
            // ]
        );
    }

    public function applicationIndex()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.application.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
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
                } else if ($status == "Process") {
                    $result = "info";
                } else if ($status == "Reject") {
                    $result = "danger";
                } else {
                    $result = "";
                }

                return '<span class="badge badge-soft-' . $result . ' p-1">' . $status . '</span>';
            })
            ->addColumn('actions', function ($row) {
                $edit = route('admin.application.edit', $row['id']);
                // <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" id="viewApplicationBtn"><i class="fe-eye"></i></a>

                return '<div class="button-list">
                <a href="' . $edit . '" class="btn btn-warning waves-effect waves-light" ><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteApplicationBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions', 'status', 'phase_2_status'])
            ->make(true);
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
        // dd($application);
        $dep_data = [
            "department_id" => isset($application['data']['enrolled_department']) ? $application['data']['enrolled_department'] : ""
        ];
        $class_data = [
            "class_id" => isset($application['data']['enrolled_grade']) ? $application['data']['enrolled_grade'] : ""
        ];
        $department = Helper::GetMethod(config('constants.api.department_list'));
        if (isset($application['data']['enrolled_grade'])) {

            $gradebydepartment = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $dep_data);
        }
        if (isset($application['data']['enrolled_grade'])) {

            $section_by_class = Helper::PostMethod(config('constants.api.section_by_class'), $class_data);
        }
        // dd($gradebydepartment);
        return view(
            'admin.application.edit',
            [
                'application' => isset($application['data']) ? $application['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'gradebydepartment' => isset($gradebydepartment['data']) ? $gradebydepartment['data'] : [],
                'section_by_class' => isset($section_by_class['data']) ? $section_by_class['data'] : [],
            ]
        );
    }

    // DELETE Application Details
    public function deleteApplication(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.application_delete'), $data);
        return $response;
    }


    // approve application
    public function approveApplication(Request $request)
    {
        $data = [
            'id' => $request->id,
            'status' => $request->status
        ];
        $response = Helper::PostMethod(config('constants.api.application_approve'), $data);
        return $response;
    }

    // public function getApplicationDetails($id)
    // {

    //     $data = [
    //         'id' => $id,
    //     ];

    //     $getclass = Helper::GetMethod(config('constants.api.class_list'));
    //     $relation = Helper::GetMethod(config('constants.api.relation_list'));
    //     $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));


    //     $application = Helper::PostMethod(config('constants.api.application_details'), $data);
    //     return view(
    //         'admin.application.edit',
    //         [
    //             'grade' => isset($getclass['data']) ? $getclass['data'] : [],
    //             'relation' => isset($relation['data']) ? $relation['data'] : [],
    //             'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
    //             'application' => isset($application['data']) ? $application['data'] : [],
    //         ]
    //     );
    // }


    public function updateApplication(Request $request)
    {
        $trail_date = "";
        if ($request->enrollment == "Trail Enrollment") {
            $trail_date = $request->trail_date;
        }
        $official_date = "";
        if ($request->enrollment == "Official Enrollment") {
            $official_date = $request->official_date;
        }
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
            'academic_grade' => $request->academic_grade,
            'academic_year' => $request->academic_year,
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
            'status' => $request->status,
            'enrollment' => $request->enrollment,
            'trail_date' => $trail_date,
            'official_date' => $official_date,
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
            'phase_2_status' => $request->phase_2_status,
            'phase_1_reason' => $request->phase_1_reason,
            'phase_2_reason' => $request->phase_2_reason,
            'register_number' => $request->register_number,
            'phase_2_status_old' => $request->phase_2_status_old,
            'status_old' => $request->status_old,
            'role_id' => session()->get('role_id'),




            "middle_name" => $request->middle_name,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            "dual_nationality" => $request->dual_nationality,
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

            "status_after_approval" => $request->status_after_approval,
            "enrolled_academic_year" => $request->enrolled_academic_year,
            "enrolled_department" => $request->enrolled_department,
            "enrolled_grade" => $request->enrolled_grade,
            "enrolled_class" => $request->enrolled_class,
            'url' => url('/'),
        ];
        // dd($data);
        // return $data;
        $response = Helper::PostMethod(config('constants.api.application_update'), $data);

        return $response;
    }
    // index FeesGroup
    public function logactivity()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));

        $data = [
            'status' => "All"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        //dd($roles);
        return view(
            'admin.activity_monitoring.index',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
            ]
        );
    }
    public function login_activity(Request $request)
    {
        $data = [
            'branch_id' => session()->get('branch_id'),
            'role_id' => $request->role_id,
            'frm_ldate' => date('Y-m-d', strtotime($request->frm_ldate)),
            'to_ldate' => date('Y-m-d', strtotime($request->to_ldate))
        ];
        $activity_list = Helper::GETMethodWithData(config('constants.api.login_activity_list'), $data);
        //$data = isset($response['data']) ? $response['data'] : [];
        return $activity_list;
        /*return view('admin.activity_monitoring.index', [
            'activity_list' => !empty($activity_list['data']) ? $activity_list['data'] : []
        ]);*/
    }
    public function logmodifydatas()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        $modifyusers = Helper::GetMethod(config('constants.api.getlogmodifyusers'));
        $modifytables = Helper::GetMethod(config('constants.api.getlogmodifytables'));
        $data = [
            'status' => "All"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        //dd($modifytables);
        return view(
            'admin.activity_monitoring.logmodifydatas',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'modifyusers' => isset($modifyusers['data']) ? $modifyusers['data'] : [],
                'modifytables' => isset($modifytables['data']) ? $modifytables['data'] : [],
            ]
        );
    }
    public function log_modifylist(Request $request)
    {
        $data = [
            'branch_id' => session()->get('branch_id'),
            'user_id' => $request->user_id,
            'tablename' => $request->tablename,
            'frm_ldate' => date('Y-m-d', strtotime($request->frm_ldate)),
            'to_ldate' => date('Y-m-d', strtotime($request->to_ldate))
        ];
        $activity_list = Helper::GETMethodWithData(config('constants.api.log_modifylist'), $data);

        return $activity_list;
    }
    public function menuaccess()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        //$menus = Helper::GetMethod(config('constants.api.menus'));
        $data = [
            'status' => "All"
        ];
        $mainmenudata = [
            'type' => "Mainmenu"
        ];
        $submenudata = [
            'type' => "Submenu"
        ];
        $childmenudata = [
            'type' => "Childmenu"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $mainmenu = Helper::PostMethod(config('constants.api.menus_list'), $mainmenudata);
        $submenu = Helper::PostMethod(config('constants.api.menus_list'), $submenudata);
        $childmenu = Helper::PostMethod(config('constants.api.menus_list'), $childmenudata);

        return view(
            'admin.activity_monitoring.menuaccess',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'mainmenu' => isset($mainmenu['data']) ? $mainmenu['data'] : [],
                'submenu' => isset($submenu['data']) ? $submenu['data'] : [],
                'childmenu' => isset($childmenu['data']) ? $childmenu['data'] : []
            ]
        );
    }
    // start Check In Out Time
    public function checkInOutTime()
    {
        return view('admin.check_in_out_time.index');
    }
    public function getCheckInOutTimeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.check_in_out_time_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editCheckInOutTimeBtn"><i class="fe-edit"></i></a>
                        </div>';
            })

            // <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteCheckInOutTimeBtn"><i class="fe-trash-2"></i></a>
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getCheckInOutTimeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.check_in_out_time_details'), $data);
        return $response;
    }
    public function updateCheckInOutTime(Request $request)
    {
        $data = [
            'id' => $request->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'updated_by' => session()->get('ref_user_id'),
        ];

        $response = Helper::PostMethod(config('constants.api.check_in_out_time_update'), $data);
        if ($response['code'] == 200) {

            $request->session()->pull('check_in_time');
            $request->session()->pull('check_out_time');
            $request->session()->put('check_in_time', $request->check_in);
            $request->session()->put('check_out_time', $request->check_out);
        }
        return $response;
    }
    // end Check In Out Time
    // index holidays
    public function holidays()
    {
        return view(
            'admin.holidays.index'
        );
    }
    public function getHolidaysList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.holidays_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editHolidaysBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteHolidaysBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function addHolidays(Request $request)
    {
        $data = [
            'name' => $request->name,
            'date' => $request->date,
            'created_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.holidays_add'), $data);
        return $response;
    }
    public function getHolidaysDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.holidays_details'), $data);
        return $response;
    }
    public function updateHolidays(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'date' => $request->date,
            'updated_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.holidays_update'), $data);
        return $response;
    }
    public function deleteHolidays(Request $request)
    {
        $data = [
            'id' => $request->id,
            'deleted_by' => session()->get('ref_user_id')
        ];

        $response = Helper::PostMethod(config('constants.api.holidays_delete'), $data);
        return $response;
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

    // index BankAccount 
    public function bankAccount()
    {
        return view('admin.bank_account.index');
    }
    // create Event 
    public function createBankAccount()
    {
        $data = [
            'country' => "Malaysia",
        ];

        $bank = Helper::GETMethodWithData(config('constants.api.bank_list'), $data);
        return view(
            'admin.bank_account.add',
            [
                'bank' => isset($bank['data']) ? $bank['data'] : [],
            ]
        );
    }
    // edit Event 
    public function editBankAccount($id)
    {

        $data = [
            'id' => $id,
        ];
        $bank_account = Helper::PostMethod(config('constants.api.bank_account_details'), $data);
        $country = [
            'country' => isset($bank_account['data']['country']) ? $bank_account['data']['country'] : null
        ];
        $bank = Helper::GETMethodWithData(config('constants.api.bank_list'), $country);
        return view(
            'admin.bank_account.edit',
            [
                'bank' => isset($bank['data']) ? $bank['data'] : [],
                'bank_account' => isset($bank_account['data']) ? $bank_account['data'] : [],
            ]
        );
    }
    public function addBankAccount(Request $request)
    {
        $data = [
            'bank_name' => $request->bank_name,
            'holder_name' => $request->holder_name,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'bank_address_2' => $request->bank_address_2,
            'ifsc_code' => $request->ifsc_code,
            'city' => $request->city,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'routing_number' => $request->routing_number,
            'swift_code' => $request->swift_code,
            'email' => $request->email,
            'account_no' => $request->account_no,
            'status' => $request->status,
            'created_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bank_account_add'), $data);
        // dd($response);
        return $response;
    }

    public function getBankAccountList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.bank_account_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $status = "";
                if ($row['status'] == "1") {
                    $status = "checked";
                }

                // return '<input type="checkbox" ' . $status . ' data-id="' . $row['id'] . '"  id="bankAccountStatusBtn">';
                return '<div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input bankAccountStatusBtn"  data-id="' . $row['id'] . '" id="bankAccountStatusBtn' . $row['id'] . '" ' . $status . '>
                            <label class="custom-control-label" for="bankAccountStatusBtn' . $row['id'] . '"></label>
                        </div>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                            <a href="' . route('admin.bank_account.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBankAccountBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
    // Update bank_account 
    public function updateBankAccount(Request $request)
    {
        $data = [
            'id' => $request->id,
            'bank_name' => $request->bank_name,
            'holder_name' => $request->holder_name,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'bank_address_2' => $request->bank_address_2,
            'ifsc_code' => $request->ifsc_code,
            'city' => $request->city,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'country' => $request->country,
            'routing_number' => $request->routing_number,
            'swift_code' => $request->swift_code,
            'email' => $request->email,
            'account_no' => $request->account_no,
            'status' => $request->status,
            'updated_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.bank_account_update'), $data);
        return $response;
    }
    // DELETE bank_account 
    public function deleteBankAccount(Request $request)
    {
        $data = [
            'id' => $request->id,
            'deleted_by' => session()->get('ref_user_id')
        ];

        $response = Helper::PostMethod(config('constants.api.bank_account_delete'), $data);
        return $response;
    }

    // bank Account Status
    public function bankAccountStatus(Request $request)
    {
        $data = [
            'id' => $request->id,
            'status' => $request->status
        ];
        $response = Helper::PostMethod(config('constants.api.bank_account_status'), $data);
        return $response;
    }
    // index bank
    public function bank()
    {
        return view('admin.bank.index');
    }

    public function addBank(Request $request)
    {
        $data = [
            'name' => $request->name,
            'country' => $request->country
        ];
        $response = Helper::PostMethod(config('constants.api.bank_add'), $data);
        return $response;
    }
    public function getBankList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.bank_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editBankBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBankBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getBankDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.bank_details'), $data);
        return $response;
    }
    public function updateBank(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'country' => $request->country
        ];
        $response = Helper::PostMethod(config('constants.api.bank_update'), $data);
        return $response;
    }
    // DELETE Bank Details
    public function deleteBank(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.bank_delete'), $data);
        return $response;
    }
    // index School Roles
    public function school_role()
    {
        $data = [
            'status' => "0"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $portal_roles = Helper::PostMethod(config('constants.api.portal_roles'), $data);
        //dd($portal_roles);
        return view(
            'admin.school_roles.index',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'portal_roles' => isset($portal_roles['data']) ? $portal_roles['data'] : []
            ]
        );
    }
    public function addschool_role(Request $request)
    {
        $data = [
            'portal_roleid' => $request->portal_roleid,
            'fullname' => $request->fullname,
            'shortname' => $request->shortname,
        ];
        $response = Helper::PostMethod(config('constants.api.school_role_add'), $data);
        return $response;
    }

    public function getschool_roleList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.school_role_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        $a = 1;
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('color', function ($row) {
                return '<span style="color:' . $row['shortname'] . '" >' . $row['shortname'] . '</span>';
            })
            ->addColumn('actions', function ($row) use ($a) {

                return '<div class="button-list">
                                
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSchoolRoleBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSchoolRoleBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['shortname', 'actions'])
            ->make(true);
    }
    public function getschool_roleDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.school_role_details'), $data);
        return $response;
    }
    public function school_menurole_details(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.school_menurole_details'), $data);
        return $response;
    }

    public function updateschool_role(Request $request)
    {
        $data = [
            'id' => $request->id,
            'portal_roleid' => $request->portal_roleid,
            'fullname' => $request->fullname,
            'shortname' => $request->shortname,
        ];

        $response = Helper::PostMethod(config('constants.api.school_role_update'), $data);
        return $response;
    }
    public function deleteschool_role(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.school_role_delete'), $data);
        return $response;
    }

    public function rollmenuaccess(Request $request)
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        //$menus = Helper::GetMethod(config('constants.api.menus'));
        $data = [
            'status' => "All"
        ];

        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));

        return view(
            'admin.school_roles.menuaccess',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'mainmenu' =>  [],
                'submenu' => [],
                'childmenu' =>  []
            ]
        );
    }
    public function getmenus1(Request $request)
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        //$menus = Helper::GetMethod(config('constants.api.menus'));
        $data = [
            'status' => "All"
        ];

        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));

        return view(
            'admin.school_roles.menuaccess',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'mainmenu' =>  [],
                'submenu' => [],
                'childmenu' =>  []
            ]
        );
    }
    public function getmenus(Request $request)
    {
        $role_id = $request->role_id;
        $branch_id = config('constants.branch_id');

        $school_roleid = $request->school_roleid;
        // dd($school_roleid);
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        //$menus = Helper::GetMethod(config('constants.api.menus'));
        $data = [
            'status' => "All"
        ];
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        $mainmenudata = [
            'role_id' => $role_id,
            'br_id' => $branch_id,
            'scrole_id' => $school_roleid,
            'type' => 'Mainmenu'
        ];
        // dd($mainmenudata);
        $submenudata = [
            'role_id' => $role_id,
            'br_id' => $branch_id,
            'scrole_id' => $school_roleid,
            'type' => "Submenu"
        ];
        $childmenudata = [
            'role_id' => $role_id,
            'br_id' => $branch_id,
            'scrole_id' => $school_roleid,
            'type' => "Childmenu"
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);

        $mainmenu = Helper::PostMethod(config('constants.api.schoolmenuaccess_list'), $mainmenudata);
        $submenu = Helper::PostMethod(config('constants.api.schoolmenuaccess_list'), $submenudata);
        $childmenu = Helper::PostMethod(config('constants.api.schoolmenuaccess_list'), $childmenudata);
        // dd($mainmenu);
        return view(
            'admin.school_roles.menuaccess',
            [
                'roles' => isset($roles['data']) ? $roles['data'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
                'branches' => isset($getBranches['data']) ? $getBranches['data'] : [],
                'mainmenu' => isset($mainmenu['data']) ? $mainmenu['data'] : [],
                'submenu' => isset($submenu['data']) ? $submenu['data'] : [],
                'childmenu' => isset($childmenu['data']) ? $childmenu['data'] : [],
                'role_id' => $role_id,
                'branch_id' => $branch_id,
                'school_roleid' => $school_roleid
            ]
        );
    }
    public function setpermission(Request $request)
    {

        $data = [
            'role_id' => $request->role_id,
            'school_roleid' => $request->school_roleid,
            'menu_id' => $request->menu_id,
            'menuaccess_id' => $request->menuaccess_id,
            'act' => $request->act,
            'read' => $request->read,
            'add' => $request->add,
            'updates' => $request->updates,
            'deletes' => $request->deletes,
            'export' => $request->export
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.setschoolpermission'), $data);
        // dd($response);
        //return redirect('admin/school_role/menuaccess');
        if ($response['code'] == 200) {
            return redirect()->route('admin.school_role.menuaccess')->with('success', $response['message']);
        } else {
            return redirect()->route('admin.school_role.menuaccess')->with('errors', $response['message']);
        }
    }
    public function deleteschoolpermission(Request $request)
    {

        $data = [
            'role_id' => $request->role_id,
            'br_id' => $request->branch_id,
            'school_roleid' => $request->school_roleid

        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.deleteschoolpermission'), $data);
        // dd($response);
        //return redirect('admin/school_role/menuaccess');
        if ($response['code'] == 200) {
            return redirect()->route('admin.school_role.menuaccess')->with('success', $response['message']);
        } else {
            return redirect()->route('admin.school_role.menuaccess')->with('errors', $response['message']);
        }
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
        // dd($pagedata);
        $page = Helper::PostMethod(config('constants.api.getschoolroleaccess'), $pagedata);
        return $page;
    }
    // dashboard widget
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

        return view('admin.settings.dashboard_widget', [

            'get_data_hide_unhide_dashboard' => isset($get_data_hide_unhide_dashboard['data']) ? $get_data_hide_unhide_dashboard['data'] : [],
            'get_settings_row' => isset($response['data']) ? $response['data'] : [],
            'department' => isset($department['data']) ? $department['data'] : [],
            // 'term' => isset($term['data']) ? $term['data'] : [],
            // 'semester' => isset($semester['data']) ? $semester['data'] : [],
            // 'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
        ]);
        // return view('admin.settings.dashboard_widget');
        // $workWeek = Helper::GetMethod(config('constants.api.work_week_get'));
        // return view(
        //     'admin.work_week.index',
        //     [
        //         'workWeek' => isset($workWeek['data']) ? $workWeek['data'] : [],
        //     ]
        // );
    }
    // work week
    public function workWeek()
    {
        $workWeek = Helper::GetMethod(config('constants.api.work_week_get'));
        return view(
            'admin.work_week.index',
            [
                'workWeek' => isset($workWeek['data']) ? $workWeek['data'] : [],
            ]
        );
    }
    public function workWeekUpdate(Request $request)
    {
        // dd($request);
        $data = [
            'work_weeks' => $request->work_weeks
        ];
        $response = Helper::PostMethod(config('constants.api.work_week_update'), $data);
        // dd($response);
        return $response;
    }
    public function buletin_board()
    {
        $user_id = session()->get('role_id');
        $data = [
            'user_id' => $user_id,
        ];
        $usernames = Helper::GETMethodWithData(config('constants.api.buletin_board_usernames'), $data);
        $getClasses = Helper::GetMethod(config('constants.api.class_list'));
        $emp_department = Helper::PostMethod(config('constants.api.emp_department'), []);
        return view(
            'admin.buletin_board.index',
            [
                'classDetails' => isset($getClasses['data']) ? $getClasses['data'] : [],
                'emp_department' => isset($emp_department['data']) ? $emp_department['data'] : [],
                'usernames' => isset($usernames['data']) ? $usernames['data'] : []
            ]
        );
    }
    public function getBuletinBoardList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.buletin_board_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('target_user', function ($row) {
                $targetUser = 'Target Users: ' . $row['name'];

                if (!empty($row['grade_name'])) {
                    $targetUser .= '<br>Grade: ' . $row['grade_name'];
                }

                if (!empty($row['section_name'])) {
                    $targetUser .= '<br>Class: ' . $row['section_name'];
                }

                // Check if "admin" and "student" are in the target user names
                if (strpos($row['name'], 'Admin') !== false && strpos($row['name'], 'Student') !== false) {
                    if (!empty($row['student_name'])) {
                        $targetUser .= '<br>Student: ' . $row['student_name'];
                    }
                } elseif (strpos($row['name'], 'Admin') !== false && strpos($row['name'], 'Teacher') !== false) {
                    if (!empty($row['department_name'])) {
                        $targetUser .= '<br>Department: ' . $row['department_name'];
                    }
                } else {
                    if (!empty($row['parent_name'])) {
                        $targetUser .= '<br>Parent: ' . $row['parent_name'];
                    }
                }

                return $targetUser;
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-id="' . $row['id'] . '" id="viewBuletinBtn"><i class="fe-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light"  data-id="' . $row['id'] . '" id="editBuletinBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBuletin_boardBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            ->rawColumns(['target_user', 'actions'])
            ->make(true);
    }
    public function addBuletinBoard(Request $request)
    {


        // Retrieve the selected values as an array
        $targetUsers = $request->input('target_user', []);

        // Ensure $targetUsers is an array
        if (!is_array($targetUsers)) {
            $targetUsers = [$targetUsers];
        }

        // Implode the array with commas
        $targetUserString = implode(',', $targetUsers);

        // Assuming the admin ID is 2 (replace with the actual admin ID)
        $adminId = 2;

        // Concatenate the admin ID with the target users
        $rollid_target_user = $adminId . ',' . $targetUserString;
        $file = $request->file('file');
        $path = $file->path();
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        $extension = $file->getClientOriginalExtension();
        $data = [
            'title' => $request->title,
            'description' => $request->discription,
            'file' => $base64,
            'file_extension' => $extension,
            'target_user' => $rollid_target_user,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'student_id' =>  $request->student_id,
            'parent_id' =>  $request->parent_id,
            'department_id' => $request->empDepartment,
            'publish' => $request->publish,
            'add_to_dash' => $request->add_to_dash,
            'publish_date' => $request->date,
            'publish_end_date' => $request->endDate,
            'created_by' => session()->get('ref_user_id')

        ];
        $response = Helper::PostMethod(config('constants.api.buletin_board_add'), $data);
        // dd($response);
        return $response;
    }
    public function deleteBuletinBoard(Request $request)
    {
        $data = [
            'id' => $request->id,
            'deleted_by' => session()->get('ref_user_id')
        ];

        $response = Helper::PostMethod(config('constants.api.buletin_board_delete'), $data);
        return $response;
    }
    public function getBuletinBoardDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.buletin_board_details'), $data);
        return $response;
    }
    public function editBuletinBoard($id)
    {

        $data = [
            'id' => $id,
        ];
        $response = Helper::PostMethod(config('constants.api.buletin_board_details'), $data);

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettype = Helper::GetMethod(config('constants.api.event_type_list'));
        $getgroup = Helper::GetMethod(config('constants.api.group_list'));

        return view(
            'admin.buletin_board.edit',
            [
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'type' => isset($gettype['data']) ? $gettype['data'] : [],
                'group' => isset($getgroup['data']) ? $getgroup['data'] : [],
                'event' => isset($response['data']) ? $response['data'] : [],
            ]
        );
    }
    public function updateBuletinBoard(Request $request)
    {

        // Retrieve the selected values as an array
        $targetUsers = $request->input('target_user', []);

        // Ensure $targetUsers is an array
        if (!is_array($targetUsers)) {
            $targetUsers = [$targetUsers];
        }

        // Implode the array with commas
        $targetUserString = implode(',', $targetUsers);

        // Assuming the admin ID is 2 (replace with the actual admin ID)
        $adminId = 2;

        // Concatenate the admin ID with the target users
        $rollid_target_user = $adminId . ',' . $targetUserString;
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
            'title' => $request->title,
            'description' => $request->discription,
            'file' => $base64,
            'file_extension' => $extension,
            'oldfile' => $request->oldfile,
            'target_user' => $rollid_target_user,
            'publish' => $request->publish,
            'publish_date' => $request->date,
            'publish_end_dates' => $request->publish_end_dates,
            'updated_by' => session()->get('ref_user_id')
        ];
        $response = Helper::PostMethod(config('constants.api.buletin_board_update'), $data);
        return $response;
    }
    public function retired_person()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($session);
        return view(
            'admin.retired_person.retired_person',
            [
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function retiredPersonList(Request $request)
    {
        // $data = [
        //     "working_status" => $request->employee_type
        // ];
        $response = Helper::GetMethod(config('constants.api.retired_list'));
        $data = isset($response['data']['staff']) ? $response['data']['staff'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('designation_name', function ($row) {
                return  $row['designation_name'];
            })
            ->addColumn('tenure', function ($row) {
                $joiningDate =  $row['joining_date'];
                $relieveDate = $row['releive_date'];
                $relieveDate = empty($relieveDate) ? date('Y-m-d') : $relieveDate;
                // Create DateTime objects for joining and relieve dates
                $joiningDateTime = new DateTime($joiningDate);
                $relieveDateTime = new DateTime($relieveDate);

                // Calculate the difference between the dates
                $interval = $joiningDateTime->diff($relieveDateTime);

                if ($interval->y > 0) {
                    return $tenure = $interval->y . ' year' . ($interval->y !== 1 ? 's' : '');
                } else if ($interval->m > 0) {
                    return  $tenure = $interval->m . ' month' . ($interval->m !== 1 ? 's' : '');
                } else {
                    return $tenure = $interval->d . ' day' . ($interval->d !== 1 ? 's' : '');
                }
            })

            ->addColumn('actions', function ($row) {
                $edit = route('admin.student.details', $row['id']);
                return '<div class="button-list">
                                <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editStudentBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteStudentBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['tenure', 'designation_name', 'actions'])
            ->make(true);
    }
    // index Email Type
    public function emailType()
    {
        return view('admin.email_type.index');
    }

    public function addEmailType(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        $response = Helper::PostMethod(config('constants.api.email_type_add'), $data);
        return $response;
    }
    public function getEmailTypeList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.email_type_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEmailTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEmailTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getEmailTypeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.email_type_details'), $data);
        return $response;
    }
    public function updateEmailType(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name' => $request->name,
        ];

        $response = Helper::PostMethod(config('constants.api.email_type_update'), $data);
        return $response;
    }
    // DELETE email type Details
    public function deleteEmailType(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.email_type_delete'), $data);
        return $response;
    }


    // index Email Template
    public function emailTemplate()
    {
        $email_type = Helper::GETMethod(config('constants.api.email_type_list'));

        // dd($email_type);
        return view(
            'admin.email_template.index',
        );
    }

    public function createEmailTemplate()
    {
        $email_type = Helper::GETMethod(config('constants.api.email_type_list'));
        return view(
            'admin.email_template.add',
            [
                'email_type' => isset($email_type['data']) ? $email_type['data'] : [],
            ]
        );
    }

    public function addEmailTemplate(Request $request)
    {
        $data = [
            'type_id' => $request->type_id,
            'subject' => $request->subject,
            'template_body' => $request->template_body,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.email_template_add'), $data);
        return $response;
    }
    public function getEmailTemplateList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.email_template_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEmailTemplateBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEmailTemplateBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['color', 'actions'])
            ->make(true);
    }
    public function getEmailTemplateDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.email_template_details'), $data);
        return $response;
    }
    public function updateEmailTemplate(Request $request)
    {
        $data = [
            'id' => $request->id,
            'type_id' => $request->type_id,
            'subject' => $request->subject,
            'template_body' => $request->template_body,
        ];

        $response = Helper::PostMethod(config('constants.api.email_template_update'), $data);
        return $response;
    }
    // DELETE email template Details
    public function deleteEmailTemplate(Request $request)
    {
        $data = [
            'id' => $request->id
        ];

        $response = Helper::PostMethod(config('constants.api.email_template_delete'), $data);
        return $response;
    }

    public function emailTemplateImage(Request $request)
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


    public function emailEvent(Request $request)
    {
        return view(
            'auth.email_event',
            [
                'school_name' => "クアラルンプール日本人学校",
                'school_image' => "logo_jskl.jpeg",
            ]
        );
    }

    // start Form Field
    public function formField()
    {
        return view('admin.form_field.index');
    }

    public function getFormFieldList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.form_field_list'));
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name_english', function ($row) {

                $name_english = $row['name_english'];
                if ($name_english == 0) {
                    $result_name_english = "checked";
                } else {
                    $result_name_english = "";
                }
                return '<input type="checkbox" ' . $result_name_english . '>';
            })->addColumn('name_common', function ($row) {

                $name_common = $row['name_common'];
                if ($name_common == 0) {
                    $result_name_common = "checked";
                } else {
                    $result_name_common = "";
                }
                return '<input type="checkbox" ' . $result_name_common . '>';
            })->addColumn('visa', function ($row) {

                $visa = $row['visa'];
                if ($visa == 0) {
                    $result_visa = "checked";
                } else {
                    $result_visa = "";
                }
                return '<input type="checkbox" ' . $result_visa . '>';
            })->addColumn('nationality', function ($row) {

                $nationality = $row['nationality'];
                if ($nationality == 0) {
                    $result_nationality = "checked";
                } else {
                    $result_nationality = "";
                }
                return '<input type="checkbox" ' . $result_nationality . '>';
            })->addColumn('passport', function ($row) {

                $passport = $row['passport'];
                if ($passport == 0) {
                    $result_passport = "checked";
                } else {
                    $result_passport = "";
                }
                return '<input type="checkbox" ' . $result_passport . '>';
            })->addColumn('nric', function ($row) {

                $nric = $row['nric'];
                if ($nric == 0) {
                    $result_nric = "checked";
                } else {
                    $result_nric = "";
                }
                return '<input type="checkbox" ' . $result_nric . '>';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editFormFieldBtn"><i class="fe-edit"></i></a>
                         </div>';
            }) // <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteFormFieldBtn"><i class="fe-trash-2"></i></a>
            ->rawColumns(['name_english', 'name_common', 'visa', 'nationality', 'passport', 'nric', 'actions'])
            ->make(true);
    }
    public function getFormFieldDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.form_field_details'), $data);
        return $response;
    }
    public function updateFormField(Request $request)
    {
        $data = [
            'id' => $request->id,
            'name_english' => $request->name_english,
            'name_furigana' => $request->name_furigana,
            'visa' => $request->visa,
            'nationality' => $request->nationality,
            'passport' => $request->passport,
            'nric' => $request->nric,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
        ];

        $response = Helper::PostMethod(config('constants.api.form_field_update'), $data);
        return $response;
    }


    public function terminationIndex()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // dd($student);
        return view(
            'admin.termination.index',
            [
                'grade' => isset($getclass['data']) ? $getclass['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
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
    public function getTerminationList(Request $request)
    {

        $response = Helper::GETMethod(config('constants.api.termination_list'));
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
                } else if ($row['termination_status'] == "Send Back") {
                    $color = "info";
                }
                return '<div class="button-list">
                
                <span class="badge badge-soft-' . $color . ' p-1">' . $row['termination_status'] . '</span>
            </div>';
            })
            // <a href="' . route('parent.termination.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                    <a data-toggle="modal" data-target="#terminationModal" data-id="' . $row['id'] . '"  id="editTerminationBtn" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
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
    // Update group 
    public function updateTermination(Request $request)
    {
        // dd($request);
        $termination_notification = "No";
        $date_of_termination = null;
        if ($request->termination_status == "Approved") {
            $date_of_termination = $request->date_of_termination;
            $termination_notification = "Yes";
        }
        $delete_google_address = "No";
        if ($request->delete_google_address == "on") {
            $delete_google_address = "Yes";
        }
        $data = [
            'id' => $request->id,
            'school_fees_payment_status' => $request->school_fees_payment_status,
            'termination_status' => $request->termination_status,
            'termination_status_old' => $request->termination_status_old,
            'delete_google_address' => $delete_google_address,
            'remarks' => $request->remarks,
            'student_status' => $request->student_status,
            'date_of_termination' => $date_of_termination,
            'termination_notification' => $termination_notification,
            'role_id' => session()->get('role_id'),

        ];
        // dd($request);
        $response = Helper::PostMethod(config('constants.api.termination_update_admin'), $data);
        return $response;
    }
    public function ExamImport()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.import.exam', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function ExamImportAdd(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $department_id = $request->department_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $exam_id = $request->exam_id;
        $subject_id = $request->subject_id;
        $semester_id = $request->semester_id;
        $session_id = $request->session_id;
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

                'academic_session_id' => session()->get('academic_session_id'),
                'department_id' => $department_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'exam_id' => $exam_id,
                'subject_id' => $subject_id,
                'semester_id' => $semester_id,
                'session_id' => $session_id,
                'file' => $base64,
                'fileName' => $filename,
                'extension' => $extension,
                'tempPath' => $tempPath,
                'fileSize' => $fileSize,
                'mimeType' => $mimeType,
            ];

            $response = Helper::PostMethod(config('constants.api.import_exam'), $data);
            //dd($response);
            //dd($data);
            if ($response['code'] == 200) {
                return redirect()->route('admin.exam.import')->with('success', ' Exam Mark  Imported Successfully');
            } else {
                return redirect()->route('admin.exam.import')->with('errors', $response['data']);
            }
        }
    }
    public function graduatesIndex()
    {
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        // dd($session);
        return view(
            'admin.graduates.student',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function graduatesList(Request $request)
    {
        $data = [
            "department_id" => $request->department_id,
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
                $edit = route('admin.graduates.details', $row['id']);
                return '<div class="button-list">
                                 <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editStudentBtn"><i class="fe-eye"></i></a>
                                 
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getGraduateDetails($id)
    {

        $data = [
            'id' => $id,
        ];

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $student = Helper::PostMethod(config('constants.api.student_details'), $data);
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        $data = [
            'department_id' => isset($student['data']['student']['department_id']) ? $student['data']['student']['department_id'] : 0,
        ];
        $grade_list_by_department = Helper::PostMethod(config('constants.api.grade_list_by_departmentId'), $data);

        $prev = json_decode($student['data']['student']['previous_details']);
        $school_name = $prev->school_name;
        $student['data']['student']['school_name'] = isset($prev->school_name) ? $prev->school_name : "";
        $student['data']['student']['qualification'] = isset($prev->qualification) ? $prev->qualification : "";
        $student['data']['student']['remarks'] = isset($prev->remarks) ? $prev->remarks : "";
        $school_roles = Helper::GetMethod(config('constants.api.school_role_list'));
        //dd($student);
        return view(
            'admin.graduates.edit',
            [
                'grade_list_by_department' => isset($grade_list_by_department['data']) ? $grade_list_by_department['data'] : [],
                'department' => isset($department['data']) ? $department['data'] : [],
                'class' => isset($getclass['data']) ? $getclass['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'student' => isset($student['data']['student']) ? $student['data']['student'] : [],
                'section' => isset($student['data']['section']) ? $student['data']['section'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'role' => isset($student['data']['user']) ? $student['data']['user'] : [],
                'school_roles' => isset($school_roles['data']) ? $school_roles['data'] : [],
            ]
        );
    }
    public function student_picture(Request $request)
    {
        return view('admin.student.picture');
    }
    public function student_pictureview(Request $request)
    {
        return view('admin.student.viewpicture');
    }
    public function report_history(Request $request)
    {
        return view('admin.report.report_history');
    }
    public function addstupicture(Request $request)
    {
        //$roll_no  = $request->roll_no;
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
                'register_no' => $request->register_no,
                'branch_id' => config('constants.branch_id')
            ];
            //dd($data);

            $response = Helper::PostMethod(config('constants.api.addstupicture'), $data);
            if ($response['code'] == 200) {
                return redirect()->route('admin.student.picture')->with('success', $response['message']);
            } else {
                return redirect()->route('admin.student.picture')->with('errors', $response['message']);
            }
        }
    }
    public function addmultistupicture(Request $request)
    {
        //$roll_no  = $request->roll_no;
        $base64 = "";
        $extension = "";

        $n = count($request->file('uploads'));
        $response = '';
        for ($i = 0; $i < $n; $i++) {
            if ($request->hasFile('uploads')) {
                $file = $request->file('uploads')[$i];
                $filenamewithextension = $request->file('uploads')[$i]->getClientOriginalName();
                $path = $file->path();
                $data = file_get_contents($path);
                $base64 = base64_encode($data);
                $extension = $file->getClientOriginalExtension();
                $data = [
                    'filename' => pathinfo($filenamewithextension, PATHINFO_FILENAME),
                    'photo' => $base64,
                    'file_extension' => $extension,
                    'register_no' => pathinfo($filenamewithextension, PATHINFO_FILENAME),
                    'branch_id' => config('constants.branch_id')
                ];
                //dd($data);
                $response = Helper::PostMethod(config('constants.api.addstupicture'), $data);
            }
        }

        if ($response['code'] == 200) {
            return redirect()->route('admin.student.picture')->with('success', $response['message']);
        } else {
            return redirect()->route('admin.student.picture')->with('errors', $response['message']);
        }
    }
    public function examsutdentlist(Request $request)
    {
        $data = [
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "academic_session_id" => $request->academic_year
        ];
        $response = Helper::PostMethod(config('constants.api.student_list'), $data);
        //dd($data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $edit = route('admin.graduates.details', $row['id']);
                return '<div class="button-list">
                                 <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editStudentBtn"><i class="fe-eye"></i></a>
                                 
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // index shortcutLinks 
    public function shortcutLinks()
    {
        return view('admin.shortcut_links.index');
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
    public function studentInterviewIndex()
    {

        $department = Helper::GetMethod(config('constants.api.department_list'));

        return view(
            'admin.student_interview_record.index',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
            ]
        );
    }
    public function getStudentInterviewData(Request $request)
    {
        $data = [
            'department_id' => $request->department_id,
            'grade_id' => $request->changeClassName,
            'section_id' => $request->sectionID,
            'student_id' => $request->student_id,
        ];
        $response = Helper::PostMethod(config('constants.api.student_interview_list'), $data);
        return $response;
    }

    public function childHealthImport(Request $request)
    {


        $department = Helper::GetMethod(config('constants.api.department_list'));
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));

        // dd($session);
        return view(
            'admin.child_health.import',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classes' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function childHealthImportAdd(Request $request)
    {
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
                $object->fileName = $file->getClientOriginalName();
                $object->tempPath = $file->getRealPath();
                $object->fileSize = $file->getSize();
                $object->mimeType = $file->getMimeType();
                array_push($files, $object);
            }
        }

        $data = [
            'file' => $files,
            'missing_file' => "",
            "date" => $request->date
        ];
        // dd($request->date);
        $response = Helper::PostMethod(config('constants.api.import_child_health'), $data);

        // dd($response);
        if ($response['code'] == 200) {
            return redirect()->route('admin.child_health.import')->with('success', ' Child Health Data Imported Successfully');
        } else {
            return redirect()->route('admin.child_health.import')->with('errors', $response['data']['error']);
        }
    }
    public function childHealthIndex(Request $request)
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view('admin.child_health.report', [
            'department' => isset($department['data']) ? $department['data'] : [],
            'classes' => isset($getclass['data']) ? $getclass['data'] : [],
            'semester' => isset($semester['data']) ? $semester['data'] : [],
            'session' => isset($session['data']) ? $session['data'] : [],
            'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
            'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
        ]);
    }
    public function childHealthList(Request $request)
    {
        $data = [
            "class_id" => $request->class_id,
            'department_id' => $request->department_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.student_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $route = route('admin.child_health.pdf', $row['id']);
                return '<div class="button-list">
                    <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" data-toggle="modal"  data-target="#bs-example-modal-lg"><i class="fe-eye"></i></a>
                    <a href="' . $route . '" class="btn btn-danger waves-effect waves-light" id="downloadChidlHealth"><i class="dripicons-download" style="color: white;"></i></a>
                </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    public function childHealthPdf(Request $request)
    {
        $data = [
            'student_id' => $request->student_id,
            "class_id" => $request->class_id,
            'department_id' => $request->department_id,
            "section_id" => $request->section_id,
            "student_name" => $request->student_name,
            "session_id" => $request->session_id,
            "academic_session_id" => session()->get('academic_session_id')
        ];
        $child_health = Helper::PostMethod(config('constants.api.child_health_export'), $data);
        // dd($child_health);
        $count = isset($child_health['data']['grade']) ? count($child_health['data']['grade']) : 0;
        $empty = 9 - $count;


        $pdf = PDF::loadView('admin.child_health.pdf', [
            'child_health' => isset($child_health['data']['child_health']) ? $child_health['data']['child_health'] : [],
            'grade' => isset($child_health['data']['grade']) ? $child_health['data']['grade'] : [],
            'empty' => isset($empty) ? $empty : 9,
            'storage' => storage_path('fonts/ipag.ttf')
        ],);
        // $pdf->setPaper('A3', 'landscape');
        return $pdf->stream('pdfview.pdf');



        // dd($count);
        return view('admin.child_health.pdf', [
            'child_health' => isset($child_health['data']['child_health']) ? $child_health['data']['child_health'] : [],
            'grade' => isset($child_health['data']['grade']) ? $child_health['data']['grade'] : [],
            'empty' => isset($empty) ? $empty : 9,
            'storage' => storage_path('fonts/ipag.ttf')
        ]);
    }
    public function personalinterviewIndex()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.personalinterview.student',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function personalinterviewstore(Request $request)
    {
        $data = [
            'id' => $request->id,
            'academic_year' => $request->year,
            'department_id' => $request->department_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'interview_date' => date('Y-m-d', strtotime($request->interview_date)),
            'student_id' => $request->student_id,
            'question_situation' => $request->question_situation,
            'question_improved' => $request->question_improved,
            'question_tried' => $request->question_tried,
            'question_future' => $request->question_future,
            'question_parent' => $request->question_parent,
            'question_feedback' => $request->question_feedback,
            'staff_id' => session()->get('ref_user_id')
        ];
        //dd($data);

        $response = Helper::PostMethod(config('constants.api.personalinterviewstore'), $data);
        if ($response['code'] == 200) {
            return redirect()->route('admin.personalinterview.index')->with('success', $response['message']);
        } else {
            return redirect()->route('admin.personalinterview.index')->with('errors', $response['message']);
        }
    }
    public function personalinterviewlist()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $sem = Helper::GetMethod(config('constants.api.get_semester_session'));
        $department = Helper::GetMethod(config('constants.api.department_list'));
        return view(
            'admin.personalinterview.report',
            [
                'department' => isset($department['data']) ? $department['data'] : [],
                'classnames' => isset($getclass['data']) ? $getclass['data'] : [],
                'semester' => isset($semester['data']) ? $semester['data'] : [],
                'session' => isset($session['data']) ? $session['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'current_semester' => isset($sem['data']['semester']['id']) ? $sem['data']['semester']['id'] : "",
                'current_session' => isset($sem['data']['session']) ? $sem['data']['session'] : ""
            ]
        );
    }
    public function personalinterviewshow(Request $request)
    {
        $data = [
            "academic_year" => $request->year,
            "department_id" => $request->department_id,
            "class_id" => $request->class_id,
            "section_id" => $request->section_id,
            "semester_id" => $request->semester_id
        ];
        $response = Helper::PostMethod(config('constants.api.interviewstudent_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $edit = route('admin.personalinterviewdownload', $row['id']);
                return '<div class="button-list">
                            <a href="' . $edit . '" class="btn btn-blue waves-effect waves-light" id="editStudentBtn" title="Download"><i class="fe-download"></i></a>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
