<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
// base controller add
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthController extends BaseController
{
    //

    public function authenticate(Request $request)
    {

        
        $credentials = $request->only('email', 'password');
        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->send422Error('Validation error.', ['error' => $validator->messages()]);
        }

       
        //Request is validated
        //Crean token
        try {

            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->send400Error('Unauthorised.', ['error' => 'Unauthorised']);
            }
        } catch (JWTException $e) {
            return $credentials;
            return $this->send500Error('Could not create token.', ['error' => 'Could not create token']);
        }
        $user = auth()->user();
        $success['token'] = $token;
        $success['user'] = $user; 
        $success['role_name'] = $user->role->role_name;
       
       
        // dd($userDetails->role_id);
        //Token created, return with success response and jwt token
        return $this->successResponse($success, 'User signed in successfully');
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->send422Error('Validation error.', ['error' => $validator->messages()]);
        }

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);

            $success = [];
            return $this->successResponse($success, 'User has been logged out successfully');
        } catch (JWTException $exception) {
            return $this->send500Error('Sorry, user cannot be logged out', ['error' => 'Could not create token']);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $success['user'] = JWTAuth::authenticate($request->token);

        return $this->successResponse($success, 'Get User details');
    }
}
