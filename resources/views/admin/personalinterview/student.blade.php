@extends('layouts.admin-layout')
@section('title',' ' . __('messages.personal_interview') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<!-- <link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}"> -->

<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">
	
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
					</ol>-->
				</div>
                <h4 class="page-title">{{ __('messages.personal_interview') }}</h4>
			</div>
		</div>
	</div>
    <!-- end page title -->
	
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.select_ground') }}
						</h4>
					</li>
				</ul><br>
					<div class="card-body">
						@if($message = Session::get('success'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>{{ $message }}</strong>
						</div>
						@endif
						@if($message = Session::get('errors'))
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>{{ $message }}</strong>
						</div>
						@endif
						<form id="bystudentfilter" method="post" action="{{ route('admin.personalinterview.store') }}" autocomplete="off">
						@csrf
							<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="btwyears">{{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
											<select id="btwyears" class="form-control" name="year" required>
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
												<label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
												<select id="department_id" name="department_id" class="form-control" required>
													<option value="">{{ __('messages.select_department') }}</option>
														@forelse($department as $r)
														<option value="{{$r['id']}}">{{$r['name']}}</option>
														@empty
														@endforelse
												</select>
												</div>
											</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="changeClassName">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
											<select id="changeClassName" class="form-control" name="class_id" required>
												<option value="">{{ __('messages.select_grade') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3" id="section_drp_div">
										<div class="form-group">
											<label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span>
											</label>
											<select id="sectionID" class="form-control" name="section_id" required>
												<option value="">{{ __('messages.select_class') }}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="semester_id">{{ __('messages.semester') }}<span class="text-danger">*</span></label>
											<select id="semester_id" class="form-control" name="semester_id" required>
												<option value="0">{{ __('messages.select_semester') }}</option>
												@forelse($semester as $sem)
												<option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-3 d-none">
										<div class="form-group">
											<label for="session_id">{{ __('messages.session') }}</label>
											<select id="session_id" class="form-control" name="session_id">
												<option value="0">{{ __('messages.select_session') }}</option>
												@forelse($session as $ses)
												<option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="interview_date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
											<input type="date" name="interview_date" id="interview_date" class="form-control" placeholder="{{ __('messages.yyyy_mm_dd') }}" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										
										<label for="student_id">{{ __('messages.student') }}<span class="text-danger">*</span>
										</label>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="student_id" class="form-control" name="student_id" required>
												<option value="">{{ __('messages.select') }}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_situation">{{ __('messages.personalinterview_situation')}}<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_situation" name="question_situation" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_improved">{{ __('messages.personalinterview_improved')}}<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_improved" name="question_improved" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_tried">{{ __('messages.personalinterview_tried')}}
									<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_tried" name="question_tried" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_future">{{ __('messages.personalinterview_future')}}<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_future" name="question_future" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_parent">{{ __('messages.personalinterview_parent')}}<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_parent" name="question_parent" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-3">  <label for="question_feedback">{{ __('messages.personalinterview_feedback')}}<span class="text-danger">*</span>
									</label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<textarea id="question_feedback" name="question_feedback" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<input type="hidden" name="id" value="">
								<button class="btn btn-success" type="submit"> {{ __('messages.save')}} </button>
							</form>
							
						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
				
			</div>
			<!-- end row -->
			
			
			
					
</div> <!-- container -->

@endsection
@section('scripts')
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
	toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
	var sectionByClass = "{{ config('constants.api.section_by_class') }}";
	var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
	var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
	var getInterviewData = "{{ config('constants.api.getInterviewData') }}";
	// default image test
	var teacher_id = null;
	var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
	var downloadFileName = "{{ __('messages.by_student') }}";
	var getStudentList = "{{ config('constants.api.get_student_details') }}";
	var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
	// localStorage variables
	var exam_result_by_student_storage = localStorage.getItem('admin_exam_result_by_student_details');


	function savealert()
	{
		toastr.success("Personal Interview Information Saved Successfully");
	}
</script>
<script src="{{ asset('js/custom/student_interview_kinder.js') }}"></script>

@endsection																																																																																		