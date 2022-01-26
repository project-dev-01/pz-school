@extends('layouts.admin-layout')
@section('title','Homework')
@section('content')
<!-- Start Content-->
<div class="container-fluid">                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
               
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
                            HomeWork List
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
                                <i class="fas fa-caret-square-down"></i> English - 21 Jan 2022 
                                </a>
                                </div>
                                </p>
                                <div class="collapse" id="English">
                                <div class="card card-body">
                                <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Created By : </div>
                                        <div class="col-md-3">Kumar</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Details :</div>
                                        <div class="col-md-3">poem </div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Status :</div>
                                        <div class="col-md-3">Complete</div>    
                                        </div>
                                        </div>

                                        </div><br/>                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                        <div class="col-md-3">20 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                        <div class="col-md-3">22 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                        <div class="col-md-3">23 Jan 2022</div>    
                                        </div>
                                        </div>                                   
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Remarks :</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Rank Out Of 5 :</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Document :</div>
                                        <div class="col-md-3">
                                            <a href="~/resources/views/Guide.pdf" download>
                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                            </a>
                                        </div>    
                                        </div>
                                        </div>                                   
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
                                <i class="fas fa-caret-square-down"></i>  Mathematics - 20 Jan 2022
                                </a>
                                </div>
                                </p>
                                <div class="collapse" id="Maths">
                                <div class="card card-body">
                                <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Created By : </div>
                                        <div class="col-md-3">Saran</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Details :</div>
                                        <div class="col-md-3">Geometry</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Status :</div>
                                        <div class="col-md-3">InComplete</div>    
                                        </div>
                                        </div>

                                        </div><br/>                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                        <div class="col-md-3">20 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                        <div class="col-md-3">22 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                        <div class="col-md-3">23 Jan 2022</div>    
                                        </div>
                                        </div>                                   
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Remarks :</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Rank Out Of 5:</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Document :</div>
                                        <div class="col-md-3">
                                        <a href="~/resources/views/Guide.pdf" download>
                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                            </a>

                                        </div>    
                                        </div>
                                        </div>                                   
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
                                <i class="fas fa-caret-square-down"></i>  Study of the Environment - 18 Jan 2022
                                </a>
                                </div>
                                </p>
                                <div class="collapse" id="stdenv">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Created By : </div>
                                        <div class="col-md-3">Saran</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Details :</div>
                                        <div class="col-md-3">Ecosystems</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Status :</div>
                                        <div class="col-md-3">InComplete</div>    
                                        </div>
                                        </div>

                                        </div><br/>                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Homework :</div>
                                        <div class="col-md-3">20 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Date Of Submission :</div>
                                        <div class="col-md-3">22 Jan 2022</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Evalution Date :</div>
                                        <div class="col-md-3">23 Jan 2022</div>    
                                        </div>
                                        </div>                                   
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Remarks :</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Rank Out Of 5 :</div>
                                        <div class="col-md-3">N/A</div>    
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="row">
                                        <div class="col-md-5 font-weight-bold">Document :</div>
                                        <div class="col-md-3">
                                        <a href="~/resources/views/Guide.pdf" download>
                                            <i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i>
                                            </a>

                                        </div>    
                                        </div>
                                        </div>                                   
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>                           
                        </div>
                    </form>
                    <div class="form-group text-right m-b-0">
                        
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    
</div> <!-- container -->
@endsection