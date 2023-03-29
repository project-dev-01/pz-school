@extends('layouts.admin-layout')
@section('title','Soap Sub Category')
@section('css')
<style>
.dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}
</style>
<link href="{{ asset('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">Sub Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Sub Category
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSoapSubCategoryModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="soap-sub-category-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>Sub Category Name</th>
                                    <th>Action</th>
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
        @include('admin.soap_sub_category.add')
        @include('admin.soap_sub_category.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //soapSubCategory routes
    var imageUrl = "{{ asset('public/soap/images/') }}";
    var soapSubCategoryList = "{{ route('admin.soap_sub_category.list') }}";
    var soapSubCategoryDetails = "{{ route('admin.soap_sub_category.details') }}";
    var soapSubCategoryDelete = "{{ route('admin.soap_sub_category.delete') }}";
    var categoryList = "{{ config('constants.api.category_list_by_soap_type') }}";
</script>

<script src="{{ asset('public/js/custom/soap_sub_category.js') }}"></script>

@endsection