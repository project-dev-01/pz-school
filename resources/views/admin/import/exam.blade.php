@extends('layouts.admin-layout')
@section('title','Employee Import')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
@section('content')
<!-- Page Content -->
<div class="content container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
					</ol>
				</div>
                <h4 class="page-title">{{ __('messages.exam_import') }}</h4>
			</div>
		</div>
	</div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.exam_import') }}<h4>
						</li>
						</ul><br>
						<div class="card-body">
							<form id="resultsByPaper" autocomplete="off" method="post" enctype="multipart/form-data" action="{{ route('admin.exam.import.add') }}">
							 {{ csrf_field() }}
								<div class="row"> 
									<div class="col-12">
										<div class="col-sm-12 col-md-12">
											<div class="dt-buttons" style="float:right;"> 
												<a href="{{ config('constants.image_url').'/common-asset/uploads/sample Exam.csv'}}" target="_blank"><button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button"><span>{{ __('messages.download_sample_csv') }}</span></button></a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
											<select id="department_id" name="department_id" class="form-control">
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
											<select id="changeClassName" class="form-control" name="class_id">
												<option value="">{{ __('messages.select_grade') }}</option>
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
											<label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
											<select id="examnames" class="form-control" name="exam_id">
												<option value="">{{ __('messages.select_exams') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
											<select id="subjectID" class="form-control" name="subject_id">
												<option value="">{{ __('messages.select_subject') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="semester_id">{{ __('messages.semester') }}</label>
											<select id="semester_id" class="form-control" name="semester_id" required>
												<option value="0">{{ __('messages.select_semester') }}</option>
												@forelse($semester as $sem)
												<option value="{{$sem['id']}}" {{ $current_semester == $sem['id'] ? 'selected' : ''}}>{{$sem['name']}}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="session_id">{{ __('messages.session') }}</label>
											<select id="session_id" class="form-control" name="session_id" required>
												<option value="0">{{ __('messages.select_session') }}</option>
												@forelse($session as $ses)
												<option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<!-- <div class="col-md-3">
										<div class="form-group">
										<label for="btwyears">Perspective<span class="text-danger">*</span></label>
										<select id="btwyears" class="form-control" name="year">
										<option value="">Select Perspective</option>
										<option value="2">Knowledge And Skills</option>
										<option value="1">Thinking</option>                                        
										<option value="1">Musics</option>
										</select>
										</div>
									</div>-->
								</div>
							</div>
							@if(count($errors) > 0)
							<div class="alert alert-danger">
								{{ __('messages.upload_validation_error') }}<br><br>
								<ul>
									@foreach($errors as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							
							@if($message = Session::get('success'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
							</div>
							@endif
							
							<div class="form-group" style="text-align: center;">
								<div class="card-body" style="margin-left: 17px;">
									<label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
									<input type="file" name="file" accept=".csv" required />
								</div>  
								<input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">   
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<!-- /Content End -->
			<br>
			<!-- content start  -->
			<div class="row d-none">
				<div class="col-md-12" >
					<button class="btn btn-success" style="float:right;">{{ __('messages.new_record') }} </button><button class="btn btn-warning" style="float:right;">{{ __('messages.existing_record') }}</button><button class="btn btn-danger" style="float:right;">{{ __('messages.modify_data') }}</button> <br> <br>
				</div>
				<div class="col-md-12">
					<div class="card mb-0">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<h4 class="nav-link">{{ __('messages.compare_report') }}<h4>
								</li>
								</ul><br>
								<div class="card-body">
									<div class="row">   <div class="col-12">
										<table class="table">
											<tr>
												<th>{{ __('messages.sno') }} sno </th>
												<th>{{ __('messages.student_id') }}</th>
												<th>{{ __('messages.student_name') }}</th>
												<th>{{ __('messages.year') }}</th>
												<th>{{ __('messages.department') }}</th>
												<th>{{ __('messages.grade') }}</th>
												<th>{{ __('messages.class') }}</th>
											</tr>
											<tr>
												<th> 1 </th>
												<th class="btn btn-warning"> 900000001</th>
												<th> A</th>
												<th> 2023</th>
												<th class="btn-danger btn" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="Previous Data : Kinder"> Primary</th>
												<th> 1</th>
												<th> 1</th>
											</tr>
											<tr>
												<th> 2 </th>
												<th class="btn btn-warning"> 900000002</th>
												<th class="btn-danger btn" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="Previous Data : Boy"> B</th>
												
												<th> 2023</th>
												<th> Primary</th>
												<th> 1</th>
												<th> 1</th>
											</tr> 
											<tr>
												<th> 3 </th>
												<th class="btn btn-success"> 900000003</th>
												<th> C</th>
												<th> 2023</th>
												<th> Primary</th>
												<th> 1</th>
												<th> 1</th>
											</tr>
											
										</table>
										<center><input type="button" name="upload" class="btn btn-success" data-toggle="modal" data-target="#myModal" value="{{ __('messages.save') }}">  </center> 
										
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									
									<h4 class="modal-title">{{ __('messages.info') }}</h4> 
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<p>{{ __('messages.this_information_already_exist') }}
										
										
										<br>
										{{ __('messages.are_your_confirm_to_overwrite_informations') }}</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('messages.close') }}</button>
						 		</div>
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Page Content -->
				@endsection
				@section('scripts')
				<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
				<!-- plugin js -->
				<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
				<!-- Chart JS -->
				<script src="{{ asset('libs/chart.js/Chart.bundle.min.js') }}"></script>
				<script src="{{ asset('libs/morris.js06/morris.min.js') }}"></script>
				<script src="{{ asset('libs/raphael/raphael.min.js') }}"></script>
				
				<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
				<script src="{{ asset('toastr/toastr.min.js') }}"></script>
				<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
				<script>
					toastr.options.preventDuplicates = true;
				</script>
				<!--<script src="{{ asset('js/validation/validation.js') }}"></script>-->
				
				<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
				<script>
					var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
					var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
					var examBySubjects = "{{ config('constants.api.exam_by_subjects') }}";
					
					var getExamPaperResults = "{{ config('constants.api.get_exam_paper_res') }}";
					var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
					
					var teacherID = null;
					// default image test
					var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
					var downloadFileName = "{{ __('messages.exam_paper_result') }}";
					// localStorage variables
					var exam_paper_result_storage = localStorage.getItem('admin_exam_paper_result_details');
				</script>
				<script src="{{ asset('js/custom/exam_import.js') }}"></script>
			@endsection												