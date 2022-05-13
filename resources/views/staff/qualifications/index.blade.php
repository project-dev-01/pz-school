@extends('layouts.admin-layout')
@section('title','Qualification')
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
                <h4 class="page-title">Qualification</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Qualification</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addqualifyModal">Add Qualification</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="qualification-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Qualification Name</th>
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
    @include('staff.qualifications.add')
    @include('staff.qualifications.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //qualification routes
    var qualifyList = "{{ route('staff.qualification.list') }}";
    var qualifyDetails="{{route('staff.qualification.details')}}";
    var qualifyDelete = "{{ route('staff.qualification.delete') }}";
</script>

<script src="{{ asset('js/custom/qualification.js') }}"></script>

@endsection