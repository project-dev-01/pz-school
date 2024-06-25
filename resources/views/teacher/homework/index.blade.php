@extends('layouts.admin-layout')
@section('title',' ' . __('messages.add_homework') . '')
@section('component_css')
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
.ui-datepicker
 {
width: 21.4em;
}
@media screen and (min-device-width: 280px) and (max-device-width: 653px) 
{
.ui-datepicker
 {
width: 14.4em;
}
.checkbox label {
    margin-top: 15px;
}
}
@media screen and (min-device-width: 320px) and (max-device-width: 660px) 
{
.ui-datepicker
 {
width: 14.4em;
}
.checkbox label {
    margin-top: 15px;
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
.custom-file-input:lang(en)~.custom-file-label::after 
{
    content: "{{ __('messages.butt_browse') }}";
}
</style>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
			<div class="col-12">
				<div class="page-title-box" style="display: inline-flex; align-items: center;">
					<div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 1.6668H3.93801V3.1181H5.0536V1.6668H5.28419H20.0992C20.9784 1.64405 21.8384 1.90614 22.5299 2.40755C23.2215 2.90896 23.7008 3.61801 23.8847 4.41156C23.9536 4.69416 23.9873 4.98309 23.9851 5.27273C23.9851 12.2033 23.9851 15.1361 23.9851 22.0712C24.0144 22.7616 23.8171 23.4441 23.419 24.0293C23.0209 24.6146 22.4406 25.0753 21.7539 25.3511C21.2377 25.5735 20.6724 25.6816 20.1029 25.6668H5.07593V24.2086H3.96034V25.6531H0.0111668L0 1.6668ZM3.96034 5.18696V6.96762H5.07593V5.18696H3.96034ZM5.07593 10.8V9.02962H3.96034V10.8H5.07593ZM3.98268 12.8586V14.6324H5.09826V12.8586H3.98268ZM5.09826 16.6944H3.98268V18.4785H5.09826V16.6944ZM5.09826 20.537H3.98268V22.3108H5.09826V20.537Z" fill="#3A4265" />
</svg>

					</div>
					<!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
					<ol class="breadcrumb m-0 responsivebc">
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.homework') }}</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.add_homework') }}</a></li>
					</ol>

				</div>
			</div>
		</div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addHomeworkForm">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">  {{ __('messages.add_homework') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
				
                <form id="addHomeworkForm" method="post" action="{{ route('teacher.homework.add') }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body collapse show">
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
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
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
                            <div class="col-md-4" style="display:none;">
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
                                        <label class="custom-file-label" for="document">{{ __('messages.choose_the_file') }}</label>
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
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection