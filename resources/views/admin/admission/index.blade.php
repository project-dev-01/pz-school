@extends('layouts.admin-layout')
@section('title',' ' . __('messages.admission') . '')
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
                        <h4 class="page-title">{{ __('messages.student_admission') }}</h4>
                    </div>
                </div>
                <!-- <div class="col-md-6 pt-2">
                    <div class="form-group">
                        <input type="hidden" name="student_id" id="student_id">
                        <select class="form-control select2" data-toggle="select2" id="application_id" name="application_id" data-placeholder="{{ __('messages.application_list') }}">
                            <option value="">{{ __('messages.application_list') }}</option>
                            @forelse($application as $app)
                            <option value="{{$app['id']}}">{{$app['first_name']}} {{$app['last_name']}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <form id="addadmission" method="post" action="{{ route('admin.admission.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <input type="hidden" name="sudent_application_id" id="sudent_application_id">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.student_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="file" class="dropify-im" name="photo" id="photo" data-max-file-size="2M" data-plugins="dropify" data-default-file="{{ config('constants.image_url').'/common-asset/images/700x500.png' }}" />
                                        <p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.middle_name') }}</label>
                                    <input type="text" name="mname" class="form-control alloptions" maxlength="50" id="mname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                        </div>
                        @if($form_field['name_english'] == 0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name_english" class="form-control alloptions" maxlength="50" id="last_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.middle_name_roma') }}</label>
                                    <input type="text" name="middle_name_english" class="form-control alloptions" maxlength="50" id="middle_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name_english" class="form-control alloptions" maxlength="50" id="first_name_english" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>

                        </div>
                        @endif
                        @if($form_field['name_furigana'] == 0)
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name_furigana" class="form-control alloptions" maxlength="50" id="last_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.middle_name_furigana') }}</label>
                                    <input type="text" name="middle_name_furigana" class="form-control alloptions" maxlength="50" id="middle_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name_furigana" class="form-control alloptions" maxlength="50" id="first_name_furigana" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>

                        </div>
                        @endif

                        <div class="row">
                            @if($form_field['name_common'] == 0)
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.last_name_common') }}</label>
                                    <input type="text" name="last_name_common" class="form-control alloptions" maxlength="50" id="last_name_common" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
                                   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.first_name_common') }}</label>
                                   
                                        <input type="text" name="first_name_common" class="form-control alloptions" maxlength="50" id="first_name_common" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
                                   
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="dob">{{ __('messages.date_of_birth') }}<span class="text-danger">*</span></label>
                                    
                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                        </div>


                        <div class="row">

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number_validation" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_unit_no">{{ __('messages.address_unit_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="255" id="address_unit_no" class="form-control alloptions" placeholder="{{ __('messages.enter_address_unit_no') }}" name="address_unit_no" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_condominium">{{ __('messages.address_condominium') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address_condominium" name="address_condominium" placeholder="{{ __('messages.enter_address_condominium') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_street">{{ __('messages.address_street') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address_street" name="address_street" placeholder="{{ __('messages.enter_address_street') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_district">{{ __('messages.address_district') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address_district" value="{{ isset($application['address_district']) ? $application['address_district'] : ''}}" name="address_district" placeholder="{{ __('messages.enter_address_district') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="{{ __('messages.state_province') }}" name="drp_state" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="drp_country" class="form-control country" placeholder="{{ __('messages.country') }}" name="drp_country" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="drp_post_code">{{ __('messages.zip_postal_code') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change">
                                </div>
                            </div>
                            @if($form_field['race'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_caste">{{ __('messages.race') }}</label>
                                    <select class="form-control" name="txt_race" id="addRace">
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
                                    <label for="txt_religion">{{ __('messages.religion') }}</label>
                                    <select class="form-control" name="txt_religion" id="religion">
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
                                    <label for="nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="nationality" class="form-control country" placeholder="{{ __('messages.nationality') }}" name="nationality" data-parsley-trigger="change">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox" style="margin-top: 2.25rem;">
                                                        
                                                        <input type="checkbox" name="has_dual_nationality_checkbox" id="has_dual_nationality_checkbox" class="custom-control-input">
                                                        <label class="custom-control-label"  for="has_dual_nationality_checkbox">{{ __('messages.dual_nationality') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4"  id="dual_nationality_container" style="display:none">
                                                <div class="form-group">
                                                    <label for="dual_nationality">{{ __('messages.dual_nationality') }}</label>
                                                    <input type="text" maxlength="50" id="dual_nationality" class="form-control country" placeholder="{{ __('messages.dual_nationality') }}" name="dual_nationality" data-parsley-trigger="change">
                                                </div>
                                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($form_field['blood_group'] == 0)
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                    <select id="blooddgrp" name="blooddgrp" class="form-control">
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
                            @endif
                            @if($form_field['nric'] == 0)
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                    <input type="text" maxlength="16" id="txt_nric" class="form-control alloptions" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">
                                </div>
                            </div> -->
                            @endif
                            @if($form_field['passport'] == 0)
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                    <input type="text" maxlength="20" class="form-control alloptions" placeholder="{{ __('messages.enter_passport_number') }}" name="txt_passport">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
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
                            </div> -->
                            <!-- <div class="col-md-4">
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
                            </div> -->
                            @endif
                            @if($form_field['visa'] == 0)
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                    <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" data-parsley-trigger="change">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
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
                            </div> -->
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.previous_school_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_prev_schname">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="txt_prev_schname" placeholder="{{ __('messages.enter_school_name') }}" class="form-control alloptions" name="txt_prev_schname" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" id="school_country" value="{{ isset($application['school_country']) ? $application['school_country'] : ''}}" name="school_country" class="form-control country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_state">{{ __('messages.state_province') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="school_state" value="{{ isset($application['school_state']) ? $application['school_state'] : ''}}" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="school_city" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.city') }}" aria-describedby="inputGroupPrepend">
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
                                    <!-- <input type="text" class="form-control" id="school_enrollment_status" name="school_enrollment_status" placeholder="{{ __('messages.enter_enrollment_status') }}" aria-describedby="inputGroupPrepend"> -->
                                    <select id="school_enrollment_status"  name="school_enrollment_status" class="form-control ">
                                        <option value="">{{ __('messages.select_enrollment_status') }}</option>
                                        <option value="Regular class" >{{ __('messages.regular_class') }}</option>
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
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_prev_qualify">{{ __('messages.qualification') }}</label>
                                    <input type="text" maxlength="50" id="txt_prev_qualify" placeholder="{{ __('messages.enter_qualification') }}" class="form-control alloptions" name="txt_prev_qualify" data-parsley-trigger="change">
                                </div>
                            </div> -->
                        </div>


                    </div> <!-- end card-body -->
                </div> <!-- end card-->

                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.academic_details') }}</h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_regiter_no">{{ __('messages.register_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="{{ __('messages.enter_register_no') }}" data-parsley-trigger="change">
                                </div>
                            </div> -->
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="department_id" name="department_id" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                           
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.expected_grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                      <option value="">{{ __('messages.select_grade') }}</option>
                                                        @forelse($class as $g)
                                                        <option value="{{$g['id']}}">{{$g['name']}}</option>
                                                        @empty
                                                        @endforelse
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_roll_no">{{ __('messages.attendance_no') }}</label>
                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="{{ __('messages.enter_attendance_no') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="text">{{ __('messages.admission_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div><label for="admission_date" class="error"></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>

                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.personal_details') }}
                                <h4>
                        </li>
                    </ul><br>
                    <div class="card-body">
                        <div class="row">
                        @if($form_field['passport'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport_photo">{{ __('messages.passport_image_japan') }}<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                        </div>
                                    </div>
                                    <span id="passport_photo_name"></span>
                                    <label for="passport_photo" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport">{{ __('messages.passport_number_japan') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="20" class="form-control alloptions" id="passport" placeholder="{{ __('messages.enter_passport_number') }}" name="passport">
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
                                        <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <label for="passport_expiry_date" class="error"></label>
                                </div>
                            </div>
                           
                            @endif
                            @if($form_field['visa'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_photo">{{ __('messages.visa_image__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="visa_photo" class="custom-file-input" value="" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                        </div>
                                    </div>
                                    <span id="visa_photo_name"></span>
                                    <label for="visa_photo" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_type">{{ __('messages.visa_type__for_non_malaysian') }}<span class="text-danger">*</span></label>
                                    <select id="visa_type" name="visa_type" class="form-control">
                                        <option value="">{{ __('messages.select_visa_type') }}</option>
                                        <option value="No Require (Malaysian)">{{ __('messages.no_require_malaysian') }}</option>
                                        <option value="Depedent Pass">{{ __('messages.depedent_pass') }}</option>
                                        <option value="MM2H">{{ __('messages.mm2h') }}</option>
                                        <option value="Resident Pass">{{ __('messages.resident_pass') }}</option>
                                        <option value="Others">{{ __('messages.others') }}</option>
                                    </select>
                                </div>
                            </div>

                            @endif

                            <div class="col-md-4" id="visa_type_others_show">

                                <div class="form-group">
                                    <label for="visa_type_others">{{ __('messages.visa_type_others') }}</label>
                                    <input type="text" id="visa_type_others" class="form-control" placeholder="{{ __('messages.enter_visa_type_others') }}" name="visa_type_others" data-parsley-trigger="change">
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
                                        <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <label for="visa_expiry_date" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="japanese_association_membership_number_student">{{ __('messages.japanese_association_membership_number_student') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="14" id="japanese_association_membership_number_student" class="form-control alloptions" placeholder="999999-99-9999" name="japanese_association_membership_number_student">
                                </div>
                            </div>

                           
                            @if($form_field['nric'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric">{{ __('messages.nric_number_only_for_malaysian') }}</label>
                                    <input type="text" maxlength="16" id="nric" class="form-control alloptions" placeholder="999999-99-9999" name="nric" data-parsley-trigger="change">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_photo">{{ __('messages.nric_image_only_for_malaysian') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="nric_photo" class="custom-file-input" name="nric_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="nric_photo">{{ __('messages.choose_file') }}</label>
                                        </div>
                                    </div>
                                    <span id="nric_photo_name"></span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.student_login_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                        </div>
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
                                        <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
                                    </div><label for="txt_emailid" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" name="txt_pwd" class="form-control" id="txt_pwd" placeholder="********" aria-describedby="inputGroupPrepend">
                                    </div>  <label for="txt_pwd" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" name="txt_retype_pwd" class="form-control" id="txt_retype_pwd" placeholder="*********" aria-describedby="inputGroupPrepend">
                                    </div><label for="txt_retype_pwd" class="error"></label>
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
                            <h4 class="navv">{{ __('messages.guardian_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guardian_name">{{ __('messages.guardian_name') }}</label>
                                    <input type="text" class="form-control" id="guardian_name" placeholder="{{ __('messages.yamamoto') }} {{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                    <div id="guardian_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="relation">{{ __('messages.relation') }}</label>
                                    <select class="form-control" name="relation" id="guardian_relation">
                                        <option value="">{{ __('messages.select_relation') }}</option>
                                        @forelse($relation as $r)
                                        <option value="{{$r['id']}}" data-parent-id="{{$r['parent']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3" id="guardian_photo" style="display:none;">

                            </div>
                        </div>
                        <div id="guardian_form" style="display:none;">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.last_name') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" maxlength="50" id="guardian_last_name" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name" name="guardian_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" maxlength="50" id="guardian_first_name"  name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">{{ __('messages.gender') }}</label>
                                        <select class="form-control" id="guardian_gender" disabled>
                                            <option value="">{{ __('messages.select_gender') }}</option>
                                            <option value="Male">{{ __('messages.male') }}</option>
                                            <option value="Female">{{ __('messages.female') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">{{ __('messages.date_of_birth') }}</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="guardian_date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" readonly>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">{{ __('messages.passport_number') }}</label>
                                        <input type="text" class="form-control" id="guardian_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                    </div>
                                </div> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_last_name_furigana" name="guardian_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name_furigana" name="guardian_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_first_name_furigana" name="guardian_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_last_name_english" name="guardian_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name_english" name="guardian_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_first_name_english" name="guardian_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.nric_number') }}</label>
                                        <input type="text" maxlength="50" id="guardian_nric" class="form-control" placeholder="{{ __('messages.select_blood_group') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                        <select class="form-control" id="guardian_blooddgrp" disabled>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control copy_guardian_info" id="guardian_email" name="guardian_email" placeholder="xxxxx@gmail.com" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation copy_guardian_info" id="guardian_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change" readonly>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="guardian_occupation" class="form-control copy_guardian_info" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_company_name_japan" name="guardian_company_name_japan" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_company_name_local" name="guardian_company_name_local" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info number_validation " id="guardian_company_phone_number" name="guardian_company_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend" readonly>
                                        <label for="guardian_company_phone_number" class="error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
                                        <select id="guardian_employment_status" name="guardian_employment_status" class="form-control copy_guardian_info" readonly>
                                            <option value="">{{ __('messages.select_employment_status') }}</option>
                                            <option value="Expat">{{ __('messages.expat') }}</option>
                                            <option value="Local Hire">{{ __('messages.local_hire') }}</option>
                                            <option value="Public Servant">{{ __('messages.public_servant') }}</option>
                                            <option value="Self-Employed">{{ __('messages.self_employed') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">{{ __('messages.education') }}</label>
                                        <input type="text" class="form-control" data-parsley-trigger="change" id="guardian_education" placeholder="{{ __('messages.enter_education_name') }}" readonly>
                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">{{ __('messages.income') }}</label>
                                        <input type="text" maxlength="50" id="guardian_income" class="form-control" placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{{ __('messages.country') }}</label>
                                        <input type="text" class="form-control" id="guardian_country" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.state_province') }}</label>
                                        <input type="text" class="form-control" maxlength="50" id="guardian_state" placeholder=">{{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.city') }}</label>
                                        <input type="text" class="form-control" maxlength="50" id="guardian_city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_post_code">{{ __('messages.zip_postal_code') }}</label>
                                        <input type="text" class="form-control" id="guardian_post_code" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="guardian_address">{{ __('messages.address_1') }}</label>
                                        <input type="text" class="form-control" id="guardian_address" readonly>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="guardian_address_2">{{ __('messages.address_2') }}</label>
                                        <input type="text" class="form-control" id="guardian_address_2" readonly>
                                        </textarea>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.father_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input skip" id="skip_father_details"  name="skip_father_details" >
                                    <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="father_name">{{ __('messages.father_name') }}</label>
                                    <input type="text" class="form-control" id="father_name" placeholder="{{ __('messages.yamamoto') }} {{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                   
                                    <div id="father_list">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4" id="father_photo" style="display:none;">

                            </div>
                        </div>
                        <div id="father_form">
                        <input type="hidden" name="father_id" id="father_id">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control father_form" maxlength="50" id="father_last_name" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control father_form" maxlength="50" id="father_first_name" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_furigana" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_english" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">{{ __('messages.gender') }}</label>
                                        <select class="form-control" id="father_gender" disabled>
                                            <option value="">{{ __('messages.select_gender') }}</option>
                                            <option value="Male">{{ __('messages.male') }}</option>
                                            <option value="Female">{{ __('messages.female') }}</option>
                                        </select>
                                    </div>
                                </div> -->
                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">{{ __('messages.date_of_birth') }}/label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-birthday-cake"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="father_date_of_birth" readonly>
                                            </div>
                                    </div>
                                </div> -->

                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">{{ __('messages.passport_number') }}</label>
                                        <input type="text" class="form-control" id="father_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                    </div>
                                </div> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form country" id="father_nationality" name="father_nationality" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        
                                            <input type="text" class="form-control copy_parent_info father_form " placeholder="{{ __('messages.enter_your_email') }}" id="father_email"  name="father_email">
                                       
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.nric_number') }}</label>
                                        <input type="text" maxlength="50" id="father_nric" class="form-control" placeholder="{{ __('messages.enter_nric_number') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                        <select class="form-control" id="father_blooddgrp" disabled>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation copy_parent_info father_form "  placeholder="(XXX)-(XXX)-(XXXX)" id="father_mobile_no" name="father_mobile_no" data-parsley-trigger="change" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">{{ __('messages.education') }}</label>
                                        <input type="text" class="form-control" data-parsley-trigger="change" placeholder="{{ __('messages.enter_education_name') }}" id="father_education" readonly>
                                    </div>
                                </div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="father_occupation" name="father_occupation" class="form-control copy_parent_info father_form" placeholder="Manager" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">{{ __('messages.income') }}</label>
                                        <input type="text" maxlength="50" id="father_income" class="form-control " placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{{ __('messages.country') }}</label>
                                        <input type="text" class="form-control" id="father_country" placeholder="Country" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.state_province') }}</label>
                                        <input type="text" class="form-control " maxlength="50" id="father_state" placeholder="{{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.city') }}</label>
                                        <input type="text" class="form-control " maxlength="50" id="father_city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_post_code">{{ __('messages.zip_postal_code') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('messages.zip_postal_code') }}" id="father_post_code" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="father_address">{{ __('messages.address_1') }}</label>
                                        <input type="text" class="form-control" id="father_address" placeholder="{{ __('messages.enter_address_1') }}" readonly>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="father_address_2">{{ __('messages.address_2') }}</label>
                                        <input type="text" class="form-control" id="father_address_2" placeholder="{{ __('messages.enter_address_2') }}" readonly>
                                        </textarea>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.mother_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input skip" id="skip_mother_details"  name="skip_mother_details" >
                                    <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mother_name">{{ __('messages.mother_name') }}</label>
                                    <input type="text" class="form-control" id="mother_name" placeholder="{{ __('messages.sato') }} {{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" >
                                    
                                    <div id="mother_list">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-4" id="mother_photo" style="display:none;">

                            </div>
                        </div>
                        <div id="mother_form">
                        <input type="hidden" name="mother_id" id="mother_id">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_last_name" name="mother_last_name"placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_first_name" name="mother_first_name" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">{{ __('messages.gender') }}</label>
                                        <select class="form-control" id="mother_gender" disabled>
                                            <option value="">{{ __('messages.select_gender') }}</option>
                                            <option value="Male">{{ __('messages.male') }}</option>
                                            <option value="Female">{{ __('messages.female') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">{{ __('messages.date_of_birth') }}</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="mother_date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" readonly>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_furigana" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_furigana" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_furigana" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_english" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_english" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_english" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Passport">{{ __('messages.passport_number') }}</label>
                                        <input type="text" class="form-control" id="mother_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                    </div>
                                </div> -->

                            <div class="row">
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="heard">{{ __('messages.nric_number') }}</label>
                                        <input type="text" maxlength="50" id="mother_nric" class="form-control" placeholder="{{ __('messages.enter_nric_number') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                        <select class="form-control" id="mother_blooddgrp" disabled>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form country" id="mother_nationality" name="mother_nationality" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                     
                                            <input type="text" class="form-control" placeholder="{{ __('messages.enter_the_email') }}" id="mother_email" name="mother_email">
                                       
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation copy_parent_info mother_form "  placeholder="(XXX)-(XXX)-(XXXX)" id="mother_mobile_no" name="mother_mobile_no" data-parsley-trigger="change">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">{{ __('messages.education') }}</label>
                                        <input type="text" class="form-control" data-parsley-trigger="change" placeholder="{{ __('messages.enter_education_name') }}" id="mother_education" readonly>
                                    </div>
                                </div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" maxlength="50" id="mother_occupation"  name="mother_occupation" class="form-control" placeholder="Developer" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change" >
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txt_income">{{ __('messages.income') }}</label>
                                        <input type="text" maxlength="50" id="mother_income" class="form-control" placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{{ __('messages.country') }}</label>
                                        <input type="text" class="form-control" id="mother_country" data-parsley-trigger="change" placeholder="Country" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.state_province') }}</label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_state" placeholder="{{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="validationCustomUsername">{{ __('messages.city') }}</label>
                                        <input type="text" class="form-control" maxlength="50" id="mother_city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_post_code">{{ __('messages.zip_postal_code') }}</label>
                                        <input type="text" class="form-control" id="mother_post_code" placeholder="{{ __('messages.zip_postal_code') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="mother_address">{{ __('messages.address_1') }}</label>
                                        <input type="text" class="form-control" id="mother_address" placeholder="{{ __('messages.enter_address_1') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="mother_address_2">{{ __('messages.address_2') }}</label>
                                        <input type="text" class="form-control" id="mother_address_2" placeholder="{{ __('messages.enter_address_2') }}" readonly>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                    </div>
                </div>
              
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="message">{{ __('messages.remarks') }}</label>
                            <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                            </textarea>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.transport_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_transport_route">{{ __('messages.transport_route') }}</label>

                                    <select id="drp_transport_route" name="drp_transport_route" class="form-control">
                                        <option value="0">{{ __('messages.select_transport') }}</option>
                                        @forelse($transport as $trans)
                                        <option value="{{$trans['id']}}">{{$trans['name']}}</option>

                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_transport_vechicleno">{{ __('messages.vehicle_number') }}</label>
                                    <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                        <option value="0">{{ __('messages.select_vehicle_number') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.hostel_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_hostelnam">{{ __('messages.hostel_name') }}</label>
                                    <select id="drp_hostelnam" name="drp_hostelnam" class="form-control">
                                        <option value="0">{{ __('messages.select_hostel_name') }}</option>
                                        @forelse($hostel as $hos)
                                        <option value="{{$hos['id']}}">{{$hos['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="drp_roomname">{{ __('messages.room_name') }}</label>
                                    <select id="drp_roomname" name="drp_roomname" class="form-control">
                                        <option value="0">{{ __('messages.select_room_name') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                        {{ __('messages.save') }}
                    </button>
                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
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
    
    function countrySelect(inputSelector,country) {
        $(inputSelector).countrySelect({
            defaultCountry: country,
            preferredCountries: ['my', 'jp'],
            responsiveDropdown: true
        });
    }
    countrySelect('#father_nationality',"jp")
    countrySelect('#mother_nationality',"jp")
    countrySelect('#drp_country',"my")
    countrySelect('#nationality',"jp")
    countrySelect('#dual_nationality',"jp")

    // $(".country").countrySelect({
    //     defaultCountry: "jp",
    //     preferredCountries: ['my', 'jp'],
    //     responsiveDropdown: true
    // });
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
        initialCountry: "jp",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#guardian_mobile_no");
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
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#father_mobile_no");
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
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });
    var input = document.querySelector("#mother_mobile_no");
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
        //preferredCountries: ['cn', 'jp'],
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
    var malaysiaPostalCode = "{{ route('admin.malaysia_postalCode') }}";
</script>

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<!-- <script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script> -->
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