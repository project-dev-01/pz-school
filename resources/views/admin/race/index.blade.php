@extends('layouts.admin-layout')
@section('title','Race')
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
                <h4 class="page-title">Race</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Race</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addRaceModal">Add Race</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0" id="race-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Race Name</th>
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
    @include('admin.race.add')
    @include('admin.race.edit')
</div>
<!-- container -->
@endsection
@section('scripts')

<script>
  //race routes
    var raceList = "{{ route('admin.race.list') }}";
    var raceDetails = "{{ route('admin.race.details') }}";
    var raceDelete = "{{ route('admin.race.delete') }}";
</script>

<script src="{{ asset('js/custom/race.js') }}"></script>

@endsection