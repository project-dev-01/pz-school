@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.exam_paper') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li>
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.exam_paper') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.exam_paper') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addExamPaperModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap w-100" id="exam-paper-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.grade') }}</th>
                                    <th>{{ __('messages.subject') }}</th>
                                    <th>{{ __('messages.grade_category') }}</th>
                                    <th>{{ __('messages.paper_name') }}</th>
                                    <th>{{ __('messages.paper_type') }}</th>
                                    <th>{{ __('messages.subject_weightage') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
    </div>
    <!--- end row -->
    @include('admin.exam_paper.add')
    @include('admin.exam_paper.edit')

</div>
<!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    // exam paper
    var examPaperAdd = "{{ config('constants.api.exam_paper_add') }}";
    var examPaperList = "{{ route('admin.exam_paper.list') }}";
    var examPaperDetails = "{{ config('constants.api.exam_paper_details') }}";
    var examPaperUpdate = "{{ config('constants.api.exam_paper_update') }}";
    var examPaperDelete = "{{ config('constants.api.exam_paper_delete') }}";
    var classesByAllSubjects = "{{ config('constants.api.classes_by_all_subjects') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_exam_paper') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
    // Get PDF Footer Text

    var header_txt="{{ __('messages.exam_hexam_paperall') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/exam_paper.js') }}"></script>
@endsection