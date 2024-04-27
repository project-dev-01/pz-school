@extends('layouts.admin-layout')
@section('title',' ' . __('messages.menu_creation') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
		<div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="black">
                                    <path d="M21.5,21.5v129h64.5v-32.25v-64.5v-32.25zM86,53.75c0,17.7805 14.4695,32.25 32.25,32.25c17.7805,0 32.25,-14.4695 32.25,-32.25c0,-17.7805 -14.4695,-32.25 -32.25,-32.25c-17.7805,0 -32.25,14.4695 -32.25,32.25zM118.25,86c-17.7805,0 -32.25,14.4695 -32.25,32.25c0,17.7805 14.4695,32.25 32.25,32.25c17.7805,0 32.25,-14.4695 32.25,-32.25c0,-17.7805 -14.4695,-32.25 -32.25,-32.25z"></path>
                                </g>
                            </g>
                        </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('messages.school_roles') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.school_rolepermissions') }}</a></li>
                </ol>

            </div>   
			
		</div>
	</div>
	<!-- end page title -->

	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<h4 class="nav-link">{{ __('messages.menu_access') }}
							<h4>
					</li>
				</ul><br>
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
				<div class="card-body">
					<form id="q" method="post" action="{{ route('admin.school_role.getmenus') }}" autocomplete="off">
						@csrf
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="role_id">{{ __('messages.school_roles') }}<span class="text-danger">*</span></label>
									<select class="form-control" data-toggle="select2" id="school_roleid" name="school_roleid" data-placeholder="{{ __('messages.choose_branch') }}" required>
										<option value="">{{ __('messages.select') }}</option>
										@forelse($school_roles as $sr)
										@if($sr['id']!=1)
										@php $selbr =(@$school_roleid==$sr['id'])?'Selected':''; @endphp
										<option value="{{$sr['id']}}" {{ $selbr }}>{{ $sr['fullname'] }}</option>
										@endif
										@empty
										@endforelse
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="role_id">{{ __('messages.portal') }}<span class="text-danger">*</span></label>
									<select class="form-control" data-toggle="select2" id="role_id" name="role_id" data-placeholder="{{ __('messages.choose_role') }}" required>
										<option value="">{{ __('messages.select') }}</option>

									</select>
								</div>
							</div>
							<div class="col-md-3">

							</div>

							<div class="form-group text-right m-b-0">
								<button class="btn btn-primary-bl waves-effect waves-light" type="submit" name="getmenus" value="get" style="width: 150px;margin-top: 27px;">
									{{ __('messages.get_permissions') }}
								</button>
							</div>
						</div>

					</form>
					<br>
					<hr><br>
					<div class="table-responsive">
						<form method="post" style="float:right;" action="{{ route('admin.school_role.deleteschoolpermission') }}" autocomplete="off" novalidate="novalidate">
							@csrf
							<input type="hidden" name="role_id" id="prole_id" value="{{ @$role_id }}">
							<input type="hidden" name="school_roleid" value="{{ @$school_roleid }}">
							@if(isset($branch_id))
							<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmdelete"> {{ __('messages.remove_portal_access_permission') }} </button>

							@endif
							<!-- Trigger the modal with a button -->

							<!-- Modal -->
							<div id="confirmdelete" class="modal fade" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">{{ __('messages.remove_portal_access_permission') }} </h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>

										</div>
										<div class="modal-body">
											<h4>{{ __('messages.menu_access_deleteconfirmation') }}</h4>
										</div>
										<div class="modal-footer">
											<button name="submit" name="set" value="update" class="btn btn-danger btn-lg"> {{ __('messages.delete') }} </button>
											<button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">{{ __('messages.close') }}</button>
										</div>
									</div>

								</div>
							</div><br><br>
						</form>
						<input type="checkbox" id="select_all" />{{ __('messages.select_all') }}
						<form method="post" action="{{ route('admin.school_role.setpermission') }}" autocomplete="off" novalidate="novalidate">
							@csrf
							<input type="hidden" name="role_id" id="prole_id" value="{{ @$role_id }}">
							<input type="hidden" name="school_roleid" value="{{ @$school_roleid }}">
							<table class="table dt-responsive nowrap w-100">
								<thead>
									<tr>
										<th>#</th>
										<th>{{ __('messages.name') }}</th>
										<th>{{ __('messages.read') }}</th>
										<th>{{ __('messages.add') }} </th>
										<th>{{ __('messages.update') }} </th>
										<th>{{ __('messages.delete') }} </th>

										<th>{{ __('messages.export') }} </th>

									</tr>
								</thead>
								<tbody>
									@php $i=0;@endphp
									@foreach($mainmenu as $menu)
									@if($menu['menu_status']==1)
									@php $i++;
									$readbtn1=($menu['menu_read']=='Access')?'checked':'';
									@endphp
									@if($menu['menu_read']=='Access')
									@php
									$addbtn1=($menu['menu_add']=='Access')?'checked':'';
									$updatebtn1=($menu['menu_update']=='Access')?'checked':'';
									$deletebtn1=($menu['menu_delete']=='Access')?'checked':'';
									$exportbtn1=($menu['menu_export']=='Access')?'checked':'';
									@endphp
									@else
									@php
									$addbtn1=($menu['menu_add']=='Access')?'checked':'readonly';
									$updatebtn1=($menu['menu_update']=='Access')?'checked':'readonly';
									$deletebtn1=($menu['menu_delete']=='Access')?'checked':'readonly';
									$exportbtn1=($menu['menu_export']=='Access')?'checked':'readonly';
									@endphp
									@endif
									@php
									$act=($menu['menuaccess_id']!=null)?'Update':'Insert';
									@endphp
									<tr>
										<th>{{ $i }}</th>
										<th>{{ __("messages.".$menu['menu_name']) }}
											<input type="hidden" name="menu_id[]" value="{{$menu['menu_id']}}">
											<input type="hidden" name="menuaccess_id[{{$menu['menu_id']}}]" value="{{ $menu['menuaccess_id'] }}">
											<input type="hidden" name="act[{{$menu['menu_id']}}]" value="{{ $act }}">
										</th>
										<th><input type="checkbox" name="read[{{$menu['menu_id']}}]" class="checkall" id="mainmenu{{ $i }}" onchange="mainmenu({{ $i }},'A')" value="Access" {{ $readbtn1 }}>{{ __('messages.read') }}</th>
										@if($menu['menu_dropdown']=='No')
										<th><input type="checkbox" name="add[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}" value="Access" {{ $addbtn1 }}> {{ __('messages.add') }}</th>
										<th><input type="checkbox" name="updates[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}" value="Access" {{ $updatebtn1 }}> {{ __('messages.update') }}</th>
										<th><input type="checkbox" name="deletes[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}" value="Access" {{ $deletebtn1 }}> {{ __('messages.delete') }}</th>
										<th><input type="checkbox" name="export[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}" value="Access" {{ $exportbtn1 }}> {{ __('messages.export') }}</th>
										@else
										<th colspan="4"></th>
										@endif
									</tr>
									@php $k=0;@endphp
									@foreach($submenu as $menu1)
									@if($menu1['menu_status']==1)
									@if($menu1['menu_refid']== $menu['menu_id'])
									@php $k++;

									$readbtn2=($menu1['menu_read']=='Access')?'checked':'';@endphp
									@if($menu1['menu_read']=='Access')
									@php
									$addbtn2=($menu1['menu_add']=='Access')?'checked':'';
									$updatebtn2=($menu1['menu_update']=='Access')?'checked':'';
									$deletebtn2=($menu1['menu_delete']=='Access')?'checked':'';
									$exportbtn2=($menu1['menu_export']=='Access')?'checked':'';
									@endphp
									@else
									@php
									$addbtn2=($menu1['menu_add']=='Access')?'checked':'readonly';
									$updatebtn2=($menu1['menu_update']=='Access')?'checked':'readonly';
									$deletebtn2=($menu1['menu_delete']=='Access')?'checked':'readonly';
									$exportbtn2=($menu1['menu_export']=='Access')?'checked':'readonly';
									@endphp
									@endif
									@php
									$act=($menu1['menuaccess_id']!=null)?'Update':'Insert';
									@endphp
									<tr class="submenu{{ $i }}">
										<th>&emsp;{{ $i }}.{{ $k }}</th>
										<th>&emsp;{{ __("messages.".$menu1['menu_name']) }}
											<input type="hidden" name="menu_id[]" value="{{$menu1['menu_id']}}">
											<input type="hidden" name="menuaccess_id[{{$menu1['menu_id']}}]" value="{{ $menu1['menuaccess_id'] }}">
											<input type="hidden" name="act[{{$menu1['menu_id']}}]" value="  {{ $act}}">
										</th>
										<th><input type="checkbox" name="read[{{$menu1['menu_id']}}]" class="checkall" id="submenu{{ $i }}{{ $k }}" onchange="submenu({{ $i }}{{ $k }},'A')" value="Access" {{ $readbtn2 }}>{{ __('messages.read') }}</th>
										@if($menu1['menu_dropdown']=='No')
										<th><input type="checkbox" name="add[{{$menu1['menu_id']}}]" class="checkall submenu{{ $i }}{{ $k }}" value="Access" {{ $addbtn2 }}>{{ __('messages.add') }}</th>
										<th><input type="checkbox" name="updates[{{$menu1['menu_id']}}]" class="checkall submenu{{ $i }}{{ $k }}" value="Access" {{ $updatebtn2 }}>{{ __('messages.update') }}</th>
										<th><input type="checkbox" name="deletes[{{$menu1['menu_id']}}]" class="checkall  submenu{{ $i }}{{ $k }}" value="Access" {{ $deletebtn2 }}>{{ __('messages.delete') }}</th>
										<th><input type="checkbox" name="export[{{$menu1['menu_id']}}]" class="checkall  submenu{{ $i }}{{ $k }}" value="Access" {{ $exportbtn2 }}>{{ __('messages.export') }}</th>
										@else
										<th colspan="4"></th>
										@endif
									</tr>
									@php $j=0;@endphp
									@foreach($childmenu as $menu2)

									@if($menu2['menu_status']==1)
									@if($menu2['menu_refid']== $menu1['menu_id'])
									@php $j++;

									$readbtn3=($menu2['menu_read']=='Access')?'checked':'';@endphp
									@if($menu2['menu_read']=='Access')
									@php
									$addbtn3=($menu2['menu_add']=='Access')?'checked':'';
									$updatebtn3=($menu2['menu_update']=='Access')?'checked':'';
									$deletebtn3=($menu2['menu_delete']=='Access')?'checked':'';
									$exportbtn3=($menu2['menu_export']=='Access')?'checked':'';
									@endphp
									@else
									@php
									$addbtn3=($menu2['menu_add']=='Access')?'checked':'readonly';
									$updatebtn3=($menu2['menu_update']=='Access')?'checked':'readonly';
									$deletebtn3=($menu2['menu_delete']=='Access')?'checked':'readonly';
									$exportbtn3=($menu2['menu_export']=='Access')?'checked':'readonly';
									@endphp
									@endif
									@php
									$act=($menu2['menuaccess_id']!=null)?'Update':'Insert';
									@endphp
									<tr class="submenu{{ $i }} childmenu{{ $i }}{{ $k }} ">
										<th>&emsp;&emsp;{{ $i }}.{{ $k }}.{{ $j }}
											<input type="hidden" name="menu_id[]" value="{{$menu2['menu_id']}}">
											<input type="hidden" name="menuaccess_id[{{$menu2['menu_id']}}]" value="{{ $menu2['menuaccess_id'] }}">
											<input type="hidden" name="act[{{$menu2['menu_id']}}]" value="{{$act}}">
										</th>
										<th>&emsp;&emsp;{{ __("messages.".$menu2['menu_name']) }}</th>
										<th><input type="checkbox" name="read[{{$menu2['menu_id']}}]" class="checkall" id="childmenu{{ $i }}{{ $k }}{{ $j }}" onchange="childmenu({{ $i }}{{ $k }}{{ $j }},'A')" value="Access" {{ $readbtn3 }}>{{ __('messages.read') }}</th>
										@if($menu2['menu_dropdown']=='No')
										<th><input type="checkbox" name="add[{{$menu2['menu_id']}}]" class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $addbtn3 }}>{{ __('messages.add') }}</th>
										<th><input type="checkbox" name="updates[{{$menu2['menu_id']}}]" class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $updatebtn3 }}> {{ __('messages.update') }}</th>
										<th><input type="checkbox" name="deletes[{{$menu2['menu_id']}}]" class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $deletebtn3 }}>{{ __('messages.delete') }} </th>
										<th><input type="checkbox" name="export[{{$menu2['menu_id']}}]" class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $exportbtn3 }}> {{ __('messages.export') }}</th>
										@else
										<th colspan="4"></th>
										@endif
									</tr>
									@endif
									@endif
									@endforeach
									@endif
									@endif
									@endforeach
									@endif
									@endforeach
								</tbody>
							</table>

							@if(isset($branch_id))
							<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#confirm">{{ __('messages.set_permission') }}</button> -->
							<div class="form-group text-left m-b-0">
								<button class="btn btn-primary-bl waves-effect waves-light" data-toggle="modal" data-target="#confirm" style="width: 150px;">
									{{ __('messages.set_permission') }}
								</button>
							</div>
							@endif
							<!-- Trigger the modal with a button -->

							<!-- Modal -->
							<div id="confirm" class="modal fade" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">{{ __('messages.menu_access') }}</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>

										</div>
										<div class="modal-body">
											<h4>{{ __('messages.menu_access_confirmation') }}</h4>
										</div>
										<div class="modal-footer">
											<button name="submit" name="set" value="update" class="btn btn-success btn-lg">{{ __('messages.update') }}</button>
											<button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">{{ __('messages.close') }}</button>
										</div>
									</div>

								</div>
							</div>
						</form>
					</div>
				</div> <!-- end card-box -->
			</div> <!-- end col -->
		</div>
	</div>
	<!--- end row -->
