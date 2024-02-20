@extends('layouts.admin-layout')
@section('title',' ' . __('messages.dashboard_hideunhide') . '')
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
                <h4 class="page-title">{{ __('messages.dashboard_hideunhide') }}</h4>
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
                                <h4 class="navv">{{ __('messages.dashboard_hideunhide') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="DemoBS2">
                            <!-- Toogle Buttons -->
                            <div>
                                <div class="container">
                                    <div class="row">
                                        <button type="button" name="add" id="add" class="btn btn-primary" style="margin: 18px;border-color: #0ABAB5;background-color: #6FC6CC; margin-left: 25px;margin-bottom: 0px;">{{ __('messages.add_hideunhide') }}</button>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form id="addDynamicFilter" action="{{ route('admin.widget.add') }}" method="post">
                                                <div class="table-responsive">    
                                                <table class="table table-borderless" id="dynamic_field">
                                                        @forelse($get_data_hide_unhide_dashboard as $r)
                                                        <tr class="widget" id="{{ $r['order_no'] }}" data-id="{{ $r['order_no'] }}" data-order="{{ $r['order_no'] }}">
                                                            <td class="col-md-9">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][order_no]" id="orderNo{{ $r['order_no'] }}" value="{{ $r['order_no'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][widget_name]" id="widgetName{{ $r['order_no'] }}" value="{{ $r['widget_name'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][widget_value]" id="widgetValue{{ $r['order_no'] }}" value="{{ $r['widget_value'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][visibility]" id="visibility{{ $r['order_no'] }}" value="{{ $r['visibility'] }}">

                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][department_id]" id="departmentID{{ $r['order_no'] }}" value="{{ $r['department_id'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][class_id]" id="classID{{ $r['order_no'] }}" value="{{ $r['class_id'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][section_id]" id="sectionID{{ $r['order_no'] }}" value="{{ $r['section_id'] }}">
                                                                <input type="hidden" name="unhide_data[{{ $r['order_no'] }}][pattern]" id="patternName{{ $r['order_no'] }}" value="{{ $r['pattern'] }}">
                                                                <button type="button" data-widget="{{ $r['order_no'] }}" id="WidgetLabelName{{ $r['order_no'] }}" class="form-control name_list addWidget" style="height: 50px;border-radius: 10px;border: 1px solid #18161652;background-color: transparent;">{{ $r['widget_name'] }}</button>
                                                            </td>
                                                            <td class="col-md-3" style="padding:15px;">
                                                            <div class="btn-group">
                                                                <button type="button" class="fe-arrow-up move-up" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px; margin-right:10px;"><i class="fe-arrow-up"></i></button>
                                                                <button type="button" class="fe-arrow-down move-down" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px; margin-right:10px;"><i class="fe-arrow-down"></i></button>
                                                                <button type="button" class="fe-remove remove-widget" style="background-color: transparent;border: 1px solid #18161652;height: 50px;border-radius: 10px;width: 45px;"><i class="fe-trash"></i></button>
</div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        @endforelse
                                                    </table>
</div>
                                                    <div class="form-group text-right m-b-0">
                                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">{{ __('messages.save') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">{{ __('messages.dashboard_details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.s.no') }}</th>
                                            <th>{{ __('messages.dashboard_details') }}</th>
                                            <th>{{ __('messages.action') }}</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <input type="hidden" value="" id="widgetDynamicID">
                                            <td>1</td>
                                            <td>{{ __('messages.AttendanceReport') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light" data-widgetname="Attendance Report" data-orderno="1" data-widgetvalue="AttendanceReport" data-toggle="modal" data-target="#attendance-modal">{{ __('messages.add') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>{{ __('messages.Calendar') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="Calendar" data-orderno="2" data-widgetvalue="Calendar">{{ __('messages.add') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>{{ __('messages.Task') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="Task" data-orderno="3" data-widgetvalue="Task">{{ __('messages.add') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>{{ __('messages.StudentTransferredList') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="StudentTransferredList" data-orderno="4" data-widgetvalue="StudentTransferredList">{{ __('messages.add') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>{{ __('messages.ShortcutLinks') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="ShortcutLinks" data-orderno="5" data-widgetvalue="ShortcutLinks">{{ __('messages.add') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>{{ __('messages.BulletinBoard') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="BulletinBoard" data-orderno="6" data-widgetvalue="BulletinBoard">{{ __('messages.add') }}</button></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>{{ __('messages.student_plan_to_leave') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="StudentPlanToLeave" data-orderno="7" data-widgetvalue="StudentPlanToLeave">{{ __('messages.add') }}</button></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>{{ __('messages.student_new_joining_list') }}</td>
                                            <td><button class="btn btn-success waves-effect waves-light addToWidget" data-widgetname="StudentNewJoining" data-orderno="8" data-widgetvalue="StudentNewJoining">{{ __('messages.add') }}</button></td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="modal fade attendance-modal" id="attendance-modal" tabindex="-1" role="dialog" aria-labelledby="attendance-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-full-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendance-modalTitle">{{ __('messages.add_attendance_report') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            {{ __('messages.attendance_report') }}
                                            <h4>
                                    </li>
                                </ul><br>
                                <br>
                                <div class="card-body">
                                    <form id="attendanceFilter" autocomplete="off">
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="atOrderNo" value="1" />
                                            <input type="hidden" class="form-control" id="attwidgetValue" value="AttendanceReport" />

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="att_widget_name">{{ __('messages.widget_name') }}<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="att_widget_name" name="att_widget_name" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="department_id">{{ __('messages.department') }}</label>
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
                                                    <label for="changeClassName">{{ __('messages.grade') }}</label>
                                                    <select id="changeClassName" class="form-control" name="class_id">
                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sectionID">{{ __('messages.class') }}</label>
                                                    <select id="sectionID" class="form-control" name="section_id">
                                                        <option value="">{{ __('messages.select_class') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pattern">{{ __('messages.pattern') }}</label>
                                                    <select id="pattern" class="form-control" name="pattern">
                                                        <!-- <option value="">Select Pattern</option> -->
                                                        <option value="Day">{{ __('messages.day') }}</option>
                                                        <option value="Month">{{ __('messages.month') }}</option>
                                                        <option value="Term">{{ __('messages.term') }}</option>
                                                        <option value="Year">{{ __('messages.year') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button to fetch and display attendance information -->
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-success waves-effect waves-light">{{ __('messages.add') }}</button>
                                        </div>
                                        <!-- Display the attendance information -->
                                    </form>
                                </div>
                                <div class="">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div id="attendanceInfo">

                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end col -->

                                </div>
                                <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        // Get PDF Footer Text
        var countHideUnhide = "{{ count($get_data_hide_unhide_dashboard) }}";
        var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
        var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
        var header_txt = "{{ __('messages.all_leaves') }}";
        var footer_txt = "{{ session()->get('footer_text') }}";
        // Get PDF Header & Footer Text End
    </script>
    <script src="{{ asset('js/custom/dashboard_widget_hide.js') }}"></script>
    @endsection