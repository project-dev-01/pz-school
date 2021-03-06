@extends('layouts.admin-layout')
@section('title','Books Issued')
@section('content')
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
                <h4 class="page-title">Library</h4>
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
                            Books Issued
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                Books Issued List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#home-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Books Issued
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile-b1">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book Title</th>
                                            <th>Author</th>
                                            <th>Publisher</th>
                                            <th>ISBN No</th>
                                            <th>Edition</th>
                                            <th>Date of Issue</th>
                                            <th> Date of Expiry</th>
                                            <th>Return Date</th>
                                            <th>Fine</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Time</td>
                                            <td>James</td>
                                            <td>James</td>
                                            <td>76882</td>
                                            <td>First</td>
                                            <td>24-02-2022</td>
                                            <td>26-02-2022</td>
                                            <td>30-02-2022</td>
                                            <td>50</td>
                                            <td>Returned</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>
                        <div class="tab-pane" id="home-b1">
                            <form id="demo-form">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
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
                                                <label for="inputEmail3" class="col-3 col-form-label">Book Title<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Book ISBN No</label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Author</label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Edition</label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Purchase Date<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Book Category<span class="text-danger">*</span></label>
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
                                                <label for="inputEmail3" class="col-3 col-form-label">Publisher<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Description</label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Price<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Cover Image<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Total Stock<span class="text-danger">*</span></label>
                                                <div class="col-9">
                                                    <input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </form>
                            <div class="col-8 offset-4" style="margin-left:34%;">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->

        </div>
        <!-- end row -->
    </div>


</div> <!-- container -->
@endsection