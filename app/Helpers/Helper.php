<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Exception;

class Helper
{
    // get api call get method
    public static function getMethod($url, $data = [])
    {
        try {
            $data["token"] = session('token');
            $data["branch_id"] = session('branch_id');
            $response = Http::withToken(session('token'))->get($url, $data);

            return self::handleResponse($response);
        } catch (Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
    public static function GETMethodWithData($url, $data)
    {
        try {
            $data["token"] = session('token');
            $data["branch_id"] = session('branch_id');

            $response = Http::withToken(session('token'))->get($url, $data);

            return self::handleResponse($response);
        } catch (Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
    // post api call

    public static function postMethod($url, $data)
    {
        try {
            $data["token"] = session('token');
            $data["branch_id"] = session('branch_id');

            $response = Http::withToken(session('token'))->post($url, $data);

            return self::handleResponse($response);
        } catch (Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private static function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        } elseif ($response->clientError()) {
            abort($response->status(), view('errors.' . $response->status()));
        } elseif ($response->serverError()) {
            abort($response->status(), view('errors.' . $response->status()));
        } else {
            return null;
        }
    }
    // get api call
    public static function DataTableGetMethod($url, $data)
    {
        try {
            $data["token"] = session('token');
            $data["branch_id"] = session('branch_id');

            $response = Http::withToken(session('token'))->get($url, $data);

            return self::handleResponse($response);
        } catch (Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'body' => $data,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }
    // decrypt string
    public static function decryptStringData($string)
    {
        try {
            return Crypt::decryptString($string);
        } catch (DecryptException $e) {
            Log::error("Error decrypting string: " . $e->getMessage());
            return null;
        }
    }
    // greeting message
    public static function greetingMessage()
    {
        $time = date("H");

        if ($time < "12") {
            return __('messages.good_morning');
        } elseif ($time < "17") {
            return __('messages.good_afternoon');
        } elseif ($time < "19") {
            return __('messages.good_evening');
        } else {
            return __('messages.good_night');
        }
    }

    // get like column
    public static function getLikeColumn($url, $data)
    {
        try {
            $data["token"] = session('token');
            $data["branch_id"] = session('branch_id');

            $response = Http::withToken(session('token'))->post($url, $data);

            return self::handleResponse($response);
        } catch (Exception $e) {
            Log::error("Error in HTTP request: " . $e->getMessage());
            return null;
        }
    }
}
