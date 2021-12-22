<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;
use App\Helpers\Helper;
use App\Models\Branches;

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
    // add branch
    public function addBranch(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'school_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'name' => $request->name,
                'school_name' => $request->school_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'currency' => $request->currency,
                'symbol' => $request->symbol,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'address' => $request->address
            ];
            $response = Helper::PostMethod(config('constants.api.branch_add'), $data);
            return $response;
        }
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
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
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

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'school_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'currency' => 'required',
            'symbol' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $data = [
                'id' => $request->id,
                'name' => $request->name,
                'school_name' => $request->school_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'currency' => $request->currency,
                'symbol' => $request->symbol,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'address' => $request->address
            ];
            $response = Helper::PostMethod(config('constants.api.branch_update'), $data);
            return $response;
        }
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
    public function updateSectionAllocation(Request $request){
        $id = $request->said;

        $validator = \Validator::make($request->all(),[
            'branch_id'=>'required',
            'class_name'=>'required',
            'section_name'=>'required'
        ]);

        if(!$validator->passes()){
               return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
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
        'class_name'=>'required',
        'section_name'=>'required',
        'class_teacher'=>'required'
    ]);

    if (!$validator->passes()) {
        return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {

        
        $data = [
            'branch_id' => $request->branch_id,
            'class_name'=>$request->class_name,
            'section_name'=>$request->section_name,
            'class_teacher'=>$request->class_teacher,            
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

        ->rawColumns(['status','actions'])
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
        'class_name'=>'required',
        'section_name'=>'required',
        'class_teacher'=>'required'
    ]);

   
    if (!$validator->passes()) {
        return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
        $data = [
            'teacher_allocation__id' => $assign_teacher_id,
            'branch_id' => $request->branch_id,
            'class_name'=>$request->class_name,
            'section_name'=>$request->section_name,
            'class_teacher'=>$request->class_teacher,      
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
        return view('super_admin.event.index', ['branches' => $getBranches['data'],'type' => $getEventType['data'],'classDetails' => $getClass['data'],'sectionDetails' => $getSection['data']]);
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

            if($request->audience==2)
            {
                $selected_list = json_encode($request->class);
            }elseif($request->audience==3)
            {
                $selected_list = json_encode($request->section);
            }else{
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
                if($audience==1)
                {
                    return "Everyone";
                }else{
                    return "Class ".$row['classname'];
                }
            })
            ->addColumn('status', function ($row) {
                
                $status = $row['status'];
                if($status==1)
                {
                    $result = "checked";
                }else{
                    $result = "";
                }
                return '<input type="checkbox" '.$result.' data-id="' . $row['id'] . '"  id="publishEventBtn">';
            })
            ->addColumn('actions', function ($row) {
                return '<div class="button-list">
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="viewEventBtn"><i class="fe-eye"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteEventBtn"><i class="fe-trash-2"></i></a>
                        </div>';
            })

            ->rawColumns(['status','actions'])
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
    public function publishEvent(Request $request){

        
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
        $roles = Helper::PostMethod(config('constants.api.roles'),$data);
    //    dd($roles);
        return view(
            'super_admin.employee.index',
            [
                'branches' => $getBranches['data'],
                'roles' => $roles['data'],
            ]
        );
    }
    // setting show
    public function settings()
    {
        return view('super_admin.settings.index');
    }
}
