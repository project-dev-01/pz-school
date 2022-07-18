@extends('layouts.admin-layout')
@section('title','Staff Category')
@section('content')
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
                <h4 class="page-title">Staff Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Staff Category <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" style="width:150px;" data-toggle="modal" data-target="#addstaffcategoryModal">Add Staff Category</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="staffcategory-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Staff Category</th>
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