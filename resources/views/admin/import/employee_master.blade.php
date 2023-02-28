@extends('layouts.admin-layout')
@section('content')
<!-- Page Content -->
<div class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-body">
                    <h3 align="center">Employee Master import</h3>
                    <br />
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach($errors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.employee_master.import.add') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td width="45%" align="right"><label>Select File for Upload</label></td>
                                    <td width="30">
                                        <input type="file" name="file" />
                                    </td>
                                    <td width="30%" align="left">
                                        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" align="right"><span class="text-muted">Sample Format csv</span></td>
                                    <td width="30" align="left"><a href="{{asset('uploads/Sample Employee Master.csv')}}" target="_blank"><button type="button" class="btn btn-primary-bl waves-effect waves-light" style="float:right;">Download</button></a></td>
                                    <td width="30%" align="left"></td>
                                    <!-- <span class="float-right"><a href=""><i class="ft-eye mr-2 info"></i></a>
                                    <a href="" target="_blank"><i class="ft-download danger"></i></a></span> -->
                                    <div class="col-md-12">
                                        <div class="clearfix mt-4">
                                        
                                        </div>
                                    </div>
                                </tr>
                                
                                <tr>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content End -->
    <!-- content start  -->

</div>
<!-- /Page Content -->
@stop