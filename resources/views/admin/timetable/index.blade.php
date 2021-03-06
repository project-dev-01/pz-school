@extends('layouts.admin-layout')
@section('title','Schedule List')
@section('content')
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
    }
    .edit-button {
        float: right !important;
        position: absolute;
        right: 13px;
        top: 5px;
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
                <h4 class="page-title">Schedule List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 timetableForm">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="indexFilter" method="post" action="{{ route('admin.timetable.details') }}"  enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Standard<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id" >                             
                                    <option value="">Select Standard</option>
                                        @foreach($class as $cla)
                                            <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Class Name<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control"  name="section_id">                              
                                    <option value="">Select Class Name</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select id="semester_id" class="form-control"  name="semester_id">                              
                                    <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                            <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Session</label>
                                    <select id="session_id" class="form-control"  name="session_id">                              
                                    <option value="0">Select Session</option>
                                        @foreach($session as $ses)
                                            <option value="{{$ses['id']}}">{{$ses['name']}}</option>
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


    <div class="row" id="timetablerow" style="display:none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <div class="edit-button">
                            <a class="edit_modal btn btn-soft-secondary waves-effect" id="edit-modal" data-toggle="modal" data-target="#editTimetableModal">
                                <i class="fas fa-pen-nib"></i>
                            </a>
                        </div>
                        <h4 class="nav-link">
                           Schedule List
                        </h4>
                        
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table dt-responsive nowrap w-100 text-center">
                                    <tbody id="timetable">
                                        
                                        
                                    </tbody>
                                </table>
                                
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

<!-- Center modal content -->
<div class="modal fade editTimetable" id="editTimetableModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myeditTimetableModalLabel">Schedule Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
            </div>
            <div class="modal-body">
                <form id="edit-timetable-form" method="post" action="{{ route('admin.timetable.edit') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="class_id" id="edit_class_id">
                    <input type="hidden" name="section_id" id="edit_section_id">
                    <input type="hidden" name="semester_id" id="edit_semester_id">
                    <input type="hidden" name="session_id" id="edit_session_id">
                    <div class="form-group">
                        <label for="day">Day<span class="text-danger">*</span></label>
                        <select id="day" class="form-control"  name="day">
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Done</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('scripts')
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>

@endsection