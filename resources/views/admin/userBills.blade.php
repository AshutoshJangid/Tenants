@extends('layout.master')
@section('page-title','User Bills')
@section('title','User Bills')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Tenant Bills</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> --}}
    <div class="card mb-4">
        {{-- <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div> --}}
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Invoice No</th>
                        <th>Previous Units</th>
                        <th>Present Units</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Action</th>
                        <th>Invoice No</th>
                        <th>Previous Units</th>
                        <th>Present Units</th>
                        <th>Created At</th>
                    </tr>
                </tfoot>
                <tbody>
                    
                    @foreach($bill_data as $bills)
                        <tr>
                            <td><a href="{{route('ad.downloadPdf',$bills->bill_id)}}" class="btn btn-warning">Download Bill</a></td>
                            <td>{{$bills->bill_id}}</td>
                            <td>{{$bills->previous_unit}}</td>
                            <td>{{$bills->present_unit}}</td>
                            <td>{{date('d-M-Y', strtotime($bills->created_at));}}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
