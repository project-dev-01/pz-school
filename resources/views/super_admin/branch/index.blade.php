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
                    <!--<ol class="breadcrumb m-0">
                                           <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                           <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                           <li class="breadcrumb-item active">Branch</li>
                                       </ol>-->
                </div>
                <h4 class="page-title">Branch</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4  class="nav-link">
                            Branch List
                        <h4>
                    </li>
                </ul><br>								
                <div class="card-body">										 
                    <form id="filter">                                         
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country<span class="text-danger">*</span></label>
                                    <select id="country" class="form-control" name="country" required="">
                                        <option value="">Select</option>
                                        @foreach($countries as $c)
                                        <option value="{{$c['id']}}">{{$c['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State<span class="text-danger">*</span></label>
                                    <select id="state" class="form-control" name="state" required="">
                                    <option value="">Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City<span class="text-danger">*</span></label>
                                    <select id="city" class="form-control"  required="">
                                    <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                Filter
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </form>
                    
                    
                </div> 
            </div>
        </div> 
    </div>  -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#branch-list-tab" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            Branch List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#branch-tab" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Create Branch
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="branch-list-tab">									 
                        <form id="filter">                                         
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Country<span class="text-danger">*</span></label>
                                        <select id="country" class="form-control" name="country" required="">
                                            <option value="">Select</option>
                                            @foreach($countries as $c)
                                            <option value="{{$c['id']}}">{{$c['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">State<span class="text-danger">*</span></label>
                                        <select id="state" class="form-control" name="state" required="">
                                        <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City<span class="text-danger">*</span></label>
                                        <select id="city" class="form-control"  required="">
                                        <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="button">
                                    Filter
                                </button>
                                <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table w-100 nowrap" id="branch-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch Name</th>
                                        <th>School Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th>Currency</th>
                                        <th>Symbol</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                    <div class="tab-pane" id="branch-tab">
                        @include('super_admin.branch.add')
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection