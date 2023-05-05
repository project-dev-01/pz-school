@extends('layouts.admin-layout')
@section('title','Timetable')
@section('component_css')
<link href="{{ asset('public/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

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
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.view_timetable') }}</h4>
            </div>
        </div>
    </div>


    <div class="row" id="timetablerow">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                            @if($timetable>0)
                            {{ __('messages.class') }} {{ $details['class']['class_name'] }} ({{ __('messages.section') }}: {{ $details['section']['section_name'] }}) ({{ __('messages.semester') }}: {{ $details['semester']['semester_name'] }}) ({{ __('messages.session') }}: {{ $details['session']['session_name'] }})
                            @endif
                        </h4>

                    </li>
                </ul><br>
                <div class="card-body">
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
<script src="{{ asset('public/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('public/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>

@endsection