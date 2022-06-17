<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
                return $this->send400Error('Email and password are wrong.', ['error' => 'Email and password are wrong']);
            }
        } catch (JWTException $e) {
            return $credentials;
            return $this->send500Error('Could not create token.', ['error' => 'Could not create token']);
        }
        $user = auth()->user();
        if ($user->status == 0) {
            $success['token'] = $token;
            $success['user'] = $user;
            $success['role_name'] = $user->role->role_name;
            $success['subsDetails'] = $user->subsDetails;
            // dd($user->user_id);
            if ($user->role->id == 5) {
                $branch_id = $user->subsDetails->id;
                $Connection = $this->createNewConnection($branch_id);
                $StudentID = $Connection->table('students')->select('id')->where('id', $user->user_id)->first();
                $success['StudentID'] = $StudentID;
            }

            //Token created, return with success response and jwt token
            return $this->successResponse($success, 'User signed in successfully');
        } else {
            return $this->send500Error('Your Account Locked, Please Contact Admin', ['error' => 'Your Account Locked, Please Contact Admin']);
        }
        
        
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

    public function resetPassword (Request $request) {

        $credentials = $request->only('email', 'password','password_confirmation');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->send422Error('Validation error.', ['error' => $validator->messages()]);
        }

        $user = User::where('email', '=', $request->email)->first();
        if($user === null){
            return $this->send400Error('Email does not Exist.', ['error' => 'Email does not Exist']);
        }

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);
        
        //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return $this->successResponse('success','A reset link has been sent to your email address.');
        } else {
            return $this->send500Error('A Network Error occurred. Please try again.', ['error' => 'A Network Error occurred. Please try again.']);
        }
        
    }

    private function sendResetEmail($email, $token){

        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name','email')->first();

        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('schoolcrm/password/reset').'/'.$token;
        if($email){
            $data = array('link'=>$link,'name'=> $user->name); 
            
            Mail::send('auth.mail', $data, function($message) use($email) {
            $message->to('rajesh@aibots.my', 'members')->subject
                ('Password Reset');
            $message->from('rajesh@aibots.my','Password Reset');
            });  
            return true;
        }else{
            return false;
        } 
    }

    public function resetPasswordValidation(Request $request)
    {
        $credentials = $request->only('email', 'password','password_confirmation');
        $validator = Validator::make($credentials, [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
    
        ]);

        if ($validator->fails()) {
            return $this->send422Error('Validation error.', ['error' => $validator->messages()]);
        }
            
        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();   
                            //  dd($updatePassword);
        if($updatePassword)
        {
            $user = User::where('email', $request->email)
                        ->update(['password' => bcrypt($request->password)]);
    
            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            return $this->successResponse('success','Your password has been changed!');
    
        }else{
            return $this->send500Error('Invalid token!', ['error' => 'Invalid token!']);
        }
    }
}
