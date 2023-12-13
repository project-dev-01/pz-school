@extends('layouts.admin-layout')
@section('title',' ' . __('messages.add_email_template') . '')
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
        <!-- Summernote css -->
        <link href="{{ asset('libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('css')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
 .ck-editor__editable
 {
    min-height: 250px !important;
 }
    .dot {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .ui-datepicker {
        width: 21.4em;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
        .ui-datepicker {
            width: 14.4em;
        }
    }

    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
        .ui-datepicker {
            width: 17.4em;
        }
    }

    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
        .ui-datepicker {
            width: 18.6em;
        }
    }

    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .ui-datepicker {
            width: 19.8em;
        }
    }

    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
        .ui-datepicker {
            width: 21.5em;
        }
    }

    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
        .ui-datepicker {
            width: 31.3em;
        }
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .ui-datepicker {
            width: 13.2em;
        }
    }

    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
        .ui-datepicker {
            width: 14.3em;
        }
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.email_template') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.add_email_template') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="emailTemplateForm" method="post" action="{{ route('admin.email_template.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type_id">{{ __('messages.email_type') }}</label>
                                    <select class="form-control" id="type_id" name="type_id">
                                        <option value="">{{ __('messages.select_email_type') }}</option>
                                        @forelse($email_type as $type)
                                        <option value="{{$type['id']}}">{{$type['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">{{ __('messages.subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="{{ __('messages.enter_subject') }}">
                                    <span class="text-danger error-text subject_error"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="template_body">{{ __('messages.template_body') }} <span class="text-danger">*</span></label>
                                    
                                        <!-- basic summernote-->
                                        <!-- <div id="summernote-basic"></div> -->
                                        
							            <textarea name="template_body" id="summernote-basic" class="summernote"></textarea>
                                    <span class="text-danger error-text template_body_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-md">
                            <strong>Dynamic Tag : </strong>
                            <a data-value="{name}" class="btn btn-light btn-xs btn_tag">{name}</a>
                            <a data-value="{email}" class="btn btn-light btn-xs btn_tag">{email}</a>
                            <a data-value="{mobile_no}" class="btn btn-light btn-xs btn_tag">{mobile_no}</a>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.submit') }}</button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
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
</script>
<!-- button js added -->
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>


        <!-- Summernote js -->
<script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('js/pages/form-summernote.init.js') }}"></script>


<script>
    //email Template routes
    var emailTemplateIndex = "{{ route('admin.email_template') }}";
    var emailTemplateList = "{{ route('admin.email_template.list') }}";
    var emailTemplateDetails = "{{ route('admin.email_template.details') }}";
    var emailTemplateDelete = "{{ route('admin.email_template.delete') }}";
    // lang name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_email_template') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.email_template') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/email_template.js') }}"></script>

<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
@endsection