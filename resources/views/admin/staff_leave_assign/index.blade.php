@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.staff_leave_assign') . '')
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
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_122_3580)">
                                <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_122_3580">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_management') }} </a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.staff_leave_assign') }} </a></li>
                </ol>

            </div>  
         
        </div>
    </div>
    <!-- end page title -->

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
                    <form id="staffLeaveAssignFilter"   method="post" autocomplete="off">
                        <div class="row">      
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="department" id="department">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $dep)
                                        <option value="{{$dep['id']}}">{{$dep['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee">{{ __('messages.employee') }}</label>
                                    <select class="form-control" name="employee" id="employee">
                                        <option value="">{{ __('messages.select_employee') }}</option>
                                    </select>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.staff_leave_assign') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
             
                <!-- <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffLeaveAssignModal">Add</button>
                    </div>
                </div> -->
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="staff-leave-assign-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.staff_name') }} </th>
                                    <th>{{ __('messages.leave_type') }} </th>
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
    //staff Leave Assign routes
    var employeeByDepartment = "{{ config('constants.api.employee_by_department') }}";
    var staffLeaveAssignList = "{{ route('admin.staff_leave_assign.list') }}";
    var staffLeaveAssignDetails = "{{ route('admin.staff_leave_assign.details') }}";
    var staffLeaveAssignDelete = "{{ route('admin.staff_leave_assign.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_leave_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
    // Get PDF Footer Text
    var header_txt="{{ __('messages.soap_sub_category') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    
    var admin_staffleaveassign_storage = localStorage.getItem('admin_staffleaveassign_details');
</script>

<script src="{{ asset('js/custom/staff_leave_assign.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection