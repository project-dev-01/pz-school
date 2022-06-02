@extends('layouts.admin-layout')
@section('title','Parent')
@section('css')
<style>
    .containers-img {
        height: 270px;
        position: relative;
        max-width: 320px;
        /* margin: auto; */
    }

    .containers-img .imageWrapper {
        border: 3px solid #888;
        width: 70%;
        padding-bottom: 70%;
        border-radius: 50%;
        overflow: hidden;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .containers-img .imageWrapper img {
        height: 105%;
        width: initial;
        max-height: 100%;
        max-width: initial;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .file-upload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }

    .file-upload {
        position: relative;
        overflow: hidden;
        margin: 10px;
        width: 100%;
        max-width: 150px;
        text-align: center;
        /* color: #fff; */
        font-size: 1.2em;
        background: transparent;
        border: 2px solid #888;
        padding: 0.85em 1em;
        display: inline;
        -ms-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    /* .file-upload:hover {
        background: #999;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
        -moz-box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
        box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
    } */

    .file-upload input.file-input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        height: 100%;
    }
</style>
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
                        </div>
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
                                    <label for="nric">NRIC</label>
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
                                    <label for="address">Address Line 1(Street address)</label>
                                    <input class="form-control" name="address" id="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_2">Address Line 2</label>
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

<script>
    $(document).on("change", ".uploadProfileInput", function() {
        var triggerInput = this;
        var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
        var holder = $(this).closest(".pic-holder");
        var wrapper = $(this).closest(".profile-pic-wrapper");
        $(wrapper).find('[role="alert"]').remove();
        triggerInput.blur();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            return;
        }
        if (/^image/.test(files[0].type)) {
            // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() {
                $(holder).addClass("uploadInProgress");
                $(holder).find(".pic").attr("src", this.result);
                $(holder).append(
                    '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
                );

                // Dummy timeout; call API or AJAX below
                setTimeout(() => {
                    $(holder).removeClass("uploadInProgress");
                    $(holder).find(".upload-loader").remove();
                    // If upload successful
                    if (Math.random() < 0.9) {
                        $(wrapper).append(
                            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
                        );

                        // Clear input after upload
                        $(triggerInput).val("");

                        setTimeout(() => {
                            $(wrapper).find('[role="alert"]').remove();
                        }, 3000);
                    } else {
                        $(holder).find(".pic").attr("src", currentImg);
                        $(wrapper).append(
                            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
                        );

                        // Clear input after upload
                        $(triggerInput).val("");
                        setTimeout(() => {
                            $(wrapper).find('[role="alert"]').remove();
                        }, 3000);
                    }
                }, 1500);
            };
        } else {
            $(wrapper).append(
                '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
            );
            setTimeout(() => {
                $(wrapper).find('role="alert"').remove();
            }, 3000);
        }
    });
</script>
<script src="{{ asset('js/custom/parent.js') }}"></script>
@endsection