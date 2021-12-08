<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\States;

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
}
