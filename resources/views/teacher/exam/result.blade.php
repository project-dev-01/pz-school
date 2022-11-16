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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Exam
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="byexamfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Grade<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>                    
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID" id="lblsectionId">Class<span class="text-danger">*</span></label>
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
                                <label for="heard">Roll No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="registerno" name="registerno">
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


<div class="row" id="exam_details_div">
    <div class="col-xl-12">
        <div class="card">
            <ul class="nav nav-tabs" >
                <li class="nav-item">
                    <h4 class="nav-link">
                        Exam Result
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="table-responsive">
                            <header><b>Student General Details</b></header>
                                <table class="table table-bordered mb-0" id="tbl_general_details">
                                    <thead id="tbl_general_details_header"></thead>                                   
                                </table>
                            </div> <!-- end table-responsive-->
                         
                                                 
                            <div class="table-responsive">
                            <hr>
                            <header><b>Individual Subject</b></header>
                                <table class="table table-bordered mb-0" id="tbl_std_subject_marks">
                                    <thead id="tbl_std_subject_marks_header">
                                       
                                    </thead>
                                    <tbody id="tbl_std_subject_marks_body">
                                       
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                            
                            <div class="table-responsive" id="tbl_std_subject_marks_division">
                           
                            <hr>
                            <header><b>Subject Division</b></header>
                                <table class="table table-bordered mb-0">
                                    <thead id="tbl_std_subject_marks_division_header">
                                       
                                    </thead>
                                    <tbody id="tbl_std_subject_marks_division_body">
                                       
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
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
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbyresult = "{{ config('constants.api.student_result') }}";  
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/exam_result.js') }}"></script>
@endsection