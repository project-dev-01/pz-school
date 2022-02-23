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
    <style>
        .error {
            color: red;
        }
        
    </style>
</head>