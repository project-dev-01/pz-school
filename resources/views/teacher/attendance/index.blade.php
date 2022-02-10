@extends('layouts.admin-layout')
@section('title','Student Attendance')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title"> Attendance List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row " >
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Class">Standard<span class="text-danger">*</span></label>
                                    <select id="Class" class="form-control" required="">
                                        <option >Select Standard</option> 
                                        <option >I</option>
                                        <option >II</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Section">Class Name<span class="text-danger">*</span></label>
                                    <select id="Section" class="form-control" required="">
                                        <option >Select Class Name</option> 
                                        <option >A</option>
                                        <option >B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge text-center">
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" Value="February 2022" data-date-min-view-mode="1">   
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Filter
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                             Attendance Report
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <table class="table table-bordered mb-0  w-100">
                                                    <tr>
                                                        <th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> Present</button></th>
                                                        <th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i> Absent</button></th>
                                                        <th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> Holiday</button></th>
                                                        <th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> Late</button></th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <div class="m-6 table-responsive">
                                    <table  class="table table-bordered mb-0 nowrap">
                                        <thead>
                                            <tr>
                                                <th WIDTH="20%">Name</th>
                                                <th>Sat<br>1</th>
                                                <th>Sun<br>2</th>
                                                <th>Mon<br>3</th>
                                                <th>Tue<br>4</th>
                                                <th>Wed<br>5</th>
                                                <th>Thu<br>6</th>
                                                <th>Fri<br>7</th>
                                                <th>Sat<br>8</th>
                                                <th>Sun<br>9</th>
                                                <th>Mon<br>10</th>
                                                <th>Tue<br>11</th>
                                                <th>Wed<br>12</th>
                                                <th>Thu<br>13</th>
                                                <th>Fri<br>14</th>
                                                <th>Sat<br>15</th>
                                                <th>Sun<br>16</th>
                                                <th>Mon<br>17</th>
                                                <th>Tue<br>18</th>
                                                <th>Wed<br>19</th>
                                                <th>Thu<br>20</th>
                                                <th>Fri<br>21</th>
                                                <th>Sat<br>22</th>
                                                <th>Sun<br>23</th>
                                                <th>Mon<br>24</th>
                                                <th>Tue<br>25</th>
                                                <th>Wed<br>26</th>
                                                <th>Thu<br>27</th>
                                                <th>Fri<br>28</th>
                                                <th>Total<br>Present</th>
                                                <th>Total<br>Absent</th>
                                                <th>Total<br>Late</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td class="text-left">   
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" >
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                   William
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td class="text-center vertical-align: top"><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="10-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button"  data-toggle="tooltip" title="15-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>18</td>
                                                <td>2</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">   
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                    <i class="fas fa-crown"></i>Benjamin
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>19</td>
                                                <td>2</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                    James
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="05-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="10-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="10-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button"  data-toggle="tooltip" title="05-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>17</td>
                                                <td>2</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center th-lg">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                    Mia
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button"  data-toggle="tooltip" title="15-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>18</td>
                                                <td>2</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                    Lucas
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="05-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="15-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button"  data-toggle="tooltip" title="10-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>18</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">                                                
                                                    </a>
                                                    Sophia
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="10-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button"  data-toggle="tooltip" title="05-min Late" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button"  data-toggle="tooltip" title="05-min Late"  class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>19</td>
                                                <td>1</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">

                                                    </a>
                                                    Amelia
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td class="align-center"><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>19</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">

                                                    </a>
                                                    Isabella
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td class="align-center"><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>19</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>                                           
                                            <tr>
                                                <td class="text-center">
                                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"  data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                    <img src="{{ Session::get('picture') && asset('users/images/'.Session::get('picture')) ? asset('users/images/'.Session::get('picture')) : asset('images/users/default.jpg') }}" alt="user-image" class="rounded-circle admin_picture">

                                                    </a>
                                                    Charlotte
                                                </td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td class="align-center"><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" data-toggle="tooltip" title="Public Holiday" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> </button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td style="background-color: #ddd; cursor: not-allowed;"></td>
                                                <td><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i></button></td>
                                                <td>19</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Download
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
        <!-- end page title -->

        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Daily Present and Late Analysis 
                            <h4>
                    </li>
                </ul><br>
                <br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row ">                              
                             <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="header-title"></h4>

                                    <div id="cardCollpase7" class="collapse pt-3 show" dir="ltr">                                           
                                            <div id="apex-mixed-3" class="apex-mixed-1" data-colors="#6658dd,#1abc9c"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                             </div> <!-- end col -->                      
                        </div>
                    </form> 
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

    @include('teacher.attendance.lateanalytics')
</div> <!-- container -->

@endsection