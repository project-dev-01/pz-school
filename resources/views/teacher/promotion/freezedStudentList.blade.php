@extends('layouts.admin-layout')
@section('title','Promotion Import')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
@media screen and (min-device-width: 768px) and (max-device-width: 1200px)
     {
        .dt-buttons {
            margin-left: 56px;
        }

        div.dt-buttons {
            display: flex;
        }
    }
</style>
<!-- Page Content -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.promotion_import') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.promotion_import') }}
                            <h4>
                    </li>
                </ul><br>
               
                    <div class="card-body">
                    <form id="promoteStudentListForm" method="post" action="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_list_department_id">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                                    <select id="promote_list_status_id" name="promote_list_status_id" class="form-control">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="1">{{ __('messages.data_preparing') }}</option>
                                        <option value="2">{{ __('messages.data_prepared') }}</option>
                                        <option value="3">{{ __('messages.data_freezed') }}</option>
                                        <option value="4">{{ __('messages.temporary_unlock') }}</option>
                                    </select>
                                </div>
                            </div>
														<div class="col-md-3">
                            </div>
                            <div class="col-md-2">
                            </div>
                              
                            <div class="col-md-2">
                            <div class="form-group text-right m-b-0" style="margin-top:32px;">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.filter') }}
                                </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group text-right m-b-0" style="margin-top:32px;">
                        <button class="btn btn-primary-bl waves-effect waves-light" id="saveFinalPromotionDataBtn" type="button">
                                    {{ __('messages.promotion') }}
                                </button>
                        </div>
                            </div> 
                    </div>
                
            </div>
        </div>
    </div>

</div>
<!-- /Content End -->
<!-- content start  -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title"></h4>
                
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.promoted_student_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form method="" active="">
                    @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="promotionDataFreezedStudentList">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.id') }}</th>
                                        <th>{{ __('messages.department') }}</th>
                                        <th>{{ __('messages.grade') }}</th>
                                        <th>{{ __('messages.data_status') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="saveStatusDataBtn" type="button">
                                    {{ __('messages.save') }}
                                </button>
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col --> 
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.unassigned_student_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="unassignedPromotionStudentList">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.attendance_no') }}</th>
                                    <th>{{ __('messages.student_name') }}</th>
                                    <th>{{ __('messages.student_number') }}</th>
                                    <th>{{ __('messages.dept') }}</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.class') }}</th>
                                    <th>{{ __('messages.admission_date') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                           
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>

</div>

<!-- /Page Content -->
@endsection
@section('scripts')
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
    var studentListFreezed = "{{ route('teacher.promotion.get_freezed_student_list') }}";
    var studentListUnassignedFreezed = "{{config('constants.api.get_studentList_Unassigned_Freezed')}}"
    var savestatusFreezed = "{{ route('teacher.promotion.save_status_freezed_data') }}";
    var promotionFinalData = "{{ route('teacher.promotion.promotion_final_data') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var data_prepared = "{{ __('messages.data_prepared') }}";
    var data_preparing = "{{ __('messages.data_preparing') }}";
    var data_freezed = "{{ __('messages.data_freezed') }}";
    var temporary_unlock = "{{ __('messages.temporary_unlock') }}";
    var student_promoted_message = "{{ __('messages.student_promoted_message') }}";
    var student_promoted_status = "{{ __('messages.student_promoted_status') }}";
    var valid_status     = "{{ __('messages.valid_status') }}";
    var cancelButtonText = "{{ __('messages.cancel') }}";
	var confirmButtonText = "{{ __('messages.confirm') }}";
	var successButtonText = "{{ __('messages.success') }}";
    var error = "{{ __('messages.error') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
</script>
<script src="{{ asset('js/custom/promotion_bulk_process.js') }}"></script>@endsection