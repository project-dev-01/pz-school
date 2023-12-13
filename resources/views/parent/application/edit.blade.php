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

                    <form id="editApplication" method="post" action="{{ route('parent.application.update') }}" enctype="multipart/form-data" autocomplete="off">
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
                        }
                        @endphp
                        <ul class="nav nav-pills navtab-bg nav-justified" style="display:{{$hidden_phase_2}}">
                            <li class="nav-item">
                                <a href="#basic" id="basic_tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                {{ __('messages.phase_1') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#personal" id="personal_tab" data-toggle="tab" data-tab="info" aria-expanded="true" class="nav-link ">
                                {{ __('messages.phase_2') }}
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- start Dashboard -->
                                <div class="tab-pane show active" id="basic">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.student_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="first_name" {{$readonly_phase_1}} value="{{ isset($application['first_name']) ? $application['first_name'] : ''}}" name="first_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="last_name">{{ __('messages.last_name') }}</label>
                                                <input type="text" class="form-control" id="last_name" {{$readonly_phase_1}} value="{{ isset($application['first_name']) ? $application['first_name'] : ''}}" name="last_name" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    @if($form_field['name_english'] == 0)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first_name">{{ __('messages.first_name_english') }}<span class="text-danger"></span></label>
                                                <input type="text" class="form-control" id="first_name_english" {{$readonly_phase_1}} value="{{ isset($application['first_name_english']) ? $application['first_name_english'] : ''}}" name="first_name_english" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="last_name">{{ __('messages.last_name_english') }}</label>
                                                <input type="text" class="form-control" id="last_name_english" {{$readonly_phase_1}} value="{{ isset($application['last_name_english']) ? $application['last_name_english'] : ''}}" name="last_name_english" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['name_furigana'] == 0)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first_name">{{ __('messages.first_name_furigana') }}<span class="text-danger"></span></label>
                                                <input type="text" class="form-control" id="first_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['first_name_furigana']) ? $application['first_name_furigana'] : ''}}" name="first_name_furigana" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="last_name">{{ __('messages.last_name_furigana') }}</label>
                                                <input type="text" class="form-control" id="last_name_furigana" {{$readonly_phase_1}} value="{{ isset($application['last_name_furigana']) ? $application['last_name_furigana'] : ''}}" name="last_name_furigana" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date_of_birth">{{ __('messages.date_of_birth') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="date_of_birth" {{$readonly_phase_1}} value="{{ isset($application['date_of_birth']) ? $application['date_of_birth'] : date('d-m-Y')}}" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('messages.gender') }}</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control number_validation mobile_no" id="mobile_no" {{$readonly_phase_1}} value="{{ isset($application['mobile_no']) ? $application['mobile_no'] : ''}}" name="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_1">{{ __('messages.address_1') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="address_1" {{$readonly_phase_1}} value="{{ isset($application['address_1']) ? $application['address_1'] : ''}}" name="address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_2">{{ __('messages.address_2') }}<br></label>
                                                <input type="text" class="form-control" id="address_2" {{$readonly_phase_1}} value="{{ isset($application['address_2']) ? $application['address_2'] : ''}}" name="address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                <input type="text" maxlength="50" id="country" {{$readonly_phase_1}} class="form-control country" placeholder="{{ __('messages.country') }}" value="{{ isset($application['country']) ? $application['country'] : ''}}" name="country" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="state" {{$readonly_phase_1}} value="{{ isset($application['state']) ? $application['state'] : ''}}" name="state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="city" {{$readonly_phase_1}} value="{{ isset($application['city']) ? $application['city'] : ''}}" name="city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="postal_code" {{$readonly_phase_1}} value="{{ isset($application['postal_code']) ? $application['postal_code'] : ''}}" name="postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email" {{$readonly_phase_1}} value="{{ isset($application['email']) ? $application['email'] : ''}}" name="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
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
                                                <label for="religion">{{ __('messages.religion') }}</label>
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
                                        @if($form_field['blood_group'] == 0)
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
                                        @endif
                                        @if($form_field['nationality'] == 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                <input type="text" maxlength="50" id="nationality" {{$readonly_phase_1}} class="form-control country" placeholder="{{ __('messages.nationality') }}" value="{{ isset($application['nationality']) ? $application['nationality'] : ''}}" name="country" data-parsley-trigger="change">
                                            </div>
                                        </div>

                                    </div>
                                    @endif<br>
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
                                                    <label for="academic_year">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                                    <select {{$disabled_phase_1}} id="academic_year" name="academic_year" class="form-control">
                                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                                        @forelse($academic_year_list as $r)
                                                        <option value="{{$r['id']}}" {{ isset($application['academic_year']) ? $application['academic_year'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="academic_year" value="{{$application['academic_year']}}">
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="academic_grade">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                    <select {{$disabled_phase_1}} id="academic_grade" name="academic_grade" class="form-control">
                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                        @forelse($grade as $g)
                                                        <option value="{{$g['id']}}" {{ isset($application['academic_grade']) ? $application['academic_grade'] == $g['id'] ? 'selected' : '' : '' }}>{{$g['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="academic_grade" value="{{$application['academic_grade']}}">
                                                @endif
                                                </div>
                                            </div>
                                        </div><br>
                                    </div><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.old_school_information') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_year">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                                    <select {{$disabled_phase_1}} id="school_year" name="school_year" class="form-control">
                                                        <option value="">{{ __('messages.select') }} {{ __('messages.select_academic_year') }}</option>
                                                        @forelse($academic_year_list as $r)
                                                        <option value="{{$r['id']}}" {{ isset($application['school_year']) ? $application['school_year'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="school_year" value="{{$application['school_year']}}">
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="grade">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                    <select {{$disabled_phase_1}} id="grade" name="grade" class="form-control">
                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                        @forelse($grade as $g)
                                                        <option value="{{$g['id']}}" {{ isset($application['grade']) ? $application['grade'] == $g['id'] ? 'selected' : '' : '' }}>{{$g['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                @if($disabled_phase_1=="disabled")
                                                <input type="hidden" name="grade" value="{{$application['grade']}}">
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_last_attended">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_last_attended" {{$readonly_phase_1}} value="{{ isset($application['school_last_attended']) ? $application['school_last_attended'] : ''}}" name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="school_country" {{$readonly_phase_1}} value="{{ isset($application['school_country']) ? $application['school_country'] : ''}}" name="school_country" class="form-control country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_state" {{$readonly_phase_1}} value="{{ isset($application['school_state']) ? $application['school_state'] : ''}}" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_city" {{$readonly_phase_1}} value="{{ isset($application['school_city']) ? $application['school_city'] : ''}}" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_postal_code" {{$readonly_phase_1}} value="{{ isset($application['school_postal_code']) ? $application['school_postal_code'] : ''}}" name="school_postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
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
                                                <input type="checkbox" class="custom-control-input skip" id="skip_mother_details" name="skip_mother_details" {{ $application['mother_first_name'] ? "" : 'checked'}}>
                                                <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                                            </div>
                                        </div>
                                        <div id="mother_details" style="display: {{ $application['mother_first_name'] ? '' : 'none' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="mother_first_name" value="{{ isset($application['mother_first_name']) ? $application['mother_first_name'] : ''}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name">{{ __('messages.last_name') }}</label>
                                                        <input type="text" class="form-control" id="mother_last_name" {{$readonly_phase_1}} value="{{ isset($application['mother_last_name']) ? $application['mother_last_name'] : ''}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="mother_email" {{$readonly_phase_1}} value="{{ isset($application['mother_email']) ? $application['mother_email'] : ''}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="mother_phone_number" {{$readonly_phase_1}} value="{{ isset($application['mother_phone_number']) ? $application['mother_phone_number'] : ''}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select {{$disabled_phase_1}} id="mother_occupation" name="mother_occupation" class="form-control">
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
                                                <input type="checkbox" class="custom-control-input skip" id="skip_father_details" name="skip_father_details" {{ $application['father_first_name'] ? "" : 'checked'}}>
                                                <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                                            </div>
                                        </div>

                                        <div id="father_details" style="display: {{ $application['father_first_name'] ? '' : 'none' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="father_first_name" value="{{ isset($application['father_first_name']) ? $application['father_first_name'] : ''}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name">{{ __('messages.last_name') }}</label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="father_last_name" value="{{ isset($application['father_last_name']) ? $application['father_last_name'] : ''}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="father_email" value="{{ isset($application['father_email']) ? $application['father_email'] : ''}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="father_phone_number" value="{{ isset($application['father_phone_number']) ? $application['father_phone_number'] : ''}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_guardian_details" name="skip_guardian_details" {{ $application['guardian_first_name'] ? "" : "checked" }}>
                                                <label class="custom-control-label" for="skip_guardian_details">{{ __('messages.skip_guardian_details') }}</label>
                                            </div>
                                        </div>

                                        <div id="guardian_details" style="display: {{ $application['guardian_first_name'] ? '' : 'none' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_first_name" value="{{ isset($application['guardian_first_name']) ? $application['guardian_first_name'] : ''}}" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name">{{ __('messages.last_name') }}</label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_last_name" value="{{ isset($application['guardian_last_name']) ? $application['guardian_last_name'] : ''}}" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
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
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_email" value="{{ isset($application['guardian_email']) ? $application['guardian_email'] : ''}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" {{$readonly_phase_1}} id="guardian_phone_number" value="{{ isset($application['guardian_phone_number']) ? $application['guardian_phone_number'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                                </div>
                                            </div>
                                        </div>
                                        <br>
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
                                            <input type="hidden" name="phase_1_status" value="{{$application['status']}}">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phase_1_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                                    <select id="phase_1_status" name="status" class="form-control" disabled>
                                                        <option value="">{{ __('messages.status') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Applied" ? 'selected' : '' : '' }}>{{ __('messages.applied') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Approved" ? 'selected' : '' : '' }}>{{ __('messages.approved') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Send Back" ? 'selected' : '' : '' }}>{{ __('messages.send_back') }}</option>
                                                        <option {{ isset($application['status']) ? $application['status'] == "Reject" ? 'selected' : '' : '' }}>{{ __('messages.reject') }}</option>
                                                    </select>   
                                                </div>
                                            </div>
                                            @php 
                                            
                                            $phase_1_reason =  "none";
                                            if($application['status']=="Reject" || $application['status']=="Send Back"){

                                                $phase_1_reason =  "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="reason_1" style="display:{{$phase_1_reason}}">
                                                <div class="form-group">
                                                    <label for="phase_1_reason">{{ __('messages.reason') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="phase_1_reason" readonly value="{{ isset($application['phase_1_reason']) ? $application['phase_1_reason'] : ''}}" name="phase_1_reason" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            @php
                                            $enrollment = "none";
                                            if($application['enrollment'])
                                            {
                                            $enrollment = "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="enrollment_show" style="display:{{$enrollment}}">
                                                <div class="form-group">
                                                    <label for="enrollment">{{ __('messages.enrollment') }}<span class="text-danger">*</span></label>
                                                    <select id="enrollment" name="enrollment" class="form-control" disabled>
                                                        <option value="">{{ __('messages.select_enrollment') }}</option>
                                                        <option {{ isset($application['enrollment']) ? $application['enrollment'] == "Trail Enrollment" ? 'selected' : '' : '' }}>{{ __('messages.trail_enrollment') }}</option>
                                                        <option {{ isset($application['enrollment']) ? $application['enrollment'] == "Official Enrollment" ? 'selected' : '' : '' }}>{{ __('messages.official_enrollment') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="enrollment"  value="{{$application['enrollment']}}">
                                            @php
                                            $trail_date = "none";
                                            if($application['enrollment']=="Trail Enrollment") {
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
                                                        <input type="text" readonly class="form-control" id="trail_date" value="2023-12-10" name="trail_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
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
                                        <button class="btn btn-primary-bl waves-effect waves-light" id="submit" type="submit">
                                            {{ __('messages.update') }}
                                        </button>
                                        @endif
                                        <a href="{{ route('admin.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                            {{ __('messages.back') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="personal">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.personal_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="row">
                                        @if($form_field['nric'] == 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nric">{{ __('messages.nric_number') }}</label>
                                                <input type="text" maxlength="16" id="nric" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($application['nric']) ? $application['nric'] : ''}}" name="nric" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        @endif
                                        @if($form_field['passport'] == 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="passport">{{ __('messages.passport_number') }}</label>
                                                <input type="text" maxlength="20" class="form-control alloptions" id="passport" placeholder="{{ __('messages.enter_passport_number') }}" value="{{ isset($application['passport']) ? $application['passport'] : ''}}" name="passport">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="passport_expiry_date">{{ __('messages.passport_expiry_date') }}<span class="text-danger"></span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" id="passport_expiry_date" value="{{ isset($application['passport_expiry_date']) ? $application['passport_expiry_date'] : date('d-m-Y')}}" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($application['passport_photo']) ? $application['passport_photo'] : ''}}" />

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="passport_photo">{{ __('messages.passport_photo') }}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                                        <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                                    </div>
                                                </div>
                                                @if(isset($application['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_photo'])
                                                <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['passport_photo'] }}" target="_blank"> {{ __('messages.passport_photo') }} </a>
                                                @endif
                                                <span id="passport_photo_name"></span>
                                            </div>
                                        </div>
                                        @endif
                                        @if($form_field['visa'] == 0)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                                <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" value="{{ isset($application['visa_number']) ? $application['visa_number'] : ''}}" name="visa_number" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="visa_expiry_date">{{ __('messages.visa_expiry_date') }}<span class="text-danger"></span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" id="visa_expiry_date" value="{{ isset($application['visa_expiry_date']) ? $application['visa_expiry_date'] : date('d-m-Y')}}" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($application['visa_photo']) ? $application['visa_photo'] : ''}}" />

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="visa_photo">{{ __('messages.visa_photo') }}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="visa_photo" class="custom-file-input" value="" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                                        <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                                    </div>
                                                </div>
                                                @if(isset($application['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_photo'])
                                                <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$application['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                                @endif
                                                <span id="visa_photo_name"></span>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phase_2_status">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                                <select id="phase_2_status" name="phase_2_status" class="form-control">
                                                    <option value="">{{ __('messages.select_status') }}</option>
                                                    
                                                    <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Process" ? 'selected' : '' : '' }}>{{ __('messages.process') }}</option>
                                                    <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Approved" ? 'selected' : '' : '' }} disabled>{{ __('messages.approved') }}</option>
                                                        <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Send Back" ? 'selected' : '' : '' }} disabled>{{ __('messages.send_back') }}</option>
                                                    <option {{ isset($application['phase_2_status']) ? $application['phase_2_status'] == "Reject" ? 'selected' : '' : '' }} disabled>{{ __('messages.reject') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                            @php
                                            $phase_2_reason =  "none";
                                            if($application['phase_2_status']=="Reject" || $application['phase_2_status']=="Send Back"){

                                                $phase_2_reason =  "";
                                            }
                                            @endphp
                                            <div class="col-md-4" id="reason_2" style="display:{{$phase_2_reason}}">
                                                <div class="form-group">
                                                    <label for="phase_2_reason">{{ __('messages.reason') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="phase_2_reason" readonly value="{{ isset($application['phase_2_reason']) ? $application['phase_2_reason'] : ''}}" name="phase_2_reason" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary-bl waves-effect waves-light" id="submit" type="submit">
                                            {{ __('messages.update') }}
                                        </button>
                                        <a href="{{ route('parent.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
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
    var applicationList = "{{ route('parent.application.list') }}";
    var applicationIndex = "{{ route('parent.application.index') }}";
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
<script src="{{ asset('js/custom/parent_application.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>

<script>
    var input = document.querySelector(".mobile_no");
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
        preferredCountries: ['my', 'jp'],
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
<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
@endsection