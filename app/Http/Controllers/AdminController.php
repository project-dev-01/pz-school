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
use App\Models\Tenant\User as TenantUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;
use app\Models;
use App\Models\Task;

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
        // $data = TenantUser::all();
        // dd($data);
        // config(['database.connections.mysql_new_connection' => [
        //     'driver'    => 'mysql',
        //     'host'      => 'localhost',
        //     'database'  => 'school-management-system-test',
        //     'username'  => 'root',
        //     'password'  => '',
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_unicode_ci'
        // ]]);
        // $decDB = DB::connection('tenant')->table("branches")->get();
        // echo "<pre>";
        // print_r($decDB);
        // exit;
        return view('admin.dashboard.index');
    }
    public function settings()
    {
        return view('admin.settings.index');
    }
    public function classes()
    {
        // $decDB = DB::connection('tenant')->table("branches")->get();
        // echo "<pre>";
        // print_r($decDB);
        // exit;
        // config(['database.connections.mysql_new_connection' => [
        //     'driver'    => 'mysql',
        //     'host'      => 'localhost',
        //     'database'  => 'school-management-system-test',
        //     'username'  => 'root',
        //     'password'  => '',
        //     'charset'   => 'utf8',
        //     'collation' => 'utf8_unicode_ci'
        // ]]);
        // $decDB = DB::connection('mysql_new_connection')->table("branches")->get();
        // print_r($decDB);
        // exit;
        return view('admin.classes.index');
    }
    public function addClasses()
    {
        $teacherDetails = User::select('id', 'name')->where('role_id', 3)->get();
        return view('admin.classes.add', ['teacherDetails' => $teacherDetails]);
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editClassBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteClassBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteUserBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSectionBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSectionBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="editSectionAlloBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteSectionAlloBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="editTeacherAlloBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteTeacherAlloBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEventTypeBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventTypeBtn">Delete</a>
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row->id . '" id="viewEventBtn">View</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row->id . '" id="deleteEventBtn">Delete</a>
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
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $gettransport = Helper::GetMethod(config('constants.api.transport_list'));
        $gethostel = Helper::GetMethod(config('constants.api.hostel_list'));
        $session = Helper::GetMethod(config('constants.api.session'));
        // dd($gethostel);
        return view(
            'admin.admission.index',
            [
                'class' => $getclass['data'],
                'transport' => $gettransport['data'],
                'hostel' => $gethostel['data'],
                'session' => $session['data'],
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
        return view(
            'admin.homework.index',
            [
                'class' => $getclass['data'],
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

    // get hostel
    public function hostel()
    {
        return view('admin.hostel.index');
    }

    // get Room
    public function getRoom()
    {
        return view('admin.hostel.room');
    }

    public function getRoute()
    {
        return view('admin.transport.route');
    }

    public function getVehicle()
    {
        return view('admin.transport.vehicle');
    }

    public function getstoppage()
    {
        return view('admin.transport.stoppage');
    }

    public function assignVehicle()
    {
        return view('admin.transport.assignvehicle');
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
        $data = [
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'qualification' => $request->qualification,
            'name' => $request->name,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'birthday' => $request->birthday,
            'mobile_no' => $request->mobile_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'photo' => $request->file('photo'),
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'skip_bank_details' => $request->skip_bank_details,
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'ifsc_code' => $request->ifsc_code,
            'account_no' => $request->account_no

        ];
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

        // dd($staff);
        return view(
            'admin.employee.edit',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
                'employee' => $staff['data']['staff'],
                'bank' => $staff['data']['bank'],
                'department' => $department['data'],
                'designation' => $designation['data'],
                'role' => $staff['data']['user']
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
        return view(
            'admin.employee.index',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
                'emp_department' => !empty($emp_department) ? $emp_department['data'] : $emp_department,
                'emp_designation' => !empty($emp_designation) ? $emp_designation['data'] : $emp_designation,
            ]
        );
    }
    // update Employee
    public function updateEmployee(Request $request)
    {

        $data = [
            'id' => $request->id,
            'role_id' => $request->role_id,
            'joining_date' => $request->joining_date,
            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'qualification' => $request->qualification,
            'name' => $request->name,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'birthday' => $request->birthday,
            'mobile_no' => $request->mobile_no,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'skip_bank_details' => $request->skip_bank_details,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'bank_address' => $request->bank_address,
            'ifsc_code' => $request->ifsc_code,
            'account_no' => $request->account_no
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
        ];

        $timetable = Helper::PostMethod(config('constants.api.timetable_subject'), $data);

        // dd($timetable);
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

                    $disabled = "";
                    $checked = "";
                    if ($table['break'] == "1") {
                        $checked = "checked";
                        $disabled = "disabled";
                    }



                    $teacher = "";
                    foreach ($timetable['data']['teacher'] as $teach) {
                        if ($teach['id'] == $table['teacher_id']) {
                            $teacher .= '<option value="' . $teach['id'] . '" Selected>' . $teach['name'] . '</option>';
                        } else {
                            $teacher .= '<option value="' . $teach['id'] . '"   >' . $teach['name'] . '</option>';
                        }
                    }

                    // dd($teacher);
                    $response .=  '<tr class="iadd">';
                    $response .=  '<input type="hidden"  name="timetable[' . $row . '][id]" value="' . $table['id'] . '">';
                    $response .=  '<td>';
                    $response .=  '<div class="checkbox-replace">';
                    $response .=  '<label class="i-checks">';
                    $response .=  '<input type="checkbox" name="timetable[' . $row . '][break]" ' . $checked . ' ><i></i>';
                    $response .=  '</label>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%">';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select class="form-control subject"  name="timetable[' . $row . '][subject]" ' . $disabled . '>';
                    $response .=  '<option value="">Select Subject</option>';
                    $response .=  $subject;
                    $response .=  '</select>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%"  > ';
                    $response .=  '<div class="form-group">';
                    $response .=  '<select  class="form-control teacher"  name="timetable[' . $row . '][teacher]" ' . $disabled . '>';
                    $response .=  '<option value="">Select Teacher</option>';
                    $response .=  $teacher;
                    $response .=  '</select>';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%" >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control"  type="time" name="timetable[' . $row . '][time_start]" value="' . $table['time_start'] . '">';
                    $response .=  '</div></td>';
                    $response .=  '<td width="20%"  >';
                    $response .=  '<div class="form-group">';
                    $response .=  '<input class="form-control"  type="time" name="timetable[' . $row . '][time_end]"  value="' . $table['time_end'] . '">';
                    $response .=  '</div>';
                    $response .=  '</td>';
                    $response .=  '<td width="20%"> <div class="input-group"><input type="remarks"  name="timetable[' . $row . '][class_room]" value="' . $table['class_room'] . '" class="form-control" ><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></div></td>';

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
        // dd($semester);
        return view(
            'admin.timetable.add',
            [
                'class' => $getclass['data'],
                'semester' => $semester['data'],
                'session' => $session['data'],
            ]
        );
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

        ];
        $response = Helper::PostMethod(config('constants.api.timetable_add'), $data);
        // dd($response);
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

    // get Timetable
    public function getTimetable(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
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
            foreach ($days as $day) {
                $response .= '<tr><td>' . strtoupper($day) . '</td>';
                $row = 0;
                foreach ($timetable['data']['timetable'] as $table) {
                    if ($table['day'] == $day) {
                        $response .= '<td>';
                        if ($table['break'] == "1") {
                            $response .= '<b>Break Time</b><br> ';
                            $response .= '(' . $table['time_start'] . ' - ' . $table['time_end'] . ' )<br>';
                            if ($table['class_room']) {

                                $response .= 'Class Room : ' . $table['class_room'] . '';
                            }
                        } else {
                            $response .= '<b>Subject:' . $table['subject_name'] . '</b><br>';
                            $response .= '(' . $table['time_start'] . ' - ' . $table['time_end'] . ' )<br>';
                            $response .= 'Teacher :  ' . $table['teacher_name'] . '<br>';
                            if ($table['class_room']) {
                                $response .= 'Class Room : ' . $table['class_room'] . '';
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
            'day' => $request->day
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
                    'subject' => $timetable['data']['subject']
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
    public function updateTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'semester_id' => $request->semester_id,
            'session_id' => $request->session_id,
            'day' => $request->day,
            'timetable' => $request->timetable,

        ];
        $timetable = Helper::PostMethod(config('constants.api.timetable_update'), $data);

        return $timetable;
    }

    public function studentEntry()
    {
        return view('admin.attendance.student');
    }
    public function employeeEntry()
    {
        return view('admin.attendance.employee');
    }
    public function examEntry()
    {
        return view('admin.attendance.exam');
    }
    public function studentIndex()
    {
        return view('admin.student.student');
    }
    public function classroomManagement()
    {
        return view('admin.classroom.management');
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editDepartmentBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteDepartmentBtn">Delete</a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function evaluationReport()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        return view(
            'admin.homework.evaluation_report',
            [
                'class' => $getclass['data'],
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
            'date_of_homework' => $request->date_of_homework,
            'date_of_submission' => $request->date_of_submission,
            'schedule_date' => $request->schedule_date,
            'description' => $request->description,
            'file' => $base64,
            'file_extension' => $extension,
            'created_by' => $created_by,
        ];
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

        // dd($homework);
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editDepartmentBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteDepartmentBtn">Delete</a>
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
        ];
        $response = Helper::PostMethod(config('constants.api.exam_term_add'), $data);
        return $response;
    }
    // get ExamTerm 
    public function getExamTermList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.exam_term_list'));

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
            'name' => $request->name
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
        $term = Helper::GetMethod(config('constants.api.exam_term_list'));
        // dd($response)

        return view('admin.exam.list', ['term' => $term['data']]);
    }

    //add exam
    public function addExam(Request $request)
    {
        $data = [
            'name' => $request->name,
            'term_id' => $request->term_id,
            'remarks' => $request->remarks
        ];
        $response = Helper::PostMethod(config('constants.api.exam_add'), $data);
        return $response;
    }
    // get Exam 
    public function getExamList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.exam_list'));
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
        return view(
            'admin.exam_timetable.schedule',
            [
                'class' => $getclass['data'],
            ]
        );
    }
    public function timeTableSetExamWise()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $getexam = Helper::GetMethod(config('constants.api.exam_list'));
        return view(
            'admin.exam_timetable.add_schedule',
            [
                'class' => $getclass['data'],
                'exam' => $getexam['data'],
            ]
        );
    }

    public function timetableExam(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
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
                                    <td><div class="button-list"><a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-toggle="modal" data-target="#examTimeTable" data-exam_id="' . $exam['exam_id'] . '" id=""><i class="fe-eye"></i></a><a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="" id=""><i class="fe-trash-2"></i></a></div></td>
                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                    <td colspan="7"> No Data Available</td>
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
            'exam_id' => $request->exam_id,
        ];
        $response = Helper::PostMethod(config('constants.api.exam_timetable_get'), $data);
        $teacher = Helper::PostMethod(config('constants.api.teacher_list'), $data);

        // dd($teacher);
        $hall_list = Helper::GetMethod(config('constants.api.exam_hall_list'));
        $hall = "";
        if ($response['code'] == "200") {
            $output = "";
            $row = 1;
            if ($response['data']['exam']) {
                foreach ($response['data']['exam'] as $exam) {

                    // dd($exam['hall_id']);
                    $hall = "";
                    $dist = "";
                    $dist_type1 = "";
                    $dist_type2 = "";
                    foreach ($hall_list['data'] as $list) {
                        if ($list['id'] == $exam['hall_id']) {
                            $hall .= '<option value="' . $list['id'] . '" selected>' . $list['hall_no'] . '</option>';
                        } else {
                            $hall .= '<option value="' . $list['id'] . '">' . $list['hall_no'] . '</option>';
                        }
                    }

                    if ($exam['marks']) {
                        $mark = json_decode($exam['marks']);
                        $full = $mark->full;
                        $pass = $mark->pass;
                    } else {
                        $full = NULL;
                        $pass = NULL;
                    }

                    if ($exam['distributor_type'] == "1") {
                        $dist .= ' <select  class="form-control " name="exam[' . $row . '][distributor]">';
                        foreach ($teacher['data'] as $teach) {
                            if ($teach['id'] == $exam['distributor_id']) {
                                $dist .= '<option value="' . $teach['id'] . '" selected>' . $teach['name'] . '</option>';
                            } else {
                                $dist .= '<option value="' . $teach['id'] . '">' . $teach['name'] . '</option>';
                            }
                        }
                        $dist .= ' </select>';
                    } else {
                        $dist .= '<input type="text" name="exam[' . $row . '][distributor]" class="form-control"  value="' . $exam['distributor'] . '" placeholder="Distributor Name">';
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
                                    </td>
                                    <td >
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
                                                        <option value="">Select Type</option>
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
                                    <td width="10%">
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" name="exam[' . $row . '][mark][full]" class="form-control" value="' . $full . '" placeholder="Full Mark">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" name="exam[' . $row . '][mark][pass]" class="form-control"  value="' . $pass . '" placeholder="Pass Mark">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                    $row++;
                }
            } else {
                $output .= '<tr>
                                <td colspan="6"> No Data Available</td>
                            </tr>';
            }

            $response['table'] = $output;
            $response['class_id'] = $request->class_id;
            $response['section_id'] = $request->section_id;
            $response['exam_id'] = $request->exam_id;
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
            'exam' => $request->exam,
        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.exam_timetable_add'), $data);
        return $response;
    }

    public function viewExamTimetable(Request $request)
    {

        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'exam_id' => $request->exam_id,
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
                    }
                    $output .= '<tr>
                                    <td>' . $exam['subject_name'] . '</td>
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

    public function markEntry()
    {
        return view('admin.exam_marks.mark_entry');
    }

    // get grade 
    public function grade()
    {
        return view('admin.grade.index',);
    }

    //add Grade
    public function addGrade(Request $request)
    {

        $data = [
            'min_mark' => $request->min_mark,
            'max_mark' => $request->max_mark,
            'grade' => $request->grade,
            'grade_point' => $request->grade_point
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
            'grade_point' => $request->grade_point
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


        $data = [
            'register_no' => $request->txt_regiter_no,
            'roll_no' => $request->txt_roll_no,
            'admission_date' => $request->admission_date,
            'category_id' => $request->categy,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'gender' => $request->gender,
            'blood_group' => $request->blooddgrp,
            'birthday' => $request->dob,
            'mother_tongue' => $request->txt_mothertongue,
            'religion' => $request->txt_religion,
            'caste' => $request->txt_caste,
            'mobile_no' => $request->txt_mobile_no,
            'city' => $request->drp_city,
            'state' => $request->drp_state,
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
            'password' => $request->txt_pwd,
            'confirm_password' => $request->txt_retype_pwd,

            'parent_name' => $request->txt_name,
            'relation' => $request->txt_relation,
            'father_name' => $request->txt_fathernam,
            'mother_name' => $request->txt_mothernam,
            'occupation' => $request->txt_occupation,
            'income' => $request->txt_income,
            'education' => $request->txt_eduction,
            'parent_city' => $request->txt_guardian_city,
            'parent_state' => $request->txt_guardian_state,
            'parent_mobile_no' => $request->txt_guardian_mobileno,
            'address' => $request->txt_guardian_address,
            'parent_email' => $request->txt_guardian_email,
            'parent_password' => $request->txt_guardian_pwd,
            'parent_confirm_password' => $request->txt_guardian_retyppwd,

        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.admission_add'), $data);
        // dd($response);
        return $response;
    }
    public function byclasss()
    {
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        //   $allGrades = Helper::GetMethod(config('constants.api.tot_grade_calcu_byclass'));
        $allGrades = Helper::GetMethod(config('constants.api.tot_grade_master'));

        return view(
            'admin.exam_results.byclass',
            [
                'classnames' => $getclass['data'],
                'allGrades' => $allGrades['data']
            ]
        );
    }
    // exam master -> exam result start
    public function bysubject()
    {
        return view('admin.exam_results.bysubject');
    }
    public function overall()
    {
        return view('admin.exam_results.overall');
    }
    public function bystudent()
    {
        return view('super_admin.exam_results.bystudent');
    }
    public function examResult()
    {
        return view('super_admin.exam.result');
    }

    public function testResult()
    {
       
        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        //$get_exams = Helper::GetMethod(config('constants.api.get_testresult_exams'));
        // dd($response);     
        return view('admin.testresult.index', [
            'classes' => $getclass['data']
        ]);       
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
    // exam master -> exam result end
}
