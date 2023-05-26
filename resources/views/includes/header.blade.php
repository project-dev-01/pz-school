<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/public/common-asset/images/favicon.ico' }}">

    <!-- jquery -->
    <script src="{{ asset('public/jquery/jquery-3.6.0.min.js') }}"></script>
    @yield('calendar')
    <!-- App css -->
    <link href="{{ asset('public/css/bootstrap-purple.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('public/css/app-purple.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    @yield('component_css')
    <!-- icons -->
    <link href="{{ asset('public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/common.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('public/css/custom/Responsive.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('public/css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom/spinner.css') }}" rel="stylesheet" type="text/css" />