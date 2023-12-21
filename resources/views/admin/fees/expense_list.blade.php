@extends('layouts.admin-layout')
@section('title',' ' . __('messages.expense') . '')
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
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('messages.expense_details') }}</h4>
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
                    <form id="filterFeesExpense" autocomplete="off">
                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                        <div class="form-group">
                                        <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                        <select id="department_id" name="department_id" class="form-control">
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
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        
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

                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Status<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select status</option>
                                        <option value="">Paid</option>
                                        <option value="">Unpaid</option>
                                    </select>
                                </div>
                            </div> -->
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
    <!-- End Student Details -->

    <!-- Student Fees Details List-->
    <div class="row getFessStudentsHideShow"  style="display: none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">
                        {{ __('messages.student_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <div class="col-sm-6 col-md-6">
                                    <div class="dt-buttons" style="margin-top: 15px;">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12 col-md-12">
                                    <div id="parent-table_filter" class="dataTables_filter">
                                        <label style="float: right;">Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="parent-table"></label>
                                    </div>
                                </div> -->
                            </div>
                            <table class="table w-100 nowrap " id="fees-expense">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.roll_number') }}</th>
                                        <th>{{ __('messages.semester_1') }}</th>
                                        <th>{{ __('messages.semester_2') }}</th>
                                        <th>{{ __('messages.semester_3') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>佐藤 清</td>
                                        <td>BRO-022</td>
                                        <td>Paid<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>佐藤 清</td>
                                        <td>BRO-022</td>
                                        <td>Paid<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>佐藤 清</td>
                                        <td>BRO-022</td>
                                        <td>Paid<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                        <td>N/A<a href="#" data-toggle="modal" data-target="#centermodal"><i class="fa fa-caret-down" style="color:solid blue;font-size: 20px;padding: 0px 0px 0px 12px;"></i></a></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col-->
                    <div class="form-group text-right m-b-0">
                        <form method="post" action="{{ route('admin.fees.expense.excel')}}">
                            @csrf
                            <input type="hidden" name="department_id" id="excelDepartment">
                            <input type="hidden" name="class_id" id="excelClass">
                            <input type="hidden" name="section_id" id="excelSection">
                            <input type="hidden" name="academic_session_id" id="excelSession">
                            <div class="clearfix float-right">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.download') }}
                                </button>
                            </div>
                        </form>
                        <form method="post" action="{{ route('admin.fees.expense.pdf')}}">
                            @csrf
                            <input type="hidden" name="class_id" id="downExcelClass">
                            <input type="hidden" name="section_id" id="downExcelSection">
                            <input type="hidden" name="department_id" id="downExcelDepartment">
                            <input type="hidden" name="academic_session_id" id="downExcelSession">
                            <div class="clearfix float-right" style="margin-right: 4px">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    {{ __('messages.pdf') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
</div><!-- /.modal-dialog -->
<!-- container -->

<div class="modal fade" id="semesterModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #10a084;">
                <h4 class="modal-title" id="mysemester1ModalLabel">{{ __('messages.are_you_sure') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="fees-expense-form" method="post" action="{{ route('admin.fees.expense.update') }}" autocomplete="off">
                    @csrf
            <input type="hidden" name="id">
            <input type="hidden" name="student_id">
            <input type="hidden" name="academic_year">
            <div class="card-body">
                <div class="form-group" id="semester1status">
                    <label for="semester_1">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                    <select id="semester_1" class="form-control" name="semester_1">
                        <option value="">{{ __('messages.select_status') }}</option>
                        <option value="Paid">{{ __('messages.paid') }}</option>
                        <option value="Unpaid">{{ __('messages.unpaid') }}</option>
                    </select>
                </div>
                <div class="form-group" id="semester2status">
                    <label for="semester_2">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                    <select id="semester_2" class="form-control" name="semester_2">
                        <option value="">{{ __('messages.select_status') }}</option>
                        <option value="Paid">{{ __('messages.paid') }}</option>
                        <option value="Unpaid">{{ __('messages.unpaid') }}</option>
                    </select>
                </div>
                <div class="form-group" id="semester3status">
                    <label for="semester_3">{{ __('messages.status') }}<span class="text-danger">*</span></label>
                    <select id="semester_3" class="form-control" name="semester_3">
                        <option value="">{{ __('messages.select_status') }}</option>
                        <option value="Paid">{{ __('messages.paid') }}</option>
                        <option value="Unpaid">{{ __('messages.unpaid') }}</option>
                    </select>
                </div>
                <div class="form-group text-right m-b-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>

                </div>

            </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    var getStudentList = "{{ config('constants.api.get_student_details') }}";
    var getFeesExpenseStudents = "{{ config('constants.api.get_fees_expense_students') }}";
    var feesTypeGroupUrl = "{{ config('constants.api.fees_type_group') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images' }}";
    var editFeesPageUrl = '{{ route("admin.fees.edit", ":id") }}';
    var feesDelete = '{{ route("admin.fees.fees_delete") }}';
    // localStorage variables
    var fees_storage = localStorage.getItem('admin_fees_expense_details');
</script>

<script src="{{ asset('js/custom/expense.js') }}"></script>

@endsection