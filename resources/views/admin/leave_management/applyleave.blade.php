@extends('layouts.admin-layout')
@section('title','Leave Management')
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.leave_management') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">
                                {{ __('messages.already_taken_leave_details') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="alreadyTakenLeave" class="table table-centered table-borderless table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.leave_type') }}</th>
                                            <th>{{ __('messages.total_leave') }}</th>
                                            <th></th>
                                            <th>{{ __('messages.remaining_leave') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leave_taken_history as $val)
                                        <tr>
                                            <td>{{ $val['leave_name'] }}</td>
                                            <td>{{ $val['total_leave'] }}</td>
                                            <td>{{ $val['used_leave'] ? $val['used_leave'] : 0 }}</td>
                                            <td>{{ $val['total_leave'] - $val['used_leave'] }}</td>
                                        </tr> 
                                        @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center;">{{ __('messages.no_data_available') }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end row -->
                        <!--Leave Application -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="nav-link">
                                {{ __('messages.leave_application') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="staffLeaveApply" method="post" action="{{ route('admin.leave_management.add') }}" autocomplete="off" novalidate>
                                <!--1st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="leave_type">{{ __('messages.leave_type') }}<span class="text-danger">*</span></label>
                                            <select id="leave_type" name="leave_type" class="form-control">
                                                <option value="">{{ __('messages.select_leave_type') }}</option>
                                                @forelse ($get_leave_types as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.leave_from') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="frm_ldate" class="form-control" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="frm_ldate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.to') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="to_ldate" class="form-control" placeholder="{{ __('messages.dd_mm_yyyy') }}" id="to_ldate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="changelev">{{ __('messages.reason(s)') }}<span class="text-danger">*</span></label>
                                            <select id="changelevReasons" class="form-control" name="changelevReasons">
                                                <option value="">{{ __('messages.select_reason') }}</option>
                                                @forelse ($get_leave_reasons as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_leave">{{ __('messages.total_leave_days') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="number" name="total_leave" class="form-control" id="total_leave">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="remarks_div" style="display:none;">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.remarks') }}</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" name="remarks" class="form-control" id="remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="document">{{ __('messages.attachment_file') }}</label>

                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="homework_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="document">{{ __('messages.choose_file') }}</label>
                                                </div>
                                            </div>
                                            <span id="file_name"></span>

                                        </div>
                                    </div>
                                </div>
                                <!--3rd row-->
                                <br />
                                <div class="clearfix mt-4">
                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="float:right;">{{ __('messages.apply') }}</button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!--Last Leave Taken -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.leave_history') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="staff-leave-list" class="table w-100 nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.name') }}</th>
                                                        <th>{{ __('messages.leave_type') }}</th>
                                                        <th>{{ __('messages.leave_from') }}</th>
                                                        <th>{{ __('messages.to_from') }}</th>
                                                        <th>{{ __('messages.reason') }}</th>
                                                        <th>{{ __('messages.document') }}</th>
                                                        <th>{{ __('messages.status') }}</th>
                                                        <th>{{ __('messages.apply_date') }}</th>
                                                        <th>{{ __('messages.action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-box -->
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var StaffDocUrl = "{{ asset('public/admin-documents/leaves/') }}";
    var StaffLeaveList = "{{ route('admin.leave_management.apply_list') }}";
    var reuploadFileUrl = "{{ route('admin.reupload_file.add') }}";
</script>
<script src="{{ asset('public/js/custom/staff_apply_leave.js') }}"></script>
@endsection