<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use DateTime;

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
    function DBMigrationCall()
    {
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

        Artisan::call(
            'migrate',
            array(
                '--path' => 'database/migrations/dynamic_migrate',
                '--database' => 'mysql_new_connection',
                '--force' => true
            )
        );
        echo "migration table executed success";
    }  
    function get_timeago( $ptime )
    {
        $estimate_time = time() - $ptime;
    
        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }
    
        $condition = array(
                    12 * 30 * 24 * 60 * 60  =>  'yr',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hr',
                    60                      =>  'min',
                    1                       =>  'sec'
        );
    
        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;
    
            if( $d >= 1 )
            {
                $r = round( $d );
                return '' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
    function limitedChar($str)
    {
        if (strlen($str) > 20)
        $str = substr($str, 0, 30) . '...';
        return $str;
    }
    function limitedChar_category($str)
    {
        if (strlen($str) > 8)
        $str = substr($str, 0, 15) . '...';
        return $str;
    }
}
