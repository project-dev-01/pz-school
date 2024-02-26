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
                    <form id="menu-form" method="post" action="{{ route('super_admin.addmenu') }}" autocomplete="off">
                    @csrf                  
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role_id">{{ __('messages.portal') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" data-toggle="select2" id="role_id" name="role_id"  data-placeholder="{{ __('messages.choose_role') }}" onchange="rolemenus(this.value)" required>
                                        <option value="">{{ __('messages.select') }}</option>
                                        @forelse($roles as $r)
                                            @if($r['id']!='1')
                                            <option value="{{$r['id']}}">{{ __('messages.' . strtolower($r['role_name'])) }}</option>
                                            @endif
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_name') }} (Message(en/jp) Name)<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" name="menu_name" class="form-control " placeholder="{{ __('messages.enter_menu_name') }}" id="menu_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_type') }} <span class="text-danger">*</span> </label required>
                                    <select id="menu_type" name="menu_type" class="form-control" onchange="getrefid(this.value)">
                                    <option value="">{{ __('messages.select_menu_type') }}</option>
                                    
                                    <option value="Mainmenu">{{ __('messages.select_mainmenu') }}</option>
                                    <option value="Submenu">{{ __('messages.select_submenu') }}</option>
                                    <option value="Childmenu">{{ __('messages.select_childmenu') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu') }} <span class="text-danger">*</span></label>
                                    <select id="menu_refid" name="menu_refid" class="form-control" required>
                                        <option value="0">{{ __('messages.select_menu') }}</option>
                                        <option class="menulists none" value="0">{{ __('messages.none') }}</option>
                                            @php $i=0; $list_role = [];@endphp

                                            @foreach($mainmenu as $menu)
                                            @php
                                            $role=$menu['role_id'];
                                            if(in_array($role, $list_role))
                                            {$i++;}
                                            else
                                            {
                                                $i=1;
                                                $list_role[] = $role;
                                            }   
                                            $mainmenus="mainmenus".$menu['role_id']; 
                                            @endphp
                                            <option class="menulists {{ $mainmenus }}" value="{{ $menu['menu_id'] }}">{{ $i }}. {{ __("messages.".$menu['menu_name']) }}</option>
                                                @php $k=0;@endphp
                                                @foreach($submenu as $menu1)
                                                @php $k++; $submenus="submenus".$menu1['role_id'];@endphp
                                                @if($menu1['menu_refid']== $menu['menu_id'])
                                                <option class="menulists {{ $submenus }}" value="{{ $menu1['menu_id'] }}">{{ $i }}.{{ $k }}. {{ __("messages.".$menu1['menu_name']) }}</option>
                                                
                                                    <!-- @php $j=0;@endphp
                                                    @foreach($childmenu as $menu2)
                                                    
                                                    @php $j++;@endphp
                                                    @if($menu2['menu_refid']== $menu1['menu_id'])
                                                    <option value="{{ $menu2['menu_id'] }}">{{ $i }}.{{ $k }}.{{ $j }}. {{ __("messages.".$menu2['menu_name']) }}</option>
                                                        
                                                    @endif
                                                    @endforeach-->
                                                @endif
                                                @endforeach                                            
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">   
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">{{ __('messages.menu_icon') }}</label>
                                    <textarea class="form-control" name="menu_icon" placeholder="{{ __('messages.enter_menu_icon') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_url') }} <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" name="menu_url" class="form-control " placeholder="{{ __('messages.enter_menu_url') }}" id="menu_url" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_routename') }} <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" name="menu_routename" class="form-control " placeholder="{{ __('messages.enter_menu_routename') }}" id="menu_routename" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.dropdown') }} <span class="text-danger">*</span></label>
                                    <select id="menu_dropdown" name="menu_dropdown" class="form-control" required>
                                        <option value="">{{ __('messages.select') }}</option>
                                        <option value="Yes">{{ __('messages.yes') }}</option>
                                        <option value="No">{{ __('messages.no') }}</option>
                                    </select>
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.order_code') }} <span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" name="menu_order" class="form-control " placeholder="{{ __('messages.order_code') }}" id="menu_order" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('messages.menu_status') }} <span class="text-danger">*</span></label>
                                    <select id="menu_status" name="menu_status" class="form-control" required>
                                        <option value="">{{ __('messages.select_menu_status') }}</option>
                                        <option value="1">{{ __('messages.active') }}</option>
                                        <option value="0">{{ __('messages.de_active') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.save') }}
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>-->
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">{{ __('messages.menu_list') }}
                                    <h4>
                            </li>
                        </ul><br>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="table-responsive">
                                        <table class="table dt-responsive nowrap w-100" id="">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.portal') }}</th>
                                                    <th>#</th>
                                                    <th>{{ __('messages.menu_name') }}</th>
                                                    <th>{{ __('messages.menu_type') }}</th>							
                                                    <th>{{ __('messages.menu_url') }}</th>
                                                    <th>{{ __('messages.menu_status') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0;$list_role=[];@endphp
                                                @foreach($mainmenu as $menu)
                                                
                                                @php
                                                    $role=$menu['role_id'];
                                                    if(in_array($role, $list_role))
                                                    {$i++;}
                                                    else
                                                    {
                                                        $i=1;
                                                        $list_role[] = $role;
                                                    }
                                                @endphp
                                                <tr>
                                                    <th>{{ $menu['role_id'] }}</th>
                                                    <th>{{ $i }}</th>
                                                    <th>{!! $menu['menu_icon'] !!} {{ __("messages.".$menu['menu_name']) }}</th>
                                                    <th>{{ $menu['menu_type'] }}</th>
                                                    <th>{{ $menu['menu_url'] }}</th>
                                                    <th>{{ ($menu['menu_status']=='1')?__('messages.active'):__('messages.de_active') }}</th>
                                                    <th>
                                                        <div class="button-list">
                                                            
                                                            <a href="{{ url('syscont/menu/edit/'.$menu['menu_id']) }}" class="btn btn-blue waves-effect waves-light"  id="viewEventBtn"><i class="fe-edit"></i></a>
                                                        </div>
                                                    </th>
                                                </tr>
                                                    @php $k=0;@endphp
                                                    @foreach($submenu as $menu1)
                                                    @php $k++;@endphp
                                                    @if($menu1['menu_refid']== $menu['menu_id'])
                                                    <tr>
                                                        <th>{{ $menu1['role_id'] }}</th>
                                                        <th>{{ $i }}.{{ $k }}</th>
                                                        <th>{!! $menu1['menu_icon'] !!}{{ __("messages.".$menu1['menu_name']) }}</th>
                                                        <th>{{ $menu1['menu_type'] }}</th>
                                                        <th>{{ $menu1['menu_url'] }}</th>
                                                         <th>{{ ($menu1['menu_status']=='1')?__('messages.active'):__('messages.de_active') }}</th>
                                                        <th>
                                                        <div class="button-list">
                                                            
                                                            <a href="{{ url('syscont/menu/edit/'.$menu1['menu_id'])}}" class="btn btn-blue waves-effect waves-light"  id="viewEventBtn"><i class="fe-edit"></i></a>
                                                        </div>
                                                        </th>
                                                    </tr> 
                                                        @php $j=0;@endphp
                                                            @foreach($childmenu as $menu2)
                                                            
                                                            @php $j++;@endphp
                                                            @if($menu2['menu_refid']== $menu1['menu_id'])
                                                            <tr>
                                                                <th>{{ $menu2['role_id'] }}</th>
                                                                <th>{{ $i }}.{{ $k }}.{{ $j }}</th>
                                                                <th>{!! $menu2['menu_icon'] !!} {{ __("messages.".$menu2['menu_name']) }}</th>
                                                                <th>{{ $menu2['menu_type'] }}</th>
                                                                <th>{{ $menu2['menu_url'] }}</th>
                                                                <th>{{ ($menu2['menu_status']=='1')?__('messages.active'):__('messages.de_active') }}</th>
                                                                <th>
                                                                    <div class="button-list">
                                                                    
                                                                        <a href="{{ url('syscont/menu/edit/'.$menu2['menu_id']) }}" class="btn btn-blue waves-effect waves-light"  id="viewEventBtn"><i class="fe-edit"></i></a>
                                                                    </div>
                                                                </th>
                                                            </tr>     
                                                            @endif
                                                            @endforeach
                                                    @endif
                                                    @endforeach                                            
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-box -->
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
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
    function getrefid(val)
    {
        $('#menu_refid').val('');
        var role= $('#role_id').val();
        loadmenus();
        if(val=='Mainmenu')
        {
            $('.none').show();
            $('.none').attr('selected', true);
            $('.mainmenus'+role).hide();
            $('.submenus'+role).hide();
        }
        else if(val=='Submenu')
        {
            $('.mainmenus'+role).show();            
            $('.submenus'+role).hide();
            $('.mainmenus'+role).attr('disabled', false);
            $('.submenus'+role).attr('disabled', true);
        }
        else if(val=='Childmenu')
        {
            $('.mainmenus'+role).show();
            $('.submenus'+role).show();            
            $('.mainmenus'+role).attr('disabled', true);
            $('.submenus'+role).attr('disabled', false);
        }
    }
    function rolemenus(val)
    {
        loadmenus();
        $('.mainmenus'+val).show();
        $('.submenus'+val).show();
    }
    function loadmenus()
    {        
        $('.menulists').hide();      
        
    }
    $( document ).ready(function() {
        loadmenus();
    });
</script>

<script src="{{ asset('js/custom/login_activity.js') }}"></script>

@endsection