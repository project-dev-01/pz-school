@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.assign_leave_approval') . '')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<!-- Bootstrap Tables css -->
<link href="{{ asset('libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
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
                            <g clip-path="url(#clip0_122_3580)">
                                <path d="M0.0202342 7.91378C0.0202342 7.25256 -0.00771459 6.59133 0.0202342 5.93395C0.0563401 5.55371 0.223237 5.19596 0.494462 4.91741C0.765688 4.63885 1.12572 4.45543 1.51749 4.39623C1.64961 4.37648 1.78306 4.36621 1.91676 4.36548H4.60383V1.75135C4.5853 1.51634 4.66449 1.28386 4.82398 1.10507C4.98347 0.926273 5.21019 0.815805 5.45427 0.797962C5.69835 0.78012 5.9398 0.856361 6.1255 1.00992C6.31119 1.16348 6.42593 1.38179 6.44446 1.6168C6.44854 1.69236 6.44854 1.76806 6.44446 1.84361V4.35395H17.5082V4.18095C17.5082 3.37749 17.5082 2.57787 17.5082 1.77826C17.5023 1.54171 17.5944 1.31264 17.764 1.14141C17.9336 0.970189 18.1668 0.870841 18.4125 0.865233C18.6582 0.859625 18.8961 0.948214 19.0739 1.11151C19.2518 1.2748 19.355 1.49943 19.3608 1.73597C19.3608 2.54712 19.3608 3.35827 19.3608 4.16941V4.36548H22.0678C22.3208 4.35688 22.573 4.39854 22.8086 4.48784C23.0442 4.57715 23.2582 4.71219 23.4372 4.88457C23.6162 5.05695 23.7565 5.26297 23.8492 5.4898C23.942 5.71664 23.9852 5.95943 23.9763 6.20306C23.9763 6.76817 23.9763 7.33328 23.9763 7.90993L0.0202342 7.91378Z" fill="#3A4265" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000144945 9.70129H6V10.8095H8V9.70129H24.0001V22.9526C24.0182 23.3692 23.8838 23.7786 23.6204 24.1095C23.3569 24.4404 22.9812 24.6718 22.5588 24.7633C22.4014 24.7959 22.2407 24.8114 22.0797 24.8094H1.92461C1.49174 24.8272 1.06621 24.6974 0.722953 24.4429C0.379694 24.1883 0.140706 23.8253 0.0480552 23.4178C0.0143581 23.2714 -0.00171658 23.1218 0.000144945 22.9718V9.70129ZM8 11.8095H6V13.8095H8V11.8095Z" fill="#3A4265" />
                            </g>
                            <defs>
                                <clipPath id="clip0_122_3580">
                                    <rect width="24" height="24" fill="white" transform="translate(0 0.809509)" />
                                </clipPath>
                            </defs>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.leave_management') }} </a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.assign_leave_approval') }} </a></li>
                </ol>

            </div>  
      
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xl-4 col-sm-4 col-lg-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                            <i class="mdi mdi-account font-22 avatar-title text-pink"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span>{{$total_staff}}/{{$level_one_count}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.level_one_staff_approval') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-4 col-xl-4 col-sm-4 col-lg-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="mdi mdi-account-check font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="text-right">
                            <h3 class="mt-1"><span>{{$total_staff}}/{{$level_two_count}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.level_two_staff_approval') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-4 col-xl-4 col-sm-4 col-lg-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="mdi mdi-account-key font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span>{{$total_staff}}/{{$level_three_count}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.level_three_staff_approval') }}</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.assign_leave_approval') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
              
                <div class="card-body collapse show">
                    <label class="form-inline mb-3">
                        {{ __('messages.show') }}
                        <select id="demo-show-entries" class="form-control form-control-sm ml-1 mr-1">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        {{ __('messages.entries') }}
                    </label>

                    <div class="table-responsive">
                        <table id="demo-foo-pagination" class="table w-100 nowrap" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.employee_name') }}</th>
                                    <th>{{ __('messages.department_name') }}</th>
                                    <th>{{ __('messages.level_one_staff_approval') }}</th>
                                    <th>{{ __('messages.level_two_staff_approval') }}</th>
                                    <th>{{ __('messages.level_three_staff_approval') }}</th>
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                @endphp
                                @forelse($get_all_staff_details as $key => $value)
                                <?php
                                $secondDisable = "disabled";
                                $thirdDisable = "disabled";
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['department_name']}}</td>
                                    <td>
                                        <select id="levelOneStaffApproval{{$value['id']}}" data-enablekey="{{$key}}" data-level="1" data-id="{{$value['id']}}" class="form-control enableNextDropdown level1 firstDropDown{{$key}} staff-dropdown{{$value['id']}}">
                                            <option value="">{{ __('messages.none') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if($value['id'] != $val['id'])
                                            @if ($val['id'] == $value['level_one_staff_id'])
                                            <?php $secondDisable = ""; ?>
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <select id="levelTwoStaffApproval{{$value['id']}}" data-enablekey="{{$key}}" data-level="2" {{$secondDisable}} data-id="{{$value['id']}}" class="form-control enableNextDropdown level2 secondDropDown{{$key}} staff-dropdown{{$value['id']}}">
                                            <option value="">{{ __('messages.none') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if($value['id'] != $val['id'])
                                            @if ($val['id'] == $value['level_two_staff_id'])
                                            <?php $thirdDisable = ""; ?>
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <select id="levelThreeStaffApproval{{$value['id']}}" data-enablekey="{{$key}}" data-level="3" {{$thirdDisable}} data-id="{{$value['id']}}" class="form-control level3 thirdDropDown{{$key}} staff-dropdown{{$value['id']}}">
                                            <option value="">{{ __('messages.none') }}</option>
                                            @forelse($get_all_staff_details as $val)
                                            @if($value['id'] != $val['id'])
                                            @if ($val['id'] == $value['level_three_staff_id'])
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                            @else
                                            <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary-bl waves-effect waves-light assignLeaveApprove" data-id="{{$value['id']}}" type="button">
                                            {{ __('messages.save') }}
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <td colspan="5">
                                        <div class="text-right">
                                            <ul class="pagination pagination-split justify-content-end footable-pagination m-t-10"></ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->
</div>
@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<!-- Bootstrap Tables js -->
<script src="{{ asset('libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('libs/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('js/pages/foo-tables.init.js') }}"></script>

<script>
    var assignLeaveApprovalUrl = "{{ config('constants.api.assign_leave_approval') }}";
</script>
<!-- <script src="{{ asset('js/custom/sections.js') }}"></script> -->
<script src="{{ asset('js/custom/assign_leave_approval.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection