<form id="branch-form" method="post" action="{{ route('branch.add') }}" autocomplete="off">
    @csrf
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
            content: 'Unlock';
            transition: all 0.3s ease 0.2s;
        }

        .switch input+span strong:after {
            content: 'Lock';
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
    </style>
    <div class="card">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <h4 class="navv">Create Branch <h4>
            </li>
        </ul>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="firstname">First Name<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-user-graduate"></span>
                                </div>
                            </div>
                            <input type="text" name="fname" class="form-control" maxlength="50" id="fname" placeholder="Ahmad Ali" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="lastname">Last Name<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-user-graduate"></span>
                                </div>
                            </div>
                            <input type="text" name="lname" class="form-control" maxlength="50" id="lname" placeholder="Muhammad Jaafar" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender">Gender<span class="text-danger">*</span></label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Branchname">Branch Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Branch Name" name="txt_branchname">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Schoolname">School Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter School Name" name="txt_schoolname">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Schoolcode">School Code</label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter School Code" name="txt_schoolcode">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Passport">Passport Number<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Passport Number" name="txt_passport">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_nric">NRIC Number<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="txt_nric" class="form-control" placeholder="NRIC Number" name="txt_nricnumber" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_mobile_no">Mobile No<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="txt_mobile_no" placeholder="Enter your number" id="txt_mobile_no" data-parsley-trigger="change">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_currency">Currency<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="Currency" class="form-control" placeholder="Enter Currency" name="txt_currency" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_currencysymbol">Currency Symbol<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="Symbol" class="form-control" placeholder="Enter Currency Symbol" name="txt_currencysymbol" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="drp_country">Country<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="drp_country" class="form-control" placeholder="Country" name="drp_country" data-parsley-trigger="change">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="drp_state">State/Province<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="drp_state" class="form-control" placeholder="state" name="drp_state" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="drp_city">City<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="drp_city" class="form-control" placeholder="City" name="drp_city" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="drp_post_code">Zip/Postal Code<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="drp_post_code" class="form-control" placeholder="Post Code" name="drp_post_code" data-parsley-trigger="change">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="txtarea_paddress">Address 1<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="txtarea_paddress" class="form-control" placeholder="Address" name="txtarea_paddress" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="txtarea_permanent_address">Address 2<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" id="txtarea_permanent_address" class="form-control" placeholder="Address" name="txtarea_permanent_address" data-parsley-trigger="change">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <h4 class="navv">Login Details<h4>
            </li>
        </ul>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-envelope-open"></span>
                                </div>
                            </div>
                            <input type="text" name="txt_emailid" class="form-control" id="txt_emailid" placeholder="xxxxx@gmail.com" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="email">Password<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="password" name="txt_pwd" class="form-control" id="txt_pwd" placeholder="********" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="email">Confirm Password<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="confirmpassword" name="txt_retype_pwd" class="form-control" id="txt_retype_pwd" placeholder="*********" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label class="switch">Authentication
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
                <h4 class="navv">Database Details<h4>
            </li>
        </ul>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="Databasename">Database Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Database Name" name="txt_databasename">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="Databaseusername">Database User Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Database User Name" name="txt_databaseusername">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="databasepassword">Database Password<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="databasepassword" name="txt_type_pwd" class="form-control" id="txt_type_pwd" placeholder="*********" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                    Save
                </button>
            </div>
        </div>
    </div>

</form>