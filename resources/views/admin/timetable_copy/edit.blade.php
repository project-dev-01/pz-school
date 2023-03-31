@extends('layouts.admin-layout')
@section('title','Copy Schedule')
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
                <h4 class="page-title">Grade Schedule</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row" id="edit_timetable">
        <div class="col-xl-12 editTimetableForm">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link"><i class="far fa-clock"></i>
                            @if($timetable)Grade {{ $details['class']['class_name'] }} (Class: {{ $details['section']['section_name'] }}) - {{ $details['day'] }} - @endif Schedule Edit
                        </h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="copyeditTimetableForm" method="post" action="{{ route('admin.timetable.copy.save') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">Select Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Copy To Grade<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        <!-- <option value="All">All</option> -->
                                        @forelse ($classnames as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">Copy To Class<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Copy To Semester<span class="text-danger">*</span></label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Copy To Session<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-center" id="edit_timetable_table">
                                        @if($timetable)
                                        <thead>
                                            <tr>
                                                <th>Break</th>
                                                <th>Subject</th>
                                                <th>Teacher</th>
                                                <th>{{ __('messages.starting_time') }}</th>
                                                <th>{{ __('messages.ending_time') }}</th>
                                                <th>Class Room</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="edit_timetable_body">

                                            @php $row = 0; @endphp
                                            @foreach($timetable as $table)
                                            @php
                                            $bulk = "";
                                            if($table['bulk_id']) {
                                            $bulk = "disabled";
                                            }
                                            @endphp
                                            <tr class="iadd">

                                                <!-- <input type="hidden" name="timetable[{{$row}}][id]" value="{{$table['id']}}" {{$bulk}}> -->
                                                <td>
                                                    <div class="checkbox-replace">
                                                        <label class="i-checks">
                                                            <input type="checkbox" name="timetable[{{$row}}][break]" {{$table['break'] == "1" ? 'checked' : ''}} {{$bulk}}><i></i>
                                                        </label>
                                                    </div>
                                                </td>
                                                @if($table['break'] == "1")
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <select class="form-control subject" name="timetable[{{$row}}][subject]" disabled hidden="hidden" {{$bulk}}>
                                                            <option value="">Select Subject</option>
                                                            @foreach($subject as $sub)
                                                            <option value="{{$sub['id']}}">{{$sub['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input class="form-control break_type" type="text" name="timetable[{{$row}}][break_type]" value="{{$table['break_type']}}" {{$bulk}}></input>
                                                    </div>
                                                </td>
                                                @else
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <select class="form-control subject" name="timetable[{{$row}}][subject]" {{$bulk}}>
                                                            <option value="">Select Subject</option>
                                                            @foreach($subject as $sub)
                                                            <option value="{{$sub['id']}}" {{ $sub['id'] == $table['subject_id'] ? 'selected' : ''}}>{{$sub['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input class="form-control break_type" type="text" name="timetable[{{$row}}][break_type]" disabled hidden="hidden" {{$bulk}}></input>
                                                    </div>
                                                </td>
                                                @endif
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <select class="form-control teacher teacher select2-multiple-plus" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[{{$row}}][teacher][]" {{$bulk}}>
                                                            <option value="">Select Teacher</option>
                                                            @if($table['bulk_id'])
                                                            @php
                                                            $all = "";
                                                            foreach (explode(',', $table['teacher_id']) as $info) {
                                                            if($info == "0") {
                                                            $all = "Selected";
                                                            }
                                                            }
                                                            @endphp
                                                            <option value="0" {{ $all }}>All</option>
                                                            @endif
                                                            @forelse($teacher as $teach)
                                                            @php
                                                            $selected = "";
                                                            @endphp
                                                            @if($table['teacher_id'])
                                                            @foreach(explode(',', $table['teacher_id']) as $info)
                                                            @if($teach['id'] == $info)
                                                            @php
                                                            $selected = "Selected";
                                                            @endphp
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                            <option value="{{$teach['id']}}" {{ $selected }}>{{$teach['name']}}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <input class="form-control" type="time" name="timetable[{{$row}}][time_start]" value="{{$table['time_start']}}" {{$bulk}}>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <input class="form-control" type="time" name="timetable[{{$row}}][time_end]" value="{{$table['time_end']}}" {{$bulk}}>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <select class="form-control" name="timetable[{{$row}}][class_room]" {{$bulk}}>
                                                            <option value="">Select Hall</option>
                                                            @forelse($hall_list as $list)
                                                            <option value="{{$list['id']}}" {{ $list['id'] == $table['class_room'] ? 'selected' : ''}}>{{ $list['hall_no'] }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <!-- <div class="input-group"><input type="remarks" name="timetable[{{$row}}][class_room]" value="{{$table['class_room']}}" class="form-control"><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></div> -->
                                                </td>
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <button type="button" class=" btn btn-danger removeTR" {{$bulk}}><i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $row++; @endphp
                                            @endforeach

                                        </tbody>
                                        @else
                                        <tbody>
                                            <td>No Data Found </td>
                                        </tbody>
                                        @endif
                                    </table>

                                </div> <!-- end table-responsive-->
                            </div> <!-- end col-->
                        </div>
                        <br>
                        <!-- <button type="button" class="btn btn-soft-secondary waves-effect" id="addMore" >
					<i class="fas fa-plus-circle"></i> Add More				</button> -->
                        <!-- end row-->
                        @if($timetable)
                        <!-- <input type="hidden" id="form_class_id" name="class_id" value="{{$details['class']['class_id']}}">
                        <input type="hidden" id="form_section_id" name="section_id" value="{{$details['section']['section_id']}}"> -->
                        <!-- <input type="hidden" id="form_semester_id" name="semester_id" value="{{$details['semester']['semester_id']}}">
                        <input type="hidden" id="form_session_id" name="session_id" value="{{$details['session']['session_id']}}"> -->
                        <input type="hidden" id="form_day" name="day" value="{{$details['day']}}">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Copy
                            </button>
                            <a href="{{ route('admin.timetable') }}" class="btn btn-primary-bl waves-effect waves-light">
                                Back
                            </a>
                        </div>
                        @else
                        <div class="form-group text-right m-b-0">
                            <a href="{{ route('admin.timetable') }}" class="btn btn-primary-bl waves-effect waves-light">
                                Back
                            </a>
                        </div>
                        @endif
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection

@section('scripts')

<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.timetable.subject') }}";
    var timetableList = "{{ route('admin.timetable.copy') }}";
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>
@endsection