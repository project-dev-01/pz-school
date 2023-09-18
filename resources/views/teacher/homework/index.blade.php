@extends('layouts.admin-layout')
@section('title','Homework')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <!--<div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>
                </div>
                <h4 class="page-title">Form Wizard</h4>-->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" style="margin-top: 20px;">
        <div class="col-xl-12 addHomeworkForm">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.add_homework') }}
                            <h4>
                    </li>
                </ul><br>
                <form id="addHomeworkForm" method="post" action="{{ route('teacher.homework.add') }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">{{ __('messages.homework_title') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="{{ __('messages.enter_homework_title') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse($class as $cla)
                                        <option value="{{$cla['class_id']}}">{{$cla['class_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="subject_id">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subject_id" class="form-control" name="subject_id">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}" >{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_homework">{{ __('messages.date_of_homework') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>

                                        <input type="text" class="form-control homeWorkAdd" name="date_of_homework" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_submission">{{ __('messages.date_of_submission') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="date_of_submission" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="document">{{ __('messages.attachment_file') }}<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="">
                                        <input type="file" id="homework_file" class="custom-file-input" name="file">
                                        <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                                            <span id="file_name"></span>
                                    </div>
                                </div>
                                <span id="file_name"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="checkbox checkbox-purple">
                                    <input id="publish_later" type="checkbox">
                                    <label for="publish_later">
                                    {{ __('messages.published_later') }}
                                    </label>
                                </div>
                            </div>
                        </div><br>
                        <div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="description">{{ __('messages.description') }}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="1" placeholder="{{ __('messages.enter_description') }}"></textarea>
                                </div>
                                <div class="col-md-4" id="schedule" style="display:none">
                                    <label for="schedule_date">{{ __('messages.schedule_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="schedule_date" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                            {{ __('messages.save') }}
                            </button>
                        </div>
                    </div> <!-- end card-body -->
                </form>
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection

@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    var teacherSectionUrl = "{{ config('constants.api.teacher_section') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var homeworkList = "{{ route('teacher.evaluation_report') }}";
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    var subjectByClass = "{{ route('teacher.subject_by_class') }}";
    // localStorage variables
    var teacher_add_homework_storage = localStorage.getItem('teacher_add_homework_details');
</script>
<script src="{{ asset('js/custom/add_homework.js') }}"></script>
@endsection