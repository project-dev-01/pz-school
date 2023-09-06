@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_management') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.branch_url_permission') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">

            <!--Last Leave Taken -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> Create Role
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="country">{{ __('messages.role') }}<span class="text-danger">*</span></label>
                                        <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="demo-custom-toolbar" class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Sidebar Menu List</th>
                                                        <th>Access</th>
                                                        <th>Delete</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr class="table-active">
                                                        <th scope="row">1</th>
                                                        <td colspan="3">Branch Name</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Dashboard</td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Admission->Student Details->New Admission</td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Admission->Student Details->Application List</td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Admission->Student Details->Student List</td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Admission->Student Details->Student Bulk Upload</td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-box -->
                                    <div class="form-group text-right m-b-0" style="margin-top:20px;">
                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                            {{ __('messages.filter') }}
                                        </button>
                                    </div>
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>

<script>
    var StaffLeaveList = "{{ route('teacher.leave_management.list') }}";
    var StaffDocUrl = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/admin-documents/leaves/' }}";
    var reuploadFileUrl = "{{ route('teacher.reupload_file.add') }}";
    // Get PDF Footer Text

    var header_txt = "{{ __('messages.all_leaves') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    var teacher_leave_apply_storage = localStorage.getItem('teacher_leave_apply_details');
</script>
<script src="{{ asset('public/js/custom/staff_apply_leave.js') }}"></script>
@endsection