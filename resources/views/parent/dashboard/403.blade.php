@extends('layouts.admin-layout')
@section('title',' ' . __('messages.access_denied') . '')
@section('calendar')
<!-- full calendar css start-->
<link href="{{ asset('libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/@fullcalendar/list/main.min.css') }}" rel="stylesheet" type="text/css" />
<!-- full calendar css end-->
@endsection
@section('component_css')

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
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="#3A4265" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.33333 13.3333H9.33333C9.68696 13.3333 10.0261 13.1929 10.2761 12.9428C10.5262 12.6928 10.6667 12.3536 10.6667 12V1.33333C10.6667 0.979711 10.5262 0.640573 10.2761 0.390524C10.0261 0.140476 9.68696 0 9.33333 0H1.33333C0.979711 0 0.640573 0.140476 0.390524 0.390524C0.140476 0.640573 0 0.979711 0 1.33333V12C0 12.3536 0.140476 12.6928 0.390524 12.9428C0.640573 13.1929 0.979711 13.3333 1.33333 13.3333ZM0 22.6667C0 23.0203 0.140476 23.3594 0.390524 23.6095C0.640573 23.8595 0.979711 24 1.33333 24H9.33333C9.68696 24 10.0261 23.8595 10.2761 23.6095C10.5262 23.3594 10.6667 23.0203 10.6667 22.6667V17.3333C10.6667 16.9797 10.5262 16.6406 10.2761 16.3905C10.0261 16.1405 9.68696 16 9.33333 16H1.33333C0.979711 16 0.640573 16.1405 0.390524 16.3905C0.140476 16.6406 0 16.9797 0 17.3333V22.6667ZM13.3333 22.6667C13.3333 23.0203 13.4738 23.3594 13.7239 23.6095C13.9739 23.8595 14.313 24 14.6667 24H22.6667C23.0203 24 23.3594 23.8595 23.6095 23.6095C23.8595 23.3594 24 23.0203 24 22.6667V13.3333C24 12.9797 23.8595 12.6406 23.6095 12.3905C23.3594 12.1405 23.0203 12 22.6667 12H14.6667C14.313 12 13.9739 12.1405 13.7239 12.3905C13.4738 12.6406 13.3333 12.9797 13.3333 13.3333V22.6667ZM14.6667 9.33333H22.6667C23.0203 9.33333 23.3594 9.19286 23.6095 8.94281C23.8595 8.69276 24 8.35362 24 8V1.33333C24 0.979711 23.8595 0.640573 23.6095 0.390524C23.3594 0.140476 23.0203 0 22.6667 0H14.6667C14.313 0 13.9739 0.140476 13.7239 0.390524C13.4738 0.640573 13.3333 0.979711 13.3333 1.33333V8C13.3333 8.35362 13.4738 8.69276 13.7239 8.94281C13.9739 9.19286 14.313 9.33333 14.6667 9.33333Z" />
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.access_denied') }}</h4>
            </div>
        </div>
    </div>
   
    <div class="row" id="hideGreeting">
        <div class="col-md-12 col-xl-12">
            <div class="widget-rounded-circle card-box">
                <div class="card-widgets">
                    <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                </div>
                <img src="{{asset('images/403.jpg')}}" class="img-responsive img-fluid">
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
   
</div> <!-- container -->
@endsection
@section('scripts')

<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- Chart JS -->

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>


@endsection