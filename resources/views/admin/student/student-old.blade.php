@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_list') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<!-- <link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}"> -->

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.student_list') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.select_ground') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="StudentFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_name') }}</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id_filter">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="department_id_filter" name="department_id_filter" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}</label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.filter') }}
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


    <div class="row" id="student">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            {{ __('messages.students_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.register_no') }}</th>
                                            <th> {{ __('messages.roll_no') }}</th>
                                            <th> {{ __('messages.gender') }}</th>
                                            <th> {{ __('messages.email') }}</th>
                                            <th> {{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <form method="post" action="">
                                    @csrf
                                    <div class="clearfix float-right" style="margin-bottom:5px;">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.pdf') }}</button>
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Setting Student Information
                            <h4>
                    </li>
                </ul><br>
                <!-- <div class="card-body"> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input id="checkbox2" type="checkbox" checked>
                                            <label for="checkbox2">
                                                Student Details
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input id="checkbox2" type="checkbox" checked>
                                            <label for="checkbox2">
                                                Parent Details
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input id="checkbox2" type="checkbox" checked>
                                            <label for="checkbox2">
                                                School Details
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="checkbox checkbox-primary mb-2">
                                            <input id="checkbox2" type="checkbox" checked>
                                            <label for="checkbox2">
                                                Academic Details
                                            </label>
                                        </div>
                                        <ul>
                                            <li class="list-unstyled">
                                                <ul class="list-inline m-b-0">
                                                    <li class="list-inline-item">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input id="checkbox2" type="checkbox" checked>
                                                            <label for="checkbox2">
                                                                Grade & Classes
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <select id="inputState" class="form-control">
                                                            <option>FY23</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="list-unstyled">
                                                <ul class="list-inline m-b-0">
                                                    <li class="list-inline-item">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input id="checkbox2" type="checkbox" checked>
                                                            <label for="checkbox2">
                                                                Activity
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <select id="inputState" class="form-control">
                                                            <option>FY23</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="list-unstyled">
                                                <ul class="list-inline m-b-0">
                                                    <li class="list-inline-item">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input id="checkbox2" type="checkbox" checked>
                                                            <label for="checkbox2">
                                                                Attenadance
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <select id="inputState" class="form-control">
                                                            <option>FY23</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="list-unstyled">
                                                <ul class="list-inline m-b-0">
                                                    <li class="list-inline-item">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input id="checkbox2" type="checkbox" checked>
                                                            <label for="checkbox2">
                                                                Test Results
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <select id="inputState" class="form-control">
                                                            <option>FY23</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="list-unstyled">
                                                <ul class="list-inline m-b-0">
                                                    <li class="list-inline-item">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input id="checkbox2" type="checkbox" checked>
                                                            <label for="checkbox2">
                                                                Interview
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <select id="inputState" class="form-control">
                                                            <option>FY23</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div class="form-group text-left m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div>  -->
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
<!-- <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.colVis.min.js"></script> -->

<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script>
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";

    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var studentDelete = "{{ route('admin.student.delete') }}";
    var studentList = "{{ route('admin.student.list') }}";
    // lang change name start
    var deleteTitle = "{{ __('messages.are_you_sure') }}";
    var deleteHtml = "{{ __('messages.delete_this_student') }}";
    var deletecancelButtonText = "{{ __('messages.cancel') }}";
    var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
    // lang change name end// Get PDF Footer Text

    // Get PDF Footer Text
    var header_txt = "{{ __('messages.student_list') }}";
    var footer_txt = "{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    // localStorage variables
    var student_list_storage = localStorage.getItem('admin_student_list_details');
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>
<script src="{{ asset('js/custom/student.js') }}"></script>
@endsection