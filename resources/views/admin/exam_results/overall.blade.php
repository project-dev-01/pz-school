@extends('layouts.admin-layout')
@section('title','Overall')
@section('content')
<style>
    .btn-primary-bl

    {
        width:100px;
        margin-bottom:5px;
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
                <h4 class="page-title">Overall</h4>
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
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="byoverallfilter" data-parsley-validate="">
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
                                    <label for="changeClassName">Grade<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
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
                                        <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">Exam Name<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="exam_id">
                                        <option value="">Select Exam</option>
                                        @forelse ($allexams as $exam)
                                        <option value="{{ $exam['id'] }}">{{ $exam['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
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


    <div class="row" style="display:none;" id="body_content">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Class
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body" id="card-body-tbl">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="overall_body">
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form method="post" action="{{ route('admin.exam_results.downbyoverall') }}">
                                        @csrf
                                        <input type="hidden" name="exam_id" id="downExamID">
                                        <input type="hidden" name="class_id" id="downClassID">
                                        <input type="hidden" name="semester_id" id="downSemesterID">
                                        <input type="hidden" name="session_id" id="downSessionID">
                                        <input type="hidden" name="academic_year" id="downAcademicYear">

                                        <div class="clearfix float-right">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">PDF</button>
                                            <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">Download</button>
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
    <!-- <div class="row" id="analysis_graph">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Overall Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-overall" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var getoverall = "{{ config('constants.api.tot_grade_calcu_overall') }}";

    //
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/overall.js') }}"></script>
@endsection