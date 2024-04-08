@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.parent_list') . '')
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
                <h4 class="page-title">{{ __('messages.parent_guardian_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="parentFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">{{ __('messages.status') }}</label>
                                    <select id="parent_status" class="form-control" name="status">
                                        <option value="">{{ __('messages.select_status') }}</option>
                                        <option value="0">{{ __('messages.active') }}</option>
                                        <option value="1">{{ __('messages.de_active') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div><br>
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
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                    <h4 class="navv">{{ __('messages.parent_guardian_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap" id="parent-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('messages.name') }}</th>
                                                <th> {{ __('messages.occupation') }}</th>
                                                <th> {{ __('messages.email') }}</th>
                                                <th> {{ __('messages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentList = "{{ route('admin.parent.list') }}";
    var parentDelete = "{{ route('admin.parent.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_Parent') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end// Get PDF Footer Text
 // Get PDF Footer Text
    var header_txt="{{ __('messages.parent_list') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/admin_parent_list.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection