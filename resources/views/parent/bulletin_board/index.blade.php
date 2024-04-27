@extends('layouts.admin-layout')
@section('title',' ' . __('messages.buletin') . '')
@section('component_css')

<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
<style>
    .datepicker {
        z-index: 99999 !important;
    }

    .pdf-icon {
        color: #FF0000;
        /* Red color for PDF icon */
        font-size: 24px;
        /* Adjust the font size of the icon */
    }

    .pdf-file {
        font-weight: bold;
        /* Bold font for the file name */
        color: #0000FF;
        /* Blue color for PDF file name */
    }

    .star-button {
        font-size: 24px;
        border: none;
        background: none;
        cursor: pointer;
    }

    .star-button::before {
        content: '☆';
        color: gray;
    }

    .star-button.star-important::before {
        content: '★';
        color: gold;
    }

    /* Style for the tabs */
    .tabs {
        display: flex;
        justify-content: space-between;
        /* Adjust spacing between buttons */
        margin-bottom: 20px;
        /* Adjust as needed */
        margin-right: 774px;
    }

    /* Style for the tab buttons */
    .tablink {
        border-color: #0ABAB5;
        background-color: #6FC6CC;
        border: none;
        /* Remove border */
        color: black;
        /* Text color */
        padding: 10px 20px;
        /* Padding */
        cursor: pointer;
        /* Cursor style */
        transition: background-color 0.3s;
        /* Transition effect on hover */
        float: left;
        /* Float left */
    }

    /* Change background color on hover */
    .tablink:hover {
        background-color: #0ABAB5;
    }

    /* Style for the active tab */
    .tablink.active {
        background-color: #0ABAB5;
    }

    #Important {
        display: none;
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 653px) {
        .nav {
            display: block;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .nav-item {
            margin-bottom: 10px;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1200px) {
        .dt-buttons {
            margin-left: 56px;
        }

        div.dt-buttons {
            display: flex;
        }
    }
</style>
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg class="svg-icon" style="width: 20px; height: 20px; fill: #3A4265;" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                        <path d="M513.706667 106.666667L406.613333 213.333333h213.333334l-106.24-106.666666M170.666667 298.666667v554.666666h682.666666V298.666667H170.666667m341.333333-298.666667l213.333333 213.333333h128a85.333333 85.333333 0 0 1 85.333334 85.333334v554.666666a85.333333 85.333333 0 0 1-85.333334 85.333334H170.666667a85.333333 85.333333 0 0 1-85.333334-85.333334V298.666667a85.333333 85.333333 0 0 1 85.333334-85.333334h128l213.333333-213.333333M298.666667 768v-170.666667h213.333333v170.666667H298.666667m298.666666-42.666667v-298.666666h170.666667v298.666666h-170.666667m-341.333333-213.333333V384h213.333333v128H256z" />
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.buletin') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- Add the search input here -->
    <div class="card-box">
        <div class="row">
            <div class="col-lg-3">
                <label for="employee_type">{{ __('messages.search') }}</label>
                <input type="text" class="form-control" id="pdfSearchInput" placeholder="{{ __('messages.search_pdf_files') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="nav-link">{{ __('messages.buletin') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1"  aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">             
                <ul class="nav nav-pills navtab-bg nav-justified" id="myTabs" style="padding: 0px 20px 0px 20px;">
                    <li class="nav-item">
                        <a href="#home1" id="tab1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            {{ __('messages.buletin') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" id="tab2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            {{ __('messages.imp_buletin') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="home1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="parent-bulletin-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.title') }}</th>
                                                    <th>{{ __('messages.file') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Your Bulletin Board table content here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end col-->
                        </div>
                    </div> <!-- end card-->


                    <div class="tab-pane show active" id="profile1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table w-100 nowrap" id="parent-bulletin-imp-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.title') }}</th>
                                                    <th>{{ __('messages.file') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Your Bulletin Board table content here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end col-->
                        </div>
                    </div>
                </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div> <!-- end card-box -->
</div> <!-- end col -->
</div>
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">{{ __('messages.file_details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card-box eventpopup" style="background-color: #8adfee14;">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap">
                                    <tr>
                                        <td>{{ __('messages.title') }}</td>
                                        <td id="fileTitle"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td id="fileDescription"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.file_download') }}</td>
                                        <td class="publish_date"><a id="downloadLink" href="#" download>{{ __('messages.download') }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.preview') }}</td>
                                        <td class="target_user"><a href="#" id="previewLink" target="_blank">{{ __('messages.preview') }}</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <iframe id="filePreview" src="" style="display: none; width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>
</div>
</div>
<!--- end row -->
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
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<link rel="preload" href="{{ asset('buttons-datatables/vfs_fonts.js') }}" as="script">
<!-- <script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script> -->

<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    //event routes
    var parentList = "{{ route('parent.buletin_board.list') }}";
    var starRoute = "{{ route('parent.buletin_board.star') }}";
    var importantList = "{{ route('parent.buletin_board.imp_list') }}";
    // Get PDF Footer Text
    var header_txt = "{{ __('messages.event') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    var pdfPath = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/buletin_files' }}";
</script>
<script src="{{ asset('js/custom/parent_bulletin.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection