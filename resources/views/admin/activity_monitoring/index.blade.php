@extends('layouts.admin-layout')
@section('title',' ' . __('messages.activty_monitoring') . '')
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
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.activty_monitoring') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.login_activity') }}
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">
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
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.login_activity_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
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
@endif
@endsection