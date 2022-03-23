@extends('layout.master')
@section('page-title','Front')
@section('title','Dashboard')
@section('content')
@if(Session::get('user'))
<h1>This is content</h1>
 @endif   
@endsection