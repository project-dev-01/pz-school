@extends('layouts.admin-layout')
@section('title','Student Interview Notes')
@section('component_css')
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- Start Content-->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li>
                        </ol>
                    </div> -->
                <h4 class="page-title">{{ __('messages.student_interview_notes') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.student_interview_details') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="form-group pull-right">
                        <div class="col-xs-2 col-sm-2">
                            <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                            <a type="button" class="btn add-btn btn-rounded waves-effect waves-light" href="{{ route('teacher.student_interview_notes.create')}}">{{ __('messages.add') }}</a>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="studentInterviewTeacherForm" data-parsley-validate="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sectionID"> {{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_name') }}<span class="text-danger">*</span></label>
                                    <select id="student_id" class="form-control" name="student_id">
                                    <option value="">{{ __('messages.select_student') }}</option>
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
                <div class="card studentInterviewShow" style="display:none;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.student_leave_details_list') }}
                            <h4>
                    </li>
                </ul>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100" id="studentInterviewTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>id</th>
                                        <th>{{ __('messages.department') }}</th>
                                        <th>{{ __('messages.grade') }}</th>
                                        <th>{{ __('messages.class') }}</th>
                                        <th>{{ __('messages.student_name') }}</th>
                                        <th>{{ __('messages.type') }}</th>
                                        <th>{{ __('messages.title') }}</th>
                                        <th>{{ __('messages.number_of_messages') }}</th>
                                        <th>{{ __('messages.action') }}</th>                     
                                    </tr>
                                </thead>
                                <tbody>  
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div> <!-- end card-box-->
                </div>
            </div> <!-- end card -->
            </div>

        </div><!-- end col-->
    </div>
    <!-- end row-->
    @include('teacher.student_interview_notes.edit')
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script>
    
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    var getStudentList = "{{ config('constants.api.get_student_details_buletin_board') }}";
    var getStudentInterviewList = "{{ route('teacher.student_interview_details.list') }}";
    var editStudentInterview = "{{ route('teacher.student_interview_details.edit') }}";
    var updateStudentInterviewComment = "{{ route('teacher.student_interview_details.update') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
</script>
<script src="{{ asset('js/custom/student_interview_teacher.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
    var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>

@endif
@endsection