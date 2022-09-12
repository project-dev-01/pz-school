@extends('layouts.admin-layout')
@section('title','Report Card')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">Report Card</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <form id="reportcart_filter" data-parsley-validate="">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="selected_year">Year<span class="text-danger">*</span></label>
                                    <select id="selected_year" class="yrselectdesc form-control"></select>

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

                            <div class="forum-group">
                                <label></label>
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Get
                                </button>

                            </div>
                        </div>
                    </form>





                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="row" style="display: none;" id="reportlist">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Report Card List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">

                    <div class="form-group">
                        <p>
                        <div>
                            <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#quarterlyExam" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-caret-square-down"></i>&nbsp;<span id="exam_name_header"></span>
                            </a>
                        </div>
                        </p>
                        <div class="collapse" id="quarterlyExam">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject</th>
                                                            <th>Score</th>
                                                            <th>Grade</th>
                                                            <th>Ranking</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_bdy_reportcard">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- end card-box -->
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>

    <div class="row" style="display: none;" id="reportlist_norecords">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Report Card List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">

                    <div class="form-group text-center">


                        <h4>No records found...</h4>



                    </div>



                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>


</div> <!-- container -->
@endsection
@section('scripts')


<script>
    var getbyreportcard = "{{ config('constants.api.get_by_reportcard') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/year-select.js') }}"></script>
<script src="{{ asset('public/js/custom/reportcard.js') }}"></script>
@endsection