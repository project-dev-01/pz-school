@extends('layouts.admin-layout')
@section('title',' ' . __('messages.student_list') . '')
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
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
			<div class="col-12">
				<div class="page-title-box" style="display: inline-flex; align-items: center;">
					<div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_122_3468)">
        <path d="M5.65939 2.52906C4.71434 2.52906 3.80799 2.91067 3.13974 3.58994C2.47149 4.26921 2.09607 5.19049 2.09607 6.15112V15.7027C1.51005 15.602 0.978038 15.2937 0.594355 14.8323C0.210673 14.3709 0.00010696 13.7863 0 13.1822V3.38131C0 2.70321 0.265 2.05289 0.736708 1.57341C1.20841 1.09392 1.84819 0.824554 2.51528 0.824554H18.3406C18.8606 0.824718 19.3678 0.988711 19.7924 1.29396C20.2169 1.59921 20.5379 2.0307 20.7113 2.52906H5.65939Z" fill="#3A4265" />
        <path d="M21.4851 3.59438H5.65982C4.99272 3.59438 4.35295 3.86375 3.88124 4.34323C3.40953 4.82271 3.14453 5.47304 3.14453 6.15113V15.952C3.14453 16.6301 3.40953 17.2804 3.88124 17.7599C4.35295 18.2394 4.99272 18.5088 5.65982 18.5088H21.4851C22.1522 18.5088 22.792 18.2394 23.2637 17.7599C23.7354 17.2804 24.0004 16.6301 24.0004 15.952V6.15113C24.0004 5.47304 23.7354 4.82271 23.2637 4.34323C22.792 3.86375 22.1522 3.59438 21.4851 3.59438ZM9.11833 6.47072C9.49144 6.47072 9.85616 6.58319 10.1664 6.79389C10.4766 7.0046 10.7184 7.30408 10.8612 7.65447C11.004 8.00486 11.0413 8.39041 10.9685 8.76238C10.8958 9.13435 10.7161 9.47603 10.4523 9.74421C10.1884 10.0124 9.8523 10.195 9.48636 10.269C9.12042 10.343 8.74112 10.305 8.39641 10.1599C8.05171 10.0148 7.75708 9.76897 7.5498 9.45363C7.34251 9.13829 7.23187 8.76755 7.23187 8.38829C7.23187 7.87972 7.43062 7.39198 7.7844 7.03237C8.13818 6.67275 8.61801 6.47072 9.11833 6.47072ZM5.55501 14.6736C5.55501 13.6848 5.94147 12.7364 6.62938 12.0371C7.31728 11.3379 8.25029 10.945 9.22313 10.945C10.196 10.945 11.129 11.3379 11.8169 12.0371C12.5048 12.7364 12.8913 13.6848 12.8913 14.6736H5.55501ZM21.6947 13.7149H15.1969C15.1413 13.7149 15.088 13.6924 15.0487 13.6524C15.0094 13.6125 14.9873 13.5583 14.9873 13.5018C14.9873 13.4453 15.0094 13.3911 15.0487 13.3511C15.088 13.3112 15.1413 13.2887 15.1969 13.2887H21.6947C21.7503 13.2887 21.8037 13.3112 21.843 13.3511C21.8823 13.3911 21.9044 13.4453 21.9044 13.5018C21.9044 13.5583 21.8823 13.6125 21.843 13.6524C21.8037 13.6924 21.7503 13.7149 21.6947 13.7149ZM21.6947 12.2234H15.1969C15.1413 12.2234 15.088 12.201 15.0487 12.161C15.0094 12.1211 14.9873 12.0669 14.9873 12.0104C14.9873 11.9538 15.0094 11.8997 15.0487 11.8597C15.088 11.8197 15.1413 11.7973 15.1969 11.7973H21.6947C21.7503 11.7973 21.8037 11.8197 21.843 11.8597C21.8823 11.8997 21.9044 11.9538 21.9044 12.0104C21.9044 12.0669 21.8823 12.1211 21.843 12.161C21.8037 12.201 21.7503 12.2234 21.6947 12.2234ZM21.6947 10.732H15.1969C15.1413 10.732 15.088 10.7095 15.0487 10.6696C15.0094 10.6296 14.9873 10.5754 14.9873 10.5189C14.9873 10.4624 15.0094 10.4082 15.0487 10.3683C15.088 10.3283 15.1413 10.3059 15.1969 10.3059H21.6947C21.7503 10.3059 21.8037 10.3283 21.843 10.3683C21.8823 10.4082 21.9044 10.4624 21.9044 10.5189C21.9044 10.5754 21.8823 10.6296 21.843 10.6696C21.8037 10.7095 21.7503 10.732 21.6947 10.732ZM21.6947 9.24054H15.1969C15.1413 9.24054 15.088 9.21809 15.0487 9.17813C15.0094 9.13817 14.9873 9.08398 14.9873 9.02748C14.9873 8.97097 15.0094 8.91678 15.0487 8.87682C15.088 8.83686 15.1413 8.81441 15.1969 8.81441H21.6947C21.7503 8.81441 21.8037 8.83686 21.843 8.87682C21.8823 8.91678 21.9044 8.97097 21.9044 9.02748C21.9044 9.08398 21.8823 9.13817 21.843 9.17813C21.8037 9.21809 21.7503 9.24054 21.6947 9.24054Z" fill="#3A4265" />
    </g>
    <defs>
        <clipPath id="clip0_122_3468">
            <rect width="24" height="17.6842" fill="white" transform="translate(0 0.824554)" />
        </clipPath>
    </defs>
</svg>
					</div>
					<!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
					<ol class="breadcrumb m-0 responsivebc">
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.student_details') }}</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.student_list') }}</a></li>
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
                        <h4 class="navv">   {{ __('messages.select_ground') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <form id="StudentFilter" autocomplete="off">
                        <div class="row">      
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">{{ __('messages.student_student_name') }}</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name" placeholder="{{ __('messages.yamamoto') }}">
                                </div>
                            </div>                       
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse ($classes as $class)
                                            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">{{ __('messages.select_class') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}<span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control"  name="session_id">                              
                                    <option value="">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                            <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            {{ __('messages.filter') }}
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


    <div class="row" id="student" style="display:none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.students_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap" id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('messages.name') }}</th>
                                            <th>{{ __('messages.register_no') }}</th>
                                            <th>{{ __('messages.attendance_no') }}</th>
                                            <th>{{ __('messages.gender') }}</th>
                                            <th>{{ __('messages.email') }}</th>
                                            <th>{{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@section('scripts')
<!-- plugin js -->
<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
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
    
    var studentImg = "{{ config('constants.image_url').'/'.config('constants.branch_id').'/users/images/' }}";
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    var studentList = "{{ route('teacher.student.list') }}";
    // localStorage variables
    var student_list_storage = localStorage.getItem('teacher_student_list_details');
</script>
<script src="{{ asset('js/custom/teacher_student_list.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection