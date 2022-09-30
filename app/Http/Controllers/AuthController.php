<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Helper;

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

    public function employeePunchCardLogin(Request $request, $branch, $session)
    {
        $email = $request->cookie('email');
        $password = $request->cookie('password');

        $request['email'] = $email;
        $request['password'] = $password;
        if ($email && $password) {
            $branch_id = $request->cookie('branch_id');
            $user_id = $request->cookie('user_id');
            $user_name = $request->cookie('user_name');
            $data = [
                'branch_id' => $branch_id,
                'id' => $user_id,
                'session_id' => $session
            ];
            $response = Http::post(config('constants.api.employee_punchcard_check'), $data);
            $greetings = Helper::greetingMessage();
            $output = $response->json();
            return view(
                'auth.punch-card',
                [
                    'punchcard' => $output['data'],
                    'session' => $session,
                    'temp_user_name' => isset($user_name) ? $user_name : '-',
                    'greetings' => $greetings
                ]
            );
        } else {
            return view(
                'auth.punch-card-login',
                [
                    'branch_id' => $branch,
                    'session' => $session
                ]
            )->with('session', $session);
        }
    }
    public function employeePunchCard(Request $request)
    {
        $branch = $request->cookie('branch_id');
        $user = $request->cookie('user_id');
        $check_in = $request->check_in;
        $session = $request->session;
        if ($check_in) {

            $data = [
                'branch_id' => $branch,
                'id' => $user,
                'check_in' => $check_in,
                'session_id' => $session
            ];
        }

        $check_out = $request->check_out;
        if ($check_out) {

            $data = [
                'branch_id' => $branch,
                'id' => $user,
                'check_out' => $check_out,
                'session_id' => $session
            ];
        }
        $response = Http::post(config('constants.api.employee_punchcard'), $data);

        return $response;
    }
    public function punchCardDetails(Request $request)
    {
        $minutes = 600000;
        $email = $request->email;
        $password = $request->password;
        $session = $request->session;
        $branch_id = $request->branch_id;
        $check = Http::post(config('constants.api.login_branch'), [
            'email' => $request->email,
            'password' => $request->password,
            'branch_id' => $branch_id
        ]);

        $user_id = "";
        $branch_id = "";
        $userDetails = $check->json();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                if ($userDetails['data']['user']['role_id'] != 1) {
                    $branch_id = $userDetails['data']['user']['branch_id'];
                    $user_id = $userDetails['data']['user']['user_id'];
                    $user_name = $userDetails['data']['user']['name'];
                    // dd($user_name);
                    Cookie::queue(Cookie::make('email', $email, $minutes));
                    Cookie::queue(Cookie::make('password', $password, $minutes));
                    Cookie::queue(Cookie::make('branch_id', $branch_id, $minutes));
                    Cookie::queue(Cookie::make('user_id', $user_id, $minutes));
                    Cookie::queue(Cookie::make('user_name', $user_name, $minutes));
                    $data = [
                        'branch_id' => $branch_id,
                        'id' => $user_id,
                        'session_id' => $session
                    ];
                    $response = Http::post(config('constants.api.employee_punchcard_check'), $data);

                    // dd($response);
                    $greetings = Helper::greetingMessage();
                    $output = $response->json();

                    return view(
                        'auth.punch-card',
                        [
                            'punchcard' => $output['data'],
                            'temp_user_name' => isset($user_name) ? $user_name : '-',
                            'session' => $session,
                            'greetings' => $greetings
                        ]
                    );
                }
            } else {
                return redirect()->back()->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }
    }



    public function logoutPunchCard(Request $request)
    {
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('password'));
        Cookie::queue(Cookie::forget('branch_id'));
        Cookie::queue(Cookie::forget('user_id'));
        Cookie::queue(Cookie::forget('user_name'));
        return redirect()->route('employee.punchcard.login', ['branch' => $request->cookie('branch_id'), 'session' => 1]);
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
                if ($userDetails['data']['user']['role_id'] == 2) {
                    $redirect_route = route('admin.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                } elseif ($userDetails['data']['user']['role_id'] == 3) {
                    $redirect_route = route('staff.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                } elseif ($userDetails['data']['user']['role_id'] == 4) {
                    $redirect_route = route('teacher.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                } elseif ($userDetails['data']['user']['role_id'] == 5) {
                    $redirect_route = route('parent.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                } elseif ($userDetails['data']['user']['role_id'] == 6) {
                    $redirect_route = route('student.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
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
