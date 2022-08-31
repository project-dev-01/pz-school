@extends('layouts.admin-layout')
@section('title','Punch Card')
@section('content')
<div class="col-md-6">
    <div class="">
        <div class="card-body" style="margin:0px 55px 0px 30px;">
            <!-- Logo -->
            <div>
                <!-- form -->
                <form id="getOtp" action="{{ route('employee.punchcarddetails') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <input class="form-control" type="email" id="email" name="email" value="{{Cookie::get('email')}}"  required placeholder="Enter your email">
                    </div>
                    <div class="form-group"  >
                        <input class="form-control" type="passwarod"  name="password" value="{{Cookie::get('password')}}" required placeholder="Enter your Password">
                    </div>
                    <br>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit">
                            Login
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>-->
                    </div>

                </form>


                <!-- end form-->
            </div><br><br>


        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>

@endsection

@section('scripts')
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
</script>
<!-- <script src="{{ asset('public/js/custom/punchcard.js') }}"></script> -->

@endsection