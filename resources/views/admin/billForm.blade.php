@extends('layout.master')
@section('page-title','Create Bill')
@section('title','Create Bill')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Create Bill</h2>
            
            <form action="{{route('ad.tntBillCreate')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tnt_id" value="{{$tnt_rent_data->user_id}}">
                <input type="hidden" name="rent_amt" value="{{$tnt_rent_data->rent_amt}}">
                <div class="row">
                <div class="form-group col-sm-6">
                <label for="prev_reading">Previous Electricity Meter Reading</label>
                <input type="number" class="form-control" name="prev_reading" value="{{$tnt_last_bill ? $tnt_last_bill : ''}}" id="prev_reading" placeholder="Enter Previous Reading">
                </div>
                <div class="form-group col-sm-6">
                <label for="present_read">Present Electricity Meter Reading</label>
                <input type="number" class="form-control" name="present_read" id="present_read" placeholder="Enter Present Reading">
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="elec_char">Electricity Charges Per Unit</label>
                        <input type="text" class="form-control" value="{{$tnt_rent_data->electricity_amt}}" id="elec_char" name="elect_rate"  readonly="true">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tot_elec_bill">Total Electricity Bill</label>
                        <input type="text" class="form-control" value="" id="tot_elec_bill" name="tot_elec_bill"  readonly="true">
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">
                <label for="water_bill">Water Bill</label>
                <input type="number" class="form-control" name="water_bill" id="water_bill" value="{{$tnt_rent_data->water_amt}}" placeholder="Enter Water Charges">
                </div>
                <div class="form-group col-sm-6">
                <label for="discount">Discount</label>
                <input type="number" class="form-control" name="discount" id="discount"  placeholder="Enter Discount on Bill">
                </div>
                </div>
                
                <div class="form-group">
                <label for="remark">Remark For Special Instructions</label>
                <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter Remark">
                </div>
                <div class="form-group">
                    <label for="other_charge">Other Charges</label>
                    <div class="input_fields_wrap">
                            
                            <input type="text" placeholder="Enter Name of Charge" name="charge_name[]">

                            
                            <input type="number" placeholder="Enter value of Charge" name="charge_value[]">

                            
                            <button class="add_field_button btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>
 
                    </div>
                </div>
                
                <br/>
                <button type="submit" class="btn btn-primary">Create Bill</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

@endsection