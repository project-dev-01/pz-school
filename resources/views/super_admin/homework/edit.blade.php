@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
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
                    <span class="header-title mb-3" id="parent">Copy Homework</span>
                    <hr>

                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Standard<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Select</option>
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
                                        <label for="inputEmail3" class="col-3 col-form-label">Class<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Select</option>
                                                <option Selected>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                                <option>D</option>
                                                <option>E</option>n>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Subject<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Select</option>
                                                <option>Physics </option>
                                                <option>Chemistry </option>
                                                <option Selected>Maths </option>
                                                <option>Biology </option>
                                                <option>Geography </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Date Of Homework<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Date Of Submission<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <span class="far fa-calendar-alt"></span>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-8 offset-3">
                                        <div class="checkbox checkbox-purple">
                                            <input id="checkbox6" type="checkbox">
                                            <label for="checkbox6">
                                                Published later
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Schedule Date<span class="text-danger">*</span></label>
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
                                        <label for="inputEmail3" class="col-3 col-form-label">Homework<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description">Write 5 Sums in Addition, Subtraction, Multiplication and Divison</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Attachment File<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
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
                                                Send Notification Sms
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
                            Save
                        </button>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->



</div> <!-- container -->
@endsection