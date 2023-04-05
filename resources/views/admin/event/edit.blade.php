@extends('layouts.admin-layout')
@section('title','Edit Event')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.event') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Edit Event
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="eventEditForm" method="post" action="{{ route('admin.event.update') }}" autocomplete="off">
                        @csrf<input type="hidden" name="id" value="{{$event['id']}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">{{ __('messages.title') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Name" value="{{$event['title']}}">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">{{ __('messages.type') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="">Select The Type</option>
                                        @foreach($type as $typ)
                                        <option value="{{$typ['id']}}" {{$event['type'] == $typ['id'] ? 'Selected':''}}>{{$typ['name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text type_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="audience">{{ __('messages.audience') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="edit_audience" name="audience">
                                        <option value="">Select The Audience</option>
                                        <option value="1" {{$event['audience'] == "1" ? 'Selected':''}}>EveryBody</option>
                                        <option value="2" {{$event['audience'] == "2" ? 'Selected':''}}>Selected Grade</option>
                                        <option value="3" {{$event['audience'] == "3" ? 'Selected':''}}>Selected Group</option>
                                        <!-- <option value="3">Selected Section</option> -->
                                    </select>
                                    <span class="text-danger error-text audience_error"></span>
                                </div>
                            </div>
                            @php $cla = 'style=display:none'; $gro = 'style=display:none'; @endphp
                            @if($event['audience']==2)
                            @php $cla = ''; @endphp
                            @endif

                            @if($event['audience']==3)
                            @php $gro = ''; @endphp
                            @endif

                            <div class="col-md-4" id="edit_class" {{$cla}}>
                                <div class="form-group">
                                    <label for="class">{{ __('messages.grade') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="class[]" id="edit_classes" multiple="multiple" data-placeholder="Choose ...">
                                        @forelse($class as $cla)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $event['selected_list']) as $info)
                                        @if($cla['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$cla['id']}}" {{ $selected }}>{{$cla['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text class_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4" id="edit_group_row" {{$gro}}>
                                <div class="form-group">
                                    <label for="group">{{ __('messages.group') }}</label>
                                    <select class="form-control select2-multiple" data-toggle="select2" name="group[]" id="edit_group" multiple="multiple" data-placeholder="Choose ...">
                                        @forelse($group as $gro)
                                        @php
                                        $selected = "";
                                        @endphp
                                        @foreach(explode(',', $event['selected_list']) as $info)
                                        @if($gro['id'] == $info)
                                        @php
                                        $selected = "Selected";
                                        @endphp
                                        @endif
                                        @endforeach
                                        <option value="{{$gro['id']}}" {{ $selected }}>{{$gro['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text group_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">{{ __('messages.start_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="{{ __('messages.yyyy_mm_dd') }}" class="form-control" name="start_date" id="edit_event_start_date" value="{{$event['start_date']}}">
                                    </div>
                                </div>
                                <span class="text-danger error-text start_date_error"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date">{{ __('messages.end_date') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="{{ __('messages.yyyy_mm_dd') }}" class="form-control" name="end_date" id="edit_event_end_date" value="{{$event['end_date']}}">
                                    </div>
                                    <span class="text-danger error-text end_date_error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-3">
                                    <div class="custom-control custom-checkbox form-check">
                                        <input type="checkbox" class="custom-control-input" name="all_day" id="allDay" {{$event['all_day'] == "on" ? 'checked':''}}>
                                        <label class="custom-control-label" for="allDay">{{ __('messages.all_day') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 time" {{$event['all_day'] == "on" ? 'style=display:none':''}}>
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input type="text" class="form-control edittimepicker" name="start_time" id="edit_start_time" placeholder="00:00" value="{{$event['end_time']}}">
                                    <span class="text-danger error-text start_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3 time" {{$event['all_day'] == "on" ? 'style=display:none':''}}>
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input type="text" class="form-control edittimepicker" name="end_time" id="edit_end_time" placeholder="00:00" value="{{$event['end_time']}}">
                                    <span class="text-danger error-text end_time_error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-3">
                                    <div class="custom-control custom-checkbox form-check">
                                        <input type="checkbox" class="custom-control-input" name="holiday" id="holiday" {{$event['holiday'] == "0" ? 'checked':''}}>
                                        <label class="custom-control-label" for="holiday">{{ __('messages.holiday') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.description') }}</label>
                                    <textarea class="form-control" name="description">{{$event['remarks']}}</textarea>
                                    <span class="text-danger error-text description_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                            {{ __('messages.update') }}
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
<script src="{{ asset('public/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('public/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('public/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('public/js/custom/event.js') }}"></script>

@endsection