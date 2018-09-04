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
                            Trip Details    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
	
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<p>{{ $message }}</p>
			</div>
			@endif
	
    <div class="clearfix create-trip">
        <div class="panel panel-primary">
            <div class="panel-heading white-bg">
                <h3 class="panel-title">Booked Trip Detail</h3>
                <div class="panel-tools"> </div>
            </div>
        </div>
        <div class="table-responsive">
		@if(count($tripdata)>0)
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Trip Name</th>
                        <th>Base Cost</th>
                        <th>Booking Date</th>		 
                        <th>Number of Traveler</th>
						<!--<th>Paid Amount by user</th>-->
						<th>Number of addon selected</th>
                    </tr>
                </thead>
                <tbody> 
				<?php $amount=0;?>
				
					@foreach($tripdata As $key=> $tripdetail)
						
				<tr class="parent">
                        <td>{{$tripdetail['trip_detail']->name}}</td>
                        <td>${{$tripdetail['trip_detail']->base_cost}}</td>
                        <td>{{$tripdetail['trip_detail']->booking_date}}</td>
                        <td><?php echo !empty($tripdetail['traveler_detail']) ? count($tripdetail['traveler_detail']): ''; ?></td>
						
						<td><?php echo !empty($tripdetail['selected_add_on']) ? count($tripdetail['selected_add_on']): '0'; ?></td>
                
                </tr>		
                   
				@endforeach
				
                </tbody>
            </table>
			@else
					<h1>No record found..</h1>
				@endif
        </div>
        <script>
        </script>
    </div>
</div>

@endsection