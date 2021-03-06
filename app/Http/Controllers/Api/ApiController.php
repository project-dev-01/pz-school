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
// notifications
use App\Notifications\LeaveApply;
use Illuminate\Support\Facades\Notification;

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
            $section = $secConn->table('sections')->orderBy('name', 'asc')->get();
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
            $sectionDetails = $createConnection->table('sections')->where('id', $request->section_id)->first();
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
                        $branch->db_password = isset($request->db_password) ? $request->db_password : "";
                        $query = $branch->save();

                        $success = [];
                        if (!$query) {
                            return $this->send500Error('Error while creating branch', ['error' => 'Error while creating branch']);
                        } else {
                            $branchID = $branch->id;
                            // create new connection
                            $Connection = $this->createNewConnection($branchID);
                            $Staffid = $Connection->table('staffs')->insertGetId([
                                // 'staff_id' => $request->staff_id,
                                // 'name' => $request->name,
                                'first_name' => isset($request->name) ? $request->name : "",
                                'last_name' => "",

                                'present_address' => trim($request->address),
                                // 'permanent_address' => trim($request->permanent_address),
                                'mobile_no' => $request->mobile_no,
                                'email' => $request->email,
                                // 'nric_number' => $request->nric_number,
                                // 'passport' => $request->passport,
                                'city' => $request->city_id,
                                'state' => $request->state_id,
                                'country' => $request->country_id,
                                // 'post_code' => $request->post_code,
                                'status' => "1",
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                            // create admin login users for schoolcrm
                            $createUser = $this->createUser($request, $branchID, $Staffid);
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
                return $this->send500Error('Users already exist', ['error' => 'Users already exist']);
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
                ->where('br.status', 0)
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
            $class = $classConn->table('classes')->orderBy('name', 'asc')->get();
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
            $sectionDetails = $createConnection->table('classes')->where('id', $request->class_id)->first();
            return $this->successResponse($sectionDetails, 'Class row fetch successfully');
        }
    }
    // update class
    public function updateClassDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'name' => 'required',
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
                    'capacity' => $request->capacity,
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
                ->select('sa.id', 'sa.capacity', 'sa.class_id', 'sa.section_id', 's.name as section_name', 'c.name as class_name', 'c.name_numeric')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->orderBy('c.name', 'asc')
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
            $sectionDetails = $createConnection->table('section_allocations')->where('id', $request->id)->first();
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
                    'capacity' => $request->capacity,
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
            'teacher_id' => 'required',
            'type' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist
            if ($request->type == "0") {
                $old = $createConnection->table('teacher_allocations')
                    ->where(
                        [
                            ['section_id', $request->section_id],
                            ['class_id', $request->class_id],
                            ['type', '0']
                        ]
                    )
                    ->first();
            }

            // dd($arraySubject);
            if (isset($old->id)) {
                return $this->send422Error('Main Class Teacher Already Assigned', ['error' => 'Main Class Teacher Already Assigned']);
                // $arraySubject['updated_at'] = date("Y-m-d H:i:s");
                // $query = $createConnection->table('subject_assigns')->where('id', $old->id)->update($arraySubject);
            } else {
                $arrayData = array(
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => $request->teacher_id,
                    'type' => $request->type,
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
            // if ($createConnection->table('teacher_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id]])->count() > 0) {
            //     return $this->send422Error('Class Teacher Already Assigned', ['error' => 'Class Teacher Already Assigned']);
            // } else {


            // }


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
                ->select(
                    'ta.id',
                    'ta.class_id',
                    'ta.section_id',
                    'ta.teacher_id',
                    'ta.type',
                    's.name as section_name',
                    'c.name as class_name',
                    DB::raw("CONCAT(st.first_name, ' ', st.last_name) as teacher_name")
                )
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
            $sectionDetails = $createConnection->table('teacher_allocations')->where('id', $request->id)->first();
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
            'teacher_id' => 'required',
            'type' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // check exist name
            // if ($createConnection->table('teacher_allocations')->where([['section_id', $request->section_id], ['class_id', $request->class_id], ['id', '!=', $id]])->count() > 0) {
            //     return $this->send422Error('Class Teacher Already Assigned', ['error' => 'Class Teacher Already Assigned']);
            // } else {
            // }

            $getCount = 0;
            if ($request->type == "0") {
                $getCount = $createConnection->table('teacher_allocations')
                    ->where(
                        [
                            ['section_id', $request->section_id],
                            ['class_id', $request->class_id],
                            ['type', $request->type],
                            ['id', '!=', $request->id]
                        ]
                    )
                    ->count();
            }
            if ($getCount > 0) {
                return $this->send422Error('Main Class Teacher Already Assigned', ['error' => 'Main Class Teacher Already Assigned']);
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
                    'short_name' => $request->short_name,
                    'subject_color_calendor' => $request->subject_color,
                    'subject_author' => $request->subject_author,
                    'subject_type_2' => $request->subject_type_2,
                    'exam_exclude' => $request->exam_exclude,
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
            $subjectDetails = $secConn->table('subjects')->orderBy('name', 'asc')->get();
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
            $sectionDetails = $createConnection->table('subjects')->where('id', $request->id)->first();
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
                    'short_name' => $request->short_name,
                    'subject_color_calendor' => $request->subject_color,
                    'subject_author' => $request->subject_author,
                    'subject_type_2' => $request->subject_type_2,
                    'exam_exclude' => $request->exam_exclude,
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
                ->select('sa.id', 'sa.class_id', 'sa.section_id', 'sa.subject_id', 'sa.teacher_id', 's.name as section_name', 'sb.name as subject_name', 'c.name as class_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                // ->leftJoin('staffs as st', 'sa.teacher_id', '=', 'st.id')
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                // ->groupBy('sa.subject_id')
                ->where([
                    ['sa.type', '=', '0']
                ])
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
            $classAssign = $createConnection->table('subject_assigns')->where('id', $request->id)->first();
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
            'subject_id' => 'required',
            'type' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);

            if ($request->type == "0") {
                $old = $createConnection->table('subject_assigns')
                    ->where(
                        [
                            ['section_id', $request->section_id],
                            ['class_id', $request->class_id],
                            ['subject_id', $request->subject_id],
                            // ['teacher_id', '!=', '0'],
                            // ['teacher_id','0'],
                            ['type', $request->type]
                        ]
                    )
                    ->first();
            }

            // if ($getCount > 0) {
            //     return $this->send422Error('Teacher is already assigned to this class and section', ['error' => 'Teacher is already assigned to this class and section']);
            // } else {
            $arraySubject = array(
                'class_id' =>  $request->class_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
                'type' => $request->type
            );
            // dd($arraySubject);
            if (isset($old->id)) {
                // if($old->teacher_id == "0"){

                // }
                // // return $this->send422Error('Main teacher is already assigned to this class and section', ['error' => 'Main teacher is already assigned to this class and section']);
                $arraySubject['updated_at'] = date("Y-m-d H:i:s");
                $query = $createConnection->table('subject_assigns')->where('id', $old->id)->update($arraySubject);
            } else {
                $arraySubject['created_at'] = date("Y-m-d H:i:s");
                $query = $createConnection->table('subject_assigns')->insert($arraySubject);
            }

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Teacher assign has been successfully saved');
            }
            // }
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
                ->select(
                    'sa.id',
                    'sa.class_id',
                    DB::raw("CONCAT(st.first_name, ' ', st.last_name) as teacher_name"),
                    'sa.section_id',
                    'sa.subject_id',
                    'sa.teacher_id',
                    'sa.type',
                    's.name as section_name',
                    'sb.name as subject_name',
                    'c.name as class_name'
                )
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
            $classAssign = $createConnection->table('subject_assigns')->where('id', $request->id)->first();
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
            'type' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $getCount = 0;
            if ($request->type == "0") {
                $getCount = $createConnection->table('subject_assigns')
                    ->where(
                        [
                            ['section_id', $request->section_id],
                            ['class_id', $request->class_id],
                            ['subject_id', $request->subject_id],
                            ['type', $request->type],
                            ['id', '!=', $request->id]
                        ]
                    )
                    ->count();
            }
            // $getCount = $createConnection->table('subject_assigns')
            //     ->where(
            //         [
            //             ['section_id', $request->section_id],
            //             ['class_id', $request->class_id],
            //             ['subject_id', $request->subject_id],
            //             // ['teacher_id', $request->teacher_id],
            //             ['id', '!=', $request->id]
            //         ]
            //     )
            //     ->count();
            if ($getCount > 0) {
                return $this->send422Error('Main subject is already assigned to this class and section', ['error' => 'Main subject is already assigned to this class and section']);
            } else {
                $arraySubject = array(
                    'class_id' =>  $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                    'type' => $request->type,
                    'updated_at' => date("Y-m-d H:i:s")
                );
                // dd($arraySubject);
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
    // getAssignClassSubjects
    public function getAssignClassSubjects(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $success = $createConnection->table('subject_assigns as sa')
                ->select('sa.id', 'sa.subject_id', 'sb.name as subject_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.type', '=', '0']
                ])
                ->get();
            return $this->successResponse($success, 'Get Assign class subjects fetch successfully');
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

    // addEventType
    public function addEventType(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'color' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('event_types')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('event_types')->insert([
                    'name' => $request->name,
                    'color' => $request->color,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Event Type has been successfully saved');
                }
            }
        }
    }
    // getEventTypeList
    public function getEventTypeList(Request $request)
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
            $eventTypeDetails = $conn->table('event_types')->get();
            return $this->successResponse($eventTypeDetails, 'Event Type record fetch successfully');
        }
    }
    // get EventType row details
    public function getEventTypeDetails(Request $request)
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
            $eventTypeDetails = $conn->table('event_types')->where('id', $id)->first();
            return $this->successResponse($eventTypeDetails, 'Event Type row fetch successfully');
        }
    }
    // update EventType
    public function updateEventType(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'color' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('event_types')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('event_types')->where('id', $id)->update([
                    'name' => $request->name,
                    'color' => $request->color,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Event Type Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete EventType
    public function deleteEventType(Request $request)
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
            $query = $conn->table('event_types')->where('id', $id)->delete();

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

        //    return $request;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            if ($request->audience == 2) {
                $selected_list = $request->event_class;
            } else if ($request->audience == 3) {
                $selected_list = $request->event_group;
            } else {
                $selected_list = NULL;
            }

            $allDay = $request->all_day;
            if ($allDay == NULL) {
                $eventSt = $request->start_time;
                $eventEt = $request->end_time;
            } else {
                $eventSt = NULL;
                $eventEt = NULL;
            }

            $query = $conn->table('events')->insertGetId([
                'title' => $request->title,
                'type' => $request->type,
                'audience' => $request->audience,
                'selected_list' => $selected_list,
                'status' => 1,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $eventSt,
                'end_time' => $eventEt,
                'all_day' => $request->all_day,
                'remarks' => $request->description,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $eventId = $query;
            $title = $request->title;
            if ($request->audience == 1) {
                $classes = $conn->table('classes')->get();
            } elseif ($request->audience == 2) {
                $classes = $request->class;
            }

            $allDay = $request->all_day;
            if ($allDay == NULL) {
                $begin = new DateTime($request->start_date);
                $end = new DateTime($request->end_date);

                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $interval, $end);

                $date = [];
                foreach ($period as $dt) {
                    $fd['start_date'] = $dt->format('Y-m-d') . ' ' . $request->start_time;
                    $fd['end_date'] = $dt->format("Y-m-d") . ' ' . $request->end_time;
                    array_push($date, $fd);
                }
                $final['start_date'] = $request->end_date . ' ' . $request->start_time;
                $final['end_date'] = $request->end_date . ' ' . $request->end_time;
                array_push($date, $final);

                foreach ($date as $d) {
                    $start_date = $d['start_date'];
                    $end_date = $d['end_date'];
                    if ($request->audience == 3) {
                        $group = $request->group;
                        foreach ($group as $gro) {
                            $conn->table('calendors')->insert([
                                'title' => $title,
                                'start' => $start_date,
                                'end' => $end_date,
                                'group_id' => $gro,
                                'event_id' => $eventId,
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                        }
                    } else {
                        foreach ($classes as $class) {
                            if ($request->audience == 1) {
                                $classId = $class->id;
                            } elseif ($request->audience == 2) {
                                $classId = $class;
                            }
                            $conn->table('calendors')->insert([
                                'title' => $title,
                                'class_id' => $classId,
                                'start' => $start_date,
                                'end' => $end_date,
                                'event_id' => $eventId,
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                        }
                    }
                }
            } else {
                // date converted into timestamp
                $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay()->toDateTimeString();
                $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay()->toDateTimeString();

                if ($request->audience == 3) {
                    $group = $request->group;
                    foreach ($group as $gro) {
                        $conn->table('calendors')->insert([
                            'title' => $title,
                            'start' => $start_date,
                            'end' => $end_date,
                            'group_id' => $gro,
                            'event_id' => $eventId,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                } else {
                    foreach ($classes as $class) {

                        if ($request->audience == 1) {
                            $classId = $class->id;
                        } elseif ($request->audience == 2) {
                            $classId = $class;
                        }
                        $conn->table('calendors')->insert([
                            'title' => $title,
                            'class_id' => $classId,
                            'start' => $start_date,
                            'end' => $end_date,
                            'event_id' => $eventId,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Event has been successfully saved');
            }
        }
    }
    // get Events 
    public function getEventList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $eventDetails = $conn->table('events')
                ->select("events.*", DB::raw("GROUP_CONCAT(DISTINCT  classes.name) as class_name"), 'event_types.name as type', DB::raw("GROUP_CONCAT(DISTINCT  groups.name) as group_name"))
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin("groups", \DB::raw("FIND_IN_SET(groups.id,events.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
                ->groupBy("events.id")
                ->orderBy('events.id', 'desc')
                ->get()->toArray();
            return $this->successResponse($eventDetails, 'Event record fetch successfully');
        }
    }
    // get Event row details
    public function getEventDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data

            $event_id = $request->id;
            $eventDetails = $conn->table('events')
                ->select("events.*", DB::raw("GROUP_CONCAT(DISTINCT  classes.name) as classname"), 'event_types.name as type_name')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,events.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin('event_types', 'event_types.id', '=', 'events.type')
                ->groupBy("events.id")
                ->where('events.id', $event_id)->first();
            return $this->successResponse($eventDetails, 'Event row fetch successfully');
        }
    }
    // update Event
    public function updateEvent(Request $request)
    {
        $id = $request->id;
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

        //    return $request;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            if ($request->audience == 2) {
                $selected_list = $request->event_class;
            } else if ($request->audience == 3) {
                $selected_list = $request->event_group;
            } else {
                $selected_list = NULL;
            }

            $allDay = $request->all_day;
            if ($allDay == NULL) {
                $eventSt = $request->start_time;
                $eventEt = $request->end_time;
            } else {
                $eventSt = NULL;
                $eventEt = NULL;
            }

            $query = $conn->table('events')->where('id', $id)->update([
                'title' => $request->title,
                'type' => $request->type,
                'audience' => $request->audience,
                'selected_list' => $selected_list,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $eventSt,
                'end_time' => $eventEt,
                'all_day' => $request->all_day,
                'remarks' => $request->description,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            // date converted into timestamp
            $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay()->toDateTimeString();
            $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay()->toDateTimeString();

            //delete old calendors
            $conn->table('calendors')->where('event_id', $id)->delete();

            $eventId = $id;
            $title = $request->title;
            if ($request->audience == 1) {
                $classes = $conn->table('classes')->get();
            } elseif ($request->audience == 2) {
                $classes = $request->class;
            }

            $allDay = $request->all_day;
            if ($allDay == NULL) {
                $begin = new DateTime($request->start_date);
                $end = new DateTime($request->end_date);

                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $interval, $end);

                $date = [];
                foreach ($period as $dt) {
                    $fd['start_date'] = $dt->format('Y-m-d') . ' ' . $request->start_time;
                    $fd['end_date'] = $dt->format("Y-m-d") . ' ' . $request->end_time;
                    array_push($date, $fd);
                }
                $final['start_date'] = $request->end_date . ' ' . $request->start_time;
                $final['end_date'] = $request->end_date . ' ' . $request->end_time;
                array_push($date, $final);

                if ($request->audience == 3) {
                    $group = $request->group;
                    foreach ($group as $gro) {
                        $conn->table('calendors')->insert([
                            'title' => $title,
                            'start' => $start_date,
                            'end' => $end_date,
                            'group_id' => $gro,
                            'event_id' => $eventId,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                } else {

                    foreach ($date as $d) {
                        $start_date = $d['start_date'];
                        $end_date = $d['end_date'];
                        foreach ($classes as $class) {
                            if ($request->audience == 1) {
                                $classId = $class->id;
                            } elseif ($request->audience == 2) {
                                $classId = $class;
                            }
                            $conn->table('calendors')->insert([
                                'title' => $title,
                                'class_id' => $classId,
                                'start' => $start_date,
                                'end' => $end_date,
                                'event_id' => $eventId,
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                        }
                    }
                }
            } else {
                // date converted into timestamp
                $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->startOfDay()->toDateTimeString();
                $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date)->endOfDay()->toDateTimeString();

                if ($request->audience == 3) {
                    $group = $request->group;
                    foreach ($group as $gro) {
                        $conn->table('calendors')->insert([
                            'title' => $title,
                            'start' => $start_date,
                            'end' => $end_date,
                            'group_id' => $gro,
                            'event_id' => $eventId,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                } else {
                    foreach ($classes as $class) {

                        if ($request->audience == 1) {
                            $classId = $class->id;
                        } elseif ($request->audience == 2) {
                            $classId = $class;
                        }
                        $conn->table('calendors')->insert([
                            'title' => $title,
                            'class_id' => $classId,
                            'start' => $start_date,
                            'end' => $end_date,
                            'event_id' => $eventId,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Event has been successfully Updated');
            }
        }
    }
    // delete Event
    public function deleteEvent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'branch_id' => 'required',
        ]);
        $event_id = $request->id;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $delete = $conn->table('calendors')->where('event_id', $event_id)->delete();
            $query = $conn->table('events')->where('id', $event_id)->delete();
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
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'status' => 'required',
            'branch_id' => 'required',
        ]);
        $event_id = $request->id;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            $query = $conn->table('events')->where('id', $event_id)->update([
                'status' => $request->status,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            if ($request->status == "1") {
                $status = "Published";
            } else {
                $status = "UnPublished";
            }
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Event have been ' . $status . ' successfully');
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
    // Qualification  start 

    // add qualification
    public function add_qualifications(Request $request)
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
            $qulifyConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($qulifyConn->table('qualifications')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $qulifyConn->table('qualifications')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Qualifications has been successfully saved');
                }
            }
        }
    }
    //view list qualification
    public function getQualificationsList(Request $request)
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
            $Department = $staffConn->table('qualifications')->get();

            return $this->successResponse($Department, 'Qualifications record fetch successfully');
        }
    }
    // update qualification
    public function updateQualifications(Request $request)
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
            if ($staffConn->table('qualifications')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('qualifications')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Qualifications Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete qualification
    public function deleteQualifications(Request $request)
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
            $query = $staffConn->table('qualifications')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Qualifications have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // get Qualifications row details
    public function getQualifications(Request $request)
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
            $deptDetails = $staffConn->table('qualifications')->where('id', $id)->first();
            return $this->successResponse($deptDetails, 'Qualifications row fetch successfully');
        }
    }
    // Qualifaication end

    // staff category start 
    // add qualification
    public function add_staffcategory(Request $request)
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
            $qulifyConn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($qulifyConn->table('staff_categories')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $qulifyConn->table('staff_categories')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'staff category has been successfully saved');
                }
            }
        }
    }
    //view list staffcategory
    public function getstaffcategory(Request $request)
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
            $Department = $staffConn->table('staff_categories')->get();

            return $this->successResponse($Department, 'staff categories record fetch successfully');
        }
    }
    // update staffcategory
    public function updatestaffcategory(Request $request)
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
            if ($staffConn->table('staff_categories')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $staffConn->table('staff_categories')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'staff categories Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete staffcategory
    public function deletestaffcategory(Request $request)
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
            $query = $staffConn->table('staff_categories')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'staff categories have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // get staffcategory row details
    public function getstaffcategory_details(Request $request)
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
            $deptDetails = $staffConn->table('staff_categories')->where('id', $id)->first();
            return $this->successResponse($deptDetails, 'staff categories row fetch successfully');
        }
    }

    // staff category end
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
    // delete department
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
    // get qualifications
    public function getQualificationsLst(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('qualifications')->select('id', 'name as qualification_name')->get();
            return $this->successResponse($StaffDepartment, 'Qualifications record fetch successfully');
        }
    }
    // staffCategories
    public function staffCategories(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('staff_categories')->select('id', 'name as staff_categories_name')->get();
            return $this->successResponse($StaffDepartment, 'Staff Categories record fetch successfully');
        }
    }
    // staffPositons
    public function staffPositions(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('staff_positions')->select('id', 'name as staff_positions_name')->get();
            return $this->successResponse($StaffDepartment, 'Staff Positons record fetch successfully');
        }
    }
    // streamTypes
    public function streamTypes(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('stream_types')->select('id', 'name as stream_types_name')->get();
            return $this->successResponse($StaffDepartment, 'Sream Types record fetch successfully');
        }
    }
    // getReligion
    public function getReligion(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('religions')->select('id', 'name as religions_name')->get();
            return $this->successResponse($StaffDepartment, 'Religions record fetch successfully');
        }
    }
    // streamTypes
    public function getRaces(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $StaffDepartment = $Connection->table('races')->select('id', 'name as races_name')->get();
            return $this->successResponse($StaffDepartment, 'Races record fetch successfully');
        }
    }
    // add Employee
    public function addEmployee(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'role_id' => 'required',
            'first_name' => 'required',
            // 'joining_date' => 'required',
            // 'designation_id' => 'required',
            // 'designation_id' => 'required',
            // 'race' => 'required',
            // 'name' => 'required',
            // 'gender' => 'required',
            // 'religion' => 'required',
            // 'birthday' => 'required',
            // 'mobile_no' => 'required',
            // 'present_address' => 'required',
            // 'permanent_address' => 'required',
            'email' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
            // 'post_code' => 'required',
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
                $existUser = $this->existUser($request->email);
                if ($existUser) {
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

                    if (isset($request->photo)) {
                        $now = now();
                        $name = strtotime($now);
                        $extension = $request->file_extension;
                        $fileName = $name . "." . $extension;

                        $base64 = base64_decode($request->photo);
                        $file = base_path() . '/public/images/staffs/' . $fileName;
                        $picture = file_put_contents($file, $base64);
                    } else {
                        $fileName = null;
                    }
                    // first letter word
                    // update data
                    $Staffid = $Connection->table('staffs')->insertGetId([
                        // 'staff_id' => $request->staff_id,
                        // 'name' => $request->name,
                        'first_name' => isset($request->first_name) ? $request->first_name : "",
                        'last_name' => isset($request->last_name) ? $request->last_name : "",
                        'short_name' => $request->short_name,
                        'employment_status' => $request->employment_status,
                        'department_id' => $request->department_id,
                        'designation_id' => $request->designation_id,
                        'staff_qualification_id' => $request->staff_qualification_id,
                        'stream_type_id' => $request->stream_type_id,
                        'race' => $request->race,
                        'joining_date' => $request->joining_date,
                        'birthday' => $request->birthday,
                        'gender' => $request->gender,
                        'religion' => $request->religion,
                        'blood_group' => $request->blood_group,
                        'present_address' => trim($request->present_address),
                        'permanent_address' => trim($request->permanent_address),
                        'mobile_no' => $request->mobile_no,
                        'email' => $request->email,
                        'photo' => $fileName,
                        'facebook_url' => $request->facebook_url,
                        'linkedin_url' => $request->linkedin_url,
                        'twitter_url' => $request->twitter_url,
                        'salary_grade' => isset($request->salary_grade) ? $request->salary_grade : "0",
                        'staff_position' => $request->staff_position,
                        'staff_category' => $request->staff_category,
                        'nric_number' => $request->nric_number,
                        'passport' => $request->passport,
                        'height' => isset($request->height) ? $request->height : "",
                        'weight' => isset($request->weight) ? $request->weight : "",
                        'allergy' => isset($request->allergy) ? $request->allergy : "",
                        'city' => $request->city,
                        'state' => $request->state,
                        'country' => $request->country,
                        'post_code' => $request->post_code,
                        'status' => $request->status,
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

                        $user->name = (isset($request->first_name) ? $request->first_name : "") . " " . (isset($request->last_name) ? $request->last_name : "");
                        $user->user_id = $Staffid;
                        $user->role_id = $request->role_id;
                        $user->branch_id = $request->branch_id;
                        $user->picture = $fileName;
                        $user->email = $request->email;
                        $user->status = $request->status;
                        $user->password = bcrypt($request->password);
                        $query = $user->save();
                        $success = [];
                        if (!$query) {
                            return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                        } else {
                            return $this->successResponse($success, 'Employee has been successfully saved');
                        }
                    }
                } else {
                    return $this->send500Error('Users already exist', ['error' => 'Users already exist']);
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
            ->select(
                DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"),
                's.id',
                's.short_name',
                's.salary_grade',
                's.email',
                's.mobile_no',
                's.photo',
                'stp.name as stream_type',
                DB::raw("GROUP_CONCAT(DISTINCT  dp.name) as department_name"),
                DB::raw("GROUP_CONCAT(DISTINCT  ds.name) as designation_name")
            )
            ->leftJoin("staff_departments as dp", DB::raw("FIND_IN_SET(dp.id,s.department_id)"), ">", DB::raw("'0'"))
            ->leftJoin("staff_designations as ds", DB::raw("FIND_IN_SET(ds.id,s.designation_id)"), ">", DB::raw("'0'"))
            ->leftJoin('stream_types as stp', 's.stream_type_id', '=', 'stp.id')
            ->orderBy('stp.name', 'desc')
            ->orderBy('s.salary_grade', 'desc')
            ->groupBy("s.id")
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
            $empDetails['staff'] = $staffConn->table('staffs as s')
                ->select(
                    's.*',
                    DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"),
                    DB::raw("GROUP_CONCAT(DISTINCT  dp.name) as department_name")
                )
                ->leftJoin("staff_departments as dp", DB::raw("FIND_IN_SET(dp.id,s.department_id)"), ">", DB::raw("'0'"))
                ->where('s.id', $id)
                ->first();
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
            'id' => 'required',
            'role_id' => 'required',
            'first_name' => 'required',
            // 'joining_date' => 'required',
            // 'designation_id' => 'required',
            // 'designation_id' => 'required',
            // 'name' => 'required',
            // 'gender' => 'required',
            'email' => 'required',
            'role_user_id' => 'required',
            // 'religion' => 'required',
            // 'birthday' => 'required',
            // 'mobile_no' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
            // 'post_code' => 'required',
            // 'present_address' => 'required',
            // 'permanent_address' => 'required',
            // 'race' => 'required',
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

                if (isset($request->old_photo) && empty($request->photo)) {
                    $fileName = $request->old_photo;
                } else {
                    if (isset($request->photo)) {
                        $now = now();
                        $name = strtotime($now);
                        $extension = $request->file_extension;
                        $fileName = $name . "." . $extension;

                        $base64 = base64_decode($request->photo);
                        $file = base_path() . '/public/images/staffs/' . $fileName;
                        $picture = file_put_contents($file, $base64);
                    } else {
                        $fileName = null;
                    }
                }
                // update data
                $query = $Connection->table('staffs')->where('id', $id)->update([
                    // 'staff_id' => $request->staff_id,
                    // 'name' => $request->name,
                    'first_name' => isset($request->first_name) ? $request->first_name : "",
                    'last_name' => isset($request->last_name) ? $request->last_name : "",
                    'short_name' => $request->short_name,
                    'employment_status' => $request->employment_status,
                    'department_id' => $request->department_id,
                    'designation_id' => $request->designation_id,
                    'staff_qualification_id' => $request->staff_qualification_id,
                    'stream_type_id' => $request->stream_type_id,
                    'race' => $request->race,
                    'joining_date' => $request->joining_date,
                    'birthday' => $request->birthday,
                    'gender' => $request->gender,
                    'religion' => $request->religion,
                    'blood_group' => $request->blood_group,
                    'present_address' => trim($request->present_address),
                    'permanent_address' => trim($request->permanent_address),
                    'mobile_no' => $request->mobile_no,
                    'email' => $request->email,
                    'photo' => $fileName,
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'twitter_url' => $request->twitter_url,
                    'salary_grade' => isset($request->salary_grade) ? $request->salary_grade : "0",
                    'staff_position' => $request->staff_position,
                    'staff_category' => $request->staff_category,
                    'nric_number' => $request->nric_number,
                    'height' => isset($request->height) ? $request->height : "",
                    'weight' => isset($request->weight) ? $request->weight : "",
                    'allergy' => isset($request->allergy) ? $request->allergy : "",
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'post_code' => $request->post_code,
                    'passport' => isset($request->passport) ? $request->passport : "",
                    'status' => $request->status,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong on Update employee']);
                } else {
                    // update users
                    if (isset($request->role_user_id) && isset($request->password)) {
                        $user = User::find($request->role_user_id);
                        $user->email = $request->email;
                        $user->name = (isset($request->first_name) ? $request->first_name : "") . " " . (isset($request->last_name) ? $request->last_name : "");
                        $user->picture = $fileName;
                        $user->password = bcrypt($request->password);
                        $user->status = $request->status;
                        $updateUser = $user->save();
                    }
                    if (isset($request->role_user_id) && isset($request->email)) {
                        $user = User::find($request->role_user_id);
                        $user->name = (isset($request->first_name) ? $request->first_name : "") . " " . (isset($request->last_name) ? $request->last_name : "");
                        $user->email = $request->email;
                        $user->picture = $fileName;
                        $user->status = $request->status;
                        $updateUser = $user->save();
                    }
                    if (isset($request->old_photo) && empty($request->photo)) {
                        $user = User::find($request->role_user_id);
                        $user->name = (isset($request->first_name) ? $request->first_name : "") . " " . (isset($request->last_name) ? $request->last_name : "");
                        $user->picture = $fileName;
                        $user->status = $request->status;
                        $updateUser = $user->save();
                    }
                    // add bank details
                    if ($request->skip_bank_details == 1) {
                        $bankRow = $Connection->table('staff_bank_accounts')->where('staff_id', $id)->first();
                        if (isset($bankRow->id)) {
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
                        } else {
                            $bank = $Connection->table('staff_bank_accounts')->insert([
                                'staff_id' => $id,
                                'bank_name' => $request->bank_name,
                                'holder_name' => $request->holder_name,
                                'bank_branch' => $request->bank_branch,
                                'bank_address' => $request->bank_address,
                                'ifsc_code' => $request->ifsc_code,
                                'account_no' => $request->account_no,
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                        }
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
    public function examByClassSubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
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
                ->where('subject_id', '=', $request->subject_id)
                ->groupBy('exam.name')
                ->get();
            return $this->successResponse($getExamsName, 'Exams  list of Name record fetch successfully');
        }
    }
    // by class single
    public function totgradeCalcuByClass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data             

            $grade_list_master = array();
            $allbysubject = array();
            $total_classes_section = $Connection->table('section_allocations')
                ->select('class_id', 'section_id')
                ->get();
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'section_id as section_id',
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('class_id', '=', $request->class_id)
                ->where('subject_id', '=', $request->subject_id)
                ->get();
            //array_push($teachers_list, $getteachername);

            // common grade list 
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $grade_count_list_master = count($getmastergrade);


            // dd($total_sujects_teacher);
            foreach ($total_sujects_teacher as $key => $val) {
                $object = new \stdClass();
                $section_id = $val->section_id;
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                $object->teacher_name = $teacher_name;
                $object->subject_name = $subject_name;
                $object->grad_count_master = $grade_count_list_master;
                // class name and section name
                $getstudentcount = $Connection->table('enrolls')
                    ->select(
                        'classes.name',
                        'sections.name as section_name',
                        DB::raw('COUNT(student_id) as "totalStudentCount"')
                    )
                    ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
                    ->leftJoin('sections', 'enrolls.section_id', '=', 'sections.id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $section_id)
                    ->get();
                $object->totalstudentcount = $getstudentcount;

                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $section_id)
                    ->where('subject_id', '=', $request->subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);
                // Not matched subject division table go 2 if 
                if ($subject_division_matched == 0) {
                    $getexamattendance = $Connection->table('student_marks')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $request->subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_marks')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                } else if ($subject_division_matched > 0) {

                    $getexamattendance = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                }
            }
            // array_push($allbysubject,$grade_list_master);
            // dd($allbysubject);
            return $this->successResponse($allbysubject, 'byclass all Post record fetch successfully');
        }
    }
    // by class all 
    public function allstdlist(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'subject_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data             

            $grade_list_master = array();
            $allbysubject = array();
            $total_classes_section = $Connection->table('section_allocations')
                ->select('class_id', 'section_id')
                ->get();
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'class_id as class_id',
                    'section_id as section_id',
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('subject_id', '=', $request->subject_id)
                ->get();
            //array_push($teachers_list, $getteachername);

            // common grade list 
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $grade_count_list_master = count($getmastergrade);


            // dd($total_sujects_teacher);
            foreach ($total_sujects_teacher as $key => $val) {
                $object = new \stdClass();
                $class_id =  $val->class_id;
                $section_id = $val->section_id;
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                $object->teacher_name = $teacher_name;
                $object->subject_name = $subject_name;
                $object->grad_count_master = $grade_count_list_master;
                // class name and section name
                $getstudentcount = $Connection->table('enrolls')
                    ->select(
                        'classes.name',
                        'sections.name as section_name',
                        DB::raw('COUNT(student_id) as "totalStudentCount"')
                    )
                    ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
                    ->leftJoin('sections', 'enrolls.section_id', '=', 'sections.id')
                    ->where('class_id', '=', $class_id)
                    ->where('section_id', '=', $section_id)
                    ->get();
                $object->totalstudentcount = $getstudentcount;

                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $class_id)
                    ->where('section_id', '=', $section_id)
                    ->where('subject_id', '=', $request->subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);
                // Not matched subject division table go 2 if 
                if ($subject_division_matched == 0) {
                    $getexamattendance = $Connection->table('student_marks')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $request->subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_marks')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $request->subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                } else if ($subject_division_matched > 0) {

                    $getexamattendance = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $request->subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $request->subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                }
            }
            // array_push($allbysubject,$grade_list_master);
            // dd($allbysubject);
            return $this->successResponse($allbysubject, 'byclass all Post record fetch successfully');
        }
    }
    // by subject  single 
    public function totgradeCalcuBySubject(Request $request)
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

            $grade_list_master = array();
            $allbysubject = array();
            $total_classes_section = $Connection->table('section_allocations')
                ->select('class_id', 'section_id')
                ->get();
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name')
                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->get();
            //array_push($teachers_list, $getteachername);

            // common grade list 
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $grade_count_list_master = count($getmastergrade);


            // dd($total_sujects_teacher);
            foreach ($total_sujects_teacher as $key => $val) {
                $object = new \stdClass();
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                $object->teacher_name = $teacher_name;
                $object->subject_name = $subject_name;
                $object->grad_count_master = $grade_count_list_master;
                // class name and section name
                $getstudentcount = $Connection->table('enrolls')
                    ->select(
                        'classes.name',
                        'sections.name as section_name',
                        DB::raw('COUNT(student_id) as "totalStudentCount"')
                    )
                    ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
                    ->leftJoin('sections', 'enrolls.section_id', '=', 'sections.id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $request->section_id)
                    ->get();
                $object->totalstudentcount = $getstudentcount;
                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $request->section_id)
                    ->where('subject_id', '=', $subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);
                // Not matched subject division table go 2 if 
                if ($subject_division_matched == 0) {
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
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_marks')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $request->section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;

                    array_push($allbysubject, $object);
                } else if ($subject_division_matched > 0) {

                    $getexamattendance = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $request->section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        ->where('section_id', '=', $request->section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                }
            }

            return $this->successResponse($allbysubject, 'bysubject all Post record fetch successfully');
        }
    }
    // by subject  all 
    public function allbysubjectlist(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data     
            $allbysubject = array();
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'class_id as class_id',
                    'section_id as section_id',
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),

                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                // ->where('class_id', '=', $request->class_id)
                // ->where('section_id', '=', $request->section_id)
                ->get();
            // common grade list 
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $grade_count_list_master = count($getmastergrade);
            // dd($total_sujects_teacher);
            foreach ($total_sujects_teacher as $key => $val) {
                $object = new \stdClass();
                $class_id = $val->class_id;
                $section_id = $val->section_id;
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                $object->teacher_name = $teacher_name;
                $object->subject_name = $subject_name;
                $object->grad_count_master = $grade_count_list_master;
                // class name and section name
                $getstudentcount = $Connection->table('enrolls')
                    ->select(
                        'classes.name',
                        'sections.name as section_name',
                        DB::raw('COUNT(student_id) as "totalStudentCount"')
                    )
                    ->leftJoin('classes', 'enrolls.class_id', '=', 'classes.id')
                    ->leftJoin('sections', 'enrolls.section_id', '=', 'sections.id')
                    ->where('class_id', '=', $class_id)
                    ->where('section_id', '=', $section_id)
                    ->get();
                $object->totalstudentcount = $getstudentcount;
                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $class_id)
                    ->where('section_id', '=', $section_id)
                    ->where('subject_id', '=', $subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);

                if ($subject_division_matched == 0) {

                    $getexamattendance = $Connection->table('student_marks')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;
                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_marks')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                } else if ($subject_division_matched > 0) {

                    $getexamattendance = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $class_id)
                        ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                }
            }


            return $this->successResponse($allbysubject, 'bysubject all Post record fetch successfully');
        }
    }
    //by student single
    public function totgradeCalcuByStudent(Request $request)
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
            $allbyStudent = array();

            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->get();
            $obj_header = new \stdClass();

            $getotal_subject = $Connection->table('student_marks')
                ->select(
                    'subject_id'
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('subject_id')
                ->get();
            $subject_count = count($getotal_subject);
            $obj_header->total_subject_count = $subject_count;

            $getheaders = $Connection->table('student_marks')
                ->select(
                    DB::raw('group_concat(student_marks.subject_id) as subject_id'),
                    DB::raw('group_concat(subjects.name) as subject_name')
                )
                ->leftJoin('subjects', 'student_marks.subject_id', '=', 'subjects.id')

                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('student_marks.student_id')
                ->first();
            $obj_header->sub_header = $getheaders;



            array_push($allbyStudent, $obj_header);
            $getexam_total_student = $Connection->table('student_marks')
                ->select(
                    'students.id as student_id',
                    'students.first_name',
                    'students.register_no',
                    'student_marks.score',
                    'student_marks.grade',
                    'student_marks.pass_fail'
                )
                ->leftJoin('students', 'student_marks.student_id', '=', 'students.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                //->where('student_id', '=', )
                ->groupBy('students.id')
                ->get();

            $sno = 0;
            $studentmark_sno = 0;
            $student_subjectdiv = 0;
            foreach ($total_sujects_teacher as $key => $val) {
                $sno++;

                $object = new \stdClass();
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                //   $object->subject_name = $subject_name;


                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $request->section_id)
                    ->where('subject_id', '=', $subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);
                // Not matched subject division table go 2 if 

                if ($subject_division_matched == 0) {
                    $studentmark_sno++;

                    if ($studentmark_sno == 1) {

                        foreach ($getexam_total_student as $key => $val) {

                            $obj = new \stdClass();
                            $student_id = $val->student_id;

                            $getexamgrademarks = $Connection->table('student_marks')
                                ->select(
                                    'students.id as student_id',
                                    'students.first_name',
                                    'students.register_no',
                                    // DB::raw('CONCAT(student_marks.score as score)','CONCAT(student_marks.grade as grade)'),
                                    DB::raw("group_concat(student_marks.score,',',student_marks.grade) as scoremarks"),
                                    DB::raw('group_concat(student_marks.subject_id) as subject_id'),
                                    DB::raw('group_concat(subjects.name) as subject_name'),
                                    DB::raw('group_concat(student_marks.score) as score'),
                                    DB::raw('group_concat(student_marks.grade) as grade'),
                                    // DB::raw('GROUP_CONCAT(student_marks.score ',') as s_score'),
                                    // DB::raw('GROUP_CONCAT(student_marks.grade ',') as s_grade'),
                                    // 'student_marks.score',
                                    // 'student_marks.grade',
                                    'student_marks.pass_fail'
                                )
                                ->leftJoin('students', 'student_marks.student_id', '=', 'students.id')
                                ->leftJoin('subjects', 'student_marks.subject_id', '=', 'subjects.id')

                                ->where('class_id', '=', $request->class_id)
                                ->where('section_id', '=', $request->section_id)
                                ->where('exam_id', '=', $request->exam_id)
                                ->where('student_id', '=', $student_id)
                                ->groupBy('student_marks.student_id')
                                ->get();
                            $obj->both_exam_marksgrade = $getexamgrademarks;
                            $count = count($getexamgrademarks);
                            array_push($allbyStudent, $obj);
                        }
                    }
                } else if ($subject_division_matched > 0) {
                    $student_subjectdiv++;
                    if ($student_subjectdiv == 1) {
                        foreach ($getexam_total_student as $key => $val) {
                            $obj_sub_div = new \stdClass();
                            $student_id = $val->student_id;
                            $getexamgrademarks_subdiv = $Connection->table('student_subjectdivision_inst')
                                ->select(
                                    'students.id as student_id',
                                    'students.first_name',
                                    'students.register_no',
                                    DB::raw("group_concat(student_subjectdivision_inst.total_score,',',student_subjectdivision_inst.grade) as scoremarks"),
                                    'student_subjectdivision_inst.pass_fail'
                                )
                                ->leftJoin('students', 'student_subjectdivision_inst.student_id', '=', 'students.id')
                                ->leftJoin('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')

                                ->where('class_id', '=', $request->class_id)
                                ->where('section_id', '=', $request->section_id)
                                ->where('exam_id', '=', $request->exam_id)
                                ->where('student_id', '=', $student_id)
                                ->get();
                            $obj_sub_div->both_exam_marksgrade = $getexamgrademarks_subdiv;
                            // array_push($allbyStudent, $obj_sub_div);
                        }
                    }
                }
            }
            //   dd($allbyStudent);
            return $this->successResponse($allbyStudent, 'bystudent all Post record fetch successfully');
        }
    }
    // by student single subject div
    public function totgradecalcubyStudent_subjectdiv(Request $request)
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
            $allbyStudent = array();
            $lef_class_id = $request->class_id;
            $lef_section_id = $request->class_id;
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'subjects.id as subject_id',

                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),

                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')

                ->where('subject_assigns.class_id', '=', $request->class_id)
                ->where('subject_assigns.section_id', '=', $request->section_id)
                ->get();
            $obj_header = new \stdClass();

            $getotal_subject = $Connection->table('student_subjectdivision_inst')
                ->select(
                    'subject_id'
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('subject_id')
                ->get();
            $subject_count = count($getotal_subject);
            $obj_header->total_subject_count = $subject_count;

            $getheaders = $Connection->table('student_subjectdivision_inst')
                ->select(
                    DB::raw('group_concat(student_subjectdivision_inst.subject_id) as subject_id'),
                    DB::raw('group_concat(subjects.name) as subject_name'),
                    'subject_division',
                    'subjectdivision_scores'
                    // 'subdiv.subject_division as master_subject_div',
                )
                ->leftJoin('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')
                // ->leftJoin('student_subjectdivision as subdiv', function ($join) use ($lef_class_id,$lef_section_id) {
                //     $join->on('student_subjectdivision_inst.subject_id', '=', 'subdiv.subject_id')
                //         ->where('subdiv.class_id', '=', DB::raw("'$lef_class_id'"))
                //         ->where('subdiv.section_id', '=', DB::raw("'$lef_section_id'")
                //     );
                //})

                ->where('student_subjectdivision_inst.class_id', '=', $request->class_id)
                ->where('student_subjectdivision_inst.section_id', '=', $request->section_id)
                ->where('student_subjectdivision_inst.exam_id', '=', $request->exam_id)
                ->groupBy('student_subjectdivision_inst.student_id')
                ->first();
            $obj_header->sub_header = $getheaders;
            array_push($allbyStudent, $obj_header);
            $getexam_total_student = $Connection->table('student_marks')
                ->select(
                    'students.id as student_id',
                    'students.first_name',
                    'students.register_no',
                    'student_marks.score',
                    'student_marks.grade',
                    'student_marks.pass_fail'
                )
                ->leftJoin('students', 'student_marks.student_id', '=', 'students.id')
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                //->where('student_id', '=', )
                ->groupBy('students.id')
                ->get();

            $sno = 0;

            $student_subjectdiv = 0;
            foreach ($total_sujects_teacher as $key => $val) {
                $sno++;
                $subject_id = $val->subject_id;

                //   $object->subject_name = $subject_name;


                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $request->class_id)
                    ->where('section_id', '=', $request->section_id)
                    ->where('subject_id', '=', $subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);
                // Not matched subject division table go 2 if 
                if ($subject_division_matched > 0) {

                    $student_subjectdiv++;
                    if ($student_subjectdiv == 1) {

                        foreach ($getexam_total_student as $key => $val) {
                            $obj_sub_div = new \stdClass();
                            $student_id = $val->student_id;
                            $getexamgrademarks_subdiv = $Connection->table('student_subjectdivision_inst')
                                ->select(
                                    'students.id as student_id',
                                    'students.first_name',
                                    'students.register_no',
                                    DB::raw("group_concat(student_subjectdivision_inst.total_score,',',student_subjectdivision_inst.grade) as scoremarks"),
                                    'subject_division',
                                    'subjectdivision_scores',
                                    'student_subjectdivision_inst.pass_fail'
                                )
                                ->leftJoin('students', 'student_subjectdivision_inst.student_id', '=', 'students.id')
                                ->leftJoin('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')

                                ->where('class_id', '=', $request->class_id)
                                ->where('section_id', '=', $request->section_id)
                                ->where('exam_id', '=', $request->exam_id)
                                ->where('student_id', '=', $student_id)
                                ->get();
                            $obj_sub_div->both_exam_marksgrade = $getexamgrademarks_subdiv;
                            array_push($allbyStudent, $obj_sub_div);
                        }
                    }
                }
            }

            return $this->successResponse($allbyStudent, 'bystudent subject division Post record fetch successfully');
        }
    }
    // over all 
    public function tot_grade_calcu_overall(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
            'exam_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data     
            $allbysubject = array();
            $total_sujects_teacher = $Connection->table('subject_assigns')
                ->select(
                    'class_id as class_id',
                    'section_id as section_id',
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'staffs.id as staff_id',
                    DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name')
                )
                ->leftJoin('staffs', 'subject_assigns.teacher_id', '=', 'staffs.id')
                ->leftJoin('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('class_id', '=', $request->class_id)
                ->groupBy('subjects.id')
                ->get();
            // common grade list 

            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $grade_count_list_master = count($getmastergrade);

            // dd($total_sujects_teacher);
            foreach ($total_sujects_teacher as $key => $val) {
                $object = new \stdClass();
                $class_id = $val->class_id;
                $section_id = $val->section_id;
                $subject_id = $val->subject_id;
                $staff_id = $val->staff_id;
                $subject_name = $val->subject_name;
                $teacher_name = $val->teacher_name;

                $object->teacher_name = $teacher_name;
                $object->subject_name = $subject_name;
                $object->grad_count_master = $grade_count_list_master;
                // class name and section name

                // subject division table check subject id is there 
                $subject_division_tbl = $Connection->table('student_subjectdivision')
                    ->select('subject_division', 'credit_point', 'semester_id')
                    ->where('class_id', '=', $request->class_id)
                    // ->where('section_id', '=', $section_id)
                    ->where('subject_id', '=', $subject_id)
                    ->get();
                $subject_division_matched = count($subject_division_tbl);

                if ($subject_division_matched == 0) {
                    $getstudentcount = $Connection->table('student_marks')
                        ->select(
                            'classes.name',
                            'sections.name as section_name',
                            DB::raw('COUNT(student_id) as "totalStudentCount"')
                        )
                        ->leftJoin('classes', 'student_marks.class_id', '=', 'classes.id')
                        ->leftJoin('sections', 'student_marks.section_id', '=', 'sections.id')
                        ->where('class_id', '=', $request->class_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->totalstudentcount = $getstudentcount;

                    $getexamattendance = $Connection->table('student_marks')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $request->class_id)
                        // ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;
                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_marks')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        // ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                } else if ($subject_division_matched > 0) {

                    $getstudentcount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'classes.name',
                            'sections.name as section_name',
                            DB::raw('COUNT(student_id) as "totalStudentCount"')
                        )
                        ->leftJoin('classes', 'student_subjectdivision_inst.class_id', '=', 'classes.id')
                        ->leftJoin('sections', 'student_subjectdivision_inst.section_id', '=', 'sections.id')
                        ->where('class_id', '=', $request->class_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->totalstudentcount = $getstudentcount;
                    $getexamattendance = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            DB::raw('SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) AS absent'),
                            DB::raw('SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) AS present'),
                            DB::raw('SUM(CASE WHEN pass_fail = "pass" THEN 1 ELSE 0 END) AS pass'),
                            DB::raw('SUM(CASE WHEN pass_fail = "fail" THEN 1 ELSE 0 END) AS fail')
                        )
                        ->where('class_id', '=', $request->class_id)
                        //->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->get();
                    $object->attendance_list = $getexamattendance;

                    $count = count($getexamattendance);
                    $getgradecount = $Connection->table('student_subjectdivision_inst')
                        ->select(
                            'grade as gname',
                            DB::raw('COUNT(*) as "gradecount"')
                        )
                        ->where('class_id', '=', $request->class_id)
                        // ->where('section_id', '=', $section_id)
                        ->where('exam_id', '=', $request->exam_id)
                        ->where('subject_id', '=', $subject_id)
                        ->groupBy('grade')
                        ->get();
                    $object->grade_count_list = $getgradecount;
                    array_push($allbysubject, $object);
                }
            }


            return $this->successResponse($allbysubject, 'bysubject all Post record fetch successfully');
        }
    }
    // by subject chart 
    public function getGradebysubject(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            // get data     
            $allbygradecount = array();
            $object = new \stdClass();
            // common grade list 
            $getmastergrade = $Connection->table('grade_marks')
                ->select(
                    'id',
                    'grade',
                    'grade_point'
                )
                ->get();
            $getgradecount_nosubj_studmarks = $Connection->table('student_marks')
                ->select(
                    'grade as gname',
                    DB::raw('COUNT(*) as "gradecount"')
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('grade')
                ->get();
            $object->grade_count_list_stdmarks = $getgradecount_nosubj_studmarks;
            $getgradecount_nosubj_division = $Connection->table('student_subjectdivision_inst')
                ->select(
                    'grade as gname',
                    DB::raw('COUNT(*) as "gradecount"')
                )
                ->where('class_id', '=', $request->class_id)
                ->where('section_id', '=', $request->section_id)
                ->where('exam_id', '=', $request->exam_id)
                ->groupBy('grade')
                ->get();
            $object->grade_count_list_subdivision = $getgradecount_nosubj_division;
            $grade_count_list_master = count($getmastergrade);
            // dd($total_sujects_teacher);
            array_push($allbygradecount, $object);

            $commondetails = [
                "getgradecount_nosubj_studmarks" => $getgradecount_nosubj_studmarks,
                "getgradecount_nosubj_division" => $getgradecount_nosubj_division


            ];
            //  dd($commondetails);
            return $this->successResponse($commondetails, 'bysubject all Post record fetch successfully');
        }
    }
    // Individual Result 
    public function getbyresult_student(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'registerno' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection    
            $Connection = $this->createNewConnection($request->branch_id);
            // get data   

            $student_marks_result = array();
            $object = new \stdClass();
            $object_sub_division = new \stdClass();
            $object_general_details = new \stdClass();
            //  $student_id=$Connection->table("students")->Select('id')->where('register_no','=',$request->registerno);
            $student_id = $Connection->table('students')->Select('id', 'first_name', 'birthday')
                ->where('register_no', '=', $request->registerno)
                ->first();

            $student_marks = $Connection->table("student_marks")
                ->select(
                    'students.first_name',
                    'students.birthday',
                    'classes.name as class_name',
                    'sections.name as section_name',
                    DB::raw("group_concat(student_marks.subject_id) as subject_id"),
                    DB::raw("group_concat(subjects.name) as subject_names"),
                    //DB::raw("group_concat(student_marks.score,',',student_marks.grade) as scoregrade")
                    DB::raw("group_concat(student_marks.grade) as grade"),
                    DB::raw("sum(grade_marks.grade_point) as gradepoint"),
                    'pass_fail'

                )
                ->leftJoin('grade_marks', 'student_marks.grade', '=', 'grade_marks.grade')
                ->leftJoin('students', 'student_marks.student_id', '=', 'students.id')
                ->leftJoin('subjects', 'student_marks.subject_id', '=', 'subjects.id')
                ->leftJoin('classes', 'student_marks.class_id', '=', 'classes.id')
                ->leftJoin('sections', 'student_marks.section_id', '=', 'sections.id')
                ->where([
                    ['student_marks.student_id', $student_id->id],
                    ['student_marks.class_id', $request->class_id],
                    ['student_marks.section_id', $request->section_id],
                    ['student_marks.exam_id', $request->exam_id]
                ])
                ->get();
            $object->student_marks_details = $student_marks;
            array_push($student_marks_result, $object);
            //dd($student_marks_result);
            // subject division table 
            $student_marks_sub_division = $Connection->table("student_subjectdivision_inst")
                ->select(
                    'students.first_name',
                    'students.birthday',
                    'classes.name as class_name',
                    'sections.name as section_name',

                    'subjectdivision_scores',
                    'subject_division',
                    DB::raw("group_concat(student_subjectdivision_inst.subject_id) as subject_id_division"),
                    DB::raw("group_concat(subjects.name) as subject_names_division"),
                    //DB::raw("group_concat(student_subjectdivision_inst.total_score,',',student_subjectdivision_inst.grade) as scoregrade_division"),
                    DB::raw("group_concat(student_subjectdivision_inst.total_score) as total_score_division"),
                    DB::raw("group_concat(student_subjectdivision_inst.grade) as grade_division"),
                    DB::raw("sum(grade_marks.grade_point) as gradepoint_division"),
                    'pass_fail',

                )
                ->leftJoin('grade_marks', 'student_subjectdivision_inst.grade', '=', 'grade_marks.grade')
                ->leftJoin('students', 'student_subjectdivision_inst.student_id', '=', 'students.id')
                ->leftJoin('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')
                ->leftJoin('classes', 'student_subjectdivision_inst.class_id', '=', 'classes.id')
                ->leftJoin('sections', 'student_subjectdivision_inst.section_id', '=', 'sections.id')
                ->where([
                    ['student_subjectdivision_inst.student_id', $student_id->id],
                    ['student_subjectdivision_inst.class_id', $request->class_id],
                    ['student_subjectdivision_inst.section_id', $request->section_id],
                    ['student_subjectdivision_inst.exam_id', $request->exam_id]
                ])
                ->get();

            $object_sub_division->student_marks_subdivision_details = $student_marks_sub_division;
            // genral details 

            array_push($student_marks_result, $object_sub_division);
            $object_general_details->student_general_details = $student_id;
            array_push($student_marks_result, $object_general_details);

            return $this->successResponse($student_marks_result, 'student result record fetch successfully');
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
    public function allexamslist(Request $request)
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
            $getmastergrade = $Connection->table('exam')
                ->select(
                    'id',
                    'name'
                )
                ->get();
            return $this->successResponse($getmastergrade, 'exam list record fetch successfully');
        }
    }

    // subjectByClass 
    public function subjectByClass(Request $request)
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
            $classConn = $this->createNewConnection($request->branch_id);
            // get data
            // $teacher_id = "All";
            // if (isset($request->teacher_id)) {
            //     $teacher_id = $request->teacher_id;
            // }

            $class_id = $request->class_id;
            $class = $classConn->table('subject_assigns as sa')->select('s.id as subject_id', 's.name as subject_name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')

                // ->when($teacher_id != "All", function ($ins)  use ($teacher_id) {
                //     $ins->where('sa.teacher_id', $teacher_id);
                // })
                // ->where('sa.class_id', $class_id)
                ->where([
                    ['sa.type', '=', '0'],
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id]
                ])
                // ->groupBy('s.id')
                ->get();
            return $this->successResponse($class, 'Subject Name fetch successfully');
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

            $Timetable = $classConn->table('timetable_class')->select(
                'timetable_class.*',
                DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                'subjects.name as subject_name'
            )
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
            $output['teacher'] = $classConn->table('subject_assigns as sa')->select(
                's.id',
                DB::raw('CONCAT(s.first_name, " ", s.last_name) as name')
            )
                ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                // type zero mean main
                ->where('sa.type', '=', '0')
                ->groupBy('sa.teacher_id')
                ->get();
            $output['subject'] = $classConn->table('subject_assigns as sa')->select('s.id', 's.name')
                ->join('subjects as s', 'sa.subject_id', '=', 's.id')
                ->where('sa.class_id', $request->class_id)
                ->where('sa.section_id', $request->section_id)
                ->where('sa.type', '=', '0')
                // get teacher 
                // ->where('sa.teacher_id', '!=', '0')
                ->get();
            $output['exam_hall'] = $classConn->table('exam_hall')->get();

            return $this->successResponse($output, 'Teacher and Subject record fetch successfully');
        }
    }

    // Timetable Subject Bulk
    public function timetableSubjectBulk(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // return $request;
            // create new connection
            $classConn = $this->createNewConnection($request->branch_id);
            $class_id = $request->class_id;

            $Timetable = $classConn->table('timetable_bulk')->select(
                'timetable_bulk.*',
                DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name')
            )
                ->leftJoin('staffs', 'timetable_bulk.teacher_id', '=', 'staffs.id')
                ->where([
                    ['timetable_bulk.day', $request->day],
                    ['timetable_bulk.class_id', $request->class_id],
                    ['timetable_bulk.semester_id', $request->semester_id],
                    ['timetable_bulk.session_id', $request->session_id],
                ])
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get()->toArray();
            $output['timetable'] = $Timetable;
            $output['teacher'] = $classConn->table('subject_assigns as sa')->select(
                's.id',
                DB::raw('CONCAT(s.first_name, " ", s.last_name) as name')
            )
                ->join('staffs as s', 'sa.teacher_id', '=', 's.id')
                ->when($class_id != "All", function ($q)  use ($class_id) {
                    $q->where('sa.class_id', $class_id);
                })
                // type zero mean main
                ->where('sa.type', '=', '0')
                ->groupBy('sa.teacher_id')
                ->get();
            $output['exam_hall'] = $classConn->table('exam_hall')->get();

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
            // dd($getObjRow);
            $timetable = $request->timetable;
            $oldest = $staffConn->table('timetable_class')->where([['class_id', $request->class_id], ['section_id', $request->section_id], ['semester_id', $request->semester_id], ['session_id', $request->session_id], ['day', $request->day]])->WhereNull('bulk_id')->get()->toArray();

            // return $oldest;
            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));

            if (isset($diff)) {
                foreach ($diff as $del) {

                    // $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
                    // // delete calendor data
                    // $staffConn->table('calendors')->where('time_table_id', $del)->delete();
                    if ($staffConn->table('timetable_class')->where('id', '=', $del)->count() > 0) {
                        // record found
                        // echo "time table" . $del;
                        $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
                    }
                    // delete calendor data
                    if ($staffConn->table('calendors')->where('time_table_id', '=', $del)->count() > 0) {
                        // record found
                        // dd($del);
                        // echo "calendor" . $del;
                        $staffConn->table('calendors')->where('time_table_id', $del)->delete();
                    }
                }
            }

            // return $timetable;

            foreach ($timetable as $table) {

                // return $table;
                $session_id = 0;
                $semester_id = 0;

                $break_type = NULL;
                $break = 0;
                $subject_id = 0;
                $teacher_id = NULL;


                if (isset($request['session_id'])) {
                    $session_id = $request['session_id'];
                }
                if (isset($request['semester_id'])) {
                    $semester_id = $request['semester_id'];
                }
                if (isset($table['break_type'])) {
                    $break_type = $table['break_type'];
                }
                if (isset($table['break'])) {
                    $break = 1;
                }
                if (!empty($table['teacher'])) {
                    $teacher_id =  implode(",", $table['teacher']);
                }
                if (isset($table['subject'])) {
                    $subject_id = $table['subject'];
                }
                //  dd($break_type);
                $insertOrUpdateID = 0;
                if (isset($table['id'])) {
                    // echo "<pre>";
                    // echo $teacher_id;
                    $query = $staffConn->table('timetable_class')->where('id', $table['id'])->update([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => $break,
                        'break_type' => $break_type,
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
                    // echo "<pre>";
                    // echo $teacher_id;
                    $query = $staffConn->table('timetable_class')->insertGetId([
                        'class_id' => $request['class_id'],
                        'section_id' => $request['section_id'],
                        'break' => $break,
                        'break_type' => $break_type,
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
                $bulkID = NuLL;
                // return $break;
                $this->addCalendorTimetable($request, $table, $getObjRow, $insertOrUpdateID, $bulkID);
            }
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'TimeTable has been successfully saved');
            }
        }
    }

    // add Bulk Timetable
    public function addBulkTimetable(Request $request)
    {

        // dd($request);
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'class_id' => 'required',
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
            $oldest = $staffConn->table('timetable_bulk')->where([['class_id', $request->class_id], ['semester_id', $request->semester_id], ['session_id', $request->session_id], ['day', $request->day]])->get()->toArray();

            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));

            if (isset($diff)) {
                foreach ($diff as $del) {

                    if ($staffConn->table('timetable_class')->where('bulk_id', '=', $del)->count() > 0) {
                        $delete =  $staffConn->table('timetable_class')->where('bulk_id', $del)->get();
                        // delete calendor data
                        foreach ($delete as $d) {
                            if ($staffConn->table('calendors')->where('time_table_id', '=', $d->id)->count() > 0) {
                                $staffConn->table('calendors')->where('time_table_id', $d->id)->delete();
                            }
                        }

                        // delete timetable data
                        $staffConn->table('timetable_class')->where('bulk_id', $del)->delete();
                    }

                    if ($staffConn->table('timetable_bulk')->where('id', '=', $del)->count() > 0) {
                        // record found
                        $staffConn->table('timetable_bulk')->where('id', $del)->delete();
                    }
                }
            }
            foreach ($timetable as $table) {

                // return $table;
                $session_id = 0;
                $semester_id = 0;

                $break_type = NULL;
                $break = 0;
                $teacher_id = NULL;


                if (isset($request['session_id'])) {
                    $session_id = $request['session_id'];
                }
                if (isset($request['semester_id'])) {
                    $semester_id = $request['semester_id'];
                }
                if (isset($table['break_type'])) {
                    $break_type = $table['break_type'];
                }
                if (isset($table['break'])) {
                    $break = 1;
                }
                if (!empty($table['teacher'])) {
                    $teacher_id =  implode(",", $table['teacher']);
                }
                //  dd($break_type);
                $bulkID = 0;
                if (isset($table['id'])) {
                    // echo "<pre>";
                    // echo $teacher_id;
                    $query = $staffConn->table('timetable_bulk')->where('id', $table['id'])->update([
                        'class_id' => $request['class_id'],
                        'break' => $break,
                        'break_type' => $break_type,
                        'teacher_id' => $teacher_id,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'semester_id' => $semester_id,
                        'session_id' => $session_id,
                        'day' => $request['day'],
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                    $timeTableUpdate = $staffConn->table('timetable_class')->where('bulk_id', $table['id'])->update([
                        'break' => $break,
                        'break_type' => $break_type,
                        'teacher_id' => $teacher_id,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'type' => "All",
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);

                    $bulkID = $table['id'];
                    $class = $staffConn->table('timetable_class')->where('bulk_id', $bulkID)->get();
                    if ($class) {
                        foreach ($class as $cla) {
                            $timeTableID = $cla->id;
                            $request['section_id'] = "$cla->section_id";
                            // update calendor
                            $this->addCalendorTimetable($request, $table, $getObjRow, $timeTableID, $bulkID);
                        }
                    }

                    // $calendorUpdate = $staffConn->table('calendors')->where('bulk_id', $table['id'])->update([

                    //     "title" =>  $break_type,
                    //     'teacher_id' => $teacher_id,
                    //     'updated_at' => date("Y-m-d H:i:s"),
                    // ]);
                } else {
                    // echo "<pre>";
                    // echo $teacher_id;
                    $query = $staffConn->table('timetable_bulk')->insertGetId([
                        'class_id' => $request['class_id'],
                        'break' => $break,
                        'break_type' => $break_type,
                        'teacher_id' => $teacher_id,
                        'class_room' => $table['class_room'],
                        'time_start' => $table['time_start'],
                        'time_end' => $table['time_end'],
                        'semester_id' => $semester_id,
                        'session_id' => $session_id,
                        'day' => $request['day'],
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                    $bulkID = $query;

                    $class = [];
                    // fetch class and section
                    if ($request['class_id'] == "All") {
                        $class = $staffConn->table('section_allocations')->select('class_id', 'section_id')->get();
                    } else {
                        $class = $staffConn->table('section_allocations')->select('class_id', 'section_id')->where('class_id', $request['class_id'])->get();
                    }
                    if ($class) {
                        foreach ($class as $cla) {
                            $timeTableID = $staffConn->table('timetable_class')->insertGetId([
                                'class_id' => $cla->class_id,
                                'section_id' => $cla->section_id,
                                'break' => $break,
                                'break_type' => $break_type,
                                'teacher_id' => $teacher_id,
                                'class_room' => $table['class_room'],
                                'time_start' => $table['time_start'],
                                'time_end' => $table['time_end'],
                                'semester_id' => $semester_id,
                                'session_id' => $session_id,
                                'day' => $request['day'],
                                'bulk_id' => $bulkID,
                                'type' => "All",
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
                            $request['class_id'] = "$cla->class_id";
                            $request['section_id'] = "$cla->section_id";
                            // update calendor
                            $this->addCalendorTimetable($request, $table, $getObjRow, $timeTableID, $bulkID);
                        }
                    }
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
            $Timetable = $con->table('timetable_class')->select(
                'timetable_class.*',
                DB::raw('GROUP_CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                'subjects.name as subject_name',
                'exam_hall.hall_no'
            )
                // ->leftJoin('staffs', 'timetable_class.teacher_id', '=', 'staffs.id')
                ->leftJoin("staffs", DB::raw("FIND_IN_SET(staffs.id,timetable_class.teacher_id)"), ">", DB::raw("'0'"))
                ->leftJoin('subjects', 'timetable_class.subject_id', '=', 'subjects.id')
                ->leftJoin('exam_hall', 'timetable_class.class_room', '=', 'exam_hall.id')
                ->where([
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->groupBy("timetable_class.id")
                ->get()->toArray();

            if ($Timetable) {
                $mapfunction = function ($s) {
                    return $s->day;
                };
                $count = array_count_values(array_map($mapfunction, $Timetable));
                $max = max($count);

                $output['timetable'] = $Timetable;
                $output['max'] = $max;
                $output['week'] = $count;
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

            $Timetable = $con->table('timetable_class')->select(
                'timetable_class.*',
                DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                'subjects.name as subject_name'
            )
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
            // dd($Timetable);
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

                $output['teacher'] = $con->table('subject_assigns as sa')->select(
                    's.id',
                    DB::raw('CONCAT(s.first_name, " ", s.last_name) as name')
                )
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
                $output['exam_hall'] = $con->table('exam_hall')->get();

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
            // return $getObjRow;
            $oldest = $staffConn->table('timetable_class')
                ->where([
                    ['timetable_class.day', $request->day],
                    ['timetable_class.class_id', $request->class_id],
                    ['timetable_class.semester_id', $request->semester_id],
                    ['timetable_class.session_id', $request->session_id],
                    ['timetable_class.section_id', $request->section_id]
                ])
                ->WhereNull('bulk_id')
                ->get()->toArray();
            // dd($oldest);
            $diff = array_diff(array_column($oldest, 'id'), array_column($timetable, 'id'));
            // dd($diff);
            if (isset($diff)) {
                foreach ($diff as $del) {
                    // dd($del);
                    if ($staffConn->table('timetable_class')->where('id', '=', $del)->count() > 0) {
                        // record found
                        // echo "time table" . $del;
                        $delete =  $staffConn->table('timetable_class')->where('id', $del)->delete();
                    }
                    // delete calendor data
                    if ($staffConn->table('calendors')->where('time_table_id', '=', $del)->count() > 0) {
                        // record found
                        // dd($del);
                        // echo "calendor" . $del;
                        $staffConn->table('calendors')->where('time_table_id', $del)->delete();
                    }
                }
            }

            // exit;

            foreach ($timetable as $table) {

                $session_id = 0;
                $semester_id = 0;
                // $break;
                // $subject_id;
                // $teacher_id;
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
                    if (!empty($table['teacher'])) {
                        $teacher_id =  implode(",", $table['teacher']);
                    }
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
                $bulkID = NULL;
                $this->addCalendorTimetable($request, $table, $getObjRow, $insertOrUpdateID, $bulkID);
            }

            $success = [];
            return $this->successResponse($success, 'TimeTable has been Update Successfully');
            // if (!$query) {
            //     return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            // } else {
            //     return $this->successResponse($success, 'TimeTable has been Update Successfully');
            // }
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

            $Timetable = $con->table('timetable_class')->select(
                'timetable_class.*',
                DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                'subjects.name as subject_name'
            )
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

            $Timetable = $con->table('timetable_class')->select(
                'timetable_class.*',
                DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as teacher_name'),
                'subjects.name as subject_name'
            )
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
    // changeLogo settings
    public function changeLogo(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
            'change_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            $path = 'images/sub-logo/';
            $file = $request->file('change_logo');
            $new_name = 'ULOGO_' . date('Ymd') . uniqid() . '.jpg';

            //Upload new image
            $upload = $file->move(public_path($path), $new_name);

            if (!$upload) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong, upload new picture failed.']);
            } else {
                //Get Old picture
                $oldPicture = Branches::find($request->id)->getAttributes()['logo'];

                if ($oldPicture != '') {
                    if (\File::exists(public_path($path . $oldPicture))) {
                        \File::delete(public_path($path . $oldPicture));
                    }
                }
                //Update DB
                $update = Branches::find($request->id)->update(['logo' => $new_name]);
                $data = [
                    "logo" => $new_name
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
                    ['sa.type', '=', '0'],
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
                    ['sa.type', '=', '0'],
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.teacher_id', '=', $request->teacher_id]
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    DB::raw('CONCAT(st.first_name, " ", st.last_name) as name'),
                    'st.register_no',
                    'sa.id as att_id',
                    'sa.status as att_status',
                    'sa.remarks as att_remark',
                    'sa.date',
                    'sa.student_behaviour',
                    'sa.classroom_behaviour',
                    'sa.reasons',
                    'st.birthday',
                    'st.photo'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('student_attendances as sa', function ($q) use ($date, $subject_id, $semester_id, $session_id) {
                    $q->on('sa.student_id', '=', 'st.id')
                        ->on('sa.date', '=', DB::raw("'$date'"))
                        ->on('sa.subject_id', '=', DB::raw("'$subject_id'"))
                        ->on('sa.semester_id', '=', DB::raw("'$semester_id'"))
                        ->on('sa.session_id', '=', DB::raw("'$session_id'"));
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id],
                    ['en.semester_id', '=', $request->semester_id],
                    ['en.session_id', '=', $request->session_id]
                ])
                ->get();
            return $this->successResponse($getTeachersClassName, 'Attendance record fetch successfully');
        }
    }
    // getReturnLayoutMode
    function getReturnLayoutMode(Request $request)
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
            $Connection = $this->createNewConnection($request->branch_id);
            $getTeachersClassName = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.roll',
                    DB::raw('CONCAT(st.first_name, " ", st.last_name) as name'),
                    'st.register_no',
                    'sa.id as att_id',
                    'sa.status as att_status',
                    'sa.remarks as att_remark',
                    'sa.date',
                    'sa.student_behaviour',
                    'sa.classroom_behaviour',
                    'sa.reasons',
                    'st.birthday',
                    'st.photo',
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('student_attendances as sa', function ($q) use ($date, $subject_id, $semester_id, $session_id) {
                    $q->on('sa.student_id', '=', 'st.id')
                        ->on('sa.date', '=', DB::raw("'$date'"))
                        ->on('sa.subject_id', '=', DB::raw("'$subject_id'"))
                        ->on('sa.semester_id', '=', DB::raw("'$semester_id'"))
                        ->on('sa.session_id', '=', DB::raw("'$session_id'"));
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id],
                    ['en.semester_id', '=', $request->semester_id],
                    ['en.session_id', '=', $request->session_id]
                ])
                ->get();
            return $getTeachersClassName;
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
            $date = $request->date;
            // $data = [];
            foreach ($attendance as $key => $value) {
                // dd($value['attendance_id']);
                // dd($value);
                $attStatus = (isset($value['att_status']) ? $value['att_status'] : "");
                $att_remark = (isset($value['att_remark']) ? $value['att_remark'] : "");
                $reasons = (isset($value['reasons']) ? $value['reasons'] : "");
                $student_behaviour = (isset($value['student_behaviour']) ? $value['student_behaviour'] : "");
                $classroom_behaviour = (isset($value['classroom_behaviour']) ? $value['classroom_behaviour'] : "");
                // $student_behaviour = $value['student_behaviour'];
                // $classroom_behaviour = $value['classroom_behaviour'];
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
                    'semester_id' => $semester_id,
                    'session_id' => $session_id,
                    'created_at' => date("Y-m-d H:i:s")

                );
                if ((empty($value['attendance_id']) || $value['attendance_id'] == "null")) {
                    // echo "sdjfsjfsjs";exit;
                    // return "fjsdjfsdjf";
                    if ($Connection->table('student_attendances')->where([
                        ['date', '=', $date],
                        ['class_id', '=', $class_id],
                        ['section_id', '=', $section_id],
                        ['subject_id', '=', $subject_id],
                        ['semester_id', '=', $semester_id],
                        ['session_id', '=', $session_id],
                        ['student_id', '=', $value['student_id']]
                    ])->count() > 0) {

                        $row = $Connection->table('student_attendances')->select('id')->where([
                            ['date', '=', $date],
                            ['class_id', '=', $class_id],
                            ['section_id', '=', $section_id],
                            ['subject_id', '=', $subject_id],
                            ['semester_id', '=', $semester_id],
                            ['session_id', '=', $session_id],
                            ['student_id', '=', $value['student_id']]
                        ])->first();
                        $Connection->table('student_attendances')->where('id', $row->id)->update([
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
                    // return "sdd";

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

            $data = $this->getReturnLayoutMode($request);
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
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
                    DB::raw('CONCAT(st.first_name, " ", st.last_name) as name'),
                    'st.register_no',
                    'sht.id as short_test_id',
                    'sht.test_marks',
                    'sht.grade_status',
                    'sht.date',
                    'sht.test_name',
                    'st.photo'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->leftJoin('short_tests as sht', function ($q) use ($date, $subject_id, $semester_id, $session_id) {
                    $q->on('sht.student_id', '=', 'st.id')
                        ->on('sht.date', '=', DB::raw("'$date'"))
                        ->on('sht.subject_id', '=', DB::raw("'$subject_id'"))
                        ->on('sht.semester_id', '=', DB::raw("'$semester_id'"))
                        ->on('sht.session_id', '=', DB::raw("'$session_id'"));
                })
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id],
                    ['en.semester_id', '=', $request->semester_id],
                    ['en.session_id', '=', $request->session_id]
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
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
                    'semester_id' => $semester_id,
                    'session_id' => $session_id,
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
                'semester_id' => $request->semester_id,
                'session_id' => $request->session_id,
                'date' => $request->date,
                'report' => $request->daily_report,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $checkExist = $Connection->table('daily_reports')->where([
                ['date', '=', $request->date],
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id],
                ['semester_id', '=', $request->semester_id],
                ['session_id', '=', $request->session_id]
            ])->first();
            // dd($checkExist);
            if ($Connection->table('daily_reports')->where([
                ['date', '=', $request->date],
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id],
                ['semester_id', '=', $request->semester_id],
                ['session_id', '=', $request->session_id]

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
                    DB::raw('CONCAT(st.first_name, " ", st.last_name) as name'),
                    'dr.student_remarks',
                    'dr.teacher_remarks',
                    'dr.id',
                    'st.photo'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->join('daily_report_remarks as dr', 'dr.student_id', '=', 'en.student_id')
                ->where([
                    ['dr.class_id', '=', $request->class_id],
                    ['dr.section_id', '=', $request->section_id],
                    ['dr.subject_id', '=', $request->subject_id],
                    ['dr.semester_id', '=', $request->semester_id],
                    ['dr.session_id', '=', $request->session_id]
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
                    ['dr.semester_id', '=', $request->semester_id],
                    ['dr.session_id', '=', $request->session_id],
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
            $semester_id = $request->semester_id;
            $session_id = $request->session_id;
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
                    'semester_id' => $semester_id,
                    'session_id' => $session_id,
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
                'semester_id' =>  $request->semester_id,
                'session_id' =>  $request->session_id,
                'date' =>  $request->date,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $daily_report_remarks = $Connection->table('daily_report_remarks')->where([
                ['class_id', '=', $request->class_id],
                ['section_id', '=', $request->section_id],
                ['subject_id', '=', $request->subject_id],
                ['semester_id', '=', $request->semester_id],
                ['date', '=', $request->date],
                ['session_id', '=', $request->session_id]
            ])->first();
            if (isset($daily_report_remarks->id)) {
                $Connection->table('daily_report_remarks')->where('id', $daily_report_remarks->id)->update([
                    "student_id" => $request->student_id,
                    'student_remarks' => $request->student_remarks,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' =>  $request->subject_id,
                    'semester_id' =>  $request->semester_id,
                    'session_id' =>  $request->session_id,
                    'date' =>  $request->date,
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
                    ['sa.semester_id', '=', $request->semester_id],
                    ['sa.session_id', '=', $request->session_id]
                    // ['sa.date', '=', $request->date]
                ])
                ->whereBetween(DB::raw('date(date)'), [$startDate, $endDate])
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
                    ['sa.semester_id', '=', $request->semester_id],
                    ['sa.session_id', '=', $request->session_id]
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
                    ['sa.semester_id', '=', $request->semester_id],
                    ['sa.session_id', '=', $request->session_id]
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
                    ['en.section_id', '=', $request->section_id],
                    ['en.semester_id', '=', $request->semester_id],
                    ['en.session_id', '=', $request->session_id]
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
                    ['tc.semester_id', '=', $request->semester_id],
                    ['tc.session_id', '=', $request->session_id]
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
                ->select(
                    'cl.id',
                    'cl.class_id',
                    'cl.time_table_id',
                    'cl.section_id',
                    'cl.subject_id',
                    'cl.start',
                    'cl.event_id',
                    'cl.end',
                    's.name as section_name',
                    'c.name as class_name',
                    'sb.subject_color_calendor as color',
                    'sb.name as subject_name',
                    'sb.name as title',
                    'st.first_name as teacher_name',
                    'dr.report'
                    // 'en.session_id',
                    // 'en.semester_id'
                )
                ->join('classes as c', 'cl.class_id', '=', 'c.id')
                ->join('sections as s', 'cl.section_id', '=', 's.id')
                ->join('staffs as st', 'cl.teacher_id', '=', 'st.id')
                // ->join('enrolls as en', function ($join) {
                //     $join->on('en.class_id', '=', 'c.id')
                //         ->on('en.section_id', '=', 's.id');
                // })
                ->leftJoin('daily_reports as dr', function ($join) {
                    $join->on('cl.class_id', '=', 'dr.class_id')
                        ->on('cl.section_id', '=', 'dr.section_id')
                        ->on('cl.subject_id', '=', 'dr.subject_id')
                        ->on(DB::raw('date(cl.end)'), '=', 'dr.date');
                })
                ->join('subjects as sb', 'cl.subject_id', '=', 'sb.id')
                ->whereRaw("find_in_set($request->teacher_id,cl.teacher_id)")
                ->get();
            return $this->successResponse($success, 'calendor data get successfully');
        }
    }
    // getBirthdayCalendorTeacher
    public function getBirthdayCalendorTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'teacher_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $date = now()->format('Y-m-d h:i:s');
            $day = now()->format('d');
            $month = now()->format('m');
            $Connection = $this->createNewConnection($request->branch_id);
            $birthday = $Connection->table('staffs as s')
                ->select('s.id', 's.first_name as name', 's.birthday')
                ->whereMonth("s.birthday", $month)
                ->whereDay("s.birthday", $day)
                ->where('id', $request->teacher_id)
                ->get();
            $success = [];
            foreach ($birthday as $birth) {
                $data = new \stdClass();
                $data->id = $birth->id;
                $data->birthday = $birth->birthday;
                $data->title = $birth->name . " Happy Birthday";
                $data->start = $date;
                $data->end = $date;
                $data->className = "bg-success";
                array_push($success, $data);
            }
            return $this->successResponse($success, 'Birthday Calendor data get successfully');
        }
    }
    // getBirthdayCalendorAdmin
    public function getBirthdayCalendorAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $date = now()->format('Y-m-d h:i:s');
            $day = now()->format('d');
            $month = now()->format('m');
            $Connection = $this->createNewConnection($request->branch_id);
            $birthday = $Connection->table('staffs as s')
                ->select('s.id', 's.first_name as name', 's.birthday')
                ->whereMonth("s.birthday", $month)
                ->whereDay("s.birthday", $day)
                ->get();
            $success = [];
            foreach ($birthday as $birth) {
                // $data = $birth;
                $data = new \stdClass();
                $data->id = $birth->id;
                $data->birthday = $birth->birthday;
                $data->title = $birth->name . " Happy Birthday";
                $data->start = $date;
                $data->end = $date;
                $data->className = "bg-success";
                array_push($success, $data);
            }
            // dd($success);

            return $this->successResponse($success, 'Birthday Calendor data get successfully');
        }
    }

    // getEventCalendor
    public function getEventCalendor(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'teacher_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // ->leftJoin('subject_assigns as s', function ($join) use ($teacherId) {
            //     $join->on('e.selected_list', '=', 's.class_id')
            //         ->where('s.teacher_id', $teacherId);
            // })
            // // ->when('e.auidence' == "1", function ($q)  use ($teacherId) {
            // //     $q->where('s.teacher_id', $teacherId);
            // // })->leftJoin('events as e', 'c.event_id', '=', 'e.id')
            $Connection = $this->createNewConnection($request->branch_id);
            $teacherId = $request->teacher_id;
            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  classes.name) as class_name"), 'et.color', 'c.title', 'c.title as subject_name', 'c.class_id', 's.teacher_id', 'c.start', 'c.end', 'c.event_id', 'et.name as event_type', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                ->leftJoin('subject_assigns as s', 'c.class_id', '=', 's.class_id')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.event_id')
                ->whereNull('c.group_id')
                ->where('e.status', 1)
                ->where('s.teacher_id', $teacherId)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();
            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($success, 'Event data Fetched successfully');
        }
    }
    // getEventCalendorStud
    public function getEventCalendorStud(Request $request)
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
            $studentId = $request->student_id;
            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  classes.name) as class_name"), 'et.color', 'c.title', 'c.title as subject_name', 'c.class_id', 'en.student_id', 'c.start', 'c.end', 'et.name as event_type', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                ->leftJoin('enrolls as en', 'c.class_id', '=', 'en.class_id')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.event_id')
                ->whereNull('c.group_id')
                ->where('en.student_id', $studentId)
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();
            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($success, 'Event data Fetched successfully');
        }
    }
    // getEventCalendorAdmin
    public function getEventCalendorAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  classes.name) as class_name"), 'et.color', 'c.title', 'c.title as subject_name', 'et.name as event_type', 'c.class_id', 'c.start', 'c.end', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("classes", \DB::raw("FIND_IN_SET(classes.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.event_id')
                ->whereNull('c.group_id')
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();


            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($success, 'Event data Fetched successfully');
        }
    }

    // getEventGroupCalendor
    public function getEventGroupCalendor(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'teacher_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            // ->leftJoin('subject_assigns as s', function ($join) use ($teacherId) {
            //     $join->on('e.selected_list', '=', 's.class_id')
            //         ->where('s.teacher_id', $teacherId);
            // })
            // // ->when('e.auidence' == "1", function ($q)  use ($teacherId) {
            // //     $q->where('s.teacher_id', $teacherId);
            // // })->leftJoin('events as e', 'c.event_id', '=', 'e.id')
            $Connection = $this->createNewConnection($request->branch_id);
            $teacherId = $request->teacher_id;

            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  g.name) as class_name"), 'et.color', 'c.title', 'c.title as subject_name', 'et.name as event_type', 'c.class_id', 'c.start', 'c.end', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                // ->leftJoin('groups as g', 'c.group_id', '=', 'g.id')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("groups as g", \DB::raw("FIND_IN_SET( g.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin("staffs as s", \DB::raw("FIND_IN_SET(s.id,g.staff)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.group_id')
                ->where('s.id', $teacherId)
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();


            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($event, 'Event data Fetched successfully');
        }
    }

    // getEventGroupCalendorStud
    public function getEventGroupCalendorStud(Request $request)
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
            $studentId = $request->student_id;
            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT g.name) as class_name"), DB::raw("GROUP_CONCAT(DISTINCT en.student_id) as stud_id"), 'et.color', 'c.title', 'c.title as subject_name', 'c.class_id', 'c.start', 'c.end', 'et.name as event_type', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                // ->leftJoin('groups as g', 'c.group_id', '=', 'g.id')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftJoin('groups as g', DB::raw("FIND_IN_SET(g.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->leftJoin('enrolls as en', \DB::raw("FIND_IN_SET(en.student_id,g.student)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.group_id')
                ->where('en.student_id', $studentId)
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();
            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($event, 'Event data Fetched successfully');
        }
    }

    // getEventGroupCalendorAdmin
    public function getEventGroupCalendorAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  groups.name) as class_name"), 'c.group_id', 'et.color', 'c.title', 'c.title as subject_name', 'et.name as event_type', 'c.class_id', 'c.start', 'c.end', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("groups", \DB::raw("FIND_IN_SET(groups.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->whereNotNull('c.group_id')
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();


            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($success, 'Event data Fetched successfully');
        }
    }

    // getEventGroupCalendorParent
    public function getEventGroupCalendorParent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'parent_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $parentId = $request->parent_id;

            $event = $Connection->table('calendors as c')
                ->select('c.id', DB::raw("GROUP_CONCAT(DISTINCT  g.name) as class_name"), 'c.group_id', 'et.color', 'c.title', 'c.title as subject_name', 'et.name as event_type', 'c.class_id', 'c.start', 'c.end', 'e.id as event_id', 'e.remarks', 'e.audience', 'e.selected_list', 'e.all_day', 'e.start_time', 'e.end_time', 'e.start_date', 'e.end_date')
                // ->leftJoin('groups as g', 'c.group_id', '=', 'g.id')
                ->leftJoin('events as e', 'c.event_id', '=', 'e.id')
                ->leftJoin('event_types as et', 'e.type', '=', 'et.id')
                ->leftjoin("groups as g", \DB::raw("FIND_IN_SET( g.id,e.selected_list)"), ">", \DB::raw("'0'"))
                ->leftjoin("parent as p", \DB::raw("FIND_IN_SET(p.id,g.parent)"), ">", \DB::raw("'0'"))
                ->where('p.id', $parentId)
                ->whereNotNull('c.group_id')
                ->where('e.status', 1)
                ->groupBy('c.event_id')
                ->groupBy('c.start')
                ->get();


            $success = [];
            foreach ($event as $eve) {
                $data = $eve;
                if ($eve->audience == "1") {
                    $data->class_name = "EveryOne";
                }
                array_push($success, $data);
            }
            return $this->successResponse($event, 'Event data Fetched successfully');
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
            $studentID = $request->student_id;
            $success = $Connection->table('students as stud')
                ->select(
                    'cl.id',
                    'cl.class_id',
                    'cl.time_table_id',
                    'cl.section_id',
                    'cl.subject_id',
                    'cl.start',
                    'cl.end',
                    'en.semester_id',
                    'en.session_id',
                    's.name as section_name',
                    'c.name as class_name',
                    'sb.subject_color_calendor as color',
                    'sb.name as subject_name',
                    'sb.name as title',
                    DB::raw("CONCAT(st.first_name, ' ', st.last_name) as teacher_name"),
                    'drr.student_remarks'
                )
                ->join('enrolls as en', 'en.student_id', '=', 'stud.id')
                ->join('classes as c', 'en.class_id', '=', 'c.id')
                ->join('sections as s', 'en.section_id', '=', 's.id')
                ->leftJoin('subject_assigns as sa', function ($join) {
                    $join->on('sa.class_id', '=', 'en.class_id')
                        ->on('sa.section_id', '=', 'en.section_id');
                })
                ->join('calendors as cl', function ($join) {
                    $join->on('cl.class_id', '=', 'sa.class_id')
                        ->on('cl.section_id', '=', 'sa.section_id')
                        ->on('cl.subject_id', '=', 'sa.subject_id');
                })
                ->join('subjects as sb', 'sa.subject_id', '=', 'sb.id')
                ->join('staffs as st', 'sa.teacher_id', '=', 'st.id')
                ->leftJoin('daily_report_remarks as drr', function ($join) use ($studentID) {
                    $join->on('cl.class_id', '=', 'drr.class_id')
                        ->on('cl.section_id', '=', 'drr.section_id')
                        ->on('cl.subject_id', '=', 'drr.subject_id')
                        ->on(DB::raw('DATE(cl.start)'), '=', 'drr.date')
                        ->on('drr.student_id', '=', DB::raw("'$studentID'"));
                })
                ->where('stud.id', $request->student_id)
                ->get();
            return $this->successResponse($success, 'student calendor data get successfully');
        }
    }
    // addCalendorTimetable
    // function addCalendorTimetable(Request $request)
    function addCalendorTimetable($request, $row, $getObjRow, $insertOrUpdateID, $bulkID)
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
                    $this->addTimetableCalendor($request, $startDate, $endDate, $day, $row, $insertOrUpdateID, $bulkID);
                }
            }
        }
    }
    // addTimetableCalendor
    function addTimetableCalendor($request, $startDate, $endDate, $day, $row, $insertOrUpdateID, $bulkID)
    {
        // create new connection
        $Connection = $this->createNewConnection($request->branch_id);
        // delete existing calendor data
        $calendors = $Connection->table('calendors')->where([
            ['time_table_id', '=', $insertOrUpdateID]
        ])->count();
        if ($calendors > 0) {
            $Connection->table('calendors')->where('time_table_id', $insertOrUpdateID)->delete();
            // $Connection->table('calendors')->where('id', $calendors->id)->update([
            //     "subject_id" => $row['subject'],
            //     "teacher_id" => $row['teacher'],
            //     "sem_id" => $request['semester_id'],
            //     "start" => $start,
            //     "end" => $end,
            //     'updated_at' => date("Y-m-d H:i:s")
            // ]);
        }

        // dd($request);
        if (isset($row['subject']) && isset($row['teacher'])) {
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
                        // "teacher_id" => $row['teacher'],
                        "teacher_id" => implode(",", $row['teacher']),
                        "start" => $start,
                        "end" => $end,
                        "time_table_id" => $insertOrUpdateID,
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                    // return $arrayInsert;

                    $Connection->table('calendors')->insert($arrayInsert);
                }
                $startDate->modify('+1 day');
            }
        }

        if (isset($row['teacher']) && !isset($row['break'])) {
            while ($startDate <= $endDate) {
                if ($startDate->format('w') == $day) {
                    $start = $startDate->format('Y-m-d') . " " . $row['time_start'];
                    $end = $startDate->format('Y-m-d') . " " . $row['time_end'];
                    $arrayInsert = [
                        "title" =>  $row['break_type'],
                        "class_id" => $request['class_id'],
                        "section_id" => $request['section_id'],
                        "sem_id" => $request['semester_id'],
                        // "teacher_id" => $row['teacher'],
                        "teacher_id" => implode(",", $row['teacher']),
                        "start" => $start,
                        "end" => $end,
                        "time_table_id" => $insertOrUpdateID,
                        "bulk_id" => $bulkID,
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                    // return $arrayInsert;
                    $check = $Connection->table('calendors')->insert($arrayInsert);
                }
                $startDate->modify('+1 day');
            }
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



        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            $exams = $request['exam'];
            // insert data

            // return $exams;
            foreach ($exams as $exam) {
                $mark = json_encode($exam['mark']);

                $distributor = $exam['distributor'];


                if ($exam['distributor_type'] == "1") {

                    $data = $con->table('staffs as s')->select('s.id',  DB::raw('CONCAT(s.first_name, " ", s.last_name) as name'),)
                        ->where('id', $exam['distributor'])
                        ->first();

                    $distributor = $data->name;
                }
                if ($exam['timetable_exam_id']) {
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

                    $insertValidator = \Validator::make($exam, [
                        'subject_id' => 'required',
                        'time_start' => 'required',
                        'time_end' => 'required',
                        'hall_id' => 'required',
                        'distributor_type' => 'required',
                        'distributor' => 'required',
                        'exam_date' => 'required',
                    ]);

                    // return $insertValidator;
                    if ($insertValidator->passes()) {
                        // return $exam;
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
                ->join('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->join('classes', 'subject_assigns.class_id', '=', 'classes.id')
                ->join('sections', 'subject_assigns.section_id', '=', 'sections.id')
                ->where([
                    ['subject_assigns.class_id', $request->class_id],
                    ['subject_assigns.section_id', $request->section_id],
                    ['subjects.exam_exclude', '=', '0']
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
    // addHostel
    public function addHostel(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('hostel')->insert([
                    'name' => $request->name,
                    'category_id' => $request->category,
                    'watchman' => $request->watchman,
                    'address' => $request->address,
                    'remarks' => $request->remarks,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Hostel has been successfully saved');
                }
            }
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
            $Hostel = $Conn->table('hostel')->select('hostel_category.name as category', 'hostel.*')->leftJoin('hostel_category', 'hostel.category_id', '=', 'hostel_category.id')->get();
            return $this->successResponse($Hostel, 'Hostel record fetch successfully');
        }
    }
    // get Hostel row details
    public function getHostelDetails(Request $request)
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
            $HostelDetails = $conn->table('hostel')->where('id', $id)->first();
            return $this->successResponse($HostelDetails, 'Hostel row fetch successfully');
        }
    }
    // update Hostel
    public function updateHostel(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('hostel')->where('id', $id)->update([
                    'name' => $request->name,
                    'category_id' => $request->category,
                    'watchman' => $request->watchman,
                    'address' => $request->address,
                    'remarks' => $request->remarks,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Hostel Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Hostel
    public function deleteHostel(Request $request)
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
            $query = $conn->table('hostel')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addHostelRoom
    public function addHostelRoom(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'hostel_id' => 'required',
            'no_of_beds' => 'required',
            'block' => 'required',
            'floor' => 'required',
            'bed_fee' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel_room')->where([['name', $request->name], ['block', $request->block]])->count() > 0) {
                return $this->send422Error('Room Already Exist', ['error' => 'Room Already Exist']);
            } else {
                // insert data
                $query = $conn->table('hostel_room')->insert([
                    'name' => $request->name,
                    'hostel_id' => $request->hostel_id,
                    'no_of_beds' => $request->no_of_beds,
                    'block' => $request->block,
                    'floor' => $request->floor,
                    'bed_fee' => $request->bed_fee,
                    'remarks' => $request->remarks,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Hostel Room has been successfully saved');
                }
            }
        }
    }
    // getHostelRoomList
    public function getHostelRoomList(Request $request)
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
            $HostelRoomDetails = $conn->table('hostel_room')->select('hostel_room.*', 'hostel.name as hostel')->leftJoin('hostel', 'hostel_room.hostel_id', '=', 'hostel.id')->get();
            return $this->successResponse($HostelRoomDetails, 'Hostel Room record fetch successfully');
        }
    }
    // get HostelRoom row details
    public function getHostelRoomDetails(Request $request)
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
            $HostelRoomDetails = $conn->table('hostel_room')->where('id', $id)->first();
            return $this->successResponse($HostelRoomDetails, 'Hostel Room row fetch successfully');
        }
    }
    // update HostelRoom
    public function updateHostelRoom(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'hostel_id' => 'required',
            'no_of_beds' => 'required',
            'block' => 'required',
            'floor' => 'required',
            'bed_fee' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel_room')->where([['name', '=', $request->name], ['block', $request->block], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Room Already Exist', ['error' => 'Room Already Exist']);
            } else {
                // update data
                $query = $conn->table('hostel_room')->where('id', $id)->update([
                    'name' => $request->name,
                    'hostel_id' => $request->hostel_id,
                    'no_of_beds' => $request->no_of_beds,
                    'block' => $request->block,
                    'floor' => $request->floor,
                    'bed_fee' => $request->bed_fee,
                    'remarks' => $request->remarks,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Hostel Room Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete HostelRoom
    public function deleteHostelRoom(Request $request)
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
            $query = $conn->table('hostel_room')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Room have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addHostelCategory
    public function addHostelCategory(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel_category')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {

                // insert data
                $query = $conn->table('hostel_category')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Hostel Category has been successfully saved');
                }
            }
        }
    }
    // getHostelCategoryList
    public function getHostelCategoryList(Request $request)
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
            $HostelCategoryDetails = $conn->table('hostel_category')->get();
            return $this->successResponse($HostelCategoryDetails, 'Hostel Category record fetch successfully');
        }
    }
    // get HostelCategory row details
    public function getHostelCategoryDetails(Request $request)
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
            $HostelCategoryDetails = $conn->table('hostel_category')->where('id', $id)->first();
            return $this->successResponse($HostelCategoryDetails, 'Hostel Category row fetch successfully');
        }
    }
    // update HostelCategory
    public function updateHostelCategory(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('hostel_category')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('hostel_category')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Hostel Category Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete HostelCategory
    public function deleteHostelCategory(Request $request)
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
            $query = $conn->table('hostel_category')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Category have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
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
            'year' => 'required',
            'register_no' => 'required',
            'roll_no' => 'required',
            'admission_date' => 'required',
            'category_id' => 'required',
            'first_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',

            'class_id' => 'required',
            'section_id' => 'required',

            'branch_id' => 'required',
            'token' => 'required',
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

            if ($conn->table('students')->where('email', '=', $request->email)->count() > 0) {
                return $this->send422Error('Student Email Already Exist', ['error' => 'Student Email Already Exist']);
            } else {

                $fileName = "";
                if ($request->photo) {
                    $extension = $request->file_extension;
                    $fileName = 'UIMG_' . date('Ymd') . uniqid() . '.' . $extension;

                    $base64 = base64_decode($request->photo);
                    $file = base_path() . '/public/users/images/' . $fileName;
                    $suc = file_put_contents($file, $base64);
                }


                $studentId = $conn->table('students')->insertGetId([
                    'year' => $request->year,
                    'father_id' => $request->father_id,
                    'mother_id' => $request->mother_id,
                    'guardian_id' => $request->guardian_id,
                    'passport' => $request->passport,
                    'nric' => $request->nric,
                    'relation' => $request->relation,
                    'register_no' => $request->register_no,
                    'roll_no' => $request->roll_no,
                    'admission_date' => $request->admission_date,
                    'category_id' => $request->category_id,
                    'first_name' => isset($request->first_name) ? $request->first_name : "",
                    'last_name' => isset($request->last_name) ? $request->last_name : "",
                    'gender' => $request->gender,
                    'blood_group' => $request->blood_group,
                    'birthday' => $request->birthday,
                    'mother_tongue' => $request->mother_tongue,
                    'religion' => $request->religion,
                    'race' => $request->race,
                    'country' => $request->country,
                    'post_code' => $request->post_code,
                    'mobile_no' => $request->mobile_no,
                    'city' => $request->city,
                    'state' => $request->state,
                    'current_address' => $request->current_address,
                    'permanent_address' => $request->permanent_address,
                    'email' => $request->email,
                    'photo' => $fileName,
                    'route_id' => $request->route_id,
                    'vehicle_id' => $request->vehicle_id,
                    'hostel_id' => $request->hostel_id,
                    'room_id' => $request->room_id,
                    'previous_details' => $previous_details,
                    'status' => $request->status,
                    'created_at' => date("Y-m-d H:i:s")
                ]);

                $session_id = 0;
                if (isset($request->session_id)) {
                    $session_id = $request->session_id;
                }
                $semester_id = 0;
                if (isset($request->semester_id)) {
                    $semester_id = $request->semester_id;
                }

                $enroll = $conn->table('enrolls')->insert([
                    'student_id' => $studentId,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'roll' => $request->roll_no,
                    'session_id' => $session_id,
                    'semester_id' => $semester_id,
                ]);


                $studentName = $request->first_name . ' ' . $request->last_name;
            }

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
                $user->status = $request->status;
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
            $success = $createConnection->table('subject_assigns as sa')->select('s.id', DB::raw("CONCAT(first_name, ' ', last_name) as name"))
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


            $check = $Connection->table('student_subjectdivision')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                ->get()->toArray();
            if ($check) {
                $studentdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.exam_id', 'te.exam_date', DB::raw('round(AVG(ssd.total_score), 2) as average'))
                    ->leftJoin('timetable_exam as te', function ($join) {
                        $join->on('te.exam_id', '=', 'ssd.exam_id')
                            ->on('te.class_id', '=', 'ssd.class_id')
                            ->on('te.section_id', '=', 'ssd.section_id')
                            ->on('te.subject_id', '=', 'ssd.subject_id');
                    })
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id]
                    ])
                    ->groupBy('ssd.exam_id')
                    ->orderBy('te.exam_date', 'ASC')
                    ->get();
            } else {
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
            }

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

            $check = $Connection->table('student_subjectdivision')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                ->get()->toArray();

            if ($check) {

                $studentdivdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.id', 'ssd.total_score', 'ssd.exam_id', "ssd.subject_division", 'ssd.subjectdivision_scores', 'e.name')
                    ->leftJoin('exam as e', 'ssd.exam_id', '=', 'e.id')
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id],
                        ['ssd.student_id', '=', $request->student_id]
                    ])
                    ->orderBy('ssd.id')
                    ->get()
                    ->groupBy('name');

                $studentdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.exam_id', 'te.exam_date', 'ssd.total_score')
                    ->leftJoin('timetable_exam as te', function ($join) {
                        $join->on('te.exam_id', '=', 'ssd.exam_id')
                            ->on('te.class_id', '=', 'ssd.class_id')
                            ->on('te.section_id', '=', 'ssd.section_id')
                            ->on('te.subject_id', '=', 'ssd.subject_id');
                    })
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id],
                        ['ssd.student_id', '=', $request->student_id]
                    ])
                    ->groupBy('ssd.exam_id')
                    ->orderBy('te.exam_date', 'ASC')
                    ->get();


                $markDetails = [];
                $sl = 0;
                foreach ($studentdivdetails as $key => $details) {
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
                                } else {
                                    $total[$subdiv] += $subjectdivision_scores[$s];
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
                    'subjectdivision' => $subjectdivision,
                    'studentdetails' => $studentdetails
                ];
            } else {
                $data = $Connection->table('student_marks as sm')->select('sm.exam_id', 'te.exam_date', 'sm.score')
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
            }
            // return $studentdetails;
            return $this->successResponse($data, 'Subject division record fetch successfully');
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

            $check = $Connection->table('student_subjectdivision')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                ->get()->toArray();
            if ($check) {
                $studentdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.grade as y', DB::raw('count(ssd.grade) as a'))
                    ->leftJoin('timetable_exam as te', function ($join) {
                        $join->on('te.exam_id', '=', 'ssd.exam_id')
                            ->on('te.class_id', '=', 'ssd.class_id')
                            ->on('te.section_id', '=', 'ssd.section_id')
                            ->on('te.subject_id', '=', 'ssd.subject_id');
                    })
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id],
                        ['ssd.exam_id', '=', $request->exam_id],
                    ])
                    ->groupBy('ssd.grade')
                    ->get();
            } else {
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
            }



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

            $studentdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.id', 'ssd.total_score', 'ssd.exam_id', "ssd.subject_division", 'ssd.subjectdivision_scores', 'e.name')
                ->leftJoin('exam as e', 'ssd.exam_id', '=', 'e.id')
                ->where([
                    ['ssd.class_id', '=', $request->class_id],
                    ['ssd.section_id', '=', $request->section_id],
                    ['ssd.subject_id', '=', $request->subject_id],
                ])
                ->orderBy('ssd.id')
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

            $check = $Connection->table('student_subjectdivision')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                ->get()->toArray();
            if ($check) {
                $subjectDetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.pass_fail as status', DB::raw('count(ssd.pass_fail) as count'))
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id],
                        ['ssd.exam_id', '=', $request->exam_id],
                    ])
                    ->groupBy('ssd.pass_fail')
                    ->get();
            } else {
                $subjectDetails = $Connection->table('student_marks as sm')->select('sm.pass_fail as status', DB::raw('count(sm.pass_fail) as count'))
                    ->where([
                        ['sm.class_id', '=', $request->class_id],
                        ['sm.section_id', '=', $request->section_id],
                        ['sm.subject_id', '=', $request->subject_id],
                        ['sm.exam_id', '=', $request->exam_id],
                    ])
                    ->groupBy('sm.pass_fail')
                    ->get();
            }



            // return $subjectDetails;
            return $this->successResponse($subjectDetails, 'Subject Status record fetched successfully');
        }
    }
    // addToDoList
    public function addToDoList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'title' => 'required',
            'due_date' => 'required',
            'assign_to' => 'required',
            'priority' => 'required',
            'check_list' => 'required',
            'task_description' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $fileDetails = $request->file;

            $fileNames = [];
            if ($fileDetails) {
                foreach ($fileDetails as $key => $value) {
                    $now = now();
                    $name = strtotime($now);
                    $extension = $value['extension'];
                    $fileName = $name . uniqid() . "." . $extension;
                    $base64 = base64_decode($value['base64']);
                    $file = base_path() . '/public/images/todolist/' . $fileName;
                    $upload = file_put_contents($file, $base64);
                    array_push($fileNames, $fileName);
                }
            }
            $insertArr = [
                'title' => $request->title,
                'due_date' => $request->due_date,
                'assign_to' => $request->assign_to,
                'priority' => $request->priority,
                'check_list' => $request->check_list,
                'task_description' => $request->task_description,
                'file' => implode(",", $fileNames),
                'mark_as_complete' => "0",
                'created_at' => date("Y-m-d H:i:s")
            ];
            $query = $Connection->table('to_do_lists')->insert($insertArr);
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse([], 'To List has been successfully saved');
            }
        }
    }
    // get ToDoList
    public function getToDoList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $toDoList = $Connection->table('to_do_lists')->get();
            return $this->successResponse($toDoList, 'To do lists record fetch successfully');
        }
    }
    // get to do row details
    public function getToDoListRow(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'token' => 'required',
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $sectionDetails = $createConnection->table('to_do_lists')->where('id', $request->id)->get();
            return $this->successResponse($sectionDetails, 'to Do Lists row fetch successfully');
        }
    }
    // deleteToDoList
    public function deleteToDoList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $getRow = $createConnection->table('to_do_lists')->where('id', $request->id)->first();
            if (isset($getRow->file)) {
                $arrayVal = explode(',', $getRow->file);
                foreach ($arrayVal as $key => $value) {
                    if ($value) {
                        $file = base_path() . '/public/images/todolist/' . $value;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
            }
            // get data
            $query = $createConnection->table('to_do_lists')->where('id', $request->id)->delete();
            if ($query) {
                return $this->successResponse([], 'To Do Lists have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // getToDoListDashboard
    public function getToDoListDashboard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'user_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $now = Carbon::now()->format('Y-m-d');

            // $dateNow = Carbon::now();
            // $tmr = $dateNow->addDays(1);
            // $dateStart = $tmr->format('Y-m-d');

            // $daysToAdd = 7;
            // $end = $tmr->addDays($daysToAdd);
            // $dateEnd = $end->format('Y-m-d');
            // print_r($dateStart);
            // print_r($dateEnd);
            // exit;
            // dd($now);
            $userID = $request->user_id;
            $createConnection = $this->createNewConnection($request->branch_id);
            // $today = $createConnection->table('to_do_lists as tdl')
            //     ->select(
            //         'tdl.id',
            //         'tdl.title',
            //         'tdl.due_date',
            //         'tdl.priority',
            //         'tdl.priority',
            //         'tdl.mark_as_complete',
            //         'rtd.user_id',
            //         DB::raw('count(tdlc.to_do_list_id) as total_comments')
            //     )
            //     ->leftJoin('read_to_do_list as rtd', function ($join) use ($userID) {
            //         $join->on('rtd.to_do_list_id', '=', 'tdl.id')
            //             ->on('rtd.user_id', '=', DB::raw("'$userID'"));
            //     })
            //     ->leftjoin('to_do_list_comments as tdlc', 'tdl.id', '=', 'tdlc.to_do_list_id')
            //     ->orderBy('tdl.due_date', 'desc')
            //     ->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), $now)
            //     ->groupBy('tdl.id')
            //     ->get();

            // $upcoming = $createConnection->table('to_do_lists as tdl')
            //     ->select(
            //         'tdl.id',
            //         'tdl.title',
            //         'tdl.due_date',
            //         'tdl.priority',
            //         'tdl.mark_as_complete',
            //         'rtd.user_id',
            //         DB::raw('count(tdlc.to_do_list_id) as total_comments')
            //     )
            //     ->leftJoin('read_to_do_list as rtd', function ($join) use ($userID) {
            //         $join->on('rtd.to_do_list_id', '=', 'tdl.id')
            //             ->on('rtd.user_id', '=', DB::raw("'$userID'"));
            //     })
            //     ->leftjoin('to_do_list_comments as tdlc', 'tdl.id', '=', 'tdlc.to_do_list_id')
            //     ->orderBy('tdl.due_date', 'desc')
            //     ->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '>', $now)
            //     ->groupBy('tdl.id')
            //     ->get();
            $query = $createConnection->table('to_do_lists as tdl')
                ->select(
                    'tdl.id',
                    'tdl.title',
                    'tdl.due_date',
                    'tdl.priority',
                    'tdl.mark_as_complete',
                    'rtd.user_id',
                    DB::raw('count(tdlc.to_do_list_id) as total_comments')
                )
                ->leftJoin('read_to_do_list as rtd', function ($join) use ($userID) {
                    $join->on('rtd.to_do_list_id', '=', 'tdl.id')
                        ->on('rtd.user_id', '=', DB::raw("'$userID'"));
                })
                ->leftjoin('to_do_list_comments as tdlc', 'tdl.id', '=', 'tdlc.to_do_list_id')
                ->orderBy('tdl.due_date', 'desc');
            // old
            $old_query = clone $query;
            $old_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '<', $now);
            $old = $old_query->groupBy('tdl.id')->get();
            // today
            $today_query = clone $query;
            $today_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), $now);
            $today = $today_query->groupBy('tdl.id')->get();
            // upcoming
            $upcoming_query = clone $query;
            $upcoming_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '>', $now);
            $upcoming = $upcoming_query->groupBy('tdl.id')->get();

            $data = [
                'old' => $old,
                'today' => $today,
                'upcoming' => $upcoming
            ];
            return $this->successResponse($data, 'To Do List fetch successfully');
        }
    }
    // readUpdateTodo
    public function readUpdateTodo(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'user_id' => 'required',
            'to_do_list_id' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $checkExist = $Connection->table('read_to_do_list')->where([
                ['to_do_list_id', '=', $request->to_do_list_id],
                ['user_id', '=', $request->user_id]
            ])->first();

            if (empty($checkExist)) {
                // echo "update";         
                $query = $Connection->table('read_to_do_list')->insert([
                    'to_do_list_id' => $request->to_do_list_id,
                    'user_id' => $request->user_id,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            } else {
                // update data
                $query = $Connection->table('read_to_do_list')->where('id', $checkExist->id)->update([
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }
            $userID = $request->user_id;
            $rowData = $Connection->table('to_do_lists as tdl')
                ->select(
                    'tdl.id',
                    'tdl.title',
                    'tdl.due_date',
                    'tdl.priority',
                    'tdl.assign_to',
                    'tdl.check_list',
                    'tdl.task_description',
                    'tdl.file',
                    'rtd.user_id'
                )
                ->leftJoin('read_to_do_list as rtd', function ($join) use ($userID) {
                    $join->on('rtd.to_do_list_id', '=', 'tdl.id')
                        ->on('rtd.user_id', '=', DB::raw("'$userID'"));
                })
                ->where('tdl.id', $request->to_do_list_id)
                ->first();
            // get comments details
            $commentsData = $Connection->table('to_do_list_comments as tdlc')
                ->select(
                    'tdlc.id',
                    'tdlc.comment',
                    'tdlc.created_at',
                    'us.name'
                )
                // change superadmin db here
                ->leftJoin('school-management-system.users as us', 'us.id', '=', 'tdlc.user_id')
                // ->leftJoin('paxsuzen_pz-school.users as us', 'us.id', '=', 'tdlc.user_id')
                ->where([
                    ['tdlc.to_do_list_id', '=', $request->to_do_list_id]
                ])
                ->get();
            $data = [
                "comments" => $commentsData,
                "to_do_list" => $rowData,
            ];
            return $this->successResponse($data, 'Read to Do have Been updated');
        }
    }
    // getAssignClass
    public function getAssignClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'get_assign_class' => 'required',
            'branch_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // dd($request->get_assign_class);
            // // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get data
            $rowData = $Connection->table('section_allocations as sa')
                ->select('sa.id', 's.name as section_name', 'c.name as class_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->join('classes as c', 'sa.class_id', '=', 'c.id')
                ->whereIn('sa.id', $request->get_assign_class)
                ->get();

            return $this->successResponse($rowData, 'Get Class details');
        }
    }
    // toDoComments
    public function toDoComments(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'user_id' => 'required',
            'to_do_list_id' => 'required',
            'branch_id' => 'required',
            'comment' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $query = $Connection->table('to_do_list_comments')->insert([
                'to_do_list_id' => $request->to_do_list_id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse([], 'Commented successfully');
            }
        }
    }
    // getToDoTeacher
    public function getToDoTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'user_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $userID = $request->user_id;
            $now = Carbon::now()->format('Y-m-d');
            // 1st get assign teachers
            $Connection = $this->createNewConnection($request->branch_id);
            // any one come 
            if ($request->student_id) {
                $getTeachersClassName = $Connection->table('enrolls as en')
                    ->select('en.class_id', 'en.section_id')
                    ->where('en.student_id', $request->student_id)
                    ->groupBy('en.class_id', 'en.section_id')
                    ->get();
            }
            if ($request->teacher_id) {
                $getTeachersClassName = $Connection->table('subject_assigns as sa')
                    ->select('sa.class_id', 'sa.section_id')
                    ->where('sa.teacher_id', $request->teacher_id)
                    ->groupBy('sa.class_id', 'sa.section_id')
                    ->get();
            }

            $oldArray = array();
            $todayArray = array();
            $upcomingArray = array();
            // 2nd get sections id
            foreach ($getTeachersClassName as $key => $value) {

                $secAllocation = $Connection->table('section_allocations')
                    ->select('id')
                    ->where(
                        [
                            ['section_id', $value->section_id],
                            ['class_id', $value->class_id]
                        ]
                    )->first();
                if (isset($secAllocation->id)) {

                    $secAllID = $secAllocation->id;
                    $old = $Connection->table('to_do_lists as tdl')
                        ->select(
                            'tdl.id'
                        )
                        ->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '<', $now)
                        ->whereRaw('FIND_IN_SET(?,tdl.assign_to)', [$secAllID])
                        ->get();
                    $today = $Connection->table('to_do_lists as tdl')
                        ->select(
                            'tdl.id'
                        )
                        ->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), $now)
                        ->whereRaw('FIND_IN_SET(?,tdl.assign_to)', [$secAllID])
                        ->get();
                    $upcoming = $Connection->table('to_do_lists as tdl')
                        ->select(
                            'tdl.id'
                        )
                        ->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '>', $now)
                        ->whereRaw('FIND_IN_SET(?,tdl.assign_to)', [$secAllID])
                        ->get();
                    if ($old->count() > 0) {
                        foreach ($old as $val) {
                            array_push($oldArray, $val->id);
                        }
                    }
                    if ($today->count() > 0) {
                        foreach ($today as $val) {
                            array_push($todayArray, $val->id);
                        }
                    }
                    if ($upcoming->count() > 0) {
                        foreach ($upcoming as $val) {
                            array_push($upcomingArray, $val->id);
                        }
                    }
                }
            }
            $query = $Connection->table('to_do_lists as tdl')
                ->select(
                    'tdl.id',
                    'tdl.title',
                    'tdl.due_date',
                    'tdl.priority',
                    'tdl.assign_to',
                    'tdl.mark_as_complete',
                    'rtd.user_id',
                    DB::raw('count(tdlc.to_do_list_id) as total_comments')
                )
                ->leftJoin('read_to_do_list as rtd', function ($join) use ($userID) {
                    $join->on('rtd.to_do_list_id', '=', 'tdl.id')
                        ->on('rtd.user_id', '=', DB::raw("'$userID'"));
                })
                ->leftjoin('to_do_list_comments as tdlc', 'tdl.id', '=', 'tdlc.to_do_list_id')
                ->orderBy('tdl.due_date', 'desc');
            // old
            $old_query = clone $query;
            $old = $old_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '<', $now)
                ->whereIn('tdl.id', $oldArray)
                ->groupBy('tdl.id')
                ->get();
            // today
            $today_query = clone $query;
            $today = $today_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), $now)
                ->whereIn('tdl.id', $todayArray)
                ->groupBy('tdl.id')
                ->get();
            // upcoming
            $upcoming_query = clone $query;
            $upcoming = $upcoming_query->where(DB::raw("(DATE_FORMAT(tdl.due_date,'%Y-%m-%d'))"), '>', $now)
                ->whereIn('tdl.id', $upcomingArray)
                ->groupBy('tdl.id')
                ->get();

            $data = [
                'old' => $old,
                'today' => $today,
                'upcoming' => $upcoming
            ];
            return $this->successResponse($data, 'To Do List fetch successfully');
        }
    }

    // get Student List
    public function getStudentList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        $class_id = $request->class_id;
        $session_id = $request->session_id;
        $section_id = $request->section_id;
        $name = $request->student_name;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $student = $con->table('enrolls as e')->select('s.id', DB::raw('CONCAT(s.first_name, " ", s.last_name) as name'), 's.register_no', 's.roll_no', 's.mobile_no', 's.email', 's.gender', 's.photo')
                ->leftJoin('students as s', 'e.student_id', '=', 's.id')
                ->when($class_id, function ($query, $class_id) {
                    return $query->where('e.class_id', $class_id);
                })
                ->when($session_id, function ($query, $session_id) {
                    return $query->where('e.session_id', $session_id);
                })
                ->when($section_id, function ($query, $section_id) {
                    return $query->where('e.section_id', $section_id);
                })
                ->when($name, function ($query, $name) {
                    return $query->where('s.first_name', 'like', '%' . $name . '%')->orWhere('s.last_name', 'like', '%' . $name . '%');
                })
                ->get()->toArray();

            return $this->successResponse($student, 'Student record fetch successfully');
        }
    }

    // update Student
    public function updateStudent(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'student_id' => 'required',
            'year' => 'required',
            'register_no' => 'required',
            'roll_no' => 'required',
            'admission_date' => 'required',
            'category_id' => 'required',
            'first_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',

            'class_id' => 'required',
            'section_id' => 'required',

            'branch_id' => 'required',
            'token' => 'required',
        ]);

        $previous['school_name'] = $request->school_name;
        $previous['qualification'] = $request->qualification;
        $previous['remarks'] = $request->remarks;

        $previous_details = json_encode($previous);

        // return $request['old_photo'];

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // insert data

            if ($conn->table('students')->where([['email', '=', $request->email], ['id', '!=', $request->student_id]])->count() > 0) {
                return $this->send422Error('Student Email Already Exist', ['error' => 'Student Email Already Exist']);
            } else {

                if ($request->photo) {

                    $extension = $request->file_extension;

                    $fileName = 'UIMG_' . date('Ymd') . uniqid() . '.' . $extension;

                    // return $fileName;
                    $path = '/public/users/images/';
                    $base64 = base64_decode($request->photo);
                    $file = base_path() . $path . $fileName;
                    $suc = file_put_contents($file, $base64);


                    if ($request->old_photo) {
                        if (\File::exists(base_path($path . $request->old_photo))) {
                            \File::delete(base_path($path . $request->old_photo));
                        }
                    }
                } else {
                    $fileName = $request->old_photo;
                }


                $studentId = $conn->table('students')->where('id', $request->student_id)->update([
                    'father_id' => $request->father_id,
                    'mother_id' => $request->mother_id,
                    'guardian_id' => $request->guardian_id,
                    'relation' => $request->relation,
                    'passport' => $request->passport,
                    'nric' => $request->nric,
                    'register_no' => $request->register_no,
                    'year' => $request->year,
                    'roll_no' => $request->roll_no,
                    'admission_date' => $request->admission_date,
                    'category_id' => $request->category_id,
                    'first_name' => isset($request->first_name) ? $request->first_name : "",
                    'last_name' => isset($request->last_name) ? $request->last_name : "",
                    'gender' => $request->gender,
                    'blood_group' => $request->blood_group,
                    'birthday' => $request->birthday,
                    'mother_tongue' => $request->mother_tongue,
                    'religion' => $request->religion,
                    'race' => $request->race,
                    'country' => $request->country,
                    'post_code' => $request->post_code,
                    'mobile_no' => $request->mobile_no,
                    'city' => $request->city,
                    'state' => $request->state,
                    'current_address' => $request->current_address,
                    'permanent_address' => $request->permanent_address,
                    'email' => $request->email,
                    'photo' => $fileName,
                    'route_id' => $request->route_id,
                    'vehicle_id' => $request->vehicle_id,
                    'hostel_id' => $request->hostel_id,
                    'room_id' => $request->room_id,
                    'previous_details' => $previous_details,
                    'status' => $request->status,
                    'created_at' => date("Y-m-d H:i:s")
                ]);

                $session_id = 0;
                if (isset($request->session_id)) {
                    $session_id = $request->session_id;
                }
                $semester_id = 0;
                if (isset($request->semester_id)) {
                    $semester_id = $request->semester_id;
                }

                $enroll = $conn->table('enrolls')->where('student_id', $request->student_id)->update([
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'roll' => $request->roll_no,
                    'session_id' => $session_id,
                    'semester_id' => $semester_id,
                ]);


                $studentName = $request->first_name . ' ' . $request->last_name;

                // return
            }

            if (!$studentId) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Student']);
            } else {
                // add User

                $password = $request->password;
                if ($password) {

                    $passvalidator = \Validator::make($request->all(), [
                        'password' => 'required|min:6',
                        'confirm_password' => 'required|same:password|min:6',
                    ]);

                    if (!$passvalidator->passes()) {
                        return $this->send422Error('Validation error.', ['error' => $passvalidator->errors()->toArray()]);
                    } else {

                        $query = User::where([['user_id', '=', $request->student_id], ['role_id', '=', "6"], ['branch_id', '=', $request->branch_id]])
                            ->update([
                                'name' => $studentName,
                                'email' => $request->email,
                                'status' => $request->status,
                                'password' => bcrypt($request->password)
                            ]);
                    }
                } else {
                    $query = User::where([['user_id', '=', $request->student_id], ['role_id', '=', "6"], ['branch_id', '=', $request->branch_id]])
                        ->update([
                            'name' => $studentName,
                            'email' => $request->email,
                            'status' => $request->status
                        ]);
                }




                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Student has been successfully Updated');
                }
            }
        }
    }

    // get StudentDetails details
    public function getStudentDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required'
        ]);
        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $id = $request->id;
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $studentDetail['student'] = $conn->table('students as s')
                ->select('s.*', DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"), 'c.name as class_name', 'sec.name as section_name', 's.relation', 'e.class_id', 'e.section_id', 'e.session_id', 'e.semester_id')
                ->leftJoin('enrolls as e', 's.id', '=', 'e.student_id')
                ->leftJoin('classes as c', 'e.class_id', '=', 'c.id')
                ->leftJoin('sections as sec', 'e.section_id', '=', 'sec.id')
                ->where('s.id', $id)->first();

            $class_id = $studentDetail['student']->class_id;
            $studentDetail['section'] = $conn->table('section_allocations as sa')->select('s.id as section_id', 's.name as section_name')
                ->join('sections as s', 'sa.section_id', '=', 's.id')
                ->where('sa.class_id', $class_id)
                ->get();

            $route_id = $studentDetail['student']->route_id;
            $studentDetail['vehicle'] = $conn->table('transport_assign')->select('transport_vehicle.id as vehicle_id', 'transport_vehicle.vehicle_no')
                ->join('transport_vehicle', 'transport_assign.vehicle_id', '=', 'transport_vehicle.id')
                ->where('transport_assign.route_id', $route_id)
                ->get();

            $hostel_id = $studentDetail['student']->hostel_id;
            $studentDetail['room'] = $conn->table('hostel_room')->select('hostel_room.id as room_id', 'hostel_room.name as room_name')
                ->where('hostel_room.hostel_id', $hostel_id)
                ->get();

            return $this->successResponse($studentDetail, 'Designation row fetch successfully');
        }
    }

    // delete Student
    public function deleteStudent(Request $request)
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
            $path = '/public/users/images/';
            $data = $conn->table('students as s')->select('s.photo', 'e.*')
                ->leftJoin('enrolls as e', 's.id', '=', 'e.student_id')
                ->where('s.id', $id)
                ->first();
            $imageDelete = $data->photo;
            if ($imageDelete) {
                if (\File::exists(base_path($path . $imageDelete))) {
                    \File::delete(base_path($path . $imageDelete));
                }
            }
            // $studentDelete = 1;
            $studentDelete = User::where([['user_id', '=', $id], ['role_id', '=', "6"], ['branch_id', '=', $request->branch_id]])->delete();
            $enroll = $conn->table('enrolls')->where('student_id', $id)->delete();
            $query = $conn->table('students')->where('id', $id)->delete();

            $success = $conn->table('enrolls as e')->select('s.id', 's.first_name', 's.last_name', 's.register_no', 's.roll_no', 's.mobile_no', 's.email', 's.gender')
                ->leftJoin('students as s', 'e.student_id', '=', 's.id')
                ->where([
                    ['e.class_id', $data->class_id],
                    ['e.semester_id', $data->semester_id],
                    ['e.session_id', $data->session_id],
                    ['e.section_id', $data->section_id]
                ])
                ->get()->toArray();
            if ($studentDelete) {
                return $this->successResponse($success, 'Student have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addParent
    public function addParent(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'occupation' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist email
            if ($conn->table('parent')->where('email', '=', $request->email)->count() > 0) {
                return $this->send422Error('Email Already Exist', ['error' => 'Email Already Exist']);
            } else {

                $fileName = "";
                if ($request->photo) {
                    $extension = $request->file_extension;

                    $fileName = 'UIMG_' . date('Ymd') . uniqid() . '.' . $extension;

                    // return $fileName;
                    $path = '/public/users/images/';
                    $base64 = base64_decode($request->photo);
                    $file = base_path() . $path . $fileName;
                    $suc = file_put_contents($file, $base64);
                }



                $name = $request->first_name . " " . $request->last_name;
                // insert data
                $parentId = $conn->table('parent')->insertGetId([

                    'first_name' => isset($request->first_name) ? $request->first_name : "",
                    'last_name' => isset($request->last_name) ? $request->last_name : "",
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'passport' => $request->passport,
                    'race' => $request->race,
                    'religion' => $request->religion,
                    'nric' => $request->nric,
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
                    'photo' => $fileName,
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'twitter_url' => $request->twitter_url,
                    'status' => $request->status,
                    'created_at' => date("Y-m-d H:i:s")
                ]);

                if (!$parentId) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong add Parent']);
                } else {

                    // add User
                    $query = new User();
                    $query->name = $name;
                    $query->user_id = $parentId;
                    $query->role_id = "5";
                    $query->branch_id = $request->branch_id;
                    $query->email = $request->email;
                    $query->status = $request->status;
                    $query->password = bcrypt($request->parent_password);
                    $query->save();
                }

                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Parent has been successfully saved');
                }
            }
        }
    }
    // getParentList
    public function getParentList(Request $request)
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
            $parentDetails = $conn->table('parent')->select("*", DB::raw("CONCAT(first_name, ' ', last_name) as name"))->get();
            return $this->successResponse($parentDetails, 'Parent record fetch successfully');
        }
    }
    // get Parent row details
    public function getParentDetails(Request $request)
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
            $parentDetails['parent'] = $conn->table('parent')->select('*', DB::raw("CONCAT(first_name, ' ', last_name) as name"))->where('id', $id)->first();
            $parentDetails['childs'] = $conn->table('students as s')->select('s.id', 's.first_name', 's.last_name', 's.photo', 'c.name as class_name', 'sec.name as section_name')
                ->leftJoin('enrolls as e', 'e.student_id', '=', 's.id')
                ->leftJoin('classes as c', 'e.class_id', '=', 'c.id')
                ->leftJoin('sections as sec', 'e.section_id', '=', 'sec.id')
                ->where('father_id', $id)
                ->orWhere('mother_id', $id)
                ->orWhere('guardian_id', $id)->get();

            return $this->successResponse($parentDetails, 'Parent row fetch successfully');
        }
    }
    // get Parent Name
    public function getParentName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $data = $conn->table('parent')
                ->select("id", DB::raw("CONCAT(first_name, ' ', last_name) as name"), 'email')
                ->where("first_name", "LIKE", "%{$request->name}%")
                ->orWhere("last_name", "LIKE", "%{$request->name}%")
                ->get();

            $output = '';
            if ($request->name) {
                if (!$data->isEmpty()) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {

                        $output .= '<li class="list-group-item" value="' . $row->id . '">' . $row->name . ' ( ' . $row->email . ' ) </li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
                }
            } else {
                $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
            }
            return $output;
        }
    }
    // update Parent
    public function updateParent(Request $request)
    {


        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'first_name' => 'required',
            'occupation' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // check exist email
            if ($staffConn->table('parent')->where([['email', '=', $request->email], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Email Already Exist', ['error' => 'Email Already Exist']);
            } else {

                if ($request->photo) {

                    $extension = $request->file_extension;

                    $fileName = 'UIMG_' . date('Ymd') . uniqid() . '.' . $extension;

                    // return $fileName;
                    $path = '/public/users/images/';
                    $base64 = base64_decode($request->photo);
                    $file = base_path() . $path . $fileName;
                    $suc = file_put_contents($file, $base64);


                    if ($request->old_photo) {
                        if (\File::exists(base_path($path . $request->old_photo))) {
                            \File::delete(base_path($path . $request->old_photo));
                        }
                    }
                } else {
                    $fileName = $request->old_photo;
                }
                $password = $request->password;
                $name = $request->first_name . " " . $request->last_name;
                if ($password) {

                    $passvalidator = \Validator::make($request->all(), [
                        'password' => 'required|min:6',
                        'confirm_password' => 'required|same:password|min:6',
                    ]);

                    // return $passvalidator;

                    if (!$passvalidator->passes()) {
                        return $this->send422Error('Validation error.', ['error' => $passvalidator->errors()->toArray()]);
                    } else {

                        $updatePassword = bcrypt($request->password);
                        $parent = User::where([['user_id', '=', $id], ['role_id', '=', "5"], ['branch_id', '=', $request->branch_id]])
                            ->update([
                                'name' => $name,
                                'email' => $request->email,
                                'status' => $request->status,
                                'password' => $updatePassword
                            ]);
                    }
                } else {
                    $parent = User::where([['user_id', '=', $id], ['role_id', '=', "5"], ['branch_id', '=', $request->branch_id]])
                        ->update([
                            'name' => $name,
                            'email' => $request->email,
                            'status' => $request->status
                        ]);
                }

                // update data
                $query = $staffConn->table('parent')->where('id', $id)->update([
                    'first_name' => isset($request->first_name) ? $request->first_name : "",
                    'last_name' => isset($request->last_name) ? $request->last_name : "",
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'passport' => $request->passport,
                    'race' => $request->race,
                    'religion' => $request->religion,
                    'nric' => $request->nric,
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
                    'photo' => $fileName,
                    'facebook_url' => $request->facebook_url,
                    'linkedin_url' => $request->linkedin_url,
                    'twitter_url' => $request->twitter_url,
                    'status' => $request->status,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Parent Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Parent
    public function deleteParent(Request $request)
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
            $parent = User::where([['user_id', '=', $id], ['role_id', '=', "5"], ['branch_id', '=', $request->branch_id]])->delete();
            $query = $conn->table('parent')->where('id', $id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Parent have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // get all teacher list
    public function getAllTeacherList(Request $request)
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
            // get all teachers
            $allTeachers = $conn->table('staffs as stf')
                ->select(
                    'stf.id',
                    DB::raw("CONCAT(stf.first_name, ' ', stf.last_name) as name"),
                    'us.role_id',
                    'us.user_id',
                    'us.email',
                    'rol.role_name'
                )
                ->join('school-management-system.users as us', 'stf.id', '=', 'us.user_id')
                ->join('school-management-system.roles as rol', 'rol.id', '=', 'us.role_id')
                // ->join('paxsuzen_pz-school.users as us', 'stf.id', '=', 'us.user_id')
                // ->join('paxsuzen_pz-school.roles as rol', 'rol.id', '=', 'us.role_id')
                ->where([
                    ['us.branch_id', '=', $request->branch_id]
                ])
                ->whereIn('us.role_id', ['2', '3', '4'])
                ->get();
            // $allTeachers = User::select('name', 'user_id')->where([['role_id', '=', "4"], ['branch_id', '=', $request->branch_id]])->get();
            return $this->successResponse($allTeachers, 'get all record fetch successfully');
        }
    }
    // Report card 
    public function getreportcard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'exam_id' => 'required',
            'selected_year' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            // get all teachers
            $allsubjectreport = array();
            $object = new \stdClass();
            $subjectreport_studentmarks = $Connection->table('student_marks')
                ->select(
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'student_marks.score',
                    'student_marks.grade',
                    'student_marks.ranking',
                    'student_marks.pass_fail',
                    'timetable_exam.exam_date'
                )
                ->Join('subjects', 'student_marks.subject_id', '=', 'subjects.id')
                ->leftJoin('timetable_exam', 'student_marks.exam_id', '=', 'timetable_exam.exam_id')

                ->where([
                    ['student_marks.exam_id', '=', $request->exam_id],
                    ['student_marks.student_id', '=', $request->student_id]
                ])
                ->whereYear('timetable_exam.exam_date', $request->selected_year)
                ->get();
            $object->subjectreport = $subjectreport_studentmarks;
            //  array_push($allsubjectreport, $object);

            // check subject division tbl
            $subjectreport_subject_division = $Connection->table('student_subjectdivision_inst')
                ->select(
                    'subjects.id as subject_id',
                    'subjects.name as subject_name',
                    'student_subjectdivision_inst.subject_division',
                    'student_subjectdivision_inst.subjectdivision_scores',
                    'student_subjectdivision_inst.total_score',
                    'student_subjectdivision_inst.grade',
                    'student_subjectdivision_inst.ranking',
                    'student_subjectdivision_inst.pass_fail',
                    'timetable_exam.exam_date'
                )
                ->Join('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')
                ->leftJoin('timetable_exam', 'student_subjectdivision_inst.exam_id', '=', 'timetable_exam.exam_id')

                ->where([
                    ['student_subjectdivision_inst.exam_id', '=', $request->exam_id],
                    ['student_subjectdivision_inst.student_id', '=', $request->student_id]
                ])
                ->whereYear('timetable_exam.exam_date', $request->selected_year)
                ->get();
            $object->subjectreport_div = $subjectreport_subject_division;
            array_push($allsubjectreport, $object);
            //dd($allsubjectreport);
            return $this->successResponse($allsubjectreport, 'get report for student fetch successfully');
        }
    }
    // getHomeworkListDashboard
    public function getHomeworkListDashboard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $student_id = $request->student_id;
            $con = $this->createNewConnection($request->branch_id);
            $student = $con->table('enrolls')->where('student_id', $student_id)->first();
            // return 1;

            $data = $con->table('homeworks')->select('homeworks.title', 'homeworks.date_of_submission', 'subjects.name as subject_name')
                ->leftJoin('subjects', 'homeworks.subject_id', '=', 'subjects.id')
                ->leftJoin('homework_evaluation', 'homeworks.id', '=', 'homework_evaluation.homework_id')
                ->whereNotIn('homeworks.id', function ($q) use ($student_id) {
                    $q->select('homework_id')->from('homework_evaluation')->where('student_id', $student_id);
                })
                ->where('homeworks.class_id', $student->class_id)
                ->where('homeworks.section_id', $student->section_id)
                ->orderBy('homeworks.date_of_submission', 'desc')
                ->get();

            return $this->successResponse($data, 'Student Pending Homework List fetch successfully');
        }
    }

    // getTestScoreDashboard
    public function getTestScoreDashboard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'student_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $student_id = $request->student_id;
            $con = $this->createNewConnection($request->branch_id);
            $student = $con->table('enrolls')->where('student_id', $student_id)->first();
            // return 1;

            $data['subjects'] = $con->table('subject_assigns')->select('subjects.name as subject_name')
                ->join('subjects', 'subject_assigns.subject_id', '=', 'subjects.id')
                ->where('subject_assigns.class_id', $student->class_id)
                ->where('subject_assigns.section_id', $student->section_id)
                ->orderBy('subject_name')
                ->get();


            $sub = $con->table('exam')->select('student_marks.score', 'subjects.name as subject_name', 'student_marks.ranking', 'student_marks.pass_fail', 'student_marks.status', 'student_marks.grade', 'exam.name as exam_name',)
                ->leftJoin('student_marks', 'exam.id', '=', 'student_marks.exam_id')
                ->join('subjects', 'student_marks.subject_id', '=', 'subjects.id')
                ->where('student_marks.class_id', $student->class_id)
                ->where('student_marks.section_id', $student->section_id)
                ->where('student_marks.student_id', $student_id)
                ->orderBy('subject_name')
                ->get()
                ->groupBy('exam_name')->toArray();

            $sub_div = $con->table('exam')->select('student_subjectdivision_inst.total_score as score', 'subjects.name as subject_name', 'student_subjectdivision_inst.ranking', 'student_subjectdivision_inst.pass_fail', 'student_subjectdivision_inst.status', 'student_subjectdivision_inst.grade', 'exam.name as exam_name',)
                ->leftJoin('student_subjectdivision_inst', 'exam.id', '=', 'student_subjectdivision_inst.exam_id')
                ->join('subjects', 'student_subjectdivision_inst.subject_id', '=', 'subjects.id')
                ->where('student_subjectdivision_inst.class_id', $student->class_id)
                ->where('student_subjectdivision_inst.section_id', $student->section_id)
                ->where('student_subjectdivision_inst.student_id', $student_id)
                ->orderBy('subject_name')
                ->get()
                ->groupBy('exam_name')->toArray();
            $combined = array();
            foreach ($sub as $key => $val) {
                $combined[$key] = array_merge($val, $sub_div[$key]);
            }

            $data['marks'] = $combined;

            return $this->successResponse($data, 'Test Score List fetch successfully');
        }
    }

    // addStaffPosition
    public function addStaffPosition(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('staff_positions')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('staff_positions')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Staff Position has been successfully saved');
                }
            }
        }
    }
    // getStaffPositionList
    public function getStaffPositionList(Request $request)
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
            $posDetails = $conn->table('staff_positions')->get();
            return $this->successResponse($posDetails, 'Staff Position record fetch successfully');
        }
    }
    // get StaffPosition row details
    public function getStaffPositionDetails(Request $request)
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
            $posDetails = $conn->table('staff_positions')->where('id', $id)->first();
            return $this->successResponse($posDetails, 'Staff Position row fetch successfully');
        }
    }
    // update StaffPosition
    public function updateStaffPosition(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('staff_positions')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('staff_positions')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Staff Position Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete StaffPosition
    public function deleteStaffPosition(Request $request)
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
            $query = $conn->table('staff_positions')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Staff Position have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addStreamType
    public function addStreamType(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('stream_types')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('stream_types')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Stream Type has been successfully saved');
                }
            }
        }
    }
    // getStreamTypeList
    public function getStreamTypeList(Request $request)
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
            $streamDetails = $conn->table('stream_types')->get();
            return $this->successResponse($streamDetails, 'Stream Type record fetch successfully');
        }
    }
    // get StreamType row details
    public function getStreamTypeDetails(Request $request)
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
            $streamDetails = $conn->table('stream_types')->where('id', $id)->first();
            return $this->successResponse($streamDetails, 'Stream Type row fetch successfully');
        }
    }
    // update StreamType
    public function updateStreamType(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('stream_types')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('stream_types')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Stream Type Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete StreamType
    public function deleteStreamType(Request $request)
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
            $query = $conn->table('stream_types')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Stream Type have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addReligion
    public function addReligion(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('religions')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('religions')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Religion has been successfully saved');
                }
            }
        }
    }
    // getReligionList
    public function getReligionList(Request $request)
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
            $religionDetails = $conn->table('religions')->get();
            return $this->successResponse($religionDetails, 'Religion record fetch successfully');
        }
    }
    // get Religion row details
    public function getReligionDetails(Request $request)
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
            $religionDetails = $conn->table('religions')->where('id', $id)->first();
            return $this->successResponse($religionDetails, 'Religion row fetch successfully');
        }
    }
    // update Religion
    public function updateReligion(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('religions')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('religions')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Religion Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Religion
    public function deleteReligion(Request $request)
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
            $query = $conn->table('religions')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Religion have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // addRace
    public function addRace(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('races')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('races')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Race has been successfully saved');
                }
            }
        }
    }
    // getRaceList
    public function getRaceList(Request $request)
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
            $raceDetails = $conn->table('races')->get();
            return $this->successResponse($raceDetails, 'Race record fetch successfully');
        }
    }
    // get Race row details
    public function getRaceDetails(Request $request)
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
            $raceDetails = $conn->table('races')->where('id', $id)->first();
            return $this->successResponse($raceDetails, 'Race row fetch successfully');
        }
    }
    // update Race
    public function updateRace(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('races')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('races')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Race Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Race
    public function deleteRace(Request $request)
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
            $query = $conn->table('races')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Race have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // studnet leave start 
    // parent dashboard : parent id wise get student
    public function get_studentsparentdashboard(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'parent_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $parent_id = $request->parent_id;
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            // $studentDetails = $conn->table('students as std')
            //     ->select('std.id', 'class_id', 'section_id', 'parent_id', 'first_name', 'last_name', 'gender')
            //     ->leftJoin('enrolls as en', 'std.id', '=', 'en.student_id')
            //     ->where('parent_id', $parent_id)
            //     ->get();
            $studentDetails = $conn->table('students as std')
                ->select(
                    'std.id',
                    'en.class_id',
                    'en.section_id',
                    DB::raw("CONCAT(first_name, ' ', last_name) as name"),
                    'std.gender'
                )
                ->join('enrolls as en', 'std.id', '=', 'en.student_id')
                ->where('std.father_id', '=', $parent_id)
                ->orWhere('std.mother_id', '=', $parent_id)
                ->get();
            return $this->successResponse($studentDetails, 'Student details fetch successfully');
        }
    }
    // student leave apply insert 
    public function student_leaveapply(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'student_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'frm_leavedate' => 'required',
            'to_leavedate' => 'required',
            'reasons' => 'required'
        ]);

        // return $request;

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            $from_leave = date('Y-m-d', strtotime($request['frm_leavedate']));
            $to_leave = date('Y-m-d', strtotime($request['to_leavedate']));
            // check leave exist
            $fromLeaveCnt = $staffConn->table('student_leaves as lev')
                ->where([
                    ['lev.student_id', '=', $request->student_id],
                    ['lev.class_id', '=', $request->class_id],
                    ['lev.section_id', '=', $request->section_id],
                    ['lev.from_leave', '<=', $from_leave],
                    ['lev.to_leave', '>=', $from_leave],
                ])->count();
            $toLeaveCnt = $staffConn->table('student_leaves as lev')
                ->where([
                    ['lev.student_id', '=', $request->student_id],
                    ['lev.class_id', '=', $request->class_id],
                    ['lev.section_id', '=', $request->section_id],
                    ['lev.from_leave', '<=', $to_leave],
                    ['lev.to_leave', '>=', $to_leave]
                ])->count();
            if ($fromLeaveCnt > 0 || $toLeaveCnt > 0) {
                return $this->send422Error('You have already applied for leave between these dates', ['error' => 'You have already applied for leave between these dates']);
            } else {
                // insert data
                if (isset($request->file)) {
                    $now = now();
                    $name = strtotime($now);
                    $extension = $request->file_extension;
                    $fileName = $name . "." . $extension;

                    $base64 = base64_decode($request->file);
                    $file = base_path() . '/public/teacher/student-leaves/' . $fileName;
                    $suc = file_put_contents($file, $base64);
                } else {
                    $fileName = null;
                }
                $data = [
                    'student_id' => $request['student_id'],
                    'parent_id' => $request['parent_id'],
                    'class_id' => $request['class_id'],
                    'section_id' => $request['section_id'],
                    'from_leave' => $from_leave,
                    'to_leave' => $to_leave,
                    'reasonid' => $request['reasons'],
                    'reason' => $request['reason_text'],
                    'remarks' => $request['remarks'],
                    'document' => $fileName,
                    'status' => $request['status'],
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $query = $staffConn->table('student_leaves')->insert($data);
                // send notifications to assign staff
                $getAssignStaff = $staffConn->table('subject_assigns')
                    ->select('teacher_id')
                    ->where([
                        ['class_id', '=', $request->class_id],
                        ['type', '=', '0'],
                        ['teacher_id', '!=', '0'],
                        ['section_id', '=', $request->section_id]
                    ])->groupBy("teacher_id")->get();
                // dd($getAssignStaff);
                $assignerID = [];
                if (isset($getAssignStaff)) {
                    foreach ($getAssignStaff as $key => $value) {
                        array_push($assignerID, $value->teacher_id);
                    }
                }
                // dd($assignerID);
                // send leave notifications
                $user = User::whereIn('user_id', $assignerID)->where([
                    ['branch_id', '=', $request->branch_id]
                ])->where(function ($q) {
                    $q->where('role_id', 3)
                        ->orWhere('role_id', 4);
                })->get();
                // get staff name
                $student_name = $staffConn->table('students')
                    ->select(
                        DB::raw('CONCAT(students.first_name, " ", students.last_name) as name')
                    )
                    ->where([
                        ['id', '=', $request->student_id]
                    ])->first();
                // dd($student_name->name);
                // notifications sent
                Notification::send($user, new LeaveApply($data, $request->branch_id, $student_name->name));

                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Waiting for approval');
                }
            }
        }
    }
    // reupload certificates
    public function reuploadFileStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'id' => 'required',
            'document' => 'required',
            'file' => 'required',
            'file_extension' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // insert data
            if (isset($request->file)) {
                $now = now();
                $name = strtotime($now);
                $extension = $request->file_extension;
                $fileName = $name . "." . $extension;

                $base64 = base64_decode($request->file);
                $file = base_path() . '/public/teacher/student-leaves/' . $fileName;
                $suc = file_put_contents($file, $base64);
                // return $fileName;
                $path = '/public/teacher/student-leaves/';

                if ($request->document) {
                    if (\File::exists(base_path($path . $request->document))) {
                        \File::delete(base_path($path . $request->document));
                    }
                }
            } else {
                $fileName = $request->document;
            }
            $query = $staffConn->table('student_leaves')->where('id', $request->id)->update([
                'document' => $fileName,
                'status' => "Pending",
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Document submitted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    //Class room management : get student leaves
    function get_studentleaves(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'classDate' => 'required'

        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $compare_date = $request->classDate;
            $studentDetails = $conn->table('student_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.class_id',
                    'lev.section_id',
                    'lev.student_id',
                    DB::raw('CONCAT(std.first_name, " ", std.last_name) as name'),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    'lev.reason',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.teacher_remarks',
                    'std.photo'
                )
                ->leftJoin('students as std', 'lev.student_id', '=', 'std.id')
                ->where([
                    ['lev.class_id', '=', $request->class_id],
                    ['lev.section_id', '=', $request->section_id],
                    // ['lev.status', '!=', 'Approve'],
                    // ['lev.status', '!=', 'Reject'],
                    // ['lev.status', '!=', 'Reject'],
                    ['lev.from_leave', '<=', $compare_date],
                    ['lev.to_leave', '>=', $compare_date]
                ])
                ->orderBy('lev.from_leave', 'asc')
                ->get();
            return $this->successResponse($studentDetails, 'Student details fetch successfully');
        }
    }
    public function get_leavereasons(Request $request)
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
            $reasons = $staffConn->table('reasons')->get();

            return $this->successResponse($reasons, 'Reasons record fetch successfully');
        }
    }
    //get particular student leave 
    function get_particular_studentleave_list(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'parent_id' => 'required'

        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data

            $studentDetails = $conn->table('student_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.class_id',
                    'lev.section_id',
                    'lev.student_id',
                    DB::raw("CONCAT(std.first_name, ' ', std.last_name) as name"),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    'lev.reason',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.teacher_remarks'
                )
                //->select('lev.class_id','lev.section_id','student_id','std.first_name','std.last_name','lev.from_leave','lev.to_leave','lev.reason','lev.status')
                ->leftJoin('students as std', 'lev.student_id', '=', 'std.id')
                ->where([
                    ['lev.parent_id', '=', $request->parent_id]
                ])
                ->orderby('lev.to_leave', 'desc')
                ->get();
            return $this->successResponse($studentDetails, 'Student details fetch successfully');
        }
    }
    public function teacher_leaveapprove(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'student_leave_tbl_id' => 'required',
            'student_leave_approve' => 'required'

        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $student_leave_id = $request->student_leave_tbl_id;
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);

            // update data
            $query = $Conn->table('student_leaves')->where('id', $student_leave_id)->update([
                'status' => $request->student_leave_approve,
                'teacher_remarks' => $request->teacher_remarks,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Leave Request have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // studnet leave end 
    // get all student leave list
    function getAllStudentLeaves(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            $class_id = $request->class_id;
            $section_id = $request->section_id;
            // get data
            $studentDetails = $conn->table('student_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.class_id',
                    'lev.section_id',
                    'lev.student_id',
                    DB::raw("CONCAT(std.first_name, ' ', std.last_name) as name"),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    'lev.reason',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.teacher_remarks',
                    'cl.name as class_name',
                    'sc.name as section_name',

                )
                ->leftJoin('students as std', 'lev.student_id', '=', 'std.id')
                ->leftJoin('classes as cl', 'lev.class_id', '=', 'cl.id')
                ->leftJoin('sections as sc', 'lev.section_id', '=', 'sc.id')
                // ->leftJoin('students as std', 'lev.student_id', '=', 'std.id')
                ->when($class_id, function ($query, $class_id) {
                    return $query->where('lev.class_id', $class_id);
                })
                ->when($section_id, function ($query, $section_id) {
                    return $query->where('lev.section_id', $section_id);
                })
                ->orderBy('lev.from_leave', 'asc')
                ->get();
            return $this->successResponse($studentDetails, 'Student details fetch successfully');
        }
    }
    // getLeaveTypes
    public function getLeaveTypes(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $getAllTypes = $conn->table('leave_types as lev')->get();
            return $this->successResponse($getAllTypes, 'Staff leave types fetch successfully');
        }
    }

    // addLeaveType
    public function addLeaveType(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('leave_types')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('leave_types')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Leave Type has been successfully saved');
                }
            }
        }
    }
    // getLeaveTypeList
    public function getLeaveTypeList(Request $request)
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
            $leaveTypeDetails = $conn->table('leave_types')->get();
            return $this->successResponse($leaveTypeDetails, 'Leave Type record fetch successfully');
        }
    }
    // get LeaveType row details
    public function getLeaveTypeDetails(Request $request)
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
            $leaveTypeDetails = $conn->table('leave_types')->where('id', $id)->first();
            return $this->successResponse($leaveTypeDetails, 'Leave Type row fetch successfully');
        }
    }
    // update LeaveType
    public function updateLeaveType(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('leave_types')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('leave_types')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Leave Type Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete LeaveType
    public function deleteLeaveType(Request $request)
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
            $query = $conn->table('leave_types')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Leave Type have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add TransportRoute
    public function addTransportRoute(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'start_place' => 'required',
            'stop_place' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('transport_route')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('transport_route')->insert([
                    'name' => $request->name,
                    'start_place' => $request->start_place,
                    'stop_place' => $request->stop_place,
                    'remarks' => $request->remarks,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Transport Route has been successfully saved');
                }
            }
        }
    }
    // getTransportRouteList
    public function getTransportRouteList(Request $request)
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
            $transportRouteDetails = $conn->table('transport_route')->get();
            return $this->successResponse($transportRouteDetails, 'Transport Route record fetch successfully');
        }
    }
    // get TransportRoute row details
    public function getTransportRouteDetails(Request $request)
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
            $transportRouteDetails = $conn->table('transport_route')->where('id', $id)->first();
            return $this->successResponse($transportRouteDetails, 'Transport Route row fetch successfully');
        }
    }
    // update TransportRoute
    public function updateTransportRoute(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'start_place' => 'required',
            'stop_place' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('transport_route')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('transport_route')->where('id', $id)->update([
                    'name' => $request->name,
                    'start_place' => $request->start_place,
                    'stop_place' => $request->stop_place,
                    'remarks' => $request->remarks,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Transport Route Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete TransportRoute
    public function deleteTransportRoute(Request $request)
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
            $query = $conn->table('transport_route')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Route have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add TransportStoppage
    public function addTransportStoppage(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'route_fare' => 'required',
            'stop_position' => 'required',
            'stop_time' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // insert data
            $query = $conn->table('transport_stoppage')->insert([
                'stop_position' => $request->stop_position,
                'stop_time' => $request->stop_time,
                'route_fare' => $request->route_fare,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Transport Stoppage has been successfully saved');
            }
        }
    }
    // getTransportStoppageList
    public function getTransportStoppageList(Request $request)
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
            $transportStoppageDetails = $conn->table('transport_stoppage')->get();
            return $this->successResponse($transportStoppageDetails, 'Transport Stoppage record fetch successfully');
        }
    }
    // get TransportStoppage row details
    public function getTransportStoppageDetails(Request $request)
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
            $transportStoppageDetails = $conn->table('transport_stoppage')->where('id', $id)->first();
            return $this->successResponse($transportStoppageDetails, 'Transport Stoppage row fetch successfully');
        }
    }
    // update TransportStoppage
    public function updateTransportStoppage(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'route_fare' => 'required',
            'stop_position' => 'required',
            'stop_time' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // update data
            $query = $conn->table('transport_stoppage')->where('id', $id)->update([
                'stop_position' => $request->stop_position,
                'stop_time' => $request->stop_time,
                'route_fare' => $request->route_fare,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Stoppage Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete TransportStoppage
    public function deleteTransportStoppage(Request $request)
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
            $query = $conn->table('transport_stoppage')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Stoppage have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // staff leave apply
    public function staffLeaveApply(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'staff_id' => 'required',
            'from_leave' => 'required',
            'to_leave' => 'required',
            'leave_type' => 'required',
            'reason' => 'required',
            'status' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            $branch_id = $request->branch_id;
            $from_leave = date('Y-m-d', strtotime($request['from_leave']));
            $to_leave = date('Y-m-d', strtotime($request['to_leave']));
            // check leave exist
            $fromLeaveCnt = $staffConn->table('staff_leaves as lev')
                ->where([
                    ['lev.staff_id', '=', $request->staff_id],
                    ['lev.from_leave', '<=', $from_leave],
                    ['lev.to_leave', '>=', $from_leave]
                ])->count();
            $toLeaveCnt = $staffConn->table('staff_leaves as lev')
                ->where([
                    ['lev.staff_id', '=', $request->staff_id],
                    ['lev.from_leave', '<=', $to_leave],
                    ['lev.to_leave', '>=', $to_leave]
                ])->count();
            if ($fromLeaveCnt > 0 || $toLeaveCnt > 0) {
                return $this->send422Error('You have already applied for leave between these dates', ['error' => 'You have already applied for leave between these dates']);
            } else {
                // insert data
                if (isset($request->document)) {
                    $now = now();
                    $name = strtotime($now);
                    $extension = $request->file_extension;
                    $fileName = $name . "." . $extension;

                    $base64 = base64_decode($request->document);
                    $file = base_path() . '/public/admin-documents/leaves/' . $fileName;
                    $suc = file_put_contents($file, $base64);
                } else {
                    $fileName = null;
                }
                $fileName = null;
                $data = [
                    'staff_id' => $request['staff_id'],
                    'from_leave' => $from_leave,
                    'to_leave' => $to_leave,
                    'leave_type' => $request['leave_type'],
                    'reason_id' => $request['reason'],
                    'status' => $request['status'],
                    'document' => $fileName,
                    'remarks' => $request['remarks'],
                    'created_at' => date("Y-m-d H:i:s")
                ];
                $query = $staffConn->table('staff_leaves')->insert($data);
                // send notifications to assign staff and admin
                $getAssignStaff = $staffConn->table('assign_leave_approval')
                    ->where([
                        ['staff_id', '=', $request->staff_id]
                    ])->get();
                $assignerID = [];
                if (isset($getAssignStaff)) {
                    foreach ($getAssignStaff as $key => $value) {
                        array_push($assignerID, $value->assigner_staff_id);
                    }
                }
                // send leave notifications
                $getAssiger = User::whereIn('user_id', $assignerID)->where([
                    ['branch_id', '=', $request->branch_id]
                ])->where(function ($q) {
                    $q->where('role_id', 2)
                        ->orWhere('role_id', 3)
                        ->orWhere('role_id', 4);
                })->get();
                $allAdmin = User::where([
                    ['branch_id', '=', $request->branch_id],
                    ['role_id', '=', 2]
                ])->get();
                $merged = $allAdmin->merge($getAssiger);
                $user = $merged->all();
                // get staff name
                $staff_name = $staffConn->table('staffs')
                    ->select(
                        DB::raw('CONCAT(staffs.first_name, " ", staffs.last_name) as staff_name')
                    )
                    ->where([
                        ['id', '=', $request->staff_id]
                    ])->first();
                Notification::send($user, new LeaveApply($data, $branch_id, $staff_name->staff_name));
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'You have applied for leave');
                }
            }
        }
    }
    public function staffLeaveHistory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $leave_status = "All";
            if (isset($request->leave_status)) {
                $leave_status = $request->leave_status;
            }
            $staff_id = $request->staff_id;
            $leaveDetails = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.staff_id',
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as name'),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    DB::raw('DATEDIFF(lev.to_leave,lev.from_leave) as date_diff'),
                    'lt.name as leave_type_name',
                    'rs.name as reason_name',
                    'lev.reason_id',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.assiner_remarks',
                    DB::raw('CONCAT(appr.first_name, " ", appr.last_name) as approval_name')

                )
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->leftJoin('staffs as stf', 'lev.staff_id', '=', 'stf.id')
                ->leftJoin('staffs as appr', 'lev.assiner_id', '=', 'appr.id')
                ->leftJoin('reasons as rs', 'lev.reason_id', '=', 'rs.id')
                ->when($staff_id, function ($query, $staff_id) {
                    return $query->where('lev.staff_id', '=', $staff_id);
                })
                ->when($leave_status != "All", function ($ins)  use ($leave_status) {
                    $ins->where('lev.status', $leave_status);
                })
                ->orderBy('lev.from_leave', 'asc')
                ->get();
            return $this->successResponse($leaveDetails, 'Staff leave details fetch successfully');
        }
    }
    // staffLeaveApproved
    public function staffLeaveApproved(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'leave_id' => 'required',
            'status' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $leave_id = $request->leave_id;
            // create new connection
            $Conn = $this->createNewConnection($request->branch_id);
            // update data
            $query = $Conn->table('staff_leaves')->where('id', $leave_id)->update([
                'status' => $request->status,
                'assiner_remarks' => (isset($request->assiner_remarks) ? $request->assiner_remarks : ""),
                'assiner_id' => $request->staff_id,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Leave Request have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // getAllStaffDetails
    public function getAllStaffDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $getAllAdmins = $conn->table('staffs as stf')
                ->select(
                    'stf.id',
                    'stf.department_id',
                    'stf.photo',
                    'ala.staff_id',
                    'ala.assigner_staff_id',
                    DB::raw("GROUP_CONCAT(sdp.name) as department_name"),
                    DB::raw("CONCAT(stf.first_name, ' ', stf.last_name) as name")
                )
                ->join('school-management-system.users as us', 'stf.id', '=', 'us.user_id')
                // ->join('paxsuzen_pz-school.users as us', 'stf.id', '=', 'us.user_id')
                ->join("staff_departments as sdp", DB::raw("FIND_IN_SET(sdp.id,stf.department_id)"), ">", DB::raw("'0'"))
                ->leftJoin("assign_leave_approval as ala", 'ala.staff_id', '=', 'stf.id')
                ->where([
                    ['us.branch_id', '=', $request->branch_id]
                ])
                ->whereIn('us.role_id', ['3', '4'])
                ->groupBy("stf.id")
                ->get();
            return $this->successResponse($getAllAdmins, 'Staffs admin record fetch successfully');
        }
    }
    // assignLeaveApproval
    public function assignLeaveApproval(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'staff_id' => 'required',
            'assigner_staff_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            $old = $createConnection->table('assign_leave_approval')
                ->where(
                    [
                        ['staff_id', $request->staff_id]
                    ]
                )
                ->first();

            $arrDetails = array(
                'staff_id' =>  $request->staff_id,
                'assigner_staff_id' => $request->assigner_staff_id,
                'created_by' => isset($request->created_by) ? $request->created_by : 0,
            );
            if (isset($old->id)) {
                $arrDetails['updated_at'] = date("Y-m-d H:i:s");
                $query = $createConnection->table('assign_leave_approval')->where('id', $old->id)->update($arrDetails);
            } else {
                $arrDetails['created_at'] = date("Y-m-d H:i:s");
                $query = $createConnection->table('assign_leave_approval')->insert($arrDetails);
            }
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse([], 'Assigning approval for leave has been successfully saved');
            }
        }
    }
    // leaveApprovalHistoryByStaff
    public function leaveApprovalHistoryByStaff(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'staff_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $leave_status = "All";
            if (isset($request->leave_status)) {
                $leave_status = $request->leave_status;
            }
            $staff_id = $request->staff_id;
            $leaveDetails = $conn->table('assign_leave_approval as alp')
                ->select(
                    'lev.id',
                    'lev.staff_id',
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as name'),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    DB::raw('DATEDIFF(lev.to_leave,lev.from_leave) as date_diff'),
                    'lt.name as leave_type_name',
                    'rs.name as reason_name',
                    'lev.reason_id',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.assiner_remarks'
                )
                ->join('staffs as stf', 'alp.staff_id', '=', 'stf.id')
                ->join('staff_leaves as lev', 'alp.staff_id', '=', 'lev.staff_id')
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->join('reasons as rs', 'lev.reason_id', '=', 'rs.id')
                ->where('alp.assigner_staff_id', '=', $staff_id)
                ->when($leave_status != "All", function ($ins)  use ($leave_status) {
                    $ins->where('lev.status', $leave_status);
                })
                ->orderBy('lev.from_leave', 'desc')
                ->get();
            return $this->successResponse($leaveDetails, 'Leave Approval History By Staff details fetch successfully');
        }
    }
    // leave details
    public function staffLeaveDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'leave_id' => 'required',
            'staff_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $leave_id = $request->leave_id;
            $staff_id = $request->staff_id;
            $leaveDetails['leave_details'] = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.id',
                    'lev.staff_id',
                    DB::raw('CONCAT(stf.first_name, " ", stf.last_name) as name'),
                    DB::raw('DATE_FORMAT(lev.from_leave, "%d-%m-%Y") as from_leave'),
                    DB::raw('DATE_FORMAT(lev.to_leave, "%d-%m-%Y") as to_leave'),
                    DB::raw('DATE_FORMAT(lev.created_at, "%d-%m-%Y") as created_at'),
                    DB::raw('DATEDIFF(lev.to_leave,lev.from_leave) as date_diff'),
                    'lt.name as leave_type_name',
                    'rs.name as reason_name',
                    'lev.reason_id',
                    'lev.document',
                    'lev.status',
                    'lev.remarks',
                    'lev.assiner_remarks'
                )
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->join('staffs as stf', 'lev.staff_id', '=', 'stf.id')
                ->join('reasons as rs', 'lev.reason_id', '=', 'rs.id')
                ->where('lev.id', '=', $leave_id)
                ->first();
            $leaveDetails['leave_type_details'] = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.staff_id',
                    'lt.name as leave_name',
                    DB::raw('count(leave_type) as total_leave')
                )
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->where('lev.staff_id', '=', $staff_id)
                ->where(
                    [
                        ['lev.staff_id', '=', $staff_id],
                        ['lev.status', '=', 'Approve'],
                    ]
                )
                ->groupBy('lev.leave_type')
                ->get();
            return $this->successResponse($leaveDetails, 'Staff leave row details fetch successfully');
        }
    }
    // staffLeaveTakenHist
    public function staffLeaveTakenHist(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'staff_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $staff_id = $request->staff_id;

            $leave_type_details = $conn->table('staff_leaves as lev')
                ->select(
                    'lev.staff_id',
                    'lt.name as leave_name',
                    DB::raw('count(leave_type) as total_leave')
                )
                ->join('leave_types as lt', 'lev.leave_type', '=', 'lt.id')
                ->where('lev.staff_id', '=', $staff_id)
                ->where(
                    [
                        ['lev.staff_id', '=', $staff_id],
                        ['lev.status', '=', 'Approve'],
                    ]
                )
                ->groupBy('lev.leave_type')
                ->get();
            return $this->successResponse($leave_type_details, 'Staff leave history details fetch successfully');
        }
    }

    // get Employee Attendance List
    public function getEmployeeAttendanceList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'employee' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $employee = $request->employee;
            $date = $request->date;
            $output = array();
            // get data
            $begin = new DateTime($request->firstDay);
            $end   = new DateTime($request->lastDay);
            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {

                $date = $i->format("Y-m-d");
                $attendance['date'] = $date;
                $attendance['details'] = $Connection->table('staffs as s')
                    ->select(
                        'sa.id',
                        'sa.check_in',
                        'sa.check_out',
                        'sa.status',
                        'sa.hours',
                        'sa.remarks',
                    )
                    ->leftJoin('staff_attendances as sa', function ($join) use ($date) {
                        $join->on('s.id', '=', 'sa.staff_id')
                            ->on('sa.date', '=', DB::raw("'$date'"));
                    })
                    ->where('s.id', $employee)
                    ->first();
                array_push($output, $attendance);
            }

            if ($output) {
                return $this->successResponse($output, 'Attendance record fetch successfully');
            } else {
                return $this->send404Error('No Data Found.', ['error' => 'No Data Found']);
            }
        }
    }

    //  add Employee Attendance
    public function addEmployeeAttendance(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'attendance' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // insert data
            $attendance = $request->attendance;
            $employee = $request->employee;

            foreach ($attendance as $att) {

                // return $att;
                if (isset($att['id'])) {
                    $query = $conn->table('staff_attendances')->where('id', $att['id'])->update([
                        'date' => $att['date'],
                        'check_in' => $att['check_in'],
                        'check_out' => $att['check_out'],
                        'status' => $att['status'],
                        'hours' => $att['hours'],
                        'remarks' => $att['remarks'],
                        'staff_id' => $employee,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                } else {

                    if ($att['status']) {
                        $query = $conn->table('staff_attendances')->insert([
                            'date' => $att['date'],
                            'check_in' => $att['check_in'],
                            'check_out' => $att['check_out'],
                            'status' => $att['status'],
                            'hours' => $att['hours'],
                            'remarks' => $att['remarks'],
                            'staff_id' => $employee,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Attendance has been successfully saved');
            }
        }
    }

    //get Employee Attendance Report
    function getEmployeeAttendanceReport(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'date' => 'required',
            'employee' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $date = explode('-', $request->date);
            $employee = $request->employee;
            $department = $request->department;
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            if (!isset($department)) {
                $dep = $Connection->table('staffs')->select('department_id')->where('id', $employee)->first();
                $department = $dep->department_id;
            }
            $getAttendanceList = $Connection->table('staff_attendances as sa')
                ->select(
                    'st.first_name',
                    'st.last_name',
                    'sa.staff_id',
                    'sa.date',
                    'st.photo',
                    'sa.status',
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"'),

                )
                ->join('staffs as st', 'sa.staff_id', '=', 'st.id')
                ->when($employee != "All", function ($q)  use ($employee) {
                    $q->where('sa.staff_id', $employee);
                })
                ->where('st.department_id', $department)
                ->whereMonth('sa.date', $date[0])
                ->whereYear('sa.date', $date[1])
                ->groupBy('sa.staff_id')
                ->get();
            $staffDetails = array();
            if (!empty($getAttendanceList)) {
                foreach ($getAttendanceList as $value) {
                    $object = new \stdClass();

                    $object->first_name = $value->first_name;
                    $object->last_name = $value->last_name;
                    $object->staff_id = $value->staff_id;
                    $object->photo = $value->photo;
                    $object->presentCount = $value->presentCount;
                    $object->absentCount = $value->absentCount;
                    $object->lateCount = $value->lateCount;
                    $staff_id = $value->staff_id;
                    $date = $value->date;
                    $getStaffsAttData = $this->getAttendanceByDateStaff($request, $staff_id, $date);
                    $object->attendance_details = $getStaffsAttData;

                    array_push($staffDetails, $object);
                }
            }



            // dd($staffDetails);
            $data = [
                'staff_details' => $staffDetails,
            ];

            return $this->successResponse($data, 'Attendance record fetch successfully');
        }
    }

    function getAttendanceByDateStaff($request, $staff_id, $date)
    {
        // create new connection
        $Connection = $this->createNewConnection($request->branch_id);

        $query_date = $date;
        // First day of the month.
        $startDate = date('Y-m-01', strtotime($query_date));
        // Last day of the month.
        $endDate = date('Y-m-t', strtotime($query_date));

        $staffList = $Connection->table('staff_attendances as sa')
            ->select(
                'sa.date',
                'sa.status'
            )
            ->join('staffs as st', 'sa.staff_id', '=', 'st.id')
            ->where([
                ['sa.staff_id', '=', $staff_id],
            ])
            ->whereBetween(DB::raw('date(date)'), [$startDate, $endDate])
            ->groupBy('sa.date')
            ->orderBy('sa.date', 'asc')
            ->whereNotNull('sa.status')
            ->get();
        return $staffList;
    }

    // getRelationList
    public function getRelationList(Request $request)
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
            $relationDetails = $conn->table('relations')->get();
            return $this->successResponse($relationDetails, 'Relation record fetch successfully');
        }
    }
    // calendorAddTask
    public function calendorAddTask(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $createConnection = $this->createNewConnection($request->branch_id);
            // insert data
            $ids = $createConnection->table('calendors')->insertGetId([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'description' => isset($request->description) ? $request->description : "",
                'login_id' => $request->login_id,
                'task_color' => "bg-info",
                'created_at' => date("Y-m-d H:i:s")
            ]);
            // get insert row
            $success = $createConnection->table('calendors')
                ->select('id', 'title', 'start', 'end', 'description', 'task_color as className')
                ->where('id', $ids)->first();
            // dd($success);

            if (!$ids) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'New Task has been successfully saved');
            }
        }
    }
    // calendorListTask
    public function calendorListTask(Request $request)
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
            $section = $secConn->table('calendors')
                ->select('id', 'title', 'start', 'end', 'description', 'task_color as className')
                ->where('login_id', '=', $request->login_id)
                ->get();
            return $this->successResponse($section, 'calendors tast details fetch successfully');
        }
    }
    // delete calendor row
    public function calendorDeleteTask(Request $request)
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
            $query = $conn->table('calendors')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Calendor Event have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // add Education
    public function addEducation(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('educations')->where('name', '=', $request->name)->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // insert data
                $query = $conn->table('educations')->insert([
                    'name' => $request->name,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if (!$query) {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                } else {
                    return $this->successResponse($success, 'Education has been successfully saved');
                }
            }
        }
    }
    // get Education List
    public function getEducationList(Request $request)
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
            $educationDetails = $conn->table('educations')->get();
            return $this->successResponse($educationDetails, 'Education record fetch successfully');
        }
    }
    // get Education row details
    public function getEducationDetails(Request $request)
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
            $educationDetails = $conn->table('educations')->where('id', $id)->first();
            return $this->successResponse($educationDetails, 'Education row fetch successfully');
        }
    }
    // update Education
    public function updateEducation(Request $request)
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
            $conn = $this->createNewConnection($request->branch_id);
            // check exist name
            if ($conn->table('educations')->where([['name', '=', $request->name], ['id', '!=', $id]])->count() > 0) {
                return $this->send422Error('Name Already Exist', ['error' => 'Name Already Exist']);
            } else {
                // update data
                $query = $conn->table('educations')->where('id', $id)->update([
                    'name' => $request->name,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $success = [];
                if ($query) {
                    return $this->successResponse($success, 'Education Details have Been updated');
                } else {
                    return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
                }
            }
        }
    }
    // delete Education
    public function deleteEducation(Request $request)
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
            $query = $conn->table('educations')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Education have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // get employee by department
    public function getEmployeeByDepartment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'department_id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $staffConn = $this->createNewConnection($request->branch_id);
            // get data
            $Staffs = $staffConn->table('staffs')->where('department_id', $request->department_id)->get();
            return $this->successResponse($Staffs, 'Department Staffs record fetch successfully');
        }
    }
    // get student list by entrolls
    public function getStudListByClassSec(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required'
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $Connection = $this->createNewConnection($request->branch_id);
            $getSubjectMarks = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id',
                    DB::raw("CONCAT(st.first_name, ' ', st.last_name) as name"),
                    'st.id as id'
                )
                ->leftJoin('students as st', 'st.id', '=', 'en.student_id')
                ->where([
                    ['en.class_id', '=', $request->class_id],
                    ['en.section_id', '=', $request->section_id]
                ])
                ->orderBy('st.first_name', 'asc')
                ->get();
            return $this->successResponse($getSubjectMarks, 'Students record fetch successfully');
        }
    }
    // get attendance report graph
    function getAttendanceReportGraph(Request $request)
    {
        $validator = \Validator::make($request->all(), [
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
            $Connection = $this->createNewConnection($request->branch_id);
            $month = date('m');
            $year = date('Y');
            // date wise late present analysis
            $getLatePresentData = $Connection->table('student_attendances as sa')
                ->select(
                    // 'sa.date',
                    DB::raw('DATE_FORMAT(sa.date, "%b") as month'),
                    // DB::raw('DATE_FORMAT(sa.date, "%b %d") as date'),
                    DB::raw('COUNT(CASE WHEN sa.status = "present" then 1 ELSE NULL END) as "presentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "absent" then 1 ELSE NULL END) as "absentCount"'),
                    DB::raw('COUNT(CASE WHEN sa.status = "late" then 1 ELSE NULL END) as "lateCount"')
                )
                // ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                // ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    ['sa.student_id', '=', $request->student_id]
                ])
                ->whereMonth('sa.date', $month)
                ->whereYear('sa.date', $year)
                // ->groupBy('sa.date')
                ->get();

            return $this->successResponse($getLatePresentData, 'attendance record fetch successfully');
        }
    }
    // view Homework submission
    public function viewHomeworkGraphByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'student_id' => 'required'
        ]);
        $student_id = $request->student_id;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection    
            $con = $this->createNewConnection($request->branch_id);
            // get data
            $homework = $con->table('homeworks as h')->select(
                'h.id',
                'h.document',
                'h.date_of_homework',
                'h.date_of_submission',
                'he.student_id',
                'he.date',
                'he.status',
                'he.correction'
            )->leftJoin('homework_evaluation as he', function ($q) use ($student_id) {
                $q->on('h.id', '=', 'he.homework_id')
                    ->on('he.student_id', '=', DB::raw("'$student_id'"));
            })->where([
                ['h.class_id', '=', $request->class_id],
                ['h.section_id', '=', $request->section_id],
                ['h.subject_id', '=', $request->subject_id]
            ])->get();

            $complete  = 0;
            $inComplete  = 0;
            $lateSubmission  = 0;

            if (!empty($homework)) {
                foreach ($homework as $home) {
                    // dd($home);
                    if (isset($home->date)) {
                        $submitDate = $home->date;
                        $submitDate = date('Y-m-d', strtotime($submitDate));
                        // echo $submitDate; // echos today! 
                        // $date_of_homework = date('Y-m-d', strtotime($home->date_of_homework));
                        $date_of_submission = date('Y-m-d', strtotime($home->date_of_submission));
                        // echo $date_of_submission; // echos today! 

                        if ($submitDate > $date_of_submission) {
                            $lateSubmission++; // late submited
                        } else {
                            if ($home->correction == "1") {
                                $complete++;
                            } else {
                                $inComplete++;
                            }
                        }
                    } else {
                        if (isset($home->correction)) {
                            if ($home->correction == "1") {
                                $complete++; // late submited
                            } else {
                                $inComplete++;
                            }
                        } else {
                            $inComplete++;
                        }
                    }
                }
            }

            $data = [
                'complete' => $complete,
                'in_complete' => $inComplete,
                'late_submission' => $lateSubmission,
            ];
            return $this->successResponse($data, 'Homework record fetch successfully');
        }
    }
    // get attendance report graph
    function getAttitudeGraphByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
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
            $Connection = $this->createNewConnection($request->branch_id);
            $month = date('m');
            $year = date('Y');

            $getStudBehaviour = $Connection->table('student_attendances as sa')
                ->select(
                    DB::raw('COUNT(sa.date) as "total_no_of_days_date_count"'),
                    // DB::raw('DATE_FORMAT(sa.date, "%b %d") as date'),
                    DB::raw('COUNT(CASE WHEN sa.student_behaviour = "smile" then 1 ELSE NULL END) as "smileCount"'),
                    DB::raw('COUNT(CASE WHEN sa.student_behaviour = "angry" then 1 ELSE NULL END) as "angryCount"'),
                    DB::raw('COUNT(CASE WHEN sa.student_behaviour = "dizzy" then 1 ELSE NULL END) as "dizzyCount"'),
                    DB::raw('COUNT(CASE WHEN sa.student_behaviour = "surprise" then 1 ELSE NULL END) as "surpriseCount"'),
                    DB::raw('COUNT(CASE WHEN sa.student_behaviour = "tired" then 1 ELSE NULL END) as "tiredCount"')
                )
                // ->join('enrolls as en', 'sa.student_id', '=', 'en.student_id')
                // ->join('students as stud', 'sa.student_id', '=', 'stud.id')
                ->where([
                    ['sa.class_id', '=', $request->class_id],
                    ['sa.section_id', '=', $request->section_id],
                    ['sa.subject_id', '=', $request->subject_id],
                    ['sa.student_id', '=', $request->student_id]
                ])
                ->whereMonth('sa.date', $month)
                ->whereYear('sa.date', $year)
                // ->groupBy('sa.date')
                ->get();

            return $this->successResponse($getStudBehaviour, 'attitude record fetch successfully');
        }
    }
    // getShortTestByStudent
    function getShortTestByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'subject_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);

            $getShortTest = $Connection->table('short_tests as sht')
                ->select(
                    'sht.id',
                    // DB::raw("group_concat(sht.test_marks,'|',sht.grade_status) as scoremarks"),
                    'sht.test_name',
                    'sht.test_marks',
                    'sht.grade_status',
                    'sht.date'
                )
                ->where([
                    ['sht.class_id', '=', $request->class_id],
                    ['sht.section_id', '=', $request->section_id],
                    ['sht.subject_id', '=', $request->subject_id],
                    ['sht.student_id', '=', $request->student_id]
                ])
                // ->groupBy('sht.date')
                ->get();
            // dd($getShortTest);
            // if (!empty($getShortTest)) {
            //     foreach ($getShortTest as $test) {
            //         // dd($home);
            //         $testnames = explode(",", $test->test_name);
            //         print_r($testnames);
            //         if (!empty($testnames)) {
            //             foreach ($testnames as $names) {
            //                 echo $names;
            //             }
            //         }
            //         // echo $test->id;
            //         // echo $test->test_name;
            //         // echo $test->test_marks;
            //         // echo $test->grade_status;
            //         // echo $test->date;
            //         // echo "<pre>";
            //     }
            // }
            // exit;
            return $this->successResponse($getShortTest, 'Short test record fetch successfully');
        }
    }
    public function getSubjectAverageByStudent(Request $request)
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


            $check = $Connection->table('student_subjectdivision')
                ->where([
                    ['class_id', '=', $request->class_id],
                    ['section_id', '=', $request->section_id],
                    ['subject_id', '=', $request->subject_id]
                ])
                ->get()->toArray();
            if ($check) {
                $studentdetails = $Connection->table('student_subjectdivision_inst as ssd')->select('ssd.exam_id', 'te.exam_date', DB::raw('round(AVG(ssd.total_score), 2) as average'))
                    ->leftJoin('timetable_exam as te', function ($join) {
                        $join->on('te.exam_id', '=', 'ssd.exam_id')
                            ->on('te.class_id', '=', 'ssd.class_id')
                            ->on('te.section_id', '=', 'ssd.section_id')
                            ->on('te.subject_id', '=', 'ssd.subject_id');
                    })
                    ->where([
                        ['ssd.class_id', '=', $request->class_id],
                        ['ssd.section_id', '=', $request->section_id],
                        ['ssd.subject_id', '=', $request->subject_id],
                        ['ssd.student_id', '=', $request->student_id]
                    ])
                    ->groupBy('ssd.exam_id')
                    ->orderBy('te.exam_date', 'ASC')
                    ->get();
            } else {
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
                        ['sm.subject_id', '=', $request->subject_id],
                        ['sm.student_id', '=', $request->student_id]
                    ])
                    ->groupBy('sm.exam_id')
                    ->orderBy('te.exam_date', 'ASC')
                    ->get();
            }

            return $this->successResponse($studentdetails, 'Subject average by student fetch successfully');
        }
    }
    // get exam marks by report graph
    function getExamMarksByStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
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
            $Connection = $this->createNewConnection($request->branch_id);
            $getStudBehaviour = $Connection->table('student_marks as sm')
                ->select(
                    'sm.score',
                    'ex.name as exam_name',
                    'sb.name as subject_name'
                    // DB::raw('group_concat(sm.score) as scores'),
                    // DB::raw('group_concat(sb.name) as subject_name')
                )
                ->join('subjects as sb', 'sm.subject_id', '=', 'sb.id')
                ->join('exam as ex', 'sm.exam_id', '=', 'ex.id')
                ->where([
                    ['sm.class_id', '=', $request->class_id],
                    ['sm.section_id', '=', $request->section_id],
                    ['sm.subject_id', '=', $request->subject_id],
                    ['sm.student_id', '=', $request->student_id]
                ])
                // ->groupBy('sm.exam_id')
                ->get();

            return $this->successResponse($getStudBehaviour, 'exam result record fetch successfully');
        }
    }
    // get student by all subjects
    function getStudentByAllSubjects(Request $request)
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
            $getStudentAllSubjects = $Connection->table('enrolls as en')
                ->select(
                    // 'en.student_id',
                    // 'en.class_id',
                    // 'en.section_id',
                    'sa.subject_id',
                    'sb.name as subject_name'
                )
                ->join('subject_assigns as sa', function ($q) {
                    $q->on('sa.class_id', '=', 'en.class_id')
                        ->on('sa.section_id', '=', 'en.section_id');
                })
                ->join('subjects as sb', 'sb.id', '=', 'sa.subject_id')
                ->where([
                    ['en.student_id', '=', $request->student_id],
                    ['sa.type', '=', '0']
                ])
                ->groupBy('sa.subject_id')
                ->get();

            return $this->successResponse($getStudentAllSubjects, 'get all subjects fetch successfully');
        }
    }
    // get class section by student
    function getClassSectionByStudent(Request $request)
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
            $getStudentClassSection = $Connection->table('enrolls as en')
                ->select(
                    'en.student_id',
                    'en.class_id',
                    'en.section_id'
                )
                ->where([
                    ['en.student_id', '=', $request->student_id]
                ])
                ->first();
            return $this->successResponse($getStudentClassSection, 'get class and section record successfully');
        }
    }
    // get schedule exam details
    function getScheduleExamDetails(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $getTimeTableCalendor = $Connection->table('timetable_exam as tex')
                ->select(
                    'tex.id as schedule_id',
                    'tex.time_start',
                    'tex.time_end',
                    'cl.name as class_name',
                    'sc.name as section_name',
                    'ex.name as exam_name',
                    DB::raw("CONCAT('Exam Name: ',ex.name, ' - ', sbj.name) as title"),
                    'sbj.name as subject_name',
                    'sbj.subject_color_calendor as color',
                    'tex.exam_date as start'
                )
                ->join('classes as cl', 'tex.class_id', '=', 'cl.id')
                ->join('sections as sc', 'tex.section_id', '=', 'sc.id')
                ->join('subjects as sbj', 'tex.subject_id', '=', 'sbj.id')
                ->join('exam as ex', 'tex.exam_id', '=', 'ex.id')
                // ->where([
                //     ['en.student_id', '=', $request->student_id]
                // ])
                ->get();
            return $this->successResponse($getTimeTableCalendor, 'get schedule exam details record successfully');
        }
    }
    // get schedule exam details by teacher
    function getScheduleExamDetailsBYTeacher(Request $request)
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
            $getTimeTableCalendor = $Connection->table('subject_assigns as sa')
                ->select(
                    'tex.id as schedule_id',
                    'tex.time_start',
                    'tex.time_end',
                    'cl.name as class_name',
                    'sc.name as section_name',
                    'ex.name as exam_name',
                    DB::raw("CONCAT('Exam Name: ',ex.name, ' - ', sbj.name) as title"),
                    'sbj.name as subject_name',
                    'sbj.subject_color_calendor as color',
                    'tex.exam_date as start'
                )
                ->join('timetable_exam as tex', function ($q) {
                    $q->on('tex.class_id', '=', 'sa.class_id')
                        ->on('tex.section_id', '=', 'sa.section_id') //second join condition                           
                        ->on('tex.subject_id', '=', 'sa.subject_id'); //need to add subject id also later                           
                })
                ->join('classes as cl', 'tex.class_id', '=', 'cl.id')
                ->join('sections as sc', 'tex.section_id', '=', 'sc.id')
                ->join('subjects as sbj', 'tex.subject_id', '=', 'sbj.id')
                ->join('exam as ex', 'tex.exam_id', '=', 'ex.id')
                ->where([
                    ['sa.teacher_id', '=', $request->teacher_id]
                ])
                ->get();
            return $this->successResponse($getTimeTableCalendor, 'get schedule exam details record successfully');
        }
    }
    // get schedule exam details by student
    function getScheduleExamDetailsBYStudent(Request $request)
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
            $getStudentExamSchedule = $Connection->table('enrolls as en')
                ->select(
                    'tex.id as schedule_id',
                    'tex.time_start',
                    'tex.time_end',
                    'cl.name as class_name',
                    'sc.name as section_name',
                    'ex.name as exam_name',
                    DB::raw("CONCAT('Exam Name: ',ex.name, ' - ', sbj.name) as title"),
                    'sbj.name as subject_name',
                    'sbj.subject_color_calendor as color',
                    'tex.exam_date as start'
                )
                ->join('timetable_exam as tex', function ($q) {
                    $q->on('tex.class_id', '=', 'en.class_id')
                        ->on('tex.section_id', '=', 'en.section_id');
                })
                ->join('classes as cl', 'tex.class_id', '=', 'cl.id')
                ->join('sections as sc', 'tex.section_id', '=', 'sc.id')
                ->join('subjects as sbj', 'tex.subject_id', '=', 'sbj.id')
                ->join('exam as ex', 'tex.exam_id', '=', 'ex.id')
                ->where([
                    ['en.student_id', '=', $request->student_id]
                ])
                ->get();
            return $this->successResponse($getStudentExamSchedule, 'get schedule exam details record successfully');
        }
    }

    // add TransportVehicle
    public function addTransportVehicle(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'vehicle_no' => 'required',
            'capacity' => 'required',
            'insurance_renewal' => 'required',
            'driver_phone' => 'required',
            'driver_name' => 'required',
            'driver_license' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // insert data
            $query = $conn->table('transport_vehicle')->insert([
                'vehicle_no' => $request->vehicle_no,
                'capacity' => $request->capacity,
                'insurance_renewal' => $request->insurance_renewal,
                'driver_phone' => $request->driver_phone,
                'driver_name' => $request->driver_name,
                'driver_license' => $request->driver_license,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Transport Vehicle has been successfully saved');
            }
        }
    }
    // getTransportVehicleList
    public function getTransportVehicleList(Request $request)
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
            $transportVehicleDetails = $conn->table('transport_vehicle')->get();
            return $this->successResponse($transportVehicleDetails, 'Transport Vehicle record fetch successfully');
        }
    }
    // get TransportVehicle row details
    public function getTransportVehicleDetails(Request $request)
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
            $transportVehicleDetails = $conn->table('transport_vehicle')->where('id', $id)->first();
            return $this->successResponse($transportVehicleDetails, 'Transport Vehicle row fetch successfully');
        }
    }
    // update TransportVehicle
    public function updateTransportVehicle(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'vehicle_no' => 'required',
            'capacity' => 'required',
            'insurance_renewal' => 'required',
            'driver_phone' => 'required',
            'driver_name' => 'required',
            'driver_license' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // update data
            $query = $conn->table('transport_vehicle')->where('id', $id)->update([
                'vehicle_no' => $request->vehicle_no,
                'capacity' => $request->capacity,
                'insurance_renewal' => $request->insurance_renewal,
                'driver_phone' => $request->driver_phone,
                'driver_name' => $request->driver_name,
                'driver_license' => $request->driver_license,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Vehicle Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete TransportVehicle
    public function deleteTransportVehicle(Request $request)
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
            $query = $conn->table('transport_vehicle')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Vehicle have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // getBulkCalendorTeacher
    public function getBulkCalendorTeacher(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'teacher_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $success = $Connection->table('calendors as cl')
                ->select('cl.id', 'cl.class_id', 'cl.title', 'cl.title as name', 'cl.time_table_id', 'cl.section_id', 'cl.subject_id', 'cl.start', 'cl.event_id', 'cl.end', "cl.teacher_id", "bulk_id")
                ->join('subject_assigns as sa', function ($q) {
                    $q->on('cl.class_id', '=', 'sa.class_id')
                        ->on('cl.section_id', '=', 'sa.section_id');
                })
                ->where('sa.teacher_id', $request->teacher_id)
                ->where("cl.teacher_id", "0")
                ->orWhere("cl.teacher_id", $request->teacher_id)
                ->whereNotNull('cl.bulk_id')
                ->groupBy('cl.start')
                ->get();

            // dd($success);
            $output = [];
            foreach ($success as $suc) {
                $data = $suc;
                $data->color = "bg-success";
                array_push($output, $data);
            }
            // dd($success);
            return $this->successResponse($output, 'calendor data get successfully');
        }
    }

    // getBulkCalendorAdmin
    public function getBulkCalendorAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $success = $Connection->table('calendors as cl')
                ->select('cl.id', 'cl.class_id', 'cl.title', 'cl.title as name', 'cl.time_table_id', 'cl.section_id', 'cl.subject_id', 'cl.start', 'cl.event_id', 'cl.end', "cl.teacher_id", "bulk_id")
                ->where("cl.teacher_id", "0")
                ->whereNotNull('cl.bulk_id')
                ->groupBy('cl.start')
                ->get();

            // dd($success);
            $output = [];
            foreach ($success as $suc) {
                $data = $suc;
                $data->color = "bg-success";
                array_push($output, $data);
            }
            // dd($success);
            return $this->successResponse($output, 'calendor data get successfully');
        }
    }

    // getBulkCalendorStudent
    public function getBulkCalendorStudent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'student_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $Connection = $this->createNewConnection($request->branch_id);
            $success = $Connection->table('calendors as cl')
                ->select('cl.id', 'cl.class_id', 'cl.title', 'cl.title as name', 'cl.time_table_id', 'cl.section_id', 'cl.subject_id', 'cl.start', 'cl.event_id', 'cl.end', "cl.teacher_id", "bulk_id")
                ->join('enrolls as e', function ($q) {
                    $q->on('cl.class_id', '=', 'e.class_id')
                        ->on('cl.section_id', '=', 'e.section_id');
                })
                ->where('e.student_id', $request->student_id)
                ->whereNotNull('cl.bulk_id')
                ->groupBy('cl.start')
                ->get();

            // dd($success);
            $output = [];
            foreach ($success as $suc) {
                $data = $suc;
                $data->color = "bg-success";
                array_push($output, $data);
            }
            // dd($success);
            return $this->successResponse($output, 'calendor data get successfully');
        }
    }
    // unread Notifications
    public function unreadNotifications(Request $request)
    {

        $id = auth()->user()->id;
        // $notifications = auth()->user()->unreadnotifications()
        $res = [
            'unread' => auth()->user()->unreadnotifications,
            'unread_count' => auth()->user()->unreadnotifications->count(),
            'read' => auth()->user()->notifications()
                ->whereNotNull('read_at')
                ->orderBy('read_at', 'asc')
                ->orderBy('created_at', 'desc')
                ->where('notifiable_id', $id)
                ->get()
        ];

        // $notifications = auth()->user()->notifications()
        //     ->orderBy('read_at', 'asc')
        //     ->orderBy('created_at', 'desc')
        //     ->where('notifiable_id', $id)
        //     ->get();
        return $this->successResponse($res, 'get notifications data get successfully');
    }
    // markAsRead
    public function markAsRead(Request $request)
    {

        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
        return $this->successResponse(response()->noContent(), 'mark as read');
    }

    // add TransportAssign
    public function addTransportAssign(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'route_id' => 'required',
            'stoppage_id' => 'required',
            'vehicle_id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // insert data
            $query = $conn->table('transport_assign')->insert([
                'route_id' => $request->route_id,
                'stoppage_id' => $request->stoppage_id,
                'vehicle_id' => $request->vehicle_id,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Transport Assign has been successfully saved');
            }
        }
    }
    // getTransportAssignList
    public function getTransportAssignList(Request $request)
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
            $transportAssignDetails = $conn->table('transport_assign as ta')
                ->select('ta.*', 'tr.name as route_name', 'tv.vehicle_no', 'ts.stop_position')
                ->join('transport_route as tr', 'ta.route_id', '=', 'tr.id')
                ->join('transport_vehicle as tv', 'ta.vehicle_id', '=', 'tv.id')
                ->join('transport_stoppage as ts', 'ta.stoppage_id', '=', 'ts.id')->get();
            return $this->successResponse($transportAssignDetails, 'Transport Assign record fetch successfully');
        }
    }
    // get TransportAssign row details
    public function getTransportAssignDetails(Request $request)
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
            $transportAssignDetails = $conn->table('transport_assign')->where('id', $id)->first();
            return $this->successResponse($transportAssignDetails, 'Transport Assign row fetch successfully');
        }
    }
    // update TransportAssign
    public function updateTransportAssign(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'route_id' => 'required',
            'stoppage_id' => 'required',
            'vehicle_id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // update data
            $query = $conn->table('transport_assign')->where('id', $id)->update([
                'route_id' => $request->route_id,
                'stoppage_id' => $request->stoppage_id,
                'vehicle_id' => $request->vehicle_id,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Assign Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete TransportAssign
    public function deleteTransportAssign(Request $request)
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
            $query = $conn->table('transport_assign')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Transport Assign have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add HostelBlock
    public function addHostelBlock(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'block_name' => 'required',
            'block_warden' => 'required',
            'total_floor' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // insert data
            $query = $conn->table('hostel_block')->insert([
                'block_name' => $request->block_name,
                'block_warden' => $request->block_warden,
                'total_floor' => $request->total_floor,
                'block_leader' => $request->block_leader,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Hostel Block has been successfully saved');
            }
        }
    }
    // getHostelBlockList
    public function getHostelBlockList(Request $request)
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
            $hostelBlockDetails = $conn->table('hostel_block')->get();
            return $this->successResponse($hostelBlockDetails, 'Hostel Block record fetch successfully');
        }
    }
    // get HostelBlock row details
    public function getHostelBlockDetails(Request $request)
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
            $hostelBlockDetails = $conn->table('hostel_block')->where('id', $id)->first();
            return $this->successResponse($hostelBlockDetails, 'Hostel Block row fetch successfully');
        }
    }
    // update HostelBlock
    public function updateHostelBlock(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'block_name' => 'required',
            'block_warden' => 'required',
            'total_floor' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // update data
            $query = $conn->table('hostel_block')->where('id', $id)->update([
                'block_name' => $request->block_name,
                'block_warden' => $request->block_warden,
                'total_floor' => $request->total_floor,
                'block_leader' => $request->block_leader,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Block Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete HostelBlock
    public function deleteHostelBlock(Request $request)
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
            $query = $conn->table('hostel_block')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Block have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // add HostelFloor
    public function addHostelFloor(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'floor_name' => 'required',
            'block_id' => 'required',
            'floor_warden' => 'required',
            'total_room' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // insert data
            $query = $conn->table('hostel_floor')->insert([
                'floor_name' => $request->floor_name,
                'block_id' => $request->block_id,
                'floor_warden' => $request->floor_warden,
                'floor_leader' => $request->floor_leader,
                'total_room' => $request->total_room,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Hostel Floor has been successfully saved');
            }
        }
    }
    // getHostelFloorList
    public function getHostelFloorList(Request $request)
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
            $hostelFloorDetails = $conn->table('hostel_floor')->get();
            return $this->successResponse($hostelFloorDetails, 'Hostel Floor record fetch successfully');
        }
    }
    // get HostelFloor row details
    public function getHostelFloorDetails(Request $request)
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
            $hostelFloorDetails = $conn->table('hostel_floor')->where('id', $id)->first();
            return $this->successResponse($hostelFloorDetails, 'Hostel Floor row fetch successfully');
        }
    }
    // update HostelFloor
    public function updateHostelFloor(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'floor_name' => 'required',
            'block_id' => 'required',
            'floor_warden' => 'required',
            'total_room' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // update data
            $query = $conn->table('hostel_floor')->where('id', $id)->update([
                'floor_name' => $request->floor_name,
                'block_id' => $request->block_id,
                'floor_warden' => $request->floor_warden,
                'floor_leader' => $request->floor_leader,
                'total_room' => $request->total_room,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Floor Details have Been updated');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // delete HostelFloor
    public function deleteHostelFloor(Request $request)
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
            $query = $conn->table('hostel_floor')->where('id', $id)->delete();

            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Hostel Floor have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }
    // get absent late excuse classroom
    public function getAbsentLateExcuse(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'attendance_type' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $secConn = $this->createNewConnection($request->branch_id);
            $data = [];
            if ($request->attendance_type == "absent") {
                $table_name = 'absent_reasons';
            }
            if ($request->attendance_type == "late") {
                $table_name = 'late_reasons';
            }
            if ($request->attendance_type == "excused") {
                $table_name = 'excused_reasons';
            }
            if (isset($table_name)) {
                $data = $secConn->table($table_name)
                    ->select('id', 'name')
                    ->get();
            }
            return $this->successResponse($data, 'reasons details fetch successfully');
        }
    }
    // add Group
    public function addGroup(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'name' => 'required',
        ]);

        //    return $request;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            $staff = NULL;
            $parent = NULL;
            $student = NULL;
            if (!empty($request->staff)) {
                $staff =  implode(",", $request->staff);
            }
            if (!empty($request->parent)) {
                $parent =  implode(",", $request->parent);
            }
            if (!empty($request->student)) {
                $student =  implode(",", $request->student);
            }
            $query = $conn->table('groups')->insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'staff' => $staff,
                'parent' => $parent,
                'student' => $student,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Group has been successfully saved');
            }
        }
    }
    // get Groups 
    public function getGroupList(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $groupDetails = $conn->table('groups')->get()->toArray();
            return $this->successResponse($groupDetails, 'Group record fetch successfully');
        }
    }
    // get Group row details
    public function getGroupDetails(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'token' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data


            $id = $request->id;
            $group = $conn->table('groups')->where('id', $id)->first();

            $staff = NULL;
            $parent = NULL;
            $student = NULL;

            if ($group->staff) {
                $group_staff = explode(",", $group->staff);
                $staff = [];
                foreach ($group_staff as $gs) {
                    $data = $conn->table('staffs as s')
                        ->select("s.id", DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"), DB::raw("GROUP_CONCAT(DISTINCT  dp.name) as department_name"))
                        ->leftJoin("staff_departments as dp", DB::raw("FIND_IN_SET(dp.id,s.department_id)"), ">", DB::raw("'0'"))
                        ->where('s.id', $gs)->first();
                    array_push($staff, $data);
                }
            }

            if ($group->student) {
                $group_student = explode(",", $group->student);
                $student = [];
                foreach ($group_student as $gs) {
                    $data = $conn->table('students as s')
                        ->select("s.id", DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"), 'c.name as class_name', 'sc.name as section_name')
                        ->leftJoin('enrolls as e', 'e.student_id', '=', 's.id')
                        ->leftJoin('classes as c', 'e.class_id', '=', 'c.id')
                        ->leftJoin('sections as sc', 'e.section_id', '=', 'sc.id')
                        ->where('s.id', $gs)->first();
                    array_push($student, $data);
                }
            }

            if ($group->parent) {
                $group_parent = explode(",", $group->parent);
                $parent = [];
                foreach ($group_parent as $gp) {
                    $data = $conn->table('parent')->select("id", DB::raw("CONCAT(first_name, ' ', last_name) as name"), 'email')->where('id', $gp)->first();
                    array_push($parent, $data);
                }
            }

            $groupDetails['group'] = $group;
            $groupDetails['staff'] = $staff;
            $groupDetails['student'] = $student;
            $groupDetails['parent'] = $parent;
            return $this->successResponse($groupDetails, 'Group row fetch successfully');
        }
    }
    // update Group
    public function updateGroup(Request $request)
    {
        $id = $request->id;
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
            'name' => 'required',
        ]);

        //    return $request;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {

            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            $staff = NULL;
            $parent = NULL;
            $student = NULL;
            if (!empty($request->staff)) {
                $staff =  implode(",", $request->staff);
            }
            if (!empty($request->parent)) {
                $parent =  implode(",", $request->parent);
            }
            if (!empty($request->student)) {
                $student =  implode(",", $request->student);
            }

            $query = $conn->table('groups')->where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'staff' => $staff,
                'parent' => $parent,
                'student' => $student,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            $success = [];
            if (!$query) {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            } else {
                return $this->successResponse($success, 'Group has been successfully Updated');
            }
        }
    }
    // delete Group
    public function deleteGroup(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
            'branch_id' => 'required',
        ]);
        $group_id = $request->id;
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $query = $conn->table('groups')->where('id', $group_id)->delete();
            $success = [];
            if ($query) {
                return $this->successResponse($success, 'Group have been deleted successfully');
            } else {
                return $this->send500Error('Something went wrong.', ['error' => 'Something went wrong']);
            }
        }
    }

    // get Student Name
    public function getStudentName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data

            $data = $conn->table('students as s')
                ->select("s.id", DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"), 'c.name as class_name', 'sc.name as section_name')
                ->leftJoin('enrolls as e', 'e.student_id', '=', 's.id')
                ->leftJoin('classes as c', 'e.class_id', '=', 'c.id')
                ->leftJoin('sections as sc', 'e.section_id', '=', 'sc.id')
                ->where("s.first_name", "LIKE", "%{$request->name}%")
                ->orWhere("s.last_name", "LIKE", "%{$request->name}%")
                ->get();
            $output = '';
            if ($request->name) {
                if (!$data->isEmpty()) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {

                        $output .= '<li class="list-group-item" value="' . $row->id . '">' . $row->name . ' ( ' . $row->class_name . ' - ' .  $row->section_name . ' )</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
                }
            } else {
                $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
            }
            return $output;
        }
    }

    // get Staff Name
    public function getStaffName(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'token' => 'required'
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);
            // get data
            $data = $conn->table('staffs as s')
                ->select("s.id", DB::raw("CONCAT(s.first_name, ' ', s.last_name) as name"), DB::raw("GROUP_CONCAT(DISTINCT  dp.name) as department_name"))
                ->where("s.first_name", "LIKE", "%{$request->name}%")
                ->orWhere("s.last_name", "LIKE", "%{$request->name}%")
                ->leftJoin("staff_departments as dp", DB::raw("FIND_IN_SET(dp.id,s.department_id)"), ">", DB::raw("'0'"))
                ->groupBy("s.id")
                ->get();
            $output = '';
            if ($request->name) {
                if (!$data->isEmpty()) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        $output .= '<li class="list-group-item" value="' . $row->id . '">' . $row->name . '( ' . $row->department_name . ' ) </li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
                }
            } else {
                $output .= '<li class="list-group-item">' . 'No results Found' . '</li>';
            }
            return $output;
        }
    }

    // get Semester and Session
    public function getSemesterSession(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'branch_id' => 'required',
        ]);
        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            // create new connection
            $conn = $this->createNewConnection($request->branch_id);

            // get data
            $success['semester'] = $conn->table('semester')->whereRaw('(now() between start_date and end_date)')->first();
            $hour = Carbon::now()->format('H');

            if ($hour < 13) {
                $session = 1;
            } else {
                $session = 2;
            }
            $success['session'] = $session;

            return $this->successResponse($success, 'Semester and Session Fetched successfully');
        }
    }
}
