@extends('layouts.admin-layout')
@section('title',' ' . __('messages.timetable') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
    }

    .edit-button {
        float: right !important;
        position: absolute;
        right: 13px;
        top: 5px;
    }

    .table td,
    .table th {
        padding: .85rem;
        border-bottom: 1px solid #dee2e6;
    }

    .dt-responsive {
        width: max-content;
    }

    @media only screen and (min-device-width: 280px) and (max-device-width: 1200px) {
        .dt-responsive {
            width: max-content;
        }

    }
</style>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.0461 24.0952H6.00096C5.82368 24.0952 5.65366 24.0231 5.5283 23.8949C5.40295 23.7666 5.33252 23.5926 5.33252 23.4111V3.85696C5.33252 3.67552 5.40295 3.50152 5.5283 3.37322C5.65366 3.24493 5.82368 3.17285 6.00096 3.17285H20.0461C20.2232 3.173 20.3931 3.24515 20.5184 3.37342C20.6436 3.5017 20.7139 3.67562 20.7139 3.85696V23.4111C20.7139 23.5925 20.6436 23.7664 20.5184 23.8946C20.3931 24.0229 20.2232 24.0951 20.0461 24.0952ZM8.08473 10.1814H18.1197C18.297 10.1814 18.467 10.1093 18.5924 9.98101C18.7178 9.85272 18.7882 9.67871 18.7882 9.49727V9.48294C18.7882 9.3015 18.7178 9.12749 18.5924 8.9992C18.467 8.8709 18.297 8.79883 18.1197 8.79883H8.08473C7.99694 8.79883 7.91002 8.81652 7.82892 8.8509C7.74782 8.88528 7.67414 8.93567 7.61207 8.9992C7.55 9.06272 7.50076 9.13814 7.46717 9.22114C7.43358 9.30414 7.41628 9.3931 7.41628 9.48294V9.49727C7.41628 9.58711 7.43358 9.67607 7.46717 9.75907C7.50076 9.84207 7.55 9.91749 7.61207 9.98101C7.67414 10.0445 7.74782 10.0949 7.82892 10.1293C7.91002 10.1637 7.99694 10.1814 8.08473 10.1814ZM9.65357 7.21557H16.566C16.7433 7.21557 16.9133 7.1435 17.0387 7.0152C17.164 6.88691 17.2345 6.7129 17.2345 6.53146C17.2343 6.35013 17.1638 6.17627 17.0385 6.0481C16.9131 5.91993 16.7432 5.84793 16.566 5.84793H9.65357C9.56551 5.8474 9.47821 5.86468 9.3967 5.89879C9.31518 5.9329 9.24105 5.98316 9.17857 6.04667C9.1161 6.11019 9.06649 6.18572 9.03262 6.26891C8.99875 6.35211 8.98128 6.44134 8.98121 6.53146C8.98121 6.62164 8.99863 6.71093 9.03247 6.79419C9.0663 6.87746 9.11589 6.95305 9.17838 7.01663C9.24086 7.0802 9.31501 7.13051 9.39657 7.16465C9.47812 7.1988 9.56546 7.2161 9.65357 7.21557Z" fill="#3A4265" />
                            <path d="M8.62207 0.978877C8.62207 0.862833 8.64441 0.747925 8.6878 0.640714C8.73119 0.533502 8.79479 0.43609 8.87497 0.354034C8.95514 0.271979 9.05033 0.206889 9.15508 0.162481C9.25984 0.118073 9.37211 0.0952148 9.4855 0.0952148H23.1373C23.3663 0.0952148 23.5859 0.188315 23.7478 0.354034C23.9097 0.519753 24.0007 0.744515 24.0007 0.978877V20.1265C24.0007 20.3608 23.9097 20.5856 23.7478 20.7513C23.5859 20.917 23.3663 21.0101 23.1373 21.0101H22.8722C22.6432 21.0101 22.4236 20.917 22.2617 20.7513C22.0998 20.5856 22.0088 20.3608 22.0088 20.1265V2.74621C22.0088 2.51184 21.9178 2.28708 21.7559 2.12136C21.594 1.95564 21.3744 1.86254 21.1454 1.86254H9.4855C9.37211 1.86254 9.25984 1.83969 9.15508 1.79528C9.05033 1.75087 8.95514 1.68578 8.87497 1.60372C8.79479 1.52167 8.73119 1.42425 8.6878 1.31704C8.64441 1.20983 8.62207 1.09492 8.62207 0.978877Z" fill="#3A4265" />
                            <path d="M0.00846616 7.08881H3.76641V7.24707C3.76641 12.0731 3.76529 16.8991 3.76305 21.7252C3.76306 21.8111 3.73395 21.8944 3.68069 21.9609C3.18202 22.5876 2.67831 23.2109 2.17067 23.8406C2.1353 23.8844 2.09088 23.9197 2.04061 23.944C1.99034 23.9682 1.93545 23.9808 1.87988 23.9808C1.8243 23.9808 1.76942 23.9682 1.71915 23.944C1.66887 23.9197 1.62446 23.8844 1.58908 23.8406C1.45946 23.6808 1.33078 23.5212 1.20303 23.3618C0.824827 22.891 0.446063 22.4213 0.0723415 21.9471C0.0280793 21.8909 0.00395735 21.8209 0.0039862 21.7487C0.00062439 16.9085 0.00062439 12.0681 0.0039862 7.22758C0.00118469 7.18514 0.00566465 7.14328 0.00846616 7.08881Z" fill="#3A4265" />
                            <path d="M3.75725 6.14037H0.00994332C0.0065815 6.09679 0.000976562 6.05493 0.000976562 6.01307C0.000976562 5.34444 0.000976562 4.67581 0.000976562 4.00604C0.000976562 3.4521 0.266561 3.08052 0.754584 2.93486C0.817237 2.91613 0.882065 2.9061 0.947328 2.90504C1.56366 2.90504 2.17999 2.88096 2.79633 2.90791C3.37008 2.93314 3.75277 3.35347 3.76453 3.94354C3.77798 4.6546 3.76453 5.3668 3.76453 6.07843C3.76334 6.09921 3.76091 6.11989 3.75725 6.14037Z" fill="#3A4265" />
                        </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.timetable') }}</h4>
            </div>
        
        </div>
    </div>


    <div class="row" id="timetablerow">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                @if($timetable>0)
                            {{ __('messages.class') }} {{ $details['class']['class_name'] ?? "" }} ({{ __('messages.section') }}: {{ $details['section']['section_name'] ?? "" }})
                            @endif
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
               
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table2excel" style="width:max-content;">
                                    <tbody id="timetable">
                                        @if($timetable>0)
                                        
                                        <tr><td class="center" style="color:#ed1833;">{{ __('messages.day') }}/{{ __('messages.period') }}</td>
                                        @for ($i = 1; $i <= $max; $i++)
                                            <td class="centre">{{ $i }}</td>
                                        @endfor
                                        </tr>
                                        @foreach($days as $day)
                                        @if (!isset($timetable['data']['week'][$day]) && ($day == "saturday" || $day == "sunday"))
                                        @else
                                        <tr>
                                            <td class="center" style="color:#ed1833;">{{__('messages.'.$day) }}</td>
                                            @php $row=0; @endphp
                                            @foreach($timetable as $table)
                                            @if($table['day'] == $day)
                                            @php
                                            $start_time = date('H:i', strtotime($table['time_start']));
                                            $end_time = date('H:i', strtotime($table['time_end']));
                                            @endphp
                                            @if($table['break'] == 1)
                                            <td>
                                                <b>
                                                    <div style="color:#2d28e9;display:inline-block;padding-right:10px;"> <i class="dripicons-bell"></i></div>{{ isset($table['break_type']) ? $table['break_type'] : "" }}
                                                </b><br>
                                                <b>
                                                    <div style="color:#179614;display:inline-block;padding-right:10px;"><i class="icon-speedometer"></i></div>( {{ $start_time }} - {{$end_time}} )
                                                    <b><br>
                                                        @if(isset($table['class_room']))
                                                        <b>
                                                            <div style="color:#ff0000;display:inline-block;padding-right:10px;"> <i class="icon-location-pin"></i> </div>{{$table['class_room']}}
                                                        </b><br>
                                                        @endif

                                            </td>
                                            @else

                                            <td>
                                                @if($table['subject_name'])
                                                @php $subject = $table['subject_name']; @endphp
                                                @else
                                                @php $subject = isset($table['break_type']) ? $table['break_type'] : ""; @endphp
                                                @endif
                                                <b>
                                                    <div style="color:#2d28e9;display:inline-block;padding-right:10px;"> <i class="icon-book-open"></i></div>{{$table['subject_name']}}
                                                </b><br>
                                                <b>
                                                    <div style="color:#179614;display:inline-block;padding-right:10px;"><i class="icon-speedometer"></i></div>( {{ $start_time }} - {{$end_time}} )
                                                    <b><br>
                                                        @if($table['teacher_name'])
                                                        <b>
                                                            <div style="color:#28dfe9;display:inline-block;padding-right:10px;"> <i class=" fas fa-book-reader"></i></div>{{$table['teacher_name'] }}
                                                        </b><br>
                                                        @endif
                                                        @if($table['class_room'])
                                                        <b>
                                                            <div style="color:#ff0000;display:inline-block;padding-right:10px;"> <i class="icon-location-pin"></i> </div>{{$table['class_room']}}
                                                        </b><br>
                                                        @endif
                                            </td>

                                            @endif
                                            @php $row++; @endphp
                                            @endif
                                            @endforeach
                                            @while($row<$max) <td class="center">N/A</td>
                                                @php $row++; @endphp
                                                @endwhile
                                        </tr>
                                        @endif

                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center">{{ __('messages.no_data_available') }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right;">{{ __('messages.download') }}</button>
                            </div>
                        </div> 
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection

@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
</script>
<script src="{{ asset('js/custom/timetable.js') }}"></script>
<script>
    var  downloadFileName="{{ __('messages.timetable') }}";
</script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection