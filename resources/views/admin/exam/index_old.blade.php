@extends('layouts.admin-layout')
@section('title','Exam')
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
                        <li class="breadcrumb-item active">Exam</li>
                    </ol>-->
                </div>
                <h4 class="page-title">Examm</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        {{ __('messages.exam_list') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Create Exam
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="profile-b1">
                        <div class="table-responsive">
                            <table class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.s._no') }}</th>
                                        <th>{{ __('messages.exam_name') }}</th>
                                        <th>Exam Type</th>
                                        <th>{{ __('messages.term') }}</th>
                                        <th>Mark Distribution</th>
                                        <th>{{ __('messages.remarks') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Annual</td>
                                        <td>Internal</td>
                                        <td>1st term</td>
                                        <td>Aibots</td>
                                        <td>Test</td>
                                        <td>
                                            <div class="button-list">
                                                <a href="javascript:void(0)" class="btn btn-blue waves-effect waves-light" data-id="" id="viewEventBtn">View</a>
                                                <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteEventBtn">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                    <div class="tab-pane" id="home-b1">
                        <form id="demo-form">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <!-- <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">Branch<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Select Branch</option>
                                                    <option value="">Malaysia</option>
                                                    <option value="">Singapore</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.name') }}<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.term') }} </label>
                                            <div class="col-9">
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">{{ __('messages.select_term') }}</option>
                                                    <option value="">Ist Term</option>
                                                    <option value="">Half Yearly</option>
                                                    <option value="">Quater Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">Exam Type </label>
                                            <div class="col-9">
                                                <select id="heard" class="form-control" required="">
                                                    <option value="">Select Exam Type</option>
                                                    <option value="">Internal</option>
                                                    <option value="">Model</option>
                                                    <option value="">Main</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">Mark Distribution </label>
                                            <div class="col-9">
                                                <input type="text" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.remarks') }} </label>
                                            <div class="col-9">
                                                <textarea type="email" class="form-control form-control-sm" id="colFormLabel"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                        <div class="col-8 offset-4" style="margin-left:34%;">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>

                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


</div> <!-- container -->

</div>
<!-- container -->
@endsection