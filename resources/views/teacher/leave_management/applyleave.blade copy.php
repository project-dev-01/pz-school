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
                        <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                            <li class="nav-item">
                                <h4 class="nav-link">
                                    <span data-feather="airplay" class="icon-dual" id="span-parent"></span> Leave Can Avail
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3" id="top-header">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="">
                                                    <i class="fas fa-hat-wizard font-24"></i>
                                                    <p class="text-muted mb-1">Annual</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                            <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                        </div>

                                    </div>
                                </div><!-- end col-->
                                <div class="col-lg-3" id="top-header">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="">
                                                    <i class="fas fa-clinic-medical font-24"></i>
                                                    <p class="text-muted mb-1">Medical</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="my-1" style="color:blue"><span data-plugin="counterup">2</span></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                            <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                        </div>

                                    </div>
                                </div><!-- end col-->
                                <div class="col-lg-3" id="top-header">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="">
                                                    <i class="fas fa-compass font-24"></i>
                                                    <p class="text-muted mb-1">Compassionate</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-right">
                                                    <h3 class="my-1" style="color:blue"><span data-plugin="counterup">1</span></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                            <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                        </div>

                                    </div>
                                </div><!-- end col-->
                                <div class="col-lg-3">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="">
                                                    <i class="fas fa-receipt font-24"></i>
                                                    <p class="text-muted mb-1">Unpaid</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="my-1" style="color:blue"><span data-plugin="counterup">0</span></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="progress progress-sm m-0">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                            <h6 class="text-uppercase"><span class="text-muted float-right">Total Strength</span></h6>
                                        </div>
                                    </div> <!-- end card-box-->
                                </div>
                            </div><!-- end col-->
                        </div> <!-- end row -->
                        <!--General Details -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                            <li class="nav-item">
                                <h4 class="nav-link">
                                    <span data-feather="folder" class="icon-dual" id="span-parent"></span> General Details
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <form id="staffLeaveApply" method="post" action="{{ route('teacher.leave_management.add') }}" autocomplete="off" novalidate>
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
                                <div class="clearfix mt-4">
                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Apply</button>
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
                        <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                            <li class="nav-item">
                                <h4 class="nav-link">
                                    <span data-feather="bookmark" class="icon-dual" id="span-parent"></span> Leave History
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
    var StaffLeaveList = "{{ route('teacher.leave_management.list') }}";
</script>
<script src="{{ asset('js/custom/staff_apply_leave.js') }}"></script>
@endsection