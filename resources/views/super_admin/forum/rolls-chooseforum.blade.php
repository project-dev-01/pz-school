@extends('layouts.admin-layout')
@section('title','RollChoose')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

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
                    <h4 class="page-title">{{ __('messages.rolls') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="filter" id="dbnames" method="post" action="{{route('super_admin.forum.index')}}">                        
                        @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">{{ __('messages.school_names') }}<span class="text-danger">*</span></label>
                                        <select id="getbranchid" class="form-control" name="getbranchid">
                                            <option value="">{{ __('messages.select') }}..</option>
                                            @if(!empty($dbnames))
                                            @foreach($dbnames as $c)
                                            <option value="{{$c['id']}}">{{$c['school_name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- <div class="form-group">
                                        <label for="Rolls">Rolls<span class="text-danger">*</span></label>
                                        <select id="Rolls" class="form-control" name="Rolls" required="">
                                            <option value="">Select..</option>
                                        </select>
                                    </div> -->
                            </div>

                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary-bl waves-effect waves-light" id="branch-filter" type="submit">
                        {{ __('messages.go_to') }}
                        </button>
                        <!-- <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>-->
                    </div>
                    </form>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

<!-- end row -->
</div> <!-- container -->
@endsection
@section('scripts')
<script src="{{ asset('js/custom/getbranchidsession.js') }}"></script>
@endsection