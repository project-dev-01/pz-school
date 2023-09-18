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
                <h4 class="page-title">{{ __('messages.profile_edit') }}</h4>
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
                <div class="card">
                    <ul class="nav nav-tabs" style="display: block;">
                        <li class="nav-item">
                            <h4 class="navv float-left">{{ __('messages.profile_edit') }}</h4>
                        </li>
                    </ul>
                    <div class="card-body">

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
                                        <input type="text" name="first_name" value="{{ isset($parent['first_name']) ? $parent['first_name'] : ''}}" class="form-control alloptions" maxlength="50" id="first_name" placeholder="{{ __('messages.ahmad_ali') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" name="last_name" value="{{ isset($parent['last_name']) ? $parent['last_name'] : ''}}" class="form-control alloptions" maxlength="50" id="last_name" placeholder="{{ __('messages.muhammad_jaafar') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">{{ __('messages.gender') }}</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="">{{ __('messages.select_gender') }}</option>
                                        <option value="Male" {{ isset($parent['gender']) ? $parent['gender'] == "Male" ? "Selected" : "" : '' }}>{{ __('messages.male') }}</option>
                                        <option value="Female" {{ isset($parent['gender']) ? $parent['gender'] == "Female" ? "Selected" : "" : '' }}>{{ __('messages.female') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="dob">{{ __('messages.date_of_birth') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-birthday-cake"></span>
                                            </div>
                                        </div>
                                        <input type="text" name="date_of_birth" class="form-control" value="{{ isset($parent['date_of_birth']) ? $parent['date_of_birth'] : ''}}" id="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                    <input type="text" maxlength="50" id="nric" value="{{$parent['nric']}}" class="form-control alloptions" placeholder="{{ __('messages.enter_nric_number') }}" name="nric" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                    <input type="text" maxlength="50" class="form-control alloptions" value="{{$parent['passport']}}" placeholder="{{ __('messages.enter_passport_number') }}" name="passport">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="race">{{ __('messages.race') }}</label>
                                    <select class="form-control" name="race">
                                        <option value="">{{ __('messages.select_race') }}</option>
                                        @forelse($races as $r)
                                        <option value="{{$r['id']}}" {{ isset($parent['race']) ? $parent['race'] == $r['id'] ? "selected" : "" : "" }}>{{$r['races_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_religion">{{ __('messages.religion') }}</label>
                                    <select class="form-control" name="religion">
                                        <option value="">{{ __('messages.select_religion') }}</option>
                                        @forelse($religion as $r)
                                        <option value="{{$r['id']}}" {{ isset($parent['religion']) ? $parent['religion'] == $r['id'] ? "selected" : "" : "" }}>{{$r['religions_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                    <select class="form-control" name="blood_group">
                                        <option value="">{{ __('messages.select_blood_group') }}</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "O+" ? "selected" : "" : "" }}>O+</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "A+" ? "selected" : "" : "" }}>A+</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "B+" ? "selected" : "" : "" }}>B+</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "AB+" ? "selected" : "" : "" }}>AB+</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "O-" ? "selected" : "" : "" }}>O-</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "A-" ? "selected" : "" : "" }}>A-</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "B-" ? "selected" : "" : "" }}>B-</option>
                                        <option {{ isset($parent['blood_group']) ? $parent['blood_group'] == "AB-" ? "selected" : "" : "" }}>AB-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="education">{{ __('messages.education') }}</label>
                                    <select class="form-control" name="education">
                                        <option value="">{{ __('messages.select_education') }}</option>
                                        @forelse($education as $e)
                                        <option value="{{$e['id']}}" {{ isset($parent['education']) ? $parent['education'] == $e['id'] ? "selected" : "" : "" }}>{{$e['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="occupation" value="{{ isset($parent['occupation']) ? $parent['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="income">{{ __('messages.income') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-calculator"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="income" value="{{ isset($parent['income']) ? $parent['income'] : ''}}" placeholder="{{ __('messages.enter_income') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">{{ __('messages.address_1') }}</label>
                                    <input class="form-control" name="address" id="address" value="{{ isset($parent['address']) ? $parent['address'] : ''}}" placeholder="{{ __('messages.enter_address_1') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address_2">{{ __('messages.address_2') }}</label>
                                    <input class="form-control" name="address_2" id="address_2" value="{{ isset($parent['address_2']) ? $parent['address_2'] : ''}}" placeholder="{{ __('messages.enter_address_2') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ __('messages.city') }}</label>
                                    <input type="text" class="form-control" name="city"  value="{{ isset($parent['city']) ? $parent['city'] : ''}}"placeholder="{{ __('messages.enter_city') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">{{ __('messages.zip_postal_code') }}</label>
                                    <input type="text" class="form-control" name="post_code" value="{{ isset($parent['post_code']) ? $parent['post_code'] : ''}}" id="postCode" placeholder="{{ __('messages.zip_postal_code') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ __('messages.state_province') }}</label>
                                    <input type="text" class="form-control" name="state" value="{{ isset($parent['state']) ? $parent['state'] : ''}}" placeholder="{{ __('messages.state_province') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">{{ __('messages.country') }}</label>
                                    <input type="text" class="form-control" name="country" value="{{ isset($parent['country']) ? $parent['country'] : ''}}" id="country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number_validation" value="{{ isset($parent['mobile_no']) ? $parent['mobile_no'] : ''}}" name="mobile_no" id="mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">
                                {{ __('messages.social_links') }}
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="facebook_url"> {{ __('messages.facebook') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fab fa-facebook-f"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ isset($parent['facebook_url']) ? $parent['facebook_url'] : ''}}" name="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" class="form-control" value="{{ isset($parent['twitter_url']) ? $parent['twitter_url'] : ''}}" name="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}" aria-describedby="inputGroupPrepend">
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
                                        <input type="text" class="form-control" name="linkedin_url" value="{{ isset($parent['linkedin_url']) ? $parent['linkedin_url'] : ''}}" placeholder="{{ __('messages.enter_linkedIn_url') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                    <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary-bl waves-effect waves-light" style="width: 100px; margin-right: 15px;">
                        {{ __('messages.update') }}
                    </button>
                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>-->
                </div>
                </div> <!-- end card-->

                
 
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

    $("#country").countrySelect({
        responsiveDropdown: true
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