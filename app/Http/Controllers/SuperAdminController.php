<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;
use App\Helpers\Helper;
use App\Models\Branches;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Task;
class SuperAdminController extends Controller
{
    //
    public function index()
    {
        return view('super_admin.dashboard.index');
    }
    // get section
    public function section()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view('super_admin.section.index', ['branches' => $getBranches['data']]);
    }

    // add section
    public function addSection(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'capacity' => $request->capacity
            ];
            $response = Helper::PostMethod(config('constants.api.section_add'), $data);

            return $response;
        }
    }
    // get sections 
    public function getSectionList(Request $request)
    {
        $response = Helper::GetMethod(config('constants.api.section_list'));
        return DataTables::of($response['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                // dd($row);
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
        $data = [
            'section_id' => $request->section_id,
        ];
        $response = Helper::PostMethod(config('constants.api.section_details'), $data);
        return $response;
    }
    // update section
    public function updateSectionDetails(Request $request)
    {
        $section_id = $request->sid;

        $validator = \Validator::make($request->all(), [
            'sid' => 'required',
            'branch_id' => 'required',
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'sid' => $section_id,
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'capacity' => $request->capacity,
            ];
            $response = Helper::PostMethod(config('constants.api.section_update'), $data);
            return $response;
        }
    }
    // delete Section
    public function deleteSection(Request $request)
    {

        $section_id = $request->sid;
        $validator = \Validator::make($request->all(), [
            'sid' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'sid' => $section_id
            ];
            $response = Helper::PostMethod(config('constants.api.section_delete'), $data);
            return $response;
        }
    }

    // branch index
    public function branchIndex()
    {
        $countries = Helper::GetMethod(config('constants.api.countries'));
        return view('super_admin.branch.index', ['countries' => $countries['data']]);
    }
    public function branchCreate()
    {
        $countries = Helper::GetMethod(config('constants.api.countries'));
        return view('super_admin.branch.create', ['countries' => $countries['data']]);
    }
    // add branch
    public function addBranch(Request $request)
    {

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'branch_name' => $request->branch_name,
            'school_name' => $request->school_name,
            'school_code' => $request->school_code,
            'passport' => $request->passport,
            'nric_number' => $request->nric_number,
            'mobile_no' => $request->mobile_no,
            'currency' => $request->currency,
            'symbol' => $request->symbol,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'address1' => $request->address1,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'status' => $request->status,
            'location' => $request->location,
            'db_name' => $request->db_name,
            'db_username' => $request->db_username,
            'db_password' => $request->db_password,
            'school_type' => $request->school_type,
            'db_host' => $request->db_host,
            'db_port' => $request->db_port
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.branch_add'), $data);
        return $response;
    }
    //
    // get branch 
    public function getBranchList(Request $request)
    {
        $data = [
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ];
        $branch = Helper::DataTableGetMethod(config('constants.api.branch_list'), $data);
        return DataTables::of($branch['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                // dd($row);
                return '<div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })
            // ->parameters([
            //     'dom'          => 'Bfrtip',
            //     'buttons'      => ['excel', 'csv'],
            // ])
            ->rawColumns(['actions'])
            ->make(true);
    }
    // branch index
    public function getEditDetails(Request $request, $id)
    {
        $countries = Helper::GetMethod(config('constants.api.countries'));

        $res = [
            'id' => $id,
        ];
        $branch = Helper::PostMethod(config('constants.api.branch_details'), $res);

        $getStates = [
            'country_id' => $branch['data']['country_id']
        ];
        $states = Helper::PostMethod(config('constants.api.states'), $getStates);

        $getCities = [
            'state_id' => $branch['data']['state_id']
        ];
        $cities = Helper::PostMethod(config('constants.api.cities'), $getCities);

        return view('super_admin.branch.edit', [
            'id' => $id,
            'countries' => $countries['data'],
            'branch' => $branch['data'],
            'states' => $states['data'],
            'cities' => $cities['data']
        ]);
    }

    // update branch
    public function updateBranchDetails(Request $request)
    {
        // $data = [
        //     'id' => $request->id,
        //     'name' => $request->name,
        //     'school_name' => $request->school_name,
        //     'email' => $request->email,
        //     'mobile_no' => $request->mobile_no,
        //     'currency' => $request->currency,
        //     'symbol' => $request->symbol,
        //     'country_id' => $request->country,
        //     'state_id' => $request->state,
        //     'city_id' => $request->city,
        //     'address' => $request->address
        // ];
        $data = [
            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'branch_name' => $request->branch_name,
            'school_name' => $request->school_name,
            'school_code' => $request->school_code,
            'passport' => $request->passport,
            'nric_number' => $request->nric_number,
            'mobile_no' => $request->mobile_no,
            'currency' => $request->currency,
            'symbol' => $request->symbol,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'address1' => $request->address1,
            'email' => $request->email,
            'password' => $request->password,
            'confirm_password' => $request->confirm_password,
            'status' => $request->status,
            'location' => $request->location,
            'school_type' => $request->school_type,
        ];
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.branch_update'), $data);
        return $response;
    }

    // delete branch
    public function deleteBranch(Request $request)
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
            ];
            $response = Helper::PostMethod(config('constants.api.branch_delete'), $data);
            return $response;
        }
    }

    // get class
    public function class()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view('super_admin.class.index', ['branches' => $getBranches['data']]);
    }


    // section allocations
    public function showSectionAllocation()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view(
            'super_admin.section_allocation.allocation',
            [
                'branches' => $getBranches['data']
            ]
        );
    }
    // add branch
    public function addSectionAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'branch_id' => $request->branch_id,
                'class_id' => $request->class_name,
                'section_id' => $request->section_name
            ];
            $response = Helper::PostMethod(config('constants.api.allocate_section_add'), $data);
            return $response;
        }
    }
    // get branch 
    public function getSectionAllocationList(Request $request)
    {
        $sectionAllocation = Helper::GetMethod(config('constants.api.allocate_section_list'));
        return DataTables::of($sectionAllocation['data'])
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
    // get getSectionAllocationDetails details
    public function getSectionAllocationDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.allocate_section_details'), $data);
        return $response;
    }

    // update Section Allocations
    public function updateSectionAllocation(Request $request)
    {
        $id = $request->said;

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->said,
                'branch_id' => $request->branch_id,
                'class_id' => $request->class_name,
                'section_id' => $request->section_name
            ];
            $response = Helper::PostMethod(config('constants.api.allocate_section_update'), $data);
            return $response;
        }
    }

    // delete deleteSectionAllocation
    //  public function (Request $request){
    //     $id = $request->id;
    //     SectionAllocation::where('id', $id)->delete();
    //     return response()->json(['code'=>1, 'msg'=>'Section Allocation have been deleted from database']); 
    // }
    public function deleteSectionAllocation(Request $request)
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
            ];
            $response = Helper::PostMethod(config('constants.api.allocate_section_delete'), $data);
            return $response;
        }
    }
    // get TeacherAllocation
    public function showTeacherAllocation()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view('super_admin.assign_teacher.index', ['branches' => $getBranches['data']]);
    }
    // add TeacherAllocation
    public function addTeacherAllocation(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required',
            'class_teacher' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {


            $data = [
                'branch_id' => $request->branch_id,
                'class_name' => $request->class_name,
                'section_name' => $request->section_name,
                'class_teacher' => $request->class_teacher,
            ];
            $response = Helper::PostMethod(config('constants.api.assign_teacher_add'), $data);

            return $response;
        }
    }
    // get TeacherAllocation 
    public function getTeacherAllocationList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.assign_teacher_list'));
        $row = $response['data'];
        return DataTables::of($row)

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                            <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editTeacherAllocationBtn"><i class="fe-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteTeacherAllocationBtn"><i class="fe-trash-2"></i></a>
                    </div>';
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
    // get TeacherAllocation row details
    public function getTeacherAllocationDetails(Request $request)
    {
        $data = [
            'teacher_allocation__id' => $request->assign_teacher_id,
        ];
        $response = Helper::PostMethod(config('constants.api.assign_teacher_details'), $data);
        return $response;
    }
    // update TeacherAllocation
    public function updateTeacherAllocation(Request $request)
    {
        $assign_teacher_id = $request->assign_teacher_id;

        $validator = \Validator::make($request->all(), [
            'assign_teacher_id' => 'required',
            'branch_id' => 'required',
            'class_name' => 'required',
            'section_name' => 'required',
            'class_teacher' => 'required'
        ]);


        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'teacher_allocation__id' => $assign_teacher_id,
                'branch_id' => $request->branch_id,
                'class_name' => $request->class_name,
                'section_name' => $request->section_name,
                'class_teacher' => $request->class_teacher,
            ];

            $response = Helper::PostMethod(config('constants.api.assign_teacher_update'), $data);
            return $response;
        }
    }
    // delete TeacherAllocation
    public function deleteTeacherAllocation(Request $request)
    {

        $assign_teacher_id = $request->assign_teacher_id;
        $validator = \Validator::make($request->all(), [
            'assign_teacher_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'teacher_allocation__id' => $assign_teacher_id
            ];
            $response = Helper::PostMethod(config('constants.api.assign_teacher_delete'), $data);
            return $response;
        }
    }

    // add class
    public function addClass(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required',
            'name_numeric' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'name_numeric' => $request->name_numeric
            ];
            $response = Helper::PostMethod(config('constants.api.class_add'), $data);

            return $response;
        }
    }
    // get class 
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
    // get class row details
    public function getClassDetails(Request $request)
    {
        $data = [
            'class_id' => $request->class_id,
        ];
        $response = Helper::PostMethod(config('constants.api.class_details'), $data);
        return $response;
    }
    // update class
    public function updateClassDetails(Request $request)
    {
        $class_id = $request->class_id;

        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
            'branch_id' => 'required',
            'name' => 'required',
            'name_numeric' => 'required',
        ]);


        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'class_id' => $class_id,
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'name_numeric' => $request->name_numeric,
            ];

            $response = Helper::PostMethod(config('constants.api.class_update'), $data);
            return $response;
        }
    }
    // delete class
    public function deleteClass(Request $request)
    {

        $class_id = $request->class_id;
        $validator = \Validator::make($request->all(), [
            'class_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'class_id' => $class_id
            ];
            $response = Helper::PostMethod(config('constants.api.class_delete'), $data);
            return $response;
        }
    }
    // get department 
    public function Department()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view(
            'super_admin.department.index',
            [
                'branches' => $getBranches['data']
            ]
        );
    }
    //add Department
    public function addDepartment(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'branch_id' => $request->branch_id,
                'name' => $request->name
            ];
            $response = Helper::PostMethod(config('constants.api.department_add'), $data);
            return $response;
        }
    }
    // get DepartmentList
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
    // get department row details
    public function getDepartmentDetails(Request $request)
    {
        $data = [
            'id' => $request->id,
        ];
        $response = Helper::PostMethod(config('constants.api.department_details'), $data);
        return $response;
    }
    // update department
    public function updateDepartment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'name' => $request->name,
                'branch_id' => $request->branch_id
            ];

            $response = Helper::PostMethod(config('constants.api.department_update'), $data);
            return $response;
        }
    }
    // delete department
    public function deleteDepartment(Request $request)
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
            $response = Helper::PostMethod(config('constants.api.department_delete'), $data);
            return $response;
        }
    }
    // get Designation 
    public function Designation()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view(
            'super_admin.designation.index',
            [
                'branches' => $getBranches['data']
            ]
        );
    }

    //add Designation
    public function addDesignation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'branch_id' => $request->branch_id,
                'name' => $request->name
            ];
            $response = Helper::PostMethod(config('constants.api.designation_add'), $data);
            return $response;
        }
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
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'name' => $request->name,
                'branch_id' => $request->branch_id
            ];

            $response = Helper::PostMethod(config('constants.api.designation_update'), $data);
            return $response;
        }
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

    // get eventType
    public function eventType()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        return view('super_admin.event_type.index', ['branches' => $getBranches['data']]);
    }

    // add eventType
    public function addEventType(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'name' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'name' => $request->name,
                'branch_id' => $request->branch_id,
            ];
            $response = Helper::PostMethod(config('constants.api.event_type_add'), $data);

            return $response;
        }
    }
    // get eventType 
    public function getEventTypeList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.event_type_list'));

        return DataTables::of($response['data'])

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
    // get eventType row details
    public function getEventTypeDetails(Request $request)
    {
        $data = [
            'event_type_id' => $request->event_type_id,
        ];
        $response = Helper::PostMethod(config('constants.api.event_type_details'), $data);
        return $response;
    }
    // update eventType
    public function updateEventTypeDetails(Request $request)
    {
        $event_type_id = $request->event_type_id;

        $validator = \Validator::make($request->all(), [
            'event_type_id' => 'required',
            'branch_id' => 'required',
            'name' => 'required',
        ]);


        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'event_type_id' => $event_type_id,
                'name' => $request->name,
                'branch_id' => $request->branch_id,
            ];

            $response = Helper::PostMethod(config('constants.api.event_type_update'), $data);
            return $response;
        }
    }
    // delete eventType
    public function deleteEventType(Request $request)
    {

        $event_type_id = $request->event_type_id;
        $validator = \Validator::make($request->all(), [
            'event_type_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'event_type_id' => $event_type_id
            ];
            $response = Helper::PostMethod(config('constants.api.event_type_delete'), $data);
            return $response;
        }
    }
    
    // get event
    public function event()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));
        $getEventType = Helper::GetMethod(config('constants.api.event_type_list'));
        $getClass = Helper::GetMethod(config('constants.api.class_list'));
        $getSection = Helper::GetMethod(config('constants.api.allocate_section_list'));
        return view('super_admin.event.index', ['branches' => $getBranches['data'], 'type' => $getEventType['data'], 'classDetails' => $getClass['data'], 'sectionDetails' => $getSection['data']]);
    }
    // add event
    public function addEvent(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'title' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'class' => '',
            'section' => '',
            'description' => '',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->audience == 2) {
                $selected_list = json_encode($request->class);
            } elseif ($request->audience == 3) {
                $selected_list = json_encode($request->section);
            } else {
                $selected_list = NULL;
            }

            $data = [
                'branch_id' => $request->branch_id,
                'title' => $request->title,
                'type' => $request->type,
                'audience' => $request->audience,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'selected_list' => $selected_list,
                'description' => $request->description,
            ];

            $response = Helper::PostMethod(config('constants.api.event_add'), $data);

            return $response;
        }
    }
    // get event 
    public function getEventList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.event_list'));
        $row = $response['data'];
        return DataTables::of($row)

            ->addIndexColumn()
            ->addColumn('classname', function ($row) {
                $audience = $row['audience'];
                if ($audience == 1) {
                    return "Everyone";
                } else {
                    return "Class " . $row['classname'];
                }
            })
            ->addColumn('status', function ($row) {

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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="viewEventBtn"><i class="fe-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
    // get event row details
    public function getEventDetails(Request $request)
    {
        $data = [
            'event_id' => $request->event_id,
        ];
        $response = Helper::PostMethod(config('constants.api.event_details'), $data);
        return $response;
    }
    // delete event
    public function deleteEvent(Request $request)
    {

        $event_id = $request->event_id;
        $validator = \Validator::make($request->all(), [
            'event_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'event_id' => $event_id
            ];
            $response = Helper::PostMethod(config('constants.api.event_delete'), $data);
            return $response;
        }
    }
    // Publish Event 
    public function publishEvent(Request $request)
    {


        $event_id = $request->event_id;
        $validator = \Validator::make($request->all(), [
            'event_id' => 'required',
            'value' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'event_id' => $event_id,
                'value' => $request->value,
            ];
            $response = Helper::PostMethod(config('constants.api.event_publish'), $data);
            return $response;
        }
    }
    // show employee
    public function showEmployee()
    {
        $getBranches = Helper::GetMethod(config('constants.api.branch_list'));

        $data = [
            'status' => 0
        ];
        $roles = Helper::PostMethod(config('constants.api.roles'), $data);
        //    dd($roles);
        return view(
            'super_admin.employee.index',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
            ]
        );
    }

    //add employee
    public function addEmployee(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'branch_id' => 'required',
            'role' => 'required',
            'joining_date' => 'required',
            'designation' => 'required',
            'department' => 'required',
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
            'password' => 'required',
            'confirm_password' => 'required',
            'facebook_url' => 'required',
            'twitter_url' => 'required',
            'linkedin_url' => 'required',
        ]);


        // dd($validator);   'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'branch_id' => $request->branch_id,
                'role' => $request->role,
                'joining_date' => $request->joining_date,
                'designation' => $request->designation,
                'department' => $request->department,
                'qualification' => $request->qualification,
                'name' => $request->name,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'blood_group' => $request->blood_group,
                'birthday' => $request->birthday,
                'mobile_no' => $request->mobile_no,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                'email' => $request->email,
                'password' => $request->password,
                'confirm_password' => $request->confirm_password,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'linkedin_url' => $request->linkedin_url,
            ];
            $response = Helper::PostMethod(config('constants.api.employee_add'), $data);
            return $response;
        }
    }

    // get Employee
    public function listEmployee()
    {
        return view('super_admin.employee.list');
    }

    // setting show
    public function settings()
    {
        $getUser = Helper::GetMethod(config('constants.api.get_user'));
        return view(
            'super_admin.settings.index',
            [
                'user_details' => $getUser['data']['user'],
            ]
        );
    }


    // get Employee 
    public function getEmployeeList(Request $request)
    {

        $response = Helper::GetMethod(config('constants.api.employee_list'));

        return DataTables::of($response['data'])

            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id=""><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id=""><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // change password
    public function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'oldpassword' => "required",
            'newpassword' => "required",
            'cnewpassword' => "required"
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'oldpassword' => $request->oldpassword,
                'newpassword' => $request->newpassword,
                'cnewpassword' => $request->cnewpassword
            ];
            // dd($data);
            $response = Helper::PostMethod(config('constants.api.change_password'), $data);
            return $response;
        }
    }
    // update te profile
    public function updateProfileInfo(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
            'name' => "required",
            'email' => "required",
            'address' => "required"
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address
            ];
            // dd($data);
            $response = Helper::PostMethod(config('constants.api.update_profile_info'), $data);
            return $response;
        }
    }

    // static page controller start
    public function admission()
    {
        return view('super_admin.admission.index');
    }

    public function import()
    {
        return view('super_admin.admission.import');
    }
    public function parent()
    {
        return view('super_admin.parent.index');
    }
    public function homework()
    {
        return view('super_admin.homework.index');
    }
    // exam routes
    public function examIndex()
    {
        return view('super_admin.exam_term.index');
    }
    public function examHall()
    {
        return view('super_admin.exam_hall.index');
    }
    public function examMarkDistribution()
    {
        return view('super_admin.exam_mark_distribution.index');
    }
    public function exam()
    {
        return view('super_admin.exam.index');
    }

    // get hostel
    public function hostel()
    {
        return view('super_admin.hostel.index');
    }

    // get Room
    public function getRoom()
    {
        return view('super_admin.hostel.room');
    }
    // get Category
    public function getCategory()
    {
        return view('super_admin.hostel.category');
    }
    public function getRoute()
    {
        return view('super_admin.transport.route');
    }

    public function getVehicle()
    {
        return view('super_admin.transport.vehicle');
    }

    public function getstoppage()
    {
        return view('super_admin.transport.stoppage');
    }

    public function assignVehicle()
    {
        return view('super_admin.transport.assignvehicle');
    }
    public function book()
    {
        return view('super_admin.library.book');
    }
    public function bookCategory()
    {
        return view('super_admin.library.book_category');
    }
    public function issuedBook()
    {
        return view('super_admin.library.issued_book');
    }
    public function issueReturn()
    {
        return view('super_admin.library.issue_return');
    }
    public function addClasses()
    {
        $teacherDetails = User::select('id', 'name')->where('role_id', 3)->get();
        return view('super_admin.classes.add', ['teacherDetails' => $teacherDetails]);
    }
    // users page
    public function users()
    {
        return view('super_admin.users.index');
    }

    // get users details
    public function getUserList(Request $request)
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
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
        return view('super_admin.users.add', ['roleDetails' => $roleDetails]);
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
    // forum screen pages start
    public function superadminrollchoose()
    {
        $dbnames = Helper::GetMethod(config('constants.api.dbnameslist'));
        //dd($dbnames);
        return view('super_admin.forum.rolls-chooseforum', [
            'dbnames' => $dbnames['data']
        ]);
    }
    public function forumIndex(Request $request)
    {
        // $getval = $request->getbranchid;
        // //$branchidge =  session()->get('branchid');
        
        // $forum_list = Helper::GetMethod(config('constants.api.forum_list'));
        // //dd($forum_list);
        // return view('super_admin.forum.index', [
        //     'forum_list' => $forum_list['data']
        // ]);
        $branch_id =$request->getbranchid;
        $roll_id=2;
        $request->session()->put('branch_id', $branch_id);
        $request->session()->put('roll_id', 2);
        $data = [            
            'user_id' => $roll_id
        ];        
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data); 
        //dd($forum_list);
          return view('super_admin.forum.index', [
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []
        ]);
    }
    public function forumPageSingleTopic()
    {
        return view('super_admin.forum.page-single-topic');
    }
    public function forumPageCreateTopic()
    {
        $id = session()->get('user_id');
        $user_id = session()->get('role_id');
        $data = [            
            'user_id' => $user_id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'),$data);
        //dd($usernames);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$data);
        // dd($forum_list);
        return view('super_admin.forum.page-create-topic', [
            'category' => $category['data'],
            //'forum_list' => $forum_list['data'],
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => $usernames['data'],
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
            'id'=>$id
        ];
        $category = Helper::GetMethod(config('constants.api.category'));
        $usernames = Helper::GETMethodWithData(config('constants.api.usernames_autocomplete'), $data);
        // dd($usernames);
        $forum_edit = Helper::GETMethodWithData(config('constants.api.forum_edit'), $data);
        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'), $data);
        // dd($forum_edit);
        return view('super_admin.forum.page-edit-topic', [
            'category' => $category['data'],
            'forum_edit' => !empty($forum_edit['data']) ? $forum_edit['data'] : [],
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : [],
            'usernames' => $usernames['data']
        ]);
    }
    public function forumPageSingleUser()
    {
        $user_id= session()->get('user_id');  
        $data = [            
            'user_id' => $user_id
        ];
        $forum_post_user_crd = Helper::GETMethodWithData(config('constants.api.forum_post_user_created'), $data);
        $forum_categorypost_user_crd = Helper::GETMethodWithData(config('constants.api.forum_categorypost_user_created'), $data);
        $forum_post_user_allreplies = Helper::GETMethodWithData(config('constants.api.forum_posts_user_repliesall'), $data);
        $forum_threadslist = Helper::GetMethod(config('constants.api.forum_threadslist'));
       // dd($forum_threadslist);
        return view('super_admin.forum.page-single-user', [
            
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
        return view('super_admin.forum.page-single-threads');
    }
    public function forumPageSingleReplies()
    {
        return view('super_admin.forum.page-single-replies');
    }
    public function forumPageSingleFollowers()
    {
        return view('super_admin.forum.page-single-followers');
    }
    public function forumPageSingleCategories()
    {
        return view('super_admin.forum.page-single-categories');
        
    }
    public function forumPageCategories()
    {
        //$listcategoryvs= Helper::GetMethod(config('constants.api.listcategoryvs'));  
        $adminlistcategoryvs= Helper::GetMethod(config('constants.api.adminlistcategoryvs'));  
        // dd($listcategoryvs);      
         return view('super_admin.forum.page-categories', [
             'adminlistcategoryvs' => $adminlistcategoryvs['data']]);
    }
    public function forumPageCategoriesSingle($categId, $user_id, $category_names)
    {
        session()->put('session_category_names', $category_names);
        $data = [
            'categId' => $categId,
            'user_id' => $user_id
        ];
        $forum_category = Helper::GETMethodWithData(config('constants.api.forum_single_categ'), $data);

        return view('super_admin.forum.page-categories-single', [
            'forum_category' => $forum_category['data']
        ]);
    }
    public function forumPageTabs()
    {
        return view('super_admin.forum.page-tabs');
    }
    public function forumPageTabGuidelines()
    {
        return view('super_admin.forum.page-tabs-guidelines');
    }
    // forum create post 
    public function createpost(Request $request)
    {
        $current_user = session()->get('role_id');
        $rollid_tags = implode(",", $request->tags);
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
            // 'imagesorvideos' => $request->inputTopicTitle,
            'threads_status' => 2
        ];
        //dd($data);
        $response = Helper::PostMethod(config('constants.api.forum_cpost'), $data);
        return $response;
    }
    // forum update post 
    public function updatepost(Request $request)
    {
        $current_user = session()->get('role_id');
        $rollid_tags = implode(",", $request->tags);
        $adminid = 2;
        $tags_add_also_currentroll = $rollid_tags . ',' . $current_user . ',' . $adminid;
        $data = [
            'id'=> $request->id,
            'user_id' => session()->get('user_id'),
            'user_name' => session()->get('name'),
            'topic_title' => $request->inputTopicTitle,
            'topic_header' => $request->inputTopicHeader,
            'types' => $request->topictype,
            'body_content' => $request->tpbody,
            'category' => $request->category,
            'tags' => $tags_add_also_currentroll,
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
        $user_id= session()->get('user_id');  
        $usdata = [            
            'user_id' => $user_id
        ];
        

        $forum_list = Helper::GETMethodWithData(config('constants.api.forum_list'),$usdata);
        
        $forum_singlepost = Helper::GETMethodWithData(config('constants.api.forum_single_post'), $data);
        $forum_singlepost_replies = Helper::GETMethodWithData(config('constants.api.forum_single_post_replies'), $data);
        //dd($forum_singlepost_replies);
        return view('super_admin.forum.page-single-topic', [
            'forum_single_post' => !empty($forum_singlepost['data']) ? $forum_singlepost['data'] : $forum_singlepost,
            'forum_singlepost_replies' => $forum_singlepost_replies['data'],
            //'forum_list' => $forum_list['data']
            'forum_list' => !empty($forum_list['data']) ? $forum_list['data'] : []

        ]);
    }
    public function dbvsgetbranchid(Request $request)
    {
        $data = [
            'id' => $request->id,
            'school_name' => $request->school_name
        ];
        session()->put('branch_id', $request->id);

        //$forum_redirect = Helper::GETMethodWithData(config('constants.api.dbvsgetbranchid'),$data);
        
    
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
            // $response = Helper::PostMethod(config('constants.api.forum_image_store'), $data);
            echo json_encode([

                'default' => config('constants.image_url') . $response['path'] . $response['file_name'],

                '500' =>  config('constants.image_url') . $response['path'] . $response['file_name'],

            ]);
        }
    }
    // forum screen pages end
    public function studentEntry()
    {
        return view('super_admin.attendance.student');
    }
    public function employeeEntry()
    {
        return view('super_admin.attendance.employee');
    }
    public function examEntry()
    {
        return view('super_admin.attendance.exam');
    }
    public function studentIndex()
    {
        return view('super_admin.student.student');
    }

    public function taskIndex()
    {
        return view('super_admin.task.index');
    }
    public function timeTable()
    {
        $weekDays     = Lesson::WEEK_DAYS;
        return view('super_admin.time_table.index', compact('weekDays'));
    }
    public function addLesson()
    {
        return view('super_admin.lesson.index');
    }
    public function faqIndex()
    {
        
        $data = [
            'email' => session()->get('email'),
            'name' => session()->get('name'),
            'role_name' => session()->get('role_name')

        ];
        return view(
            'super_admin.faq.index',
            [
                'data' => $data,
            ]
        );
    }
    public function examResult()
    {
        return view('super_admin.exam.result');
    }
    // LEAVE MANAGEMENT START
    public function applyleave()
    {
        return view('super_admin.leave_management.applyleave');
    }
    public function approvalleave()
    {
        return view('super_admin.leave_management.approvalleave');
    }

    public function allleaves()
    {
        return view('super_admin.leave_management.allleaves');
    }
    // LEAVE MANAGEMENT END 
    public function timeTableViewExam()
    {
        return view('super_admin.exam_timetable.schedule');
    }
    public function timeTableSetExamWise()
    {
        return view('super_admin.exam_timetable.add_schedule');
    }
    public function markEntry()
    {
        return view('super_admin.exam_marks.mark_entry');
    }
    public function byclasss()
    {
        return view('super_admin.exam_results.byclass');
    }
    public function bysubject()
    {
        return view('super_admin.exam_results.bysubject');
    }
    public function overall()
    {
        return view('super_admin.exam_results.overall');
    }
    public function bystudent()
    {
        return view('super_admin.exam_results.bystudent');
    }

    public function evaluationReport()
    {
        return view('super_admin.homework.evaluation_report');
    }

    public function homeworkEdit()
    {
        return view('super_admin.homework.edit');
    }
    public function gradeRange()
    {
        return view('super_admin.exam_marks.grades');
    }

    // static page controller end

}
