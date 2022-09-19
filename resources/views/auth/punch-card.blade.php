@extends('layouts.punchcard-layout')
@section('title','Punch Card')
@section('content')
<div class="col-md-8">
    <div class="">
        <div class="card-body" style="margin:0px 55px 0px 30px;">
            <!-- Logo -->
                <!-- form -->
                <form id="" action="{{ route('employee.punchcard') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    
                    <div class="card"  >
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <h4 class="navv">Punch Card Details ( <span class="date"></span> )   -  @if($session==1) Morning Session @elseif($session==2) Evening Session @endif</h4>
                            </li>
                        </ul>
                        <input type="hidden" name="session" id="session" value="{{$session}}">
                        <div class="card-body">
                            <div class="table-responsive mt-md mb-md">
                                <table class="table table-striped table-bordered table-condensed mb-none">
                                    <tbody>
                                        <tr>
                                            <th width="25%">Check In Time</th>
                                            <td width="25%" class="check_in_time">{{$punchcard['check_in_time']}}</td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Check Out Time</th>
                                            <td width="25%" class="check_out_time">{{$punchcard['check_out_time']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group text-center m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" id="check_in" type="button" {{$punchcard['check_in_status']}}>
                        {{$punchcard['check_in']}}
                        </button>
                    </div>

                    <div class="form-group text-center m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" id="check_out" type="button" {{$punchcard['check_out_status']}}>
                        {{$punchcard['check_out']}}
                        </button>
                    </div>
                </form>


                <!-- end form--><br><br>


        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>

@endsection

@section('scripts')
<script>
    var sectionByClass = "{{ route('admin.section_by_class') }}";
    var punchcard = "{{ route('employee.punchcard') }}";
</script>
<script src="{{ asset('public/js/custom/punchcard.js') }}"></script>

@endsection