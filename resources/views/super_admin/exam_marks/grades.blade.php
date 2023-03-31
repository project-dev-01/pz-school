@extends('layouts.admin-layout')
@section('title','Class Room Management')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title">{{ __('messages.grades') }}</h4>
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
                            <span data-feather="book" class="icon-dual" id="span-parent"></span> Grades Range
                            <h4>
                    </li>
                </ul><br>
                <div class="card-box">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Grade List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                Create Grade
                            </a>
                        </li>
                    </ul> <br>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="home-b1">
                            <table id="datatable-buttons" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Branch</th>
                                        <th>{{ __('messages.grade_name') }}</th>
                                        <th>Grade Point</th>
                                        <th>Min Percentage</th>
                                        <th>Max Percentage</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>IV</td>
                                        <td>A</td>
                                        <td>10</td>
                                        <td>10%</td>
                                        <td>8%</td>
                                        <td>Good</td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="profile-b1">
                            <form id="demo-form" data-parsley-validate="">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Branch<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <select id="heard" class="form-control" required="">
                                                        <option value="">select</option>
                                                        <option value="press">Press</option>
                                                        <option value="net">Internet</option>
                                                        <option value="mouth">Word of mouth</option>
                                                        <option value="other">Other..</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Name<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Grade Point<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Min Percentage<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Max Percentage<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Remarks<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="name" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="clearfix mt-4">
                                    <button type="submit" class="btn btn-primary-bl waves-effect waves-light float-right">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end card-box-->


            </div> <!-- end card-->
        </div> <!-- end col -->

        <!-- container -->
    </div>
</div>


@endsection