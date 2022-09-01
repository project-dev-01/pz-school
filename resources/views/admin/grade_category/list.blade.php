@extends('layouts.admin-layout')
@section('title','Grade Category')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Grade Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Grade Category<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGradeCategoryModal">Add </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap w-100" id="grade-category-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
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
</script>
<script src="{{ asset('public/js/custom/grade_category.js') }}"></script>
@endsection