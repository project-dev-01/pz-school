@extends('layouts.admin-layout')
@section('title','Add Guardian')
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

	.ui-datepicker {
		width: 21.4em;
	}

	@media screen and (min-device-width: 320px) and (max-device-width: 660px) {
		.ui-datepicker {
			width: 14.4em;
		}
	}

	@media screen and (min-device-width: 360px) and (max-device-width: 740px) {
		.ui-datepicker {
			width: 17.4em;
		}
	}

	@media screen and (min-device-width: 375px) and (max-device-width: 667px) {
		.ui-datepicker {
			width: 18.6em;
		}
	}

	@media screen and (min-device-width: 390px) and (max-device-width: 844px) {
		.ui-datepicker {
			width: 19.8em;
		}
	}

	@media screen and (min-device-width: 412px) and (max-device-width: 915px) {
		.ui-datepicker {
			width: 21.5em;
		}
	}

	@media screen and (min-device-width: 540px) and (max-device-width: 720px) {
		.ui-datepicker {
			width: 31.3em;
		}
	}

	@media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		.ui-datepicker {
			width: 13.2em;
		}
	}

	@media screen and (min-device-width: 820px) and (max-device-width: 1180px) {
		.ui-datepicker {
			width: 14.3em;
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
@section('content')
<!-- Start Content-->
<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title">{{ __('messages.add_parent_guardian') }}</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<style>

	</style>
	<div class="row">
		<div class="col-xl-12">
			<form id="addparent" method="post" action="{{ route('admin.parent.add') }}" enctype="multipart/form-data" autocomplete="off">
				@csrf
				<div class="card">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<h4 class="navv">
								{{ __('messages.guardian_details') }}
								<h4>
						</li>
					</ul>
					<div class="card-body">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="last_name">{{ __('messages.last_name') }}<span class="text-danger">*</span></label>

									<input type="text" class="form-control" name="guardian_last_name" id="guardian_last_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="last_name">{{ __('messages.middle_name') }}</label>

									<input type="text" class="form-control" name="guardian_middle_name" id="guardian_middle_name" placeholder="{{ __('messages.yukio') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>

									<input type="text" class="form-control" name="guardian_first_name" id="guardian_first_name" placeholder="{{ __('messages.yamamoto') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>

						</div>
						@if($form_field['name_furigana'] == 0)
						<div class="row">
							<div class="col-md-4">
								<div class="form-group mb-3">
									<label for="">{{ __('messages.last_name') }}({{ __('messages.furigana') }})<span class="text-danger">*</span></label>

									<input type="text" name="guardian_last_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_last_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-3">
									<label for="">{{ __('messages.middle_name') }}({{ __('messages.furigana') }})</label>

									<input type="text" name="guardian_middle_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_middle_name_furigana" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">{{ __('messages.first_name') }}({{ __('messages.furigana') }})<span class="text-danger">*</span></label>

									<input type="text" name="guardian_first_name_furigana" class="form-control alloptions" maxlength="50" id="guardian_first_name_furigana" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>

						</div>
						@endif
						@if($form_field['name_english'] == 0)
						<div class="row">

							<div class="col-md-4">
								<div class="form-group mb-3">
									<label for="">{{ __('messages.last_name_roma') }}<span class="text-danger">*</span></label>

									<input type="text" name="guardian_last_name_english" class="form-control alloptions" maxlength="50" id="guardian_last_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-3">
									<label for="">{{ __('messages.middle_name_roma') }}</label>

									<input type="text" name="guardian_middle_name_english" class="form-control alloptions" maxlength="50" id="guardian_middle_name_english" placeholder="{{ __('messages.wick') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">{{ __('messages.first_name_roma') }}<span class="text-danger">*</span></label>

									<input type="text" name="guardian_first_name_english" class="form-control alloptions" maxlength="50" id="guardian_first_name_english" placeholder="{{ __('messages.john') }}" aria-describedby="inputGroupPrepend">

								</div>
							</div>
						</div>
						@endif

						<div class="row">
							<!-- <div class="col-md-4">
								<div class="form-group">
									<label for="guardian_relation">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
									<select id="guardian_relation" name="guardian_relation" class="form-control">
										<option value="">{{ __('messages.select_relation') }}</option>
										@forelse($relation as $r)
										<option value="{{$r['id']}}" {{ isset($parent['guardian_relation']) ? $parent['guardian_relation'] == $r['id'] ? 'selected' : '' : '' }}>{{$r['name']}}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div> -->
							<!--
														<div class="col-md-4">
														<div class="form-group">
														<label for="birthday">{{ __('messages.date_of_birth') }}</label>
														<div class="input-group input-group-merge">
														<div class="input-group-prepend">
														<div class="input-group-text">
														<span class="fas fa-birthday-cake"></span>
														</div>
														</div>
														<input type="text" class="form-control" name="date_of_birth" placeholder="{{ __('messages.yyyy_mm_dd') }}" id="date_of_birth">
														</div>
														</div>
														</div>
														<div class="col-md-4">
														<div class="form-group">
														<label for="gender">{{ __('messages.gender') }}</label>
														<select class="form-control" name="gender">
														<option value="">{{ __('messages.select_gender') }}</option>
														<option value="Male">{{ __('messages.male') }}</option>
														<option value="Female">{{ __('messages.female') }}</option>
														</select>
														</div>
														</div> 
														<div class="col-md-4">
														<div class="form-group">
														<label for="guardian_email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
														<input type="text" class="form-control"  id="guardian_email" readonly value="{{ isset($parent['email']) ? $parent['email'] : ''}}" name="guardian_email" placeholder="{{ __('messages.enter_the_email') }}" aria-describedby="inputGroupPrepend">
														</div>
													</div>-->
							<div class="col-md-4">
								<div class="form-group">
									<label for="guardian_phone_number">{{ __('messages.phone_number') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control number_validation" id="guardian_phone_number" value="{{ isset($parent['guardian_phone_number']) ? $parent['guardian_phone_number'] : ''}}" name="guardian_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
									<label for="guardian_phone_number" class="error"></label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="occupation">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="guardian_occupation" id="guardian_occupation" placeholder="{{ __('messages.enter_occupation') }}" data-parsley-trigger="change">
								</div>
							</div>


							<div class="col-md-4">
								<div class="form-group">
									<label for="guardian_company_name_japan">{{ __('messages.work_company_name_japan') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="guardian_company_name_japan" value="{{ isset($parent['guardian_company_name_japan']) ? $parent['guardian_company_name_japan'] : ''}}" name="guardian_company_name_japan" placeholder="{{ __('messages.enter_work_company_name_japan') }}" aria-describedby="inputGroupPrepend">
								</div>
							</div>
						</div>
						<!--
													<div class="row">
													<div class="col-md-4">
													<div class="form-group">
													<label for="education">{{ __('messages.education') }}</label>
													<select class="form-control" name="education">
													<option value="">{{ __('messages.select_education') }}</option>
													@forelse($education as $e)
													<option value="{{$e['id']}}">{{$e['name']}}</option>
													@empty
													@endforelse
													</select>
													</div>
													</div>
													
													<div class="col-md-4">
													<div class="form-group">
													<label for="income">{{ __('messages.income') }}</label>
													<div class="input-group input-group-merge">
													<div class="input-group-prepend">
													<div class="input-group-text">
													<span class="fas fa-calculator"></span>
													</div>
													</div>
													<input type="text" class="form-control" name="income" placeholder="{{ __('messages.enter_income') }}" aria-describedby="inputGroupPrepend">
													</div>
													</div>
													</div>
													</div>
													<div class="row">
													<div class="col-md-4">
													<div class="form-group">
													<label for="address">{{ __('messages.address_1') }}</label>
													<input class="form-control" name="address" id="address" placeholder="{{ __('messages.enter_address_1') }}">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="address_2">{{ __('messages.address_2') }}</label>
													<input class="form-control" name="address_2" id="address_2" placeholder="{{ __('messages.enter_address_2') }}">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="city">{{ __('messages.city') }}</label>
													<input type="text" class="form-control" name="city" placeholder="{{ __('messages.enter_city') }}" data-parsley-trigger="change">
													</div>
													</div>
													</div>
													<div class="row">
													<div class="col-md-4">
													<div class="form-group">
													<label for="post_code">{{ __('messages.zip_postal_code') }}</label>
													<input type="text" class="form-control" name="post_code" id="postCode" placeholder="{{ __('messages.zip_postal_code') }}">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="state">{{ __('messages.state_province') }}</label>
													<input type="text" class="form-control" name="state" placeholder="{{ __('messages.state_province') }}" data-parsley-trigger="change">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="country">{{ __('messages.country') }}</label>
													<input type="text" class="form-control country" name="country" id="country" placeholder="{{ __('messages.country') }}" data-parsley-trigger="change">
													</div>
													</div>
													</div>
													<div class="row">
													@if($form_field['race'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="race">{{ __('messages.race') }}</label>
													<select class="form-control" name="race">
													<option value="">{{ __('messages.select_race') }}</option>
													@forelse($races as $r)
													<option value="{{$r['id']}}">{{$r['races_name']}}</option>
													@empty
													@endforelse
													</select>
													</div>
													</div>
													@endif
													@if($form_field['religion'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="religion">{{ __('messages.religion') }}</label>
													<select class="form-control" name="religion">
													<option value="">{{ __('messages.select_religion') }}</option>
													@forelse($religion as $r)
													<option value="{{$r['id']}}">{{$r['religions_name']}}</option>
													@empty
													@endforelse
													</select>
													</div>
													</div>
													@endif
													@if($form_field['blood_group'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="blooddgrp">{{ __('messages.blood_group') }}</label>
													<select class="form-control" name="blood_group">
													<option value="">{{ __('messages.select_blood_group') }}</option>
													<option>O+</option>
													<option>A+</option>
													<option>B+</option>
													<option>AB+</option>
													<option>O-</option>
													<option>A-</option>
													<option>B-</option>
													<option>AB-</option>
													</select>
													</div>
													</div>
													@endif
													@if($form_field['nationality'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="nationality">{{ __('messages.nationality') }}</label>
													<input type="text" maxlength="50" id="nationality" class="form-control country" placeholder="{{ __('messages.nationality') }}" name="nationality" data-parsley-trigger="change">
													</div>
													</div>
													@endif
													@if($form_field['nric'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="nric">{{ __('messages.nric_number') }}</label>
													<input type="text" maxlength="16" class="form-control" id="nric" name="nric" placeholder="999999-99-9999" data-parsley-trigger="change">
													</div>
													</div>
													@endif
													</div>
													<div class="row">
													@if($form_field['passport'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="Passport">{{ __('messages.passport_number') }}</label>
													<input type="text" maxlength="20" class="form-control" placeholder="{{ __('messages.enter_passport_number') }}" name="passport">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group mb-3">
													<label for="text">{{ __('messages.passport_expiry_date') }}<span class="text-danger"></span></label>
													<div class="input-group input-group-merge">
													<div class="input-group-prepend">
													<div class="input-group-text">
													<span class="far fa-calendar-alt"></span>
													</div>
													</div>
													<input type="text" class="form-control" id="passport_expiry_date" name="passport_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
													</div>
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="passport_photo">{{ __('messages.passport_photo') }}</label>
													<div class="input-group">
													<div class="custom-file">
													<input type="file" id="passport_photo" class="custom-file-input" name="passport_photo" accept="image/png, image/gif, image/jpeg" >
													<label class="custom-file-label" for="passport_photo">{{ __('messages.choose_the_file') }}</label>
													</div>
													</div>
													<span id="passport_photo_name"></span>
													</div>
													</div>
													@endif
													@if($form_field['visa'] == 0)
													<div class="col-md-4">
													<div class="form-group">
													<label for="visa_number">{{ __('messages.visa_number') }}</label>
													<input type="text" maxlength="16" id="visa_number" class="form-control alloptions" placeholder="999999-99-9999" name="visa_number" data-parsley-trigger="change">
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group mb-3">
													<label for="text">{{ __('messages.visa_expiry_date') }}<span class="text-danger"></span></label>
													<div class="input-group input-group-merge">
													<div class="input-group-prepend">
													<div class="input-group-text">
													<span class="far fa-calendar-alt"></span>
													</div>
													</div>
													<input type="text" class="form-control" id="visa_expiry_date" name="visa_expiry_date" placeholder="{{ __('messages.yyyy_mm_dd') }}" aria-describedby="inputGroupPrepend">
													</div>
													</div>
													</div>
													<div class="col-md-4">
													<div class="form-group">
													<label for="visa_photo">{{ __('messages.visa_photo') }}</label>
													<div class="input-group">
													<div class="custom-file">
													<input type="file" id="visa_photo" class="custom-file-input" name="visa_photo" accept="image/png, image/gif, image/jpeg" >
													<label class="custom-file-label" for="visa_photo">{{ __('messages.choose_the_file') }}</label>
													</div>
													</div>
													<span id="visa_photo_name"></span>
													</div>
													</div>
													@endif
												</div>   -->
						<div class="row">


							<div class="col-md-4">
								<div class="form-group">
									<label for="guardian_company_name_local">{{ __('messages.work_company_name_local') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="guardian_company_name_local" value="{{ isset($parent['guardian_company_name_local']) ? $parent['guardian_company_name_local'] : ''}}" name="guardian_company_name_local" placeholder="{{ __('messages.enter_work_company_name_local') }}" aria-describedby="inputGroupPrepend">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="guardian_company_phone_number">{{ __('messages.work_company_phone_number') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control  number_validation " id="guardian_company_phone_number" value="{{ isset($parent['guardian_company_phone_number']) ? $parent['guardian_company_phone_number'] : ''}}" name="guardian_company_phone_number" placeholder="(XXX)-(XXX)-(XXXX)" aria-describedby="inputGroupPrepend">
									<label for="guardian_company_phone_number" class="error"></label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="guardian_employment_status">{{ __('messages.employment_status') }}<span class="text-danger">*</span></label>
									<select id="guardian_employment_status" name="guardian_employment_status" class="form-control">
										<option value="">{{ __('messages.select_employment_status') }}</option>
										<option value="Expat" {{ isset($parent['guardian_employment_status']) ? $parent['guardian_employment_status'] == "Expat" ? 'selected' : '' : '' }}>{{ __('messages.expat') }}</option>
										<option value="Local Hire" {{ isset($parent['guardian_employment_status']) ? $parent['guardian_employment_status'] == "Local Hire" ? 'selected' : '' : '' }}>{{ __('messages.local_hire') }}</option>
										<option value="Public Servant" {{ isset($parent['guardian_employment_status']) ? $parent['guardian_employment_status'] == "Public Servant" ? 'selected' : '' : '' }}>{{ __('messages.public_servant') }}</option>
										<option value="Self-Employed" {{ isset($parent['guardian_employment_status']) ? $parent['guardian_employment_status'] == "Self-Employed" ? 'selected' : '' : '' }}>{{ __('messages.self_employed') }}</option>
										<option value="Others" {{ isset($parent['guardian_employment_status']) ? $parent['guardian_employment_status'] == "Others" ? 'selected' : '' : '' }}>{{ __('messages.others') }}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="school_roleid">{{ __('messages.select_role') }}<span class="text-danger">*</span></label>
									<select class="form-control " id="school_roleid" name="school_roleid" data-placeholder="{{ __('messages.choose_role') }}">
										<option value="">{{ __('messages.select_role') }}</option>
										@forelse($school_roles as $r)
										@if($r['portal_roleid']==2 && $r['roles']!=null)
										<option value="{{$r['id']}}">{{ $r['fullname'] }} ( {{ $r['roles'] }} )</option>
										@endif
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
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
									<input type="text" class="form-control number_validation" id="japan_contact_no" value="{{ isset($parent['japan_contact_no']) ? $parent['japan_contact_no'] : ''}}" name="japan_contact_no" placeholder="" aria-describedby="inputGroupPrepend">
									<label for="japan_contact_no" class="error"></label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="japan_emergency_sms">{{ __('messages.Emergency_tel_sms') }}<span class="text-danger">*</span></label>
									<input type="text" class="form-control number_validation" id="japan_emergency_sms" value="{{ isset($parent['japan_emergency_sms']) ? $parent['japan_emergency_sms'] : ''}}" name="japan_emergency_sms" placeholder="" aria-describedby="inputGroupPrepend">
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
						<!-- <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="siblings">{{ __('messages.siblings') }}<span class="text-danger">*</span></label>
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
                                    <tr>
                                        <td>
										<input type="text" class="form-control" id="full_name" value="" name="full_name" placeholder="" aria-describedby="inputGroupPrepend">
                                        </td>
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-calendar"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control designationDatepicker" name="department_start[]" placeholder="{{ __('messages.yyyy_mm_dd') }}">
                                            </div>
                                        </td>
                                        <td>
										<input type="text" class="form-control" id="relationship" value="" name="relationship" placeholder="" aria-describedby="inputGroupPrepend">
                                        </td>
                                        <td>
                                            <button type="button" name="add_department" id="add_department" class="btn btn-primary">{{ __('messages.add') }} +</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->

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
							<div class="col-md-4">
								<div class="form-group">
									<label for="japanese_association_membership_image_principal">{{ __('messages.japanese_association_membership_image_principal') }}<span class="text-danger">*</span></label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" id="japanese_association_membership_image_principal" class="custom-file-input" value="" name="japanese_association_membership_image_principal" accept="image/png, image/gif, image/jpeg">
											<label class="custom-file-label" for="japanese_association_membership_image_principal">{{ __('messages.choose_file') }}</label>
										</div>
									</div>

									<span id="japanese_association_membership_image_principal_name"></span>
									<label for="japanese_association_membership_image_principal" class="error"></label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="japanese_association_membership_image_supplimental">{{ __('messages.japanese_association_membership_image_supplimental') }}</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" id="japanese_association_membership_image_supplimental" class="custom-file-input" name="japanese_association_membership_image_supplimental" accept="image/png, image/gif, image/jpeg">
											<label class="custom-file-label" for="japanese_association_membership_image_supplimental">{{ __('messages.choose_file') }}</label>
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
								<div class="form-group">
									<label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<span class="far fa-envelope-open"></span>
											</div>
										</div>
										<input type="text" class="form-control" name="email" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
									</div><label for="email" class="error"></label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="password">{{ __('messages.password') }}<span class="text-danger">*</span></label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<span class="fas fa-unlock"></span>
											</div>
										</div>
										<input type="password" class="form-control" name="password" id="password" placeholder="********" aria-describedby="inputGroupPrepend">
									</div><label for="password" class="error"></label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="confirm_password">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
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
							<div class="col-md-2">
								<div class="form-group mb-3">
									<label class="switch">{{ __('messages.authentication') }}

										<input id="status" name="status" type="checkbox">
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
				<!-- <div class="card">
																			<ul class="nav nav-tabs">
																			<li class="nav-item">
																			<h4 class="navv">
																			{{ __('messages.social_links') }}
																			<h4>
																			</li>
																			</ul>
																			<div class="card-body">
																			<div class="row">
																			<div class="col-md-4">
																			<div class="form-group mb-3">
																			<label for="facebook_url"> {{ __('messages.facebook') }}</label>
																			<div class="input-group input-group-merge">
																			<div class="input-group-prepend">
																			<div class="input-group-text">
																			<span class="fab fa-facebook-f"></span>
																			</div>
																			</div>
																			<input type="text" class="form-control" name="facebook_url" placeholder="{{ __('messages.enter_facebook_url') }}" aria-describedby="inputGroupPrepend">
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
																			<input type="text" class="form-control" name="twitter_url" placeholder="{{ __('messages.enter_twitter_url') }}" aria-describedby="inputGroupPrepend">
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
																			<input type="text" class="form-control" name="linkedin_url" placeholder="{{ __('messages.enter_linkedIn_url') }}" aria-describedby="inputGroupPrepend">
																			</div>
																			</div>
																			</div>
																			</div>
																		</div> <!-- end card-body -->
				<!-- </div> <!-- end card-->

				<div class="form-group text-right m-b-0">
					<button class="btn btn-primary-bl waves-effect waves-light" type="Save">
						{{ __('messages.save') }}
					</button>
					<!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
																				Cancel
																			</button>-->
				</div>
			</form>
		</div> <!-- end col -->

	</div><!-- end row -->
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
	var indexParent = "{{ route('admin.parent') }}";

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
</script>
<!-- <script src="{{ asset('libs/dropzone/min/dropzone.min.js') }}"></script> -->
<script src="{{ asset('libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/custom/parent.js') }}"></script>
<script>
	var parentList = "{{ route('admin.parent.list') }}";
	var yyyy_mm_dd = "{{ __('messages.yyyy_mm_dd') }}";
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
		// var $form_2 = $('#addparent');
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