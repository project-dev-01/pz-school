@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_profile') . '')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/dropzone/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('mobile-country/css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('country/css/countrySelect.css') }}">
<style>
    .switch {
	height: 24px;
	display: block;
	position: relative;
	cursor: pointer;
    }
	
    .switch input {
	display: none;
    }
	
    .switch input+span {
	padding-left: 50px;
	min-height: 24px;
	line-height: 24px;
	display: block;
	color: #99a3ba;
	position: relative;
	vertical-align: middle;
	white-space: nowrap;
	transition: color 0.3s ease;
    }
	
    .switch input+span:before,
    .switch input+span:after {
	content: '';
	display: block;
	position: absolute;
	border-radius: 12px;
    }
	
    .switch input+span:before {
	top: 0;
	left: 0;
	width: 42px;
	height: 24px;
	background: #e4ecfa;
	transition: all 0.3s ease;
    }
	
    .switch input+span:after {
	width: 18px;
	height: 18px;
	background: #fff;
	top: 3px;
	left: 3px;
	box-shadow: 0 1px 3px rgba(18, 22, 33, .1);
	transition: all 0.45s ease;
    }
	
    .switch input+span em {
	width: 8px;
	height: 7px;
	background: #99a3ba;
	position: absolute;
	left: 8px;
	bottom: 7px;
	border-radius: 2px;
	display: block;
	z-index: 1;
	transition: all 0.45s ease;
    }
	
    .switch input+span em:before {
	content: '';
	width: 2px;
	height: 2px;
	border-radius: 1px;
	background: #fff;
	position: absolute;
	display: block;
	left: 50%;
	top: 50%;
	margin: -1px 0 0 -1px;
    }
	
    .switch input+span em:after {
	content: '';
	display: block;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
	border: 1px solid #99a3ba;
	border-bottom: 0;
	width: 6px;
	height: 4px;
	left: 1px;
	bottom: 6px;
	position: absolute;
	z-index: 1;
	transform-origin: 0 100%;
	transition: all 0.45s ease;
	transform: rotate(-35deg) translate(0, 1px);
    }
	
    .switch input+span strong {
	font-weight: normal;
	position: relative;
	display: block;
	top: 1px;
    }
	
    .switch input+span strong:before,
    .switch input+span strong:after {
	font-size: 14px;
	font-weight: 500;
	display: block;
	font-family: 'Mukta Malar', Arial;
	-webkit-backface-visibility: hidden;
    }
	
    .switch input+span strong:before {
	transition: all 0.3s ease 0.2s;
    }
	
    .switch input+span strong:after {
	opacity: 0;
	visibility: hidden;
	position: absolute;
	left: 0;
	top: 0;
	color: #007bff;
	transition: all 0.3s ease;
	transform: translate(2px, 0);
    }
	
    .switch input:checked+span:before {
	background: rgba(0, 123, 255, .35);
    }
	
    .switch input:checked+span:after {
	background: #fff;
	transform: translate(18px, 0);
    }
	
    .switch input:checked+span em {
	transform: translate(18px, 0);
	background: #007bff;
    }
	
    .switch input:checked+span em:after {
	border-color: #007bff;
	transform: rotate(0deg) translate(0, 0);
    }
	
    .switch input:checked+span strong:before {
	opacity: 0;
	visibility: hidden;
	transition: all 0.3s ease;
	transform: translate(-2px, 0);
    }
	
    .switch input:checked+span strong:after {
	opacity: 1;
	visibility: visible;
	transform: translate(0, 0);
	transition: all 0.3s ease 0.2s;
    }
	
    html {
	-webkit-font-smoothing: antialiased;
    }
	
    * {
	box-sizing: border-box;
    }
	
    *:before,
    *:after {
	box-sizing: border-box;
    }
	
    .switch {
	display: table;
	margin: 12px auto;
	min-width: 118px;
    }
	
    .dribbble {
	position: fixed;
	display: block;
	right: 20px;
	bottom: 20px;
    }
	
    .dribbble img {
	display: block;
	height: 28px;
    }
	
    .iti {
	display: block;
    }
	
    .country-select {
	display: block;
    }
	
    .ui-datepicker {
	width: 20.2em;
    }
	
    @media screen and (min-device-width: 320px) and (max-device-width: 660px) {
	.ui-datepicker {
	width: 14em;
	}
    }
	
    @media screen and (min-device-width: 360px) and (max-device-width: 740px) {
	.ui-datepicker {
	width: 13.9em;
	}
    }
	
    @media screen and (min-device-width: 375px) and (max-device-width: 667px) {
	.ui-datepicker {
	width: 14.8em;
	}
    }
	
    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
	.ui-datepicker {
	width: 16em;
	}
    }
	
    @media screen and (min-device-width: 412px) and (max-device-width: 915px) {
	.ui-datepicker {
	width: 17.8em;
	}
    }
	
    @media screen and (min-device-width: 540px) and (max-device-width: 720px) {
	.ui-datepicker {
	width: 27.6em;
	}
    }
	
    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
	.ui-datepicker {
	width: 13.2em;
	}
    }
	
    @media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
	.ui-datepicker {
	width: 13.3em;
	}
    }
