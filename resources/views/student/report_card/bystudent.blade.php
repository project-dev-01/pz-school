@extends('layouts.admin-layout')
@section('title',' ' . __('messages.by_student') . '')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.by_student') }}</h4>
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
                        <h4 class="navv"> {{ __('messages.select_ground') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <form id="bystudentfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        <!-- <option value="All">All</option> -->
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span>
                                    </label>
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
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.get') }}
                            </button>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" style="display: none;" id="bystudent_bodycontent">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.student') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div id="byStudentTableAppend">

                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light float-right exportToExcel">{{ __('messages.download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- <div class="row" id="bystudent_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Student Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudent" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";
    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
    // default image test
    var teacher_id = null;
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
</script>
<script src="{{ asset('js/custom/bystudent.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection