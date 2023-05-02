@extends('layouts.admin-layout')
@section('title','Children')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">My Children</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="tab-content pt-0">
                            <div class="tab-pane active show" id="product-1-item">
                                <img src="{{ config('constants.image_url').'/public/images/users/user-12.jpg' }}" alt="" style="width:100%" class="img-fluid mx-auto d-block rounded">
                            </div>
                            
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">                                              
                            <h1 class="mb-3">Manikandan</h1>
                                <h6 class="mb-3">My Child</h6>
                                <div class="row mb-3">
                                <div class="col-md-12">
                                    <div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-school"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">Third(C)</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-award"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">35752008</a></h5>
                                            </div>
                                        </div>
                                            <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="far fa-registered"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">RSM-0231</a></h5>
                                            </div>
                                        </div>
                                        
                                            <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-birthday-cake"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">15-Jun-2013</a></h5>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-2">
                        <a href="{{ route('parent.dashboard')}}" class="chil-shaw btn btn-primary-bn btn-circle pull-right"><i class="fas fa-tachometer-alt"></i>{{ __('messages.dashboard') }}</a>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card-box" style="background-color:powderblue;">
                <div class="row">
                    <div class="col-md-3">
                        
                        <div class="tab-content pt-0">
                            <div class="tab-pane active show" >
                                <img src="{{ config('constants.image_url').'/public/images/users/user-13.jpg' }}" alt="" style="width:100%" class="img-fluid mx-auto d-block rounded">
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">                                              
                            <h1 class="mb-3">Karthik</h1>
                                <h6 class="mb-3">My Child</h6>
                                <div class="row mb-3">
                                <div class="col-md-12">
                                    <div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-school"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">First(A)</a></h5>
                                            </div>
                                        </div>
                                        <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-award"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">21252002</a></h5>
                                            </div>
                                        </div>
                                            <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="far fa-registered"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">RSM-0001</a></h5>
                                            </div>
                                        </div>
                                        
                                            <div class="media mb-2">
                                            <div class="avatar-xs bg-success rounded-circle">
                                                <span class="avatar-title font-14 font-weight-bold text-white">
                                                <i class="fas fa-birthday-cake"></i></span>
                                            </div>
                                            <div class="media-body pl-2">
                                                <h5 class="mt-1 mb-0 font-family-primary font-weight-semibold">
                                                <a href="javascript: void(0);" class="text-reset">27-Mar-2015</a></h5>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-2">
                        <a href="{{ route('parent.dashboard')}}" class="chil-shaw btn btn-primary-bn btn-circle pull-right"><i class="fas fa-tachometer-alt"></i>{{ __('messages.dashboard') }}</a>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    
        
    
</div> <!-- container -->
@endsection