</style>
@if(Session::get('locale')=="en")
<style>
    .switch input+span strong:before {
	content: 'Unlock';
    }
	
    .switch input+span strong:after {
	content: 'Lock';
    }
</style>
@endif
@if(Session::get('locale')=="japanese")
<style>
    .switch input+span strong:before {
	content: 'アンロック';
    }
	
    .switch input+span strong:after {
	content: 'ロック';
    }
</style>
@endif
@endsection
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
					</ol>-->
				</div>
                <h4 class="page-title">{{ __('messages.student_profile') }}</h4>
			</div>
		</div>
	</div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-xl-3 col-3">
                        @if(isset($student['photo']))
                        <img src="{{ config('constants.image_url') }}/{{ config('constants.branch_id') }}/users/images/{{$student['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
                        @else
                        <img src="{{ config('constants.image_url') }}/common-asset/images/users/default.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                        @endif
						
					</div> <!-- end col -->
                    <div class="col-lg-7  col-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">
                            <h1 class="mb-3">{{ isset($student['first_name']) ? $student['first_name'] : ''}} {{ isset($student['last_name']) ? $student['last_name'] : ''}}</h5>
							<div class="row mb-3">
								<div class="col-md-12">
									<div>
										<!-- <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
											<span class="avatar-title font-14 font-weight-bold text-white">
											<i class="fas fa-users"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
											<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
											<a href="javascript: void(0);" class="text-reset"></a></h5>
                                            </div>
										</div> -->
										<div class="media mb-2">
											<div class="avatar-xs bg-success rounded-circle">
												<span class="avatar-title font-14 font-weight-bold text-white">
												<i class="fas fa-birthday-cake"></i></span>
											</div>
											<div class="media-body pl-2">
												<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
													<a href="javascript: void(0);" class="text-reset">{{ isset($student['birthday']) ? $student['birthday'] : ''}}</a>
												</h5>
											</div>
										</div>
										<div class="media mb-2">
											<div class="avatar-xs bg-success rounded-circle">
												<span class="avatar-title font-14 font-weight-bold text-white">
												<i class="fas fa-school"></i></span>
											</div>
											<div class="media-body pl-2">
												<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
													<a href="javascript: void(0);" class="text-reset">{{ isset($student['class_name']) ? $student['class_name'] : ''}} ({{ isset($student['section_name']) ? $student['section_name'] : ''}})</a>
												</h5>
											</div>
										</div>
										
										<div class="media mb-2">
											<div class="avatar-xs bg-success rounded-circle">
												<span class="avatar-title font-14 font-weight-bold text-white">
												<i class="fas fa-phone-volume"></i></span>
											</div>
											<div class="media-body pl-2">
												<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
													<a href="javascript: void(0);" class="text-reset">{{ isset($student['mobile_no']) ? $student['mobile_no'] : ''}}</a>
												</h5>
											</div>
										</div>
										<div class="media mb-2">
											<div class="avatar-xs bg-success rounded-circle">
												<span class="avatar-title font-14 font-weight-bold text-white">
												<i class="far fa-envelope"></i></span>
											</div>
											<div class="media-body pl-2">
												<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
													<a href="javascript: void(0);" class="text-reset">{{ isset($student['email']) ? $student['email'] : ''}}</a>
												</h5>
											</div>
										</div>
										<div class="media mb-2">
											<div class="avatar-xs bg-success rounded-circle">
												<span class="avatar-title font-14 font-weight-bold text-white">
												<i class="fas fa-home"></i></span>
											</div>
											<div class="media-body pl-2">
												<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
													<a href="javascript: void(0);" class="text-reset">{{ isset($student['current_address']) ? $student['current_address'] : ''}}</a>
												</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- end col -->
				</div><!-- end row -->
			</div> <!-- end card-->
		</div> <!-- end col-->
	</div><!-- end row-->
	<div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-xl-3 col-3">
						@if($student['department_id']==1)
						<a href="{{url('admin/primary/downloadform1/'.$student['id'])}}" class="btn btn-warning">{{ __('messages.download_form1') }}</a> 
						@elseif($student['department_id']==2)
						<a href="{{url('admin/secondary/downloadform1/'.$student['id'])}}" class="btn btn-warning">{{ __('messages.download_form1') }} </a> 
						@endif
					</div> <!-- end col -->
                    <div class="col-xl-3 col-3">
						
						<a href="{{url('admin/yoroku/downloadform2a/'.$student['id'])}}" class="btn btn-warning">{{ __('messages.download_form2a') }}</a> 
						
					</div> <!-- end col -->
                    <div class="col-xl-3 col-3">
						
						<a href="{{url('admin/yoroku/downloadform2b/'.$student['id'])}}" class="btn btn-warning">{{ __('messages.download_form2b') }}</a> 
						
					</div> <!-- end col -->
				</div><!-- end row -->
			</div> <!-- end card-->
		</div> <!-- end col-->
	</div><!-- end row-->
	
    
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>

