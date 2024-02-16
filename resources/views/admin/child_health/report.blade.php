@extends('layouts.admin-layout')
@section('title',' ' . __('messages.child_health_report') . '')
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
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.child_health_report') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
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

@endsection