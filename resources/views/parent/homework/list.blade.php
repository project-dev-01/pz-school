@extends('layouts.admin-layout')
@section('title','Homework')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
@endsection
@section('content')
<style>
    .homework-list {
        display: inline-block;
        width: 50%;
        position: relative;
        padding-right: 10px;
    }

    .homework-list::after {
        content: ":";
        position: absolute;
        right: 10px;
    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.homework') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-blue rounded">
                            <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span data-plugin="counterup">@if($count){{$count['ontime']}}@endif</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.on_time_submission') }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="text-uppercase">{{ __('messages.target') }}<span class="float-right">@if($count){{$count['ontime_percentage']}}@endif%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="@if($count){{$count['ontime_percentage']}}@endif" aria-valuemin="0" aria-valuemax="100" @if($count)style="width: {{$count['ontime_percentage']}}%"@endif>
                            <span class="sr-only">@if($count){{$count['ontime_percentage']}}@endif% {{ __('messages.complete') }}</span>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

        <div class="col-md-6">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-blue rounded">
                            <i class="fe-aperture avatar-title font-22 text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="my-1"><span data-plugin="counterup">@if($count){{$count['late']}}@endif</span></h3>
                            <p class="text-muted mb-1 text-truncate">{{ __('messages.late_submission') }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="text-uppercase">{{ __('messages.target') }}<span class="float-right">@if($count){{$count['late_percentage']}}@endif%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="@if($count){{$count['late_percentage']}}@endif" aria-valuemin="0" aria-valuemax="100" @if($count)style="width: {{$count['late_percentage']}}%"@endif>
                            <span class="sr-only">@if($count){{$count['late_percentage']}}@endif% {{ __('messages.complete') }}</span>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.homework_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="studentHomeworkFilter" method="post" action="{{ route('parent.homework.filter') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row ml-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="row"><label for="status">{{ __('messages.status') }}<span class="text-danger">*</span></label> </div>

                                    <div class="row">
                                        <div class="form-check ">
                                            <input type="radio" class="form-check-input" name="status" value="1">
                                            <label class="form-check-label font-weight-bold" for="materialInline1">{{ __('messages.completed') }}</label>
                                        </div> &nbsp;&nbsp;
                                        <div class="form-check col-md-offset-4">
                                            <input type="radio" class="form-check-input" name="status" value="0">
                                            <label class="form-check-label font-weight-bold" for="materialInline2">{{ __('messages.incompleted') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="subject" class="form-control" required="" name="subject">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                        <option value="All">{{ __('messages.all') }}</option>
                                        @forelse($subject as $sub)
                                        <option value="{{$sub['subject_id']}}">{{$sub['subject_name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="joining_date">Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control homeWorkAdd" name="date" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <span class="text-danger error-text date_error"></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Submit">
                            {{ __('messages.get') }}
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="homeworks">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link" id="title">
                        {{ __('messages.homework_list') }} ({{ __('messages.all_subject') }})
                        <h4>
                    </li>
                </ul><br>
                <div class="card-body" id="homework_list">
                    @if($homework)
                    @foreach($homework as $key=>$work)
                    <form class="submitHomeworkForm" id="form{{$key}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#hw-{{$key}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> {{$work['subject_name']}} - {{ date('j F Y', strtotime($work['date_of_homework'])) }} @if($work['status'] == 1) (Completed) @endif
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="hw-{{$key}}">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.title') }}</span>{{$work['title']}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.status') }}</span>@if($work['status'] == 1) Completed @else Incomplete @endif</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.date_of_homework') }}</span>{{ date('F j , Y', strtotime($work['date_of_homework'])) }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.date_of_submission') }}</span>{{ date('F j , Y', strtotime($work['date_of_submission'])) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.evalution_date') }}</span>@if($work['evaluation_date']){{ date('F j , Y', strtotime($work['evaluation_date'])) }}@endif</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.remarks') }}</span>{{$work['description']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.rank_out_of_5') }} </span>@if($work['remarks']) {{$work['rank']}} @endif</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <p class="col-md-12"><span class="font-weight-semibold homework-list">{{ __('messages.document') }}</span><a href="{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/teacher/homework/'}}{{$work['document']}}" download>
                                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                            </a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 font-weight-bold">{{ __('messages.submission_process_here') }} :- </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <input type="hidden" name="homework_id" value="{{$work['id']}}">
                                                <div class="col-md-6">
                                                    <p class="col-md-12"><span class="font-weight-semibold">{{ __('messages.note') }} </span><textarea maxlength="255" id="txtarea_prev_remarks" class="form-control alloptions" placeholder="Enter the text..." name="remarks" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                                   @if($work['remarks']) {{$work['remarks']}} @endif</textarea></p>

                                                </div>

                                                @if($work['file'])

                                                <div class="col-md-6">
                                                    <div class="col-md-6 font-weight-bold">{{ __('messages.attachment_file') }} :</div>
                                                    <div class="col-md-6">
                                                        <a href="{{ config('constants.image_url').'/public/'.config('constants.branch_id').'/student/homework/'}}{{$work['file'] }}" download>
                                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                            </div><br>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                    @endforeach
                    @endif
                    <div class="form-group text-right m-b-0">

                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection


@section('scripts')
<!-- plugin js -->
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    var homeworkList = "{{ route('student.homework') }}";
    
    var parent_homework_storage = localStorage.getItem('parent_homework_details');
</script>
<script src="{{ asset('public/js/custom/homework.js') }}"></script>

@endsection