@extends('layouts.admin-layout')
@section('title','Hostel')
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
                <h4 class="page-title">Hostel</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Hostel</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <a href="{{ route('admin.add_classes')}}" class="btn btn-primary btn-rounded waves-effect waves-light">Add Class</a> -->
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addHostelModal">Add Hostel</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0 text-center" id="hostel-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hostel Name</th>
                                <th>Category</th>
                                <th>Warden</th>
                                <th>Remarks</th>
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
    <!--- end row -->
    @include('admin.hostel.add')
    @include('admin.hostel.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //hostel routes
    var hostelList = "{{ route('admin.hostel.list') }}";
    var hostelDetails = "{{ route('admin.hostel.details') }}";
    var hostelDelete = "{{ route('admin.hostel.delete') }}";
</script>

<script src="{{ asset('js/custom/hostel.js') }}"></script>

@endsection