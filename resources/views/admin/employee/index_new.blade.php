@extends('layouts.admin-layout')
@section('title','Add Employee')
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
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.add_employee') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addEmployeeForm">
            <form id="addEmployeeForm" method="post" action="{{ route('admin.employee.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.personal_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="file" name="photo" id="photo" class="dropify-im" data-max-file-size="2M" data-plugins="dropify" data-default-file="{{ config('constants.image_url').'/common-asset/images/700x500.png' }}" data-remove="Rewm" />
                                        <p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="first_name" placeholder="{{ __('messages.yamamoto') }}" id="firstName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">{{ __('messages.last_name') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="last_name" placeholder="{{ __('messages.yukio') }}" id="lastName">
                                    </div>
                                </div>
                            </div>
                        </div>@if($form_field['name_english'] == 0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name') }}({{ __('messages.english') }})<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="first_name_english" class="form-control alloptions" maxlength="50" id="first_name_english" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name') }}({{ __('messages.english') }})</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="last_name_english" class="form-control alloptions" maxlength="50" id="last_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($form_field['name_furigana'] == 0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name') }}({{ __('messages.furigana') }})<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="first_name_furigana" class="form-control alloptions" maxlength="50" id="first_name_furigana" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name') }}({{ __('messages.furigana') }})</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="last_name_furigana" class="form-control alloptions" maxlength="50" id="last_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="birthday">{{ __('messages.date_of_birth') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="birthday" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="empDOB">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">{{ __('messages.gender') }}</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">{{ __('messages.select_gender') }}</option>
                                        <option value="Male">{{ __('messages.male') }}</option>
                                        <option value="Female">{{ __('messages.female') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number_validation" name="mobile_no" id="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="present_address">{{ __('messages.address_1') }}</label>
                                    <input class="form-control" name="present_address" id="present_address" placeholder="{{ __('messages.enter_address_1') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="permanent_address">{{ __('messages.address_2') }}</label>
                                    <input class="form-control" name="permanent_address" id="permanent_address" placeholder="{{ __('messages.enter_address_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ __('messages.city') }}</label>
                                    <input type="text" class="form-control" name="city" id="City" placeholder="{{ __('messages.enter_city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">{{ __('messages.zip_postal_code') }}</label>
                                    <input type="text" class="form-control" name="post_code" id="postCode" placeholder="{{ __('messages.enter') }} {{ __('messages.zip_postal_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ __('messages.state_province') }}</label>
                                    <input type="text" class="form-control" name="state" id="State" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">{{ __('messages.country') }}</label>
                                    <input type="text" class="form-control country" placeholder="{{ __('messages.country') }}" name="country" id="Country">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="short_name">{{ __('messages.short_name') }}</label>
                                    <input type="text" class="form-control" name="short_name" placeholder="{{ __('messages.ali') }}" id="shortName">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment_status">{{ __('messages.employment_status') }}</label>
                                    <select class="form-control" name="employment_status" id="employment_status">
                                        <option value="">{{ __('messages.select_employment_status') }}</option>
                                        <option value="Under_Probation">{{ __('messages.under_probation') }}</option>
                                        <option value="Employed">{{ __('messages.employed') }}</option>
                                        <option value="Transferred">{{ __('messages.transferred') }}</option>
                                        <option value="Resign">{{ __('messages.resign') }}</option>
                                        <option value="Retired">{{ __('messages.retired') }}</option>
                                    </select>
                                </div>
                            </div>
                            @if($form_field['race'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="race">{{ __('messages.race') }}</label>
                                    <select class="form-control" name="race" id="addRace">
                                        <option value="">{{ __('messages.select_race') }}</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}">{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if($form_field['religion'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="religion">{{ __('messages.religion') }}</label>
                                    <select class="form-control" name="religion" id="religion">
                                        <option value="">{{ __('messages.select_religion') }}</option>
                                        @forelse($religion as $r)
                                        <option value="{{$r['id']}}">{{$r['religions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if($form_field['nationality'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nationality">{{ __('messages.nationality') }}</label>
                                    <input type="text" maxlength="50" id="nationality" class="form-control country" placeholder="{{ __('messages.nationality') }}" name="nationality" data-parsley-trigger="change">
                                </div>
                            </div>
                            @endif
                            @if($form_field['nric'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">{{ __('messages.nric_number') }}</label>
                                    <input type="text" maxlength="16" class="form-control" name="nric_number" placeholder="999999-99-9999" id="nricNumber">
                                </div>
                            </div>
                            @endif
                            @if($form_field['passport'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                    <input type="text" maxlength="20" class="form-control" placeholder="{{ __('messages.enter_passport_number') }}" name="passport" id="Passport">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="text">{{ __('messages.passport_expiry_date') }}<span class="text-danger"></span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport_photo">{{ __('messages.passport_photo') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg" >
                                            <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                        </div>
                                    </div>
                                    <span id="passport_photo_name"></span>
                                </div>
                            </div>
                            @endif
                            @if($form_field['visa'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                    <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="text">{{ __('messages.visa_expiry_date') }}<span class="text-danger"></span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_photo">{{ __('messages.visa_photo') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg" >
                                            <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                        </div>
                                    </div>
                                    <span id="visa_photo_name"></span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.employee_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_id">{{ __('messages.role') }}<span class="text-danger">*</span></label>
                                <!--<select class="form-control select2-multiple" data-toggle="select2" id="role_id" name="role_id" multiple="multiple" data-placeholder="{{ __('messages.choose_role') }}">
                                        @forelse($roles as $r)
                                        <option value="{{$r['id']}}">{{ __('messages.' . strtolower($r['role_name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>-->    
                                    <select class="form-control "  id="role_id" name="role_id" data-placeholder="{{ __('messages.choose_role') }}">
                                        <option value="">{{ __('messages.select_role') }}</option>
                                        @forelse($school_roles as $r)
                                        @if($r['portal_roleid']==3)
                                        <option value="{{$r['id']}}">{{ $r['fullname'] }}</option>
                                        @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="joining_date">{{ __('messages.joining_date') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="joining_date" id="joiningDate" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation_id">{{ __('messages.designation') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDesignation" name="designation_id" multiple="multiple" data-placeholder="{{ __('messages.choose_designation') }}">
                                        <option value="">{{ __('messages.choose_designation') }}</option>
                                        @forelse($emp_designation as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">{{ __('messages.department') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="empDepartment" name="department_id" multiple="multiple" data-placeholder="{{ __('messages.choose_department') }}">
                                        <option value="">{{ __('messages.choose_department') }}</option>
                                        @forelse($emp_department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_position">{{ __('messages.staff_position') }}</label>
                                    <select class="form-control" id="staffPosition" name="staff_position">
                                        <option value="">{{ __('messages.select_staff_position') }}</option>
                                        @forelse($staff_positions as $r)
                                        <option value="{{$r['id']}}">{{$r['staff_positions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary_grade">{{ __('messages.salary_grade') }}</label>
                                    <input type="text" class="form-control" name="salary_grade" id="salaryGrade" placeholder="{{ __('messages.enter_salary_grade') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_category">{{ __('messages.staff_category') }}</label>
                                    <select class="form-control" id="staffCategory" name="staff_category">
                                        <option value="">{{ __('messages.select_category') }}</option>
                                        @forelse($staff_categories as $r)
                                        <option value="{{$r['id']}}">{{$r['staff_categories_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualifications">{{ __('messages.staff_qualification') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" id="staffQualification" name="staff_qualification_id" multiple="multiple" data-placeholder="{{ __('messages.choose_staff_qualification') }}">
                                        <option value="">{{ __('messages.choose_staff_qualification') }}</option>
                                        @forelse($qualifications as $r)
                                        <option value="{{$r['id']}}">{{$r['qualification_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stream_type">{{ __('messages.stream_type') }}</label>
                                    <select class="form-control" id="streamType" name="stream_type">
                                        <option value="">{{ __('messages.select_stream_type') }}</option>
                                        @forelse($stream_types as $r)
                                        <option value="{{$r['id']}}">{{$r['stream_types_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.login_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-envelope-open"></span>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="xxxxx@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="*********">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="confirm_password">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="*********">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label class="switch">{{ __('messages.authentication') }}

                                        <input id="status" name="status" type="checkbox">
                                        <span>
                                            <em></em>
                                            <strong></strong>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.enable_two_factor_authentication') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title">{{ __('messages.turn_on_turn_off') }}</h4>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="google2fa_secret_enable" id="google2fa_secret_enable">
                                    <label class="custom-control-label" for="google2fa_secret_enable">{{ __('messages.enable_two_factor_authentication') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.social_links') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="facebook_url">{{ __('messages.facebook') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-facebook-f"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="twitter_url">{{ __('messages.twitter') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-twitter"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="linkedin_url">{{ __('messages.linkedin') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-linkedin-in"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="{{ __('messages.enter_linkedIn_url') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.medical_history') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="skip_medical_history" name="skip_medical_history">
                                <label class="custom-control-label" for="skip_medical_history">{{ __('messages.skipped_medical_history') }}</label>
                            </div>
                        </div>
                        <div id="medical_history_form">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="height">{{ __('messages.height') }}</label>
                                        <input type="text" id="height" class="form-control" name="height" placeholder="{{ __('messages.enter_height') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weight">{{ __('messages.weight') }}</label>
                                        <input type="text" id="weight" class="form-control" name="weight" placeholder="{{ __('messages.enter_weight') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="allergy">{{ __('messages.allergy') }}</label>
                                        <input type="text" id="allergy" class="form-control" name="allergy" placeholder="{{ __('messages.enter_allergy') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="blood_group">{{ __('messages.blood_group') }}</label>
                                        <select class="form-control" name="blood_group" id="blood_group">
                                            <option value="">{{ __('messages.select_blood_group') }}</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.bank_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="skip_bank_details" name="skip_bank_details">
                                <label class="custom-control-label" for="skip_bank_details">{{ __('messages.skipped_bank_details') }}</label>
                            </div>
                        </div>
                        <div id="bank_details_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_name">{{ __('messages.bank_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_name" class="form-control" name="bank_name" placeholder="{{ __('messages.enter_bank_name') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="holder_name">{{ __('messages.account_holder') }}<span class="text-danger">*</span></label>
                                        <input type="text" id="holder_name" class="form-control" name="holder_name" placeholder="{{ __('messages.enter_account_holder') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_branch">{{ __('messages.bank_branch') }}<span class="text-danger">*</span></label>
                                        <input type="text" id="bank_branch" class="form-control" name="bank_branch" placeholder="{{ __('messages.enter_bank_branch') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="bank_address">{{ __('messages.bank_address') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="{{ __('messages.enter_bank_address') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="ifsc_code">{{ __('messages.ifsc_code') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="{{ __('messages.enter_ifsc_code') }}" aria-describedby="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">{{ __('messages.account_no') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="account_no" name="account_no" placeholder="{{ __('messages.enter_account_no') }}" aria-describedby="inputGroupPrepend">
                                    </div>
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
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </form>
        </div> <!-- end col -->
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
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>

<script>
    var input = document.querySelector("#mobile_no");
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

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>

<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
    var employeeList = null;
</script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
        }
    });
    $(function() {
        // nric validation start
        // var $form_2 = $('#addEmployeeForm');
        // $form_2.validate({
        //     debug: true
        // });

        // $('#nricNumber').rules("add", {
        //     required: true
        // });

        $('#nricNumber').mask("000000-00-0000", {
            reverse: true
        });
        // nric validation end
    });
</script>
@endsection