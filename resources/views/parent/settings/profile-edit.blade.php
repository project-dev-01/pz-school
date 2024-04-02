@extends('layouts.admin-layout')
@section('title','Profile Edit')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('css')
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

                <div class="card">

                    <ul class="nav nav-tabs" style="display: block;">
                        <li class="nav-item">
                            <h4 class="navv float-left">{{ __('messages.guardian_details') }}</h4>
                        </li>
                    </ul>

                    <div class="card-body">

                        <div id="guardian_details">

                            <input type="hidden" name="guardian_id" value="{{ isset($guardian['id']) ? $guardian['id'] : ''}}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_last_name" value="{{ isset($guardian['last_name']) ? $guardian['last_name'] : ''}}" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name" value="{{ isset($guardian['middle_name']) ? $guardian['middle_name'] : ''}}" name="guardian_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_first_name" value="{{ isset($guardian['first_name']) ? $guardian['first_name'] : ''}}" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_last_name_furigana" value="{{ isset($guardian['last_name_furigana']) ? $guardian['last_name_furigana'] : ''}}" name="guardian_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name_furigana" value="{{ isset($guardian['middle_name_furigana']) ? $guardian['middle_name_furigana'] : ''}}" name="guardian_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_first_name_furigana" value="{{ isset($guardian['first_name_furigana']) ? $guardian['first_name_furigana'] : ''}}" name="guardian_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_last_name_english" value="{{ isset($guardian['last_name_english']) ? $guardian['last_name_english'] : ''}}" name="guardian_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_middle_name_english" value="{{ isset($guardian['middle_name_english']) ? $guardian['middle_name_english'] : ''}}" name="guardian_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_first_name_english" value="{{ isset($guardian['first_name_english']) ? $guardian['first_name_english'] : ''}}" name="guardian_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                        <select id="guardian_relation" name="guardian_relation" class="form-control copy_guardian_info">
                                            <option value="">{{ __('messages.select_relation') }}</option>
                                            @forelse($relation as $r)
                                            <option value="{{$r['id']}}" data-parent-id="{{$r['parent']}}" {{ isset($guardian_relation) ? $guardian_relation == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_email" readonly value="{{ isset($guardian['email']) ? $guardian['email'] : ''}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info number_validation" id="guardian_phone_number" value="{{ isset($guardian['phone_number']) ? $guardian['phone_number'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="guardian_phone_number" class="error"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_guardian_info" id="guardian_occupation" name="guardian_occupation" value="{{ isset($guardian['occupation']) ? $guardian['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian__name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="guardian_company_name_japan" name="guardian_company_name_japan" value="{{ isset($guardian['company_name_japan']) ? $guardian['company_name_japan'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="guardian_company_name_local" name="guardian_company_name_local" value="{{ isset($guardian['company_name_local']) ? $guardian['company_name_local'] : ''}}" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  number_validation " id="guardian_company_phone_number" name="guardian_company_phone_number" value="{{ isset($guardian['company_phone_number']) ? $guardian['company_phone_number'] : ''}}" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="guardian_company_phone_number" class="error"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
                                        <select id="guardian_employment_status" name="guardian_employment_status" class="form-control">
                                            <option value="">{{ __('messages.select_employment_status') }}</option>
                                            <option value="Expat" {{ isset($guardian['employment_status']) ? $guardian['employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
                                            <option value="Local Hire" {{ isset($guardian['employment_status']) ? $guardian['employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
                                            <option value="Public Servant" {{ isset($guardian['employment_status']) ? $guardian['employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
                                            <option value="Self-Employed" {{ isset($guardian['employment_status']) ? $guardian['employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
                                            <option value="Others" {{ isset($guardian['guardian_employment_status']) ? $guardian['guardian_employment_status'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="passport_father_old_photo" id="passport_father_old_photo" value="{{ isset($father['passport_photo']) ? $father['passport_photo'] : ''}}" />

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="passport_father_photo">{{ __('messages.passport_image_father_only_if_malaysian') }}<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="passport_father_photo" class="custom-file-input" name="passport_father_photo" accept="image/png, image/gif, image/jpeg" value="{{ isset($father['passport_photo']) ? $father['passport_photo'] : ''}}">
                                                <label class="custom-file-label" for="passport_father_photo">{{ __('messages.choose_file') }}</label>
                                            </div>
                                        </div>
                                        <label for="passport_father_photo" class="error"></label>
                                        @if(isset($father['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$father['passport_photo'])
                                        <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$father['passport_photo'] }}" target="_blank"> {{ __('messages.passport_image_father_only_if_malaysian') }} </a>
                                        @endif
                                        <span id="passport_father_photo_name"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <input type="hidden" name="passport_mother_old_photo" id="passport_mother_old_photo" value="{{ isset($mother['passport_photo']) ? $mother['passport_photo'] : ''}}" />

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="passport_mother_photo">{{ __('messages.passport_image_mother_only_if_malaysian') }}<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="passport_mother_photo" class="custom-file-input" name="passport_mother_photo" accept="image/png, image/gif, image/jpeg">
                                                <label class="custom-file-label" for="passport_mother_photo">{{ __('messages.choose_file') }}</label>
                                            </div>
                                        </div>
                                        <label for="passport_mother_photo" class="error"></label>
                                        @if(isset($mother['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$mother['passport_photo'])
                                        <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$mother['passport_photo'] }}" target="_blank"> {{ __('messages.passport_image_mother_only_if_malaysian') }} </a>
                                        @endif
                                        <span id="passport_mother_photo_name"></span>
                                    </div>
                                </div>


                                <input type="hidden" name="visa_father_old_photo" id="visa_father_old_photo" value="{{ isset($father['visa_photo']) ? $father['visa_photo'] : ''}}" />

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="visa_father_photo">{{ __('messages.visa_image_father_only_for_non_malaysian') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="visa_father_photo" class="custom-file-input" name="visa_father_photo" accept="image/png, image/gif, image/jpeg">
                                                <label class="custom-file-label" for="visa_father_photo">{{ __('messages.choose_file') }}</label>
                                            </div>
                                        </div>
                                        @if(isset($father['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$father['visa_photo'])
                                        <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$father['visa_photo'] }}" target="_blank"> {{ __('messages.visa_image_father_only_for_non_malaysian') }} </a>
                                        @endif
                                        <span id="visa_father_photo_name"></span>
                                    </div>
                                </div>

                                <input type="hidden" name="visa_mother_old_photo" id="visa_mother_old_photo" value="{{ isset($mother['visa_photo']) ? $mother['visa_photo'] : ''}}" />

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="visa_mother_photo">{{ __('messages.visa_image_mother_only_for_non_malaysian') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="visa_mother_photo" class="custom-file-input" name="visa_mother_photo" accept="image/png, image/gif, image/jpeg">
                                                <label class="custom-file-label" for="visa_mother_photo">{{ __('messages.choose_file') }}</label>
                                            </div>
                                        </div>
                                        @if(isset($mother['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$mother['visa_photo'])
                                        <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$mother['visa_photo'] }}" target="_blank"> {{ __('messages.visa_image_mother_only_for_non_malaysian') }} </a>
                                        @endif
                                        <span id="visa_mother_photo_name"></span>
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
                                <input type="checkbox" class="custom-control-input skip" id="skip_mother_details" name="skip_mother_details" {{ isset($mother['first_name']) ? "" : 'checked'}}>
                                <label class="custom-control-label" for="skip_mother_details">{{ __('messages.skip_mother_details') }}</label>
                            </div>
                        </div>
                        <div id="mother_details" style="display: {{ isset($mother['first_name']) ? '' : 'none' }}">
                            <input type="hidden" name="mother_id" value="{{ isset($mother['id']) ? $mother['id'] : ''}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name" value="{{ isset($mother['last_name']) ? $mother['last_name'] : ''}}" name="mother_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name" value="{{ isset($mother['middle_name']) ? $mother['middle_name'] : ''}}" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name" value="{{ isset($mother['first_name']) ? $mother['first_name'] : ''}}" name="mother_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_furigana" value="{{ isset($mother['last_name_furigana']) ? $mother['last_name_furigana'] : ''}}" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_furigana" value="{{ isset($mother['middle_name_furigana']) ? $mother['middle_name_furigana'] : ''}}" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_furigana" value="{{ isset($mother['first_name_furigana']) ? $mother['first_name_furigana'] : ''}}" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_english" value="{{ isset($mother['last_name_english']) ? $mother['last_name_english'] : ''}}" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_english" value="{{ isset($mother['middle_name_english']) ? $mother['middle_name_english'] : ''}}" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_english" value="{{ isset($mother['first_name_english']) ? $mother['first_name_english'] : ''}}" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form country" id="mother_nationality" name="mother_nationality" value="{{ isset($mother['nationality']) ? $mother['nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  mother_form" id="mother_email" value="{{ isset($mother['email']) ? $mother['email'] : ''}}" name="mother_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form number_validation" id="mother_phone_number" value="{{ isset($mother['mobile_no']) ? $mother['mobile_no'] : ''}}" name="mother_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="mother_phone_number" class="error"></label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select    id="mother_occupation" name="mother_occupation" class="form-control copy_parent_info mother_form">
                                                            <option value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($mother['occupation']) ? $mother['occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($mother['occupation']) ? $mother['occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($mother['occupation']) ? $mother['occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($mother['occupation']) ? $mother['occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mother_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info mother_form" id="mother_occupation" name="mother_occupation" value="{{ isset($mother['occupation']) ? $mother['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
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
                                <input type="checkbox" class="custom-control-input skip" id="skip_father_details" name="skip_father_details" {{ isset($father['first_name']) ? "" : 'checked'}}>
                                <label class="custom-control-label" for="skip_father_details">{{ __('messages.skip_father_details') }}</label>
                            </div>
                        </div>

                        <div id="father_details" style="display: {{ isset($father['first_name']) ? '' : 'none' }}">
                            <input type="hidden" name="father_id" value="{{ isset($father['id']) ? $father['id'] : ''}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name" value="{{ isset($father['last_name']) ? $father['last_name'] : ''}}" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name">{{ __('messages.middle_name') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name" value="{{ isset($father['middle_name']) ? $father['middle_name'] : ''}}" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name" value="{{ isset($father['first_name']) ? $father['first_name'] : ''}}" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana" value="{{ isset($father['last_name_furigana']) ? $father['last_name_furigana'] : ''}}" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana" value="{{ isset($father['middle_name_furigana']) ? $father['middle_name_furigana'] : ''}}" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_furigana" value="{{ isset($father['first_name_furigana']) ? $father['first_name_furigana'] : ''}}" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english" value="{{ isset($father['last_name_english']) ? $father['last_name_english'] : ''}}" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english" value="{{ isset($father['middle_name_english']) ? $father['middle_name_english'] : ''}}" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_first_name_english" value="{{ isset($father['first_name_english']) ? $father['first_name_english'] : ''}}" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form country" id="father_nationality" name="father_nationality" value="{{ isset($father['nationality']) ? $father['nationality'] : ''}}" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control  father_form" id="father_email" value="{{ isset($father['email']) ? $father['email'] : ''}}" name="father_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form number_validation" id="father_phone_number" value="{{ isset($father['mobile_no']) ? $father['mobile_no'] : ''}}" name="father_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
                                        <label for="father_phone_number" class="error"></label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                        <select  id="father_occupation" name="father_occupation" class="form-control">
                                                            <option  value="">{{ __('messages.select_occupation') }}</option>
                                                            <option {{ isset($father['occupation']) ? $father['occupation'] == "Business" ? 'selected' : '' : '' }}>Business</option>
                                                            <option {{ isset($father['occupation']) ? $father['occupation'] == "IT/Software" ? 'selected' : '' : '' }}>IT/Software</option>
                                                            <option {{ isset($father['occupation']) ? $father['occupation'] == "Civil Department" ? 'selected' : '' : '' }}>Civil Department</option>
                                                            <option {{ isset($father['occupation']) ? $father['occupation'] == "Others" ? 'selected' : '' : '' }}>Others</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="father_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control copy_parent_info father_form" id="father_occupation" name="father_occupation" value="{{ isset($father['occupation']) ? $father['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">
                                {{ __('messages.family_details') }}
                            </h4>
                        </li>
                    </ul><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="japan_postalcode">{{ __('messages.japan_address_postal') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="japan_postalcode" value="{{ isset($guardian['japan_postalcode']) ? $guardian['japan_postalcode'] : ''}}" name="japan_postalcode" placeholder="" aria-describedby="inputGroupPrepend">
                                    <label for="japan_postalcode" class="error"></label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="japan_contact_no">{{ __('messages.japan_contact_phone_number') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number_validation" id="japan_contact_no" value="{{ isset($guardian['japan_contact_no']) ? $guardian['japan_contact_no'] : ''}}" name="japan_contact_no" placeholder="" aria-describedby="inputGroupPrepend">
                                    <label for="japan_contact_no" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="japan_emergency_sms">{{ __('messages.Emergency_tel_sms') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number_validation" id="japan_emergency_sms" value="{{ isset($guardian['japan_emergency_sms']) ? $guardian['japan_emergency_sms'] : ''}}" name="japan_emergency_sms" placeholder="" aria-describedby="inputGroupPrepend">
                                    <label for="japan_emergency_sms" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="japan_address">{{ __('messages.japan_address') }}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="japan_address" name="japan_address" placeholder="" aria-describedby="inputGroupPrepend">{{ isset($guardian['japan_address']) ? $guardian['japan_address'] : ''}}</textarea>
                                    <label for="japan_address" class="error"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stay_category">{{ __('messages.stay_category') }}<span class="text-danger">*</span></label>
                                    <select id="stay_category" name="stay_category" class="form-control">
                                        <option value="">{{ __('messages.select_stay_category') }}</option>
                                        <option value="Long stay" {{ isset($guardian['stay_category']) ? $guardian['stay_category'] == "Long stay" ? 'selected' : '' : '' }}>{{ __('messages.long_stay') }}</option>
                                        <option value="PR" {{ isset($guardian['stay_category']) ? $guardian['stay_category'] == "PR" ? 'selected' : '' : '' }}>{{ __('messages.pr_stay') }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">
                                {{ __('messages.personal_details') }}
                            </h4>
                        </li>
                    </ul><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="japanese_association_membership_image_supplimental">{{ __('messages.japanese_association_membership_image_supplimental') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="japanese_association_membership_image_supplimental" class="custom-file-input" name="japanese_association_membership_image_supplimental" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="japanese_association_membership_image_supplimental">{{ __('messages.choose_file') }}</label>
                                            <input type="hidden" id="japanese_association_membership_image_supplimental_old" value="{{ isset($guardian['japanese_association_membership_image_supplimental']) ?$guardian['japanese_association_membership_image_supplimental'] : ''}}" name="japanese_association_membership_image_supplimental_old">
                                        </div>
                                    </div>
                                    @if(isset($guardian['japanese_association_membership_image_supplimental']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$guardian['japanese_association_membership_image_supplimental'])
                                    <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$guardian['japanese_association_membership_image_supplimental'] }}" target="_blank"> {{ __('messages.japanese_association_membership_image_supplimental') }} </a>
                                    @endif
                                    <span id="japanese_association_membership_image_supplimental_name"></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- <script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script> -->
<!-- <script src="{{ asset('libs/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script> -->
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('libs/autonumeric/autoNumeric-min.js') }}"></script>

<!-- Init js-->
<!-- <script src="{{ asset('js/pages/form-masks.init.js') }}"></script>
<script src="{{ asset('libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script> -->
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<script>
    $(".country").countrySelect({
        defaultCountry: "jp",
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
    });
    function initializeIntlTelInput(inputSelector) {
    var input = document.querySelector(inputSelector);
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
}
initializeIntlTelInput("#mother_phone_number");
initializeIntlTelInput("#father_phone_number");
initializeIntlTelInput("#phone_number");
initializeIntlTelInput("#japan_emergency_sms");
initializeIntlTelInput("#japan_contact_no");
initializeIntlTelInput("#guardian_phone_number");
initializeIntlTelInput("#guardian_company_phone_number");
</script>
<script>
    //event routes
    var eventList = "{{ route('parent.event.list') }}";
    var eventDetails = "{{ route('parent.event.details') }}";
</script>
<!-- <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script> -->
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