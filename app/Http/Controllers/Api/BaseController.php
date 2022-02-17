<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function successResponse($result, $message)
    {
        $response = [
            'code' => 200,
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function send404Error($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'code' => 404,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function send500Error($error, $errorMessages = [], $code = 500)
    {
        $response = [
            'code' => 500,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
    public function send400Error($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'code' => 400,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function send422Error($error, $errorMessages = [], $code = 422)
    {
        $response = [
            'code' => 422,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
    // create migration file
    function DBMigrationCall($dbName, $dbUsername, $dbPass)
    {

        // Artisan::call("migrate", ['name' => 'test', '--fieldsFile' => 'database/migrations/dynamic_migrate']);
        config(['database.connections.mysql_new_connection' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'database'  => env('DB_DATABASE', $dbName),
            'username'  => env('DB_USERNAME', $dbUsername),
            'password'  => env('DB_PASSWORD', $dbPass),
            'charset'   => 'utf8',
            // 'collation' => 'utf8_unicode_ci'
        ]]);

        Artisan::call(
            'migrate',
            array(
                '--path' => 'database/migrations/dynamic_migrate',
                '--database' => 'mysql_new_connection',
                '--force' => true
            )
        );
        return true;
    }
    // create users
    function createUser(Request $request, $lastInsertID)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->password = \Hash::make($request->password);
        $user->branch_id = $lastInsertID;
        $query = $user->save();
        if (!$query) {
            return false;
        } else {
            return true;
        }
    }
    // check users email exit 
    function existUser($email)
    {
        if (User::where('email', '=', $email)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
    // check users email exit 
    function existBranch($email)
    {
        if (Branches::where('email', '=', $email)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}
