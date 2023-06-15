<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use DateTime;
use App\Helpers\Helper;
use Excel;
use App\Exports\ExamScheduleDownload;

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
        
        $data = [
            'branch_id' => config('constants.branch_id')
        ];
        $relation_response = Http::post(config('constants.api.application_relation_list'), $data);
        $relation = $relation_response->json();

        $academic_year_list_response = Http::post(config('constants.api.application_academic_year_list'), $data);
        $academic_year_list = $academic_year_list_response->json();
        return view(
            'school-application-form',
            [
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : []
            ]
        );
    }
    
    public function addApplicationForm(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'grade' => $request->grade,
            'school_year' => $request->school_year,
            'school_last_attended' => $request->school_last_attended,
            'school_address_1' => $request->school_address_1,
            'school_address_2' => $request->school_address_2,
            'school_country' => $request->school_country,
            'school_city' => $request->school_city,
            'school_state' => $request->school_state,
            'school_postal_code' => $request->school_postal_code,
            'father_first_name' => $request->father_first_name,
            'father_last_name' => $request->father_last_name,
            'father_phone_number' => $request->father_phone_number,
            'father_occupation' => $request->father_occupation,
            'father_email' => $request->father_email,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone_number' => $request->mother_phone_number,
            'mother_occupation' => $request->mother_occupation,
            'mother_email' => $request->mother_email,
            'guardian_first_name' => $request->guardian_first_name,
            'guardian_last_name' => $request->guardian_last_name,
            'guardian_phone_number' => $request->guardian_phone_number,
            'guardian_occupation' => $request->guardian_occupation,
            'guardian_email' => $request->guardian_email,
            'guardian_relation' => $request->guardian_relation,

        ];

        // dd($data);
        $response = Helper::PostMethod(config('constants.api.application_add'), $data);
        return $response;
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
    public function examScheduleDownloadExcel(Request $request)
    {
        return Excel::download(new ExamScheduleDownload($request->exam_name,$request->class_section_name,$request->class_id, $request->section_id, $request->exam_id, $request->semester_id, $request->session_id), 'ExamSchedule.xlsx');
    }
    public function soapStudentID(Request $request)
    {
        // dd($request);
        if (session()->has('soap_student_id') || $request->soap_student_id) {
            session()->pull('soap_student_id');
            $request->session()->put('soap_student_id', $request->soap_student_id);
            return true;
        } else {
            return false;
        }
    }
}
