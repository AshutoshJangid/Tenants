@extends('layout.master')
@section('page-title','Select Bill ID')
@section('title','Select  Bill ID')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Enter Bill ID</h2>
            
            <form action="{{route('ad.getBillDetail')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bill_id">Bill ID (Invoice Number)</label>
                        <input type="number" class="form-control" name="bill_id" id="bill_id">
                    </div>
                <br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection