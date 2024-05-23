@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_medical_record') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('country/css/countrySelect.css') }}">
<style>
    .switch {
        height: 24px;
        display: block;
        position: relative;
        cursor: pointer;
    }

    .switch input {
        display: none;
    }

    .switch input+span {
        padding-left: 50px;
        min-height: 24px;
        line-height: 24px;
        display: block;
        color: #99a3ba;
        position: relative;
        vertical-align: middle;
        white-space: nowrap;
        transition: color 0.3s ease;
    }

    .switch input+span:before,
    .switch input+span:after {
        content: '';
        display: block;
        position: absolute;
        border-radius: 12px;
    }

    .switch input+span:before {
        top: 0;
        left: 0;
        width: 42px;
        height: 24px;
        background: #e4ecfa;
        transition: all 0.3s ease;
    }

    .switch input+span:after {
        width: 18px;
        height: 18px;
        background: #fff;
        top: 3px;
        left: 3px;
        box-shadow: 0 1px 3px rgba(18, 22, 33, .1);
        transition: all 0.45s ease;
    }

    .switch input+span em {
        width: 8px;
        height: 7px;
        background: #99a3ba;
        position: absolute;
        left: 8px;
        bottom: 7px;
        border-radius: 2px;
        display: block;
        z-index: 1;
        transition: all 0.45s ease;
    }

    .switch input+span em:before {
        content: '';
        width: 2px;
        height: 2px;
        border-radius: 1px;
        background: #fff;
        position: absolute;
        display: block;
        left: 50%;
        top: 50%;
        margin: -1px 0 0 -1px;
    }

    .switch input+span em:after {
        content: '';
        display: block;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border: 1px solid #99a3ba;
        border-bottom: 0;
        width: 6px;
        height: 4px;
        left: 1px;
        bottom: 6px;
        position: absolute;
        z-index: 1;
        transform-origin: 0 100%;
        transition: all 0.45s ease;
        transform: rotate(-35deg) translate(0, 1px);
    }

    .switch input+span strong {
        font-weight: normal;
        position: relative;
        display: block;
        top: 1px;
    }

    .switch input+span strong:before,
    .switch input+span strong:after {
        font-size: 14px;
        font-weight: 500;
        display: block;
        font-family: 'Mukta Malar', Arial;
        -webkit-backface-visibility: hidden;
    }

    .switch input+span strong:before {
        transition: all 0.3s ease 0.2s;
    }

    .switch input+span strong:after {
        opacity: 0;
        visibility: hidden;
        position: absolute;
        left: 0;
        top: 0;
        color: #007bff;
        transition: all 0.3s ease;
        transform: translate(2px, 0);
    }

    .switch input:checked+span:before {
        background: rgba(0, 123, 255, .35);
    }

    .switch input:checked+span:after {
        background: #fff;
        transform: translate(18px, 0);
    }

    .switch input:checked+span em {
        transform: translate(18px, 0);
        background: #007bff;
    }

    .switch input:checked+span em:after {
        border-color: #007bff;
        transform: rotate(0deg) translate(0, 0);
    }

    .switch input:checked+span strong:before {
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        transform: translate(-2px, 0);
    }

    .switch input:checked+span strong:after {
        opacity: 1;
        visibility: visible;
        transform: translate(0, 0);
        transition: all 0.3s ease 0.2s;
    }

    html {
        -webkit-font-smoothing: antialiased;
    }

    * {
        box-sizing: border-box;
    }

    *:before,
    *:after {
        box-sizing: border-box;
    }

    .switch {
        display: table;
        margin: 12px auto;
        min-width: 118px;
    }

    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
    }

    .dribbble img {
        display: block;
        height: 28px;
    }

    .iti {
        display: block;
    }

    .country-select {
        display: block;
    }

    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
    #loader {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 999; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: hidden; /* Disable scrolling */
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
}

#loader .spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@if(Session::get('locale')=="en")
<style>
    .switch input+span strong:before {
        content: 'Unlock';
    }

    .switch input+span strong:after {
        content: 'Lock';
    }
</style>
@endif
@if(Session::get('locale')=="japanese")
<style>
    .switch input+span strong:before {
        content: 'アンロック';
    }

    .switch input+span strong:after {
        content: 'ロック';
    }
