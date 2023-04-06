<form id="branch-form" method="post" action="{{ route('branch.add') }}" autocomplete="off">
    @csrf
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
                        <label for="first_name">{{ __('messages.first_name') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-user-graduate"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control shortNameChange" name="first_name" placeholder="{{ __('messages.ahmad_ali') }}" id="firstName">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="last_name">{{ __('messages.last_name') }}</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-user-graduate"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control shortNameChange" name="last_name" placeholder="{{ __('messages.ali') }}" id="lastName">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender">{{ __('messages.gender') }}</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Choose Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="branch_name">Branch Name</label>
                        <input type="text" maxlength="50" name="branch_name" class="form-control" placeholder="{{ __('messages.enter_branch_name') }}" name="txt_branchname">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_name">{{ __('messages.school_name') }}<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" name="school_name" class="form-control" placeholder="{{ __('messages.enter_school_name') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_code">School Code</label>
                        <input type="text" maxlength="50" name="school_code" class="form-control" placeholder="{{ __('messages.enter_school_code') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="passport">{{ __('messages.passport_number') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="{{ __('messages.enter_passport_number') }}" name="passport" id="Passport">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nric_number">{{ __('messages.nric_number') }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nric_number" placeholder="{{ __('messages.enter_nric_number') }}" id="nricNumber">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile_no">Mobile No<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="mobile_no" id="mobile_no" data-parsley-trigger="change">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="currency">Currency<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" name="currency" class="form-control" placeholder="{{ __('messages.enter_currency') }}" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="symbol">Currency Symbol<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" name="symbol" class="form-control" placeholder="Enter Currency Symbol" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="country">{{ __('messages.country') }}</label>
                        <select id="getCountry" class="form-control" name="country">
                            <option value="">Select Country</option>
                            @foreach($countries as $c)
                            <option value="{{$c['id']}}">{{$c['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state">{{ __('messages.state') }}/{{ __('messages.province') }}</label>
                        <select id="getState" class="form-control" name="state">
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">{{ __('messages.city') }}</label>
                        <select id="getCity" class="form-control" name="city">
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="post_code">{{ __('messages.zip') }}/{{ __('messages.postal_code') }}</label>
                        <input type="text" class="form-control" name="post_code" id="postCode" placeholder="000000">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address Line 1<span class="text-danger">*</span></label>
                        <input class="form-control" name="address" id="address" placeholder="johor">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address1">Address Line 2</label>
                        <input class="form-control" name="address1" id="address1" placeholder="johor">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <h4 class="navv">{{ __('messages.login_details') }}<h4>
            </li>
        </ul>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="email">{{ __('messages.email') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="far fa-envelope-open"></span>
                                </div>
                            </div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="aa@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="password">{{ __('messages.password') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="*********">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="confirm_password">{{ __('messages.retype_password') }}<span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="*********">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-3">
                        <label class="switch">{{ __('messages.authentication') }}

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
                        <label for="db_name">Database Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Database Name" name="db_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="db_username">Database User Name<span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control" placeholder="Enter Database User Name" name="db_username">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="db_password">Database Password</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-unlock"></span>
                                </div>
                            </div>
                            <input type="text" name="db_password" class="form-control" id="db_password" placeholder="*********" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary-bl waves-effect waves-light" id="saveBranch" type="submit">
                    Save
                </button>
            </div>
        </div>
    </div>
</form>