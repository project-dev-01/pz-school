@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.check_in_out_time') . '')
@section('component_css')
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <g clip-path="url(#clip0_59_2284)">
                                <path d="M12.1447 13.2052H1.08195C0.869997 13.2189 0.65905 13.1661 0.478598 13.0541C0.298146 12.9421 0.15721 12.7765 0.0754908 12.5806C0.0164159 12.4358 -0.00778721 12.2791 0.00484663 12.1232C0.0174805 11.9674 0.0665963 11.8166 0.148221 11.6832C0.229846 11.5498 0.341689 11.4374 0.474746 11.3552C0.607802 11.273 0.758347 11.2231 0.914212 11.2097H12.1405C12.2076 11.0127 12.2621 10.8199 12.3418 10.6354C12.6014 10.027 13.0086 9.49288 13.5267 9.0814C14.0447 8.66992 14.6573 8.39407 15.3088 8.27879C15.9604 8.1635 16.6304 8.21244 17.2583 8.42116C17.8861 8.62989 18.452 8.99181 18.9048 9.47419C19.3395 9.92582 19.6538 10.4793 19.819 11.084C19.8215 11.1037 19.828 11.1228 19.8382 11.14C19.8483 11.1571 19.8618 11.172 19.8779 11.1838C19.894 11.1956 19.9123 11.2039 19.9317 11.2084C19.9512 11.2129 19.9713 11.2133 19.9909 11.2097H22.96C23.0968 11.2009 23.2339 11.2202 23.363 11.2664C23.492 11.3126 23.6102 11.3848 23.7102 11.4786C23.8102 11.5723 23.8899 11.6855 23.9444 11.8112C23.9989 11.937 24.0271 12.0725 24.0271 12.2096C24.0271 12.3466 23.9989 12.4822 23.9444 12.6079C23.8899 12.7336 23.8102 12.8469 23.7102 12.9406C23.6102 13.0343 23.492 13.1065 23.363 13.1527C23.2339 13.199 23.0968 13.2182 22.96 13.2094H20.0035C19.982 13.2058 19.96 13.2066 19.9388 13.2116C19.9176 13.2167 19.8976 13.2259 19.88 13.2388C19.8624 13.2517 19.8476 13.268 19.8364 13.2867C19.8252 13.3054 19.8178 13.3261 19.8148 13.3477C19.6447 13.9597 19.326 14.5203 18.887 14.9796C18.4481 15.4388 17.9025 15.7826 17.2986 15.9804C16.7889 16.1679 16.2449 16.2443 15.7032 16.2045C15.1615 16.1648 14.6345 16.0097 14.1576 15.7498C13.2959 15.3082 12.6303 14.5606 12.2914 13.6538C12.2369 13.528 12.1992 13.3771 12.1447 13.2052ZM17.9948 12.2075C17.9948 11.8128 17.8777 11.427 17.6583 11.0988C17.439 10.7707 17.1272 10.5149 16.7625 10.3639C16.3977 10.2129 15.9964 10.1734 15.6092 10.2503C15.222 10.3273 14.8663 10.5174 14.5871 10.7965C14.3079 11.0755 14.1178 11.4311 14.0408 11.8182C13.9638 12.2053 14.0033 12.6065 14.1544 12.9711C14.3055 13.3357 14.5613 13.6474 14.8896 13.8666C15.2179 14.0859 15.6038 14.2029 15.9986 14.2029C16.5262 14.2018 17.0321 13.9924 17.4059 13.6202C17.7798 13.248 17.9914 12.7433 17.9948 12.2158V12.2075Z" fill="black" />
                                <path d="M11.8637 3.21532H22.9474C23.2121 3.20031 23.472 3.29103 23.6698 3.46753C23.8676 3.64402 23.9871 3.89184 24.0021 4.15645C24.0171 4.42106 23.9264 4.6808 23.7498 4.87853C23.5733 5.07625 23.3254 5.19576 23.0607 5.21077H11.8637C11.8008 5.38684 11.7505 5.56291 11.6792 5.73479C11.3186 6.64418 10.6262 7.38284 9.74176 7.80152C8.97637 8.18733 8.10323 8.304 7.26334 8.13269C6.59308 8.01156 5.96582 7.71834 5.4431 7.28179C4.92038 6.84525 4.52017 6.28037 4.2817 5.64257C4.23944 5.54113 4.20714 5.43583 4.18524 5.32816C4.18524 5.22755 4.10976 5.21077 4.0175 5.21077H1.04842C0.850946 5.22166 0.654793 5.17266 0.48567 5.07017C0.316546 4.96769 0.182353 4.8165 0.100672 4.63645C0.0297274 4.48724 -0.00304361 4.32276 0.00530182 4.15777C0.0136473 3.99277 0.0628466 3.83243 0.148484 3.69113C0.234122 3.54984 0.353511 3.43201 0.495946 3.34823C0.638382 3.26445 0.799407 3.21734 0.964553 3.21113C1.96263 3.21113 2.96071 3.21113 3.96298 3.21113C3.99055 3.21526 4.01867 3.21385 4.04569 3.20699C4.07271 3.20013 4.09811 3.18796 4.12037 3.17117C4.14262 3.15439 4.1613 3.13333 4.17532 3.10924C4.18934 3.08515 4.19842 3.0585 4.20202 3.03086C4.39211 2.37157 4.75398 1.7746 5.2506 1.30098C5.74722 0.827368 6.36077 0.494118 7.0285 0.335318C7.96449 0.0791761 8.96321 0.193273 9.81725 0.653918C10.3027 0.896827 10.7318 1.23867 11.0771 1.65745C11.4223 2.07622 11.676 2.56263 11.8218 3.08536C11.8329 3.12954 11.847 3.17295 11.8637 3.21532ZM5.99268 4.20466C5.99103 4.59932 6.10648 4.98561 6.32444 5.31467C6.5424 5.64374 6.85308 5.90081 7.21719 6.05337C7.5813 6.20593 7.98249 6.24713 8.37002 6.17176C8.75756 6.09639 9.11404 5.90784 9.39438 5.62995C9.67472 5.35205 9.86632 4.9973 9.94497 4.61054C10.0236 4.22379 9.98577 3.82242 9.83623 3.45716C9.68668 3.09191 9.43214 2.77919 9.1048 2.55855C8.77746 2.33791 8.39202 2.21925 7.99722 2.21758C7.47066 2.22087 6.96654 2.43115 6.59381 2.80297C6.22107 3.17479 6.00966 3.67829 6.00526 4.20466H5.99268Z" fill="black" />
                                <path d="M11.893 21.2373C11.7211 21.5978 11.5827 21.9709 11.3772 22.3105C10.8928 23.1349 10.1134 23.7447 9.19656 24.0167C8.28685 24.3027 7.30466 24.2526 6.42877 23.8756C5.55289 23.4986 4.84155 22.8197 4.42423 21.9625C4.33155 21.7581 4.25171 21.5481 4.18519 21.3337C4.179 21.2943 4.15742 21.2589 4.1252 21.2353C4.09297 21.2118 4.05272 21.2019 4.01325 21.2079H1.02741C0.824263 21.2115 0.624908 21.1527 0.456202 21.0395C0.287496 20.9263 0.157544 20.7642 0.083848 20.5749C0.0242861 20.4226 0.00293495 20.258 0.0216632 20.0955C0.0403914 19.933 0.0986279 19.7776 0.191286 19.6428C0.283944 19.508 0.408206 19.3979 0.553222 19.3222C0.698239 19.2464 0.859598 19.2073 1.02321 19.2083C1.57257 19.2083 2.12195 19.2083 2.67131 19.2083C3.12002 19.2083 3.56873 19.2083 4.01745 19.2083C4.03841 19.2119 4.05987 19.2112 4.08057 19.2064C4.10127 19.2015 4.1208 19.1926 4.13799 19.1801C4.15519 19.1676 4.1697 19.1518 4.18069 19.1336C4.19167 19.1154 4.19892 19.0952 4.20197 19.0741C4.37105 18.4413 4.70201 17.8634 5.1623 17.3973C5.84546 16.6988 6.76137 16.2754 7.73618 16.2074C8.71099 16.1394 9.67685 16.4316 10.4504 17.0284C11.114 17.5333 11.5965 18.2391 11.8259 19.0406C11.8259 19.0825 11.8553 19.1286 11.8721 19.1873H22.9432C23.0786 19.175 23.215 19.1903 23.3443 19.2324C23.4735 19.2744 23.5928 19.3423 23.695 19.4319C23.7972 19.5215 23.8801 19.631 23.9386 19.7536C23.9972 19.8762 24.0302 20.0095 24.0356 20.1452C24.041 20.281 24.0187 20.4165 23.9701 20.5433C23.9215 20.6702 23.8476 20.7859 23.7529 20.8834C23.6581 20.9808 23.5446 21.058 23.4191 21.1102C23.2936 21.1624 23.1588 21.1885 23.0229 21.187H11.8595L11.893 21.2373ZM6.02199 20.2018C6.022 20.5961 6.13886 20.9816 6.35783 21.3096C6.57681 21.6375 6.88807 21.8933 7.25233 22.0446C7.61659 22.1958 8.01752 22.2359 8.40451 22.1595C8.79149 22.0832 9.14719 21.894 9.42669 21.6158C9.70618 21.3375 9.89695 20.9828 9.97492 20.5962C10.0529 20.2097 10.0146 19.8088 9.86476 19.444C9.71496 19.0792 9.4604 18.767 9.13324 18.5467C8.80608 18.3265 8.42098 18.208 8.02654 18.2064C7.76213 18.2025 7.4996 18.2512 7.25425 18.3498C7.0089 18.4484 6.78563 18.5948 6.59749 18.7806C6.40934 18.9663 6.26008 19.1877 6.15839 19.4317C6.05671 19.6757 6.00463 19.9375 6.00522 20.2018H6.02199Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2284">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.209534)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.settings') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.check_in_out_time') }}</a></li>
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
                        <h4 class="navv">{{ __('messages.check_in_out_time') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <!-- <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addGlobalSettingModal">Add</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="check-in-out-time-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.check_in_time') }}</th>
                                    <th>{{ __('messages.check_out_time') }}</th>
                                    <!-- <th>{{ __('messages.updated_by') }}</th> -->
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.check_in_out_time.edit')
</div>
<!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
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
    //checkInOutTime routes
    var checkInOutTimeList = "{{ route('admin.check_in_out_time.list') }}";
    var checkInOutTimeDetails = "{{ route('admin.check_in_out_time.details') }}";
    
    // Get PDF Footer Text
    var header_txt="{{ __('messages.check_in_out_time') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/check_in_out_time.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection