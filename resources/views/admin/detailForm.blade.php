@extends('layout.master')
@section('page-title','Tenant Details')
@section('title','Tenant Details')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Add New Tenant</h2>
            {{-- @php
                print_r($tnt_rent_data);die;
            @endphp --}}
            <form action="{{route('ad.addtntDetails')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tnt_id" value="{{$tnt_rent_data->id}}">
                <div class="form-group">
                    <label for="place-type">Type Of Rental Place</label>
                    <select class="form-control" name="place_type" id="place-type"  required>
                        <option {{$tnt_rent_data->type== 'Room' ? 'selected': ''}} value="Room">Flat/Room</option>
                        <option {{$tnt_rent_data->type== 'Shop' ? 'selected': ''}} value="Shop">Shop</option>
                        <option {{$tnt_rent_data->type== 'Land' ? 'selected': ''}} value="Land">Land</option>
                        <option {{$tnt_rent_data->type== 'Other' ? 'selected': ''}} value="Other">Other</option>
                    </select>
                    </div>
                <div class="form-group">
                <label for="joindate">Date Of Joining</label>
                <input type="date" value="{{$tnt_rent_data->joining_date}}" class="form-control" name="joindate" id="joindate"  required>
                </div>
                <div class="form-group">
                <label for="rentAmt">Monthly Rental Charges</label>
                <input type="number" value="{{$tnt_rent_data->rent_amt}}" class="form-control" name="rentAmt" id="rentAmt" placeholder="Enter Rent Amount" required>
                </div>
                <div class="form-group">
                <label for="advanceAmt">Advance Amount</label>
                <input type="number"  value="{{$tnt_rent_data->advance_amt}}" class="form-control" name="advanceAmt" id="advanceAmt" placeholder="Enter Advance Amount" required>
                </div>
                <div class="form-group">
                <label for="elec_cost">Electricity Cost Per Unit</label>
                <input type="number"  value="{{$tnt_rent_data->electricity_amt}}" class="form-control" name="elec_cost" id="elec_cost" placeholder="Enter Per Unit Electricity Cost" required>
                </div>
                <div class="form-group">
                <label for="water_cost">Water Cost</label>
                <input type="number" value="{{$tnt_rent_data->water_amt}}"  class="form-control" name="water_cost" id="water_cost" placeholder="Enter Monthly Water Cost" required>
                </div>
                <div class="form-group">
                <label for="agreement_doc">Rent Agreement Document</label>
                <input type="file" class="form-control" name="agreement_doc" id="agreement_doc" placeholder="Insert Image" >
                </div>
                <div class="form-group">
                    <label for="agreement_date">Date Of Agreement</label>
                    <input type="date"  value="{{$tnt_rent_data->agreement_date}}" class="form-control" name="agreement_date" id="agreement_date"  required>
                    </div>
                <div class="form-group">
                    <label for="agreement_duration">Agreement Duration in Months</label>
                    <input type="number"  value="{{$tnt_rent_data->agreement_duration}}" class="form-control" name="agreement_duration" value="11" id="agreement_duration"  required>
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