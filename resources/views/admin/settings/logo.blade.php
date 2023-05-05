@extends('layouts.admin-layout')
@section('title','Settings')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
<style>
    .dropify-clear {
        display: none !important;
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
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Extras</a></li> -->
                        <li class="breadcrumb-item active">{{ __('messages.logo') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.logo') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ __('messages.change_logo') }}</h4>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mt-3">
                                <form method="post" id="upload_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="file" class="dropify-im" name="change_logo" id="change_logo" data-plugins="dropify" data-default-file="{{ Session::get('school_logo') && asset('public/images/sub-logo/'.Session::get('school_logo')) ? asset('public/images/sub-logo/'.Session::get('school_logo')) : asset('public/images/users/default.jpg') }}" />
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
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-fileuploads.init.js') }}"></script>

<script>
    var subLogoPath = "{{ asset('public/images/sub-logo') }}";
    var changeLogoUrl = "{{ config('constants.api.change_logo') }}";
    var updateLogoSession = "{{ route('settings.update.logo') }}";
</script>
<script src="{{ asset('public/js/custom/settings.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove:  remove,
            error: oops_went_wrong
        }
    });
</script>
@endsection