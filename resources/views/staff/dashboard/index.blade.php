@extends('layouts.admin-layout')
@section('title','Dashboard')
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
<!-- date picker -->
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/greeting.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/calendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/calendarresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/commonresponsive.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div> -->
                <h4 class="page-title">{{ __('messages.dashboard') }}</h4>
            </div>
        </div>
    </div>
    @if(Session::get('greetting_id') == '1')
    <div class="row" id="hideGreeting">
        <div class="col-md-6 col-xl-6">
            <div class="widget-rounded-circle card-box">
                <div class="card-widgets">
                    <!-- <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="greetingText">
                            {{ $greetings }}
                        </p>
                        <h3 class="greetingName">{{ Session::get('name') }}</h3>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <div class="greetingCntRing">
                                <span id="greetingRingCnt">3</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    @endif
    <!-- end page title -->
    <!-- <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <svg width="24" height="21" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_59_2322)">
                                    <path d="M6.34223 7.23056C5.7425 7.23007 5.15636 7.01747 4.65793 6.61967C4.15949 6.22186 3.77115 5.65671 3.54202 4.99567C3.3129 4.33464 3.25328 3.60741 3.37069 2.90596C3.4881 2.20451 3.77727 1.56033 4.20165 1.05489C4.62602 0.549454 5.16654 0.205456 5.75483 0.0663959C6.34313 -0.0726644 6.95278 -0.000540423 7.5067 0.273649C8.06063 0.547838 8.53395 1.01177 8.8668 1.60679C9.19965 2.20181 9.3771 2.9012 9.37668 3.61649C9.37446 4.57506 9.0539 5.49353 8.4852 6.17087C7.91649 6.84821 7.14595 7.22924 6.34223 7.23056Z" fill="#3A4265" />
                                    <path d="M10.0811 11.9834H2.55917V11.873C2.55917 11.3388 2.55917 10.8071 2.55917 10.2754C2.5522 9.95066 2.60508 9.62803 2.71409 9.33031C2.8231 9.03259 2.98556 8.76704 3.19003 8.5524C3.4986 8.2185 3.89473 8.02261 4.31086 7.99813C4.50222 7.98559 4.69569 7.99813 4.88705 7.99813H8.18223C8.42962 7.99216 8.67545 8.04597 8.90494 8.15631C9.13442 8.26665 9.34282 8.43125 9.51756 8.64018C9.69556 8.84315 9.83698 9.08729 9.93315 9.35768C10.0293 9.62806 10.0782 9.91901 10.0769 10.2127C10.0769 10.7871 10.0769 11.3614 10.0769 11.9383C10.0853 11.9458 10.0832 11.9583 10.0811 11.9834Z" fill="#3A4265" />
                                    <path d="M23.7708 20.4606C23.7708 20.5852 23.7294 20.7047 23.6558 20.7931C23.5821 20.8814 23.482 20.9314 23.3776 20.9321H0.622457C0.568257 20.9368 0.513817 20.9281 0.462548 20.9066C0.411278 20.8852 0.364273 20.8513 0.32447 20.8072C0.284667 20.763 0.252921 20.7096 0.231212 20.6502C0.209503 20.5907 0.198303 20.5266 0.198303 20.4618C0.198303 20.397 0.209503 20.3329 0.231212 20.2735C0.252921 20.214 0.284667 20.1606 0.32447 20.1165C0.364273 20.0723 0.411278 20.0385 0.462548 20.017C0.513817 19.9955 0.568257 19.9868 0.622457 19.9915H23.3776C23.4818 19.9915 23.5819 20.041 23.6556 20.1289C23.7294 20.2169 23.7708 20.3362 23.7708 20.4606Z" fill="#3A4265" />
                                    <path d="M23.9832 13.8469L23.2829 19.3269C23.2829 19.342 23.2829 19.357 23.2724 19.3796H0.735992C0.687626 19.0059 0.641366 18.6397 0.595103 18.271L0.147192 14.7824C0.103032 14.4363 0.0546668 14.0876 0.0168152 13.739C0.000204056 13.5777 0.0210201 13.4141 0.0770107 13.2659C0.133001 13.1178 0.222021 12.9908 0.33435 12.8988C0.521552 12.7277 0.752607 12.6391 0.988338 12.648H23.0264C23.2117 12.6356 23.3961 12.6879 23.5571 12.7983C23.718 12.9087 23.8485 13.0726 23.9327 13.27C24.0029 13.4503 24.0206 13.6532 23.9832 13.8469Z" fill="#3A4265" />
                                    <path d="M17.6956 7.23056C17.0959 7.23007 16.5097 7.01747 16.0113 6.61967C15.5129 6.22186 15.1245 5.65671 14.8954 4.99567C14.6663 4.33464 14.6066 3.60741 14.7241 2.90596C14.8415 2.20451 15.1306 1.56033 15.555 1.05489C15.9794 0.549454 16.5199 0.205456 17.1082 0.0663959C17.6965 -0.0726644 18.3061 -0.000540423 18.8601 0.273649C19.414 0.547838 19.8873 1.01177 20.2202 1.60679C20.553 2.20181 20.7305 2.9012 20.73 3.61649C20.7284 4.57526 20.408 5.49411 19.8392 6.1716C19.2703 6.84908 18.4995 7.2299 17.6956 7.23056Z" fill="#3A4265" />
                                    <path d="M21.4345 11.9834H13.9125V11.873C13.9125 11.3397 13.9125 10.8071 13.9125 10.2754C13.9059 9.95071 13.9589 9.62818 14.0679 9.33051C14.1769 9.03285 14.3392 8.76726 14.5434 8.5524C14.852 8.2185 15.2481 8.02261 15.6642 7.99813C15.8577 7.98559 16.0491 7.99813 16.2425 7.99813H19.5356C19.7819 7.99515 20.0262 8.05009 20.2546 8.1598C20.483 8.26952 20.691 8.43186 20.8668 8.63754C21.0426 8.84322 21.1826 9.0882 21.279 9.35848C21.3753 9.62876 21.426 9.91904 21.4282 10.2127C21.4282 10.7871 21.4282 11.3614 21.4282 11.9383C21.4387 11.9458 21.4366 11.9583 21.4345 11.9834Z" fill="#3A4265" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_59_2322">
                                        <rect width="24" height="20.9321" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="mb-1 text-truncate">{{ __('messages.employee') }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span style="color:#3A4265" data-plugin="counterup">{{$count['employee_count']}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h6 class="text-uppercase"><span class="float-right" style="color:#3A4265">{{ __('messages.total_strength') }}</span></h6>
                </div>
            </div> 

        </div> 

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <svg width="24" height="21" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_59_2318)">
                                    <path d="M0 18.6667C0.0521565 18.2957 0.0962869 17.9247 0.148443 17.5798C0.294192 16.5919 0.537261 15.6184 0.874621 14.6714C1.23927 13.5946 1.81449 12.5887 2.57172 11.7038C3.46053 10.6593 4.72431 9.94343 6.13441 9.68573C7.69185 9.36207 9.32112 9.51976 10.7723 10.1346C11.53 10.4746 12.2045 10.9543 12.7543 11.5442C13.2132 12.0305 13.6028 12.569 13.9137 13.1468L13.9779 13.2581C14.284 12.9197 14.6359 12.6192 15.0251 12.3641C15.7892 11.8787 16.6865 11.6035 17.6128 11.5702C18.3739 11.5193 19.1385 11.6063 19.8636 11.8262C20.7852 12.1257 21.5877 12.6751 22.1665 13.4028C22.7898 14.195 23.2433 15.0903 23.5025 16.0403C23.7288 16.8147 23.8858 17.605 23.9719 18.4033C23.9719 18.4886 23.992 18.5739 24 18.6629L0 18.6667Z" fill="#3A4265" />
                                    <path d="M7.7633 8.3132C6.87327 8.31466 6.00277 8.07193 5.26202 7.61572C4.52127 7.15952 3.94357 6.51034 3.60206 5.7504C3.26054 4.99045 3.17056 4.15391 3.34352 3.34666C3.51647 2.53941 3.94458 1.79775 4.57365 1.21559C5.20272 0.633425 6.00445 0.236927 6.87736 0.0762895C7.75027 -0.0843483 8.65509 -0.00190527 9.4773 0.313188C10.2995 0.628281 11.0021 1.16186 11.4962 1.84636C11.9903 2.53086 12.2536 3.33551 12.2528 4.15845C12.2517 5.25941 11.7785 6.31506 10.9369 7.0939C10.0953 7.87275 8.95402 8.31123 7.7633 8.3132Z" fill="#3A4265" />
                                    <path d="M18.018 4.02492C18.7079 4.02639 19.3819 4.21708 19.9545 4.57285C20.5271 4.92862 20.9727 5.43347 21.2349 6.02351C21.4971 6.61354 21.564 7.26223 21.4273 7.88746C21.2905 8.5127 20.9563 9.08636 20.4667 9.53586C19.9772 9.98535 19.3545 10.2905 18.6773 10.4126C18.0002 10.5347 17.2991 10.4683 16.6628 10.2218C16.0265 9.97531 15.4836 9.55983 15.1028 9.02792C14.722 8.49601 14.5204 7.87159 14.5236 7.23371C14.523 6.81031 14.6132 6.391 14.7889 6.00001C14.9646 5.60902 15.2224 5.25409 15.5473 4.95573C15.8722 4.65738 16.2579 4.42151 16.682 4.26175C17.106 4.10198 17.5601 4.02149 18.018 4.02492Z" fill="#3A4265" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_59_2318">
                                        <rect width="24" height="18.6667" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="mb-1 text-truncate">{{ __('messages.students') }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span style="color:#3A4265" data-plugin="counterup">{{$count['student_count']}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h6 class="text-uppercase"><span class="float-right" style="color:#3A4265">{{ __('messages.total_strength') }}</span></h6>
                </div>
            </div> 

        </div> 

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <svg width="24" height="21" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.242 13.769L0 9.5L12 0L24 9.5L18.758 13.769C17.548 11.249 14.978 9.5 12 9.5C9.023 9.5 6.452 11.248 5.242 13.769ZM12 10C10.1435 10 8.36301 10.7375 7.05025 12.0503C5.7375 13.363 5 15.1435 5 17C5 18.8565 5.7375 20.637 7.05025 21.9497C8.36301 23.2625 10.1435 24 12 24C13.8565 24 15.637 23.2625 16.9497 21.9497C18.2625 20.637 19 18.8565 19 17C19 15.1435 18.2625 13.363 16.9497 12.0503C15.637 10.7375 13.8565 10 12 10Z" fill="#3A4265" />
                            </svg>

                            <p class="mb-1 text-truncate">{{ __('messages.parents') }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span style="color:#3A4265" data-plugin="counterup">{{$count['parent_count']}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h6 class="text-uppercase"><span class="float-right" style="color:#3A4265">{{ __('messages.total_strength') }}</span></h6>
                </div>
            </div> 

        </div> 

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <svg width="24" height="21" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.67 9.13C17.04 10.06 18 11.32 18 13V16H22V13C22 10.82 18.43 9.53 15.67 9.13Z" fill="#3A4265" />
                                <path d="M8 8C10.2091 8 12 6.20914 12 4C12 1.79086 10.2091 0 8 0C5.79086 0 4 1.79086 4 4C4 6.20914 5.79086 8 8 8Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14 8C16.21 8 18 6.21 18 4C18 1.79 16.21 0 14 0C13.53 0 13.09 0.0999998 12.67 0.24C13.5 1.27 14 2.58 14 4C14 5.42 13.5 6.73 12.67 7.76C13.09 7.9 13.53 8 14 8Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C5.33 9 0 10.34 0 13V16H16V13C16 10.34 10.67 9 8 9Z" fill="#3A4265" />
                            </svg>
                            <p class="mb-1 text-truncate">{{ __('messages.teachers') }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span style="color:#3A4265" data-plugin="counterup">{{$count['teacher_count']}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                    <h6 class="text-uppercase"><span class="float-right" style="color:#3A4265">{{ __('messages.total_strength') }}</span></h6>
                </div>
            </div> 
        </div> 
    </div> -->

    <!-- end row-->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.to_do_list') }}
                                    <h4>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row" id="toDoList" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three"]'>
                                <div class="col">
                                    <a class="text-dark" data-toggle="collapse" data-id="today" data-count="{{ isset($get_to_do_list_dashboard['today'])?count($get_to_do_list_dashboard['today']):0 }}" href="#todayTasks" aria-expanded="false" aria-controls="todayTasks">
                                        <h5 class="mb-0"><i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.today') }}<span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['today'])?count($get_to_do_list_dashboard['today']):0 }} )</span></h5>
                                    </a>
                                    <!-- Right modal -->
                                    <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#right-modal">Rightbar Modal</button> -->
                                    @if(!empty($get_to_do_list_dashboard['today']))
                                    @forelse ($get_to_do_list_dashboard['today'] as $today)
                                    <div class="collapse todayTasks" id="todayTasks">
                                        <div class="card mb-0 shadow-none">
                                            <div class="card-body pb-0" id="task-list-one">
                                                <!-- task -->
                                                <div class="row justify-content-sm-between task-item">
                                                    <div class="col-lg-5 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" data-id="{{ $today['id'] }}" class="custom-control-input admintaskListDashboard" id="today{{ $today['id'] }}" {{ ($today['user_id']) ? "checked" : "" }}>
                                                            <label class="custom-control-label" for="today{{ $today['id'] }}">
                                                                {{$today['title']}}
                                                            </label>
                                                        </div> <!-- end checkbox -->
                                                    </div> <!-- end col -->
                                                    <div class="col-lg-7">
                                                        <div class="d-sm-flex justify-content-between">
                                                            <div>
                                                                <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                            </div>
                                                            <div class="mt-3 mt-sm-0">
                                                                <ul class="list-inline font-13 text-sm-center todo_list">
                                                                    <li class="list-inline-item" id="comments{{ $today['id'] }}">
                                                                        <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                        {{$today['total_comments']}}
                                                                    </li>
                                                                    <li class="list-inline-item pr-1">
                                                                        <i class='mdi mdi-calendar-month-outline font-16 mr-1'></i>
                                                                        <!-- Today 10am -->
                                                                        {{ date('j F y g a', strtotime($today['due_date']));}}
                                                                    </li>
                                                                    <!-- <li class="list-inline-item pr-1">
                                                                                    <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                    3/7
                                                                                </li> -->

                                                                    <li class="list-inline-item mt-3 mt-sm-0">
                                                                        @if($today['priority'] == "Low")
                                                                        <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                        @endif
                                                                        @if($today['priority'] == "Medium")
                                                                        <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                        @endif
                                                                        @if($today['priority'] == "High")
                                                                        <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div> <!-- end .d-flex-->
                                                    </div> <!-- end col -->
                                                </div>
                                                <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                                <!-- end task -->
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card -->
                                    </div> <!-- end .collapse-->
                                    @empty
                                    <p></p>
                                    @endforelse
                                    @endif

                                    <!-- upcoming tasks -->
                                    <div class="mt-4">
                                        <a class="text-dark" data-toggle="collapse" data-id="upcoming" data-count="{{ isset($get_to_do_list_dashboard['upcoming'])?count($get_to_do_list_dashboard['upcoming']):0 }}" href="#upcomingTasks" aria-expanded="false" aria-controls="upcomingTasks">
                                            <h5 class="mb-0">
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.upcoming') }}<span class="text-muted font-14">( {{ isset($get_to_do_list_dashboard['upcoming']) ? count($get_to_do_list_dashboard['upcoming']) : 0 }} )</span>
                                            </h5>
                                        </a>
                                        @if(!empty($get_to_do_list_dashboard['upcoming']))
                                        @forelse ($get_to_do_list_dashboard['upcoming'] as $upcoming)
                                        <div class="collapse upcomingTasks" id="upcomingTasks">
                                            <div class="card mb-0 shadow-none">
                                                <div class="card-body pb-0" id="task-list-two">
                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between task-item">
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" data-id="{{ $upcoming['id'] }}" class="custom-control-input admintaskListDashboard" id="upcoming{{ $upcoming['id'] }}" {{ ($upcoming['user_id']) ? "checked" : "" }}>
                                                                <label class="custom-control-label" for="upcoming{{ $upcoming['id'] }}">
                                                                    {{$upcoming['title']}}
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                                </div>

                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-center todo_list">
                                                                        <li class="list-inline-item" id="comments{{ $upcoming['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16 mr-1'></i>
                                                                            {{$upcoming['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                            {{ date('j F y g a', strtotime($upcoming['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                        1/12
                                                                                    </li> -->

                                                                        <li class="list-inline-item mt-3 mt-sm-0">
                                                                            @if($upcoming['priority'] == "Low")
                                                                            <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                            @endif
                                                                            @if($upcoming['priority'] == "Medium")
                                                                            <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                            @endif
                                                                            @if($upcoming['priority'] == "High")
                                                                            <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                            @endif
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                                    <!-- end task -->
                                                </div> <!-- end card-body-->
                                            </div> <!-- end card -->
                                        </div> <!-- end collapse-->
                                        @empty
                                        <p></p>
                                        @endforelse
                                        @endif

                                    </div>
                                    <!-- end upcoming tasks -->
                                    <!-- old tasks -->
                                    <div class="mt-4">
                                        <a class="text-dark" data-toggle="collapse" data-id="old" data-count="{{ isset($get_to_do_list_dashboard['old'])?count($get_to_do_list_dashboard['old']):0 }}" href="#pastTasks" aria-expanded="false" aria-controls="pastTasks">
                                            <h5 class="mb-0">
                                                <i class='mdi mdi-chevron-down font-18'></i>{{ __('messages.past') }}<span class="text-muted font-14">( {{isset($get_to_do_list_dashboard['old']) ? count($get_to_do_list_dashboard['old']) : 0 }} )</span>
                                            </h5>
                                        </a>
                                        @if(!empty($get_to_do_list_dashboard['old']))
                                        @forelse ($get_to_do_list_dashboard['old'] as $old)
                                        <div class="collapse pastTasks" id="pastTasks">
                                            <div class="card mb-0 shadow-none">
                                                <div class="card-body pb-0" id="task-list-two">
                                                    <!-- task -->
                                                    <div class="row justify-content-sm-between task-item">
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" data-id="{{ $old['id'] }}" class="custom-control-input admintaskListDashboard" id="old{{ $old['id'] }}" {{ ($old['user_id']) ? "checked" : "" }}>
                                                                <label class="custom-control-label" for="old{{ $old['id'] }}">
                                                                    {{$old['title']}}
                                                                </label>
                                                            </div> <!-- end checkbox -->
                                                        </div> <!-- end col -->
                                                        <div class="col-lg-6">
                                                            <div class="d-sm-flex justify-content-between">
                                                                <div>
                                                                    <img src="{{ config('constants.image_url').'/common-asset/images/users/12.jpg' }}" lt="image" class="avatar-xs rounded-circle" data-toggle="tooltip" data-placement="bottom" title="" />
                                                                </div>
                                                                <div class="mt-3 mt-sm-0">
                                                                    <ul class="list-inline font-13 text-sm-center todo_list">
                                                                        <li class="list-inline-item" id="comments{{ $old['id'] }}">
                                                                            <i class='mdi mdi-comment-text-multiple-outline font-16'></i>
                                                                            {{$old['total_comments']}}
                                                                        </li>
                                                                        <li class="list-inline-item pr-1">
                                                                            <i class='mdi mdi-calendar-month-outline font-16'></i>
                                                                            <?php setlocale(LC_ALL, 'ja.UTF-8');
                                                                            ?>
                                                                            {{ date('j F y g a', strtotime($old['due_date']));}}

                                                                        </li>
                                                                        <!-- <li class="list-inline-item pr-1">
                                                                                        <i class='mdi mdi-tune font-16 mr-1'></i>
                                                                                        1/12
                                                                                    </li> -->

                                                                        <li class="list-inline-item mt-3 mt-sm-0">
                                                                            @if($old['priority'] == "Low")
                                                                            <span class="badge badge-soft-success p-1">{{ __('messages.low') }}</span>
                                                                            @endif
                                                                            @if($old['priority'] == "Medium")
                                                                            <span class="badge badge-soft-info p-1">{{ __('messages.medium') }}</span>
                                                                            @endif
                                                                            @if($old['priority'] == "High")
                                                                            <span class="badge badge-soft-danger p-1">{{ __('messages.high') }}</span>
                                                                            @endif
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- end .d-flex-->
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end task -->
                                                    <hr class="my-2" style="margin-bottom: 1px!important;;margin-top: 1px!important;" />
                                                </div> <!-- end card-body-->
                                            </div> <!-- end card -->
                                        </div> <!-- end collapse-->
                                        @empty
                                        <p></p>
                                        @endforelse
                                        @endif

                                    </div>
                                    <!-- end old tasks -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->


                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end col -->

        <!-- task details -->
        <!-- task panel end -->
    </div> <!-- end card-box -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.Calendar') }}
                                    <h4>
                            </li>
                        </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div id="" class="m-t-20">
                                <br>
                            </div>

                        </div> <!-- end col-->

                        <div class="col-lg-12">
                            <!-- <div id="admin_calendor"></div> -->
                            <div id="new_calendor"></div>
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card body-->
            </div> <!-- end card -->

            <!-- Add New Event MODAL -->
            <div class="modal fade viewEvent" id="admin-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewEventModalLabel" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i>{{ __('messages.event_details') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <style>
                                                    .table td {
                                                        border-top: none;
                                                        text-align: justify;
                                                    }
                                                </style>
                                                <tr>
                                                    <td>{{ __('messages.title') }}</td>
                                                    <td id="title"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('messages.type') }}</td>
                                                    <td id="type"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('messages.start_date') }}</td>
                                                    <td id="start_date"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('messages.end_date') }}</td>
                                                    <td id="end_date"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('messages.audience') }}</td>
                                                    <td id="audience"></td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('messages.description') }}</td>
                                                    <td id="description"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade " id="bulk-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewBulkModalLabel"> <i class="fas fa-info-circle"></i>{{ __('messages.details') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <p class="text-center"> {{ __('messages.name') }} :<span id="bulk_name"></span></p><br>
                                        </div>
                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade " id="birthday-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myviewBirthdayModalLabel"> <i class="fas fa-info-circle"></i>{{ __('messages.birthday') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-box">
                                        <div class="table-responsive">
                                            <p class="text-center">{{ __('messages.happy_birthday') }}<span id="name"></span></p>
                                        </div>
                                    </div> <!-- end card-box -->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.ShortcutLinks') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                <div class="col-12">
                        <div class="row">
                        <?php 
                         if (!empty($shortcut_links)) {
                            // Iterate through shortcut data and generate links
                            foreach ($shortcut_links as $shortcut) {
                                ?>
                                <div class="col-3">
                                    <a href="<?= $shortcut['links'] ?>" data-toggle="collapse">
                                        <i class="fa fa-share" aria-hidden="true" style="color: blue;"></i>
                                        <span><?= $shortcut['sidebar_name'] ?></span>
                                    </a>
                                </div>
                                <?php
                            }
                        }else{
                                // Display a message or take alternative action when no shortcuts are available
                                echo '<div class="col-12  text-center">'.__('messages.noshortcutLinks').'</div>';
                        }
                        ?>

                        </div>
                    </div>
                    </div>
                    
            </div>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    @include('staff.dashboard.check_list')
    @include('staff.dashboard.task')
    @include('staff.dashboard.task-show')
    @include('staff.dashboard.exam-schedule')
    @include('staff.dashboard.taskupdate')

</div> <!-- container -->
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<!-- <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script> -->

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('date-picker/jquery-ui.js') }}"></script> -->
<script>
    toastr.options.preventDuplicates = true;
