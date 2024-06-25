	@extends('layouts.admin-layout')
	@section('title',' ' . __('messages.promotion_student_list') . '')
	@section('component_css')
	<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- datatable -->
	<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
	<!-- button link  -->
	<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">

	<!-- date picker -->
	<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
	<!-- toaster alert -->
	<!-- toaster alert -->
	<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
	<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
	@endsection
	@section('content')
	<style>
		.warning-symbol {
			display: block;
			float: right;
			/* Align to the right */
			margin-top: -43px;
			/* Add some top margin for spacing */
			color: red;
			/* Set the color to yellow */
			font-size: 40px;
			/* Set the font size to your desired value */
		}

		@media screen and (min-device-width: 768px) and (max-device-width: 1200px) {
			.dt-buttons {
				margin-left: 56px;
			}

			div.dt-buttons {
				display: flex;
			}
		}
	</style>
	<!-- Page Content -->
	<!-- Page Content -->
	<div class="content container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box" style="display: inline-flex; align-items: center;">
					<div class="page-title-icon">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20px" height="20px" viewBox="0 0 256 256" xml:space="preserve">
							<defs>
							</defs>
							<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
								<path d="M 77.025 48.783 L 63.347 35.105 c 3.137 -3.239 2.843 -8.674 -0.688 -12.206 s -8.967 -3.825 -12.206 -0.688 L 36.971 8.729 c -1.015 -1.016 -2.512 -0.926 -3.462 -0.108 c -0.181 0.155 -0.337 0.336 -0.47 0.543 c -0.177 0.276 -0.323 0.58 -0.386 0.938 c -0.198 1.133 -0.412 2.248 -0.638 3.353 c -0.056 0.274 -0.117 0.544 -0.174 0.816 c -0.182 0.859 -0.369 1.711 -0.568 2.553 c -0.059 0.252 -0.121 0.502 -0.182 0.753 c -0.219 0.899 -0.446 1.789 -0.684 2.668 c -0.044 0.163 -0.088 0.327 -0.132 0.489 c -0.288 1.044 -0.587 2.077 -0.902 3.095 c -2.506 8.092 -5.882 15.313 -10.128 21.665 c -0.521 0.779 -1.054 1.545 -1.599 2.299 c -0.025 0.034 -0.048 0.069 -0.073 0.103 c -0.558 0.769 -1.13 1.525 -1.717 2.266 c -0.003 0.003 -0.005 0.006 -0.007 0.01 l -7.514 7.514 c -3.064 3.064 -4.405 7.199 -4.022 11.201 c 0.17 1.778 0.681 3.53 1.532 5.15 c 0.213 0.405 0.447 0.802 0.702 1.188 c 0.511 0.773 1.107 1.507 1.787 2.188 c 0.34 0.34 0.694 0.66 1.059 0.958 c 0.365 0.298 0.742 0.575 1.129 0.83 c 1.16 0.766 2.41 1.341 3.704 1.724 c 1.294 0.383 2.633 0.575 3.972 0.575 c 0.892 0 1.785 -0.085 2.664 -0.255 c 2.638 -0.511 5.157 -1.787 7.199 -3.83 l 1.121 -1.121 l 12.364 12.364 c 1.793 1.793 4.726 1.793 6.519 0 c 1.793 -1.793 1.793 -4.727 0 -6.519 L 35.725 69.794 c -0.045 0.035 -0.092 0.069 -0.137 0.104 c 0 0 0 0 0 0 c 0.741 -0.588 1.498 -1.16 2.268 -1.718 c 0.034 -0.025 0.07 -0.049 0.104 -0.074 c 0.754 -0.545 1.52 -1.079 2.299 -1.599 l 0 0 c 6.353 -4.246 13.576 -7.623 21.67 -10.129 c 1.014 -0.314 2.045 -0.612 3.086 -0.899 c 0.164 -0.045 0.329 -0.089 0.494 -0.134 c 0.878 -0.238 1.767 -0.464 2.664 -0.682 c 0.252 -0.061 0.503 -0.123 0.756 -0.183 c 0.839 -0.198 1.689 -0.385 2.544 -0.566 c 0.275 -0.058 0.547 -0.12 0.824 -0.176 c 1.103 -0.225 2.216 -0.439 3.347 -0.636 c 0.001 0 0.003 -0.001 0.004 -0.001 c 1.274 -0.223 2.065 -1.282 2.121 -2.402 C 77.804 50.026 77.574 49.331 77.025 48.783 z M 35.581 69.903 L 35.581 69.903 L 35.581 69.903 L 35.581 69.903 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #3A4265; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
								<path d="M 68.382 18.381 c 0.259 0 0.517 -0.099 0.715 -0.296 l 8.793 -8.793 c 0.395 -0.395 0.395 -1.035 0 -1.43 s -1.035 -0.395 -1.43 0 l -8.793 8.793 c -0.395 0.395 -0.395 1.035 0 1.43 C 67.864 18.282 68.123 18.381 68.382 18.381 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #3A4265; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
								<path d="M 58.368 13.07 c 0.06 0.011 0.12 0.016 0.18 0.016 c 0.481 0 0.907 -0.343 0.994 -0.833 l 1.985 -11.063 c 0.099 -0.55 -0.268 -1.075 -0.817 -1.174 c -0.55 -0.1 -1.075 0.267 -1.174 0.817 l -1.985 11.063 C 57.453 12.446 57.819 12.971 58.368 13.07 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #3A4265; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
								<path d="M 84.56 24.224 l -11.062 1.985 c -0.549 0.099 -0.915 0.624 -0.817 1.174 c 0.088 0.489 0.514 0.832 0.994 0.832 c 0.059 0 0.12 -0.005 0.18 -0.016 l 11.062 -1.985 c 0.549 -0.099 0.915 -0.624 0.817 -1.174 C 85.636 24.491 85.111 24.128 84.56 24.224 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #3A4265; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
							</g>
						</svg>
					</div>
					<!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
					<ol class="breadcrumb m-0 responsivebc">
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.promotion') }}</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.promotion_student_list') }}</a></li>
					</ol>

				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.promotion_import') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
					<div class="card-body collapse show">
						<form id="promoteDownloadForm" method="post" action="{{ route('teacher.promotion.downloadCSV') }}" autocomplete="off">
							<div class="row">
								<!-- <div class="col-md-3">
									<div class="form-group">
										<label for="download_department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
										<select id="download_department_id" name="download_department_id" class="form-control">
										   <option value="">{{ __('messages.select_department') }}</option>
												@forelse($department as $r)
												<option value="{{$r['id']}}">{{$r['name']}}</option>
												@empty
												@endforelse 
										</select>
									</div>
								</div> -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="downloadListClassID">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
										<select id="downloadListClassID" class="form-control" name="download_class_id">
											<option value="">{{ __('messages.select_grade') }}</option>
											@forelse($teacher_class as $cla)
											<option value="{{$cla['id']}}">{{$cla['name']}}</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="downloadListSectionID">{{ __('messages.class') }}</label>
										<select id="downloadListSectionID" class="form-control" name="download_section_id">
											<option value="">{{ __('messages.select_class') }}</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="dt-buttons" style="float:right;margin-right: 10px;margin-top: 32px;">
											<button id="downloadSampleButton" class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="employee-table" type="button">
												<span>{{ __('messages.download_sample_csv') }}</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
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
					<form id="uploadFile" method="post" enctype="multipart/form-data" action="{{ route('teacher.promotion.import.add') }}">
						{{ csrf_field() }}
						<div class="form-group" style="text-align: center;">
							<div class="card-body" style="margin-left: 17px;">
								<label style="margin-right:10px;">{{ __('messages.select_file_for_upload') }}</label>
								<input type="file" name="file" id="file" accept=".csv" />
							</div>
							<input type="submit" name="upload" class="btn btn-success" value="{{ __('messages.upload') }}">
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
	<!-- /Content End -->
	<div class="content container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
						</ol>
					</div>
					<h4 class="page-title"></h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-0">
					<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.promotion_import') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
					<form id="promoteStudentListForm" method="post" action="" autocomplete="off">
						<div class="card-body collapse show">
							<div class="row">
								<!-- <div class="col-md-3">
									<div class="form-group">
										<label for="promote_list_department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
										<select id="promote_list_department_id" name="promote_list_department_id" class="form-control">
										   <option value="All">{{ __('messages.all') }}</option>
												@forelse($department as $r)
												<option value="{{$r['id']}}">{{$r['name']}}</option>
												@empty
												@endforelse
										</select>
									</div>
								</div> -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="promoteListClassID">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
										<select id="promoteListClassID" class="form-control" name="promote_list_class_id">
											<option value="All">{{ __('messages.all') }}</option>
											@forelse($teacher_class as $cla)
											<option value="{{$cla['class_id']}}">{{$cla['class_name']}}</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="promoteListSectionID">{{ __('messages.class') }}</label>
										<select id="promoteListSectionID" class="form-control" name="promote_list_section_id">
											<option value="All">{{ __('messages.all') }}</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="sectionID">{{ __('messages.promotion_sort') }}<span class="text-danger">*</span></label>
										<select id="sort" class="form-control" name="sort_id">
											<option value="All">{{ __('messages.all') }}</option>
											<option value="1">Before Promotion Sort</option>
											<option value="2">After Promotion Sort</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- /Content End -->
	<!-- content start  -->
	<div class="content container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
						</ol>
					</div>
					<h4 class="page-title"></h4>

				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.promoted_student_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton3" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
					<div class="card-body collapse show">
						<form method="" active="">
							@csrf
							<div id="warningSymbol" class="warning-symbol" style="display: none;">&#9888;</div>
							<div class="table-responsive">
								<table class="table table-bordered w-100" id="promotionDataStudentList">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ __('messages.id') }}</th>
											<th># {{ __('messages.attendance_no') }}</th>
											<th>{{ __('messages.student_name') }}</th>
											<th>{{ __('messages.student_number') }}</th>
											<th>{{ __('messages.current_dept') }}</th>
											<th>{{ __('messages.current_grade') }}</th>
											<th>{{ __('messages.current_class') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_dept') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_grade') }}</th>
											<th style="background-color: orange;">{{ __('messages.promoted_class') }}</th>
											<th>{{ __('messages.status') }}</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<br>
							<div class="form-group text-right m-b-0">
								<button class="btn btn-primary-bl waves-effect waves-light" id="savePreparedDataBtn" type="button">
									{{ __('messages.data_prepared_done') }}
								</button>
							</div>
						</form>
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.unassigned_student_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton4" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
					<div class="card-body collapse show">
						<div class="table-responsive">
							<table class="table table-bordered w-100" id="unassignedStudentList">
								<thead>
									<tr>
										<th>#</th>
										<th>{{ __('messages.attendance_no') }}</th>
										<th>{{ __('messages.student_name') }}</th>
										<th>{{ __('messages.student_number') }}</th>
										<th>{{ __('messages.department') }}</th>
										<th>{{ __('messages.grade') }}</th>
										<th>{{ __('messages.class') }}</th>
										<th>{{ __('messages.admission_date') }}</th>
										<th>{{ __('messages.status') }}</th>
									</tr>
								</thead>
								<tbody>
									<tr>

									</tr>
								</tbody>
							</table>
						</div>
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">{{ __('messages.student_termination_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton5" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
					<div class="card-body collapse show">
						<div class="table-responsive">
							<table class="table w-100 nowrap" id="terminationStudentList">
								<thead>
									<tr>
										<th>#</th>
										<th>{{ __('messages.attendance_no') }}</th>
										<th>{{ __('messages.student_name') }}</th>
										<th>{{ __('messages.student_number') }}</th>
										<th>{{ __('messages.department') }}</th>
										<th>{{ __('messages.grade') }}</th>
										<th>{{ __('messages.class') }}</th>
										<th>{{ __('messages.admission_date') }}</th>
										<th>{{ __('messages.termination_date') }}</th>
									</tr>
								</thead>
								<tbody>
									<tr>

									</tr>
								</tbody>
							</table>
						</div>
					</div> <!-- end card-box -->
				</div> <!-- end col -->
			</div>
		</div>

	</div>

	<!-- /Page Content -->
	@endsection
	@section('scripts')
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
	<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
	<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
	<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
	<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>

	<!-- validation js -->
	<script src="{{ asset('js/validation/validation.js') }}"></script>
	<script>
		var studentListBulk = "{{ route('teacher.promotion.bulk_student_list') }}";
		var getUnassignedStudentList = "{{ route('teacher.promotion.unassigned_student_list') }}";
		var getTerminationStudentList = "{{ route('teacher.promotion.termination_student_list') }}";
		var promotionImportPreparedUrl = "{{ route('teacher.promotion.save_prepared_data') }}";
		var sectionByClass = "{{ route('teacher.section_by_class') }}";
		var confirmTitle = "{{ __('messages.promotion_message') }}";
		var cancelButtonText = "{{ __('messages.cancel') }}";
		var confirmButtonText = "{{ __('messages.confirm') }}";
		var successButtonText = "{{ __('messages.success') }}";
		var promotion_message_moved = "{{ __('messages.promotion_message_moved') }}";
		var promotion_message_error = "{{ __('messages.promotion_message_error') }}";
		var error = "{{ __('messages.error') }}";
		// default image test
		var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
		var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
		var footer_txt = "{{ session()->get('footer_text') }}";
		var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
	</script>
	<script src="{{ asset('js/custom/promotion_bulk.js') }}"></script>
	<script src="{{ asset('js/custom/collapse.js') }}"></script>
	@endsection
