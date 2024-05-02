@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_profile') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
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
    .country-select .country-list
    {
        width: 361px !important;
    }
    .ui-datepicker {
        width: 20.2em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 13.9em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 14.8em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 16em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 17.8em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 27.6em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 13.3em;
        }
    }

    .breadcrumb-item+.breadcrumb-item::before {
        font-family: "Material Design Icons";
        color: #3A4265;
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
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg fill="#3A4265" width="20" height="20" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 402.161 402.161" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <path d="M201.08,49.778c-38.794,0-70.355,31.561-70.355,70.355c0,18.828,7.425,40.193,19.862,57.151
                c14.067,19.181,32,29.745,50.493,29.745c18.494,0,36.426-10.563,50.494-29.745c12.437-16.958,19.862-38.323,19.862-57.151
                C271.436,81.339,239.874,49.778,201.08,49.778z M201.08,192.029c-13.396,0-27.391-8.607-38.397-23.616
                c-10.46-14.262-16.958-32.762-16.958-48.28c0-30.523,24.832-55.355,55.355-55.355s55.355,24.832,55.355,55.355
                C256.436,151.824,230.372,192.029,201.08,192.029z"></path>
                                    <path d="M201.08,0C109.387,0,34.788,74.598,34.788,166.292c0,91.693,74.598,166.292,166.292,166.292
                s166.292-74.598,166.292-166.292C367.372,74.598,292.773,0,201.08,0z M201.08,317.584c-30.099-0.001-58.171-8.839-81.763-24.052
                c0.82-22.969,11.218-44.503,28.824-59.454c6.996-5.941,17.212-6.59,25.422-1.615c8.868,5.374,18.127,8.099,27.52,8.099
                c9.391,0,18.647-2.724,27.511-8.095c8.201-4.97,18.39-4.345,25.353,1.555c17.619,14.93,28.076,36.526,28.895,59.512
                C259.25,308.746,231.178,317.584,201.08,317.584z M296.981,283.218c-3.239-23.483-15.011-45.111-33.337-60.64
                c-11.89-10.074-29.1-11.256-42.824-2.939c-12.974,7.861-26.506,7.86-39.483-0.004c-13.74-8.327-30.981-7.116-42.906,3.01
                c-18.31,15.549-30.035,37.115-33.265,60.563c-33.789-27.77-55.378-69.868-55.378-116.915C49.788,82.869,117.658,15,201.08,15
                c83.423,0,151.292,67.869,151.292,151.292C352.372,213.345,330.778,255.448,296.981,283.218z"></path>
                                    <path d="M302.806,352.372H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5
                C310.307,355.73,306.948,352.372,302.806,352.372z"></path>
                                    <path d="M302.806,387.161H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5
                C310.307,390.519,306.948,387.161,302.806,387.161z"></path>
                                </g>
                            </g>
                        </g>
                    </svg>

                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.profile') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.student_profile') }}</a></li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @if($id==0)
    <div class="row">
        <div class="col-xl-12">
            <div class="">
                <h4> No Student's Available here.</h4>
                </div>
        </div>
    </div>   
 
