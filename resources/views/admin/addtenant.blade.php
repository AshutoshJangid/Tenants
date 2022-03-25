@extends('layout.master')
@section('page-title','Front')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Add New Tenant</h2>
            
            <form action="{{route('ad.addtnt')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-group">
                <label for="img">Image</label>
                <input type="file" class="form-control" name="img" id="img" placeholder="Insert Image" >
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection