@extends('layouts.admin-layout')
@section('title','Schedule List')
@section('component_css')
<link href="{{ asset('libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #eee;
        opacity: 1;
    }

    .edit-button {
        float: right !important;
        position: absolute;
        right: 13px;
        top: 5px;
    }

    .table td,
    .table th {
        padding: .85rem;
        border-bottom: 1px solid #dee2e6;
    }

    .dt-responsive {
        width: max-content;
    }

    @media only screen and (min-device-width: 280px) and (max-device-width: 1200px) {
        .dt-responsive {
            width: max-content;
        }

    }
</style>
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_59_2159)">
                            <path d="M12.0082 0.333357C12.3265 0.333368 12.6405 0.404131 12.9251 0.540022L23.5031 5.58224H23.5171C23.647 5.62866 23.761 5.70847 23.8462 5.81281C23.9315 5.91715 23.9847 6.04195 24 6.17336C23.9982 6.30157 23.9577 6.42658 23.8832 6.5334C23.8087 6.64021 23.7035 6.7243 23.5801 6.77558L21.0137 8.27336C18.3696 9.82003 15.7193 11.3659 13.0627 12.9111C12.7472 13.1111 12.3767 13.2178 11.9977 13.2178C11.6187 13.2178 11.2482 13.1111 10.9327 12.9111C7.45176 10.8845 3.9732 8.85335 0.496966 6.8178C0.379773 6.75335 0.27226 6.67412 0.17734 6.58224C0.115835 6.52749 0.0677813 6.46047 0.0366231 6.38598C0.00546495 6.31149 -0.00803291 6.23136 -0.00290644 6.15132C0.00222003 6.07128 0.0258503 5.99332 0.0662845 5.92298C0.106719 5.85265 0.162958 5.79169 0.230996 5.74447C0.310931 5.67767 0.399533 5.62091 0.494631 5.57558L11.1403 0.502248C11.4121 0.383066 11.7091 0.325266 12.0082 0.333357Z" fill="#3A4265" />
                            <path d="M21.1514 12.4066C21.1514 13.0444 21.1374 13.68 21.1514 14.3178C21.1643 15.0128 20.8884 15.6845 20.3838 16.1866C19.6546 16.9248 18.7675 17.5053 17.7825 17.8889C16.5167 18.4161 15.1736 18.7556 13.8 18.8955C12.7461 19.017 11.6818 19.0319 10.6247 18.94C8.75486 18.8117 6.93588 18.3016 5.29134 17.4444C4.51122 17.0555 3.83519 16.5013 3.31526 15.8244C3.0033 15.3987 2.84004 14.8902 2.84865 14.3711C2.84865 13.0978 2.84865 11.8244 2.84865 10.5511C2.8478 10.4175 2.86585 10.2845 2.90231 10.1555C2.9083 10.1149 2.92398 10.0761 2.94813 10.0422C2.97228 10.0082 3.00428 9.97996 3.04166 9.95959C3.07903 9.93921 3.1208 9.92726 3.16378 9.92463C3.20675 9.922 3.24979 9.92877 3.2896 9.94442C3.38779 9.96817 3.48148 10.0064 3.56725 10.0578C5.83263 11.38 8.09101 12.7244 10.3611 14.0266C10.846 14.3304 11.4138 14.4923 11.9942 14.4923C12.5746 14.4923 13.1424 14.3304 13.6273 14.0266C15.9604 12.6822 18.2724 11.3133 20.5961 9.95553C20.6498 9.92442 20.7011 9.89109 20.7571 9.8622C20.9461 9.76887 21.0814 9.82664 21.121 10.0244C21.1396 10.1242 21.149 10.2253 21.149 10.3266C21.1537 11.0244 21.1514 11.7155 21.1514 12.4066Z" fill="#3A4265" />
                            <path d="M23.1624 12.5133C23.1624 13.6244 23.1624 14.7467 23.1624 15.8622C23.1591 15.9211 23.173 15.9798 23.2027 16.0316C23.2323 16.0834 23.2766 16.1263 23.3304 16.1555C23.5427 16.2768 23.7097 16.4585 23.8077 16.675C23.9056 16.8916 23.9296 17.132 23.8763 17.3622C23.8387 17.5901 23.7293 17.8018 23.5627 17.9692C23.396 18.1366 23.18 18.252 22.9431 18.3C22.6665 18.3611 22.3762 18.3295 22.1212 18.2105C21.8662 18.0915 21.6621 17.8923 21.5433 17.6467C21.4199 17.4087 21.3873 17.1373 21.4512 16.879C21.515 16.6207 21.6713 16.3916 21.8932 16.2311C21.9841 16.1758 22.057 16.0974 22.1036 16.0047C22.1502 15.912 22.1686 15.8088 22.1569 15.7067C22.1569 13.7355 22.1569 11.7667 22.1569 9.79776C22.1398 9.66544 22.1673 9.53139 22.2352 9.41482C22.3031 9.29825 22.4079 9.20515 22.5348 9.14888C22.6818 9.07777 22.8171 8.98887 22.9618 8.91331C23.1064 8.83776 23.1391 8.87332 23.1694 9.00221C23.1819 9.06069 23.1874 9.12033 23.1857 9.17998L23.1624 12.5133Z" fill="#3A4265" />
                        </g>
                        <defs>
                            <clipPath id="clip0_59_2159">
                                <rect width="24" height="18.6667" fill="white" transform="translate(0 0.333313)" />
                            </clipPath>
                        </defs>
                    </svg>

                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.time_table') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 timetableForm">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv"> {{ __('messages.select_ground') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <form id="indexFilter" method="post" action="{{ route('staff.timetable.details') }}" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">{{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                        @forelse($class as $cla)
                                        <option value="{{$cla['class_id']}}">{{$cla['class_name']}}</option>
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="semester_id">{{ __('messages.semester') }}</label>
                                    <select id="semester_id" class="form-control" name="semester_id">
                                        <option value="0">{{ __('messages.select_semester') }}</option>
                                        @forelse($semester as $sem)
                                        <option value="{{$sem['id']}}">{{$sem['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" style="display:none;">
                                <div class="form-group">
                                    <label for="session_id">{{ __('messages.session') }}</label>
                                    <select id="session_id" class="form-control" name="session_id">
                                        <option value="0">{{ __('messages.select_session') }}</option>
                                        @forelse($session as $ses)
                                        <option value="{{$ses['id']}}">{{ __('messages.' . strtolower($ses['name'])) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
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

    <div class="row" id="timetablerow" style="display:none;">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">  {{ __('messages.schedule_list') }}
                            <h4>
                                <button class="btn btn-link " type="button" id="collapseButton2" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                    </li>
                </ul>
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive table2excel">
                                    <tbody id="timetable">
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix mt-4">
                                <form method="post" action="{{ route('staff.timetable.pdf') }}">
                                    @csrf
                                    <input type="hidden" name="class_id" id="downClassID">
                                    <input type="hidden" name="section_id" id="downSectionID">
                                    <input type="hidden" name="semester_id" id="downSemesterID">
                                    <input type="hidden" name="session_id" id="downSessionID">
                                    <input type="hidden" name="academic_year" id="downAcademicYear">
                                    <div class="clearfix float-right">
                                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light exportToPDF" id="exportToPDF"  style="margin-right:5px;">{{ __('messages.pdf') }}</button>
                                        <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel" style="float:right;">{{ __('messages.download') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

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
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>
<script>
    var sectionByClass = "{{ route('staff.section_by_class') }}";
</script>
<script src="{{ asset('js/custom/timetable.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection