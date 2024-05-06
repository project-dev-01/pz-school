@extends('layouts.admin-layout')
@section('title',' ' .  __('messages.faqs') . '')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
<link href="{{ asset('css/custom/pagehead_breadcrumb.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom/collapse.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
        <div class="page-title-box" style="display: inline-flex; align-items: center;margin-bottom:10px;margin-top:10px">
                <div class="page-title-icon">
                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.08171 0.243231C2.76064 0.356801 1.51649 1.08837 0.766601 2.19249C0.563862 2.491 0.313088 3.0067 0.206566 3.34412C-0.0108295 4.03279 9.10194e-05 3.64385 9.10194e-05 10.7017C9.10194e-05 17.7985 -0.0103579 17.4431 0.218249 18.1251C0.783 19.8098 2.24727 20.9967 4.01002 21.1985C4.21762 21.2223 6.14711 21.2359 9.33259 21.2361L14.3295 21.2364L17.1521 22.6456C19.6315 23.8836 20.0147 24.0643 20.3047 24.1323C20.7038 24.226 21.3091 24.2358 21.6552 24.1543C22.7744 23.8906 23.6145 23.0619 23.9188 21.9216L24 21.6171V12.9507C24 4.76607 23.9964 4.26609 23.935 3.95787C23.7437 2.99724 23.3238 2.19224 22.6767 1.54552C21.9275 0.796687 20.9561 0.34469 19.8793 0.243884C19.3945 0.198485 4.6092 0.197904 4.08171 0.243231ZM13.2584 4.79739C14.1859 4.95024 15.0177 5.41057 15.4892 6.03187C15.7075 6.31954 15.934 6.767 16.0177 7.07634C16.0994 7.37804 16.1305 8.18133 16.0742 8.53503C15.9406 9.37361 15.421 10.0903 14.2783 11.0123C13.5617 11.5904 13.4241 11.8211 13.4241 12.4444V12.7875H12.1673H10.9105L10.9306 12.1983C10.967 11.13 11.0667 10.9567 12.2268 9.94396C13.0331 9.24002 13.3465 8.90536 13.5369 8.54493C13.6082 8.40985 13.6227 8.33044 13.6207 8.0839C13.6186 7.8284 13.6031 7.75632 13.5115 7.57726C13.2591 7.0841 12.6479 6.87473 11.9445 7.04048C11.6293 7.11475 11.4476 7.21548 11.2416 7.43018C11.033 7.64764 10.9004 7.90274 10.8408 8.20113C10.8169 8.32043 10.7944 8.42287 10.7908 8.42882C10.7783 8.44916 8.29035 8.28229 8.26607 8.25948C8.22791 8.22361 8.33381 7.64042 8.4391 7.30686C8.55531 6.93859 8.73591 6.57035 8.94456 6.27635C9.16446 5.9665 9.66061 5.51163 10.001 5.30781C10.8525 4.79801 12.0877 4.60445 13.2584 4.79739ZM12.644 13.7864C13.6441 14.0605 14.0314 15.4191 13.3305 16.1944C12.9998 16.5603 12.6095 16.719 12.0949 16.6969C11.8009 16.6842 11.7326 16.6673 11.49 16.5475C11.1741 16.3915 10.9429 16.1591 10.7863 15.8404C10.6931 15.6508 10.6849 15.6001 10.6849 15.217C10.6849 14.8399 10.6942 14.7801 10.7827 14.5914C11.107 13.8997 11.8636 13.5725 12.644 13.7864Z" fill="#3A4265" />
                        </svg>           
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.faqs') }}</h4>
            </div>
          
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
    <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.faqs') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton1" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
                      
                        <div class="card-body collapse show">              
            
    
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <i class="h1 mdi mdi-comment-multiple-outline text-muted"></i>
                        <h3 class="mb-3">{{ __('messages.frequently_asked_questions') }}</h3>
                        <p class="text-muted">{{ __('messages.have_questions_look') }}</p>
                        <!-- <button type="button" class="btn btn-success waves-effect waves-light mt-2 mr-1" data-toggle="modal" data-target="#faq-mail"><i class="mdi mdi-email-outline mr-1"></i>{{ __('messages.email_us_your_question') }}</button> -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


            <div class="row pt-5">
                <div class="col-lg-5 offset-lg-1">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question" data-wow-delay=".1s">{{ __('messages.what_is_the_admission') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.for_those_seeking_admissions') }}..</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.other_than_a_ptm') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.school_considers_parents') }}</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.what_will_be') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.school_timings_are') }} </p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question" data-wow-delay=".1s">{{ __('messages.what_is_the_fee') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.please_call_the_school') }}</p>
                    </div>

                </div>
                <!--/col-md-5 -->

                <div class="col-lg-5">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.will_the_school') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.school_maintains_a_high') }}</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.what_is_the_kind') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.the_school_has_installed') }}</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.how_many_terms') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.we_will_be_having') }} </p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.how_many_students') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.we_strive_to_maintain') }}</p>
                    </div>

                </div>
                <!--/col-md-5-->
            </div>
            <!-- end row -->
        </div>
    </div>

</div> <!-- container -->

<div class="modal fade" id="faq-mail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{ __('messages.ask_question') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <hr>
            <div class="modal-body" style="margin-top: -76px;">

                <div class="mt-4">
                    <form id="sendFaqMail" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="email" id="email" value="{{ isset($data['email']) ? $data['email'] : ''}}">
                        <input type="hidden" name="name" id="name" value="{{ isset($data['name']) ? $data['name'] : ''}}">
                        <input type="hidden" name="role_name" id="role_name" value="{{ isset($data['role_name']) ? $data['role_name'] : ''}}">
                        <div class="form-group">
                            <input type="text" name="subject" id="subject"  class="form-control" placeholder="{{ __('messages.subject') }}">
                        </div>
                        <div class="form-group">
                            <div class="summernote">
                                <textarea class="form-control"   id="remarks" rows="5" placeholder="{{ __('messages.questions_type_here') }}" name="remarks"></textarea>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="text-right">
                                <button class="btn btn-success waves-effect waves-light m-r-5"> <span>{{ __('messages.send') }}</span> <i class="mdi mdi-send ml-2"></i> </button>
                            </div>
                        </div>

                    </form>
                </div> <!-- end card-->


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
<script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('js/validation/validation.js') }}"></script>
<script>
    var faqEmail = "{{ config('constants.api.faq_email') }}";
    var schoolName = "{{ Session::get('school_name') }}";
</script>

<script src="{{ asset('js/custom/faq.js') }}"></script>

@endsection