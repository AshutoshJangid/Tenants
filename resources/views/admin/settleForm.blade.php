@extends('layout.master')
@section('page-title','Settle Amount')
@section('title','Settle Amount')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Settle Amount</h2>
            <p> Bill Amount: {{$settle_data->total_amt}}</p>
            <p> Pending Amount: {{$settle_data->remaining_amt}}</p>
            <form action="{{route('ad.settleAmt')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bill_amt">Enter Bill Amount</label>
                        <input type="hidden" name="bill_id" value="{{$settle_data->bill_id}}">
                        <input type="number" class="form-control" name="bill_amt" id="bill_amt">
                    </div>
                <br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection