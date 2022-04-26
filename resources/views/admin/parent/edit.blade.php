@extends('layouts.admin-layout')
@section('title','Edit Parent')
@section('content')
@section('css')
<style>
    .profile {
        
    padding: 5px 0 0;
    border-top: 1px dotted #ddd;
    text-align: right;
    }
</style>
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
                <h4 class="page-title">Parent Profile</h4>
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
                            <img src="{{ asset('users/images//') }}/{{$parent['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                            <img src="{{ asset('images/users/default.jpg') }}" alt="" class="img-fluid mx-auto d-block rounded">
                        @endif
                        
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">                                              
                            <h1 class="mb-3">{{$parent['name']}}</h5>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-bezier-curve"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['relation']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-user-tag"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['occupation']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['income']}}</a></h5>
                                            </div>
                                        </div>
                                    
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-phone"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['mobile_no']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="far fa-envelope"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['email']}}</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-home"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">{{$parent['address']}}</a></h5>
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
                    <div class="collapse" id="basic_details">
                        <div class="card card-body">
                            <form id="editParent" method="post" action="{{ route('admin.parent.update') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <input type="hidden" name="id" value="{{$parent['id']}}">
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
                                                        <input type="text" class="form-control" value="{{$parent['name']}}" name="name" aria-describedby="inputGroupPrepend" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="relation">Relation<span class="text-danger">*</span></label>
                                                    <input type="text"  class="form-control" value="{{$parent['relation']}}" name="relation"  data-parsley-trigger="change" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_name">Father Name</label>
                                                    <input type="text"  class="form-control" value="{{$parent['father_name']}}" name="father_name" data-parsley-trigger="change" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_name">Mother Name</label>
                                                    <input type="text"  class="form-control" value="{{$parent['mother_name']}}" name="mother_name" data-parsley-trigger="change" >
                                                </div>
                                            </div>
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
                                                        <input type="text" class="form-control" value="{{$parent['email']}}" name="email" aria-describedby="inputGroupPrepend" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-phone-volume"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" value="{{$parent['mobile_no']}}" name="mobile_no" aria-describedby="inputGroupPrepend" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="occupation">Occupation<span class="text-danger">*</span></label>
                                                    <input type="text"  class="form-control" value="{{$parent['occupation']}}" name="occupation" data-parsley-trigger="change" >
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
                                                        <input type="text" class="form-control" value="{{$parent['income']}}" name="income" aria-describedby="inputGroupPrepend" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="education">Education</label>
                                                    <input type="text"  class="form-control" value="{{$parent['education']}}" name="education" data-parsley-trigger="change" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text"  class="form-control" value="{{$parent['city']}}" name="city" data-parsley-trigger="change" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text"  class="form-control" value="{{$parent['state']}}" name="state" data-parsley-trigger="change" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="document">Photo</label>
                                                    <div class="col-12">
                                                            <input type="file"  class="custom-file-input" name="photo">
                                                            <label class="custom-file-label" for="document">Choose file</label>
                                                            @if($parent['photo'])
                                                            <a target="_blank"  href="{{asset('users/images/')}}/{{$parent['photo']}}" alt="your Photo">Photo Preview</a>
                                                            @endif
                                                            <input type="hidden" name="old_photo" value="{{$parent['photo']}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea  class="form-control"name="address" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                                        {{$parent['address']}}     
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
                                                        <input type="text" class="form-control" value="{{$parent['facebook_url']}}" name="facebook_url" aria-describedby="inputGroupPrepend" >
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
                                                        <input type="text" class="form-control" value="{{$parent['twitter_url']}}" name="twitter_url" aria-describedby="inputGroupPrepend" >
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
                                                        <input type="text" class="form-control" value="{{$parent['linkedin_url']}}" name="linkedin_url" aria-describedby="inputGroupPrepend" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                                <div class="card">
                                    <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                                        <li class="nav-item">
                                            <h4 class="nav-link">
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
                                                        <input type="password" class="form-control"  name="password" aria-describedby="inputGroupPrepend" >
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
                                                        <input type="password" class="form-control"  name="confirm_password" aria-describedby="inputGroupPrepend" >
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
                                                        <img src="{{ asset('users/images//') }}/{{$child['photo']}}" alt="" class="rounded-circle img-thumbnail avatar-xl">
                                                    @else
                                                        <img src="{{ asset('images/users/default.jpg') }}" alt="" class="rounded-circle img-thumbnail avatar-xl">
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
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
</script>
<script src="{{ asset('js/custom/parent.js') }}"></script>
@endsection