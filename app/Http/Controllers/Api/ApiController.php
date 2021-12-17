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
use App\Models\StaffDepartments;
use App\Models\StaffDesignation;

class ApiController extends BaseController
{
    //
    public function getRoles(Request $request){
        $data = Role::where('status',$request->status)->get();
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
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // $success = Section::all();
            $success = DB::table('sections as sc')
                ->select('sc.*', 'br.name as branch_name', 'br.branch_code', 'br.school_name')
                ->join('branches as br', 'sc.branch_id', '=', 'br.id')
                ->get();
            return $this->successResponse($success, 'Section record fetch successfully');
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
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $student_name = $request->name;
            $branch_code = Helper::CodeGenerator(new Branches, 'branch_code', 4, 'PZ');

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
            $query = $branch->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Branch has been successfully saved');
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

            $query = Branches::find($id)->delete();
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
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('classes as cl')
                ->select('cl.*', 'br.name as branch_name', 'br.branch_code', 'br.school_name')
                ->join('branches as br', 'cl.branch_id', '=', 'br.id')
                ->get();            
                return $this->successResponse($success, 'Class record fetch successfully');
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
            ->select('sa.id', 'sa.class_id', 'sa.section_id','s.name as section_name', 'c.name as class_name', 'c.name_numeric','b.name as branch_name')
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
            'class_name'=>'required',
            'section_name'=>'required',
            'class_teacher'=>'required'
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
                        ->select('ta.id','ta.class_id','ta.section_id','ta.teacher_id','s.name as section_name','c.name as class_name','u.name as teacher_name','b.name as branch_name')
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
            'class_name'=>'required',
            'section_name'=>'required',
            'class_teacher'=>'required'
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
            $response=[];
            $response['class'] = Classes::where('branch_id',$branch_id)->get();
            $response['teacher'] = DB::table('users as us')
                                    ->select('us.id', 'us.user_id', 'us.name')
                                    ->join('staffs as s', 'us.user_id', '=', 's.id')
                                    ->join('branches as b', 's.branch_id', '=', 'b.id')
                                    ->where('s.branch_id',$branch_id)
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
            $branchBasedClass = Classes::where('branch_id',$branch_id)->get();
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
            $branchBasedSection = Section::where('branch_id',$branch_id)->get();
            return $this->successResponse($branchBasedSection, 'Section row fetch successfully');
        }
    }
    // SectionByClass 
    public function SectionByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $class_id = $request->class_id;
            $sectionBasedClass = DB::table('sections_allocations as sa')
                                ->select('s.id','s.name')
                                ->join('sections as s', 'sa.section_id', '=', 's.id')
                                ->where('sa.class_id',$class_id)
                                ->get();
            return $this->successResponse($sectionBasedClass, 'Section row fetch successfully');
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
            ->select("events.*",\DB::raw("GROUP_CONCAT(classes.name) as classname"),'event_types.name as type','users.name as created_by')
            ->leftjoin("classes",\DB::raw("FIND_IN_SET(classes.id,events.selected_list)"),">",\DB::raw("'0'"))
            ->leftjoin('event_types','event_types.id','=','events.type')
            ->leftjoin('users','users.id','=','events.created_by')
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
            ->select("events.*",\DB::raw("GROUP_CONCAT(classes.name) as classname"),'event_types.name as type','users.name as created_by')
            ->leftjoin("classes",\DB::raw("FIND_IN_SET(classes.id,events.selected_list)"),">",\DB::raw("'0'"))
            ->leftjoin('event_types','event_types.id','=','events.type')
            ->leftjoin('users','users.id','=','events.created_by')
            ->groupBy("events.id")
            ->where('events.id',$event_id)->first();
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
            $response=[];
            $response['class'] = Classes::where('branch_id',$branch_id)->get();
            $response['section'] = DB::table('sections_allocations as sa')
                                    ->select('sa.id', 'sa.class_id', 'sa.section_id','s.name as section_name', 'c.name as class_name', 'c.name_numeric','b.name as branch_name')
                                    ->join('sections as s', 'sa.section_id', '=', 's.id')
                                    ->join('branches as b', 'sa.branch_id', '=', 'b.id')
                                    ->join('classes as c', 'sa.class_id', '=', 'c.id')
                                    ->where('sa.branch_id',$branch_id)
                                    ->get();
            $response['eventType'] = EventType::where('branch_id',$branch_id)->get();
            return $this->successResponse($response, 'Information fetch successfully');
        }
    }
    // addDepartment
    public function addDepartment(Request $request){

        $branch_id = $request->branch_id;
        $validator = \Validator::make($request->all(), [
            'name' => Rule::unique('staff_departments')->where(function ($query) use ($branch_id) {
                return $query->where('branch_id', $branch_id);
            }),
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $department = new StaffDepartments();
            $department->branch_id = $request->branch_id;
            $department->name = $request->name;
            $query = $department->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Department has been successfully saved');
            }

        }
    }
    // getDepartmentList
    public function getDepartmentList(Request $request)
    {
        $Department = DB::table('staff_departments as s')
            ->select('s.*','b.name as branch_name')
            ->join('branches as b', 's.branch_id', '=', 'b.id')
            ->get();
        return $this->successResponse($Department, 'Department record fetch successfully');
    }
    // get department row details
    public function getDepartmentDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            $deptDetails = StaffDepartments::find($id);
            return $this->successResponse($deptDetails, 'Department row fetch successfully');
        }
    }
    // update department
    public function updateDepartment(Request $request)
    {
        $id = $request->id;

        $branch_id = $request->branch_id;
        $validator = \Validator::make($request->all(), [
            'name' => Rule::unique('staff_departments')->where(function ($query) use ($branch_id,$id) {
                return $query->where('branch_id', $branch_id)->where('id','!=', $id);
            }),
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $department = StaffDepartments::find($id);
            $department->branch_id = $request->branch_id;
            $department->name = $request->name;
            $query = $department->save();
            
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Department Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete Section
    public function deleteDepartment(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = StaffDepartments::find($id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Department have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // addDesignation
    public function addDesignation(Request $request){

        $branch_id = $request->branch_id;
        $validator = \Validator::make($request->all(), [
            'name' => Rule::unique('staff_designations')->where(function ($query) use ($branch_id) {
                return $query->where('branch_id', $branch_id);
            }),
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $designation = new StaffDesignation();
            $designation->branch_id = $request->branch_id;
            $designation->name = $request->name;
            $query = $designation->save();

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Designation has been successfully saved');
            }

        }
    }
    // getDesignationList
    public function getDesignationList(Request $request)
    {
        $Designation = DB::table('staff_designations as s')
            ->select('s.*','b.name as branch_name')
            ->join('branches as b', 's.branch_id', '=', 'b.id')
            ->get();
        return $this->successResponse($Designation, 'Designation record fetch successfully');
    }
    // getDesignationDetails row details
    public function getDesignationDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            $designDetails = StaffDesignation::find($id);
            return $this->successResponse($designDetails, 'Designation row fetch successfully');
        }
    }
    // update updateDesignation
    public function updateDesignation(Request $request)
    {
        $id = $request->id;

        $branch_id = $request->branch_id;
        $validator = \Validator::make($request->all(), [
            'name' => Rule::unique('staff_designations')->where(function ($query) use ($branch_id,$id) {
                return $query->where('branch_id', $branch_id)->where('id','!=', $id);   
            }),
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $designation = StaffDesignation::find($id);
            $designation->branch_id = $request->branch_id;
            $designation->name = $request->name;
            $query = $designation->save();
            
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Designation Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete Designation
    public function deleteDesignation(Request $request)
    {

        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $query = StaffDesignation::find($id)->delete();
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
                $StaffDepartment = StaffDepartments::where('branch_id',$request->branch_id)->get();
                return $this->successResponse($StaffDepartment, 'Department row fetch successfully');
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
                $StaffDesig = StaffDesignation::where('branch_id',$request->branch_id)->get();
                return $this->successResponse($StaffDesig, 'Designation row fetch successfully');
            }
        }
}
