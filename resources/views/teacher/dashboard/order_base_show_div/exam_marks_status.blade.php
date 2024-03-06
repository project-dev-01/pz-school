<div class="row">
    <div class="col-xl-12 col-md-12">
        <!-- Portlet card -->
        <div class="card">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv"> {{ __('messages.exam_marks_status') }}
                        <h4>
                </li>
            </ul><br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                            <select id="ems_btwyears" class="form-control examMarkStatus" name="year">
                                <option value="">{{ __('messages.select_academic_year') }}</option>
                                @forelse($academic_year_list as $r)
                                <option value="{{$r['id']}}">{{$r['name']}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                            <select id="ems_class_id" class="form-control" name="class_id">
                                <option value="">{{ __('messages.select_grade') }}</option>
                                @forelse ($classes as $class)
                                <option value="{{ $class['class_id'] }}">{{ $class['class_name'] }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                            <select id="ems_section_id" class="form-control " name="section_id">
                                <option value="">{{ __('messages.select_class') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ems_student_id">{{ __('messages.student') }}<span class="text-danger">*</span></label>
                            <select id="ems_student_id" class="form-control examMarkStatus" name="student_id">
                                <option value="">{{ __('messages.select_student') }}</option>
                            </select>
                        </div>
                    </div>
                </div><br>
                <ul class="nav nav-tab nav-bordered float-right">
                    <li class="nav-item">
                        <a href="#mcex" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            <b style="font-size:12px">{{ __('messages.marks_in_class_each_exam') }}</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rcex" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <b style="font-size:12px">{{ __('messages.rank_in_class_each_exam') }}</b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#score-class" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <b style="font-size:12px">{{ __('messages.score_in_class') }}</b>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="mcex">
                        <div class="card-body" dir="ltr">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase1" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="allExamSubjectScoresChart" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                    <div class="tab-pane" id="rcex">
                        <div class="card-body" dir="ltr">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase2" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="allExamSubjectRankChart" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                    <div class="tab-pane" id="score-class">
                        <div class="card-body" dir="ltr">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examID">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                    <select id="scoreExamID" class="form-control" name="examID">
                                        <option value="">{{ __('messages.select_exams') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                            <h4 class="header-title mb-0"></h4>

                            <div id="cardCollpase2" class="collapse pt-3 show">
                                <div class="text-center">
                                    <div class="mt-3 chartjs-chart">
                                        <canvas id="examSubjectMarkHighLowAvg" height="150"></canvas>
                                    </div>
                                </div>
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div>
                </div>
            </div> <!-- end card-box-->

        </div> <!-- end card-->
    </div> <!-- end col-->
</div>