@extends('layouts.admin-layout')
@section('title','Promotion Import')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    th#hide-id {
      display: none;
    }
    @media screen and (min-device-width: 768px) and (max-device-width: 1200px)
     {
        .dt-buttons {
            margin-left: 56px;
        }

        div.dt-buttons {
            display: flex;
        }
    }
  </style>
<!-- Page Content -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.promotion_import') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.promotion_import') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="dt-buttons" style="float:right;">
                                <a href="{{ config('constants.image_url').'/common-asset/uploads/promotion_sample.csv'}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    {{ __('messages.upload_validation_error') }}<br><br>
                    <ul>
                        @foreach($errors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.promotion.import.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group" style="text-align: center;">
                        <div class="card-body" style="margin-left: 17px;">
                            <label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
                            <input type="file" name="file" />
                        </div>
                        <input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /Content End -->
<!-- content start  -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.student_promoted_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="promoteStudentListForm" method="post" action="" autocomplete="off">
                         <div class="table-responsive">
                            <table class="table w-100 nowrap" id="promotionBulkData">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllchkbox"></th>
                                        <th># {{ __('messages.attendance_no') }}</th>
                                        <th>{{ __('messages.student_name') }}</th>
                                        <th>{{ __('messages.student_number') }}</th>
                                        <th>{{ __('messages.current_dept') }}</th>
                                        <th>{{ __('messages.current_grade') }}</th>
                                        <th>{{ __('messages.current_class') }}</th>
                                        <th>{{ __('messages.current_semester') }}</th>
                                        <th>{{ __('messages.current_session') }}</th>
                                        <th style="background-color: orange;">{{ __('messages.promoted_dept') }}</th>
                                        <th style="background-color: orange;">{{ __('messages.promoted_grade') }}</th>
                                        <th style="background-color: orange;">{{ __('messages.promoted_class') }}</th>
                                        <th style="background-color: orange;">{{ __('messages.promoted_semester') }}</th>
                                        <th style="background-color: orange;">{{ __('messages.promoted_session') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @if(session::get('data'))
                                @foreach(session::get('data') as $index => $outerArray)
                                    @foreach($outerArray as $index2 => $innerArray)
                                    <tr id="row-{{ $index2 }}">
                                        <td><input type="checkbox" class="selectAllchkbox"></td>
                                        @foreach($innerArray[0] as $key => $value)
                                            @if($key === 'id')
                                            <input type="hidden" name="id" value="{{ $value }}">
                                            @elseif($key === 'attendance_no')
                                            <td data-field="{{ $key }}" class="data-cell">
                                              <span class="attendance-td">{{ $value }}</span>
                                                    <a href="#" data-toggle="modal" data-target="#centermodal" class="open-modal" data-attendance="{{ $value }}" data-row-index="{{ $index2 }}">
                                                        <i class="fa fa-caret-down" style="color:solid blue;font-size: 18px;padding: 0px 0px 0px 12px;"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td>{{ $value }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                @endforeach 
                                @else
                                <td colspan="14" class="text-center">{{ __('messages.n0_data_availlable') }}</td>   
                                @endif
                                    </tr>
                                </tbody>
                            </table>
                      </div>
                        <br>
                        @if(session::get('data'))
                        <div class="form-group text-right m-b-0">

                            <button class="btn btn-primary-bl waves-effect waves-light" id="saveDataBtn" type="button">
                                {{ __('messages.save') }}
                            </button>
                        </div>
                        @endif
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #10a084;">
                <h4 class="modal-title" id="myCenterModalLabel">{{ __('messages.are_you_sure') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="card-body">
                <form id="attendanceForm">
                <div class="form-group">
                    <label for="attendanceNumber">{{ __('messages.attendance_number') }}<span class="text-danger">*</span></label>
                    <input type="text" id="attendanceNumber" name="attendanceNumber" class="form-control" placeholder="{{ __('messages.enter_attendance_number') }}">
                    <span class="text-danger error-text name_error"></span>
                </div>
                <div class="form-group text-right m-b-0">
                    <button type="button" class="btn btn-success waves-effect waves-light" id="saveAttendanceBtn">{{ __('messages.save') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>

<!-- /Page Content -->
@endsection
@section('scripts')
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
// Declare rowIndexToUpdate in a scope accessible by both events
var rowIndexToUpdate;

// Event handler when the modal is opened
$('#centermodal').on('show.bs.modal', function (event) {
    var attendanceValue = $(event.relatedTarget).data('attendance');
    rowIndexToUpdate = $(event.relatedTarget).data('row-index');
    $('#attendanceNumber').val(attendanceValue);
});

// Event handler when the save button is clicked
$('#saveAttendanceBtn').on('click', function() {
    var newAttendanceValue = $('#attendanceNumber').val();
    console.log('New Attendance Value:', newAttendanceValue);
    console.log('Row Index to Update:', rowIndexToUpdate);

    // Update the table cell with the new attendance value
    $('#row-' + rowIndexToUpdate + ' .attendance-td').text(newAttendanceValue);
    $('#centermodal').modal('hide');
});

</script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var promotionImportUrl = "{{ route('admin.promotion.import.save') }}";
    var getStudentListByClassSectionUrl = "{{ config('constants.api.get_student_by_class_section_sem_ses') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";

    var admin_promotion_storage = localStorage.getItem('admin_promotion_details');
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
</script>
<script src="{{ asset('js/custom/promotion_bulk.js') }}"></script>@endsection