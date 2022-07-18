@extends('layouts.admin-layout')
@section('title','Edit Schedule')
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
                <h4 class="page-title">Class Schedule</h4>
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
                            @if($timetable)Class {{ $details['class']['class_name'] }} (Section: {{ $details['section']['section_name'] }}) - {{ $details['day'] }} - @endif Schedule Edit
                        </h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="editTimetableForm" method="post" action="{{ route('admin.timetable.update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
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
                                                <th>Starting Time</th>
                                                <th>Ending Time</th>
                                                <th>Class Room</th>
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

                                                <input type="hidden" name="timetable[{{$row}}][id]" value="{{$table['id']}}" {{$bulk}}>
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
                                                        <input class="form-control break_type"  type="text" name="timetable[{{$row}}][break_type]" value="{{$table['break_type']}}" {{$bulk}}></input>
                                                    </div>
                                                </td>
                                                @else
                                                <td width="20%">
                                                    <div class="form-group">
                                                        <select class="form-control subject" name="timetable[{{$row}}][subject]" {{$bulk}}>
                                                            <option value="">Select Subject</option >
                                                            @foreach($subject as $sub)
                                                            <option value="{{$sub['id']}}" {{ $sub['id'] == $table['subject_id'] ? 'selected' : ''}}>{{$sub['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input class="form-control break_type"  type="text" name="timetable[{{$row}}][break_type]" disabled hidden="hidden" {{$bulk}}></input>
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
                                                                            $all =  "Selected";
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
                                                    </div><button type="button" class=" btn btn-danger removeTR" {{$bulk}}><i class="fas fa-times" ></i> </button>

                                                    <!-- <div class="input-group"><input type="remarks" name="timetable[{{$row}}][class_room]" value="{{$table['class_room']}}" class="form-control"><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></div> -->
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
                        <input type="hidden" id="form_class_id" name="class_id" value="{{$details['class']['class_id']}}">
                        <input type="hidden" id="form_section_id" name="section_id" value="{{$details['section']['section_id']}}">
                        <input type="hidden" id="form_semester_id" name="semester_id" value="{{$details['semester']['semester_id']}}">
                        <input type="hidden" id="form_session_id" name="session_id" value="{{$details['session']['session_id']}}">
                        <input type="hidden" id="form_day" name="day" value="{{$details['day']}}">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                Update
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
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
    var timetableList = "{{ route('admin.timetable') }}";
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>
@endsection