<script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('libs/autonumeric/autoNumeric-min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('js/pages/form-masks.init.js') }}"></script>
<script src="{{ asset('libs/jquery-mask-plugin/jquery.mask.min.js') }}"></script>

<script src="{{ asset('mobile-country/js/intlTelInput.js') }}"></script>
<script src="{{ asset('country/js/countrySelect.js') }}"></script>
<script>
    var input = document.querySelector("#txt_mobile_no");
    intlTelInput(input, {
        allowExtensions: true,
        autoFormat: false,
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        preventInvalidNumbers: true,
        // utilsScript: "js/utils.js"
	});
	
    $(".country").countrySelect({
        responsiveDropdown: true,
        preferredCountries: ['my', 'jp'],
	});
</script>
<script>
    var parentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var parentName = "{{ config('constants.api.parent_name') }}";
    var parentDetails = "{{ config('constants.api.parent_details') }}";
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
    var roomByHostel = "{{ route('admin.room_by_hostel') }}";
    var indexStudent = "{{ route('admin.student.index') }}";
    var indexAdmission = "{{ route('admin.admission') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
</script>

<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/student.js') }}"></script>
<script>
    $('.dropify-im').dropify({
        messages: {
            default: drag_and_drop_to_check,
            replace: drag_and_drop_to_replace,
            remove: remove,
            error: oops_went_wrong
		}
	});
    $(function() {
        // nric validation start
        // var $form_2 = $('#editadmission');
        // $form_2.validate({
        //     debug: true
        // });
		
        // $('#txt_nric').rules("add", {
        //     required: true
        // });
		
        $('#txt_nric').mask("000000-00-0000", {
            reverse: true
		});
        // nric validation end
	});
</script>
@endsection