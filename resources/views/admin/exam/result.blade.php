@extends('layouts.admin-layout')
@section('title','Exam Result')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Exam Result</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Exam
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="byexamfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">Academic year<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">Select Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID" id="lblsectionId">Class Name<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
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
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
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
                                    <label for="heard">Roll No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="registerno" name="registerno">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Get
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="exam_details_div" style="display: none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Exam Result
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            <header><b>Student General Details</b></header>
                                            <h4>
                                    </li>
                                </ul>
                                <br>
                                <!-- <header><b style="line-height:35px;">Student General Details</b></header>-->
                                <div id="byStudentGeneralDetails">
                                </div>
                            </div>
                        </div>
                        <br>



                        <div class="col-sm-12">
                            <div class="card-box">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <h4 class="navv">
                                            <header><b>Individual Subject</b></header>
                                            <h4>
                                    </li>
                                </ul>
                                <br>
                                <!--<header><b style="line-height:35px;">Individual Subject</b></header>-->
                                <div id="byStudentTableAppend">
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right;">Download</button>
                                    </div>
                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->


@endsection
@section('scripts')
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";

    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyresult = "{{ config('constants.api.student_result') }}";
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    var teacher_id = null;
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/exam_result.js') }}"></script>
@endsection