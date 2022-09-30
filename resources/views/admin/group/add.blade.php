@extends('layouts.admin-layout')
@section('title','Add Group')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Group
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="groupForm" method="post" action="{{ route('admin.group.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Group Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Group Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">Description</label>
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
                                    <label for="staff">Add Staff<span class="text-danger">*</span></label>
                                    <input type="text" id="staff" name="staff" class="form-control" placeholder="Enter Staff Name">
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
                                                <th>Staff Name</th>
                                                <th>Staff Department</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="staff_table">
                                            <tr>
                                                <td colspan="4">No Data Available</td>
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
                                    <label for="student">Add Student<span class="text-danger">*</span></label>
                                    <input type="text" id="student" name="student" class="form-control" placeholder="Enter Student Name">
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
                                                <th>Student Name</th>
                                                <th>Student Class</th>
                                                <th>Student Section</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student_table">
                                            <tr>
                                                <td colspan="5">No Data Available</td>
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
                                    <label for="parent">Add Parent<span class="text-danger">*</span></label>
                                    <input type="text" id="parents" name="parent" class="form-control" placeholder="Enter Parent Name">
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
                                                <th>Parent Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            <tr>
                                                <td colspan="4">No Data Available</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br>
                        <div class="form-group text-center m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
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
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/group.js') }}"></script>

@endsection

