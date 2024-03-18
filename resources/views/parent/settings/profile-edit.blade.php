@extends('layouts.admin-layout')
@section('title','Profile Edit')
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
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.parent_profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <form id="profileEdit" method="post" action="{{ route('parent.profile_update') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{ isset($parent['id']) ? $parent['id'] : ''}}">
                <input type="hidden" name="email" value="{{ isset($parent['email']) ? $parent['email'] : ''}}">
                <input type="hidden" name="first_name" value="{{ isset($parent['first_name']) ? $parent['first_name'] : ''}}">
                <div class="card">

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
                                <input type="checkbox" class="custom-control-input skip" id="skip_mother_details"  name="skip_mother_details" {{ isset($parent['mother_first_name']) ? "" : 'checked'}}>
                                <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                            </div>
                        </div>
                        <div id="mother_details" style="display: {{ isset($parent['mother_first_name']) ? '' : '' }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_last_name" value="{{ isset($parent['mother_last_name']) ? $parent['mother_last_name'] : ''}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_middle_name" value="{{ isset($parent['mother_middle_name']) ? $parent['mother_middle_name'] : ''}}" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name" value="{{ isset($parent['mother_first_name']) ? $parent['mother_first_name'] : ''}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_last_name_furigana" value="{{ isset($parent['mother_last_name_furigana']) ? $parent['mother_last_name_furigana'] : ''}}" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_middle_name_furigana" value="{{ isset($parent['mother_middle_name_furigana']) ? $parent['mother_middle_name_furigana'] : ''}}" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name_furigana" value="{{ isset($parent['mother_first_name_furigana']) ? $parent['mother_first_name_furigana'] : ''}}" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_last_name_english" value="{{ isset($parent['mother_last_name_english']) ? $parent['mother_last_name_english'] : ''}}" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_middle_name_english" value="{{ isset($parent['mother_middle_name_english']) ? $parent['mother_middle_name_english'] : ''}}" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_first_name_english" value="{{ isset($parent['mother_first_name_english']) ? $parent['mother_first_name_english'] : ''}}" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form country"  id="mother_nationality" name="mother_nationality" value="{{ isset($parent['mother_nationality']) ? $parent['mother_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  mother_form"  id="mother_email" value="{{ isset($parent['mother_email']) ? $parent['mother_email'] : ''}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form number_validation"  id="mother_phone_number" value="{{ isset($parent['mother_phone_number']) ? $parent['mother_phone_number'] : ''}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="mother_phone_number" class="error"></label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select    id="mother_occupation" name="mother_occupation" class="form-control copy_parent_info mother_form">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($parent['mother_occupation']) ? $parent['mother_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($parent['mother_occupation']) ? $parent['mother_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($parent['mother_occupation']) ? $parent['mother_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($parent['mother_occupation']) ? $parent['mother_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form"  id="mother_occupation" name="mother_occupation" value="{{ isset($parent['mother_occupation']) ? $parent['mother_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
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
                                <input type="checkbox" class="custom-control-input skip" id="skip_father_details" name="skip_father_details"  {{ isset($parent['father_first_name']) ? "" : 'checked'}}>
                                <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                            </div>
                        </div>

                        <div id="father_details" style="display: {{ isset($parent['father_first_name']) ? '' : '' }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name"  value="{{ isset($parent['father_last_name']) ? $parent['father_last_name'] : ''}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name"  value="{{ isset($parent['father_middle_name']) ? $parent['father_middle_name'] : ''}}" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name"  value="{{ isset($parent['father_first_name']) ? $parent['father_first_name'] : ''}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana"  value="{{ isset($parent['father_last_name_furigana']) ? $parent['father_last_name_furigana'] : ''}}" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana"  value="{{ isset($parent['father_middle_name_furigana']) ? $parent['father_middle_name_furigana'] : ''}}" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_furigana"  value="{{ isset($parent['father_first_name_furigana']) ? $parent['father_first_name_furigana'] : ''}}" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english"  value="{{ isset($parent['father_last_name_english']) ? $parent['father_last_name_english'] : ''}}" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english"  value="{{ isset($parent['father_middle_name_english']) ? $parent['father_middle_name_english'] : ''}}" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_english"  value="{{ isset($parent['father_first_name_english']) ? $parent['father_first_name_english'] : ''}}" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form country" id="father_nationality" name="father_nationality"  value="{{ isset($parent['father_nationality']) ? $parent['father_nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  father_form" id="father_email"  value="{{ isset($parent['father_email']) ? $parent['father_email'] : ''}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form number_validation" id="father_phone_number"  value="{{ isset($parent['father_phone_number']) ? $parent['father_phone_number'] : ''}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="father_phone_number" class="error"></label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select  id="father_occupation" name="father_occupation" class="form-control">
                                                            <option  value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($parent['father_occupation']) ? $parent['father_occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($parent['father_occupation']) ? $parent['father_occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($parent['father_occupation']) ? $parent['father_occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($parent['father_occupation']) ? $parent['father_occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_occupation" name="father_occupation"  value="{{ isset($parent['father_occupation']) ? $parent['father_occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <ul class="nav nav-tabs" style="display: block;">
                        <li class="nav-item">
                            <h4 class="navv float-left">{{ __('messages.guardian_details') }}</h4>
                        </li>
                    </ul>

                    <div class="card-body">

                        <div id="guardian_details">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name" value="{{ isset($parent['last_name']) ? $parent['last_name'] : ''}}" name="last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control" id="middle_name" value="{{ isset($parent['middle_name']) ? $parent['middle_name'] : ''}}" name="middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" value="{{ isset($parent['first_name']) ? $parent['first_name'] : ''}}" name="first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name_furigana" value="{{ isset($parent['last_name_furigana']) ? $parent['last_name_furigana'] : ''}}" name="last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control" id="middle_name_furigana" value="{{ isset($parent['middle_name_furigana']) ? $parent['middle_name_furigana'] : ''}}" name="middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name_furigana" value="{{ isset($parent['first_name_furigana']) ? $parent['first_name_furigana'] : ''}}" name="first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name_english" value="{{ isset($parent['last_name_english']) ? $parent['last_name_english'] : ''}}" name="last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control" id="middle_name_english" value="{{ isset($parent['middle_name_english']) ? $parent['middle_name_english'] : ''}}" name="middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name_english" value="{{ isset($parent['first_name_english']) ? $parent['first_name_english'] : ''}}" name="first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" readonly value="{{ isset($parent['email']) ? $parent['email'] : ''}}" name="email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control number_validation" id="phone_number" value="{{ isset($parent['phone_number']) ? $parent['phone_number'] : ''}}" name="phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="phone_number" class="error"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="occupation" name="occupation" value="{{ isset($parent['occupation']) ? $parent['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select  id="occupation" name="occupation" class="form-control">
                                                            <option  value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($parent['occupation']) ? $parent['occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($parent['occupation']) ? $parent['occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($parent['occupation']) ? $parent['occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($parent['occupation']) ? $parent['occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="company_name_japan" name="company_name_japan" value="{{ isset($parent['company_name_japan']) ? $parent['company_name_japan'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="company_name_local" name="company_name_local" value="{{ isset($parent['company_name_local']) ? $parent['company_name_local'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  number_validation " id="company_phone_number" name="company_phone_number" value="{{ isset($parent['company_phone_number']) ? $parent['company_phone_number'] : ''}}" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="company_phone_number" class="error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
                                        <select id="employment_status" name="employment_status" class="form-control">
                                            <option value="">{{ __('messages.select_employment_status') }}</option>
                                            <option value="Expat" {{ isset($parent['employment_status']) ? $parent['employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
                                            <option value="Local Hire" {{ isset($parent['employment_status']) ? $parent['employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
                                            <option value="Public Servant" {{ isset($parent['employment_status']) ? $parent['employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
                                            <option value="Self-Employed" {{ isset($parent['employment_status']) ? $parent['employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" style="width: 100px; margin-right: 15px;">
                            {{ __('messages.update') }}
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>-->
                    </div>
                </div>


        </div>
    </div> <!-- end col -->
    </form>
</div>
<!-- end row -->
</div>
<!-- container -->

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
    $(".country").countrySelect({
        defaultCountry: "jp",
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
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
    var input = document.querySelector("#phone_number");
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
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        utilsScript: "js/utils.js"
    });

    var input = document.querySelector("#company_phone_number");
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
    //event routes
    var eventList = "{{ route('parent.event.list') }}";
    var eventDetails = "{{ route('parent.event.details') }}";
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/parent_settings.js') }}"></script>
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
        // var $form_2 = $('#editParent');
        // $form_2.validate({
        //     debug: true
        // });

        // $('#nric').rules("add", {
        //     required: true
        // });

        $('#nric').mask("000000-00-0000", {
            reverse: true
        });
        // nric validation end
    });
</script>

@endsection