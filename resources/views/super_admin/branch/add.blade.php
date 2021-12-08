<form id="branch-form" method="post" action="{{ route('branch.add') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="name" class="col-3 col-form-label">Branch Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Branch Name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="school_name" class="col-3 col-form-label">School Name<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="school_name" name="school_name" placeholder="Enter School Name">
                        <span class="text-danger error-text school_name_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="email" class="col-3 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="mobile_no" class="col-3 col-form-label">Mobile No<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No">
                        <span class="text-danger error-text mobile_no_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="currency" class="col-3 col-form-label">Currency<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="currency" name="currency" placeholder="Enter Currency">
                        <span class="text-danger error-text currency_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="symbol" class="col-3 col-form-label">Currency Symbol<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="symbol" name="symbol" placeholder="Enter Currency Symbol">
                        <span class="text-danger error-text symbol_error"></span>
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
                        <span class="text-danger error-text country_error"></span>
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
                        <span class="text-danger error-text state_error"></span>
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
                        <span class="text-danger error-text city_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="address" class="col-3 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-9">
                        <textarea type="text" class="form-control form-control-sm" rows="4" id="address" name="address"></textarea>
                        <span class="text-danger error-text address_error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-8 offset-4" style="margin-left:34%;">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                Save
            </button>

        </div>
    </div>
</form>