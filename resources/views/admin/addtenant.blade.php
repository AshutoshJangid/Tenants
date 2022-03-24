@extends('layout.master')
@section('page-title','Front')
@section('title','Dashboard')
@section('content')
<div class="comtainer">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Add New Tenant</h2>
            <form action="{{route('ad.addtnt')}}" method="POST">
                @csrf
                <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter email">
                </div>
                <br/>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection