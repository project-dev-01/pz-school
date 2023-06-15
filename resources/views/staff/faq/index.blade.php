@extends('layouts.admin-layout')
@section('title','FAQs')
@section('component_css')
<!-- toaster alert -->
<link rel="stylesheet" href="{{ asset('public/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/toastr/toastr.min.css') }}">

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ __('messages.faqs') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.faqs') }}</h4>
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
                        <button type="button" class="btn btn-success waves-effect waves-light mt-2 mr-1" data-toggle="modal" data-target="#faq-mail"><i class="mdi mdi-email-outline mr-1"></i>{{ __('messages.email_us_your_question') }}</button>
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
<script src="{{ asset('public/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/toastr/toastr.min.js') }}"></script>
<script>
    toastr.options.preventDuplicates = true;
</script>
<script src="{{ asset('public/js/validation/validation.js') }}"></script>
<script>
    var faqEmail = "{{ config('constants.api.faq_email') }}";
</script>

<script src="{{ asset('public/js/custom/faq.js') }}"></script>

@endsection