@extends('layouts.admin-layout')
@section('title','Edit Guardian')
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
	.country-select .country-list
    {
        width: 361px !important;
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

	.show {
		display: block !important;
		/* Ensure the element is displayed */
		/* Additional styling for visibility */
	}

	.card-body.clicked {
		background-color: lightblue;
		cursor: pointer;
		/* Add cursor pointer to indicate clickability */
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
@section('content')
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
				<h4 class="page-title">{{ __('messages.parent_information') }}</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box" style="background-color:powderblue;">
				<div class="row">
					<div class="col-xl-3">
						@if(isset($parent['photo']))
						<img src="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}/{{$parent['photo']}}" alt="" class="img-fluid mx-auto d-block rounded user-img">
						@else
						<img src="{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}" alt="" class="img-fluid mx-auto d-block rounded">
						@endif

					</div> <!-- end col -->
					<div class="col-lg-7">
						<div class="pl-xl-3 mt-3 mt-xl-0">
							<h1 class="mb-3">{{ isset($parent['last_name']) ? $parent['last_name'] : ''}}{{ isset($parent['first_name']) ? $parent['first_name'] : ''}}</h5>
								<div class="row mb-3">
									<div class="col-md-12">
										<div>
											<div class="media mb-2">
												<div class="avatar-xs bg-success rounded-circle">
													<span class="avatar-title font-14 font-weight-bold text-white">
														<i class="fas fa-user-tag"></i></span>
												</div>
												<div class="media-body pl-2">
													<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
														<a href="javascript: void(0);" class="text-reset">{{ isset($parent['occupation']) ? $parent['occupation'] : ''}}</a>
													</h5>
												</div>
											</div>
											<div class="media mb-2">
												<div class="avatar-xs bg-success rounded-circle">
													<span class="avatar-title font-14 font-weight-bold text-white">
														<i class="fas fa-dollar-sign"></i></span>
												</div>
												<div class="media-body pl-2">
													<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
														<a href="javascript: void(0);" class="text-reset">{{ isset($parent['income']) ? $parent['income'] : ''}}</a>
													</h5>
												</div>
											</div>

											<div class="media mb-2">
												<div class="avatar-xs bg-success rounded-circle">
													<span class="avatar-title font-14 font-weight-bold text-white">
														<i class="fas fa-phone"></i></span>
												</div>
												<div class="media-body pl-2">
													<h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
														<a href="javascript: void(0);" class="text-reset">{{ isset($parent['mobile_no']) ? $parent['mobile_no'] : ''}}</a>
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
														<a href="javascript: void(0);" class="text-reset">{{ isset($parent['email']) ? $parent['email'] : ''}}</a>
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
														<a href="javascript: void(0);" class="text-reset">{{ isset($parent['japan_address']) ? $parent['japan_address'] : ''}}</a>
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
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<span class="header-title mb-3" id="span-parent" role="button" aria-expanded="false" aria-controls="basic_details" onclick="openBasicDetails()"><i class="fas fa-user-edit"></i>{{ __('messages.basic_details') }}</span>
						</div>
					</div>
					<br>
					<div class="row basic-details-row" style="display: none;">
						<div class="col-lg-12">
							<div class="row">
								@foreach($childs as $child)
								<div class="col-md-12 col-lg-6 col-xl-4">
									<div class="card text-center">
										<div class="card-body" id="child_{{ $child['id'] }}" onclick="toggleBasicDetails('{{ $child['id'] }}')">
											<div class="row">
												<div class="col-sm-4">
													@if($child['photo'])
													<img src="{{ config('constants.image_url') . '/' . config('constants.branch_id') . '/users/images/' . $child['photo'] }}" alt="Child Photo" class="avatar-xl">
													@else
													<img src="{{ config('constants.image_url') . '/common-asset/images/users/default.jpg' }}" alt="Default Photo" class="avatar-xl">
													@endif
												</div>
												<div class="col-sm-8">
													<h4 class="title">{{ $child['first_name'] }} {{ $child['last_name'] }}</h4>
													<div class="info">
														<span>{{ __('messages.class') }}: {{ $child['class_name'] }} ({{ $child['section_name'] }})</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="col-lg-4">
                            <div class="form-group">
                                <select id="student_id" name="student_id" class="form-control" onchange="toggleBasicDetails()">
                                    <option value="">{{ __('messages.select_student') }}</option>
                                    @forelse($get_std_names_dashboard as $r)
                                    <option value="{{$r['id']}}">{{$r['name']}}</option>
                                    @empty
                                    @endforelse
                                </select>
								<div id="alertMessage" style="display: none; color: red;">Please select a student.</div>
                            </div> -->
						<!-- <div class="text-lg-right mt-3 mt-lg-0">
								<button type="button" class="btn btn-white btn-rounded waves-effect waves-light mr-1" data-toggle="modal" data-target="#authenticationModal"><i class="fas fa-lock mr-1"></i> Authentication</button>
							</div> -->
						<!--</div>--><!-- end col-->
					</div> <!-- end row -->
					<br>
					<div class="collapse" id="basic_details">
						<form id="editParent" method="post" action="{{ route('admin.parent.update') }}" enctype="multipart/form-data" autocomplete="off">
							@csrf
							<input type="hidden" name="id" value="{{ isset($parent['id']) ? $parent['id'] : ''}}">
							<input type="hidden" name="student_id" id="student_id">
							<div class="card">
								<br>
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">
											{{ __('messages.parent_guardian_details') }}
										</h4>
									</li>
								</ul>
								<div class="card-body">
									<!--<div class="row">
										<div class="col-md-12">
											<div class="col-lg-3">
												<div class="mt-3">
													<input type="hidden" name="old_photo" id="oldPhoto" value="{{ isset($parent['photo']) ? $parent['photo'] : ''}}" />
													<input type="file" name="photo" id="photo" class="dropify-im" data-max-file-size="2M" data-plugins="dropify" data-default-file="{{ isset($parent['photo']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['photo'] ? config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['photo'] : config('constants.image_url').'/common-asset/images/users/default.jpg' }}" />
													<p class="text-muted text-center mt-2 mb-0">{{ __('messages.photo') }}</p>
													</div>
												</div>
												</div>
											</div>-->
									<div class="row">

										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="guardian_last_name">{{ __('messages.last_name') }}</label>

												<input type="text" class="form-control" value="{{ isset($parent['last_name']) ? $parent['last_name'] : ''}}" name="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="guardian_middle_name">{{ __('messages.middle_name') }}<span class="text-danger">*</span></label>

												<input type="text" class="form-control" value="{{ isset($parent['middle_name']) ? $parent['middle_name'] : ''}}" name="guardian_middle_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="guardian_first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>

												<input type="text" class="form-control" value="{{ isset($parent['first_name']) ? $parent['first_name'] : ''}}" name="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
									</div>

									@if($form_field['name_furigana'] == 0)
									<div class="row">

										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="">{{ __('messages.last_name') }}({{ __('messages.furigana') }})</label>

												<input type="text" name="guardian_last_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_last_name_furigana" value="{{ isset($parent['last_name_furigana']) ? $parent['last_name_furigana'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="">{{ __('messages.middle_name') }}({{ __('messages.furigana') }})</label>

												<input type="text" name="guardian_middle_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_middle_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend" value="{{ isset($parent['middle_name_furigana']) ? $parent['middle_name_furigana'] : ''}}">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">{{ __('messages.first_name') }}({{ __('messages.furigana') }})<span class="text-danger">*</span></label>

												<input type="text" name="guardian_first_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_first_name_furigana" value="{{ isset($parent['first_name_furigana']) ? $parent['first_name_furigana'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
									</div>
									@endif
									@if($form_field['name_english'] == 0)
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>

												<input type="text" name="guardian_last_name_english" class="form-control alloptions" maxlength="50" id="guardian_last_name_english" value="{{ isset($parent['last_name_english']) ? $parent['last_name_english'] : ''}}" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="">{{ __('messages.middle_name_roma') }}</label>

												<input type="text" name="guardian_middle_name_english" class="form-control alloptions" maxlength="50" id="guardian_middle_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend" value="{{ isset($parent['middle_name_english']) ? $parent['middle_name_english'] : ''}}">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>



												<input type="text" name="guardian_first_name_english" class="form-control alloptions" maxlength="50" id="guardian_first_name_english" value="{{ isset($parent['first_name_english']) ? $parent['first_name_english'] : ''}}" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

											</div>
										</div>
									</div>
									@endif


									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
												<select id="guardian_relation" name="guardian_relation" class="form-control copy_guardian_info">
													<option value="0">{{ __('messages.select_relation') }}</option>
													@forelse($relation as $r)
													<option value="{{$r['id']}}">{{$r['name']}}</option>
													@empty
													@endforelse
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control copy_guardian_info" id="guardian_email" readonly value="{{ isset($parent['email']) ? $parent['email'] : ''}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control number_validation" id="guardian_phone_number" value="{{ isset($parent['mobile_no']) ? $parent['mobile_no'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
												<label for="guardian_phone_number" class="error"></label>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="guardian_occupation" value="{{ isset($parent['occupation']) ? $parent['occupation'] : ''}}" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change">
											</div>
										</div>
										<!-- <div class="col-md-4">
											<div class="form-group">
												<label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
												<select id="guardian_relation" name="guardian_relation" class="form-control">
													<option value="">{{ __('messages.select_relation') }}</option>
													@forelse($relation as $r)
													<option value="{{$r['id']}}" {{ isset($parent['relation']) ?$parent['relation'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
													@empty
													@endforelse
												</select>
											</div>
										</div> -->

										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="guardian_company_name_japan" value="{{ isset($parent['company_name_japan']) ?$parent['company_name_japan'] : ''}}" name="guardian_company_name_japan" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
											</div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="guardian_company_name_local" value="{{ isset($parent['company_name_local']) ?$parent['company_name_local'] : ''}}" name="guardian_company_name_local" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control  number_validation " id="guardian_company_phone_number" value="{{ isset($parent['company_phone_number']) ?$parent['company_phone_number'] : ''}}" name="guardian_company_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
												<label for="guardian_company_phone_number" class="error"></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
												<select id="guardian_employment_status" name="guardian_employment_status" class="form-control">
													<option value="">{{ __('messages.select_employment_status') }}</option>
													<option value="Expat" {{ isset($parent['employment_status']) ?$parent['employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
													<option value="Local Hire" {{ isset($parent['employment_status']) ?$parent['employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
													<option value="Public Servant" {{ isset($parent['employment_status']) ?$parent['employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
													<option value="Self-Employed" {{ isset($parent['employment_status']) ?$parent['employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
													<option value="Others" {{ isset($parent['employment_status']) ? $parent['employment_status'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="school_roleid">{{ __('messages.select_role') }}<span class="text-danger">*</span></label>
												<select class="form-control " id="school_roleid" name="school_roleid" data-placeholder="{{ __('messages.choose_role') }}">
													<option value="">{{ __('messages.select_role') }}</option>
													@forelse($school_roles as $r)
													@if($r['portal_roleid']==2 && $r['roles']!=null)
													<option value="{{$r['id']}}" {{ isset($user['school_roleid']) ? $user['school_roleid'] == $r['id'] ? 'selected' : '' : '' }}>{{ $r['fullname'] }} ( {{ $r['roles'] }} )</option>
													@endif
													@empty
													@endforelse
												</select>
											</div>
										</div>
										

									</div>
									<div class="row">
									<input type="hidden" name="passport_father_old_photo" id="passport_father_old_photo" />
										<div class="col-md-4" id="passportdetails" style="display: none;">
											<div class="form-group">
												<label for="passport_father_photo">{{ __('messages.passport_image_father_only_if_malaysian') }}<span class="text-danger">*</span></label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="passport_father_photo" class="custom-file-input" name="passport_father_photo" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="passport_father_photo">{{ __('messages.choose_file') }}</label>
													</div>
												</div>
												<label for="passport_father_photo" class="error"></label>
												<a id="passport_father_photo_link" href="#" target="_blank"> {{ __('messages.passport_image_mother_only_if_malaysian') }} </a>
												<span id="passport_father_photo_name"></span>
											</div>
										</div>
										<input type="hidden" name="passport_mother_old_photo" id="passport_mother_old_photo" />

										<div class="col-md-4" id="mother_father_photo" style="display: none;">
											<div class="form-group">
												<label for="passport_mother_photo">{{ __('messages.passport_image_mother_only_if_malaysian') }}<span class="text-danger">*</span></label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="passport_mother_photo" class="custom-file-input" name="passport_mother_photo" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="passport_mother_photo">{{ __('messages.choose_file') }}</label>
													</div>
												</div>
												<label for="passport_mother_photo" class="error"></label>

												<a id="passport_mother_photo_link" href="#" target="_blank"> {{ __('messages.passport_image_mother_only_if_malaysian') }} </a>

												<span id="passport_mother_photo_name"></span>
											</div>
										</div>


										<input type="hidden" name="visa_father_old_photo" id="visa_father_old_photo" />

										<div class="col-md-4" id="mother_father_photos" style="display: none;">
											<div class="form-group">
												<label for="visa_father_photo">{{ __('messages.visa_image_father_only_for_non_malaysian') }}</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="visa_father_photo" class="custom-file-input" name="visa_father_photo" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="visa_father_photo">{{ __('messages.choose_file') }}</label>
													</div>
												</div>
												<a id="visa_father_photo_link" href="#" target="_blank"> {{ __('messages.visa_image_father_only_for_non_malaysian') }} </a>
												<span id="visa_father_photo_name"></span>
											</div>
										</div>

										<input type="hidden" name="visa_mother_old_photo" id="visa_mother_old_photo" />

										<div class="col-md-4" id="mother_father_photoss" style="display: none;">
											<div class="form-group">
												<label for="visa_mother_photo">{{ __('messages.visa_image_mother_only_for_non_malaysian') }}</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="visa_mother_photo" class="custom-file-input" name="visa_mother_photo" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="visa_mother_photo">{{ __('messages.choose_file') }}</label>
													</div>
												</div>

												<a id="visa_mother_photo_link" href="#" target="_blank"> {{ __('messages.visa_image_mother_only_for_non_malaysian') }} </a>

												<span id="visa_mother_photo_name"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card" id="father_details" style="display: none;">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">{{ __('messages.father_details') }}
											<h4>
									</li>
								</ul>
								<div class="card-body">
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-4" id="father_photo" style="display:none;">

										</div>
									</div>
									<div id="father_form">
										<input type="hidden" name="father_id" id="father_id">
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control father_form" maxlength="50" id="father_last_name" name="father_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_middle_name">{{ __('messages.middle_name') }}</label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_middle_name" name="father_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control father_form" maxlength="50" id="father_first_name" name="father_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_last_name_furigana" name="father_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_furigana" name="father_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_first_name_furigana" name="father_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_last_name_english" name="father_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_middle_name_english" name="father_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info father_form" id="father_first_name_english" name="father_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="father_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info father_form country" id="father_nationality" name="father_nationality" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
													<div class="input-group input-group-merge">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<span class="far fa-envelope-open"></span>
															</div>
														</div>
														<input type="text" class="form-control copy_parent_info father_form " placeholder="{{ __('messages.enter_your_email') }}" id="father_email" name="father_email">
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control number_validation copy_parent_info father_form " placeholder="(XXX)-(XXX)-(XXXX)" id="father_mobile_no" name="father_mobile_no" data-parsley-trigger="change">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
													<input type="text" maxlength="50" id="father_occupation" name="father_occupation" class="form-control copy_parent_info father_form" placeholder="Manager" data-parsley-trigger="change">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card" id="mother_details" style="display: none;">

								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">{{ __('messages.mother_details') }}
											<h4>
									</li>
								</ul>
								<div class="card-body">
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-4" id="mother_photo" style="display:none;">

										</div>
									</div>
									<div id="mother_form">
										<input type="hidden" name="mother_id" id="mother_id">
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label for="heard">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control" maxlength="50" id="mother_last_name" name="mother_last_name" placeholder="{{ __('messages.akari') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_middle_name">{{ __('messages.middle_name') }}</label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name" name="mother_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="heard">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control" maxlength="50" id="mother_first_name" name="mother_first_name" placeholder="{{ __('messages.sato') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_last_name_furigana">{{ __('messages.last_name_furigana') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_furigana" name="mother_last_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_middle_name_furigana">{{ __('messages.middle_name_furigana') }}</label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_furigana" name="mother_middle_name_furigana" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_first_name_furigana">{{ __('messages.first_name_furigana') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_furigana" name="mother_first_name_furigana" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_last_name_english">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_last_name_english" name="mother_last_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_middle_name_english">{{ __('messages.middle_name_roma') }}</label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_middle_name_english" name="mother_middle_name_english" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_first_name_english">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info mother_form" id="mother_first_name_english" name="mother_first_name_english" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="mother_nationality">{{ __('messages.nationality') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control copy_parent_info mother_form country" id="mother_nationality" name="mother_nationality" placeholder="{{ __('messages.enter_nationality') }}" aria-describedby="inputGroupPrepend">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>

													<input type="text" class="form-control" placeholder="{{ __('messages.enter_the_email') }}" id="mother_email" name="mother_email">

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="mobile_no">{{ __('messages.mobile_no') }}<span class="text-danger">*</span></label>
													<input type="text" class="form-control number_validation" placeholder="(XXX)-(XXX)-(XXXX)" id="mother_mobile_no" name="mother_mobile_no" data-parsley-trigger="change">
												</div>
											</div>
										</div>
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label for="txt_occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
													<input type="text" maxlength="50" id="mother_occupation" name="mother_occupation" class="form-control" placeholder="Developer" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change">
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">
											{{ __('messages.family_details') }}
										</h4>
									</li>
								</ul><br>
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="japan_postalcode">{{ __('messages.japan_address_postal') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="japan_postalcode" value="{{ isset($parent['japan_postalcode']) ? $parent['japan_postalcode'] : ''}}" name="japan_postalcode" placeholder="" aria-describedby="inputGroupPrepend">
												<label for="japan_postalcode" class="error"></label>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="japan_contact_no">{{ __('messages.japan_contact_phone_number') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="japan_contact_no" value="{{ isset($parent['japan_contact_no']) ? $parent['japan_contact_no'] : ''}}" name="japan_contact_no" placeholder="" aria-describedby="inputGroupPrepend">
												<label for="japan_contact_no" class="error"></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="japan_emergency_sms">{{ __('messages.Emergency_tel_sms') }}<span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="japan_emergency_sms" value="{{ isset($parent['japan_emergency_sms']) ? $parent['japan_emergency_sms'] : ''}}" name="japan_emergency_sms" placeholder="" aria-describedby="inputGroupPrepend">
												<label for="japan_emergency_sms" class="error"></label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label for="japan_address">{{ __('messages.japan_address') }}<span class="text-danger">*</span></label>
												<textarea class="form-control" id="japan_address" name="japan_address" placeholder="" aria-describedby="inputGroupPrepend">{{ isset($parent['japan_address']) ? $parent['japan_address'] : ''}}</textarea>
												<label for="japan_address" class="error"></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="stay_category">{{ __('messages.stay_category') }}<span class="text-danger">*</span></label>
												<select id="stay_category" name="stay_category" class="form-control">
													<option value="">{{ __('messages.select_stay_category') }}</option>
													<option value="Long stay" {{ isset($parent['stay_category']) ? $parent['stay_category'] == "Long stay" ? 'selected' : '' : '' }}>{{ __('messages.long_stay') }}</option>
													<option value="PR" {{ isset($parent['stay_category']) ? $parent['stay_category'] == "PR" ? 'selected' : '' : '' }}>{{ __('messages.pr_stay') }}</option>
												</select>
											</div>
										</div>

									</div>
									<div class="row" id="sibling" style="display: none;">
										<div class="col-md-4">
											<div class="form-group">
												<label for="department">{{ __('messages.siblings') }}</label>
											</div>
										</div>
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<td>{{ __('messages.full_name') }}</td>
													<td>{{ __('messages.date_of_birth') }}</td>
													<td>{{ __('messages.relationship') }}</td>
												</tr>
											</thead>
											<tbody id="dynamic_field_one">

												<tr id="row_department">
													<td>
														<input type="text" class="form-control" name="full_name[]" id="full_name">
													</td>
													<td>
														<div class="input-group input-group-merge">
															<div class="input-group-prepend">
																<div class="input-group-text">
																	<span class="fas fa-calendar"></span>
																</div>
															</div>
															<input type="text" class="form-control dobDatepicker" name="dob[]" id="dob" placeholder="{{ __('messages.yyyy_mm_dd') }}">
														</div>
													</td>
													<td>
														<input type="text" class="form-control" name="relationship[]" id="relationship">

													</td>
													<td>
														<button type="button" name="add_sibling" id="add_sibling" class="btn btn-primary">{{ __('messages.add') }} +</button>

													</td>
												</tr>

												<!-- last feild value -->

											</tbody>
										</table>
									</div>

								</div>
							</div>
							<div class="card">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">
											{{ __('messages.personal_details') }}
										</h4>
									</li>
								</ul><br>
								<div class="card-body">
									<div class="row">

										<input type="hidden" name="japanese_association_membership_image_principal_old" id="japanese_association_membership_image_principal_old" value="{{ isset($parent['japanese_association_membership_image_principal']) ? $parent['japanese_association_membership_image_principal'] : ''}}" />
										<div class="col-md-4">
											<div class="form-group">
												<label for="japanese_association_membership_image_principal">{{ __('messages.japanese_association_membership_image_principal') }}</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="japanese_association_membership_image_principal" class="custom-file-input" value="" name="japanese_association_membership_image_principal" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="japanese_association_membership_image_principal">{{ __('messages.choose_file') }}</label>
													</div>
												</div>
												<label for="japanese_association_membership_image_principal" class="error"></label>
												@if(isset($parent['japanese_association_membership_image_principal']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['japanese_association_membership_image_principal'])
												<a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['japanese_association_membership_image_principal'] }}" target="_blank"> {{ __('messages.japanese_association_membership_image_principal') }} </a>
												@endif
												<span id="japanese_association_membership_image_principal_name"></span>

											</div>
										</div>
										<input type="hidden" name="japanese_association_membership_image_supplimental_old" id="japanese_association_membership_image_supplimental_old" value="{{ isset($parent['japanese_association_membership_image_supplimental']) ? $parent['japanese_association_membership_image_supplimental'] : ''}}" />

										<div class="col-md-4">
											<div class="form-group">
												<label for="japanese_association_membership_image_supplimental">{{ __('messages.japanese_association_membership_image_supplimental') }}</label>
												<div class="input-group">
													<div class="custom-file">
														<input type="file" id="japanese_association_membership_image_supplimental" class="custom-file-input" name="japanese_association_membership_image_supplimental" accept="image/png, image/gif, image/jpeg">
														<label class="custom-file-label" for="japanese_association_membership_image_supplimental">{{ __('messages.choose_file') }}</label>
														<input type="hidden" id="japanese_association_membership_image_supplimental_old" value="{{ isset($parent['japanese_association_membership_image_supplimental']) ?$parent['japanese_association_membership_image_supplimental'] : ''}}" name="japanese_association_membership_image_supplimental_old">
													</div>
												</div>
												@if(isset($parent['japanese_association_membership_image_supplimental']) && config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['japanese_association_membership_image_supplimental'])
												<a href="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/'.$parent['japanese_association_membership_image_supplimental'] }}" target="_blank"> {{ __('messages.japanese_association_membership_image_supplimental') }} </a>
												@endif
												<span id="japanese_association_membership_image_supplimental_name"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">
											{{ __('messages.login_details') }}
											<h4>
									</li>
								</ul>
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
												<div class="input-group input-group-merge">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<span class="far fa-envelope-open"></span>
														</div>
													</div>
													<input type="text" class="form-control" value="{{ isset($parent['email']) ? $parent['email'] : ''}}" name="email" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
												</div><label for="email" class="error"></label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group mb-3">
												<label class="switch">{{ __('messages.authentication') }}

													<input id="edit_status" name="status" type="checkbox" {{  isset($user['status']) ? $user['status'] == "1" ? "checked" : "" : "" }}>
													<span>
														<em></em>
														<strong></strong>
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">{{ __('messages.enable_two_factor_authentication') }}
											<h4>
									</li>
								</ul>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<h4 class="header-title">{{ __('messages.turn_on_turn_off') }}</h4>
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" name="google2fa_secret_enable" id="google2fa_secret_enable">
												<label class="custom-control-label" for="google2fa_secret_enable">{{ __('messages.enable_two_factor_authentication') }}</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="card">
														<ul class="nav nav-tabs">
															<li class="nav-item">
																<h4 class="navv">
																	{{ __('messages.social_links') }}
</h4>
																	</li>
																</ul>
																<div class="card-body">
																	<div class="row">
																		<div class="col-md-4">
																			<div class="form-group mb-3">
																				<label for="facebook_url">{{ __('messages.facebook') }}</label>
																				<div class="input-group input-group-merge">
																					<div class="input-group-prepend">
																						<div class="input-group-text">
																							<span class="fab fa-facebook-f"></span>
																						</div>
																					</div>
																					<input type="text" class="form-control" value="{{ isset($parent['facebook_url']) ? $parent['facebook_url'] : ''}}" name="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}" aria-describedby="inputGroupPrepend">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group mb-3">
																				<label for="twitter_url">{{ __('messages.twitter') }}</label>
																				<div class="input-group input-group-merge">
																					<div class="input-group-prepend">
																						<div class="input-group-text">
																							<span class="fab fa-twitter"></span>
																						</div>
																					</div>
																					<input type="text" class="form-control" value="{{ isset($parent['twitter_url']) ? $parent['twitter_url'] : ''}}" name="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}" aria-describedby="inputGroupPrepend">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-4">
																			<div class="form-group mb-3">
																				<label for="linkedin_url">{{ __('messages.linkedin') }}</label>
																				<div class="input-group input-group-merge">
																					<div class="input-group-prepend">
																						<div class="input-group-text">
																							<span class="fab fa-linkedin-in"></span>
																						</div>
																					</div>
																					<input type="text" class="form-control" value="{{ isset($parent['linkedin_url']) ? $parent['linkedin_url'] : ''}}" name="linkedin_url" placeholder="{{ __('messages.enter_linkedIn_url') }}" aria-describedby="inputGroupPrepend">
																				</div>
																			</div>
																		</div>
																	</div>
																</div> end card-body -->
							<!--</div>  end card-->
							<div class="card">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<h4 class="navv">
											{{ __('messages.change_password') }}
											<h4>
									</li>
								</ul>
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="password">{{ __('messages.password') }}</label>
												<div class="input-group input-group-merge">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<span class="fas fa-unlock"></span>
														</div>
													</div>
													<input type="password" class="form-control" id="password" name="password" placeholder="********" aria-describedby="inputGroupPrepend">
												</div><label for="password" class="error"></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group mb-3">
												<label for="confirm_password">{{ __('messages.retype_password') }}</label>
												<div class="input-group input-group-merge">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<span class="fas fa-unlock"></span>
														</div>
													</div>
													<input type="password" class="form-control" name="confirm_password" placeholder="********" aria-describedby="inputGroupPrepend">
												</div><label for="confirm_password" class="error"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group text-right m-b-0">
								<button class="btn btn-primary-bl waves-effect waves-light" type="Save">
									{{ __('messages.update') }}
								</button>
								<a href="{{ route('admin.parent') }}" class="btn btn-primary-bl waves-effect waves-light">
									{{ __('messages.back') }}
								</a>
							</div>
						</form>
					</div>

				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div><!-- end row -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<span class="header-title mb-3" id="span-parent" data-toggle="collapse" href="#child_detail" role="button" aria-expanded="false" aria-controls="child_detail"><i class="fas fa-user-graduate"></i>{{ __('messages.child_details') }} </span>
					<br><br>
					<div class="collapse" id="child_detail">
						<div class="row">
							@forelse($childs as $child)
							<div class="col-md-12 col-lg-6 col-xl-4">
								<div class="card text-xs-center">
									<div class="card-body ">
										<div class="row">
											<div class="col-sm-4 text-center">
												@if($child['photo'])
												<img src="{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}/{{$child['photo']}}" alt="" class="avatar-xl">
												@else
												<img src="{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}" alt="" class="avatar-xl">
												@endif
											</div>
											<div class="col-sm-8">
												<h4 class="title">{{$child['last_name']}} {{$child['first_name']}}</h4>
												<div class="info">
													<span> {{ __('messages.class') }}: {{$child['class_name']}} ({{$child['section_name']}})</span>
												</div>
												<br>
												<div class="profile">
													<a class="text-mutedd mail-subj" style="color: #0ABAB5;" href="{{route('admin.student.details',$child['id'])}}" target="_blank">{{ __('messages.profile') }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@empty
							<div class="alert alert-subl mt-md text-center text-danger">No Childs Available !</div>
							@endforelse
						</div>
					</div>
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div> <!-- end row -->
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
	$(".country").countrySelect({
		defaultCountry: "jp",
		responsiveDropdown: true
	});
	var input = document.querySelector("#japan_emergency_sms");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		//preferredCountries: ['cn', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
	var input = document.querySelector("#japan_contact_no");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		preferredCountries: ['my', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
	var input = document.querySelector("#guardian_phone_number");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		preferredCountries: ['my', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
	var input = document.querySelector("#guardian_company_phone_number");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		preferredCountries: ['my', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
	var input = document.querySelector("#father_mobile_no");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		//preferredCountries: ['cn', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
	var input = document.querySelector("#mother_mobile_no");
	intlTelInput(input, {
		allowExtensions: true,
		autoFormat: false,
		autoHideDialCode: false,
		autoPlaceholder: false,
		defaultCountry: "auto",
		ipinfoToken: "yolo",
		nationalMode: false,
		numberType: "MOBILE",
		initialCountry: "jp",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		//preferredCountries: ['cn', 'jp'],
		preventInvalidNumbers: true,
		// utilsScript: "js/utils.js"
	});
</script>
<script>
	var indexParent = "{{ route('admin.parent') }}";
	var sectionByClass = "{{ route('admin.section_by_class') }}";
	var vehicleByRoute = "{{ route('admin.vehicle_by_route') }}";
	var roomByHostel = "{{ route('admin.room_by_hostel') }}";
	var indexAdmission = "{{ route('admin.admission') }}";
	var parentDetailsAccStudentId = "{{ route('admin.parent.parentDetailsAccStudentId') }}";
	var studentDetailsAccStudentId = "{{ config('constants.api.student_details') }}";
	var yyyy_mm_dd = "{{ __('messages.yyyy_mm_dd') }}";
	var addButton = "{{ __('messages.add') }}";
	var userImageUrl = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var statusTitle = "{{ __('messages.are_you_sure') }}";
    var statuscancelButtonText = "{{ __('messages.cancel') }}";
    var statusUnLockText = "{{ __('messages.yes_unlock') }}";
    var statusLockText = "{{ __('messages.yes_lock') }}";
    var statusUnLockHtml = "{{ __('messages.you_want_to_unlock_this_parent') }}";
    var statusLockHtml = "{{ __('messages.you_want_to_lock_this_parent') }}";
</script>
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/parent.js') }}"></script>
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
		// var $form_2 = $('#editParent');
		// $form_2.validate({
		//     debug: true
		// });

		// $('#nric').rules("add", {
		//     required: true
		// });

		$('#nric').mask("000000-00-0000", {
			reverse: true
		});
		// nric validation end
	});
</script>
@endsection