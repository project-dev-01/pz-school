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
                    <form id="StudentFilter" autocomplete="off">
                        <div class="row">      
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student_name">Student Name</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name" placeholder="ADAM IRFAN">
                                </div>
                            </div>                       
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="class_id">Standard</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Standard</option>
                                        @forelse ($classes as $class)
                                            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Class Name</label>
                                    <select id="section_id" class="form-control" name="section_id">
                                        <option value="">Select Class Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="session_id">Session <span class="text-danger">*</span></label>
                                    <select id="session_id" class="form-control"  name="session_id">                              
                                    <option value="">Select Session</option>
                                        @foreach($session as $ses)
                                            <option value="{{$ses['id']}}">{{$ses['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <!-- <button class="btn btn-primary-bl waves-effect waves-light" id="indexSubmit" type="submit">
                                Filter
                            </button> -->
                            <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                                Filter
                            </button>
                            <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>-->
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->


    <div class="row" id="student" >
        <div class="col-xl-12">
            <div class="card">
                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <h4 class="nav-link">
                            Students List
                            <h4>
                    </li>
                </ul><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table w-100 nowrap " id="student-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Register No</th>
                                            <th>Roll No</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col-->
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection
@section('scripts')
<script>
    
    var studentImg = "{{ asset('public/users/images/') }}";
    var defaultImg = "{{ asset('public/images/users/default.jpg') }}";
    
    var sectionByClass = "{{ route('teacher.section_by_class') }}";
    var studentList = "{{ route('teacher.student.list') }}";
</script>
<script src="{{ asset('public/js/custom/student.js') }}"></script>
@endsection