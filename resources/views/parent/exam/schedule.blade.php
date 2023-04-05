@extends('layouts.admin-layout')
@section('title','Exam Schedule')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    </ol>-->
                </div>
                <h4 class="page-title">{{ __('messages.exam_schedule') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.schedule_list') }} 
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.exam_name') }}</th>
                                                <th>{{ __('messages.action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $row=0; @endphp
                                            @forelse($schedule_exam_list as $exam)
                                            @php $row++; @endphp
                                            <tr>
                                                <td>{{$row}}</td>
                                                <td>{{$exam['name']}}</td>
                                                <td>
                                                    <div class="button-list">
                                                        <a href="javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light" data-toggle="modal" data-target="#examTimeTable" data-exam_id="{{$exam['exam_id']}}" id="{{$exam['exam_id']}}"><i class="fe-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center"> No Data Available</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    @include('parent.exam.view')
</div> <!-- container -->
@endsection
@section('scripts')
<script>
    var viewExamTimetable = "{{ route('parent.exam_timetable.view') }}";
</script>
<script src="{{ asset('public/js/custom/exam_timetable_schedule.js') }}"></script>

@endsection