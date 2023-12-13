<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use DateTime;
use App\Helpers\Helper;
use DataTables;
use Excel;
use App\Exports\ExamScheduleDownload;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class GuestController extends Controller
{
    //
    public function index(Request $request)
    {
        // dd($get_to_do_list_dashboard);
        return view('guest.dashboard.index',);
    }

    public function applicationIndex()
    {

        $getclass = Helper::GetMethod(config('constants.api.class_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        // dd($student);
        return view(
            'guest.application.index',
            [
                'grade' => isset($getclass['data']) ? $getclass['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
            ]
        );
    }
    public function applicationList(Request $request)
    {
        $data = [
            "academic_session_id" => session()->get('academic_session_id'),
            "academic_year" => $request->academic_year,
            "academic_grade" => $request->academic_grade,
            "created_by" => session()->get('ref_user_id'),
            "role" => session()->get('role_id'),
        ];
        $response = Helper::GETMethodWithData(config('constants.api.application_list'), $data);
        $data = isset($response['data']) ? $response['data'] : [];
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('status', function ($row) {

                $status = $row['status'];
                if ($status == "Approved") {
                    $result = "success";
                } else if ($status == "Send Back") {
                    $result = "warning";
                } else if ($status == "Applied") {
                    $result = "info";
                } else if ($status == "Reject") {
                    $result = "danger";
                }    else {
                    $result = "";
                }
                
                return '<span class="badge badge-soft-'.$result.' p-1">'.$status.'</span>';
            })
            ->addColumn('phase_2_status', function ($row) {

                $status = $row['phase_2_status'];
                if ($status == "Approved") {
                    $result = "success";
                } else if ($status == "Send Back") {
                    $result = "warning";
                } else if ($status == "Process") {
                    $result = "info";
                } else if ($status == "Reject") {
                    $result = "danger";
                }  else {
                    $result = "";
                }
                
                return '<span class="badge badge-soft-'.$result.' p-1">'.$status.'</span>';
            })
            ->addColumn('actions', function ($row) {
                $edit = route('guest.application.edit', $row['id']);
                return '<div class="button-list">
                <a href="'.$edit.'" class="btn btn-warning waves-effect waves-light" ><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteApplicationBtn"><i class="fe-trash-2"></i></a>
                         </div>';
            })

            ->rawColumns(['actions', 'status', 'phase_2_status'])
            ->make(true);
    }

    public function applicationCreate()
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
        
        $form_field_list_response = Http::post(config('constants.api.form_field_list'), $data);
        $form_field_list = $form_field_list_response->json();
        // $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        return view(
            'guest.application.add',
            [
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'contact' => isset($contactDetails['data']) ? $contactDetails['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
            ]
        );
    }
    public function applicationAdd(Request $request)
    {

        $type = "Admission";
        if($request->last_date_of_withdrawal){
            $type = "Re-Admission";
        }
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'nationality' => $request->nationality,
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
            're_admission' => $request->re_admission,
            'last_date_of_withdrawal' => $request->last_date_of_withdrawal,
            'created_by' => session()->get('ref_user_id'),
            'created_by_role' => session()->get('role_id'),
            "type" => $type

        ];

        $response = Helper::PostMethod(config('constants.api.application_add'), $data);

        return $response;
    }

    
    public function applicationEdit($id)
    {

        
        $data = [
            'id' => $id,
        ];
        // dd($data);
        $application = Helper::PostMethod(config('constants.api.application_details'), $data);
        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // dd($application['data']['guardian_first_name']);
        return view(
            'guest.application.edit',
            [
                'application' => isset($application['data']) ? $application['data'] : [],
                'religion' => isset($religion['data']) ? $religion['data'] : [],
                'races' => isset($races['data']) ? $races['data'] : [],
                'relation' => isset($relation['data']) ? $relation['data'] : [],
                'academic_year_list' => isset($academic_year_list['data']) ? $academic_year_list['data'] : [],
                'grade' => isset($grade['data']) ? $grade['data'] : [],
                'form_field' => isset($form_field['data'][0]) ? $form_field['data'][0] : [],
            ]
        );
    }
    public function applicationUpdate(Request $request)
    {
        // dd(1);
        $trail_date = "";
        if($request->enrollment=="Trail Enrollment"){
            $trail_date = $request->trail_date;
        }
        $status = $request->status;
        if($request->status==""){
            $status = $request->phase_1_status;
        }
        $visa_base64 = "";
        $visa_extension = "";
        $visa_file = $request->file('visa_photo');
        if ($visa_file) {
            $visa_path = $visa_file->path();
            $visa_data = file_get_contents($visa_path);
            $visa_base64 = base64_encode($visa_data);
            $visa_extension = $visa_file->getClientOriginalExtension();
        }
        
        $passport_base64 = "";
        $passport_extension = "";
        $passport_file = $request->file('passport_photo');
        if ($passport_file) {
            $passport_path = $passport_file->path();
            $passport_data = file_get_contents($passport_path);
            $passport_base64 = base64_encode($passport_data);
            $passport_extension = $passport_file->getClientOriginalExtension();
        }
            $data = [
                'id' => $request->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'first_name_english' => $request->first_name_english,
                'last_name_english' => $request->last_name_english,
                'first_name_furigana' => $request->first_name_furigana,
                'last_name_furigana' => $request->last_name_furigana,
                'race' => $request->race,
                'religion' => $request->religion,
                'blood_group' => $request->blood_group,
                'nationality' => $request->nationality,
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
                'status' => $status,
                'passport' => $request->passport,
                'nric' => $request->nric,
                'passport_expiry_date' => $request->passport_expiry_date,
                'visa_number' => $request->visa_number,
                'visa_expiry_date' => $request->visa_expiry_date,
                'nationality' => $request->nationality,
                'visa_photo' => $visa_base64,
                'visa_file_extension' => $visa_extension,
                'passport_photo' => $passport_base64,
                'passport_file_extension' => $passport_extension,
                'phase_2_status' => $request->phase_2_status,
                'enrollment' => $request->enrollment,
                'trail_date' => $trail_date,
                'phase_1_reason' => $request->phase_1_reason,
                'phase_2_reason' => $request->phase_2_reason,
                'role_id' => session()->get('role_id'),
            ];
        // }
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.application_update'), $data);

        return $response;
    }
}
