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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

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

        $contact = Http::post(config('constants.api.get_home_page_details'), $data);
        $contactDetails = $contact->json();

        $grade_response = Http::post(config('constants.api.application_grade_list'), $data);
        $grade = $grade_response->json();

        $relation_response = Http::post(config('constants.api.application_relation_list'), $data);
        $relation = $relation_response->json();

        $academic_year_list_response = Http::post(config('constants.api.application_academic_year_list'), $data);
        $academic_year_list = $academic_year_list_response->json();
        return view(
            'school-application-form',
            [
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'contact' => isset($contactDetails['data']) ? $contactDetails['data'] : [],
            ]
        );
    }

    public function addApplicationForm(Request $request)
    {
        $verify_email = $request->verify_email . '_email';
        // dd($verify_email);
        $created_by = session()->get('ref_user_id');
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
            'academic_grade' => $request->academic_grade,
            'academic_year' => $request->academic_year,
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
            'branch_id' => config('constants.branch_id'),
            'created_by' => isset($created_by) ? $created_by : "Public",
            'created_by_role' => session()->get('role_id'),
            'verify_email' => $request->$verify_email,
            'url' => url('/'),

        ];
        $application = Http::post(config('constants.api.application_add'), $data);
        $response = $application->json();
        return $response;
    }

    public function emailApplicationForm(Request $request, $branch_id, $token)
    {
        // dd($verify_email);
        $data = [
            'branch_id' => $branch_id,
            'url' => url('/'),
            'token' => $token,
        ];
        // dd($data);

        $application = Http::post(config('constants.api.application_email'), $data);
        $response = $application->json();
        // dd($response);
        return view(
            'school-application-email',
            [
                'application' => isset($response['message']) ? $response['message'] : [],
            ]
        );
    }
    public function verifyApplicationForm(Request $request)
    {
        $data = [
            'branch_id' => config('constants.branch_id'),
            'url' => url('/'),
            'email' => $request->email
        ];
        $application = Http::post(config('constants.api.application_verify'), $data);
        $response = $application->json();
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
    public function get_timeago($ptime)
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
    public static function limitedChar($str)
    {
        if (strlen($str) > 20)
            $str = substr($str, 0, 30) . '...';
        return $str;
    }
    public static function limitedChar_category($str)
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
            $count = isset($unread_notifications['data']['unread']) ? count($unread_notifications['data']['unread']) : 0;
            // $count = count($count);
            // dd($count);
            if (!empty($unread_notifications['data']['unread'])) {
                $notificationlist .= '<div class="noti-scroll" data-simplebar>';
                foreach ($unread_notifications['data']['unread'] as $notification) {
                    // dd($notification['type']);
                    if ($notification['type'] == "App\Notifications\LeaveApprove") {
                        $redirectRoute = "javascript:void(0)";
                        if (session()->get('role_id') == 2 || session()->get('role_id') == '2') {
                            $redirectRoute = route('admin.leave_management.applyleave');
                        }
                        if (session()->get('role_id') == 3 || session()->get('role_id') == '3') {
                            $redirectRoute = route('staff.leave_management.applyleave');
                        }
                        if (session()->get('role_id') == 4 || session()->get('role_id') == '4') {
                            $redirectRoute = route('teacher.leave_management.applyleave');
                        }

                        $from_leave = isset($notification['data']['from_leave']) ? $notification['data']['from_leave'] : '-';
                        $to_leave = isset($notification['data']['to_leave']) ? $notification['data']['to_leave'] : '-';
                        $notificationlist .= '<a href="' . $redirectRoute . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="text-muted mb-0 user-msg">
                            <small>Your leave application for ' . $from_leave . ' to ' . $to_leave . ' was approved</small>
                        </p>
                        </a>';
                    }
                    if ($notification['type'] == "App\Notifications\LeaveApply") {
                        $redirectRoute = "javascript:void(0)";
                        if (session()->get('role_id') == 2 || session()->get('role_id') == '2') {
                            $redirectRoute = route('admin.leave_management.allleaves');
                        }
                        if (session()->get('role_id') == 3 || session()->get('role_id') == '3') {
                            $redirectRoute = route('staff.leave_management.allleaves');
                        }
                        if (session()->get('role_id') == 4 || session()->get('role_id') == '4') {
                            $redirectRoute = route('teacher.leave_management.allleaves');
                        }

                        $name = isset($notification['data']['name']) ? $notification['data']['name'] : '-';
                        $from_leave = isset($notification['data']['from_leave']) ? $notification['data']['from_leave'] : '-';
                        $to_leave = isset($notification['data']['to_leave']) ? $notification['data']['to_leave'] : '-';
                        $notificationlist .= '<a href="' . $redirectRoute . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">' . ucfirst($name) . '</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Leave Start from ' . $from_leave . ' to ' . $to_leave . '</small>
                        </p>
                    </a>';
                    }
                    if ($notification['type'] == "App\Notifications\StudentLeaveApply") {
                        $redirectRoute = "javascript:void(0)";
                        if (session()->has('role_id')) {
                            $role_id = session()->get('role_id');
                            if ($role_id == 2) {
                                $redirectRoute = route('admin.student_leave.list');
                            } elseif ($role_id == 3) {
                                $redirectRoute = route('staff.student_leave.list');
                            } elseif ($role_id == 4) {
                                $redirectRoute = route('teacher.student_leave.list');
                            }
                        }
                    
                        $name = isset($notification['data']['name']) ? $notification['data']['name'] : '-';
                        $from_leave = isset($notification['data']['from_leave']) ? $notification['data']['from_leave'] : '-';
                        $to_leave = isset($notification['data']['to_leave']) ? $notification['data']['to_leave'] : '-';
                        $notificationlist .= '<a href="' . $redirectRoute . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                            <p class="notify-details">' . ucfirst($name) . '</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Student Leave Start from ' . $from_leave . ' to ' . $to_leave . '</small>
                            </p>
                        </a>';
                    }
                    
                    if ($notification['type'] == "App\Notifications\StudentInfoUpdate") {
                        $parent_name = isset($notification['data']['info_update']['parent_name']) ? $notification['data']['info_update']['parent_name'] : '-';
                        $student_name = isset($notification['data']['info_update']['student_name']) ? $notification['data']['info_update']['student_name'] : '-';

                        $notificationlist .= '<a href="' . route('admin.student.update_info') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Information Update</p>
                        <p class="text-muted mb-0 user-msg">
                            <small> ' . $parent_name . ' Parent Updated Their Student ' . $student_name . ' Information </small>
                        </p>
                        </a>';
                    }
                    if ($notification['type'] == "App\Notifications\ParentInfoUpdate") {
                        $parent_name = isset($notification['data']['info_update']['parent_name']) ? $notification['data']['info_update']['parent_name'] : '-';

                        $notificationlist .= '<a href="' . route('admin.parent.update_info') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Information Update</p>
                        <p class="text-muted mb-0 user-msg">
                            <small> ' . $parent_name . ' Parent Updated Their Information </small>
                        </p>
                        </a>';
                    }
                    if ($notification['type'] == "App\Notifications\ParentTermination") {
                        $student_name = isset($notification['data']['termination']['student_name']) ? $notification['data']['termination']['student_name'] : '-';
                        $parent_name = isset($notification['data']['termination']['parent_name']) ? $notification['data']['termination']['parent_name'] : '-';
                        $status = isset($notification['data']['termination']['status']) ? $notification['data']['termination']['status'] : '-';

                        $notificationlist .= '<a href="' . route('admin.termination.index') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Termination</p>
                        <p class="text-muted mb-0 user-msg">
                            <small> ' . $student_name . ' Termination  has Been ' . $status . ' By ' . $parent_name . ' </small>
                        </p>
                        </a>';
                    }
                    if ($notification['type'] == "App\Notifications\AdminTermination") {
                        $student_name = isset($notification['data']['termination']['student_name']) ? $notification['data']['termination']['student_name'] : '-';
                        $date = isset($notification['data']['termination']['date']) ? $notification['data']['termination']['date'] : '-';
                        $status = isset($notification['data']['termination']['status']) ? $notification['data']['termination']['status'] : '-';

                        $notificationlist .= '<a href="' . route('parent.termination.index') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Termination</p>
                        <p class="text-muted mb-0 user-msg">
                            <small> ' . $student_name . ' Termination  has Been ' . $status . ' By  Admin Termination Date ( ' . $date . ' )</small>
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

                    if ($notification['type'] == "App\Notifications\StudentHomeworkSubmit") {

                        // dd($notification['data']['homework']['homework_name']);

                        // dd($response['data']['class_name']);

                        $student_name = isset($notification['data']['homework']['student_name']) ? $notification['data']['homework']['student_name'] : '';
                        $class_name = isset($notification['data']['homework']['class_name']) ? $notification['data']['homework']['class_name'] : '';
                        $section_name = isset($notification['data']['homework']['section_name']) ? $notification['data']['homework']['section_name'] : '';
                        $subject_name = isset($notification['data']['homework']['subject_name']) ? $notification['data']['homework']['subject_name'] : '';
                        $date = isset($notification['data']['homework']['date']) ? $notification['data']['homework']['date'] : '';
                        $homework_name = isset($notification['data']['homework']['homework_name']) ? $notification['data']['homework']['homework_name'] : '';
                        $notificationlist .= '<a href="' . route('teacher.evaluation_report') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Homework (' . $date . ')</p>
                        <p class="text-muted mb-0 user-msg">
                            <small> ' . $student_name . ' ( ' . $class_name . ' - ' . $section_name . ' ) has Submitted Homework ' . $homework_name . ' ( ' . $subject_name . ' )</small>
                        </p>
                        </a>';
                    }

                    if ($notification['type'] == "App\Notifications\TeacherHomework") {

                        // dd($notification['data']['homework']['homework_name']);

                        // dd($response['data']['class_name']);

                        $student_name = isset($notification['data']['homework']['student_name']) ? $notification['data']['homework']['student_name'] : '';
                        $class_name = isset($notification['data']['homework']['class_name']) ? $notification['data']['homework']['class_name'] : '';
                        $section_name = isset($notification['data']['homework']['section_name']) ? $notification['data']['homework']['section_name'] : '';
                        $subject_name = isset($notification['data']['homework']['subject_name']) ? $notification['data']['homework']['subject_name'] : '';
                        $date = isset($notification['data']['homework']['due_date']) ? $notification['data']['homework']['due_date'] : '';
                        $homework_name = isset($notification['data']['homework']['homework_name']) ? $notification['data']['homework']['homework_name'] : '';
                        $notificationlist .= '<a href="' . route('student.homework') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="notify-details">Homework (' . $date . ')</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>' . $homework_name . ' ( ' . $subject_name . ' ) has Assigned - Due Date (' . $date . ' )</small>
                        </p>
                        </a>';
                    }
                    if ($notification['type'] == "App\Notifications\LeaveReasonNotification") {

                        // dd($notification['data']['homework']['homework_name']);

                        // dd($response['data']['class_name']);
                        $status = isset($notification['data']['leave_approve_details']['status']) ? $notification['data']['leave_approve_details']['status'] : '';
                        // $notificationlist .= '<a href="' . route('student.homework') . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        // <p class="notify-details">Homework (' . $date . ')</p>
                        // <p class="text-muted mb-0 user-msg">
                        //     <small>' . $status . ' ( ' . $subject_name . ' ) has Assigned - Due Date (' . $date . ' )</small>
                        // </p>
                        // </a>';

                        $redirectRoute = "javascript:void(0)";
                        // if (session()->get('role_id') == 2 || session()->get('role_id') == '2') {
                        //     $redirectRoute = route('admin.leave_management.applyleave');
                        // }
                        // if (session()->get('role_id') == 3 || session()->get('role_id') == '3') {
                        //     $redirectRoute = route('staff.leave_management.applyleave');
                        // }
                        // if (session()->get('role_id') == 4 || session()->get('role_id') == '4') {
                        //     $redirectRoute = route('teacher.leave_management.applyleave');
                        // }

                        $from_leave = isset($notification['data']['leave_approve_details']['from_leave']) ? $notification['data']['leave_approve_details']['from_leave'] : '-';
                        $to_leave = isset($notification['data']['leave_approve_details']['to_leave']) ? $notification['data']['leave_approve_details']['to_leave'] : '-';
                        $notificationlist .= '<a href="' . $redirectRoute . '" class="dropdown-item mark-as-read" data-id="' . $notification['id'] . '">
                        <p class="text-muted mb-0 user-msg">
                            <small>Your leave application for ' . $from_leave . ' to ' . $to_leave . ' was ' . $status . '</small>

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
    protected function getRedirectRoute($routeName)
    {
        switch (session()->get('role_id')) {
            case 2:
                return route('admin.' . $routeName);
            case 3:
                return route('staff.' . $routeName);
            case 4:
                return route('teacher.' . $routeName);
            default:
                return "javascript:void(0)";
        }
    }
    // remainder Notifications
    public function remainderNotifications(Request $request)
    {
        // return "fdfsf";
        // $unread_notifications = Helper::GetMethod(config('constants.api.get_today_schedules_admin'));
        $url = "";
        $data = [
            'login_id' => session()->get('user_id'),
            'teacher_id' => session()->get('ref_user_id')
        ];
        $role_id = session()->get('role_id');
        if ($role_id == 2 || $role_id == '2') {
            $url = config('constants.api.get_today_schedules_admin');
        }
        if ($role_id == 4 || $role_id == '2') {
            $url = config('constants.api.get_today_schedules_teacher');
        }
        $unread_notifications = Helper::GETMethodWithData($url, $data);
        // return $unread_notifications;
        $notificationlist = '';
        $count = 0;
        if ($unread_notifications['code'] == 200) {
            $counting = isset($unread_notifications['data']) ? $unread_notifications['data'] : 0;
            $lengthArr = count($counting);
            // $notificationlist .= '<div class="noti-scroll" data-simplebar>';
            if ($lengthArr > 0) {
                foreach ($unread_notifications['data'] as $val) {
                    $allDay = isset($val['allDay']) ? $val['allDay'] : null;
                    $timeDifference = $this->timeago($val['start'], $val['end'], $allDay);
                    $startTime = $val['start']; // Replace with your datetime string
                    $meetingtime = new DateTime($startTime);
                    $formattedTime = $meetingtime->format('h:i A'); // Format as hours:minutes AM/PM
                    if (isset($timeDifference)) {
                        $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <i class="mdi mdi-calendar-clock font-22" style="color:#436ce5;"></i>
                        </div>
                        <p class="notify-details" style="color:#436ce5;">' . $val['title'] . '</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>' . $formattedTime . '</small>
                            <small class="float-right">' . $timeDifference . '</small>
                        </p>
                    </a>';
                        $count++;
                    }
                }
            } else {
                $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item notify-item">
                <p class="notify-details"></p>
                <p class="text-muted mb-0 user-msg">
                    <small>There are no new notifications</small>
                </p>
            </a>';
            }
            if ($notificationlist == "") {
                $notificationlist .= '<a href="javascript:void(0);" class="dropdown-item notify-item">
                <p class="notify-details"></p>
                <p class="text-muted mb-0 user-msg">
                    <small>There are no new notifications</small>
                </p>
            </a>';
            }
            // $notificationlist .= '</div>';
        }
        return array('count' => $count, 'notificationlist' => $notificationlist);
    }
    public function timeago($start, $end, $allDay)
    {
        // $meetingDatetimeString = '2023-08-28 23:50:00'; // Replace with your datetime string
        $meetingDatetimeString = $start; // Replace with your datetime string
        $startDateString = $start; // Replace with your datetime string
        $endDatetimeString = $end; // Replace with your datetime string
        // Create DateTime objects for the meeting datetime and current datetime
        $meetingDatetime = new DateTime($meetingDatetimeString);
        $currentDatetime = new DateTime();
        $startDatetime = new DateTime($startDateString);
        $endDatetime = new DateTime($endDatetimeString);
        // if it is all day come over here
        if (isset($allDay)) {
            if ($allDay == 1) {
                // Compare the current datetime with the start and end datetimes
                if ($currentDatetime >= $startDatetime && $currentDatetime <= $endDatetime) {
                    // The current datetime is within the specified range
                    return "All Day";
                } else {
                    // The current datetime is outside the specified range
                    return null;
                }
            }
        }
        if ($currentDatetime < $meetingDatetime) {
            // Calculate the time difference
            $timeDifference = $meetingDatetime->getTimestamp() - $currentDatetime->getTimestamp();

            // Calculate days, hours, minutes, and seconds remaining
            $daysRemaining = floor($timeDifference / (60 * 60 * 24));
            $hoursRemaining = floor(($timeDifference % (60 * 60 * 24)) / (60 * 60));
            $minutesRemaining = floor(($timeDifference % (60 * 60)) / 60);
            $secondsRemaining = $timeDifference % 60;

            // Display the remaining time
            if ($daysRemaining > 0) {
                return "$daysRemaining days ";
            } elseif ($hoursRemaining > 0) {
                return "$hoursRemaining hours ";
            } elseif ($minutesRemaining > 0) {
                return "$minutesRemaining minutes ";
            } elseif ($secondsRemaining > 0) {
                return "$secondsRemaining seconds";
            } else {
                // it come only current day
                return null;
                // return $meetingDatetime->format('Y-m-d H:i:s') . ' ' . $currentDatetime->format('Y-m-d H:i:s');
            }
        }
    }
    // public function timebetweenCheck()
    // {
    //     $currentDateTime = new DateTime();  // Current date and time
    //     $startTime = new DateTime('2023-08-30 00:00:00'); // Replace with your start time
    //     $endTime = new DateTime('2023-08-30 24:00:00');   // Replace with your end time
    //     // print_r($currentDateTime);
    //     // print_r($startTime);
    //     // print_r($endTime);
    //     // exit;
    //     // Calculate the time remaining
    //     if ($currentDateTime < $startTime) {
    //         $remainingTime = $currentDateTime->diff($startTime);
    //         $message = "The event starts in: " . $remainingTime->format('%H hours %i minutes');
    //     } elseif ($currentDateTime < $endTime) {
    //         $remainingTime = $currentDateTime->diff($endTime);
    //         $message = "The event ends in: " . $remainingTime->format('%H hours %i minutes');
    //     } else {
    //         $message = "The event has already ended.";
    //     }

    //     echo $message;
    // }
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
        return Excel::download(new ExamScheduleDownload($request->exam_name, $request->class_section_name, $request->class_id, $request->section_id, $request->exam_id, $request->semester_id, $request->session_id), 'ExamSchedule.xlsx');
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
    public function teacherClassroomSetCookie(Request $request)
    {
        $minutes = 180000;
        Cookie::queue(Cookie::make('teacher_classroom_class_id', $request->class_id, $minutes));
        Cookie::queue(Cookie::make('teacher_classroom_section_id', $request->section_id, $minutes));
        Cookie::queue(Cookie::make('teacher_classroom_subject_id', $request->subject_id, $minutes));
        Cookie::queue(Cookie::make('teacher_classroom_date', $request->class_date, $minutes));
        Cookie::queue(Cookie::make('teacher_classroom_semester', $request->semester_id, $minutes));
        Cookie::queue(Cookie::make('teacher_classroom_session', $request->session_id, $minutes));
        return true;
    }
    public function adminClassroomSetCookie(Request $request)
    {
        $minutes = 180000;
        Cookie::queue(Cookie::make('admin_classroom_class_id', $request->class_id, $minutes));
        Cookie::queue(Cookie::make('admin_classroom_section_id', $request->section_id, $minutes));
        Cookie::queue(Cookie::make('admin_classroom_subject_id', $request->subject_id, $minutes));
        Cookie::queue(Cookie::make('admin_classroom_date', $request->class_date, $minutes));
        Cookie::queue(Cookie::make('admin_classroom_semester', $request->semester_id, $minutes));
        Cookie::queue(Cookie::make('admin_classroom_session', $request->session_id, $minutes));
        return true;
    }
    public function staffClassroomSetCookie(Request $request)
    {
        $minutes = 180000;
        Cookie::queue(Cookie::make('staff_classroom_class_id', $request->class_id, $minutes));
        Cookie::queue(Cookie::make('staff_classroom_section_id', $request->section_id, $minutes));
        Cookie::queue(Cookie::make('staff_classroom_subject_id', $request->subject_id, $minutes));
        Cookie::queue(Cookie::make('staff_classroom_date', $request->class_date, $minutes));
        Cookie::queue(Cookie::make('staff_classroom_semester', $request->semester_id, $minutes));
        Cookie::queue(Cookie::make('staff_classroom_session', $request->session_id, $minutes));
        return true;
    }
    public function teacherAnalyticSetCookie(Request $request)
    {
        $minutes = 180000;
        Cookie::queue(Cookie::make('teacher_analytic_class_id', $request->class_id, $minutes));
        Cookie::queue(Cookie::make('teacher_analytic_section_id', $request->section_id, $minutes));
        Cookie::queue(Cookie::make('teacher_analytic_subject_id', $request->subject_id, $minutes));
        Cookie::queue(Cookie::make('teacher_analytic_student_id', $request->student_id, $minutes));
        Cookie::queue(Cookie::make('teacher_analytic_semester', $request->semester_id, $minutes));
        Cookie::queue(Cookie::make('teacher_analytic_session', $request->session_id, $minutes));
        return true;
    }
    public function chatnotification(Request $request)
    {
        try {
            $session_id = session()->get('ref_user_id');
            $role_id = session()->get('role_id');
            $data = [
                'userID' => $session_id,
                'role_id' => $role_id
            ];
            //dd($data);       
            $response = Helper::PostMethod(config('constants.api.chatnotification'), $data);

            return $response;
        } catch (\Exception $e) {
            // dd('123');
            // CSRF token mismatch occurred, handle the error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function clearLocalStorage(Request $request)
    {
        return view('clear-local-storage');
    }
}
