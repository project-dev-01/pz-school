@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
Staff Dashboard------
@if(Session::has('user'))
    {{ Session::get('role_id') }}
@endif
@endsection
    