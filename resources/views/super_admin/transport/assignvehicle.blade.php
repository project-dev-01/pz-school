@extends('layouts.admin-layout')
@section('title','Assign Vehicle')
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
                <h4 class="page-title">{{ __('messages.assign_vehicle') }}</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        Assign List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        {{ __('messages.assign_vehicle') }}
                        </a>
                    </li> 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="profile-b1">
                            <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Branch Name</th>
                                <th>{{ __('messages.route_name') }}</th>
                                <th>{{ __('messages.stoppage') }}</th>
                                <th>{{ __('messages.stop_place') }}</th>
                                <th>{{ __('messages.route_fare') }}</th>
                                <th>Vehicle No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Malaysia</td>
                                <td>Route 35</td>
                                <td>10</td>
                                <td>Bus stand</td>
                                <td>$50</td>
                                <td>KV 0632</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Malaysia</td>
                                <td>Route 57</td>
                                <td>6</td>
                                <td>Techno Park</td>
                                <td>$80</td>
                                <td>SAB 7219</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Malaysia</td>
                                <td>Route 62</td>
                                <td>8</td>
                                <td>Bank</td>
                                <td>$70</td>
                                <td>WD 4567</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                    </div>
                    <div class="tab-pane" id="home-b1">
                        <form id="demo-form" >                                         
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Branch Name<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.transport_route') }}<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">Select</option>
                            <option>Route 62</option>
                            <option>Route 57</option>
                            <option>Route 43</option>
                            <option>Route 35</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.stoppage') }}<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">Select</option>
                            <option>6</option>
                            <option>8</option>
                            <option>10</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Vehicle No<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                   
                    </div>										
                    <div class="col-md-2"></div>
                    </div>										  
                </form>
                <div class="col-8 offset-4" style="margin-left:34%;">
                            <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                                Save
                            </button>
                            
                        </div> 
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

        
</div> <!-- container -->

</div>
<!-- container -->
@endsection