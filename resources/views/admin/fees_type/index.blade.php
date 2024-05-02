@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.fees_type') . '')
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
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1194)">
                                <rect x="12.8" y="10.4097" width="6.4" height="4.8" rx="1" fill="#3A4265" />
                                <rect x="12.8" y="16.8096" width="11.2" height="3.2" rx="1" fill="#3A4265" />
                                <rect x="12.8" y="21.6094" width="8" height="3.2" rx="1" fill="#3A4265" />
                                <rect y="0.80957" width="11.2" height="24" rx="1" fill="#3A4265" />
                                <rect x="12.8" y="0.80957" width="11.2" height="3.2" rx="1" fill="#3A4265" />
                                <rect x="12.8" y="5.60938" width="11.2" height="3.2" rx="1" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1194">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.80957)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.fees') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.fees_type') }} </a></li>
                </ol>

            </div>    
       
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.fees_type') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
          
                <div class="card-body collapse show">
              
                <div class="form-group pull-right">
                    <div class="">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addFeesTypeModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="fees-type-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.fees_type_name') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!--- end row -->
    @include('admin.fees_type.add')
    @include('admin.fees_type.edit')
</div>
<!-- container -->
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
    //feesType routes
    var feesTypeList = "{{ route('admin.fees_type.list') }}";
    var feesTypeDetails = "{{ route('admin.fees_type.details') }}";
    var feesTypeDelete = "{{ route('admin.fees_type.delete') }}";
    
    // Get PDF Footer Text
    var header_txt="{{ __('messages.fees_type') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure?') }}";
    var deleteHtml = "{{ __('messages.delete_this_fees_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
</script>

<script src="{{ asset('js/custom/fees_type.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection