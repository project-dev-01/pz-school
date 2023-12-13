@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.student_profile') . '')
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
                <h4 class="page-title">{{ __('messages.student_profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form id="updateStudentProfile" method="post" action="{{ route('parent.student.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ isset($student['id']) ? $student['id'] : ''}}">


                        <div class="card">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.student_profile') }}</h4>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtarea_paddress">{{ __('messages.address_1') }}</label>
                                            <input type="" id="txtarea_paddress" class="form-control" placeholder="{{ __('messages.enter_address_1') }}" name="txtarea_paddress" data-parsley-trigger="change" value="{{ isset($student['current_address']) ? $student['current_address'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtarea_permanent_address">{{ __('messages.address_2') }}</label>
                                            <input type="" id="txtarea_permanent_address" class="form-control" placeholder="{{ __('messages.enter_address_2') }}" name="txtarea_permanent_address" data-parsley-trigger="change" value="{{ isset($student['permanent_address']) ? $student['permanent_address'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_city">{{ __('messages.city') }}</label>
                                            <input type="" id="drp_city" class="form-control" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change" value="{{ isset($student['city']) ? $student['city'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_post_code">{{ __('messages.zip_postal_code') }}</label>
                                            <input type="" id="drp_post_code" class="form-control" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change" value="{{ isset($student['post_code']) ? $student['post_code'] : ''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_state">{{ __('messages.state_province') }}</label>
                                            <input type="" id="drp_state" placeholder="{{ __('messages.state_province') }}" class="form-control" name="drp_state" data-parsley-trigger="change" value="{{ isset($student['state']) ? $student['state'] : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drp_country">{{ __('messages.country') }}</label>
                                            <input type="" id="drp_country" placeholder="{{ __('messages.country') }}" class="form-control country" name="drp_country" data-parsley-trigger="change" value="{{ isset($student['country']) ? $student['country'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control number_validation" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" value="{{ isset($student['mobile_no']) ? $student['mobile_no'] : ''}}" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    @if($form_field['race'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_caste">{{ __('messages.race') }}</label>
                                            <select class="form-control" name="txt_race" id="addRace">
                                                <option value="">{{ __('messages.select_race') }}</option>
                                                @forelse($races as $r)
                                                <option value="{{$r['id']}}" {{ isset($student['race']) ?  $student['race'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['races_name']}}</option>
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
                                                <option value="{{$r['id']}}" {{ isset($student['religion']) ?  $student['religion'] == $r['id'] ? 'selected' : '' : "" }}>{{$r['religions_name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['blood_group'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                            <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                <option value="">{{ __('messages.select_blood_group') }}</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "O+" ? 'Selected' : '' : "" }}>O+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "A+" ? 'Selected' : '' : "" }}>A+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "B+" ? 'Selected' : '' : "" }}>B+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "AB+" ? 'Selected' : '' : "" }}>AB+</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "O-" ? 'Selected' : '' : "" }}>O-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "A-" ? 'Selected' : '' : "" }}>A-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "B-" ? 'Selected' : '' : "" }}>B-</option>
                                                <option {{ isset($student['blood_group']) ?  $student['blood_group'] == "AB-" ? 'Selected' : '' : "" }}>AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['nationality'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nationality">{{ __('messages.nationality') }}</label>
                                            <input type="text" maxlength="50" id="nationality" class="form-control country" value="{{$student['nationality']}}" placeholder="{{ __('messages.nationality') }}" name="nationality" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    @endif

                                    @if($form_field['nric'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                            <input type="text" maxlength="20" id="txt_nric" class="form-control alloptions" value="{{ isset($student['nric']) ? $student['nric'] : ''}}" placeholder="999999-99-9999" name="txt_nric" data-parsley-trigger="change">
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['passport'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Passport">{{ __('messages.passport_number') }}</label>
                                            <input type="text" maxlength="20" class="form-control" name="txt_passport" placeholder="{{ __('messages.enter_passport_number') }}" value="{{ isset($student['passport']) ? $student['passport'] : ''}}">
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
                                                <input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="{{ isset($student['passport_expiry_date']) ? $student['passport_expiry_date'] : ''}}" aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="passport_old_photo" id="passport_old_photo" value="{{ isset($student['passport_photo']) ? $student['passport_photo'] : ''}}" />

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="passport_photo">{{ __('messages.passport_photo') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="passport_photo">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            @if(isset($student['passport_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['passport_photo'] }}" target="_blank"> {{ __('messages.passport_photo') }} </a>
                                            @endif
                                            <span id="passport_photo_name"></span>
                                        </div>
                                    </div>
                                    @endif
                                    @if($form_field['visa'] == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_number">{{ __('messages.visa_number') }}</label>
                                            <input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" value="{{ isset($student['visa_number']) ? $student['visa_number'] : ''}}" data-parsley-trigger="change">
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
                                                <input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend" value="{{ isset($student['visa_expiry_date']) ? $student['visa_expiry_date'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="visa_old_photo" id="visa_old_photo" value="{{ isset($student['visa_photo']) ? $student['visa_photo'] : ''}}" />

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="visa_photo">{{ __('messages.visa_photo') }}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg">
                                                    <label class="custom-file-label" for="visa_photo">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            @if(isset($student['visa_photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'])
                                            <a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['visa_photo'] }}" target="_blank"> {{ __('messages.visa_photo') }} </a>
                                            @endif
                                            <span id="visa_photo_name"></span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="card">
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
                                                @forelse($transport as $trans)
                                                <option value="{{$trans['id']}}" {{ isset($student['route_id']) ?  $student['route_id'] == $trans['id'] ? "Selected" : "" : "" }}>{{$trans['name']}}</option>
                                                
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_transport_vechicleno">{{ __('messages.vehicle_number') }}</label>
                                            <select id="drp_transport_vechicleno" name="drp_transport_vechicleno" class="form-control">
                                                <option value="">{{ __('messages.select_vehicle_number') }}</option>

                                                @forelse($vehicle as $veh)
                                                <option value="{{$veh['vehicle_id']}}" {{ isset($student['vehicle_id']) ?  $student['vehicle_id'] == $veh['vehicle_id'] ? "Selected" : "" : "" }}>{{$veh['vehicle_no']}}</option>
                                                
                                                @empty
                                                @endforelse
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
                                                @forelse($hostel as $hos)
                                                <option value="{{$hos['id']}}" {{ isset($student['hostel_id']) ?  $student['hostel_id'] == $hos['id'] ? "Selected" : "" : "" }}>{{$hos['name']}}</option>
                                                
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drp_roomname">{{ __('messages.room_name') }}</label>
                                            <select id="drp_roomname" name="drp_roomname" class="form-control">
                                                <option value="">{{ __('messages.select_room_name') }}</option>

                                                @forelse($room as $roo)
                                                <option value="{{$roo['room_id']}}" {{ isset($student['room_id']) ?  $student['room_id'] == $roo['room_id'] ? "Selected" : "" : "" }}>{{$roo['room_name']}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light">
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
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

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

    $(".country").countrySelect({
        preferredCountries: ['my', 'jp'],
        responsiveDropdown: true
    });
</script>
<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexStudent = "{{ route('admin.student.index') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
    var studentUpdateList = "{{ route('admin.student.update_info_list') }}";
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>


<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/student_update.js') }}"></script>
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