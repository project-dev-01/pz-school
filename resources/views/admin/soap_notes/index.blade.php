@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.notes') . '')
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
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1182)">
                                <path d="M11.985 18.6498C10.3017 18.6498 8.61853 18.6498 6.93364 18.6498C6.75689 18.6497 6.58206 18.6119 6.41998 18.5387C6.29248 18.4786 6.1851 18.3804 6.11151 18.2568C6.03792 18.1332 6.00143 17.9897 6.0067 17.8445C5.99331 17.2943 6.0067 16.7424 6.0067 16.1922C6.0067 15.2966 5.9816 14.3993 6.0067 13.5054C6.05522 12.2488 6.68769 11.3828 7.78027 10.869C8.08063 10.7293 8.40647 10.6583 8.73564 10.6608C10.9359 10.6608 13.1361 10.6451 15.3363 10.6608C15.9275 10.6752 16.4977 10.8913 16.9586 11.2756C17.4195 11.6599 17.7455 12.1911 17.8862 12.7869C17.952 13.0635 17.9862 13.3472 17.9883 13.6321C17.9983 14.9876 17.9883 16.3449 17.9883 17.7004C17.9883 18.0736 17.8779 18.3947 17.5349 18.5491C17.3794 18.6152 17.2125 18.6471 17.0446 18.6429C15.3631 18.6533 13.6732 18.6498 11.985 18.6498Z" fill="#3A4265" />
                                <path d="M11.8929 8.95096C11.0146 8.95626 10.1629 8.63855 9.489 8.05421C8.81511 7.46988 8.36263 6.65674 8.21191 5.75915C8.04063 4.90628 8.14182 4.01875 8.50017 3.23084C8.85851 2.44294 9.4545 1.79756 10.198 1.39234C10.6761 1.13912 11.2011 0.995308 11.7374 0.970622C12.2737 0.945936 12.8089 1.04095 13.3068 1.24925C13.8047 1.45755 14.2537 1.77427 14.6234 2.17803C14.9932 2.58178 15.2751 3.06316 15.4501 3.58963C15.7771 4.53071 15.7563 5.56415 15.3917 6.49025C15.027 7.41635 14.3444 8.16938 13.4757 8.60383C12.9801 8.84201 12.439 8.96069 11.8929 8.95096Z" fill="#3A4265" />
                                <path d="M4.72339 11.0059C3.97111 10.9863 3.2516 10.6825 2.7 10.1515C2.14839 9.62052 1.80264 8.89892 1.72766 8.1222C1.65268 7.34548 1.85363 6.56709 2.29278 5.9332C2.73194 5.29931 3.37908 4.85353 4.11267 4.67958C4.585 4.55942 5.07963 4.57163 5.54591 4.71497C6.01219 4.8583 6.43338 5.12761 6.76634 5.49532C7.69829 6.46726 7.97269 7.64054 7.49584 8.92837C7.31137 9.47074 6.98615 9.94977 6.556 10.3127C6.12586 10.6756 5.6075 10.9082 5.05802 10.9851C4.94696 10.9987 4.83523 11.0057 4.72339 11.0059Z" fill="#3A4265" />
                                <path d="M19.198 11.0198C18.6257 11.0012 18.0695 10.8187 17.591 10.4924C17.1125 10.1662 16.7304 9.70891 16.487 9.17127C16.2437 8.63364 16.1485 8.03661 16.212 7.44632C16.2756 6.85603 16.4954 6.2955 16.8472 5.82682C17.0904 5.4815 17.4022 5.19434 17.7616 4.98475C18.1209 4.77515 18.5195 4.648 18.9303 4.61188C20.5081 4.45394 21.9002 5.67755 22.1528 7.26564C22.2695 8.07462 22.0895 8.89959 21.6484 9.57761C21.2073 10.2556 20.5371 10.7374 19.7702 10.9278C19.5828 10.9816 19.3887 10.9937 19.198 11.0198Z" fill="#3A4265" />
                                <path d="M19.5711 18.5593C19.6163 18.2798 19.6698 18.0108 19.6983 17.7401C19.7131 17.5409 19.717 17.3409 19.71 17.1413C19.71 16.0288 19.7251 14.918 19.71 13.8072C19.7016 13.316 19.623 12.8248 19.5745 12.3336C19.5745 12.2833 19.5594 12.2347 19.5494 12.1601H21.599C21.9147 12.1542 22.2283 12.2143 22.5212 12.3366C22.8141 12.459 23.0803 12.6412 23.304 12.8724C23.5277 13.1036 23.7042 13.3791 23.8232 13.6825C23.9422 13.9859 24.0012 14.311 23.9967 14.6385C23.9967 15.6139 23.9967 16.5911 23.9967 17.5665C23.9954 17.8299 23.8943 18.0821 23.7152 18.2689C23.5362 18.4556 23.2935 18.5618 23.0396 18.5645C21.9253 18.5437 20.8109 18.5645 19.6933 18.5645L19.5711 18.5593Z" fill="#3A4265" />
                                <path d="M4.45232 12.1723C4.42889 12.2434 4.41049 12.3042 4.39041 12.3632C4.26044 12.7424 4.22419 13.1494 4.285 13.5469C4.28893 13.6046 4.28893 13.6626 4.285 13.7204C4.285 15.1228 4.285 16.524 4.285 17.9241C4.285 18.1289 4.31009 18.332 4.32515 18.5489C4.29336 18.5489 4.24819 18.5489 4.20301 18.5489C3.11211 18.5489 2.02789 18.5333 0.931963 18.5489C0.684189 18.5398 0.448972 18.4335 0.273815 18.2515C0.0986583 18.0695 -0.00338759 17.8253 -0.011709 17.5683C0.0133886 16.5686 -0.011709 15.5671 -0.011709 14.5657C-0.0235154 14.0125 0.151986 13.4725 0.484279 13.0396C0.816572 12.6068 1.28463 12.3085 1.80703 12.1966C1.92864 12.1657 2.05327 12.1494 2.17847 12.1479C2.89291 12.1479 3.60737 12.1479 4.32014 12.1479C4.37201 12.1618 4.39877 12.167 4.45232 12.1723Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1182">
                                    <rect width="24" height="17.6842" fill="white" transform="translate(0 0.967285)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.soap') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.notes') }} </a></li>
                </ol>

            </div>    
          
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.soap_notes') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                <div class="card-body collapse show">
                <div class="form-group pull-right">
                    <div class="">
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addSoapNotesModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="soap-notes-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>{{ __('messages.sub_category') }} </th>
                                    <th>{{ __('messages.notes') }} </th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('admin.soap_notes.add')
    @include('admin.soap_notes.edit')
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    //soapNotes routes
    var soapNotesList = "{{ route('admin.soap_notes.list') }}";
    var soapNotesDetails = "{{ route('admin.soap_notes.details') }}";
    var soapNotesDelete = "{{ route('admin.soap_notes.delete') }}";
    var categoryList = "{{ config('constants.api.category_list_by_soap_type') }}";
    var subCategoryList = "{{ config('constants.api.sub_category_list_by_category') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_event_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
    // Get PDF Footer Text

    var header_txt="{{ __('messages.soap_sub_category') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/soap_notes.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection