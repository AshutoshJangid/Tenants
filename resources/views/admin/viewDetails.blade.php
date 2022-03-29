@extends('layout.master')
@section('page-title','Front')
@section('title','Dashboard')
@section('content')

<div class="container container-fluid px-4">
    <h1 class="mt-4">User Details</h1>
    <div class="row view-details">

        <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    User's Personal Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @if($tnt_pers_data->image!=null)
                            <img src="{{asset('/images/'.$tnt_pers_data->image)}}" class="user-detail-img"
                                alt="User Image">
                            @else
                            <img src="{{asset('/images/no-image.png')}}" alt="User Image">
                            @endif
                        </div>
                        <div class="col-sm-6 pt-3">
                            <h3>{{$tnt_pers_data->name}}</h3>
                            <p> Email: {{$tnt_pers_data->email}}</p>
                            <p> Phone: {{$tnt_pers_data->phone}}</p>
                            <p> Aadhar Number: {{$tnt_pers_data->aadhar_number}}</p>
                            <p> Status: <span
                                    class="{{$tnt_pers_data->status=='active'? 'text-success' : 'text-warning'}}">{{strtoupper($tnt_pers_data->status)}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Rental Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-sm-3">
                            @if($tnt_pers_data->image!=null)
                            <img src="{{asset('/images/'.$tnt_pers_data->image)}}" class="user-detail-img"
                                alt="User Image">
                            @else
                            <img src="{{asset('/images/no-image.png')}}" alt="User Image">
                            @endif
                        </div> -->
                        <div class="col-sm-12 pt-3">
                            <p> Rental Place Type: {{$tnt_rent_data->type=='other' || $tnt_rent_data->type=='other' ? 'Not Specified' : $tnt_rent_data->type}}</p>
                            <p> Joining Date: {{$tnt_rent_data->joining_date}}</p>
                            <p> Monthly Rent Amount: {{$tnt_rent_data->rent_amt}}</p>
                            <p> Advance Amount: {{$tnt_rent_data->advance_amt}}</p>
                            <p> Per Unit Electricity Cost: {{$tnt_rent_data->electricity_amt}}</p>
                            <p> Water Bill: {{$tnt_rent_data->water_amt}}</p>
                            <p> Agreement Date: {{$tnt_rent_data->agreement_date}}</p>
                            <p> Agreement Duration: {{$tnt_rent_data->agreement_duration}}</p>
                            @if($tnt_rent_data->agreement_doc!=null)
                            <a href="{{asset('/agreement_doc/'.$tnt_rent_data->agreement_doc)}}" class="btn btn-info" target="_blank">View Agreement</a>
                            @endif
                            @if($tnt_pers_data->aadhar_image!=null)
                            <a href="{{asset('/images/'.$tnt_pers_data->aadhar_image)}}" class="btn btn-info" target="_blank">View Aadhar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection