@extends('layouts.admin-layout')
@section('title','Group')
@section('css')
<link rel="stylesheet" href="{{ asset('public/libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/dropify/css/dropify.min.css') }}">
<style>
    .datepicker {
        z-index: 99999 !important;
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
                        <li class="breadcrumb-item active">List</li>
                        <!-- <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title">Group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Group<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <a type="button" class="btn add-btn btn-rounded waves-effect waves-light" href="{{ route('admin.group.create')}}">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="group-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group Name</th>
                                    <th>No of Members</th>
                                    <th>Description</th>
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
</div>
<!-- container -->

@endsection
@section('scripts')
<script>
    //group routes
    var groupList = "{{ route('admin.group.list') }}";
    var groupDetails = "{{ route('admin.group.details') }}";
    var groupDelete = "{{ route('admin.group.delete') }}";
</script>
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/group.js') }}"></script>

@endsection