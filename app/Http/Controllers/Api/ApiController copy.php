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
use DateTime;
use DateInterval;
use DatePeriod;
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
use Illuminate\Support\Arr;

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
            'branch_id' => 'required',
            'token' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('sections')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $createConnection->table('sections')->insert([
                    'name' => $request->name,
                    'capacity' => $request->capacity,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'New Section has been successfully saved');
                }
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
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $sectionDetails = $createConnection->table('sections')->where('id', $request->section_id)->get();
            return $this->successResponse($sectionDetails, 'Section row fetch successfully');
        }
    }
    // update section
    public function updateSectionDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $section_id = $request->sid;
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('sections')->where([['name', '=', $request->name], ['id', '!=', $section_id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('sections')->where('id', $section_id)->update([
                    'name' => $request->name,
                    'capacity' => $request->capacity,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Section Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
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
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('sections')->where('id', $section_id)->delete();

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
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('classes')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $createConnection->table('classes')->insert([
                    'name' => $request->name,
                    'name_numeric' => $request->name_numeric,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'New Class has been successfully saved');
                }
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
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $sectionDetails = $createConnection->table('classes')->where('id', $request->class_id)->get();
            return $this->successResponse($sectionDetails, 'Class row fetch successfully');
        }
    }
    // update class
    public function updateClassDetails(Request $request)
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
            $class_id = $request->class_id;
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($staffConn->table('classes')->where([['name', '=', $request->name], ['id', '!=', $class_id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('classes')->where('id', $class_id)->update([
                    'name' => $request->name,
                    'name_numeric' => $request->name_numeric,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Class Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }

    // delete class
    public function deleteClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'class_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $class_id = $request->class_id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('classes')->where('id', $class_id)->delete();

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
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('section_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id]])->count() > 0) {
                return $this->send422Error('Already Allocated Section', ['error' => 'Already Allocated Section']);
            } else {
                // insert data
                $query = $createConnection->table('section_allocations')->insert([
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Section Allocation has been successfully saved');
                }
            }
        }
    }
    // get sections allocation
    public function getSectionAllocationList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $secConn = $this->createNewConnection($request->branch_id);
            // get data
            $sectionAllocation = $secConn->table('section_allocations as sa')
                ->select('sa.id', 'sa.class_id', 'sa.section_id', 's.name as section_name', 'c.name as class_name', 'c.name_numeric')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->get();
            return $this->successResponse($sectionAllocation, 'Section Allocation record fetch successfully');
        }
    }

    // get getSectionAllocationDetails details
    public function getSectionAllocationDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $sectionDetails = $createConnection->table('section_allocations')->where('id', $request->id)->get();
            return $this->successResponse($sectionDetails, 'Section Allocation row fetch successfully');
        }
    }
    // update Section Allocations

    public function updateSectionAllocation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('section_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Already Allocated Section', ['error' => 'Already Allocated Section']);
            } else {
                // update data
                $query = $createConnection->table('section_allocations')->where('id', $id)->update([
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Section Allocation Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete deleteSectionAllocation
    public function deleteSectionAllocation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('section_allocations')->where('id', $id)->delete();

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
            'class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('teacher_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id], ['teacher_id', $request->teacher_id]])->count() > 0) {
                return $this->send422Error('Class Teacher Already Assigned', ['error' => 'Class Teacher Already Assigned']);
            } else {
                $arrayData = array(
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => $request->teacher_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                // insert data
                $query = $createConnection->table('teacher_allocations')->insert($arrayData);
                $success = [];
                // unset($arrayData['teacher_id']);

                // $createConnection->table('subject_assigns')->where($arrayData)->update([
                //     'teacher_id' => $request->teacher_id,
                //     'updated_at' => date("Y-m-d H:i:s")
                // ]);

                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Teacher Allocation has been successfully saved');
                }
            }
        }
    }

    // get TeacherAllocation 
    public function getTeacherAllocationList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $success = $createConnection->table('teacher_allocations as ta')
                ->select('ta.id', 'ta.class_id', 'ta.section_id', 'ta.teacher_id', 's.name as section_name', 'c.name as class_name', 'st.name as teacher_name')
                ->join('sections as s', 'ta.section_id', '=', 's.id')
                ->join('staffs as st', 'ta.teacher_id', '=', 'st.id')
                ->join('classes as c', 'ta.class_id', '=', 'c.id')
                ->get();
            return $this->successResponse($success, 'Teacher Allocation record fetch successfully');
        }
    }
    // get TeacherAllocation row details
    public function getTeacherAllocationDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $sectionDetails = $createConnection->table('teacher_allocations')->where('id', $request->id)->get();
            return $this->successResponse($sectionDetails, 'Teacher Allocation row fetch successfully');

            // $teacher_allocation__id = $request->teacher_allocation__id;
            // $teacherAllocationDetails = TeacherAllocation::find($teacher_allocation__id);
            // return $this->successResponse($teacherAllocationDetails, 'Teacher Allocation row fetch successfully');
        }
    }
    // update TeacherAllocation
    public function updateTeacherAllocation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('teacher_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id], ['teacher_id', $request->teacher_id], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Class Teacher Already Assigned', ['error' => 'Class Teacher Already Assigned']);
            } else {
                $arrayData = array(
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => $request->teacher_id,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                // dd($arrayData);
                // update data
                $query = $createConnection->table('teacher_allocations')->where('id', $id)->update($arrayData);
                // unset($arrayData['teacher_id']);

                // $createConnection->table('subject_assigns')->where($arrayData)->update([
                //     'teacher_id' => $request->teacher_id,
                //     'updated_at' => date("Y-m-d H:i:s")
                // ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Teacher Allocation Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete TeacherAllocation
    public function deleteTeacherAllocation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('teacher_allocations')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Teacher Allocation have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add subjects
    public function addSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('subjects')->where([['name', $request->name]])->count() > 0) {
                return $this->send422Error('Already Allocated Subjects', ['error' => 'Already Allocated Subjects']);
            } else {
                // insert data
                $query = $createConnection->table('subjects')->insert([
                    'name' => $request->name,
                    'subject_code' => $request->subject_code,
                    'subject_type' => $request->subject_type,
                    'subject_author' => $request->subject_author,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Subjects has been successfully saved');
                }
            }
        }
    }
    // get all subjects data
    public function getSubjectsList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $secConn = $this->createNewConnection($request->branch_id);
            // get data
            $subjectDetails = $secConn->table('subjects')->get();
            return $this->successResponse($subjectDetails, 'Subject record fetch successfully');
        }
    }
    // get row subjects
    public function getSubjectsDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $sectionDetails = $createConnection->table('subjects')->where('id', $request->id)->get();
            return $this->successResponse($sectionDetails, 'Subject row fetch successfully');
        }
    }
    // update subjects
    public function updateSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($createConnection->table('subjects')->where([['name', $request->name], ['id', '!=', $request->id]])->count() > 0) {
                return $this->send422Error('Already Allocated Subjects', ['error' => 'Already Allocated Subjects']);
            } else {
                // update data
                $query = $createConnection->table('subjects')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'subject_code' => $request->subject_code,
                    'subject_type' => $request->subject_type,
                    'subject_author' => $request->subject_author,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Subject Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete subjects
    public function deleteSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('subjects')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Subjects have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add class assign
    public function addClassAssign(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);

            $getCount = $createConnection->table('subject_assigns')
                ->where(
                    [
                        ['section_id', $request->section_id],
                        ['class_id', $request->class_id],
                        ['subject_id', $request->subject_id]
                    ]
                )
                ->count();
            if ($getCount > 0) {
                return $this->send422Error('This class and section is already assigned', ['error' => 'This class and section is already assigned']);
            } else {
                $arraySubject = array(
                    'class_id' =>  $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => 0,
                    'created_at' => date("Y-m-d H:i:s")
                );
                // insert data
                $query = $createConnection->table('subject_assigns')->insert($arraySubject);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Class assign has been successfully saved');
                }
            }
        }
    }
    // get class assign
    public function getClassAssignList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $success = $createConnection->table('subject_assigns as sa')
                ->select('sa.id', 'sa.class_id', 'sa.section_id', 'sa.subject_id', 'sa.teacher_id', 's.name as section_name', 'sb.name as subject_name', 'c.name as class_name', 'st.name as teacher_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('staffs as st', 'sa.teacher_id', '=', 'st.id')
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->get();
            return $this->successResponse($success, 'Section Allocation record fetch successfully');
        }
    }
    // get class assign row
    public function getClassAssignDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $classAssign = $createConnection->table('subject_assigns')->where('id', $request->id)->get();
            return $this->successResponse($classAssign, 'Class assign row fetch successfully');
        }
    }
    // update class assign
    public function updateClassAssign(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);

            $getCount = $createConnection->table('subject_assigns')
                ->where(
                    [
                        ['section_id', $request->section_id],
                        ['class_id', $request->class_id],
                        ['subject_id', $request->subject_id],
                        ['id', '!=', $request->id]
                    ]
                )
                ->count();
            if ($getCount > 0) {
                return $this->send422Error('This class and section is already assigned', ['error' => 'This class and section is already assigned']);
            } else {
                $arraySubject = array(
                    'class_id' =>  $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                // update data
                $query = $createConnection->table('subject_assigns')->where('id', $request->id)->update($arraySubject);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Class assign details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete class assign
    public function deleteClassAssign(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('subject_assigns')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Class assign have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add teacher assign
    public function addTeacherSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);

            $getCount = $createConnection->table('subject_assigns')
                ->where(
                    [
                        ['section_id', $request->section_id],
                        ['class_id', $request->class_id],
                        ['subject_id', $request->subject_id],
                        ['teacher_id', $request->teacher_id]
                    ]
                )
                ->count();
            if ($getCount > 0) {
                return $this->send422Error('This teacher is already assigned to this class and section', ['error' => 'This teacher is already assigned to this class and section']);
            } else {
                $arraySubject = array(
                    'class_id' =>  $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                // insert data
                $query = $createConnection->table('subject_assigns')->insert($arraySubject);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Teacher assign has been successfully saved');
                }
            }
        }
    }
    // get assign teacher subject
    public function getTeacherListSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $success = $createConnection->table('subject_assigns as sa')
                ->select('sa.id', 'sa.class_id', 'sa.section_id', 'sa.subject_id', 'sa.teacher_id', 's.name as section_name', 'sb.name as subject_name', 'c.name as class_name', 'st.name as teacher_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('staffs as st', 'sa.teacher_id', '=', 'st.id')
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->get();
            return $this->successResponse($success, 'Teacher record fetch successfully');
        }
    }
    // get assign teacher subject row
    public function getTeacherDetailsSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $classAssign = $createConnection->table('subject_assigns')->where('id', $request->id)->get();
            return $this->successResponse($classAssign, 'Teacher assign row fetch successfully');
        }
    }
    // update assign teacher subject
    public function updateTeacherSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);

            $getCount = $createConnection->table('subject_assigns')
                ->where(
                    [
                        ['section_id', $request->section_id],
                        ['class_id', $request->class_id],
                        ['subject_id', $request->subject_id],
                        // ['teacher_id', $request->teacher_id],
                        ['id', '!=', $request->id]
                    ]
                )
                ->count();
            if ($getCount > 0) {
                return $this->send422Error('This subject is already assigned to this class and section', ['error' => 'This subject is already assigned to this class and section']);
            } else {
                $arraySubject = array(
                    'class_id' =>  $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                // update data
                $query = $createConnection->table('subject_assigns')->where('id', $request->id)->update($arraySubject);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Teacher subject details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete assign teacher subject
    public function deleteTeacherSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // get data
            $query = $createConnection->table('subject_assigns')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Subject Teacher been deleted successfully');
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
            $class = $classConn->table('section_allocations as sa')->select('s.id as section_id', 's.name as section_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->where('sa.class_id', $class_id)
                ->get();
            return $this->successResponse($class, 'Class record fetch successfully');
        }
    }
    public function examByClassSec(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'today' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data           
            $getExamsName = $Connection->table('timetable_exam')
                ->select('timetable_exam.exam_id as id', 'exam.name as name', 'timetable_exam.exam_date', 'timetable_exam.marks')
                ->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->where('exam_date', '<', $request->today)
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->groupBy('exam.name')
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }
    public function totgradeCalcuByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data 
            $byclassDetails = array();          
            $getstudentcount = $Connection->table('enrolls')
                ->select(
                    DB::raw('COUNT(student_id) as "totalStudentCount"')
                )
                ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->get();
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $getteachername = $Connection->table('teacher_allocations')
                ->select(
                    'teacher_id',
                    'class_id',
                    'staffs.name as teachername'
                )

                ->leftJoin('staffs', 'teacher_allocations.teacher_id', '=', 'staffs.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->get();
            $getexamattendance = $Connection->table('student_marks')
                ->select(
                    DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                    DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                    DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                    DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->get();
            $getgradecount = $Connection->table('student_marks')
                ->select(
                    'grade as gname',
                    DB::raw('COUNT(*) as "gradecount"')                 
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('grade')
                ->get();
            $commondetails = [
                "getstudentcount" => $getstudentcount,
                "getteachername" => $getteachername,
                "getmastergrade" => $getmastergrade,
                "getexamattendance"=>$getexamattendance
            ];
            array_push($byclassDetails, $commondetails, $getgradecount);

            return $this->successResponse($byclassDetails, 'byclass Post record fetch successfully');
        }
    }
    public function totgrademaster(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            return $this->successResponse($getmastergrade, 'grade record fetch successfully');
        }
    }

    // subjectByClass 
    public function subjectByClass(Request $request)
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
            $class = $classConn->table('subject_assigns as sa')->select('s.id as subject_id', 's.name as subject_name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                ->where('sa.class_id', $class_id)
                ->groupBy('s.id')
                ->get();
            return $this->successResponse($class, 'Class record fetch successfully');
        }
    }

    // Timetable Subject 
    public function timetableSubject(Request $request)
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
            // return $request;
            // create new connection
            $classConn = $this->createNewConnection($request->branch_id);

            $Timetable = $classConn->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')
                ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->where([
                    ['timetable_class.day', $request->day],
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get()->toArray();
            $output['timetable'] = $Timetable;
            $output['teacher'] = $classConn->table('subject_assigns as sa')->select('s.id', 's.name')
                ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                ->groupBy('sa.teacher_id')
                ->get();
            $output['subject'] = $classConn->table('subject_assigns as sa')->select('s.id', 's.name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                ->get();
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

            // calendor data populate
            $getObjRow = $staffConn->table('semester as s')
                ->select('start_date', 'end_date')
                ->where('id', $request->semester_id)
                ->first();
            $timetable = $request->timetable;
            $oldest = $staffConn->table('timetable_class')->where([['class_id', $request->class_id], ['section_id', $request->section_id], ['semester_id', $request->semester_id], ['session_id', $request->session_id], ['day', $request->day]])->get()->toArray();

            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));


            foreach ($diff as $del) {

                $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
                // delete calendor data
                $staffConn->table('calendors')->where('time_table_id', $del)->delete();
            }

            // return $timetable;

            foreach ($timetable as $table) {


                $session_id = 0;
                $semester_id = 0;

                $break = 1;
                $subject_id = 0;
                $teacher_id = 0;


                if (isset($request['session_id'])) {
                    $session_id = $request['session_id'];
                }
                if (isset($request['semester_id'])) {
                    $semester_id = $request['semester_id'];
                }

                if (isset($table['subject']) && isset($table['teacher'])) {
                    $break = 0;
                    $subject_id = $table['subject'];
                    $teacher_id = $table['teacher'];
                }
                $insertOrUpdateID = 0;
                if (isset($table['id'])) {

                    $query = $staffConn->table('timetable_class')->where('id', $table['id'])->update([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => $break,
                        'subject_id' => $subject_id,
                        'teacher_id' => $teacher_id,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'semester_id' => $semester_id,
                        'session_id' => $session_id,
                        'day' => $request['day'],
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                    $insertOrUpdateID = $table['id'];
                } else {
                    $query = $staffConn->table('timetable_class')->insertGetId([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => $break,
                        'subject_id' => $subject_id,
                        'teacher_id' => $teacher_id,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'semester_id' => $semester_id,
                        'session_id' => $session_id,
                        'day' => $request['day'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                    $insertOrUpdateID = $query;
                }
                // return $break;
                $this->addCalendorTimetable($request, $table, $getObjRow, $insertOrUpdateID);
            }
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'TimeTable has been successfully saved');
            }
        }
    }

    // get Timetable List
    public function getTimetableList(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            // $Timetable = $con->table('timetable_class')->where('class_id',$request->class_id)->where('section_id',$request->section_id)->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')->get()->toArray();
            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')
                ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->where([
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get()->toArray();

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

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')
                ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->where([
                    ['timetable_class.day', $request->day],
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->orderBy('time_start', 'asc')->orderBy('time_end', 'asc')
                ->get()->toArray();

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

                $semester = $con->table('semester')->select('semester.id as semester_id', 'semester.name as semester_name')->where('id', $request->semester_id)->first();
                if ($semester) {
                    $semester = $semester;
                } else {
                    $semester['semester_id'] = 0;
                }
                $output['details']['semester'] = $semester;

                $session = $con->table('session')->select('session.id as session_id', 'session.name as session_name')->where('id', $request->session_id)->first();
                if ($session) {
                    $session = $session;
                } else {
                    $session['session_id'] = 0;
                }
                $output['details']['session'] = $session;

                $output['teacher'] = $con->table('subject_assigns as sa')->select('s.id', 's.name')
                    ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
                    ->where('sa.class_id', $request->class_id)
                    ->where('sa.section_id', $request->section_id)
                    ->groupBy('sa.teacher_id')
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
            // calendor data populate
            $getObjRow = $staffConn->table('semester as s')
                ->select('start_date', 'end_date')
                ->where('id', $request->semester_id)
                ->first();
            $oldest = $staffConn->table('timetable_class')
                ->where([
                    ['timetable_class.day', $request->day],
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->get()->toArray();

            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));

            foreach ($diff as $del) {
                // dd($del);
                $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
                // delete calendor data
                $staffConn->table('calendors')->where('time_table_id', $del)->delete();
            }

            foreach ($timetable as $table) {

                $session_id = 0;
                $semester_id = 0;
                $break;
                $subject_id;
                $teacher_id;
                if (isset($request['session_id'])) {
                    $session_id = $request['session_id'];
                }
                if (isset($request['semester_id'])) {
                    $semester_id = $request['semester_id'];
                }

                if (isset($table['break'])) {
                    $break = 1;
                    $subject_id = 0;
                    $teacher_id = 0;
                } else {
                    $break = 0;
                    $subject_id = $table['subject'];
                    $teacher_id = $table['teacher'];
                }
                $insertOrUpdateID =  $table['id'];
                $query = $staffConn->table('timetable_class')->where('id', $table['id'])->update([
                    'class_id' => $request['class_id'],
                    'section_id' => $request['section_id'],
                    'break' => $break,
                    'subject_id' => $subject_id,
                    'teacher_id' => $teacher_id,
                    'class_room' => $table['class_room'],
                    'time_start' => $table['time_start'],
                    'time_end' => $table['time_end'],
                    'semester_id' => $semester_id,
                    'session_id' => $session_id,
                    'day' => $request['day'],
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                // update calendor
                $this->addCalendorTimetable($request, $table, $getObjRow, $insertOrUpdateID);
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
            $student = $con->table('students')->join('enrolls', 'students.id', '=', 'students.id')->where('students.id', $request->student_id)->first();

            $today = date("Y-m-d");
            $semester = $con->table('semester')->where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

            if (isset($sem)) {
                $semester_id = $semester->id;
            } else {
                $semester_id = 0;
            }

            //    dd($semester_id);

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')
                ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->where('timetable_class.class_id', $student->class_id)
                ->where('timetable_class.section_id', $student->section_id)
                ->where('timetable_class.session_id', $student->session_id)
                ->where('timetable_class.semester_id', $semester_id)
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get()->toArray();


            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;


                $output['max'] = $max;
                $output['details']['class'] = $con->table('classes')->select('classes.id as class_id', 'classes.name as class_name')->where('id', $student->class_id)->first();
                $output['details']['section'] = $con->table('sections')->select('sections.id as section_id', 'sections.name as section_name')->where('id', $student->section_id)->first();
                // return $output;
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
            'parent_id' => 'required',
            'children_id' => 'required'
        ]);

        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $student = $con->table('students')->join('enrolls', 'students.id', '=', 'students.id')->where('enrolls.student_id', $request->children_id)->first();

            $today = date("Y-m-d");
            $semester = $con->table('semester')->where('start_date', '<=', $today)->where('end_date', '>=', $today)->first();

            if (isset($sem)) {
                $semester_id = $semester->id;
            } else {
                $semester_id = 0;
            }

            $Timetable = $con->table('timetable_class')->select('timetable_class.*', 'staffs.name as teacher_name', 'subjects.name as subject_name')
                ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->where('timetable_class.class_id', $student->class_id)
                ->where('timetable_class.section_id', $student->section_id)
                ->where('timetable_class.session_id', $student->session_id)
                ->where('timetable_class.semester_id', $semester_id)
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get()->toArray();

            // return $Timetable;
            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                $output['details']['class'] = $con->table('classes')->select('classes.id as class_id', 'classes.name as class_name')->where('id', $student->class_id)->first();
                $output['details']['section'] = $con->table('sections')->select('sections.id as section_id', 'sections.name as section_name')->where('id', $student->section_id)->first();

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
    // forum Create Post 
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
            'imagesorvideos' => 'required',
            'threads_status' => 'required'
        ]);
        //dd($request);
        if (!$validator->passes()) {
            return $this->send422Error('Validation errors.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $class = new Forum_posts();
            $getCount = Forum_posts::where('topic_title', '=', $request->topic_title)->get();
            //dd($getCount);
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
                $class->threads_status = $request->threads_status;
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
    // forum all post branch id wise
    public function postList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // $success = DB::table('forum_posts')
            //     ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
            //     // ->leftJoin('forum_count_details', function ($join) {
            //     //     $join->on('forum_posts.id', '=', 'forum_count_details.created_post_id');
            //     // })
            //     ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
            //     ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.category_names', DB::raw("SUM(forum_count_details.likes) as likes"), DB::raw("SUM(forum_count_details.dislikes)as dislikes"), DB::raw("SUM(forum_count_details.favorite)as favorite"), DB::raw("SUM(forum_count_details.replies)as replies"), DB::raw("SUM(forum_count_details.views)as views"), 'forum_count_details.activity', 'forum_posts.created_at', 'forum_posts.topic_header')
            //     ->where('forum_posts.branch_id', '=', $request->branch_id)
            //     //        ->groupBy('forum_count_details.created_post_id')
            //     ->get();

            $success = DB::table("forum_posts")

                ->select(
                    'forum_posts.id as id',
                    'forum_posts.topic_title',
                    'forum_posts.user_id as user_id',
                    'forum_posts.user_name',
                    'forum_categorys.category_names',
                    'forum_posts.topic_header',
                    'forum_posts.created_at',
                    'forum_posts.category',
                    'forum_count_details.likes',
                    'forum_count_details.dislikes',
                    'forum_count_details.views',
                    'forum_count_details.replies',
                    'forum_count_details.favorite',
                    'favorite',
                    'activity'
                )

                ->leftjoin(
                    DB::raw("(SELECT user_id,user_name,created_post_id,SUM(likes) as likes,SUM(dislikes) as dislikes,SUM(views) as views,SUM(replies) as replies ,SUM(favorite) as favorite,activity FROM forum_count_details GROUP BY created_post_id) as forum_count_details"),
                    function ($join) {
                        $join->on("forum_count_details.created_post_id", "=", "forum_posts.id");
                    }
                )
                ->leftjoin(
                    DB::raw("(SELECT id as category_id,category_names from forum_categorys) as forum_categorys"),
                    function ($join) {

                        $join->on("forum_categorys.category_id", "=", "forum_posts.category");
                    }
                )
                ->where('forum_posts.branch_id', '=', $request->branch_id)
                ->where('forum_posts.threads_status', '=', 2)
                ->whereRaw("find_in_set($request->user_id,forum_posts.tags)")
                ->get();


            // $subjectdata = DB::table('forum_posts')->select()   

            ////////////////////////////////////////////////
            // ->leftJoin('forum_count_details', function ($join) {
            //     $join->on('forum_count_details.created_post_id', '=', 'forum_posts.id')
            //         ->orWhere('forum_posts.user_id', '`c.user_id`');


            //     $branchid=$request->branch_id;
            //     $success = DB::query()->fromSub(function ($query) use ($branchid) {
            //         $query->from('forum_posts')
            //             ->select('id as created_post_id','topic_header,created_at','category')
            //             ->where('forum_posts.branch_id','=',DB::raw("'$branchid'"))                              
            //             ->leftJoin('forum_count_details','forum_posts.id','=','forum_count_details.created_post_replies_id')
            //             ->select('created_post_id',DB::raw("SUM(forum_count_details.likes) as likes"),DB::raw("SUM(forum_count_details.dislikes) as dislikes"),DB::raw("SUM(forum_count_details.views) as views"),DB::raw("SUM(forum_count_details.replies) as replies"),DB::raw("SUM(forum_count_details.favorite) as favorite"),'activity')
            //             ->Groupby('created_post_id') 
            //             ->leftJoin('forum_categorys','forum_posts.category','=','forum_categorys.category_id');
            //     },'aa')
            //     ->select('*');
            //    dd($success);

            return $this->successResponse($success, 'Post record fetch successfully');
        }
    }
    // forum all Threads post branch id wise
    public function ThreadspostList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $success = DB::table("forum_posts")
                ->select(
                    'forum_posts.id as id',
                    'forum_posts.topic_title',
                    'forum_posts.user_id as user_id',
                    'forum_posts.user_name',
                    'forum_categorys.category_names',
                    'forum_posts.topic_header',
                    'forum_posts.created_at',
                    'forum_posts.category',
                    'forum_count_details.likes',
                    'forum_count_details.dislikes',
                    'forum_count_details.views',
                    'forum_count_details.replies',
                    'forum_count_details.favorite',
                    'favorite',
                    'activity'
                )

                ->leftjoin(
                    DB::raw("(SELECT user_id,user_name,created_post_id,SUM(likes) as likes,SUM(dislikes) as dislikes,SUM(views) as views,SUM(replies) as replies ,SUM(favorite) as favorite,activity FROM forum_count_details GROUP BY created_post_id) as forum_count_details"),
                    function ($join) {
                        $join->on("forum_count_details.created_post_id", "=", "forum_posts.id");
                    }
                )
                ->leftjoin(
                    DB::raw("(SELECT id as category_id,category_names from forum_categorys) as forum_categorys"),
                    function ($join) {

                        $join->on("forum_categorys.category_id", "=", "forum_posts.category");
                    }
                )
                ->where('forum_posts.branch_id', '=', $request->branch_id)
                ->where('forum_posts.threads_status', '=', 1)
                ->get();
            return $this->successResponse($success, 'Threads Post record fetch successfully');
        }
    }
    public function userThreadspostList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $success = DB::table("forum_posts")
                ->select(
                    'forum_posts.id as id',
                    'forum_posts.topic_title',
                    'forum_posts.user_id as user_id',
                    'forum_posts.user_name',
                    'forum_categorys.category_names',
                    'forum_posts.topic_header',
                    'forum_posts.created_at',
                    'forum_posts.category',
                    'forum_count_details.likes',
                    'forum_count_details.dislikes',
                    'forum_count_details.views',
                    'forum_count_details.replies',
                    'forum_count_details.favorite',
                    'favorite',
                    'activity',
                    'forum_posts.threads_status'
                )

                ->leftjoin(
                    DB::raw("(SELECT user_id,user_name,created_post_id,SUM(likes) as likes,SUM(dislikes) as dislikes,SUM(views) as views,SUM(replies) as replies ,SUM(favorite) as favorite,activity FROM forum_count_details GROUP BY created_post_id) as forum_count_details"),
                    function ($join) {
                        $join->on("forum_count_details.created_post_id", "=", "forum_posts.id");
                    }
                )
                ->leftjoin(
                    DB::raw("(SELECT id as category_id,category_names from forum_categorys) as forum_categorys"),
                    function ($join) {

                        $join->on("forum_categorys.category_id", "=", "forum_posts.category");
                    }
                )
                ->where('forum_posts.branch_id', '=', $request->branch_id)
                ->where('forum_posts.user_id', '=', $request->user_id)
                ->get();
            return $this->successResponse($success, 'Threads Post record fetch successfully');
        }
    }

    // forum single post branch id and user id wise
    public function singlePost(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.category as category', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name', DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), DB::raw("SUM(forum_count_details.likes) as likes"), DB::raw("SUM(forum_count_details.dislikes) as dislikes"), DB::raw("SUM(forum_count_details.favorite) as favorite"), DB::raw("SUM(forum_count_details.replies) as replies"), DB::raw("SUM(forum_count_details.views) as views"), 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id', 'forum_categorys.category_names', 'forum_posts.created_at')
                ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
                ->join('forum_categorys', 'forum_posts.category', '=', 'forum_categorys.id')
                ->where('forum_posts.branch_id', '=', $request->branch_id)
                ->where('forum_posts.id', '=', $request->id)
                ->groupBy('forum_count_details.created_post_id')
                ->get();



            // DB::table('forum_posts')
            // ->select('forum_posts.id', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name',  DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), 'forum_posts.category as category', 'forum_categorys.category_names as category_names')
            // ->leftJoin('forum_categorys','forum_posts.category','=','forum_categorys.id')
            // ->where('forum_posts.id','=',$request->id)
            // ->where('forum_posts.branch_id','=',$request->branch_id)
            // ->get();
            //     //like counts
            // $success['likescount'] =DB::table('forum_count_details')
            // ->select('forum_count_details.user_id',DB::raw("SUM('forum_count_details.likes') as likes"), DB::raw("SUM('forum_count_details.dislikes') as dislikes"), DB::raw("SUM('forum_count_details.favorite') as favorite"), DB::raw("SUM('forum_count_details.replies') as replies"), DB::raw("SUM('forum_count_details.views') as views"), 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id')
            // ->where('forum_count_details.branch_id','=',$request->branch_id)
            // ->where('forum_count_details.created_post_id','=',$request->id)
            // ->groupBy('created_post_id')
            // ->get();            

            // DB::table('forum_posts')
            //     ->select('forum_posts.id', 'forum_posts.category as category', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name', DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), 'forum_count_details.likes as likes', 'forum_count_details.dislikes as dislikes', 'forum_count_details.favorite as favorite', 'forum_count_details.replies as replies', 'forum_count_details.views as views', 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id', 'forum_categorys.category_names', 'forum_posts.created_at')
            //     ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
            //     ->leftJoin('forum_count_details', 'forum_posts.user_id', '=', 'forum_count_details.user_id')
            //     ->leftJoin('forum_categorys', 'forum_posts.category', '=', 'forum_categorys.id')
            //     ->where([
            //         ['forum_posts.branch_id', '=', $request->branch_id],
            //         ['forum_posts.id', '=', $request->id],
            //         ['forum_posts.user_id', '=', $request->user_id]
            //     ])
            //     ->get();
            return  $this->successResponse($success, 'Single Post list fetch successfully');
        }
    }
    // forum post replies branch id and post id wise 
    public function singlePostReplies(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'user_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branchid = $request->branch_id;
            $id = $request->id;
            $success = DB::query()->fromSub(function ($query) use ($branchid, $id) {
                $query->from('forum_post_replies')
                    ->select('forum_post_replies.id as pk_replies_id', 'forum_post_replies.created_at', 'forum_post_replies.created_post_id as created_post_id', 'forum_post_replies.branch_id as branch_id', 'forum_post_replies.user_id as user_id', 'forum_post_replies.user_name as user_name', 'replies_com', 'forum_post_replie_counts.id as pk_replies_count_id', 'forum_post_replie_counts.likes as likes', 'forum_post_replie_counts.dislikes as dislikes', 'forum_post_replie_counts.favorits as favorits', DB::raw('DATE_FORMAT(forum_post_replies.created_at, "%b %e %Y") as date'))
                    ->leftJoin('forum_post_replie_counts', 'forum_post_replies.id', '=', 'forum_post_replie_counts.created_post_replies_id')
                    ->where('forum_post_replies.branch_id', '=', DB::raw("'$branchid'"))
                    ->where('forum_post_replies.created_post_id', '=', DB::raw("'$id'"));
            }, 'aa')
                ->select('*')
                ->where('aa.created_post_id', '=', $request->id)
                ->get();



            // DB::table('forum_post_replies')
            //     ->select('forum_post_replies.id as pk_replies_id', 'forum_post_replies.created_at', 'forum_post_replies.created_post_id as created_post_id', 'forum_post_replies.branch_id as branch_id', 'forum_post_replies.user_id as user_id', 'forum_post_replies.user_name as user_name', 'replies_com', 'forum_post_replie_counts.id as pk_replies_count_id', 'forum_post_replie_counts.likes as likes', 'forum_post_replie_counts.dislikes as dislikes', 'forum_post_replie_counts.favorits as favorits', DB::raw('DATE_FORMAT(forum_post_replies.created_at, "%b %e %Y") as date'))
            //     ->leftJoin('forum_post_replie_counts', 'forum_post_replies.id', '=', 'forum_post_replie_counts.created_post_replies_id')
            //     //->where('forum_post_replies.created_post_id', '=', $request->id)
            //     ->where([
            //         ['forum_post_replies.branch_id', '=', $request->branch_id],
            //         ['forum_post_replies.created_post_id', '=', $request->id]
            //     ])
            //     ->groupBy('forum_post_replie_counts.created_post_id')
            //     ->get();
            return  $this->successResponse($success, 'Single Post replies fetch successfully');
        }
    }
    // forum post all replies branch id and post id wise 
    public function PostAllReplies(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'user_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branchid = $request->branch_id;
            $user_id = $request->user_id;
            $success = DB::query()->fromSub(function ($query) use ($branchid, $user_id) {
                $query->from('forum_posts')
                    ->select('forum_post_replies.id as post_replies_id', 'forum_posts.topic_title', 'forum_posts.branch_id', 'forum_post_replies.created_post_id', 'forum_post_replies.user_id', 'forum_post_replies.user_name', 'forum_post_replies.replies_com', 'forum_categorys.category_names', 'forum_post_replies.created_at')
                    ->leftJoin('forum_post_replies', 'forum_posts.id', '=', 'forum_post_replies.created_post_id')
                    ->leftJoin('forum_categorys', 'forum_posts.category', '=', 'forum_categorys.id');
            }, 'aa')
                ->select('*')
                ->where('user_id', '=', DB::raw("'$user_id'"))
                ->where('branch_id', '=', DB::raw("'$branchid'"))
                ->get();

            return  $this->successResponse($success, 'Post all replies fetch successfully');
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
    // forum view count insert 
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
            $section->flag = 1;
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
    // forum view count add
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
    // forum like count add
    public function likescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'created_post_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
            'likes' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            //   dd($request);
            $likesinsert = [
                "created_post_id" => $request->created_post_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "likes" =>  $request->likes,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];

            $checkExist = DB::table('forum_count_details')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['user_id', '=', $request->user_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "update";         
                DB::table('forum_count_details')->insert($likesinsert);
            } else {
                $checkdislikecount = $checkExist->likes;

                if ($checkdislikecount <= 0) {
                    // update data
                    $query = DB::table('forum_count_details')
                        ->where('id', $checkExist->id)
                        ->update([
                            'likes' => $request->likes,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_count_details')
                ->select(DB::raw("SUM(likes) as likes"))
                ->where('created_post_id', $request->created_post_id)
                ->get();
            return $this->successResponse($success, 'like successfully');
        }
    }
    // forum dislike count add
    public function dislikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $dislikesinsert = [
                "created_post_id" => $request->created_post_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "dislikes" =>  $request->dislikes,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = DB::table('forum_count_details')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['user_id', '=', $request->user_id],
                ['branch_id', '=', $request->branch_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "insert"; 
                DB::table('forum_count_details')->insert($dislikesinsert);
            } else {
                $checkdislikecount = $checkExist->dislikes;
                if ($checkdislikecount <= 0) {
                    // update data
                    $query = DB::table('forum_count_details')
                        ->where('id', $checkExist->id)
                        ->update([
                            'dislikes' => $request->dislikes,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_count_details')
                ->select(DB::raw("SUM(dislikes) as dislikes"))
                ->where('created_post_id', $request->created_post_id)
                ->get();
            return $this->successResponse($success, 'Rep Dislike successfully');
        }
    }
    // forum heart count add
    public function heartcountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'created_post_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'favorite' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $favoritsinsert = [
                "created_post_id" => $request->created_post_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "favorite" =>  $request->favorite,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = DB::table('forum_count_details')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['user_id', '=', $request->user_id],
                ['branch_id', '=', $request->branch_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "insert";             
                DB::table('forum_count_details')->insert($favoritsinsert);
            } else {
                $checkfavoritscount = $checkExist->favorite;
                if ($checkfavoritscount <= 0) {
                    // update data
                    $query = DB::table('forum_count_details')
                        ->where('id', $checkExist->id)
                        ->update([
                            'favorite' => $request->favorite,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_count_details')
                ->select(DB::raw("SUM(favorite) as favorite"))
                ->where('created_post_id', $request->created_post_id)
                ->get();
            return $this->successResponse($success, 'Rep Favorits successfully');
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
                    'subject_id' => $subject_id,
                    'created_at' => date("Y-m-d H:i:s")

                );
                $returnData = array(
                    'att_status' => $attStatus,
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name']
                );
                array_push($data, $returnData);
                if ((empty($value['attendance_id']) || $value['attendance_id'] == "null")) {
                    if ($Connection->table('student_attendances')->where([
                        ['date', '=', $date],
                        ['class_id', '=', $class_id],
                        ['section_id', '=', $section_id],
                        ['subject_id', '=', $subject_id],
                        ['student_id', '=', $value['student_id']],

                    ])->count() > 0) {
                        $Connection->table('student_attendances')->where('id', $value['attendance_id'])->update([
                            'status' => $attStatus,
                            'remarks' => $att_remark,
                            'reasons' => $reasons,
                            'student_behaviour' => $student_behaviour,
                            'classroom_behaviour' => $classroom_behaviour,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    } else {
                        $Connection->table('student_attendances')->insert($arrayAttendance);
                    }
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
            'section_id' => 'required',
            'date' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $date = $request->date;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);
            // $getTeachersClassName = $Connection->table('enrolls as en')
            //     ->select(
            //         'en.student_id',
            //         'en.roll',
            //         'st.first_name',
            //         'st.last_name'
            //     )
            //     ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
            //     ->where([
            //         ['en.class_id', '=', $request->class_id],
            //         ['en.section_id', '=', $request->section_id]
            //     ])
            //     ->get();
            $getShortTest = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    'st.first_name',
                    'st.last_name',
                    'st.register_no',
                    'sht.id as short_test_id',
                    'sht.test_marks',
                    'sht.grade_status',
                    'sht.date',
                    'sht.test_name'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('short_tests as sht', function ($q) use ($date, $subject_id) {
                    $q->on('sht.student_id', '=', 'st.id')
                        ->on('sht.date', '=', DB::raw("'$date'")) //second join condition                           
                        ->on('sht.subject_id', '=', DB::raw("'$subject_id'")); //need to add subject id also later                           
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                // ->groupBy('en.student_id')
                ->get();
            return $this->successResponse($getShortTest, 'Short test record fetch successfully');
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
                // $test_name = (count($value['test_name'][0]) > 0) ? implode(",", $value['test_name'][0]) : "";
                // $grade_status = (count($value['grade_status'][0]) > 0) ? implode(",", $value['grade_status'][0]) : "";
                // $test_marks = (count($value['test_marks'][0]) > 0) ? implode(",", $value['test_marks'][0]) : "";
                $newTestName = $value['test_name'];
                $newgradeStatus = $value['grade_status'];
                $newtestMarks = $value['test_marks'];
                $test_name = (count($value['test_name']) > 0) ? implode(",", $value['test_name']) : "";
                $grade_status = (count($value['grade_status']) > 0) ? implode(",", $value['grade_status']) : "";
                $test_marks = (count($value['test_marks']) > 0) ? implode(",", $value['test_marks']) : "";
                // dd($value['attendance_id']);
                // $grade_status = (isset($value['grade_status']) ? $value['grade_status'] : "");
                // $test_marks = (isset($value['test_marks']) ? $value['test_marks'] : "");
                // foreach($test_name as $key => $value) {
                //     print_r($value);
                // }
                $addShortTest = array(
                    'student_id' => $value['student_id'],
                    'test_name' => $test_name,
                    'grade_status' => $grade_status,
                    'test_marks' => $test_marks,
                    'date' => $date,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                // echo $key;
                // echo gettype($test_name);
                // print_r($addShortTest);
                $checkExist = $Connection->table('short_tests')->where([
                    // ['test_name', '=', $value['test_name']],
                    ['date', '=', $date],
                    ['student_id', '=', $value['student_id']]
                ])->first();
                // $checkExist = $Connection->table('short_tests')->where([['test_name', '=', $value['test_name']], ['date', '=', $date], ['student_id', '=', $value['student_id']]])->first();

                // if ($Connection->table('short_tests')->where([['test_name', '=', $value['test_name']], ['date', '=', $date], ['student_id', '=', $value['student_id']]])->count() > 0) {
                if ($Connection->table('short_tests')->where([['date', '=', $date], ['student_id', '=', $value['student_id']]])->count() > 0) {
                    // print_r($checkExist->test_name);
                    // print_r($test_name);
                    $dbTestname = explode(",", $checkExist->test_name);
                    $dbTestMarks = explode(",", $checkExist->test_marks);
                    $dbGradeStatus = explode(",", $checkExist->grade_status);

                    // $dbTestMarks = explode(",", $checkExist->test_marks);
                    $testNames = array();
                    $gradeStatus = array();
                    $testMarks = array();

                    if (isset($newTestName)) {
                        foreach ($newTestName as $key => $val) {
                            if (in_array($val, $dbTestname)) {
                                // Match found
                                array_push($testNames, $val);
                                array_push($gradeStatus, $newgradeStatus[$key]);
                                array_push($testMarks, $newtestMarks[$key]);
                            } else {
                                // Match not found
                                array_push($testNames, $newTestName[$key]);
                                array_push($gradeStatus, $newgradeStatus[$key]);
                                array_push($testMarks, $newtestMarks[$key]);
                            }
                        }
                    }

                    $dbTestMarks = explode(",", $checkExist->test_marks);
                    $dbGradeStatus = explode(",", $checkExist->grade_status);
                    // print_r($gradeStatus);
                    // print_r($testMarks);
                    $result = array_diff_assoc($dbTestname, $testNames);
                    if (isset($result)) {
                        foreach ($result as $key => $val) {
                            array_push($testNames, $val);
                            array_push($gradeStatus, $dbGradeStatus[$key]);
                            array_push($testMarks, $dbTestMarks[$key]);
                        }
                    }
                    // print_r($testNames);
                    // print_r($gradeStatus);
                    // print_r($testMarks);

                    // array_push($testNames, $result);

                    // print_r($testNames);
                    // $result=array_diff($testNames,$dbTestname);
                    // print_r($result);
                    // $currentTestname = explode(",", $test_name);
                    // $result = array_diff($dbTestname, $currentTestname);
                    // print_r($value['test_name']);
                    // echo "<br>";
                    // print_r($currentTestname);
                    // echo "<br>";
                    // print_r($result);

                    // exit;
                    $Connection->table('short_tests')->where('id', $checkExist->id)->update([
                        'test_name' => implode(",", $testNames),
                        'grade_status' => implode(",", $gradeStatus),
                        'test_marks' => implode(",", $testMarks),
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
            $data = [
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'report' => $request->daily_report,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = $Connection->table('daily_reports')->where([
                ['date', '=', $request->date],
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id]
            ])->first();
            // dd($checkExist);
            if ($Connection->table('daily_reports')->where([
                ['date', '=', $request->date],
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id],

            ])->count() > 0) {
                $Connection->table('daily_reports')->where('id', $checkExist->id)->update([
                    'report' => $request->daily_report,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            } else {
                $Connection->table('daily_reports')->insert($data);
            }
            return $this->successResponse([], 'Daily report added successfully');
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
            'subject_id' => 'required',
            'date' => 'required'
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
            $getDailyReport = $Connection->table('daily_reports as dr')
                ->select(
                    'dr.date',
                    'dr.class_id',
                    'dr.section_id',
                    'dr.report',
                    'dr.subject_id',
                    'dr.id'
                )
                ->where([
                    ['dr.class_id', '=', $request->class_id],
                    ['dr.section_id', '=', $request->section_id],
                    ['dr.subject_id', '=', $request->subject_id],
                    ['dr.date', '=', $request->date]
                ])
                ->first();
            $data = [
                'get_daily_report_remarks' => $getDailyReportRemarks,
                'get_daily_report' => $getDailyReport
            ];
            return $this->successResponse($data, 'Daily report remarks fetch successfully');
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
    // addDailyReportByStudent
    function addDailyReportByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'student_remarks' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $arrayInsert = [
                "student_id" => $request->student_id,
                'student_remarks' => $request->student_remarks,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' =>  $request->subject_id,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $daily_report_remarks = $Connection->table('daily_report_remarks')->where([
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id]
            ])->first();
            if (isset($daily_report_remarks->id)) {
                $Connection->table('daily_report_remarks')->where('id', $daily_report_remarks->id)->update([
                    "student_id" => $request->student_id,
                    'student_remarks' => $request->student_remarks,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' =>  $request->subject_id,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            } else {
                $Connection->table('daily_report_remarks')->insert($arrayInsert);
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
            $query_date = $request->date;
            // First day of the month.
            $startDate = date('Y-m-01', strtotime($query_date));
            // Last day of the month.
            $endDate = date('Y-m-t', strtotime($query_date));
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getWidgetDetails = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "excused" then 1 ELSE NULL END) as "excusedCount"'),
                )
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    ['sa.date', '=', $request->date],
                ])
                ->get();

            $avgAttendance = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "excused" then 1 ELSE NULL END) as "excusedCount"'),
                    DB::raw('COUNT(DISTINCT sa.date) as "totalDate"')
                )
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                ])
                ->whereBetween(DB::raw('date(date)'), [$startDate, $endDate])
                ->get();

            $getStudentData = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "excused" then 1 ELSE NULL END) as "excusedCount"'),
                    DB::raw('COUNT(sa.date) as "totalDaysCount"')
                )
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    // ['sa.date', '=', $request->date],
                ])
                ->whereBetween(DB::raw('date(date)'), [$startDate, $endDate])
                ->groupBy('sa.student_id')
                ->get();

            $totalStudent = $Connection->table('enrolls as en')
                ->select(
                    DB::raw('COUNT(en.student_id) as "totalStudentCount"')
                )
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->get();

            $day = date('D', strtotime($query_date));

            $timetable_class = $Connection->table('timetable_class as tc')
                ->select(
                    'tc.time_start',
                    'tc.time_end',
                    'tc.id'
                )
                ->where([
                    ['tc.class_id', '=', $request->class_id],
                    ['tc.section_id', '=', $request->section_id],
                    ['tc.subject_id', '=', $request->subject_id],
                ])
                ->where('tc.day', 'like', '%' . $day . '%')
                ->first();
            $data = [
                'avg_attendance' => $avgAttendance,
                'get_widget_details' => $getWidgetDetails,
                'get_student_data' => $getStudentData,
                'total_student' => $totalStudent,
                'timetable_class' => $timetable_class

            ];
            return $this->successResponse($data, 'Wigget record fetch successfully');
        }
    }
    // forum replies likes count add
    public function replikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            //
            $likesinsert = [
                "created_post_id" => $request->created_post_id,
                "created_post_replies_id" => $request->created_post_replies_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "likes" =>  $request->likes,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = DB::table('forum_post_replie_counts')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['created_post_replies_id', '=', $request->created_post_replies_id],
                ['user_id', '=', $request->user_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "update";         
                DB::table('forum_post_replie_counts')->insert($likesinsert);
            } else {
                $checkdislikecount = $checkExist->likes;

                if ($checkdislikecount <= 0) {
                    // update data
                    $query = DB::table('forum_post_replie_counts')
                        ->where('id', $checkExist->id)
                        ->update([
                            'likes' => $request->likes,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_post_replie_counts')
                ->select(DB::raw("SUM(likes) as likes"))
                ->where('created_post_replies_id', $request->created_post_replies_id)
                ->get();
            return $this->successResponse($success, 'Replike successfully');
        }
    }
    // forum replies dislikes count add
    public function repdislikescountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            //
            $dislikesinsert = [
                "created_post_id" => $request->created_post_id,
                "created_post_replies_id" => $request->created_post_replies_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "dislikes" =>  $request->dislikes,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = DB::table('forum_post_replie_counts')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['created_post_replies_id', '=', $request->created_post_replies_id],
                ['user_id', '=', $request->user_id],
                ['branch_id', '=', $request->branch_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "insert"; 
                DB::table('forum_post_replie_counts')->insert($dislikesinsert);
            } else {
                $checkdislikecount = $checkExist->dislikes;
                if ($checkdislikecount <= 0) {
                    // update data
                    $query = DB::table('forum_post_replie_counts')
                        ->where('id', $checkExist->id)
                        ->update([
                            'dislikes' => $request->dislikes,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_post_replie_counts')
                ->select(DB::raw("SUM(dislikes) as dislikes"))
                ->where('created_post_replies_id', $request->created_post_replies_id)
                ->get();
            return $this->successResponse($success, 'Rep Dislike successfully');
        }
    }
    // forum heart count add
    public function repfavcountadded(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'created_post_id' => 'required',
            'created_post_replies_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'favorits' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            //
            $favoritsinsert = [
                "created_post_id" => $request->created_post_id,
                "created_post_replies_id" => $request->created_post_replies_id,
                "user_id" => $request->user_id,
                "user_name" => $request->user_name,
                "branch_id" => $request->branch_id,
                "favorits" =>  $request->favorits,
                "flag" => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = DB::table('forum_post_replie_counts')->where([
                ['created_post_id', '=', $request->created_post_id],
                ['created_post_replies_id', '=', $request->created_post_replies_id],
                ['user_id', '=', $request->user_id],
                ['branch_id', '=', $request->branch_id],
                ['flag', '>', 0]
            ])->first();

            if (empty($checkExist)) {
                // echo "insert";             
                DB::table('forum_post_replie_counts')->insert($favoritsinsert);
            } else {
                $checkfavoritscount = $checkExist->favorits;
                if ($checkfavoritscount <= 0) {
                    // update data
                    $query = DB::table('forum_post_replie_counts')
                        ->where('id', $checkExist->id)
                        ->update([
                            'favorits' => $request->favorits,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $success = DB::table('forum_post_replie_counts')
                ->select(DB::raw("SUM(favorits) as favorits"))
                ->where('created_post_replies_id', $request->created_post_replies_id)
                ->get();
            return $this->successResponse($success, 'Rep Disfav successfully');
        }
    }
    // forum replies insert
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

            $Creted_post_replies_id = DB::table('forum_post_replies')->insertGetId([
                'user_id' => $request->user_id,
                'user_name' => $request->user_name,
                'created_post_id' => $request->create_post_id,
                'branch_id' => $request->branch_id,
                'replies_com' => $request->replies_com,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            if (!$Creted_post_replies_id) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                //
                $checkExist = DB::table('forum_count_details')->where([
                    ['created_post_id', '=', $request->create_post_id]
                ])->first();
                DB::table('forum_count_details')
                    ->where('id', $checkExist->id)
                    ->increment('replies', 1);
                //
                $getval = array($request->user_id, $request->user_name, $request->create_post_id, $request->replies_com, $Creted_post_replies_id);
                return $this->successResponse($getval, 'Command has been successfully saved');
            }
        }
    }
    // forum post list category wise
    public function postListCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required'
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
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.id as categId', 'forum_categorys.category_names', 'forum_count_details.likes', 'forum_count_details.dislikes', 'forum_count_details.favorite', 'forum_count_details.replies', 'forum_count_details.views', 'forum_count_details.activity', 'forum_posts.created_at', 'forum_posts.topic_header')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    ['forum_posts.threads_status', '=', 2]
                ])
                ->whereRaw("find_in_set($request->user_id,forum_posts.tags)")
                ->groupBy('forum_posts.category')
                ->get();

            return $this->successResponse($success, 'Post List fetch successfully');
        }
    }
    public function adminpostListCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required'
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
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.id as categId', 'forum_categorys.category_names', 'forum_count_details.likes', 'forum_count_details.dislikes', 'forum_count_details.favorite', 'forum_count_details.replies', 'forum_count_details.views', 'forum_count_details.activity', 'forum_posts.created_at', 'forum_posts.topic_header')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    ['forum_posts.threads_status', '=', 2]
                ])
                ->groupBy('forum_posts.category')
                ->get();

            return $this->successResponse($success, 'Admin Post categ List fetch successfully');
        }
    }
    // forum single category posts
    public function singleCategoryPosts(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'categId' => 'required',
            'user_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')
                ->select('forum_posts.id', 'forum_posts.category as category', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name', 'forum_posts.user_id as user_id', DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), 'forum_count_details.likes as likes', 'forum_count_details.dislikes as dislikes', 'forum_count_details.favorite as favorite', 'forum_count_details.replies as replies', 'forum_count_details.views as views', 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id', 'forum_categorys.category_names', 'forum_posts.created_at')
                ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
                ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    //  ['forum_posts.user_id', '=', $request->user_id],
                    ['forum_posts.category', '=', $request->categId],
                    ['forum_posts.threads_status', '=', 2]
                ])
                ->groupBy('forum_posts.id')
                ->get();
            return  $this->successResponse($success, 'Single Post category vs successfully');
        }
    }
    // forum single category posts
    public function user_singleCategoryPosts(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'categId' => 'required',
            'user_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')
                ->select('forum_posts.id', 'forum_posts.category as category', 'forum_posts.topic_title as topic_title', 'forum_posts.topic_header as topic_header', 'forum_posts.body_content as body_content', 'forum_posts.user_name as user_name', 'forum_posts.user_id as user_id', DB::raw('DATE_FORMAT(forum_posts.created_at, "%b %e %Y") as date'), 'forum_count_details.likes as likes', 'forum_count_details.dislikes as dislikes', 'forum_count_details.favorite as favorite', 'forum_count_details.replies as replies', 'forum_count_details.views as views', 'forum_count_details.activity as activity', 'forum_count_details.id as pkcount_details_id', 'forum_categorys.category_names', 'forum_posts.created_at')
                ->leftJoin('forum_count_details', 'forum_posts.id', '=', 'forum_count_details.created_post_id')
                ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    ['forum_posts.user_id', '=', $request->user_id],
                    ['forum_posts.category', '=', $request->categId],
                    ['forum_posts.threads_status', '=', 2]
                ])
                ->groupBy('forum_posts.id')
                ->get();
            return  $this->successResponse($success, 'Single Post category vs successfully');
        }
    }
    // forum user created post branch id wise
    public function postListUserCreatedOnly(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $success = DB::table('forum_posts')
                ->leftJoin('forum_categorys', 'forum_categorys.id', '=', 'forum_posts.category')
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.category_names', 'forum_posts.created_at', 'forum_posts.topic_header')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    ['forum_posts.user_id', '=', $request->user_id],
                    ['forum_posts.threads_status', '=', 2]
                ])
                // ->groupBy('forum_posts.user_id')
                ->get();

            return $this->successResponse($success, 'User Created Post List successfully');
        }
    }
    // forum user created category post branch id and user id wise
    public function categorypostListUserCreatedOnly(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required'
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
                ->select('forum_posts.id', 'forum_posts.user_id', 'forum_posts.user_name', 'forum_posts.topic_title', 'forum_categorys.id as categId', 'forum_categorys.category_names', 'forum_count_details.likes', 'forum_count_details.dislikes', 'forum_count_details.favorite', 'forum_count_details.replies', 'forum_count_details.views', 'forum_count_details.activity', 'forum_posts.created_at', 'forum_posts.topic_header')
                ->where([
                    ['forum_posts.branch_id', '=', $request->branch_id],
                    ['forum_posts.user_id', '=', $request->user_id],
                    ['forum_posts.threads_status', '=', 2]
                ])
                ->groupBy('forum_posts.category')
                ->get();

            return $this->successResponse($success, 'user vs category grid data fetch successfully');
        }
    }
    // forum post replies branch id and post id wise 
    public function userRepliespostall(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'user_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_post_replies')
                ->select('forum_post_replies.id as pk_replies_id', 'forum_post_replies.created_at', 'forum_post_replies.created_post_id as created_post_id', 'forum_post_replies.branch_id as branch_id', 'forum_post_replies.user_id as user_id', 'forum_post_replies.user_name as user_name', 'replies_com', 'forum_post_replie_counts.id as pk_replies_count_id', 'forum_post_replie_counts.likes as likes', 'forum_post_replie_counts.dislikes as dislikes', 'forum_post_replie_counts.favorits as favorits', DB::raw('DATE_FORMAT(forum_post_replies.created_at, "%b %e %Y") as date'))
                ->leftJoin('forum_post_replie_counts', 'forum_post_replies.id', '=', 'forum_post_replie_counts.created_post_replies_id')
                //->where('forum_post_replies.created_post_id', '=', $request->id)
                ->where([
                    ['forum_post_replies.branch_id', '=', $request->branch_id],
                    ['forum_post_replies.created_post_id', '=', $request->id]
                ])
                ->get();
            return  $this->successResponse($success, 'Post replies fetch successfully');
        }
    }
    // forum thread status update
    public function threadstatusupdate(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
            'user_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = DB::table('forum_posts')->where('id', $request->id)->update([
                'threads_status' => $request->threads_status,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        return  $this->successResponse($success, 'Thread status successfully Updated');
    }
    public function usernameautocomplete(Request $request)
    {
        // $validator = \Validator::make($request->all(), [

        //     'token' => 'required'

        // ]);
        // //dd($validator);
        // if (!$validator->passes()) {
        //     return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        // } else {
        //        // create new connection              
        //     $success = DB::table('users')->select('id','name')
        //     ->where('id','!=',1)  
        //     ->where('id','!=',$request->user_id)           
        //     ->get();
        //  //   $success = Category::all();
        //     return $this->successResponse($success, 'user name record fetch successfully');
        // }
        $validator = \Validator::make($request->all(), [

            'token' => 'required'

        ]);
        //dd($validator);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection              
            $success = DB::table('roles')->select('id', 'role_name as name')
                ->where('id', '!=', 1)
                ->where('id', '!=', $request->user_id)
                ->get();
            //   $success = Category::all();
            return $this->successResponse($success, 'user name record fetch successfully');
        }
    }
    public function getuserid(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required'

        ]);
        //dd($validator);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection              
            $success = DB::table('users')->select('id', 'name')
                ->where('id', '!=', $request->branch_id)
                ->get();
            //  dd($success);
            //   $success = Category::all();
            return $this->successResponse($success, 'user name record fetch successfully');
        }
    }



    // addHomework
    public function addHomework(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'date_of_homework' => 'required',
            'date_of_submission' => 'required',
            'schedule_date' => '',
            'description' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
            'created_by' => 'required',
        ]);

        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);


            $now = now();
            $name = strtotime($now);
            $extension = $request->file_extension;
            $fileName = $name . "." . $extension;

            $base64 = base64_decode($request->file);
            $file = base_path() . '/public/teacher/homework/' . $fileName;
            $suc = file_put_contents($file, $base64);


            $query = $staffConn->table('homeworks')->insert([
                'title' => $request['title'],
                'class_id' => $request['class_id'],
                'section_id' => $request['section_id'],
                'subject_id' => $request['subject_id'],
                'date_of_homework' => $request['date_of_homework'],
                'date_of_submission' => $request['date_of_submission'],
                'schedule_date' => $request['schedule_date'],
                'description' => $request['description'],
                'document' => $fileName,
                'created_by' => $request['created_by'],
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Homework has been successfully saved');
            }
        }
    }

    // get Homework List
    public function getHomeworkList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ]);

        // return 1;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $homework['homework'] = $con->table('homeworks')->select('homeworks.*', 'sections.name as section_name', 'classes.name as class_name', 'subjects.name as subject_name', DB::raw('SUM(homework_evaluation.status = 1) as students_completed'))
                ->leftJoin('subjects', 'homeworks.subject_id', '=', 'subjects.id')
                ->leftJoin('sections', 'homeworks.section_id', '=', 'sections.id')
                ->leftJoin('classes', 'homeworks.class_id', '=', 'classes.id')
                ->leftJoin('homework_evaluation', 'homeworks.id', '=', 'homework_evaluation.homework_id')
                ->where('homeworks.class_id', $request->class_id)
                ->where('homeworks.section_id', $request->section_id)
                ->where('homeworks.subject_id', $request->subject_id)
                ->groupBy('homeworks.id')
                ->orderBy('homeworks.created_at', 'desc')
                ->get();
            $homework['total_students'] =  $con->table('enrolls')->where('class_id', $request->class_id)->where('section_id', $request->section_id)->count();
            return $this->successResponse($homework, 'Homework record fetch successfully');
        }
    }
    // getAttendanceList
    function getAttendanceList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'ref_user_id' => 'required',
            'subject_id' => 'required',
            'year_month' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $year_month = explode('-', $request->year_month);
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getAttendanceList = $Connection->table('students as stud')
                ->select(
                    'stud.first_name',
                    'stud.last_name',
                    'sa.id',
                    'sa.date',
                    'sa.status',
                )
                ->join('student_attendances as sa', 'sa.student_id', '=', 'stud.id')
                ->join('enrolls as en', function ($join) {
                    $join->on('stud.id', '=', 'en.student_id')
                        ->on('sa.class_id', '=', 'en.class_id')
                        ->on('sa.section_id', '=', 'en.section_id');
                })
                ->where([
                    ['stud.parent_id', '=', $request->ref_user_id],
                    ['sa.subject_id', '=', $request->subject_id]
                ])
                ->whereMonth('sa.date', $year_month[0])
                ->whereYear('sa.date', $year_month[1])
                ->groupBy('sa.date')
                ->orderBy('sa.date', 'asc')
                ->get();

            $getAttendanceCounts = $Connection->table('students as stud')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "excused" then 1 ELSE NULL END) as "excusedCount"'),
                )
                // ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->leftJoin('student_attendances as sa', 'sa.student_id', '=', 'stud.id')
                ->join('enrolls as en', function ($join) {
                    $join->on('stud.id', '=', 'en.student_id')
                        ->on('sa.class_id', '=', 'en.class_id')
                        ->on('sa.section_id', '=', 'en.section_id');
                })
                ->where([
                    ['stud.parent_id', '=', $request->ref_user_id],
                    ['sa.subject_id', '=', $request->subject_id]
                ])
                ->whereMonth('sa.date', $year_month[0])
                ->whereYear('sa.date', $year_month[1])
                ->get();
            $data = [
                'get_attendance_list' => $getAttendanceList,
                'get_attendance_counts' => $getAttendanceCounts,
            ];
            return $this->successResponse($data, 'attendance record fetch successfully');
        }
    }
    // getChildSubjects
    function getChildSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'ref_user_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getAttendanceList = $Connection->table('students as stud')
                ->select('stud.first_name', 'stud.last_name', 'sa.subject_id', 's.name as subject_name', 's.id as subject_id')
                // ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->join('subject_assigns as sa', function ($join) {
                    $join->on('en.class_id', '=', 'sa.class_id')
                        ->on('en.section_id', '=', 'sa.section_id');
                })
                ->join('subjects as s', 's.id', '=', 'sa.subject_id')
                ->where([
                    ['stud.parent_id', '=', $request->ref_user_id]
                ])
                ->groupBy('sa.subject_id')
                ->get();

            return $this->successResponse($getAttendanceList, 'subjects record fetch successfully');
        }
    }
    // get attendance list teacher
    function getAttendanceListTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'year_month' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $year_month = explode('-', $request->year_month);
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getAttendanceList = $Connection->table('student_attendances as sa')
                ->select(
                    'stud.first_name',
                    'stud.last_name',
                    'sa.student_id',
                    'sa.date',
                    'sa.status',
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),

                )
                ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id]
                ])
                ->whereMonth('sa.date', $year_month[0])
                ->whereYear('sa.date', $year_month[1])
                ->groupBy('sa.student_id')
                ->get();

            $studentDetails = array();
            if (!empty($getAttendanceList)) {
                foreach ($getAttendanceList as $value) {
                    $object = new \stdClass();

                    $object->first_name = $value->first_name;
                    $object->last_name = $value->last_name;
                    $object->student_id = $value->student_id;
                    $object->presentCount = $value->presentCount;
                    $object->absentCount = $value->absentCount;
                    $object->lateCount = $value->lateCount;
                    $student_id = $value->student_id;
                    $date = $value->date;
                    $getStudentsAttData = $this->getAttendanceByDateStudent($request, $student_id, $date);
                    $object->attendance_details = $getStudentsAttData;

                    array_push($studentDetails, $object);
                }
            }

            // date wise late present analysis
            $getLatePresentData = $Connection->table('student_attendances as sa')
                ->select(

                    // 'sa.date',
                    DB::raw('DATE_FORMAT(sa.date, "%b %d") as date'),
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"')
                )
                ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id]
                ])
                ->whereMonth('sa.date', $year_month[0])
                ->whereYear('sa.date', $year_month[1])
                ->groupBy('sa.date')
                ->get();
            $data = [
                'student_details' => $studentDetails,
                'late_present_graph' => $getLatePresentData
            ];

            return $this->successResponse($data, 'attendance record fetch successfully');
        }
    }
    // by student ,date
    function getAttendanceByDateStudent($request, $student_id, $date)
    {
        // create new connection
        $Connection = $this->createNewConnection($request->branch_id);

        $query_date = $date;
        // First day of the month.
        $startDate = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $endDate = date('Y-m-t', strtotime($query_date));

        $studentList = $Connection->table('student_attendances as sa')
            ->select(
                // 'stud.first_name',
                // 'stud.last_name',
                // 'sa.student_id',
                'sa.date',
                'sa.status'
            )
            ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
            ->join('students as stud', 'sa.student_id', '=', 'stud.id')
            ->where([
                ['sa.student_id', '=', $student_id],
                ['sa.class_id', '=', $request->class_id],
                ['sa.section_id', '=', $request->section_id],
                ['sa.subject_id', '=', $request->subject_id]
            ])
            ->whereBetween(DB::raw('date(date)'), [$startDate, $endDate])
            ->groupBy('sa.date')
            ->orderBy('sa.date', 'asc')
            ->get();
        return $studentList;
    }
    // getReasonsByStudent
    function getReasonsByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'year_month' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $year_month = explode('-', $request->year_month);

            $Connection = $this->createNewConnection($request->branch_id);

            $getReasonsByStudent = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(CASE WHEN sa.reasons = "fever" then 1 ELSE NULL END) as "fever"'),
                    DB::raw('COUNT(CASE WHEN sa.reasons = "breakdown" then 1 ELSE NULL END) as "breakdown"'),
                    DB::raw('COUNT(CASE WHEN sa.reasons = "book_missing" then 1 ELSE NULL END) as "book_missing"'),
                    DB::raw('COUNT(CASE WHEN sa.reasons = "others" then 1 ELSE NULL END) as "others"')
                )
                ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    ['sa.student_id', '=', $request->student_id]
                ])
                ->whereMonth('sa.date', $year_month[0])
                ->whereYear('sa.date', $year_month[1])
                ->get();


            return $this->successResponse($getReasonsByStudent, 'reasons record fetch successfully');
        }
    }


    // view Homework 
    public function viewHomework(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'homework_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection    
            $con = $this->createNewConnection($request->branch_id);
            // get data
            // $homework = $con->table('homework_evaluation as he')->select('he.*','s.first_name','s.last_name','s.register_no')->leftJoin('students as s', 'he.student_id', '=', 's.id')->where('he.homework_id',$request['homework_id'])->get();

            $homework_id = $request->homework_id;
            $status = $request->status;
            $evaluation = $request->evaluation;
            $query = $con->table('homeworks as h')->select('s.first_name', 's.last_name', 's.register_no', 'h.document', 'he.id as evaluation_id', 'he.file', 'he.remarks', 'he.status', 'he.rank', 'he.score_name', 'he.correction', 'he.teacher_remarks', 'he.score_value')
                ->join('enrolls as e', function ($q) use ($homework_id) {
                    $q->on('h.section_id', '=', 'e.section_id')
                        ->on('h.class_id', '=', 'e.class_id');
                })
                ->leftJoin('students as s', 'e.student_id', '=', 's.id')
                ->leftJoin('homework_evaluation as he', function ($q) use ($evaluation) {
                    $q->on('h.id', '=', 'he.homework_id')
                        ->on('s.id', '=', 'he.student_id');
                })
                ->where('h.id', $request['homework_id']);
            $homework = $query->get();


            return $this->successResponse($homework, 'Homework record fetch successfully');
        }
    }

    // evaluate Homework
    public function evaluateHomework(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'homework' => 'required',
        ]);



        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            foreach ($request['homework'] as $home) {

                // return $home;
                $correction = 0;
                if (isset($home['correction'])) {
                    $correction = 1;
                }
                if ($home['homework_evaluation_id']) {
                    $query = $conn->table('homework_evaluation')->where('id', $home['homework_evaluation_id'])->update([
                        'score_name' => $home['score_name'],
                        'score_value' => $home['score_value'],
                        'teacher_remarks' => $home['teacher_remarks'],
                        'correction' => $correction,
                        'evaluated_by' => $request->evaluated_by,
                        'evaluation_date' => date("Y-m-d"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Homework has been Updated Successfully');
            }
        }
    }


    // get Student Homework List
    public function studentHomework(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'student_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);

            $student = $con->table('enrolls')->where('student_id', $request->student_id)->first();
            // get data
            $student_id = $request->student_id;
            $homework['homeworks'] = $con->table('homeworks')->select('homeworks.*', 'sections.name as section_name', 'classes.name as class_name', 'subjects.name as subject_name', 'homeworks.document', 'homework_evaluation.file', 'homework_evaluation.evaluation_date', 'homework_evaluation.remarks', 'homework_evaluation.status', 'homework_evaluation.rank')
                ->leftJoin('subjects', 'homeworks.subject_id', '=', 'subjects.id')
                ->leftJoin('sections', 'homeworks.section_id', '=', 'sections.id')
                ->leftJoin('classes', 'homeworks.class_id', '=', 'classes.id')
                // ->leftJoin('homework_evaluation', 'homeworks.id', '=', 'homework_evaluation.homework_id')
                // ,DB::raw('SUM(homework_evaluation.status = 1) as students_completed')
                ->leftJoin('homework_evaluation', function ($join) use ($student_id) {
                    $join->on('homeworks.id', '=', 'homework_evaluation.homework_id')
                        ->on('homework_evaluation.student_id', '=', DB::raw("'$student_id'"));
                    // >on(DB::raw('COUNT(CASE WHEN homework_evaluation.date < homeworks.date_of_submission then 1 ELSE NULL END) as "presentCount"'));
                })
                ->where('homeworks.class_id', $student->class_id)
                ->where('homeworks.section_id', $student->section_id)
                ->orderBy('homeworks.created_at', 'desc')
                ->get();

            $count = $con->table('homeworks')->select(DB::raw('SUM(homework_evaluation.date <= homeworks.date_of_submission) as ontime'), DB::raw('SUM(homework_evaluation.date > homeworks.date_of_submission) as late'))
                ->leftJoin('homework_evaluation', 'homeworks.id', '=', 'homework_evaluation.homework_id')
                ->where('homework_evaluation.student_id', $request->student_id)
                ->first();
            $total = $count->ontime + $count->late;
            $homework['count']['ontime'] = $count->ontime;
            $homework['count']['late'] = $count->late;
            if ($total == "0") {
                $homework['count']['ontime_percentage'] = Null;
                $homework['count']['late_percentage'] =  Null;
            } else {
                $homework['count']['ontime_percentage'] = round(($count->ontime / $total) * 100, 2);
                $homework['count']['late_percentage'] =  round(($count->late / $total) * 100, 2);
            }

            $homework['subjects'] = $con->table('subjects')->select('subjects.id', 'subjects.name')->join('subject_assigns', 'subject_assigns.subject_id', '=', 'subjects.id')->groupBy('subjects.id')->get();
            return $this->successResponse($homework, 'Homework record fetch successfully');
        }
    }

    // get Student Homework List by filter
    public function studentHomeworkFilter(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'student_id' => 'required',
        ]);

        //    return $request;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);

            $student = $con->table('enrolls')->where('student_id', $request->student_id)->first();
            // get data
            $student_id = $request->student_id;
            $status = $request->status;
            $subject = $request->subject;

            $query = $con->table('homeworks')->select('homeworks.*', 'homework_evaluation.evaluation_date', 'sections.name as section_name', 'classes.name as class_name', 'subjects.name as subject_name', 'homeworks.document', 'homework_evaluation.file', 'homework_evaluation.remarks', 'homework_evaluation.status', 'homework_evaluation.rank')
                ->leftJoin('subjects', 'homeworks.subject_id', '=', 'subjects.id')
                ->leftJoin('sections', 'homeworks.section_id', '=', 'sections.id')
                ->leftJoin('classes', 'homeworks.class_id', '=', 'classes.id')
                ->leftJoin('homework_evaluation', 'homeworks.id', '=', 'homework_evaluation.homework_id');
            if ($status == "1") {
                $query->where(function ($query) use ($status) {
                    $query->where('homework_evaluation.status', $status);
                })
                    ->where('homework_evaluation.student_id', $request->student_id);
            }
            if ($status == "0") {
                $query->whereNotIn('homeworks.id', function ($q) use ($student_id) {
                    $q->select('homework_id')->from('homework_evaluation')->where('student_id', $student_id);
                });
            }
            $query->when($subject != "All", function ($ins)  use ($subject) {
                $ins->where('homeworks.subject_id', $subject);
            })
                ->where('homeworks.class_id', $student->class_id)
                ->where('homeworks.section_id', $student->section_id)
                ->orderBy('homeworks.created_at', 'desc');

            $homework['homeworks'] = $query->get();


            if ($subject == "All") {
                $homework['subject'] = "All";
            } else {

                $subname = $con->table('subjects')->select('name')->where('id', $subject)->first();
                $homework['subject'] = $subname->name;
            }
            return $this->successResponse($homework, 'Homework record fetch successfully');
        }
    }


    //  Student submits Homework 
    public function submitHomework(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'student_id' => 'required',
            'remarks' => 'required',
            'homework_id' => 'required',
            'file' => 'required',
            'file_extension' => '',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);

            $now = now();
            $name = strtotime($now);
            $extension = $request->file_extension;
            $fileName = $name . "." . $extension;

            $base64 = base64_decode($request->file);
            $file = base_path() . '/public/student/homework/' . $fileName;
            $suc = file_put_contents($file, $base64);

            $query = $con->table('homework_evaluation')->insert([
                'homework_id' => $request['homework_id'],
                'student_id' => $request['student_id'],
                'remarks' => $request['remarks'],
                'status' => 1,
                'file' => $fileName,
                'date' => date("Y-m-d"),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Homework has been Submitted Successfully ');
            }
        }
    }
    // getTimetableCalendor
    public function getTimetableCalendor(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'teacher_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $success = $Connection->table('calendors as cl')
                ->select('cl.id', 'cl.class_id', 'cl.section_id', 'cl.subject_id', 'cl.start', 'cl.end', 's.name as section_name', 'c.name as class_name', 'sb.subject_color_calendor as className', 'sb.name as subject_name', 'sb.name as title', 'st.name as teacher_name', 'dr.report')
                ->join('classes as c', 'cl.class_id', '=', 'c.id')
                ->join('sections as s', 'cl.section_id', '=', 's.id')
                ->join('staffs as st', 'cl.teacher_id', '=', 'st.id')
                ->leftJoin('daily_reports as dr', function ($join) {
                    $join->on('cl.class_id', '=', 'dr.class_id')
                        ->on('cl.section_id', '=', 'dr.section_id')
                        ->on('cl.subject_id', '=', 'dr.subject_id')
                        ->on(DB::raw('date(cl.end)'), '=', 'dr.date');
                })
                ->join('subjects as sb', 'cl.subject_id', '=', 'sb.id')
                ->where('cl.teacher_id', $request->teacher_id)
                ->get();
            return $this->successResponse($success, 'calendor data get successfully');
        }
    }
    // getTimetableCalendor
    public function getTimetableCalendorStud(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $success = $Connection->table('students as stud')
                ->select('cl.id', 'cl.class_id', 'cl.section_id', 'cl.subject_id', 'cl.start', 'cl.end', 's.name as section_name', 'c.name as class_name', 'sb.subject_color_calendor as className', 'sb.name as subject_name', 'sb.name as title', 'st.name as teacher_name', 'drr.student_remarks')
                ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->join('classes as c', 'en.class_id', '=', 'c.id')
                ->join('sections as s', 'en.section_id', '=', 's.id')
                ->leftJoin('subject_assigns as sa', function ($join) {
                    $join->on('sa.class_id', '=', 'en.class_id')
                        ->on('sa.section_id', '=', 'en.section_id');
                })
                ->leftJoin('calendors as cl', function ($join) {
                    $join->on('cl.class_id', '=', 'sa.class_id')
                        ->on('cl.section_id', '=', 'sa.section_id')
                        ->on('cl.subject_id', '=', 'sa.subject_id');
                })
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('staffs as st', 'sa.teacher_id', '=', 'st.id')
                ->leftJoin('daily_report_remarks as drr', function ($join) {
                    $join->on('cl.class_id', '=', 'drr.class_id')
                        ->on('cl.section_id', '=', 'drr.section_id')
                        ->on('cl.subject_id', '=', 'drr.subject_id');
                })
                ->where('stud.id', $request->student_id)
                ->get();
            return $this->successResponse($success, 'student calendor data get successfully');
        }
    }
    // addCalendorTimetable
    // function addCalendorTimetable(Request $request)
    function addCalendorTimetable($request, $row, $getObjRow, $insertOrUpdateID)
    {
        if ($getObjRow) {
            $start = $getObjRow->start_date;
            $end = $getObjRow->end_date;
            //
            $startDate = new DateTime($start);
            $endDate = new DateTime($end);
            // sunday=0,monday=1,tuesday=2,wednesday=3,thursday=4
            //friday =5,saturday=6
            if (isset($request->day)) {
                if ($request->day == "monday") {
                    $day = 1;
                }
                if ($request->day == "tuesday") {
                    $day = 2;
                }
                if ($request->day == "wednesday") {
                    $day = 3;
                }
                if ($request->day == "thursday") {
                    $day = 4;
                }
                if ($request->day == "friday") {
                    $day = 5;
                }
                if ($request->day == "saturday") {
                    $day = 6;
                }
                if (isset($day)) {
                    $this->addTimetableCalendor($request, $startDate, $endDate, $day, $row, $insertOrUpdateID);
                }
            }
        }
    }
    // addTimetableCalendor
    function addTimetableCalendor($request, $startDate, $endDate, $day, $row, $insertOrUpdateID)
    {
        // create new connection
        $Connection = $this->createNewConnection($request->branch_id);
        while ($startDate <= $endDate) {
            if ($startDate->format('w') == $day) {
                $start = $startDate->format('Y-m-d') . " " . $row['time_start'];
                $end = $startDate->format('Y-m-d') . " " . $row['time_end'];
                $arrayInsert = [
                    "title" => "timetable",
                    "class_id" => $request['class_id'],
                    "section_id" => $request['section_id'],
                    "sem_id" => $request['semester_id'],
                    "subject_id" => $row['subject'],
                    "teacher_id" => $row['teacher'],
                    "start" => $start,
                    "end" => $end,
                    "time_table_id" => $insertOrUpdateID,
                    'created_at' => date("Y-m-d H:i:s")
                ];
                // return $arrayInsert;

                $calendors = $Connection->table('calendors')->where([
                    ['class_id', '=', $request['class_id']],
                    ['section_id', '=', $request['section_id']],
                    ['subject_id', '=', $row['subject']],
                    ['teacher_id', '=', $row['teacher']],
                    ['sem_id', '=', $request['semester_id']],
                    ['time_table_id', '=', $insertOrUpdateID],
                    [DB::raw('date(start)'), '=', $startDate->format('Y-m-d')],
                ])->first();
                if (isset($calendors->id)) {
                    // $Connection->table('calendors')->where('id', $calendors->id)->delete();
                    $Connection->table('calendors')->where('id', $calendors->id)->update([
                        "subject_id" => $row['subject'],
                        "teacher_id" => $row['teacher'],
                        "sem_id" => $request['semester_id'],
                        "start" => $start,
                        "end" => $end,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                } else {
                    $Connection->table('calendors')->insert($arrayInsert);
                }
            }
            $startDate->modify('+1 day');
        }
    }
    // get semester 
    public function getSemesterList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $semester = $conn->table('semester')->get();
            return $this->successResponse($semester, 'Semester record fetch successfully');
        }
    }

    // get Session 
    public function getSessionList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $session = $conn->table('session')->get();
            return $this->successResponse($session, 'Session record fetch successfully');
        }
    }

    // addExamTerm
    public function addExamTerm(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($con->table('exam_term')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $con->table('exam_term')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Exam Term has been successfully saved');
                }
            }
        }
    }
    // getExamTermList
    public function getExamTermList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam_term')->get();
            return $this->successResponse($details, 'Exam Term record fetch successfully');
        }
    }
    // getExamTermDetails row details
    public function getExamTermDetails(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam_term')->where('id', $id)->first();
            return $this->successResponse($details, 'Exam Term row fetch successfully');
        }
    }
    // update updateExamTerm
    public function updateExamTerm(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($con->table('exam_term')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $con->table('exam_term')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Exam Term Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete ExamTerm
    public function deleteExamTerm(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $query = $con->table('exam_term')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Exam Term have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }


    // addExamHall
    public function addExamHall(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'hall_no' => 'required',
            'no_of_seats' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // check exist hall_no
            if ($con->table('exam_hall')->where('hall_no', '=', $request->hall_no)->count() > 0) {
                return $this->send422Error('Hall No Already Exist', ['error' => 'Hall No Already Exist']);
            } else {
                // insert data
                $query = $con->table('exam_hall')->insert([
                    'hall_no' => $request->hall_no,
                    'no_of_seats' => $request->no_of_seats,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Exam Hall has been successfully saved');
                }
            }
        }
    }
    // getExamHallList
    public function getExamHallList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam_hall')->get();
            return $this->successResponse($details, 'Exam Hall record fetch successfully');
        }
    }
    // getExamHallDetails row details
    public function getExamHallDetails(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam_hall')->where('id', $id)->first();
            return $this->successResponse($details, 'Exam Hall row fetch successfully');
        }
    }
    // update updateExamHall
    public function updateExamHall(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'hall_no' => 'required',
            'no_of_seats' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // check exist hall_no
            if ($con->table('exam_hall')->where([['hall_no', '=', $request->hall_no], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Hall No Already Exist', ['error' => 'Hall No Already Exist']);
            } else {
                // update data
                $query = $con->table('exam_hall')->where('id', $id)->update([
                    'hall_no' => $request->hall_no,
                    'no_of_seats' => $request->no_of_seats,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Exam Hall Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete ExamHall
    public function deleteExamHall(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $query = $con->table('exam_hall')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Exam Hall have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addExam
    public function addExam(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'term_id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // insert data
            $query = $con->table('exam')->insert([
                'name' => $request->name,
                'term_id' => $request->term_id,
                'remarks' => $request->remarks,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Exam has been successfully saved');
            }
        }
    }
    // getExamList
    public function getExamList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam')->select('exam.*', 'exam_term.name as term_id')->join('exam_term', 'exam.term_id', '=', 'exam_term.id')->get();
            return $this->successResponse($details, 'Exam record fetch successfully');
        }
    }
    // getExamDetails row details
    public function getExamDetails(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('exam')->where('id', $id)->first();
            return $this->successResponse($details, 'Exam row fetch successfully');
        }
    }
    // update updateExam
    public function updateExam(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'name' => 'required',
            'term_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $con = $this->createNewConnection($request->branch_id);

            // update data
            $query = $con->table('exam')->where('id', $id)->update([
                'term_id' => $request->term_id,
                'name' => $request->name,
                'remarks' => $request->remarks,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Exam Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete Exam
    public function deleteExam(Request $request)
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
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $query = $con->table('exam')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Exam have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add Exam Timetable
    public function addExamTimetable(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'exam' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            $exams = $request['exam'];
            // insert data

            foreach ($exams as $exam) {
                $mark = json_encode($exam['mark']);

                $distributor = $exam['distributor'];

                if ($exam['distributor_type'] == "1") {

                    $data = $con->table('staffs as s')->select('s.id', 's.name')
                        ->where('id', $exam['distributor'])
                        ->first();

                    $distributor = $data->name;
                }

                if ($exam['timetable_exam_id']) {
                    // return $exam;
                    $query = $con->table('timetable_exam')->where('id', $exam['timetable_exam_id'])->update([
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'subject_id' => $exam['subject_id'],
                        'time_start' => $exam['time_start'],
                        'time_end' => $exam['time_end'],
                        'marks' => $mark,
                        'hall_id' => $exam['hall_id'],
                        "distributor_type" => $exam['distributor_type'],
                        "distributor" => $distributor,
                        "distributor_id" => $exam['distributor'],
                        'exam_date' => $exam['exam_date'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                } else {

                    $query = $con->table('timetable_exam')->insert([
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'section_id' => $request->section_id,
                        'subject_id' => $exam['subject_id'],
                        'time_start' => $exam['time_start'],
                        'time_end' => $exam['time_end'],
                        'marks' => $mark,
                        'hall_id' => $exam['hall_id'],
                        "distributor_type" => $exam['distributor_type'],
                        "distributor" => $distributor,
                        "distributor_id" => $exam['distributor'],
                        'exam_date' => $exam['exam_date'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Exam Timetable has been successfully saved');
            }
        }
    }
    // list Exam Timetable 
    public function listExamTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        // dd($request);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $details = $con->table('timetable_exam')->select('exam.name', 'timetable_exam.exam_id')->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->where([
                    ['class_id', $request->class_id],
                    ['section_id', $request->section_id]
                ])
                ->groupBy('timetable_exam.exam_id')
                ->get();
            return $this->successResponse($details, 'Exam Timetable record fetch successfully');
        }
    }

    // get Exam Timetable 
    public function getExamTimetable(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        // return $request;
        // dd($request);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data

            $exam_id = $request->exam_id;
            $details['exam'] = $con->table('subject_assigns')->select('subjects.name as subject_name', 'exam_hall.hall_no', 'classes.name as class_name', 'sections.name as section_name', 'exam.name as exam_name', 'subject_assigns.class_id as class_id', 'subject_assigns.section_id as section_id', 'subject_assigns.subject_id as subject_id', 'timetable_exam.exam_id', 'timetable_exam.time_start', 'timetable_exam.time_end', 'timetable_exam.exam_date', 'timetable_exam.hall_id', 'timetable_exam.marks', 'timetable_exam.distributor_type', 'timetable_exam.distributor', 'timetable_exam.distributor_id', 'timetable_exam.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->leftJoin('classes', 'subject_assigns.class_id', '=', 'classes.id')
                ->leftJoin('sections', 'subject_assigns.section_id', '=', 'sections.id')
                ->where([
                    ['subject_assigns.class_id', $request->class_id],
                    ['subject_assigns.section_id', $request->section_id],
                ])
                ->leftJoin('timetable_exam', function ($join) use ($exam_id) {
                    $join->on('subject_assigns.class_id', '=', 'timetable_exam.class_id')
                        ->on('subject_assigns.section_id', '=', 'timetable_exam.section_id')
                        ->on('subject_assigns.subject_id', '=', 'timetable_exam.subject_id')
                        ->where('timetable_exam.exam_id', $exam_id);
                })
                ->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->leftJoin('exam_hall', 'timetable_exam.hall_id', '=', 'exam_hall.id')
                ->get();
            $exam_name = $con->table('exam')->where('id', $exam_id)->first();

            //    dd($exam_name->name);
            $details['details']['exam_name'] = $exam_name->name;
            // return $details;
            return $this->successResponse($details, 'Exam Timetable record fetch successfully');
        }
    }
    public function examslist(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'today' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getExamsName = $Connection->table('timetable_exam')
                ->select('timetable_exam.exam_id as id', 'exam.name as name', 'timetable_exam.exam_date', 'timetable_exam.marks')
                ->leftJoin('exam', 'timetable_exam.exam_id', '=', 'exam.id')
                ->where('exam_date', '<', $request->today)
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('subject_id', '=', $request->subject_id)
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }
    public function subject_vs_marks(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $exam_id = $request->exam_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);
            $getSubjectMarks = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    'st.first_name',
                    'st.last_name',
                    'st.register_no',
                    'sa.id as att_id',
                    'sa.score',
                    'sa.grade',
                    'sa.ranking',
                    'sa.memo',
                    'sa.pass_fail',
                    'sa.status',
                    // DB::raw("RANK() OVER(ORDER BY sa.score DESC) as rank_place")
                    //    'sd.subject_division'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('student_marks as sa', function ($q) use ($exam_id, $subject_id) {
                    $q->on('sa.student_id', '=', 'st.id')
                        ->on('sa.exam_id', '=', DB::raw("'$exam_id'")) //second join condition                           
                        ->on('sa.subject_id', '=', DB::raw("'$subject_id'")); //need to add subject id also later                           
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->orderBy('sa.score', 'desc')
                ->get();
            return $this->successResponse($getSubjectMarks, 'Subject vs marks record fetch successfully');
        }
    }
    public function marks_vs_grade(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'marks_range' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $branch_id =  $request->branch_id;
            $marks_range =  $request->marks_range;

            $Connection = $this->createNewConnection($branch_id);
            // $success = $Connection->table('grade_marks')         
            // ->select('id','grade')
            // ->where([
            //     ['min_mark', '>=', $marks_range]             
            // ])
            $success = $Connection->table('grade_marks')
                ->select('grade')->where('min_mark', '<=', $marks_range)->where('max_mark', '>=', $marks_range)->get();


            return $this->successResponse($success, 'marks vs grade record fetch successfully');
        }
    }
    public function addStudentMarks(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'subjectmarks' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection     
            $Connection = $this->createNewConnection($request->branch_id);
            $subjectmarks = $request->subjectmarks;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $exam_id = $request->exam_id;
            $data = [];

            foreach ($subjectmarks as $key => $value) {

                $student_id = (isset($value['student_id']) ? $value['student_id'] : "");
                $score = (isset($value['score']) ? $value['score'] : "");
                $grade = (isset($value['grade']) ? $value['grade'] : "");
                $ranking = (isset($value['ranking']) ? $value['ranking'] : "");
                $memo = (isset($value['memo']) ? $value['memo'] : "");
                $pass_fail = (isset($value['pass_fail']) ? $value['pass_fail'] : "");
                $status = (isset($value['status']) ? $value['status'] : "");

                $arrayStudentMarks = array(
                    'student_id' => $student_id,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id,
                    'exam_id' => $exam_id,
                    'score' => $score,
                    'grade' => $grade,
                    'pass_fail' => $pass_fail,
                    'ranking' => $ranking,
                    'status' => $status,
                    'memo' => $memo,
                    'created_at' => date("Y-m-d H:i:s")
                );

                if ((empty($value['studentmarks_tbl_pk_id']) || $value['studentmarks_tbl_pk_id'] == "null")) {
                    if ($Connection->table('student_marks')->where([

                        ['class_id', '=', $class_id],
                        ['section_id', '=', $section_id],
                        ['subject_id', '=', $subject_id],
                        ['student_id', '=', $value['student_id']],
                        ['exam_id', '=', $exam_id]

                    ])->count() > 0) {
                        $Connection->table('student_marks')->where('id', $value['studentmarks_tbl_pk_id'])->update([
                            'score' => $score,
                            'grade' => $grade,
                            'ranking' => $ranking,
                            'pass_fail' => $pass_fail,
                            'status' => $status,
                            'memo' => $memo,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    } else {
                        $Connection->table('student_marks')->insert($arrayStudentMarks);
                    }
                } else {
                    $Connection->table('student_marks')->where('id', $value['studentmarks_tbl_pk_id'])->update([
                        'score' => $score,
                        'grade' => $grade,
                        'ranking' => $ranking,
                        'pass_fail' => $pass_fail,
                        'status' => $status,
                        'memo' => $memo,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
            return $this->successResponse([], 'Student Marks added successfuly.');
        }
    }
    public function getsubjectdivision(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $exam_id = $request->exam_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $studentdetails = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    'st.first_name',
                    'st.last_name',
                    'st.register_no',
                    'ssdiv.id as subdivision_id',
                    'ssdiv.subject_division',
                    'ssdiv.subjectdivision_scores',
                    'ssdiv.total_score',
                    'ssdiv.grade',
                    'ssdiv.ranking',
                    'ssdiv.pass_fail',
                    'ssdiv.status',
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('student_subjectdivision_inst as ssdiv', function ($q) use ($class_id, $subject_id, $exam_id) {
                    $q->on('ssdiv.student_id', '=', 'st.id')
                        ->on('ssdiv.exam_id', '=', DB::raw("'$exam_id'")) //second join condition                           
                        ->on('ssdiv.subject_id', '=', DB::raw("'$subject_id'")); //need to add subject id also later                           
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->get();

            $subjectdivision = $Connection->table('student_subjectdivision')
                ->select(
                    'class_id',
                    'section_id',
                    'subject_id',
                    'subject_division',
                    'credit_point'
                )
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                // ->groupBy('en.student_id')
                ->get();
            $data = [
                "studentdetails" => $studentdetails,
                "subjectdivision" => $subjectdivision
            ];
            return $this->successResponse($data, 'Subject division record fetch successfully');
        }
    }
    public function addsubjectdivision(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required',
            'subjectdiv' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $subjectdiv = $request->subjectdiv;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;

            // $total_score = $request->total_score;
            // $grade = $request->grade;
            foreach ($subjectdiv as $key => $value) {

                $subject_division = (count($value['subject_division']) > 0) ? implode(",", $value['subject_division']) : "";
                $subjectdivision_scores = (count($value['subjectdivision_scores']) > 0) ? implode(",", $value['subjectdivision_scores']) : "";

                $addSubjectDivision = array(
                    'student_id' => $value['student_id'],
                    'subjectdivision_scores' => $subjectdivision_scores,
                    'subject_division' => $subject_division,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'subject_id' => $subject_id,
                    'total_score' => $value['total_score'],
                    'exam_id' => $request->exam_id,
                    'pass_fail' => $value['pass_fail'],
                    'ranking' => $value['ranking'],
                    'status' => $value['status'],
                    'grade' => $value['grade'],
                    'created_at' => date("Y-m-d H:i:s")
                );
                // dd($addSubjectDivision);
                // return "dfdf";
                $checkExist = $Connection->table('student_subjectdivision_inst')->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id],
                    ['student_id', '=', $value['student_id']],
                    ['exam_id', '=', $request->exam_id],
                ])->first();
                // dd($checkExist);
                if (isset($checkExist->id)) {
                    $Connection->table('student_subjectdivision_inst')->where('id', $checkExist->id)->update([
                        'subjectdivision_scores' => $subjectdivision_scores,
                        'subject_division' => $subject_division,
                        'total_score' => $value['total_score'],
                        'grade' => $value['grade'],
                        'pass_fail' => $value['pass_fail'],
                        'ranking' => $value['ranking'],
                        'status' => $value['status'],
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                } else {
                    $Connection->table('student_subjectdivision_inst')->insert($addSubjectDivision);
                }
            }
            return $this->successResponse([], 'Student subjects added successfuly.');
        }
    }

    // addGrade
    public function addGrade(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'min_mark' => 'required',
            'max_mark' => 'required',
            'grade' => 'required',
            'grade_point' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);



        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $grade = $this->createNewConnection($request->branch_id);
            // check exist grade
            if ($grade->table('grade_marks')->where('grade', '=', $request->grade)->count() > 0) {
                return $this->send422Error('Grade Already Exist', ['error' => 'Grade Already Exist']);
            } else {
                // insert data

                // return $request;
                $query = $grade->table('grade_marks')->insert([
                    'grade' => $request->grade,
                    'min_mark' => $request->min_mark,
                    'max_mark' => $request->max_mark,
                    'grade_point' => $request->grade_point,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Grade has been successfully saved');
                }
            }
        }
    }
    // getGradeList
    public function getGradeList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $Grade = $conn->table('grade_marks')->get();
            return $this->successResponse($Grade, 'Grade record fetch successfully');
        }
    }
    // getGradeDetails row details
    public function getGradeDetails(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $desDetails = $conn->table('grade_marks')->where('id', $id)->first();
            return $this->successResponse($desDetails, 'Grade row fetch successfully');
        }
    }
    // update updateGrade
    public function updateGrade(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'min_mark' => 'required',
            'max_mark' => 'required',
            'grade' => 'required',
            'grade_point' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist grade
            if ($conn->table('grade_marks')->where([['grade', '=', $request->grade], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Grade Already Exist', ['error' => 'Grade Already Exist']);
            } else {
                // update data
                $query = $conn->table('grade_marks')->where('id', $id)->update([
                    'grade' => $request->grade,
                    'min_mark' => $request->min_mark,
                    'max_mark' => $request->max_mark,
                    'grade_point' => $request->grade_point,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Grade Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Grade
    public function deleteGrade(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $conn->table('grade_marks')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Grade have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // get Transport List
    public function getTransportList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);
            // get data
            $Transport = $Conn->table('transport_route')->get();
            return $this->successResponse($Transport, 'Transport record fetch successfully');
        }
    }

    // get Hostel List
    public function getHostelList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);
            // get data
            $Hostel = $Conn->table('hostel')->get();
            return $this->successResponse($Hostel, 'Hostel record fetch successfully');
        }
    }


    // vehicle By Route 
    public function vehicleByRoute(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'route_id' => 'required',
        ]);


        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);
            // get data
            $route_id = $request->route_id;
            $route = $Conn->table('transport_assign')->select('transport_vehicle.id as vehicle_id', 'transport_vehicle.vehicle_no')
                ->join('transport_vehicle', 'transport_assign.vehicle_id', '=', 'transport_vehicle.id')
                ->where('transport_assign.route_id', $route_id)
                ->get();
            // return $route;
            return $this->successResponse($route, 'Vehicle record fetch successfully');
        }
    }

    // room By Hostel 
    public function roomByHostel(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'hostel_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);
            // get data
            $hostel_id = $request->hostel_id;
            $hostel = $Conn->table('hostel_room')->select('hostel_room.id as room_id', 'hostel_room.name as room_name')
                ->where('hostel_room.hostel_id', $hostel_id)
                ->get();
            return $this->successResponse($hostel, 'Room record fetch successfully');
        }
    }


    // add Admission
    public function addAdmission(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'register_no' => 'required',
            'roll_no' => 'required',
            'admission_date' => 'required',
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'birthday' => 'required',
            'mother_tongue' => 'required',
            'religion' => 'required',
            'caste' => 'required',
            'mobile_no' => 'required',
            'city' => 'required',
            'state' => 'required',
            'current_address' => 'required',
            'permanent_address' => 'required',
            'email' => 'required',
            'route_id' => 'required',
            'vehicle_id' => 'required',
            'hostel_id' => 'required',
            'room_id' => 'required',
            'school_name' => 'required',
            'qualification' => 'required',
            'remarks' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
            'class_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',

            'branch_id' => 'required',
            'token' => 'required',

            'parent_name' => 'required',
            'email' => 'required',
            'relation' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'occupation' => 'required',
            'income' => 'required',
            'education' => 'required',
            'parent_city' => 'required',
            'parent_state' => 'required',
            'parent_mobile_no' => 'required',
            'address' => 'required',
            'parent_email' => 'required',
            'parent_password' => 'required|min:6',
            'parent_confirm_password' => 'required|same:parent_password|min:6',
        ]);

        $previous['school_name'] = $request->school_name;
        $previous['qualification'] = $request->qualification;
        $previous['remarks'] = $request->remarks;



        $previous_details = json_encode($previous);



        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // insert data
            // return $request['parent_email'];
            // if ($Connection->table('parent')->where('email', '=', $request->parent_email)->count() > 0) {
            //     return $this->send422Error('Parent Email Already Exist', ['error' => 'Parent Email Already Exist']);
            // } else {

            $parentId = $conn->table('parent')->insertGetId([
                'name' => $request->parent_name,
                'relation' => $request->relation,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'occupation' => $request->occupation,
                'income' => $request->income,
                'education' => $request->education,
                'city' => $request->parent_city,
                'state' => $request->parent_state,
                'mobile_no' => $request->parent_mobile_no,
                'address' => $request->address,
                'email' => $request->parent_email,
                'active' => "1",
            ]);

            // return $parentId;
            // }


            if (!$parentId) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Parent']);
            } else {

                // add User
                $userParent = new User();
                $userParent->name = $request->parent_name;
                $userParent->user_id = $parentId;
                $userParent->role_id = "5";
                $userParent->branch_id = $request->branch_id;
                $userParent->email = $request->parent_email;
                $userParent->password = bcrypt($request->parent_password);
                $userParent->save();
            }

            // if ($Connection->table('students')->where('email', '=', $request->email)->count() > 0) {
            //     return $this->send422Error('Student Email Already Exist', ['error' => 'Student Email Already Exist']);
            // } else {

            $studentId = $conn->table('students')->insertGetId([
                'parent_id' => $parentId,
                'register_no' => $request->register_no,
                'roll_no' => $request->roll_no,
                'admission_date' => $request->admission_date,
                'category_id' => $request->category_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'blood_group' => $request->blood_group,
                'birthday' => $request->birthday,
                'mother_tongue' => $request->mother_tongue,
                'religion' => $request->religion,
                'caste' => $request->caste,
                'mobile_no' => $request->mobile_no,
                'city' => $request->city,
                'state' => $request->state,
                'current_address' => $request->current_address,
                'permanent_address' => $request->permanent_address,
                'photo' => NULL,
                'route_id' => $request->route_id,
                'vehicle_id' => $request->vehicle_id,
                'hostel_id' => $request->hostel_id,
                'room_id' => $request->room_id,
                'previous_details' => $previous_details,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $enroll = $conn->table('enrolls')->insert([
                'student_id' => $studentId,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'session_id' => $request->session_id,
                'roll' => $request->roll_no,
            ]);


            $studentName = $request->first_name . ' ' . $request->last_name;
            // }

            // return $request;
            $success = [];

            if (!$studentId) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Student']);
            } else {
                // add User
                $user = new User();
                $user->name = $studentName;
                $user->user_id = $studentId;
                $user->role_id = "6";
                $user->branch_id = $request->branch_id;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $query = $user->save();

                // return $user->id;
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Student has been successfully saved');
                }
            }
        }
    }
    // get Teacher list 
    public function getTeacherList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $success = $createConnection->table('subject_assigns as sa')->select('s.id', 's.name')
                ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                ->groupBy('sa.teacher_id')
                ->get();
            return $this->successResponse($success, 'Teachers record fetch successfully');
        }
    }

    public function getSubjectAverage(Request $request)
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
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $studentdetails = $Connection->table('student_marks as sm')->select('sm.exam_id', 'te.exam_date', DB::raw('round(AVG(sm.score), 2) as average'))
                ->leftJoin('timetable_exam as te', function ($join) {
                    $join->on('te.exam_id', '=', 'sm.exam_id')
                        ->on('te.class_id', '=', 'sm.class_id')
                        ->on('te.section_id', '=', 'sm.section_id')
                        ->on('te.subject_id', '=', 'sm.subject_id');
                })
                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id]
                ])
                ->groupBy('sm.exam_id')
                ->orderBy('te.exam_date', 'ASC')
                ->get();

            // return $studentdetails;
            return $this->successResponse($studentdetails, 'Subject division record fetch successfully');
        }
    }



    public function getStudentSubjectMark(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'student_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $studentdetails = $Connection->table('student_marks as sm')->select('sm.exam_id', 'te.exam_date', 'sm.score', DB::raw('round(AVG(sm.score), 2) as average'))
                ->leftJoin('timetable_exam as te', function ($join) {
                    $join->on('te.exam_id', '=', 'sm.exam_id')
                        ->on('te.class_id', '=', 'sm.class_id')
                        ->on('te.section_id', '=', 'sm.section_id')
                        ->on('te.subject_id', '=', 'sm.subject_id');
                })
                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id],
                    ['sm.student_id', '=', $request->student_id]
                ])
                ->groupBy('sm.exam_id')
                ->orderBy('te.exam_date', 'ASC')
                ->get();

            // return $studentdetails;
            return $this->successResponse($studentdetails, 'Subject division record fetch successfully');
        }
    }

    public function getStudentGrade(Request $request)
    {
        // return 2;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $studentdetails = $Connection->table('student_marks as sm')->select('sm.grade as y', DB::raw('count(sm.grade) as a'))
                ->leftJoin('timetable_exam as te', function ($join) {
                    $join->on('te.exam_id', '=', 'sm.exam_id')
                        ->on('te.class_id', '=', 'sm.class_id')
                        ->on('te.section_id', '=', 'sm.section_id')
                        ->on('te.subject_id', '=', 'sm.subject_id');
                })
                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id],
                    ['sm.exam_id', '=', $request->exam_id],
                ])
                ->groupBy('sm.grade')
                ->get();

            // return $studentdetails;
            return $this->successResponse($studentdetails, 'Subject division record fetch successfully');
        }
    }

    public function getSubDivisionMark(Request $request)
    {
        // return 2;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $studentdetails = $Connection->table('student_marks as sm')->select('sm.id', 'sm.score', 'sm.exam_id', "ss.subject_division", 'ss.subjectdivision_scores', 'e.name')
                ->leftJoin('exam as e', 'sm.exam_id', '=', 'e.id')
                ->leftJoin('student_subjectdivision_inst as ss', function ($join) {
                    $join->on('ss.class_id', '=', 'sm.class_id')
                        ->on('ss.section_id', '=', 'sm.section_id')
                        ->on('ss.subject_id', '=', 'sm.subject_id')
                        ->on('ss.student_id', '=', 'sm.student_id')
                        ->on('ss.exam_id', '=', 'sm.exam_id');
                })

                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id],
                ])
                ->orderBy('sm.id')
                ->get()
                ->groupBy('name');

            // dd($studentdetails);
            $markDetails = [];
            $sl = 0;
            foreach ($studentdetails as $key => $details) {
                $markDetails[$sl]['exam_name'] = $key;
                // $average = 0;
                $divison = [];
                $id = 0;
                $count = count($details);
                foreach ($details as $index => $det) {

                    if ($det->subject_division) {
                        // dd($det);
                        $subject_division = explode(',', $det->subject_division);
                        $subjectdivision_scores = explode(',', $det->subjectdivision_scores);
                        foreach ($subject_division as $s => $subdiv) {

                            if ($index == 0) {
                                $total[$subdiv] = $subjectdivision_scores[$s];
                                $average[$subdiv] = $subjectdivision_scores[$s] / $count;
                            } else {
                                $total[$subdiv] += $subjectdivision_scores[$s];
                                $average[$subdiv] += $subjectdivision_scores[$s] / $count;
                            }
                        }
                        $id++;
                    } else {
                        $total = [];
                        $average = [];
                    }
                }

                // dd($total);
                $markDetails[$sl]['total'] = $total;
                $markDetails[$sl]['average'] = $average;

                $sl++;
            }

            // dd($data);

            $subjectdivision = $Connection->table('student_subjectdivision')
                ->select('subject_division')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])->orderBy('id', 'ASC')->get();

            $data = [
                'markDetails' => $markDetails,
                'subjectdivision' => $subjectdivision
            ];

            // return $studentdetails;
            return $this->successResponse($data, 'Subject division record fetch successfully');
        }
    }

    public function getSubjectMarkStatus(Request $request)
    {
        // return 2;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // get attendance details query
            $subject_id = $request->subject_id;
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            $subject_id = $request->subject_id;
            $Connection = $this->createNewConnection($request->branch_id);

            $subjectDetails = $Connection->table('student_marks as sm')->select('sm.pass_fail as status', DB::raw('count(sm.pass_fail) as count'))
                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id],
                    ['sm.exam_id', '=', $request->exam_id],
                ])
                ->groupBy('sm.pass_fail')
                ->get();

            // return $subjectDetails;
            return $this->successResponse($subjectDetails, 'Subject Status record fetched successfully');
        }
    }
}
