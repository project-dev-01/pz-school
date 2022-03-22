<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forum </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('forum/build/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">    
    <link href="{{ asset('css/custom/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>