@extends('layouts.admin-layout')
@section('title','Settings')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.profile') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="{{ Session::get('picture') && asset('public/users/images/'.Session::get('picture')) ? asset('public/users/images/'.Session::get('picture')) : asset('public/images/users/default.jpg') }}" class="rounded-circle avatar-lg img-thumbnail admin_picture" alt="profile-image">
                <h4 class="mb-0 user_name">{{ Session::get('role_name') }}</h4>
                <div class="text-left mt-3">
                    <form method="post" id="upload_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="btn btn-block" style="background-color: #0ABAB5; color: #fff;"> <b>{{ __('messages.change_picture') }}</b>
                                <input type="file" name="profile_image" id="profile_image" style="opacity: 0;height:1px;display:none" />
                            </label>
                        </div>
                    </form>
                </div>
                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">{{ __('messages.about_me') }} :</h4>
                    <p class="text-muted mb-2 font-13"><strong>{{ __('messages.full_name') }} :</strong> <span class="ml-2 user_name"> {{ $user_details['first_name'] }} {{ $user_details['last_name'] }} </span></p>
                    <p class="text-muted mb-2 font-13"><strong>{{ __('messages.email') }} :</strong> <span class="ml-2 "> {{ $user_details['email'] }}</span></p>
                    <p class="text-muted mb-2 font-13"><strong>{{ __('messages.mobile_no') }} :</strong> <span class="ml-2 "> {{ $user_details['mobile_no'] }}</span></p>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        {{ __('messages.settings') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#changePassword" data-toggle="tab" aria-expanded="true" class="nav-link">
                        {{ __('messages.change_password') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="settings">
                        <form method="POST" action="{{ route('staff.settings.updateProfileInfo') }}" id="updateProfileInfo">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> {{ __('messages.personal_info') }}</h5>
                            <div class="row">
                                <input type="hidden" name="id" value="{{ Session::get('user_id') }}">
                                <input type="hidden" name="staff_id" value="{{ Session::get('ref_user_id') }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">{{ __('messages.first_name') }}</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user_details['first_name'] }}" placeholder="{{ __('messages.enter_the_first_name') }}">
                                        <span class="text-danger error-text first_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">{{ __('messages.last_name') }}</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user_details['last_name'] }}" placeholder="{{ __('messages.enter_the_last_name') }}">
                                        <span class="text-danger error-text last_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('messages.email_address') }}</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user_details['email'] }}" placeholder="{{ __('messages.enter_the_email') }}">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no">{{ __('messages.mobile_no') }}</label>
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ $user_details['mobile_no'] }}" placeholder="{{ __('messages.enter_the_mobile_no') }}">
                                        <span class="text-danger error-text mobile_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="present_address">{{ __('messages.present_address') }}</label>
                                        <textarea type="textarea" class="form-control" name="present_address" rows="4" id="present_address">{{ $user_details['present_address']}}</textarea>
                                        <span class="text-danger error-text present_address_error"></span>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> {{ __('messages.update') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->
                    <div class="tab-pane" id="changePassword">
                        <!-- comment box -->
                        <form action="{{ route('staff.settings.changeNewPassword') }}" method="POST" id="changeNewPassword" class="comment-area-box mt-2 mb-3">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i>{{ __('messages.change_password') }}</h5>
                            <div class="row">
                                <input type="hidden" name="id" value="{{ Session::get('user_id') }}">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="old">{{ __('messages.old_password') }} :</label>
                                        <input type="password" class="form-control" id="old" name="old" placeholder="Old Password">
                                        <span class="text-danger error-text old_error"></span>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="password">{{ __('messages.new_password') }} : <span style="color:blue;">(password atleast 8 characters and contain both numbers & letters/special characters.):</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                        <span class="text-danger error-text password_error"></span>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="confirmed">{{ __('messages.confirm_new_password') }} :</label>
                                        <input type="password" class="form-control" id="confirmed" name="confirmed" placeholder="Confirm New Password">
                                        <span class="text-danger error-text confirmed_error"></span>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>
                        <!-- end comment box -->
                    </div>
                    <!-- end changePassword content-->
                </div> <!-- end tab-content -->
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    // settings url
    var profileUpdateStg = "{{ config('constants.api.change_profile_picture') }}";
    var updateSettingSession = "{{ route('settings.updateSettingSession') }}";
    var profilePath = "{{ asset('public/users/images') }}";
</script>
<script src="{{ asset('public/js/custom/admin_settings.js') }}"></script>
@endsection