@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.edit_application') . '')
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

                        <form id="editApplication" method="post" action="{{ route('admin.application.update') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ isset($application['id']) ? $application['id'] : ''}}">
                        
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
                                            <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" value="{{$application['first_name']}}" name="first_name" maxlength="50" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">{{ __('messages.last_name') }}</label>
                                            <input type="text" class="form-control" id="last_name" value="{{$application['last_name']}}" name="last_name" maxlength="50" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender">{{ __('messages.gender') }}</label>
                                            <select id="gender" name="gender" class="form-control">
                                                <option value="">{{ __('messages.select_gender') }}</option>
                                                <option value="Male" {{$application['gender'] == "Male" ? "selected" : "" }}>{{ __('messages.male') }}</option>
                                                <option value="Female" {{$application['gender'] == "Female" ? "selected" : "" }}>{{ __('messages.female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_of_birth">{{ __('messages.date_of_birth') }}</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" id="date_of_birth" value="{{$application['date_of_birth']}}" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
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
                                            <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control number_validation mobile_no" id="mobile_no" value="{{$application['mobile_no']}}" name="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="email" value="{{$application['email']}}" name="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_1">{{ __('messages.address_1') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address_1" value="{{$application['address_1']}}" name="address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_2">{{ __('messages.address_2') }}<br></label>
                                            <input type="text" class="form-control" id="address_2" value="{{$application['address_2']}}" name="address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="50" id="country" class="form-control country" placeholder="{{ __('messages.country') }}" value="{{$application['country']}}" name="country" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="state" value="{{$application['state']}}" name="state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" value="{{$application['city']}}" name="city" placeholder="{{ __('messages.enter_city') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="postal_code" value="{{$application['postal_code']}}" name="postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
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
                                            <label for="academic_year">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                            <select id="academic_year" name="academic_year" class="form-control">
                                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                                @forelse($academic_year_list as $r)
                                                <option value="{{$r['id']}}" {{ $r['id'] == $application['academic_year'] ? "Selected" : "" }}>{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="academic_grade">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                            <select id="academic_grade" name="academic_grade" class="form-control">
                                                <option value="">{{ __('messages.select_grade') }}</option>
                                                @forelse($grade as $g)
                                                <option value="{{$g['id']}}" {{ $g['id'] == $application['academic_grade'] ? "Selected" : "" }}>{{$g['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
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
                                            <select id="school_year" name="school_year" class="form-control">
                                                <option value="">{{ __('messages.select') }} {{ __('messages.select_academic_year') }}</option>
                                                @forelse($academic_year_list as $r)
                                                <option value="{{$r['id']}}" {{ $r['id'] == $application['school_year'] ? "Selected" : "" }}>{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="grade">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                            <select id="grade" name="grade" class="form-control">
                                                <option value="">{{ __('messages.select_grade') }}</option>
                                                @forelse($grade as $g)
                                                <option value="{{$g['id']}}" {{ $g['id'] == $application['grade'] ? "Selected" : "" }}>{{$g['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_last_attended">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="school_last_attended" value="{{$application['school_last_attended']}}" name="school_last_attended" placeholder="{{ __('messages.enter_school_name') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_address_1">{{ __('messages.school_address1') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="school_address_1" value="{{$application['school_address_1']}}" name="school_address_1" placeholder="{{ __('messages.enter_address_1') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_address_2">{{ __('messages.school_address2') }}<br></label>
                                            <input type="text" class="form-control" id="school_address_2" value="{{$application['school_address_2']}}" name="school_address_2" placeholder="{{ __('messages.enter_address_2') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_country">{{ __('messages.country') }}<span class="text-danger">*</span></label>
                                            <input type="text" maxlength="50" id="school_country" value="{{$application['school_country']}}" name="school_country" class="form-control country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_state">{{ __('messages.state') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="school_state" value="{{$application['school_state']}}" name="school_state" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_city">{{ __('messages.city') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="school_city" value="{{$application['school_city']}}" name="school_city" placeholder="{{ __('messages.enter') }} {{ __('messages.state') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="school_postal_code">{{ __('messages.postal_code') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="school_postal_code" value="{{$application['school_postal_code']}}" name="school_postal_code" placeholder="{{ __('messages.enter') }} {{ __('messages.postal_code') }}" aria-describedby="inputGroupPrepend">
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mother_first_name" value="{{$application['mother_first_name']}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother_last_name">{{ __('messages.last_name') }}</label>
                                            <input type="text" class="form-control" id="mother_last_name" value="{{$application['mother_last_name']}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mother_email" value="{{$application['mother_email']}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mother_phone_number" value="{{$application['mother_phone_number']}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                            <select id="mother_occupation" name="mother_occupation" class="form-control">
                                                <option value="">{{ __('messages.select_occupation') }}</option>
                                                <option {{$application['mother_occupation'] == "Business" ? "selected" : "" }}>Business</option>
                                                <option {{$application['mother_occupation'] == "IT/ Software" ? "selected" : "" }}>IT/ Software</option>
                                                <option {{$application['mother_occupation'] == "Civil department" ? "selected" : "" }}>Civil department</option>
                                                <option {{$application['mother_occupation'] == "Others" ? "selected" : "" }}>Others</option>
                                            </select>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="father_first_name" value="{{$application['father_first_name']}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_last_name">{{ __('messages.last_name') }}</label>
                                            <input type="text" class="form-control" id="father_last_name" value="{{$application['father_last_name']}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="father_email" value="{{$application['father_email']}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="father_phone_number" value="{{$application['father_phone_number']}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                            <select id="father_occupation" name="father_occupation" class="form-control">
                                                <option value="">{{ __('messages.select_occupation') }}</option>
                                                <option {{$application['father_occupation'] == "Business" ? "selected" : "" }}>Business</option>
                                                <option {{$application['father_occupation'] == "IT/ Software" ? "selected" : "" }}>IT/ Software</option>
                                                <option {{$application['father_occupation'] == "Civil department" ? "selected" : "" }}>Civil department</option>
                                                <option {{$application['father_occupation'] == "Others" ? "selected" : "" }}>Others</option>
                                            </select>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="guardian_first_name" value="{{$application['guardian_first_name']}}" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_last_name">{{ __('messages.last_name') }}</label>
                                            <input type="text" class="form-control" id="guardian_last_name" value="{{$application['guardian_last_name']}}" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                            <select id="guardian_relation" name="guardian_relation" class="form-control">
                                                <option value="">{{ __('messages.select_relation') }}</option>
                                                @forelse($relation as $r)
                                                <option value="{{$r['id']}}" {{$r['id'] == $application['guardian_relation'] ? "selected" : "" }}>{{$r['name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="guardian_email" value="{{$application['guardian_email']}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="guardian_phone_number" value="{{$application['guardian_phone_number']}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                            <select id="guardian_occupation" name="guardian_occupation" class="form-control">
                                                <option value="">{{ __('messages.select_occupation') }}</option>
                                                <option {{$application['guardian_occupation'] == "Business" ? "selected" : "" }}>Business</option>
                                                <option {{$application['guardian_occupation'] == "IT/ Software" ? "selected" : "" }}>IT/ Software</option>
                                                <option {{$application['guardian_occupation'] == "Civil department" ? "selected" : "" }}>Civil department</option>
                                                <option {{$application['guardian_occupation'] == "Others" ? "selected" : "" }}>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <hr>
                            <!-- <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="submit" type="submit">
                                    {{ __('messages.update') }}
                                </button>
                                <a href="{{ route('admin.application.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                                    {{ __('messages.back') }}
                                </a>
                            </div> -->

                        </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')

<script>
    var applicationList = "{{ route('admin.application.list') }}";
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
<script src="{{ asset('js/custom/admin_application.js') }}"></script>

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
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
    });

    $(".country").countrySelect({
        defaultCountry: "my",
        responsiveDropdown: true
    });
</script>

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
@endsection