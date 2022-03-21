@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">Home work</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" >
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            HomeWork List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-primary rounded">
                                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="my-1"><span data-plugin="counterup">{{$count['ontime']}}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">On Time Submission</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Target <span class="float-right">{{$count['ontime_percentage']}}%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{$count['ontime_percentage']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$count['ontime_percentage']}}%">
                                                <span class="sr-only">{{$count['ontime_percentage']}}% Complete</span>
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
                                                <h3 class="my-1"><span data-plugin="counterup">{{$count['late']}}</span></h3>
                                                <p class="text-muted mb-1 text-truncate">Late Submission </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">Target <span class="float-right">{{$count['late_percentage']}}%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{$count['late_percentage']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$count['late_percentage']}}%">
                                                <span class="sr-only">{{$count['late_percentage']}}% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->
                        </div>
                        <form id="studentHomeworkFilter" method="post" action="{{ route('student.homework.filter') }}"  enctype="multipart/form-data" autocomplete="off">
                        <div class="row ml-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="row"><label for="status">Status<span class="text-danger">*</span></label> </div>

                                    <div class="row">
                                        <div class="form-check ">
                                            <input type="radio" class="form-check-input"  name="status" value="1">
                                            <label class="form-check-label font-weight-bold" for="materialInline1">Completed</label>
                                        </div> &nbsp;&nbsp;
                                        <div class="form-check col-md-offset-4">
                                            <input type="radio" class="form-check-input"  name="status" value="0">
                                            <label class="form-check-label font-weight-bold" for="materialInline2">Incompleted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject">Subject<span class="text-danger">*</span></label>
                                    <select id="subject" class="form-control" required="" name="subject">
                                        <option value="">Select Subject</option>
                                        <option value="All">All</option>
                                        @foreach($subject as $sub)
                                            <option value="{{$sub['id']}}">{{$sub['name']}}</option>
                                        @endforeach
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
                                Get
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
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link" id="title">
                            HomeWork List (All Subjects)
                        <h4>
                    </li>
                </ul><br>
                <div class="card-body" id="homework_list">
                    @foreach($homework as $work)
                    <form class="submitHomeworkForm" method="post" action="{{ route('student.homework.submit') }}"  enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#English" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> {{$work['subject_name']}} - {{ date('j F Y', strtotime($work['date_of_homework'])) }} @if($work['status'] == 1) (Completed) @endif
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="English">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Title :</div>
                                                        <div class="col-md-3">{{$work['title']}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Status :</div>
                                                        <div class="col-md-3">@if($work['status'] == 1) Completed @else Incomplete @endif</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                                        <div class="col-md-3">{{ date('F j , Y', strtotime($work['date_of_homework'])) }}</div>
                                                    </div>
                                                </div>

                                            </div><br />
                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                                        <div class="col-md-3">{{ date('F j , Y', strtotime($work['date_of_submission'])) }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                                        <div class="col-md-3">@if($work['evaluation_date']){{ date('F j , Y', strtotime($work['evaluation_date'])) }}@endif</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Remarks :</div>
                                                        <div class="col-md-3">{{$work['description']}}</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Rank Out Of 5 :</div>
                                                        <div class="col-md-3">@if($work['remarks']) {{$work['rank']}} @endif</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Document :</div>
                                                        <div class="col-md-3">
                                                            <a href="{{asset('teacher/homework/')}}/{{$work['document']}}" download>
                                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 font-weight-bold">Submission Process Here :- </div>

                                            </div><br>
                                            <input type="hidden" name="homework_id" value="{{$work['id']}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-5 font-weight-bold">Note : </div>
                                                        <div class="col-md-5">
                                                            <textarea  name="remarks" rows="4" cols="25">@if($work['remarks']) {{$work['remarks']}} @endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @if($work['file'])

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-5 font-weight-bold">Attachment File: </div>
                                                            <div class="col-md-3">
                                                                <a href="{{asset('student/homework/')}}/{{$work['file']}}" download>
                                                                    <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-5 font-weight-bold">Attachment File: </div>
                                                            <div class="col-md-5">
                                                                <input type="file"  name="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </form>
                    @endforeach
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

<script>
    var homeworkList = "{{ route('student.homework') }}";
</script>
<script src="{{ asset('js/custom/homework.js') }}"></script>
@endsection