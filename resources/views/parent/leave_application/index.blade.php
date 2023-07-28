@extends('layouts.admin-layout')
@section('title',' ' . __('messages.leave_application') . '')
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
@endsection
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
.ui-datepicker
 {
width: 21.4em;
}
@media screen and (min-device-width: 320px) and (max-device-width: 660px) 
{
.ui-datepicker
 {
width: 14.4em;
}
}
@media screen and (min-device-width: 360px) and (max-device-width: 740px) 
{
.ui-datepicker
 {
width: 17.4em;
}
}
@media screen and (min-device-width: 375px) and (max-device-width: 667px) 
{
.ui-datepicker
 {
width: 18.6em;
}
}
@media screen and (min-device-width: 390px) and (max-device-width: 844px) 
{
.ui-datepicker
 {
width: 19.8em;
}
}
@media screen and (min-device-width: 412px) and (max-device-width: 915px) 
{
.ui-datepicker
 {
width: 21.5em;
}
}
@media screen and (min-device-width: 540px) and (max-device-width: 720px) 
{
.ui-datepicker
 {
width: 31.3em;
}
}
@media screen and (min-device-width: 768px) and (max-device-width: 1024px) 
{
.ui-datepicker
 {
width: 13.2em;
}
}
@media screen and (min-device-width: 820px) and (max-device-width: 1180px) 
{
.ui-datepicker
 {
width: 14.3em;
}
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
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.leave_application') }}</h4>
            </div>
        </div>
    </div>
    <!--General Details -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> {{ __('messages.leave_application') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="stdGeneralDetails" method="post" action="{{ route('parent.studentleave.add') }}">
                        @csrf
                        <input type="hidden" name="class_id" id="listModeClassID">
                        <input type="hidden" name="section_id" id="listModeSectionID" />
                        <input type="hidden" name="student_id" id="listModestudentID" />
                        <input type="hidden" name="reasons" id="listModereason" />
                        <input type="hidden" name="reasonstxt" id="listModereasontext" />
                        <!--1st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changeStdName">{{ __('messages.student_name') }}<span class="text-danger">*</span></label>
                                    <select id="changeStdName" class="form-control" name="changeStdName">
                                        <option value="">{{ __('messages.select_student') }}</option>
                                        @forelse ($get_std_names_dashboard as $std)
                                        <option value="{{ $std['id'] }}" data-classid="{{ $std['class_id'] }}" data-sectionid="{{ $std['section_id'] }}" {{ Session::get('student_id') == $std['id'] ? 'selected' : ''}}>{{ $std['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.leave_from') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="frm_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.to') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="to_ldate" placeholder="{{ __('messages.dd_mm_yyyy') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--2st row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="changelev">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                    <select id="changelevReasons" class="form-control" name="changelevReasons">
                                        <option value="">{{ __('messages.select_reason') }}</option>
                                        @forelse ($get_leave_reasons_dashboard as $res)
                                        <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document">{{ __('messages.attachment_file') }}</label>

                                    <div class="input-group">
                                        <div class="">
                                            <input type="file" id="leave_file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                                            <span id="file_name"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.apply') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.leave_status') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="studentleave-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.student_name') }}</th>
                                    <th>{{ __('messages.leave_from') }}</th>
                                    <th>{{ __('messages.to_from') }}</th>
                                    <th>{{ __('messages.teacher_remarks') }}</th>
                                    <th>{{ __('messages.reason') }}</th>
                                    <th>{{ __('messages.document') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.apply_date') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col -->
    @include('parent.dashboard.check_list')
    @include('parent.dashboard.exam-schedule')

</div> <!-- container -->
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
    var UserName = "{{ Session::get('name') }}";
    // general details get student names
    var stutdentleaveList = "{{ route('parent.student_leave.list') }}";
    var reuploadFileUrl = "{{ route('parent.reupload_file.add') }}";
    // leave apply
    var StudentDocUrl = "{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/teacher/student-leaves/' }}";
    // Get PDF Footer Text
    var leave_status_txt = "{{ __('messages.leave_status') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";

    // Get PDF Header & Footer Text End
    var at="{{date('d-m-Y')}}";
    $("#frm_ldate").val(at);    
    $("#to_ldate").val(at);
    
    var parent_leaveapply_storage = localStorage.getItem('parent_leaveapply_details');
</script>
</script>
<!-- to do list -->
<script src="{{ asset('public/js/custom/parent_leave_app.js') }}"></script>
@endsection