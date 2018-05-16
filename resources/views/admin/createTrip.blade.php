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

    <form name="frm_create_trip" id="frm_create_trip">
	    <div class="airline-contaner row-box">
	        <div class="form-title">     
	            <div class="col-md-6 col-xs-10">
	                <h3 class="panel-title">CREATE TRIP</h3> 
	            </div>
	            <!-- <div class="text-right">
	            <a class="addMore" row="airline-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
	            </div> -->
	        </div>
	        <div class="col-md-12">
	            <div class="form-fluid">
	                <div class="row-box">
	                    <div class="col-md-12">
	                        <div class="Create-trip pt-4 pb-2">
	                            <div class="row">
	                                <div class="col-md-6 cust-input-group">
	                                    <label><span>Trip Name</span><input type="text" required="required" name="name" class="form-control" value=""></label>
	                                </div>
	                                <div class="col-md-6 cust-input-group">
	                                    <label>
	                                        <label for="date">Trip Date</label><input required="required" type="date" name="date" class="form-control" id="date" value="">
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6 cust-input-group">
	                                    <label for="end_date">Trip Return Date</label><input  required="required" type="date" name="end_date" class="form-control" id="end_date" value="">
	                                </div>
	                            </div>
	                            <div class="row ">     
	                                <div class="col-md-12 mb-4 coment-box">
	                                    <label><span>About Trip</span></label>
	                                    <input type="" required="required" name="" class="form-control" id="" value="">
	                                </div>
	                            </div>
	                            <div class="row">     
	                                <div class="col-md-6 cust-input-group type-file">
	                                    <label>
	                                        <label for="banner_image">Banner Image</label><input required="required" type="file" name="banner_image" class="form-control" id="banner_image">
	                                    </label>
	                                </div>
	                                <div class="col-md-6 cust-input-group">
	                                    <label><span>Banner Video URL</span><input  required="required" type="text" name="banner_video" class="form-control" value=""></label>
	                                </div>
	                            </div>
	                            <div class="row">     
	                                <div class="col-md-6 cust-input-group">
	                                    <label><span>Trip base cost</span><input type="number" required="required" name="base_cost" class="form-control" value=""></label>
	                                </div>
	                                <div class="col-md-6 cust-input-group">
	                                    <label><span>Maximum spots</span><input type="number" required="required" name="maximum_spots" class="form-control" value=""></label>
	                                </div>
	                            </div>
	                            <div class="row">     
	                                <div class="col-md-6 cust-input-group">
	                                    <label>
	                                        <label for="adjustment_date">Adjustment Last Date</label><input type="date" required="required" name="adjustment_date" class="form-control" id="adjustment_date" value="">
	                                    </label>
	                                </div>       
	                                <div class="col-md-6 cust-input-group">
	                                    <label>
	                                        <label for="land_only_date">Land Only Dead Line</label><input type="date" required="required" name="land_only_date" class="form-control" id="land_only_date" value="">
	                                    </label>
	                                </div>       
	                            </div>
	                        </div>
	                    </div>
	                </div> 
	             </div>
	    	</div>
	    	<!-- Airline Row -->

		    <div class="airline-contaner row-box">  
		        <div class="form-title">     
		            <div class="col-md-6 col-xs-10">
		                <h3 class="panel-title">Airlines</h3> 
		            </div>
		            <div class="text-right">
		                <a class="addMore airline-plus" row="airline-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
		            </div>
		        </div>
		        <div class="col-md-12 airline_details">
		            <div class="cust-input-group airline-row pt-4 pb-2">     
		                <fieldset class="trip_collection">
		                    <fieldset>
		                    	<label class="mycss classes "><span>Airline Name</span>
		                            <select required="required" name="airline[][airline_name]" class="form-control">
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
		                        <label><span>Departure Location</span>
		                            <input type="text" required="required" name="airline[][airline_departure_location]" class="form-control " value="">
		                        </label>
		                        <label><span>Departure Date</span>
		                            <input type="date" required="required" name="airline[][airline_departure_date]" class="form-control date" value="">
		                        </label>
		                        <label><span>Departure Time</span>
		                            <input type="time" required="required" name="airline[][airline_departure_time]" class="form-control time" value="">
		                        </label>
		                        <label><span>Layovers (MM)</span>
		                            <input required="required" type="number" name="airline[][airline_layovers]" class="form-control " value="">
		                        </label>
		                        <label><span>Baggage Allowance (Kg)</span>
		                            <input type="number" required="required" name="airline[][airline_baggage_allowance]" class="form-control " step="0.01" value="">
		                        </label>
		                        <label><span>Our Cost</span><input type="number" name="airline[][airline_our_cost]" class="form-control " value=""></label>
		                        <label><span>Cost</span>
		                            <input type="number" name="airline[][airline_cost]" class="form-control " value="">
		                        </label>
		                        <label><span>Due Date</span>
		                            <input type="date" name="airline[][airline_due_date]" class="form-control date" value="">
		                        </label>
		                        <label class="mycss classes "><span>Reserve Type</span>
		                            <select name="airline[][airline_reserve_type]" class="form-control"><option value="0">Flat</option>
		                                <option value="1">Percentage</option>
		                            </select>
		                        </label>
		                        <label><span>Reserve Amount</span>
		                            <input type="number" name="airline[][airline_reserve_amount]" required="required" class="form-control " value="">
		                        </label>
		                    </fieldset>
		                </fieldset>
		                <!-- Remove detail container -->
		                <div id="remove_airline_details"></div>
		            </div>
		        </div>
		    </div>
	    	<!-- Included Actiivity -->
		    <div class="included-activity-contaner row-box">
		        <div class="form-title">     
		            <div class="col-md-6 col-xs-10">
		                <h3>Included Activity</h3> 
		            </div>
		            <div class="text-right">
		                <a class="addMore include-plus" row="included-activity-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
		            </div>
		        </div> 
		        <div class="col-md-12 activities_details">
		            <div class="cust-input-group included-activity-row pt-4 pb-2">     
		                <fieldset class="trip_collection">
		                	<fieldset>
		                		<label class="mycss classes"><span>Activity Name</span><input type="text" name="included_activity[][activity_name]" class="form-control" value=""></label>
		                		<label class="mycss classes"><span>Activity Detail</span><input type="text" name="included_activity[][activity_detail]" class="form-control" value=""></label>
		                		<label class="mycss classes"><span>Activity Cost</span><input type="number" name="included_activity[][activity_cost]" class="form-control" value=""></label>
		                		<label class="mycss classes"><span>Activity Our Cost</span><input type="number" name="included_activity[][activity_our_cost]" class="form-control" value=""></label><label><span>Due Date</span><input type="date" name="included_activity[][activity_due_date]" class="form-control date" value=""></label>
		                		<label class="mycss classes "><span>Reserve Type</span>
		                			<select name="included_activity[][activity_reserve_type]" class="form-control">
			                			<option value="0">Flat</option>
			                            <option value="1">Percentage</option>
			                        </select>
			                    </label>
			                    <label><span>Reserve Amount</span><input type="number" name="included_activity[][activity_reserve_amount]" class="form-control " value=""></label>
			                    <label for="activity_image">Activity Image</label>
			                    <input type="file" name="included_activity[][activity_image]" class="form-control" id="activity_image">
			                    <button type="button" name="included_activity[][activity_add_hotel]" class="addons_add_hotel" value="Add activity">Add More Hotel</button>
			                    <fieldset class="addons_hotel_collection">
			                    	<legend>Activity Hotel</legend>
			                    	<fieldset>
			                    		<label class="lbl_hotel_name"><span>Hotel Name</span><input type="text" name="included_activity[][activity_hotels][][hotel_name]" class="form-control " value=""></label>
			                    		<label class="lbl_hotel_type"><span>Type</span><input type="text" name="included_activity[][activity_hotels][][hotel_type]" class="form-control" value=""></label>
			                    		<label class="lbl_hotel_cost"><span>Cost</span><input type="number" name="included_activity[][activity_hotels][][hotel_cost]" class="form-control" value=""></label>
			                    		<label class="lbl_hotel_solo_cost"><span>Solo Cost</span><input type="number" name="included_activity[][activity_hotels][][hotel_solo_cost]" class="form-control" value=""></label>
			                    		<label class="lbl_hotel_our_cost"><span>Our Cost</span><input type="number" name="included_activity[][activity_hotels][][hotel_our_cost]" class="form-control" value=""></label>
			                    		<label class="lbl_hotel_our_cost"><span>Our Solo Cost</span>
		                                    <input type="number" name="included_activity[][activity_hotels][][hotel_our_solo_cost]" class="form-control" value="">
		                                </label>
		                                <label><span>Due Date</span><input type="date" name="included_activity[][activity_hotels][][hotel_due_date]" class="form-control date" value=""></label>
		                                <label class="mycss classes "><span>Reserve Type</span>
		                                	<select name="included_activity[][activity_hotels][][hotel_reserve_type]" class="form-control">
			                                	<option value="0">Flat</option>
			                                    <option value="1">Percentage</option>
		                                	</select>
		                                </label>
		                                <label><span>Reserve Amount</span><input type="number" name="included_activity[][activity_hotels][][hotel_reserve_amount]" class="form-control " value=""></label>
		                            </fieldset>
		                            <span data-template=""></span>
		                        </fieldset>
		                        <button type="button" name="included_activity[][activity_add_airline]" class="addons_add_hotel" value="Add airline">Add More Airline</button>
		                        <fieldset class="addons_hotel_collection"><legend>Activity Airline</legend><fieldset>
		                        	<label class="mycss classes ">
		                                <span>Airline Name</span>
		                                <select name="included_activity[][activity_airlines][][airline_name]" class="form-control">
		                                    <option value="1">Alaska Airlines</option>
		                                </select>
		                            </label>
		                            <label><span>Departure Location</span><input type="text" name="" class="form-control&amp;#x20;" value=""></label>
		                                <label><span>Departure Date</span><input type="date" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_departure_date&amp;#x5D;" class="form-control&amp;#x20;date" value=""></label>
		                                <label><span>Departure Time</span><input type="time" name="" class="form-control-time" value=""></label>
		                                <label><span>Layovers (MM)</span><input type="number" name="included_activity activity_airlines airline_layovers" class="form-control&amp;#x20;" value=""></label>
		                                <label><span>Baggage Allowance (Kg)</span><input type="number" name="airline_baggage_allowance" class="form-control&amp;#x20;" step="0.01" value=""></label><label><span>Our Cost</span><input type="number" name="included_activity#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_our_cost&amp;#x5D;" class="form-control&amp;#x20;" value=""></label>
		                                <label><span>Cost</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_cost&amp;#x5D;" class="form-control&amp;#x20;" value=""></label>
		                                <label><span>Due Date</span><input type="date" name="" class="form-control&amp;#x20;date" value=""></label>
		                                <label class="mycss&amp;#x20;classes&amp;#x20;"><span>Reserve Type</span>
		                                	<select name="" class="form-control">
		                                        <option value="0">Flat</option>
		                                        <option value="1">Percentage</option>
		                                    </select>
		                                </label>
		                                <label><span>Reserve Amount</span><input type="number" name="" class="form-control&amp;#x20;" value=""></label></fieldset><span ></span>
		                        </fieldset>
		                    </fieldset>
		                </fieldset>
		                <!-- Remove detail container -->
		                <div id="remove_activities_details"></div>
		            </div>
		    	</div>
		    </div>

	  		<!-- Add ons/Upgrades -->
			<div class="hotel-contaner row-box">  
			    <div class="form-title">     
			        <div class="col-md-6 col-xs-10">
			            <h3>Add ons/Upgrades</h3> 
			        </div>
			        <div class="text-right">
			            <a class="addMore addon-plus" row="addons-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
			        </div>
			    </div> 
			    <div class="col-md-12 add_on_details">
			        <div class="cust-input-group addons-row pt-4 pb-2"> 
			            <fieldset class="trip_collection">
			            	<fieldset>
			                    <label class="mycss classes"><span>Add ons Name</span><input type="text" name="addon[][addons_name]" class="form-control" value=""></label>
			                    <label class="mycss classes"><span>Add ons Detail</span><input type="text" name="addon[][addons_detail]" class="form-control" value=""></label>
			                    <label class="mycss classes"><span>Add ons Cost</span><input type="number" name="addon[][addons_cost]" class="form-control" value=""></label>
			                    <label class="mycss classes"><span>Add ons Our Cost</span><input type="number" name="addon[][addons_our_cost]" class="form-control" value=""></label>
			                    <label><span>Due Date</span>
			                        <input type="date" required="required" name="addon[][addons_due_date]" class="form-control date" value="">
			                    </label>
			                    <label class="mycss classes "><span>Reserve Type</span>
			                        <select name="addon[][addons_reserve_type]"  required="required"class="form-control"><option value="0">Flat</option>
			                            <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span>
			                        <input required="required" type="number" name="addon[][addons_reserve_amount]" class="form-control " value="">
			                    </label>
			                    <label for="addons_image">Add ons Image</label>
			                    <input required="required" type="file" name="addon[][addons_image]" class="form-control" id="addons_image">
			                    <button type="button" name="addon[][addons_add_hotel]" class="addons_add_hotel" value="Add hotel">Add More Hotel</button>
			                    <fieldset class="addons_hotel_collection"><legend>Add ons Hotel</legend>
			                        <fieldset>
			                        	<label class="lbl_hotel_name"><span>Hotel Name</span>
			                                <input required="required" type="text" name="addon[][addons_hotels][][hotel_name]" class="form-control " value="">
			                            </label>
			                            <label class="lbl_hotel_type"><span>Type</span>
			                                <input required="required" type="text" name="addon[][addons_hotels][][hotel_type]" class="form-control" value="">
			                            </label>
			                            <label class="lbl_hotel_cost"><span>Cost</span>
			                                <input required="required"  type="number" name="addon[][addons_hotels][][hotel_cost]" class="form-control" value="">
			                            </label>
			                            <label class="lbl_hotel_solo_cost"><span>Solo Cost</span>
			                                <input required="required" type="number" name="addon[][addons_hotels][][hotel_solo_cost]" class="form-control" value="">
			                            </label>
			                            <label class="lbl_hotel_our_cost"><span>Our Cost</span>
			                                <input  required="required" type="number" name="addon[][addons_hotels][][hotel_our_cost]" class="form-control" value="">
			                            </label>
			                            <label class="lbl_hotel_our_cost"><span>Our Solo Cost</span>
			                                <input required="required"  type="number" name="addon[][addons_hotels][][hotel_our_solo_cost]" class="form-control" value="">
			                            </label>
			                            <label><span>Due Date</span>
			                                <input type="date" name="addon[][addons_hotels][][hotel_due_date]" class="form-control date" required="required" value="">
			                            </label>
			                            <label class="mycss classes "><span>Reserve Type</span>
			                                <select required="required" name="addon[][addons_hotels][][hotel_reserve_type]" class="form-control">
			                                    <option value="0">Flat</option>
			                                    <option value="1">Percentage</option></select>
			                            </label><label><span>Reserve Amount</span>
			                                <input type="number" name="addon[][addons_hotels][][hotel_reserve_amount]" class="form-control " value=""></label>
			                        </fieldset>
			                    </fieldset>
			                    <button type="button" name="addon[][addons_add_airline]" class="addons_add_hotel" value="Add Airline">Add More Airline</button>
			                    <fieldset class="addons_hotel_collection"><legend>Add ons Airline</legend>
			                    	<fieldset>
			                    		<label class="mycss classes "><span>Airline Name</span>
			                                <select required="required" name="addon[][addons_airlines][][airline_name]" class="form-control">
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
			                            <label><span>Departure Location</span>
			                                <input required="required" type="text" name="addon[][addons_airlines][][airline_departure_location]" required="required" class="form-control " value="">
			                            </label>
		                            	<label><span>Departure Date</span>
		                            	    <input required="required" type="date" name="addon[][addons_airlines][][airline_departure_date]" class="form-control date" value="">
		                            	</label>
			                            <label><span>Departure Time</span><input type="time" name="addon[][addons_airlines][][airline_departure_time]" class="form-control time" value=""></label>
			                            <label><span>Layovers (MM)</span>
			                                <input  required="required" type="number" name="addon[][addons_airlines][][airline_layovers]" class="form-control " value="">
			                            </label>
			                            <label><span>Baggage Allowance (Kg)</span><input type="number" name="addon[][addons_airlines][][airline_baggage_allowance]" class="form-control " step="0.01" value=""></label>
			                            <label><span>Our Cost</span><input type="number" name="addon[][addons_airlines][][airline_our_cost]" class="form-control " value=""></label>
			                            <label><span>Cost</span>
			                                <input required="required" type="number" name="addon[][addons_airlines][][airline_cost]" class="form-control " value="">
			                            </label>
			                            <label><span>Due Date</span>
			                                <input required="required" type="date" name="addon[][addons_airlines][][airline_due_date]" class="form-control date" value="">
			                            </label>
			                            <label class="mycss classes ">
			                            	<span>Reserve Type</span>
			                            	<select name="addon[][addons_airlines][][airline_reserve_type]" class="form-control">
			                            		<option value="0">Flat</option>
			                                    <option value="1">Percentage</option>
			                                </select>
			                            </label>
			                            <label><span>Reserve Amount</span>
			                                <input required="required" type="number" name="addon[][addons_airlines][][airline_reserve_amount]" class="form-control " value="">
			                            </label>
			                        </fieldset>
			                    </fieldset>
			                </fieldset>
			            </fieldset>
			            <!-- Remove detail container -->
			            <div id="remove_addon_plus_details"></div>
			        </div>
				</div>
			</div>

			<!-- Hotels -->  
	        <div class="hotel-contaner row-box">  
	            <div class="form-title">     
	                <div class="col-md-6 col-xs-10">
	                    <h3>Hotels</h3> 
	                </div>
	                <div class="text-right">
	                    <a class="addMore hotel-plus" row="hotel-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
	                </div>
	            </div>
	            <div class="col-md-12 hotel_details">
	                <div class="cust-input-group hotel-row pt-4 pb-2">     
	                    <fieldset class="trip_collection">
	                    	<fieldset>
	                    		<label class="lbl_hotel_name"><span>Hotel Name</span>
		                            <input type="text" name="hotels[][hotel_name]" required="required" class="form-control " value="">
		                        </label>
		                        <label class="lbl_hotel_type"><span>Type</span>
		                            <input type="text" required="required" name="hotels[][hotel_type]" class="form-control" value="">
		                        </label>
		                        <label class="lbl_hotel_cost"><span>Cost</span>
		                            <input type="number" name="hotels[][hotel_cost]" required="required" class="form-control" value="">
		                        </label>
		                        <label class="lbl_hotel_solo_cost"><span>Solo Cost</span>
		                            <input type="number" name="hotels[][hotel_solo_cost]" required="required" class="form-control" value="">
		                        </label>
		                        <label class="lbl_hotel_our_cost"><span>Our Cost</span><input type="number" name="hotels[][hotel_our_cost]" class="form-control" value=""></label>
		                        <label class="lbl_hotel_our_cost"><span>Our Solo Cost</span>
		                            <input type="number" required="required" name="hotels[][hotel_our_solo_cost]" class="form-control" value="">
		                        </label>
		                        <label><span>Due Date</span>
		                            <input type="date" name="hotels[][hotel_due_date]" class="form-control date" required="required" value="">
		                        </label>
		                        <label class="mycss classes "><span>Reserve Type</span>
	                            	<select name="hotels[][hotel_reserve_type]" class="form-control" required="required">
	                            		<option value="0">Flat</option>
	                                	<option value="1">Percentage</option>
	                                </select>
	                            </label>
	                            <label><span>Reserve Amount</span>
	                            <input type="number" required="required" name="hotels[][hotel_reserve_amount]" class="form-control " value=""></label>
	                    	</fieldset>
	                    	<span data-template=''></span>
	                    </fieldset>
	                    <!-- Remove detail container -->
	                    <div id="remove_hotel_details"></div>
	                </div>
	            </div>
	        </div>

			<!-- Trip to Do/Packing list -->
	        <div class="todo-contaner row-box">  
	            <div class="form-title">     
	                <div class="col-md-6 col-xs-10">
	                    <h3>Trip to Do/Packing list</h3> 
	                </div>
	                <div class="text-right">
	                    <a class="addMore todo-plus" row="todo-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
	                </div>
	            </div>
	            <div class="col-md-12 todo_details">
	                <div class="cust-input-group todo-row pt-4 pb-2">     
	                    <fieldset class="trip_collection">
	                    	<fieldset>
	                    		<label>
	                    			<span>Do/Packing</span>
	                        		<input required="required" type="text" name="to_do[][]" class="form-control" value="">
	                        	</label>
	                    	</fieldset>
	                    </fieldset>
	                    <!-- Remove detail container -->
	                    <div id="remove_todo_details"></div>
	                </div>
	            </div>
	        </div>

	        <div class="row-box">
	            <div class="form-title">     
	                <div class="col-md-6">
	                    <h3>Entry requirements</h3> 
	                </div>

	            </div>
	            <div class="col-md-12">
	                <div class="cust-input-group entry-req pt-4 pb-2">
	                    <div class="row">     
	                        <div class="col-md-3 cust-input-group requirement-passport">
	                            <fieldset>
	                            	<legend>Is passport required?</legend>
	                            	<label><input type="radio" name="requirement_is_passport" class="requirement-passport" value="0" checked="checked">No</label>
	                            	<label><input type="radio" name="requirement_is_passport" class="requirement-passport" value="1">Yes</label>
	                            </fieldset>
	                        </div>    
	                        <br>
	                        <div class="col-md-4 cust-input-group requirement-passport-box pb-0" style="display: none;">
	                            <label for="requirement_passport_min_expiry">Passport Min Expiry Date</label>
	                            <input type="date" name="requirement_passport_min_expiry" class="form-control" id="requirement_passport_min_expiry" value="">
	                        </div>       
	                    </div>
	                    <div class="row">     
	                        <div class="col-md-3 cust-input-group requirement-passport">
	                            <fieldset>
	                            	<legend>Is visa required?</legend>
	                            	<label>
	                            		<input type="radio" name="requirement_is_visa" class="requirement-visa" value="0" checked="checked">No
	                            	</label>
	                            	<label>
	                            		<input type="radio" name="requirement_is_visa" class="requirement-visa" value="1">Yes
	                            	</label>
	                            </fieldset>
	                        </div> 
	                        <br>
	                        <div class="col-md-4 cust-input-group requirement-visa-box pb-0" style="display: none;">
	                            <label><span>Visa Cost</span><input type="text" name="requirement_visa_cost" class="form-control" value=""></label>
	                        </div>       
	                        <div class="col-md-5 cust-input-group requirement-visa-box pb-0" style="display: none;">
	                            <label><span>Visa Process</span><input type="text" name="requirement_visa_process" class="form-control" value=""></label>
	                        </div>
	                    </div>
	                    <div class="row">     
	                        <div class="col-md-3 cust-input-group requirement-passport">
	                            <fieldset>
	                            	<legend>Is Shots/Medication required?</legend>
	                            	<label><input type="radio" name="requirement_is_shots" class="requirement-shots" id="requirement_is_shots" value="0" checked="checked">No</label>
	                            	<label><input type="radio" name="requirement_is_shots" class="requirement-shots" value="1">Yes</label>
	                            </fieldset>
	                        </div>    
	                        <br>
	                        <div class="col-md-4 cust-input-group requirement-shots-box pb-0" style="display: none;">
	                            <label><span>Shots Cost</span><input type="text" name="requirement_shots_cost" class="form-control" value=""></label>
	                        </div>       
	                        <div class="col-md-5 cust-input-group requirement-shots-box pb-0" style="display: none;">
	                            <label><span>Shots Timeframe</span><input type="text" name="requirement_shots_timeframe" class="form-control" value=""></label>
	                        </div>
	                    </div>
	                    <div class="row">     
	                        <div class="col-md-6 cust-input-group sendbtn regbtn mt-0 mb-3">
	                            <input type="submit" name="submit" id="submitbutton" value="Create Trip">
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- End Entry requirement -->
	        </div>
		</div>
	</form>
</div>

@endsection