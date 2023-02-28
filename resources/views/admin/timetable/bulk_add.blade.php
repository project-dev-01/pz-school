@extends('layouts.admin-layout')
@section('title','Add Bulk Schedule')
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
                <h4 class="page-title">Add Bulk Schedule</h4>
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
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addFilter" method="post" action="{{ route('admin.timetable.bulk.subject') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Grade<span class="text-danger">*</span></label>
                                    <select  class="form-control" name="class_id" id="bulk_class_id">
                                        <option value="">Select Grade</option>
                                        <option value="All">All</option>
                                        @foreach($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="day">Day<span class="text-danger">*</span></label>
                                    <select id="day" class="form-control" name="day">
                                        <option value="">Select Day</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}" {{$current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Session</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}" {{'1' == $ses['id'] ? 'selected' : ''}}>{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Filter
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
                            Add Bulk Schedule
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addTimetableForm" method="post" action="{{ route('admin.timetable.bulk.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 text-center" id="timetable_table">
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
                                                            <input class="form-control" type="time" name="timetable[0][time_start]">
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <input class="form-control" type="time" name="timetable[0][time_end]">
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="form-group">
                                                            <select class="form-control" name="timetable[0][class_room]">
                                                                <option value="">Select Hall</option>
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
                            <i class="fas fa-plus-circle"></i> Add More </button>
                        <!-- end row-->
                        <input type="hidden" id="form_class_id" name="class_id">
                        <input type="hidden" id="form_section_id" name="section_id">
                        <input type="hidden" id="form_semester_id" name="semester_id">
                        <input type="hidden" id="form_session_id" name="session_id">
                        <input type="hidden" id="form_day" name="day">
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                Save
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

<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.timetable.bulk.subject') }}";
    var timetableList = "{{ route('admin.timetable') }}";
    var teacherSubjectUrl = "{{ config('constants.api.teacher_subject') }}";
</script>
<script src="{{ asset('public/js/custom/timetable_bulk.js') }}"></script>
@endsection