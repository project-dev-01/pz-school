<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Helper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{

    public function showLoginForm(Request $request)
    {

        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 2) {
                return redirect()->route('admin.dashboard');
            }
        }
        $this->remove2FASession();
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        // dd($response);

        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Admin.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // roles to access
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        if (in_array(2, $roles_permissions_array)) {
            // echo "access ok";
            return view(
                'auth.login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            // echo "access denied";
            return view('auth.access_denied');
        }
    }
    public function teacherLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 4) {
                return redirect()->route('teacher.dashboard');
            }
        }
        $this->remove2FASession();

        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Teacher.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // roles to access
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        if (in_array(4, $roles_permissions_array)) {
            // echo "access ok";
            return view(
                'auth.teacher_login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            // echo "access denied";
            return view('auth.access_denied');
        }
    }
    public function staffLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 4) {
                return redirect()->route('staff.dashboard');
            }
        }
        $this->remove2FASession();
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Staff.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // roles to access
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        if (in_array(3, $roles_permissions_array)) {
            // echo "access ok";
            return view(
                'auth.staff_login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            // echo "access denied";
            return view('auth.access_denied');
        }
    }
    public function parentLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 5) {
                return redirect()->route('parent.dashboard');
            }
        }
        $this->remove2FASession();
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Parent.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // roles to access
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        if (in_array(5, $roles_permissions_array)) {
            // echo "access ok";
            return view(
                'auth.parent_login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            // echo "access denied";
            return view('auth.access_denied');
        }
    }
    public function studentLoginForm(Request $request)
    {
        if (session()->has('role_id')) {
            $role_id = session()->get('role_id');
            if ($role_id == 6) {
                return redirect()->route('student.dashboard');
            }
        }
        $this->remove2FASession();
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Student.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // roles to access
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        if (in_array(6, $roles_permissions_array)) {
            // echo "access ok";
            return view(
                'auth.student_login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            // echo "access denied";
            return view('auth.access_denied');
        }
    }
    public function showLoadingForm(Request $request)
    {
        return view('auth.loading');
    }
    public function remove2FASession()
    {
        session()->pull('two_fa_email');
        session()->pull('two_fa_pass');
        session()->pull('two_branch_id');
        session()->pull('google2fa_secret');
        session()->pull('routePrefix');
        return true;
    }
    public function employeePunchCardLogin(Request $request, $session)
    {

        $datas = [
            'branch_id' => config('constants.branch_id')
        ];
        $school = Http::post(config('constants.api.get_school_type'), $datas);
        $schoolDetails = $school->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Staff.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
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
                    'greetings' => $greetings,
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            return view(
                'auth.punch-card-login',
                [
                    'branch_id' => config('constants.branch_id'),
                    'session' => $session,
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            )->with('session', $session);
        }
    }
    public function employeePunchCard(Request $request)
    {
        $branch = $request->cookie('branch_id');
        $user = $request->cookie('user_id');
        $check_in = $request->check_in;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $session = $request->session;
        if ($check_in) {

            $data = [
                'branch_id' => $branch,
                'id' => $user,
                'check_in' => $check_in,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'session_id' => $session,
            ];
        }

        $check_out = $request->check_out;
        if ($check_out) {

            $data = [
                'branch_id' => $branch,
                'id' => $user,
                'check_out' => $check_out,
                'session_id' => $session,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }
        // dd($data);
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
                return redirect()->route('branch.index');
            }
        }
        return view('super_admin.login.login');
    }
    public function setCookie(Request $request)
    {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('name', 'MyValue', $minutes));
        return $response;
    }
    public function authenticate(Request $request)
    {
        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'user_device' => $request->user_device
        ]);
        $userDetails = $response->json();
        $school_name_url = "";
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            // $password_changed_at = $userDetails['data']['user']['password_changed_at'];
            // $created_at = $userDetails['data']['user']['created_at'];
            // $password_changed_at = new Carbon(($password_changed_at) ? $password_changed_at : $created_at);
            // if (Carbon::now()->diffInDays($password_changed_at) >= 1) {
            //     return redirect()->route('password.expired')->with('error', 'Your password is expired');
            // } else {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('2', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 2) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 2) {
                        $redirect_route = route('admin.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('admin.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Access denied please contact admin');
            }
            // }
        } else {
            return redirect()->route('admin.login')->with('error', $userDetails['message']);
        }
    }
    public function authenticateTeacher(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'user_device' => $request->user_device
        ]);

        $userDetails = $response->json();
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('4', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 4) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 4) {
                        $redirect_route = route('teacher.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('teacher.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('teacher.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('teacher.login')->with('error', $userDetails['message']);
        }
    }
    public function authenticateStaff(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'user_device' => $request->user_device
        ]);

        $userDetails = $response->json();
        // dd($userDetails);
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('3', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 3) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 3) {
                        $redirect_route = route('staff.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('staff.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('staff.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('staff.login')->with('error', $userDetails['message']);
        }
    }
    public function authenticateParent(Request $request)
    {
        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'user_device' => $request->user_device
        ]);
        $userDetails = $response->json();
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('5', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 5) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 5) {
                        $redirect_route = route('parent.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('parent.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('parent.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('parent.login')->with('error', $userDetails['message']);
        }
    }
    public function authenticateStudent(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'user_device' => $request->user_device
        ]);

        $userDetails = $response->json();
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('6', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 6) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 6) {
                        $redirect_route = route('student.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('student.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('student.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('student.login')->with('error', $userDetails['message']);
        }
    }

    // authenticate sa
    public function authenticateSA(Request $request)
    {

        $response = Http::post(config('constants.api.loginSA'), [
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
                $request->session()->put('school_roleid', $userDetails['data']['user']['school_roleid']);
                $request->session()->put('picture', $userDetails['data']['user']['picture']);
                $request->session()->put('token', $userDetails['data']['token']);
                $request->session()->put('name', $userDetails['data']['user']['name']);
                $request->session()->put('email', $userDetails['data']['user']['email']);
                $request->session()->put('role_name', $userDetails['data']['role_name']);
            }
            if ($userDetails['data']['user']['role_id'] == 1) {
                return redirect()->route('branch.index');
            } else {
                return redirect()->route('super_admin.login')->with('error', 'Invalid Credential');
            }
        } else {
            return redirect()->route('super_admin.login')->with('error', 'Email and password are wrong');
        }
    }
    public function authenticateGuest(Request $request)
    {
        $response = Http::post(config('constants.api.login_guest'), [
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'password' => $request->password,
            'user_browser' => $request->user_browser,
            'user_os' => $request->user_os,
            'role_id' => "7",
            'user_device' => $request->user_device
        ]);
        $userDetails = $response->json();
        // dd($userDetails);
        $user_name = "";
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {
            if ($userDetails['data']['subsDetails']) {
                // check 2 FA Enable
                $twoFaEnable = isset($userDetails['data']['user']['google2fa_secret_enable']) ? $userDetails['data']['user']['google2fa_secret_enable'] : 0;
                // add remember me
                $this->rememberMe($request);
                if ($twoFaEnable == 1) {
                    $google2fa_secret = isset($userDetails['data']['user']['google2fa_secret']) ? $userDetails['data']['user']['google2fa_secret'] : null;
                    $routePrefix = trim($request->route()->getPrefix(), '/');
                    // set session for 2fa
                    $request->session()->put('two_fa_email', $request->email);
                    $request->session()->put('two_fa_pass', $request->password);
                    $request->session()->put('two_branch_id', $request->branch_id);
                    $request->session()->put('google2fa_secret', $google2fa_secret);
                    $request->session()->put('routePrefix', $routePrefix);
                    if (is_null($google2fa_secret)) {
                        return redirect()->route('2fa.register');
                    } else {
                        return redirect()->route('2fa.view');
                    }
                } else {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('7', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 7) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 7) {
                        $redirect_route = route('guest.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('guest.login')->with('error', 'Invalid Credential');
                    }
                }
            } else {
                return redirect()->route('guest.login')->with('error', 'Access denied please contact admin');
            }
        } else {
            return redirect()->route('guest.login')->with('error', $userDetails['message']);
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
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('admin.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('admin.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('admin.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function logoutTeacher(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('teacher.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('teacher.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('teacher.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function logoutStaff(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('staff.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('staff.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('staff.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function logoutParent(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('parent.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('parent.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('parent.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function logoutStudent(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('student.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('student.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('student.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function logoutGuest(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('guest.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('guest.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('guest.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }
    public function forgotPassword(Request $request)
    {
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Admin.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        // dd($image_url);
        return view(
            'auth.forgot-password',
            [
                'branch_id' => config('constants.branch_id'),
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'language_name' => $setLang,
                'image_url' => $image_url
            ]
        );
    }
    public function passwordExpired(Request $request)
    {
        return view('auth.expired');
    }
    public function resetPassword(Request $request)
    {
        $data = [
            'email' => $request->email,
            'sent_link' => url('/')
        ];
        $response = Http::post(config('constants.api.reset_password'), $data);

        $userDetails = $response->json();
        // dd($userDetails);
        if ($userDetails['code'] == 200) {

            $data = [
                'branch_id' => config('constants.branch_id')
            ];
            $response = Http::post(config('constants.api.get_school_type'), $data);
            $schoolDetails = $response->json();
            $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Admin.webp";
            // set default language
            if (Cookie::get('locale') !== null) {
                $defalutLang = Cookie::get('locale');
            } else {
                $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
            }
            $setLang = isset($defalutLang) ? $defalutLang : 'en';
            App::setLocale($setLang);
            session()->put('locale', $setLang);

            // dd($image_url);

            $role_ids = explode(",", $userDetails['data']['role_id']);
            $role = $role_ids['0'];
            // dd($role_ids);
            if ($role == 1) {
                $redirect_route = route('super_admin.login');
            } elseif ($role == 2) {
                $redirect_route = route('admin.login');
            } elseif ($role == 3) {
                $redirect_route = route('staff.login');
            } elseif ($role == 4) {
                $redirect_route = route('teacher.login');
            } elseif ($role == 5) {
                $redirect_route = route('parent.login');
            } elseif ($role == 6) {
                $redirect_route = route('student.login');
            } elseif ($role == 7) {
                $redirect_route = route('guest.login');
            }
            return view(
                'auth.success',
                [
                    'redirect_route' => $redirect_route,
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }
    }

    public function passwordrest($token)
    {
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Admin.webp";
        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        return view(
            'auth.password-reset',
            [
                'token' => $token,
                'branch_id' => config('constants.branch_id'),
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'language_name' => $setLang,
                'image_url' => $image_url
            ]
        );
    }
    public function passwordExpireReset($token)
    {
        return view('auth.password_expire_reset', ['token' => $token]);
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

            $data = [
                'branch_id' => config('constants.branch_id')
            ];
            $response = Http::post(config('constants.api.get_school_type'), $data);
            $schoolDetails = $response->json();
            $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Admin.webp";
            // set default language
            if (Cookie::get('locale') !== null) {
                $defalutLang = Cookie::get('locale');
            } else {
                $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
            }
            $setLang = isset($defalutLang) ? $defalutLang : 'en';
            App::setLocale($setLang);
            session()->put('locale', $setLang);
            $role_ids = explode(",", $userDetails['data']['role_id']);
            $role = $role_ids['0'];
            // dd($role_ids);
            if ($role == 1) {
                $redirect_route = route('super_admin.login');
            } elseif ($role == 2) {
                $redirect_route = route('admin.login');
            } elseif ($role == 3) {
                $redirect_route = route('staff.login');
            } elseif ($role == 4) {
                $redirect_route = route('teacher.login');
            } elseif ($role == 5) {
                $redirect_route = route('parent.login');
            } elseif ($role == 6) {
                $redirect_route = route('student.login');
            } elseif ($role == 7) {
                $redirect_route = route('guest.login');
            }

            return view(
                'auth.success',
                [
                    'redirect_route' => $redirect_route,
                    'branch_id' => config('constants.branch_id'),
                    'school_name' => config('constants.school_name'),
                    'school_image' => config('constants.school_image'),
                    'language_name' => $setLang,
                    'image_url' => $image_url
                ]
            );
            // return redirect()->$redirect_route->with('success', 'Your password has been changed!');
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }
    }
    public function resetExpirePassword(Request $request)
    {
        $response = Http::post(config('constants.api.reset_expire_reset_password'), [
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $request->token
        ]);
        $userDetails = $response->json();
        if ($userDetails['code'] == 200) {
            $redirect_route = $userDetails['data'];
            return redirect()->route($redirect_route)->with('success', 'Your password has been changed!');
        } else {
            return redirect()->back()->with('error', $userDetails['message']);
        }
    }
    // common logout
    public function logoutCommon($req)
    {
        try {

            session()->pull('role_id');
            session()->pull('token');
            session()->pull('picture');
            session()->pull('name');
            session()->pull('email');
            session()->pull('role_name');
            session()->pull('user_id');
            session()->pull('branch_id');
            session()->pull('session_id');
            session()->pull('ref_user_id');
            session()->pull('student_id');
            session()->pull('school_name');
            session()->pull('school_logo');
            session()->pull('all_child');
            session()->pull('academic_session_id');
            // session()->pull('password_changed_at');
            $defalutLang = session()->get('locale');
            $req->session()->flush();
            // $req->session()->put('locale', $defalutLang);
            $hour = time() + 3600 * 24 * 30;
            Cookie::queue(Cookie::make('locale', $defalutLang, $hour));
            // Helper::GetMethod(config('constants.api.logout'));
        } catch (\Exception $e) {

            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => $e->getMessage()], 419);
        }
    }
    public function rememberMe($req)
    {
        // remember me set start
        $hour = time() + 3600 * 24 * 30;
        if (isset($req->remember)) {
            Cookie::queue(Cookie::make('email', $req->email, $hour));
            Cookie::queue(Cookie::make('password', $req->password, $hour));
            Cookie::queue(Cookie::make('remember', $req->remember, $hour));
        } else {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
            Cookie::queue(Cookie::forget('remember'));
        }
        // remember me set end
        return true;
    }
    // set session common
    public function sessionCommon($req, $userDetails, $roleID)
    {
        // return $req;
        // dd($userDetails);
        $req->session()->put('user_id', $userDetails['data']['user']['id']);
        $req->session()->put('ref_user_id', $userDetails['data']['user']['user_id']);
        $req->session()->put('school_roleid', $userDetails['data']['user']['school_roleid']);
        $req->session()->put('role_id', $roleID);
        $req->session()->put('picture', $userDetails['data']['user']['picture']);
        $req->session()->put('token', $userDetails['data']['token']);
        $req->session()->put('name', $userDetails['data']['user']['name']);
        $req->session()->put('email', $userDetails['data']['user']['email']);
        $req->session()->put('role_name', $userDetails['data']['role_name']);
        $req->session()->put('session_id', $userDetails['data']['user']['session_id']);
        $req->session()->put('branch_id', $userDetails['data']['subsDetails']['id']);
        $req->session()->put('school_name', $userDetails['data']['subsDetails']['school_name']);
        $req->session()->put('school_logo', $userDetails['data']['subsDetails']['logo']);
        // password_changed_at
        // $req->session()->put('password_changed_at', $userDetails['data']['subsDetails']['password_changed_at']);
        // space remove school name
        $string = preg_replace('/\s+/', '-', $userDetails['data']['subsDetails']['school_name']);
        $req->session()->put('school_name_url', $string);
        // greeting session 
        $req->session()->put('greetting_id', 1);
        // set academic session id
        if (isset($userDetails['data']['academicSession'])) {
            $req->session()->put('academic_session_id', $userDetails['data']['academicSession']['year_id']);
            $req->session()->put('language_name', $userDetails['data']['academicSession']['language_name']);
            $req->session()->put('footer_text', $userDetails['data']['academicSession']['footer_text']);
            $req->session()->put('check_in_time', $userDetails['data']['checkInOutTime']['check_in']);
            $req->session()->put('check_out_time', $userDetails['data']['checkInOutTime']['check_out']);
            $req->session()->put('hidden_week_ends', $userDetails['data']['hiddenWeekends']);
        } else {
            $req->session()->put('academic_session_id', 0);
            $req->session()->put('language_name', "en");
            $req->session()->put('footer_text', "");
            $req->session()->put('check_in_time', null);
            $req->session()->put('check_out_time', null);
            $req->session()->put('hidden_week_ends', []);
        }
        if (isset($userDetails['data']['StudentID'])) {
            $req->session()->put('student_id', isset($userDetails['data']['StudentID'][0]['id']) ? $userDetails['data']['StudentID'][0]['id'] : 0);
            $req->session()->put('all_child', $userDetails['data']['StudentID']);
        } else {
            $req->session()->put('student_id', null);
            $req->session()->put('all_child', null);
        }
        $user_name = $userDetails['data']['user']['name'];
        return $user_name;
    }
    public function lastlogout(Request $request)
    {
        try {
            $session_id = session()->get('user_id');
            $role_id = session()->get('role_id');
            $data = [
                'userID' => $session_id,
                'role_id' => $role_id
            ];
            // dd($data);       
            $response = Helper::PostMethod(config('constants.api.lastlogout'), $data);


            return $response;
        } catch (\Exception $e) {

            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function allLogout(Request $request)
    {
        try {
            // $token = session()->get('token');
            $session_id = session()->get('session_id');
            $data = [
                'session_id' => $session_id,
            ];
            $response = Helper::PostMethod(config('constants.api.all_logout'), $data);
            return $response;
        } catch (\Exception $e) {

            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => $e->getMessage()], 500);
        }


        // $role = session()->get('role_id');
        // $response['role'] = $role;
        // if ($response['code'] == 200) {
        //     $this->logoutCommon($request);
        // }
        // return $response;
    }
    //
    public function twoFACheckView(Request $request)
    {
        return view('auth.google2fa.2fa');
    }
    public function twoFACheckRegister(Request $request)
    {
        $data = [
            'email' => session()->get('two_fa_email'),
            'branch_id' => session()->get('two_branch_id'),
        ];
        $response = Http::post(config('constants.api.two_fa_generate_secret_qr'), $data);
        $output = $response->json();
        $secret = isset($output['data']['secret']) ? $output['data']['secret'] : "";
        $encrypt_key = isset($output['data']['encrypt_key']) ? $output['data']['encrypt_key'] : "";
        $qr_url = isset($output['data']['qr_url']) ? $output['data']['qr_url'] : "";
        //unset session
        session()->pull('google2fa_secret');
        return view('auth.google2fa.register', ['secret' => $secret, 'encrypt_key' => $encrypt_key, 'qr_url' => $qr_url]);
    }
    //
    public function twoFACheckOTPRegister(Request $request)
    {
        $request->session()->put('google2fa_secret', $request->secret);
        return redirect()->route('2fa.view');
        // dd($request);
    }
    public function twoFACheckOtp(Request $request)
    {
        $data = [
            'otp' => $request->otp,
            'email' => session()->get('two_fa_email'),
            'password' => session()->get('two_fa_pass'),
            'branch_id' => session()->get('two_branch_id'),
            'google2fa_secret' => session()->get('google2fa_secret')
        ];
        // dd($data);
        $google2fa_secret = session()->get('google2fa_secret');
        $response = Http::post(config('constants.api.two_fa_otp_valid'), $data);
        // dd($response);
        $userDetails = $response->json();
        if ($userDetails['code'] == 200) {
            if (isset($google2fa_secret)) {
                // here update google auth secret
                $googleSecData = [
                    'email' => session()->get('two_fa_email'),
                    'google2fa_secret' => session()->get('google2fa_secret')
                ];
                Http::post(config('constants.api.update_two_fa_secret'), $googleSecData);
            }
            $routePref = session()->get('routePrefix');
            // admin
            if ($routePref == "admin") {
                // multiple roles same account
                $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                $matchRoleIndex = array_search('2', $role_ids, true);
                $roleID = $role_ids[$matchRoleIndex];
                if ($roleID == 2) {
                    $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                }
                if ($roleID == 2) {
                    $redirect_route = route('admin.dashboard');
                    return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                } else {
                    return redirect()->route('admin.login')->with('error', 'Invalid Credential');
                }
            }
            // staff
            if ($routePref == "staff") {
                if ($userDetails['data']['subsDetails']) {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('3', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 3) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 3) {
                        $redirect_route = route('staff.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('staff.login')->with('error', 'Invalid Credential');
                    }
                } else {
                    return redirect()->route('staff.login')->with('error', 'Access denied please contact admin');
                }
            }
            // teacher
            if ($routePref == "teacher") {
                if ($userDetails['data']['subsDetails']) {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('4', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 4) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 4) {
                        $redirect_route = route('teacher.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('teacher.login')->with('error', 'Invalid Credential');
                    }
                } else {
                    return redirect()->route('staff.login')->with('error', 'Access denied please contact admin');
                }
            }
            // parent
            if ($routePref == "parent") {
                if ($userDetails['data']['subsDetails']) {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('5', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 5) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 5) {
                        $redirect_route = route('parent.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('parent.login')->with('error', 'Invalid Credential');
                    }
                } else {
                    return redirect()->route('staff.login')->with('error', 'Access denied please contact admin');
                }
            }
            // student
            if ($routePref == "student") {
                if ($userDetails['data']['subsDetails']) {
                    // multiple roles same account
                    $role_ids = explode(",", $userDetails['data']['user']['role_id']);
                    $matchRoleIndex = array_search('6', $role_ids, true);
                    $roleID = $role_ids[$matchRoleIndex];
                    if ($roleID == 6) {
                        $user_name = $this->sessionCommon($request, $userDetails, $roleID);
                    }
                    if ($roleID == 6) {
                        $redirect_route = route('student.dashboard');
                        return view('auth.loading', ['user_name' => $user_name, 'redirect_route' => $redirect_route]);
                    } else {
                        return redirect()->route('student.login')->with('error', 'Invalid Credential');
                    }
                } else {
                    return redirect()->route('staff.login')->with('error', 'Access denied please contact admin');
                }
            }
        } else {
            return redirect()->route('2fa.view')->with('error', 'Invalid Otp');
        }
    }



    public function home(Request $request)
    {
        $this->remove2FASession();
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $home_response = Http::post(config('constants.api.get_home_page_details'), $data);
        $homeDetails = $home_response->json();

        $parent_image =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Parent.webp";
        $student_image =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Student.webp";
        $teacher_image =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Teacher.webp";
        $application =  config('constants.image_url') . "/common-asset/images/application.webp";

        // set default language
        if (Cookie::get('locale') !== null) {
            $defalutLang = Cookie::get('locale');
        } else {
            $defalutLang = isset($schoolDetails['data']['academicSession']['language_name']) ? $schoolDetails['data']['academicSession']['language_name'] : 'en';
        }
        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);
        $branch_roles_permissions = isset($schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids']) ? $schoolDetails['data']['branch_roles_permissions'][0]['access_role_ids'] : '';
        $roles_permissions_array = explode(",", $branch_roles_permissions);
        return view(
            'auth.home',
            [
                'branch_id' => config('constants.branch_id'),
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'parent_image' => $parent_image,
                'student_image' => $student_image,
                'teacher_image' => $teacher_image,
                'application' => $application,
                'language_name' => $setLang,
                'home' => $homeDetails['data'],
                'branch_roles_permissions' => $roles_permissions_array,
            ]
        );
    }


    public function application()
    {
        return view('auth.application');
    }
    public function failed_logout(Request $request)
    {
        if (session()->has('role_id')) {
            $this->logoutCommon($request);
            if (isset($request->idle_timeout)) {
                $response = [
                    'code' => 200,
                    'redirect_url' => route('admin.login')
                ];
                return response()->json($response, 200);
            } else {
                return redirect()->route('admin.login')->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                    'Pragma' => 'no-cache'
                ]);
            }
        } else {
            return redirect()->route('admin.login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache'
            ]);
        }
    }

    public function guestLogin(Request $request)
    {
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $response = Http::post(config('constants.api.get_school_type'), $data);
        $schoolDetails = $response->json();
        $image_url =  config('constants.image_url') . "/common-asset/images/school-type/" . (isset($schoolDetails['data']['school_type']['school_type']) ? $schoolDetails['data']['school_type']['school_type'] : "") . "/Student.webp";

        $setLang = isset($defalutLang) ? $defalutLang : 'en';
        App::setLocale($setLang);
        session()->put('locale', $setLang);

        return view(
            'auth.guest_login',
            [
                'branch_id' => config('constants.branch_id'),
                'school_name' => config('constants.school_name'),
                'school_image' => config('constants.school_image'),
                'language_name' => $setLang,
                'image_url' => $image_url
            ]
        );
    }
}
