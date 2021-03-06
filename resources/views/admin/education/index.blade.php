@extends('layouts.admin-layout')
@section('title','Education')
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
                    </ol>
                </div>
                <h4 class="page-title">Education</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Education</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addEducationModal">Add Education</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table dt-responsive nowrap w-100" id="education-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Education Name</th>
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
    @include('admin.education.add')
    @include('admin.education.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //education routes
    var educationList = "{{ route('admin.education.list') }}";
    var educationDetails = "{{ route('admin.education.details') }}";
    var educationDelete = "{{ route('admin.education.delete') }}";
</script>

<script src="{{ asset('public/js/custom/education.js') }}"></script>

@endsection