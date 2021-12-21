@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
Parent Dashboard------
@if(Session::has('user'))
    {{ Session::get('role_id') }}
@endif
@endsection
    