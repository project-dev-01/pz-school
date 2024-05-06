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
    // get api call get method
    public static function GetMethod($url)
    {
        $data["token"] = session()->get('token');
        $data["branch_id"] = session()->get('branch_id');
        try {
            $response = Http::withToken(session()->get('token'))
                // ->accept('application/json')
                // ->retry(3, 2000)->timeout(12)
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
                // ->retry(3, 2000)->timeout(12)
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
                // ->retry(3, 2000)->timeout(12)
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
}
