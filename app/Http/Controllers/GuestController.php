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
            'email' => session()->get('email'),
        ];
        $application = Helper::PostMethod(config('constants.api.get_application_guardian_details'), $data);

        // dd($application);
        $grade = Helper::GetMethod(config('constants.api.class_list'));
        $relation = Helper::GetMethod(config('constants.api.relation_list'));
        $academic_year_list = Helper::GetMethod(config('constants.api.academic_year_list'));
        $religion = Helper::GetMethod(config('constants.api.religion'));
        $races = Helper::GetMethod(config('constants.api.races'));
        $form_field = Helper::GetMethod(config('constants.api.form_field_list'));
        // dd($form_field);
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
                'guardian' => isset($application['data']) ? $application['data'] : [],
                'email' => session()->get('email'),
            ]
        );
    }
    public function applicationAdd(Request $request)
    {

        $type = "Admission";
        if($request->re_admission == "yes"){
            $type = "Re-Admission";
        }
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_english' => $request->first_name_english,
            'last_name_english' => $request->last_name_english,
            'first_name_furigana' => $request->first_name_furigana,
            'last_name_furigana' => $request->last_name_furigana,
            'first_name_common' => $request->first_name_common,
            'last_name_common' => $request->last_name_common,
            'race' => $request->race,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            // 'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            // 'address_1' => $request->address_1,
            // 'address_2' => $request->address_2,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            // 'academic_grade' => $request->academic_grade,
            // 'academic_year' => $request->academic_year,
            // 'grade' => $request->grade,
            // 'school_year' => $request->school_year,
            'school_last_attended' => $request->school_last_attended,
            // 'school_address_1' => $request->school_address_1,
            // 'school_address_2' => $request->school_address_2,
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
            "type" => $type,

            "middle_name" => $request->middle_name,
            "middle_name_english" => $request->middle_name_english,
            "middle_name_furigana" => $request->middle_name_furigana,
            "dual_nationality" => $request->dual_nationality,
            "school_enrollment_status" => $request->school_enrollment_status,
            "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
            "mother_middle_name" => $request->mother_middle_name,
            "mother_last_name_furigana" => $request->mother_last_name_furigana,
            "mother_middle_name_furigana" => $request->mother_middle_name_furigana,
            "mother_first_name_furigana" => $request->mother_first_name_furigana,
            "mother_last_name_english" => $request->mother_last_name_english,
            "mother_middle_name_english" => $request->mother_middle_name_english,
            "mother_first_name_english" => $request->mother_first_name_english,
            "mother_nationality" => $request->mother_nationality,
            "father_middle_name" => $request->father_middle_name,
            "father_last_name_furigana" => $request->father_last_name_furigana,
            "father_middle_name_furigana" => $request->father_middle_name_furigana,
            "father_first_name_furigana" => $request->father_first_name_furigana,
            "father_last_name_english" => $request->father_last_name_english,
            "father_middle_name_english" => $request->father_middle_name_english,
            "father_first_name_english" => $request->father_first_name_english,
            "father_nationality" => $request->father_nationality,
            "guardian_middle_name" => $request->guardian_middle_name,
            "guardian_last_name_furigana" => $request->guardian_last_name_furigana,
            "guardian_middle_name_furigana" => $request->guardian_middle_name_furigana,
            "guardian_first_name_furigana" => $request->guardian_first_name_furigana,
            "guardian_last_name_english" => $request->guardian_last_name_english,
            "guardian_middle_name_english" => $request->guardian_middle_name_english,
            "guardian_first_name_english" => $request->guardian_first_name_english,
            "guardian_company_name_japan" => $request->guardian_company_name_japan,
            "guardian_company_name_local" => $request->guardian_company_name_local,
            "guardian_company_phone_number" => $request->guardian_company_phone_number,
            "guardian_employment_status" => $request->guardian_employment_status,
            "expected_academic_year" => $request->expected_academic_year,
            "expected_grade" => $request->expected_grade,
            "expected_enroll_date" => $request->expected_enroll_date,
            "remarks" => $request->remarks,

        ];
        return $data;
        $response = Helper::PostMethod(config('constants.api.application_add'), $data);
// dd($response);
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
        // dd($application);
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

        $nric_base64 = "";
        $nric_extension = "";
        $nric_file = $request->file('nric_photo');
        if ($nric_file) {
            $nric_path = $nric_file->path();
            $nric_data = file_get_contents($nric_path);
            $nric_base64 = base64_encode($nric_data);
            $nric_extension = $nric_file->getClientOriginalExtension();
        }

        $image_principal_base64 = "";
        $image_principal_extension = "";
        $image_principal_file = $request->file('japanese_association_membership_image_principal');
        if ($image_principal_file) {
            $image_principal_path = $image_principal_file->path();
            $image_principal_data = file_get_contents($image_principal_path);
            $image_principal_base64 = base64_encode($image_principal_data);
            $image_principal_extension = $image_principal_file->getClientOriginalExtension();
        }

        $image_supplimental_base64 = "";
        $image_supplimental_extension = "";
        $image_supplimental_file = $request->file('japanese_association_membership_image_supplimental');
        if ($image_supplimental_file) {
            $image_supplimental_path = $image_supplimental_file->path();
            $image_supplimental_data = file_get_contents($image_supplimental_path);
            $image_supplimental_base64 = base64_encode($image_supplimental_data);
            $image_supplimental_extension = $image_supplimental_file->getClientOriginalExtension();
        }
        

        $passport_father_base64 = "";
        $passport_father_extension = "";
        $passport_father_file = $request->file('passport_father_photo');
        if ($passport_father_file) {
            $passport_father_path = $passport_father_file->path();
            $passport_father_data = file_get_contents($passport_father_path);
            $passport_father_base64 = base64_encode($passport_father_data);
            $passport_father_extension = $passport_father_file->getClientOriginalExtension();
        }

        $passport_mother_base64 = "";
        $passport_mother_extension = "";
        $passport_mother_file = $request->file('passport_mother_photo');
        if ($passport_mother_file) {
            $passport_mother_path = $passport_mother_file->path();
            $passport_mother_data = file_get_contents($passport_mother_path);
            $passport_mother_base64 = base64_encode($passport_mother_data);
            $passport_mother_extension = $passport_mother_file->getClientOriginalExtension();
        }

        $visa_father_base64 = "";
        $visa_father_extension = "";
        $visa_father_file = $request->file('visa_father_photo');
        if ($visa_father_file) {
            $visa_father_path = $visa_father_file->path();
            $visa_father_data = file_get_contents($visa_father_path);
            $visa_father_base64 = base64_encode($visa_father_data);
            $visa_father_extension = $visa_father_file->getClientOriginalExtension();
        }

        $visa_mother_base64 = "";
        $visa_mother_extension = "";
        $visa_mother_file = $request->file('visa_mother_photo');
        if ($visa_mother_file) {
            $visa_mother_path = $visa_mother_file->path();
            $visa_mother_data = file_get_contents($visa_mother_path);
            $visa_mother_base64 = base64_encode($visa_mother_data);
            $visa_mother_extension = $visa_mother_file->getClientOriginalExtension();
        }
            $data = [
                'id' => $request->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'first_name_english' => $request->first_name_english,
                'last_name_english' => $request->last_name_english,
                'first_name_furigana' => $request->first_name_furigana,
                'last_name_furigana' => $request->last_name_furigana,
                'first_name_common' => $request->first_name_common,
                'last_name_common' => $request->last_name_common,
                'race' => $request->race,
                'religion' => $request->religion,
                'blood_group' => $request->blood_group,
                'nationality' => $request->nationality,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'country' => $request->country,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'academic_grade' => $request->academic_grade,
                'academic_year' => $request->academic_year,
                'grade' => $request->grade,
                'school_year' => $request->school_year,
                'school_last_attended' => $request->school_last_attended,
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
                // 'visa_number' => $request->visa_number,
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

                
                "middle_name" => $request->middle_name,
                "middle_name_english" => $request->middle_name_english,
                "middle_name_furigana" => $request->middle_name_furigana,
                "dual_nationality" => $request->dual_nationality,
                "school_enrollment_status" => $request->school_enrollment_status,
                "school_enrollment_status_tendency" => $request->school_enrollment_status_tendency,
                "mother_middle_name" => $request->mother_middle_name,
                "mother_last_name_furigana" => $request->mother_last_name_furigana,
                "mother_middle_name_furigana" => $request->mother_middle_name_furigana,
                "mother_first_name_furigana" => $request->mother_first_name_furigana,
                "mother_last_name_english" => $request->mother_last_name_english,
                "mother_middle_name_english" => $request->mother_middle_name_english,
                "mother_first_name_english" => $request->mother_first_name_english,
                "mother_nationality" => $request->mother_nationality,
                "father_middle_name" => $request->father_middle_name,
                "father_last_name_furigana" => $request->father_last_name_furigana,
                "father_middle_name_furigana" => $request->father_middle_name_furigana,
                "father_first_name_furigana" => $request->father_first_name_furigana,
                "father_last_name_english" => $request->father_last_name_english,
                "father_middle_name_english" => $request->father_middle_name_english,
                "father_first_name_english" => $request->father_first_name_english,
                "father_nationality" => $request->father_nationality,
                "guardian_middle_name" => $request->guardian_middle_name,
                "guardian_last_name_furigana" => $request->guardian_last_name_furigana,
                "guardian_middle_name_furigana" => $request->guardian_middle_name_furigana,
                "guardian_first_name_furigana" => $request->guardian_first_name_furigana,
                "guardian_last_name_english" => $request->guardian_last_name_english,
                "guardian_middle_name_english" => $request->guardian_middle_name_english,
                "guardian_first_name_english" => $request->guardian_first_name_english,
                "guardian_company_name_japan" => $request->guardian_company_name_japan,
                "guardian_company_name_local" => $request->guardian_company_name_local,
                "guardian_company_phone_number" => $request->guardian_company_phone_number,
                "guardian_employment_status" => $request->guardian_employment_status,
                "expected_academic_year" => $request->expected_academic_year,
                "expected_grade" => $request->expected_grade,
                "expected_enroll_date" => $request->expected_enroll_date,
                "remarks" => $request->remarks,

                // "nric_photo" => $request->nric_photo,
                // "japanese_association_membership_image_principal" => $request->japanese_association_membership_image_principal,
                // "japanese_association_membership_image_supplimental" => $request->japanese_association_membership_image_supplimental,
                
                "address_unit_no" => $request->address_unit_no,
                "address_condominium" => $request->address_condominium,
                "address_street" => $request->address_street,
                "address_district" => $request->address_district,
                "visa_type" => $request->visa_type,
                "visa_type_others" => $request->visa_type_others,
                "japanese_association_membership_number_student" => $request->japanese_association_membership_number_student,
                "phase2_remarks" => $request->phase2_remarks,
                
                'nric_photo' => $nric_base64,
                'nric_file_extension' => $nric_extension,
                'image_principal_photo' => $image_principal_base64,
                'image_principal_file_extension' => $image_principal_extension,
                'image_supplimental_photo' => $image_supplimental_base64,
                'image_supplimental_file_extension' => $image_supplimental_extension,
                'visa_father_photo' => $visa_father_base64,
                'visa_father_file_extension' => $visa_father_extension,
                'visa_mother_photo' => $visa_mother_base64,
                'visa_mother_file_extension' => $visa_mother_extension,
                'passport_mother_photo' => $passport_mother_base64,
                'passport_mother_file_extension' => $passport_mother_extension,
                'passport_father_photo' => $passport_father_base64,
                'passport_father_file_extension' => $passport_father_extension,
                
                'visa_old_photo' => $request->visa_old_photo,
                'passport_old_photo' => $request->passport_old_photo,
                'image_principal_old_photo' => $request->japanese_association_membership_image_principal_old,
                'image_supplimental_old_photo' => $request->japanese_association_membership_image_supplimental_old,
                'nric_old_photo' => $request->nric_old_photo,
                'passport_father_old_photo' => $request->passport_father_old_photo,
                'passport_mother_old_photo' => $request->passport_mother_old_photo,
                'visa_father_old_photo' => $request->visa_father_old_photo,
                'visa_mother_old_photo' => $request->visa_mother_old_photo,
            ];
        // }
        // return $data;
        // dd($data);
        $response = Helper::PostMethod(config('constants.api.application_update'), $data);

        return $response;
    }
}
