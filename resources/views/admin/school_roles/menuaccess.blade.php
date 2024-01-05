@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.menu_creation') . '')
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
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
	
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
					<li class="breadcrumb-item active">List</li>
                    </ol>
				</div> -->
                <h4 class="page-title">{{ __('messages.menu_access') }}</h4>
			</div>
		</div>
	</div>
    <!-- end page title -->
	
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.menu_access') }}<h4>
						</li>
						</ul><br>
						
						<div class="card-body">
							<form id="q" method="post" action="{{ route('admin.school_role.getmenus') }}" autocomplete="off" novalidate="novalidate">                    
								@csrf     
								<div class="row">
									
									<!-- <div class="col-md-3">
										<div class="form-group">
										<label for="role_id">{{ __('messages.branch') }}<span class="text-danger">*</span></label>
										<select class="form-control" data-toggle="select2" id="branch_id" name="branch_id"  data-placeholder="{{ __('messages.choose_branch') }}" required>
                                        <option value="">{{ __('messages.select') }}</option>
                                        @forelse($branches as $br)
                                        @php $selbr =(@$branch_id==$br['id'])?'Selected':''; @endphp
                                        <option value="{{$br['id']}}" {{ $selbr }}>{{ $br['name'] }}</option>
                                        @empty
                                        @endforelse
										</select>
										</div>
									</div>-->
									<input type="hidden" name="branch_id" value="4">
									<div class="col-md-3">
										<div class="form-group">
											<label for="role_id">{{ __('messages.school_roles') }}<span class="text-danger">*</span></label>
											<select class="form-control" data-toggle="select2" id="school_roleid" name="school_roleid"  data-placeholder="{{ __('messages.choose_branch') }}" required>
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
											<select class="form-control" data-toggle="select2" id="role_id" name="role_id"  data-placeholder="{{ __('messages.choose_role') }}" required>
												<option value="">{{ __('messages.select') }}</option>
												@forelse($roles as $r)
												
												@if($r['id']!='1')
												@if(@$role_id==6  &&  $r['id']==6)
												<option value="{{$r['id']}}" Selected>{{ __('messages.' . strtolower($r['role_name'])) }}</option>
												@elseif(@$role_id==5  &&  $r['id']==5)
												<option value="{{$r['id']}}" Selected>{{ __('messages.' . strtolower($r['role_name'])) }}</option>
												@elseif($r['id']==2  ||  $r['id']==3 ||  $r['id']==4)
												@php $selrl =(@$role_id==$r['id'])?'Selected':''; @endphp
												<option value="{{$r['id']}}" {{ $selrl }}>{{ __('messages.' . strtolower($r['role_name'])) }}</option>
												@endif
												@endif
												@empty
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-3"><br>
										<button type="submit" class="btn btn-success" name="getmenus" value="get"> GET Permissions </button>
									</div>
								</div>
								
							</form>
							<br><hr><br>
							<div class="table-responsive">
							<input type="checkbox" id="select_all" /> Select all
								<form  method="post" action="{{ route('admin.school_role.setpermission') }}" autocomplete="off" novalidate="novalidate">                    
								@csrf     
									<table class="table dt-responsive nowrap w-100">
										<thead>
											<tr>
												<th>#</th>
												<th>{{ __('messages.name') }}</th>
												<th>Read (View Page)</th>
												<th>Add </th>
												<th>Update </th>
												<th>Delete </th>
																				
												<th>Export (Export / Download)</th>
												
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
													<input type="hidden" name="menu_id[]" value="{{$menu['menu_id']}}" >
													<input type="hidden" name="menuaccess_id[{{$menu['menu_id']}}]" value="{{ $menu['menuaccess_id'] }}" >                                            
													<input type="hidden" name="act[{{$menu['menu_id']}}]" value="{{ $act }}" >
												</th>
												<th><input type="checkbox"  name="read[{{$menu['menu_id']}}]" class="checkall" id="mainmenu{{ $i }}" onchange="mainmenu({{ $i }},'A')" value="Access" {{ $readbtn1 }}> Read</th>
												@if($menu['menu_dropdown']=='No')                
												<th><input type="checkbox"  name="add[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}"  value="Access" {{ $addbtn1 }}> Add</th>
												<th><input type="checkbox"  name="updates[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}"  value="Access" {{ $updatebtn1 }}> Update</th>
												<th><input type="checkbox"  name="deletes[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}"  value="Access" {{ $deletebtn1 }}> Delete</th>
												<th><input type="checkbox"  name="export[{{$menu['menu_id']}}]" class="checkall mainmenu{{ $i }}" value="Access" {{ $exportbtn1 }}> Export</th>
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
											<tr class="submenu{{ $i }}" >
												<th>&emsp;{{ $i }}.{{ $k }}</th>
												<th>&emsp;{{ __("messages.".$menu1['menu_name']) }}
													<input type="hidden" name="menu_id[]" value="{{$menu1['menu_id']}}" >
													<input type="hidden" name="menuaccess_id[{{$menu1['menu_id']}}]" value="{{ $menu1['menuaccess_id'] }}" >                                            
													<input type="hidden" name="act[{{$menu1['menu_id']}}]" value="  {{ $act}}" >
												</th>
												<th><input type="checkbox"  name="read[{{$menu1['menu_id']}}]" class="checkall" id="submenu{{ $i }}{{ $k }}"   onchange="submenu({{ $i }}{{ $k }},'A')" value="Access"  {{ $readbtn2 }}> Read</th>
												@if($menu1['menu_dropdown']=='No')
                                                <th><input type="checkbox"  name="add[{{$menu1['menu_id']}}]"  class="checkall submenu{{ $i }}{{ $k }}" value="Access" {{ $addbtn2 }}> Add</th>
												<th><input type="checkbox"  name="updates[{{$menu1['menu_id']}}]" class="checkall submenu{{ $i }}{{ $k }}"  value="Access" {{ $updatebtn2 }}> Update</th>
												<th><input type="checkbox"  name="deletes[{{$menu1['menu_id']}}]"  class="checkall  submenu{{ $i }}{{ $k }}"  value="Access" {{ $deletebtn2 }}> Delete</th>
												<th><input type="checkbox"  name="export[{{$menu1['menu_id']}}]"  class="checkall  submenu{{ $i }}{{ $k }}"  value="Access" {{ $exportbtn2 }}> Export</th>
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
                                            <tr class="submenu{{ $i }} childmenu{{ $i }}{{ $k }} " >
                                                <th>&emsp;&emsp;{{ $i }}.{{ $k }}.{{ $j }}
                                                    <input type="hidden" name="menu_id[]" value="{{$menu2['menu_id']}}" >
                                                    <input type="hidden" name="menuaccess_id[{{$menu2['menu_id']}}]"  value="{{ $menu2['menuaccess_id'] }}" >                                            
                                                    <input type="hidden" name="act[{{$menu2['menu_id']}}]" value="{{$act}}" >
												</th>
                                                <th>&emsp;&emsp;{{ __("messages.".$menu2['menu_name']) }}</th>
                                                <th><input type="checkbox"  name="read[{{$menu2['menu_id']}}]" class="checkall" id="childmenu{{ $i }}{{ $k }}{{ $j }}" onchange="childmenu({{ $i }}{{ $k }}{{ $j }},'A')" value="Access"  {{ $readbtn3 }}> Read</th>
                                                @if($menu2['menu_dropdown']=='No')
												<th><input type="checkbox"  name="add[{{$menu2['menu_id']}}]"  class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $addbtn3 }}> Add</th>
												<th><input type="checkbox"  name="updates[{{$menu2['menu_id']}}]"  class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $updatebtn3 }}> Update</th>
												<th><input type="checkbox"  name="deletes[{{$menu2['menu_id']}}]"  class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $deletebtn3 }}> Delete</th>
												<th><input type="checkbox"  name="export[{{$menu2['menu_id']}}]"  class="checkall childmenu{{ $i }}{{ $k }}{{ $j }}" value="Access" {{ $exportbtn3 }}> Export</th>
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
									<input type="hidden" name="role_id" value="{{ @$role_id}}">
									<input type="hidden" name="branch_id" value="{{ @$branch_id}}">
									<input type="hidden" name="school_roleid" value="{{ @$school_roleid}}">
									@if(isset($branch_id))
									<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#confirm">Set Permission</button>
									
									@endif
									<!-- Trigger the modal with a button -->
									
									<!-- Modal -->
									<div id="confirm" class="modal fade" role="dialog">
										<div class="modal-dialog">
											
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Menu Access Permission</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													
												</div>
												<div class="modal-body">
													<h4>Are You Confirm To Set Access Permission</h4>
												</div>
												<div class="modal-footer">
													<button name="submit" name="set" value="update" class="btn btn-success btn-lg"> Update </button>
													<button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">Close</button>                 
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
		<script src="{{ asset('buttons-datatables/vfs_fonts.js') }}"></script>
		<script src="{{ asset('buttons-datatables/buttons.html5.min.js') }}"></script>
		<!-- validation js -->
		<script src="{{ asset('js/validation/validation.js') }}"></script>
		<script>
			//feesGroup routes
			var login_activityList = "{{ route('admin.login_activity.list') }}";
			
			// Get PDF Footer Text
			var header_txt="{{ __('messages.fees_group') }}";
			var footer_txt="{{ session()->get('footer_text') }}";
			// Get PDF Header & Footer Text End
			function mainmenu(id,per)
			{
				if ($("#mainmenu"+id).is(":checked")) {
    
					$('.mainmenu'+id).attr('disabled',false);
					$('.submenu'+id).show();
					
				}
				else
				{
					
					$('.submenu'+id).hide();
					$('.mainmenu'+id).attr('disabled',true);
				}
				
			}

			function submenu(id,per)
			{
				if ($("#submenu"+id).is(":checked")) {
    
					$('.submenu'+id).attr('disabled',false);
					$('.childmenu'+id).show();
					
				}
				else
				{
					
					$('.childmenu'+id).hide();
					$('.submenu'+id).attr('disabled',true);
				}
			}
			function childmenu(id,per)
			{
				if ($("#childmenu"+id).is(":checked")) {
    
					$('.childmenu'+id).attr('disabled',false);
				}
				else
				{
					$('.childmenu'+id).attr('disabled',true);
				}
			}
			$(document).ready(function(){ 
				
				var schoolroleDetails = "{{ route('admin.school_role.details') }}";
				$('#school_roleid').change(function(){
					var id = $(this).val();
					$("#role_id").html('');
        
        $.post(schoolroleDetails, { id: id }, function (data) {
            
			
			if(data.data.portal_roleid==5)
			{
				$("#role_id").html('<option value="5">Parent</option>');
			}
			else if(data.data.portal_roleid==6)
			{
				$("#role_id").html('<option value="6">Student</option>');
			}
			else
			{
				$("#role_id").html('<option value="">Select</option><option value="2">Admin</option><option value="3">Staff</option><option value="4">Teacher</option>');
			}
        }, 'json');
        console.log(id);
				});	
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