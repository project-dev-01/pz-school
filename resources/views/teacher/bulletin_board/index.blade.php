@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.buletin') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

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
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
    .datepicker {
        z-index: 99999 !important;
    }
    .pdf-icon {
    color: #FF0000; /* Red color for PDF icon */
    font-size: 24px; /* Adjust the font size of the icon */
}

.pdf-file {
    font-weight: bold; /* Bold font for the file name */
    color: #0000FF; /* Blue color for PDF file name */
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
    justify-content: space-between; /* Adjust spacing between buttons */
    margin-bottom: 20px; /* Adjust as needed */
    margin-right: 774px;
}

/* Style for the tab buttons */
.tablink {
    border-color: #0ABAB5;
    background-color: #6FC6CC;
    border: none; /* Remove border */
    color: black; /* Text color */
    padding: 10px 20px; /* Padding */
    cursor: pointer; /* Cursor style */
    transition: background-color 0.3s; /* Transition effect on hover */
    float: left; /* Float left */
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
</style>
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.list') }}</li>
                        <!-- <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.buletin') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- Add the search input here -->
    <div class="card-box">
                    <div class="row">
                        <div class="col-lg-3">
                        <label for="employee_type">{{ __('messages.search') }}</label>
                            <input type="text" class="form-control" id="pdfSearchInput" placeholder="{{ __('messages.search_pdf_file') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
            <div class="card-box">
            <div class="card-body">
                <div class="col-xl-12">
                                    <ul class="nav nav-pills navtab-bg nav-justified" id="myTabs">
                                        <li class="nav-item">
                                            <a href="#home1" id="tab1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            {{ __('messages.buletin') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#profile1" id="tab2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            {{ __('messages.important') }}
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="home1">
                                        <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.buletin') }}
                        <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                            <div class="col-sm-6 col-md-6">
                                        
                            </div>
                            </div>
                                <table class="table w-100 nowrap" id="teacher-bulletin-table">
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
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
                                           
                                       
                                        <div class="tab-pane show active" id="profile1">
                                                                                  <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.imp_buletin') }}
                        <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                            <div class="col-sm-6 col-md-6">
                                        
                            
                            </div>
                            </div>
                                <table class="table w-100 nowrap" id="teacher-bulletin-imp-table">
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
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->  
                                        </div>
                                        </div>
                                    </div>
                </div> <!-- end col -->
                    
                </div>
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
                                        <td  id="fileTitle"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.description') }}</td>
                                        <td id="fileDescription"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.download') }}</td>
                                        <td class="publish_date"><a id="downloadLink" href="#" download>{{ __('messages.sownload') }}</a></td>
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
</div>
<!-- container -->

@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
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
  //event routes
    var teacherList = "{{ route('teacher.buletin_board.list') }}";
    var starRoute = "{{ route('teacher.buletin_board.star') }}";
    var importantList = "{{ route('teacher.buletin_board.imp_list') }}";
    // Get PDF Footer Text
    var header_txt="{{ __('messages.event') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    var pdfPath = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/admin-documents/buletin_files' }}";
    
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/teacher_bulletin.js') }}"></script>

@endsection