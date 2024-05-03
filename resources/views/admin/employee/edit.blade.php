@extends('layouts.admin-layout')
@section('title','Edit Employee')
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
    .custom-file-input:lang(en)~.custom-file-label::after 
   {
    content: "{{ __('messages.butt_browse') }}";
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
                <h4 class="page-title">{{ __('messages.edit_employee') }}</h4>
            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 editEmployeeForm">
            <form id="editEmployeeForm" method="post" action="{{ route('admin.employee.update') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="nav-link">{{ __('messages.personal_details') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="hidden" name="old_photo" id="oldPhoto" value="{{ isset($employee['photo']) ? $employee['photo'] : ''}}" />
                                        <input type="file" name="photo" id="photo" class="dropify-im" data-plugins="dropify" data-max-file-size="2M" data-default-file="{{ isset($employee['photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['photo'] ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['photo'] : config('constants.image_url').'/common-asset/images/users/default.jpg' }}" />
                                        <p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($employee['id']) ? $employee['id'] : ''}}">
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
                                        <input type="text" class="form-control shortNameChange" value="{{ isset($employee['last_name']) ? $employee['last_name'] : ''}}" name="last_name" id="lastName" placeholder="{{ __('messages.yukio') }}">
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
                                        <input type="text" class="form-control shortNameChange" value="{{ isset($employee['first_name']) ? $employee['first_name'] : ''}}" name="first_name" id="firstName" placeholder="{{ __('messages.yamamoto') }}">
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
                                        <input type="text" name="last_name_furigana" class="form-control alloptions" maxlength="50" id="last_name_furigana" value="{{ isset($employee['last_name_furigana']) ? $employee['last_name_furigana'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" name="first_name_furigana" class="form-control alloptions" maxlength="50" id="first_name_furigana" value="{{ isset($employee['first_name_furigana']) ? $employee['first_name_furigana'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" name="last_name_english" class="form-control alloptions" maxlength="50" id="last_name_english" value="{{ isset($employee['last_name_english']) ? $employee['last_name_english'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" name="first_name_english" class="form-control alloptions" maxlength="50" id="first_name_english" value="{{ isset($employee['first_name_english']) ? $employee['first_name_english'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" class="form-control" name="birthday" value="{{ isset($employee['birthday']) ? $employee['birthday'] : ''}}" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="empDOB">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">{{ __('messages.gender') }}</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">{{ __('messages.select_gender') }}</option>
                                        <option value="Male" {{ isset($employee['gender']) ? $employee['gender'] =="Male" ? 'selected' : '' : '' }}>{{ __('messages.male') }}</option>
                                        <option value="Female" {{ isset($employee['gender']) ? $employee['gender'] == "Female" ? 'selected' : '' : '' }}>{{ __('messages.female') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="mobile_no">{{ __('messages.mobile_no') }}</label>
                                <input type="text" class="form-control number_validation" value="{{ isset($employee['mobile_no']) ? $employee['mobile_no'] : ''}}" placeholder="(XXX)-(XXX)-(XXXX)" name="mobile_no" id="mobile_no">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="present_address">{{ __('messages.address_1') }}</label>
                                    <input class="form-control" name="present_address" id="present_address" value="{{ isset($employee['present_address']) ? $employee['present_address'] : ''}}" placeholder="{{ __('messages.enter_address_1') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="permanent_address">{{ __('messages.address_2') }}</label>
                                    <input class="form-control" name="permanent_address" id="permanent_address" value="{{ isset($employee['permanent_address']) ? $employee['permanent_address'] : ''}}" placeholder="{{ __('messages.enter_address_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ __('messages.city') }}</label>
                                    <input type="text" value="{{ isset($employee['city']) ? $employee['city'] : ''}}" class="form-control" name="city" id="City" placeholder="{{ __('messages.enter_city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">{{ __('messages.zip_postal_code') }}</label>
                                    <input type="text" value="{{ isset($employee['post_code']) ? $employee['post_code'] : ''}}" class="form-control" name="post_code" id="postCode" placeholder="{{ __('messages.enter') }} {{ __('messages.zip_postal_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ __('messages.state_province') }}</label>
                                    <input type="text" value="{{ isset($employee['state']) ? $employee['state'] : ''}}" class="form-control" name="state" id="State" placeholder="{{ __('messages.enter') }} {{ __('messages.state_province') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">{{ __('messages.country') }}</label>
                                    <input type="text" value="{{ isset($employee['country']) ? $employee['country'] : ''}}" class="form-control country" name="country" id="Country" placeholder="{{ __('messages.country') }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="short_name">{{ __('messages.short_name') }}</label>
                                    <input type="text" value="{{ isset($employee['short_name']) ? $employee['short_name'] : ''}}" class="form-control" name="short_name" id="shortName" placeholder="{{ __('messages.yamamoto') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment_status">{{ __('messages.employment_status') }}</label>
                                    <select class="form-control" name="employment_status" id="employment_status">
                                        <option value="">{{ __('messages.select_employment_status') }}</option>
                                        <option value="Under_Probation" {{ isset($employee['employment_status']) ? $employee['employment_status'] =="Under_Probation" ? 'selected' : '' : '' }}>{{ __('messages.under_probation') }}</option>
                                        <option value="Employed" {{ isset($employee['employment_status']) ? $employee['employment_status'] =="Employed" ? 'selected' : '' : '' }}>{{ __('messages.employed') }}</option>
                                        <option value="Transferred" {{ isset($employee['employment_status']) ? $employee['employment_status'] =="Transferred" ? 'selected' : '' : '' }}>{{ __('messages.transferred') }}</option>
                                        <option value="Resign" {{ isset($employee['employment_status']) ? $employee['employment_status'] =="Resign" ? 'selected' : '' : '' }}>{{ __('messages.resign') }}</option>
                                        <option value="Retired" {{ isset($employee['employment_status']) ? $employee['employment_status'] =="Retired" ? 'selected' : '' : '' }}>{{ __('messages.retired') }}</option>
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
                                        <option value="{{$r['id']}}" {{ isset($employee['race']) ? $employee['race'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['races_name']}}</option>
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
                                        <option value="{{$r['id']}}" {{ isset($employee['religion']) ? $employee['religion'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['religions_name']}}</option>
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
                                    <input type="text" maxlength="50" id="nationality" class="form-control country" placeholder="{{ __('messages.nationality') }}" name="nationality" value="{{ isset($employee['nationality']) ? $employee['nationality'] : ''}}" data-parsley-trigger="change">
                                </div>
                            </div>
                            @endif
                            @if($form_field['nric'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">{{ __('messages.nric_number') }}</label>
                                    <input type="text" maxlength="16" class="form-control" name="nric_number" value="{{ isset($employee['nric_number']) ? $employee['nric_number'] : ''}}" id="nricNumber" placeholder="999999-99-9999">
                                </div>
                            </div>
                            @endif
                            @if($form_field['passport'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                    <input type="text" maxlength="20" class="form-control" name="passport" value="{{ isset($employee['passport']) ? $employee['passport'] : ''}}" id="Passport" placeholder="{{ __('messages.enter_passport_number') }}">
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
                                        <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="{{ isset($employee['passport_expiry_date']) ? $employee['passport_expiry_date'] : ''}}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($employee['passport_photo']) ? $employee['passport_photo'] : ''}}" />

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport_photo">{{ __('messages.passport_photo') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_the_file') }}</label>
                                        </div>
                                    </div>
                                    @if(isset($employee['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['passport_photo'])
                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['passport_photo'] }}" target="_blank"> {{ __('messages.passport_photo') }} </a>
                                    @endif
                                    <span id="passport_photo_name"></span>
                                </div>
                            </div>
                            @endif
                            @if($form_field['visa'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                    <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" value="{{ isset($employee['visa_number']) ? $employee['visa_number'] : ''}}" data-parsley-trigger="change">
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
                                        <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend" value="{{ isset($employee['visa_expiry_date']) ? $employee['visa_expiry_date'] : ''}}">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($employee['visa_photo']) ? $employee['visa_photo'] : ''}}" />

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="visa_photo">{{ __('messages.visa_photo') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_the_file') }}</label>
                                        </div>
                                    </div>
                                    @if(isset($employee['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['visa_photo'])
                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$employee['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                    @endif
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

                                    <select class="form-control " id="role_id" name="role_id" data-placeholder="{{ __('messages.choose_role') }}">
                                        <option value="">{{ __('messages.select_role') }}</option>
                                        @forelse($school_roles as $r)
                                        @if($r['portal_roleid']==1 && $r['roles']!=null)

                                        <option value="{{$r['id']}}" {{ (isset($role['school_roleid']) && $role['school_roleid'] ==$r['id']) ? 'selected' : ''  }}>{{ $r['fullname'] }} ( {{ $r['roles'] }} )</option>
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
                                        <input type="text" class="form-control" value="{{ isset($employee['joining_date']) ? $employee['joining_date'] : ''}}" name="joining_date" id="joiningDate" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_position">{{ __('messages.staff_position') }}</label>
                                    <select class="form-control" id="staffPosition" name="staff_position">
                                        <option value="">{{ __('messages.select_staff_position') }}</option>
                                        @forelse($staff_positions as $r)
                                        <option value="{{$r['id']}}" {{  isset($employee['staff_position']) ? $employee['staff_position'] == $r['id'] ? 'Selected' : '' : '' }}>{{$r['staff_positions_name']}}</option>
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
                                    <input type="number" value="{{ isset($employee['salary_grade']) ? $employee['salary_grade'] : ''}}" class="form-control" name="salary_grade" id="salaryGrade" placeholder="{{ __('messages.enter_salary_grade') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_category">{{ __('messages.staff_category') }}</label>
                                    <select class="form-control" id="staffCategory" name="staff_category">
                                        <option value="">{{ __('messages.select_category') }}</option>
                                        @forelse($staff_categories as $r)
                                        <option value="{{$r['id']}}" {{  isset($employee['staff_category']) ? $employee['staff_category'] == $r['id'] ? 'Selected' : '' : ''}}>{{$r['staff_categories_name']}}</option>
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
                                        @forelse($qualifications as $qua)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $employee['staff_qualification_id']) as $info)
                                        @if($qua['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$qua['id']}}" {{ $selected }}>{{$qua['qualification_name']}}</option>
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
                                        <option value="{{$r['id']}}" {{ isset($employee['stream_type_id']) ? $employee['stream_type_id'] == $r['id'] ? 'Selected' : '' : '' }}>{{$r['stream_types_name']}}</option>
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
                                        <option value="{{$r['id']}}" {{ isset($employee['job_title_id']) ? $employee['job_title_id'] == $r['id'] ? 'Selected' : '' : '' }}>{{$r['name']}}</option>
                                        @empty
                                        @endforelse <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="teacher_type">{{ __('messages.teacher_type') }}</label>
                                    <select class="form-control" name="teacher_type" id="teacher_type">
                                        <option value="">{{ __('messages.select_teacher_type') }}</option>
                                        <option value="nursing_teacher" {{ isset($employee['teacher_type']) ? $employee['teacher_type'] == "nursing_teacher" ? 'Selected' : '' : '' }}>{{ __('messages.nursing_teacher') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">{{ __('messages.department') }}</label>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>{{ __('messages.department') }}</td>
                                        <td>{{ __('messages.start_date') }}</td>
                                        <td>{{ __('messages.end_date') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field_one">
                                    @php
                                    $departmentIds = isset($employee['department_id']) ? $employee['department_id'] :"";
                                    $departmentLists = explode(',', $departmentIds);
                                    $department_start_date = isset($employee['department_start_date']) ? $employee['department_start_date'] :"";
                                    $departmentStartList = explode(',', $department_start_date);
                                    $department_end_date = isset($employee['department_end_date']) ? $employee['department_end_date'] :"";
                                    $departmentEndList = explode(',', $department_end_date);
                                    @endphp
                                    @foreach($departmentLists as $key => $step)
                                    @php
                                    $addRemovedep = $key+1;
                                    @endphp
                                    <tr id="row_department{{$addRemovedep}}">
                                        <td>
                                            <select class="form-control" name="department[]">
                                                <option value="">{{ __('messages.select_department') }}</option>
                                                @forelse($department as $r)
                                                <option value="{{$r['id']}}" {{ isset($step) ? $step == $r['id'] ? 'Selected' : '' : '' }}>{{$r['name']}}</option>
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
                                                <input type="text" value="{{ isset($departmentStartList[$key]) ? $departmentStartList[$key] : ''}}" class="form-control designationDatepicker" name="department_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" value="{{ isset($departmentEndList[$key]) ? $departmentEndList[$key] : ''}}" class="form-control designationDatepicker" name="department_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            @if($addRemovedep > 1)
                                            <button type="button" name="remove_designation" data-designationremoveid="{{$addRemovedep}}" id="{{$addRemovedep}}" class="btn btn-danger btn_remove_department">X</button>
                                            @else
                                            <button type="button" name="add_department" id="add_department" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- last feild value -->
                                    <input type="hidden" value="{{ $addRemovedep }}" id="addRemovedepartment">
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
                                        <td>{{ __('messages.start_date') }}</td>
                                        <td>{{ __('messages.end_date') }}</td>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field_two">
                                    @php
                                    $designationIds = isset($employee['designation_id']) ? $employee['designation_id'] :"";
                                    $designationLists = explode(',', $designationIds);
                                    $designation_start_date = isset($employee['designation_start_date']) ? $employee['designation_start_date'] :"";
                                    $designationStartList = explode(',', $designation_start_date);
                                    $designation_end_date = isset($employee['designation_end_date']) ? $employee['designation_end_date'] :"";
                                    $designationEndList = explode(',', $designation_end_date);
                                    @endphp
                                    @foreach($designationLists as $dkey => $dstep)
                                    @php
                                    $addRemovedes = $dkey+1;
                                    @endphp
                                    <tr id="row_designation{{$addRemovedes}}">
                                        <td>
                                            <select class="form-control" name="designation[]">
                                                <option value="">{{ __('messages.select_designation') }}</option>
                                                @forelse($designation as $r)
                                                <option value="{{$r['id']}}" {{ isset($dstep) ? $dstep == $r['id'] ? 'Selected' : '' : '' }}>{{$r['name']}}</option>
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
                                                <input type="text" value="{{ isset($designationStartList[$dkey]) ? $designationStartList[$dkey] : ''}}" class="form-control designationDatepicker" name="designation_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" value="{{ isset($designationEndList[$dkey]) ? $designationEndList[$dkey] : ''}}" class="form-control designationDatepicker" name="designation_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            @if($addRemovedes > 1)
                                            <button type="button" name="remove_designation" data-designationremoveid="{{$addRemovedes}}" id="{{$addRemovedes}}" class="btn btn-danger btn_remove_designation">X</button>
                                            @else
                                            <button type="button" name="add_designation" id="add_designation" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- last feild value -->
                                    <input type="hidden" value="{{ $addRemovedes }}" id="addRemoveDesignation">
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
                                    @php
                                    $employeeTypeIds = isset($employee['employee_type_id']) ? $employee['employee_type_id'] :"";
                                    $employeeTypeLists = explode(',', $employeeTypeIds);
                                    $employee_type_start_date = isset($employee['employee_type_start_date']) ? $employee['employee_type_start_date'] :"";
                                    $employeeTypeStartList = explode(',', $employee_type_start_date);
                                    $employee_type_end_date = isset($employee['employee_type_end_date']) ? $employee['employee_type_end_date'] :"";
                                    $employeeTypeEndList = explode(',', $employee_type_end_date);
                                    @endphp
                                    @foreach($employeeTypeLists as $etkey => $etstep)
                                    @php
                                    $addRemove = $etkey+1;
                                    @endphp
                                    <tr id="row_emp_type{{$addRemove}}">
                                        <td>
                                            <select class="form-control" name="employee_type[]">
                                                <option value="">{{ __('messages.select_employee_type') }}</option>
                                                @forelse($employee_type_list as $r)
                                                <option value="{{$r['id']}}" {{ isset($etstep) ? $etstep == $r['id'] ? 'Selected' : '' : '' }}>{{$r['name']}}</option>
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
                                                <input type="text" value="{{ isset($employeeTypeStartList[$etkey]) ? $employeeTypeStartList[$etkey] : ''}}" class="form-control designationDatepicker" name="employee_type_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" value="{{ isset($employeeTypeEndList[$etkey]) ? $employeeTypeEndList[$etkey] : ''}}" class="form-control designationDatepicker" name="employee_type_end[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
                                            @if($addRemove > 1)
                                            <button type="button" name="remove_emp_type" data-emptype="{{$addRemove}}" id="{{$addRemove}}" class="btn btn-danger btn_remove_emp_type">X</button>
                                            @else
                                            <button type="button" name="add_employee_type" id="add_employee_type" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- last feild value -->
                                    <input type="hidden" value="{{ $addRemove }}" id="addRemoveLastEmpType">
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="relieving_date">{{ __('messages.relieving_date') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ isset($employee['releive_date']) ? $employee['releive_date'] : ''}}" name="relieving_date" id="relieving_date" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                    </div>
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
                            <input type="hidden" value="{{ isset($role['id']) ? $role['id'] : '0'}}" class="form-control" name="role_user_id" id="role_user_id">
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-envelope-open"></span>
                                            </div>
                                        </div>
                                        <input type="email" value="{{ isset($employee['email']) ? $employee['email'] : ''}}" class="form-control" name="email" id="email" placeholder="xxxxx@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('messages.password') }}</label>
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
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <label class="switch">{{ __('messages.authentication') }}

                                        <input id="edit_status" name="status" type="checkbox" {{  isset($employee['status']) ? $employee['status'] == "1" ? "checked" : ""  : ""}}>
                                        <span>
                                            <em></em>
                                            <strong></strong>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="confirm_password">{{ __('messages.retype_password') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                    </div>
                                </div>
                            </div> -->
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
                                    <input type="checkbox" class="custom-control-input" name="google2fa_secret_enable" id="google2fa_secret_enable" {{ isset($role['google2fa_secret_enable']) ? $role['google2fa_secret_enable'] == "1" ? "checked" : ""  : ""}}>
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
                                        <input type="text" class="form-control" name="facebook_url" value="{{ isset($employee['facebook_url']) ? $employee['facebook_url'] : ''}}" id="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}">
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
                                        <input type="text" class="form-control" name="twitter_url" value="{{ isset($employee['twitter_url']) ? $employee['twitter_url'] : ''}}" id="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}">
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
                                        <input type="text" class="form-control" name="linkedin_url" value="{{ isset($employee['linkedin_url']) ? $employee['linkedin_url'] : ''}}" id="linkedin_url" placeholder="{{ __('messages.enter_linkedIn_url') }}">
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
                                        <input type="text" id="height" class="form-control" value="{{ isset($employee['height']) ? $employee['height'] : ''}}" name="height" placeholder="{{ __('messages.enter_height') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weight">{{ __('messages.weight') }}</label>
                                        <input type="text" id="weight" class="form-control" value="{{ isset($employee['weight']) ? $employee['weight'] : ''}}" name="weight" placeholder="{{ __('messages.enter_weight') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="allergy">{{ __('messages.allergy') }}</label>
                                        <input type="text" id="allergy" class="form-control" value="{{ isset($employee['allergy']) ? $employee['allergy'] : ''}}" name="Allergy" placeholder="{{ __('messages.enter_allergy') }}" data-parsley-trigger="change">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="blood_group">{{ __('messages.blood_group') }}</label>
                                        <select class="form-control" name="blood_group" id="blood_group">
                                            <option value="">{{ __('messages.select_blood_group') }}</option>
                                            <option value="A+" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "A+" ? 'selected' : '' : '' }}>A+</option>
                                            <option value="A-" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "A-" ? 'selected' : '' : '' }}>A-</option>
                                            <option value="AB+" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "AB+" ? 'selected' : '' : '' }}>AB+</option>
                                            <option value="AB-" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "AB-" ? 'selected' : '' : '' }}>AB-</option>
                                            <option value="B+" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "B+" ? 'selected' : '' : '' }}>B+</option>
                                            <option value="B-" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "B-" ? 'selected' : '' : '' }}>B-</option>
                                            <option value="O+" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "O+" ? 'selected' : '' : '' }}>O+</option>
                                            <option value="O-" {{ isset($employee['blood_group']) ? $employee['blood_group'] == "O-" ? 'selected' : '' : '' }}>O-</option>
                                        </select>
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
                                            <input type="text" id="bank_name" value="{{ isset($bank['bank_name']) ? $bank['bank_name']:' ' }}" class="form-control" name="bank_name" placeholder="{{ __('messages.enter_bank_name') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="holder_name">{{ __('messages.account_holder') }}</label>
                                            <input type="text" id="holder_name" value="{{ isset($bank['holder_name']) ? $bank['holder_name']:''}}" class="form-control" name="holder_name" placeholder="{{ __('messages.enter_account_holder') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bank_branch">{{ __('messages.bank_branch') }}</label>
                                            <input type="text" id="bank_branch" value="{{ isset($bank['bank_branch']) ? $bank['bank_branch']:'' }}" class="form-control" name="bank_branch" placeholder="{{ __('messages.enter_bank_branch') }}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="bank_address">{{ __('messages.bank_address') }}</label>
                                            <input type="text" class="form-control" value="{{ isset($bank['bank_address']) ? $bank['bank_address']:'' }}" id="bank_address" name="bank_address" placeholder="{{ __('messages.enter_bank_address') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="ifsc_code">{{ __('messages.ifsc_code') }}</label>
                                            <input type="text" class="form-control" value="{{ isset($bank['ifsc_code']) ? $bank['ifsc_code']:''}}" id="ifsc_code" name="ifsc_code" placeholder="{{ __('messages.enter_ifsc_code') }}" aria-describedby="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">{{ __('messages.account_no') }}</label>
                                            <input type="text" class="form-control" value="{{ isset($bank['account_no']) ? $bank['account_no']:'' }}" id="account_no" name="account_no" placeholder="{{ __('messages.enter_account_no') }}" aria-describedby="inputGroupPrepend">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.update') }}
                                </button>
                                <a href="{{ route('admin.listemployee') }}" class="btn btn-primary-bl waves-effect waves-light">
                                    {{ __('messages.back') }}
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row-->
</div><!-- container -->
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
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

<script>
    var employeeListShow = "{{ route('admin.listemployee') }}";
    var employeeList = null;
    var yyyy_mm_dd = "{{ __('messages.yyyy_mm_dd') }}";
    var emp_department_list = @json($department);
    var emp_designation_list = @json($designation);
    var employee_type_list = @json($employee_type_list);
</script>
<script src="{{ asset('js/custom/employee.js') }}"></script>
<script src="{{ asset('js/custom/edit_employee_add_more.js') }}"></script>
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
        // var $form_2 = $('#editEmployeeForm');
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