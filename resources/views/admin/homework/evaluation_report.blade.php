@extends('layouts.admin-layout')
@section('title','Evaluation Report')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <style>
        .btn {
            background-color: #6FC6CC;

        }
    </style>
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="evaluationFilterForm" method="post" action="{{ route('admin.homework.details') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Standard</option>
                                        @foreach($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Homework List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
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
                                                    <table class="table w-100 nowrap  text-center">
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

@include('admin.homework.homework_modal')
@endsection


@section('scripts')

<script>
    var homeworkView = "{{ route('admin.homework.view') }}";
    var homeworkList = "{{ route('admin.evaluation_report') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.subject_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/homework.js') }}"></script>
@endsection