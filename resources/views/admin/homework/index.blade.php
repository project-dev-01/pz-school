@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
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

    <div class="row">
        <div class="col-xl-12 addHomeworkForm" >
            <div class="card">
                <div class="card-body">
                    <span class=" fas fa-user-graduate  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">Add Homework</span>
                    <hr>

                    <form id="addHomeworkForm" method="post" action="{{ route('admin.homework.add') }}"  enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="title" class="col-3 col-form-label">Homework Title<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="class_id" class="col-3 col-form-label">Standard<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="class_id" class="form-control" name="class_id" >                             
                                            <option value="">Select Standard</option>
                                                @foreach($class as $cla)
                                                    <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="section_id" class="col-3 col-form-label">Class Name<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="section_id" class="form-control"  name="section_id">                              
                                                <option value="">Select Class Name</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="subject_id" class="col-3 col-form-label">Subject<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="subject_id" class="form-control" name="subject_id">                                       
                                                <option value="">Select Subject</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="date_of_homework" class="col-3 col-form-label">Date Of Homework<span class="text-danger">*</span></label>
                                        <div class="col-9">
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
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="date_of_submission" class="col-3 col-form-label">Date Of Submission<span class="text-danger">*</span></label>
                                        <div class="col-9">
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
                                <div class="form-group row">
                                    <div class="col-8 offset-3">
                                        <div class="checkbox checkbox-purple">
                                            <input id="publish_later" type="checkbox">
                                            <label for="publish_later">
                                                Published later
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="schedule" style="display:none">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="schedule_date" class="col-3 col-form-label">Schedule Date<span class="text-danger">*</span></label>
                                            <div class="col-9">
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
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="description" class="col-3 col-form-label">Homework<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" name="description" rows="5" placeholder="Please enter Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="document" class="col-3 col-form-label">Attachment File<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="homework_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="document">Choose file</label>
                                                </div>
                                            </div>
                                            <span id="file_name"></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>
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
    var homeworkList = "{{ route('admin.evaluation_report') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var subjectByClass = "{{ route('admin.subject_by_class') }}";
</script>
<script src="{{ asset('js/custom/homework.js') }}"></script>
@endsection