<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class CommonController extends Controller
{
    //
    public function updateSettingSession(Request $request)
    {
        // dd($request);
        if (session()->has('picture') && $request->picture) {
            session()->pull('picture');
            $request->session()->put('picture', $request->picture);
            return true;
        } else {
            return false;
        }
    }
    public function showApplicationForm()
    {
        return view('school-application-form');
    }
    function DBMigrationCall(){
        // Artisan::call("migrate", ['name' => 'test', '--fieldsFile' => 'database/migrations/dynamic_migrate']);
        config(['database.connections.mysql_new_connection' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'school-management-system-01'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            // 'collation' => 'utf8_unicode_ci'
        ]]);

        Artisan::call('migrate',
        array(
        '--path' => 'database/migrations/dynamic_migrate',
        '--database' => 'mysql_new_connection',
        '--force' => true));
        echo "migration table executed success";
    }
    
}
