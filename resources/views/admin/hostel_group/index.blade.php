@extends('layouts.admin-layout')
@section('title','Hostel Group')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                        <!-- <li class="breadcrumb-item"><a href="{{ route('admin.add_classes')}}">Add Class</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title">Hostel Group</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title"> Hostel Group</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <a type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" href="{{ route('admin.hostel_group.create')}}">Add Hostel Group</a>
                    </div>
                </div>
                </p>
                
                <div class="table-responsive">
                    <table class="table mb-0" id="hostel-group-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Incharge Staff</th>
                                <th>Incharge Student</th>
                                <th>Student</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
</div>
<!-- container -->

@endsection
@section('scripts')
<script>
  //HostelGroup routes
    var hostelGroupList = "{{ route('admin.hostel_group.list') }}";
    var hostelGroupDetails = "{{ route('admin.hostel_group.details') }}";
    var hostelGroupDelete = "{{ route('admin.hostel_group.delete') }}";
    
    
</script>

<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/hostel_group.js') }}"></script>

@endsection