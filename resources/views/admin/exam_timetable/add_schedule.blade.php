@extends('layouts.admin-layout')
@section('title','Add Schedule')
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

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <style>
        .w-100 {
            width: 150% !important;
        }
    </style>

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
                <h4 class="page-title">{{ __('messages.add_schedule') }}</h4>
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
                        {{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addScheduleFilter" method="post" action="{{ route('admin.exam_timetable.get') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse($class as $cla)
                                        <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exam_id">{{ __('messages.exam') }}<span class="text-danger">*</span></label>
                                    <select id="exam_id" class="form-control" name="exam_id">
                                        <option value="">{{ __('messages.select_exam') }}</option>
                                        @forelse($exam as $exa)
                                        <option value="{{$exa['id']}}">{{$exa['name']}} ( {{$exa['term_id']}} )</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
                            </button>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="listrow" style="display:none">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.add_schedule') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="addScheduleForm" method="post" action="{{ route('admin.exam_timetable.add') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-centered dt-responsive nowrap w-100" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.subject') }} <span class="text-danger">*</span></th>
                                                <th>{{ __('messages.paper_name') }}</th>
                                                <th>{{ __('messages.date') }} <span class="text-danger">*</span></th>
                                                <th>{{ __('messages.starting_time') }}<span class="text-danger">*</span></th>
                                                <th>{{ __('messages.ending_time') }} <span class="text-danger">*</span></th>
                                                <th>{{ __('messages.location') }}</th>
                                                <th>{{ __('messages.distributor') }}</th>
                                                <!-- <th>Marks<span class="text-danger">*</span></th> -->

                                            </tr>
                                        </thead>
                                        <tbody id="subject-schedule">

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                            </div>

                        </div>
                        <input type="hidden" id="form_class_id" name="class_id">
                        <input type="hidden" id="form_section_id" name="section_id">
                        <input type="hidden" id="form_exam_id" name="exam_id">
                        <input type="hidden" id="form_session_id" name="session_id">
                        <input type="hidden" id="form_semester_id" name="semester_id">
                        <!-- end row-->
                        <div class="form-group text-right m-b-0" style="margin-top: 20px;">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.save') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

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
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var scheduleList = "{{ route('admin.timetable.viewexam') }}";
    var getTeacherList = "{{config('constants.api.teacher_list')}}";
</script>
<script src="{{ asset('js/custom/exam_timetable.js') }}"></script>

@endsection