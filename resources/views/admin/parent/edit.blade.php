@extends('layouts.admin-layout')
@section('title','Edit Guardian')
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
@section('content')
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
                <h4 class="page-title">{{ __('messages.Parent_Guardian_Profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-xl-3">
                        @if($parent['photo'])
                        <img src="{{ config('constants.image_url').'/public/users/images/' }}/{{$parent['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                        <img src="{{ config('constants.image_url').'/public/images/users/default.jpg' }}" alt="" class="img-fluid mx-auto d-block rounded">
                        @endif

                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">
                            <h1 class="mb-3">{{$parent['first_name']}} {{$parent['last_name']}}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div>
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-user-tag"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$parent['occupation']}}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$parent['income']}}</a>
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="media mb-2">
                                                <div class="avatar-xs bg-success rounded-circle">
                                                    <span class="avatar-title font-14 font-weight-bold text-white">
                                                        <i class="fas fa-phone"></i></span>
                                                </div>
                                                <div class="media-body pl-2">
                                                    <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                        <a href="javascript: void(0);" class="text-reset">{{$parent['mobile_no']}}</a>
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
                                                        <a href="javascript: void(0);" class="text-reset">{{$parent['email']}}</a>
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
                                                        <a href="javascript: void(0);" class="text-reset">{{$parent['address']}}</a>
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
                            <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#basic_details" role="button" aria-expanded="false" aria-controls="basic_details"><i class="fas fa-user-edit"></i>{{ __('messages.basic_details') }}</span>
                        </div>
                        <div class="col-lg-4">
                            <!-- <div class="text-lg-right mt-3 mt-lg-0">
                                    <button type="button" class="btn btn-white btn-rounded waves-effect waves-light mr-1" data-toggle="modal" data-target="#authenticationModal"><i class="fas fa-lock mr-1"></i> Authentication</button>
                            </div> -->
                        </div><!-- end col-->
                    </div> <!-- end row -->
                    <br>
                    <div class="collapse" id="basic_details">
                        <form id="editParent" method="post" action="{{ route('admin.parent.update') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{$parent['id']}}">
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.parent') }}/{{ __('messages.guardian_details') }}
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-3">
                                                <div class="mt-3">
                                                    <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $parent['photo'] }}" />
                                                    <input type="file" name="photo" id="photo" class="dropify-im" data-max-file-size="2M" data-plugins="dropify" data-default-file="{{ $parent['photo'] && config('constants.image_url').'/public/users/images/'.$parent['photo'] ? config('constants.image_url').'/public/users/images/'.$parent['photo'] : config('constants.image_url').'/public/images/users/default.jpg' }}" />
                                                    <p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['first_name']}}" name="first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="last_name">{{ __('messages.last_name') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['last_name']}}" name="last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('messages.gender') }}</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">{{ __('messages.select_gender') }}</option>
                                                    <option value="Male" {{$parent['gender'] == "Male" ? "selected" : ""}}>{{ __('messages.male') }}</option>
                                                    <option value="Female" {{$parent['gender'] == "Female" ? "selected" : ""}}>{{ __('messages.female') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="birthday">{{ __('messages.date_of_birth') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-birthday-cake"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="date_of_birth" value="{{$parent['date_of_birth']}}" id="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nric">{{ __('messages.nric_number') }}</label>
                                                <input type="text" maxlength="16" class="form-control" value="{{$parent['nric']}}" id="nric" name="nric" placeholder="{{ __('messages.enter_nric_number') }}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                <input type="text" maxlength="20" class="form-control" name="passport" placeholder="999999-99-9999" value="{{$parent['passport']}}">
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
                                                    <option value="{{$r['id']}}" {{$parent['race'] == $r['id'] ? "selected" : ""}}>{{$r['races_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="religion">{{ __('messages.religion') }}</label>
                                                <select class="form-control" name="religion">
                                                    <option value="">{{ __('messages.select_religion') }}</option>
                                                    @forelse($religion as $r)
                                                    <option value="{{$r['id']}}" {{$parent['religion'] == $r['id'] ? "selected" : ""}}>{{$r['religions_name']}}</option>
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
                                                    <option {{$parent['blood_group'] == "O+" ? "selected" : ""}}>O+</option>
                                                    <option {{$parent['blood_group'] == "A+" ? "selected" : ""}}>A+</option>
                                                    <option {{$parent['blood_group'] == "B+" ? "selected" : ""}}>B+</option>
                                                    <option {{$parent['blood_group'] == "AB+" ? "selected" : ""}}>AB+</option>
                                                    <option {{$parent['blood_group'] == "O-" ? "selected" : ""}}>O-</option>
                                                    <option {{$parent['blood_group'] == "A-" ? "selected" : ""}}>A-</option>
                                                    <option {{$parent['blood_group'] == "B-" ? "selected" : ""}}>B-</option>
                                                    <option {{$parent['blood_group'] == "AB-" ? "selected" : ""}}>AB-</option>
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
                                                    <option value="{{$e['id']}}" {{$parent['education'] == $e['id'] ? "selected" : ""}}>{{$e['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{$parent['occupation']}}" name="occupation" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="income">{{ __('messages.income') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calculator"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['income']}}" name="income" placeholder="{{ __('messages.enter_income') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">{{ __('messages.address_1') }}</label>
                                                <input class="form-control" name="address" id="address" value="{{$parent['address']}}" placeholder="{{ __('messages.enter_address_1') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_2">{{ __('messages.address_2') }}</label>
                                                <input class="form-control" name="address_2" id="address_2" value="{{$parent['address_2']}}" placeholder="{{ __('messages.enter_address_2') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">{{ __('messages.city') }}</label>
                                                <input type="text" class="form-control" value="{{$parent['city']}}" name="city" data-parsley-trigger="change" placeholder="{{ __('messages.enter_city') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="post_code">{{ __('messages.zip_postal_code') }}</label>
                                                <input type="text" class="form-control" value="{{$parent['post_code']}}" name="post_code" data-parsley-trigger="change" placeholder="{{ __('messages.state') }}/{{ __('messages.province') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">{{ __('messages.state') }}/{{ __('messages.province') }}</label>
                                                <input type="text" class="form-control" value="{{$parent['state']}}" name="state" data-parsley-trigger="change" placeholder="{{ __('messages.state') }}/{{ __('messages.province') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">{{ __('messages.country') }}</label>
                                                <input type="text" class="form-control" value="{{$parent['country']}}" name="country" id="country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control number_validation" name="mobile_no" id="mobile_no" value="{{$parent['mobile_no']}}" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.login_details') }}
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
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
                                                    <input type="text" class="form-control" value="{{$parent['email']}}" name="email" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label class="switch">{{ __('messages.authentication') }}

                                                    <input id="edit_status" name="status" type="checkbox" {{ $parent['status'] == "1" ? "checked" : "" }}>
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
                                            <h4 class="header-title">{{ __('messages.turn_on') }} / {{ __('messages.turn_off') }}</h4>
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
                                        <h4 class="navv">
                                            {{ __('messages.social_links') }}
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
                                                    <input type="text" class="form-control" value="{{$parent['facebook_url']}}" name="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}" aria-describedby="inputGroupPrepend">
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
                                                    <input type="text" class="form-control" value="{{$parent['twitter_url']}}" name="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}" aria-describedby="inputGroupPrepend">
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
                                                    <input type="text" class="form-control" value="{{$parent['linkedin_url']}}" name="linkedin_url" placeholder="{{ __('messages.enter_linkedIn_url') }}" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.change_password') }}
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
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="********" aria-describedby="inputGroupPrepend">
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
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="********" aria-describedby="inputGroupPrepend">
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
                                <a href="{{ route('admin.parent') }}" class="btn btn-primary-bl waves-effect waves-light">
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
                    <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#child_detail" role="button" aria-expanded="false" aria-controls="child_detail"><i class="fas fa-user-graduate"></i>{{ __('messages.child_details') }} </span>
                    <br><br>
                    <div class="collapse" id="child_detail">
                        <div class="row">
                            @forelse($childs as $child)
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card text-xs-center">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
                                                @if($child['photo'])
                                                <img src="{{ config('constants.image_url').'/public/users/images/' }}/{{$child['photo']}}" alt="" class="avatar-xl">
                                                @else
                                                <img src="{{ config('constants.image_url').'/public/images/users/default.jpg' }}" alt="" class="avatar-xl">
                                                @endif
                                            </div>
                                            <div class="col-sm-8">
                                                <h4 class="title">{{$child['first_name']}} {{$child['last_name']}}</h4>
                                                <div class="info">
                                                    <span> Class: {{$child['class_name']}} ({{$child['section_name']}})</span>
                                                </div>
                                                <br>
                                                <div class="profile">
                                                    <a class="text-mutedd mail-subj" style="color: #0ABAB5;" href="{{route('admin.student.details',$child['id'])}}" target="_blank">{{ __('messages.profile') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="alert alert-subl mt-md text-center text-danger">No Childs Available !</div>
                            @endforelse
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
    var indexParent = "{{ route('admin.parent') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
</script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<!-- <script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/parent.js') }}"></script>
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
        var $form_2 = $('#editParent');
        $form_2.validate({
            debug: true
        });

        $('#nric').rules("add", {
            required: true
        });

        $('#nric').mask("000000-00-0000", {
            reverse: true
        });
        // nric validation end
    });
</script>
@endsection