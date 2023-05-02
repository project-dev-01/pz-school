@extends('layouts.admin-layout')
@section('title','Grade Category')
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.grade_category') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.grade_category') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGradeCategoryModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap w-100" id="grade-category-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!--- end row -->
    @include('admin.grade_category.add')
    @include('admin.grade_category.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    // grade category
    var gradeCategoryAdd = "{{ config('constants.api.grade_category_add') }}";
    var gradeCategoryList = "{{ route('admin.grade_category.list') }}";
    var gradeCategoryDetails = "{{ config('constants.api.grade_category_details') }}";
    var gradeCategoryUpdate = "{{ config('constants.api.grade_category_update') }}";
    var gradeCategoryDelete = "{{ config('constants.api.grade_category_delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_grade_category') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
</script>
<script src="{{ asset('public/js/custom/grade_category.js') }}"></script>
@endsection