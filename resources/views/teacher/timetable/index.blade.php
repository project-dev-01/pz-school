@extends('layouts.admin-layout')
@section('title','Schedule List')
@section('content')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
    }

    .edit-button {
        float: right !important;
        position: absolute;
        right: 13px;
        top: 5px;
    }

    .table td,
    .table th {
        padding: .85rem;
        border-bottom: 1px solid #dee2e6;
    }

    .dt-responsive {
        width: max-content;
    }

    @media only screen and (min-device-width: 280px) and (max-device-width: 1200px) {
        .dt-responsive {
            width: max-content;
        }

    }

    .btn-primary-bl {
        width: 100px;
        margin-bottom: 5px;
        margin-right: 5px;
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="indexFilter" method="post" action="{{ route('teacher.timetable.details') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Grade</option>
                                        @foreach($class as $cla)
                                        <option value="{{$cla['class_id']}}">{{$cla['class_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
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

    <div class="row" id="timetablerow" style="display:none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <!-- <div class="edit-button">
                            <a class="edit_modal btn btn-soft-secondary waves-effect" id="edit-modal" data-toggle="modal" data-target="#editTimetableModal">
                                <i class="fas fa-pen-nib"></i>
                            </a>
                        </div> -->
                        <h4 class="nav-link">
                            Schedule List
                        </h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive table2excel">
                                    <tbody id="timetable">
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <form method="post" action="{{ route('teacher.timetable.pdf') }}">
                                    @csrf
                                    <input type="hidden" name="class_id" id="downClassID">
                                    <input type="hidden" name="section_id" id="downSectionID">
                                    <input type="hidden" name="semester_id" id="downSemesterID">
                                    <input type="hidden" name="session_id" id="downSessionID">
                                    <input type="hidden" name="academic_year" id="downAcademicYear">
                                    <div class="clearfix float-right">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">PDF</button>
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">Download</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->
@endsection

@section('scripts')
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>

@endsection