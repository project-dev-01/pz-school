@extends('layouts.admin-layout')
@section('title','By Class')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">By Class</h4>
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
                    <form id="byclassfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        <option value="All">All</option>
                                        @forelse ($classnames as $class)

                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID" id="lblsectionId">Subject Name<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Subject</option>
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
                                Filter
                            </button>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Class 
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="class_id" id="listModeClassID">
                        <input type="hidden" name="section_id" id="listModeSectionID">
                        <input type="hidden" name="exam_id" id="listModeexamID">
                        <input type="hidden" name="fullmark" id="fullmark">
                        <input type="hidden" name="passmark" id="passmark">
                        <div class="col-sm-12">
                            <div class="card-box">

                                <!-- <div id="byclassTableAppend">

                                </div> -->
                                <div class="table-responsive">
                                    <table id="tblbycls" class="table w-100 nowrap table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-top" rowspan="2">S.no.</th>
                                                <th class="align-top" rowspan="2">Class</th>
                                                <th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>
                                                <th class="align-top" rowspan="2">Absent</th>
                                                <th class="align-top" rowspan="2">Present</th>
                                                <th class="align-top" rowspan="2">Class Teacher Name</th>
                                                @forelse ($allGrades as $val)
                                                <th class="text-center" data-id="{{$val['id']}}">{{ $val['grade'] }}</th>
                                                @empty
                                                <th>0</th>
                                                @endforelse

                                                <th class="align-middle" rowspan="2">PASS</th>
                                                <th class="align-middle" rowspan="2">G</th>
                                                <th class="align-middle" rowspan="2">Avg. grade of subject</th>
                                                <th class="align-middle" rowspan="2">%</th>
                                            </tr>
                                            <tr>
                                                @forelse ($allGrades as $val)
                                                <td class="text-center">%</td>
                                                @empty
                                                <th>0</th>
                                                @endforelse
                                            </tr>
                                        </thead>
                                        <tbody id="byclassTableAppend">
                                      
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Download</button>
                                    </div>


                                </div> <!-- end table-responsive-->

                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->

        </div>
     
    </div> <!-- container -->
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Class Analysis</h4>

                        <div class="mt-4 chartjs-chart">
                            <canvas id="radar-chart-test-byclass" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                            <!-- <canvas id="marksChart" height="350" data-colors="#39afd1,#a17fe0"></canvas> -->
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    @endsection
    @section('scripts')
    <script>
        var sectionByClass = "{{ route('admin.section_by_class') }}";
        var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
        var examsByclassandsubject = "{{ config('constants.api.exam_by_classSubject') }}";
        
        var getbyClass = "{{ config('constants.api.tot_grade_calcu_byclass') }}";
        var getbySubjectnames = "{{ config('constants.api.subject_by_class') }}";
        var getbyClass_thead="{{ config('constants.api.tot_grade_master') }}";
        var Allexams="{{ config('constants.api.all_exams_list') }}";
        var getbyClassAllstd ="{{ config('constants.api.all_std_list') }}";
        var getbysubjectnamesall="{{ config('constants.api.class_assign_list') }}";

        //
        var getbySubject = "{{ config('constants.api.tot_grade_calcu_bySubject') }}";

        var getbySubjectAllstd ="{{ config('constants.api.all_bysubject_list') }}";
        //
        // default image test
        var defaultImg = "{{ asset('images/users/default.jpg') }}";
    </script>
    <script src="{{ asset('js/custom/byclass.js') }}"></script>
    @endsection