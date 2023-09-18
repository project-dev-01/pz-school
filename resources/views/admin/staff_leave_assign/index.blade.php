@extends('layouts.admin-layout')
@section('title','Staff Leave Assign')
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
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.staff_leave_assign') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.staff_leave_assign') }}
                            <h4>
                    </li>
                </ul><br>
                <!-- <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addStaffLeaveAssignModal">Add</button>
                    </div>
                </div> -->
                <div class="card-body">
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
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

@endsection