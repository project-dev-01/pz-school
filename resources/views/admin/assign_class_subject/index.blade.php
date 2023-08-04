@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.assign_grade_subjects') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.assign_grade_subjects') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.assign_grade_subjects') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="assignClassSubFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName"> {{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($classDetails as $cla)
                                        <option value="{{ $cla['id'] }}">{{ $cla['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="filtersectionID"> {{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="filtersectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="student Name">Subject<span class="text-danger">*</span></label>
                                <select id="student Name" class="form-control" name="class_id">
                                    <option value="">{{ __('messages.select_subject') }}</option>
                                    <option value="">Pengurusan Kelas</option>
                                    <option value="">Pendidikan Jasmani & Pendidikan Kesihatan</option>
                                </select>
                            </div>
                        </div> -->
                        </div>
                        <div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                {{ __('messages.filter') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.assign_grade_subjects_list') }}<h4>
                    </li>
                </ul><br>

                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAssignClassSubjectModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="class-assign-subjects-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.class') }}</th>
                                    <th>{{ __('messages.subject') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.assign_class_subject.add')
        @include('admin.assign_class_subject.edit')

    </div>
</div>
<!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    var classAssignAddUrl = "{{ config('constants.api.class_assign_add') }}";
    var classAssignGetRowUrl = "{{ config('constants.api.class_assign_details') }}";
    var classAssignUpdateUrl = "{{ config('constants.api.class_assign_update') }}";
    var classAssignDeleteUrl = "{{ config('constants.api.class_assign_delete') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var classAssignSubList = "{{ route('admin.class_assign_subject.list') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_assigned_grade_subject') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
    // Get PDF Footer Text

    var header_txt="{{ __('messages.assign_grade_subjects') }}";

    var footer_txt="{{ session()->get('footer_text') }}";

    // Get PDF Header & Footer Text End
    
    var admin_assign_class_subject_storage = localStorage.getItem('admin_assign_class_subject_details');
</script>
<script src="{{ asset('public/js/custom/assign_class_subject.js') }}"></script>
@endsection