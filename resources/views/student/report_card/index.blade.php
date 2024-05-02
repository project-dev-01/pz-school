@extends('layouts.admin-layout')
@section('title',' ' . __('messages.report_card') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <i class="far fa-id-card" style="color:#3A4265"></i>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.report_card') }}</h4>
            </div>
         
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.select_ground') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                      
                        <div class="card-body collapse show">              
                    <form id="reportcart_filter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">{{ __('messages.exam_name') }}<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="exam_id">
                                        <option value="">{{ __('messages.select_exam') }}</option>
                                        @forelse ($allexams as $exam)
                                        <option value="{{ $exam['id'] }}">{{ $exam['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.get') }}
                            </button>
                        </div>
                    </form>





                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="row" style="display: none;" id="bystudent_bodycontent">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            {{ __('messages.report_card_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div id="byStudentTableAppend">

                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix mt-4">
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right">{{ __('messages.download') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- <div class="row" id="bystudent_analysis">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Student Analysis</h4>

                    <div class="mt-4 chartjs-chart">
                        <canvas id="radar-chart-test-bystudent" height="350" data-colors="#39afd1,#a17fe0"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
    var getbyreportcard = "{{ config('constants.api.get_by_reportcard') }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    
    var student_reportcard_storage = localStorage.getItem('student_reportcard_details');
</script>
<script src="{{ asset('js/custom/reportcard.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection
