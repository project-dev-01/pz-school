@extends('layouts.admin-layout')
@section('title','Time Table')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.time_table') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.time_table') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Weekly</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <!-- <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addToDoTask">Add To Do Task</button> -->
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table table-striped mb-0 table-centered" id="task-table">
                        <thead>
                            <th width="125">{{ __('messages.time') }}</th>
                            @foreach($weekDays as $day)
                            <th>{{ $day }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    08:00 - 08:30
                                </td>
                                <td>English<br>Teacher: David
                                </td>
                                <td>Mathematics<br>Teacher: Smith</td>
                                <td rowspan="6" class="align-middle text-center" style="background-color:#f0f0f0">
                                 New Year Holiday
                                </td>
                                <td>Natural Sciences<br>Teacher: Taylor</td>
                                <td>Geography<br>Teacher: Starc</td>
                                <td rowspan="6" class="align-middle text-center" style="background-color:#f0f0f0">
                                 Public Holiday
                                </td>
                                <td rowspan="6" class="align-middle text-center" style="background-color:#f0f0f0">
                                 Public Holiday
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    08:30 - 09:30
                                </td>
                                <td>Mathematics<br>Teacher: Smith</td>
                                <td>English<br>Teacher: David</td>
                                <td>Civics Education<br>Teacher: Mitcheal</td>
                                <td>History<br>Teacher: Cameron</td>
                            </tr>
                            <tr>
                                <td>
                                    09:30 - 10:00
                                </td>
                                <td>Natural Sciences<br>Teacher: Taylor</td>
                                <td>Civics Education<br>Teacher: Mitcheal</td>
                                <td>History<br>Teacher: Cameron</td>
                                <td>Geography<br>Teacher: Starc</td>
                            </tr>
                            <tr>
                                <td>
                                    10:00 - 10:30
                                </td>
                                <td>English<br>Teacher: David</td>
                                <td>History<br>Teacher: Cameron</td>
                                <td>Geography<br>Teacher: Starc</td>
                                <td>Mathematics<br>Teacher: Smith</td>
                            </tr>
                            <tr>
                                <td>
                                    10:30 - 11:00
                                </td>
                                <td>Geography<br>Teacher: Starc</td>
                                <td>Civics Education<br>Teacher: Mitcheal</td>
                                <td>Natural Sciences<br>Teacher: Taylor</td>
                                <td>History<br>Teacher: Cameron</td>
                            </tr>
                            <tr>
                                <td>
                                    11:00 - 11:30
                                </td>
                                <td>History<br>Teacher: Cameron</td>
                                <td>Geography<br>Teacher: Starc</td>
                                <td>Natural Sciences<br>Teacher: Taylor</td>
                                <td>Civics Education<br>Teacher: Mitcheal</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
</div>
<!-- container -->
@endsection