@extends('layouts.admin-layout')
@section('title',' ' . __('messages.child_health_report') . '')
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
                <h4 class="page-title">{{ __('messages.child_health_report') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="StudentFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_name') }}</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id_filter">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="department_id_filter" name="department_id_filter" class="form-control">
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
                                    <label for="class_id">{{ __('messages.grade') }}</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}</label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.filter') }}
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- End Student Details -->

    <!-- Student Fees Details List-->
    <div class="row" id="student">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            {{ __('messages.report_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.register_no') }}</th>
                                            <th> {{ __('messages.roll_no') }}</th>
                                            <th> {{ __('messages.gender') }}</th>
                                            <th> {{ __('messages.email') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <form method="post" action="">
                                    @csrf
                                    <div class="clearfix float-right" style="margin-bottom:5px;">
                                    
                                    <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                    </div>
                                </form>
                        <form method="post" action="{{ route('admin.child_health.student_pdf')}}">
                            @csrf
                            <input type="hidden" name="student_id" id="1">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.pdf') }}
                                </button>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script> -->
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var studentList = "{{ route('admin.child_health.list') }}";
    var getFeesList = "{{ config('constants.api.get_parent_fees_list') }}";
    var feesTypeGroupUrl = "{{ config('constants.api.fees_type_group') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var feesView = '{{ route("parent.fees.view", [":id",""]) }}';
    var feesInvoice = '{{ route("parent.fees.invoice", [":id",""]) }}';
    // localStorage variables
    var fees_storage = localStorage.getItem('parent_fees_details');

    var year_id = "{{ Session::get('academic_session_id') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>

<script src="{{ asset('js/custom/student.js') }}"></script>

@endsection