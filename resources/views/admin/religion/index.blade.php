@extends('layouts.admin-layout')
@section('title','Religion')
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
                <h4 class="page-title">Religion</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Religion</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addReligionModal">Add Religion</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="religion-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Religion Name</th>
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
    @include('admin.religion.add')
    @include('admin.religion.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //religion routes
    var religionList = "{{ route('admin.religion.list') }}";
    var religionDetails = "{{ route('admin.religion.details') }}";
    var religionDelete = "{{ route('admin.religion.delete') }}";
</script>

<script src="{{ asset('js/custom/religion.js') }}"></script>

@endsection