@extends('layouts.admin-layout')
@section('title','Edit Group')
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
                        <h4 class="navv">Edit Group
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="groupEditForm" method="post" action="{{ route('admin.group.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$group['id']}}">   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Group Name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Group Name" value="{{$group['name']}}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <input type="hidden" id="staffCount" class="form-control"  @if($staff) value="{{count($staff)}}" @else value="0" @endif>
                            <input type="hidden" id="studentCount" class="form-control"  @if($student)value="{{count($student)}}" @else value="0" @endif>
                            <input type="hidden" id="parentCount" class="form-control"  @if($parent)value="{{count($parent)}}" @else value="0" @endif>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.description') }}</label>
                                    <textarea class="form-control" name="description">{{$group['description']}}</textarea>
                                    <span class="text-danger error-text description_error"></span>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff">Add Staff</label>
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
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="staff_table">
                                            @if($staff)
                                                @foreach($staff as $key => $st)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <input type="hidden"  name="staff_id[]" value="{{$st['id']}}">
                                                    <td>{{$st['name']}}</td>
                                                    <td>{{$st['department_name']}}</td>
                                                    <td ></div><button type="button" class=" btn btn-danger removeStaff"><i class="fe-trash-2"></i> </button></td>
                                                </tr> 
                                                @endforeach
                                            @else     
                                                <tr>
                                                    <td colspan="4">No Data Available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student">Add Student</label>
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
                                                <th>{{ __('messages.student_name') }}</th>
                                                <th>{{ __('messages.class') }}</th>
                                                <th>Section</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student_table">
                                            @if($student)
                                                @foreach($student as $key => $stu)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <input type="hidden"  name="student_id[]" value="{{$stu['id']}}">
                                                    <td>{{$stu['name']}}</td>
                                                    <td>{{$stu['class_name']}}</td>
                                                    <td>{{$stu['section_name']}}</td>
                                                    <td ></div><button type="button" class=" btn btn-danger removeStudent"><i class="fe-trash-2"></i> </button></td>
                                                </tr> 
                                                @endforeach 
                                            @else     
                                                <tr>
                                                    <td colspan="5">No Data Available</td>
                                                </tr> 
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="parent">Add Parent</label>
                                    <input type="text" id="parents" name="parent" class="form-control" placeholder="Enter Parent Name">
                                    <div id="parent_list"></div>
                                    <span class="text-danger error-text parent_error"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped  text-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Parent Name</th>
                                                <th>{{ __('messages.email') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parent_table">
                                            @if($parent)
                                                @foreach($parent as $key => $p)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <input type="hidden"  name="parent_id[]" value="{{$p['id']}}">
                                                        <td>{{$p['name']}}</td>
                                                        <td>{{$p['email']}}</td>
                                                        <td ></div><button type="button" class=" btn btn-danger removeParent"><i class="fe-trash-2"></i> </button></td>
                                                    </tr> 
                                                @endforeach  
                                            @else     
                                                <tr>
                                                    <td colspan="4">No Data Available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br>
                        
                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Update
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

