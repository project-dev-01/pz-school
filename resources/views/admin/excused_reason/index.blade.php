@extends('layouts.admin-layout')
@section('title','Excused Reason')
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
                <h4 class="page-title">Excused Reason</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">Excused Reason<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addExcusedReasonModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="excused-reason-table">
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
    @include('admin.excused_reason.add')
    @include('admin.excused_reason.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //excused reason routes
    var excusedReasonList = "{{ route('admin.excused_reason.list') }}";
    var excusedReasonDetails = "{{ route('admin.excused_reason.details') }}";
    var excusedReasonDelete = "{{ route('admin.excused_reason.delete') }}";
</script>

<script src="{{ asset('public/js/custom/excused_reason.js') }}"></script>

@endsection