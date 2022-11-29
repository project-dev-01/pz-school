@extends('layouts.admin-layout')
@section('title','Copy Subject Teacher Assign')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Copy Subject Teacher Assign</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv"> The Next Session Was Copy Subject Teacher Assign<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <!-- end row-->
                    <form id="copySessionForm" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="academic_session_id">Copy From Academic Year<span class="text-danger">*</span></label>
                                    <select id="academic_session_id" class="form-control" name="academic_session_id">
                                        <option value="">Choose Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="copy_academic_session_id">Copy To Academic Year<span class="text-danger">*</span></label>
                                    <select id="copy_academic_session_id" class="form-control" name="copy_academic_session_id">
                                        <option value="">Choose Academic Year</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                        Create Copy
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div> <!-- end card-body -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div>
<!-- end row -->
@endsection
@section('scripts')
<script>
    var copySessionUrl = "{{ config('constants.api.acdemic_copy_subject_teacher_assign') }}";
</script>
<script src="{{ asset('public/js/custom/copy_next_session_aca_exm.js') }}"></script>
@endsection