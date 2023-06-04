@extends('layouts.admin-layout')
@section('title','Employee')
@section('component_css')
<link href="{{ asset('public/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- datatable -->
<!-- <link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}"> -->
<!-- button link  -->
<!-- <link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}"> -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://datatables.net/media/css/site-examples.css">

<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<style>
    /* table css*/
    table.dataTable td,
    table.dataTable th {
        font-family: Open Sans !important;
        color: #3A4265 !important;
        font-weight: 500 !important;
    }

    .form-control-light {
        background-color: white !important;
        border: 1px solid #ECECEC !important;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Datatables</li> -->
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.employee_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.employee_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="employee-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.short_name') }}</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.stream_type') }}</th>
                                    <th>{{ __('messages.department') }}</th>
                                    <th>{{ __('messages.designation') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <!-- end row -->
</div> <!-- container -->
@endsection

@section('scripts')
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<!-- <script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script> -->
 <!-- buttons -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  
  <!--
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

  Build a custom local version of the vfs_fonts.js file, containing whatever fonts you need. The 
  structure of the file is this:
  
  this.pdfMake = this.pdfMake || {}; this.pdfMake.vfs = {
    "arial.ttf": "AAEAA...MYXRu",
    "another_one.ttf": "XXXX...XXXX"
  };

  Replace the "AAEAA...MYXRu" with the base64-encoded string of your font file.
  You can use this site to generate the string: https://dataurl.sveinbjorn.org/#dataurlmaker

  -->
  <!-- <script src="vfs_fonts.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    // employee
    var employeeList = "{{ route('admin.employee.list') }}";
    var employeeDelete = "{{ route('admin.employee.delete') }}";
    var employeeImg = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/users/images/' }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/public/common-asset/images/users/default.jpg' }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_employee') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
</script>
<script src="{{ asset('public/js/custom/employee.js') }}"></script>
@endsection