<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use DataTables;
use App\Models\Classes;
use App\Models\Role;
use App\Models\Section;
use App\Models\EventType;
use App\Models\Event;
use App\Models\SectionAllocation;
use App\Models\TeacherAllocation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;
use Excel;
use App\Exports\StaffAttendanceExport;

class StaffController extends Controller
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
        $greetings = Helper::greetingMessage();

        $employee_count = Helper::GetMethod(config('constants.api.employee_count'));
        $student_count = Helper::GetMethod(config('constants.api.student_count'));
        $parent_count = Helper::GetMethod(config('constants.api.parent_count'));
        $teacher_count = Helper::GetMethod(config('constants.api.teacher_count'));
        $count['employee_count'] = $employee_count['data'];
        $count['student_count'] = $student_count['data'];
        $count['parent_count'] = $parent_count['data'];
        $count['teacher_count'] = $teacher_count['data'];
        // dd($get_to_do_list_dashboard);
        return view(
            'staff.dashboard.index',
            [
                'get_to_do_list_dashboard' => $get_to_do_list_dashboard['data'],
                'greetings' => $greetings,
                'count' => $count
            ]
        );
    }
    public function settings()
    {
        $data = [
            'staff_id' => session()->get('ref_user_id')
        ];
        $staff_profile_info = Helper::PostMethod(config('constants.api.staff_profile_info'), $data);
        return view(
            'staff.settings.index',
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
        return view('staff.forum.index', [
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('staff.forum.page-single-topic');
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
        return view('staff.forum.page-create-topic', [
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
        return view('staff.forum.page-single-user', [

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
        return view('staff.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('staff.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('staff.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('staff.forum.page-single-categories');
    }
    public function forumPageCategories()
    {
        $user_id = session()->get('user_id');
        $data = [
            'user_id' => $user_id
        ];
        $listcategoryvs = Helper::GETMethodWithData(config('constants.api.listcategoryvs'), $data);
        return view('staff.forum.page-categories', [
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

        return view('staff.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
        //  return view('teacher.forum.page-categories-single');
    }
    public function forumPageTabs()
    {
        return view('staff.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('staff.forum.page-tabs-guidelines');
    }

    // forum create post 
    public function createpost(Request $request)
    {
        $current_user = session()->get('role_id');
        //dd($current_user);
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

        return view('staff.forum.page-single-topic', [
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
        return view('staff.faq.index');
    }

    public function classes()
    {
        return view('admin.classes.index');
    }
    public function addClasses()
    {
        $teacherDetails = User::select('id', 'name')->where('role_id', 3)->get();
        return view('admin.classes.add', ['teacherDetails' => $teacherDetails]);
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
    //add New Class
    public function addClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:classes',
            'name_numeric' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $class = new Classes();
            $class->name = $request->name;
            $class->name_numeric = $request->name_numeric;
            $query = $class->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Class has been successfully saved']);
            }
        }
    }

    // get class row details
    public function getClassDetails(Request $request)
    {
        $class_id = $request->class_id;
        $classDetails = Classes::find($class_id);
        return response()->json(['details' => $classDetails]);
    }

    // get class details
    public function getClassList(Request $request)
    {
        $classes = Classes::all();

        return DataTables::of($classes)
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

    //UPDATE Class DETAILS
    public function updateClass(Request $request)
    {
        // dd($request);
        $classID = $request->class_id;

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'name_numeric' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $class = Classes::find($classID);
            $class->name = $request->name;
            $class->name_numeric = $request->name_numeric;
            $query = $class->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Class Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    // DELETE Class Details
    public function deleteClass(Request $request)
    {
        $classID = $request->class_id;
        Classes::where('id', $classID)->delete();
        return response()->json(['code' => 1, 'msg' => 'Class have been deleted from database']);

        // if ($query) {
        //     return response()->json(['code' => 1, 'msg' => 'Class has been deleted from database']);
        // } else {
        //     return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        // }
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
    // Qualifications
    public function qualification_view()
    {
        //dd('resp');
        return view('staff.qualifications.index');
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
        return view('staff.staffCategories.index');
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
    // get section
    public function section()
    {
        return view('admin.section.index');
    }
    // add section
    public function addSection(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:sections'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $section = new Section();
            $section->name = $request->name;
            $query = $section->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Section has been successfully saved']);
            }
        }
    }

    // get sections 
    public function getSectionList(Request $request)
    {
        $section = Section::all();
        return DataTables::of($section)
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

    // get section row details
    public function getSectionDetails(Request $request)
    {
        $section_id = $request->section_id;
        $sectionDetails = Section::find($section_id);
        return response()->json(['details' => $sectionDetails]);
    }
    // update section
    public function updateSectionDetails(Request $request)
    {
        $section_id = $request->sid;

        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:sections,name,' . $section_id
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $section = Section::find($section_id);
            $section->name = $request->name;
            $query = $section->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Section Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }
    // delete Section
    public function deleteSection(Request $request)
    {
        $section_id = $request->section_id;
        Section::where('id', $section_id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Section have been deleted from database']);
    }

    // section allocations
    public function showSectionAllocation()
    {
        $classDetails = Classes::select('id', 'name')->get();
        $sectionDetails = Section::select('id', 'name')->get();
        return view('admin.section_allocation.allocation', ['classDetails' => $classDetails, 'sectionDetails' => $sectionDetails]);
    }

    // add section allocations
    public function addSectionAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'class_name' => 'required',
            'section_name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $section = new SectionAllocation();
            $section->class_id = $request->class_name;
            $section->section_id = $request->section_name;
            $query = $section->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Section Allocation has been successfully saved']);
            }
        }
    }
    // get sections allocation
    public function getSectionAllocationList(Request $request)
    {
        $sectionAllocation = DB::table('sections_allocations as sa')
            ->select('sa.id', 'sa.class_id', 'sa.section_id', 's.name as section_name', 'c.name as class_name', 'c.name_numeric')
            ->join('sections as s', 'sa.section_id', '=', 's.id')
            ->join('classes as c', 'sa.class_id', '=', 'c.id')
            ->get();

        return DataTables::of($sectionAllocation)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="editSectionAlloBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteSectionAlloBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // get getSectionAllocationDetails details

    public function getSectionAllocationDetails(Request $request)
    {
        $id = $request->id;
        $SectionAllocation = SectionAllocation::find($id);
        return response()->json(['details' => $SectionAllocation]);
    }

    // update Section Allocations

    public function updateSectionAllocation(Request $request)
    {
        $id = $request->said;

        $validator = \Validator::make($request->all(), [
            'class_name' => 'required',
            'section_name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $section = SectionAllocation::find($id);
            $section->class_id = $request->class_name;
            $section->section_id = $request->section_name;
            $query = $section->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Section Allocation Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    // delete deleteSectionAllocation
    public function deleteSectionAllocation(Request $request)
    {
        $id = $request->id;
        SectionAllocation::where('id', $id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Section Allocation have been deleted from database']);
    }

    // show assign teacher

    public function showAssignTeacher()
    {
        $classDetails = Classes::select('id', 'name')->get();
        $teacherDetails = User::select('id', 'name')->where('role_id', 3)->get();
        return view('admin.assign_teacher.index', ['classDetails' => $classDetails, 'teacherDetails' => $teacherDetails]);
    }
    // get allocation section

    public function getAllocationSection(Request $request)
    {
        $class_id = $request->class_id;

        $classDetails = DB::table('sections_allocations as sa')
            ->select('sa.id', 'sa.class_id', 'sa.section_id', 's.name as section_name')
            ->join('sections as s', 'sa.section_id', '=', 's.id')
            ->where('sa.class_id', $class_id)
            ->get();

        return response()->json(['code' => 1, 'data' => $classDetails]);
    }
    // get TeacherAllocation
    public function showTeacherAllocation()
    {
        return view('admin.assign_teacher.index');
    }
    // add section allocations
    public function addTeacherAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'class_name' => 'required',
            'section_name' => 'required',
            'class_teacher' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $teacherAllocation = new TeacherAllocation();
            $teacherAllocation->class_id = $request->class_name;
            $teacherAllocation->section_id = $request->section_name;
            $teacherAllocation->teacher_id = $request->class_teacher;
            $query = $teacherAllocation->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Teacher Allocation has been successfully saved']);
            }
        }
    }

    // get Teacher Allocation List

    public function getTeacherAllocationList(Request $request)
    {
        $teacherAllocation = DB::table('teacher_allocations as ta')
            ->select('ta.id', 'ta.class_id', 'ta.section_id', 'ta.teacher_id', 's.name as section_name', 'c.name as class_name', 'u.name as teacher_name')
            ->join('sections as s', 'ta.section_id', '=', 's.id')
            ->join('classes as c', 'ta.class_id', '=', 'c.id')
            ->join('users as u', 'ta.teacher_id', '=', 'u.id')
            ->get();

        return DataTables::of($teacherAllocation)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="editTeacherAlloBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteTeacherAlloBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }


    public function eventType()
    {
        return view('admin.event_type.index');
    }


    // get Even Type details
    public function getEventTypeList(Request $request)
    {
        $event_type = EventType::all();

        return DataTables::of($event_type)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEventTypeBtn"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventTypeBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    //add New Event Type
    public function addEventType(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $event_type = new EventType();
            $event_type->name = $request->name;
            $query = $event_type->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Event Type has been successfully saved']);
            }
        }
    }

    // get Event Type row details
    public function getEventType(Request $request)
    {
        // dd($request);
        $event_type_id = $request->event_type_id;
        $eventTypeDetails = EventType::find($event_type_id);
        return response()->json(['details' => $eventTypeDetails]);
    }

    // update Event Type
    public function updateEventType(Request $request)
    {
        $event_type_id = $request->event_type_id;

        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:sections,name,' . $event_type_id
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $event_type = EventType::find($event_type_id);
            $event_type->name = $request->name;
            $query = $event_type->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Event Type Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    // delete Event Type
    public function deleteEventType(Request $request)
    {
        $event_type_id = $request->event_type_id;
        EventType::where('id', $event_type_id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Event Type have been deleted from database']);
    }


    public function event()
    {
        $classDetails = Classes::select('id', 'name')->get();
        $sectionDetails = SectionAllocation::select('sections_allocations.id', 'sections_allocations.class_id', 'sections_allocations.section_id', 'sections.name')->join('sections', 'sections.id', '=', 'sections_allocations.section_id')->get();
        // dd($docomuntOrders);
        $type = EventType::select('id', 'name')->get();
        return view('admin.event.index', ['type' => $type, 'classDetails' => $classDetails, 'sectionDetails' => $sectionDetails]);
    }


    // get Even Type details
    public function getEventList(Request $request)
    {
        $event = \DB::table("events")
            ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
            ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
            ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
            ->leftjoin('users', 'users.id', '=', 'events.created_by')
            ->groupBy("events.id")
            ->get();
        // $event = Event::select('events.id','events.title','events.audience','event_types.name as type','events.start_date','events.end_date','events.status','users.name as created_by')
        //     ->join('users','users.id','=','events.created_by')
        //     ->join('event_types','event_types.id','=','events.type')
        //     ->get();

        // $ch = Event::all(); data-plugin="switchery" data-color="#9261c6"
        //    dd($teacherAllocation);
        return DataTables::of($event)

            ->addIndexColumn()
            ->addColumn('classname', function ($row) {
                $audience = $row->audience;
                if ($audience == 1) {
                    return "Everyone";
                } else {
                    return "Class " . $row->classname;
                }
            })
            ->addColumn('status', function ($row) {

                $status = $row->status;
                if ($status == 1) {
                    $result = "checked";
                } else {
                    $result = "";
                }
                return '<input type="checkbox" ' . $result . ' data-id="' . $row->id . '"  id="publishEventBtn">';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="viewEventBtn"><i class="fe-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteEventBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    //add New Event Type
    public function addEvent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'class' => '',
            'section' => '',
            'description' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $event = new Event();
            $event->title = $request->title;
            $event->type = $request->type;
            $event->audience = $request->audience;

            if ($request->audience == 2) {
                $event->selected_list = json_encode($request->class);
            } elseif ($request->audience == 3) {
                $event->selected_list = json_encode($request->section);
            } else {
                $event->selected_list = NULL;
            }

            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->remarks = $request->description;

            $user = Auth::id();
            $event->created_by = $user;
            $query = $event->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Event has been successfully saved']);
            }
        }
    }

    // get Event details
    public function getEvent(Request $request)
    {
        // dd($request);
        $event_id = $request->event_id;
        $eventDetails = \DB::table("events")
            ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
            ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
            ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
            ->leftjoin('users', 'users.id', '=', 'events.created_by')
            ->groupBy("events.id")
            ->where('events.id', $event_id)->first();
        // $eventDetails = Event::select('events.id','events.title','events.audience','event_types.name as type','events.start_date','events.end_date','events.status','users.name as created_by','events.remarks')
        //     ->join('users','users.id','=','events.created_by')
        //     ->join('event_types','event_types.id','=','events.type')
        //     ->find($event_id);
        return response()->json(['details' => $eventDetails]);
    }

    // delete Event 
    public function deleteEvent(Request $request)
    {
        $event_id = $request->event_id;
        Event::where('id', $event_id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Event have been deleted from database']);
    }
    // Publish Event 
    public function publishEvent(Request $request)
    {

        $event = Event::find($request->event_id);
        $event->status = $request->value;
        $query = $event->save();

        return response()->json(['code' => 1, 'msg' => 'Event Updated Successfully']);
    }


    public function admission()
    {
        return view('staff.admission.index');
    }

    public function import()
    {
        return view('staff.admission.import');
    }

    public function parent()
    {
        return view('staff.parent.index');
    }

    public function employee()
    {
        return view('staff.employee.index');
    }

    public function homework()
    {
        return view('staff.homework.index');
    }


    // get department
    public function department()
    {
        // echo "nsdds";exit;
        return view('staff.department.index');
    }

    // get designation
    public function designation()
    {
        return view('staff.designation.index');
    }

    // get Category
    public function getCategory()
    {
        return view('staff.hostel.category');
    }

    // get Branch
    public function branch()
    {
        return view('staff.branch.index');
    }

    // get hostel
    public function hostel()
    {
        return view('staff.hostel.index');
    }

    // get Room
    public function getRoom()
    {
        return view('staff.hostel.room');
    }

    public function getRoute()
    {
        return view('staff.transport.route');
    }

    public function getVehicle()
    {
        return view('staff.transport.vehicle');
    }

    public function getstoppage()
    {
        return view('staff.transport.stoppage');
    }

    public function assignVehicle()
    {
        return view('staff.transport.assignvehicle');
    }

    public function book()
    {
        return view('staff.library.book');
    }
    public function bookCategory()
    {
        return view('staff.library.book_category');
    }
    public function issuedBook()
    {
        return view('staff.library.issued_book');
    }
    public function issueReturn()
    {
        return view('staff.library.issue_return');
    }
    // exam routes
    public function examIndex()
    {
        return view('staff.exam_term.index');
    }
    public function examHall()
    {
        return view('staff.exam_hall.index');
    }
    public function examMarkDistribution()
    {
        return view('staff.exam_mark_distribution.index');
    }
    public function exam()
    {
        return view('staff.exam.index');
    }
    // get Employee
    public function listEmployee()
    {
        return view('staff.employee.list');
    }
    // show employee
    public function showEmployee()
    {
        return view('staff.employee.index');
    }
    public function studentEntry()
    {
        return view('staff.attendance.student');
    }
    public function examEntry()
    {
        return view('staff.attendance.exam');
    }
    public function studentIndex()
    {
        return view('staff.student.student');
    }
    public function taskIndex()
    {
        return view('staff.task.index');
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
    // index Timetable
    public function timetable(Request $request)
    {
        $data = [
            'teacher_id' => session()->get('ref_user_id')
        ];
        $getclass = Helper::PostMethod(config('constants.api.teacher_class'), $data);
        // $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $semester = Helper::GetMethod(config('constants.api.semester'));
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'staff.timetable.index',
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

    public function employeeEntry()
    {
        $employee = session()->get('ref_user_id');
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'staff.attendance.employee',
            [
                'employee' => $employee,
                'session' => $session['data']
            ]
        );
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
        dd($attendance);
        return $attendance;
    }

    public function reportEmployeeAttendance()
    {
        $employee = session()->get('ref_user_id');
        $session = Helper::GetMethod(config('constants.api.session'));
        return view(
            'staff.attendance.employee_report',
            [
                'employee' => $employee,
                'session' => $session['data']
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

        return view('staff.leave_management.applyleave', [
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
                    <a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' . $row['id'] . '"  data-document="' . $row['document'] . '" id="updateIssueFile">Upload</a>
            </div>';
                } else {
                    return '-';
                }
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
    public function allleaves()
    {
        return view('staff.leave_management.allleaves');
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
    public function staffAttendanceExcel(Request $request)
    {
        // dd($request);
        return Excel::download(new StaffAttendanceExport(1, $request->employee, $request->session, $request->date, $request->department), 'Staff_Attendance.xlsx');
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
        return view('staff.classroom.management', [
            'teacher_class' => $response['data'],
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
}
