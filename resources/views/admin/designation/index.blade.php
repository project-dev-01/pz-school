@extends('layouts.admin-layout')
@section('title','Designation')
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
                    </ol>
                </div> -->
                <h4 class="page-title">Designation</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Designation<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addDesignationModal">Add Designation</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="designation-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Designation Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.designation.add')
        @include('admin.designation.edit')
    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    // designation routes
    var designationList = "{{ route('admin.designation.list') }}";
    var designationDetails = "{{ route('admin.designation.details') }}";
    var designationDelete = "{{ route('admin.designation.delete') }}";
</script>
<script src="{{ asset('public/js/custom/designation.js') }}"></script>
@endsection