@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Homework</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 addHomeworkForm">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Homework
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="addHomeworkForm" method="post" action="{{ route('admin.homework.add') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Homework Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Standard</option>
                                        @foreach($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="subject_id">Subject<span class="text-danger">*</span></label>
                                    <select id="subject_id" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_homework">Date Of Homework<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>

                                        <input type="text" class="form-control homeWorkAdd" name="date_of_homework" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_submission">Date Of Submission<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="date_of_submission" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-purple">
                                        <input id="publish_later" type="checkbox">
                                        <label for="publish_later">
                                            Published later
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="schedule" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="schedule_date">Schedule Date<span class="text-danger">*</span></label>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document">Attachment File<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="homework_file" class="custom-file-input" name="file">
                                            <label class="custom-file-label" for="document">Choose file</label>
                                        </div>
                                    </div>
                                    <span id="file_name"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Homework<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" placeholder="Please enter Description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>
                        </div>
                </div>
            </div>

            </form>
        </div> <!-- end card-body -->
    </div> <!-- end card-->




</div> <!-- container -->
@endsection

@section('scripts')

<script>
    var homeworkList = "{{ route('admin.evaluation_report') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.subject_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/homework.js') }}"></script>
@endsection