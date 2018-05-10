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
                <h3 class="panel-title">CREATE TRIP</h3> 
            </div>
            <div class="text-right">
                <a class="addMore" row="airline-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <form method="POST" name="trip" action="/" enctype="multipart/form-data" id="trip">  
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
            </form>	
        </div>
    </div>
    <!----Airline Row----->

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
                    <fieldset><label class="mycss classes "><span>Airline Name</span>
                            <select required="required" name="airline[0][airline_name]" class="form-control">
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
                                <option value="11">Virgin America</option></select></label>
                                <label><span>Departure Location</span>
                            <input type="text" required="required" name="airline[0][airline_departure_location]" class="form-control " value=""></label>
                            <label><span>Departure Date</span>
                                <input type="date" required="required" name="airline[0][airline_departure_date]" class="form-control date" value=""></label>
                                <label><span>Departure Time</span>
                                    <input type="time" required="required" name="airline[0][airline_departure_time]" class="form-control time" value=""></label>
                                    <label><span>Layovers (MM)</span>
                                        <input required="required" type="number" name="airline[0][airline_layovers]" class="form-control " value=""></label>
                                        <label><span>Baggage Allowance (Kg)</span>
                                            <input type="number" required="required" name="airline[0][airline_baggage_allowance]" class="form-control " step="0.01" value=""></label><label><span>Our Cost</span><input type="number" name="airline[0][airline_our_cost]" class="form-control " value=""></label>
                                            <label><span>Cost</span>
                                            <input type="number" name="airline[0][airline_cost]" class="form-control " value=""></label>
                                            <label><span>Due Date</span>
                                            <input type="date" name="airline[0][airline_due_date]" class="form-control date" value=""></label>
                                            <label class="mycss classes "><span>Reserve Type</span>
                                            <select name="airline[0][airline_reserve_type]" class="form-control"><option value="0">Flat</option>
                                           <option value="1">Percentage</option></select>
                                            </label><label><span>Reserve Amount</span>
                                            <input type="number" name="airline[0][airline_reserve_amount]" required="required" class="form-control " value=""></label>
                                        </fieldset>  </fieldset> 
            </div>
        </div>
    </div>
    <!--- Included Actiivity ------>  
    <div class="included-activity-contaner row-box">
        <div class="form-title">     
            <div class="col-md-6 col-xs-10">
                <h3>Included Activity</h3> 
            </div>
            <div class="text-right">
                <a class="addMore" row="included-activity-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div> 
        <div class="col-md-12">
            <div class="cust-input-group included-activity-row pt-4 pb-2">     
                <fieldset class="trip_collection"><fieldset><label class="mycss classes"><span>Activity Name</span><input type="text" name="included_activity[0][activity_name]" class="form-control" value=""></label><label class="mycss classes"><span>Activity Detail</span><input type="text" name="included_activity[0][activity_detail]" class="form-control" value=""></label><label class="mycss classes"><span>Activity Cost</span><input type="number" name="included_activity[0][activity_cost]" class="form-control" value=""></label><label class="mycss classes"><span>Activity Our Cost</span><input type="number" name="included_activity[0][activity_our_cost]" class="form-control" value=""></label><label><span>Due Date</span><input type="date" name="included_activity[0][activity_due_date]" class="form-control date" value=""></label><label class="mycss classes "><span>Reserve Type</span><select name="included_activity[0][activity_reserve_type]" class="form-control"><option value="0">Flat</option>
                                <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span><input type="number" name="included_activity[0][activity_reserve_amount]" class="form-control " value=""></label><label for="activity_image">Activity Image</label><input type="file" name="included_activity[0][activity_image]" class="form-control" id="activity_image"><button type="button" name="included_activity[0][activity_add_hotel]" class="addons_add_hotel" value="Add activity">Add More Hotel</button><fieldset class="addons_hotel_collection"><legend>Activity Hotel</legend><fieldset><label class="lbl_hotel_name"><span>Hotel Name</span><input type="text" name="included_activity[0][activity_hotels][0][hotel_name]" class="form-control " value=""></label><label class="lbl_hotel_type"><span>Type</span><input type="text" name="included_activity[0][activity_hotels][0][hotel_type]" class="form-control" value=""></label><label class="lbl_hotel_cost"><span>Cost</span><input type="number" name="included_activity[0][activity_hotels][0][hotel_cost]" class="form-control" value=""></label><label class="lbl_hotel_solo_cost"><span>Solo Cost</span><input type="number" name="included_activity[0][activity_hotels][0][hotel_solo_cost]" class="form-control" value=""></label><label class="lbl_hotel_our_cost"><span>Our Cost</span><input type="number" name="included_activity[0][activity_hotels][0][hotel_our_cost]" class="form-control" value=""></label><label class="lbl_hotel_our_cost"><span>Our Solo Cost</span><input type="number" name="included_activity[0][activity_hotels][0][hotel_our_solo_cost]" class="form-control" value=""></label><label><span>Due Date</span><input type="date" name="included_activity[0][activity_hotels][0][hotel_due_date]" class="form-control date" value=""></label><label class="mycss classes "><span>Reserve Type</span><select name="included_activity[0][activity_hotels][0][hotel_reserve_type]" class="form-control"><option value="0">Flat</option>
                                        <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span><input type="number" name="included_activity[0][activity_hotels][0][hotel_reserve_amount]" class="form-control " value=""></label></fieldset>
                            <span data-template=""></span></fieldset>
                        <button type="button" name="included_activity[0][activity_add_airline]" class="addons_add_hotel" value="Add airline">Add More Airline</button><fieldset class="addons_hotel_collection"><legend>Activity Airline</legend><fieldset><label class="mycss classes "><span>Airline Name</span><select name="included_activity[0][activity_airlines][0][airline_name]" class="form-control"><option value="1">Alaska Airlines</option>

                                        <option value="2">Allegiant Air</option>
                                        <option value="3">American Airlines</option>
                                        <option value="4">Delta Air Lines</option>
                                        <option value="5">Frontier Airlines</option>
                                        <option value="6">Hawaiian Airlines</option>
                                        <option value="7">JetBlue</option>
                                        <option value="8">Southwest Airlines</option>
                                        <option value="9">Spirit Airlines</option>
                                        <option value="10">United Airlines</option>
                                        <option value="11">Virgin America</option></select></label><label><span>Departure Location</span><input type="text" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_departure_location&amp;#x5D;" class="form-control&amp;#x20;" value=""></label><label><span>Departure Date</span><input type="date" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_departure_date&amp;#x5D;" class="form-control&amp;#x20;date" value=""></label><label><span>Departure Time</span><input type="time" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_departure_time&amp;#x5D;" class="form-control&amp;#x20;time" value=""></label><label><span>Layovers (MM)</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_layovers&amp;#x5D;" class="form-control&amp;#x20;" value=""></label><label><span>Baggage Allowance (Kg)</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_baggage_allowance&amp;#x5D;" class="form-control&amp;#x20;" step="0.01" value=""></label><label><span>Our Cost</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_our_cost&amp;#x5D;" class="form-control&amp;#x20;" value=""></label><label><span>Cost</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_cost&amp;#x5D;" class="form-control&amp;#x20;" value=""></label><label><span>Due Date</span><input type="date" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_due_date&amp;#x5D;" class="form-control&amp;#x20;date" value=""></label><label class="mycss&amp;#x20;classes&amp;#x20;"><span>Reserve Type</span><select name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_reserve_type&amp;#x5D;" class="form-control"><option value="0">Flat</option>
                                        <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span><input type="number" name="included_activity&amp;#x5B;__index__&amp;#x5D;&amp;#x5B;activity_airlines&amp;#x5D;&amp;#x5B;0&amp;#x5D;&amp;#x5B;airline_reserve_amount&amp;#x5D;" class="form-control&amp;#x20;" value=""></label></fieldset><span ></span></fieldset>    </div>
                        </div>
                        </div>

                        <!------Add ons/Upgrades------------>
                        <div class="hotel-contaner row-box">  
                            <div class="form-title">     
                                <div class="col-md-6 col-xs-10">
                                    <h3>Add ons/Upgrades</h3> 
                                </div>
                                <div class="text-right">
                                    <a class="addMore" row="addons-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="cust-input-group addons-row pt-4 pb-2"> 
                                    <fieldset class="trip_collection"><fieldset>
                                            <label class="mycss classes"><span>Add ons Name</span><input type="text" name="addon[0][addons_name]" class="form-control" value=""></label><label class="mycss classes"><span>Add ons Detail</span><input type="text" name="addon[0][addons_detail]" class="form-control" value=""></label><label class="mycss classes"><span>Add ons Cost</span><input type="number" name="addon[0][addons_cost]" class="form-control" value=""></label><label class="mycss classes"><span>Add ons Our Cost</span><input type="number" name="addon[0][addons_our_cost]" class="form-control" value=""></label><label><span>Due Date</span>
                                                <input type="date" required="required" name="addon[0][addons_due_date]" class="form-control date" value=""></label>
                                                <label class="mycss classes "><span>Reserve Type</span>
                                                <select name="addon[0][addons_reserve_type]"  required="required"class="form-control"><option value="0">Flat</option>
                                                    <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span>
                                                    <input required="required" type="number" name="addon[0][addons_reserve_amount]" class="form-control " value=""></label>
                                                    <label for="addons_image">Add ons Image</label>
                                                    <input required="required" type="file" name="addon[0][addons_image]" class="form-control" id="addons_image">
                                                    <button type="button" name="addon[0][addons_add_hotel]" class="addons_add_hotel" value="Add hotel">Add More Hotel</button><fieldset class="addons_hotel_collection"><legend>Add ons Hotel</legend>
                                                    <fieldset><label class="lbl_hotel_name"><span>Hotel Name</span>
                                                    <input required="required" type="text" name="addon[0][addons_hotels][0][hotel_name]" class="form-control " value=""></label>
                                                    <label class="lbl_hotel_type"><span>Type</span>
                                                    <input required="required" type="text" name="addon[0][addons_hotels][0][hotel_type]" class="form-control" value=""></label>
                                                    <label class="lbl_hotel_cost"><span>Cost</span>
                                                    <input required="required"  type="number" name="addon[0][addons_hotels][0][hotel_cost]" class="form-control" value=""></label>
                                                    <label class="lbl_hotel_solo_cost"><span>Solo Cost</span>
                                                    <input required="required" type="number" name="addon[0][addons_hotels][0][hotel_solo_cost]" class="form-control" value=""></label>
                                                    <label class="lbl_hotel_our_cost"><span>Our Cost</span>
                                                    <input  required="required" type="number" name="addon[0][addons_hotels][0][hotel_our_cost]" class="form-control" value=""></label>
                                                    <label class="lbl_hotel_our_cost"><span>Our Solo Cost</span>
                                                    <input required="required"  type="number" name="addon[0][addons_hotels][0][hotel_our_solo_cost]" class="form-control" value=""></label>
                                                    <label><span>Due Date</span>
                                                    <input type="date" name="addon[0][addons_hotels][0][hotel_due_date]" class="form-control date" required="required" value=""></label>
                                                    <label class="mycss classes "><span>Reserve Type</span>
                                                     <select required="required" name="addon[0][addons_hotels][0][hotel_reserve_type]" class="form-control">
                                                         <option value="0">Flat</option>
                                                    <option value="1">Percentage</option></select>
                                                    </label><label><span>Reserve Amount</span>
                                                    <input type="number" name="addon[0][addons_hotels][0][hotel_reserve_amount]" class="form-control " value=""></label>
                                                    </fieldset>
                                                    </fieldset>
                                                    <button type="button" name="addon[0][addons_add_airline]" class="addons_add_hotel" value="Add Airline">Add More Airline</button><fieldset class="addons_hotel_collection"><legend>Add ons Airline</legend><fieldset><label class="mycss classes "><span>Airline Name</span>
                                                    <select required="required" name="addon[0][addons_airlines][0][airline_name]" class="form-control">
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
                                                    <option value="11">Virgin America</option></select></label>
                                                    <label><span>Departure Location</span>
                                                    <input required="required" type="text" name="addon[0][addons_airlines][0][airline_departure_location]" required="required" class="form-control " value=""></label><label><span>Departure Date</span>
                                                    <input required="required" type="date" name="addon[0][addons_airlines][0][airline_departure_date]" class="form-control date" value=""></label><label><span>Departure Time</span><input type="time" name="addon[0][addons_airlines][0][airline_departure_time]" class="form-control time" value=""></label>
                                                    <label><span>Layovers (MM)</span>
                                                        <input  required="required" type="number" name="addon[0][addons_airlines][0][airline_layovers]" class="form-control " value=""></label><label><span>Baggage Allowance (Kg)</span><input type="number" name="addon[0][addons_airlines][0][airline_baggage_allowance]" class="form-control " step="0.01" value=""></label><label><span>Our Cost</span><input type="number" name="addon[0][addons_airlines][0][airline_our_cost]" class="form-control " value=""></label>
                                                    <label><span>Cost</span>
                                                        <input required="required" type="number" name="addon[0][addons_airlines][0][airline_cost]" class="form-control " value=""></label>
                                                    <label><span>Due Date</span>
                                                        <input required="required" type="date" name="addon[0][addons_airlines][0][airline_due_date]" class="form-control date" value=""></label><label class="mycss classes "><span>Reserve Type</span><select name="addon[0][addons_airlines][0][airline_reserve_type]" class="form-control"><option value="0">Flat</option>
                                                            <option value="1">Percentage</option></select></label>
                                                    <label><span>Reserve Amount</span>
                                                        <input required="required" type="number" name="addon[0][addons_airlines][0][airline_reserve_amount]" class="form-control " value=""></label></fieldset></fieldset>    </div>
                                            </div>
                            </div>

                                            <!--- Hotels --->  
                                            <div class="hotel-contaner row-box">  
                                                <div class="form-title">     
                                                    <div class="col-md-6 col-xs-10">
                                                        <h3>Hotels</h3> 
                                                    </div>
                                                    <div class="text-right">
                                                        <a class="addMore" row="hotel-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="cust-input-group hotel-row pt-4 pb-2">     
                                                        <fieldset class="trip_collection"><fieldset><label class="lbl_hotel_name"><span>Hotel Name</span>
                                                                    <input type="text" name="hotels[0][hotel_name]" required="required" class="form-control " value=""></label>
                                                                    <label class="lbl_hotel_type"><span>Type</span>
                                                                        <input type="text" required="required" name="hotels[0][hotel_type]" class="form-control" value=""></label>
                                                                        <label class="lbl_hotel_cost"><span>Cost</span>
                                                                            <input type="number" name="hotels[0][hotel_cost]" required="required" class="form-control" value=""></label>
                                                                            <label class="lbl_hotel_solo_cost"><span>Solo Cost</span>
                                                                            <input type="number" name="hotels[0][hotel_solo_cost]" required="required" class="form-control" value=""></label>
                                                                            <label class="lbl_hotel_our_cost"><span>Our Cost</span><input type="number" name="hotels[0][hotel_our_cost]" class="form-control" value=""></label>
                                                                            <label class="lbl_hotel_our_cost"><span>Our Solo Cost</span>
                                                                            <input type="number" required="required" name="hotels[0][hotel_our_solo_cost]" class="form-control" value=""></label>
                                                                            <label><span>Due Date</span>
                                                                            <input type="date" name="hotels[0][hotel_due_date]" class="form-control date" required="required" value=""></label>
                                                                            <label class="mycss classes "><span>Reserve Type</span>
                                                                            <select name="hotels[0][hotel_reserve_type]" class="form-control" required="required"><option value="0">Flat</option>
                                                                        <option value="1">Percentage</option></select></label><label><span>Reserve Amount</span>
                                                                            <input type="number" required="required" name="hotels[0][hotel_reserve_amount]" class="form-control " value=""></label>
                                                            </fieldset><span data-template=''>
                                                                
                                                            </span></fieldset>    </div>
                                                </div>
                                            </div>
                                            <!--- Trip to Do/Packing list --->
                                            <div class="todo-contaner row-box">  
                                                <div class="form-title">     
                                                    <div class="col-md-6 col-xs-10">
                                                        <h3>Trip to Do/Packing list</h3> 
                                                    </div>
                                                    <div class="text-right">
                                                        <a class="addMore" row="todo-row"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="cust-input-group todo-row pt-4 pb-2">     
                                                        <fieldset class="trip_collection"><fieldset><label><span>Do/Packing</span>
                                                                    <input required="required" type="text" name="to_do[0][todo_name]" class="form-control" value=""></label>
                                                            </fieldset>   </div>
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
                                                                <fieldset><legend>Is passport required?</legend><label><input type="radio" name="requirement_is_passport" class="requirement-passport" value="0" checked="checked">No</label><label><input type="radio" name="requirement_is_passport" class="requirement-passport" value="1">Yes</label></fieldset>    </div>    
                                                            <br>
                                                            <div class="col-md-4 cust-input-group requirement-passport-box pb-0" style="display: none;">
                                                                <label for="requirement_passport_min_expiry">Passport Min Expiry Date</label><input type="date" name="requirement_passport_min_expiry" class="form-control" id="requirement_passport_min_expiry" value="">    </div>       
                                                        </div>
                                                        <div class="row">     
                                                            <div class="col-md-3 cust-input-group requirement-passport">
                                                                <fieldset><legend>Is visa required?</legend><label><input type="radio" name="requirement_is_visa" class="requirement-visa" value="0" checked="checked">No</label><label><input type="radio" name="requirement_is_visa" class="requirement-visa" value="1">Yes</label></fieldset>    </div> 
                                                            <br>
                                                            <div class="col-md-4 cust-input-group requirement-visa-box pb-0" style="display: none;">
                                                                <label><span>Visa Cost</span><input type="text" name="requirement_visa_cost" class="form-control" value=""></label>    </div>       
                                                            <div class="col-md-5 cust-input-group requirement-visa-box pb-0" style="display: none;">
                                                                <label><span>Visa Process</span><input type="text" name="requirement_visa_process" class="form-control" value=""></label>    </div>       
                                                        </div>
                                                        <div class="row">     
                                                            <div class="col-md-3 cust-input-group requirement-passport">
                                                                <fieldset><legend>Is Shots/Medication required?</legend><label><input type="radio" name="requirement_is_shots" class="requirement-shots" id="requirement_is_shots" value="0" checked="checked">No</label><label><input type="radio" name="requirement_is_shots" class="requirement-shots" value="1">Yes</label></fieldset>    </div>    
                                                            <br>
                                                            <div class="col-md-4 cust-input-group requirement-shots-box pb-0" style="display: none;">
                                                                <label><span>Shots Cost</span><input type="text" name="requirement_shots_cost" class="form-control" value=""></label>    </div>       
                                                            <div class="col-md-5 cust-input-group requirement-shots-box pb-0" style="display: none;">
                                                                <label><span>Shots Timeframe</span><input type="text" name="requirement_shots_timeframe" class="form-control" value=""></label>    </div>       
                                                        </div>
                                                        <div class="row">     
                                                            <div class="col-md-6 col-md-offset-6 cust-input-group sendbtn regbtn mt-0 mb-3">
                                                                <input type="submit" name="submit" id="submitbutton" value="Create Trip">         </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--- End Entry requirement --->
                                            </div>
                                            </div>
                                            </div>

                                            @endsection