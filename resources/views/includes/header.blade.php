<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('constants.image_url').'/common-asset/images/favicon.ico' }}">

    <!-- jquery -->
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @yield('calendar')
    <!-- App css -->
    <link href="{{ asset('css/bootstrap-purple.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('css/app-purple.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    @yield('component_css')
    <!-- icons -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/common.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('css/custom/Responsive.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('css/custom/style.css') }}" rel="stylesheet" type="text/css" />
    @if(Session::get('role_id') && Session::get('role_id') == '5')
    <link href="{{ asset('css/custom/parent_responsive.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{ asset('css/custom/opensans-font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom/spinner.css') }}" rel="stylesheet" type="text/css" />