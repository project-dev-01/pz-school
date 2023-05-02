@extends('layouts.admin-layout')
@section('title','Education')
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.list') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.education') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">{{ __('messages.education') }}</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" style="margin: 0px 0px 0px -15px;" data-toggle="modal" data-target="#addEducationModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="education-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.education_name') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.education.add')
    @include('admin.education.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //education routes
    var educationList = "{{ route('admin.education.list') }}";
    var educationDetails = "{{ route('admin.education.details') }}";
    var educationDelete = "{{ route('admin.education.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_stream_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
</script>

<script src="{{ asset('public/js/custom/education.js') }}"></script>

@endsection