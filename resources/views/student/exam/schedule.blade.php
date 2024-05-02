@extends('layouts.admin-layout')
@section('title',' ' . __('messages.exam_schedule') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

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
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
              <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#3A4265">
                            <path fill-rule="evenodd" d="M20.001 2H4C2.897 2 2 2.897 2 4v16c0 1.103.897 2 2 2h16.001c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-1 16H5V8h14v10zm0-12H5V5h14v1zm-6 5h4v2h-4v-2z" clip-rule="evenodd" />
                        </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.exam_schedule') }}</h4>
            </div>
         
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.schedule_list') }} 
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
                                                <td colspan="3" class="text-center">{{ __('messages.no_data_available') }}</td>
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
    @include('student.exam.view')
</div> <!-- container -->
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
    var viewExamTimetable = "{{ route('student.exam_timetable.view') }}";
</script>
<script src="{{ asset('js/custom/exam_timetable_schedule.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection