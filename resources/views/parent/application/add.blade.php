@extends('layouts.admin-layout')
@section('title',' ' . __('messages.add_application') . '')
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
                <h4 class="page-title">{{ __('messages.add_application') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="addApplication" method="post" action="{{ route('parent.application.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <!-- <li class="nav-item">
                                <a href="#basic" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Phase 1
                                </a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="#personal" data-toggle="tab" data-tab="info" aria-expanded="true" class="nav-link ">
                                    Phase 2
                                </a>
                            </li> -->
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
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name">{{ __('messages.middle_name') }}</label>
                                                    <input type="text" class="form-control" id="middle_name" name="middle_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @if($form_field['name_furigana'] == 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name_furigana" name="last_name_furigana" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name_furigana">{{ __('messages.middle_name_furigana') }}<span class="text-danger"></span></label>
                                                    <input type="text" class="form-control" id="middle_name_furigana" name="middle_name_furigana" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name_furigana" name="first_name_furigana" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($form_field['name_english'] == 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name_english" name="last_name_english" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                    <input type="text" class="form-control" id="middle_name_english" name="middle_name_english" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name_english" name="first_name_english" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @if($form_field['name_common'] == 0)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="first_name_common">{{ __('messages.first_name_common') }}</label>
                                                        <input type="text" class="form-control" id="first_name_common" name="first_name_common" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="last_name_common">{{ __('messages.last_name_common') }}</label>
                                                        <input type="text" class="form-control" id="last_name_common" name="last_name_common" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- <div class="row"> -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_of_birth">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="date_of_birth">
                                                    </div>
                                                    <label for="date_of_birth" class="error"></label>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="date_of_birth">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-calendar-alt"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                                    <select id="gender" name="gender" class="form-control">
                                                        <option value="">{{ __('messages.select_gender') }}</option>
                                                        <option value="Male">{{ __('messages.male') }}</option>
                                                        <option value="Female">{{ __('messages.female') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- </div>
                                            <div class="row"> -->
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div> -->
                                            @if($form_field['race'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="race">{{ __('messages.race') }}</label>
                                                    <select class="form-control" name="race" id="race">
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
                                                    <label for="religion">{{ __('messages.religion') }}<span class="text-danger">*</span></label>
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
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="blood_group">{{ __('messages.blood_group') }}</label>
                                                    <select id="blood_group" name="blood_group" class="form-control">
                                                        <option value="">{{ __('messages.select_blood_group') }}</option>
                                                        <option>O+</option>
                                                        <option>A+</option>
                                                        <option>B+</option>
                                                        <option>AB+</option>
                                                        <option>O-</option>
                                                        <option>A-</option>
                                                        <option>B-</option>
                                                        <option>AB-</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                            @if($form_field['nationality'] == 0)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nationality">{{ __('messages.nationality') }}<span class="text-danger">*</spa   n></label>
                                                    <input type="text" maxlength="50" id="nationality" class="form-control country" placeholder="{{ __('messages.enter_nationality') }}" name="nationality" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dual_nationality">{{ __('messages.dual_nationality') }}</label>
                                                    <input type="text" maxlength="50" id="dual_nationality" class="form-control country" placeholder="{{ __('messages.dual_nationality') }}" name="dual_nationality" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            @endif
                                        </div><br>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">
                                                {{ __('messages.prev_school_details') }}
                                                <h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_last_attended">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_last_attended" name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="school_country" name="school_country" class="form-control country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_state" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_city" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="school_postal_code" name="school_postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_enrollment_status">{{ __('messages.enrollment_status') }}<span class="text-danger">*</span></label>
                                                    <select id="school_enrollment_status" name="school_enrollment_status" class="form-control">
                                                        <option value="">{{ __('messages.select_enrollment_status') }}</option>
                                                        <option value="Regular class">{{ __('messages.regular_class') }}</option>
                                                        <option value="Special need class">{{ __('messages.special_need_class') }}</option>
                                                        <option value="Regular guidance class">{{ __('messages.regular_guidance_class') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="school_enrollment_status_tendency">{{ __('messages.enrollment_status_tendency') }}<span class="text-danger">*</span></label>
                                                    <select id="school_enrollment_status_tendency" name="school_enrollment_status_tendency" class="form-control">
                                                        <option value="">{{ __('messages.select_enrollment_status') }}</option>
                                                        <option value="Yes">{{ __('messages.yes') }}</option>
                                                        <option value="No">{{ __('messages.no') }}</option>
                                                    </select>
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
                                                <input type="checkbox" class="custom-control-input skip" id="skip_mother_details"  name="skip_mother_details">
                                                <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                                            </div>
                                        </div>
                                        <div id="mother_details">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name"  value="{{ isset($guardian['mother_last_name']) ? $guardian['mother_last_name'] : ''}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name"  value="{{ isset($guardian['mother_middle_name']) ? $guardian['mother_middle_name'] : ''}}" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name" value="{{ isset($guardian['mother_first_name']) ? $guardian['mother_first_name'] : ''}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_furigana"  value="{{ isset($guardian['mother_last_name_furigana']) ? $guardian['mother_last_name_furigana'] : ''}}" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_furigana"  value="{{ isset($guardian['mother_middle_name_furigana']) ? $guardian['mother_middle_name_furigana'] : ''}}" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name_furigana" value="{{ isset($guardian['mother_first_name_furigana']) ? $guardian['mother_first_name_furigana'] : ''}}" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_english"  value="{{ isset($guardian['mother_last_name_english']) ? $guardian['mother_last_name_english'] : ''}}" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_english"  value="{{ isset($guardian['mother_middle_name_english']) ? $guardian['mother_middle_name_english'] : ''}}" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name_english" value="{{ isset($guardian['mother_first_name_english']) ? $guardian['mother_first_name_english'] : ''}}" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form country"  id="mother_nationality" name="mother_nationality" value="{{ isset($guardian['mother_nationality']) ? $guardian['mother_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  mother_form" id="mother_email"  value="{{ isset($guardian['mother_email']) ? $guardian['mother_email'] : ''}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form number_validation" id="mother_phone_number"  value="{{ isset($guardian['mother_phone_number']) ? $guardian['mother_phone_number'] : ''}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="mother_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select  id="mother_occupation" name="mother_occupation" class="form-control copy_parent_info mother_form">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($guardian['mother_occupation']) ? $guardian['mother_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($guardian['mother_occupation']) ? $guardian['mother_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($guardian['mother_occupation']) ? $guardian['mother_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($guardian['mother_occupation']) ? $guardian['mother_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_occupation" name="mother_occupation"  value="{{ isset($guardian['mother_occupation']) ? $guardian['mother_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
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
                                                <input type="checkbox" class="custom-control-input skip" id="skip_father_details" name="skip_father_details"  >
                                                <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                                            </div>
                                        </div>

                                        <div id="father_details" >
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form"  id="father_last_name" value="{{ isset($guardian['father_last_name']) ? $guardian['father_last_name'] : ''}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form"  id="father_middle_name" value="{{ isset($guardian['father_middle_name']) ? $guardian['father_middle_name'] : ''}}" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form"  id="father_first_name" value="{{ isset($guardian['father_first_name']) ? $guardian['father_first_name'] : ''}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana"  value="{{ isset($guardian['father_last_name_furigana']) ? $guardian['father_last_name_furigana'] : ''}}" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana"  value="{{ isset($guardian['father_middle_name_furigana']) ? $guardian['father_middle_name_furigana'] : ''}}" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form"  id="father_first_name_furigana" value="{{ isset($guardian['father_first_name_furigana']) ? $guardian['father_first_name_furigana'] : ''}}" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english"  value="{{ isset($guardian['father_last_name_english']) ? $guardian['father_last_name_english'] : ''}}" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english"  value="{{ isset($guardian['father_middle_name_english']) ? $guardian['father_middle_name_english'] : ''}}" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form"  id="father_first_name_english" value="{{ isset($guardian['father_first_name_english']) ? $guardian['father_first_name_english'] : ''}}" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form country"  id="father_nationality" name="father_nationality" value="{{ isset($guardian['father_nationality']) ? $guardian['father_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  father_form"  id="father_email" value="{{ isset($guardian['father_email']) ? $guardian['father_email'] : ''}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form number_validation"  id="father_phone_number" value="{{ isset($guardian['father_phone_number']) ? $guardian['father_phone_number'] : ''}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="father_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select  id="father_occupation" name="father_occupation" class="form-control">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($guardian['father_occupation']) ? $guardian['father_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($guardian['father_occupation']) ? $guardian['father_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($guardian['father_occupation']) ? $guardian['father_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($guardian['father_occupation']) ? $guardian['father_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control copy_parent_info father_form" id="father_occupation" name="father_occupation"  value="{{ isset($guardian['father_occupation']) ? $guardian['father_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
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
                                    </ul>
                                    <div class="card-body">
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input skip" id="skip_guardian_details" name="skip_guardian_details">
                                                <label class="custom-control-label" for="skip_guardian_details">{{ __('messages.skip_guardian_details') }}</label>
                                            </div>
                                        </div> -->
                                        <div class="row"  style="display:{{ isset($guardian['guardian_email']) ? 'none' : ''}}">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" class="copy_parent" name="copy_parent" id="copy_father" value="father">
                                                        <label for="father"> {{ __('messages.copy_from_father_details') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" class="copy_parent" name="copy_parent" id="copy_mother" value="mother" >
                                                        <label for="mother"> {{ __('messages.copy_from_mother_details') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" class="copy_parent" name="copy_parent" id="copy_others" value="others" checked>
                                                        <label for="others"> {{ __('messages.others') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        
                                        @php
                                        $guardian_readonly = "";
                                        $guardian_disabled = "";
                                        if(isset($guardian['guardian_last_name'])){
                                        $guardian_disabled = "disabled";
                                        $guardian_readonly = "readonly";
                                        }
                                        @endphp
                                        <div id="guardian_details">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_last_name" {{$guardian_readonly}}   value="{{ isset($guardian['guardian_last_name']) ? $guardian['guardian_last_name'] : ''}}"  name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name">{{ __('messages.middle_name') }}</label>
                                                        <input type="text" class="form-control" id="guardian_middle_name"   {{$guardian_readonly}} value="{{ isset($guardian['guardian_middle_name']) ? $guardian['guardian_middle_name'] : ''}}"  name="guardian_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_first_name"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_first_name']) ? $guardian['guardian_first_name'] : ''}}"  name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_last_name_furigana"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_last_name_furigana']) ? $guardian['guardian_last_name_furigana'] : ''}}"  name="guardian_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                                        <input type="text" class="form-control" id="guardian_middle_name_furigana"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_middle_name_furigana']) ? $guardian['guardian_middle_name_furigana'] : ''}}"  name="guardian_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_first_name_furigana"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_first_name_furigana']) ? $guardian['guardian_first_name_furigana'] : ''}}"  name="guardian_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_last_name_english"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_last_name_english']) ? $guardian['guardian_last_name_english'] : ''}}"  name="guardian_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                                        <input type="text" class="form-control" id="guardian_middle_name_english"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_middle_name_english']) ? $guardian['guardian_middle_name_english'] : ''}}"  name="guardian_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_first_name_english"  {{$guardian_readonly}}  value="{{ isset($guardian['guardian_first_name_english']) ? $guardian['guardian_first_name_english'] : ''}}"  name="guardian_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                                        <select id="guardian_relation" {{$guardian_disabled}} name="guardian_relation" class="form-control">
                                                            <option value="">{{ __('messages.select_relation') }}</option>
                                                            @forelse($relation as $r)
                                                            <option value="{{$r['id']}}" {{ isset($guardian['guardian_relation']) ? $guardian['guardian_relation'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    @if($guardian_disabled=="disabled")
                                                    <input type="hidden" name="guardian_relation" value="{{$guardian['guardian_relation']}}">
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_email" readonly value="{{$email}}"  name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  number_validation " {{$guardian_readonly}} id="guardian_phone_number"   value="{{ isset($guardian['guardian_phone_number']) ? $guardian['guardian_phone_number'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="guardian_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_occupation" {{$guardian_readonly}}   value="{{ isset($guardian['guardian_occupation']) ? $guardian['guardian_occupation'] : ''}}" name="guardian_occupation" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_company_name_japan" {{$guardian_readonly}}   value="{{ isset($guardian['guardian_company_name_japan']) ? $guardian['guardian_company_name_japan'] : ''}}" name="guardian_company_name_japan" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="guardian_company_name_local" {{$guardian_readonly}}   value="{{ isset($guardian['guardian_company_name_local']) ? $guardian['guardian_company_name_local'] : ''}}" name="guardian_company_name_local" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control  number_validation " {{$guardian_readonly}} id="guardian_company_phone_number"   value="{{ isset($guardian['guardian_company_phone_number']) ? $guardian['guardian_company_phone_number'] : ''}}" name="guardian_company_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                                        <label for="guardian_company_phone_number" class="error"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
                                                        <select id="guardian_employment_status"  {{$guardian_disabled}} name="guardian_employment_status" class="form-control">
                                                            <option value="">{{ __('messages.select_employment_status') }}</option>
                                                            <option value="Expat" {{ isset($guardian['guardian_employment_status']) ? $guardian['guardian_employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
                                                            <option value="Local Hire" {{ isset($guardian['guardian_employment_status']) ? $guardian['guardian_employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
                                                            <option value="Public Servant" {{ isset($guardian['guardian_employment_status']) ? $guardian['guardian_employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
                                                            <option value="Self-Employed" {{ isset($guardian['guardian_employment_status']) ? $guardian['guardian_employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
                                                        </select>
                                                    </div>
                                                    @if($guardian_disabled=="disabled")
                                                    <input type="hidden" name="guardian_employment_status" value="{{$guardian['guardian_employment_status']}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> <br>
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
                                                    <select id="expected_academic_year" name="expected_academic_year" class="form-control">
                                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                                        @forelse($academic_year_list as $r)
                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_grade">{{ __('messages.expected_grade') }}<span class="text-danger">*</span></label>
                                                    <select id="expected_grade" name="expected_grade" class="form-control">
                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                        @forelse($grade as $g)
                                                        <option value="{{$g['id']}}">{{$g['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
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
                                                        <input type="text" class="form-control" id="expected_enroll_date" name="expected_enroll_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                        
                                                    </div>
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
                                                            <input type="radio" class="re_admission" id="" name="re_admission" value="yes">
                                                            <label for="yes"> {{ __('messages.yes') }} </label>
                                                        </div>
                                                        <div class="radio radio-success form-check-inline">
                                                            <input type="radio" class="re_admission" id="" name="re_admission" value="no" checked>
                                                            <label for="no"> {{ __('messages.no') }} </label>
                                                        </div>
                                                        <!-- <div class="radio radio-success form-check-inline">
                                                            <input type="radio" class="verify_emails" id="" name="verify_emails" value="guardian">
                                                            <label for="guardian"> Guardian </label>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="last_date" style="display:none">
                                                    <div class="form-group">
                                                        <label for="last_date_of_withdrawal">{{ __('messages.last_date_of_withdrawal') }}<span class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <span class="far fa-calendar-alt"></span>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" id="last_date_of_withdrawal" name="last_date_of_withdrawal" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                        </div>
                                                        <label for="last_date_of_withdrawal" class="error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="remarks">{{ __('messages.remarks') }}<span class="text-danger">*</span></label>
                                                    <textarea type="text"  id="remarks" class="form-control" placeholder="{{ __('messages.enter_remarks') }}" name="remarks" data-parsley-trigger="change"></textarea>
                                                </div>
                                            </div>
                                        </div>
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                                <input type="text" maxlength="16" id="txt_nric" class="form-control alloptions" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                <input type="text" maxlength="20" class="form-control alloptions" placeholder="{{ __('messages.enter_passport_number') }}" name="txt_passport">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
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
                                                        <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                                    </div>
                                                </div>
                                                <span id="passport_photo_name"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                                <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
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
                                                        <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                                    </div>
                                                </div>
                                                <span id="visa_photo_name"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- <hr> -->
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.save') }}
                            </button>
                            <a href="{{ route('parent.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                {{ __('messages.back') }}
                            </a>
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
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
    

    $(".country").countrySelect({
        defaultCountry: "jp",
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
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
    var applicationList = "{{ route('parent.application.list') }}";
    var applicationIndex = "{{ route('parent.application.index') }}";
</script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<!-- <script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script> -->
<script src="{{ asset('js/custom/parent_application.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
        }
    });
    
    $("#last_date_of_withdrawal").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        maxDate: 0
    });
</script>
<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
@endsection