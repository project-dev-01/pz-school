@include('includes.header')
@yield('css')

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- add spinner  -->
    <!-- <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div> -->
    <div id="overlay">
        <div class="lds-spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <!--<div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Wizard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Form Wizard</h4>-->
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <span class=" fas fa-user-graduate  " id="parent"></span>
                            <span class="header-title mb-3" id="parent">{{ __('messages.student_admission') }}</span>
                            <hr>
                            <form id="demo-form" data-parsley-validate="">
                                <span class="fas fa-user-check  " id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent">{{ __('messages.student_details') }}
                                    <hr id="hr">
                                </span>
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
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
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
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.gender') }}<span class="text-danger">*</span></label>
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Male</option>
                                                <option value="press">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.blood_group') }}<span class="text-danger">*</span></label>
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Choose..</option>
                                                <option value="press">Press</option>
                                                <option value="net">Internet</option>
                                                <option value="mouth">Word of mouth</option>
                                                <option value="other">Other..</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">{{ __('messages.date_of_birth') }}</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-birthday-cake"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">Mother Tongue</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.religion') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Caste</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">Mobile No<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-phone-volume"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.city') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.state') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="message">{{ __('messages.present_address') }}</label>
                                            <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="message">Permanent Address</label>
                                            <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message">Profile Picture</label>
                                            <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <span class="fas fa-user-lock " id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent"> {{ __('messages.login_details') }}
                                    <hr id="hr">
                                </span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-envelope-open"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-unlock"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="email">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-unlock"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="fas fa-user-tie" id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent">{{ __('messages.guardian_details') }}
                                    <hr id="hr">
                                </span>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">{{ __('messages.skipped_bank_details') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="heard">{{ __('messages.relation') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="heard">{{ __('messages.father_name') }}</label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="heard">{{ __('messages.mother_name') }}</label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.occupation') }}<span class="text-danger">*</span></label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.income') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.education') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="validationCustomUsername">City</label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="validationCustomUsername">State</label>
                                            <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="">Mobile No<span class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-phone-volume"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">Address</label>
                                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            </textarea>
                                </div>
                                <span class="fas fa-holly-berry" id="span-parent"></span>
                                <span class="header-title mb-3" id="span-parent">{{ __('messages.previous_school_details') }}
                                    <hr style="margin-top:-1%;margin-left:20%;color:blue">
                                </span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">school_names</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">{{ __('messages.qualification') }}</label>
                                            <input type="" id="" class="form-control" name="" data-parsley-trigger="change" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">{{ __('messages.remarks') }}</label>
                                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10">
                                            </textarea>
                                </div>
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                                        Save
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
        </div> <!-- container -->
        @include('includes.footer')
        @yield('scripts')
    </div>

</body>

</html>