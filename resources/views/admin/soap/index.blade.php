@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.soap') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<style>
    .navtab-bg .nav-link {
    background-color: #bec2c6;
    }
    .text-truncate {   
    font-size: 13px;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    
       
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_354_1182)">
                                <path d="M11.985 18.6498C10.3017 18.6498 8.61853 18.6498 6.93364 18.6498C6.75689 18.6497 6.58206 18.6119 6.41998 18.5387C6.29248 18.4786 6.1851 18.3804 6.11151 18.2568C6.03792 18.1332 6.00143 17.9897 6.0067 17.8445C5.99331 17.2943 6.0067 16.7424 6.0067 16.1922C6.0067 15.2966 5.9816 14.3993 6.0067 13.5054C6.05522 12.2488 6.68769 11.3828 7.78027 10.869C8.08063 10.7293 8.40647 10.6583 8.73564 10.6608C10.9359 10.6608 13.1361 10.6451 15.3363 10.6608C15.9275 10.6752 16.4977 10.8913 16.9586 11.2756C17.4195 11.6599 17.7455 12.1911 17.8862 12.7869C17.952 13.0635 17.9862 13.3472 17.9883 13.6321C17.9983 14.9876 17.9883 16.3449 17.9883 17.7004C17.9883 18.0736 17.8779 18.3947 17.5349 18.5491C17.3794 18.6152 17.2125 18.6471 17.0446 18.6429C15.3631 18.6533 13.6732 18.6498 11.985 18.6498Z" fill="black" />
                                <path d="M11.8929 8.95096C11.0146 8.95626 10.1629 8.63855 9.489 8.05421C8.81511 7.46988 8.36263 6.65674 8.21191 5.75915C8.04063 4.90628 8.14182 4.01875 8.50017 3.23084C8.85851 2.44294 9.4545 1.79756 10.198 1.39234C10.6761 1.13912 11.2011 0.995308 11.7374 0.970622C12.2737 0.945936 12.8089 1.04095 13.3068 1.24925C13.8047 1.45755 14.2537 1.77427 14.6234 2.17803C14.9932 2.58178 15.2751 3.06316 15.4501 3.58963C15.7771 4.53071 15.7563 5.56415 15.3917 6.49025C15.027 7.41635 14.3444 8.16938 13.4757 8.60383C12.9801 8.84201 12.439 8.96069 11.8929 8.95096Z" fill="black" />
                                <path d="M4.72339 11.0059C3.97111 10.9863 3.2516 10.6825 2.7 10.1515C2.14839 9.62052 1.80264 8.89892 1.72766 8.1222C1.65268 7.34548 1.85363 6.56709 2.29278 5.9332C2.73194 5.29931 3.37908 4.85353 4.11267 4.67958C4.585 4.55942 5.07963 4.57163 5.54591 4.71497C6.01219 4.8583 6.43338 5.12761 6.76634 5.49532C7.69829 6.46726 7.97269 7.64054 7.49584 8.92837C7.31137 9.47074 6.98615 9.94977 6.556 10.3127C6.12586 10.6756 5.6075 10.9082 5.05802 10.9851C4.94696 10.9987 4.83523 11.0057 4.72339 11.0059Z" fill="black" />
                                <path d="M19.198 11.0198C18.6257 11.0012 18.0695 10.8187 17.591 10.4924C17.1125 10.1662 16.7304 9.70891 16.487 9.17127C16.2437 8.63364 16.1485 8.03661 16.212 7.44632C16.2756 6.85603 16.4954 6.2955 16.8472 5.82682C17.0904 5.4815 17.4022 5.19434 17.7616 4.98475C18.1209 4.77515 18.5195 4.648 18.9303 4.61188C20.5081 4.45394 21.9002 5.67755 22.1528 7.26564C22.2695 8.07462 22.0895 8.89959 21.6484 9.57761C21.2073 10.2556 20.5371 10.7374 19.7702 10.9278C19.5828 10.9816 19.3887 10.9937 19.198 11.0198Z" fill="black" />
                                <path d="M19.5711 18.5593C19.6163 18.2798 19.6698 18.0108 19.6983 17.7401C19.7131 17.5409 19.717 17.3409 19.71 17.1413C19.71 16.0288 19.7251 14.918 19.71 13.8072C19.7016 13.316 19.623 12.8248 19.5745 12.3336C19.5745 12.2833 19.5594 12.2347 19.5494 12.1601H21.599C21.9147 12.1542 22.2283 12.2143 22.5212 12.3366C22.8141 12.459 23.0803 12.6412 23.304 12.8724C23.5277 13.1036 23.7042 13.3791 23.8232 13.6825C23.9422 13.9859 24.0012 14.311 23.9967 14.6385C23.9967 15.6139 23.9967 16.5911 23.9967 17.5665C23.9954 17.8299 23.8943 18.0821 23.7152 18.2689C23.5362 18.4556 23.2935 18.5618 23.0396 18.5645C21.9253 18.5437 20.8109 18.5645 19.6933 18.5645L19.5711 18.5593Z" fill="black" />
                                <path d="M4.45232 12.1723C4.42889 12.2434 4.41049 12.3042 4.39041 12.3632C4.26044 12.7424 4.22419 13.1494 4.285 13.5469C4.28893 13.6046 4.28893 13.6626 4.285 13.7204C4.285 15.1228 4.285 16.524 4.285 17.9241C4.285 18.1289 4.31009 18.332 4.32515 18.5489C4.29336 18.5489 4.24819 18.5489 4.20301 18.5489C3.11211 18.5489 2.02789 18.5333 0.931963 18.5489C0.684189 18.5398 0.448972 18.4335 0.273815 18.2515C0.0986583 18.0695 -0.00338759 17.8253 -0.011709 17.5683C0.0133886 16.5686 -0.011709 15.5671 -0.011709 14.5657C-0.0235154 14.0125 0.151986 13.4725 0.484279 13.0396C0.816572 12.6068 1.28463 12.3085 1.80703 12.1966C1.92864 12.1657 2.05327 12.1494 2.17847 12.1479C2.89291 12.1479 3.60737 12.1479 4.32014 12.1479C4.37201 12.1618 4.39877 12.167 4.45232 12.1723Z" fill="black" />
                            </g>
                            <defs>
                                <clipPath id="clip0_354_1182">
                                    <rect width="24" height="17.6842" fill="white" transform="translate(0 0.967285)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.soap') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.soap') }} </a></li>
                </ol>

            </div>    
        
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">               
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.name') }} :<span class="font-weight-semibold student_name"></span></b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.grade') }} :<span class="font-weight-semibold student_class"></span></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <p class="col-md-12"><b>{{ __('messages.class') }} :<span class="font-weight-semibold student_section"></span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="tabs">
                <!-- <h4 class="header-title mb-4">SOAP</h4>-->

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#d1" data-toggle="tab"  aria-expanded="false" class="nav-link active">
                        {{ __('messages.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pi1" data-toggle="tab"  data-tab="info" aria-expanded="true" class="nav-link ">
                        {{ __('messages.personal_info') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#subjective" data-toggle="tab" data-soap-type-id="1" data-tab="subjective" aria-expanded="true" class="nav-link">
                        {{ __('messages.s_subjective') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#objective" data-toggle="tab" data-soap-type-id="2" data-tab="objective" aria-expanded="true" class="nav-link">
                        {{ __('messages.o_objective') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#assessment" data-toggle="tab" data-soap-type-id="3" data-tab="assessment" aria-expanded="true" class="nav-link">
                        {{ __('messages.a_assessment') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#plan" data-toggle="tab" data-soap-type-id="4" data-tab="plan" aria-expanded="true" class="nav-link">
                        {{ __('messages.p_plan') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#log" data-toggle="tab"  aria-expanded="true" data-tab="log" class="nav-link">
                        {{ __('messages.logs') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- start Dashboard -->
                    <div class="tab-pane show active" id="d1">

                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">{{ __('messages.old_records') }}<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="oldStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="department_id">{{ __('messages.department') }}</label>
                                                    <select id="department_id" name="department_id" class="form-control">
                                                        <option value="">{{ __('messages.select_department') }}</option>
                                                            @forelse($department as $r)
                                                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                            @empty
                                                            @endforelse
                                                    </select>
                                                    </div>
                                                </div>                          
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_class_id">{{ __('messages.grade') }}</label>
                                                        <select id="old_class_id" class="form-control" name="class_id">
                                                            <option value="">{{ __('messages.select_grade') }}</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="old_section_id">{{ __('messages.class') }}</label>
                                                        <select id="old_section_id" class="form-control" name="section_id">
                                                            <option value="">{{ __('messages.select_class') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="old_session_id">{{ __('messages.session') }}</label>
                                                        <select id="old_session_id" class="form-control"  name="session_id">                              
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
                                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                                {{ __('messages.filter') }}
                                                </button>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                            <thead class="">
                                                    <tr>
                                                        <th>{{ __('messages.s.no') }}</th>
                                                        <th colspan="2">{{ __('messages.student_name') }}</th>
                                                        <th>{{ __('messages.email') }}</th>
                                                        <th>{{ __('messages.grade') }}</th>
                                                        <th>{{ __('messages.class') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="old_student_body">
                                                    @forelse($soap_student_list as $key=>$student)
                                                        <tr class="student-row">
                                                            @php $key++; @endphp
                                                            <td>
                                                                {{$key}}
                                                            </td>
                                                            <td style="width: 36px;">
                                                                <img src="{{ $student['photo']  && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['photo'] ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$student['photo'] : config('constants.image_url').'/common-asset/images/users/default.jpg' }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                            </td>
                                                            <td class="stu-name">
                                                                <h5 class="m-0 font-weight-normal ">{{$student['name']}}</h5>
                                                            </td>
                                                            <input type="hidden" class="student" value="{{$student['id']}}">
                                                            <td>
                                                                {{$student['email']}}
                                                            </td>
                                                            <td class="stu-class">
                                                                {{$student['class_name']}}
                                                            </td>
                                                            <td class="stu-section">
                                                                {{$student['section_name']}}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr >
                                                            <td colspan="6" class="text-center">{{ __('messages.no_data_available') }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <div class="card">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <h4 class="navv">{{ __('messages.new_records') }}<h4>
                                        </li>
                                    </ul><br>
                                    <div class="card-body">
                                        <form id="newStudentFilter" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="department_id">{{ __('messages.department') }}</label>
                                                    <select id="newdepartment_id" name="department_id" class="form-control">
                                                        <option value="">{{ __('messages.select_department') }}</option>
                                                            @forelse($department as $r)
                                                            <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                            @empty
                                                            @endforelse
                                                    </select>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="class_id">{{ __('messages.grade') }}</label>
                                                        <select id="class_id" class="form-control" name="class_id">
                                                            <option value="">{{ __('messages.select_grade') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="section_id">{{ __('messages.class') }}</label>
                                                        <select id="section_id" class="form-control" name="section_id">
                                                            <option value="">{{ __('messages.select_class') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="session_id">{{ __('messages.session') }}</label>
                                                        <select id="session_id" class="form-control"  name="session_id">                              
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
                                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                                {{ __('messages.filter') }}
                                                </button>
                                            </div>
                                        
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                                <thead class="">
                                                    <tr>
                                                        <th>{{ __('messages.s.no') }}</th>
                                                        <th colspan="2">{{ __('messages.student_name') }}</th>
                                                        <th>{{ __('messages.email') }}</th>
                                                        <th>{{ __('messages.grade') }}</th>
                                                        <th>{{ __('messages.class') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="new_student_body">
                                                    <tr >
                                                        <td colspan="6" class="text-center">{{ __('messages.no_data_available') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <!-- end Dashboard -->
                    <!-- Start personal tab-->
                    <div class="tab-pane" id="pi1">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <div class="">
                                        <!-- Start Personal Info Popup -->
                                        <div class="modal fade viewEvent" id="personalinfo" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="personalinfo" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> {{ __('messages.academic_details') }}</h4>
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
                                                                                }
                                                                            </style>
                                                                            <tr>
                                                                                <td>{{ __('messages.name') }}</td>
                                                                                <td id="title"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.class') }}</td>
                                                                                <td id="type"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.subject') }}</td>
                                                                                <td id="start_date">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.grade') }}</td>
                                                                                <td id="end_date"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ __('messages.description') }}</td>
                                                                                <td id="description">
                                                                                </td>
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
                                        <!-- End Personal Info Popup -->




                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.student_details') }}<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <input type="hidden" name="student_id" id="student_id">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-user-graduate"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label for="">{{ __('messages.last_name') }}</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-user-graduate"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="gender">{{ __('messages.gender') }}</label>
                                                                    <select id="gender" name="gender" class="form-control" disabled>
                                                                        <option value="">{{ __('messages.select_gender') }}
                                                                        </option>
                                                                        <option value="Male">{{ __('messages.male') }}
                                                                        </option>
                                                                        <option value="Female">{{ __('messages.female') }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="blooddgrp">{{ __('messages.blood_group') }}</label>
                                                                    <select id="blooddgrp" name="blooddgrp" class="form-control" disabled>
                                                                        <option value="">{{ __('messages.select_blood_group') }}
                                                                        </option>
                                                                        <option>O+</option>
                                                                        <option>A+</option>
                                                                        <option>B+</option>
                                                                        <option>AB+</option>
                                                                        <option>O-</option>
                                                                        <option>A-</option>
                                                                        <option>B-</option>
                                                                        <option>AB-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label for="dob">{{ __('messages.date_of_birth') }}</label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="fas fa-birthday-cake"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="dob" class="form-control" id="dob" placeholder="{{ __('messages.dd_mm_yyyy') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Passport">{{ __('messages.passport_number') }}</label>
                                                                    <input type="text" maxlength="50" id="passport" class="form-control alloptions" placeholder="{{ __('messages.enter_passport_number') }}" name="txt_passport" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_nric">{{ __('messages.nric_number') }}</label>
                                                                    <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="{{ __('messages.enter_nric_number') }}" name="txt_nric" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_religion">{{ __('messages.religion') }}</label>
                                                                    <select class="form-control" name="txt_religion" id="religion" disabled>
                                                                        <option value="">{{ __('messages.select_religion') }}</option>
                                                                        @forelse($religion as $r)
                                                                        <option value="{{$r['id']}}">{{$r['religions_name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_caste">{{ __('messages.race') }}</label>
                                                                    <select class="form-control" name="txt_race" id="race" disabled>
                                                                        <option value="">{{ __('messages.select_race') }}</option>
                                                                        @forelse($races as $r)
                                                                        <option value="{{$r['id']}}">{{$r['races_name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
                                                                    <input type="tel" class="form-control" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_country">{{ __('messages.country') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="{{ __('messages.country') }}" name="drp_country" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_state">{{ __('messages.state_province') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="{{ __('messages.state_province') }}" name="drp_state" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_city">{{ __('messages.city') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="{{ __('messages.enter_city') }}" name="drp_city" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="drp_post_code">{{ __('messages.zip_postal_code') }}</label>
                                                                    <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="{{ __('messages.zip_postal_code') }}" name="drp_post_code" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_paddress">{{ __('messages.address_1') }}</label>
                                                                    <input type="text" maxlength="255" id="txtarea_address" class="form-control alloptions" placeholder="{{ __('messages.enter_address_1') }}" name="txtarea_paddress" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txtarea_permanent_address">{{ __('messages.address_2') }}</label>
                                                                    <input type="text" maxlength="255" id="txtarea_permanent_address" class="form-control alloptions" placeholder="{{ __('messages.enter_address_2') }}" name="txtarea_permanent_address" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.academic_details') }}</h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                                                    <select id="btwyears" class="form-control" name="year" disabled>
                                                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                                                        @forelse($academic_year_list as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_regiter_no">{{ __('messages.register_number') }}<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="{{ __('messages.enter_register_no') }}" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_roll_no">{{ __('messages.roll_number') }}<span class="text-danger">*</span></label>
                                                                    <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="{{ __('messages.enter_roll_no') }}" data-parsley-trigger="change" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label for="text">{{ __('messages.admission_date') }}<span class="text-danger">*</span></label>
                                                                    <div class="input-group input-group-merge">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">
                                                                                <span class="far fa-calendar-alt"></span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="{{ __('messages.dd_mm_yyyy') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                                                    <select id="std_class_id" class="form-control" name="std_class_id" disabled>
                                                                        <option value="">{{ __('messages.select_grade') }}</option>
                                                                        @forelse($class as $cla)
                                                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                                                    <select id="std_section_id" class="form-control" name="std_section_id" disabled>
                                                                        <option value="">{{ __('messages.select_class') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4" style="display:none;">
                                                                <div class="form-group">
                                                                    <label for="std_session_id">{{ __('messages.session') }}</label>
                                                                    <select id="std_session_id" class="form-control" name="std_session_id" disabled>
                                                                        <option value="0">{{ __('messages.select_session') }}</option>
                                                                        @forelse($session as $ses)
                                                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="std_semester_id">{{ __('messages.semester') }}</label>
                                                                    <select id="std_semester_id" class="form-control" name="std_semester_id" disabled>
                                                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                                                        @forelse($semester as $sem)
                                                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <h4 class="navv">{{ __('messages.parent_guardian_details') }}<h4>
                                                        </li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="father_name">{{ __('messages.father_name') }}</label>
                                                                    <input type="text" class="form-control" id="father_name" placeholder="{{ __('messages.john_leo') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="father_id" id="father_id">
                                                                    <div id="father_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="mother_name">{{ __('messages.mother_name') }}</label>
                                                                    <input type="text" class="form-control" id="mother_name" placeholder="{{ __('messages.aisha_mal') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="mother_id" id="mother_id">
                                                                    <div id="mother_list">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="guardian_name">{{ __('messages.guardian_name') }}</label>
                                                                    <input type="text" class="form-control" id="guardian_name" placeholder="{{ __('messages.amir_shan') }}" aria-describedby="inputGroupPrepend" readonly>
                                                                    <input type="hidden" name="guardian_id" id="guardian_id">
                                                                    <div id="guardian_list">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="relation">{{ __('messages.guardian_relation') }}</label>
                                                                    <select class="form-control" name="relation" id="relation" disabled>
                                                                        <option value="">{{ __('messages.select_relation') }}</option>
                                                                        @forelse($relation as $r)
                                                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>


                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End personal info tab-->    
                    @include('admin.soap.subjective')
                    @include('admin.soap.objective')
                    @include('admin.soap.assessment')
                    @include('admin.soap.plan')
                    @include('admin.soap.log')

                    <!--End tab-->
                    <!--start popup-->

                    <!--Title popup-->
                    <div id="sstt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('messages.title_details') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body p-4" id="modal-body">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--End Title popup-->
                    <!--sub Title popup-->
                    <div id="notes-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('messages.family_details') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <input type="hidden" id="notes-category-id">
                                <input type="hidden" id="notes-sub-category-id">
                                <div class="modal-body p-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.no') }}</th>
                                                    <th>{{ __('messages.family_details') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody id="notes-body">

                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->

                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <!--sub Title popup end-->

                    <!--delete popup /.modal -->
                    <div id="delete-notes" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <h4 class="modal-title w-100">{{ __('messages.are_you_sure?') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ __('messages.do_you_really') }}</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.cancel') }}</button>
                                    <button type="button" class="btn btn-danger" id="remove_notes">{{ __('messages.delete') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--delete popup end /.modal -->



                </div> <!-- container -->

            </div> <!-- content -->
        </div>

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2015 -
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; UBold theme by
                        <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->



        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">


        </div> <!-- end slimscroll-menu-->
    </div>
    <div class="rightbar-overlay"></div>
</div>
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
    //soapCategory routes
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var imageUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/soap/images/' }}";
    var userImageUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var subCategoryList = "{{ config('constants.api.sub_category_list_by_category') }}";
    var notesList = "{{ config('constants.api.notes_list_by_sub_category') }}";
    var soapDelete = "{{ config('constants.api.soap_delete') }}";
    var soapSubjectDelete = "{{ route('admin.soap_subject.delete') }}";
    var studentDetails = "{{ config('constants.api.student_details') }}";
    var studentSoapList = "{{ config('constants.api.student_soap_list') }}";
    var url = "{{ URL::to('/') }}";
    var soapSubjectDetails = "{{ config('constants.api.soap_subject_details') }}";
    var soapNewStudentList = "{{ config('constants.api.soap_student_list') }}";
    var soapOldStudentList = "{{ config('constants.api.old_soap_student_list') }}";
    var sectionByClassUrl = "{{ config('constants.api.section_by_class') }}";
    var academic_session_id = "{{ Session::get('academic_session_id') }}";
    var user_name = "{{ Session::get('name') }}";
    var user_id = "{{ Session::get('ref_user_id') }}";
    var soapLogList = "{{ route('admin.soap_log.list') }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var soapStudentIDUrl = "{{ route('admin.settings.soap_student_id') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    
</script>

<script src="{{ asset('js/custom/soap.js') }}"></script>
<script src="{{ asset('js/custom/soap_subject.js') }}"></script>

@endsection