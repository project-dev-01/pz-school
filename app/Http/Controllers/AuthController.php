<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //
    public function showLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 2) {
                return redirect()->route('admin.dashboard');
            } elseif ($role_id == 3) {
                return redirect()->route('staff.dashboard');
            } elseif ($role_id == 4) {
                return redirect()->route('teacher.dashboard');
            } elseif ($role_id == 5) {
                return redirect()->route('parent.dashboard');
            } elseif ($role_id == 6) {
                return redirect()->route('student.dashboard');
            }
        }
        return view('auth.login');
    }
    public function showLoginFormSA(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 1) {
                return redirect()->route('super_admin.dashboard');
            }
        }
        return view('super_admin.login.login');
    }
    public function authenticate(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $userDetails = $response->json();
        // dd($userDetails);
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                if ($userDetails['data']['user']['role_id'] != 1) {
                    $request->session()->put('user_id', $userDetails['data']['user']['id']);
                    $request->session()->put('ref_user_id', $userDetails['data']['user']['user_id']);
                    $request->session()->put('role_id', $userDetails['data']['user']['role_id']);
                    $request->session()->put('picture', $userDetails['data']['user']['picture']);
                    $request->session()->put('token', $userDetails['data']['token']);
                    $request->session()->put('name', $userDetails['data']['user']['name']);
                    $request->session()->put('email', $userDetails['data']['user']['email']);
                    $request->session()->put('role_name', $userDetails['data']['role_name']);
                    $request->session()->put('branch_id', $userDetails['data']['subsDetails']['id']);
                    $request->session()->put('school_name', $userDetails['data']['subsDetails']['school_name']);
                    $request->session()->put('school_logo', $userDetails['data']['subsDetails']['logo']);
                    if(isset($userDetails['data']['StudentID'])){
                        $request->session()->put('student_id', $userDetails['data']['StudentID']['id']);
                    }else{
                        $request->session()->put('student_id', null);
                    }
                    
                    // $request->session()->put('db_name', $userDetails['data']['subsDetails']['db_name']);
                    // $request->session()->put('db_username', $userDetails['data']['subsDetails']['db_username']);
                    // $request->session()->put('db_password', $userDetails['data']['subsDetails']['db_password']);
                }

                if ($userDetails['data']['user']['role_id'] == 2) {
                    return redirect()->route('admin.dashboard');
                } elseif ($userDetails['data']['user']['role_id'] == 3) {
                    return redirect()->route('staff.dashboard');
                } elseif ($userDetails['data']['user']['role_id'] == 4) {
                    return redirect()->route('teacher.dashboard');
                } elseif ($userDetails['data']['user']['role_id'] == 5) {
                    return redirect()->route('parent.dashboard');
                } elseif ($userDetails['data']['user']['role_id'] == 6) {
                    return redirect()->route('student.dashboard');
                } else {
                    return redirect()->route('admin.login')->with('error', 'Invalid Credential');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('admin.login')->with('error', $userDetails['message']);
        }
    }
    // authenticate sa
    public function authenticateSA(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $userDetails = $response->json();
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {

            if ($userDetails['data']['user']['role_id'] == 1) {
                $request->session()->put('user_id', $userDetails['data']['user']['id']);
                $request->session()->put('ref_user_id', $userDetails['data']['user']['user_id']);
                $request->session()->put('role_id', $userDetails['data']['user']['role_id']);
                $request->session()->put('picture', $userDetails['data']['user']['picture']);
                $request->session()->put('token', $userDetails['data']['token']);
                $request->session()->put('name', $userDetails['data']['user']['name']);
                $request->session()->put('email', $userDetails['data']['user']['email']);
                $request->session()->put('role_name', $userDetails['data']['role_name']);
            }
            if ($userDetails['data']['user']['role_id'] == 1) {
                return redirect()->route('super_admin.dashboard');
            } else {
                return redirect()->route('super_admin.login')->with('error', 'Invalid Credential');
            }
        } else {
            return redirect()->route('super_admin.login')->with('error', 'Email and password are wrong');
        }
    }

    public function logoutSA(Request $request)
    {
        // dd($request);
        if (session()->has('role_id')) {
            session()->pull('role_id');
            session()->pull('token');
            session()->pull('picture');
            session()->pull('name');
            session()->pull('email');
            session()->pull('role_name');
            session()->pull('user_id');
            session()->pull('ref_user_id');
            $request->session()->flush();
            return redirect()->route('super_admin.login');
        } else {
            return redirect()->route('super_admin.login');
        }
    }
    public function logout(Request $request)
    {
        // dd($request);
        if (session()->has('role_id')) {
            session()->pull('role_id');
            session()->pull('token');
            session()->pull('picture');
            session()->pull('name');
            session()->pull('email');
            session()->pull('role_name');
            session()->pull('user_id');
            session()->pull('branch_id');
            session()->pull('ref_user_id');
            session()->pull('student_id');
            session()->pull('school_name');
            session()->pull('school_logo');
            // session()->pull('db_name');
            // session()->pull('db_username');
            // session()->pull('db_password');
            $request->session()->flush();
            return redirect()->route('admin.login');
        } else {
            return redirect()->route('admin.login');
        }
    }
    public function forgotPassword(Request $request)
    {
        return view('auth.forgot-password');
    }

    public function resetPassword (Request $request){

        $response = Http::post(config('constants.api.reset_password'), [
            'email' => $request->email,
        ]);

        $userDetails = $response->json();
        if ($userDetails['code'] == 200) {
            return redirect()->back()->with('success','A reset link has been sent to your email address.');
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }
    }

    public function passwordrest($token)
    {
        return view('auth.password-reset', ['token' => $token]);
    }

    public function resetPasswordValidation(Request $request)
    {
        $response = Http::post(config('constants.api.reset_password_validation'), [
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $request->token
        ]);
        $userDetails = $response->json();
        if ($userDetails['code'] == 200) {
            return redirect('schoolcrm/login')->with('success', 'Your password has been changed!');
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }

    }

    
    
}
