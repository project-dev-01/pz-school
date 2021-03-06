@extends('layouts.admin-layout')
@section('title','Edit Guardian')
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
        content: 'Unlock';
        transition: all 0.3s ease 0.2s;
    }

    .switch input+span strong:after {
        content: 'Lock';
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
</style>
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
                <h4 class="page-title">Guardian Profile</h4>
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
                        <img src="{{ asset('public/users/images//') }}/{{$parent['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                        <img src="{{ asset('public/images/users/default.jpg') }}" alt="" class="img-fluid mx-auto d-block rounded">
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
                            <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#basic_details" role="button" aria-expanded="false" aria-controls="basic_details"><i class="fas fa-user-edit"></i> Basic Details</span>
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
                                            Guardian Details
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-3">
                                                <div class="mt-3">
                                                    <input type="hidden" name="old_photo" id="oldPhoto" value="{{ $parent['photo'] }}" />
                                                    <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ $parent['photo'] && asset('public/users/images/').'/'.$parent['photo'] ? asset('public/users/images/').'/'.$parent['photo'] : asset('public/images/users/default.jpg') }}" />
                                                    <p class="text-muted text-center mt-2 mb-0">Photo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="photo">Profile Picture</label>
                                                <div class="containers-img">
                                                    <div class="imageWrapper">
                                                    @if($parent['photo'])
                                                        <img src="{{ asset('public/users/images//') }}/{{$parent['photo']}}" alt="" class="image">
                                                    @else
                                                        <img src="{{ asset('public/images/users/default.jpg') }}" alt="" class="image">
                                                    @endif
                                                    </div>
                                                </div>

                                                <button class="file-upload">
                                                    <input type="file" name="photo" id="photo" class="file-input">Choose File
                                                </button>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['first_name']}}" name="first_name" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-user"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['last_name']}}" name="last_name" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">Choose Gender</option>
                                                    <option value="Male" {{$parent['gender'] == "Male" ? "selected" : ""}}>Male</option>
                                                    <option value="Female" {{$parent['gender'] == "Female" ? "selected" : ""}}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="birthday">Date Of Birth</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-birthday-cake"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="date_of_birth" value="{{$parent['date_of_birth']}}" id="date_of_birth">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Passport">Passport Number</label>
                                                <input type="text" class="form-control" name="passport" placeholder="Passport Number" value="{{$parent['passport']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nric">NRIC Number</label>
                                                <input type="text" class="form-control" value="{{$parent['nric']}}" name="nric" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="blooddgrp">Blood Group</label>
                                                <select class="form-control" name="blood_group">
                                                    <option value="">Pick Blood Type</option>
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
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" name="mobile_no" id="mobile_no" value="{{$parent['mobile_no']}}" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <select class="form-control" name="religion">
                                                    <option value="">Choose Religion</option>
                                                    @forelse($religion as $r)
                                                    <option value="{{$r['id']}}" {{$parent['religion'] == $r['id'] ? "selected" : ""}}>{{$r['religions_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="race">Race</label>
                                                <select class="form-control" name="race">
                                                    <option value="">Choose race</option>
                                                    @forelse($races as $r)
                                                    <option value="{{$r['id']}}" {{$parent['race'] == $r['id'] ? "selected" : ""}}>{{$r['races_name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="education">Education</label>
                                                <select class="form-control" name="education">
                                                    <option value="">Choose Education</option>
                                                    @forelse($education as $e)
                                                    <option value="{{$e['id']}}" {{$parent['education'] == $e['id'] ? "selected" : ""}}>{{$e['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="occupation">Occupation<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{$parent['occupation']}}" name="occupation" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="income">Income</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-calculator"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['income']}}" name="income" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" value="{{$parent['country']}}" name="country" id="country" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State/Province</label>
                                                <input type="text" class="form-control" value="{{$parent['state']}}" name="state" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" value="{{$parent['city']}}" name="city" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="post_code">Zip/Postal Code</label>
                                                <input type="text" class="form-control" value="{{$parent['post_code']}}" name="post_code" data-parsley-trigger="change">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Address 1</label>
                                                <input class="form-control" name="address" id="address" value="{{$parent['address']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address_2">Address 2</label>
                                                <input class="form-control" name="address_2" id="address_2" value="{{$parent['address_2']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            Login Details
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="email">Email<span class="text-danger">*</span></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="far fa-envelope-open"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['email']}}" name="email" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label class="switch">Authentication

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
                                        <h4 class="navv">
                                            Social Links
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="facebook_url">Facebook</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-facebook-f"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['facebook_url']}}" name="facebook_url" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="twitter_url">Twitter</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-twitter"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['twitter_url']}}" name="twitter_url" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="linkedin_url">Linkedin</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fab fa-linkedin-in"></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{$parent['linkedin_url']}}" name="linkedin_url" aria-describedby="inputGroupPrepend">
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
                                            Change Password
                                            <h4>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="password">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="confirm_password">Retype Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-unlock"></span>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" name="confirm_password" aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Update
                                </button>
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
                    <span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#child_detail" role="button" aria-expanded="false" aria-controls="child_detail"><i class="fas fa-user-graduate"></i> Child Details </span>
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
                                                <img src="{{ asset('public/users/images//') }}/{{$child['photo']}}" alt="" class="avatar-xl">
                                                @else
                                                <img src="{{ asset('public/images/users/default.jpg') }}" alt="" class="avatar-xl">
                                                @endif
                                            </div>
                                            <div class="col-sm-8">
                                                <h4 class="title">{{$child['first_name']}} {{$child['last_name']}}</h4>
                                                <div class="info">
                                                    <span> Class: {{$child['class_name']}} ({{$child['section_name']}})</span>
                                                </div>
                                                <br>
                                                <div class="profile">
                                                    <a class="text-muted mail-subj" href="{{route('admin.student.details',$child['id'])}}" target="_blank">Profile</a>
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
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/parent.js') }}"></script>
@endsection