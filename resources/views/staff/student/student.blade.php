@extends('layouts.admin-layout')
@section('title','Student List')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <!--<ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Wizard</li>
                    </ol>-->
                </div>
                <h4 class="page-title">Student List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Select Ground
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <form id="demo-form" data-parsley-validate="">
                        <div class="row">
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Standard<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">                                                                        
                                    <option value="">Select Standard</option>                            
                                    <option value="press">I</option>
                                    <option value="net">II</option>
                                    <option value="mouth">III</option>
                                    <option value="other">IV</option>
                                    <option value="other">V</option>
                                    <option value="other">VI</option>
                                    <option value="other">VII</option>
                                    <option value="other">VIII</option>
                                    <option value="other">IX</option>
                                    <option value="other">X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="heard">Class Name<span class="text-danger">*</span></label>
                                    <select id="heard" class="form-control" required="">
                                    <option value="">Select Class Name</option>
                                    <option value="press">A</option>
                                    <option value="net">B</option>
                                    <option value="mouth">C</option>
                                    <option value="other">D</option>
                                    <option value="other">E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Filter
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Student Lists
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Roll</th>
                                                <th>Register No</th>
                                                <th>{{ __('messages.class') }}</th>
                                                <th>Section</th>
                                                <th>Guardian Name</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Willam</td>
                                                <td>PZ-1001</td>
                                                <td>RSM-00-1</td>
                                                <td>1</td>
                                                <td>A</td>
                                                <td>Anser</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->

                            </div> <!-- end card-box -->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="Save">
                            Save
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection