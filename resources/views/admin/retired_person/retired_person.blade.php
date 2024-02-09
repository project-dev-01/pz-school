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

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.retired_persons') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
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
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="emp" >
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.employee_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="emp-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.employee_name') }}</th>
                                            <th> {{ __('messages.DOB') }}</th>
                                            <th> {{ __('messages.tenure') }}</th>
                                            <th> {{ __('messages.job_title') }}</th>
                                            <th> {{ __('messages.job_description') }}</th>
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var studentDelete = "{{ route('admin.student.delete') }}";
    var employeeList = "{{ route('admin.retired_person.list') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_student') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end// Get PDF Footer Text

    // Get PDF Footer Text
    var header_txt="{{ __('messages.student_list') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    //var student_list_storage = localStorage.getItem('admin_student_list_details');
</script>
<script src="{{ asset('js/custom/retired_emp.js') }}"></script>
@endsection