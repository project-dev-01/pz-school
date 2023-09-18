@extends('layouts.admin-layout')
@section('title','Assign Leave approval')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.list') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.assign_leave_approval') }}</h4>
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
                            <span class="fas fa-stream" id="span-parent"></span>
                            {{ __('messages.assign_leave_approval') }}
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="assign-leave-approval" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.employee_name') }}</th>
                                        <th>{{ __('messages.department_name') }}</th>
                                        <th>{{ __('messages.approval_head') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection
@section('scripts')
<script>
    var getAllStaffUrl = "{{ route('admin.leave_management.get_all_staff_details') }}";
</script>
<script src="{{ asset('js/custom/assign_leave_approval.js') }}"></script>

@endsection