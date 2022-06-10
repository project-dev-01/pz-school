@extends('layouts.admin-layout')
@section('title','By Subject')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">By Subject</h4>
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
                    <form id="bysubjectfilter" data-parsley-validate="">
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
                                    <label for="sectionID" id="lblsectionId">Class Name<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">Test Name<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="examnames">
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


    <div class="row" style="display: none;" id="bysubject_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            Subject
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table id="tblbycls" class="table w-100 nowrap table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-top" rowspan="2">S.no.</th>
                                                <th class="align-top" rowspan="2">Standard</th>
                                                <th class="align-top" rowspan="2">Class</th>
                                                <th class="align-top" rowspan="2">Subject Name</th>
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
                                        <tbody id="bysubjectTableAppend">

                                        </tbody>
                                    </table>
                                    <!-- <table class="table w-100 nowrap table-bordered table-striped" id="">
                                        <thead>
                                            <tr>
                                                <th class="align-top" rowspan="2">S.no.</th>
                                                <th class="align-top" rowspan="2">Standard</th>
                                                <th class="align-top" rowspan="2">Class</th>
                                                <th class="align-top" rowspan="2">Subject Name</th>
                                                <th class="align-top th-sm - 6 rem" rowspan="2">Tot. Students</th>
                                                <th class="align-top" rowspan="2">Absent</th>
                                                <th class="align-top" rowspan="2">Present</th>
                                                <th class="align-top" rowspan="2">Class Teacher Name</th>
                                                <th class="text-center">A+</th>
                                                <th class="text-center">A</th>
                                                <th class="text-center">A-</th>
                                                <th class="text-center">B+</th>
                                                <th class="text-center">B</th>
                                                <th class="text-center">C+</th>
                                                <th class="text-center">C</th>
                                                <th class="text-center">D</th>
                                                <th class="text-center">E</th>
                                                <th class="text-center">PASS</th>
                                                <th class="text-center">G</th>
                                                <th class="text-center">Avg. grade of subject</th>
                                                <th class="text-center">%</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                                <td class="text-center">%</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" rowspan="2">1</td>
                                                <td class="text-center" rowspan="2">Mathematics</td>
                                                <td class="text-center" rowspan="2">Mathematics</td>
                                                <td class="text-center" rowspan="2">Mathematics</td>
                                                <td class="text-right" rowspan="2">255</td>
                                                <td class="text-right">40</td>
                                                <td class="text-right">215</td>
                                                <td class="text-center" rowspan="2">William</td>
                                                <td class="text-right">0</td>
                                                <td class="text-right">10</td>
                                                <td class="text-right">4</td>
                                                <td class="text-right">3</td>
                                                <td class="text-right">1</td>
                                                <td class="text-right">5</td>
                                                <td class="text-right">0</td>
                                                <td class="text-right">0</td>
                                                <td class="text-right">0</td>
                                                <td class="text-right">23</td>
                                                <td class="text-right">1</td>
                                                <td class="text-right" rowspan="2">2.71</td>
                                                <td class="text-right" rowspan="2">95.83</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">41.67</td>
                                                <td class="text-right">16.67</td>
                                                <td class="text-right">12.50</td>
                                                <td class="text-right">4.17</td>
                                                <td class="text-right">20.83</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">95.83</td>
                                                <td class="text-right">4.17</td>
                                            </tr>                                          
                                        </tbody>
                                    </table> -->
                                </div> <!-- end table-responsive-->
                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" id="bysubject_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Subject Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudentmarks" height="350" data-colors="#39afd1,#a17fe0"></canvas>
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
    var getbySubject = "{{ config('constants.api.tot_grade_calcu_bySubject') }}";
    var Allexams = "{{ config('constants.api.all_exams_list') }}";
    var getbySubjectAllstd = "{{ config('constants.api.all_bysubject_list') }}";
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<script src="{{ asset('js/custom/bysubject.js') }}"></script>
@endsection