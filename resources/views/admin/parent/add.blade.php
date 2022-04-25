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
            <form id="addparent" method="post" action="{{ route('admin.parent.add') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card">
                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                        <li class="nav-item">
                            <h4 class="nav-link">
                                Parent Details
                                <h4>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="name" aria-describedby="inputGroupPrepend" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="relation">Relation<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" name="relation" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">Father Name</label>
                                    <input type="text"  class="form-control" name="father_name" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">Mother Name</label>
                                    <input type="text"  class="form-control" name="mother_name" data-parsley-trigger="change" >
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
                                <div class="form-group mb-3">
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
                                    <label for="education">Education</label>
                                    <input type="text"  class="form-control" name="education" data-parsley-trigger="change" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text"  class="form-control" name="city" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text"  class="form-control" name="state" data-parsley-trigger="change" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document" class="col-3 col-form-label">Photo</label>
                                    <div class="col-12">
                                            <input type="file"  class="custom-file-input" name="photo">
                                            <label class="custom-file-label" for="document">Choose file</label>
                                        <span id="file_name"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea  class="form-control" name="address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                    </textarea>
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
                                <div class="form-group mb-3">
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
                                <div class="form-group mb-3">
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
                                <div class="form-group mb-3">
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
<script src="{{ asset('js/custom/parent.js') }}"></script>
@endsection