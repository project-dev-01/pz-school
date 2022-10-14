@extends('layouts.admin-layout')
@section('title','Promotion')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Student Promotion</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">Student Promotion<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="promotionFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">Standard<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">Select Standard</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">Class<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">Semester<span class="text-danger">*</span></label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Session<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row" id="show_promotion_details" style="display: none;">
        <div class="col-xl-12">
            <div class="card">
                <div style="border-bottom: 2px solid blue;">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="nav-link">
                                The Next Session Was Transferred To The Student
                                <h4>
                        </div>

                    </div> <!-- end row -->
                </div>
                <br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div>
                                        <p style="color:#0b8397"><b>Instructions:</b></p>
                                        <ol style="color:#0b8397">
                                            <li>Your design preferences (Color, style, shapes, Fonts, others) </li>
                                            <li>Tell me, why is your item different? </li>
                                            <li>Do you want to bring up a specific feature of your item? If yes, please tell me </li>
                                            <li>Do you have any preference or specific thing you would like to change or improve on your item page? </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div><br>
                    <!-- end row-->

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Carry Forward Due in Next Session</label>
                    </div><br>
                    <form id="promoteStudentForm" method="post" action="{{ route('admin.promotion.add') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="btwyears">Promote to academic year<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
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
                                    <label for="promoteClassID">Promote to standard<span class="text-danger">*</span></label>
                                    <select id="promoteClassID" class="form-control" name="promote_class_id">
                                        <option value="">Select Standard</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="promoteSectionID">Promote to class<span class="text-danger">*</span></label>
                                    <select id="promoteSectionID" class="form-control" name="promote_section_id">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_semester_id">Promote to semester<span class="text-danger">*</span></label>
                                    <select id="promote_semester_id" class="form-control" name="promote_semester_id">
                                        <option value="">Select Semester</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_session_id">Promote to session<span class="text-danger">*</span></label>
                                    <select id="promote_session_id" class="form-control" name="promote_session_id">
                                        <option value="">Select Session</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="showStudentDetails">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Register No</th>
                                        <th>Promotion Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                    Promotion
                                </button>
                            </div>
                        </div> <!-- end table-responsive-->

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
    var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
    var getStudentListByClassSectionUrl = "{{ config('constants.api.get_student_by_class_section_sem_ses') }}";
    // default image test
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
</script>
<script src="{{ asset('public/js/custom/promotion.js') }}"></script>
@endsection