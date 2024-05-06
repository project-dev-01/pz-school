@extends('layouts.admin-layout')
@section('title',' ' . __('messages.homework') . '')
@section('content')
<style>
    .custom-file-input:lang(en)~.custom-file-label::after 
    {
    content: "{{ __('messages.butt_browse') }}";
    }
</style>    
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    </ol>
                </div>
                <h4 class="page-title">{{ __('messages.homework') }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.homework_list') }}
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-primary rounded">
                                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="my-1"><span data-plugin="counterup">98</span></h3>
                                                <p class="text-muted mb-1 text-truncate">{{ __('messages.on_time_submission') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">{{ __('messages.target') }}<span class="float-right">98%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%">
                                                <span class="sr-only">98% {{ __('messages.complete') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-sm bg-blue rounded">
                                                <i class="fe-aperture avatar-title font-22 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <h3 class="my-1"><span data-plugin="counterup">2</span></h3>
                                                <p class="text-muted mb-1 text-truncate">{{ __('messages.late_submission') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="text-uppercase">{{ __('messages.target') }}<span class="float-right">2%</span></h6>
                                        <div class="progress progress-sm m-0">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%">
                                                <span class="sr-only">2% {{ __('messages.complete') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->
                        </div>
                        <div class="row ml-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="row"><label>{{ __('messages.status') }}<span class="text-danger">*</span></label> </div>

                                    <div class="row">
                                        <div class="form-check ">
                                            <input type="radio" class="form-check-input" id="materialInline1" name="inlineMaterialRadiosExample">
                                            <label class="form-check-label font-weight-bold" for="materialInline1">{{ __('messages.completed') }}</label>
                                        </div> &nbsp;&nbsp;
                                        <div class="form-check col-md-offset-4">
                                            <input type="radio" class="form-check-input" id="materialInline2" name="inlineMaterialRadiosExample">
                                            <label class="form-check-label font-weight-bold" for="materialInline2">{{ __('messages.incompleted') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                        <option value="">{{ __('messages.select_subject') }}</option>
                                        <option>{{ __('messages.all') }}</option>
                                        <option value="press">English</option>
                                        <option value="">Mathematics</option>
                                        <option value="press">History</option>
                                        <option value="">Study of the Environment</option>
                                        <option value="press">Geography</option>
                                        <option value="">Natural Sciences</option>
                                        <option value="press">Civics Education</option>
                                        <option value="">Arts Education</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="joining_date">Date<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="far fa-calendar-alt"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="joining_date" id="joiningDate" placeholder="" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <span class="text-danger error-text joining_date_error"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                        {{ __('messages.get') }}
                        </button>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h4 class="navv">
                        {{ __('messages.homework_list') }} ({{ __('messages.all_subject') }})
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#English" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> English - 21 Jan 2022 (Completed)
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="English">
                                        <div class="card card-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">Created By : </div>
                                                        <div class="col-md-6">Kumar</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.details') }} :</div>
                                                        <div class="col-md-6">poem </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.status') }} :</div>
                                                        <div class="col-md-6">Complete</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.date_of_homework') }} :</div>
                                                        <div class="col-md-6">20 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.date_of_submission') }} :</div>
                                                        <div class="col-md-6">22 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.evalution_date') }} :</div>
                                                        <div class="col-md-6">23 Jan 2022</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.remarks') }} :</div>
                                                        <div class="col-md-6">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.rank_out_of_5') }} :</div>
                                                        <div class="col-md-6">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bold">{{ __('messages.document') }} :</div>
                                                        <div class="col-md-6">
                                                            <a href="~/resources/views/Guide.pdf" download>
                                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 font-weight-bold">{{ __('messages.submission_process_here') }} :- </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="product-description" class="col-md-6 col-form-label">{{ __('messages.note') }} :</label>
                                                        <div class="col-9">
                                                            <textarea class="col-md-6 form-control" id="product-description" rows="5">
														 I am most respectfully writing this in regard to the Homework </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="inputGroupFile04" class="col-md-6 col-form-label">{{ __('messages.attachment_file') }}:</label>
                                                        <div class="col-9">
                                                            <input type="file" class="col-md-6 custom-file-input" id="inputGroupFile04" disabled>
                                                            <label class="custom-file-label" for="inputGroupFile04">{{ __('messages.choose_the_file') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-8 offset-4">
                                                <button type="submit" class="ml-2 btn btn-primary-bl waves-effect waves-light float-right">
                                                {{ __('messages.submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#Maths" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> Mathematics - 20 Jan 2022
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="Maths">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">Created By : </div>
                                                        <div class="ml-2">Saran</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.details') }} :</div>
                                                        <div class="ml-2">Geometry</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.status') }} :</div>
                                                        <div class="ml-2">InComplete</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.date_of_homework') }} :</div>
                                                        <div class="ml-2">20 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.date_of_submission') }} :</div>
                                                        <div class="ml-2">22 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.evalution_date') }} :</div>
                                                        <div class="ml-2">23 Jan 2022</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.remarks') }} :</div>
                                                        <div class="ml-2">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.rank_out_of_5') }}:</div>
                                                        <div class="ml-2">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.document') }} :</div>
                                                        <div class="ml-2">
                                                            <a href="~/resources/views/Guide.pdf" download>
                                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <br />
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 font-weight-bold">{{ __('messages.submission_process_here') }} :- </div>

                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="product-description" class="mb-2 col-form-label">{{ __('messages.note') }} :</label>
                                                        <div class="col-9">
                                                            <textarea class="ml-2 form-control" id="product-description" rows="5">
														 I am most respectfully writing this in regard to the Homework </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="inputGroupFile04" class="mb-2 col-form-label">{{ __('messages.attachment_file') }}:</label>
                                                        <div class="col-9">
                                                            <input type="file" class="ml-2 custom-file-input" id="inputGroupFile04" disabled>
                                                            <label class="custom-file-label" for="inputGroupFile04">{{ __('messages.choose_the_file') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-8 offset-4">
                                                <button type="submit" class="ml-2 btn btn-primary-bl waves-effect waves-light float-right">
                                                {{ __('messages.submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>
                                    <div>
                                        <a class="list-group-item list-group-item-info btn-block btn-lg" data-toggle="collapse" href="#stdenv" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-caret-square-down"></i> Study of the Environment - 18 Jan 2022
                                        </a>
                                    </div>
                                    </p>
                                    <div class="collapse" id="stdenv">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">Created By : </div>
                                                        <div class="ml-2">Saran</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.details') }} :</div>
                                                        <div class="ml-2">Ecosystems</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.status') }} :</div>
                                                        <div class="ml-2">InComplete</div>
                                                    </div>
                                                </div>

                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.date_of_homework') }} :</div>
                                                        <div class="ml-2">20 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.date_of_submission') }} :</div>
                                                        <div class="ml-2">22 Jan 2022</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.evalution_date') }} :</div>
                                                        <div class="ml-2">23 Jan 2022</div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.remarks') }} :</div>
                                                        <div class="ml-2">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.rank_out_of_5') }} :</div>
                                                        <div class="ml-2">N/A</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="mb-2 font-weight-bold">{{ __('messages.document') }} :</div>
                                                        <div class="ml-2">
                                                            <a href="~/resources/views/Guide.pdf" download>
                                                                <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br />
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 font-weight-bold">{{ __('messages.submission_process_here') }} :- </div>

                                            </div><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="product-description" class="mb-2 col-form-label">{{ __('messages.note') }} :</label>
                                                        <div class="col-9">
                                                            <textarea class="ml-2 form-control" id="product-description" rows="5">
														 I am most respectfully writing this in regard to the Homework </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="inputGroupFile04" class="mb-2 col-form-label">{{ __('messages.attachment_file') }}:</label>
                                                        <div class="col-9">
                                                            <input type="file" class="ml-2 custom-file-input" id="inputGroupFile04" disabled>
                                                            <label class="custom-file-label" for="inputGroupFile04">{{ __('messages.choose_the_file') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-8 offset-4">
                                                <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">
                                                {{ __('messages.submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection