@extends('layouts.admin-layout')
@section('title','Fees Allocation')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.fees_allocation_details') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.fees_allocation') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="feesAllocation" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="group_id">{{ __('messages.fees_group') }}<span class="text-danger">*</span></label>
                                    <select id="group_id" class="form-control" name="group_id">
                                        <option value="">Select Fees Group</option>
                                        @forelse ($fees_group_list as $group_list)
                                        <option value="{{ $group_list['id'] }}">{{ $group_list['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.filter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Student Details -->

    <!-- Student Fees Allocation Details List-->
    <div class="row feesAllocationStudHideShow" style="display: none;">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Fees Allocation<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addFeesAllocationStud" method="post" action="{{ route('admin.fees.add_fees_allocation') }}" autocomplete="off">
                        <input type="hidden" name="group_id" id="feesAllocationStudGroupID">
                        <input type="hidden" name="class_id" id="feesAllocationStudClassID">
                        <input type="hidden" name="section_id" id="feesAllocationStudSectionID">
                        <div class="table-responsive">
                            <table id="feesAllocationStud" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllchkbox"></th>
                                        <th>No</th>
                                        <th>{{ __('messages.student_name') }}</th>
                                        <th>Payment Mode</th>
                                        <th>{{ __('messages.gender') }}</th>
                                        <th>{{ __('messages.register_no') }}</th>
                                        <th>{{ __('messages.email') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!-- End Student Fees Allocation Details List-->
</div><!-- /.modal-dialog -->
<!-- container -->
@endsection
@section('scripts')
<script>
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var feesAllocatedStudentsList = "{{ config('constants.api.fees_allocated_students') }}";
    var paymentModeList = "{{ config('constants.api.payment_mode_list') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var studentImg = "{{ asset('public/users/images/') }}";
</script>
<script src="{{ asset('public/js/custom/fees_allocation.js') }}"></script>
@endsection