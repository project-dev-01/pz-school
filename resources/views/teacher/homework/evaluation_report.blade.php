@extends('layouts.admin-layout')
@section('title','Evaluation Report')
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
                <h4 class="page-title">Evaluation Report</h4>
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
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="evaluationFilterForm" method="post" action="{{ route('teacher.homework.details') }}"  enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id" >                             
                                        <option value="">Select Standard</option>
                                        @foreach($class as $cla)
                                            <option value="{{$cla['class_id']}}">{{$cla['class_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control"  name="section_id">                              
                                        <option value="">Select Class Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject_id">Subject<span class="text-danger">*</span></label>
                                    <select id="subject_id" class="form-control" name="subject_id">                                       
                                        <option value="">Select Subject</option>
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
                    

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="evaluation" style="display:none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Evaluation Report
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item">
                                    <a href="#current-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        Homework List
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="#history-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        History
                                    </a>
                                </li> -->
                            </ul><br>
                            <div class="card-box">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="current-b1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table w-100 nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Date of Homework</th>
                                                                <th>Date of Submission</th>
                                                                <th>Complete/Incomplete</th>
                                                                <th>Total Student</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="homework_table">
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->

                                            </div> <!-- end col-->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="history-b1">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-0 text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Subject</th>
                                                                <th>Standard</th>
                                                                <th>Class</th>
                                                                <th>Date of Homework</th>
                                                                <th>Date of Submission</th>
                                                                <th>Complete/Incomplete</th>
                                                                <th>Total Student</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Mathematics</td>
                                                                <td>III</td>
                                                                <td>A</td>
                                                                <td>07-04-2018</td>
                                                                <td>21-04-2018</td>
                                                                <td>10/0</td>
                                                                <td>10</td>
                                                                <td><a href="{{ route('super_admin.homework_edit')}}" class="btn btn-circle btn-default"><i class="fas fa-bars"></i> Copy</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Study of the Environment</td>
                                                                <td>I</td>
                                                                <td>B</td>
                                                                <td>15-08-2020</td>
                                                                <td>07-09-2020</td>
                                                                <td>15/0</td>
                                                                <td>15</td>
                                                                <td><a href="{{ route('super_admin.homework_edit')}}" class="btn btn-circle btn-default"><i class="fas fa-bars"></i> Copy</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Arts Education</td>
                                                                <td>II</td>
                                                                <td>C</td>
                                                                <td>11-06-2021</td>
                                                                <td>17-06-2021</td>
                                                                <td>18/2</td>
                                                                <td>20</td>
                                                                <td><a href="{{ route('super_admin.homework_edit')}}" class="btn btn-circle btn-default"><i class="fas fa-bars"></i> Copy</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>English</td>
                                                                <td>VI</td>
                                                                <td>A</td>
                                                                <td>04-05-2020</td>
                                                                <td>19-05-2020</td>
                                                                <td>25/0</td>
                                                                <td>25</td>
                                                                <td><a href="{{ route('super_admin.homework_edit')}}" class="btn btn-circle btn-default"><i class="fas fa-bars"></i> Copy</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->
                                            </div> <!-- end col-->
                                        </div>
                                    </div> <!-- end col-->
                                </div>
                            </div> <!-- end card-box-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@include('teacher.homework.homework_modal')
@endsection


@section('scripts')

<script>
    
    var homeworkView = "{{ route('teacher.homework.view') }}";
    var homeworkList = "{{ route('teacher.evaluation_report') }}";
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    var subjectByClass = "{{ route('teacher.subject_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/homework.js') }}"></script>
@endsection