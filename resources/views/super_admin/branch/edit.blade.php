@extends('layouts.admin-layout')
@section('title','Edit Branch')
@section('content')
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
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">Edit Branch</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <form id="edit-branch-form" method="post" action="{{ route('branch.update') }}" autocomplete="off">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{$id}}">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">Edit Branch <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="first_name" value="{{$branch['first_name']}}" placeholder="{{ __('messages.ahmad_ali') }}" id="firstName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">{{ __('messages.last_name') }}</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-graduate"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control shortNameChange" name="last_name" value="{{$branch['last_name']}}" placeholder="Ali" id="lastName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">{{ __('messages.gender') }}</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Choose Gender</option>
                                        <option value="Male" {{$branch['gender'] =="Male" ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{$branch['gender'] =="Male" ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name</label>
                                    <input type="text" maxlength="50" name="branch_name" value="{{$branch['branch_name']}}" class="form-control" placeholder="{{ __('messages.enter_branch_name') }}" name="txt_branchname">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_name">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" name="school_name" value="{{$branch['school_name']}}" class="form-control" placeholder="Enter School Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school_code">School Code</label>
                                    <input type="text" maxlength="50" name="school_code" value="{{$branch['school_code']}}" class="form-control" placeholder="{{ __('messages.enter_school_code') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passport">{{ __('messages.passport_number') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$branch['passport']}}" placeholder="{{ __('messages.enter_passport_number') }}" name="passport" id="Passport">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric_number">{{ __('messages.nric_number') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$branch['nric_number']}}" name="nric_number" placeholder="{{ __('messages.enter_nric_number') }}" id="nricNumber">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{$branch['mobile_no']}}" name="mobile_no" id="mobile_no" data-parsley-trigger="change">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="currency">Currency<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" value="{{$branch['currency']}}" name="currency" class="form-control" placeholder="{{ __('messages.enter_currency') }}" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="symbol">Currency Symbol<span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" value="{{$branch['symbol']}}" name="symbol" class="form-control" placeholder="Enter Currency Symbol" data-parsley-trigger="change">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">{{ __('messages.country') }}</label>
                                    <select id="editGetCountry" class="form-control" name="country">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $c)
                                        @if($branch['country_id'] == $c['id'])
                                        <option value="{{$c['id']}}" selected>{{$c['name']}}</option>
                                        @else
                                        <option value="{{$c['id']}}">{{$c['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">{{ __('messages.state') }}/{{ __('messages.province') }}</label>
                                    <select id="editGetState" class="form-control" name="state">
                                        <option value="">Select State</option>
                                        @foreach($states as $s)
                                        @if($branch['state_id'] == $s['id'])
                                        <option value="{{$s['id']}}" selected>{{$s['name']}}</option>
                                        @else
                                        <option value="{{$s['id']}}">{{$s['name']}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">{{ __('messages.city') }}</label>
                                    <select id="editGetCity" class="form-control" name="city">
                                        <option value="">Select City</option>
                                        @foreach($cities as $c)
                                        @if($branch['city_id'] == $c['id'])
                                        <option value="{{$c['id']}}" selected>{{$c['name']}}</option>
                                        @else
                                        <option value="{{$c['id']}}">{{$c['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">{{ __('messages.zip') }}/{{ __('messages.postal_code') }}</label>
                                    <input type="text" class="form-control" value="{{$branch['post_code']}}" name="post_code" id="postCode" placeholder="000000">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address Line 1<span class="text-danger">*</span></label>
                                    <input class="form-control" name="address" value="{{$branch['address']}}" id="address" placeholder="johor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address1">Address Line 2</label>
                                    <input class="form-control" name="address1" value="{{$branch['address1']}}" id="address1" placeholder="johor">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right m-b-0">
                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                        Update
                    </button>
                    <a href="{{ route('branch.index') }}" class="btn btn-primary-bl waves-effect waves-light">
                        Back
                    </a>
                </div>
            </form>

        </div> <!-- container -->
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('public/js/custom/branch.js') }}"></script>
@endsection