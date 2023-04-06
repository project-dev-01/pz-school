@extends('layouts.admin-layout')
@section('title','Staff Leave Assign')
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
                <h4 class="page-title">{{ __('messages.staff_leave_assign') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="staffLeaveAssignFilter"   method="post" autocomplete="off">
                        <div class="row">      
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department">Department<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department" id="department">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @foreach($department as $dep)
                                        <option value="{{$dep['id']}}">{{$dep['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee">Employee</label>
                                    <select class="form-control" name="employee" id="employee">
                                        <option value="">{{ __('messages.select_employee') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.staff_leave_assign') }}
                            <h4>
                    </li>
                </ul><br>
                <!-- <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffLeaveAssignModal">Add</button>
                    </div>
                </div> -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="staff-leave-assign-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.staff_name') }} </th>
                                    <th>{{ __('messages.leave_type') }} </th>
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
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
    //staff Leave Assign routes
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
    var staffLeaveAssignList = "{{ route('admin.staff_leave_assign.list') }}";
    var staffLeaveAssignDetails = "{{ route('admin.staff_leave_assign.details') }}";
    var staffLeaveAssignDelete = "{{ route('admin.staff_leave_assign.delete') }}";
</script>

<script src="{{ asset('public/js/custom/staff_leave_assign.js') }}"></script>

@endsection