@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.to_do_list') . '')
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
<!-- <style>
    /* checklist css start  */
    li>p {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }

    .done {
        text-decoration: line-through;
        color: gray;
    }

    /* checklist end  */
    /* files add remove css start  */
    #files-area {
        width: 93%;
        margin: 0 auto;
    }

    .file-block {
        border-radius: 10px;
        background-color: rgba(144, 163, 203, 0.2);
        margin: 5px;
        color: initial;
        display: inline-flex;
    }

    .file-block>span.name {
        padding-right: 10px;
        width: max-content;
        display: inline-flex;
    }

    .file-delete {
        display: flex;
        width: 24px;
        color: initial;
        background-color: #6eb4ff00;
        font-size: large;
        justify-content: center;
        margin-right: 3px;
        cursor: pointer;
    }

    .file-delete:hover {
        background-color: rgba(144, 163, 203, 0.2);
        border-radius: 10px;
    }

    .file-delete>span {
        transform: rotate(45deg);
    }

    /* files add remove css end  */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: blue !important;
    }
</style> -->
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
                            <path d="M4.40087 0.864441V2.21359C4.39407 2.49344 4.44513 2.7717 4.55081 3.03102C4.65649 3.29035 4.81453 3.52521 5.01515 3.72097C5.33433 4.02942 5.74738 4.22314 6.18914 4.27158C6.63089 4.32002 7.07624 4.22042 7.45497 3.98849C7.76124 3.80698 8.01252 3.54612 8.18211 3.23361C8.35171 2.92111 8.43328 2.56862 8.41819 2.21359C8.41819 1.81949 8.41819 1.42251 8.41819 1.0284V0.864441H15.5818V1.1032C15.5818 1.55196 15.5819 2.00072 15.5992 2.44948C15.6835 2.9343 15.9429 3.37155 16.3283 3.67863C16.7138 3.98572 17.1986 4.14139 17.6913 4.11625C18.184 4.09111 18.6503 3.88691 19.0024 3.54219C19.3544 3.19748 19.5677 2.73611 19.602 2.24524C19.602 1.79072 19.602 1.33621 19.602 0.870191C19.6424 0.870191 19.6799 0.870191 19.7174 0.870191C20.4672 0.870191 21.2141 0.870191 21.9611 0.870191C22.4311 0.865816 22.888 1.0252 23.2529 1.32086C23.6177 1.61652 23.8677 2.02992 23.9597 2.48975C23.9866 2.6407 23.9991 2.79384 23.9971 2.94714C23.9971 8.8328 23.9971 14.7194 23.9971 20.607C24.0052 20.8816 23.9567 21.155 23.8548 21.4103C23.753 21.6656 23.5998 21.8974 23.4047 22.0914C23.2097 22.2854 22.9769 22.4376 22.7207 22.5385C22.4645 22.6394 22.1903 22.6869 21.915 22.6782H2.08222C1.80715 22.6869 1.53318 22.6394 1.27718 22.5387C1.02117 22.438 0.788519 22.2861 0.593511 22.0924C0.398503 21.8987 0.245239 21.6672 0.14318 21.4123C0.0411206 21.1573 -0.00756946 20.8843 3.98242e-05 20.6099C3.98242e-05 14.7204 3.98242e-05 8.8328 3.98242e-05 2.94714C-0.00492326 2.67848 0.0434605 2.41148 0.142405 2.16156C0.24135 1.91163 0.388892 1.6837 0.576543 1.49091C0.764193 1.29812 0.988214 1.14427 1.23574 1.03823C1.48327 0.932189 1.74941 0.876061 2.01879 0.873071C2.77726 0.873071 3.53281 0.873071 4.29128 0.873071L4.40087 0.864441ZM19.7808 15.6591H11.8587V17.1435H19.7808V15.6591ZM11.8558 9.65552H19.778V8.17691H11.8558V9.65552ZM8.16729 13.9964L5.94669 16.0705L4.91999 15.0119L3.83852 16.0561L5.89476 18.1791L9.19972 15.0982L8.16729 13.9964ZM5.94669 8.99389C5.60061 8.63718 5.26029 8.2891 4.91999 7.93528L3.83852 8.97951L5.89476 11.1054L9.19972 8.02445L8.16729 6.92844L5.94669 8.99389Z" fill="black" />
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.tasks') }} </a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.to_do_list') }}</a></li>
                </ol>

            </div> 
         
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.to_do_list') }}<h4>
                    </li>
                </ul><br>
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <button type="button" class="btn add-btn btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addToDoTask">Add</button> -->
                        <a type="button" class="btn add-btn btn-rounded waves-effect waves-light" href="{{ route('admin.task.create')}}">{{ __('messages.add') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap" id="to-do-list-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.date') }} & {{ __('messages.time') }}</th>
                                    <th>{{ __('messages.priority') }}</th>
                                    <th>{{ __('messages.description') }}</th>
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
    </div>
    <!--- end row -->
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
    var gettoDoListURL = "{{ route('admin.task.get') }}";
    var getToDORowURL = "{{ config('constants.api.get_to_do_row') }}";
    var deleteToDoList = "{{ config('constants.api.delete_to_do_list') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_list') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end 
    // Get PDF Footer Text
    var header_txt="{{ __('messages.to_do_list') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
</script>
<script src="{{ asset('js/custom/to-do-list.js') }}"></script>
@if(!empty(Session::get('school_roleid')))
<script>
var checkpermissions = "{{ route('admin.school_role.checkpermissions') }}";
</script>
<script src="{{ asset('js/custom/permissions.js') }}"></script>
@endif
@endsection