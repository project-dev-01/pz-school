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
use Illuminate\Support\Facades\Log;

class Helper
{

    // code generaaator
    // public static function CodeGenerator($model, $trow, $length = null, $prefix)
    // {
    //     $length = 4;
    //     $data = $model::orderBy('id', 'desc')->first();
    //     if (!$data) {
    //         $og_length = $length;
    //         $last_number = '';
    //     } else {
    //         $code = substr($data->$trow, strlen($prefix) + 1);
    //         $actial_last_number = ($code / 1) * 1;
    //         $increment_last_number = ((int)$actial_last_number) + 1;
    //         $last_number_length = strlen($increment_last_number);
    //         $og_length = $length - $last_number_length;
    //         $last_number = $increment_last_number;
    //     }
    //     $zeros = "";
    //     for ($i = 0; $i < $og_length; $i++) {
    //         $zeros .= "0";
    //     }
    //     return $prefix . '-' . $zeros . $last_number;
    // }

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
                abort(404, view('errors.404'));
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                abort(500, view('errors.500'));
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                abort(503, view('errors.503'));
            }
        } catch (\Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);
            // return $e->getMessage();
            // Handle HTTP client request exceptions
            if ($e instanceof \Illuminate\Http\Client\RequestException && $e->response && $e->response->status() >= 400) {
                // 401,403,404,419,429,500,503,client_error
                if ($e->response->status() == 503) {
                    abort(503, view('errors.503'));
                } else if ($e->response->status() == 500) {
                    abort(500, view('errors.500'));
                } else if ($e->response->status() == 429) {
                    abort(429, view('errors.429'));
                } else if ($e->response->status() == 419) {
                    abort(419, view('errors.419'));
                } else if ($e->response->status() == 404) {
                    abort(404, view('errors.404'));
                } else if ($e->response->status() == 403) {
                    abort(403, view('errors.403'));
                } else if ($e->response->status() == 401) {
                    abort(401, view('errors.401'));
                } else {
                    // abort(424, view('errors.424'));
                    return $e->getMessage();
                }
            }

            return null; // Continue normal execution if no client error occurred
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
                abort(404, view('errors.404'));
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                abort(500, view('errors.500'));
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                abort(503, view('errors.503'));
            }
        } catch (\Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);
            // Handle HTTP client request exceptions
            if ($e instanceof \Illuminate\Http\Client\RequestException && $e->response && $e->response->status() >= 400) {
                // 401,403,404,419,429,500,503,client_error
                if ($e->response->status() == 503) {
                    abort(503, view('errors.503'));
                } else if ($e->response->status() == 500) {
                    abort(500, view('errors.500'));
                } else if ($e->response->status() == 429) {
                    abort(429, view('errors.429'));
                } else if ($e->response->status() == 419) {
                    abort(419, view('errors.419'));
                } else if ($e->response->status() == 404) {
                    abort(404, view('errors.404'));
                } else if ($e->response->status() == 403) {
                    abort(403, view('errors.403'));
                } else if ($e->response->status() == 401) {
                    abort(401, view('errors.401'));
                } else {
                    // abort(424, view('errors.424'));
                    return $e->getMessage();
                }
            }

            return null; // Continue normal execution if no client error occurred
        }
    } // post api call

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
            //Check for any error 400 or 500 level status code
            if ($response->failed()) {
                // process the failure
                return $response->json();
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                return $response->json();
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                return $response->json();
            }
            return $response->json();
        } catch (\Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);
            // Handle HTTP client request exceptions
            if ($e instanceof \Illuminate\Http\Client\RequestException && $e->response && $e->response->status() >= 400) {
                // return $e->getMessage();
                // 401,403,404,419,429,500,503,client_error
                if ($e->response->status() == 503) {
                    abort(503, view('errors.503'));
                } else if ($e->response->status() == 500) {
                    abort(500, view('errors.500'));
                } else if ($e->response->status() == 429) {
                    abort(429, view('errors.429'));
                } else if ($e->response->status() == 419) {
                    abort(419, view('errors.419'));
                } else if ($e->response->status() == 404) {
                    abort(404, view('errors.404'));
                } else if ($e->response->status() == 403) {
                    abort(403, view('errors.403'));
                } else if ($e->response->status() == 401) {
                    abort(401, view('errors.401'));
                } else {
                    return $e->getMessage();
                }
            }
            return null; // Continue normal execution if no client error occurred
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
                abort(404, view('errors.404'));
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                abort(500, view('errors.500'));
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                abort(503, view('errors.503'));
            }
        } catch (\Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);
            // Handle HTTP client request exceptions
            if ($e instanceof \Illuminate\Http\Client\RequestException && $e->response && $e->response->status() >= 400) {
                // 401,403,404,419,429,500,503,client_error
                if ($e->response->status() == 503) {
                    abort(503, view('errors.503'));
                } else if ($e->response->status() == 500) {
                    abort(500, view('errors.500'));
                } else if ($e->response->status() == 429) {
                    abort(429, view('errors.429'));
                } else if ($e->response->status() == 419) {
                    abort(419, view('errors.419'));
                } else if ($e->response->status() == 404) {
                    abort(404, view('errors.404'));
                } else if ($e->response->status() == 403) {
                    abort(403, view('errors.403'));
                } else if ($e->response->status() == 401) {
                    abort(401, view('errors.401'));
                } else {
                    abort(424, view('errors.424'));
                }
            }

            return null; // Continue normal execution if no client error occurred
        }
    }
    // decrypt string
    public static function decryptStringData($string)
    {
        try {
            $data = Crypt::decryptString($string);
        } catch (DecryptException $e) {
            Log::error("HTTP request failed", [
                'string' => $string,
                'error' => $e->getMessage(),
            ]);
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
                abort(404, view('errors.404'));
            }
            // //Check if response has error with 500 level status code
            if ($response->serverError()) {
                //process on server error
                abort(500, view('errors.500'));
            }
            // //Check if response has error with 400 level status code
            if ($response->clientError()) {
                //process on client error
                abort(503, view('errors.503'));
            }
        } catch (\Exception $e) {
            Log::error("Error in HTTP request: " . $e->getMessage());
            // Handle HTTP client request exceptions
            if ($e instanceof \Illuminate\Http\Client\RequestException && $e->response && $e->response->status() >= 400) {
                // 401,403,404,419,429,500,503,client_error
                if ($e->response->status() == 503) {
                    abort(503, view('errors.503'));
                } else if ($e->response->status() == 500) {
                    abort(500, view('errors.500'));
                } else if ($e->response->status() == 429) {
                    abort(429, view('errors.429'));
                } else if ($e->response->status() == 419) {
                    abort(419, view('errors.419'));
                } else if ($e->response->status() == 404) {
                    abort(404, view('errors.404'));
                } else if ($e->response->status() == 403) {
                    abort(403, view('errors.403'));
                } else if ($e->response->status() == 401) {
                    abort(401, view('errors.401'));
                } else {
                    abort(424, view('errors.424'));
                }
            }

            return null; // Continue normal execution if no client error occurred
        }
    }
}
