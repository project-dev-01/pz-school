@extends('layouts.admin-layout')
@section('title','Admission')
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
<link href="{{ asset('css/custom/parent_responsive.css') }}" rel="stylesheet" type="text/css" />
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
                        <h4 class="page-title">Student Medical Record</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <form id="addadmission" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <input type="hidden" name="sudent_application_id" id="sudent_application_id">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the normal temperature">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hospital Name</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor's Name</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the doctor's name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance</label>
                                    <p>
                                        <input type="radio" name="yes_no" checked style="margin: 10px;">Yes</input>
                                        <input type="radio" name="yes_no" style="margin: 10px;">No</input>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the insurance company name">
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
                                    <tr style="height: 30px;">
                                        <td>Food Allergies</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Drug Allergies</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Other Allergies</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Asthma</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Atopic Dermatitis</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Allergic Rhinitis</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                    </tr>
                                    <tr style="height: 30px;">
                                        <td>Allergic Conjunctivitis</td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter the data"></td>
                                        <td>
                                            <<input type="text" class="form-control" placeholder="Enter the data">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"> <span style="margin-right:10px;">*</span>Please write about the allergen if any<br>
                                            <br>
                                            <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Anaphylactic Shock :</label>
                                                    <input type="radio" name="yes_no" checked style="margin: 10px;">Yes</input>
                                                    <input type="radio" name="yes_no" style="margin: 10px;">No</input>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Epinephrine autoinjector :</label>
                                                    <input type="radio" name="yes_no" checked style="margin: 10px;">Yes</input>
                                                    <input type="radio" name="yes_no" style="margin: 10px;">No</input>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <span style="margin-right:10px;">*</span>
                                                    <label>Other Medicines :</label>
                                                    <input type="radio" name="yes_no" checked style="margin: 10px;">Yes</input>
                                                    <input type="radio" name="yes_no" style="margin: 10px;">No</input>
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Epilepsy</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Measles</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kawasaki disease</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Febrile Convulsions</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heart Problem</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chicken Pox</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Scoliosis</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tuberculosis</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mumps</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kindly Problems</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Others</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rubella(German Measles)</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Diabetes</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dengue Fever</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operated Disease</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details>
                                    <span class=" text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Injury</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Illness</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Streptococcus pneumoniae</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Triple Antigen</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hib</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quadruple Antigen</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Covid 19</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>BCG</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rabies Vaccine</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Measles/Rubella(MR)</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the hospital Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tetanus</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chicken Pox</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mumps</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Advised by doctors against vaccination</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Frequent headaches.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dyspepsia & stomachache and cliarrhea easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Constipates easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vomits easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faints easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dizziness easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nettle rash easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prone to car sickness.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has had otitis media before.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bleeds from the nose easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nasal congestion and sevene running nose easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Throat is swollen easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Eye irritation & redness easily.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Use glasses or lenses.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Wrong Colour.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
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
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bleed from gum.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pain or sound in jaw joint.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Has been Orthodontics.</label>
                                    <input type="text" id="total_leave" name="total_leave" class="form-control" placeholder="Enter the details">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card-body">

                        <div class="form-group">
                            <label for="message">Any medicine to take daily?<br>(No/Yes) (Name of medicine:)</label>
                            <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
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
                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Remarks:</label>
                                    <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
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
<!-- Init js-->
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<script>
    var input = document.querySelector("#txt_mobile_no");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "my",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    $(".country").countrySelect({
        defaultCountry: "my",
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
    });
</script>
<script>
    $(function() {
        $(".alloptions").maxlength({
            alwaysShow: !0,
            separator: "/",
            preText: " ",
            postText: " chars available.",
            validate: !0,
            //fontSize:"20%",
            warningClass: "badge badge-success badge-custom",
            limitReachedClass: "badge badge-danger badge-custom",
        })

    });
</script>
<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var studentList = "{{ config('constants.api.application_list') }}";
    var studentDetails = "{{ config('constants.api.application_details') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.student.index') }}";
    var select_vehicle_number = "{{ __('messages.select_vehicle_number') }}";
    var select_room_name = "{{ __('messages.select_room_name') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/admission.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
        }
    });
</script>
@endsection