</script>

<script src="{{ asset('js/validation/validation.js') }}"></script>

<!-- full calendar js start -->
<script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/list/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>
<!-- full calendar js end -->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    var getBirthdayCalendorAdmin = "{{ config('constants.api.get_birthday_calendor_admin') }}";
    var getEventCalendorAdmin = "{{ config('constants.api.get_event_calendor_admin') }}";
    var getEventGroupCalendorAdmin = "{{ config('constants.api.get_event_group_calendor_admin') }}";
    var getBulkCalendor = "{{ config('constants.api.get_bulk_calendor_admin') }}";
    var readUpdateTodoUrl = "{{ config('constants.api.read_update_todo') }}";
    var getAssignClassUrl = "{{ config('constants.api.get_assign_class') }}";
    var pathDownloadFileUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/images/todolist/' }}";
    var toDoCommentsUrl = "{{ config('constants.api.to_do_comments') }}";
    var getScheduleExamDetailsUrl = "{{ config('constants.api.get_schedule_exam_details') }}";

    var UserName = "{{ Session::get('name') }}";
    var hiddenWks = "{{ $hiddenWeekends }}";
    // task all url
    var calendorAddTaskCalendor = "{{ config('constants.api.calendor_add_task_calendor') }}";
    var calendorListTaskCalendor = "{{ config('constants.api.calendor_list_task_calendor') }}";
    var calendorEditTaskCalendor = "{{ config('constants.api.calendor_edit_task_calendor') }}";
    var calendorUpdateTaskCalendor = "{{ config('constants.api.calendor_update_task_calendor') }}";
    var calendorDeleteTaskCalendor = "{{ config('constants.api.calendor_delete_task_calendor') }}";
    var getPublicHolidays = "{{ config('constants.api.get_public_holidays') }}";
</script>
<!-- <script src="{{ asset('js/custom/admin_calendor.js') }}"></script> -->
<script src="{{ asset('js/custom/admin_calendor_new_cal.js') }}"></script>
<script src="{{ asset('js/custom/admin/dashboard.js') }}"></script>
<script src="{{ asset('js/custom/greeting.js') }}"></script>
@endsection