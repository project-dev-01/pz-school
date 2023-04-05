@extends('layouts.admin-layout')
@section('title','Hostel Room')
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
                <h4 class="page-title">{{ __('messages.hostel_room') }}</h4>
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
                            Room List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Create Room
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
                                <th>{{ __('messages.room_name') }}</th>
                                <th>{{ __('messages.category') }}</th>
                                <th>{{ __('messages.no_of_beds') }}</th>
                                <th>{{ __('messages.cost_per_bed') }}</th>
                                <th>{{ __('messages.remarks') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kuala Lumpur</td>
                                <td>Block A</td>
                                <td>Eco</td>
                                <td>50</td>
                                <td>5000</td>
                                <td>Good</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Kuala Lumpur</td>
                                <td>Block B</td>
                                <td>Eco</td>
                                <td>50</td>
                                <td>3000</td>
                                <td>Better</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kuala Lumpur</td>
                                <td>Block C</td>
                                <td>Party</td>
                                <td>50</td>
                                <td>8000</td>
                                <td>Nice</td>
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
                            <select id="heard" class="form-control" required="">
                            <option value="">Select Branch Name</option>
                            <option value="">Malaysia</option>
                            <option value="">Singapore</option>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.hostel_name') }}<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.category') }}<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select id="heard" class="form-control" required="">
                            <option value="">{{ __('messages.select_category') }}</option>
                            <option value="net">Eco</option>
                            <option value="mouth">Cheap</option>
                            <option value="other">Party</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">Watchman Name<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.hostel_address') }}<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" required parsley-type="email" class="form-control"
                                    id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.remarks') }}<span class="text-danger">*</span></label>
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