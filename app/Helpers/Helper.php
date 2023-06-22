<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
// encrypt and decrypt
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\Client\PendingRequest;

class Helper
{

    // code generaaator
    public static function CodeGenerator($model, $trow, $length = 4, $prefix)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number) + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . '-' . $zeros . $last_number;
    }

    // get api call get method
    public static function GetMethod($url)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                ->retry(3, 2000)->timeout(12)
                // ->withBody("dummy body content", "application/json")
                ->get($url, $data);
            // Determine if the status code is >= 200 and < 300...
            if ($response->successful()) {
                // process the failure
                return $response->json();
            }
            // //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                $datas = [
                    'data' => [
                        'message' => 'Failed'
                    ]
                ];
                return $datas;
                // return view('errors.404')->with([
                //     'message' => 'Failed.',
                // ]);
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                $datas = [
                    'data' => [
                        'message' => 'serverError'
                    ]
                ];
                return $datas;
                // return view('errors.500')->with([
                //     'message' => 'serverError.',
                // ]);
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                $datas = [
                    'data' => [
                        'message' => 'clientError'
                    ]
                ];
                return $datas;
                // return view('errors.503')->with([
                //     'message' => 'clientError.',
                // ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            // $e->getMessage() - will output "cURL error 6: Could not resolve host" in case of invalid domain
        }
    }
    // get api call get method with data
    public static function GETMethodWithData($url, $data)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                ->retry(3, 2000)->timeout(12)
                // ->withBody("dummy body content", "application/json")
                ->get($url, $data);
            // Determine if the status code is >= 200 and < 300...
            if ($response->successful()) {
                // process the failure
                return $response->json();
            }
            // //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                $datas = [
                    'data' => [
                        'message' => 'Failed'
                    ]
                ];
                return $datas;
                // return view('errors.404')->with([
                //     'message' => 'Failed.',
                // ]);
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                $datas = [
                    'data' => [
                        'message' => 'serverError'
                    ]
                ];
                return $datas;
                // return view('errors.500')->with([
                //     'message' => 'serverError.',
                // ]);
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                $datas = [
                    'data' => [
                        'message' => 'clientError'
                    ]
                ];
                return $datas;
                // return view('errors.503')->with([
                //     'message' => 'clientError.',
                // ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            // $e->getMessage() - will output "cURL error 6: Could not resolve host" in case of invalid domain
        }
    }
    // post api call
    public static function PostMethod($url, $data)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                ->retry(3, 2000)->timeout(12)
                // ->withBody("dummy body content", "application/json")
                ->post($url, $data);
            // Determine if the status code is >= 200 and < 300...
            if ($response->successful()) {
                // process the failure
                return $response->json();
            }
            // //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                $datas = [
                    'data' => [
                        'message' => 'Failed'
                    ]
                ];
                return $datas;
                // return view('errors.404')->with([
                //     'message' => 'Failed.',
                // ]);
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                $datas = [
                    'data' => [
                        'message' => 'serverError'
                    ]
                ];
                return $datas;
                // return view('errors.500')->with([
                //     'message' => 'serverError.',
                // ]);
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                $datas = [
                    'data' => [
                        'message' => 'clientError'
                    ]
                ];
                return $datas;
                // return view('errors.503')->with([
                //     'message' => 'clientError.',
                // ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            // $e->getMessage() - will output "cURL error 6: Could not resolve host" in case of invalid domain
        }
    }

    // get api call
    public static function DataTableGetMethod($url, $data)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                ->retry(3, 2000)->timeout(12)
                // ->withBody("dummy body content", "application/json")
                ->get($url, $data);
            // Determine if the status code is >= 200 and < 300...
            if ($response->successful()) {
                // process the failure
                return $response->json();
            }
            // //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                $datas = [
                    'data' => [
                        'message' => 'Failed'
                    ]
                ];
                return $datas;
                // return view('errors.404')->with([
                //     'message' => 'Failed.',
                // ]);
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                $datas = [
                    'data' => [
                        'message' => 'serverError'
                    ]
                ];
                return $datas;
                // return view('errors.500')->with([
                //     'message' => 'serverError.',
                // ]);
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                $datas = [
                    'data' => [
                        'message' => 'clientError'
                    ]
                ];
                return $datas;
                // return view('errors.503')->with([
                //     'message' => 'clientError.',
                // ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            // $e->getMessage() - will output "cURL error 6: Could not resolve host" in case of invalid domain
        }
    }
    // decrypt string
    public static function decryptStringData($string)
    {
        try {
            $data = Crypt::decryptString($string);
        } catch (DecryptException $e) {
            $data = "";
        }
        return $data;
    }
    // greeting message
    public static function greetingMessage()
    {
        $greetings = "";
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greetings = __('messages.good_morning');
        } else {
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $greetings = __('messages.good_afternoon');
            } else {
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {

                    $greetings =  __('messages.good_evening');
                } else {
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        $greetings = __('messages.good_night');
                    }
                }
            }
        }
        return $greetings;
    }

    // get like column
    public static function getLikeColumn($url, $data)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                ->retry(3, 2000)->timeout(12)
                // ->withBody("dummy body content", "application/json")
                ->post($url, $data);
            // Determine if the status code is >= 200 and < 300...
            if ($response->successful()) {
                // process the failure
                return $response->json();
            }
            // //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                $datas = [
                    'data' => [
                        'message' => 'Failed'
                    ]
                ];
                return $datas;
                // return view('errors.404')->with([
                //     'message' => 'Failed.',
                // ]);
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                $datas = [
                    'data' => [
                        'message' => 'serverError'
                    ]
                ];
                return $datas;
                // return view('errors.500')->with([
                //     'message' => 'serverError.',
                // ]);
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                $datas = [
                    'data' => [
                        'message' => 'clientError'
                    ]
                ];
                return $datas;
                // return view('errors.503')->with([
                //     'message' => 'clientError.',
                // ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            // $e->getMessage() - will output "cURL error 6: Could not resolve host" in case of invalid domain
        }
    }
}