@endif
@if($id!=0)
    <div class="row">
        <div class="col-xl-12">
            <div class="">

                <div class="">
                    <form id="updateStudentProfile" method="post" action="{{ route('parent.student.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ isset($student['id']) ? $student['id'] : ''}}">


                        <div class="card">
                            <ul class="nav nav-tabs" style="display: inline-block;">
                                <li class="nav-item d-flex justify-content-between align-items-center">
                                    <!-- Button placed on the left side -->
                                    <h4 class="navv">{{ __('messages.student_profile') }}</h4>
                                    <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                        <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                    </button>
                                </li>
                            </ul>

                            <div class="card-body collapse show">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="lname">{{ __('messages.last_name') }} <span class="text-danger">*</span></label>

                                            <input type="text" name="lname" class="form-control" id="lname" value="{{ isset($student['last_name']) ? $student['last_name'] : ''}}" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mname">{{ __('messages.middle_name') }} </label>

                                            <input type="text" name="mname" class="form-control alloptions" maxlength="50" id="mname" value="{{ isset($student['middle_name']) ? $student['middle_name'] : ''}}" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>

                                            <input type="text" name="fname" class="form-control" value="{{ isset($student['first_name']) ? $student['first_name'] : ''}}" id="fname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>

                                </div>
                                @if($form_field['name_english'] == 0)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>

                                            <input type="text" name="last_name_english" class="form-control alloptions" maxlength="50" id="last_name_english" value="{{ isset($student['last_name_english']) ? $student['last_name_english'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="middle_name_english">{{ __('messages.middle_name_roma') }}</label>

                                            <input type="text" name="middle_name_english" class="form-control alloptions" maxlength="50" id="middle_name_english" value="{{ isset($student['middle_name_english']) ? $student['middle_name_english'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_english">{{ __('messages.first_name_roma') }}</label>

                                            <input type="text" name="first_name_english" class="form-control alloptions" maxlength="50" id="first_name_english" value="{{ isset($student['first_name_english']) ? $student['first_name_english'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>

                                </div>
                                @endif
                                @if($form_field['name_furigana'] == 0)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>

                                            <input type="text" name="last_name_furigana" class="form-control alloptions" maxlength="50" id="last_name_furigana" value="{{ isset($student['last_name_furigana']) ? $student['last_name_furigana'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>

                                            <input type="text" name="middle_name_furigana" class="form-control alloptions" maxlength="50" id="middle_name_furigana" value="{{ isset($student['middle_name_furigana']) ? $student['middle_name_furigana'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_furigana">{{ __('messages.first_name_furigana') }}</label>

                                            <input type="text" name="first_name_furigana" class="form-control alloptions" maxlength="50" id="first_name_furigana" value="{{ isset($student['first_name_furigana']) ? $student['first_name_furigana'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>

                                </div>
                                @endif

                                <div class="row">
                                    @if($form_field['name_common'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="last_name_common">{{ __('messages.last_name_common') }}</label>

                                            <input type="text" name="last_name_common" class="form-control alloptions" maxlength="50" id="last_name_common" value="{{ isset($student['last_name_common']) ? $student['last_name_common'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name_common">{{ __('messages.first_name_common') }}</label>

                                            <input type="text" name="first_name_common" class="form-control alloptions" maxlength="50" id="first_name_common" value="{{ isset($student['first_name_common']) ? $student['first_name_common'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                    @endif
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control number_validation" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" value="{{ isset($student['mobile_no']) ? $student['mobile_no'] : ''}}" data-parsley-trigger="change">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="dob">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span></label>

                                            <input type="text" name="dob" class="form-control" value="{{ isset($student['birthday']) ? $student['birthday'] : ''}}" id="dob" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                            <select id="gender" name="gender" class="form-control">
                                                <option value="">{{ __('messages.select_gender') }}</option>
                                                <option value="Male" {{ isset($student['gender']) ?  $student['gender'] == "Male" ? 'Selected' : '' : "" }}>{{ __('messages.male') }}</option>
                                                <option value="Female" {{ isset($student['gender']) ?  $student['gender'] == "Female" ? 'Selected' : '' : "" }}>{{ __('messages.female') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if($form_field['race'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_race">{{ __('messages.race') }}</label>
                                            <select class="form-control" name="txt_race" id="addRace">
                                                <option value="">{{ __('messages.select_race') }}</option>
                                                @forelse($races as $r)
                                                <option value="{{$r['id']}}" {{ isset($student['race']) ?  $student['race'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['races_name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['religion'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_religion">{{ __('messages.religion') }}</label>
                                            <select class="form-control" name="txt_religion" id="religion">
                                                <option value="">{{ __('messages.select_religion') }}</option>
                                                @forelse($religion as $r)
                                                <option value="{{$r['id']}}" {{ isset($student['religion']) ?  $student['religion'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['religions_name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['blood_group'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                            <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                <option value="">{{ __('messages.select_blood_group') }}</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "O+" ? 'Selected' : '' : "" }}>O+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "A+" ? 'Selected' : '' : "" }}>A+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "B+" ? 'Selected' : '' : "" }}>B+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "AB+" ? 'Selected' : '' : "" }}>AB+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "O-" ? 'Selected' : '' : "" }}>O-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "A-" ? 'Selected' : '' : "" }}>A-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "B-" ? 'Selected' : '' : "" }}>B-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "AB-" ? 'Selected' : '' : "" }}>AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_post_code">{{ __('messages.zip_postal_code') }}<span class="text-danger">*</span></label>
                                            <input type="" id="drp_post_code" class="form-control" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change" value="{{ isset($student['post_code']) ? $student['post_code'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_unit_no">{{ __('messages.address_unit_no') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="255" id="address_unit_no" value="{{ isset($student['address_unit_no']) ? $student['address_unit_no'] : ''}}" class="form-control alloptions" placeholder="{{ __('messages.enter_address_unit_no') }}" name="address_unit_no" data-parsley-trigger="change">
                                        </div>
                                    </div>

                                    <!-- <div class="row"> -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_condominium">{{ __('messages.address_condominium') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address_condominium" name="address_condominium" value="{{ isset($student['address_condominium']) ? $student['address_condominium'] : ''}}" placeholder="{{ __('messages.enter_address_condominium') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_street">{{ __('messages.address_street') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address_street" name="address_street" value="{{ isset($student['address_street']) ? $student['address_street'] : ''}}" placeholder="{{ __('messages.enter_address_street') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_district">{{ __('messages.address_district') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address_district" value="{{ isset($student['address_district']) ? $student['address_district'] : ''}}" name="address_district" placeholder="{{ __('messages.enter_address_district') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="drp_city" class="form-control" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change" value="{{ isset($student['city']) ? $student['city'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="drp_state" placeholder="{{ __('messages.state_province') }}" class="form-control" name="drp_state" data-parsley-trigger="change" value="{{ isset($student['state']) ? $student['state'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="drp_country" placeholder="{{ __('messages.country') }}" class="form-control country" name="drp_country" data-parsley-trigger="change" value="{{ isset($student['country']) ? $student['country'] : ''}}">
                                        </div>
                                    </div>
                                <!-- </div> -->
                                <!-- </div> -->
                                <!-- <div class="row"> -->

                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtarea_paddress">{{ __('messages.address_1') }}</label>
                                            <input type="" id="txtarea_paddress" class="form-control" placeholder="{{ __('messages.enter_address_1') }}" name="txtarea_paddress" data-parsley-trigger="change" value="{{ isset($student['current_address']) ? $student['current_address'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtarea_permanent_address">{{ __('messages.address_2') }}</label>
                                            <input type="" id="txtarea_permanent_address" class="form-control" placeholder="{{ __('messages.enter_address_2') }}" name="txtarea_permanent_address" data-parsley-trigger="change" value="{{ isset($student['permanent_address']) ? $student['permanent_address'] : ''}}">
                                        </div>
                                    </div> -->


                                    @if($form_field['nationality'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="50" id="nationality" class="form-control country" value="{{ isset($student['nationality']) ? $student['nationality'] : ''}}" placeholder="{{ __('messages.nationality') }}" name="nationality" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox" style="margin-top: 2.25rem;">
                                                <input type="checkbox" name="has_dual_nationality_checkbox" id="has_dual_nationality_checkbox" class="custom-control-input" {{ isset($student['dual_nationality']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="has_dual_nationality_checkbox">{{ __('messages.dual_nationality') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="dual_nationality_container" style="{{ isset($student['dual_nationality']) ? '' : 'display: none;' }}">
                                            <label for="dual_nationality">{{ __('messages.dual_nationality') }}</label>
                                            <input type="text" maxlength="50" id="dual_nationality" class="form-control country" placeholder="{{ __('messages.dual_nationality') }}" name="dual_nationality" value="{{ isset($student['dual_nationality']) ? $student['dual_nationality'] : ''}}" data-parsley-trigger="change">
                                        </div>
                                        <span id ="error_message"></span>

                                    </div>
                                    @endif
                                </div>
                                <div class="row">



                                </div>
                                <div class="row">

                                    @if($form_field['nric'] == 0)
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                            <input type="text" maxlength="20" id="txt_nric" class="form-control alloptions" value="{{ isset($student['nric']) ? $student['nric'] : ''}}" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">
                                        </div>
                                    </div> -->
                                    @endif
                                    @if($form_field['passport'] == 0)
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Passport">{{ __('messages.passport_number') }}</label>
                                            <input type="text" maxlength="20" class="form-control" name="txt_passport" placeholder="{{ __('messages.enter_passport_number') }}" value="{{ isset($student['passport']) ? $student['passport'] : ''}}">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="text">{{ __('messages.passport_expiry_date') }}<span class="text-danger"></span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="{{ isset($student['passport_expiry_date']) ? $student['passport_expiry_date'] : ''}}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($student['passport_photo']) ? $student['passport_photo'] : ''}}" />

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_photo">{{ __('messages.passport_photo') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_the_file') }}</label>
                                                </div>
                                            </div>
                                            @if(isset($student['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'] }}" target="_blank"> {{ __('messages.passport_photo') }} </a>
                                            @endif
                                            <span id="passport_photo_name"></span>
                                        </div>
                                    </div> -->
                                    @endif
                                    @if($form_field['visa'] == 0)
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                            <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" value="{{ isset($student['visa_number']) ? $student['visa_number'] : ''}}" data-parsley-trigger="change">
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
                                                <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend" value="{{ isset($student['visa_expiry_date']) ? $student['visa_expiry_date'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($student['visa_photo']) ? $student['visa_photo'] : ''}}" />

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_photo">{{ __('messages.visa_photo') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_the_file') }}</label>
                                                </div>
                                            </div>
                                            @if(isset($student['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                            @endif
                                            <span id="visa_photo_name"></span>
                                        </div>
                                    </div> -->
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <ul class="nav nav-tabs" style="display: inline-block;">
                                <li class="nav-item d-flex justify-content-between align-items-center">
                                    <!-- Button placed on the left side -->
                                    <h4 class="navv">{{ __('messages.personal_details') }}
                                        <h4>
                                            <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                                <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                            </button>
                                </li>
                            </ul>

                            <div class="card-body collapse show">
                                <div class="row">

                                    @if($form_field['passport'] == 0)
                                    <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($student['passport_photo']) ? $student['passport_photo'] : ''}}" />
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_photo">{{ __('messages.passport_image_japan') }}<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            <label for="passport_photo" class="error"></label>
                                            @if(isset($student['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'] }}" target="_blank"> {{ __('messages.passport_photo') }} </a>
                                            @endif
                                            <span id="passport_photo_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_passport">{{ __('messages.passport_number_japan') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="20" class="form-control alloptions" id="txt_passport" value="{{ isset($student['passport']) ? $student['passport'] : ''}}" placeholder="{{ __('messages.enter_passport_number') }}" name="txt_passport">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_expiry_date">{{ __('messages.passport_expiry_date_japan') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="{{ isset($student['passport_expiry_date']) ? $student['passport_expiry_date'] : ''}}" aria-describedby="inputGroupPrepend">
                                            </div>
                                            <label for="passport_expiry_date" class="error"></label>
                                        </div>
                                    </div>

                                    @endif
                                    @if($form_field['visa'] == 0)
                                    <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_number">{{ __('messages.visa_number') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($application['visa_number']) ? $application['visa_number'] : ''}}" name="visa_number" data-parsley-trigger="change">
                                                </div>
                                            </div> -->
                                    <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($student['visa_photo']) ? $student['visa_photo'] : ''}}" />
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_photo">{{ __('messages.visa_image__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="visa_photo" class="custom-file-input" value="" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            <label for="visa_photo" class="error"></label>
                                            @if(isset($student['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                            @endif
                                            <span id="visa_photo_name"></span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_type">{{ __('messages.visa_type__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                            <select id="visa_type" name="visa_type" class="form-control">
                                                <option value="">{{ __('messages.select_visa_type') }}</option>
                                                <option value="No Require (Malaysian)" {{ isset($student['visa_type']) ? $student['visa_type'] == "No Require (Malaysian)" ? 'selected' : '' : '' }}>{{ __('messages.no_require_malaysian') }}</option>
                                                <option value="Depedent Pass" {{ isset($student['visa_type']) ? $student['visa_type'] == "Depedent Pass" ? 'selected' : '' : '' }}>{{ __('messages.depedent_pass') }}</option>
                                                <option value="MM2H" {{ isset($student['visa_type']) ? $student['visa_type'] == "MM2H" ? 'selected' : '' : '' }}>{{ __('messages.mm2h') }}</option>
                                                <option value="Resident Pass" {{ isset($student['visa_type']) ? $student['visa_type'] == "Resident Pass" ? 'selected' : '' : '' }}>{{ __('messages.resident_pass') }}</option>
                                                <option value="Others" {{ isset($student['visa_type']) ? $student['visa_type'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @php

                                    $visa_type_others = "none";
                                    if (isset($student['visa_type']) && $student['visa_type'] == "Others") {

                                    $visa_type_others = "";
                                    }
                                    @endphp

                                    <div class="col-md-4" id="visa_type_others_show" style="display:{{$visa_type_others}}">

                                        <div class="form-group">
                                            <label for="visa_type_others">{{ __('messages.visa_type_others') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="visa_type_others" class="form-control" placeholder="{{ __('messages.enter_visa_type_others') }}" value="{{ isset($student['visa_type_others']) ? $student['visa_type_others'] : ''}}" name="visa_type_others" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_expiry_date">{{ __('messages.visa_expiry_date_for_non_malaysian') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" value="{{ isset($student['visa_expiry_date']) ? $student['visa_expiry_date'] : date('Y-m-d')}}" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="{{ isset($student['visa_expiry_date']) ? $student['visa_expiry_date'] : ''}}" aria-describedby="inputGroupPrepend">
                                            </div>
                                            <label for="visa_expiry_date" class="error"></label>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="japanese_association_membership_number_student">{{ __('messages.japanese_association_membership_number_student') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="japanese_association_membership_number_student" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($student['japanese_association_membership_number_student']) ? $student['japanese_association_membership_number_student'] : ''}}" name="japanese_association_membership_number_student" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    @if($form_field['nric'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_nric">{{ __('messages.nric_number_only_for_malaysian') }}</label>
                                            <input type="text" maxlength="16" id="txt_nric" class="form-control alloptions" value="{{ isset($student['nric']) ? $student['nric'] : ''}}" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">

                                        </div>
                                    </div>
                                    <input type="hidden" name="nric_old_photo" id="nric_old_photo" value="{{ isset($student['nric_photo']) ? $student['nric_photo'] : ''}}" />
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nric_photo">{{ __('messages.nric_image_only_for_malaysian') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="nric_photo" class="custom-file-input" name="nric_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="nric_photo">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            @if(isset($student['nric_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['nric_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['nric_photo'] }}" target="_blank"> {{ __('messages.nric_image_only_for_malaysian') }} </a>
                                            @endif
                                            <span id="nric_photo_name"></span>
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
                                    <h4 class="navv">{{ __('messages.previous_school_details') }}</h4>
                                    <button class="btn btn-link " type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                        <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                    </button>
                                </li>
                            </ul>

                            <div class="card-body collapse show">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input skip" {{ $student['school_name'] ? '' : 'checked' }} id="skip_prev_school_details" name="skip_prev_school_details">
                                        <label class="custom-control-label" for="skip_prev_school_details">{{ __('messages.skip_prev_school_details') }}</label>
                                    </div>
                                </div>
                                <div id="prev_school_details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_prev_schname">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" id="txt_prev_schname" class="form-control prev_school_form" name="txt_prev_schname" placeholder="{{ __('messages.enter_school_name') }}" data-parsley-trigger="change" value="{{ isset($student['school_name']) ? $student['school_name'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="50" id="school_country" value="{{ isset($student['school_country']) ? $student['school_country'] : ''}}" name="school_country" class="form-control country prev_school_form" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control prev_school_form" id="school_state" value="{{ isset($student['school_state']) ? $student['school_state'] : ''}}" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control prev_school_form" id="school_city" value="{{ isset($student['school_city']) ? $student['school_city'] : ''}}" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.city') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control prev_school_form" id="school_postal_code" name="school_postal_code" value="{{ isset($student['school_postal_code']) ? $student['school_postal_code'] : ''}}" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_enrollment_status">{{ __('messages.enrollment_status') }}<span class="text-danger">*</span></label>
                                            <select id="school_enrollment_status" name="school_enrollment_status" class="form-control prev_school_form">
                                                <option value="">{{ __('messages.select_enrollment_status') }}</option>
                                                <option value="Regular class" {{ isset($student['school_enrollment_status']) ? $student['school_enrollment_status'] == "Regular class" ? 'selected' : '' : '' }}>{{ __('messages.regular_class') }}</option>
                                                <option value="Special need class" {{ isset($student['school_enrollment_status']) ? $student['school_enrollment_status'] == "Special need class" ? 'selected' : '' : '' }}>{{ __('messages.special_need_class') }}</option>
                                                <option value="Regular guidance class" {{ isset($student['school_enrollment_status']) ? $student['school_enrollment_status'] == "Regular guidance class" ? 'selected' : '' : '' }}>{{ __('messages.regular_guidance_class') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_enrollment_status_tendency">{{ __('messages.enrollment_status_tendency') }}<span class="text-danger">*</span></label>
                                            <select id="school_enrollment_status_tendency" name="school_enrollment_status_tendency" class="form-control prev_school_form">
                                                <option value="">{{ __('messages.tendency_select_enrollment_status') }}</option>
                                                <option value="Yes" {{ isset($student['school_enrollment_status_tendency']) ? $student['school_enrollment_status_tendency'] == "Yes" ? 'selected' : '' : '' }}>{{ __('messages.yes') }}</option>
                                                <option value="No" {{ isset($student['school_enrollment_status_tendency']) ? $student['school_enrollment_status_tendency'] == "No" ? 'selected' : '' : '' }}>{{ __('messages.no') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_prev_qualify">{{ __('messages.qualification') }}</label>
                                                <input type="text" id="txt_prev_qualify" class="form-control" name="txt_prev_qualify" placeholder="{{ __('messages.enter_qualification') }}" data-parsley-trigger="change" value="{{ isset($student['qualification']) ? $student['qualification'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txtarea_prev_remarks">{{ __('messages.remarks') }}</label>
                                                <textarea id="txtarea_prev_remarks" class="form-control" name="txtarea_prev_remarks" placeholder="{{ __('messages.enter_the_remarks') }}">{{ isset($student['remarks']) ? $student['remarks'] : '' }}
                                                </textarea>
                                            </div>
                                        </div> -->
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.transport_details') }}</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_transport_route">{{ __('messages.transport_route') }}</label>

                                            <select id="drp_transport_route" name="drp_transport_route" class="form-control">
                                                <option value="">{{ __('messages.select_transport') }}</option>
                                                @forelse($transport as $trans)
                                                <option value="{{$trans['id']}}" {{ isset($student['route_id']) ?  $student['route_id'] == $trans['id'] ? "Selected" : "" : "" }}>{{$trans['name']}}</option>
                                                
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_transport_vechicleno">{{ __('messages.vehicle_number') }}</label>
                                            <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                                <option value="">{{ __('messages.select_vehicle_number') }}</option>

                                                @forelse($vehicle as $veh)
                                                <option value="{{$veh['vehicle_id']}}" {{ isset($student['vehicle_id']) ?  $student['vehicle_id'] == $veh['vehicle_id'] ? "Selected" : "" : "" }}>{{$veh['vehicle_no']}}</option>
                                                
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
                                    <h4 class="navv">{{ __('messages.hostel_details') }}</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_hostelnam">{{ __('messages.hostel_name') }}</label>
                                            <select id="drp_hostelnam" name="drp_hostelnam" class="form-control">
                                                <option value="">{{ __('messages.select_hostel_name') }}</option>
                                                @forelse($hostel as $hos)
                                                <option value="{{$hos['id']}}" {{ isset($student['hostel_id']) ?  $student['hostel_id'] == $hos['id'] ? "Selected" : "" : "" }}>{{$hos['name']}}</option>
                                                
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_roomname">{{ __('messages.room_name') }}</label>
                                            <select id="drp_roomname" name="drp_roomname" class="form-control">
                                                <option value="">{{ __('messages.select_room_name') }}</option>

                                                @forelse($room as $roo)
                                                <option value="{{$roo['room_id']}}" {{ isset($student['room_id']) ?  $student['room_id'] == $roo['room_id'] ? "Selected" : "" : "" }}>{{$roo['room_name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.update') }}
                            </button>
                            <a href="{{ route('parent.update_info') }}" class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.back') }}
                            </a>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
    @endif
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

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
    $(".country").countrySelect({
        responsiveDropdown: true,
        defaultCountry: "jp",
    });
</script>
<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexStudent = "{{ route('admin.student.index') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
    var studentUpdateList = "{{ route('admin.student.update_info_list') }}";
    var malaysiaPostalCode = "{{ route('parent.malaysia_postalCode') }}";
    var updateInfoList = "{{ route('parent.update_info') }}";
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>


<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/student_update.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
        }
    });
    $(document).ready(function(){
    var nationality = $('#nationality').val();
    var dual_nationality = $('#dual_nationality').val();
    if(nationality == dual_nationality)
    {
        $('#error_message').text('Please select a different nationality.').css('color', 'red').show();
    }
    else
    {
        $('#error_message').hide().text('');
    }
    $('#nationality').on('change', function(){
        var nationality = $('#nationality').val();
        var dual_nationality = $('#dual_nationality').val();
        $('#error_message').hide().text('');
        if(nationality == dual_nationality)
    {
        $('#error_message').text('Please select a different nationality.').css('color', 'red').show();
    }
    });
    $('#dual_nationality').on('change', function(){
        var nationality = $('#nationality').val();
        var dual_nationality = $('#dual_nationality').val();
        $('#error_message').hide().text('');
        if(nationality == dual_nationality)
    {
        $('#error_message').text('Please select a different nationality.').css('color', 'red').show();
    }
    });
});
    $(function() {
        // nric validation start
        // var $form_2 = $('#editadmission');
        // $form_2.validate({
        //     debug: true
        // });

        // $('#txt_nric').rules("add", {
        //     required: true
        // });

        $('#txt_nric').mask("000000-00-0000", {
            reverse: true
        });
        // nric validation end
    });
</script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection