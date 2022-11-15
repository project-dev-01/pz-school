@extends('layouts.admin-layout')
@section('title','Add Hostel Group')
@section('css')
<link href="{{ asset('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Hostel Group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Hostel Group
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="hostelGroupForm" method="post" action="{{ route('admin.hostel_group.add') }}" autocomplete="off">
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
                                    <label for="incharge_staff">Incharge Staff</label>
                                    <select class="form-control" name="incharge_staff">
                                        <option value="">Select Incharge Staff</option>
                                        @forelse($staff as $st)
                                        <option value="{{$st['id']}}">{{$st['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="incharge_student">Incharge Student</label>
                                    <select class="form-control" name="incharge_student">
                                        <option value="">Select Incharge Student</option>
                                        @forelse($student as $stu)
                                        <option value="{{$stu['id']}}">{{$stu['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="student">Student</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="student[]" multiple="multiple" data-placeholder="Choose The Student">
                                        <option value="">Select Student</option>
                                        @forelse($student as $stu)
                                        <option value="{{$stu['id']}}">{{$stu['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color"> Color <span class="text-danger">*</span></label>
                                    <input type="text" id="color" name="color" class="form-control color" placeholder="Choose Color" value="#4a81d4">
                                </div>
                            </div>
                        </div>
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
    //HostelGroup routes
    var hostelGroupList = "{{ route('admin.hostel_group.list') }}";
    var hostelGroupDetails = "{{ route('admin.hostel_group.details') }}";
    var hostelGroupDelete = "{{ route('admin.hostel_group.delete') }}";
</script>

<script src="{{ asset('public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/hostel_group.js') }}"></script>

@endsection