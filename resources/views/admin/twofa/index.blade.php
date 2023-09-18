@extends('layouts.admin-layout')
@section('title','2FA')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">2FA</li>
                    </ol>
                </div>
                <h4 class="page-title">2FA</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">
            
        </div>
    </div>

</div> <!-- container -->

@endsection
@section('scripts')

<script>
    var faqEmail = "{{ config('constants.api.faq_email') }}";
</script>

<script src="{{ asset('js/custom/faq.js') }}"></script>

@endsection