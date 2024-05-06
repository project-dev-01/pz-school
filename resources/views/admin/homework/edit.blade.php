@extends('layouts.admin-layout')
@section('title','Homework')
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
                <!--<div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>
                </div>
                <h4 class="page-title">Form Wizard</h4>-->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <span class=" fas fa-user-graduate  " id="parent"></span>
                    <span class="header-title mb-3" id="parent">{{ __('messages.copy_homework') }}</span>
                    <hr>

                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.standard') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">{{ __('messages.select') }}</option>
                                                <option Selected>I</option>
                                                <option>II</option>
                                                <option>III</option>
                                                <option>IV</option>
                                                <option>V</option>
                                                <option>VI</option>
                                                <option>VII</option>
                                                <option>VIII</option>
                                                <option>IX</option>
                                                <option>X</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.class') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">{{ __('messages.select') }}</option>
                                                <option Selected>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                                <option>D</option>
                                                <option>E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.subject') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">{{ __('messages.select_subject') }}</option>
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
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.date_of_homework') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.date_of_submission') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-8 offset-3">
                                        <div class="checkbox checkbox-purple">
                                            <input id="checkbox6" type="checkbox">
                                            <label for="checkbox6">
                                            {{ __('messages.published_later') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.schedule_date') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.homework') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="product-description" rows="5" placeholder="{{ __('messages.enter_description') }}">Write 5 Sums in Addition, Subtraction, Multiplication and Divison</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">{{ __('messages.attachment_file') }}<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                    <label class="custom-file-label" for="inputGroupFile04">{{ __('messages.choose_the_file') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-8 offset-3">
                                        <div class="checkbox checkbox-purple">
                                            <input id="checkbox6" type="checkbox">
                                            <label for="checkbox6">
                                            {{ __('messages.send_notification_sms') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                    </form>
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light">
                        {{ __('messages.save') }}
                        </button>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection