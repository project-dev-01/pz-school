@extends('layouts.admin-layout')
@section('title','Parent')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Add Parent</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <style>

    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Parent Details
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Relation<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Father Name<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mother Name<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Occupation<span class="text-danger">*</span></label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="">Income</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="fas fa-calculator"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                    </div>
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
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
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
                </div>
            </div>
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Login Details
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
                            Social Links
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">Facebook</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-facebook-f"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">Twitter</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-twitter"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustomUsername">Linkedin</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fab fa-linkedin-in"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>
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