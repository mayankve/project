@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<div class="pageContainer">
    <div class="dashboardHeader">
        <div class="row">
            <div class="col-sm-6 text-left">
                <div class="sidebar_toggle">
                    <i class="fa fa-chevron-right" data-unicode="f00a"></i>
                </div>
                <ol class="breadcrumb">
                    <li>
                        <a class="desh-title" href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <a>
                            Trip Spots    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
    <div class="clearfix create-trip">
        <div class="panel panel-primary">
            <div class="panel-heading white-bg">
                <h3 class="panel-title">Booked Trip Detail</h3>
                <div class="panel-tools"> </div>
            </div>
        </div>
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Trip Name</th>
                        <th>Base Cost</th>
                        <th>Booking Date</th>		 
                        <th>Nex Payment Date</th>
                    </tr>
                </thead>
                <tbody> 
				@if(count($tripdata)>0)
					@foreach($tripdata As $tripdetail)
                    <tr class="parent">
                        <td>{{$tripdetail->name}}</td>
                        <td>{{$tripdetail->base_cost}}</td>
                        <td>{{$tripdetail->booking_date}}</td>

                        <td><input  name="adjustment_date" type="date" class="form-control datechek" value="<?php echo($tripdetail->monthly_payment_date != '') ? $tripdetail->monthly_payment_date : ''; ?>"  id="adjustment_date" style=" width: 165px;"></td>
                <input type="hidden" name="trip_id" class="trip_id" value="{{$tripdetail->trip_id}}">
                </tr>
				@endforeach
				@endif
                </tbody>
            </table>
        </div>
        <script>
        </script>
    </div>
</div>

@endsection