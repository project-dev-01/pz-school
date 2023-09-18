@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.leave_management') . '')
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
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.leave_management') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.already_taken_leave_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="alreadyTakenLeave" class="table table-centered table-borderless table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.leave_type') }}</th>
                                            <th>{{ __('messages.total_leave') }}</th>
                                            <th>{{ __('messages.used_leave') }}</th>
                                            <th>{{ __('messages.applied_leave') }}</th>
                                            <th>{{ __('messages.remaining_leave') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leave_taken_history as $val)
                                        <tr>
                                            <td>{{ $val['leave_name'] }}</td>
                                            <td>{{ $val['total_leave'] }}</td>
                                            <td>{{ $val['used_leave'] ? $val['used_leave'] : 0 }}</td>
                                            <td>{{ $val['applied_leave'] ? $val['applied_leave'] : 0 }}</td>
                                            <td>{{ $val['total_leave'] - $val['used_leave'] }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center;">{{ __('messages.no_data_available') }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end row -->
                        <!--Leave Application -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> {{ __('messages.leave_application') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="staffLeaveApply" method="post" action="{{ route('teacher.leave_management.add') }}" autocomplete="off" novalidate>
                                <!--1st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="leave_type">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                                            <select id="leave_type" name="leave_type" class="form-control">
                                                <option value="">{{ __('messages.select_leave_type') }}</option>
                                                @forelse ($get_leave_types as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.leave_from') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="frm_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.to') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="to_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="changelev">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                            <select id="changelevReasons" class="form-control" name="changelevReasons">
                                                <option value="">{{ __('messages.select_reason') }}</option>
                                                @forelse ($get_leave_reasons as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="remarks_div" style="display:none;">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.remarks') }}</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" name="remarks" class="form-control" id="remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_leave">{{ __('messages.total_leave_days') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" name="total_leave" class="form-control number_validation" id="total_leave">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="document">{{ __('messages.attachment_file') }}</label>

                                            <div class="input-group">
                                                <div class="">
                                                    <input type="file" id="leave_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                                                    <span id="file_name"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--3rd row-->
                                <br />
                                <div class="form-group text-right m-b-0">
                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                        {{ __('messages.apply') }}
                                    </button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!--Last Leave Taken -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> {{ __('messages.leave_history') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="staff-leave-list" class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.name') }}</th>
                                                        <th>{{ __('messages.leave_type') }}</th>
                                                        <th>{{ __('messages.leave_from') }}</th>
                                                        <th>{{ __('messages.to_from') }}</th>
                                                        <th>{{ __('messages.reason') }}</th>
                                                        <th>{{ __('messages.document') }}</th>
                                                        <th>{{ __('messages.remarks') }}</th>
                                                        <th>{{ __('messages.status') }}</th>
                                                        <th>{{ __('messages.apply_date') }}</th>
                                                        <th>{{ __('messages.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-box -->
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
    var StaffLeaveList = "{{ route('teacher.leave_management.list') }}";
    var StaffDocUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/leaves/' }}";
    var reuploadFileUrl = "{{ route('teacher.reupload_file.add') }}";
    // Get PDF Footer Text

    var header_txt = "{{ __('messages.all_leaves') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    var teacher_leave_apply_storage = localStorage.getItem('teacher_leave_apply_details');
</script>
<script src="{{ asset('js/custom/staff_apply_leave.js') }}"></script>
@endsection