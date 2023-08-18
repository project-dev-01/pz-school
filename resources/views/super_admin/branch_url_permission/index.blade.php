@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.activty_monitoring') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
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
                <h4 class="page-title">{{ __('messages.menu_creation') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.menu_creation') }}<h4>
                    </li>
                </ul><br>
               
                <div class="card-body">
                    <form id="LogHistoryFilter" autocomplete="off" novalidate="novalidate">
                                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" name="" class="form-control " placeholder="{{ __('messages.enter_menu_name') }}" id="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_type') }}</label>
                                    <select id="" name="" class="form-control">
                                    <option value="">{{ __('messages.select_menu_type') }}</option>
                                    <option value="">{{ __('messages.select_mainmenu') }}</option>
                                    <option value="">{{ __('messages.select_submenu') }}</option>
                                    <option value="">{{ __('messages.select_childmenu') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu') }}</label>
                                    <select id="" name="" class="form-control">
                                    <option value="">{{ __('messages.select_menu') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">   
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.menu_icon') }}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" placeholder="{{ __('messages.enter_menu_icon') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_url') }}</label>
                                    <input type="text" autocomplete="off" name="" class="form-control " placeholder="{{ __('messages.enter_menu_url') }}" id="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_status') }}</label>
                                    <select id="" name="" class="form-control">
                                    <option value="">{{ __('messages.select_menu_status') }}</option>
                                    <option value="">{{ __('messages.active') }}</option>
                                    <option value="">{{ __('messages.de-active') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
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
                                <h4 class="navv">{{ __('messages.menu_list') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="table-responsive">
                                        <table class="table dt-responsive nowrap w-100" id="">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th>{{ __('messages.menu_name') }}</th>
									<th>{{ __('messages.menu_type') }}</th>
                                    <th>{{ __('messages.menu_icon') }}</th>
                                    <th>{{ __('messages.menu') }}</th>									
                                    <th>{{ __('messages.menu_url') }}</th>
                                    <th>{{ __('messages.menu_status') }}</th>
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
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    //feesGroup routes
    var login_activityList = "{{ route('admin.login_activity.list') }}";

    // Get PDF Footer Text
    var header_txt="{{ __('messages.fees_group') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>

<script src="{{ asset('public/js/custom/login_activity.js') }}"></script>

@endsection