@extends('layouts.admin-layout')
@section('title',' ' . __('messages.edit_application') . '')
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
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.edit_application') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="editApplication" method="post" action="{{ route('guest.application.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ isset($application['id']) ? $application['id'] : ''}}">

                        @php
                        $readonly_phase_1 = "";
                        $disabled_phase_1 = "";
                        $hidden_phase_2 = "none";
                        if($application['status']=="Approved"){
                        $disabled_phase_1 = "disabled";
                        $readonly_phase_1 = "readonly";
                        $hidden_phase_2 = "";
                        }else if($application['status']=="Reject"){
                        $disabled_phase_1 = "disabled";
                        $readonly_phase_1 = "readonly";
                        $hidden_phase_2 = "none";
                        }else if($application['status']=="Applied"){
                        $disabled_phase_1 = "disabled";
                        $readonly_phase_1 = "readonly";
                        $hidden_phase_2 = "none";
                        }


                        $readonly_phase_2 = "";
                        $disabled_phase_2 = "";
                        if($application['phase_2_status']=="Approved"){
                        $disabled_phase_2 = "disabled";
                        $readonly_phase_2 = "readonly";
                        }else if($application['phase_2_status']=="Reject"){
                        $disabled_phase_2 = "disabled";
                        $readonly_phase_2 = "readonly";
                        }else if($application['phase_2_status']=="Applied"){
                        $disabled_phase_2 = "disabled";
                        $readonly_phase_2 = "readonly";
                        }
                        @endphp
                        <ul class="nav nav-pills navtab-bg nav-justified" style="display:{{$hidden_phase_2}}">
                            <li class="nav-item">
                                <a href="#basic" id="basic_tab" data-toggle="tab" aria-expanded="false" class="nav-link   {{ isset($application['status']) ? $application['status'] != 'Approved' ? 'active' : '' : '' }} ">
                                    {{ __('messages.phase_1') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#personal" id="personal_tab" data-toggle="tab" data-tab="info" aria-expanded="true" class="nav-link  {{ isset($application['status']) ? $application['status'] == 'Approved' ? 'active' : '' : '' }} ">
                                    {{ __('messages.phase_2') }}
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- start Dashboard -->
                                <div class="tab-pane {{ isset($application['status']) ? $application['status'] != 'Approved' ? 'active' : '' : '' }}" id="basic">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.student_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name" {{$readonly_phase_1}} value="{{ isset($application['last_name']) ? $application['last_name'] : ''}}" name="last_name" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name">{{ __('messages.middle_name') }}</label>
                                                    <input type="text" class="form-control" id="middle_name" {{$readonly_phase_1}} name="middle_name" value="{{ isset($application['middle_name']) ? $application['middle_name'] : ''}}" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name" {{$readonly_phase_1}} value="{{ isset($application['first_name']) ? $application['first_name'] : ''}}" name="first_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @if($form_field['name_furigana'] == 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['last_name_furigana']) ? $application['last_name_furigana'] : ''}}" name="last_name_furigana" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name">{{ __('messages.middle_name_furigana') }}</label>
                                                    <input type="text" class="form-control" id="middle_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['middle_name_furigana']) ? $application['middle_name_furigana'] : ''}}" name="middle_name_furigana" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['first_name_furigana']) ? $application['first_name_furigana'] : ''}}" name="first_name_furigana" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($form_field['name_english'] == 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name_english" {{$readonly_phase_1}} value="{{ isset($application['last_name_english']) ? $application['last_name_english'] : ''}}" name="last_name_english" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name">{{ __('messages.middle_name_roma') }}</label>
                                                    <input type="text" class="form-control" id="middle_name_english" {{$readonly_phase_1}} value="{{ isset($application['middle_name_english']) ? $application['middle_name_english'] : ''}}" name="middle_name_english" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name_english" {{$readonly_phase_1}} value="{{ isset($application['first_name_english']) ? $application['first_name_english'] : ''}}" name="first_name_english" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @if($form_field['name_common'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">{{ __('messages.first_name_common') }}<span class="text-danger"></span></label>
                                                    <input type="text" class="form-control" id="first_name_common" {{$readonly_phase_1}} value="{{ isset($application['first_name_common']) ? $application['first_name_common'] : ''}}" name="first_name_common" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">{{ __('messages.last_name_common') }}</label>
                                                    <input type="text" class="form-control" id="last_name_common" {{$readonly_phase_1}} value="{{ isset($application['last_name_common']) ? $application['last_name_common'] : ''}}" name="last_name_common" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_of_birth">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="date_of_birth" {{$disabled_phase_1}} value="{{ isset($application['date_of_birth']) ? $application['date_of_birth'] : date('Y-m-d')}}" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">

                                                    </div>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="date_of_birth" value="{{$application['date_of_birth']}}">
                                                    @endif
                                                    <label for="date_of_birth" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                                    <select {{$disabled_phase_1}} id="gender" {{$disabled_phase_1}} name="gender" class="form-control">
                                                        <option value="">{{ __('messages.select_gender') }}</option>
                                                        <option value="Male" {{ isset($application['gender']) ? $application['gender'] =="Male" ? 'selected' : '' : '' }}>{{ __('messages.male') }}</option>
                                                        <option value="Female" {{ isset($application['gender']) ? $application['gender'] == "Female" ? 'selected' : '' : '' }}>{{ __('messages.female') }}</option>
                                                    </select>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="gender" value="{{$application['gender']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            @if($form_field['race'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="race">{{ __('messages.race') }}</label>
                                                    <select {{$disabled_phase_1}} class="form-control" name="race" id="race">
                                                        <option value="">{{ __('messages.select_race') }}</option>
                                                        @forelse($races as $r)
                                                        <option value="{{$r['id']}}" {{ isset($application['race']) ? $application['race'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['races_name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>

                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="race" value="{{$application['race']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if($form_field['religion'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="religion">{{ __('messages.religion') }}<span class="text-danger"></span></label>
                                                    <select {{$disabled_phase_1}} class="form-control" name="religion" id="religion">
                                                        <option value="">{{ __('messages.select_religion') }}</option>
                                                        @forelse($religion as $r)
                                                        <option value="{{$r['id']}}" {{ isset($application['religion']) ? $application['religion'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['religions_name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="religion" value="{{$application['religion']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            <!-- @if($form_field['blood_group'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                                    <select {{$disabled_phase_1}} class="form-control" name="blood_group" id="blood_group">
                                                        <option value="">{{ __('messages.select_blood_group') }}</option>
                                                        <option value="A+" {{ isset($application['blood_group']) ? $application['blood_group'] == "A+" ? 'selected' : '' : '' }}>A+</option>
                                                        <option value="A-" {{ isset($application['blood_group']) ? $application['blood_group'] == "A-" ? 'selected' : '' : '' }}>A-</option>
                                                        <option value="AB+" {{ isset($application['blood_group']) ? $application['blood_group'] == "AB+" ? 'selected' : '' : '' }}>AB+</option>
                                                        <option value="AB-" {{ isset($application['blood_group']) ? $application['blood_group'] == "AB-" ? 'selected' : '' : '' }}>AB-</option>
                                                        <option value="B+" {{ isset($application['blood_group']) ? $application['blood_group'] == "B+" ? 'selected' : '' : '' }}>B+</option>
                                                        <option value="B-" {{ isset($application['blood_group']) ? $application['blood_group'] == "B-" ? 'selected' : '' : '' }}>B-</option>
                                                        <option value="O+" {{ isset($application['blood_group']) ? $application['blood_group'] == "O+" ? 'selected' : '' : '' }}>O+</option>
                                                        <option value="O-" {{ isset($application['blood_group']) ? $application['blood_group'] == "O-" ? 'selected' : '' : '' }}>O-</option>
                                                    </select>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="blood_group" value="{{$application['blood_group']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            @endif -->
                                            @if($form_field['nationality'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="nationality" {{$readonly_phase_1}} class="form-control country" placeholder="{{ __('messages.nationality') }}" value="{{ isset($application['nationality']) ? $application['nationality'] : ''}}" name="nationality" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox" style="margin-top: 2.25rem;">
                                                        <input type="checkbox" name="has_dual_nationality_checkbox" {{$disabled_phase_1}} id="has_dual_nationality_checkbox" class="custom-control-input" {{ isset($application['dual_nationality']) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="has_dual_nationality_checkbox">Nationality (For dual nationality)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="dual_nationality_container" style="{{ isset($application['dual_nationality']) ? '' : 'display: none;' }}">
                                                    <label for="dual_nationality">{{ __('messages.dual_nationality') }}</label>
                                                    <input type="text" maxlength="50" id="dual_nationality" {{$readonly_phase_1}} class="form-control country" placeholder="{{ __('messages.dual_nationality') }}" name="dual_nationality" value="{{ isset($application['dual_nationality']) ? $application['dual_nationality'] : ''}}" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            @endif
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control number_validation mobile_no" id="mobile_no" {{$readonly_phase_1}} value="{{ isset($application['mobile_no']) ? $application['mobile_no'] : ''}}" name="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div> -->
                                        </div>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.prev_school_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_prev_school_details" {{$disabled_phase_1}} name="skip_prev_school_details" {{ $application['school_last_attended'] ? "" : 'checked'}}>
                                                <label class="custom-control-label" for="skip_prev_school_details">{{ __('messages.skip_prev_school_details') }}</label>
                                            </div>
                                        </div>
                                        <div id="prev_school_details" style="display: {{ $application['school_last_attended'] ? '' : 'none' }}">
                                            <div class="row">
                                                <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_address_1">{{ __('messages.school_address1') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_address_1" {{$readonly_phase_1}} value="{{ isset($application['school_address_1']) ? $application['school_address_1'] : ''}}" name="school_address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_address_2">{{ __('messages.school_address2') }}<br></label>
                                                    <input type="text" class="form-control" id="school_address_2" {{$readonly_phase_1}} value="{{ isset($application['school_address_2']) ? $application['school_address_2'] : ''}}" name="school_address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_last_attended">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control prev_school_form" id="school_last_attended" {{$readonly_phase_1}} value="{{ isset($application['school_last_attended']) ? $application['school_last_attended'] : ''}}" name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                        <input type="text" maxlength="50" id="school_country" {{$readonly_phase_1}} value="{{ isset($application['school_country']) ? $application['school_country'] : ''}}" name="school_country" class="form-control prev_school_form country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control prev_school_form" id="school_state" {{$readonly_phase_1}} value="{{ isset($application['school_state']) ? $application['school_state'] : ''}}" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control prev_school_form" id="school_city" {{$readonly_phase_1}} value="{{ isset($application['school_city']) ? $application['school_city'] : ''}}" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.city') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control prev_school_form number_validation" id="school_postal_code" {{$readonly_phase_1}} value="{{ isset($application['school_postal_code']) ? $application['school_postal_code'] : ''}}" name="school_postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_enrollment_status">{{ __('messages.enrollment_status') }}<span class="text-danger">*</span></label>
                                                        <select id="school_enrollment_status" {{$disabled_phase_1}} name="school_enrollment_status" class="form-control prev_school_form">
                                                            <option value="">{{ __('messages.select_enrollment_status') }}</option>
                                                            <option value="Regular class" {{ isset($application['school_enrollment_status']) ? $application['school_enrollment_status'] == "Regular class" ? 'selected' : '' : '' }}>{{ __('messages.regular_class') }}</option>
                                                            <option value="Special need class" {{ isset($application['school_enrollment_status']) ? $application['school_enrollment_status'] == "Special need class" ? 'selected' : '' : '' }}>{{ __('messages.special_need_class') }}</option>
                                                            <option value="Regular guidance class" {{ isset($application['school_enrollment_status']) ? $application['school_enrollment_status'] == "Regular guidance class" ? 'selected' : '' : '' }}>{{ __('messages.regular_guidance_class') }}</option>
                                                        </select>
                                                        @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="school_enrollment_status" value="{{$application['school_enrollment_status']}}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="school_enrollment_status_tendency">{{ __('messages.enrollment_status_tendency') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="school_enrollment_status_tendency" name="school_enrollment_status_tendency" class="form-control prev_school_form">
                                                            <option value="">{{ __('messages.tendency_select_enrollment_status') }}</option>
                                                            <option value="Yes" {{ isset($application['school_enrollment_status_tendency']) ? $application['school_enrollment_status_tendency'] == "Yes" ? 'selected' : '' : '' }}>{{ __('messages.yes') }}</option>
                                                            <option value="No" {{ isset($application['school_enrollment_status_tendency']) ? $application['school_enrollment_status_tendency'] == "No" ? 'selected' : '' : '' }}>{{ __('messages.no') }}</option>
                                                        </select>
                                                        @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="school_enrollment_status_tendency" value="{{$application['school_enrollment_status_tendency']}}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.mother_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_mother_details" {{$disabled_phase_1}} name="skip_mother_details" {{ $application['mother_first_name'] ? "" : 'checked'}}>
                                                <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                                            </div>
                                        </div>
                                        <div id="mother_details" style="display: {{ $application['mother_first_name'] ? '' : 'none' }}">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name" {{$readonly_phase_1}} value="{{ isset($application['mother_last_name']) ? $application['mother_last_name'] : ''}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name" {{$readonly_phase_1}} value="{{ isset($application['mother_middle_name']) ? $application['mother_middle_name'] : ''}}" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" {{$readonly_phase_1}} id="mother_first_name" value="{{ isset($application['mother_first_name']) ? $application['mother_first_name'] : ''}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['mother_last_name_furigana']) ? $application['mother_last_name_furigana'] : ''}}" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['mother_middle_name_furigana']) ? $application['mother_middle_name_furigana'] : ''}}" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" {{$readonly_phase_1}} id="mother_first_name_furigana" value="{{ isset($application['mother_first_name_furigana']) ? $application['mother_first_name_furigana'] : ''}}" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_english" {{$readonly_phase_1}} value="{{ isset($application['mother_last_name_english']) ? $application['mother_last_name_english'] : ''}}" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_english" {{$readonly_phase_1}} value="{{ isset($application['mother_middle_name_english']) ? $application['mother_middle_name_english'] : ''}}" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" {{$readonly_phase_1}} id="mother_first_name_english" value="{{ isset($application['mother_first_name_english']) ? $application['mother_first_name_english'] : ''}}" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form country" {{$readonly_phase_1}} id="mother_nationality" name="mother_nationality" value="{{ isset($application['mother_nationality']) ? $application['mother_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control mother_form" id="mother_email" {{$readonly_phase_1}} value="{{ isset($application['mother_email']) ? $application['mother_email'] : ''}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form number_validation" id="mother_phone_number" {{$readonly_phase_1}} value="{{ isset($application['mother_phone_number']) ? $application['mother_phone_number'] : ''}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="mother_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="mother_occupation" name="mother_occupation" class="form-control copy_parent_info mother_form">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($application['mother_occupation']) ? $application['mother_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($application['mother_occupation']) ? $application['mother_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($application['mother_occupation']) ? $application['mother_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($application['mother_occupation']) ? $application['mother_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="mother_occupation" value="{{$application['mother_occupation']}}">
                                                @endif
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_occupation" name="mother_occupation" {{$readonly_phase_1}} value="{{ isset($application['mother_occupation']) ? $application['mother_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.father_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_father_details" name="skip_father_details" {{$disabled_phase_1}} {{ $application['father_first_name'] ? "" : 'checked'}}>
                                                <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                                            </div>
                                        </div>

                                        <div id="father_details" style="display: {{ $application['father_first_name'] ? '' : 'none' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" {{$readonly_phase_1}} id="father_last_name" value="{{ isset($application['father_last_name']) ? $application['father_last_name'] : ''}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form" {{$readonly_phase_1}} id="father_middle_name" value="{{ isset($application['father_middle_name']) ? $application['father_middle_name'] : ''}}" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" {{$readonly_phase_1}} id="father_first_name" value="{{ isset($application['father_first_name']) ? $application['father_first_name'] : ''}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['father_last_name_furigana']) ? $application['father_last_name_furigana'] : ''}}" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['father_middle_name_furigana']) ? $application['father_middle_name_furigana'] : ''}}" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" {{$readonly_phase_1}} id="father_first_name_furigana" value="{{ isset($application['father_first_name_furigana']) ? $application['father_first_name_furigana'] : ''}}" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english" {{$readonly_phase_1}} value="{{ isset($application['father_last_name_english']) ? $application['father_last_name_english'] : ''}}" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english" {{$readonly_phase_1}} value="{{ isset($application['father_middle_name_english']) ? $application['father_middle_name_english'] : ''}}" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" {{$readonly_phase_1}} id="father_first_name_english" value="{{ isset($application['father_first_name_english']) ? $application['father_first_name_english'] : ''}}" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form country" {{$readonly_phase_1}} id="father_nationality" name="father_nationality" value="{{ isset($application['father_nationality']) ? $application['father_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  father_form" {{$readonly_phase_1}} id="father_email" value="{{ isset($application['father_email']) ? $application['father_email'] : ''}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form number_validation" {{$readonly_phase_1}} id="father_phone_number" value="{{ isset($application['father_phone_number']) ? $application['father_phone_number'] : ''}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="father_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="father_occupation" name="father_occupation" class="form-control">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($application['father_occupation']) ? $application['father_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($application['father_occupation']) ? $application['father_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($application['father_occupation']) ? $application['father_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($application['father_occupation']) ? $application['father_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="father_occupation" value="{{$application['father_occupation']}}">
                                                @endif
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_occupation" name="father_occupation" {{$readonly_phase_1}} value="{{ isset($application['father_occupation']) ? $application['father_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.guardian_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_guardian_details" name="skip_guardian_details" {{ $application['guardian_first_name'] ? "" : "checked" }}>
                                                <label class="custom-control-label" for="skip_guardian_details">{{ __('messages.skip_guardian_details') }}</label>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" {{$disabled_phase_1}} class="copy_parent" name="copy_parent" id="copy_father" value="father" {{ isset($application['guardian_email']) ? $application['guardian_email'] == $application['father_email'] ? 'checked' : '' : '' }}>
                                                        <label for="father"> {{ __('messages.copy_from_father_details') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" {{$disabled_phase_1}} class="copy_parent" name="copy_parent" id="copy_mother" value="mother" {{ isset($application['guardian_email']) ? $application['guardian_email'] == $application['mother_email'] ? 'checked' : '' : '' }}>
                                                        <label for="mother"> {{ __('messages.copy_from_mother_details') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" {{$disabled_phase_1}} class="copy_parent" name="copy_parent" id="copy_others" value="others" {{ isset($application['guardian_email']) ? $application['guardian_email'] != $application['father_email'] ? 'checked' : '' : '' }} {{ isset($application['guardian_email']) ? $application['guardian_email'] == $application['mother_email'] ? 'checked' : '' : '' }}>
                                                        <label for="others"> {{ __('messages.others') }} </label>
                                                    </div>
                                                </div>
                                            </div><br>
                                        </div>

                                        <div id="guardian_details">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_last_name" value="{{ isset($application['guardian_last_name']) ? $application['guardian_last_name'] : ''}}" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_middle_name" value="{{ isset($application['guardian_middle_name']) ? $application['guardian_middle_name'] : ''}}" name="guardian_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_first_name" value="{{ isset($application['guardian_first_name']) ? $application['guardian_first_name'] : ''}}" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_last_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['guardian_last_name_furigana']) ? $application['guardian_last_name_furigana'] : ''}}" name="guardian_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control" id="guardian_middle_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['guardian_middle_name_furigana']) ? $application['guardian_middle_name_furigana'] : ''}}" name="guardian_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_first_name_furigana" value="{{ isset($application['guardian_first_name_furigana']) ? $application['guardian_first_name_furigana'] : ''}}" name="guardian_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_last_name_english" {{$readonly_phase_1}} value="{{ isset($application['guardian_last_name_english']) ? $application['guardian_last_name_english'] : ''}}" name="guardian_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control" id="guardian_middle_name_english" {{$readonly_phase_1}} value="{{ isset($application['guardian_middle_name_english']) ? $application['guardian_middle_name_english'] : ''}}" name="guardian_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_first_name_english" value="{{ isset($application['guardian_first_name_english']) ? $application['guardian_first_name_english'] : ''}}" name="guardian_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="guardian_relation" name="guardian_relation" class="form-control">
                                                            <option value="">{{ __('messages.select_relation') }}</option>
                                                            @forelse($relation as $r)
                                                            <option value="{{$r['id']}}" {{ isset($application['guardian_relation']) ? $application['guardian_relation'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="guardian_relation" value="{{$application['guardian_relation']}}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" readonly id="guardian_email" value="{{ isset($application['guardian_email']) ? $application['guardian_email'] : ''}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control number_validation" {{$readonly_phase_1}} id="guardian_phone_number" value="{{ isset($application['guardian_phone_number']) ? $application['guardian_phone_number'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="guardian_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="guardian_occupation" name="guardian_occupation" class="form-control">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($application['guardian_occupation']) ? $application['guardian_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($application['guardian_occupation']) ? $application['guardian_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($application['guardian_occupation']) ? $application['guardian_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($application['guardian_occupation']) ? $application['guardian_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                        @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="guardian_occupation" value="{{$application['guardian_occupation']}}">
                                                        @endif
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_occupation" name="guardian_occupation" value="{{ isset($application['guardian_occupation']) ? $application['guardian_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_company_name_japan" name="guardian_company_name_japan" value="{{ isset($application['guardian_company_name_japan']) ? $application['guardian_company_name_japan'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_company_name_local" name="guardian_company_name_local" value="{{ isset($application['guardian_company_name_local']) ? $application['guardian_company_name_local'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  number_validation " {{$readonly_phase_1}} id="guardian_company_phone_number" name="guardian_company_phone_number" value="{{ isset($application['guardian_company_phone_number']) ? $application['guardian_company_phone_number'] : ''}}" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="guardian_company_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
                                                        <select id="guardian_employment_status" name="guardian_employment_status" {{$disabled_phase_1}} class="form-control">
                                                            <option value="">{{ __('messages.select_employment_status') }}</option>
                                                            <option value="Expat" {{ isset($application['guardian_employment_status']) ? $application['guardian_employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
                                                            <option value="Local Hire" {{ isset($application['guardian_employment_status']) ? $application['guardian_employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
                                                            <option value="Public Servant" {{ isset($application['guardian_employment_status']) ? $application['guardian_employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
                                                            <option value="Self-Employed" {{ isset($application['guardian_employment_status']) ? $application['guardian_employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
                                                            <option value="Others" {{ isset($application['guardian_employment_status']) ? $application['guardian_employment_status'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
                                                        </select>
                                                    </div>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="guardian_employment_status" value="{{$application['guardian_employment_status']}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.academic_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_academic_year">{{ __('messages.expected_academic_year') }}<span class="text-danger">*</span></label>
                                                    <select id="expected_academic_year" {{$disabled_phase_1}} name="expected_academic_year" class="form-control">
                                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                                        @forelse($academic_year_list as $r)
                                                        <option value="{{$r['id']}}" {{ isset($application['expected_academic_year']) ? $application['expected_academic_year'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="expected_academic_year" value="{{$application['expected_academic_year']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_grade">{{ __('messages.expected_grade') }}<span class="text-danger">*</span></label>
                                                    <select id="expected_grade" {{$disabled_phase_1}} name="expected_grade" class="form-control">
                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                        @forelse($grade as $g)
                                                        <option value="{{$g['id']}}" {{ isset($application['expected_grade']) ? $application['expected_grade'] == $g['id'] ? 'selected' : '' : '' }}>{{$g['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="expected_grade" value="{{$application['expected_grade']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_enroll_date">{{ __('messages.expected_enroll_date') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" value="{{ isset($application['expected_enroll_date']) ? $application['expected_enroll_date'] : ''}}" {{$disabled_phase_1}} id="expected_enroll_date" name="expected_enroll_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">

                                                    </div>
                                                    @if($disabled_phase_1=="disabled")
                                                    <input type="hidden" name="expected_enroll_date" value="{{$application['expected_enroll_date']}}">
                                                    @endif
                                                    <label for="expected_enroll_date" class="error"></label>
                                                </div>
                                            </div>
                                        </div><br>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.re-admission') }}
                                                <h4>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <div id="re_admission_details">
                                            <div class="row">
                                                <div class="col-md-2 mt-4">
                                                    <div class="form-group">
                                                        <div class="radio radio-success form-check-inline">
                                                            <input type="radio" class="re_admission" id="" {{$disabled_phase_1}} name="re_admission" value="yes" {{ isset($application['type']) ? $application['type'] == "Re-Admission" ? 'checked' : '' : '' }}>
                                                            <label for="yes"> {{ __('messages.yes') }} </label>
                                                        </div>
                                                        <div class="radio radio-success form-check-inline">
                                                            <input type="radio" class="re_admission" id="" {{$disabled_phase_1}} name="re_admission" value="no" {{ isset($application['type']) ? $application['type'] == "Admission" ? 'checked' : '' : '' }}>
                                                            <label for="no"> {{ __('messages.no') }} </label>
                                                        </div>
                                                        <!-- <div class="radio radio-success form-check-inline">
                                                            <input type="radio" class="verify_emails" id="" name="verify_emails" value="guardian">
                                                            <label for="guardian"> Guardian </label>
                                                        </div> -->
                                                    </div>
                                                    
                                                    @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="re_admission" value="{{ isset($application['type']) ? $application['type'] == 'Re-Admission' ? 'yes' : 'no' : 'no' }}">
                                                    @endif
                                                </div>
                                                @php

                                                $last_date = "none";
                                                if($application['type']=="Re-Admission"){

                                                $last_date = "";
                                                }
                                                @endphp
                                                <div class="col-md-4" id="last_date" style="display:{{$last_date}}">
                                                    <div class="form-group">
                                                        <label for="last_date_of_withdrawal">{{ __('messages.last_date_of_withdrawal') }}<span class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <span class="far fa-calendar-alt"></span>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" {{$disabled_phase_1}} id="last_date_of_withdrawal" value="{{ isset($application['last_date_of_withdrawal']) ? $application['last_date_of_withdrawal'] : ''}}" name="last_date_of_withdrawal" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                        </div>
                                                        @if($disabled_phase_1=="disabled")
                                                        <input type="hidden" name="last_date_of_withdrawal" value="{{$application['last_date_of_withdrawal']}}">
                                                        @endif
                                                        <label for="last_date_of_withdrawal" class="error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.status') }}
                                                <h4>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="enrollment">{{ __('messages.enrollment') }}<span class="text-danger">*</span></label>
                                                    <select id="enrollment" name="enrollment" class="form-control">
                                                        <option value="">{{ __('messages.enrollment') }}</option>
                                                        <option selected>Trail</option>
                                                        <option>Official</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            <input type="hidden" name="status" value="{{$application['status']}}">
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phase_1_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                                    <select id="phase_1_status" name="status" class="form-control" disabled>
                                                        <option value="">{{ __('messages.status') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Applied" ? 'selected' : '' : '' }} value="Applied">{{ __('messages.applied') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Approved" ? 'selected' : '' : '' }} value="Approved">{{ __('messages.approved') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Send Back" ? 'selected' : '' : '' }} value="Send Back">{{ __('messages.send_back') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Reject" ? 'selected' : '' : '' }} value="Reject">{{ __('messages.reject') }}</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            @php

                                            $phase_1_reason = "none";
                                            if($application['status']=="Reject" || $application['status']=="Send Back"){

                                            $phase_1_reason = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="reason_1" style="display:{{$phase_1_reason}}">
                                                <div class="form-group">
                                                    <label for="phase_1_reason">{{ __('messages.reason') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" id="phase_1_reason" class="form-control" readonly  placeholder="{{ __('messages.enter_reason') }}" name="phase_1_reason" data-parsley-trigger="change">{{ isset($application['phase_1_reason']) ? $application['phase_1_reason'] : ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="remarks">{{ __('messages.remarks') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" id="remarks" class="form-control" {{$readonly_phase_1}} placeholder="{{ __('messages.enter_remarks') }}" name="remarks" data-parsley-trigger="change">{{ isset($application['remarks']) ? $application['remarks'] : ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right m-b-0">
                                        @if($application['status']=="Approved")
                                        <a class="btn btn-primary-bl waves-effect waves-light" id="next" href="#personal" data-toggle="tab" data-tab="info" aria-expanded="true" class="nav-link ">
                                            Next
                                        </a>
                                        @else
                                        <button class="btn btn-primary-bl waves-effect waves-light" {{$disabled_phase_1}} id="submit" type="submit">
                                            {{ __('messages.update') }}
                                        </button>
                                        @endif
                                        <a href="{{ route('guest.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                            {{ __('messages.back') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-pane {{ isset($application['status']) ? $application['status'] == 'Approved' ? 'active' : '' : '' }}" id="personal">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.student_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control number_validation" id="postal_code" value="{{ isset($application['postal_code']) ? $application['postal_code'] : ''}}" name="postal_code" placeholder="{{ __('messages.enter_postal_code') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address_unit_no">{{ __('messages.address_unit_no') }}<span class="text-danger">*</span></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="address_unit_no" value="{{ isset($application['address_unit_no']) ? $application['address_unit_no'] : ''}}" name="address_unit_no" placeholder="{{ __('messages.enter_address_unit_no') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address_condominium">{{ __('messages.address_condominium') }}<span class="text-danger">*</span><br></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="address_condominium" value="{{ isset($application['address_condominium']) ? $application['address_condominium'] : ''}}" name="address_condominium" placeholder="{{ __('messages.enter_address_condominium') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address_street">{{ __('messages.address_street') }}<span class="text-danger">*</span><br></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="address_street" value="{{ isset($application['address_street']) ? $application['address_street'] : ''}}" name="address_street" placeholder="{{ __('messages.enter_address_street') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="address_district">{{ __('messages.address_district') }}<span class="text-danger">*</span><br></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="address_district" value="{{ isset($application['address_district']) ? $application['address_district'] : ''}}" name="address_district" placeholder="{{ __('messages.enter_address_district') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="city" value="{{ isset($application['city']) ? $application['city'] : ''}}" name="city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                                    <input type="text" {{$readonly_phase_2}} class="form-control" id="state" value="{{ isset($application['state']) ? $application['state'] : ''}}" name="state" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="country" {{$readonly_phase_2}} class="form-control " placeholder="{{ __('messages.country') }}" value="{{ isset($application['country']) ? $application['country'] : ''}}" name="country" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.personal_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">

                                            @if($form_field['passport'] == 0)
                                            <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($application['passport_photo']) ? $application['passport_photo'] : ''}}" />
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_photo">{{ __('messages.passport_image_japan') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" id="passport_photo" {{$disabled_phase_2}} class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>

                                                    <label for="passport_photo" class="error"></label>
                                                    @if(isset($application['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_photo'] }}" target="_blank"> {{ __('messages.passport_image_japan') }} </a>
                                                    @endif
                                                    <span id="passport_photo_name"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport">{{ __('messages.passport_number_japan') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="20" {{$readonly_phase_2}} class="form-control alloptions" id="passport" placeholder="{{ __('messages.enter_passport_number') }}" value="{{ isset($application['passport']) ? $application['passport'] : ''}}" name="passport">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_expiry_date">{{ __('messages.passport_expiry_date_japan') }}<span class="text-danger">*</span><span class="text-danger"></span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" {{$disabled_phase_2}} id="passport_expiry_date" value="{{ isset($application['passport_expiry_date']) ? $application['passport_expiry_date'] : date('Y-m-d')}}" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
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
                                            <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($application['visa_photo']) ? $application['visa_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_photo">{{ __('messages.visa_image__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" id="visa_photo" {{$disabled_phase_2}} class="custom-file-input" value="" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    <label for="visa_photo" class="error"></label>
                                                    @if(isset($application['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                                    @endif
                                                    <span id="visa_photo_name"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_type">{{ __('messages.visa_type__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                                    <select id="visa_type" name="visa_type" {{$disabled_phase_2}} class="form-control">
                                                        <option value="">{{ __('messages.select_visa_type') }}</option>
                                                        <option value="No Require (Malaysian)" {{ isset($application['visa_type']) ? $application['visa_type'] == "No Require (Malaysian)" ? 'selected' : '' : '' }}>{{ __('messages.no_require_malaysian') }}</option>
                                                        <option value="Depedent Pass" {{ isset($application['visa_type']) ? $application['visa_type'] == "Depedent Pass" ? 'selected' : '' : '' }}>{{ __('messages.depedent_pass') }}</option>
                                                        <option value="MM2H" {{ isset($application['visa_type']) ? $application['visa_type'] == "MM2H" ? 'selected' : '' : '' }}>{{ __('messages.mm2h') }}</option>
                                                        <option value="Resident Pass" {{ isset($application['visa_type']) ? $application['visa_type'] == "Resident Pass" ? 'selected' : '' : '' }}>{{ __('messages.resident_pass') }}</option>
                                                        <option value="Others" {{ isset($application['visa_type']) ? $application['visa_type'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @php
                                            $visa_type_others = "none";
                                            if($application['visa_type'] == "Others"){

                                            $visa_type_others = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="visa_type_others_show" style="display:{{$visa_type_others}}">

                                                <div class="form-group">
                                                    <label for="visa_type_others">{{ __('messages.visa_type_others') }}<span class="text-danger">*</span></label>
                                                    <input type="text" id="visa_type_others" {{$readonly_phase_2}} class="form-control" placeholder="{{ __('messages.enter_visa_type_others') }}" value="{{ isset($application['visa_type_others']) ? $application['visa_type_others'] : ''}}" name="visa_type_others" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_expiry_date">{{ __('messages.visa_expiry_date_for_non_malaysian') }}<span class="text-danger">*</span><span class="text-danger"></span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" {{$disabled_phase_2}} id="visa_expiry_date" value="{{ isset($application['visa_expiry_date']) ? $application['visa_expiry_date'] : ''}}" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                    <label for="visa_expiry_date" class="error"></label>
                                                </div>
                                            </div>

                                            @endif

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="japanese_association_membership_number_student">{{ __('messages.japanese_association_membership_number_student') }}<span class="text-danger">*</span></label>
                                                    <input type="text" id="japanese_association_membership_number_student" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($application['japanese_association_membership_number_student']) ? $application['japanese_association_membership_number_student'] : ''}}" name="japanese_association_membership_number_student" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <input type="hidden" name="japanese_association_membership_image_principal_old" id="japanese_association_membership_image_principal_old" value="{{ isset($application['japanese_association_membership_image_principal']) ? $application['japanese_association_membership_image_principal'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="japanese_association_membership_image_principal">{{ __('messages.japanese_association_membership_image_principal') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="japanese_association_membership_image_principal" class="custom-file-input" value="" name="japanese_association_membership_image_principal" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="japanese_association_membership_image_principal">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    <label for="japanese_association_membership_image_principal" class="error"></label>
                                                    @if(isset($application['japanese_association_membership_image_principal']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['japanese_association_membership_image_principal'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['japanese_association_membership_image_principal'] }}" target="_blank"> {{ __('messages.japanese_association_membership_image_principal') }} </a>
                                                    @endif
                                                    <span id="japanese_association_membership_image_principal_name"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="japanese_association_membership_image_supplimental_old" id="japanese_association_membership_image_supplimental_old" value="{{ isset($application['japanese_association_membership_image_supplimental']) ? $application['japanese_association_membership_image_supplimental'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="japanese_association_membership_image_supplimental">{{ __('messages.japanese_association_membership_image_supplimental') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="japanese_association_membership_image_supplimental" class="custom-file-input" value="" name="japanese_association_membership_image_supplimental" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="japanese_association_membership_image_supplimental">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    <label for="japanese_association_membership_image_supplimental" class="error"></label>
                                                    @if(isset($application['japanese_association_membership_image_supplimental']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['japanese_association_membership_image_supplimental'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['japanese_association_membership_image_supplimental'] }}" target="_blank"> {{ __('messages.japanese_association_membership_image_supplimental') }} </a>
                                                    @endif
                                                    <span id="japanese_association_membership_image_supplimental_name"></span>
                                                </div>
                                            </div>
                                            @if($form_field['nric'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nric">{{ __('messages.nric_number_only_for_malaysian') }}</label>
                                                    <input type="text" {{$readonly_phase_2}} maxlength="16" id="nric" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($application['nric']) ? $application['nric'] : ''}}" name="nric" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <input type="hidden" name="nric_old_photo" id="nric_old_photo" value="{{ isset($application['nric_photo']) ? $application['nric_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nric_photo">{{ __('messages.nric_image_only_for_malaysian') }}</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" id="nric_photo" {{$disabled_phase_2}} class="custom-file-input" name="nric_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="nric_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    @if(isset($application['nric_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['nric_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['nric_photo'] }}" target="_blank"> {{ __('messages.nric_image_only_for_malaysian') }} </a>
                                                    @endif
                                                    <span id="nric_photo_name"></span>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div><br>

                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.guardian_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">

                                            <input type="hidden" name="passport_father_old_photo" id="passport_father_old_photo" value="{{ isset($application['passport_father_photo']) ? $application['passport_father_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_father_photo">{{ __('messages.passport_image_father_only_if_malaysian') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="passport_father_photo" class="custom-file-input" name="passport_father_photo" accept="image/png, image/gif, image/jpeg" value="{{ isset($application['passport_father_photo']) ? $application['passport_father_photo'] : ''}}">
                                                            <label class="custom-file-label" for="passport_father_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    <label for="passport_father_photo" class="error"></label>
                                                    @if(isset($application['passport_father_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_father_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_father_photo'] }}" target="_blank"> {{ __('messages.passport_image_father_only_if_malaysian') }} </a>
                                                    @endif
                                                    <span id="passport_father_photo_name"></span>
                                                </div>
                                            </div>

                                            <input type="hidden" name="passport_mother_old_photo" id="passport_mother_old_photo" value="{{ isset($application['passport_mother_photo']) ? $application['passport_mother_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_mother_photo">{{ __('messages.passport_image_mother_only_if_malaysian') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="passport_mother_photo" class="custom-file-input" name="passport_mother_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="passport_mother_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    <label for="passport_mother_photo" class="error"></label>
                                                    @if(isset($application['passport_mother_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_mother_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_mother_photo'] }}" target="_blank"> {{ __('messages.passport_image_mother_only_if_malaysian') }} </a>
                                                    @endif
                                                    <span id="passport_mother_photo_name"></span>
                                                </div>
                                            </div>


                                            <input type="hidden" name="visa_father_old_photo" id="visa_father_old_photo" value="{{ isset($application['visa_father_photo']) ? $application['visa_father_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_father_photo">{{ __('messages.visa_image_father_only_for_non_malaysian') }}</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="visa_father_photo" class="custom-file-input" name="visa_father_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="visa_father_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    @if(isset($application['visa_father_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_father_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_father_photo'] }}" target="_blank"> {{ __('messages.visa_image_father_only_for_non_malaysian') }} </a>
                                                    @endif
                                                    <span id="visa_father_photo_name"></span>
                                                </div>
                                            </div>

                                            <input type="hidden" name="visa_mother_old_photo" id="visa_mother_old_photo" value="{{ isset($application['visa_mother_photo']) ? $application['visa_mother_photo'] : ''}}" />

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="visa_mother_photo">{{ __('messages.visa_image_mother_only_for_non_malaysian') }}</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" {{$disabled_phase_2}} id="visa_mother_photo" class="custom-file-input" name="visa_mother_photo" accept="image/png, image/gif, image/jpeg">
                                                            <label class="custom-file-label" for="visa_mother_photo">{{ __('messages.choose_file') }}</label>
                                                        </div>
                                                    </div>
                                                    @if(isset($application['visa_mother_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_mother_photo'])
                                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_mother_photo'] }}" target="_blank"> {{ __('messages.visa_image_mother_only_for_non_malaysian') }} </a>
                                                    @endif
                                                    <span id="visa_mother_photo_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.family_details') }}
                                            </h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stay_category">{{ __('messages.stay_category') }}<span class="text-danger">*</span></label>
                                                <select id="stay_category" {{$disabled_phase_2}} name="stay_category" class="form-control">
                                                    <option value="">{{ __('messages.select_stay_category') }}</option>
                                                    <option value="Long stay" {{ isset($application['stay_category']) ? $application['stay_category'] == "Long stay" ? 'selected' : '' : '' }}>{{ __('messages.long_stay') }}</option>
                                                    <option value="PR" {{ isset($application['stay_category']) ? $application['stay_category'] == "PR" ? 'selected' : '' : '' }}>{{ __('messages.pr_stay') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.status') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">


                                            <input type="hidden" name="phase_2_status" value="{{$application['phase_2_status']}}">
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phase_2_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                                    <select id="phase_2_status"  {{$disabled_phase_2}}  name="phase_2_status" class="form-control">
                                                        <option value="">{{ __('messages.select_status') }}</option>
                                                        <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Applied" ? 'selected' : '' : '' }} {{ isset($application['phase_2_status']) ? "" : 'selected'}} value="Applied" >{{ __('messages.applied') }}</option>
                                                        <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Approved" ? 'selected' : '' : '' }} disabled value="Approved">{{ __('messages.approved') }}</option>
                                                        <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Send Back" ? 'selected' : '' : '' }} disabled value="Send Back">{{ __('messages.send_back') }}</option>
                                                        <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Reject" ? 'selected' : '' : '' }} disabled value="Reject">{{ __('messages.reject') }}</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            @php

                                            $enrollment = "none";
                                            if($application['enrollment']){

                                            $enrollment = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="enrollment_show" style="display:{{$enrollment}}">
                                                <div class="form-group">
                                                    <label for="enrollment">{{ __('messages.enrollment') }}<span class="text-danger"></span></label>
                                                    <select id="enrollment" {{$disabled_phase_2}} name="enrollment" class="form-control" disabled>
                                                        <option value="">{{ __('messages.select_enrollment') }}</option>
                                                        <option {{ isset($application['enrollment']) ? $application['enrollment'] == "Trail Enrollment" ? 'selected' : '' : '' }} value="Trail Enrollment">{{ __('messages.trail_enrollment') }}</option>
                                                        <option {{ isset($application['enrollment']) ? $application['enrollment'] == "Official Enrollment" ? 'selected' : '' : '' }} value="Official Enrollment">{{ __('messages.official_enrollment') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @php

                                            $trail_date = "none";
                                            if($application['enrollment']=="Trail Enrollment"){

                                            $trail_date = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="trail_date_show" style="display:{{$trail_date}}">
                                                <div class="form-group">
                                                    <label for="text">{{ __('messages.trail_date') }}<span class="text-danger"></span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" disabled class="form-control" id="trail_date" value="{{ isset($application['trail_date']) ? $application['trail_date'] : date('Y-m-d')}}" name="trail_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="trail_date" value="{{ isset($application['trail_date']) ? $application['trail_date'] : '' }}">
                                            </div>
                                            @php

                                            $official_date = "none";
                                            if($application['enrollment']=="Official Enrollment"){

                                            $official_date = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="official_date_show" style="display:{{$official_date}}">
                                                <div class="form-group">
                                                    <label for="text">{{ __('messages.official_date') }}<span class="text-danger"></span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" disabled class="form-control" id="trail_date" value="{{ isset($application['trail_date']) ? $application['trail_date'] : date('Y-m-d')}}" name="trail_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="trail_date" value="{{ isset($application['trail_date']) ? $application['trail_date'] : '' }}">
                                            </div>
                                            @php
                                            $phase_2_reason = "none";
                                            if($application['phase_2_status']=="Reject" || $application['phase_2_status']=="Send Back"){

                                            $phase_2_reason = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="reason_2" style="display:{{$phase_2_reason}}">
                                                <div class="form-group">
                                                    <label for="phase_2_reason">{{ __('messages.reason') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" id="phase_2_reason" {{$readonly_phase_2}} class="form-control"   placeholder="{{ __('messages.enter_reason') }}" name="phase_2_reason" data-parsley-trigger="change">{{ isset($application['phase_2_reason']) ? $application['phase_2_reason'] : ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phase2_remarks">{{ __('messages.remarks') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text" id="phase2_remarks" {{$readonly_phase_2}} class="form-control" placeholder="{{ __('messages.enter_remarks') }}" name="phase2_remarks" data-parsley-trigger="change"> {{ isset($application['phase2_remarks']) ? $application['phase2_remarks'] : ''}} </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary-bl waves-effect waves-light" {{$disabled_phase_2}} id="submit" type="submit">
                                            {{ __('messages.update') }}
                                        </button>
                                        <a href="{{ route('guest.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                            {{ __('messages.back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <!-- <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                    {{ __('messages.email_verification') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div id="guardian_details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="mother" value="Seyon"  name="verify_email" value="mother" checked="">
                                                <label for="mother"> Mother </label>
                                            </div>
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="father" value="Seyon"  name="verify_email" value="father">
                                                <label for="father"> Father </label>
                                            </div>
                                            <div class="radio radio-success form-check-inline">
                                                <input type="radio" class="verify_email" id="guardian" value="Seyon"  name="verify_email" value="guardian">
                                                <label for="guardian"> Guardian </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr> -->

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')

<script>
    var applicationList = "{{ route('guest.application.list') }}";
    var applicationIndex = "{{ route('guest.application.index') }}";
    var malaysiaPostalCode = "{{ route('guest.malaysia_postalCode') }}";
</script>
<!-- Plugins js-->
<script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-wizard.init.js')}}"></script>
<script src="{{ asset('js/validation/validation.js') }}"></script>


<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<!-- Init js-->
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<script src="{{ asset('js/custom/guest_application.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>

<script>
    // $(".country").countrySelect({
    //     defaultCountry: "my",
    //     preferredCountries: ['my', 'jp'],
    //     responsiveDropdown: true
    // });
    
    function countrySelect(inputSelector,country) {
        $(inputSelector).countrySelect({
            defaultCountry: country,
            preferredCountries: ['my', 'jp'],
            responsiveDropdown: true
        });
    }
    countrySelect('#father_nationality',"jp")
    countrySelect('#mother_nationality',"jp")
    countrySelect('#country',"my")
    countrySelect('#nationality',"jp")
    countrySelect('#dual_nationality',"jp")
    var input = document.querySelector("#mother_phone_number");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#father_phone_number");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#guardian_phone_number");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#guardian_company_phone_number");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
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
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
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

<!-- <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script> -->
<!-- <script src="https://code.jquery.com/jquery.min.js"></script> -->
<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
@endsection