</style>
@endif
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12 addadmission">

            <div class="row">
                <div class="col-md-6">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ __('messages.student_medical_record') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <form id="addstudentmedical" method="post" action="{{ route('parent.medical.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="student_id" id="student_id" value="{{ $student_id }}">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">1. Basic Details
                                <h4>
                        </li>
                    </ul>
                 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Normal Temperature</label>
                                    <input type="text" value="{{ isset($studentmedical['normal_temperature']) ? $studentmedical['normal_temperature'] : '' }}" id="normal_temp" name="normal_temp" class="form-control" placeholder="Enter the normal temperature">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hospital Name</label>
                                    <input type="text" id="hospital_name" value="{{ isset($studentmedical['hospital_name']) ? $studentmedical['hospital_name'] : '' }}" name="hospital_name" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor's Name</label>
                                    <input type="text" id="doctor_name"  value="{{ isset($studentmedical['doctor_name']) ? $studentmedical['doctor_name'] : '' }}" name="doctor_name" class="form-control" placeholder="Enter the doctor's name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance</label>
                                    <p>
                                        <input type="radio" name="insurance" value="yes" style="margin: 10px;"
                                            {{ !isset($studentmedical['insurance_yes_no']) || $studentmedical['insurance_yes_no'] == 'yes' ? 'checked' : '' }}>Yes</input>
                                        <input type="radio" name="insurance" value="no" style="margin: 10px;"
                                            {{ isset($studentmedical['insurance_yes_no']) && $studentmedical['insurance_yes_no'] == 'no' ? 'checked' : '' }}>No</input>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" id="company_name"  value="{{ isset($studentmedical['company_name']) ? $studentmedical['company_name'] : '' }}" name="company_name" class="form-control" placeholder="Enter the insurance company name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- 2 -->
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">2. Place "O", if any of the condition are present.
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-bordered mb-0">
                                <thead>
                                    <tr style="height: 30px;text-align:center;">
                                        <th rowspan="2">About allergies</th>
                                        <th rowspan="2">Age of onset</th>
                                        <th colspan="3"></th>
                                    </tr>
                                    <tr style="height: 30px;text-align:center;">
                                        <th rowspan="1">Undern Treatment</th>
                                        <th rowspan="1">Follow up</th>
                                        <th rowspan="1">(age)
                                            Treated ( )
                                        </th>
                                    </tr>
                                    <tr>

                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($allergies_name as $index => $allergies)
                                    <tr style="height: 30px;">
                                        <td>{{$allergies['name']}}</td>
                                        <input type="hidden" name="allergies[{{$index}}][name]" value="$allergies['name']">
                                       <td> <input type="text" class="form-control" name="allergies[{{$index}}][age_onset]" placeholder="Enter the age of onset" value="{{$allergies_details[$allergies['id']]['age_onset']}}"></td>
                                       <td> <input type="text" class="form-control" name="allergies[{{$index}}][treatment]" placeholder="Enter the treatment"  value="{{$allergies_details[$allergies['id']]['under_treatment']}}"></td>
                                       <td><input type="text" class="form-control" name="allergies[{{$index}}][follow_up]" placeholder="Enter the follow up"  value="{{$allergies_details[$allergies['id']]['follow_up']}}"></td>
                                       <td> <input type="text" class="form-control" name="allergies[{{$index}}][treated]" placeholder="Enter the treated status"  value="{{$allergies_details[$allergies['id']]['age_treat']}}"></td>
                                    </tr>
                                @endforeach
                                    

                                    <tr>
                                        <td colspan="5"> <span style="margin-right:10px;">*</span>Please write about the allergen if any<br>
                                            <br>
                                            <textarea maxlength="255" id="remark_allergen" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="remark_allergen" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            {{ isset($studentmedical['allergen_if_any']) ? $studentmedical['allergen_if_any'] : '' }}
                                        </textarea>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Anaphylactic Shock :</label>
                                                    <input type="radio" name="anaphylactic" value="yes" checked style="margin: 10px;"
                                                    {{ !isset($studentmedical['anaphylactic_shock']) || $studentmedical['anaphylactic_shock'] == 'yes' ? 'checked' : '' }}>Yes</input>
                                                    <input type="radio" name="anaphylactic" value="no" style="margin: 10px;"
                                                    {{ isset($studentmedical['anaphylactic_shock']) && $studentmedical['anaphylactic_shock'] == 'no' ? 'checked' : '' }}>No</input>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Epinephrine autoinjector :</label>
                                                    <input type="radio" name="epinephrine" value="yes"  checked style="margin: 10px;"
                                                    {{ !isset($studentmedical['epinephrine_autoinjector']) || $studentmedical['epinephrine_autoinjector'] == 'yes' ? 'checked' : '' }}>Yes</input>
                                                    <input type="radio" name="epinephrine" value="no"  style="margin: 10px;" 
                                                    {{ !isset($studentmedical['epinephrine_autoinjector']) || $studentmedical['epinephrine_autoinjector'] == 'yes' ? 'checked' : '' }}>No</input>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Other Medicines :</label>
                                                    <input type="radio" name="other_medicines" value="yes" checked style="margin: 10px;" 
                                                    {{ !isset($studentmedical['other_medicines']) || $studentmedical['other_medicines'] == 'yes' ? 'checked' : '' }}>Yes</input>
                                                    <input type="radio" name="other_medicines" value="no" style="margin: 10px;"
                                                    {{ !isset($studentmedical['other_medicines']) || $studentmedical['other_medicines'] == 'yes' ? 'checked' : '' }}>No</input>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <!-- 3 -->
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">3. Medical Histroy
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heart Problem</label>
                                    <input type="text" value="{{ isset($studentmedical['heart_problem']) ? $studentmedical['heart_problem'] : '' }}"  id="heart_problem" name="heart_problem" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Epilepsy</label>
                                    <input type="text" value="{{ isset($studentmedical['epilepsy']) ? $studentmedical['epilepsy'] : '' }}"  id="epilepsy" name="epilepsy" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Measles</label>
                                    <input type="text" value="{{ isset($studentmedical['measles']) ? $studentmedical['measles'] : '' }}"  id="measles" name="measles" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kawasaki disease</label>
                                    <input type="text" value="{{ isset($studentmedical['kawasaki_disease']) ? $studentmedical['kawasaki_disease'] : '' }}"  id="kawasaki_disease" name="kawasaki_disease" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Febrile Convulsions</label>
                                    <input type="text" value="{{ isset($studentmedical['febrile_convulsions']) ? $studentmedical['febrile_convulsions'] : '' }}"  id="febrile_convulsion" name="febrile_convulsion" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heart Problem</label>
                                    <input type="text" value="{{ isset($studentmedical['heart_problem']) ? $studentmedical['heart_problem'] : '' }}"  id="heart_problem" name="heart_problem" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chicken Pox</label>
                                    <input type="text" value="{{ isset($studentmedical['chicken_pox']) ? $studentmedical['chicken_pox'] : '' }}"  id="chicken_pox" name="chicken_pox" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Scoliosis</label>
                                    <input type="text" value="{{ isset($studentmedical['scoliosis']) ? $studentmedical['scoliosis'] : '' }}"  id="scoliosis" name="scoliosis" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tuberculosis</label>
                                    <input type="text" value="{{ isset($studentmedical['tuberculosis']) ? $studentmedical['tuberculosis'] : '' }}"  id="tuberculosis" name="tuberculosis" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mumps</label>
                                    <input type="text" value="{{ isset($studentmedical['mumps']) ? $studentmedical['mumps'] : '' }}"  id="mumps" name="mumps" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kidney problems</label>
                                    <input type="text" value="{{ isset($studentmedical['kidny_problems']) ? $studentmedical['kidny_problems'] : '' }}"  id="kidney_problems" name="kidney_problems" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Others</label>
                                    <input type="text" value="{{ isset($studentmedical['others']) ? $studentmedical['others'] : '' }}"  id="others" name="others" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rubella(German Measles)</label>
                                    <input type="text" value="{{ isset($studentmedical['rubella']) ? $studentmedical['rubella'] : '' }}"  id="rubella" name="rubella" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Diabetes</label>
                                    <input type="text" value="{{ isset($studentmedical['diabetes']) ? $studentmedical['diabetes'] : '' }}"  id="diabetes" name="diabetes" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dengue Fever</label>
                                    <input type="text" value="{{ isset($studentmedical['dengue_fever']) ? $studentmedical['dengue_fever'] : '' }}"  id="dengue_fever" name="dengue_fever" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operated Disease</label>
                                    <input type="text" value="{{ isset($studentmedical['operated_disease']) ? $studentmedical['operated_disease'] : '' }}"  id="operated_disease" name="operated_disease" class="form-control" placeholder="Enter the details">
                                    <span class=" text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Injury</label>
                                    <input type="text" value="{{ isset($studentmedical['injury']) ? $studentmedical['injury'] : '' }}"  id="injury" name="injury" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Illness</label>
                                    <input type="text" value="{{ isset($studentmedical['illness']) ? $studentmedical['illness'] : '' }}"  id="illness" name="illness" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--4-->
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">4. Immunization History
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Japanese Encephalitis</label>
                                    <input type="text" value="{{ isset($studentmedical['japanese_encephalitis']) ? $studentmedical['japanese_encephalitis'] : '' }}" id="japanese_encephalitis" name="japanese_encephalitis" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Streptococcus pneumoniae</label>
                                    <input type="text" value="{{ isset($studentmedical['streptococcus_pneumoniae']) ? $studentmedical['streptococcus_pneumoniae'] : '' }}" id="streptococcus_pneumoniae" name="streptococcus_pneumoniae" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Triple Antigen</label>
                                    <input type="text" value="{{ isset($studentmedical['triple_antigen']) ? $studentmedical['triple_antigen'] : '' }}" id="triple_antigen" name="triple_antigen" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hib</label>
                                    <input type="text" value="{{ isset($studentmedical['hib']) ? $studentmedical['hib'] : '' }}" id="hib" name="hib" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quadruple Antigen</label>
                                    <input type="text" value="{{ isset($studentmedical['quadruple_antigen']) ? $studentmedical['quadruple_antigen'] : '' }}" id="quadruple_antigen" name="quadruple_antigen" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Covid 19</label>
                                    <input type="text" value="{{ isset($studentmedical['covid_19']) ? $studentmedical['covid_19'] : '' }}" id="covid" name="covid" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>BCG</label>
                                    <input type="text" value="{{ isset($studentmedical['bcg']) ? $studentmedical['bcg'] : '' }}" id="bcg" name="bcg" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rabies Vaccine</label>
                                    <input type="text" value="{{ isset($studentmedical['rabies_vaccine']) ? $studentmedical['rabies_vaccine'] : '' }}" id="rabies_vaccine" name="rabies_vaccine" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Measles/Rubella(MR)</label>
                                    <input type="text" value="{{ isset($studentmedical['measles_rubella']) ? $studentmedical['measles_rubella'] : '' }}" id="measles" name="measles" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tetanus</label>
                                    <input type="text" value="{{ isset($studentmedical['tetanus']) ? $studentmedical['tetanus'] : '' }}" id="tetanus" name="tetanus" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chicken Pox</label>
                                    <input type="text" value="{{ isset($studentmedical['chicken_pox_imm']) ? $studentmedical['chicken_pox_imm'] : '' }}" id="chicken_pox_imm" name="chicken_pox_imm" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mumps</label>
                                    <input type="text" value="{{ isset($studentmedical['mumps_imm']) ? $studentmedical['mumps_imm'] : '' }}" id="mumps_imm" name="mumps_imm" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Advised by doctors against vaccination</label>
                                    <input type="text" value="{{ isset($studentmedical['doctors_advised']) ? $studentmedical['doctors_advised'] : '' }}" id="advised_doctors" name="advised_doctors" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--5-->
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">5. Current Health Condition<h4>
                        </li>
                    </ul>
                    <div>
                        <h4 class="navv">Internal Medicine<h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Develops a fever easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['develops_fever_easily']) ? $studentmedical['develops_fever_easily'] : '' }}" id="develops_fever" name="develops_fever" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Frequent headaches.</label>
                                    <input type="text" value="{{ isset($studentmedical['frequent_headaches']) ? $studentmedical['frequent_headaches'] : '' }}" id="frequent_headaches" name="frequent_headaches" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dyspepsia & stomachache and cliarrhea easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['dyspepsia_stomachache_cliarrhea']) ? $studentmedical['dyspepsia_stomachache_cliarrhea'] : '' }}" id="dyspepsia" name="dyspepsia" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Constipates easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['constipates']) ? $studentmedical['constipates'] : '' }}" id="constipates" name="constipates" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vomits easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['vomits']) ? $studentmedical['vomits'] : '' }}" id="vomits" name="vomits" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faints easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['faints']) ? $studentmedical['faints'] : '' }}" id="faints" name="faints" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dizziness easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['dizziness']) ? $studentmedical['dizziness'] : '' }}" id="dizziness" name="dizziness" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nettle rash easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['nettle_rash']) ? $studentmedical['nettle_rash'] : '' }}" id="nettle_rash" name="nettle_rash" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prone to car sickness.</label>
                                    <input type="text" value="{{ isset($studentmedical['prone_to_car_sickness']) ? $studentmedical['prone_to_car_sickness'] : '' }}" id="prone_car_sickness" name="prone_car_sickness" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <h4 class="navv">ENT<h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has poor hearing.</label>
                                    <input type="text" value="{{ isset($studentmedical['has_poor_hearing']) ? $studentmedical['has_poor_hearing'] : '' }}" id="poor_hearing" name="poor_hearing" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has had otitis media before.</label>
                                    <input type="text" value="{{ isset($studentmedical['has_had_otitis_media_before']) ? $studentmedical['has_had_otitis_media_before'] : '' }}" id="otitis_media" name="otitis_media" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bleeds from the nose easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['bleeds_from_the_nose']) ? $studentmedical['bleeds_from_the_nose'] : '' }}" id="bleeds_nose" name="bleeds_nose" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nasal congestion and sevene running nose easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['nasal_congestion']) ? $studentmedical['nasal_congestion'] : '' }}" id="nasal_congestion_nose" name="nasal_congestion_nose" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Throat is swollen easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['throat_is_swollen']) ? $studentmedical['throat_is_swollen'] : '' }}" id="throat_swollen" name="throat_swollen" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div>
                        <h4 class="navv">Eye<h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Squinted eyes to view from a distance.</label>
                                    <input type="text" value="{{ isset($studentmedical['squinted_eyes']) ? $studentmedical['squinted_eyes'] : '' }}" id="squinted_eyes" name="squinted_eyes" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Eye irritation & redness easily.</label>
                                    <input type="text" value="{{ isset($studentmedical['eye_irritation_redness']) ? $studentmedical['eye_irritation_redness'] : '' }}" id="eye_irritation" name="eye_irritation" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Use glasses or lenses.</label>
                                    <input type="text" value="{{ isset($studentmedical['glasses_lenses']) ? $studentmedical['glasses_lenses'] : '' }}" id="glasses_lenses" name="glasses_lenses" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Wrong Colour.</label>
                                    <input type="text" value="{{ isset($studentmedical['wrong_colour']) ? $studentmedical['wrong_colour'] : '' }}" id="wrong_colour" name="wrong_colour" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div>
                        <h4 class="navv">Dent<h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has a sensistive tooth or toothache</label>
                                    <input type="text" value="{{ isset($studentmedical['tooth_toothache']) ? $studentmedical['tooth_toothache'] : '' }}" id="sensistive_tooth" name="sensistive_tooth" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bleed from gum.</label>
                                    <input type="text" value="{{ isset($studentmedical['bleed_gum']) ? $studentmedical['bleed_gum'] : '' }}" id="bleed_from_gum" name="bleed_from_gum" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pain or sound in jaw joint.</label>
                                    <input type="text" value="{{ isset($studentmedical['pain_sound_jaw_joint']) ? $studentmedical['pain_sound_jaw_joint'] : '' }}" id="pain_sound_jaw_joint" name="pain_sound_jaw_joint" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has been Orthodontics.</label>
                                    <input type="text" value="{{ isset($studentmedical['orthodontics']) ? $studentmedical['orthodontics'] : '' }}" id="orthodontics" name="orthodontics" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card-body">

                        <div class="form-group">
                            <label for="txtarea_prev_remarks">Any medicine to take daily?<br>(No/Yes) (Name of medicine:)</label>
                            <textarea maxlength="255" id="medicine_to_take_daily" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="medicine_to_take_daily" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            {{ isset($studentmedical['any_medicine_take']) ? $studentmedical['any_medicine_take'] : ''}} </textarea>
                        </div>


                    </div>





                </div>
                <!--6-->
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">6. Any Other medical concerns which require the attention of the medical practitioner
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" value="{{ isset($studentmedical['date']) ? $studentmedical['date'] : '' }}"  class="form-control" id="date" name="date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txtarea_prev_remarks">Remarks:</label>
                                    <textarea maxlength="255" id="remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    {{ isset($studentmedical['remarks']) ? $studentmedical['remarks'] : ''}}
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.save') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                        </div>


                    </div>



                </div>
        </div>











    </div> <!-- end col -->
    </form>
</div>
<!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>


<script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('libs/autonumeric/autoNumeric-min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-masks.init.js') }}"></script>
<script src="{{ asset('libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script>


<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var studentList = "{{ config('constants.api.application_list') }}";
    var studentDetails = "{{ config('constants.api.application_details') }}";
  
    
</script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/student_medical.js') }}"></script>

@endsection