@extends('layouts.admin-layout')
@section('title','FAQs')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">FAQs</li>
                    </ol>
                </div>
                <h4 class="page-title">FAQs</h4>
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
                        <h3 class="mb-3">Frequently Asked Questions</h3>
                        <p class="text-muted"> Have questions? Look no further. Our Frequently Asked Questions (FAQ) make it easy for you to find answers to your most pressing inquiries<br> into the School of Education. If you can't find your answer here, please feel free to contact us or use our site search to find the information you need.</p>
                        <button type="button" class="btn btn-success waves-effect waves-light mt-2 mr-1" data-toggle="modal" data-target="#faq-mail"><i class="mdi mdi-email-outline mr-1"></i>Email us your question</button>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


            <div class="row pt-5">
                <div class="col-lg-5 offset-lg-1">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question" data-wow-delay=".1s">What is the admission procedure?</h4>
                        <p class="faq-answer mb-4">For those seeking admissions, an informal interaction will be conducted in which pupil and both the parents have to be present. The final decision of the admission committee will be binding..</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">Other than a PTM, when can a parent interact with the teacher?</h4>
                        <p class="faq-answer mb-4">School considers parents as partners in the education process and parents are free to meet teachers, with prior appointment, as and when necessary.</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">What will be the school timings?</h4>
                        <p class="faq-answer mb-4">School timings are: 7:30 am to 1:30 pm </p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question" data-wow-delay=".1s">What is the fee structure?</h4>
                        <p class="faq-answer mb-4">Please call the school for fee details</p>
                    </div>

                </div>
                <!--/col-md-5 -->

                <div class="col-lg-5">
                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">Will the school authorities be taking adequate measures to ensure hygiene in the school?</h4>
                        <p class="faq-answer mb-4">School maintains a high standard of cleanliness and hygiene. There are regular checks and monitoring by the school administration as well as the principal of the school.</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">What is the kind of security offered to the students?</h4>
                        <p class="faq-answer mb-4">The school has installed CCTV in all classrooms. Students are always accompanied by teachers or the class monitors when they are moving from one block to the other.</p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">How many terms will the school have?</h4>
                        <p class="faq-answer mb-4">We will be having only two semesters as per CBSE </p>
                    </div>

                    <!-- Question/Answer -->
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question">How many students will be there per division?</h4>
                        <p class="faq-answer mb-4">We strive to maintain a ratio of 30 Students in each class.</p>
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
                <h4 class="modal-title" id="myLargeModalLabel">Ask question ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <hr>
            <div class="modal-body" style="margin-top: -76px;">

                <div class="mt-4">
                    <form id="sendFaqMail" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" id="subject"  class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <div class="summernote">
                                <textarea class="form-control"   id="remarks" rows="5" placeholder="Questions type here " name="remarks"></textarea>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="text-right">
                                <button class="btn btn-success waves-effect waves-light m-r-5"> <span>Send</span> <i class="mdi mdi-send ml-2"></i> </button>
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

<script>
    var faqEmail = "{{ config('constants.api.faq_email') }}";
</script>

<script src="{{ asset('public/js/custom/faq.js') }}"></script>

@endsection