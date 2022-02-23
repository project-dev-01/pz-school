<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Branches;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\States;
// db connection
use App\Helpers\DatabaseConnection;
use App\Models\Category;

class CommonController extends BaseController
{
    //
    // get sections 
    public function countryList()
    {
        $success = Countries::all();
        return $this->successResponse($success, 'Countries record fetch successfully');
    }
    // get states by country id
    public function getStateByIdList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'country_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = States::where('country_id', $request->country_id)->get();
            return $this->successResponse($success, 'States record fetch successfully');
        }
    }
    // get citites by state id
    public function getCityByIdList(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'state_id' => 'required',
        ]);

        if (!$validator->passes()) {
            return $this->send422Error('Validation error.', ['error' => $validator->errors()->toArray()]);
        } else {
            $success = Cities::where('state_id', $request->state_id)->get();
            return $this->successResponse($success, 'Citites record fetch successfully');
        }
    }
    function databaseMigrate(Request $request){
        $params = Branches::find($request->branch_id);
        $staffConn = DatabaseConnection::databaseMigrate($params);
        return $this->successResponse([], 'Migrated successfully');

    }
    public function categoryList()
    {
        $success = Category::all();
        return $this->successResponse($success, 'category record fetch successfully');
    }
}
