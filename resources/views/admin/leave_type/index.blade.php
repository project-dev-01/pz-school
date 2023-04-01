@extends('layouts.admin-layout')
@section('title','Leave Type')
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
                <h4 class="page-title">{{ __('messages.leave_types') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Leave Type
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addLeaveTypeModal">Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="leave-type-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.leave_type_name') }}</th>
                                    <th>{{ __('messages.short_name') }}</th>
                                    <th>Leave Days</th>
                                    <th>{{ __('messages.gender') }}</th>
                                    <th>{{ __('messages.action') }}</th>
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
    @include('admin.leave_type.add')
    @include('admin.leave_type.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //leaveType routes
    var leaveTypeList = "{{ route('admin.leave_type.list') }}";
    var leaveTypeDetails = "{{ route('admin.leave_type.details') }}";
    var leaveTypeDelete = "{{ route('admin.leave_type.delete') }}";
    var leaveTypeRestore = "{{ route('admin.leave_type.update') }}";
</script>

<script src="{{ asset('public/js/custom/leave_type.js') }}"></script>

@endsection