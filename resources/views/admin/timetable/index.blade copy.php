@extends('layouts.admin-layout')
@section('title','Schedule List')
@section('content')
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
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
                <h4 class="page-title">Schedule List</h4>
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
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">                             
                                    <option value="">Select Standard</option>
                                    <option value="">I</option>
                                    <option value="press">II</option>
                                    <option value="">III</option>
                                    <option value="press">IV</option>
                                    <option value="">V</option>
                                    <option value="press">VI</option>
                                    <option value="">VII</option>
                                    <option value="press">VIII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">                              
                                    <option value="">Select Class Name</option>
                                    <option value="">A</option>
                                    <option value="">B</option>
                                    <option value="press">C</option>
                                    <option value="">D</option>
                                    <option value="press">E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Day<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">Select Day</option>
                                        <option >Sunday</option>
                                        <option >Monday</option>
                                        <option >Tuesday</option>
                                        <option >Wednesday</option>
                                        <option >Thursday</option>
                                        <option >Friday</option>
                                        <option >Saturday</option>
                                    </select>
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
        <div class="col-xl-12 addTimetableForm">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                           Schedule List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 text-center">
                                    <tbody id="dats">
                                        @foreach($days as $day)
                                        <tr>
                                            <td> {{strtoupper($day)}}</td>
                                            @php $row = 0; @endphp
                                            @foreach($timetable as $table)
                                                @if($table['day'] == $day)
                                                    <td>
                                                        @if($table['break'] == "1")
                                                            <b>Break Time</b><br>
                                                            ({{ $table['time_start'] }} - {{$table['time_end'] }} )<br>
                                                            Teacher : {{ $table['teacher_id'] }}<br>
                                                            @if($table['class_room'])
                                                            Class Room : {{$table['class_room'] }}
                                                            @endif
                                                        @else
                                                            <b>Subject: {{ $table['subject_id'] }}</b><br>
                                                            ({{ $table['time_start'] }} - {{$table['time_end'] }} )<br>
                                                            Teacher : {{ $table['teacher_id'] }}<br>
                                                            @if($table['class_room'])
                                                            Class Room : {{$table['class_room'] }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    @php $row++; @endphp
                                                @endif
                                            @endforeach
                                            @while($row<$max)
                                                <td class="center">N/A</td>
                                                @php $row++; @endphp
                                            @endwhile
                                        </tr>
                                        @endforeach
                                        
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
        var employeeListShow = "{{ route('admin.listemployee') }}";
</script>
<script src="{{ asset('js/custom/timetable.js') }}"></script>

<script type="text/javascript">

    $(document).on('change', "#timetable_body input[type='checkbox']", function() {
        $(this).closest('tr').find('select').prop('disabled', this.checked);
    })
    
    function timetable_entry(){
        var lenght_div = $('#timetable_body .iadd').length;
        $("#timetable_body").append(getDynamicInput(lenght_div));
    }
    
    function getDynamicInput(value) {
        var row = "";
        row += '<tr class="iadd">';
        row += '<td ><div class="checkbox-replace"> ';
        row += '<label class="i-checks"><input type="checkbox" name="timetable[' + value + '][break]" id="' + value + '"><i></i>';
        row += '</label></div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control"  name="timetable[' + value + '][subject]">';
        row += '<option value="">Select Subject</option>';
        row += '<option value="1">Maths</option>'; 
        row += '<option value="2">English</option>';
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control"  name="timetable[' + value + '][teacher]">';
        row += '<option value="">Select Teacher</option>';
        row += '<option value="3">Siva</option>';
        row += '<option value="4">Mithran</option>';
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + value + '][time_start]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + value + '][time_end]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="input-group">';
        row += '<input type="text"  name="timetable[' + value + '][class_room]" value="" class="form-control" >';
        row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        row += '</div></td>';
        row += '</tr>';
        return row;
    }
</script>
@endsection