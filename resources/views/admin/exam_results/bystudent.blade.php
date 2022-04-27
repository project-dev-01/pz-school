@extends('layouts.admin-layout')
@section('title','By Student')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">              
                </div>
                <h4 class="page-title">By Student</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                <form id="bystudentfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
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
                                <label for="sectionID" id="lblsectionId">Class Name<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
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
                        </div>
                        <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Get
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
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Student 
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                            <div class="table-responsive">
                            <table class="table w-100 nowrap table-bordered table-striped">
                                <thead id="bystudent_header">
                                                            
                                </thead>
                                <tbody id="bystudent_body">
                                    
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                
                            <div class="table-responsive">
                            <table class="table w-100 nowrap table-bordered table-striped" id="tbl_bystudent">
                                <thead id="bystudent_subdiv_header">
                                                            
                                </thead>
                                <tbody id="bystudent_subdiv_body">
                                    
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
        
    </div>
    <div class="row" id="bystudent_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Student Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudent" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                        <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div> <!-- container -->

@endsection
    @section('scripts')
    <script>
        var sectionByClass = "{{ route('admin.section_by_class') }}";
        var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
        var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
        var getbyClass_thead="{{ config('constants.api.tot_grade_master') }}";
        var Allexams="{{ config('constants.api.all_exams_list') }}";
        var getbySubjectAllstd ="{{ config('constants.api.all_bysubject_list') }}";
        var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
        var getbyStudent_subjectdivision="{{ config('constants.api.tot_grade_calcu_byStdsubjectdiv') }}";
        // default image test
        var defaultImg = "{{ asset('images/users/default.jpg') }}";
    </script>
    <script src="{{ asset('js/custom/bystudent.js') }}"></script>
    @endsection