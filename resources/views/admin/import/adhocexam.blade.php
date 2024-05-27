@extends('layouts.admin-layout')
@section('title','Adhoc Exam Import')
@section('component_css')
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
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
							<form id="resultsByPaper"  method="post" enctype="multipart/form-data" action="{{ route('admin.exam.adhocexamdownloadexcel') }}">
							{{ csrf_field() }}
								
								<div class="row">
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
									<div class="col-md-3">
										<div class="form-group">
											<label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span></label>
											<select id="sectionID" class="form-control" name="section_id" required>
												<option value="">{{ __('messages.select_class') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="subjectID">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
											<select id="subjectID" class="form-control" name="subject_id" required>
												<option value="">{{ __('messages.select_subject') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
											<select id="examnames" class="form-control" name="exam_id" required>
												<option value="">{{ __('messages.select_exams') }}</option>
												@forelse($exam as $ex)
												<option value="{{$ex['id']}}">{{$ex['name']}}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="interview_date">{{ __('messages.date') }}<span class="text-danger">*</span></label>
											<div class="input-group input-group-merge">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<span class="fas fa-calendar-alt"></span>
													</div>
												</div>
												<input type="text" class="form-control" name="exam_date" id="exam_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" required>
											</div>
                                    	</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="score_type">{{ __('messages.score_type') }}<span class="text-danger">*</span></label>
											<select class="form-control" name="score_type" id="score_type">
												<option value="">{{ __('messages.select') }}</option>
												<option value="Grade">{{ __('messages.grade') }}</option>
												<option value="Mark">{{ __('messages.mark') }}</option>
												<option value="Points">{{ __('messages.points') }}</option>
												<option value="Freetext">{{ __('messages.freetext') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group"><br>
									<button type="submit" class="btn btn-warning" id="downloadexcel1"><i class="fa fa-download"></i> Download Excel format</button>
									</div>
									</div>
									
									
								</div>
							</div>
							
							
							
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
							<div class="form-group" style="text-align: center;">
								<div class="card-body" style="margin-left: 17px;">
									<label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
									<input type="file" name="file" id="fileInput" accept=".csv" required />
								</div>  
								<input type="button" name="upload" id="submitbtn" class="btn btn-success" value="{{ __('messages.submit') }}" style="display:none;">   
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- content start  -->
	<div class="row " id="exammark_preview" style="display:none;">
		<div class="col-md-12" >
		<h4 class="page-title">{{ __('messages.exam_import') }}</h4>
			<table class="table" id="headerdata1">
				
				
			</table>
		</div>
		<div class="col-md-12 studentmark" >
			<button class="btn btn-success" style="float:right;">{{ __('messages.new_record') }} </button><button class="btn btn-warning" style="float:right;">{{ __('messages.existing_record') }}</button><button class="btn btn-danger" style="float:right;">{{ __('messages.modify_data') }}</button> <br> <br>
		</div>
		<div class="col-md-12 studentmark">
			<div class="card mb-0">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<h4 class="nav-link">{{ __('messages.compare_report') }} <h4>
						</li>
						</ul><br>
						<div class="card-body">
							<div class="row">   <div class="col-12">
								<table class="table">
									<thead>
										<tr>
											<th># </th>
											<th>{{ __('messages.register_no') }}</th>
											<th>{{ __('messages.student_name') }}</th>
											<th>{{ __('messages.mark') }}</th>
										</tr>
									</thead>
									<tbody id="markdatas">
									</tbody>									
								</table>
								<center>
									<a href="{{route('admin.exam.import')}}" class="btn btn-warning"> <i class="fe fe-refresh"></i>  Re-Upload  </a> <input type="button" name="upload" class="btn btn-success" data-toggle="modal" data-target="#markModal" value="{{ __('messages.upload') }}">  </center> 
								
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div id="markModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<form  method="post" enctype="multipart/form-data" action="{{ route('admin.exam.uploadmark') }}">
								{{ csrf_field() }}
							<div class="modal-header">
								
								<h4 class="modal-title">{{ __('messages.mark_info') }}</h4> 
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>
								{{ __('messages.promotion_message') }}</p>
							</div> 
							
							<div class="modal-footer">
								<button type="button" id="savestudentmarks" class="btn btn-success" >{{ __('messages.save') }}</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
			<!-- /Content End -->
			<br>
			
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
				<script src="{{ asset('js/validation/validation.js') }}"></script>
				
				<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
				<script>
					var savemarks="{{ route('admin.exam.adhocuploadmark') }}";
					var newRoute = "{{ route('admin.exam.import.adhocadd') }}";
					var examdownloadexcel = "{{ route('admin.exam.examdownloadexcel') }}";
					var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
					var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
					var examBySubjects = "{{ config('constants.api.exam_by_subjects') }}";					
    				var subjectByPapers = "{{ config('constants.api.subject_by_papers') }}";
									
    				var ExamPaperDetails = "{{ config('constants.api.exam_paper_details') }}";
					var getExamPaperResults = "{{ config('constants.api.get_exam_paper_res') }}";
					var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
					var getAssignClassSubjUrl = "{{ config('constants.api.get_assign_class_subjects') }}";
					
					var academic_session_id = "{{ Session::get('academic_session_id') }}";
					var teacherID = null;
					// default image test
					var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
					var downloadFileName = "{{ __('messages.exam_paper_result') }}";
					// localStorage variables
					var exam_paper_result_storage = localStorage.getItem('admin_exam_paper_result_details');
					var marktext="{{ __('messages.alertexamupload_mark') }}";
					var pointstext="{{ __('messages.alertexamupload_points') }}";
					var freetext="{{ __('messages.alertexamupload_freetext') }}";
					var infotext="{{ __('messages.alertexamupload_info') }}";
				</script>
				<script src="{{ asset('js/custom/adhocexam_import.js') }}"></script>
				

			@endsection												