@extends('layouts.admin-layout')
@section('title','Exam Paper Result')
@section('content')
<style>
    .ellipse {
        white-space: nowrap;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .two-lines {
        -webkit-line-clamp: 2;
        display: inline-grid;
        white-space: normal;
    }

    .width {
        width: 130px;
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
                <h4 class="page-title">Exam Paper Result</h4>
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
                                <h4 class="navv">Exam Paper Result
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="resultsByPaper" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="changeClassName">Grade<span class="text-danger">*</span></label>
                                            <select id="changeClassName" class="form-control" name="class_id">
                                                <option value="">Select Grade</option>
                                                @forelse ($classes as $class)
                                                <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sectionID">Class<span class="text-danger">*</span></label>
                                            <select id="sectionID" class="form-control" name="section_id">
                                                <option value="">Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="examnames">Test Name<span class="text-danger">*</span></label>
                                            <select id="examnames" class="form-control" name="exam_id">
                                                <option value="">Select Exams</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subjectID">Subject<span class="text-danger">*</span></label>
                                            <select id="subjectID" class="form-control" name="subject_id">
                                                <option value="">Select Subject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="semester_id">Semester</label>
                                            <select id="semester_id" class="form-control" name="semester_id">
                                                <option value="0">Select Semester</option>
                                                @foreach($semester as $sem)
                                                <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="session_id">Session</label>
                                            <select id="session_id" class="form-control" name="session_id">
                                                <option value="0">Select Session</option>
                                                @foreach($session as $ses)
                                                <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                        Filter
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
                            Exam Paper Result
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
                                    <button type="button" class="btn btn-primary-bl waves-effect waves-light float-right exportToExcel">Download</button>
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
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
    var examBySubjects = "{{ config('constants.api.exam_by_subjects') }}";

    var getExamPaperResults = "{{ config('constants.api.get_exam_paper_res') }}";

    var teacherID = null;
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/paper_wise_result.js') }}"></script>
@endsection