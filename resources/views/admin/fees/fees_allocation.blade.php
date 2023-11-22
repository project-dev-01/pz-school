@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.fees_allocation') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
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
                                        <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                        <select id="department_id" name="department_id" class="form-control">
                                            <option value="">{{ __('messages.select_department') }}</option>
                                                @forelse($department as $r)
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
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="group_id">{{ __('messages.fees_group') }}<span class="text-danger">*</span></label>
                                    <select id="group_id" class="form-control" name="group_id">
                                        <option value="">{{ __('messages.select_fees_group') }}</option>
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
                        <h4 class="navv">{{ __('messages.student_fees_allocation') }}<h4>
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
                                        <th>{{ __('messages.no') }}</th>
                                        <th>{{ __('messages.student_name') }}</th>
                                        <th>{{ __('messages.payment_mode') }}</th>
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
                            {{ __('messages.save') }}
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
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var feesAllocatedStudentsList = "{{ config('constants.api.fees_allocated_students') }}";
    var paymentModeList = "{{ config('constants.api.payment_mode_list') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    // localStorage variables
    var fees_allocation_storage = localStorage.getItem('admin_fees_allocation_details');
</script>
<script src="{{ asset('js/custom/fees_allocation.js') }}"></script>
@endsection