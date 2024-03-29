@extends('layouts.admin-layout')
@section('title','Promotion Import')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .warning-symbol {
    display: block;
    float: right;  /* Align to the right */
    margin-top: -43px; /* Add some top margin for spacing */
    color: red; /* Set the color to yellow */
    font-size: 40px; /* Set the font size to your desired value */
}
@media screen and (min-device-width: 768px) and (max-device-width: 1200px)
     {
        .dt-buttons {
            margin-left: 56px;
        }

        div.dt-buttons {
            display: flex;
        }
    }
</style>
<!-- Page Content -->
<!-- Page Content -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.promotion_import') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.promotion_import') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="promoteDownloadForm" method="post" action="{{ route('teacher.promotion.downloadCSV') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="download_department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="download_department_id" name="download_department_id" class="form-control">
                                       <option value="">{{ __('messages.select_department') }}</option>
                                            @forelse($department as $r)
                                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                                            @empty
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="downloadListClassID">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="downloadListClassID" class="form-control" name="download_class_id">
                                       <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="downloadListSectionID">{{ __('messages.class') }}</label>
                                    <select id="downloadListSectionID" class="form-control" name="download_section_id">
                                       <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="dt-buttons" style="float:right;">
                                        <button id="downloadSampleButton" class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button">
                                            <span>{{ __('messages.download_sample_csv') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </form>
                </div>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    {{ __('messages.upload_validation_error') }}<br><br>
                    <ul>
                        @foreach($errors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form id="uploadFile" method="post" enctype="multipart/form-data" action="{{ route('teacher.promotion.import.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group" style="text-align: center;">
                        <div class="card-body" style="margin-left: 17px;">
                            <label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
                            <input type="file" name="file" id="file"/>
                        </div>
                        <input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /Content End -->
<div class="content container-fluid">
     <!-- start page title -->
     <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.promotion_import') }}
                            <h4>
                    </li>
                </ul><br>
                <form id="promoteStudentListForm" method="post" action="" autocomplete="off">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_list_department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="promote_list_department_id" name="promote_list_department_id" class="form-control">
                                       <option value="All">{{ __('messages.all') }}</option>
                                            @forelse($department as $r)
                                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                                            @empty
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promoteListClassID">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="promoteListClassID" class="form-control" name="promote_list_class_id">
                                       <option value="All">{{ __('messages.all') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promoteListSectionID">{{ __('messages.class') }}</label>
                                    <select id="promoteListSectionID" class="form-control" name="promote_list_section_id">
                                       <option value="All">{{ __('messages.all') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.promotion_sort') }}<span class="text-danger">*</span></label>
                                    <select id="sort" class="form-control" name="sort_id">
                                        <option value="All">{{ __('messages.all') }}</option>
                                        <option value="1">Before Promotion Sort</option>
                                        <option value="2">After Promotion Sort</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Content End -->
<!-- content start  -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title"></h4>
                
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.promoted_student_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form method="" active="">
                    @csrf
                    <div id="warningSymbol" class="warning-symbol" style="display: none;">&#9888;</div>
                        <div class="table-responsive">
                            <table class="table table-bordered w-100" id="promotionDataStudentList">
                                <thead>
                                    <tr>
                                            <th>#</th>
											<th>{{ __('messages.id') }}</th>
											<th>{{ __('messages.attendance_no') }}</th>
											<th>{{ __('messages.student_name') }}</th>
											<th>{{ __('messages.student_number') }}</th>
											<th>{{ __('messages.current_dept') }}</th>
											<th>{{ __('messages.current_grade') }}</th>
											<th>{{ __('messages.current_class') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_dept') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_grade') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_class') }}</th>
											<th>{{ __('messages.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="savePreparedDataBtn" type="button">
                                    {{ __('messages.data_prepared_done') }}
                                </button>
                            </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.unassigned_student_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="unassignedStudentList">
                            <thead>
                                <tr>
                                        <th>#</th>
										<th>{{ __('messages.attendance_no') }}</th>
										<th>{{ __('messages.student_name') }}</th>
										<th>{{ __('messages.student_number') }}</th>
										<th>{{ __('messages.dept') }}</th>
										<th>{{ __('messages.grade') }}</th>
										<th>{{ __('messages.class') }}</th>
										<th>{{ __('messages.admission_date') }}</th>
										<th>{{ __('messages.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                           
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.termination_student_list') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="terminationStudentList">
                            <thead>
                                <tr>
                                        <th>#</th>
										<th>{{ __('messages.attendance_no') }}</th>
										<th>{{ __('messages.student_name') }}</th>
										<th>{{ __('messages.student_number') }}</th>
										<th>{{ __('messages.dept') }}</th>
										<th>{{ __('messages.grade') }}</th>
										<th>{{ __('messages.class') }}</th>
										<th>{{ __('messages.admission_date') }}</th>
										<th>{{ __('messages.termination_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                           
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>

</div>

<!-- /Page Content -->
@endsection
@section('scripts')
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var studentListBulk = "{{ route('teacher.promotion.bulk_student_list') }}";
    var getUnassignedStudentList = "{{ route('teacher.promotion.unassigned_student_list') }}";
    var getTerminationStudentList = "{{ route('teacher.promotion.termination_student_list') }}";
    var promotionImportPreparedUrl = "{{ route('teacher.promotion.save_prepared_data') }}";
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";

    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>
<script src="{{ asset('js/custom/promotion_bulk.js') }}"></script>@endsection