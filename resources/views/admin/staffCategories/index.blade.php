@extends('layouts.admin-layout')
@section('title','Staff Category')
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol> -->
                </div>
                <h4 class="page-title">{{ __('messages.staff_category') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.staff_category') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addstaffcategoryModal">{{ __('messages.add') }}</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="staffcategory-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.staff_category') }}</th>
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
    </div>
    <!--- end row -->
    @include('admin.staffCategories.add')
    @include('admin.staffCategories.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //department routes
    var staffcategoryList = "{{ route('admin.staffcategory.list') }}";
    var staffcategoryDetails = "{{ route('admin.staffcategory.details') }}";
    var staffcategoryDelete = "{{ route('admin.staffcategory.delete') }}";
</script>

<script src="{{ asset('public/js/custom/staffcategory.js') }}"></script>

@endsection