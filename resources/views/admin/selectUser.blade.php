@extends('layout.master')
@section('page-title','Select User')
@section('title','Select User')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h2>Select User</h2>
            
            <form action="{{route('ad.settleAmt')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="slct-user">Select Tenant to Create Bill</label>
                    <select class="form-control" name="tnt_id" id="slct-user"  required>
                        <option>...Select User...</option>
                        @foreach ($tnts_data as $tnts)
                        <option value="{{$tnts->id}}">{{$tnts->name}}</option>
                        @endforeach
                    </select>
                    </div>
                <br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>


@endsection