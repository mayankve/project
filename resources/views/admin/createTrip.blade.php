@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')

<style type="text/css">
	.form-title {
	    background-color: #e3e3e3;
	    /* margin-bottom: 40px; */
	    text-transform: uppercase;
	}
</style>

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
					        Create New Trip
					    </a>
			    	</li>
			    </ol>
			</div>
			<div class="col-sm-6 text-right">
				<h3 class="userName">
			    	
				</h3>
			</div>
		</div>
	</div>

	<div class="airline-contaner row-box">  
	    <div class="form-title">     
	        <div class="col-md-6 col-xs-10">
	            <h3 class="panel-title">Airlines</h3> 
	        </div>
	        <div class="text-right">
	            <a class="addMore" row="airline-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
	        </div>
		</div>
	    <div class="col-md-12">
	    	<form method="POST" name="trip" action="/aat_backup/public/dashboard/create-trip" enctype="multipart/form-data" id="trip">  <div class="form-fluid">
	    	    <div class="row-box">
	    		    <div class="col-md-12">
	    			    <div class="Create-trip pt-4 pb-2">
	    					<div class="row">
	    					 	<div class="col-md-6 cust-input-group">
	    					    	<label><span>Trip Name</span><input type="text" name="name" class="form-control" value=""></label>
	    						</div>
	    						<div class="col-md-6 cust-input-group">
	    						    <label>
	    						        <label for="date">Trip Date</label><input type="date" name="date" class="form-control" id="date" value="">
	    						    </label>
	    						</div>
	    					</div>
	    					<div class="row">
	    						<div class="col-md-6 cust-input-group">
	    							<label for="end_date">Trip Return Date</label><input type="date" name="end_date" class="form-control" id="end_date" value="">
	    						</div>
	    					</div>
	    					<div class="row ">     
	    						<div class="col-md-12 mb-4 coment-box">
	    							<label><span>About Trip</span></label>
	    							<input type="" name="" class="form-control" id="" value="">
	    						</div>
	    					</div>
	    					<div class="row">     
	    						<div class="col-md-6 cust-input-group type-file">
	    							<label>
	    								<label for="banner_image">Banner Image</label><input type="file" name="banner_image" class="form-control" id="banner_image">
	    							</label>
	    						 </div>
	    						<div class="col-md-6 cust-input-group">
	    							<label><span>Banner Video URL</span><input type="text" name="banner_video" class="form-control" value=""></label>
	    						</div>
	    					</div>
	    					<div class="row">     
	    					 	<div class="col-md-6 cust-input-group">
	    						    <label><span>Trip base cost</span><input type="number" name="base_cost" class="form-control" value=""></label>
	    						</div>
	    					 	<div class="col-md-6 cust-input-group">
	    					    	<label><span>Maximum spots</span><input type="number" name="maximum_spots" class="form-control" value=""></label>
	    						</div>
	    					</div>
	    					<div class="row">     
	    						<div class="col-md-6 cust-input-group">
	    							<label>
	    								<label for="adjustment_date">Adjustment Last Date</label><input type="date" name="adjustment_date" class="form-control" id="adjustment_date" value="">
	    							</label>
	    						</div>       
	    						<div class="col-md-6 cust-input-group">
	    							<label>
	    								<label for="land_only_date">Land Only Dead Line</label><input type="date" name="land_only_date" class="form-control" id="land_only_date" value="">
	    							</label>
	    						</div>       
	    					</div>
	    			    </div>
	    		 	</div>
	    	 	</div>
	    	</form>	
	    </div>
	</div>


	<div class="airline-contaner row-box">  
	    <div class="form-title">     
	        <div class="col-md-6 col-xs-10">
	            <h3 class="panel-title">Airlines</h3> 
	        </div>
	        <div class="text-right">
	            <a class="addMore" row="airline-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
	        </div>
		</div>
	    <div class="col-md-12">    
		    <div class="cust-input-group airline-row pt-4 pb-2">     
		        <fieldset class="trip_collection">
		        	<label class="mycss classes "><span>Airline Name</span>
			        	<select name="airline[0][airline_name]" class="form-control">
							<option value="1">Alaska Airlines</option>
							<option value="2">Allegiant Air</option>
							<option value="3">American Airlines</option>
							<option value="4">Delta Air Lines</option>
							<option value="5">Frontier Airlines</option>
							<option value="6">Hawaiian Airlines</option>
							<option value="7">JetBlue</option>
							<option value="8">Southwest Airlines</option>
							<option value="9">Spirit Airlines</option>
							<option value="10">United Airlines</option>
							<option value="11">Virgin America</option>
						</select>
					</label>
					<label><span>Departure Location</span><input type="text" name="airline[0][airline_departure_location]" class="form-control " value=""></label>
					<label><span>Departure Date</span><input type="date" name="airline[0][airline_departure_date]" class="form-control date" value=""></label>
					<label><span>Departure Time</span><input type="time" name="airline[0][airline_departure_time]" class="form-control time" value=""></label>
					<label><span>Layovers (MM)</span><input type="number" name="airline[0][airline_layovers]" class="form-control " value=""></label>
					<label><span>Baggage Allowance (Kg)</span><input type="number" name="airline[0][airline_baggage_allowance]" class="form-control " step="0.01" value=""></label>
					<label><span>Our Cost</span><input type="number" name="airline[0][airline_our_cost]" class="form-control " value=""></label>
					<label><span>Cost</span><input type="number" name="airline[0][airline_cost]" class="form-control " value=""></label>
					<label><span>Due Date</span><input type="date" name="airline[0][airline_due_date]" class="form-control date" value=""></label>
					<label class="mycss classes "><span>Reserve Type</span>
						<select name="airline[0][airline_reserve_type]" class="form-control"><option value="0">Flat</option>
							<option value="1">Percentage</option>
						</select>
					</label>
					<label><span>Reserve Amount</span><input type="number" name="airline[0][airline_reserve_amount]" class="form-control " value=""></label>
				</fieldset>
			</div>
	    </div>
	</div>

</div>



@endsection