</div>
<!-- container -->
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
<script src="{{ asset('buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}" async></script>
<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
	//feesGroup routes
	var login_activityList = "{{ route('admin.login_activity.list') }}";

	// Get PDF Footer Text
	var header_txt = "{{ __('messages.fees_group') }}";
	var footer_txt = "{{ session()->get('footer_text') }}";
	// Get PDF Header & Footer Text End
	function mainmenu(id, per) {
		if ($("#mainmenu" + id).is(":checked")) {

			$('.mainmenu' + id).attr('disabled', false);
			$('.submenu' + id).show();

		} else {

			$('.submenu' + id).hide();
			$('.mainmenu' + id).attr('disabled', true);
		}

	}

	function submenu(id, per) {
		if ($("#submenu" + id).is(":checked")) {

			$('.submenu' + id).attr('disabled', false);
			$('.childmenu' + id).show();

		} else {

			$('.childmenu' + id).hide();
			$('.submenu' + id).attr('disabled', true);
		}
	}

	function childmenu(id, per) {
		if ($("#childmenu" + id).is(":checked")) {

			$('.childmenu' + id).attr('disabled', false);
		} else {
			$('.childmenu' + id).attr('disabled', true);
		}
	}

	$(document).ready(function() {
		var sid = $('#school_roleid').val();

		setTimeout(function() {
			get_roles(sid);

		}, 2000);
		setTimeout(function() {

			var role_id = $('#prole_id').val();
			$("#role_id").val(role_id);
		}, 3000);
		var schoolroleDetails = "{{ route('admin.school_menurole.details') }}";
		$('#school_roleid').change(function() {
			var id = $(this).val();
			get_roles(id);

		});

		function get_roles(id) {
			$.post(schoolroleDetails, {
				id: id
			}, function(data) {

				$("#role_id").empty();
				$("#role_id").append('<option value="">' + select + '</option>');

				$.each(data.data, function(key, val) {

					$("#role_id").append('<option value="' + val.id + '">' + val.role_name + '</option>');
				});

			}, 'json');

		}

	});
</script>
<script>
	$("#select_all").click(function() {
		var isChecked = $(this).prop('checked');
		//$("input[type='checkbox']").prop('checked', isChecked);
		//$("input[type='checkbox']").attr('checked', isChecked);
		$(".checkall").attr('checked', isChecked);
	});
</script>
<script src="{{ asset('js/custom/login_activity.js') }}"></script>

@endsection