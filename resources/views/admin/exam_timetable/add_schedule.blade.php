@extends('layouts.admin-layout')
@section('title','Add Schedule')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
<style>
.w-100 {
    width: 150%!important;
}
</style>

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
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addScheduleFilter" method="post" action="{{ route('admin.exam_timetable.get') }}"  enctype="multipart/form-data" autocomplete="off">
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
                                    <label for="exam_id">Exam<span class="text-danger">*</span></label>
                                    <select id="exam_id" class="form-control" name="exam_id">
                                        <option value="">Select Exam</option>
                                            @foreach($exam as $exa)
                                                <option value="{{$exa['id']}}">{{$exa['name']}} ( {{$exa['term_id']}} )</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Filter
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="listrow"  style="display:none">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="navv">
                            Add Schedule
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addScheduleForm"  method="post" action="{{ route('admin.exam_timetable.add') }}"  enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered dt-responsive nowrap w-100" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Subject <span class="text-danger">*</span></th>
                                                    <th>Date <span class="text-danger">*</span></th>
                                                    <th>Starting Time <span class="text-danger">*</span></th>
                                                    <th>Ending Time <span class="text-danger">*</span></th>
                                                    <th>Hall Room <span class="text-danger">*</span></th>
                                                    <th>Distributor<span class="text-danger">*</span></th>
                                                    <th>Marks<span class="text-danger">*</span></th>

                                                </tr>
                                            </thead>
                                            <tbody id="subject-schedule">
                                           
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->                             
                        </div>

                        </div>
                        <input type="hidden" id="form_class_id"  name="class_id">
                        <input type="hidden" id="form_section_id" name="section_id">
                        <input type="hidden" id="form_exam_id" name="exam_id">
                        <!-- end row-->
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
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
    var scheduleList = "{{ route('admin.timetable.viewexam') }}";
    var getTeacherList = "{{config('constants.api.teacher_list')}}";
    
    
</script>
<script src="{{ asset('public/js/custom/exam_timetable.js') }}"></script>

@endsection