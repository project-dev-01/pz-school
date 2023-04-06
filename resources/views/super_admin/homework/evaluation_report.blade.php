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
                <h4 class="page-title">{{ __('messages.evaluation_report') }}</h4>
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
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Branch<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Branch</option>
                                        <option value="">Malaysia</option>
                                        <option value="press">Singapore</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.standard') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Standard</option>
                                        <option value="">All</option>
                                        <option value="">I</option>
                                        <option value="press">II</option>
                                        <option value="">III</option>
                                        <option value="press">IV</option>
                                        <option value="">V</option>
                                        <option value="press">VI</option>
                                        <option value="">VII</option>
                                        <option value="press">VIII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.class_Name') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Class Name</option>
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="press">C</option>
                                        <option value="">D</option>
                                        <option value="press">E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                        <option value="press">English</option>
                                        <option value="">Mathematics</option>
                                        <option value="press">History</option>
                                        <option value="">Study of the Environment</option>
                                        <option value="press">Geography</option>
                                        <option value="">Natural Sciences</option>
                                        <option value="press">Civics Education</option>
                                        <option value="">Arts Education</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                        {{ __('messages.filter') }}
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            {{ __('messages.evaluation_report') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item">
                                    <a href="#current-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    {{ __('messages.homework_list') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#history-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        History
                                    </a>
                                </li>
                            </ul>
                            <div class="">
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
                                                    <table class="table table-striped table-bordered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{ __('messages.subject') }}</th>
                                                                <th>{{ __('messages.standard') }}</th>
                                                                <th>{{ __('messages.class') }}</th>
                                                                <th>{{ __('messages.date_of_homework') }}</th>
                                                                <th>{{ __('messages.date_of_submission') }}</th>
                                                                <th>{{ __('messages.complete') }}/{{ __('messages.incomplete') }}</th>
                                                                <th>{{ __('messages.total_student') }}</th>
                                                                <th>{{ __('messages.action') }}</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Geography</td>
                                                                <td>I</td>
                                                                <td>A</td>
                                                                <td>18-02-2022</td>
                                                                <td>23-02-2022</td>
                                                                <td>1/2</td>
                                                                <td>3</td>
                                                                <td><a href="" class="btn btn-circle btn-default" data-toggle="modal" data-target=".firstModal"><i class="fas fa-bars"></i> Details</a></td>
                                                            </tr>
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
                                                    <table class="table table-bordered table-striped mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{ __('messages.subject') }}</th>
                                                                <th>{{ __('messages.standard') }}</th>
                                                                <th>{{ __('messages.class') }}</th>
                                                                <th>{{ __('messages.date_of_homework') }}</th>
                                                                <th>{{ __('messages.date_of_submission') }}</th>
                                                                <th>{{ __('messages.complete') }}/{{ __('messages.incomplete') }}</th>
                                                                <th>{{ __('messages.total_student') }}</th>
                                                                <th>{{ __('messages.action') }}</th>

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

@include('super_admin.homework.homework_modal')
@endsection