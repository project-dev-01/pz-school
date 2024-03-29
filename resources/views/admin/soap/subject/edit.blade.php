@extends('layouts.admin-layout')
@section('css')
<style>
            .nav-tabs .nav-link.active {

                border-color: none;
                border: none;
            }

            .nav-tabs .nav-link:hover {
                border-color: none;
                border: none;
            }

            .nav-tabs {
                border-bottom: none;
            }

            .tt-btn-create-topic {
                display: inline-block;
                right: 15px;
                top: 14px;
            }

            .tt-title-border {
                border-bottom: 1px solid #E9D528;
                color: #303344;
                font-size: 18px;
                line-height: 26px;
                font-weight: 500;
                padding: 0 0 23px 0;
                margin-bottom: 21px;
                letter-spacing: 0.01em;
                font-weight:bold;
            }
            .title
            {
                font-weight:bold;  
            }
            
            .form-default .form-control {
                background: #e2e7ea;
                color: #666f74;
                font-family: Cerebri Sans, sans-serif;
                font-size: 16px;
                line-height: 25px;
                border: none;
                -webkit-box-shadow: none;
                box-shadow: none;
                outline: none;
                width: 100%;
                font-weight: 500;
                letter-spacing: 0.01em;
                border-radius: 3px;
                border: 1px solid #e2e7ea;
                -webkit-transition: border-color 0.2s linear;
                transition: border-color 0.2s linear;
            }

            .form-create-topic.form-default .form-group label:not(.error) {
                padding-bottom: 22px;
            }

            .form-default .form-group label:not(.error) {
                font-size: 16px;
                line-height: 26px;
                font-weight: 600;
                color: #182730;
                padding-bottom: 14px;
                margin-bottom: 0;
                letter-spacing: 0.01em;
            }

            .tt-button-icon {
                background-color: #e2e7ea;
                border-radius: 3px;
                border: 2px solid #e2e7ea;
                display: block;
                padding-top: 28px;
                padding-bottom: 19px;
                -webkit-transition: border 0.2s linear;
                transition: border 0.2s linear;
            }

            .tt-button-icon .tt-icon {
                display: block;
                text-align: center;
            }

            .tt-button-icon .tt-text {
                color: #182730;
                display: block;
                text-align: center;
                margin-top: 21px;
                font-weight: 600;
                font-size: 16px;
                letter-spacing: 0.01em;
            }

            .tt-button-icon .tt-icon svg {
                max-width: 78px;
                max-height: 78px;
                fill: #666e74;
            }

            .tt-button-icon .tt-icon {
                display: block;
                text-align: center;
            }

            .svg {
                overflow: hidden;
                vertical-align: middle;
            }

            .pt-editor {
                padding-top: 36px;
            }

            .pt-editor .pt-title {
                color: #182730;
                font-weight: 600;
                font-size: 16px;
                line-height: 26px;
                margin: 0;
                padding: 0 0 50px 0;
                letter-spacing: 0.01em;
            }

            .pt-editor .pt-row {
                padding-bottom: 12px;
            }

            .btn.btn-secondary:hover {
                background-color: #333333;
                color: #ffffff;
            }
            .btn i{
                color:black;
            }
            .note-editable{
                height:200px;
            }
            .pt-editor .pt-title {    
             padding: 0 0 1px 0; 
            }
        </style>
    <link href="{{ asset('libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('title','SOAP')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="margin-top: 25px;">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="home">
                            <div class="container">
                                <div class="tt-wrapper-inner editSoapSubject">
                                    <h1 class="tt-title-border">{{ __('messages.edit_topic') }}</h1>
                                    <form id="editSoapSubjectForm" method="post" action="{{ route('admin.soap_subject.update') }}">
                                        @csrf
                                        <input type="hidden" value="{{$soapsubject['id']}}" name="id">
                                        <div class="form-group">
                                            <label for="title">{{ __('messages.topic_title') }}</label>
                                            <div class="tt-value-wrapper">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('messages.subject_of_your_topic') }}" value="{{$soapsubject['title']}}">
                                                <span class="tt-value-input"></span>
                                            </div>
                                            <div class="tt-note">{{ __('messages.describe_your_topic') }}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="header">{{ __('messages.topic_header') }}</label>
                                            <div class="tt-value-wrapper">
                                                <input type="text" name="header" class="form-control" id="header" placeholder="{{ __('messages.header_of_your_topic') }}" value="{{$soapsubject['header']}}">
                                                <span class="tt-value-input"></span>
                                            </div>
                                            <div class="tt-note">{{ __('messages.describe_your_topic_header') }}..</div>
                                        </div>
                                        <div class="pt-editor">
                                            <h6 class="pt-title">{{ __('messages.topic_body') }}</h6>
                                            <div class="pt-row">
                                                <!-- basic summernote-->
                                                <textarea class="summernote" name="body">{{$soapsubject['title']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="soap_type_id" class="">{{ __('messages.soap_type') }}<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <select id="soap_type_id" class="col-md-6 form-control" name="soap_type_id">
                                                    <option value="">{{ __('messages.select_type') }}</option>
                                                    <option value="1" {{$soapsubject['soap_type_id']=="1" ? 'Selected':''}}>S - Subjective</option>
                                                    <option value="2" {{$soapsubject['soap_type_id']=="2" ? 'Selected':''}}>O - Objective</option>
                                                    <option value="3" {{$soapsubject['soap_type_id']=="3" ? 'Selected':''}}>A - Assessment</option>
                                                    <option value="4" {{$soapsubject['soap_type_id']=="4" ? 'Selected':''}}>P - Plan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-auto ml-md-auto">
                                                <button type="submit" id="search" class="btn btn-secondary" style="background-color: #2172cd;">{{ __('messages.update_post') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
</div>
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
$(document).ready(function() {
$   ('.summernote').summernote();
});
    //soapCategory routes
    var imageUrl = "{{ config('constants.image_url').'/soap/images/' }}";
    var soapIndex = "{{ route('admin.soap') }}";
    var soapDelete = "{{ config('constants.api.soap_delete') }}";
</script>
<!-- Summernote js -->
<script src="{{ asset('libs/summernote/summernote-bs4.min.js') }}"></script>

<script src="{{ asset('js/custom/soap_subject.js') }}"></script>

@endsection