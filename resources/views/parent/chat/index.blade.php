@extends('layouts.admin-layout')
@section('title','Chat')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.chat') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.chat') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <!-- start chat users-->
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">

                    <div class="media mb-3">
                        <img src="{{ config('constants.image_url').'/public/images/users/user-5.jpg' }}" class="mr-2 rounded-circle" height="42" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="javascript: void(0);" class="text-reset">James Zavel</a>(Parent)
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-14">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-20">
                                <i class="mdi mdi-cog-outline"></i>
                            </a>
                        </div>
                    </div>

                    <!-- start search box -->
                    <form class="search-bar mb-3">
                        <div class="position-relative">
                            <input type="text" class="form-control form-control-light" placeholder="{{ __('messages.people_group') }}">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>
                    <!-- end search box -->

                    <h6 class="font-13 text-muted text-uppercase">{{ __('messages.group_chat') }}</h6>
                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                            <span class="mb-0 mt-1">Grade A Group</span>
                        </a>
                    </div>

                    <h6 class="font-13 text-muted text-uppercase mb-2">{{ __('messages.teacher_contacts') }}</h6>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div data-simplebar style="max-height: 375px">
                                <a href="javascript:void(0);" class="text-body">
                                    <div class="media p-2">
                                        <img src="{{ config('constants.image_url').'/public/images/users/user-2.jpg' }}" class="mr-2 rounded-circle" height="42" alt="Brandon Smith" />
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0 font-14">
                                                <span class="float-right text-muted font-weight-normal font-12">4:30am</span>
                                                Brandon Smith
                                            </h5>
                                            <p class="mt-1 mb-0 text-muted font-14">
                                                <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">3</span></span>
                                                <span class="w-75">What academic standard do you use?</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="javascript:void(0);" class="text-body">
                                    <div class="media p-2">
                                        <img src="{{ config('constants.image_url').'/public/images/users/user-7.jpg' }}" class="mr-2 rounded-circle" height="42" alt="Maria C" />
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-0 font-14">
                                                <span class="float-right text-muted font-weight-normal font-12">Thu</span>
                                                Maria C
                                            </h5>
                                            <p class="mt-1 mb-0 text-muted font-14">
                                                <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">2</span></span>
                                                <span class="w-75">Thanks</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div> <!-- end slimscroll-->
                        </div> <!-- End col -->
                    </div>
                    <!-- end users -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end chat users-->

        <!-- chat area -->
        <div class="col-xl-9 col-lg-8">

            <div class="card">
                <div class="card-body py-2 px-3 border-bottom border-light">
                    <div class="media py-1">
                        <img src="{{ config('constants.image_url').'/public/images/users/user-1.jpg' }}" class="mr-2 rounded-circle" height="36" alt="Brandon Smith">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 font-15">
                                <a href="javascript: void(0);" class="text-reset">Geneva McKnight</a>(Teacher)
                            </h5>
                            <p class="mt-1 mb-0 text-muted font-12">
                                <small class="mdi mdi-circle text-success"></small> Online
                            </p>
                        </div>
                        <div>
                            <a href="javascript: void(0);" class="text-reset font-19 py-1 px-2 d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Chat">
                                <i class="fe-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height: 460px">
                        
                        <li class="clearfix odd">
                            <div class="chat-avatar">
                                <img src="{{ config('constants.image_url').'/public/images/users/user-5.jpg' }}" class="rounded" alt="James Z" />
                                <i>10:01</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>James Z</i>
                                    <p>
                                    Actually I wanted to know about the progress of my child
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <div class="chat-avatar">
                                <img src="{{ config('constants.image_url').'/public/images/users/user-1.jpg' }}" class="rounded" alt="Geneva M" />
                                <i>10:00</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>Geneva M</i>
                                    <p>
                                    Karan is doing well in all the subjects except mathematics
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        
                        <li class="clearfix odd">
                            <div class="chat-avatar">
                                <img src="{{ config('constants.image_url').'/public/images/users/user-5.jpg' }}" class="rounded" alt="James Z" />
                                <i>10:02</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>James Z</i>
                                    <p>
                                    He needs more attention on that
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <div class="chat-avatar">
                                <img src="{{ config('constants.image_url').'/public/images/users/user-1.jpg' }}" class="rounded" alt="Geneva M" />
                                <i>10:01</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>Geneva M</i>
                                    <p>
                                    But mathematics is a subject he practices a lot.
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix odd">
                            <div class="chat-avatar">
                                <img src="{{ asset('public/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                <i>10:03</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>James Z</i>
                                    <p>
                                    Don’t worry, I had a word with his mathematics teacher and I discussed his problem with her.
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <div class="chat-avatar">
                                <img src="{{ asset('public/images/users/user-1.jpg') }}" alt="Geneva M" class="rounded" />
                                <i>10:02</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>Geneva M</i>
                                    <p>
                                    Sure, we will focus on him but I want that more attention should be given to him in his class so that he can score good grades
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix odd">
                            <div class="chat-avatar">
                                <img src="{{ asset('public/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                <i>10:04</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>James Z</i>
                                    <p>
                                        Thank you so much
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="clearfix odd">
                            <div class="chat-avatar">
                                <img src="{{ asset('public/images/users/user-5.jpg') }}" alt="James Z" class="rounded" />
                                <i>10:04</i>
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap">
                                    <i>James Z</i>
                                    <p>
                                    Please don’t mention that.
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-actions dropdown">
                                <button class="btn btn-sm btn-link" data-toggle="dropdown" aria-expanded="false"><i class='mdi mdi-dots-vertical font-16'></i></button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Copy Message</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.edit') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('messages.delete') }}</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col">
                            <div class="mt-2 bg-light p-3 rounded">
                                <form class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                    <div class="row">
                                        <div class="col mb-2 mb-sm-0">
                                            <input type="text" class="form-control border-0" placeholder="{{ __('messages.enter_your_text') }}" required="">
                                            <div class="invalid-feedback">
                                                Please enter your messsage
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="btn-group">
                                                <a href="javascript: void(0);" class="btn btn-light"><i class="fe-paperclip"></i></a>
                                                <button type="submit" class="btn btn-success chat-send btn-block"><i class='fe-send'></i></button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </form>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
        <!-- end chat area-->

    </div> <!-- end row-->
</div> <!-- container -->
@endsection