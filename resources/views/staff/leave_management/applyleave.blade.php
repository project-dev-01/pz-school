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
                <h4 class="page-title">Leave Management</h4>
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
                                <h4 class="navv">Already Taken Leave Details
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="alreadyTakenLeave" class="table table-centered table-borderless table-striped mb-0">
                                    <tbody>
                                        @forelse($leave_taken_history as $val)
                                        <tr>
                                            <td>{{ $val['leave_name'] }}</td>
                                            <td>:</td>
                                            <td>{{ $val['total_leave'] }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" style="text-align: center;">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end row -->
                        <!--General Details -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> General Details
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="staffLeaveApply" method="post" action="{{ route('staff.leave_management.add') }}" autocomplete="off" novalidate>
                                <!--1st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="leave_type">Leave Type<span class="text-danger">*</span></label>
                                            <select id="leave_type" name="leave_type" class="form-control">
                                                <option value="">Select Leave Type</option>
                                                @forelse ($get_leave_types as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">Leave From<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="frm_ldate" class="form-control" id="frm_ldate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">To<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" autocomplete="off" name="to_ldate" class="form-control" id="to_ldate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2st row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="changelev">Reason(s)<span class="text-danger">*</span></label>
                                            <select id="changelevReasons" class="form-control" name="changelevReasons">
                                                <option value="">Select Student</option>
                                                @forelse ($get_leave_reasons as $res)
                                                <option value="{{ $res['id'] }}">{{ $res['name'] }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="remarks_div" style="display:none;">
                                        <div class="form-group">
                                            <label for="heard">Remarks</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" name="remarks" class="form-control" id="remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="document">Attachment File</label>

                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" id="homework_file" class="custom-file-input" name="file">
                                                    <label class="custom-file-label" for="document">Choose file</label>
                                                </div>
                                            </div>
                                            <span id="file_name"></span>

                                        </div>
                                    </div>
                                </div>
                                <!--3rd row-->
                                <br />
                                <div class="form-group text-right m-b-0">
                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                        Apply
                                    </button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!--Last Leave Taken -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv"> Leave History
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="staff-leave-list" class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Leave Type</th>
                                                        <th>Leave From</th>
                                                        <th>To From</th>
                                                        <th>Reason</th>
                                                        <th>Document</th>
                                                        <th>Status</th>
                                                        <th>Apply Date</th>
                                                        <th>Action</th>
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
    var StaffLeaveList = "{{ route('staff.leave_management.list') }}";
    var reuploadFileUrl = "{{ route('staff.reupload_file.add') }}";
</script>
<script src="{{ asset('public/js/custom/staff_apply_leave.js') }}"></script>
@endsection