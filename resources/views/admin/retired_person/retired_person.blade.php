@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.retired_persons') . '')
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
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 446 511.89">
                            <path fill="#3A4265" d="M35.61 13.26a32.08 32.08 0 00-5.74 23.93l42.95 266.86a32.09 32.09 0 0010.87 19.4c5.69 4.86 13.07 7.72 20.88 7.71h2.85v.1h42.86l-39.66 110.78c-18.8-8.04-36.06-18.34-50.93-30.87-6.17-5.19-12.01-10.9-17.45-17.09-8.76-10.02-24-11.03-34.01-2.27-10.02 8.77-11.03 24-2.27 34.01 6.88 7.84 14.51 15.25 22.74 22.19 51.08 43.04 123.58 64.33 195.41 63.87 71.99-.47 144.12-22.72 194.27-66.75 7.77-6.83 15.13-14.31 21.97-22.43 8.56-10.17 7.24-25.36-2.93-33.91-10.17-8.56-25.35-7.24-33.91 2.93-5.04 5.98-10.7 11.71-16.88 17.13-7.62 6.7-15.9 12.77-24.72 18.24l-31.11-95.83h32.23c8.91 0 16.98-3.61 22.81-9.44 5.82-5.83 9.43-13.9 9.43-22.81 0-8.91-3.61-16.98-9.44-22.81-5.83-5.82-13.89-9.43-22.8-9.43H221.51l28.77-63.82h88.3c5.28 0 10.05-2.14 13.5-5.58 3.45-3.45 5.59-8.23 5.59-13.5 0-5.28-2.14-10.06-5.59-13.51a19.062 19.062 0 00-13.5-5.58H115.52L93.36 27.11c-1.38-8.75-6.21-16.14-12.86-20.97A32.124 32.124 0 0056.57.4c-8.75 1.38-16.13 6.21-20.96 12.86zm158.75 35.91l-18.51-4.96-29.14 108.26h19.39l28.26-103.3zm52.89 93.87c11.28 3.03 22.91-3.67 25.93-14.96 3.03-11.29-3.68-22.92-14.97-25.93-11.3-3.02-22.92 3.68-25.94 14.97-3.02 11.29 3.7 22.9 14.98 25.92zm67.96 9.43l22.6-84.61-131.14-35.14-32.21 119.75h19.31l20.97-77.86c9.33 2.5 18.98-3.09 21.48-12.42l61.8 16.55c-2.5 9.35 3.06 19 12.4 21.5l-13.94 52.23h18.73zM148.04 454.65l44.21-123.39h97.05l37.13 113.5c-31.5 12.4-66.92 18.72-102.51 18.95-25.79.16-51.56-2.86-75.88-9.06zm-23.05-251.7h83.48l-28.76 63.82h-47.77l-10.27-63.82h3.32z" />
                        </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.retired_persons') }}</h4>
            </div>
           
        </div>
    </div>
    <!-- end page title -->

    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.employee_type') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="EmpFilter" autocomplete="off">
                        <div class="row">      
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee_type">{{ __('messages.employee_type') }}</label>
                                    <select name="employee_type" class="form-control" id="employee_type">
                                        <option value=''>{{ __('messages.select_employee_type') }}</option>
                                        <option value='0'>{{ __('messages.all') }}</option>
                                         <option value='1'>{{ __('messages.retired_persons') }}</option>
                                   </select>
                                </div>
                            </div>                       
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> 
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </form>

                </div> 
            </div> 
        </div> 

    </div> -->
    <!-- end row -->


    <div class="row" >
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.employee_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
           
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table dt-responsive nowrap w-100" id="emp-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.employee_name') }}</th>
                                            <th style="display: none"> {{ __('messages.name_english') }}</th>
                                            <th style="display: none"> {{ __('messages.name_furigana') }}</th>
                                            <th style="display: none"> {{ __('messages.email') }}</th>
                                            <th style="display: none"> {{ __('messages.city') }}</th>
                                            <th style="display: none"> {{ __('messages.state') }}</th>
                                            <th style="display: none"> {{ __('messages.country') }}</th>
                                            <th style="display: none"> {{ __('messages.post_code') }}</th>
                                            <th style="display: none"> {{ __('messages.present_address') }}</th>
                                            <th style="display: none"> {{ __('messages.permanent_address') }}</th>
                                            <th style="display: none"> {{ __('messages.nric_number') }}</th>
                                            <th style="display: none"> {{ __('messages.visa_number') }}</th>
                                            <th style="display: none"> {{ __('messages.passport') }}</th>
                                            <th style="display: none"> {{ __('messages.mobile_number') }}</th>
                                            <th style="display: none"> {{ __('messages.gender') }}</th>
                                            <th style="display: none"> {{ __('messages.height') }}</th>
                                            <th style="display: none"> {{ __('messages.weight') }}</th>
                                            <th style="display: none"> {{ __('messages.allergy') }}</th>
                                            <th style="display: none"> {{ __('messages.blood_group') }}</th>
                                            <th style="display: none"> {{ __('messages.nationality') }}</th>
                                            <th style="display: none"> {{ __('messages.religion_name') }}</th>
                                            <th> {{ __('messages.DOB') }}</th>
                                            <th style="display: none"> {{ __('messages.joining_date') }}</th>
                                            <th> {{ __('messages.tenure') }}</th>
                                            <th> {{ __('messages.job_title') }}</th>
                                            <th> {{ __('messages.job_description') }}</th>
                                            <th style="display: none"> {{ __('messages.staff_position') }}</th>
                                            <th style="display: none"> {{ __('messages.staff_category') }}</th>
                                            <th> {{ __('messages.employment_status') }}</th>
                                            <th> {{ __('messages.employee_type') }}</th>
                                            <th style="display: none"> {{ __('messages.start_date') }}</th>
                                            <th style="display: none"> {{ __('messages.end_date') }}</th>
                                            <!-- <th> {{ __('messages.actions') }}</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Placeholder row for "No data available" message -->
                                    <tr id="no-data-row">
                                        <td colspan="10" class="text-center">{{ __('messages.no_data_avaliable') }}</td>
                                    </tr>
                                    <!-- Actual data rows will be inserted here dynamically -->
                                </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

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

<script>
    
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    
    var retireEmployeeList = "{{ route('admin.retired_person.list') }}";
    // lang change name end// Get PDF Footer Text

    // Get PDF Footer Text
    var header_txt="{{ __('messages.student_list') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    //var student_list_storage = localStorage.getItem('admin_student_list_details');
</script>
<script src="{{ asset('js/custom/retired_emp.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection