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

class AdminController extends Controller
{
    // forum screen pages start
    public function forumIndex()
    {
        return view('admin.forum.index');
    }
    public function forumPageSingleTopic()
    {
        return view('admin.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        return view('admin.forum.page-create-topic');
    }
    public function forumPageSingleUser()
    {
        return view('admin.forum.page-single-user');
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
        return view('admin.forum.page-categories');
    }
    public function forumPageCategoriesSingle()
    {
        return view('admin.forum.page-categories-single');
    }
    public function forumPageTabs()
    {
        return view('admin.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('admin.forum.page-tabs-guidelines');
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
        return view('admin.admission.index');
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
        return view('admin.homework.index');
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
    public function examHall()
    {
        return view('admin.exam_hall.index');
    }
    public function examMarkDistribution()
    {
        return view('admin.exam_mark_distribution.index');
    }
    public function exam()
    {
        return view('admin.exam.index');
    }
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
                                 <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editEmployeeBtn"><i class="fe-edit"></i></a>
                                 <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEmployeeBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    // get Employee row details
    public function getEmployeeDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.employee_details'), $data);
        return $response;
    }

    // show employee
    public function showEmployee()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));

        $data = [
            'status' => 0
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        $emp_department = Helper::PostMethod(config('constants.api.emp_department'),[]);
        $emp_designation = Helper::PostMethod(config('constants.api.emp_designation'),[]);
        return view(
            'admin.employee.index',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
                'emp_department' => !empty($emp_department)?$emp_department['data']:$emp_department,
                'emp_designation' => !empty($emp_designation)?$emp_designation['data']:$emp_designation,
            ]
        );
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
        return view('admin.task.index');
    }


    public function evaluationReport()
    {
        return view('admin.homework.evaluation_report');
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
}
