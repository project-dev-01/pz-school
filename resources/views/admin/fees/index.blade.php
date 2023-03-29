@extends('layouts.admin-layout')
@section('title','Fees')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.fees_details') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.student_details') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="filterFeesAllocation" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">Select Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        <!-- <option value="All">All</option> -->
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
                                    <label for="student_id">{{ __('messages.student') }}</label>
                                    <select id="student_id" class="form-control" name="student_id">
                                        <option value="">Select Student</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fees_type">{{ __('messages.fees_type') }}Fees Type</label>
                                    <select id="fees_type" class="form-control" name="fees_type">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment_status">{{ __('messages.payment_status') }}</label>
                                    <select id="payment_status" class="form-control" name="payment_status">
                                        <option value="">Select Payment Status</option>
                                        @forelse ($payment_status as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
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

    <!-- Student Fees Details List-->
    <div class="row getFessStudentsHideShow" style="display: none;">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Fees Allocation<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="getFessStudents" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Grade</th>
                                    <th>{{ __('messages.class') }}</th>
                                    <th>Student Name</th>
                                    <th>Fees Group</th>
                                    <!-- <th>Payment Status</th> -->
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
</div><!-- /.modal-dialog -->
<!-- container -->
@endsection
@section('scripts')

<!-- <script>
    document
        .getElementById('target')
        .addEventListener('change', function() {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
        
</script>
<script>
    document
        .getElementById('targett')
        .addEventListener('change', function() {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'invv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script>
<script>
    document
        .getElementById('targettt')
        .addEventListener('change', function() {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'invvv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
</script> -->
<script>
    // $(function() {
    //     $(document).on('change', '#semester1', function() {
    //         if ($(this).prop('checked') == false) {
    //             $('.inputDateFld1').prop('disabled', true);
    //             $('.dropDwn1').prop('disabled', true);
    //         } else {
    //             $('.inputDateFld1').prop('disabled', false);
    //             $('.dropDwn1').prop('disabled', false);
    //         }

    //     });
    // });
</script>
<script>
    // $(function() {
    //     $(document).on('change', '#semester2', function() {
    //         if ($(this).prop('checked') == false) {
    //             $('.inputDateFld2').prop('disabled', true);
    //             $('.dropDwn2').prop('disabled', true);
    //         } else {
    //             $('.inputDateFld2').prop('disabled', false);
    //             $('.dropDwn2').prop('disabled', false);
    //         }

    //     });
    // });
</script>
<script>
    // $(function() {
    //     $(document).on('change', '#semester3', function() {
    //         if ($(this).prop('checked') == false) {
    //             $('.inputDateFld3').prop('disabled', true);
    //             $('.dropDwn3').prop('disabled', true);
    //         } else {
    //             $('.inputDateFld3').prop('disabled', false);
    //             $('.dropDwn3').prop('disabled', false);
    //         }

    //     });
    // });
</script>

<script>
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var getFeesAllocatedStudents = "{{ config('constants.api.get_fees_allocated_students') }}";
    var feesTypeGroupUrl = "{{ config('constants.api.fees_type_group') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    var studentImg = "{{ asset('public/users/images/') }}";
    var editFeesPageUrl = '{{ route("admin.fees.edit", ":id") }}';
    var feesDelete = '{{ route("admin.fees.fees_delete") }}';
</script>

<script src="{{ asset('public/js/custom/fees.js') }}"></script>

@endsection