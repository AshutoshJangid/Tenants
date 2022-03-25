@extends('layout.master')
@section('page-title','Front')
@section('title','Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Tenant List</h1>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Start date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($userdata as $users)
                    <tr>
                        <td>
                            @if($users->status=='active')
                            <a href="{{route('ad.changeStatus',$users->id)}}" class="btn btn-warning">Deactive</a>
                            @else
                            <a href="{{route('ad.changeStatus',$users->id)}}" class="btn btn-success">Active</a>
                        @endif
                        </td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{$users->phone}}</td>
                        <td> {{strtoupper($users->status)}} </td>
                        <td>{{date('d-M-Y', strtotime($users->created_at));}}</td>
                    </tr>
                    @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
