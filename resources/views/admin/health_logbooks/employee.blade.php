@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.employee_attendance_report') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

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
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title"> {{ __('messages.health_logbooks') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="employeeAttendanceFilter" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_homework">{{ __('messages.date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>

                                        <input type="text" class="form-control homeWorkAdd" name="date_of_homework" id="date_of_homework" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" id="filterButton" type="submit">
                            {{ __('messages.filter') }} 
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <form id="healthLogBookForm" action="" method="post">
        <div class="card classRoomHideSHow" style="display: none;">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.part_a') }}<h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="temp">{{ __('messages.temperature') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="temp" name="temp" placeholder="{{ __('messages.enter_temperature') }}" aria-describedby="inputGroupPrepend">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="weather">{{ __('messages.weather') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="weather" name="weather" placeholder="{{ __('messages.enter_weather') }}" aria-describedby="inputGroupPrepend">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="humidity">{{ __('messages.humidity') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="humidity" name="humidity" placeholder="{{ __('messages.enter_humidity') }}" aria-describedby="inputGroupPrepend">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="description">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
        </div>

        <div class="card classRoomHideSHow" style="display: none;">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.part_b') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                        <div class="summernote">
                                            <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="{{ __('messages.event_notes_type_here') }}" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
        </div>

        <div class="card classRoomHideSHow" style="display: none;">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.part_c') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                        <select id="changeClassName" class="form-control" name="class_id">
                                            <option value="">{{ __('messages.select_grade') }}</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                        <select id="sectionID" class="form-control" name="section_id">
                                            <option value="">{{ __('messages.select_class') }}</option>
                                        </select>
                                    </div>
                                </div>
                            
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{ __('messages.name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.enter_name') }}" aria-describedby="inputGroupPrepend">
                                       
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="section_id">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                        <select id="gender" name="gender" class="form-control">
                                        <option value="">{{ __('messages.select_gender') }}</option>
                                        <option value="Male">{{ __('messages.male') }}</option>
                                        <option value="Female">{{ __('messages.female') }}</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time">{{ __('messages.time') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="time" name="time" placeholder="{{ __('messages.enter_time') }}" aria-describedby="inputGroupPrepend">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descriptions">{{ __('messages.event_notes') }}<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="descriptions" id="descriptions" placeholder="{{ __('messages.enter_event_notes') }}"></textarea>
                                    </div>
                                </div>
                        </div>
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <h4 class="navv">{{ __('messages.report_list') }}
                                <h4>
                        </li>
                    </ul><br>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100" id="healthLogbooksTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.grade') }}</th>
                                        <th>{{ __('messages.class') }}</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.gender') }}</th>
                                        <th>{{ __('messages.time') }}</th>
                                        <th>{{ __('messages.event_notes') }}</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!--- end row -->
            </form>
        </div>
    
<div class="form-group text-right m-b-0">

<!-- <form method="post" action="{{ route('admin.attendance.student_excel')}}">
    <input type="hidden" name="subject" id="excelSubject">
    <input type="hidden" name="class" id="excelClass">
    <input type="hidden" name="section" id="excelSection">
    <input type="hidden" name="semester" id="excelSemester">
    <input type="hidden" name="session" id="excelSession">
    <input type="hidden" name="date" id="excelDate"> -->
    <div class="clearfix float-right">
        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
        {{ __('messages.download') }}
        </button>
    </div>
<!-- </form> -->
   
    <div class="clearfix float-right" style="margin-right: 5px;">
    <button type="submit"  id="saveButton" class="btn btn-primary-bl waves-effect waves-light">
        {{ __('messages.save') }}
    </button>
    </div>
   
</div>
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<!-- hightcharts js -->
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
     toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    var getHealthLogBooksList = "{{ route('admin.health_logbooks.list') }}";
    var saveHealthLogBooksList = "{{ route('admin.health_logbooks.add') }}";
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
    var getTeacherAbsentExcuse = "{{ config('constants.api.get_teacher_absent_excuse') }}";
    
    var admin_employee_attentance_storage = localStorage.getItem('admin_employee_attentance_details');
</script>

<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>


<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>

<script>
    var homeworkView = "{{ route('admin.homework.view') }}";
    var homeworkList = "{{ route('admin.evaluation_report') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.subject_by_class') }}";
    var evaluationReportList = "{{ route('admin.evaluation_report.list') }}";
    var homeworkTableList = "{{ route('admin.homework.details') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.evaluation_report') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    var admin_evaluation_report_storage = localStorage.getItem('admin_evaluation_report_details');
</script>
<script src="{{ asset('js/custom/health_log_books.js') }}"></script>

@endsection


