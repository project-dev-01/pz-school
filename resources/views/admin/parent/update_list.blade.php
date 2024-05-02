@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.parent_update_list') . '')
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
                <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_183_477)">
                                <path d="M0 18.9996C0.0521565 18.6286 0.0962869 18.2577 0.148443 17.9127C0.294192 16.9248 0.537261 15.9513 0.874621 15.0043C1.23927 13.9275 1.81449 12.9216 2.57172 12.0367C3.46053 10.9922 4.72431 10.2763 6.13441 10.0186C7.69185 9.69498 9.32112 9.85267 10.7723 10.4675C11.53 10.8075 12.2045 11.2872 12.7543 11.8772C13.2132 12.3634 13.6028 12.9019 13.9137 13.4797L13.9779 13.591C14.284 13.2526 14.6359 12.9521 15.0251 12.697C15.7892 12.2116 16.6865 11.9364 17.6128 11.9031C18.3739 11.8523 19.1385 11.9392 19.8636 12.1591C20.7852 12.4586 21.5877 13.008 22.1665 13.7357C22.7898 14.5279 23.2433 15.4232 23.5025 16.3732C23.7288 17.1476 23.8858 17.938 23.9719 18.7362C23.9719 18.8215 23.992 18.9068 24 18.9959L0 18.9996Z" fill="#3A4265" />
                                <path d="M7.76333 8.64601C6.8733 8.64747 6.0028 8.40474 5.26205 7.94853C4.5213 7.49232 3.94361 6.84315 3.60209 6.08321C3.26057 5.32326 3.17059 4.48672 3.34355 3.67947C3.5165 2.87222 3.94461 2.13056 4.57368 1.5484C5.20275 0.966235 6.00448 0.569737 6.87739 0.409099C7.7503 0.248461 8.65513 0.330904 9.47733 0.645998C10.2995 0.961091 11.0022 1.49467 11.4962 2.17917C11.9903 2.86367 12.2536 3.66832 12.2528 4.49126C12.2517 5.59222 11.7785 6.64787 10.9369 7.42671C10.0953 8.20556 8.95405 8.64404 7.76333 8.64601Z" fill="#3A4265" />
                                <path d="M18.018 4.35802C18.7079 4.35949 19.3818 4.55018 19.9544 4.90595C20.527 5.26172 20.9726 5.76657 21.2348 6.35661C21.497 6.94664 21.5639 7.59533 21.4272 8.22056C21.2905 8.8458 20.9562 9.41946 20.4667 9.86896C19.9772 10.3185 19.3544 10.6236 18.6773 10.7457C18.0001 10.8678 17.299 10.8014 16.6627 10.5549C16.0264 10.3084 15.4835 9.89293 15.1027 9.36102C14.7219 8.82911 14.5203 8.20469 14.5235 7.56681C14.5229 7.14341 14.6131 6.7241 14.7888 6.33311C14.9646 5.94212 15.2223 5.58719 15.5472 5.28883C15.8722 4.99048 16.2578 4.75461 16.6819 4.59485C17.106 4.43508 17.5601 4.35458 18.018 4.35802Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_183_477">
                                    <rect width="24" height="18.6667" fill="white" transform="translate(0 0.333008)" />
                                </clipPath>
                            </defs>
                        </svg>

                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.parent_guardian_details') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.parent_update_list') }}</a></li>
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
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.parent_update_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
             
                <div class="card-body collapse show">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table w-100 nowrap" id="parent-update-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('messages.name') }}</th>
                                                <th> {{ __('messages.email') }}</th>
                                                <th> {{ __('messages.status') }}</th>
                                                <th> {{ __('messages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentUpdateList = "{{ route('admin.parent.update_info_list') }}";
    var parentList = "{{ route('admin.parent.list') }}";
    var parentDelete = "{{ route('admin.parent.delete') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_Parent') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end// Get PDF Footer Text
 // Get PDF Footer Text
    var header_txt="{{ __('messages.parent_list') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/parent_update.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection