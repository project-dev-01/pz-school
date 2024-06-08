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
<link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .datepicker {
        z-index: 1600 !important;
        /* has to be larger than 1050 */
    }

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
</style>
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                    <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.4847 0.594238H2.65933C1.99223 0.594238 1.35246 0.863608 0.880751 1.34309C0.409043 1.82258 0.144043 2.4729 0.144043 3.15099V12.9519C0.144043 13.63 0.409043 14.2803 0.880751 14.7598C1.35246 15.2393 1.99223 15.5086 2.65933 15.5086H18.4847C19.1517 15.5086 19.7915 15.2393 20.2632 14.7598C20.7349 14.2803 20.9999 13.63 20.9999 12.9519V3.15099C20.9999 2.4729 20.7349 1.82258 20.2632 1.34309C19.7915 0.863608 19.1517 0.594238 18.4847 0.594238ZM6.11784 3.47059C6.49095 3.47059 6.85568 3.58305 7.1659 3.79376C7.47613 4.00446 7.71793 4.30394 7.86071 4.65433C8.00349 5.00472 8.04085 5.39028 7.96806 5.76225C7.89527 6.13422 7.7156 6.4759 7.45177 6.74407C7.18794 7.01225 6.85181 7.19488 6.48587 7.26887C6.11993 7.34286 5.74063 7.30488 5.39592 7.15975C5.05122 7.01461 4.7566 6.76883 4.54931 6.45349C4.34202 6.13815 4.23138 5.76741 4.23138 5.38815C4.23138 4.87958 4.43013 4.39184 4.78391 4.03223C5.13769 3.67262 5.61752 3.47059 6.11784 3.47059ZM2.55452 11.6735C2.55452 10.6846 2.94098 9.73624 3.62889 9.03699C4.31679 8.33774 5.2498 7.9449 6.22265 7.9449C7.19549 7.9449 8.1285 8.33774 8.8164 9.03699C9.50431 9.73624 9.89077 10.6846 9.89077 11.6735H2.55452ZM18.6943 10.7147H12.1964C12.1409 10.7147 12.0875 10.6923 12.0482 10.6523C12.0089 10.6124 11.9868 10.5582 11.9868 10.5017C11.9868 10.4451 12.0089 10.391 12.0482 10.351C12.0875 10.311 12.1409 10.2886 12.1964 10.2886H18.6943C18.7499 10.2886 18.8032 10.311 18.8425 10.351C18.8818 10.391 18.9039 10.4451 18.9039 10.5017C18.9039 10.5582 18.8818 10.6124 18.8425 10.6523C18.8032 10.6923 18.7499 10.7147 18.6943 10.7147ZM18.6943 9.22328H12.1964C12.1409 9.22328 12.0875 9.20083 12.0482 9.16087C12.0089 9.12092 11.9868 9.06673 11.9868 9.01022C11.9868 8.95371 12.0089 8.89952 12.0482 8.85956C12.0875 8.81961 12.1409 8.79716 12.1964 8.79716H18.6943C18.7499 8.79716 18.8032 8.81961 18.8425 8.85956C18.8818 8.89952 18.9039 8.95371 18.9039 9.01022C18.9039 9.06673 18.8818 9.12092 18.8425 9.16087C18.8032 9.20083 18.7499 9.22328 18.6943 9.22328ZM18.6943 7.73184H12.1964C12.1409 7.73184 12.0875 7.70939 12.0482 7.66943C12.0089 7.62948 11.9868 7.57529 11.9868 7.51878C11.9868 7.46227 12.0089 7.40808 12.0482 7.36812C12.0875 7.32817 12.1409 7.30572 12.1964 7.30572H18.6943C18.7499 7.30572 18.8032 7.32817 18.8425 7.36812C18.8818 7.40808 18.9039 7.46227 18.9039 7.51878C18.9039 7.57529 18.8818 7.62948 18.8425 7.66943C18.8032 7.70939 18.7499 7.73184 18.6943 7.73184ZM18.6943 6.2404H12.1964C12.1409 6.2404 12.0875 6.21795 12.0482 6.17799C12.0089 6.13804 11.9868 6.08385 11.9868 6.02734C11.9868 5.97083 12.0089 5.91664 12.0482 5.87668C12.0875 5.83673 12.1409 5.81428 12.1964 5.81428H18.6943C18.7499 5.81428 18.8032 5.83673 18.8425 5.87668C18.8818 5.91664 18.9039 5.97083 18.9039 6.02734C18.9039 6.08385 18.8818 6.13804 18.8425 6.17799C18.8032 6.21795 18.7499 6.2404 18.6943 6.2404Z" fill="#3A4265"></path>
                    </svg>

                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.student_details') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.termination_list') }}</a></li>
                </ol>

            </div>

        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                    <h4 class="nav-link">{{ __('messages.select_ground') }}
                            <h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>             
              
                <div class="card-body collapse show">
                    <form id="applicationFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="academic_year">{{ __('messages.academic_year') }}</label>
                                    <select id="academic_year" name="academic_year" class="form-control">
                                        <option value="">{{ __('messages.admission_select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="academic_grade">{{ __('messages.grade') }}</label>
                                    <select id="academic_grade" name="academic_grade" class="form-control">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse($grade as $g)
                                        <option value="{{$g['id']}}">{{$g['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group text-right m-b-0">
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.termination_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
             
                <div class="card-body collapse show">
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
                                            <th> {{ __('messages.termination_academic_year') }}</th>
                                            <th> {{ __('messages.grade') }}</th>
                                            <th> {{ __('messages.status') }}</th>
                                            <th> {{ __('messages.date_of_termination') }}</th>
                                            <th> {{ __('messages.school_fees_payment_status') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    @include('admin.application.termination')

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
<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;

    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";

    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var terminationDelete = "{{ route('admin.application.delete') }}";
    var terminationList = "{{ route('admin.termination.list') }}";
    var terminationDetails = "{{ config('constants.api.termination_details') }}";

    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_termination') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
</script>
<!-- button js added -->
<script>
    
    function initializeIntlTelInput(inputSelector) {
        var input = document.querySelector(inputSelector);
        intlTelInput(input, {
            allowExtensions: true,
            autoFormat: false,
            autoHideDialCode: false,
            autoPlaceholder: false,
            defaultCountry: "auto",
            ipinfoToken: "yolo",
            nationalMode: false,
            numberType: "MOBILE",
            initialCountry: "my",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            preferredCountries: ['my', 'jp'],
            preventInvalidNumbers: true,
            // utilsScript: "js/utils.js"
        });
    }

initializeIntlTelInput("#transfer_destination_tel");
initializeIntlTelInput("#parent_phone_number_after_transfer");
</script>
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('js/custom/admin_termination.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection