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
    <div class="row ">
		<div class="col-md-12" >
			<table class="table">
				
				@php $row=0;@endphp
				
				@foreach($studentlist as $ldata)
				
				@if($row < 8)
				<tr>
					<th> {{$ldata[0] }}</th>
					<th>{{$ldata[1]}}</th>
					<th class="btn btn-{{($headerdata[$row]=='Matched')?'success':'danger';}}"> {{$headerdata[$row]}}</th>
					
				</tr>
				@endif
				@php $row++;@endphp
				@endforeach
			</table>
		</div>
	</div>
	<!-- content start  -->
	<div class="row ">
		<div class="col-md-12" >
			<button class="btn btn-success" style="float:right;">{{ __('messages.new_record') }} </button><button class="btn btn-warning" style="float:right;">{{ __('messages.existing_record') }}</button><button class="btn btn-danger" style="float:right;">{{ __('messages.modify_data') }}</button> <br> <br>
		</div>
		<div class="col-md-12">
			<div class="card mb-0">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<h4 class="nav-link">{{ __('messages.compare_report') }} <h4>
						</li>
						</ul><br>
						<div class="card-body">
							<div class="row">   <div class="col-12">
								<table class="table">
									<tr>
										<th># </th>
										<th>{{ __('messages.register_no') }}</th>
										<th>{{ __('messages.student_name') }}</th>
										<th>{{ __('messages.mark') }}</th>
										<th>{{ __('messages.attendance') }}</th>
										<th>{{ __('messages.memo') }}</th>
									</tr>
									
									
									@foreach($studentmarks as $ldata)
									
									@if($ldata!='')
									<tr>
										<th> {{$ldata[0] }}</th>
										<th class="btn btn-{{($ldata['oldmark']['mark_id']!='')?'warning':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['student_id']=='')?'Student Not Exist':'';}}"> {{$ldata[1]}}</th>
										<th> {{$ldata[2]}}</th>
										@if($studentlist[7][1]=='Points')
										<th class="text-{{($ldata['oldmark']['points']!='' && $ldata['oldmark']['points']!=$ldata[3])?'danger ':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['points']!='')?'Previous Data :'.$ldata['oldmark']['points']:'New Data';}}"> {{(strtolower($ldata[4])=='a')?'0':(($ldata[3]!='')?$ldata[3]:'No Data')}} </th>
										@elseif($studentlist[7][1]=='Freetext')
										<th class="text-{{($ldata['oldmark']['freetext']!='' && $ldata['oldmark']['freetext']!=$ldata[3])?'danger ':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['freetext']!='')?'Previous Data :'.$ldata['oldmark']['freetext']:'New Data';}}"> {{(strtolower($ldata[4])=='a')?'0':(($ldata[3]!='')?$ldata[3]:'No Data')}} </th>
										
										@else
										<th class="text-{{($ldata['oldmark']['score']!='' && $ldata['oldmark']['score']!=$ldata[3])?'danger ':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['score']!='')?'Previous Data :'.$ldata['oldmark']['score']:'New Data';}}"> {{(strtolower($ldata[4])=='a')?'0':(($ldata[3]!='')?$ldata[3]:'No Data')}} </th>
										
										@endif
										<th class="text-{{($ldata['oldmark']['status']!='' && $ldata['oldmark']['status'][0]!=$ldata[4])?'danger ':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['status']!='')?'Previous Data :'.$ldata['oldmark']['status']:'New Data';}}"> {{($ldata[4]!='')?$ldata[4]:'No Data'}} </th>
										<th class="text-{{($ldata['oldmark']['memo']!='' && $ldata['oldmark']['memo']!=$ldata[5])?'danger ':'success';}}" data-toggle="tooltip" title=""  aria-haspopup="false" aria-expanded="false" data-original-title="{{($ldata['oldmark']['memo']!='')?'Previous Data :'.$ldata['oldmark']['memo']:'New Data';}}"> {{ ($ldata[5]!='')?$ldata[5]:'No Data'}} </th>
									</tr>
									@endif
									@endforeach
									<!--<tr>
										<th> 2 </th>
										<th class="btn btn-warning"> 900000002</th>
										<th class="btn-danger btn" > B</th>
										
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
									</tr>-->
									
								</table>
								<center>
									<a href="{{url('admin.exam.import')}}" class="btn btn-warning"> <i class="fe fe-refresh"></i>  Re-Upload  </a> <input type="button" name="upload" class="btn btn-success" data-toggle="modal" data-target="#myModal" value="{{ __('messages.upload') }}" disabled>  </center> 
								
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
							<input type="hidden" name="department_id" value="{{$requestdata['department_id']}}">
							<input type="hidden" name="class_id" value="{{$requestdata['class_id']}}">
							<input type="hidden" name="section_id" value="{{$requestdata['section_id']}}">
							<input type="hidden" name="exam_id" value="{{$requestdata['exam_id']}}">
							<input type="hidden" name="subject_id" value="{{$requestdata['subject_id']}}">
							<input type="hidden" name="paper_id" value="{{$requestdata['paper_id']}}">
							<input type="hidden" name="semester_id" value="{{$requestdata['semester_id']}}">
							<input type="hidden" name="session_id" value="{{$requestdata['session_id']}}">
							<input type="hidden" name="student_marks" value="">
							<div class="modal-footer">
								<button type="submit" class="btn btn-success" >{{ __('messages.save') }}</button>
							</div>
						</form>
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
			var examdownloadexcel = "{{ route('admin.exam.examdownloadexcel') }}";
			var teacherSectionUrl = "{{ config('constants.api.section_by_class') }}";
			var subjectByExamNames = "{{ config('constants.api.subject_by_exam_names') }}";
			var examBySubjects = "{{ config('constants.api.exam_by_subjects') }}";					
			var subjectByPapers = "{{ config('constants.api.subject_by_papers') }}";
			
			var ExamPaperDetails = "{{ config('constants.api.exam_paper_details') }}";
			var getExamPaperResults = "{{ config('constants.api.get_exam_paper_res') }}";
			var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
			
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
		<script src="{{ asset('js/custom/exam_import.js') }}"></script>
		<script>
			$(document).ready(function(){
				$('#fileInput').change(function(){
					var fileName = $(this).val().split('\\').pop();		
					
					$('#submitbtn').removeAttr("type").attr("type", "submit");	
					$('#submitbtn').show();	
					var newRoute = "{{ route('admin.exam.import.add') }}";
					$('#resultsByPaper').attr('action', newRoute);	
					$('#downloadexcel1').hide();	   		
					
				});
			});
		</script>
		
	@endsection													