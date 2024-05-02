@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.event_type') . '')
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
@endsection
@section('css')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<style>
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
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2234)">
                                <path d="M2.28743e-05 9.70142H24V22.9527C24.0181 23.3693 23.8836 23.7787 23.6202 24.1096C23.3568 24.4406 22.9811 24.6719 22.5587 24.7634C22.4013 24.7961 22.2405 24.8115 22.0795 24.8095H1.92449C1.49161 24.8273 1.06609 24.6975 0.722831 24.443C0.379572 24.1884 0.140584 23.8254 0.0479331 23.4179C0.014236 23.2715 -0.00183866 23.1219 2.28743e-05 22.972V9.70142ZM12.0819 11.5736C11.9309 11.5694 11.7821 11.6094 11.6552 11.6884C11.5283 11.7673 11.4293 11.8814 11.3712 12.0157C11.0118 12.7115 10.6445 13.4035 10.2892 14.0993C10.2291 14.2268 10.135 14.3366 10.0164 14.4176C9.89789 14.4987 9.75917 14.548 9.61439 14.5606L7.30263 14.8797C7.15318 14.8875 7.0099 14.9397 6.89261 15.0292C6.77532 15.1187 6.68979 15.2411 6.64783 15.3795C6.60182 15.5152 6.59929 15.6611 6.64059 15.7982C6.6819 15.9354 6.76511 16.0573 6.87941 16.1483C7.44637 16.6635 8.00534 17.1863 8.56831 17.686C8.68001 17.7795 8.76345 17.9003 8.80983 18.0356C8.85621 18.1709 8.86381 18.3158 8.83183 18.4549C8.69209 19.2238 8.55633 19.9926 8.43256 20.7615C8.40654 20.9234 8.43013 21.089 8.50044 21.2382C8.54584 21.3271 8.61036 21.4058 8.68971 21.4689C8.76906 21.532 8.86143 21.5782 8.96071 21.6044C9.05999 21.6305 9.16391 21.6361 9.26559 21.6207C9.36727 21.6053 9.46439 21.5692 9.55051 21.515C10.2412 21.1651 10.932 20.8191 11.6147 20.4616C11.7538 20.3825 11.9124 20.3407 12.0739 20.3407C12.2354 20.3407 12.394 20.3825 12.533 20.4616C13.2038 20.8102 13.8786 21.1536 14.5573 21.4919C14.6653 21.5505 14.7852 21.5859 14.9087 21.5957C15.0277 21.6049 15.1472 21.586 15.2569 21.5407C15.3666 21.4953 15.4632 21.4249 15.5383 21.3356C15.6134 21.2462 15.6648 21.1406 15.688 21.0279C15.7111 20.9151 15.7054 20.7986 15.6713 20.6884C15.5475 19.9696 15.4277 19.2468 15.272 18.5318C15.2324 18.3737 15.239 18.2081 15.2911 18.0533C15.3433 17.8986 15.4389 17.7608 15.5675 17.6553C16.1344 17.1478 16.6854 16.625 17.2444 16.1176C17.3417 16.0419 17.4174 15.9436 17.4642 15.8319C17.511 15.7202 17.5274 15.5989 17.5119 15.4794C17.4923 15.3006 17.4048 15.1351 17.2663 15.0145C17.1278 14.8939 16.948 14.8268 16.7613 14.8259L14.4615 14.5145C14.3087 14.5009 14.1626 14.4476 14.0388 14.3603C13.915 14.2729 13.8182 14.1548 13.7588 14.0186C13.4234 13.3497 13.0761 12.6846 12.7327 12.0157C12.6786 11.8904 12.5888 11.7823 12.4736 11.7041C12.3584 11.6259 12.2226 11.5806 12.0819 11.5736Z" fill="#3A4265" />
                                <path d="M0.01999 7.91378C0.01999 7.25256 -0.00795873 6.59133 0.01999 5.93395C0.056096 5.55371 0.222993 5.19596 0.494218 4.91741C0.765444 4.63885 1.12548 4.45543 1.51724 4.39623C1.64936 4.37648 1.78282 4.36621 1.91651 4.36548H4.60359V1.75135C4.58506 1.51634 4.66425 1.28386 4.82374 1.10507C4.98323 0.926273 5.20995 0.815805 5.45403 0.797962C5.69811 0.78012 5.93956 0.856361 6.12525 1.00992C6.31095 1.16348 6.42568 1.38179 6.44422 1.6168C6.4483 1.69236 6.4483 1.76806 6.44422 1.84361V4.35395H17.5079V4.18095C17.5079 3.37749 17.5079 2.57787 17.5079 1.77826C17.5021 1.54171 17.5941 1.31264 17.7637 1.14141C17.9333 0.970189 18.1666 0.870841 18.4123 0.865233C18.6579 0.859625 18.8959 0.948214 19.0737 1.11151C19.2515 1.2748 19.3547 1.49943 19.3605 1.73597C19.3605 2.54712 19.3605 3.35827 19.3605 4.16941V4.36548H22.0676C22.3206 4.35688 22.5728 4.39854 22.8083 4.48784C23.0439 4.57715 23.2579 4.71219 23.4369 4.88457C23.616 5.05695 23.7562 5.26297 23.849 5.4898C23.9417 5.71664 23.985 5.95943 23.9761 6.20306C23.9761 6.76817 23.9761 7.33328 23.9761 7.90993L0.01999 7.91378Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2234">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.events') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.event_type') }}</a></li>
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
                                {{ __('messages.event_type') }}
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
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addEventTypeModal">{{ __('messages.add') }}</button>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table dt-responsive nowrap w-100" id="event-type-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.event_type_name') }}</th>
                                    <th>{{ __('messages.color') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!--- end row -->
        @include('admin.event_type.add')
        @include('admin.event_type.edit')
    </div>
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
<script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('js/pages/form-pickers.init.js') }}"></script>

<script>
    //eventType routes
    var eventTypeList = "{{ route('admin.event_type.list') }}";
    var eventTypeDetails = "{{ route('admin.event_type.details') }}";
    var eventTypeDelete = "{{ route('admin.event_type.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_event_type') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end
    
    // Get PDF Footer Text
    var header_txt="{{ __('messages.event_type') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>  
<script src="{{ asset('js/custom/event_type.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endif
@endsection