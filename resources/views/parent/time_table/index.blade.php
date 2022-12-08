@extends('layouts.admin-layout')
@section('title','Timetable ')
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
                <h4 class="page-title">View Timetable</h4>
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
                            Class {{ $details['class']['class_name'] }} (Section: {{ $details['section']['section_name'] }}) (Semester: {{ $details['semester']['semester_name'] }}) (Session: {{ $details['session']['session_name'] }})
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
                                        
                                            <tr><td class="center" style="color:#ed1833;">Day/Period</td>
                                            @for ($i = 1; $i <= $max; $i++)
                                                <td class="centre">{{ $i }}</td>
                                            @endfor
                                            </tr>
                                        @foreach($days as $day)
                                        @if (!isset($timetable['data']['week'][$day]) && ($day == "saturday" || $day == "sunday"))
                                        @else
                                        <tr>
                                            <td class="center" style="color:#ed1833;">{{strtoupper($day)}}</td>
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
                                            <td class="text-center">No timetable Available</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right;">Download</button>
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
<script src="{{ asset('public/js/dist/jquery.table2excel.js') }}"></script>
</script>
<script src="{{ asset('public/js/custom/timetable.js') }}"></script>

@endsection