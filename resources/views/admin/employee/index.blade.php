@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.add_employee') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
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
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2147)">
                                <path d="M6.34223 7.4312C5.7425 7.43071 5.15636 7.21811 4.65793 6.8203C4.15949 6.4225 3.77115 5.85735 3.54202 5.19631C3.3129 4.53528 3.25328 3.80805 3.37069 3.1066C3.4881 2.40515 3.77727 1.76097 4.20165 1.25553C4.62602 0.750092 5.16654 0.406094 5.75483 0.267034C6.34313 0.127973 6.95278 0.200097 7.5067 0.474287C8.06063 0.748476 8.53395 1.21241 8.8668 1.80743C9.19965 2.40245 9.3771 3.10183 9.37668 3.81713C9.37446 4.77569 9.0539 5.69417 8.4852 6.37151C7.91649 7.04885 7.14595 7.42988 6.34223 7.4312Z" fill="#3A4265" />
                                <path d="M10.0812 12.184H2.5592V12.0737C2.5592 11.5395 2.5592 11.0077 2.5592 10.476C2.55223 10.1513 2.60512 9.82865 2.71412 9.53093C2.82313 9.23321 2.98559 8.96766 3.19006 8.75302C3.49863 8.41913 3.89476 8.22323 4.31089 8.19875C4.50226 8.18621 4.69572 8.19875 4.88708 8.19875H8.18226C8.42965 8.19278 8.67548 8.24659 8.90497 8.35693C9.13446 8.46728 9.34285 8.63187 9.51759 8.84081C9.69559 9.04377 9.83701 9.28791 9.93318 9.5583C10.0294 9.82869 10.0783 10.1196 10.0769 10.4133C10.0769 10.9877 10.0769 11.562 10.0769 12.1389C10.0854 12.1464 10.0833 12.1589 10.0812 12.184Z" fill="#3A4265" />
                                <path d="M23.7708 20.6612C23.7708 20.7858 23.7294 20.9053 23.6558 20.9937C23.5821 21.0821 23.482 21.132 23.3776 21.1327H0.622457C0.568257 21.1374 0.513817 21.1288 0.462548 21.1073C0.411278 21.0858 0.364273 21.0519 0.32447 21.0078C0.284667 20.9636 0.252921 20.9102 0.231212 20.8508C0.209503 20.7914 0.198303 20.7272 0.198303 20.6624C0.198303 20.5976 0.209503 20.5335 0.231212 20.4741C0.252921 20.4147 0.284667 20.3612 0.32447 20.3171C0.364273 20.273 0.411278 20.2391 0.462548 20.2176C0.513817 20.1961 0.568257 20.1874 0.622457 20.1922H23.3776C23.4818 20.1922 23.5819 20.2416 23.6556 20.3295C23.7294 20.4175 23.7708 20.5368 23.7708 20.6612Z" fill="#3A4265" />
                                <path d="M23.9832 14.0475L23.2829 19.5276C23.2829 19.5426 23.2829 19.5576 23.2724 19.5802H0.736022C0.687656 19.2065 0.641397 18.8404 0.595134 18.4717L0.147222 14.983C0.103062 14.6369 0.0546973 14.2883 0.0168457 13.9396C0.000234573 13.7784 0.0210506 13.6147 0.0770412 13.4666C0.133032 13.3184 0.222051 13.1914 0.33438 13.0995C0.521583 12.9284 0.752638 12.8397 0.988369 12.8486H23.0264C23.2118 12.8363 23.3962 12.8885 23.5571 12.9989C23.718 13.1094 23.8486 13.2733 23.9327 13.4706C24.0029 13.6509 24.0207 13.8539 23.9832 14.0475Z" fill="#3A4265" />
                                <path d="M17.6956 7.4312C17.0959 7.43071 16.5097 7.21811 16.0113 6.8203C15.5129 6.4225 15.1246 5.85735 14.8954 5.19631C14.6663 4.53528 14.6067 3.80805 14.7241 3.1066C14.8415 2.40515 15.1307 1.76097 15.555 1.25553C15.9794 0.750092 16.5199 0.406094 17.1082 0.267034C17.6965 0.127973 18.3062 0.200097 18.8601 0.474287C19.414 0.748476 19.8873 1.21241 20.2202 1.80743C20.553 2.40245 20.7305 3.10183 20.7301 3.81713C20.7284 4.7759 20.408 5.69475 19.8392 6.37224C19.2704 7.04972 18.4995 7.43054 17.6956 7.4312Z" fill="#3A4265" />
                                <path d="M21.4345 12.184H13.9125V12.0737C13.9125 11.5403 13.9125 11.0077 13.9125 10.476C13.9059 10.1513 13.9589 9.8288 14.0679 9.53114C14.1769 9.23347 14.3392 8.96788 14.5434 8.75302C14.852 8.41913 15.2481 8.22323 15.6642 8.19875C15.8577 8.18621 16.0491 8.19875 16.2425 8.19875H19.5356C19.7819 8.19577 20.0262 8.25071 20.2546 8.36042C20.483 8.47014 20.691 8.63248 20.8668 8.83816C21.0426 9.04384 21.1826 9.28882 21.279 9.5591C21.3753 9.82939 21.426 10.1197 21.4282 10.4133C21.4282 10.9877 21.4282 11.562 21.4282 12.1389C21.4387 12.1464 21.4366 12.1589 21.4345 12.184Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2147">
                                    <rect width="24" height="20.9321" fill="white" transform="translate(0 0.200623)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.employee') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.add_employee') }}</a></li>
                </ol>

            </div>       
       
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addEmployeeForm">
            <form id="addEmployeeForm" method="post" action="{{ route('admin.employee.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
								{{ __('messages.personal_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                  
                    <div class="card-body collapse show">
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
                        </div>
                        @if($form_field['name_furigana'] == 0)
                        <div class="row">
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
                        </div>
                        @endif
                        @if($form_field['name_english'] == 0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name_roma') }}</label>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
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
                                    <label for="mobile_no">{{ __('messages.mobile_no') }}</label>
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
                                            <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_the_file') }}</label>
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
                                            <input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_the_file') }}</label>
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
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
								{{ __('messages.employee_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                  
                    <div class="card-body collapse show">
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
                                    <select class="form-control " id="role_id" name="role_id" data-placeholder="{{ __('messages.choose_role') }}">
                                        <option value="">{{ __('messages.select_role') }}</option>
                                        @forelse($school_roles as $r)
                                        @if($r['portal_roleid']==1 && $r['roles']!=null)
                                        <option value="{{$r['id']}}">{{ $r['fullname'] }} ( {{ $r['roles'] }} )</option>
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
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salary_grade">{{ __('messages.salary_grade') }}</label>
                                    <input type="number" class="form-control" name="salary_grade" id="salaryGrade" placeholder="{{ __('messages.enter_salary_grade') }}">
                                </div>
                            </div>

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
                        </div>
                        <div class="row">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job_title">{{ __('messages.job_title') }}</label>
                                    <select class="form-control" name="job_title" id="job_title">
                                        <option value="">{{ __('messages.select_job_title') }}</option>
                                        @forelse($job_title_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="teacher_type">{{ __('messages.teacher_type') }}</label>
                                    <select class="form-control" name="teacher_type" id="teacher_type">
                                        <option value="">{{ __('messages.select_teacher_type') }}</option>
                                        <option value="nursing_teacher">{{ __('messages.nursing_teacher') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>{{ __('messages.department') }}</td>
                                        <td>{{ __('messages.start') }}</td>
                                        <td>{{ __('messages.end') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field_one">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="department[]">
                                                <option value="">{{ __('messages.select_department') }}</option>
                                                @forelse($emp_department as $r)
                                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="department_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="department_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" name="add_department" id="add_department" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation">{{ __('messages.designation') }}</label>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>{{ __('messages.designation') }}</td>
                                        <td>{{ __('messages.start') }}</td>
                                        <td>{{ __('messages.end') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field_two">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="designation[]">
                                                <option value="">{{ __('messages.select_designation') }}</option>
                                                @forelse($emp_designation as $r)
                                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="designation_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="designation_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" name="add_designation" id="add_designation" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_type">{{ __('messages.employee_type') }}</label>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>{{ __('messages.employee_type') }}</td>
                                        <td>{{ __('messages.start') }}</td>
                                        <td>{{ __('messages.end') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field_three">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="employee_type[]">
                                                <option value="">{{ __('messages.select_employee_type') }}</option>
                                                @forelse($employee_type_list as $r)
                                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="employee_type_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="employee_type_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" name="add_employee_type" id="add_employee_type" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.login_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
               
                    <div class="card-body collapse show">
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
                                        <input type="email" class="form-control" name="email" id="email" placeholder="xxxxx@gmail.com" autocomplete="off">
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
                                        <input type="password" class="form-control" name="password" id="password" placeholder="*********" autocomplete="off">
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
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.enable_two_factor_authentication') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton4" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                 
                    <div class="card-body collapse show">
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
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.social_links') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton5" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                 
                
                    <div class="card-body collapse show">
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
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.medical_history') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton6" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
              
                    <div class="card-body collapse show">
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
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.bank_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton7" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                    
                        <div class="card-body collapse show">
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="skip_bank_details" name="skip_bank_details">
                                    <label class="custom-control-label" for="skip_bank_details">{{ __('messages.skipped_bank_details') }}</label>
                                </div>
                            </div> -->
                            <div id="bank_details_form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bank_name">{{ __('messages.bank_name') }}</label>
                                            <input type="text" id="bank_name" class="form-control" name="bank_name" placeholder="{{ __('messages.enter_bank_name') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="holder_name">{{ __('messages.account_holder') }}</label>
                                            <input type="text" id="holder_name" class="form-control" name="holder_name" placeholder="{{ __('messages.enter_account_holder') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bank_branch">{{ __('messages.bank_branch') }}</label>
                                            <input type="text" id="bank_branch" class="form-control" name="bank_branch" placeholder="{{ __('messages.enter_bank_branch') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="bank_address">{{ __('messages.bank_address') }}</label>
                                            <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="{{ __('messages.enter_bank_address') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="ifsc_code">{{ __('messages.ifsc_code') }}</label>
                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="{{ __('messages.enter_ifsc_code') }}" aria-describedby="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">{{ __('messages.account_no') }}</label>
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
<script src="{{ asset('js/custom/collapse.js') }}"></script>
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

<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
    var employeeList = null;
    
    var emp_department_list = @json($emp_department);
    var emp_designation_list = @json($emp_designation);
    var employee_type_list = @json($employee_type_list);
</script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
<script src="{{ asset('js/custom/employee_add_more.js') }}"></script>
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
<script>
    $(document).ready(function() {
        setTimeout(function() {
            // Clear the values of email and password fields
            $("#email").val("");
            $("#password").val("");
        }, 2000);
    });
</script>
@endsection