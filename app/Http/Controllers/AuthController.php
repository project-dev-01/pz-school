<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    //
    public function showLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            $school_name_url = session()->get('school_name_url');
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
    public function showLoadingForm(Request $request)
    {
        return view('auth.loading');
    }
    
    public function employeePunchCardLogin(Request $request, $branch)
    {
        
      
        // $minutes = 60;
        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('name', 'MyValue', $minutes));
        
    //   return $response;
        // $data = [
        //     'branch_id' => $branch,
        //     'id' => $id
        // ];
        // $response = Http::post(config('constants.api.employee_punchcard'), $data);
        // return view('auth.punch-card',['response' => $response['data']]);
        // dd($response->json());
        return view('auth.punch-card-login');
    }
    public function employeePunchCard(Request $request)
    {
        
        $branch = $request->cookie('branch_id');
        $user = $request->cookie('user_id');
        // dd($value);
        $data = [
                'branch_id' => $branch,
                'id' => $user
            ];
        $response = Http::post(config('constants.api.employee_punchcard'), $data);
    }
    public function punchCardDetails(Request $request)
    {
        #luvupqvyc
        $minutes = 600000;
        $email = $request->email;
        $password = $request->password;
        $check = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user_id = "";
        $branch_id = "";
        $userDetails = $check->json();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                if ($userDetails['data']['user']['role_id'] != 1) {
                    $branch_id = $userDetails['data']['user']['branch_id'];
                    $user_id = $userDetails['data']['user']['user_id'];
                    Cookie::queue(Cookie::make('email', $email, $minutes));
                    Cookie::queue(Cookie::make('password', $password, $minutes));
                    Cookie::queue(Cookie::make('branch_id', $branch_id, $minutes));
                    Cookie::queue(Cookie::make('user_id', $user_id, $minutes));
                }
            }
        }
        $data = [
            'branch_id' => $branch_id,
            'id' => $user_id
        ];
        $response = Http::post(config('constants.api.employee_punchcard_check'), $data);
        $output = $response->json();
        return view('auth.punch-card',
            [
                'punchcard' => $output['data']
            ]
        );
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
        $school_name_url = "";
        $user_name = "";
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
                    // space remove school name
                    $string = preg_replace('/\s+/', '-', $userDetails['data']['subsDetails']['school_name']);
                    $request->session()->put('school_name_url', $string);
                    // greeting session 
                    $request->session()->put('greetting_id', 1);
                    // dd($userDetails['data']['StudentID'][0]['id']);
                    if (isset($userDetails['data']['StudentID'])) {
                        $request->session()->put('student_id', $userDetails['data']['StudentID'][0]['id']);
                        $request->session()->put('all_child', $userDetails['data']['StudentID']);
                    } else {
                        $request->session()->put('student_id', null);
                        $request->session()->put('all_child', null);
                    }
                    $user_name = $userDetails['data']['user']['name'];
                    // $request->session()->put('db_name', $userDetails['data']['subsDetails']['db_name']);
                    // $request->session()->put('db_username', $userDetails['data']['subsDetails']['db_username']);
                    // $request->session()->put('db_password', $userDetails['data']['subsDetails']['db_password']);
                }
                // $response = [
                //     'code' => 200,
                //     'success' => true,
                //     'message' => "success"
                // ];
                // return response()->json($response, 200);
                // return "dashboard";
                if ($userDetails['data']['user']['role_id'] == 2) {
                    // return redirect()->route('admin.dashboard', ['school_name_url' => $school_name_url]);
                    $redirect_route = route('admin.dashboard');
                    echo "<script>setTimeout(function(){ window.location.href = '" . $redirect_route . "'; }, 3000);</script>";
                    return view('auth.loading', ['user_name' => $user_name]);
                } elseif ($userDetails['data']['user']['role_id'] == 3) {
                    // return redirect()->route('staff.dashboard');
                    $redirect_route = route('staff.dashboard');
                    echo "<script>setTimeout(function(){ window.location.href = '" . $redirect_route . "'; }, 3000);</script>";
                    return view('auth.loading', ['user_name' => $user_name]);
                } elseif ($userDetails['data']['user']['role_id'] == 4) {
                    // return redirect()->route('teacher.dashboard');
                    $redirect_route = route('teacher.dashboard');
                    echo "<script>setTimeout(function(){ window.location.href = '" . $redirect_route . "'; }, 3000);</script>";
                    return view('auth.loading', ['user_name' => $user_name]);
                } elseif ($userDetails['data']['user']['role_id'] == 5) {
                    // return redirect()->route('parent.dashboard');
                    $redirect_route = route('parent.dashboard');
                    echo "<script>setTimeout(function(){ window.location.href = '" . $redirect_route . "'; }, 3000);</script>";
                    return view('auth.loading', ['user_name' => $user_name]);
                } elseif ($userDetails['data']['user']['role_id'] == 6) {
                    // return redirect()->route('student.dashboard');
                    $redirect_route = route('student.dashboard');
                    echo "<script>setTimeout(function(){ window.location.href = '" . $redirect_route . "'; }, 3000);</script>";
                    return view('auth.loading', ['user_name' => $user_name]);
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
            session()->pull('all_child');
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

    public function resetPassword(Request $request)
    {

        $response = Http::post(config('constants.api.reset_password'), [
            'email' => $request->email,
        ]);

        $userDetails = $response->json();
        if ($userDetails['code'] == 200) {
            return redirect()->back()->with('success', 'A reset link has been sent to your email address.');
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
