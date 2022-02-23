@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">Add Homework</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #0ABAB5;">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <span data-feather="book-open" class="icon-dual" id="span-parent"></span> Add Homework
                            <h4>
                    </li>
                </ul><br>

                <div class="card-body">

                    <form id="demo-form" data-parsley-validate="" autocomplete="off">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Standard<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Select</option>
                                                <option>I</option>
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
                                                <option>A</option>
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
                                        <label for="inputEmail3" class="col-3 col-form-label">Subject<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <select id="heard" class="form-control" required="">
                                                <option value="">Select</option>
                                                <option>Physics </option>
                                                <option>Chemistry </option>
                                                <option>Maths </option>
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
                                                <input type="text" class="form-control homeWorkAdd" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-3 col-form-label">Homework<span class="text-danger">*</span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="product-description" rows="5" placeholder="Please enter description"></textarea>
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

                            </div>
                            <div class="col-md-1"></div>
                        </div>

                    </form>
                    <div class="col-8 offset-4">
                        <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">
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