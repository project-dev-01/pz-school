@extends('layouts.admin-layout')
@section('title',' ' . __('messages.termination') . '')
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
<style>
    fieldset {
        display: none;
    }

    fieldset.show {
        display: block;
    }


    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer;
    }

    .tabs:hover,
    .tabs.active {
        border-bottom: 1px solid #2196F3;
    }

    a:hover {
        text-decoration: none;
        color: #1565C0;
    }

    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%;
    }

    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px;
        }
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
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/parent_responsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.termination_list') }}</h4>
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
                            {{ __('messages.termination_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="termination-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.control_number') }}</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.name_english') }}</th>
                                            <th> {{ __('messages.gender') }}</th>
                                            <th> {{ __('messages.email') }}</th>
                                            <th> {{ __('messages.academic_year') }}</th>
                                            <th> {{ __('messages.grade') }}</th>
                                            <th> {{ __('messages.status') }}</th>
                                            <th> {{ __('messages.date_of_termination') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
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

    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";

    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var terminationDelete = "{{ route('parent.termination.delete') }}";
    var terminationList = "{{ route('parent.termination.list') }}";
    var terminationDetails = "{{ config('constants.api.termination_details') }}";

    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_termination') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('js/custom/parent_termination.js') }}"></script>

@endsection