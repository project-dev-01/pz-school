@extends('layouts.admin-layout')
@section('title','Grade')
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
                <h4 class="page-title">{{ __('messages.grade') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">{{ __('messages.grade') }}</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGradeModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="grade-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.grade_category') }}</th>
                                <th>{{ __('messages.notes') }}</th>
                                <th>{{ __('messages.grade_name') }}</th>
                                <th>{{ __('messages.grade_point') }}</th>
                                <th>{{ __('messages.min_percentage') }}</th>
                                <th>{{ __('messages.max_percentage') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.grade.add')
    @include('admin.grade.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
// grade routes
    var gradeList = "{{ route('admin.grade.list') }}";
    var gradeDetails = "{{ route('admin.grade.details') }}";
    var gradeDelete = "{{ route('admin.grade.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_grade') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
</script>
<script src="{{ asset('public/js/custom/grade.js') }}"></script>
@endsection
