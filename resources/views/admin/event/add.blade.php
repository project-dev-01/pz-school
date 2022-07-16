@extends('layouts.admin-layout')
@section('title','Add Event')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Event</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Add Event
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="eventForm" method="post" action="{{ route('admin.event.add') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Title<span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title name">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Type<span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="">Select</option>
                                        @foreach($type as $typ)
                                        <option value="{{$typ['id']}}">{{$typ['name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text type_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="audience">Audience<span class="text-danger">*</span></label>
                                    <select class="form-control" id="audience" name="audience">
                                        <option value="">Select</option>
                                        <option value="1">EveryBody</option>
                                        <option value="2">Selected Class</option>
                                        <!-- <option value="3">Selected Section</option> -->
                                    </select>
                                    <span class="text-danger error-text audience_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4" id="class">
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <select class="form-control select2-multiple" data-toggle="select2"  name="class[]" id="classes" multiple="multiple" data-placeholder="Choose ...">
                                        @foreach($class as $cla)
                                            <option value="{{$cla['id']}}">{{$cla['name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text class_error"></span>
                                </div>
                            </div>
                                <!-- <div class="form-group" id="section">
                                    <label for="section">Section</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="section[]">
                                    </select>
                                    <span class="text-danger error-text section_error"></span>
                                </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Start Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="start_date" id="event_start_date" placeholder="YYYY/MM/DD">
                                    </div>
                                    <span class="text-danger error-text start_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date">End Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="end_date" id="event_end_date" placeholder="YYYY/MM/DD">
                                    </div>
                                    <span class="text-danger error-text end_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-3">
                                    <div class="custom-control custom-checkbox form-check">
                                        <input type="checkbox" class="custom-control-input" name="all_day" id="allDay" checked>
                                        <label class="custom-control-label" for="allDay">All Day</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 time" style="display:none">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input type="text"  class="form-control timepicker" name="start_time" id="add_start_time">
                                        <span class="text-danger error-text start_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3 time" style="display:none">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input type="text"  class="form-control timepicker" name="end_time" id="add_end_time">
                                        <span class="text-danger error-text end_time_error"></span>
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
                        
                        <div class="form-group text-right m-b-0">
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
  //event routes
    var eventList = "{{ route('admin.event') }}";
    
</script>
<script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/event.js') }}"></script>

@endsection

