@extends('layouts.admin-layout')
@section('title','Add Group')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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

                <h4 class="page-title">{{ __('messages.group') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.add_group') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="groupForm" method="post" action="{{ route('admin.group.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">{{ __('messages.group_name') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.enter_group_name') }}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.description') }}</label>
                                    <textarea class="form-control" name="description"></textarea>
                                    <span class="text-danger error-text description_error"></span>
                                </div> 
                            </div>
                        </div>
                        
                        <input type="hidden" id="staffCount" class="form-control"  value="0" >
                        <input type="hidden" id="studentCount" class="form-control" value="0" >
                        <input type="hidden" id="parentCount" class="form-control"  value="0" >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff">{{ __('messages.add_staff') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="staff" name="staff" class="form-control" placeholder="{{ __('messages.enter_staff_name') }}">
                                    <div id="staff_list"></div>
                                    <span class="text-danger error-text staff_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.staff_name') }}</th>
                                                <th>{{ __('messages.staff_department') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="staff_table">
                                            <tr>
                                                <td colspan="4">{{ __('messages.no_data_available') }}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student">{{ __('messages.add_student') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="student" name="student" class="form-control" placeholder="{{ __('messages.enter_student_name') }}">
                                    <div id="student_list"></div>
                                    <span class="text-danger error-text student_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.student_name') }}</th>
                                                <th>{{ __('messages.student_Class') }}</th>
                                                <th>{{ __('messages.student_section') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student_table">
                                            <tr>
                                                <td colspan="5">{{ __('messages.no_data_available') }}</td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="parent">{{ __('messages.add_parent') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="parents" name="parent" class="form-control" placeholder="{{ __('messages.enter_parent_name') }}">
                                    <div id="parent_list"></div>
                                    <span class="text-danger error-text parent_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.parent_name') }}</th>
                                                <th>{{ __('messages.email') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            <tr>
                                                <td colspan="4">{{ __('messages.no_data_available') }}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br>
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                            {{ __('messages.save') }}
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
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
  //group routes
    var parentName = "{{ config('constants.api.parent_name') }}";
    var staffName = "{{ config('constants.api.staff_name') }}";
    var studentName = "{{ config('constants.api.student_name') }}";
    var groupList = "{{ route('admin.group') }}";
    var staffDetails = "{{ config('constants.api.employee_details') }}";
    var studentDetails = "{{ config('constants.api.student_details') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/group.js') }}"></script>

@endsection

