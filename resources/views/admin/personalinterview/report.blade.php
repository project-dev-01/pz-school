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
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<!-- Start Content-->
<div class="container-fluid">
	
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
		<div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
				<i data-feather="file-text" class="icon-dual" style="color:#3A4265"></i>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.personal_interview') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.personal_interview_report') }}</a></li>
                </ol>

            </div> 
           
		</div>
	</div>
    <!-- end page title -->
	
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
			<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
								{{ __('messages.select_ground') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
               
					<div class="card-body collapse show">
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
									<div class="col-md-3" id="section_drp_div">
										<div class="form-group">
											<label for="sectionID">{{ __('messages.class') }}<span class="text-danger">*</span>
											</label>
											<select id="sectionID" class="form-control" name="section_id">
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
												<option value="{{$sem['id']}}">{{$sem['name']}}</option>
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-3 d-none">
									<select id="student_id" class="form-control" name="student_id" required>
												<option value="">{{ __('messages.select') }}</option>
											</select>
											</div>
									<div class="col-md-3"><br><button class="btn btn-success" type="submit" id="get_report"> {{ __('messages.filter') }} </button>
									</div>
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
			<ul class="nav nav-tabs" style="display: inline-block;">
			<li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.student_list') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
              
				<div id="class_all"  style="display:none;">
					<form method="post" action="{{ route('admin.personalinterviewdownload.all') }}">
						@csrf
						
						<input type="hidden" name="department_id" class="downDepartmentID">
						<input type="hidden" name="class_id" class="downClassID">
						<input type="hidden" name="semester_id" class="downSemesterID">
						<input type="hidden" name="section_id" class="downSectionID">
						<input type="hidden" name="academic_year" class="downAcademicYear">

						<div class="clearfix float-right" style="margin-bottom:5px;">
							<button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF">{{ __('messages.download') }} {{ __('messages.pdf') }}</button>
							<!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
						</div>
					</form>
				</div>
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('messages.date') }}</th>
                                            <th> {{ __('messages.name') }}</th>
                                            <th> {{ __('messages.roll_no') }}</th>
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
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
	toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
	var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";
	var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
	var getbyStudent = "{{ config('constants.api.tot_grade_calcu_byStudent') }}";
	var getInterviewData = "{{ config('constants.api.getInterviewData') }}";
	
    var interviewList = "{{ route('admin.personalinterview.show') }}";
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
<script src="{{ asset('js/custom/student_interviewreport.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection																																																																																		