@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.clear_local_storage') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.clear_local_storage') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6">
            <div class="card-box">
                
            <button class="btn btn-primary-bl waves-effect waves-light" id="clear-local-storage" type="button">
                {{ __('messages.clear') }}
            </button>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    <!-- end row -->



</div> <!-- container -->
@endsection


@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    
    $("#clear-local-storage").on('click', function (e) {
        e.preventDefault();
        console.log('test')
        // Clear all items from local storage 
        localStorage.clear(); 
        toastr.success('Local Storages are Cleared');
    });
</script>
@endsection