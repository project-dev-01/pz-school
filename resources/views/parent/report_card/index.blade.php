@extends('layouts.admin-layout')
@section('title','Report Card')
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

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
    <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;">
            <div class="page-title-icon" style="margin-top: 6px;">
                <svg width="22" height="22" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_183_469)">
                        <path d="M5.65939 2.52906C4.71434 2.52906 3.80799 2.91067 3.13974 3.58994C2.47149 4.26921 2.09607 5.19049 2.09607 6.15112V15.7027C1.51005 15.602 0.978038 15.2937 0.594355 14.8323C0.210673 14.3709 0.00010696 13.7863 0 13.1822V3.38131C0 2.70321 0.265 2.05289 0.736708 1.57341C1.20841 1.09392 1.84819 0.824554 2.51528 0.824554H18.3406C18.8606 0.824718 19.3678 0.988711 19.7924 1.29396C20.2169 1.59921 20.5379 2.0307 20.7113 2.52906H5.65939Z" fill="#3A4265" />
                        <path d="M21.4847 3.59438H5.65933C4.99223 3.59438 4.35246 3.86375 3.88075 4.34323C3.40904 4.82271 3.14404 5.47304 3.14404 6.15113V15.952C3.14404 16.6301 3.40904 17.2804 3.88075 17.7599C4.35246 18.2394 4.99223 18.5088 5.65933 18.5088H21.4847C22.1517 18.5088 22.7915 18.2394 23.2632 17.7599C23.7349 17.2804 23.9999 16.6301 23.9999 15.952V6.15113C23.9999 5.47304 23.7349 4.82271 23.2632 4.34323C22.7915 3.86375 22.1517 3.59438 21.4847 3.59438ZM9.11784 6.47072C9.49095 6.47072 9.85568 6.58319 10.1659 6.79389C10.4761 7.0046 10.7179 7.30408 10.8607 7.65447C11.0035 8.00486 11.0409 8.39041 10.9681 8.76238C10.8953 9.13435 10.7156 9.47603 10.4518 9.74421C10.1879 10.0124 9.85181 10.195 9.48587 10.269C9.11993 10.343 8.74063 10.305 8.39592 10.1599C8.05122 10.0148 7.7566 9.76897 7.54931 9.45363C7.34202 9.13829 7.23138 8.76755 7.23138 8.38829C7.23138 7.87972 7.43013 7.39198 7.78391 7.03237C8.13769 6.67275 8.61752 6.47072 9.11784 6.47072ZM5.55452 14.6736C5.55452 13.6848 5.94098 12.7364 6.62889 12.0371C7.31679 11.3379 8.2498 10.945 9.22265 10.945C10.1955 10.945 11.1285 11.3379 11.8164 12.0371C12.5043 12.7364 12.8908 13.6848 12.8908 14.6736H5.55452ZM21.6943 13.7149H15.1964C15.1409 13.7149 15.0875 13.6924 15.0482 13.6524C15.0089 13.6125 14.9868 13.5583 14.9868 13.5018C14.9868 13.4453 15.0089 13.3911 15.0482 13.3511C15.0875 13.3112 15.1409 13.2887 15.1964 13.2887H21.6943C21.7499 13.2887 21.8032 13.3112 21.8425 13.3511C21.8818 13.3911 21.9039 13.4453 21.9039 13.5018C21.9039 13.5583 21.8818 13.6125 21.8425 13.6524C21.8032 13.6924 21.7499 13.7149 21.6943 13.7149ZM21.6943 12.2234H15.1964C15.1409 12.2234 15.0875 12.201 15.0482 12.161C15.0089 12.1211 14.9868 12.0669 14.9868 12.0104C14.9868 11.9538 15.0089 11.8997 15.0482 11.8597C15.0875 11.8197 15.1409 11.7973 15.1964 11.7973H21.6943C21.7499 11.7973 21.8032 11.8197 21.8425 11.8597C21.8818 11.8997 21.9039 11.9538 21.9039 12.0104C21.9039 12.0669 21.8818 12.1211 21.8425 12.161C21.8032 12.201 21.7499 12.2234 21.6943 12.2234ZM21.6943 10.732H15.1964C15.1409 10.732 15.0875 10.7095 15.0482 10.6696C15.0089 10.6296 14.9868 10.5754 14.9868 10.5189C14.9868 10.4624 15.0089 10.4082 15.0482 10.3683C15.0875 10.3283 15.1409 10.3059 15.1964 10.3059H21.6943C21.7499 10.3059 21.8032 10.3283 21.8425 10.3683C21.8818 10.4082 21.9039 10.4624 21.9039 10.5189C21.9039 10.5754 21.8818 10.6296 21.8425 10.6696C21.8032 10.7095 21.7499 10.732 21.6943 10.732ZM21.6943 9.24054H15.1964C15.1409 9.24054 15.0875 9.21809 15.0482 9.17813C15.0089 9.13817 14.9868 9.08398 14.9868 9.02748C14.9868 8.97097 15.0089 8.91678 15.0482 8.87682C15.0875 8.83686 15.1409 8.81441 15.1964 8.81441H21.6943C21.7499 8.81441 21.8032 8.83686 21.8425 8.87682C21.8818 8.91678 21.9039 8.97097 21.9039 9.02748C21.9039 9.08398 21.8818 9.13817 21.8425 9.17813C21.8032 9.21809 21.7499 9.24054 21.6943 9.24054Z" fill="#3A4265" />
                    </g>
                    <defs>
                        <clipPath id="clip0_183_469">
                            <rect width="24" height="17.6842" fill="white" transform="translate(0 0.824554)" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.report_card') }}</h4>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
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
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right; ">{{ __('messages.download') }}</button>
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
    
    var parent_reportcard_storage = localStorage.getItem('parent_reportcard_details');
</script>
<script src="{{ asset('js/custom/reportcard.js') }}"></script>
@endsection
