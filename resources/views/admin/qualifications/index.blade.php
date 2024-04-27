@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.add_qualification') . '')
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
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2147)">
                                <path d="M6.34223 7.4312C5.7425 7.43071 5.15636 7.21811 4.65793 6.8203C4.15949 6.4225 3.77115 5.85735 3.54202 5.19631C3.3129 4.53528 3.25328 3.80805 3.37069 3.1066C3.4881 2.40515 3.77727 1.76097 4.20165 1.25553C4.62602 0.750092 5.16654 0.406094 5.75483 0.267034C6.34313 0.127973 6.95278 0.200097 7.5067 0.474287C8.06063 0.748476 8.53395 1.21241 8.8668 1.80743C9.19965 2.40245 9.3771 3.10183 9.37668 3.81713C9.37446 4.77569 9.0539 5.69417 8.4852 6.37151C7.91649 7.04885 7.14595 7.42988 6.34223 7.4312Z" fill="black" />
                                <path d="M10.0812 12.184H2.5592V12.0737C2.5592 11.5395 2.5592 11.0077 2.5592 10.476C2.55223 10.1513 2.60512 9.82865 2.71412 9.53093C2.82313 9.23321 2.98559 8.96766 3.19006 8.75302C3.49863 8.41913 3.89476 8.22323 4.31089 8.19875C4.50226 8.18621 4.69572 8.19875 4.88708 8.19875H8.18226C8.42965 8.19278 8.67548 8.24659 8.90497 8.35693C9.13446 8.46728 9.34285 8.63187 9.51759 8.84081C9.69559 9.04377 9.83701 9.28791 9.93318 9.5583C10.0294 9.82869 10.0783 10.1196 10.0769 10.4133C10.0769 10.9877 10.0769 11.562 10.0769 12.1389C10.0854 12.1464 10.0833 12.1589 10.0812 12.184Z" fill="black" />
                                <path d="M23.7708 20.6612C23.7708 20.7858 23.7294 20.9053 23.6558 20.9937C23.5821 21.0821 23.482 21.132 23.3776 21.1327H0.622457C0.568257 21.1374 0.513817 21.1288 0.462548 21.1073C0.411278 21.0858 0.364273 21.0519 0.32447 21.0078C0.284667 20.9636 0.252921 20.9102 0.231212 20.8508C0.209503 20.7914 0.198303 20.7272 0.198303 20.6624C0.198303 20.5976 0.209503 20.5335 0.231212 20.4741C0.252921 20.4147 0.284667 20.3612 0.32447 20.3171C0.364273 20.273 0.411278 20.2391 0.462548 20.2176C0.513817 20.1961 0.568257 20.1874 0.622457 20.1922H23.3776C23.4818 20.1922 23.5819 20.2416 23.6556 20.3295C23.7294 20.4175 23.7708 20.5368 23.7708 20.6612Z" fill="black" />
                                <path d="M23.9832 14.0475L23.2829 19.5276C23.2829 19.5426 23.2829 19.5576 23.2724 19.5802H0.736022C0.687656 19.2065 0.641397 18.8404 0.595134 18.4717L0.147222 14.983C0.103062 14.6369 0.0546973 14.2883 0.0168457 13.9396C0.000234573 13.7784 0.0210506 13.6147 0.0770412 13.4666C0.133032 13.3184 0.222051 13.1914 0.33438 13.0995C0.521583 12.9284 0.752638 12.8397 0.988369 12.8486H23.0264C23.2118 12.8363 23.3962 12.8885 23.5571 12.9989C23.718 13.1094 23.8486 13.2733 23.9327 13.4706C24.0029 13.6509 24.0207 13.8539 23.9832 14.0475Z" fill="black" />
                                <path d="M17.6956 7.4312C17.0959 7.43071 16.5097 7.21811 16.0113 6.8203C15.5129 6.4225 15.1246 5.85735 14.8954 5.19631C14.6663 4.53528 14.6067 3.80805 14.7241 3.1066C14.8415 2.40515 15.1307 1.76097 15.555 1.25553C15.9794 0.750092 16.5199 0.406094 17.1082 0.267034C17.6965 0.127973 18.3062 0.200097 18.8601 0.474287C19.414 0.748476 19.8873 1.21241 20.2202 1.80743C20.553 2.40245 20.7305 3.10183 20.7301 3.81713C20.7284 4.7759 20.408 5.69475 19.8392 6.37224C19.2704 7.04972 18.4995 7.43054 17.6956 7.4312Z" fill="black" />
                                <path d="M21.4345 12.184H13.9125V12.0737C13.9125 11.5403 13.9125 11.0077 13.9125 10.476C13.9059 10.1513 13.9589 9.8288 14.0679 9.53114C14.1769 9.23347 14.3392 8.96788 14.5434 8.75302C14.852 8.41913 15.2481 8.22323 15.6642 8.19875C15.8577 8.18621 16.0491 8.19875 16.2425 8.19875H19.5356C19.7819 8.19577 20.0262 8.25071 20.2546 8.36042C20.483 8.47014 20.691 8.63248 20.8668 8.83816C21.0426 9.04384 21.1826 9.28882 21.279 9.5591C21.3753 9.82939 21.426 10.1197 21.4282 10.4133C21.4282 10.9877 21.4282 11.562 21.4282 12.1389C21.4387 12.1464 21.4366 12.1589 21.4345 12.184Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2147">
                                    <rect width="24" height="20.9321" fill="white" transform="translate(0 0.200623)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.masters') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.add_qualification') }}</a></li>
                </ol>

            </div>     
          
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.qualification') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addqualifyModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="qualification-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.qualification_name') }}</th>
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
    @include('admin.qualifications.add')
    @include('admin.qualifications.edit')
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
    //qualification routes
    var qualifyList = "{{ route('admin.qualification.list') }}";
    var qualifyDetails = "{{route('admin.qualification.details')}}";
    var qualifyDelete = "{{ route('admin.qualification.delete') }}";
     // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_department') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";// Get PDF Footer Text
     // Get PDF Footer Text
     var header_txt="{{ __('messages.qualification') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/qualification.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection