
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">UI</a></li>
                    <li class="breadcrumb-item active">Tabs & Accordions</li>
                </ol>
            </div>
            <h4 class="page-title">SOAP</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="">
            <!-- <h4 class="header-title mb-4">SOAP</h4>-->

            <ul class="nav nav-pills navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#d1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#pi1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                        Personal Info
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#subjective" data-toggle="tab" aria-expanded="true" class="nav-link">
                        S-Subjective
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#objective" data-toggle="tab" aria-expanded="true" class="nav-link">
                        O-Objective
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#assessment" data-toggle="tab" aria-expanded="true" class="nav-link">
                        A-Assessment
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#plan" data-toggle="tab" aria-expanded="true" class="nav-link">
                        P-Plan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#l1" data-toggle="tab" aria-expanded="true" class="nav-link">
                        logs
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- start Dashboard -->
                <div class="tab-pane show active" id="d1">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                            <i class="fe-bar-chart font-22 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="mt-1"><span data-plugin="counterup">58</span>%</h3>
                                            <p class="text-muted mb-1 text-truncate">Physical Status
                                            </p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-sm-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                            <i class="fe-bar-chart-2 font-22 avatar-title text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span>%</h3>
                                            <p class="text-muted mb-1 text-truncate">psychological
                                                Status</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-sm-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">0.58</span>%</h3>
                                            <p class="text-muted mb-1 text-truncate">Normal</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-sm-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                            <i class="fe-eye font-22 avatar-title text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">78</span>%</h3>
                                            <p class="text-muted mb-1 text-truncate">Today's Visits
                                            </p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <div class="col-xl-6 col-sm-6 col-md-6">
                            <div class="card-box color">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Edit
                                            Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Export
                                            Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">{{ __('messages.action') }}</a>
                                    </div>
                                </div>

                                <h4 class="header-title mb-3">Old Records</h4>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>S.no</th>
                                                <th colspan="2">Student Profile</th>
                                                <th>{{ __('messages.class') }}</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td style="width: 36px;">
                                                    <img src="../assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since
                                                            2017</small></p>
                                                </td>

                                                <td>
                                                    X
                                                </td>

                                                <td>
                                                    12/11/2022
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td style="width: 36px;">
                                                    <img src="../assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since
                                                            2017</small></p>
                                                </td>

                                                <td>
                                                    X
                                                </td>

                                                <td>
                                                    12/11/2022
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-6 col-sm-6 col-md-6">
                            <div class="card-box color">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Edit
                                            Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Export
                                            Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">{{ __('messages.action') }}</a>
                                    </div>
                                </div>

                                <h4 class="header-title mb-3">New Records</h4>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>S.no</th>
                                                <th colspan="2">Student Profile</th>
                                                <th>{{ __('messages.class') }}</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td style="width: 36px;">
                                                    <img src="../assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since
                                                            2017</small></p>
                                                </td>

                                                <td>
                                                    X
                                                </td>

                                                <td>
                                                    12/11/2022
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td style="width: 36px;">
                                                    <img src="../assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since
                                                            2017</small></p>
                                                </td>

                                                <td>
                                                    X
                                                </td>

                                                <td>
                                                    12/11/2022
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- end Dashboard -->
                <!-- Start personal tab-->
                <div class="tab-pane" id="pi1">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-6 col-xl-3">
                                            <div class="widget-rounded-circle card-box">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                            <i class="fe-bar-chart font-22 avatar-title text-primary" data-toggle="modal" data-target="#personalinfo"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-right">
                                                            <h3 class="mt-1"><span data-plugin="counterup">58</span>%
                                                            </h3>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                Academic Status</p>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end widget-rounded-circle-->
                                        </div> <!-- end col-->

                                        <div class="col-md-6 col-xl-3">
                                            <div class="widget-rounded-circle card-box">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                            <i class="fe-bar-chart-2 font-22 avatar-title text-success" data-toggle="modal" data-target="#personalinfo"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-right">
                                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span>%
                                                            </h3>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                Classroom Management Status</p>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end widget-rounded-circle-->
                                        </div> <!-- end col-->

                                        <div class="col-md-6 col-xl-3">
                                            <div class="widget-rounded-circle card-box">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                            <i class="fe-bar-chart-line- font-22 avatar-title text-info" data-toggle="modal" data-target="#personalinfo"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-right">
                                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">0.58</span>%
                                                            </h3>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                Attendance Report</p>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end widget-rounded-circle-->
                                        </div> <!-- end col-->

                                        <div class="col-md-6 col-xl-3">
                                            <div class="widget-rounded-circle card-box">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                            <i class="fe-eye font-22 avatar-title text-warning" data-toggle="modal" data-target="#personalinfo"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-right">
                                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">78</span>%
                                                            </h3>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                Homework Status</p>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end widget-rounded-circle-->
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->


                                    <!-- Start Personal Info Popup -->
                                    <div class="modal fade viewEvent" id="personalinfo" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="personalinfo" style="color: #6FC6CC"> <i class="fas fa-info-circle"></i> Academic
                                                        Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card-box eventpopup" style="background-color: #8adfee14;">
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">
                                                                        <style>
                                                                            .table td {
                                                                                border-top: none;
                                                                            }
                                                                        </style>
                                                                        <tr>
                                                                            <td>{{ __('messages.name') }}</td>
                                                                            <td id="title"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ __('messages.class') }}</td>
                                                                            <td id="type"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ __('messages.subject') }}</td>
                                                                            <td id="start_date">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ __('messages.grade') }}</td>
                                                                            <td id="end_date"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Description</td>
                                                                            <td id="description">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div> <!-- end card-box -->
                                                        </div> <!-- end col -->
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- End Personal Info Popup -->




                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <h4 class="navv">{{ __('messages.student_details') }}<h4>
                                                    </li>
                                                </ul>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="fas fa-user-graduate"></span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="fname" class="form-control alloptions" maxlength="50" id="fname" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="">{{ __('messages.last_name') }}</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="fas fa-user-graduate"></span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="lname" class="form-control alloptions" maxlength="50" id="lname" placeholder="Muhammad Jaafar" aria-describedby="inputGroupPrepend">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gender">{{ __('messages.gender') }}</label>
                                                                <select id="gender" name="gender" class="form-control">
                                                                    <option value="">Select Gender
                                                                    </option>
                                                                    <option value="Male">Male
                                                                    </option>
                                                                    <option value="Female">Female
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="blooddgrp">Blood
                                                                    Group</label>
                                                                <select id="blooddgrp" name="blooddgrp" class="form-control">
                                                                    <option value="">Pick Blood Type
                                                                    </option>
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
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="dob">Date Of
                                                                    Birth</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="fas fa-birthday-cake"></span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="dob" class="form-control" id="dob" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="Passport">Passport
                                                                    Number</label>
                                                                <input type="text" maxlength="50" class="form-control alloptions" placeholder="Passport Number" name="txt_passport">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_nric">NRIC
                                                                    Number</label>
                                                                <input type="text" maxlength="50" id="txt_nric" class="form-control alloptions" placeholder="Identifaction Number" name="txt_nric" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_religion">{{ __('messages.religion') }}</label>
                                                                <select class="form-control" name="txt_religion" id="religion">
                                                                    <option value="">Choose Religion
                                                                    </option>
                                                                    <option value="">Islam</option>
                                                                    <option value="">Hindu</option>
                                                                    <option value="">Budha</option>
                                                                    <option value="">Kristian
                                                                    </option>
                                                                    <option value="">Sikh</option>
                                                                    <option value="">Animisme
                                                                    </option>
                                                                    <option value="">Taoisme
                                                                    </option>
                                                                    <option value="">Confiusme
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_caste">{{ __('messages.race') }}</label>
                                                                <select class="form-control" name="txt_race" id="addRace">
                                                                    <option value="">Choose Race
                                                                    </option>
                                                                    <option value="">Melayu</option>
                                                                    <option value="">Cina</option>
                                                                    <option value="">India</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_mobile_no">Mobile
                                                                    No<span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control" name="txt_mobile_no" id="txt_mobile_no" placeholder="(XXX)-(XXX)-(XXXX)" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="drp_country">{{ __('messages.country') }}</label>
                                                                <input type="text" maxlength="50" id="drp_country" class="form-control alloptions" placeholder="Country" name="drp_country" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="drp_state">{{ __('messages.state') }}/{{ __('messages.province') }}</label>
                                                                <input type="text" maxlength="50" id="drp_state" class="form-control alloptions" placeholder="State/Province" name="drp_state" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="drp_city">{{ __('messages.city') }}</label>
                                                                <input type="text" maxlength="50" id="drp_city" class="form-control alloptions" placeholder="City" name="drp_city" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="drp_post_code">Zip/Postal
                                                                    Code</label>
                                                                <input type="text" maxlength="50" id="drp_post_code" class="form-control alloptions" placeholder="Zip/Postal_Code" name="drp_post_code" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtarea_paddress">Address
                                                                    1</label>
                                                                <input type="text" maxlength="255" id="txtarea_paddress" class="form-control alloptions" placeholder="Address 1" name="txtarea_paddress" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txtarea_permanent_address">Address
                                                                    2</label>
                                                                <input type="text" maxlength="255" id="txtarea_permanent_address" class="form-control alloptions" placeholder="Address 2" name="txtarea_permanent_address" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <h4 class="navv">{{ __('messages.academic_details') }}</h4>
                                                    </li>
                                                </ul>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="btwyears">Academic
                                                                    Year<span class="text-danger">*</span></label>
                                                                <select id="btwyears" class="form-control" name="year">
                                                                    <option value="">Choose Academic
                                                                        Year</option>
                                                                    <option value="">2019-2020
                                                                    </option>
                                                                    <option value="">2020-2021
                                                                    </option>
                                                                    <option value="">2021-2022
                                                                    </option>
                                                                    <option value="">2022-2023
                                                                    </option>
                                                                    <option value="">2023-2024
                                                                    </option>
                                                                    <option value="">2024-2025
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_regiter_no">Register
                                                                    No<span class="text-danger">*</span></label>
                                                                <input type="text" id="txt_regiter_no" class="form-control" name="txt_regiter_no" placeholder="Registration Number" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_roll_no">Roll
                                                                    No<span class="text-danger">*</span></label>
                                                                <input type="text" id="txt_roll_no" class="form-control" name="txt_roll_no" placeholder="Roll No" data-parsley-trigger="change">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="text">Admission
                                                                    Date<span class="text-danger">*</span></label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <span class="far fa-calendar-alt"></span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="DD-MM-YYYY" aria-describedby="inputGroupPrepend">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="class_id">Standard<span class="text-danger">*</span></label>
                                                                <select id="class_id" class="form-control" name="class_id">
                                                                    <option value="">Select Standard
                                                                    </option>
                                                                    <option value="">PPK 1</option>
                                                                    <option value="">Tingkatan 1
                                                                    </option>
                                                                    <option value="">Tingkatan 2
                                                                    </option>
                                                                    <option value="">Tingkatan 3
                                                                    </option>
                                                                    <option value="">Tingkatan 4
                                                                    </option>
                                                                    <option value="">Tingkatan 5
                                                                    </option>
                                                                    <option value="">Tingkatan 6
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="section_id">Class
                                                                    Name<span class="text-danger">*</span></label>
                                                                <select id="section_id" class="form-control" name="section_id">
                                                                    <option value="">Select Class
                                                                        Name</option>
                                                                    <option value="">K 1</option>
                                                                    <option value="">K 2</option>
                                                                    <option value="">K 3</option>
                                                                    <option value="">K 4</option>
                                                                    <option value="">K 5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="categy">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                                                                <select id="categy" name="categy" class="form-control">
                                                                    <option value="">Choose the
                                                                        Category</option>
                                                                    <option value="1">One</option>
                                                                    <option value="2">Two</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="session_id">{{ __('messages.session') }}</label>
                                                                <select id="session_id" class="form-control" name="session_id">
                                                                    <option value="0">Select Session
                                                                    </option>
                                                                    <option value="0">Morning
                                                                    </option>
                                                                    <option value="0">Evening
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="semester_id">{{ __('messages.semester') }}</label>
                                                                <select id="semester_id" class="form-control" name="semester_id">
                                                                    <option value="0">Select
                                                                        Semester</option>
                                                                    <option value="1">Semester 1
                                                                    </option>
                                                                    <option value="1">Semester 2
                                                                    </option>
                                                                    <option value="3">Semester 3
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <h4 class="navv">{{ __('messages.parent') }}/{{ __('messages.guardian_details') }}<h4>
                                                    </li>
                                                </ul>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="father_name">Father
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="father_name" placeholder="John Leo" aria-describedby="inputGroupPrepend">
                                                                <input type="hidden" name="father_id" id="father_id">
                                                                <div id="father_list">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mother_name">Mother
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="mother_name" placeholder="Aisha Mal" aria-describedby="inputGroupPrepend">
                                                                <input type="hidden" name="mother_id" id="mother_id">
                                                                <div id="mother_list">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="guardian_name">Guardian
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="guardian_name" placeholder="Amir Shan" aria-describedby="inputGroupPrepend">
                                                                <input type="hidden" name="guardian_id" id="guardian_id">
                                                                <div id="guardian_list">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="relation">Guardian
                                                                    Relation</label>
                                                                <select class="form-control" name="relation">
                                                                    <option value="">Choose Relation
                                                                    </option>
                                                                    <option value="">Uncle</option>
                                                                    <option value="">Father</option>
                                                                    <option value="">Mother</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                        </div> <!-- end col -->
                                    </div>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        {{ __('messages.submit') }}
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End personal info tab-->    
                @include('admin.soap.subjective')
                @include('admin.soap.objective')
                @include('admin.soap.assessment')
                @include('admin.soap.plan')
                <div class="tab-pane" id="l1">
                    <p>Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                        ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
                        parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec,
                        pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                        arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                        dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                        elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                        porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>

                <!--End tab-->
                <!--start popup-->

                <!--Title popup-->
                <div id="sstt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Title Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body p-4">
                                <h5>Overflowing text to show scroll behavior</h5>
                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                    odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                    risus, porta ac consectetur ac, vestibulum at eros.</p>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                    et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                    dolor auctor.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
                <!--End Title popup-->
                <!--sub Title popup-->
                <div id="notes-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Family Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <input type="hidden" id="notes-category-id">
                            <input type="hidden" id="notes-sub-category-id">
                            <div class="modal-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Family Details</th>
                                            </tr>
                                        </thead>

                                        <tbody id="notes-body">

                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive-->

                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
                <!--sub Title popup end-->

                <!--delete popup /.modal -->
                <div id="delete-notes" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <h4 class="modal-title w-100">Are you sure?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to delete these record? This process cannot
                                    be undone.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="remove_notes">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--delete popup end /.modal -->



            </div> <!-- container -->

        </div> <!-- content -->
    </div>

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2015 -
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; UBold theme by
                    <a href="">Coderthemes</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->



    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">


    </div> <!-- end slimscroll-menu-->
</div>
<div class="rightbar-overlay"></div>
</div>