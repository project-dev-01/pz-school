@extends('layouts.admin-layout')
@section('title','Promotion Import')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
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
                    <div class="col-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="dt-buttons" style="float:right;">
                                <a href="{{ config('constants.image_url').'/common-asset/uploads/promotion_sample.csv'}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
                            </div>
                        </div>
                    </div>
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
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.promotion.import.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group" style="text-align: center;">
                        <div class="card-body" style="margin-left: 17px;">
                            <label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
                            <input type="file" name="file" />
                        </div>
                        <input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">
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
    <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Promoted List<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllchkbox"></th>
                                    <th># Attendance No</th>
                                    <th>Student Name</th>
                                    <th>Student Number</th>
                                    <th>Current Dept</th>
                                    <th>Current Grade</th>
                                    <th>Current Class</th>
                                    <th>Current Semester</th>
                                    <th>Current Session</th>
                                    <th style="background-color: orange;">Promoted Dept</th>
                                    <th style="background-color: orange;">Promoted Grade</th>
                                    <th style="background-color: orange;">Promoted Class</th>
                                    <th style="background-color: orange;">Promoted Semester</th>
                                    <th style="background-color: orange;">Promoted Session</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @if(session::get('data'))
                            @foreach(session::get('data') as $index => $outerArray)
                                @foreach($outerArray as $innerArray)
                                    <tr> <!-- Assuming you are in a table row -->
                                        <td><input type="checkbox" id="selectAllchkbox"></td>
                                        @foreach($innerArray[0] as $key => $value)
                                            <td>
                                                @if(isset($value))
                                                    {{ $value }}
                                                    @if($key === 'attendance_no')
                                                        <a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 18px;padding: 0px 0px 0px 12px;"></i></a>
                                                    @endif
                                                @else
                                                    Debug: {{ print_r($innerArray, true) }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach      
                            @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" id="deleteClassBtn" type="button">
                            {{ __('messages.save') }}
                        </button>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 1px solid #10a084;">
                    <h4 class="modal-title" id="myCenterModalLabel">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Attendance Number<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Attendance Number">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                    </div>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

<!-- /Page Content -->
@endsection
@section('scripts')
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    $(function() {

        // delete form
        $(document).on('click', '#deleteClassBtn', function() {
            var class_id = $(this).data('id');
            var url = "classDeleteUrl";
            swal.fire({
                title: "Are you sure want to proceed?",
                html: "",
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: "cancel",
                confirmButtonText: "confirm",
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 400,
                allowOutsideClick: false
            }).then(function(result) {
                
            });
        });
    });
</script>
<script>
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var getStudentListByClassSectionUrl = "{{ config('constants.api.get_student_by_class_section_sem_ses') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";

    var admin_promotion_storage = localStorage.getItem('admin_promotion_details');
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>
<script src="{{ asset('js/custom/promotion.js') }}"></script>@endsection