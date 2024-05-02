@extends('layouts.admin-layout')
@section('title',' ' . __('messages.report') . '')
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
<style>
    .slider {
        position: relative;
        width: 100%;
    }

    .myslide {
        height: 100;
        display: none;
        overflow: hidden;
    }

    .prev,
    /* .next {
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
        font-size: 50px;
        padding: 15px;
        cursor: pointer;
        color: #fff;
        transition: 0.1s;
        user-select: none;
    } */

    .prev:hover,
    .next:hover {
        color: #00a7ff;
        /* blue */
    }

    .next {
        right: 0;
    }

    .dotsbox {
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        bottom: 20px;
        cursor: pointer;
    }

    .dot {
        display: inline-block;
        width: 15px;
        height: 15px;
        border: 3px solid #fff;
        border-radius: 50%;
        margin: 0 10px;
        cursor: pointer;
    }

    .active,
    .dot:hover {
        border-color: #00a7ff;
        /* blue */
    }

    .fade {
        -webkit-animation-name: fade;
        animation-name: fade;
        animation-duration: 10s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: 0.8
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: 0.8
        }

        to {
            opacity: 1
        }
    }

    .txt {
        position: absolute;
        letter-spacing: 2px;
        line-height: 35px;
        top: 40%;
        left: 15%;

        z-index: 1;
    }

    @-webkit-keyframes posi {
        from {
            left: 25%;
        }

        to {
            left: 15%;
        }
    }

    @keyframes posi {
        from {
            left: 25%;
        }

        to {
            left: 15%;
        }
    }

    .txt h1 {
        color: #00a7ff;
        /* blue */
        font-size: 50px;
        margin-bottom: 20px;
    }

    .txt p {
        font-weight: bold;
        font-size: 20px;
    }

    @media screen and (max-width: 800px) {
        .myslide {
            height: 500px;
        }

        .txt {
            letter-spacing: 2px;
            line-height: 25px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-animation-name: posi2;
            -webkit-animation-duration: 2s;
            animation-name: posi2;
            animation-duration: 2s;
        }

        @-webkit-keyframes posi2 {
            from {
                top: 35%;
            }

            to {
                top: 50%;
            }
        }


        @keyframes posi2 {
            from {
                top: 35%;
            }

            to {
                top: 50%;
            }
        }

        .txt h1 {
            font-size: 40px;
        }

        .txt p {
            font-size: 13px;
        }

    }

    .table1 td,
    .table1 th {
        padding: 2px;
    }

    .table1 {
        width: 100%;
        margin-bottom: 1px;
        color: black;
        text-align: center;
    }

    .table-bordered1 td,
    .table-bordered1 th {
        border: 1px solid black;
        text-align: center;
        font-size: 11px;
    }

    .line {
        height: 10px;
        right: 10px;
        margin: auto;
        left: -5px;
        width: 100%;
        border-top: 1px solid #000;
        -webkit-transform: rotate(14deg);
        -ms-transform: rotate(14deg);
        transform: rotate(14deg);
    }

    .diagonal {
        width: 150px;
        height: 40px;
    }

    .diagonal span.lb {
        bottom: 2px;
        left: 2px;
    }

    .diagonal span.rt {
        top: 2px;
        right: 2px;
    }

    .diagonalCross2 {
        background: linear-gradient(to top right, #fff calc(50% - 1px), black, #fff calc(50% + 1px))
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 900px) {
        .responsive {
            margin-top: 10px;
        }
    }

</style>

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_59_2147)">
                                <path d="M6.34223 7.4312C5.7425 7.43071 5.15636 7.21811 4.65793 6.8203C4.15949 6.4225 3.77115 5.85735 3.54202 5.19631C3.3129 4.53528 3.25328 3.80805 3.37069 3.1066C3.4881 2.40515 3.77727 1.76097 4.20165 1.25553C4.62602 0.750092 5.16654 0.406094 5.75483 0.267034C6.34313 0.127973 6.95278 0.200097 7.5067 0.474287C8.06063 0.748476 8.53395 1.21241 8.8668 1.80743C9.19965 2.40245 9.3771 3.10183 9.37668 3.81713C9.37446 4.77569 9.0539 5.69417 8.4852 6.37151C7.91649 7.04885 7.14595 7.42988 6.34223 7.4312Z" fill="black" />
                                <path d="M10.0812 12.184H2.5592V12.0737C2.5592 11.5395 2.5592 11.0077 2.5592 10.476C2.55223 10.1513 2.60512 9.82865 2.71412 9.53093C2.82313 9.23321 2.98559 8.96766 3.19006 8.75302C3.49863 8.41913 3.89476 8.22323 4.31089 8.19875C4.50226 8.18621 4.69572 8.19875 4.88708 8.19875H8.18226C8.42965 8.19278 8.67548 8.24659 8.90497 8.35693C9.13446 8.46728 9.34285 8.63187 9.51759 8.84081C9.69559 9.04377 9.83701 9.28791 9.93318 9.5583C10.0294 9.82869 10.0783 10.1196 10.0769 10.4133C10.0769 10.9877 10.0769 11.562 10.0769 12.1389C10.0854 12.1464 10.0833 12.1589 10.0812 12.184Z" fill="black" />
                                <path d="M23.7708 20.6612C23.7708 20.7858 23.7294 20.9053 23.6558 20.9937C23.5821 21.0821 23.482 21.132 23.3776 21.1327H0.622457C0.568257 21.1374 0.513817 21.1288 0.462548 21.1073C0.411278 21.0858 0.364273 21.0519 0.32447 21.0078C0.284667 20.9636 0.252921 20.9102 0.231212 20.8508C0.209503 20.7914 0.198303 20.7272 0.198303 20.6624C0.198303 20.5976 0.209503 20.5335 0.231212 20.4741C0.252921 20.4147 0.284667 20.3612 0.32447 20.3171C0.364273 20.273 0.411278 20.2391 0.462548 20.2176C0.513817 20.1961 0.568257 20.1874 0.622457 20.1922H23.3776C23.4818 20.1922 23.5819 20.2416 23.6556 20.3295C23.7294 20.4175 23.7708 20.5368 23.7708 20.6612Z" fill="black" />
                                <path d="M23.9832 14.0475L23.2829 19.5276C23.2829 19.5426 23.2829 19.5576 23.2724 19.5802H0.736022C0.687656 19.2065 0.641397 18.8404 0.595134 18.4717L0.147222 14.983C0.103062 14.6369 0.0546973 14.2883 0.0168457 13.9396C0.000234573 13.7784 0.0210506 13.6147 0.0770412 13.4666C0.133032 13.3184 0.222051 13.1914 0.33438 13.0995C0.521583 12.9284 0.752638 12.8397 0.988369 12.8486H23.0264C23.2118 12.8363 23.3962 12.8885 23.5571 12.9989C23.718 13.1094 23.8486 13.2733 23.9327 13.4706C24.0029 13.6509 24.0207 13.8539 23.9832 14.0475Z" fill="black" />
                                <path d="M17.6956 7.4312C17.0959 7.43071 16.5097 7.21811 16.0113 6.8203C15.5129 6.4225 15.1246 5.85735 14.8954 5.19631C14.6663 4.53528 14.6067 3.80805 14.7241 3.1066C14.8415 2.40515 15.1307 1.76097 15.555 1.25553C15.9794 0.750092 16.5199 0.406094 17.1082 0.267034C17.6965 0.127973 18.3062 0.200097 18.8601 0.474287C19.414 0.748476 19.8873 1.21241 20.2202 1.80743C20.553 2.40245 20.7305 3.10183 20.7301 3.81713C20.7284 4.7759 20.408 5.69475 19.8392 6.37224C19.2704 7.04972 18.4995 7.43054 17.6956 7.4312Z" fill="black" />
                                <path d="M21.4345 12.184H13.9125V12.0737C13.9125 11.5403 13.9125 11.0077 13.9125 10.476C13.9059 10.1513 13.9589 9.8288 14.0679 9.53114C14.1769 9.23347 14.3392 8.96788 14.5434 8.75302C14.852 8.41913 15.2481 8.22323 15.6642 8.19875C15.8577 8.18621 16.0491 8.19875 16.2425 8.19875H19.5356C19.7819 8.19577 20.0262 8.25071 20.2546 8.36042C20.483 8.47014 20.691 8.63248 20.8668 8.83816C21.0426 9.04384 21.1826 9.28882 21.279 9.5591C21.3753 9.82939 21.426 10.1197 21.4282 10.4133C21.4282 10.9877 21.4282 11.562 21.4282 12.1389C21.4387 12.1464 21.4366 12.1589 21.4345 12.184Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_59_2147">
                                    <rect width="24" height="20.9321" fill="white" transform="translate(0 0.200623)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.child_health') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.report') }}</a></li>
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
                                {{ __('messages.select_ground') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
              
                <div class="card-body collapse show">
                    <form id="StudentFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_name') }}</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id_filter">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="department_id_filter" name="department_id_filter" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}</label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.filter') }}
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- End Student Details -->

    <!-- Student Fees Details List-->
    <div class="row" id="student">
        <div class="col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            {{ __('messages.report_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAllchkbox"></th>
                                            <th>#</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.register_no') }}</th>
                                            <th> {{ __('messages.gender') }}</th>
                                            <th> {{ __('messages.email') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <form method="post" action="{{ route('admin.child_health.student_pdf')}}">
                                    @csrf
                                    <input type="hidden" name="student_id" id="student_id_pdf" value="">
                                    <input type="hidden" name="department_id" id="department_id_pdf" value="">
                                    <input type="hidden" name="class_id" id="class_id_pdf" value="">
                                    <input type="hidden" name="section_id" id="section_id_pdf" value="">
                                    <input type="hidden" name="session_id" id="session_id_pdf" value="">
                                    <input type="hidden" name="student_name" id="student_name_pdf" value="">
                                    <div class="clearfix float-right">
                                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                            {{ __('messages.pdf') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- container -->

<!-- Center modal content -->
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Child Health Examination</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="">
                <div class="">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="content" style="box-sizing: border-box; max-width: 800px; display: block; margin: 0 auto; padding: 20px;border-radius: 7px; margin-top: 20px;background-color: #fff;">
                                    <table class="main" width="100%">
                                        <tr>
                                            <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;
                    align=" center">


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4 style="text-align:left;margin-left: 12px; ">Student 1</h4>
                                                        <div class="row" style="margin-top:30px;">
                                                            <h5 style="margin-left: 25px;margin-top: 2px;">Child Health Examination Form</h5>
                                                        </div>
                                                    </div> <!-- end table-responsive-->


                                                    <div class="col-md-6">
                                                        <table class="table table-bordered" style="margin-bottom: 15px;">
                                                            <thead>
                                                                <tr>
                                                                    <h6>　　　　　　　　　Primary　　　　　　　　　Secondary</h6>
                                                                    <th colspan="2" style="text-align:center;background-color: white;">Class</th>
                                                                    <th colspan="1" class="diagonalCross2" style="width:0px;border-right:hidden; border-left:hidden;background-color: white;"></th>
                                                                    <th colspan="1" style="text-align:center;background-color: white;">Grade</th>
                                                                    <th style="background-color: white;">1</th>
                                                                    <th style="background-color: white;">2</th>
                                                                    <th style="background-color: white;">3</th>
                                                                    <th style=" background-color: white;">4</th>
                                                                    <th style=" background-color: white;">5</th>
                                                                    <th style=" background-color: white;">6</th>
                                                                    <th style=" background-color: white;">1</th>
                                                                    <th style=" background-color: white;">2</th>
                                                                    <th style=" background-color: white;">3</th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>
                                                                <tr>

                                                                    <td colspan="4">Class</td>
                                                                    <td>1</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">Grade</td>
                                                                    <td>2</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>



                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div>
                                                    </div>



                                                </div>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-responsive">
                                                                <thead class="colspanHead">
                                                                    <tr>
                                                                        <td colspan="32" style="text-align:center; background-color: white; vertical-align: middle;width:47%;">
                                                                            Student Name</td>
                                                                        <td colspan="2" style="text-align:left;background-color: white; width:8%;">
                                                                        </td>
                                                                        <td colspan="1" style="text-align:center; background-color: white;vertical-align: middle;width:8%;">
                                                                        </td>
                                                                        <td colspan="1" style="text-align:center; background-color: white; vertical-align: middle;width:8%;">
                                                                        </td>
                                                                        <td colspan="1" style="text-align:center; background-color: white; vertical-align: middle;border-right:hidden;">
                                                                        </td>
                                                                        <td colspan="1" style="text-align:center; background-color: white; vertical-align: middle;border-right:hidden;">
                                                                        </td>

                                                                        <td colspan="10" style="text-align:center;background-color: white; vertical-align: middle;">
                                                                        </td>



                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="26" style="width:1%;">School Name</td>
                                                                        <td colspan="6" style="width:20%;"></td>
                                                                        <td colspan="5"></td>
                                                                        <td colspan="5"></td>
                                                                    </tr>


                                                                </tbody>

                                                                <tbody style="border: 1px solid black;">

                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Age</td>
                                                                        <td colspan="2">6</td>
                                                                        <td colspan="2">7</td>
                                                                        <td colspan="2">8</td>
                                                                        <td colspan="2">9</td>
                                                                        <td colspan="1">10</td>
                                                                        <td colspan="2">11</td>
                                                                        <td colspan="2">12</td>
                                                                        <td colspan="1">13</td>
                                                                        <td colspan="2">14</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Fiscal Year</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Height</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Weight</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Nutritional Status</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Spine/Chest/Limb</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td rowspan="2" style="width: 0px;">Eyesight</td>
                                                                        <td colspan="25" style="text-align:center;">Right</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="1">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="1">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Left</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="1">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                        <td colspan="1">( )</td>
                                                                        <td colspan="2">( )</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Eye Diseases and abnormalities</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td rowspan="2" style="width: 0px;">Hearing</td>
                                                                        <td colspan="25" style="text-align:center;">Right</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1" style="background-color:#00000014;"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Left</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1" style="background-color:#00000014;"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Otorhinolaryngopathy</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Skin Diseases</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td rowspan="2" style="width: 0px;">Tuberculosis</td>
                                                                        <td colspan="25" style="text-align:center;">Diseases and abnormalities</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Instruction Category</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td rowspan="2" style="width: 0px;">Heart</td>
                                                                        <td colspan="25" style="text-align:center;">Clinical Medical Examination</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="1" style="background-color:#00000014;"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1" style="background-color:#00000014;"></td>
                                                                        <td colspan="2" style="background-color:#00000014;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Diseases and abnormalities</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td rowspan="3" style="width: 0px;">Urine</td>
                                                                        <td colspan="25" style="text-align:center;">Protein</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Glucose</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Glucose</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Other Diseases and abnormalities</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td rowspan="2" style="width: 0px;">School Doctors</td>
                                                                        <td colspan="25" style="text-align:center;">Findings</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="25" style="text-align:center;">Data</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="text-align:center;">Follow Up Treatments</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="26" style="">Remark</td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="2"></td>
                                                                        <td colspan="1"></td>
                                                                        <td colspan="2"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>


                                                        </div> <!-- end table-responsive-->
                                                        <div>
                                                        </div>

                                                        <div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" title="prev" style="background-image:none;"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #1615153d;left:11%;"></span><span class="sr-only">Previous</span></a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" title="Next" style="background-image:none;"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #1615153d;right: 11%;"></span><span class="sr-only">Next</span></a>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
<!-- <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script> -->
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var studentList = "{{ route('admin.child_health.list') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var childHealthReport = '{{ route("admin.child_health.student_pdf") }}';

    // localStorage variables

    var year_id = "{{ Session::get('academic_session_id') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>
<script>
    var myCarousel = $('#myCarousel');
    var itemFirst = myCarousel.find('.carousel-inner > .item:first-child');
    var itemLast = myCarousel.find('.carousel-inner > .item:last-child');
    var controlLeft = myCarousel.find('a.left.carousel-control');
    var controlRight = myCarousel.find('a.right.carousel-control');

    hideControl();

    myCarousel.on('slid.bs.carousel', function() {
        hideControl();
    });
    myCarousel.on('slide.bs.carousel', function() {
        showControl();
    });

    function hideControl() {
        if (itemFirst.hasClass('active')) {
            controlLeft.css('display', 'none');
        }
        if (itemLast.hasClass('active')) {
            controlRight.css('display', 'none');
            myCarousel.carousel('pause'); // stop from cycling through items
        }
    }

    function showControl() {
        if (itemFirst.hasClass('active')) {
            controlLeft.css('display', 'block');
        }
        if (itemLast.hasClass('active')) {
            controlRight.css('display', 'block');
        }
    }
</script>
<script src="{{ asset('js/custom/child_health.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>

@endsection