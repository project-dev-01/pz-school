@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.menu_creation') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- button link  -->
<link rel="stylesheet" href="{{ asset('public/datatable/css/buttons.dataTables.min.css') }}">
<!-- date picker -->
<link href="{{ asset('public/date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">
<link href="{{ asset('public/css/custom/buttonresponsive.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="page-title">{{ __('messages.menu_creation') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="nav-link">{{ __('messages.menu_creation') }}<h4>
                    </li>
                </ul><br>
                
                <div class="card-body">
                    <form id="q" method="post" action="{{ route('super_admin.getmenus') }}" autocomplete="off" novalidate="novalidate">                    
                    @csrf     
                        <div class="row">
                            
                            <div class="col-md-3">
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role_id">{{ __('messages.portal') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" data-toggle="select2" id="role_id" name="role_id"  data-placeholder="{{ __('messages.choose_role') }}" required>
                                        <option value="">{{ __('messages.select') }}</option>
                                        @forelse($roles as $r)
                                        @if($r['id']!='1')
                                        @php $selrl =(@$role_id==$r['id'])?'Selected':''; @endphp
                                            <option value="{{$r['id']}}" {{ $selrl }}>{{ __('messages.' . strtolower($r['role_name'])) }}</option>
                                        @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit" name="getmenus" value="get">
                            GET MENUS
                            </button>
                        </div>
                        
                    </form>
                    <br><hr><br>
                    <div class="table-responsive">
                    <form  method="post" action="{{ route('super_admin.setpermission') }}" autocomplete="off" novalidate="novalidate">                    
                    @csrf  
                        <table class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th>{{ __('messages.name') }}</th>
									<th>Access</th>
                                    <th>Denied</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0;@endphp
                                @foreach($mainmenu as $menu)
                                @if($menu['menu_status']==1)
                                @php $i++; 
                                $acbtn=($menu['menu_permission']=='Access')?'checked':'checked';
                                $debtn=($menu['menu_permission']=='Denied')?'checked':'';
                                $act=($menu['menuaccess_id']!=null)?'Update':'Insert';
                                @endphp
                                <tr>
                                    <th>{{ $i }}</th>
									<th>{{ __("messages.".$menu['menu_name']) }} 
                                        <input type="hidden" name="menu_id[]" value="{{$menu['menu_id']}}" >
                                        <input type="hidden" name="menuaccess_id[{{$menu['menu_id']}}]" value="{{ $menu['menuaccess_id'] }}" >                                            
                                        <input type="hidden" name="act[{{$menu['menu_id']}}]" value="{{ $act }}" >
                                    </th>
									<th><input type="radio"  name="accessdenied[{{$menu['menu_id']}}]" class="mainmenu{{ $i }}" onclick="mainmenu({{ $i }},'A')" value="Access" {{ $acbtn }}> Access</th>
                                    <th><input type="radio"  name="accessdenied[{{$menu['menu_id']}}]" class="mainmenu{{ $i }}"onclick="mainmenu({{ $i }},'D')" value="Denied" {{ $debtn }}> Denied</th>
                                    
                                </tr>
                                    @php $k=0;@endphp
                                    @foreach($submenu as $menu1) 
                                    @if($menu1['menu_status']==1)                                  
                                    @if($menu1['menu_refid']== $menu['menu_id'])
                                    @php $k++;
                                        $acbtn=($menu1['menu_permission']=='Access')?'checked':'checked';
                                        $debtn=($menu1['menu_permission']=='Denied')?'checked':'';
                                        $act=($menu1['menuaccess_id']!=null)?'Update':'Insert';
                                    @endphp
                                    <tr class="submenu{{ $i }}" >
                                        <th>{{ $i }}.{{ $k }}</th>
                                        <th>{{ __("messages.".$menu1['menu_name']) }}
                                            <input type="hidden" name="menu_id[]" value="{{$menu1['menu_id']}}" >
                                            <input type="hidden" name="menuaccess_id[{{$menu1['menu_id']}}]" value="{{ $menu1['menuaccess_id'] }}" >                                            
                                            <input type="hidden" name="act[{{$menu1['menu_id']}}]" value="  {{ $act}}" >
                                        </th>
                                        <th><input type="radio"  name="accessdenied[{{$menu1['menu_id']}}]"  onclick="submenu({{ $i }}{{ $k }},'A')" value="Access"  {{ $acbtn }}> Access</th>
                                        <th><input type="radio"  name="accessdenied[{{$menu1['menu_id']}}]"  onclick="submenu({{ $i }}{{ $k }},'D')" value="Denied" {{ $debtn }}> Denied</th>
                                        
                                    </tr>
                                    
                                            @php $j=0;@endphp
                                            @foreach($childmenu as $menu2)
                                            
                                            @if($menu2['menu_status']==1)
                                            @if($menu2['menu_refid']== $menu1['menu_id'])
                                            @php $j++;
                                                $acbtn=($menu2['menu_permission']=='Access')?'checked':'checked';
                                                $debtn=($menu2['menu_permission']=='Denied')?'checked':'';
                                                $act=($menu2['menuaccess_id']!=null)?'Update':'Insert';
                                            @endphp
                                            <tr class="childmenu{{ $i }}{{ $k }} " >
                                                <th>{{ $i }}.{{ $k }}.{{ $j }}
                                                    <input type="hidden" name="menu_id[]" value="{{$menu2['menu_id']}}" >
                                                    <input type="hidden" name="menuaccess_id[{{$menu2['menu_id']}}]" value="{{ $menu2['menuaccess_id'] }}" >                                            
                                                    <input type="hidden" name="act[{{$menu2['menu_id']}}]" value="{{$act}}" >
                                                </th>                                                
                                                <th>{{ __("messages.".$menu2['menu_name']) }}</th>
                                                <th><input type="radio"  name="accessdenied[{{$menu2['menu_id']}}]"  onclick="childmenu({{ $i }}{{ $k }}{{ $j }},'A')" value="Access"  {{ $acbtn }}> Access</th>
                                                <th><input type="radio"  name="accessdenied[{{$menu2['menu_id']}}]"  onclick="childmenu({{ $i }}{{ $k }}{{ $j }},'D')" value="Denied" {{ $debtn }}> Denied</th>
                                                
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
                        @if(isset($branch_id))
                        <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="button" data-toggle="modal" data-target="#confirm">Set Permission</button>
                        </div>
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
      <!--<div class="modal-footer">
      <button name="submit" name="set" value="update" class="btn btn-success btn-lg"> Update </button>
      <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">Close</button>                 
      </div>-->
      <div class="modal-footer">
      <button type="button" class="btn btn-light" data-dismiss="modal" name="set" value="update">Close</button>
      <button type="submit" class="btn btn-success waves-effect waves-light" data-dismiss="modal">Update</button>
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
<script src="{{ asset('public/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/date-picker/jquery-ui.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<!-- button js added -->
<script src="{{ asset('public/buttons-datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/buttons-datatables/buttons.html5.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    //feesGroup routes
    var login_activityList = "{{ route('admin.login_activity.list') }}";

    // Get PDF Footer Text
    var header_txt="{{ __('messages.fees_group') }}";
    var footer_txt="{{ session()->get('footer_text') }}";
    // Get PDF Header & Footer Text End
    function mainmenu(id,per)
    {
        
        if(per=='A')
        {
            $('.submenu'+id).show();
        }
        else
        {
            $('.submenu'+id).hide();

        }
    }
    function submenu(id,per)
    {
        if(per=='A')
        {
            $('.childmenu'+id).show();
        }
        else
        {
            $('.childmenu'+id).hide();
            
        }
    }
</script>

<script src="{{ asset('public/js/custom/login_activity.js') }}"></script>

@endsection