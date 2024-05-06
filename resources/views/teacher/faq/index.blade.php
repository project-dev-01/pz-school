@extends('layouts.admin-layout')
@section('title',' ' . __('messages.faqs') . '')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box" style="display: inline-flex; align-items: center;">
                <div class="page-title-icon">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="#3A4265" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_308_1884)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.08171 0.24317C2.76064 0.35674 1.51649 1.08831 0.766601 2.19243C0.563862 2.49093 0.313088 3.00664 0.206566 3.34405C-0.0108295 4.03273 9.10194e-05 3.64379 9.10194e-05 10.7017C9.10194e-05 17.7984 -0.0103579 17.4431 0.218249 18.1251C0.783 19.8098 2.24727 20.9966 4.01002 21.1984C4.21762 21.2222 6.14711 21.2358 9.33259 21.236L14.3295 21.2363L17.1521 22.6456C19.6315 23.8835 20.0147 24.0642 20.3047 24.1323C20.7038 24.2259 21.3091 24.2357 21.6552 24.1542C22.7744 23.8905 23.6145 23.0619 23.9188 21.9215L24 21.6171V12.9506C24 4.766 23.9964 4.26603 23.935 3.95781C23.7437 2.99718 23.3238 2.19218 22.6767 1.54546C21.9275 0.796626 20.9561 0.344629 19.8793 0.243823C19.3945 0.198424 4.6092 0.197843 4.08171 0.24317ZM13.2584 4.79733C14.1859 4.95017 15.0177 5.41051 15.4892 6.03181C15.7075 6.31947 15.934 6.76694 16.0177 7.07628C16.0994 7.37798 16.1305 8.18127 16.0742 8.53497C15.9406 9.37354 15.421 10.0903 14.2783 11.0122C13.5617 11.5904 13.4241 11.821 13.4241 12.4443V12.7874H12.1673H10.9105L10.9306 12.1982C10.967 11.13 11.0667 10.9566 12.2268 9.9439C13.0331 9.23996 13.3465 8.9053 13.5369 8.54487C13.6082 8.40979 13.6227 8.33038 13.6207 8.08384C13.6186 7.82834 13.6031 7.75625 13.5115 7.5772C13.2591 7.08404 12.6479 6.87467 11.9445 7.04042C11.6293 7.11468 11.4476 7.21542 11.2416 7.43012C11.033 7.64758 10.9004 7.90268 10.8408 8.20107C10.8169 8.32037 10.7944 8.42281 10.7908 8.42876C10.7783 8.4491 8.29035 8.28222 8.26607 8.25942C8.22791 8.22355 8.33381 7.64036 8.4391 7.3068C8.55531 6.93853 8.73591 6.57029 8.94456 6.27629C9.16446 5.96643 9.66061 5.51157 10.001 5.30775C10.8525 4.79795 12.0877 4.60439 13.2584 4.79733ZM12.644 13.7864C13.6441 14.0605 14.0314 15.419 13.3305 16.1944C12.9998 16.5602 12.6095 16.7189 12.0949 16.6968C11.8009 16.6841 11.7326 16.6673 11.49 16.5475C11.1741 16.3914 10.9429 16.159 10.7863 15.8403C10.6931 15.6507 10.6849 15.6001 10.6849 15.2169C10.6849 14.8398 10.6942 14.78 10.7827 14.5913C11.107 13.8997 11.8636 13.5725 12.644 13.7864Z" />
                    </svg>
                </div>
                <h4 class="page-title" style="margin-left: 10px;">{{ __('messages.faqs') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">
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


            <div class="row pt-3">
                <div class="col-lg-5 offset-lg-1">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question" data-wow-delay=".1s">{{ __('messages.who_should_i_contact_if_i_have_any') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.please_send_your_inquire') }}</p>
                    </div>
                </div>
                <!--/col-md-5 -->

                <div class="col-lg-5">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">{{ __('messages.where_can_i_download_the_user') }}</h4>
                        <p class="faq-answer mb-4">{{ __('messages.you_can_download_the_user_manual') }}
                            <span class="text-left" style="display: inline-block; color: red;margin-top:10px;">
                                {{ __('messages.faq_japanese') }}: <a href="http://www.OOOOOOO.com/jp" style="color: red;">http://www.OOOOOOO.com/jp</a>
                                <br>
                                {{ __('messages.faq_english') }}: <a href="http://www.OOOOOOO.com/en" style="color: red;">http://www.OOOOOOO.com/en</a>
                            </span>
                        </p>
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
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('messages.subject') }}">
                        </div>
                        <div class="form-group">
                            <div class="summernote">
                                <textarea class="form-control" id="remarks" rows="5" placeholder="{{ __('messages.questions_type_here') }}" name="remarks"></textarea>
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