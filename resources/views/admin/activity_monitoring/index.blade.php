@extends('layouts.admin-layout')
@section('title',' ' . __('messages.login_activity') . '')
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
<style>
     div.dt-buttons {
        display: flex;
    }
</style>    
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" enable-background="new 0 0 256 256" xml:space="preserve" style="width: 15px;">
                            <g>
                                <g>
                                    <g>
                                        <path fill="#3A4265" d="M20.1,10.7c-4.6,1.6-7.9,5-9.4,9.6C10,22.4,9.9,32.4,10,129l0.1,106.4l1.2,2.3c1.4,3,4.2,5.7,7.2,7.2l2.3,1.2h107.3h107.3l2.3-1.2c3-1.4,5.7-4.2,7.2-7.2l1.2-2.3V128.1V20.8l-1.2-2.3c-1.4-3-4.2-5.7-7.2-7.2l-2.3-1.2l-106.6-0.1C32.7,10,22,10,20.1,10.7z M216.7,76.4v36.9H198h-18.7l-10.7,16.2c-5.9,8.9-10.8,16.1-11,16.1c-0.1,0-12.7-18.7-27.9-41.5c-15.2-22.9-28.2-42-28.8-42.5c-1.6-1.2-3.5-1.1-5.1,0.4c-0.8,0.7-8.9,12.6-18,26.3l-16.6,25.1H50.3H39.5V76.4V39.5h88.6h88.6V76.4z M126.5,152.1c15.2,22.9,28.2,42,28.8,42.5c1.3,1.1,3.2,1.1,4.6,0.1c0.6-0.4,8.7-12.2,18.1-26.3l17-25.6h10.8h10.8v36.9v36.9h-88.6H39.5v-36.9v-36.9h18.7h18.7l10.7-16.2c5.9-8.9,10.8-16.1,11-16.1C98.7,110.6,111.2,129.3,126.5,152.1z" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.activty_monitoring') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.login_activity') }}</a></li>
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
                                {{ __('messages.login_activity') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
        

                <div class="card-body collapse show">
                    <form id="LogHistoryFilter" autocomplete="off" novalidate="novalidate">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role_id">{{ __('messages.role') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" data-toggle="select2" id="role_id" name="role_id" data-placeholder="{{ __('messages.choose_role') }}">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        @forelse($roles as $r)
                                        <option value="{{$r['id']}}">{{ __('messages.' . strtolower($r['role_name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.from') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="frm_ldate" class="form-control " placeholder="{{ __('messages.dd_mm_yyyy') }}" id="frm_ldate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.to') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="to_ldate" class="form-control " placeholder="{{ __('messages.dd_mm_yyyy') }}" id="to_ldate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                {{ __('messages.filter') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>-->
                        </div>
                    </form>

                </div> <!-- end card-box -->
            </div> <!-- end col -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.login_activity_details') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
        

                <div class="card-body collapse show">                     
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table dt-responsive nowrap w-100" id="logactivity-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.name') }}</th>
                                                        <th>{{ __('messages.role') }}</th>
                                                        <th>{{ __('messages.check_in_time') }}</th>
                                                        <th>{{ __('messages.check_out_time') }}</th>
                                                        <th>{{ __('messages.loginactivity_spend') }}</th>
                                                        <th>{{ __('messages.ip_address') }}</th>
                                                        <th>{{ __('messages.country') }}</th>
                                                        <th>{{ __('messages.device') }}</th>
                                                        <th>{{ __('messages.os') }}</th>
                                                        <th>{{ __('messages.browser') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-box -->
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
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
    //feesGroup routes
    var login_activityList = "{{ route('admin.login_activity.list') }}";

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.fees_group') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>

<script src="{{ asset('js/custom/login_activity.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection