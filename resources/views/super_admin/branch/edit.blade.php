@extends('layouts.admin-layout')
@section('title','Branch')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Branch</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="{{ route('branch.index') }}" class="nav-link">
                            Branch List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#edit-branch-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            Edit Branch
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane show active" id="edit-branch-tab">
                        <form id="edit-branch-form" method="post" action="{{ route('branch.update') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <input type="hidden" class="form-control" name="id" value="{{$id}}">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-3 col-form-label">Branch Name<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="name" name="name" value="{{$branch['name']}}" placeholder="Enter Branch Name">
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="school_name" class="col-3 col-form-label">School Name<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="school_name" name="school_name" value="{{$branch['school_name']}}" placeholder="Enter School Name">
                                                <span class="text-danger error-text school_name_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="email" class="col-3 col-form-label">Email<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="email" class="form-control" id="email" name="email" value="{{$branch['email']}}" placeholder="Enter Email">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="mobile_no" class="col-3 col-form-label">Mobile No<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{$branch['mobile_no']}}" placeholder="Enter Mobile No">
                                                <span class="text-danger error-text mobile_no_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="currency" class="col-3 col-form-label">Currency<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="currency" name="currency" value="{{$branch['currency']}}" placeholder="Enter Currency">
                                                <span class="text-danger error-text currency_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="symbol" class="col-3 col-form-label">Currency Symbol<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="symbol" name="symbol" value="{{$branch['symbol']}}" placeholder="Enter Currency Symbol">
                                                <span class="text-danger error-text symbol_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="country" class="col-3 col-form-label">Country<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <select id="editGetCountry" class="form-control" name="country">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $c)
                                                    @if($branch['country_id'] == $c['id'])
                                                    <option value="{{$c['id']}}" selected>{{$c['name']}}</option>
                                                    @else
                                                    <option value="{{$c['id']}}">{{$c['name']}}</option>
                                                    @endif
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
                                                <select id="editGetState" class="form-control" name="state">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $s)
                                                    @if($branch['state_id'] == $s['id'])
                                                    <option value="{{$s['id']}}" selected>{{$s['name']}}</option>
                                                    @else
                                                    <option value="{{$s['id']}}">{{$s['name']}}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                                <span class="text-danger error-text state_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="city" class="col-3 col-form-label">City<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <select id="editGetCity" class="form-control" name="city">
                                                    <option value="">Select City</option>
                                                    @foreach($cities as $c)
                                                    @if($branch['city_id'] == $c['id'])
                                                    <option value="{{$c['id']}}" selected>{{$c['name']}}</option>
                                                    @else
                                                    <option value="{{$c['id']}}">{{$c['name']}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-text city_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="address" class="col-3 col-form-label">Address<span class="text-danger">*</span></label>
                                            <div class="col-9">
                                                <textarea type="text" class="form-control form-control-sm" rows="4" id="address" name="address">{{ $branch['address'] }}</textarea>
                                                <span class="text-danger error-text address_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-8 offset-4" style="margin-left:34%;">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Update
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection