@extends('layouts.admin-layout')
@section('title','Add Schedule')
@section('component_css')
<link href="{{ asset('public/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('content')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
    }
</style>
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
                <h4 class="page-title"> {{ __('messages.add_schedule') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addFilter" method="post" action="{{ route('admin.timetable.subject') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="day">{{ __('messages.day') }}<span class="text-danger">*</span></label>
                                    <select id="day" class="form-control" name="day">
                                        <option value="">{{ __('messages.select_day') }}</option>
                                        <option value="monday">{{ __('messages.monday') }}</option>
                                        <option value="tuesday">{{ __('messages.tuesday') }}</option>
                                        <option value="wednesday">{{ __('messages.wednesday') }}</option>
                                        <option value="thursday">{{ __('messages.thursday') }}</option>
                                        <option value="friday">{{ __('messages.friday') }}</option>
                                        <option value="saturday">{{ __('messages.saturday') }}</option>
                                        <option value="sunday">{{ __('messages.sunday') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}" {{$current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                        
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
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
    <!-- end row -->
    <div class="row" id="timetable" style="display:none;">
        <div class="col-xl-12 addTimetableForm">

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.add_schedule') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addTimetableForm" method="post" action="{{ route('admin.timetable.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table nowrap" id="timetable_table" style="width: max-content;">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.break') }}</th>
                                                    <th>{{ __('messages.subject') }}</th>
                                                    <th>{{ __('messages.teacher') }}</th>
                                                    <th>{{ __('messages.starting_time') }}</th>
                                                    <th>{{ __('messages.ending_time') }}</th>
                                                    <th>{{ __('messages.class_room') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="timetable_body">
                                                <tr class="iadd">
                                                    <td>
                                                        <div class="checkbox-replace">
                                                            <label class="i-checks">
                                                                <input type="checkbox" name="timetable[0][break]"><i></i>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <select class="form-control subject" name="timetable[0][subject]">
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <select class="form-control teacher" name="timetable[0][teacher]">
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <input class="form-control time_start_class" type="time" name="timetable[0][time_start]">
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <input class="form-control time_end_class" type="time" name="timetable[0][time_end]">
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <select class="form-control class_room" name="timetable[0][class_room]">
                                                                <option value="">{{ __('messages.select_hall') }}</option>
                                                                @forelse($hall_list as $list)
                                                                <option value="{{$list['id']}}">{{ $list['hall_no'] }}</option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div> <!-- end table-responsive-->

                                </div> <!-- end card-box -->
                            </div> <!-- end col-->
                        </div>
                        <button type="button" class="btn btn-soft-secondary waves-effect" style="color: #fff; border-color: #1abc9c; background-color: #1abc9c;" id="addMore">
                            <i class="fas fa-plus-circle"></i> {{ __('messages.add_more') }}</button>
                        <!-- end row-->
                        <input type="hidden" id="form_class_id" name="class_id">
                        <input type="hidden" id="form_section_id" name="section_id">
                        <input type="hidden" id="form_semester_id" name="semester_id">
                        <input type="hidden" id="form_session_id" name="session_id">
                        <input type="hidden" id="form_day" name="day">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.save') }}
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
    <!-- end row -->

</div> <!-- container -->

@endsection

@section('scripts')
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.timetable.subject') }}";
    var timetableList = "{{ route('admin.timetable') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
    var classRoomCheck = "{{ config('constants.api.class_room_check') }}";
     
    var admin_add_schedule_storage = localStorage.getItem('admin_add_schedule_details');
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>
@endsection