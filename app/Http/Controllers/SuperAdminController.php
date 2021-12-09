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
        $branch = Helper::GetMethod(config('constants.api.branch_list'));
        return DataTables::of($branch['data'])
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                // dd($row);
                return '<div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue waves-effect waves-light">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn">Delete</a>
                        </div>';
            })

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
        $branchDetails = Branches::all();
        return view('super_admin.class.index', ['branchDetails' => $branchDetails]);
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
                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="' . $row['id'] . '" id="editSectionAlloBtn">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteSectionAlloBtn">Delete</a>
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
}
