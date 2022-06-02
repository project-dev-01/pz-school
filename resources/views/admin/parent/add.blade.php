@extends('layouts.admin-layout')
@section('title','Parent')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Parent / Guardian</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <style>

    </style>
    <div class="row">
        <div class="col-xl-12">
            <form id="addparent" method="post" action="{{ route('admin.parent.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                        <li class="nav-item">
                            <h4 class="nav-link">
                                Parent / Guardian Details
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-3">
                                    <div class="mt-3">
                                        <input type="file" name="photo" id="photo" data-plugins="dropify" data-default-file="{{ asset('images/700x500.png') }}" />
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
                                            <img class="image" src="{{ asset('images/700x500.png') }}">
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
                                <div class="form-group">
                                    <label for="first_name"> First Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="first_name" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name"> Last Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="last_name" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" name="gender" >
                                        <option value="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
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
                                        <input type="text" class="form-control" name="date_of_birth"  id="date_of_birth" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Passport">Passport</label>
                                    <input type="text" class="form-control" name="passport">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nric">NRIC Number</label>
                                    <input type="text"  class="form-control" name="nric" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blooddgrp">Blood Group</label>
                                    <select  class="form-control" name="blood_group" >
                                        <option value="">Pick Blood Type</option>
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
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone-volume"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"  name="mobile_no" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="education">Education</label>
                                    <input type="text"  class="form-control" name="education" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="occupation">Occupation<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" name="occupation" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="income">Income</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-calculator"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"  name="income" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text"  class="form-control" name="country" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State/Province</label>
                                    <input type="text"  class="form-control" name="state" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text"  class="form-control" name="city" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post_code">Zip/Postal code</label>
                                    <input type="text" class="form-control" name="post_code" id="postCode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address 1</label>
                                    <input class="form-control" name="address" id="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_2">Address 2</label>
                                    <input class="form-control" name="address_2" id="address_2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                        <li class="nav-item">
                            <h4 class="nav-link">
                                Login Details
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-envelope-open"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"  name="email" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control"  name="password" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="confirm_password">Retype Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-unlock"></span>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control"  name="confirm_password" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                        <li class="nav-item">
                            <h4 class="nav-link">
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
                                        <input type="text" class="form-control"  name="facebook_url" aria-describedby="inputGroupPrepend" >
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
                                        <input type="text" class="form-control"  name="twitter_url" aria-describedby="inputGroupPrepend" >
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
                                        <input type="text" class="form-control"  name="linkedin_url" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
                
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                        Save
                    </button>
                    <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>-->
                </div>
            </form>
        </div> <!-- end col -->

    </div><!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var indexParent = "{{ route('admin.parent') }}";
</script>

<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/parent.js') }}"></script>
@endsection