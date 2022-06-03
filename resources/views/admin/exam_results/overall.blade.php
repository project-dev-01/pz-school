@extends('layouts.admin-layout')
@section('title','Overall')
@section('content')
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
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="byoverallfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Standard</option>
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
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


    <div class="row" style="display:none;" id="body_content">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Class
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body" id="card-body-tbl">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap table-bordered table-striped" id="tab_overall">
                                        <thead id="overall_header">
                                            <tr>
                                                <th class="align-top" rowspan="2">S.no.</th>                                                                    
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
                                        <tbody id="overall_body">
                                            <!-- <tr>
                                   <td class="text-center" rowspan="2">1</td>
                                   <td class="text-center" rowspan="2">I</td>
                                   <td class="text-right" rowspan="2">24</td>  
                                   <td class="text-right" rowspan="2">0</td>
                                   <td class="text-right" rowspan="2">24</td>
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
                                </tr> -->

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
    <div class="row"  id="analysis_graph">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Overall Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-overall" height="350" data-colors="#39afd1,#a17fe0"></canvas>
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
    var getoverall = "{{ config('constants.api.tot_grade_calcu_overall') }}";

    //
    // default image test
    var defaultImg = "{{ asset('images/users/default.jpg') }}";
</script>
<script src="{{ asset('js/custom/overall.js') }}"></script>
@endsection