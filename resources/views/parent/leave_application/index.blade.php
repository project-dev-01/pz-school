@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_application') . '')
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
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
<style>
    .selected-cell {
        background-color: #f2f2f2;
        /* Change to your desired highlight color */
    }

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

    @media screen and (min-device-width: 768px) and (max-device-width: 1200px) {
        .dt-buttons {
            margin-left: 56px;
        }

        div.dt-buttons {
            display: flex;
        }
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
    content: "{{ __('messages.butt_browse') }}";
}
</style>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg class="svg-icon" width="20" height="20" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                        <path d="M802.133333 567.466667c-123.733333 0-221.866667 98.133333-221.866666 221.866666s98.133333 221.866667 221.866666 221.866667 221.866667-98.133333 221.866667-221.866667-98.133333-221.866667-221.866667-221.866666z m0 388.266666c-89.6 0-162.133333-72.533333-162.133333-162.133333s72.533333-162.133333 162.133333-162.133333 162.133333 72.533333 162.133334 162.133333-72.533333 162.133333-162.133334 162.133333z" fill="#3A4265"></path>
                        <path d="M832 780.8v-102.4c0-17.066667-12.8-29.866667-29.866667-29.866667-17.066667 0-29.866667 12.8-29.866666 29.866667v115.2c0 8.533333 4.266667 12.8 8.533333 21.333333l59.733333 59.733334c4.266667 4.266667 12.8 8.533333 21.333334 8.533333s12.8-4.266667 21.333333-8.533333c12.8-12.8 12.8-29.866667 0-42.666667l-51.2-51.2z" fill="#3A4265"></path>
                        <path d="M524.8 789.333333c0-72.533333 25.6-136.533333 72.533333-183.466666v-166.4h170.666667v81.066666c12.8 0 21.333333-4.266667 34.133333-4.266666 17.066667 0 34.133333 0 51.2 4.266666V226.133333c0-72.533333-55.466667-128-128-128h-85.333333v-42.666666c0-25.6-17.066667-42.666667-42.666667-42.666667s-42.666667 17.066667-42.666666 42.666667v42.666666H298.666667v-42.666666c0-25.6-17.066667-42.666667-42.666667-42.666667s-42.666667 17.066667-42.666667 42.666667v42.666666H128c-72.533333 0-128 55.466667-128 128v597.333334c0 72.533333 55.466667 128 128 128h448c-29.866667-46.933333-51.2-102.4-51.2-162.133334zM85.333333 226.133333c0-25.6 17.066667-42.666667 42.666667-42.666666h85.333333v42.666666c0 25.6 17.066667 42.666667 42.666667 42.666667s42.666667-17.066667 42.666667-42.666667v-42.666666h256v42.666666c0 25.6 17.066667 42.666667 42.666666 42.666667s42.666667-17.066667 42.666667-42.666667v-42.666666h85.333333c25.6 0 42.666667 17.066667 42.666667 42.666666v128H85.333333v-128z m170.666667 640H128c-25.6 0-42.666667-17.066667-42.666667-42.666666v-132.266667h170.666667v174.933333z m0-260.266666H85.333333v-166.4h170.666667v166.4z m256 260.266666H341.333333v-174.933333h170.666667v174.933333z m0-260.266666H341.333333v-166.4h170.666667v166.4z" fill="#3A4265"></path>
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.leave_application') }}</h4>
            </div>
        </div>
    </div>

    <!--General Details -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.leave_application') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1"  aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                
                <div class="card-body collapse show">
                    <form id="stdGeneralDetails" method="post" action="{{ route('parent.studentleave.add') }}">
                        @csrf
                        <!-- <input type="text" name="class_id" id="listModeClassID">
                        <input type="text" name="section_id" id="listModeSectionID" />
                        <input type="text" name="student_id" id="listModestudentID" />
                        <input type="text" name="reasons" id="listModereason" />
                        <input type="text" name="reasonstxt" id="listModereasontext" /> -->
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeStdName">{{ __('messages.lab_student_name') }}<span class="text-danger">*</span></label>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">{{ __('messages.select_student') }}</option>
                                        @forelse ($get_std_names_dashboard as $std)
                                        <option value="{{ $std['id'] }}" data-classid="{{ $std['class_id'] }}" data-sectionid="{{ $std['section_id'] }}" {{ Session::get('student_id') == $std['id'] ? 'selected' : ''}}>{{ $std['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="frm_ldate">{{ __('messages.lab_leave_start') }}<span class="text-danger">*</span></label>
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
                                    <label for="to_ldate">{{ __('messages.lab_leave_end') }}<span class="text-danger">*</span></label>
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
                                    <label for="total_leave">{{ __('messages.lab_number_of_days_leave') }}<span class="text-danger">*</span></label>
                                    <input type="number" id="total_leave" name="total_leave" class="form-control" placeholder="{{ __('messages.enter_days_leave') }}" readonly>
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeLevType">{{ __('messages.lab_leave_type') }}<span class="text-danger">*</span></label>
                                    <select id="changeLevType" class="form-control" name="changeLevType">
                                        <option value="">{{ __('messages.select_leave_type') }}</option>
                                        @forelse ($get_student_leave_types as $ress)
                                        <option value="{{ $ress['id'] }}">{{ $ress['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changelevReasons">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                    <select id="changelevReasons" class="form-control" name="changelevReasons">
                                        <option value="">{{ __('messages.select_reason') }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <!--3st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="leave_file">{{ __('messages.attachment_file') }}</label>

                                    <div class="input-group">
                                        <div class="">
                                            <input type="file" id="leave_file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="leave_file">{{ __('messages.choose_the_file') }}</label>
                                            <span id="file_name"></span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtarea_prev_remarks">{{ __('messages.remarks') }}</label>
                                    <textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="{{ __('messages.enter_the_remarks') }}" name="txtarea_prev_remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" class="btn form-control" style="background-color: gray;color:white;white-space: nowrap;display: inline-block;overflow: hidden;text-overflow: ellipsis;" data-toggle="modal" id="studentAllReasons">{{ __('messages.click_here_for') }}</button>
                                    <!-- <input type="button" class="form-control" id="btnOpenDialog" value="Click Here For Reason Details" /> -->
                                </div>
                            </div>


                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.apply') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.head_leave_application_status') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2"  aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
              
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="studentleave-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.tab_student_name') }}</th>
                                    <th>{{ __('messages.tab_leave_start') }}</th>
                                    <th>{{ __('messages.tab_leave_end') }}</th>
                                    <th>{{ __('messages.tab_teacher_remarks') }}</th>
                                    <th>{{ __('messages.leave_type') }}</th>
                                    <th>{{ __('messages.reason') }}</th>
                                    <th>{{ __('messages.tab_attachment') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.apply_date') }}</th>
                                    <th>{{ __('messages.tab_action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->

    <!-- Center modal content -->
    @include('parent.leave_application.reason')

</div> <!-- container -->
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
<script>
    var UserName = "{{ Session::get('name') }}";
    // general details get student names
    var stutdentleaveList = "{{ route('parent.student_leave.list') }}";
    var reuploadFileUrl = "{{ route('parent.reupload_file.add') }}";
    // leave apply
    var StudentDocUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/teacher/student-leaves/' }}";
    // Get PDF Footer Text
    var leave_status_txt = "{{ __('messages.leave_status') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    var getReasonsByLeaveType = "{{ config('constants.api.get_reasons_by_leave_type') }}";
    var leaveTypeWiseGetAllReason = "{{ config('constants.api.leave_type_wise_get_all_reason') }}";
    // Get PDF Header & Footer Text End
    var at = "{{date('d-m-Y')}}";
    $("#frm_ldate").val(at);
    // $("#to_ldate").val(at);

    var parent_leaveapply_storage = localStorage.getItem('parent_leaveapply_details');
    var holidayEventList = "{{ config('constants.api.holidays_list_event') }}";
</script>
<!-- to do list -->
<script src="{{ asset('js/custom/parent_leave_app.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection