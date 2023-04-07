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
                <h4 class="page-title">{{ __('messages.student_promotion') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.student_promotion') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="promotionFilter" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}<span class="text-danger">*</span></label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="">{{ __('messages.select_semester') }}</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            {{ __('messages.filter') }}
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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">{{ __('messages.the_next_session_was_transferred') }}<h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <!-- end row-->
                    <form id="promoteStudentForm" method="post" action="{{ route('admin.promotion.add') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_year">{{ __('messages.promote_to_academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="promote_year" class="form-control" name="promote_year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promoteClassID">Promote to standard<span class="text-danger">*</span></label>
                                    <select id="promoteClassID" class="form-control" name="promote_class_id">
                                        <option value="">{{ __('messages.select_standard') }}</option>
                                        @forelse ($classes as $class)
                                        <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_semester_id">{{ __('messages.promote_to_semester') }}<span class="text-danger">*</span></label>
                                    <select id="promote_semester_id" class="form-control" name="promote_semester_id">
                                        <option value="">{{ __('messages.select_semester') }}</option>
                                        @foreach($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promote_session_id">{{ __('messages.promote_to_session') }}<span class="text-danger">*</span></label>
                                    <select id="promote_session_id" class="form-control" name="promote_session_id">
                                        <option value="">{{ __('messages.select_session') }}</option>
                                        @foreach($session as $ses)
                                        <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div><br>
                        {{ __('messages.student_will_not_appear') }}<br>
                        <div class="table-responsive">
                            <table class="table table-bordered w-100 nowrap" id="showStudentDetails">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllchkbox"></th>
                                        <th>#</th>
                                        <th>{{ __('messages.student_name') }}</th>
                                        <th>{{ __('messages.register_no') }}</th>
                                        <th>{{ __('messages.promote_to_class') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.promotion') }}
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
    var studentImg = "{{ asset('public/users/images/') }}";
</script>
<script src="{{ asset('public/js/custom/promotion.js') }}"></script>
@endsection