<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
// base controller add
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Validation\Rule;

use App\Models\Branches;
use App\Models\Section;
use App\Helpers\Helper;
use App\Models\Classes;
use App\Models\Role;
use App\Models\SectionAllocation;
use App\Models\TeacherAllocation;
use App\Models\EventType;
use App\Models\Event;
use App\Models\Staff;
use App\Models\User;
use App\Models\StaffDepartments;
use App\Models\StaffDesignation;
// db connection
use App\Helpers\DatabaseConnection;
use App\Models\Tenant\StaffDepartment;
use App\Models\Forum_posts;
use App\Models\Forum_count_details;
use App\Models\Forum_post_replies;
use Carbon\Carbon;
use App\Models\Forum_post_replie_counts;

class ApiController extends BaseController
{
    //
    public function getRoles(Request $request)
    {
        $data = Role::where('status', $request->status)->get();
        return $this->successResponse($data, 'Section record fetch successfully');
    }
    // add section
    public function addSection(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section = new Section();
            $section->name = $request->name;
            $section->capacity = $request->capacity;
            $section->branch_id = $request->branch_id;
            $query = $section->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Section has been successfully saved');
            }
        }
    }
    // get sections 
    public function getSectionList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $secConn = $this->createNewConnection($request->branch_id);
            // get data
            $section = $secConn->table('sections')->get();
            return $this->successResponse($section, 'Sections record fetch successfully');
        }
    }
    // get section row details
    public function getSectionDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'section_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section_id = $request->section_id;
            $sectionDetails = Section::find($section_id);
            return $this->successResponse($sectionDetails, 'Section row fetch successfully');
        }
    }
    // update section
    public function updateSectionDetails(Request $request)
    {
        $section_id = $request->sid;

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required|unique:sections,name,' . $section_id
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $section = Section::find($section_id);
            $section->name = $request->name;
            $section->capacity = $request->capacity;
            $section->branch_id = $request->branch_id;
            $query = $section->save();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Section Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // delete Section
    public function deleteSection(Request $request)
    {

        $section_id = $request->sid;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'sid' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = Section::find($section_id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Section have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add branch 
    public function addBranch(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
            'school_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'db_name' => 'required',
            'db_username' => 'required',
            'password' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {


            $existUser = $this->existUser($request->email);
            if ($existUser) {
                $existBranch = $this->existBranch($request->email);
                if ($existBranch) {
                    $student_name = $request->name;
                    $db_name = $request->db_name;
                    $db_username = $request->db_username;
                    $db_password = $request->db_password;
                    $branch_code = Helper::CodeGenerator(new Branches, 'branch_code', 4, 'PZ');
                    // to migrate database structure
                    $migrate = $this->DBMigrationCall($db_name, $db_username, $db_password);
                    if ($migrate) {
                        // create new branches
                        $branch = new Branches();
                        $branch->branch_code = $branch_code;
                        $branch->name = $request->name;
                        $branch->school_name = $request->school_name;
                        $branch->email = $request->email;
                        $branch->mobile_no = $request->mobile_no;
                        $branch->currency = $request->currency;
                        $branch->symbol = $request->symbol;
                        $branch->country_id = $request->country_id;
                        $branch->state_id = $request->state_id;
                        $branch->city_id = $request->city_id;
                        $branch->address = $request->address;
                        $branch->db_name = $request->db_name;
                        $branch->db_username = $request->db_username;
                        $branch->db_password = $request->db_password;
                        $query = $branch->save();

                        $success = [];
                        if (!$query) {
                            return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                        } else {
                            $lastInsertID = $branch->id;
                            // create admin login users for schoolcrm
                            $createUser = $this->createUser($request, $lastInsertID);
                            // prin$createUser;exit;
                            if ($createUser) {
                                return $this->successResponse($success, 'New Branch has been successfully saved');
                            } else {
                                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong creating user branch']);
                            }
                        }
                    } else {
                        return $this->send500Error('Error while creating Database', ['error' => 'Error while creating Database']);
                    }
                } else {
                    return $this->send500Error('Branch exist', ['error' => 'Branch exist']);
                }
            } else {
                return $this->send500Error('User exist', ['error' => 'User exist']);
            }
        }
    }
    // get branch 
    public function getBranchList(Request $request)
    {
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('branches as br')
                ->select('br.*', 'ct.name as country_name', 'st.name as state_name', 'ci.name as city_name')
                ->join('countries as ct', 'br.country_id', '=', 'ct.id')
                ->join('states as st', 'br.state_id', '=', 'st.id')
                ->join('cities as ci', 'br.city_id', '=', 'ci.id')
                ->when($country_id, function ($query, $country_id) {
                    return $query->where('br.country_id', $country_id);
                })
                ->when($state_id, function ($query, $state_id) {
                    return $query->where('br.state_id', $state_id);
                })
                ->when($city_id, function ($query, $city_id) {
                    return $query->where('br.city_id', $city_id);
                })
                ->where('status', 0)
                ->get();
            return $this->successResponse($success, 'Branch record fetch successfully');
        }
    }
    // get branch row details
    public function getBranchDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            $branchDetails = Branches::find($id);
            return $this->successResponse($branchDetails, 'Branch row fetch successfully');
        }
    }
    // update branch
    public function updateBranchDetails(Request $request)
    {
        $id = $request->id;

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
            'name' => 'required',
            'school_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // $query = Branches::find($id)->update($request->all());
            $branch = Branches::find($id);
            $branch->name = $request->name;
            $branch->school_name = $request->school_name;
            $branch->email = $request->email;
            $branch->mobile_no = $request->mobile_no;
            $branch->currency = $request->currency;
            $branch->symbol = $request->symbol;
            $branch->country_id = $request->country_id;
            $branch->state_id = $request->state_id;
            $branch->city_id = $request->city_id;
            $branch->address = $request->address;
            $query = $branch->save();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Branch Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // delete Section
    public function deleteBranch(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $branch = Branches::find($id);
            $branch->status = 2;
            $query = $branch->save();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Branch have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add class
    public function addClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
            'name_numeric' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $class = new Classes();
            $class->name = $request->name;
            $class->name_numeric = $request->name_numeric;
            $class->branch_id = $request->branch_id;
            $query = $class->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Class has been successfully saved');
            }
        }
    }

    // get classes 
    public function getClassList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $classConn = $this->createNewConnection($request->branch_id);
            // get data
            $class = $classConn->table('classes')->get();
            return $this->successResponse($class, 'Class record fetch successfully');
        }
    }
    // get class row details
    public function getClassDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $class_id = $request->class_id;
            $classDetails = Classes::find($class_id);
            return $this->successResponse($classDetails, 'Class row fetch successfully');
        }
    }
    // update class
    public function updateClassDetails(Request $request)
    {
        $class_id = $request->class_id;

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required|unique:classes,name,' . $class_id,
            'name_numeric' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $class = Classes::find($class_id);
            $class->name = $request->name;
            $class->name_numeric = $request->name_numeric;
            $class->branch_id = $request->branch_id;
            $query = $class->save();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Class Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // delete class
    public function deleteClass(Request $request)
    {

        $class_id = $request->class_id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'class_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = Classes::find($class_id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Class have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add section allocations
    public function addSectionAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
            'section_id' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section = new SectionAllocation();
            $section->class_id = $request->class_id;
            $section->section_id = $request->section_id;
            $section->branch_id = $request->branch_id;
            $query = $section->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Section Allocation has been successfully saved');
            }
        }
    }
    // get sections allocation
    public function getSectionAllocationList(Request $request)
    {
        $sectionAllocation = DB::table('sections_allocations as sa')
            ->select('sa.id', 'sa.class_id', 'sa.section_id', 's.name as section_name', 'c.name as class_name', 'c.name_numeric', 'b.name as branch_name')
            ->join('sections as s', 'sa.section_id', '=', 's.id')
            ->join('branches as b', 'sa.branch_id', '=', 'b.id')
            ->join('classes as c', 'sa.class_id', '=', 'c.id')
            ->get();
        return $this->successResponse($sectionAllocation, 'Section Allocation record fetch successfully');
    }

    // get getSectionAllocationDetails details
    public function getSectionAllocationDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            $SectionAllocation = SectionAllocation::find($id);
            return $this->successResponse($SectionAllocation, 'Class row fetch successfully');
        }
    }
    // update Section Allocations

    public function updateSectionAllocation(Request $request)
    {
        $id = $request->id;

        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
            'section_id' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $section = SectionAllocation::find($id);
            $section->class_id = $request->class_id;
            $section->section_id = $request->section_id;
            $section->branch_id = $request->branch_id;
            $query = $section->save();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Section Allocation Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete deleteSectionAllocation
    public function deleteSectionAllocation(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = SectionAllocation::where('id', $id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Section Allocation have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add TeacherAllocation
    public function addTeacherAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required',
            'class_teacher' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $teacherAllocation = new TeacherAllocation();
            $teacherAllocation->class_id = $request->class_name;
            $teacherAllocation->section_id = $request->section_name;
            $teacherAllocation->teacher_id = $request->class_teacher;
            $teacherAllocation->branch_id = $request->branch_id;
            $query = $teacherAllocation->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Teacher Allocation has been successfully saved');
            }
        }
    }

    // get TeacherAllocation 
    public function getTeacherAllocationList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('teacher_allocations as ta')
                ->select('ta.id', 'ta.class_id', 'ta.section_id', 'ta.teacher_id', 's.name as section_name', 'c.name as class_name', 'u.name as teacher_name', 'b.name as branch_name')
                ->join('sections as s', 'ta.section_id', '=', 's.id')
                ->join('branches as b', 'ta.branch_id', '=', 'b.id')
                ->join('classes as c', 'ta.class_id', '=', 'c.id')
                ->join('users as u', 'ta.teacher_id', '=', 'u.id')
                ->get();
            return $this->successResponse($success, 'Teacher Allocation record fetch successfully');
        }
    }
    // get TeacherAllocation row details
    public function getTeacherAllocationDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'teacher_allocation__id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $teacher_allocation__id = $request->teacher_allocation__id;
            $teacherAllocationDetails = TeacherAllocation::find($teacher_allocation__id);
            return $this->successResponse($teacherAllocationDetails, 'Teacher Allocation row fetch successfully');
        }
    }
    // update TeacherAllocation
    public function updateTeacherAllocation(Request $request)
    {
        $teacher_allocation__id = $request->teacher_allocation__id;

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required',
            'class_teacher' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $teacherAllocation = TeacherAllocation::find($teacher_allocation__id);
            $teacherAllocation->class_id = $request->class_name;
            $teacherAllocation->section_id = $request->section_name;
            $teacherAllocation->teacher_id = $request->class_teacher;
            $teacherAllocation->branch_id = $request->branch_id;
            $query = $teacherAllocation->save();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Teacher Allocation Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // delete TeacherAllocation
    public function deleteTeacherAllocation(Request $request)
    {

        $teacher_allocation__id = $request->teacher_allocation__id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'teacher_allocation__id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = TeacherAllocation::find($teacher_allocation__id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Teacher Allocation have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // branchIdByTeacherAllocation 
    public function branchIdByTeacherAllocation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branch_id = $request->branch_id;
            $response = [];
            $response['class'] = Classes::where('branch_id', $branch_id)->get();
            $response['teacher'] = DB::table('users as us')
                ->select('us.id', 'us.user_id', 'us.name')
                ->join('staffs as s', 'us.user_id', '=', 's.id')
                ->join('branches as b', 's.branch_id', '=', 'b.id')
                ->where('s.branch_id', $branch_id)
                ->get();
            return $this->successResponse($response, 'Information fetch successfully');
        }
    }

    // branchIdByClass 
    public function branchIdByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branch_id = $request->branch_id;
            $branchBasedClass = Classes::where('branch_id', $branch_id)->get();
            return $this->successResponse($branchBasedClass, 'Class row fetch successfully');
        }
    }
    // branchIdBySection 
    public function branchIdBySection(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branch_id = $request->branch_id;
            $branchBasedSection = Section::where('branch_id', $branch_id)->get();
            return $this->successResponse($branchBasedSection, 'Section row fetch successfully');
        }
    }
    // add EventType
    public function addEventType(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $event_type = new EventType();
            $event_type->name = $request->name;
            $event_type->branch_id = $request->branch_id;
            $query = $event_type->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Event Type has been successfully saved');
            }
        }
    }

    // get EventTypes 
    public function getEventTypeList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('event_types as et')
                ->select('et.*', 'br.name as branch_name', 'br.branch_code', 'br.school_name')
                ->join('branches as br', 'et.branch_id', '=', 'br.id')
                ->get();
            return $this->successResponse($success, 'Event Type record fetch successfully');
        }
    }
    // get EventType row details
    public function getEventTypeDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'event_type_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $event_type_id = $request->event_type_id;
            $eventTypeDetails = EventType::find($event_type_id);
            return $this->successResponse($eventTypeDetails, 'Event Type row fetch successfully');
        }
    }
    // update EventType
    public function updateEventTypeDetails(Request $request)
    {
        $event_type_id = $request->event_type_id;

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $event_type = EventType::find($event_type_id);
            $event_type->name = $request->name;
            $event_type->branch_id = $request->branch_id;
            $query = $event_type->save();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Event Type Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // delete EventType
    public function deleteEventType(Request $request)
    {

        $event_type_id = $request->event_type_id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'event_type_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = EventType::find($event_type_id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Event Type have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }


    // add Event
    public function addEvent(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'title' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'selected_list' => '',
            'description' => '',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $event = new Event();
            $event->branch_id = $request->branch_id;
            $event->title = $request->title;
            $event->type = $request->type;
            $event->audience = $request->audience;
            $event->selected_list = $request->selected_list;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->remarks = $request->description;

            $user = Auth::id();
            $event->created_by = $user;
            $query = $event->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Event has been successfully saved');
            }
        }
    }

    // get Events 
    public function getEventList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $success = \DB::table("events")
                ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
                ->leftjoin('users', 'users.id', '=', 'events.created_by')
                ->groupBy("events.id")
                ->get();

            return $this->successResponse($success, 'Event record fetch successfully');
        }
    }
    // get Event row details
    public function getEventDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'event_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $event_id = $request->event_id;
            $eventDetails = \DB::table("events")
                ->select("events.*", \DB::raw("GROUP_CONCAT(classes.name) as classname"), 'event_types.name as type', 'users.name as created_by')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
                ->leftjoin('users', 'users.id', '=', 'events.created_by')
                ->groupBy("events.id")
                ->where('events.id', $event_id)->first();
            return $this->successResponse($eventDetails, 'Event row fetch successfully');
        }
    }
    // delete Event
    public function deleteEvent(Request $request)
    {

        $event_id = $request->event_id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'event_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = Event::find($event_id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Event have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // publish Event
    public function publishEvent(Request $request)
    {

        $event_id = $request->event_id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'event_id' => 'required',
            'value' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $event = Event::find($request->event_id);
            $event->status = $request->value;
            $query = $event->save();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Event have been Updated successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // branchIdByEvent 
    public function branchIdByEvent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branch_id = $request->branch_id;
            $response = [];
            $response['class'] = Classes::where('branch_id', $branch_id)->get();
            $response['section'] = DB::table('sections_allocations as sa')
                ->select('sa.id', 'sa.class_id', 'sa.section_id', 's.name as section_name', 'c.name as class_name', 'c.name_numeric', 'b.name as branch_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('branches as b', 'sa.branch_id', '=', 'b.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->where('sa.branch_id', $branch_id)
                ->get();
            $response['eventType'] = EventType::where('branch_id', $branch_id)->get();
            return $this->successResponse($response, 'Information fetch successfully');
        }
    }
    // addDepartment
    public function addDepartment(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('staff_departments')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $staffConn->table('staff_departments')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Department has been successfully saved');
                }
            }
        }
    }
    // getDepartmentList
    public function getDepartmentList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $Department = $staffConn->table('staff_departments')->get();
            return $this->successResponse($Department, 'Department record fetch successfully');
        }
    }
    // get department row details
    public function getDepartmentDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $deptDetails = $staffConn->table('staff_departments')->where('id', $id)->first();
            return $this->successResponse($deptDetails, 'Department row fetch successfully');
        }
    }
    // update department
    public function updateDepartment(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('staff_departments')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('staff_departments')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Department Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Section
    public function deleteDepartment(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // $query = StaffDepartments::find($id)->delete();
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $staffConn->table('staff_departments')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Department have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // addDesignation
    public function addDesignation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('staff_designations')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $staffConn->table('staff_designations')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Designation has been successfully saved');
                }
            }
        }
    }
    // getDesignationList
    public function getDesignationList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $Designation = $staffConn->table('staff_designations')->get();
            return $this->successResponse($Designation, 'Designation record fetch successfully');
        }
    }
    // getDesignationDetails row details
    public function getDesignationDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $desDetails = $staffConn->table('staff_designations')->where('id', $id)->first();
            return $this->successResponse($desDetails, 'Designation row fetch successfully');
        }
    }
    // update updateDesignation
    public function updateDesignation(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('staff_designations')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('staff_designations')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Designation Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Designation
    public function deleteDesignation(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $staffConn->table('staff_designations')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Designation have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // employee departments
    public function getEmpDepartment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $staffConn->table('staff_departments')->get();
            return $this->successResponse($StaffDepartment, 'Department record fetch successfully');
        }
    }
    // employee designation
    public function getEmpDesignation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffDesignation = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDesig = $staffDesignation->table('staff_designations')->get();
            return $this->successResponse($StaffDesig, 'Designation record fetch successfully');
        }
    }

    // add Employee
    public function addEmployee(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'role_id' => 'required',
            'joining_date' => 'required',
            'designation_id' => 'required',
            'designation_id' => 'required',
            'qualification' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'blood_group' => 'required',
            'birthday' => 'required',
            'mobile_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            if ($Connection->table('staffs')->where('email', '=', $request->email)->count() > 0) {
                return $this->send422Error('Email Already Exist', ['error' => 'Email Already Exist']);
            } else {
                // add bank details validation
                if ($request->skip_bank_details == 1) {
                    $validator = \Validator::make($request->all(), [
                        'bank_name' => 'required',
                        'holder_name' => 'required',
                        'bank_branch' => 'required',
                        'bank_address' => 'required',
                        'ifsc_code' => 'required',
                        'account_no' => 'required',
                    ]);
                    if (!$validator->passes()) {
                        return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
                    }
                }

                $picture = null;
                if (!empty($request->file('photo'))) {
                    $picture = $this->uploadUserProfile($request);
                }
                // update data
                $Staffid = $Connection->table('staffs')->insertGetId([
                    // 'staff_id' => $request->staff_id,
                    'name' => $request->name,
                    'department_id' => $request->department_id,
                    'designation_id' => $request->designation_id,
                    'qualification' => $request->qualification,
                    'joining_date' => $request->joining_date,
                    'birthday' => $request->birthday,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'blood_group' => $request->blood_group,
                    'present_address' => $request->present_address,
                    'permanent_address' => $request->permanent_address,
                    'mobile_no' => $request->mobile_no,
                    'email' => $request->email,
                    'photo' => $picture,
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'twitter_url' => $request->twitter_url,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$Staffid) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add employee']);
                } else {
                    // add bank details
                    if ($request->skip_bank_details == 1) {
                        $bank = $Connection->table('staff_bank_accounts')->insert([
                            'staff_id' => $Staffid,
                            'bank_name' => $request->bank_name,
                            'holder_name' => $request->holder_name,
                            'bank_branch' => $request->bank_branch,
                            'bank_address' => $request->bank_address,
                            'ifsc_code' => $request->ifsc_code,
                            'account_no' => $request->account_no,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                    // add picture
                    $user = new User();
                    $user->name = $request->name;
                    $user->user_id = $Staffid;
                    $user->role_id = $request->role_id;
                    $user->branch_id = $request->branch_id;
                    $user->picture = $picture;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $query = $user->save();
                    $success = [];
                    if (!$query) {
                        return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                    } else {
                        return $this->successResponse($success, 'Employee has been successfully saved');
                    }
                }
            }
        }
    }

    // getEmployeeList
    public function getEmployeeList(Request $request)
    {
        // create new connection
        $Connection = $this->createNewConnection($request->branch_id);
        $Staff = $Connection->table('staffs as s')
            ->select('s.*', 'dp.name as department_name', 'ds.name as designation_name')
            ->join('staff_departments as dp', 's.department_id', '=', 'dp.id')
            ->join('staff_designations as ds', 's.designation_id', '=', 'ds.id')
            ->get();
        return $this->successResponse($Staff, 'Staff record fetch successfully');
    }

    // getEmployeeDetails row details
    public function getEmployeeDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required'
        ]);


        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $empDetails['staff'] = $staffConn->table('staffs')->where('id', $id)->first();
            $empDetails['bank'] = $staffConn->table('staff_bank_accounts')->where('staff_id', $id)->first();
            $empDetails['user'] = User::where('user_id', $id)->where('branch_id', $request->branch_id)->first();
            return $this->successResponse($empDetails, 'Employee row fetch successfully');
        }
    }
    // update updateEmployee
    public function updateEmployee(Request $request)
    {
        $id = $request->id;

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'role_id' => 'required',
            'joining_date' => 'required',
            'designation_id' => 'required',
            'designation_id' => 'required',
            'qualification' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'blood_group' => 'required',
            'birthday' => 'required',
            'mobile_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            if ($Connection->table('staffs')->where([['email', '=', $request->email], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Email Already Exist', ['error' => 'Email Already Exist']);
            } else {

                // dd($request);
                // add bank details validation
                if ($request->skip_bank_details == 1) {
                    $validator = \Validator::make($request->all(), [
                        'bank_name' => 'required',
                        'holder_name' => 'required',
                        'bank_branch' => 'required',
                        'bank_address' => 'required',
                        'ifsc_code' => 'required',
                        'account_no' => 'required',
                    ]);
                    if (!$validator->passes()) {
                        return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
                    }
                }

                $picture = null;
                if (!empty($request->file('photo'))) {
                    $picture = $this->uploadUserProfile($request);
                }
                // update data
                $query = $Connection->table('staffs')->where('id', $id)->update([
                    // 'staff_id' => $request->staff_id,
                    'name' => $request->name,
                    'department_id' => $request->department_id,
                    'designation_id' => $request->designation_id,
                    'qualification' => $request->qualification,
                    'joining_date' => $request->joining_date,
                    'birthday' => $request->birthday,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'blood_group' => $request->blood_group,
                    'present_address' => $request->present_address,
                    'permanent_address' => $request->permanent_address,
                    'mobile_no' => $request->mobile_no,
                    'photo' => $picture,
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'twitter_url' => $request->twitter_url,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong on Update employee']);
                } else {
                    // add bank details
                    if ($request->skip_bank_details == 1) {
                        $bank = $Connection->table('staff_bank_accounts')->where('staff_id', $id)->update([
                            'staff_id' => $id,
                            'bank_name' => $request->bank_name,
                            'holder_name' => $request->holder_name,
                            'bank_branch' => $request->bank_branch,
                            'bank_address' => $request->bank_address,
                            'ifsc_code' => $request->ifsc_code,
                            'account_no' => $request->account_no,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                    $success = [];
                    if (!$query) {
                        return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                    } else {
                        return $this->successResponse($success, 'Employee Details have Been updated');
                    }
                }
            }
        }
    }
    // delete Employee
    public function deleteEmployee(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $staffConn->table('staffs')->where('id', $id)->delete();
            $query = $staffConn->table('staff_bank_accounts')->where('staff_id', $id)->delete();
            $query = User::where('user_id', $id)->where('branch_id', $request->branch_id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Employee have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }


    // SectionByClass 
    public function sectionByClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $classConn = $this->createNewConnection($request->branch_id);
            // get data
            $class_id = $request->class_id;
            $class = $classConn->table('section_allocations as sa')->select('s.id', 's.name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->where('sa.class_id', $class_id)
                ->get();
            return $this->successResponse($class, 'Class record fetch successfully');
        }
    }

    // subjectByClass 
    public function subjectByClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $classConn = $this->createNewConnection($request->branch_id);
            // get data
            $output['teacher'] = $classConn->table('teacher_allocations as t')->select('s.id', 's.name')
                ->join('staffs as s', 't.teacher_id', '=', 's.id')
                ->where('t.class_id', $request->class_id)
                ->where('t.section_id', $request->section_id)
                ->get();
            $output['subject'] = $classConn->table('subject_assigns as sa')->select('s.id', 's.name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                ->get();
            $output['class_id'] =  $request->class_id;
            $output['section_id'] =  $request->section_id;
            return $this->successResponse($output, 'Teacher and Subject record fetch successfully');
        }
    }

    // add Timetable
    public function addTimetable(Request $request)
    {

        // dd($request);
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'day' => 'required',
            'timetable' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);


            $timetable = $request->timetable;

            foreach ($timetable as $table) {
                if (isset($table['break'])) {

                    // insert data
                    $query = $staffConn->table('timetable_class')->insert([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => 1,
                        'subject_id' => 0,
                        'teacher_id' => 0,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'day' => $request['day'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                } else {
                    // insert data
                    $query = $staffConn->table('timetable_class')->insert([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => 0,
                        'subject_id' => $table['subject'],
                        'teacher_id' => $table['teacher'],
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'day' => $request['day'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'TimeTable has been successfully saved');
            }
        }
    }

    // get imetable List
    public function getTimetableList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            // $Timetable = $con->table('timetable_class')->where('class_id',$request->class_id)->where('section_id',$request->section_id)->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')->get()->toArray();
            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')->where('timetable_class.class_id', $request->class_id)->where('timetable_class.section_id', $request->section_id)->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')->get()->toArray();

            // return $Timetable;
            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                return $this->successResponse($output, 'Timetable record fetch successfully');
            } else {
                return $this->send404Error('No Data Found.', ['error' => 'No Data Found']);
            }
        }
    }

    // edit 
    public function editTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'day' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')->where('timetable_class.day', $request->day)->where('timetable_class.class_id', $request->class_id)->where('timetable_class.section_id', $request->section_id)->get()->toArray();

            // return $Timetable;
            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                $output['details']['day'] = $request->day;
                $output['details']['class'] = $con->table('classes')->select('classes.id as class_id', 'classes.name as class_name')->where('id', $request->class_id)->first();
                $output['details']['section'] = $con->table('sections')->select('sections.id as section_id', 'sections.name as section_name')->where('id', $request->section_id)->first();

                $output['teacher'] = $con->table('teacher_allocations as t')->select('s.id', 's.name')
                    ->join('staffs as s', 't.teacher_id', '=', 's.id')
                    ->where('t.class_id', $request->class_id)
                    ->where('t.section_id', $request->section_id)
                    ->get();
                $output['subject'] = $con->table('subject_assigns as sa')->select('s.id', 's.name')
                    ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                    ->where('sa.class_id', $request->class_id)
                    ->where('sa.section_id', $request->section_id)
                    ->get();

                return $this->successResponse($output, 'Timetable record fetch successfully');
            } else {
                return $this->send404Error('No Data Found.', ['error' => 'No Data Found']);
            }
        }
    }


    // update Timetable
    public function updateTimetable(Request $request)
    {


        // dd($request);
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'day' => 'required',
            'timetable' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);

            $timetable = $request->timetable;

            $oldest = $staffConn->table('timetable_class')->where([['class_id', $request->class_id], ['section_id', $request->section_id]])->get()->toArray();

            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));

            foreach ($diff as $del) {
                // dd($del);
                $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
            }

            foreach ($timetable as $table) {

                $break;
                $subject_id;
                $teacher_id;
                if (isset($table['break'])) {
                    $break = 1;
                    $subject_id = 0;
                    $teacher_id = 0;
                } else {
                    $break = 0;
                    $subject_id = $table['subject'];
                    $teacher_id = $table['teacher'];
                }

                $query = $staffConn->table('timetable_class')->where('id', $table['id'])->update([
                    'class_id' => $request['class_id'],
                    'section_id' => $request['section_id'],
                    'break' => $break,
                    'subject_id' => $subject_id,
                    'teacher_id' => $teacher_id,
                    'class_room' => $table['class_room'],
                    'time_start' => $table['time_start'],
                    'time_end' => $table['time_end'],
                    'day' => $request['day'],
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            }

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'TimeTable has been Update Successfully');
            }
        }
    }


    // get student timetable List
    public function studentTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'student_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $getclass = $con->table('students')->where('id', $request->student_id)->first();

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')->where('timetable_class.class_id', $getclass->class_id)->where('timetable_class.section_id', $getclass->section_id)->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')->get()->toArray();

            // return $Timetable;
            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                $output['details']['class'] = $con->table('classes')->select('classes.id as class_id', 'classes.name as class_name')->where('id', $getclass->class_id)->first();
                $output['details']['section'] = $con->table('sections')->select('sections.id as section_id', 'sections.name as section_name')->where('id', $getclass->section_id)->first();

                return $this->successResponse($output, 'Timetable record fetch successfully');
            } else {
                return $this->send404Error('No Data Found.', ['error' => 'No Data Found']);
            }
        }
    }

    // get parent timetable List
    public function parentTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'parent_id' => 'required'
        ]);

        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $getclass = $con->table('students')->where('parent_id', $request->parent_id)->first();

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')->where('timetable_class.class_id', $getclass->class_id)->where('timetable_class.section_id', $getclass->section_id)->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')->get()->toArray();

            // return $Timetable;
            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                $output['details']['class'] = $con->table('classes')->select('classes.id as class_id', 'classes.name as class_name')->where('id', $getclass->class_id)->first();
                $output['details']['section'] = $con->table('sections')->select('sections.id as section_id', 'sections.name as section_name')->where('id', $getclass->section_id)->first();

                return $this->successResponse($output, 'Timetable record fetch successfully');
            } else {
                return $this->send404Error('No Data Found.', ['error' => 'No Data Found']);
            }
        }
    }

    // updatePicture settings
    public function updatePicture(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $path = 'users/images/';
            $file = $request->file('profile_image');
            $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

            //Upload new image
            $upload = $file->move(public_path($path), $new_name);

            if (!$upload) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong, upload new picture failed.']);
            } else {
                //Get Old picture
                $oldPicture = User::find($request->id)->getAttributes()['picture'];

                if ($oldPicture != '') {
                    if (\File::exists(public_path($path . $oldPicture))) {
                        \File::delete(public_path($path . $oldPicture));
                    }
                }
                //Update DB
                $update = User::find($request->id)->update(['picture' => $new_name]);
                $data = [
                    "file_name" => $new_name
                ];
                if (!$upload) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong, updating picture is failed.']);
                } else {
                    return $this->successResponse($data, 'Your profile picture has been updated successfully');
                }
            }
        }
    }
    // change password
    public function changePassword(Request $request)
    {
        $dbPass = User::find($request->id)->getAttributes()['password'];
        //Validate form
        $validator = \Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) use ($dbPass) {
                    if (!\Hash::check($value, $dbPass)) {
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
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find($request->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong, Failed to update password.']);
            } else {
                return $this->successResponse([], 'Your password has been changed successfully');
            }
        }
    }

    // update profile info
    public function updateProfileInfo(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'address' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong, Failed to update profile.']);
            } else {
                return $this->successResponse([], 'Your profile info has been update successfuly.');
            }
        }
    }
    // Forum Create Post
    public function forumCreatePost(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'token' => 'required',
            'topic_title' => 'required',
            'topic_header' => 'required',
            'types' => 'required',
            'body_content' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'imagesorvideos' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $class = new Forum_posts();
            $getCount = Forum_posts::where('topic_title', '=', $request->topic_title)->get();
            if ($getCount->count() > 0) {
                return $this->send422Error('Topic Title Already Exist', ['error' => 'Topic Title Already Exist']);
            } else {
                $class->branch_id = $request->branch_id;
                $class->user_id = $request->user_id;
                $class->user_name = $request->user_name;
                $class->topic_title = $request->topic_title;
                $class->topic_header = $request->topic_header;
                $class->types = $request->types;
                $class->body_content = $request->body_content;
                $class->category = $request->category;
                $class->tags = $request->tags;
                $class->imagesorvideos = $request->imagesorvideos;
                $class->created_at = date("Y-m-d H:i:s");
                $query = $class->save();
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'New post has been successfully created');
                }
            }
        }
    }
    public function postList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')
                ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
                ->leftJoin('forum_count_details', function ($join) {
                    $join->on('forum_count_details.created_post_id', '=', 'forum_posts.id')
                        ->orWhere('forum_posts.user_id', '`c.user_id`');
                })
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.category_names', 'forum_count_details.likes', 'forum_count_details.dislikes', 'forum_count_details.favorite', 'forum_count_details.replies', 'forum_count_details.views', 'forum_count_details.activity')
                ->get();
       
            return $this->successResponse($success, 'Post record fetch successfully');
        }
    }
    public function singlePost(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'user_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')
                ->select('forum_posts.id', 'forum_posts.category as category', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name', DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), 'forum_count_details.likes as likes', 'forum_count_details.dislikes as dislikes', 'forum_count_details.favorite as favorite', 'forum_count_details.replies as replies', 'forum_count_details.views as views', 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id', 'forum_categorys.category_names')
                ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
                ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
                ->where([
                    ['forum_posts.id', '=', $request->id],
                    [
                        'forum_posts.user_id', '=', $request->user_id
                    ]
                ])
                ->get();
            return  $this->successResponse($success, 'Post record fetch successfully');
        }
    }
    public function singlePostReplies(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'user_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_post_replies')
                ->select('forum_post_replies.id as pk_replies_id', 'forum_post_replies.created_post_id as created_post_id', 'forum_post_replies.branch_id as branch_id', 'forum_post_replies.user_id as user_id', 'forum_post_replies.user_name as user_name', 'replies_com', 'forum_post_replie_counts.id as pk_replies_count_id', 'forum_post_replie_counts.likes as likes', 'forum_post_replie_counts.dislikes as dislikes', 'forum_post_replie_counts.favorits as favorits', DB::raw('DATE_FORMAT(forum_post_replies.created_at, "%b %e %Y") as date'))
                ->leftJoin('forum_post_replie_counts', 'forum_post_replies.id', '=', 'forum_post_replie_counts.created_post_replies_id')
                ->where('forum_post_replies.created_post_id', '=', $request->id)
                ->get();
            //    DB::table('forum_post_replies')
            //   ->select('id as pk_replies_id', 'created_post_id', 'branch_id', 'user_id', 'user_name', 'replies_com',DB::raw('DATE_FORMAT(created_at, "%b %e %Y") as date','forum_post_replie_counts.id as pk_replies_count_id'))
            //   ->leftJoin('forum_post_replie_counts', 'forum_post_replies.id', '=', 'forum_post_replie_counts.created_post_replies_id')
            //   ->where('created_post_id','=', $request->id)
            //   ->get();

            return  $this->successResponse($success, 'Post replies fetch successfully');
        }
    }
    // class room teacher_class
    function getTeachersClassName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'teacher_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('subject_assigns as sa')
                ->select('sa.class_id', 'sa.teacher_id', 'c.name as class_name')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->where('sa.teacher_id', $request->teacher_id)
                ->groupBy("sa.class_id")
                ->get();
            return $this->successResponse($getTeachersClassName, 'Teachers Class Name record fetch successfully');
        }
    }
    // class room teacher_section
    function getTeachersSectionName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('subject_assigns as sa')
                ->select('sa.class_id', 'sa.section_id', 'sa.teacher_id', 's.name as section_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                // ->where('sa.teacher_id',$request->teacher_id)
                ->where([
                    ['sa.teacher_id', '=', $request->teacher_id],
                    ['sa.class_id', '=', $request->class_id],
                ])
                ->groupBy("sa.section_id")
                ->get();
            return $this->successResponse($getTeachersClassName, 'Teachers Section Name record fetch successfully');
        }
    }
    // get subject name getTeachersSubjectName
    // class room teacher_section
    function getTeachersSubjectName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('subject_assigns as sa')
                ->select('sa.class_id', 'sa.subject_id', 'sa.teacher_id', 'sa.subject_id', 's.name as subject_name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                ->where([
                    ['sa.teacher_id', '=', $request->teacher_id],
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                ])
                ->groupBy("sa.subject_id")
                ->get();
            return $this->successResponse($getTeachersClassName, 'Teachers Subject Name record fetch successfully');
        }
    }
    public function viewcountinsert(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'create_post_id' => 'required',
            'views' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section = new Forum_count_details();
            $section->user_id = $request->user_id;
            $section->user_name = $request->user_name;
            $section->created_post_id = $request->create_post_id;
            $section->views = $request->views;
            $section->branch_id = $request->branch_id;
            $query = $section->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                $success = DB::table('forum_count_details')
                    ->select(DB::raw("SUM(views) as views"), 'id')
                    ->where('created_post_id', $request->create_post_id)
                    ->get();
                return $this->successResponse($success, 'View has been successfully hit');
            }
        }
    }
    public function viewcountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            DB::table('forum_count_details')
                ->where('id', $request->id)
                ->increment('views', 1);
            $success = DB::table('forum_count_details')
                ->select('views', 'likes', 'dislikes', 'favorite')
                ->where('id', $request->id)
                ->get();

            return $this->successResponse($success, 'views successfully');
        }
    }
    public function likescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // already in this user like this post or not check 
            $success = DB::table('forum_count_details')
                ->select('likes')
                ->where('id', $request->id)
                ->first();
            $getlikes = $success->likes;
            //echo gettype($bodyContent);
            //dd($bodyContent);
            if ($getlikes <= 0) {
                DB::table('forum_count_details')
                    ->where('id', $request->id)
                    ->increment('likes', 1);
                $success = DB::table('forum_count_details')
                    ->select(DB::raw("SUM(likes) as likes"))
                    ->where('created_post_id', $request->id)
                    ->get();
            }
            return $this->successResponse($success, 'like successfully');
        }
    }
    public function dislikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // already in this user like this post or not check 
            $success = DB::table('forum_count_details')
                ->select('dislikes')
                ->where('id', $request->id)
                ->first();
            $getlikes = $success->dislikes;
            //echo gettype($bodyContent);
            //dd($bodyContent);
            if ($getlikes <= 0) {
                DB::table('forum_count_details')
                    ->where('id', $request->id)
                    ->increment('dislikes', 1);
                $success = DB::table('forum_count_details')
                    ->select(DB::raw("SUM(dislikes) as dislikes"))
                    ->where('created_post_id', $request->id)
                    ->get();
            }

            return $this->successResponse($success, 'dislike successfully');
        }
    }
    public function heartcountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // already in this user like this post or not check 
            $success = DB::table('forum_count_details')
                ->select('favorite')
                ->where('id', $request->id)
                ->first();
            $getlikes = $success->favorite;
            //echo gettype($bodyContent);
            //dd($bodyContent);
            if ($getlikes <= 0) {
                DB::table('forum_count_details')
                    ->where('id', $request->id)
                    ->increment('favorite', 1);
                $success = DB::table('forum_count_details')
                    ->select(DB::raw("SUM(favorite) as favorite"))
                    ->where('created_post_id', $request->id)
                    ->get();
            }
            return $this->successResponse($success, 'Heart successfully');
        }
    }
    // getStudentAttendence
    function getStudentAttendence(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $date = $request->date;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    'st.first_name',
                    'st.last_name',
                    'st.register_no',
                    'sa.id as att_id',
                    'sa.status as att_status',
                    'sa.remarks as att_remark',
                    'sa.date',
                    'sa.student_behaviour',
                    'sa.classroom_behaviour',
                    'sa.reasons'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('student_attendances as sa', function ($q) use ($date, $subject_id) {
                    $q->on('sa.student_id', '=', 'st.id')
                        ->on('sa.date', '=', DB::raw("'$date'")) //second join condition                           
                        ->on('sa.subject_id', '=', DB::raw("'$subject_id'")); //need to add subject id also later                           
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->get();

            return $this->successResponse($getTeachersClassName, 'Attendance record fetch successfully');
        }
    }
    //add attendance
    function addStudentAttendence(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'attendance' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $attendance = $request->attendance;
            $date = $request->date;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $date = $request->date;
            $data = [];
            foreach ($attendance as $key => $value) {
                // dd($value['attendance_id']);
                $attStatus = (isset($value['att_status']) ? $value['att_status'] : "");
                $att_remark = (isset($value['att_remark']) ? $value['att_remark'] : "");
                $reasons = (isset($value['reasons']) ? $value['reasons'] : "");
                $student_behaviour = (isset($value['student_behaviour']) ? $value['student_behaviour'] : "");
                $classroom_behaviour = (isset($value['classroom_behaviour']) ? $value['classroom_behaviour'] : "");
                $arrayAttendance = array(
                    'student_id' => $value['student_id'],
                    'status' => $attStatus,
                    'remarks' => $att_remark,
                    'reasons' => $reasons,
                    'student_behaviour' => $student_behaviour,
                    'classroom_behaviour' => $classroom_behaviour,
                    'date' => $date,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id

                );
                $returnData = array(
                    'att_status' => $attStatus,
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name']
                );
                array_push($data, $returnData);
                if ((empty($value['attendance_id']) || $value['attendance_id'] == "null")) {
                    $Connection->table('student_attendances')->insert($arrayAttendance);
                } else {
                    $Connection->table('student_attendances')->where('id', $value['attendance_id'])->update([
                        'status' => $attStatus,
                        'remarks' => $att_remark,
                        'reasons' => $reasons,
                        'student_behaviour' => $student_behaviour,
                        'classroom_behaviour' => $classroom_behaviour,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
            return $this->successResponse($data, 'Attendance added successfuly.');
        }
    }
    // getShortTest
    function getShortTest(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $date = $request->date;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    'st.first_name',
                    'st.last_name'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->get();

            return $this->successResponse($getTeachersClassName, 'Short test record fetch successfully');
        }
    }
    // add short test
    function addShortTest(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'short_test' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $short_test = $request->short_test;
            $date = $request->date;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $date = $request->date;

            foreach ($short_test as $key => $value) {
                // dd($value['attendance_id']);
                $grade_status = (isset($value['grade_status']) ? $value['grade_status'] : "");
                $test_marks = (isset($value['test_marks']) ? $value['test_marks'] : "");

                $addShortTest = array(
                    'student_id' => $value['student_id'],
                    'test_name' => $value['test_name'],
                    'grade_status' => $grade_status,
                    'test_marks' => $test_marks,
                    'date' => $date,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                $checkExist = $Connection->table('short_tests')->where([['test_name', '=', $value['test_name']], ['date', '=', $date], ['student_id', '=', $value['student_id']]])->first();

                if ($Connection->table('short_tests')->where([['test_name', '=', $value['test_name']], ['date', '=', $date], ['student_id', '=', $value['student_id']]])->count() > 0) {
                    $Connection->table('short_tests')->where('id', $checkExist->id)->update([
                        'grade_status' => $grade_status,
                        'test_marks' => $test_marks,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                } else {
                    $Connection->table('short_tests')->insert($addShortTest);
                }
            }
            return $this->successResponse([], 'Short test added successfuly.');
        }
    }
    // addDailyReport
    function addDailyReport(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'daily_report' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // insert data
            $query = $Connection->table('daily_reports')->insert([
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'report' => $request->daily_report,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Daily report added successfully');
            }
        }
    }
    // get Daily Report Remarks
    function getDailyReportRemarks(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getDailyReportRemarks = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'st.first_name',
                    'st.last_name',
                    'dr.student_remarks',
                    'dr.teacher_remarks',
                    'dr.id'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->join('daily_report_remarks as dr', 'dr.student_id', '=', 'en.student_id')
                ->where([
                    ['dr.class_id', '=', $request->class_id],
                    ['dr.section_id', '=', $request->section_id],
                    ['dr.subject_id', '=', $request->subject_id],
                ])
                ->get();

            return $this->successResponse($getDailyReportRemarks, 'Daily report remarks fetch successfully');
        }
    }
    // addDailyReportRemarks
    function addDailyReportRemarks(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'daily_report_remarks' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $daily_report_remarks = $request->daily_report_remarks;

            $Connection = $this->createNewConnection($request->branch_id);
            foreach ($daily_report_remarks as $key => $value) {
                // dd($value['attendance_id']);
                $teacher_remarks = (isset($value['teacher_remarks']) ? $value['teacher_remarks'] : "");
                $reportRemarks = array(
                    'student_id' => $value['student_id'],
                    'teacher_remarks' => $teacher_remarks,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                $Connection->table('daily_report_remarks')->where('id', $value['id'])->update($reportRemarks);
            }
            return $this->successResponse([], 'Remarks added successfuly.');
        }
    }
    // get widget details
    function getClassroomWidget(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getWidgetDetails = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),
                )
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    ['sa.date', '=', $request->date],
                ])
                ->get();

            return $this->successResponse($getWidgetDetails, 'Wigget record fetch successfully');
        }
    }
    public function replikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [          
            'token' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            //
            $addShortTest = [
                "created_post_id" => $request->create_post_id,
                "created_post_replies_id" => $request->created_post_replies_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "likes" =>  $request->likes,
                "dislikes"=>0,
                "favorits"=>0
            ];
            $checkExist = DB::table('forum_post_replie_counts')->where([
                ['created_post_id', '=', $request->create_post_id],
                ['created_post_replies_id', '=', $request->created_post_replies_id],
                ['user_id', '=', $request->user_id]
            ])->first();
            // dd($checkExist);
            if (empty($checkExist)) {
                // echo "update";
                DB::table('forum_post_replie_counts')->insert($addShortTest);
            }
            $success = DB::table('forum_post_replie_counts')
                ->select(DB::raw("SUM(likes) as likes"))
                ->where('created_post_replies_id', $request->created_post_replies_id)
                ->get();
            return $this->successResponse($success, 'Replike successfully');
        }
    }
    public function repdislikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // already in this user like this post or not check 
            $success = DB::table('forum_post_replie_counts')
                ->select('dislikes')
                ->where('id', $request->id)
                ->first();
            $getdislikes = $success->dislikes;
            //echo gettype($bodyContent);
            //dd($bodyContent);
            if ($getdislikes <= 0) {
                DB::table('forum_post_replie_counts')
                    ->where('id', $request->id)
                    ->increment('dislikes', 1);
                $success = DB::table('forum_post_replie_counts')
                    ->select(DB::raw("SUM(dislikes) as dislikes"))
                    ->where('created_post_replies_id', $request->created_post_replies_id)
                    ->get();
            }
            return $this->successResponse($success, 'Rep dislike successfully');
        }
    }
    public function repfavcountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // already in this user like this post or not check 
            $success = DB::table('forum_post_replie_counts')
                ->select('favorits')
                ->where('id', $request->id)
                ->first();
            $getfavorits = $success->favorits;
            //echo gettype($bodyContent);
            //dd($bodyContent);
            if ($getfavorits <= 0) {
                DB::table('forum_post_replie_counts')
                    ->where('id', $request->id)
                    ->increment('favorits', 1);
                $success = DB::table('forum_post_replie_counts')
                    ->select(DB::raw("SUM(favorits) as favorits"))
                    ->where('created_post_replies_id', $request->created_post_replies_id)
                    ->get();
            }
            return $this->successResponse($success, 'Rep favorits successfully');
        }
    }
    public function repliesinsert(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'create_post_id' => 'required',
            'replies_com' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section = new Forum_post_replies();
            $section->user_id = $request->user_id;
            $section->user_name = $request->user_name;
            $section->created_post_id = $request->create_post_id;
            $section->branch_id = $request->branch_id;
            $section->replies_com = $request->replies_com;
            $query = $section->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                $todayDate = Carbon::now();
                $getval = array($request->user_id, $request->user_name, $request->create_post_id, $request->replies_com);
                return $this->successResponse($getval, 'Command has been successfully saved');
            }
        }
    }
    public function repliesfirstlikescountinsert(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'create_post_id' => 'required',
            'created_post_replies_id' => 'required',
            'likes' => 'required',
            'dislikes' => 'required',
            'favorits' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $section = new Forum_post_replie_counts();
            $section->user_id = $request->user_id;
            $section->user_name = $request->user_name;
            $section->created_post_id = $request->create_post_id;
            $section->created_post_replies_id = $request->created_post_replies_id;
            $section->likes = $request->likes;
            $section->dislikes = $request->dislikes;
            $section->favorits = $request->favorits;
            $section->branch_id = $request->branch_id;
            $query = $section->save();
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                $success = DB::table('forum_post_replie_counts')
                    ->select(DB::raw("SUM(likes) as likes"), DB::raw("SUM(dislikes) as dislikes"), DB::raw("SUM(favorits) as favorits"), 'id')
                    ->where('created_post_replies_id', $request->created_post_replies_id)
                    ->get();
                return $this->successResponse($success, 'View has been successfully hit');
            }
        }
    }
}
