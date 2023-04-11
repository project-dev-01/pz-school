@extends('layouts.admin-layout')
@section('title','Edit Staff Leave Assign')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">{{ __('messages.staff_leave_assign') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.edit_staff_leave_assign') }}
                            <h4>
                    </li>
                </ul>
                <div class="card-body">
                    <form id="edit-staff-leave-assign-form" method="post" action="{{ route('admin.staff_leave_assign.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="staff_id">{{ __('messages.staff_name') }}</label>
                                    <input type="hidden" name="staff_id" value="{{$staff['staff_id']}}">
                                    <input type="text"  value="{{$staff['staff_name']}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('messages.leave_days') }}<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                            @foreach($staff_leave as $key=>$leave)
                            <input type="hidden" name="leave[{{$key}}][id]" value="{{$leave['id']}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" id="leave_type" name="leave[{{$key}}][leave_type]">
                                            @forelse($leave_type as $type)
                                                @if($type['id']==$leave['leave_type_id'])
                                                <option value="{{$type['id']}}" Selected>{{$type['name']}}</option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text category_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="leave_days" name="leave[{{$key}}][leave_days]" value="{{$leave['leave_days']}}" class="form-control leave_days" placeholder="{{ __('messages.enter_leave_days') }}">
                                        <span class="text-danger error-text leave_days_error"></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <div class="form-group">
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary">{{ __('messages.back') }}</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('messages.update') }}</button>
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
    var staffLeaveAssignList = "{{ route('admin.staff_leave_assign.list') }}";
    var staffLeaveAssignIndex = "{{ route('admin.staff_leave_assign') }}";
    
</script>
<script src="{{ asset('public/js/custom/staff_leave_assign.js') }}"></script>

@endsection

