@extends('layouts.admin-layout')
@section('title',' ' . __('messages.personal_interview_report') . '')
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
                <h4 class="page-title">{{ __('messages.personal_interview_report') }}</h4>
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
                            <h4>
							</li>
						</ul><br>
						<div class="card-body">
							<form id="StudentFilter"  autocomplete="off">
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="department_id_filter">{{ __('messages.department') }}<span class="text-danger">*</span></label>
											<select id="department_id_filter" name="department_id_filter" class="form-control">
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
											<label for="class_id">{{ __('messages.grade') }}</label>
											<select id="class_id" class="form-control" name="class_id">
												<option value="">{{ __('messages.select_grade') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="section_id">{{ __('messages.class') }}</label>
											<select id="section_id" class="form-control" name="section_id">
												<option value="">{{ __('messages.select_class') }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
											<select id="session_id" class="form-control" name="session_id">
												<option value="">{{ __('messages.select_session') }}</option>
												@forelse($session as $ses)
												<option value="{{$ses['id']}}" {{$current_session == $ses['id'] ? 'selected' : ''}}>{{ __('messages.' . strtolower($ses['name'])) }}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									
									<div class="col-md-3">
										
										
										
										<div class="form-group">
											<label for="session_id">{{ __('messages.student') }}<span class="text-danger">*</span>
											</label>
											<select id="session_id" class="form-control" name="session_id">
												<option value="">{{ __('messages.select') }}</option>
												<option value="">Ananad (900001)</option>
												<option value="">Karthick (900002)</option>
												<option value="">Rajesh (900003)</option>
												<option value="">Shobana (900004)</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group text-right m-b-0">
									<!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
										Filter
									</button> -->
									<button class="btn btn-primary-bl waves-effect waves-light" onclick="savealert()">
										{{ __('messages.download') }}
									</button>
									<!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
										Cancel
									</button>-->
								</div>
							</form>
							
						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
				
			</div>
			<!-- end row -->
			
			
			<div class="row" id="student">
				<div class="col-xl-12">
					<div class="card">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<h4 class="nav-link">
									{{ __('messages.graduates_list') }}
									<h4>
									</li>
								</ul><br>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive">
												<table class="table w-100 nowrap " id="student-table">
													<thead>
														<tr>
															<th>#</th>
															<th> {{ __('messages.name') }}</th>
															<th> {{ __('messages.register_no') }}</th>
															<th> {{ __('messages.roll_no') }}</th>
															<th> {{ __('messages.gender') }}</th>
															<th> {{ __('messages.email') }}</th>
															<th> {{ __('messages.actions') }}</th>
														</tr>
													</thead>
													<tbody>
														
													</tbody>
												</table>
											</div> <!-- end table-responsive-->
										</div> <!-- end col-->
										
									</div>
								</div> <!-- end card-body -->
							</div> <!-- end card-->
						</div> <!-- end col -->
						
					</div>
					
				</div> <!-- container -->
				
				@endsection
				@section('scripts')
				<!-- plugin js -->
				<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
				<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
				<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
				
				<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
				<script src="{{ asset('toastr/toastr.min.js') }}"></script>
				<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
				<script>
					toastr.options.preventDuplicates = true;
				</script>
				<!-- button js added -->
				<!-- <script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
					<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
					<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
					<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
					<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
				<script src="https://cdn.datatables.net/buttons/1.5.3/js/buttons.colVis.min.js"></script> -->
				
				<!-- validation js -->
				<script src="{{ asset('js/validation/validation.js') }}"></script>
				
				<script>
					var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
					var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
					
					var sectionByClass = "{{ route('admin.section_by_class') }}";
					var studentDelete = "{{ route('admin.student.delete') }}";
					var studentList = "{{ route('admin.graduates.list') }}";
					// lang change name start
					var deleteTitle = "{{ __('messages.are_you_sure') }}";
					var deleteHtml = "{{ __('messages.delete_this_student') }}";
					var deletecancelButtonText = "{{ __('messages.cancel') }}";
					var deleteconfirmButtonText = "{{ __('messages.yes_delete') }}";
					// lang change name end// Get PDF Footer Text
					
					// Get PDF Footer Text
					var header_txt = "{{ __('messages.student_list') }}";
					var footer_txt = "{{ session()->get('footer_text') }}";
					// Get PDF Header & Footer Text End
					// localStorage variables
					
					var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
					function savealert()
					{
					 toastr.success("Personal Interview Report Download Successfully");
					}
				</script>
				<script src="{{ asset('js/custom/graduates.js') }}"></script>
			@endsection																																																																																		