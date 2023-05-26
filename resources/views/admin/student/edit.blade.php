@extends('layouts.admin-layout')
@section('title','Edit Student')
@section('component_css')
<link href="{{ asset('public/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('public/country/css/countrySelect.css') }}">
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
                <h4 class="page-title">{{ __('messages.student_profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-xl-3">
                        @if($student['photo'])
                        <img src="{{ config('constants.image_url') }}/public/{{ config('constants.branch_id') }}/users/images/{{$student['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                        <img src="{{ config('constants.image_url') }}/public/{{ config('constants.branch_id') }}/images/users/default.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                        @endif

                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">
                            <h1 class="mb-3">{{$student['first_name']}} {{$student['last_name']}}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div>
                                            <!-- <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-users"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset"></a></h5>
                                            </div>
                                        </div> -->
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-birthday-cake"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$student['birthday']}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-school"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$student['class_name']}} ({{$student['section_name']}})</a>
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-phone-volume"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$student['mobile_no']}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="far fa-envelope"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$student['email']}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-home"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$student['current_address']}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div><!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#basic_detail" role="button" aria-expanded="false" aria-controls="basic_detail"><i class="fas fa-user-edit"></i> {{ __('messages.student_information') }}</span>
                        </div>
                        <div class="col-lg-4">
                            <!-- <div class="text-lg-right mt-3 mt-lg-0">
                                    <button type="button" class="btn btn-white btn-rounded waves-effect waves-light mr-1"><i class="fas fa-lock mr-1"></i> Authentication</button>
                            </div> -->
                        </div><!-- end col-->
                    </div> <!-- end row -->
                    <br>
                    <div class="collapse" id="basic_detail">
                        <form id="editadmission" method="post" action="{{ route('admin.student.update') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$student['id']}}">


                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.student_details') }}</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-3">
                                                <div class="mt-3">
                                                    <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $student['photo'] }}" />
                                                    <input type="file" name="photo" id="photo" class="dropify-im" data-max-file-size="2M" data-plugins="dropify" data-default-file="{{ $student['photo'] && config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.$student['photo'] ? config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/'.$student['photo'] : config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}" />
                                                    <p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user-graduate"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="fname" class="form-control" value="{{$student['first_name']}}" id="fname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="">{{ __('messages.last_name') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user-graduate"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lname" class="form-control" id="lname" value="{{$student['last_name']}}" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('messages.gender') }}</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="">{{ __('messages.select_gender') }}</option>
                                                    <option value="Male" {{$student['gender'] == "Male" ? "Selected" : "" }}>{{ __('messages.male') }}</option>
                                                    <option value="Female" {{$student['gender'] == "Female" ? "Selected" : "" }}>{{ __('messages.female') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="">{{ __('messages.date_of_birth') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-birthday-cake"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="dob" class="form-control" value="{{$student['birthday']}}" id="dob" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                                <input type="text" maxlength="20" id="txt_nric" class="form-control alloptions" value="{{$student['nric']}}" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                <input type="text" maxlength="20" class="form-control" name="txt_passport" placeholder="{{ __('messages.enter_passport_number') }}" value="{{$student['passport']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_caste">{{ __('messages.race') }}</label>
                                                <select class="form-control" name="txt_race" id="addRace">
                                                    <option value="">{{ __('messages.select_race') }}</option>
                                                    @forelse($races as $r)
                                                    <option value="{{$r['id']}}" {{$student['race'] == $r['id'] ? "selected" : ""}}>{{$r['races_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_religion">{{ __('messages.religion') }}</label>
                                                <select class="form-control" name="txt_religion" id="religion">
                                                    <option value="">{{ __('messages.select_religion') }}</option>
                                                    @forelse($religion as $r)
                                                    <option value="{{$r['id']}}" {{$student['religion'] == $r['id'] ? "selected" : ""}}>{{$r['religions_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                                <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                    <option value="">{{ __('messages.select_blood_group') }}</option>
                                                    <option {{$student['blood_group'] == "O+" ? "Selected" : "" }}>O+</option>
                                                    <option {{$student['blood_group'] == "A+" ? "Selected" : "" }}>A+</option>
                                                    <option {{$student['blood_group'] == "B+" ? "Selected" : "" }}>B+</option>
                                                    <option {{$student['blood_group'] == "AB+" ? "Selected" : "" }}>AB+</option>
                                                    <option {{$student['blood_group'] == "O-" ? "Selected" : "" }}>O-</option>
                                                    <option {{$student['blood_group'] == "A-" ? "Selected" : "" }}>A-</option>
                                                    <option {{$student['blood_group'] == "B-" ? "Selected" : "" }}>B-</option>
                                                    <option {{$student['blood_group'] == "AB-" ? "Selected" : "" }}>AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txtarea_paddress">{{ __('messages.address_1') }}</label>
                                                <input type="" id="txtarea_paddress" class="form-control" placeholder="{{ __('messages.enter_address_1') }}" name="txtarea_paddress" data-parsley-trigger="change" value="{{$student['current_address']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txtarea_permanent_address">{{ __('messages.address_2') }}</label>
                                                <input type="" id="txtarea_permanent_address" class="form-control" placeholder="{{ __('messages.enter_address_2') }}" name="txtarea_permanent_address" data-parsley-trigger="change" value="{{$student['permanent_address']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_city">{{ __('messages.city') }}</label>
                                                <input type="" id="drp_city" class="form-control" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change" value="{{$student['city']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_post_code">{{ __('messages.zip_postal_code') }}</label>
                                                <input type="" id="drp_post_code" class="form-control" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change" value="{{$student['post_code']}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_state">{{ __('messages.state_province') }}</label>
                                                <input type="" id="drp_state" placeholder="{{ __('messages.state_province') }}" class="form-control" name="drp_state" data-parsley-trigger="change" value="{{$student['state']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="drp_country">{{ __('messages.country') }}</label>
                                                <input type="" id="drp_country" placeholder="{{ __('messages.country') }}" class="form-control" name="drp_country" data-parsley-trigger="change" value="{{$student['country']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control number_validation" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" value="{{$student['mobile_no']}}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.basic_details') }}</h4>
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
                                                    <option value="{{$r['id']}}" {{$student['year'] == $r['id'] ? "Selected" : "" }}>{{$r['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{ __('messages.register_no') }}<span class="text-danger">*</span></label>
                                                <input type="" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="{{ __('messages.enter_register_no') }}" value="{{$student['register_no']}}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">{{ __('messages.roll') }}<span class="text-danger">*</span></label>
                                                <input type="" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="{{ __('messages.enter_roll_no') }}" value="{{$student['roll_no']}}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="">{{ __('messages.admission_date') }}<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-calendar-alt"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" id="admission_date" value="{{$student['admission_date']}}" name="admission_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                <select id="class_id" class="form-control" name="class_id">
                                                    <option value="">{{ __('messages.select_grade') }}</option>
                                                    @foreach($class as $cla)
                                                    <option value="{{$cla['id']}}" {{$student['class_id'] == $cla['id'] ? "Selected" : "" }}>{{$cla['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                                <select id="section_id" class="form-control" name="section_id">
                                                    <option value="">{{ __('messages.select_class') }}</option>
                                                    @foreach($section as $sec)
                                                    <option value="{{$sec['section_id']}}" {{$student['section_id'] == $sec['section_id'] ? "Selected" : "" }}>{{$sec['section_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Category<span class="text-danger">*</span></label>
                                                <select id="categy" name="categy" class="form-control">
                                                    <option value="">Choose the Category</option>
                                                    <option value="1" {{$student['category_id'] == 1 ? "Selected" : "" }}>One</option>
                                                    <option value="2" {{$student['category_id'] == 2 ? "Selected" : "" }}>Two</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                                <select id="session_id" class="form-control" name="session_id">
                                                    <option value="">{{ __('messages.select_session') }}</option>
                                                    @foreach($session as $ses)
                                                    <option value="{{$ses['id']}}" {{$student['session_id'] == $ses['id'] ? "Selected" : "" }}>{{$ses['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="semester_id">{{ __('messages.semester') }}</label>
                                                <select id="semester_id" class="form-control" name="semester_id">
                                                    <option value="0">{{ __('messages.select_semester') }}</option>
                                                    @foreach($semester as $sem)
                                                    <option value="{{$sem['id']}}" {{$student['semester_id'] == $sem['id'] ? "Selected" : "" }}>{{$sem['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-envelope-open"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend" value="{{$student['email']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label class="switch">{{ __('messages.authentication') }}

                                                    <input id="edit_status" name="status" type="checkbox" {{ $student['status'] == "1" ? "checked" : "" }}>
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
                                                <input type="checkbox" class="custom-control-input" name="google2fa_secret_enable" id="google2fa_secret_enable" {{ $role['google2fa_secret_enable'] == "1" ? "checked" : "" }}>
                                                <label class="custom-control-label" for="google2fa_secret_enable">{{ __('messages.enable_two_factor_authentication') }}</label>
                                            </div>
                                        </div>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_name">{{ __('messages.father_name') }}</label>
                                                <input type="text" class="form-control" placeholder="{{ __('messages.john_leo') }}" maxlength="50" id="father_name" aria-describedby="inputGroupPrepend">
                                                <input type="hidden" name="father_id" id="father_id" value="{{$student['father_id']}}">
                                                <div id="father_list">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="father_form" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-4" id="father_photo" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">{{ __('messages.gender') }}</label>
                                                    <select class="form-control" id="father_gender" disabled>
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
                                                        <input type="text" class="form-control" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="father_date_of_birth" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-envelope-open"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="xxxxx@gmail.com" id="father_email" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                    <input type="text" class="form-control" id="father_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.nric_number') }}</label>
                                                    <input type="text" maxlength="50" id="father_nric" class="form-control" placeholder="{{ __('messages.enter_nric_number') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                                    <select class="form-control" id="father_blooddgrp" disabled>
                                                        <option value="">{{ __('messages.blood_group') }}</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-volume"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" placeholder="(XXX)-(XXX)-(XXXX)" id="father_mobile_no" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="education">{{ __('messages.education') }}</label>
                                                    <input type="text" class="form-control" data-parsley-trigger="change" placeholder="{{ __('messages.enter_education_name') }}" id="father_education" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="father_occupation" class="form-control " placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_income">{{ __('messages.income') }}</label>
                                                    <input type="text" maxlength="50" id="father_income" class="form-control " placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country">{{ __('messages.country') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('messages.country') }}" id="father_country" data-parsley-trigger="change" readonly>
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
                                                    <label for="validationCustomUsername"></label>
                                                    <input type="text" class="form-control " maxlength="50" id="father_" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
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
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="father_address_2">{{ __('messages.address_2') }}</label>
                                                    <input type="text" class="form-control" id="father_address_2" placeholder="{{ __('messages.enter_address_2') }}" readonly>
                                                </div>
                                            </div>

                                        </div>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_name">{{ __('messages.mother_name') }}</label>
                                                <input type="text" class="form-control" maxlength="50" id="mother_name" placeholder="{{ __('messages.aisha_mal') }}" aria-describedby="inputGroupPrepend">
                                                <input type="hidden" name="mother_id" id="mother_id" value="{{$student['mother_id']}}">
                                                <div id="mother_list">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="mother_form" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-4" id="mother_photo" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="mother_first_name" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="mother_last_name" placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-envelope-open"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="mother_email" placeholder="xxxxx@gmail.com" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                    <input type="text" class="form-control" id="mother_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-volume"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" placeholder="(XXX)-(XXX)-(XXXX)" id="mother_mobile_no" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="education">{{ __('messages.education') }}</label>
                                                    <input type="text" class="form-control" data-parsley-trigger="change" id="mother_education" placeholder="{{ __('messages.enter_education_name') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="mother_occupation" class="form-control" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_income">{{ __('messages.income') }}</label>
                                                    <input type="text" maxlength="50" id="mother_income" class="form-control" placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country">{{ __('messages.country') }}</label>
                                                    <input type="text" class="form-control" id="mother_country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change" readonly>
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
                                        </div>
                                        <div class="row">
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
                                                    <input type="text" class="form-control" id="mother_address_2" placeholder="{{ __('messages.enter_address_1') }}" readonly>
                                                </div>
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
                                                <input type="text" class="form-control" maxlength="50" id="guardian_name" placeholder="{{ __('messages.amir_shan') }}" aria-describedby="inputGroupPrepend">
                                                <input type="hidden" name="guardian_id" id="guardian_id" value="{{$student['guardian_id']}}">
                                                <div id="guardian_list">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="relation">{{ __('messages.relation') }}</label>
                                                <select class="form-control" name="relation">
                                                    <option value="">{{ __('messages.select_relation') }}</option>
                                                    @forelse($relation as $r)
                                                    <option value="{{$r['id']}}" {{$student['relation'] == $r['id'] ? "selected" : ""}}>{{$r['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="guardian_form" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-3" id="guardian_photo" style="display:none;">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="guardian_first_name" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" maxlength="50" id="guardian_last_name" placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="far fa-envelope-open"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" id="guardian_email" placeholder="xxxxx@gmail.com" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                    <input type="text" class="form-control" id="guardian_passport" placeholder="{{ __('messages.enter_passport_number') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="heard">{{ __('messages.nric_number') }}</label>
                                                    <input type="text" maxlength="50" id="guardian_nric" class="form-control" placeholder="{{ __('messages.enter_nric_number') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-volume"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" id="guardian_mobile_no" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="education">{{ __('messages.education') }}</label>
                                                    <input type="text" class="form-control" data-parsley-trigger="change" id="guardian_education" placeholder="{{ __('messages.enter_education_name') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                    <input type="text" maxlength="50" id="guardian_occupation" class="form-control" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_income">{{ __('messages.income') }}</label>
                                                    <input type="text" maxlength="50" id="guardian_income" class="form-control" placeholder="{{ __('messages.enter_income') }}" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country">{{ __('messages.country') }}</label>
                                                    <input type="text" class="form-control" id="guardian_country" data-parsley-trigger="change" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="validationCustomUsername">{{ __('messages.state_province') }}</label>
                                                    <input type="text" class="form-control" maxlength="50" id="guardian_state" placeholder="{{ __('messages.state_province') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="validationCustomUsername">{{ __('messages.city') }}</label>
                                                    <input type="text" class="form-control" maxlength="50" id="guardian_city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="guardian_post_code">{{ __('messages.zip_postal_code') }}</label>
                                                    <input type="text" class="form-control" id="guardian_post_code" placeholder="{{ __('messages.zip_postal_code') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="guardian_address">{{ __('messages.address_1') }}</label>
                                                    <input type="text" class="form-control" id="guardian_address" placeholder="{{ __('messages.enter_address_1') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="guardian_address_2">{{ __('messages.address_2') }}</label>
                                                    <input type="text" class="form-control" id="guardian_address_2" placeholder="{{ __('messages.enter_address_2') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
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
                                                    @foreach($transport as $trans)
                                                    <option value="{{$trans['id']}}" {{$student['route_id'] == $trans['id'] ? "Selected" : "" }}>{{$trans['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="drp_transport_vechicleno">{{ __('messages.vehicle_number') }}</label>
                                                <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                                    <option value="">{{ __('messages.select_vehicle_number') }}</option>

                                                    @foreach($vehicle as $veh)
                                                    <option value="{{$veh['vehicle_id']}}" {{$student['vehicle_id'] == $veh['vehicle_id'] ? "Selected" : "" }}>{{$veh['vehicle_no']}}</option>
                                                    @endforeach
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
                                                    @foreach($hostel as $hos)
                                                    <option value="{{$hos['id']}}" {{$student['hostel_id'] == $hos['id'] ? "Selected" : "" }}>{{$hos['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="drp_roomname">{{ __('messages.room_name') }}</label>
                                                <select id="drp_roomname" name="drp_roomname" class="form-control">
                                                    <option value="">{{ __('messages.select_room_name') }}</option>

                                                    @foreach($room as $roo)
                                                    <option value="{{$roo['room_id']}}" {{$student['room_id'] == $roo['room_id'] ? "Selected" : "" }}>{{$roo['room_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.previous_school_details') }}</h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="txt_prev_schname">{{ __('messages.school_name') }}</label>
                                                <input type="text" id="txt_prev_schname" class="form-control" name="txt_prev_schname" placeholder="{{ __('messages.enter_school_name') }}" data-parsley-trigger="change" value="{{$student['school_name']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="txt_prev_qualify">{{ __('messages.qualification') }}</label>
                                                <input type="text" id="txt_prev_qualify" class="form-control" name="txt_prev_qualify" placeholder="{{ __('messages.enter_qualification') }}" data-parsley-trigger="change" value="{{$student['qualification']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="txtarea_prev_remarks">{{ __('messages.remarks') }}</label>
                                                <textarea id="txtarea_prev_remarks" class="form-control" name="txtarea_prev_remarks" placeholder="{{ __('messages.enter_the_remarks') }}">{{$student['remarks']}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">{{ __('messages.change_password') }}
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="password">{{ __('messages.password') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="********" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="confirm_password">{{ __('messages.retype_password') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="*********" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    {{ __('messages.update') }}
                                </button>
                                <a href="{{ route('admin.student.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                    {{ __('messages.back') }}
                                </a>
                                <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                            </div>
                        </form>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#parent_detail" role="button" aria-expanded="false" aria-controls="parent_detail"><i class="fas fa-users"></i> {{ __('messages.parent_information') }}</span>
                    <br><br>
                    <div class="collapse" id="parent_detail">

                        <div class="card" id="father_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.father_details') }}</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">{{ __('messages.name') }}</th>
                                                <td width="25%" class="father_name"></td>
                                                <th width="25%">{{ __('messages.date_of_birth') }}</th>
                                                <td width="25%" class="father_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.passport_number') }}</th>
                                                <td width="25%" class="father_passport"></td>
                                                <th width="25%">{{ __('messages.nric_number') }}</th>
                                                <td width="25%" class="father_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.email') }}</th>
                                                <td width="25%" class="father_email"></td>
                                                <th width="25%">{{ __('messages.mobile_no') }}</th>
                                                <td width="25%" class="father_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.blood_group') }}</th>
                                                <td width="25%" class="father_blood_group"></td>
                                                <th width="25%">{{ __('messages.education') }}</th>
                                                <td width="25%" class="father_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.occupation') }}</th>
                                                <td width="25%" class="father_occupation"></td>
                                                <th width="25%">{{ __('messages.income') }}</th>
                                                <td width="25%" class="father_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.country') }}</th>
                                                <td width="25%" class="father_country"></td>
                                                <th width="25%">{{ __('messages.state_province') }}</th>
                                                <td width="25%" class="father_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.city') }}</th>
                                                <td width="25%" class="father_city"></td>
                                                <th width="25%">{{ __('messages.zip_postal_code') }}</th>
                                                <td width="25%" class="father_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">{{ __('messages.address_1') }}</th>
                                                <td width="25%" class="father_address"></td>
                                                <th width="25%">{{ __('messages.address_2') }}</th>
                                                <td width="25%" colspan="3" height="80px;" class="father_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="mother_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.mother_details') }}</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">{{ __('messages.name') }}</th>
                                                <td width="25%" class="mother_name"></td>
                                                <th width="25%">{{ __('messages.date_of_birth') }}</th>
                                                <td width="25%" class="mother_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.passport_number') }}</th>
                                                <td width="25%" class="mother_passport"></td>
                                                <th width="25%">{{ __('messages.nric_number') }}</th>
                                                <td width="25%" class="mother_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.email') }}</th>
                                                <td width="25%" class="mother_email"></td>
                                                <th width="25%">{{ __('messages.mobile_no') }}</th>
                                                <td width="25%" class="mother_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.blood_group') }}</th>
                                                <td width="25%" class="mother_blood_group"></td>
                                                <th width="25%">{{ __('messages.education') }}</th>
                                                <td width="25%" class="mother_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.occupation') }}</th>
                                                <td width="25%" class="mother_occupation"></td>
                                                <th width="25%">{{ __('messages.income') }}</th>
                                                <td width="25%" class="mother_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.country') }}</th>
                                                <td width="25%" class="mother_country"></td>
                                                <th width="25%">{{ __('messages.state_province') }}</th>
                                                <td width="25%" class="mother_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.city') }}</th>
                                                <td width="25%" class="mother_city"></td>
                                                <th width="25%">{{ __('messages.zip_postal_code') }}</th>
                                                <td width="25%" class="mother_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">{{ __('messages.address_1') }}</th>
                                                <td width="25%" class="mother_address"></td>
                                                <th width="25%">{{ __('messages.address_2') }}</th>
                                                <td width="25%" colspan="3" height="80px;" class="mother_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="guardian_info" style="display:none">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.guardian_details') }} ({{$student['relation']}})</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="table-responsive mt-md mb-md">
                                    <table class="table table-striped table-bordered table-condensed mb-none">
                                        <tbody>
                                            <tr>
                                                <th width="25%">{{ __('messages.name') }}</th>
                                                <td width="25%" class="guardian_name"></td>
                                                <th width="25%">{{ __('messages.date_of_birth') }}</th>
                                                <td width="25%" class="guardian_date_of_birth"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.passport_number') }}</th>
                                                <td width="25%" class="guardian_passport"></td>
                                                <th width="25%">{{ __('messages.nric_number') }}</th>
                                                <td width="25%" class="guardian_nric"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.email') }}</th>
                                                <td width="25%" class="guardian_email"></td>
                                                <th width="25%">{{ __('messages.mobile_no') }}</th>
                                                <td width="25%" class="guardian_mobile_no"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.blood_group') }}</th>
                                                <td width="25%" class="guardian_blood_group"></td>
                                                <th width="25%">{{ __('messages.education') }}</th>
                                                <td width="25%" class="guardian_education"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.occupation') }}</th>
                                                <td width="25%" class="guardian_occupation"></td>
                                                <th width="25%">{{ __('messages.income') }}</th>
                                                <td width="25%" class="guardian_income"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.country') }}</th>
                                                <td width="25%" class="guardian_country"></td>
                                                <th width="25%">{{ __('messages.state_province') }}</th>
                                                <td width="25%" class="guardian_state"></td>
                                            </tr>
                                            <tr>
                                                <th width="25%">{{ __('messages.city') }}</th>
                                                <td width="25%" class="guardian_city"></td>
                                                <th width="25%">{{ __('messages.zip_postal_code') }}</th>
                                                <td width="25%" class="guardian_postal_code"></td>
                                            </tr>
                                            <tr class="quick-address">
                                                <th width="25%">{{ __('messages.address_1') }}</th>
                                                <td width="25%" class="guardian_address"></td>
                                                <th width="25%">{{ __('messages.address_2') }}</th>
                                                <td width="25%" colspan="3" height="80px;" class="guardian_address_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>

<script src="{{ asset('public/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('public/libs/autonumeric/autoNumeric-min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('public/js/pages/form-masks.init.js') }}"></script>
<script src="{{ asset('public/libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script>

<script src="{{ asset('public/mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('public/country/js/countrySelect.js') }}"></script>
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
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    $("#drp_country").countrySelect({
        responsiveDropdown: true
    });
</script>
<script>
    var parentImg = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexStudent = "{{ route('admin.student.index') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
</script>

<!-- <script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/student.js') }}"></script>
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
@endsection