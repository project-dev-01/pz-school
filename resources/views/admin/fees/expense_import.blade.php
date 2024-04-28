@extends('layouts.admin-layout')
@section('title',' ' . __('messages.import_expense') . '')
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
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1194)">
                                <rect x="12.8" y="10.4097" width="6.4" height="4.8" rx="1" fill="black" />
                                <rect x="12.8" y="16.8096" width="11.2" height="3.2" rx="1" fill="black" />
                                <rect x="12.8" y="21.6094" width="8" height="3.2" rx="1" fill="black" />
                                <rect y="0.80957" width="11.2" height="24" rx="1" fill="black" />
                                <rect x="12.8" y="0.80957" width="11.2" height="3.2" rx="1" fill="black" />
                                <rect x="12.8" y="5.60938" width="11.2" height="3.2" rx="1" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1194">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.80957)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.fees') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.import_expense') }}</a></li>
                </ol>

            </div>  
       
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.expense_import') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="dt-buttons" style="float:right;">
                                <a href="{{ config('constants.image_url').'/common-asset/uploads/Expense Sample.csv'}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
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
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.fees.import.expense.add') }}">
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
@endsection