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
</style>
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
                <h4 class="page-title">View Timetable</h4>
            </div>
        </div>
    </div>


    <div class="row" id="timetablerow">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link"><i class="far fa-clock"></i>
                            @if($timetable>0)
                            @if($timetable)Class {{ $details['class']['class_name'] }} (Section: {{ $details['section']['section_name'] }}) @endif
                            @endif
                        </h4>

                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 text-center">
                                    <tbody id="timetable">
                                        @if($timetable>0)
                                        @foreach($days as $day)
                                        <tr>
                                            <td>{{strtoupper($day)}}</td>
                                            @php $row=0; @endphp
                                            @foreach($timetable as $table)
                                            @if($table['day'] == $day)
                                            @if($table['break'] == 1)
                                            <td>
                                                <b>Break Time</b><br>
                                                ( {{ $table['time_start']}} - {{$table['time_end']}} )<br>
                                                @if($table['class_room'])
                                                Class Room : {{$table['class_room']}}
                                                @endif
                                            </td>
                                            @else

                                            <td>
                                                <b>Subject:{{$table['subject_name']}}</b><br>
                                                ( {{ $table['time_start']}} - {{$table['time_end']}} )<br>
                                                Teacher : {{$table['teacher_name'] }}<br>
                                                @if($table['class_room'])
                                                Class Room : {{$table['class_room']}}
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
                                        @endforeach
                                        @else
                                        <tr ><td colspan="5">No Data Available</td></tr>

                                        @endif
                                    </tbody>
                                </table>

                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection

@section('scripts')
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
</script>
<script src="{{ asset('js/custom/timetable.js') }}"></script>

@endsection