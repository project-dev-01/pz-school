@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_apply') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
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
    .custom-file-input:lang(en)~.custom-file-label::after 
    {
    content: "{{ __('messages.butt_browse') }}";
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_122_3580)">
                                <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_122_3580">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_management') }} </a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.leave_apply') }} </a></li>
                </ol>

            </div>   
        
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.already_taken_leave_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                   
                        <div class="card-body collapse show">
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
                                            <td>{{ $val['leave_type_name'] }}</td>
                                            <td>{{ $val['overall_days'] }} Days ({{ $val['overall_days_by_hours'] }} hours)</td>
                                            <td>{{ $val['used_leave_days'] }} Days ({{ $val['used_leave_days_by_hours'] }} hours)</td>
                                            <td>{{ $val['applied_leave_days'] }} Days ({{ $val['applied_leave_days_by_hours'] }} hours)</td>
                                            <td>{{ $val['balance_days'] }} Days ({{ $val['balance_days_by_hours'] }} hours)</td>
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
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.leave_application') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                      
                        <div class="card-body collapse show">
                            <form id="staffLeaveApply" method="post" action="{{ route('admin.leave_management.add') }}" autocomplete="off" novalidate>
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
                                            <label for="leave_request">{{ __('messages.leave_request_for') }}<span class="text-danger">*</span></label>
                                            <select id="leave_request" name="leave_request" class="form-control">
                                                <option value="Days">{{ __('messages.days') }}</option>
                                                <option value="Hours">{{ __('messages.hours') }}</option>
                                            </select>
                                        </div>
                                    </div>
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
                                </div>
                                <!--2st row-->
                                <div class="row">
                                    <div class="col-md-4 dateSlotShow">
                                        <div class="form-group">
                                            <label for="frm_ldate">{{ __('messages.leave_from') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="frm_ldate" class="form-control" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="frm_ldate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 dateSlotShow">
                                        <div class="form-group">
                                            <label for="to_ldate">{{ __('messages.to_leave') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="to_ldate" class="form-control" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="to_ldate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 timeSlotShow" style="display:none">
                                        <div class="form-group">
                                            <label for="leave_date">{{ __('messages.leave_date') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="leave_date" class="form-control" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="leave_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 timeSlotShow" style="display:none">
                                        <div class="form-group">
                                            <label>{{ __('messages.start_time') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control timepicker" name="start_time" id="start_time">
                                            <span class="text-danger error-text start_time_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 timeSlotShow" style="display:none">
                                        <div class="form-group">
                                            <label>{{ __('messages.end_time') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control timepicker" name="end_time" id="end_time">
                                            <span class="text-danger error-text end_time_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 dateSlotShow">
                                        <div class="form-group">
                                            <label for="total_leave">{{ __('messages.total_leave_days') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="number" name="total_leave" class="form-control number_validation" step=".5" id="total_leave">
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div>
                                <div class="row"> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="document">{{ __('messages.attachment_file') }}</label>

                                            <div class="input-group">
                                                <div class="">
                                                    <input type="file" id="leave_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="document">{{ __('messages.choose_the_file') }}</label>
                                                    <span id="file_name"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4" id="remarks_div">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.remarks') }}</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <textarea type="textarea" name="remarks" rows="3" class="form-control" id="remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--3rd row-->
                                <br />
                                <div class="form-group text-right m-b-0">
                                    <button type="submit" id="submitButton" class="btn btn-primary-bl waves-effect waves-light">
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
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.leave_history') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                      
                        <div class="card-body collapse show">
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
                                                        <th>{{ __('messages.teachers_remarks') }}</th>
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    var StaffLeaveList = "{{ route('admin.leave_management.apply_list') }}";
    var StaffDocUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/leaves/' }}";
    var reuploadFileUrl = "{{ route('admin.reupload_file.add') }}";
    // Get PDF Footer Text
    var header_txt = "{{ __('messages.leave_management') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/staff_apply_leave.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection