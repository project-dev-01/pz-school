<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use DateTime;
use App\Helpers\Helper;

class CommonController extends Controller
{
    //
    public function updateSettingSession(Request $request)
    {
        // dd($request);
        if (session()->has('picture') || $request->picture) {
            session()->pull('picture');
            $request->session()->put('picture', $request->picture);
            return true;
        } else {
            return false;
        }
    }
    public function updateSettingSessionLogo(Request $request)
    {
        // dd($request);
        if (session()->has('school_logo') || $request->school_logo) {
            session()->pull('school_logo');
            $request->session()->put('school_logo', $request->school_logo);
            return true;
        } else {
            return false;
        }
    }
    // update child id
    public function updateStudentID(Request $request)
    {
        // dd($request);
        if (session()->has('student_id') || $request->student_id) {
            session()->pull('student_id');
            $request->session()->put('student_id', $request->student_id);
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
            'database'  => env('DB_DATABASE', 'paxsuzen_pz-school'),
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
    function get_timeago($ptime)
    {
        $estimate_time = time() - $ptime;

        if ($estimate_time < 1) {
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

        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if ($d >= 1) {
                $r = round($d);
                return '' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
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
    // unread notifications
    public function unreadNotifications(Request $request)
    {
        // return "fdfsf";
        $unread_notifications = Helper::GetMethod(config('constants.api.unread_notifications'));
        // return $unread_notifications;
        $notificationlist = '';
        $count = 0;
        if ($unread_notifications['code'] == 200) {
            // dd($unread_notifications['data']['unread']);
            // dd($unread_notifications['data']['unread_count']);
            $count = isset($unread_notifications['data']['unread_count']) ? $unread_notifications['data']['unread_count'] : 0;
            // dd($count);
            if (!empty($unread_notifications['data']['unread'])) {
                $notificationlist .= '<div class="noti-scroll" data-simplebar>';
                foreach ($unread_notifications['data']['unread'] as $notification) {
                    // dd($notification['type']);
                    if ($notification['type'] == "App\Notifications\LeaveApply") {
                        $name = isset($notification['data']['name']) ? $notification['data']['name'] : '-';
                        $from_leave = isset($notification['data']['from_leave']) ? $notification['data']['from_leave'] : '-';
                        $to_leave = isset($notification['data']['to_leave']) ? $notification['data']['to_leave'] : '-';
                        $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">' . ucfirst($name) . '</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Leave Start from ' . $from_leave . ' to ' . $to_leave . '</small>
                        </p>
                    </a>';
                    }
                    if ($notification['type'] == "App\Notifications\ReliefAssignment") {
                        $data = [
                            'calendar_id' => $notification['data']['calendar_id']
                        ];
                        $response = Helper::PostMethod(config('constants.api.get_calendar_details_timetable'), $data);
                        // dd($response['data']);
                        // dd($response['data']['class_name']);
                        $class_name = isset($response['data']['class_name']) ? $response['data']['class_name'] : '-';
                        $section_name = isset($response['data']['section_name']) ? $response['data']['section_name'] : '-';
                        $subject_name = isset($response['data']['subject_name']) ? $response['data']['subject_name'] : '-';
                        $start = isset($response['data']['start']) ? $response['data']['start'] : '-';
                        $end = isset($response['data']['end']) ? $response['data']['end'] : '-';
                        $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Relief assignment</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>A timetable for this standard ' . $class_name . ' and class ' . $section_name . ' for this subject ' . $subject_name . ' and timing is ' . $start . ' to ' . $end . '</small>
                        </p>
                    </a>';
                    }
                }
                $notificationlist .= '</div>';
            } else {
                $notificationlist .= '<div class="noti-scroll" data-simplebar>';
                $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item notify-item">
               
                <p class="notify-details"></p>
                <p class="text-muted mb-0 user-msg">
                    <small>There are no new notifications</small>
                </p>
            </a>';
                $notificationlist .= '</div>';

                // dd($notificationlist);
            }
        }
        return array('count' => $count, 'notificationlist' => $notificationlist);
    }
    // update child id
    public function greettingSession(Request $request)
    {
        // dd($request);
        if (session()->has('greetting_id') || $request->greetting_id) {
            session()->pull('greetting_id');
            $request->session()->put('greetting_id', $request->greetting_id);
            return true;
        } else {
            return false;
        }
    }
}
