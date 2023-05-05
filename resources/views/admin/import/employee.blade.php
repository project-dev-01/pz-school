@extends('layouts.admin-layout')
@section('title','Employee Import')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.employee_import') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.employee_import') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="dt-buttons" style="float:right;"> 
                                <a href="{{asset('uploads/Sample Employee.csv')}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.employee.import.add') }}">
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

</div>
<!-- /Page Content -->
@endsection
@section('scripts')
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
@endsection