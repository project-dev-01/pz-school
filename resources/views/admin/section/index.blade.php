@extends('layouts.admin-layout')
@section('title','Class')
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
                <h4 class="page-title">Class</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Class<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSectionModal">Add</button>
                        <!-- <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#">Add Section</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="section-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
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
        @include('admin.section.add')
        @include('admin.section.edit')

    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var sectionAddUrl = "{{ config('constants.api.section_add') }}";
    var sectionGetRowUrl = "{{ config('constants.api.section_details') }}";
    var sectionUpdateUrl = "{{ config('constants.api.section_update') }}";
    var sectionDeleteUrl = "{{ config('constants.api.section_delete') }}";

    var sectionList = "{{ route('admin.section.list') }}";
</script>
<script src="{{ asset('public/js/custom/sections.js') }}"></script>

@endsection