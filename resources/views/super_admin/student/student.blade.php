@extends('layouts.admin-layout')
@section('title','Student List')
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
                <h4 class="page-title">{{ __('messages.student_list') }}</h4>
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
                                    <label for="heard">{{ __('messages.branch') }}<span class="text-danger">*</span></label>
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
                                        <option>I</option>
                                        <option>II</option>
                                        <option>III</option>
                                        <option>IV</option>
                                        <option>V</option>
                                        <option>VI</option>
                                        <option>VII</option>
                                        <option>VIII</option>
                                        <option>IX</option>
                                        <option>X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.class_Name') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Class Name</option>     
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
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
                            Student Lists
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>Roll</th>
                                                <th>{{ __('messages.register_no') }}</th>
                                                <th>{{ __('messages.class') }}</th>
                                                <th>{{ __('messages.section') }}</th>
                                                <th>{{ __('messages.guardian_name') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>William</td>
                                                <td>PZ-1001</td>
                                                <td>RSM-00-1</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Amelia</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>James</td>
                                                <td>PZ-1002</td>
                                                <td>RSM-00-2</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Isbella</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Benjamin</td>
                                                <td>PZ-1003</td>
                                                <td>RSM-00-3</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Petter</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Lucas</td>
                                                <td>PZ-1004</td>
                                                <td>RSM-00-4</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Antony</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Charlotte</td>
                                                <td>PZ-1005</td>
                                                <td>RSM-00-5</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Christopher</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Sophia</td>
                                                <td>PZ-1006</td>
                                                <td>RSM-00-6</td>
                                                <td>I</td>
                                                <td>A</td>
                                                <td>Mia</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
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

</div> <!-- container -->

@endsection