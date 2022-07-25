@extends('layouts.admin-layout')
@section('title','Assign Teacher')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
                <h4 class="page-title">Assign Teacher</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title">Assign Teacher</h4>
                <p class="sub-header">
                <div class="form-group pull-right">
                    <div class="col-xs-2 col-sm-2">
                        <button type="button" class="btn btn-primary-bl btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#addAssignTeachernModal">Add</button>
                    </div>
                </div>
                </p>

                <div class="table-responsive">
                    <table class="table w-100 nowrap" id="assign-teacher">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Standard Name</th>
                                <th>Class Name</th>
                                <th>Teacher Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Malaysia</td>
                                <td>I</td>
                                <td>A</td>
                                <td>David</td>
                                <td><div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                        </div></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Singapore</td>
                                <td>III</td>
                                <td>D</td>
                                <td>Cameron</td>
                                <td><div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                        </div></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Malaysia</td>
                                <td>X</td>
                                <td>E</td>
                                <td>Starc</td>
                                <td><div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                        </div></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Singapore</td>
                                <td>V</td>
                                <td>C</td>
                                <td>Smith</td>
                                <td><div class="button-list">
                                <a href="' . route('branch.edit', $row['id']) . '" class="btn btn-blue btn-sm waves-effect waves-light"><i class="fe-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm waves-effect waves-light" data-id="' . $row['id'] . '" id="deleteBranchBtn"><i class="fe-trash-2"></i></a>
                        </div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
    <!--- end row -->
    @include('super_admin.assign_teacher.add')
    @include('super_admin.assign_teacher.edit')

</div>
<!-- container -->
@endsection