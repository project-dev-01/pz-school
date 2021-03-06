<form id="branch-form" method="post" action="{{ route('branch.add') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="name" class="col-3 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="school_name" class="col-3 col-form-label">School Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="school_name" name="school_name" placeholder="Enter School Name">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="email" class="col-3 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="emapasswordil" class="col-3 col-form-label">Password<span class="text-danger">*</span></label>
                    <div class="col-9 input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="mobile_no" class="col-3 col-form-label">Mobile No<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="currency" class="col-3 col-form-label">Currency<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="currency" name="currency" placeholder="Enter Currency">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="symbol" class="col-3 col-form-label">Currency Symbol<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="symbol" name="symbol" placeholder="Enter Currency Symbol">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="country" class="col-3 col-form-label">Country<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select id="getCountry" class="form-control" name="country">
                            <option value="">Select Country</option>
                            @foreach($countries as $c)
                            <option value="{{$c['id']}}">{{$c['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="state" class="col-3 col-form-label">State<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select id="getState" class="form-control" name="state">
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="city" class="col-3 col-form-label">City<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <select id="getCity" class="form-control" name="city">
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="db_name" class="col-3 col-form-label">Database Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="db_name" name="db_name" placeholder="Enter Database Name">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="db_username" class="col-3 col-form-label">Database User Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="db_username" name="db_username" placeholder="Enter User Name">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="db_password" class="col-3 col-form-label">Database Password</label>
                    <div class="col-9 input-group input-group-merge">
                        <input type="password" id="db_password" class="form-control" name="db_password" placeholder="Enter Database Password">
                        <span class="text-danger error-text db_password_error"></span>
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="address" class="col-3 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <textarea type="text" class="form-control form-control-sm" rows="4" id="address" name="address"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-8 offset-4" style="margin-left:34%;">
            <button type="submit" id="saveBranch" class="btn btn-primary-bl waves-effect waves-light">
                Save
            </button>

        </div>
    </div>
</form>