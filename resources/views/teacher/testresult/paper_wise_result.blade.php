@extends('layouts.admin-layout')
@section('title','Exam Paper Result')
@section('component_css')
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
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.exam_paper_result') }}</h4>
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
                                <h4 class="navv">{{ __('messages.exam_paper_result') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="resultsByPaper" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                            <select id="sectionID" class="form-control" name="section_id">
                                                <option value="">{{ __('messages.select_class') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                            <select id="examnames" class="form-control" name="exam_id">
                                                <option value="">{{ __('messages.select_exams') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                            <select id="subjectID" class="form-control" name="subject_id">
                                                <option value="">{{ __('messages.select_subject') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="semester_id">{{ __('messages.semester') }}</label>
                                            <select id="semester_id" class="form-control" name="semester_id">
                                                <option value="0">{{ __('messages.select_semester') }}</option>
                                                @foreach($semester as $sem)
                                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="session_id">{{ __('messages.session') }}</label>
                                            <select id="session_id" class="form-control" name="session_id">
                                                <option value="0">{{ __('messages.select_session') }}</option>
                                                @foreach($session as $ses)
                                                <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                                @endforeach
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
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card -->
    </div><!-- end col-->
    <div class="row" style="display:none;" id="body_content">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.exam_paper_result') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body" id="card-body-tbl">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="paper_wise_result_body">
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('teacher.exam_results.downbypaperwise') }}">
                                        @csrf
                                        <input type="hidden" name="exam_id" id="downExamID">
                                        <input type="hidden" name="class_id" id="downClassID">
                                        <input type="hidden" name="section_id" id="downSectionID">
                                        <input type="hidden" name="semester_id" id="downSemesterID">
                                        <input type="hidden" name="session_id" id="downSessionID">
                                        <input type="hidden" name="subject_id" id="downSubjectID">
                                        <input type="hidden" name="academic_year" id="downAcademicYear">
                                        <div class="clearfix float-right">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.pdf') }}</button>
                                            <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- container -->
</div>
@endsection
@section('scripts')
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
     toastr.options.preventDuplicates = true;
</script>

<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
    var examBySubjects = "{{ config('constants.api.exam_by_teacher_subjects') }}";
    var getExamPaperResults = "{{ config('constants.api.get_exam_paper_res') }}";

    var teacherID = ref_user_id;
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var downloadFileName = "{{ __('messages.exam_paper_result') }}";
    // localStorage variables
    var teacher_exam_paper_result_storage = localStorage.getItem('teacher_exam_paper_result_details');
</script>
<script src="{{ asset('js/custom/paper_wise_result.js') }}"></script>
@endsection