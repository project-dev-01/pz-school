@extends('layouts.admin-layout')
@section('title','Settings')
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Extras</a></li> -->
                        <li class="breadcrumb-item active">Logo</li>
                    </ol>
                </div>
                <h4 class="page-title">Logo</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="{{ Session::get('school_logo') && asset('public/images/sub-logo/'.Session::get('school_logo')) ? asset('public/images/sub-logo/'.Session::get('school_logo')) : asset('public/images/users/default.jpg') }}" alt="logo" class="rounded-circle avatar-lg img-thumbnail school_logo_picture">

                <!-- <img src="{{ Session::get('school_logo') && asset('public/users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" class="rounded-circle avatar-lg img-thumbnail school_logo_picture" alt="profile-image"> -->
                <!-- <img src="{{ Session::get('picture') && Storage::disk('public')->exists('users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" class="rounded-circle avatar-lg img-thumbnail admin_picture" alt="profile-image"> -->

                <!-- <img src="{{ asset('public/images/users/default.jpg') }}" class="rounded-circle avatar-lg img-thumbnail admin_picture" alt="profile-image"> -->
                <h4 class="mb-0 user_name">{{ Session::get('school_name') }}</h4>

                <div class="text-left mt-3">
                    <!-- <form method="post" id="upload_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="btn btn-primary btn-block"> <b>Change Logo</b>
                                <input type="file" name="change_logo" id="change_logo" style="opacity: 0;height:1px;display:none" />
                            </label>
                        </div>
                    </form> -->
                </div>

                <!-- end row -->
                <!-- <p class="text-muted">@webdesigner</p>

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>
                    <p class="text-muted font-13 mb-3">
                        Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley of type.
                    </p>
                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2 user_name"> dsfds </span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">(123)
                            123 1234</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "> sddsf@gmail.com</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">USA</span></p>
                </div> -->
            </div> <!-- end card-box -->

        </div> <!-- end col-->

    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Change Logo</h4>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <form method="post" id="upload_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <!-- <div class="form-group">
                                        <label class="btn btn-primary btn-block"> <b>Change Logo</b>
                                            <input type="file" name="change_logo" id="change_logo" style="opacity: 0;height:1px;display:none" />
                                        </label>
                                    </div> -->
                                    <input type="file" name="change_logo" id="change_logo" data-plugins="dropify" data-default-file="{{ Session::get('school_logo') && asset('public/images/sub-logo/'.Session::get('school_logo')) ? asset('public/images/sub-logo/'.Session::get('school_logo')) : asset('public/images/users/default.jpg') }}" />
                                    <p class="text-muted text-center mt-2 mb-0">{{ Session::get('school_name') }}</p>
                                </form>

                            </div>
                        </div>
                    </div> <!-- end row -->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->
    </div>

</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>

<script>
    var subLogoPath = "{{ asset('public/images/sub-logo') }}";
    var changeLogoUrl = "{{ config('constants.api.change_logo') }}";
    var updateLogoSession = "{{ route('settings.update.logo') }}";
</script>
<script src="{{ asset('public/js/custom/settings.js') }}"></script>
@endsection