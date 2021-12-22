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
            if ($role_id == 1) {
                return redirect()->route('super_admin.dashboard');
            } elseif ($role_id == 2) {
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
    public function authenticate(Request $request)
    {

        $response = Http::post(config('constants.api.login'), [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $userDetails = $response->json();
        $request->session()->regenerate();
        if ($userDetails['code'] == 200) {

            $request->session()->put('role_id', $userDetails['data']['user']['role_id']);
            $request->session()->put('token', $userDetails['data']['token']);
            $request->session()->put('name', $userDetails['data']['user']['name']);
            $request->session()->put('email', $userDetails['data']['user']['email']);
            $request->session()->put('role_name', $userDetails['data']['role_name']);
            
            if ($userDetails['data']['user']['role_id'] == 1) {
                return redirect()->route('super_admin.dashboard');
            } elseif ($userDetails['data']['user']['role_id'] == 2) {
                return redirect()->route('admin.dashboard');
            } elseif ($userDetails['data']['user']['role_id'] == 3) {
                return redirect()->route('staff.dashboard');
            } elseif ($userDetails['data']['user']['role_id'] == 4) {
                return redirect()->route('teacher.dashboard');
            } elseif ($userDetails['data']['user']['role_id'] == 5) {
                return redirect()->route('parent.dashboard');
            } elseif ($userDetails['data']['user']['role_id'] == 6) {
                return redirect()->route('student.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email and password are wrong');
        }
    }
    public function logout(Request $request)
    {
        if (session()->has('role_id')) {
            session()->pull('role_id');
            session()->pull('token');
            session()->pull('name');
            session()->pull('email');
            session()->pull('role_name');
            $request->session()->flush();
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }
}
