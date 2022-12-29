@extends('layouts.admin-layout')
@section('title','Absent Reason')
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
                <h4 class="page-title">Absent Reason</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Absent Reason<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAbsentReasonModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="absent-reason-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reason ID</th>
                                    <th>Reason Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.absent_reason.add')
    @include('admin.absent_reason.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //absent reason routes
    var absentReasonList = "{{ route('admin.absent_reason.list') }}";
    var absentReasonDetails = "{{ route('admin.absent_reason.details') }}";
    var absentReasonDelete = "{{ route('admin.absent_reason.delete') }}";
</script>

<script src="{{ asset('public/js/custom/absent_reason.js') }}"></script>

@endsection