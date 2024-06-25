@extends('layouts.admin-layout')
@section('title',' ' . __('messages.export_examresult') . '')
@section('component_css')
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
<!-- date picker -->
<link href="{{ asset('date-picker/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('date-picker/style.css') }}" rel="stylesheet" type="text/css" />
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
<style>
    #loadingScreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .loading-text {
        color: white;
        font-size: 24px;
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<div id="loadingScreen" style="display: none;">
    <div class="loading-text">Downloading Please Wait...</div>
</div>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:5px;margin-top:5px">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_122_3540)">
                            <path d="M11.6723 7.52307H23.9923C23.9923 7.57178 23.9989 7.61596 23.9989 7.66013C23.9989 11.4662 23.9989 15.2726 23.9989 19.0794C23.9989 20.1385 23.5335 20.9076 22.617 21.3754C22.2871 21.5319 21.9266 21.6068 21.5639 21.5941C15.6759 21.5941 9.78752 21.5941 3.89876 21.5941C2.87519 21.5941 2.12471 21.1149 1.67136 20.1577C1.52487 19.8286 1.45347 19.4689 1.46271 19.1065C1.46271 16.5194 1.46271 13.9318 1.46271 11.3438C1.46271 11.3098 1.46271 11.2759 1.46271 11.2306C3.31323 12.7428 5.36039 13.1902 7.58014 12.3803C9.7999 11.5704 11.1261 9.88598 11.6723 7.52307ZM5.83013 17.3213H4.96823C4.67874 17.3213 4.54109 17.4584 4.54 17.7563C4.54 18.3431 4.54 18.9302 4.54 19.5177C4.54 19.8156 4.67983 19.955 4.96713 19.9561C5.52426 19.9561 6.08247 19.9482 6.63959 19.9561C6.99462 19.964 7.10713 19.7205 7.11697 19.46C7.13881 18.8879 7.12789 18.3136 7.11697 17.7405C7.11697 17.4595 6.97059 17.3191 6.69968 17.3179C6.41347 17.3202 6.1218 17.3213 5.83013 17.3213ZM5.84105 13.5833C5.54938 13.5833 5.25771 13.5833 4.96713 13.5833C4.67656 13.5833 4.54219 13.7305 4.5411 14.0262C4.5411 14.6137 4.5411 15.2008 4.5411 15.7876C4.5411 16.0844 4.68093 16.2248 4.97041 16.226C5.52754 16.226 6.08502 16.226 6.64287 16.226C6.7062 16.2326 6.77015 16.2247 6.83025 16.203C6.89036 16.1813 6.94517 16.1463 6.99084 16.1003C7.03652 16.0543 7.07197 15.9986 7.0947 15.9369C7.11743 15.8753 7.12689 15.8093 7.12243 15.7434C7.13008 15.1612 7.12899 14.5778 7.12243 13.9956C7.12243 13.7283 6.96512 13.5844 6.70513 13.5833C6.41674 13.581 6.12945 13.5833 5.84105 13.5833V13.5833ZM15.4542 9.81688C15.1712 9.81688 14.8883 9.81688 14.6054 9.81688C14.3224 9.81688 14.1771 9.96074 14.176 10.2553C14.176 10.8405 14.176 11.4265 14.176 12.0133C14.176 12.2953 14.3246 12.4517 14.5944 12.4517C15.1636 12.4517 15.7338 12.4517 16.303 12.4517C16.575 12.4517 16.7246 12.2999 16.7257 12.0189C16.7257 11.4277 16.7257 10.8367 16.7257 10.2462C16.7257 9.96301 16.5804 9.81802 16.3019 9.81688C16.0233 9.81575 15.7338 9.81688 15.452 9.81688H15.4542ZM15.4542 19.9572H16.303C16.5739 19.9572 16.7213 19.8054 16.7224 19.5223C16.7224 18.931 16.7224 18.3401 16.7224 17.7495C16.7224 17.4799 16.5804 17.3191 16.3226 17.3157C15.7404 17.3089 15.157 17.31 14.5748 17.3157C14.317 17.3157 14.175 17.4765 14.1739 17.7461C14.1739 18.3419 14.1739 18.9374 14.1739 19.5325C14.1739 19.8032 14.3279 19.955 14.5923 19.9572H15.4542ZM15.4465 16.1875C15.7338 16.1875 16.0211 16.1875 16.3073 16.1875C16.3631 16.1934 16.4194 16.1865 16.4722 16.1671C16.5251 16.1478 16.5731 16.1165 16.6128 16.0755C16.6526 16.0345 16.683 15.9849 16.702 15.9302C16.7209 15.8755 16.7279 15.8171 16.7224 15.7593C16.7224 15.165 16.7224 14.5695 16.7224 13.9729C16.7224 13.7022 16.5804 13.5516 16.3193 13.5493C15.7367 13.5493 15.1541 13.5493 14.5715 13.5493C14.3181 13.5493 14.176 13.7011 14.175 13.9673C14.175 14.5665 14.175 15.1668 14.175 15.7672C14.1711 15.8239 14.1792 15.8807 14.1986 15.9338C14.2179 15.9869 14.2482 16.035 14.2872 16.0749C14.3263 16.1147 14.3731 16.1453 14.4247 16.1645C14.4762 16.1838 14.5311 16.1912 14.5857 16.1863C14.8774 16.1886 15.1592 16.1875 15.4465 16.1875V16.1875ZM20.2913 9.81688C20.0051 9.81688 19.7178 9.81688 19.4305 9.81688C19.1432 9.81688 19.0197 9.95848 19.0176 10.2417C19.0176 10.8367 19.0176 11.4322 19.0176 12.028C19.0176 12.3089 19.1596 12.4517 19.4294 12.4517C20.004 12.4517 20.5782 12.4517 21.1521 12.4517C21.2078 12.457 21.264 12.4495 21.3165 12.4296C21.3691 12.4097 21.4167 12.378 21.456 12.3367C21.4953 12.2954 21.5253 12.2456 21.5437 12.1908C21.5622 12.1361 21.5687 12.0778 21.5628 12.0201C21.5628 11.4295 21.5628 10.8386 21.5628 10.2473C21.5628 9.97207 21.4176 9.81915 21.1532 9.81688C20.8659 9.81462 20.5786 9.81688 20.2913 9.81688V9.81688ZM20.2913 16.1875H21.1401C21.4176 16.1875 21.565 16.0334 21.5661 15.7434C21.5661 15.1567 21.5661 14.5699 21.5661 13.9843C21.5661 13.7067 21.4252 13.5516 21.1587 13.5504C20.5811 13.5459 20.0025 13.5459 19.4228 13.5504C19.1596 13.5504 19.023 13.6965 19.0208 13.9741C19.0208 14.5737 19.0208 15.1736 19.0208 15.774C19.0208 16.0425 19.1694 16.1875 19.4305 16.1886C19.7145 16.1886 20.0018 16.1875 20.288 16.1875H20.2913ZM10.6574 19.9606C10.9436 19.9606 11.2309 19.9606 11.5182 19.9606C11.5718 19.9651 11.6256 19.9576 11.6761 19.9387C11.7266 19.9197 11.7725 19.8897 11.8109 19.8507C11.8492 19.8117 11.879 19.7646 11.8982 19.7127C11.9175 19.6607 11.9257 19.605 11.9224 19.5494C11.9268 18.94 11.9268 18.331 11.9224 17.7223C11.9263 17.6688 11.9188 17.615 11.9006 17.5647C11.8824 17.5144 11.8539 17.4688 11.817 17.4311C11.7801 17.3933 11.7357 17.3644 11.687 17.3462C11.6382 17.3281 11.5862 17.3211 11.5346 17.3259C10.9426 17.3259 10.3505 17.3259 9.75839 17.3259C9.70916 17.321 9.65949 17.3271 9.61271 17.3437C9.56593 17.3603 9.52312 17.3871 9.48713 17.4223C9.45114 17.4575 9.42281 17.5002 9.40403 17.5477C9.38525 17.5951 9.37646 17.6462 9.37824 17.6974C9.37169 18.3204 9.37059 18.9434 9.37824 19.5653C9.37824 19.8213 9.53335 19.9572 9.78242 19.9595C10.0708 19.9606 10.3658 19.9606 10.6574 19.9606ZM20.2836 19.9606H21.1456C21.4143 19.9606 21.5618 19.8054 21.5628 19.5223C21.5628 18.9355 21.5628 18.3499 21.5628 17.7631C21.5628 17.4777 21.4197 17.327 21.1466 17.3259C20.572 17.3259 19.9974 17.3259 19.4239 17.3259C19.1639 17.3259 19.0208 17.4618 19.0187 17.728C19.0132 18.3374 19.0187 18.9457 19.0187 19.5551C19.0187 19.8179 19.1661 19.9584 19.4217 19.9606C19.709 19.9606 19.9963 19.9606 20.2836 19.9606V19.9606ZM9.37605 14.8961C9.37631 15.2362 9.50559 15.5625 9.73595 15.8046C9.96631 16.0466 10.2793 16.185 10.6072 16.1897C11.3238 16.1999 11.882 15.6585 11.8897 14.9437C11.8992 14.7687 11.8746 14.5935 11.8173 14.4287C11.7601 14.2638 11.6714 14.1125 11.5565 13.984C11.4416 13.8554 11.3029 13.7522 11.1487 13.6805C10.9945 13.6088 10.8279 13.5701 10.6589 13.5667C10.4899 13.5633 10.322 13.5952 10.1652 13.6606C10.0084 13.726 9.86591 13.8235 9.74626 13.9472C9.62661 14.071 9.53226 14.2186 9.46884 14.381C9.40542 14.5435 9.37423 14.7175 9.37715 14.8927L9.37605 14.8961Z" fill="#3A4265" />
                            <path d="M18.1436 2.78145C18.1436 2.37026 18.1436 1.98852 18.1436 1.59546C18.1436 1.35305 18.2813 1.1922 18.4877 1.17861C18.5398 1.17067 18.593 1.17481 18.6434 1.19073C18.6937 1.20665 18.7401 1.23396 18.7791 1.27068C18.818 1.30741 18.8487 1.35264 18.8687 1.40312C18.8888 1.4536 18.8979 1.50807 18.8952 1.56261C18.8952 1.95907 18.8952 2.35553 18.8952 2.77578H19.0503C19.969 2.77578 20.8877 2.77578 21.8065 2.77578C22.3096 2.76976 22.7989 2.94607 23.19 3.27428C23.5811 3.60248 23.8494 4.06198 23.9486 4.57345C23.978 4.72257 23.993 4.87435 23.9934 5.02655C23.9934 5.56348 23.9934 6.10153 23.9934 6.63845C23.9934 6.66451 23.9934 6.69056 23.9869 6.72568H11.7302C11.7841 6.0372 11.7224 5.34425 11.5477 4.67767C11.3769 4.00712 11.1103 3.36684 10.7568 2.77805L18.1436 2.78145Z" fill="#3A4265" />
                            <path d="M5.50967 0.590698C8.52687 0.590698 11.0197 3.14618 11.0274 6.2601C11.0294 7.77723 10.4501 9.23307 9.41701 10.3073C8.38387 11.3816 6.9815 11.9863 5.5184 11.9884C4.0553 11.9905 2.65133 11.3898 1.61533 10.3185C0.579329 9.24726 -0.00382552 7.79309 -0.00585362 6.27595C-0.0102232 3.16543 2.47608 0.600893 5.50967 0.590698ZM9.41499 6.3122C9.40955 5.24292 8.99772 4.21899 8.26885 3.46257C7.53999 2.70614 6.55287 2.27824 5.52168 2.27169C4.49317 2.27169 3.50678 2.69536 2.77951 3.44949C2.05224 4.20362 1.64367 5.22644 1.64367 6.29295C1.64367 7.35945 2.05224 8.38227 2.77951 9.1364C3.50678 9.89053 4.49317 10.3142 5.52168 10.3142C7.65951 10.3063 9.41499 8.50973 9.41499 6.3122Z" fill="#3A4265" />
                            <path d="M5.39707 6.38353H5.55765C6.04486 6.38353 6.53207 6.38353 7.01928 6.38353C7.27162 6.38353 7.42238 6.53645 7.42348 6.7766C7.42457 7.01674 7.27382 7.1606 7.01711 7.1606C6.36167 7.1606 5.70623 7.1606 5.05079 7.1606C4.78861 7.1606 4.65534 7.0258 4.65534 6.75394C4.65534 6.06296 4.65534 5.37274 4.65534 4.68328C4.65441 4.6327 4.66309 4.58243 4.68089 4.53533C4.69869 4.48824 4.72527 4.44524 4.7591 4.40879C4.79293 4.37234 4.83336 4.34316 4.87806 4.32292C4.92277 4.30267 4.97088 4.29175 5.01965 4.29078C5.06843 4.28981 5.1169 4.29882 5.16232 4.31728C5.20774 4.33574 5.24922 4.3633 5.28436 4.39838C5.31951 4.43346 5.34765 4.47537 5.36717 4.52173C5.3867 4.56808 5.39723 4.61798 5.39816 4.66855C5.40472 5.17829 5.39816 5.68803 5.39816 6.19776L5.39707 6.38353Z" fill="#3A4265" />
                        </g>
                        <defs>
                            <clipPath id="clip0_122_3540">
                                <rect width="24" height="21" fill="white" transform="translate(0 0.595215)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <!--<h4 class="page-title" style="margin-left: 10px;">{{ __('messages.student_profile') }}</h4>-->
                <ol class="breadcrumb m-0 responsivebc">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.exam_master') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.exam_results') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('messages.export_examresult') }}</a></li>
                </ol>

            </div>

        </div>
    </div>
    <!-- end page title -->
    @if($message = Session::get('errors'))
    <div class="alert alert-warning alert-block alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <!-- Button placed on the left side -->
                        <h4 class="navv">
                            {{ __('messages.select_ground') }}
                        </h4>
                        <!-- Up and Down Arrows -->
                        <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                            <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                        </button>
                    </li>
                </ul>

                <div class="card-body collapse show">
                    <form id="bysubjectfilter" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btwyears"> {{ __('messages.academic_year') }}<span class="text-danger">*</span></label>
                                    <select id="btwyears" class="form-control" name="year">
                                        <option value="">{{ __('messages.select_academic_year') }}</option>
                                        @forelse($academic_year_list as $r)
                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id">{{ __('messages.department') }}<span class="text-danger">*</span></label>
                                    <select id="department_id" name="department_id" class="form-control">
                                        <option value="">{{ __('messages.select_department') }}</option>
                                        @forelse($department as $r)

                                        <option value="{{$r['id']}}">{{$r['name']}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="changeClassName"> {{ __('messages.grade') }}<span class="text-danger">*</span></label>
                                    <select id="changeClassName" class="form-control" name="class_id">
                                        <option value="">{{ __('messages.select_grade') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3" id="section_drp_div">
                                <div class="form-group">
                                    <label for="sectionID" id="lblsectionId">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                    <select id="sectionID" class="form-control" name="section_id">
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
                                        <option value="{{ $sem['id'] }}" {{ $sem['id'] == $current_semester ? 'selected' : '' }}>
                                            {{ $sem['name'] }}
                                        </option>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="examnames">{{ __('messages.test_name') }}<span class="text-danger">*</span></label>
                                    <select id="examnames" class="form-control" name="examnames">
                                        <option value="">{{ __('messages.select_exams') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_id">{{ __('messages.report_type') }}<span class="text-danger">*</span></label>
                                    <select id="report_type" class="form-control" name="report_type">
                                        <option value="">{{ __('messages.select') }}</option>
                                        <option value="report_card">{{ __('messages.report_card') }}</option>
                                        <option value="personal_test_result">{{ __('messages.personal_test_res') }}</option>
                                        <option value="english_communication">{{ __('messages.english_communication') }}</option>
                                        <option value="yoroku_report">{{ __('messages.yoroku_report') }}</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                {{ __('messages.get') }}
                            </button>
                        </div>
                    </form>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

    <form method="post" id="individual_pdf" action="#">
        @csrf
        <input type="hidden" name="department_id" class="downDepartmentID">
        <input type="hidden" name="exam_id" class="downExamID">
        <input type="hidden" name="class_id" class="downClassID">
        <input type="hidden" name="semester_id" class="downSemesterID">
        <input type="hidden" name="session_id" class="downSessionID">
        <input type="hidden" name="section_id" class="downSectionID">
        <input type="hidden" name="academic_year" class="downAcademicYear">
        <input type="hidden" name="report_type" class="downReport_type">
        <input type="hidden" name="student_id" class="downstudent_id">
    </form>

    <div class="row" style="display: none;" id="byec_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <h4 class="navv">
                            {{ __('messages.english_communication') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <!-- <div id="btnAppend">
                            </div> -->
                            @include('admin.exam_results.ec_student_table')
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form id="form1" method="post" action="{{ route('admin.exam_results.downbyecreport') }}">
                                        @csrf

                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">

                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_zip_file') }}</button>
                                        </div>
                                    </form>
                                    <form id="allPdfForm1" method="post" action="{{ route('admin.exam_results.downbyecreportfile') }}">
                                        @csrf

                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">

                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_all_pdf') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" style="display: none;" id="byreport_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <h4 class="navv">
                            {{ __('messages.report_card') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('admin.exam_results.student_table')

                            <!-- <div id="btnAppend">
                            </div> -->
                            <div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form id="form2" method="post" action="{{ route('admin.exam_results.downbyreportcard') }}">
                                        @csrf

                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">

                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_zip_file') }}</button>
                                        </div>
                                    </form>
                                    <form id="allPdfForm2" method="post" action="{{ route('admin.exam_results.downbyreportcardfile') }}">
                                        @csrf
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_all_pdf') }}</button>
                                            <!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->

                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" style="display: none;" id="byyoroku_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <h4 class="navv">
                            {{ __('messages.yoroku_report') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('admin.exam_results.yorokustudent_table')

                            <!-- <div id="btnAppend">
                            </div> -->
                            <!--<div class="col-md-12">
                                <div class="clearfix mt-4">
                                    <form id="form2" method="post" action="{{ route('admin.exam_results.downbyreportcard') }}">
                                        @csrf

                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">

                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_zip_file') }}</button>
                                        </div>
                                    </form>
                                    <form id="allPdfForm2" method="post" action="{{ route('admin.exam_results.downbyreportcardfile') }}">
                                        @csrf
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_all_pdf') }}</button>
                                            <button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>
                                        </div>
                                    </form>
                                </div>

                            </div>-->

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->

                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <div class="row" style="display: none;" id="bypersonal_body">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                        <h4 class="navv">
                            Secondary {{ __('messages.personal_test_res') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">

                            <div id="primary_personal">
                                <h4> Report Secondary School Only </h4>
                            </div>

                            <div class="col-md-12" id="secondary_personal">
                                @include('admin.exam_results.chartstudent_table')
                                <div class="clearfix mt-4">
                                    <form id="form3" method="post" action="{{ route('admin.exam_results.downbypersoanalreport') }}">
                                        @csrf
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_zip_file') }}</button>
                                        </div>
                                    </form>
                                    <form id="allPdfForm3" method="post" action="{{ route('admin.exam_results.downbypersoanalreportfile') }}">
                                        @csrf
                                        <input type="hidden" name="department_id" class="downDepartmentID">
                                        <input type="hidden" name="exam_id" class="downExamID">
                                        <input type="hidden" name="class_id" class="downClassID">
                                        <input type="hidden" name="semester_id" class="downSemesterID">
                                        <input type="hidden" name="session_id" class="downSessionID">
                                        <input type="hidden" name="section_id" class="downSectionID">
                                        <input type="hidden" name="academic_year" class="downAcademicYear">
                                        <input type="hidden" name="report_type" class="downReport_type">
                                        <div class="clearfix float-right" style="margin-bottom:5px; margin-left: 10px;">
                                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light" style="white-space: nowrap;">{{ __('messages.download_all_pdf') }}</button>
                                            <!--<button type="button" class="btn btn-primary-bl waves-effect waves-light exportToExcel">{{ __('messages.download') }}</button>-->
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
</div> <!-- container -->

@endsection
@section('scripts')

<script src="{{ asset('libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- validation js -->
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/dist/jquery.table2excel.js') }}"></script>

<script>
    var studentList = "{{ route('admin.by_result.sutdentlist') }}";
    // var sectionByClass = "{{ config('constants.api.exam_results_get_class_by_section') }}";
    var sectionByClass = "{{ config('constants.api.section_by_class') }}";
    //var studentList = "{{ route('admin.student.list') }}";

    var downbyecreport = "{{ route('admin.individual.downbyecreport') }}";
    var downbyreportcard = "{{ route('admin.individual.downbyreportcard') }}";
    var downbypersoanalreport = "{{ route('admin.individual.downbypersoanalreport') }}";
    
    var downbyprimaryyoroku = "{{ route('admin.individual.downloadyorokuprimary') }}";
    var downbysecondaryyoroku = "{{ route('admin.individual.downloadyorokusecondary') }}";

    var examsByclassandsection = "{{ config('constants.api.exam_by_classSection') }}";
    var getbySubject = "{{ config('constants.api.tot_grade_calcu_bySubject') }}";
    var Allexams = "{{ config('constants.api.all_exams_list') }}";
    var getbySubjectAllstd = "{{ config('constants.api.all_bysubject_list') }}";
    var getgradeBysubject = "{{ config('constants.api.get_grade_bysubject') }}";
    var getGradeByDepartmentUrl = "{{ config('constants.api.grade_list_by_departmentId') }}";
    var teacher_id = null;
    // default image test
    var defaultImg = "{{ config('constants.image_url').'/common-asset/images/users/default.jpg' }}";
    var downloadFileName = "{{ __('messages.by_subject') }}";
    // localStorage variables
    var exam_result_by_report_storage = localStorage.getItem('admin_exam_result_by_report_details');
</script>
<script src="{{ asset('js/custom/byreport.js') }}"></script>
<script src="{{ asset('js/custom/collapse.js') }}"></script>
@endsection