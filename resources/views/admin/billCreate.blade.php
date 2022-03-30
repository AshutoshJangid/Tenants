@extends('layout.master')
@section('page-title','Update Tenant')
@section('title','Update Tenant Details')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Update Tenant Details</h2>
            
            <form action="{{route("ad.updateTntDetails")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tntid" value="{{$tnt_personal_data->id}}" >
                <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" class="form-control" value="{{$tnt_personal_data->name}}" name="username" id="username" placeholder="Enter Full Name" required>
                </div>
                <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" value="{{$tnt_personal_data->email}}" class="form-control" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" value="{{$tnt_personal_data->phone}}" name="phone" id="phone" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-group">
                <label for="aadhar_no">Aadhar Number</label>
                <input type="number" class="form-control" value="{{$tnt_personal_data->aadhar_number}}" name="aadhar_no" id="aadhar_no" placeholder="Enter Aadhar Number" required>
                </div>
                <div class="form-group">
                <label for="aadhar_img">Aadhar Image</label>
                <input type="file" class="form-control" name="aadhar_img" id="aadhar_img" placeholder="Insert Aadhar Image" >
                </div>
                <div class="form-group">
                <label for="img">Image</label>
                <input type="file" class="form-control" name="img" id="img" placeholder="Insert Image" >
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('ad.viewTntList')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection