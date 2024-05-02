@extends('layouts.admin-layout')
@section('title',' ' . __('messages.evaluation_report') . '')
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
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
<style>
    .accordion-head i {
        font-size: 23px;
        float: right;
        margin-top: 5px;
    }

    .accordion-head>.collapsed>i:before {
        content: "\f077";

    }

    a {
        color: #3A4265;
        text-decoration: none;
        background-color: transparent;
    }

    a:hover {
        color: #3A4265;
        text-decoration: none;
    }
    div.dt-buttons {
    display: flex;
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
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1.6668H3.93801V3.1181H5.0536V1.6668H5.28419H20.0992C20.9784 1.64405 21.8384 1.90614 22.5299 2.40755C23.2215 2.90896 23.7008 3.61801 23.8847 4.41156C23.9536 4.69416 23.9873 4.98309 23.9851 5.27273C23.9851 12.2033 23.9851 15.1361 23.9851 22.0712C24.0144 22.7616 23.8171 23.4441 23.419 24.0293C23.0209 24.6146 22.4406 25.0753 21.7539 25.3511C21.2377 25.5735 20.6724 25.6816 20.1029 25.6668H5.07593V24.2086H3.96034V25.6531H0.0111668L0 1.6668ZM3.96034 5.18696V6.96762H5.07593V5.18696H3.96034ZM5.07593 10.8V9.02962H3.96034V10.8H5.07593ZM3.98268 12.8586V14.6324H5.09826V12.8586H3.98268ZM5.09826 16.6944H3.98268V18.4785H5.09826V16.6944ZM5.09826 20.537H3.98268V22.3108H5.09826V20.537Z" fill="#3A4265" />
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.homework') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.evaluation_report') }}</a></li>
                </ol>

            </div> 
         
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.select_ground') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
             
                <div class="card-body collapse show">
                    <form id="evaluationFilterForm" autocomplete="off">
                        <div class="row">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject_id">{{ __('messages.subject') }}</label>
                                    <select id="subject_id" class="form-control" name="subject_id">
                                        <option value="All">{{ __('messages.all') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
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
    <div class="row">
        <div class="col-lg-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" role="tab" id="homewWorkHis" style="border-color: #0ABAB5;background-color: #cfe2ff;/*#6FC6CC;*/">
                        <div class="mb-0 row">
                            <div class="col-12 no-padding accordion-head">
                                <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyOne" aria-expanded="false" aria-controls="accordionBodyOne" class="collapsed ">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    <h3>{{ __('messages.click_here_homework_history') }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="accordionBodyOne" class="collapse" role="tabpanel" aria-labelledby="homewWorkHis" aria-expanded="false" data-parent="accordion">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <h4 class="navv">{{ __('messages.homework_history') }}
                                        <h4>
                                </li>
                            </ul><br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table dt-responsive nowrap w-100" id="evaluation-report-history">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.title') }}</th>
                                                <th>{{ __('messages.date_of_homework') }}</th>
                                                <th>{{ __('messages.date_of_submission') }}</th>
                                                <th>{{ __('messages.complete') }}/{{ __('messages.incomplete') }}</th>
                                                <th>{{ __('messages.total_student') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end card-box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.homework_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
               
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="homework-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.date_of_homework') }}</th>
                                    <th>{{ __('messages.date_of_submission') }}</th>
                                    <th>{{ __('messages.complete') }}/{{ __('messages.incomplete') }}</th>
                                    <th>{{ __('messages.total_student') }}</th>
                                    <th>{{ __('messages.action') }}</th>

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

    </div>
    <!-- end row -->

</div> <!-- container -->

@include('admin.homework.homework_modal')
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
<script src="{{ asset('js/custom/homework.js') }}"></script>
<script src="{{ asset('js/custom/evaluatuion_report.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection