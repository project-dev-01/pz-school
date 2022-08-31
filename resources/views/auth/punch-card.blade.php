@extends('layouts.admin-layout')
@section('title','Punch Card')
@section('content')
<div class="col-md-6">
    <div class="">
        <div class="card-body" style="margin:0px 55px 0px 30px;">
            <!-- Logo -->
            <div>
                <!-- form -->
                <form id="" action="{{ route('employee.punchcard') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <br>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit" {{$punchcard['check_in_status']}}>
                        {{$punchcard['check_in']}}
                        </button>
                    </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" type="submit" {{$punchcard['check_out_status']}}>
                        {{$punchcard['check_out']}}
                        </button>
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
<script src="{{ asset('public/js/custom/punchcard.js') }}"></script>

@endsection