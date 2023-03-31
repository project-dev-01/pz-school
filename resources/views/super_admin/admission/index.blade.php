@extends('layouts.admin-layout')
@section('title','Admission')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.student_admission') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>{{ __('messages.academic_details') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.academic_year') }}r<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">2020-2021</option>
                                        <option value="">2021-2022</option>
                                        <option value="">2022-2023</option>
                                        <option value="">2023-2024</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Register No<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Roll<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="">{{ __('messages.admission_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Standard</option>
                                        <option>I</option>
                                        <option>II</option>
                                        <option>III</option>
                                        <option>IV</option>
                                        <option>V</option>
                                        <option>VI</option>
                                        <option>VII</option>
                                        <option>VIII</option>
                                        <option>IX</option>
                                        <option>X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Class Name</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Category</option>
                                        <option>Management</option>
                                        <option>Government</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Student Details
                            <h4>
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
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="heard">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Male</option>
                                    <option value="press">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">{{ __('messages.blood_group') }}<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Select Blood Group</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="">{{ __('messages.date_of_birth') }}</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-birthday-cake"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control homeWorkAdd" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Mother Tongue</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.religion') }}</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Caste</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Mobile No<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.city') }}</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.state') }}</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message">Present Address</label>
                                <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="message">Permanent Address</label>
                                <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">Profile Picture</label>
                                <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>{{ __('messages.login_details') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="far fa-envelope-open"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="email">Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="email">Retype Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Guardian Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck11">
                            <label class="custom-control-label" for="customCheck11">{{ __('messages.skipped_bank_details') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="heard">Relation<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Father Name</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="heard">Mother Name</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('messages.income') }}</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Education</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">City</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">State</label>
                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="">Mobile No<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone-volume"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Address</label>
                        <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="far fa-envelope-open"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="email">Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="email">Retype Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-unlock"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Transport Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Transport Route<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option>Route 62</option>
                                    <option>Route 57</option>
                                    <option>Route 43</option>
                                    <option>Route 35</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Vechicle No<span class="text-danger">*</span></label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option>WD 4567</option>
                                    <option>SAB 7219</option>
                                    <option>KV 0632</option>
                                    <option>QAA 8151</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Hostel Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Hostel Name</label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option>Masada Backpacker</option>
                                    <option>Kota Kinabalu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heard">Room Number</label>
                                <select id="heard" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option>14 </option>
                                    <option>51</option>
                                    <option>76</option>
                                    <option>98</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="" class="icon-dual" id="span-parent"></span>Previous School Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">School Name</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Qualification</label>
                                <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Remarks</label>
                        <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                        </textarea>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection