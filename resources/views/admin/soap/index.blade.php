@extends('layouts.admin-layout')
@section('title','SOAP')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<style>
    .navtab-bg .nav-link {
    background-color: #bec2c6;
    }
    .text-truncate {   
    font-size: 13px;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    
       
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.soap') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.name') }} :<span class="font-weight-semibold student_name"></span></b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.grade') }} :<span class="font-weight-semibold student_class"></span></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.class') }} :<span class="font-weight-semibold student_section"></span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="tabs">
                <!-- <h4 class="header-title mb-4">SOAP</h4>-->

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#d1" data-toggle="tab"  aria-expanded="false" class="nav-link active">
                        {{ __('messages.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pi1" data-toggle="tab"  data-tab="info" aria-expanded="true" class="nav-link ">
                        {{ __('messages.personal_info') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#subjective" data-toggle="tab" data-soap-type-id="1" data-tab="subjective" aria-expanded="true" class="nav-link">
                        {{ __('messages.s_subjective') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#objective" data-toggle="tab" data-soap-type-id="2" data-tab="objective" aria-expanded="true" class="nav-link">
                        {{ __('messages.o_objective') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#assessment" data-toggle="tab" data-soap-type-id="3" data-tab="assessment" aria-expanded="true" class="nav-link">
                        {{ __('messages.a_assessment') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#plan" data-toggle="tab" data-soap-type-id="4" data-tab="plan" aria-expanded="true" class="nav-link">
                        {{ __('messages.p_plan') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#log" data-toggle="tab"  aria-expanded="true" data-tab="log" class="nav-link">
                        {{ __('messages.logs') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- start Dashboard -->
                    <div class="tab-pane show active" id="d1">

                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">{{ __('messages.old_records') }}<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="oldStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">                          
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_class_id">{{ __('messages.grade') }}</label>
                                                        <select id="old_class_id" class="form-control" name="class_id">
                                                            <option value="">{{ __('messages.select_grade') }}</option>
                                                            @forelse ($class as $clas)
                                                                <option value="{{ $clas['id'] }}">{{ $clas['name'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_section_id">{{ __('messages.class') }}</label>
                                                        <select id="old_section_id" class="form-control" name="section_id">
                                                            <option value="">{{ __('messages.select_class') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_session_id">{{ __('messages.session') }}</label>
                                                        <select id="old_session_id" class="form-control"  name="session_id">                              
                                                        <option value="">{{ __('messages.select_session') }}</option>
                                                            @foreach($session as $ses)
                                                                <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-bl waves-effect waves-light" style="width:80px" type="Save">
                                                {{ __('messages.filter') }}
                                                </button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                            <thead class="">
                                                    <tr>
                                                        <th>{{ __('messages.s.no') }}</th>
                                                        <th colspan="2">{{ __('messages.student_name') }}</th>
                                                        <th>{{ __('messages.email') }}</th>
                                                        <th>{{ __('messages.grade') }}</th>
                                                        <th>{{ __('messages.class') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="old_student_body">
                                                    @forelse($soap_student_list as $key=>$student)
                                                        <tr class="student-row">
                                                            @php $key++; @endphp
                                                            <td>
                                                                {{$key}}
                                                            </td>
                                                            <td style="width: 36px;">
                                                                <img src="{{ $student['photo'] }} && config('constants.image_url').'/public/users/images/'.$student['photo'] ? config('constants.image_url').'/public/users/images/'.$student['photo'] : {{ config('constants.image_url').'/public/images/users/default.jpg' }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                            </td>
                                                            <td class="stu-name">
                                                                <h5 class="m-0 font-weight-normal ">{{$student['name']}}</h5>
                                                            </td>
                                                            <input type="hidden" class="student" value="{{$student['id']}}">
                                                            <td>
                                                                {{$student['email']}}
                                                            </td>
                                                            <td class="stu-class">
                                                                {{$student['class_name']}}
                                                            </td>
                                                            <td class="stu-section">
                                                                {{$student['section_name']}}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr >
                                                            <td colspan="6" class="text-center">{{ __('messages.no_data_available') }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">{{ __('messages.new_records') }}<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="newStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.grade') }}</label>
                                                        <select id="class_id" class="form-control" name="class_id">
                                                            <option value="">{{ __('messages.select_grade') }}</option>
                                                            @forelse ($class as $clas)
                                                                <option value="{{ $clas['id'] }}">{{ $clas['name'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="section_id">{{ __('messages.class') }}</label>
                                                        <select id="section_id" class="form-control" name="section_id">
                                                            <option value="">{{ __('messages.select_class') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="session_id">{{ __('messages.session') }}</label>
                                                        <select id="session_id" class="form-control"  name="session_id">                              
                                                        <option value="">{{ __('messages.select_session') }}</option>
                                                            @foreach($session as $ses)
                                                                <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary-bl waves-effect waves-light" style="width:80px" type="Save">
                                                {{ __('messages.filter') }}
                                                </button>
                                            </div>
                                        
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="">
                                                    <tr>
                                                        <th>{{ __('messages.s.no') }}</th>
                                                        <th colspan="2">{{ __('messages.student_name') }}</th>
                                                        <th>{{ __('messages.email') }}</th>
                                                        <th>{{ __('messages.grade') }}</th>
                                                        <th>{{ __('messages.class') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="new_student_body">
                                                    <tr >
                                                        <td colspan="6" class="text-center">{{ __('messages.no_data_available') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <!-- end Dashboard -->
                    <!-- Start personal tab-->
                    <div class="tab-pane" id="pi1">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="">
                                        <!-- Start Personal Info Popup -->
                                        <div class="modal fade viewEvent" id="personalinfo" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="personalinfo" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> {{ __('messages.academic_details') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <style>
                                                                                .table td {
                                                                                    border-top: none;
                                                                                }
                                                                            </style>
                                                                            <tr>
                                                                                <td>{{ __('messages.name') }}</td>
                                                                                <td id="title"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.class') }}</td>
                                                                                <td id="type"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.subject') }}</td>
                                                                                <td id="start_date">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.grade') }}</td>
                                                                                <td id="end_date"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.description') }}</td>
                                                                                <td id="description">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div> <!-- end card-box -->
                                                            </div> <!-- end col -->
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <!-- End Personal Info Popup -->




                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.student_details') }}<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <input type="hidden" name="student_id" id="student_id">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-user-graduate"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
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
                                                                        <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="gender">{{ __('messages.gender') }}</label>
                                                                    <select id="gender" name="gender" class="form-control" disabled>
                                                                        <option value="">{{ __('messages.select_gender') }}
                                                                        </option>
                                                                        <option value="Male">{{ __('messages.male') }}
                                                                        </option>
                                                                        <option value="Female">{{ __('messages.female') }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                                                    <select id="blooddgrp" name="blooddgrp" class="form-control" disabled>
                                                                        <option value="">{{ __('messages.select_blood_group') }}
                                                                        </option>
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
                                                                <div class="form-group mb-3">
                                                                    <label for="dob">{{ __('messages.date_of_birth') }}</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-birthday-cake"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="{{ __('messages.dd_mm_yyyy') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                                    <input type="text" maxlength="50" id="passport" class="form-control alloptions" placeholder="{{ __('messages.enter_passport_number') }}" name="txt_passport" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                                                    <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="{{ __('messages.enter_nric_number') }}" name="txt_nric" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_religion">{{ __('messages.religion') }}</label>
                                                                    <select class="form-control" name="txt_religion" id="religion" disabled>
                                                                        <option value="">{{ __('messages.select_religion') }}</option>
                                                                        @forelse($religion as $r)
                                                                        <option value="{{$r['id']}}">{{$r['religions_name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_caste">{{ __('messages.race') }}</label>
                                                                    <select class="form-control" name="txt_race" id="race" disabled>
                                                                        <option value="">{{ __('messages.select_race') }}</option>
                                                                        @forelse($races as $r)
                                                                        <option value="{{$r['id']}}">{{$r['races_name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                                    <input type="tel" class="form-control" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_country">{{ __('messages.country') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="{{ __('messages.country') }}" name="drp_country" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_state">{{ __('messages.state') }}/{{ __('messages.province') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="{{ __('messages.state') }}/{{ __('messages.province') }}" name="drp_state" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_city">{{ __('messages.city') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_post_code">{{ __('messages.zip_postal_code') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_paddress">{{ __('messages.address_1') }}</label>
                                                                    <input type="text" maxlength="255" id="txtarea_address" class="form-control alloptions" placeholder="{{ __('messages.enter_address_1') }}" name="txtarea_paddress" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_permanent_address">{{ __('messages.address_2') }}</label>
                                                                    <input type="text" maxlength="255" id="txtarea_permanent_address" class="form-control alloptions" placeholder="{{ __('messages.enter_address_2') }}" name="txtarea_permanent_address" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.academic_details') }}</h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                                                    <select id="btwyears" class="form-control" name="year" disabled>
                                                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                                                        @forelse($academic_year_list as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_regiter_no">{{ __('messages.register_number') }}<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="{{ __('messages.enter_register_no') }}" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_roll_no">{{ __('messages.roll_number') }}<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="{{ __('messages.enter_roll_no') }}" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label for="text">{{ __('messages.admission_date') }}<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="far fa-calendar-alt"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="{{ __('messages.dd_mm_yyyy') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                                    <select id="std_class_id" class="form-control" name="std_class_id" disabled>
                                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                                        @foreach($class as $cla)
                                                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                                                    <select id="std_section_id" class="form-control" name="std_section_id" disabled>
                                                                        <option value="">{{ __('messages.select_class') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="categy">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                                                                    <select id="categy" name="categy" class="form-control" disabled>
                                                                        <option value="">{{ __('messages.select_category') }}</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_session_id">{{ __('messages.session') }}</label>
                                                                    <select id="std_session_id" class="form-control" name="std_session_id" disabled>
                                                                        <option value="0">{{ __('messages.select_session') }}</option>
                                                                        @foreach($session as $ses)
                                                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_semester_id">{{ __('messages.semester') }}</label>
                                                                    <select id="std_semester_id" class="form-control" name="std_semester_id" disabled>
                                                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                                                        @foreach($semester as $sem)
                                                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
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
                                                            <h4 class="navv">{{ __('messages.parent') }}/{{ __('messages.guardian_details') }}<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="father_name">{{ __('messages.father_name') }}</label>
                                                                    <input type="text" class="form-control" id="father_name" placeholder="{{ __('messages.john_leo') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="father_id" id="father_id">
                                                                    <div id="father_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_name">{{ __('messages.mother_name') }}</label>
                                                                    <input type="text" class="form-control" id="mother_name" placeholder="{{ __('messages.aisha_mal') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="mother_id" id="mother_id">
                                                                    <div id="mother_list">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_name">{{ __('messages.guardian_name') }}</label>
                                                                    <input type="text" class="form-control" id="guardian_name" placeholder="{{ __('messages.amir_shan') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                                                    <div id="guardian_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="relation">{{ __('messages.guardian_relation') }}</label>
                                                                    <select class="form-control" name="relation" id="relation" disabled>
                                                                        <option value="">{{ __('messages.select_relation') }}</option>
                                                                        @forelse($relation as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>


                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End personal info tab-->    
                    @include('admin.soap.subjective')
                    @include('admin.soap.objective')
                    @include('admin.soap.assessment')
                    @include('admin.soap.plan')
                    @include('admin.soap.log')

                    <!--End tab-->
                    <!--start popup-->

                    <!--Title popup-->
                    <div id="sstt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('messages.title_details') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body p-4" id="modal-body">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--End Title popup-->
                    <!--sub Title popup-->
                    <div id="notes-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('messages.family_details') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <input type="hidden" id="notes-category-id">
                                <input type="hidden" id="notes-sub-category-id">
                                <div class="modal-body p-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.no') }}</th>
                                                    <th>{{ __('messages.family_details') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody id="notes-body">

                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->

                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--sub Title popup end-->

                    <!--delete popup /.modal -->
                    <div id="delete-notes" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <h4 class="modal-title w-100">{{ __('messages.are_you_sure?') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ __('messages.do_you_really') }}</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    <button type="button" class="btn btn-danger" id="remove_notes">{{ __('messages.delete') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--delete popup end /.modal -->



                </div> <!-- container -->

            </div> <!-- content -->
        </div>

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2015 -
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; UBold theme by
                        <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->



        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">


        </div> <!-- end slimscroll-menu-->
    </div>
    <div class="rightbar-overlay"></div>
</div>
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    //soapCategory routes
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var imageUrl = "{{ config('constants.image_url').'/public/soap/images/' }}";
    var userImageUrl = "{{ config('constants.image_url').'/public/users/images/' }}";
    var subCategoryList = "{{ config('constants.api.sub_category_list_by_category') }}";
    var notesList = "{{ config('constants.api.notes_list_by_sub_category') }}";
    var soapDelete = "{{ config('constants.api.soap_delete') }}";
    var soapSubjectDelete = "{{ route('admin.soap_subject.delete') }}";
    var studentDetails = "{{ config('constants.api.student_details') }}";
    var studentSoapList = "{{ config('constants.api.student_soap_list') }}";
    var url = "{{ URL::to('/') }}";
    var soapSubjectDetails = "{{ config('constants.api.soap_subject_details') }}";
    var soapNewStudentList = "{{ config('constants.api.soap_student_list') }}";
    var soapOldStudentList = "{{ config('constants.api.old_soap_student_list') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    var user_name = "{{ Session::get('name') }}";
    var user_id = "{{ Session::get('ref_user_id') }}";
    var soapLogList = "{{ route('admin.soap_log.list') }}";
    var defaultImg = "{{ config('constants.image_url').'/public/images/users/default.jpg' }}";
    var soapStudentIDUrl = "{{ route('admin.settings.soap_student_id') }}";
    
</script>

<script src="{{ asset('public/js/custom/soap.js') }}"></script>
<script src="{{ asset('public/js/custom/soap_subject.js') }}"></script>

@endsection