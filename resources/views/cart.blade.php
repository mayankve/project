
@extends('layouts.dashboard')
@section('title', 'Cart')
@section('content')

<?php

$tavelerearray=array();

$trip_flight_amount= (count($tripdata['tripAirlines'])>0)? $tripdata['tripAirlines'][0]->airline_reserve_amount:'';
$trip_hotel_amount= (count($tripdata['tripHotels'])>0)? $tripdata['tripHotels'][0]->hotel_reserve_amount:'';	
$trip_traveler=  (count($tripdata['tripTravelers'])>0)? count($tripdata['tripTravelers']):'';
$trip_only_amount= 	($trip_flight_amount + $trip_hotel_amount) * $trip_traveler	;
$tripandaddonamount= $finaladd_on_amount+$trip_only_amount;
//echo $trip_only_amount;											
?>

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
                        <a> Cart    </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">Welcome  {{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>
<!--    <svg class="hidden">
    <defs>
    <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"></path>
    </defs>
    </svg>-->

<!--    <input type="hidden" id="ajax_url" name="ajax_url" value="/dashboard/my-trips/ajax/12">
    <input type="hidden" id="ajax_todo_url" name="ajax_todo_url" value="/dashboard/my-trips/ajax-todo/12">-->

    <div class="row text-right">
        <!--<h4><a href="{{url('cart')}}">Checkout this trip</a></h4>-->
    </div>

    <div class="" id="pageWrapper">
        <div id="" class="customtab">
            <!-- Nav tabs -->
           
            <div class="tab-content">
                <!-- flight-land-------------------Start --------------------------------------->
                <div role="tabpanel" class="tab-pane active" id="DesignTrip">
                    <input type="hidden" name="trip_id" id="trip_id"  value="">
                    <div class="panel panel-primary trip-design-flight">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Trip Flight</strong></h3>
                            <div class="panel-tools">
                               <label style="color: black">Total Cost: </label>
							   <label class="total_addon_cost" style="color: black">$<?php echo $tripandaddonamount;?></label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="basic_info_view">   
                                <div class="form-horizontal">
                                    <div class="form-group pdrow-group">
                                        <div class="col-sm-9">
                                            <div class="row">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Airline Panel -->
                                    <div class="panel panel-default">
											<div class="available-flights">
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    
                                                    <div class="col-sm-2">
                                                        <b>Airline Name</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Departure Location</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Departure Date</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Departure Time</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Reserve Amount</b>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <b>Cost</b>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                      
                                         if(count($tripdata['tripAirlines'])>0){
                                        ?>                                      
                                        <div class="form-group pdrow-group parent">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->name:$_SESSION['card_item']['flight_name'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                       <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->airline_departure_location:$_SESSION['card_item']['flight_number'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->airline_departure_date:$_SESSION['card_item']['departure_date'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->airline_departure_time:$_SESSION['card_item']['departure_time'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->airline_reserve_amount:'';?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                          <?php echo (!empty($tripdata['tripAirlines']))?$tripdata['tripAirlines'][0]->airline_cost:'';?>
                                                    </div>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
										 <?php }?>
                                        
                                        </div>                                        
                               </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
				
				
				
				<!-- trip hotel here -->
				
				 <div role="tabpanel" class="tab-pane active" id="DesignTrip">
                    <input type="hidden" name="trip_id" id="trip_id"  value="">
                    <div class="panel panel-primary trip-design-flight">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Trip Hotel</strong></h3>
                            <div class="panel-tools">
                                
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="basic_info_view">   
                                <div class="form-horizontal">
                                    <div class="form-group pdrow-group">
                                        <div class="col-sm-9">
                                            <div class="row">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Airline Panel -->
                                    <div class="panel panel-default">
											<div class="available-flights">
                                        <div class="form-group pdrow-group">
                                            <div class="col-sm-12">
                                                <div class="row">
                               
                                <div class="col-sm-2">
                                    <b>Hotel Name</b>
                                </div>
                                <div class="col-sm-2">
                                    <b>Type</b>
                                </div>
                                <div class="col-sm-2">
                                    <b>Due Date</b>
                                </div>
                                <div class="col-sm-2">
                                    <b>Reserve Amount</b>
                                </div>
                                <div class="col-sm-2" >
                                    <b>Cost</b>
                                </div>

                                <div class="col-sm-2">
                                    <b>Solo Cost</b>
                                </div>

                               
                            </div>
                                            </div>
                                        </div>
                                        <?php
                                      
                                         if(count($tripdata['tripHotels'])>0){
											
                                        ?>                                    
                                        <div class="form-group pdrow-group parent">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo $tripdata['tripHotels'][0]->hotel_name;?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                         <?php echo $tripdata['tripHotels'][0]->hotel_type;?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                     <?php echo $tripdata['tripHotels'][0]->hotel_due_date;?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                       <?php echo $tripdata['tripHotels'][0]->hotel_reserve_amount;?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                         <?php echo $tripdata['tripHotels'][0]->hotel_cost;?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                            <?php echo $tripdata['tripHotels'][0]->hotel_solo_cost;?>
                                                    </div>
                                                   
                                                </div>
                                            </div>
										 </div><?php } ?>
                                        
                                        </div>                                        
                               </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
				
				
			<!-- end here -->	
			
			<!-- trip travelere information-->
			
						<div class="row">
                            <div class="panel panel-primary traveler-list">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Trip Travelers list</strong></h3>
                                    <div class="panel-tools">
                                        <a href="#" class="updown"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="basic_info_view">   
                                        <div class="form-horizontal">
                                            <div class="trip-addons">
                                                <div class="form-group pdrow-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label>SN.</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Name</label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Gender</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group pdrow-group">
                                                    <?php
										$i=1;
                                         if(count($tripdata['tripTravelers'])>0){
											 foreach($tripdata['tripTravelers'] as $traveler){
												 
                                        ?> 
                                                    <div class="col-sm-12 travler">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                              <?php echo $i;?>           
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?php echo $traveler->first_name;?>   
                                                            </div>
                                                            <div class="col-sm-4">
                                                               <?php echo ($traveler->gender==1)?'Male':'Female';?> 
                                                            </div>
                                                            
                                                        </div>
                                                    </div> 
										 <?php $i++; } } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- trip travelere information end here .-->
						
						
						
				<!-- trip hotel here -->
				<?php if(!empty($final)){?>
<div class="panel panel-primary addon-main">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Add Ons</strong></h3>
        <div class="panel-tools">
            <label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$<?php echo $finaladd_on_amount;?></label>
            <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>
        </div>
    </div>
<div class="panel-body">
    <div class="basic_info_view">   
        <div class="form-horizontal">
            <div class="trip-addons">
                <div class="form-group">
                   
                       <?php
						$i=1;
					
						foreach($final as $key=>$value){						 
						  $addons=DB::select('select * from trip_addon where trip_id='.$trip_id.' and status="1" and id='.$value[0].'');
						 ?> 
				<div class="col-sm-12">
                        <div class="row number-group-row parent">
						<div class="addon">
							
							 <div class="col-sm-3">
                                <?php echo $i;?>
                            </div>
							
                            <div class="col-sm-3">
                                <?php echo (!empty($addons))?$addons[0]->addons_name:'';?>
                            </div>
                            <div class="col-sm-3">
                           <?php echo (!empty($addons))?$addons[0]->addons_detail:'';?>
                            </div>
                            <div class="col-sm-3">
                              $<?php echo (!empty($addons))?$addons[0]->addons_cost:'';?>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                            <div class="panel panel-primary traveler-list">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                    <div class="panel-tools">                                   
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="basic_info_view">   
                                        <div class="form-horizontal">
                                            <div class="trip-addons">
                                                <div class="form-group pdrow-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <label>SN.</label>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <label>Name</label>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <label>Gender</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												<?php 
												
												$j=1;
												
												foreach($value[3] as $travelerkey=>$traveler){
													$travelere=DB::select('select * from trip_traveler where trip_id='.$trip_id.' and status="1" and id='.$traveler.'');?>
                                                <div class="form-group pdrow-group">
                                                   
                                                    <div class="col-sm-12 travler">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                              <?php echo $j;?>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                 <?php echo $travelere[0]->first_name;?> <?php echo $travelere[0]->last_name;?>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <?php echo ($travelere[0]->gender==1)?'Male':'Female';?>
                                                            </div>
                                                            
                                                        </div>
                                                   
                                                </div>
												</div><?php $j++; }
										//print_r($tavelerearray);											
										?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row addon_flight">
                            <div class="panel panel-primary trip-design-flight">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                    <div class="panel-tools">
                                        
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="basic_info_view">   
                                        <div class="form-horizontal">
                                            <div class="form-group pdrow-group">
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                       
                                                        <div class="col-sm-6">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="addon-available-flights">
                                                <div class="form-group pdrow-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            
                                                            <div class="col-sm-2">
                                                                <b>Airline Name</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Departure Location</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Departure Date</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Departure Time</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Reserve Amount</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Cost</b>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                              <?php 
											  $flight_data= DB::table('trip_addon_airline')
																->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
																->where('trip_addon_airline.trip_id', '=', $trip_id)
																->where('trip_addon_airline.addon_id', '=', $value[0])
																->where('trip_addon_airline.status', '=', '1')
																->where('airlines.id', '=', $value[1])
																->get(); ?>

                                                <div class="form-group pdrow-group flightparent">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                               <?php echo $flight_data[0]->name;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                 <?php echo $flight_data[0]->airline_departure_location;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                              <?php echo $flight_data[0]->airline_departure_date;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo $flight_data[0]->airline_departure_time;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo $flight_data[0]->airline_reserve_amount;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                 <?php echo $flight_data[0]->airline_cost;?>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="row addon_hotel">
                        <div class="panel panel-primary trip-design-hotel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Hotels</strong></h3>
                                <div class="panel-tools">
                                  
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="basic_info_view">   
                                    <div class="form-horizontal">
                                        <div class="trip-addons">
                                            <div class="form-group pdrow-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pdrow-group">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        
                                                        <div class="col-sm-2">
                                                            <b>Hotel Name</b>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <b>Type</b>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <b>Due Date</b>
                                                        </div>
                                                        
                                                        <div class="col-sm-2 hotel_solo_cost">
                                                            <b>Reserve Amount</b>
                                                        </div>
                                                        <div class="col-sm-2 hotel_solo_cost">
                                                            <b>Solo Cost</b>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                           <?php 
											  $hote_data=DB::table('trip_addon_hotel')
															->where('trip_id', '=', $trip_id)
															->where('id', '=', $value[2])
															->where('status', '=', '1')
															->get(); ?>
                                                <div class="form-group pdrow-group hotleparent">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php echo $hote_data[0]->hotel_name;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo $hote_data[0]->hotel_type;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                               <?php echo ($hote_data[0]->hotel_due_date!='')?$hote_data[0]->hotel_due_date:'';?>
                                                            </div>
                                                            
                                                            <div class="col-sm-2 hotel_cost" >
                                                                <label>$</label>
                                                                <label class="cost">
                                                                   <?php echo $hote_data[0]->hotel_reserve_amount;?>
                                                                </label>
                                                             </div>
                                                            <div class="col-sm-2 hotel_cost">
                                                                <label>$</label> 
                                                                <label class="cost"> <?php echo $hote_data[0]->hotel_solo_cost;?></label>
                                                            </div>                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 text-right">
                                                <div class="update-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</div>
                        </div>
                      
					   </div><?php $i++; } ?>
                </div>
				
				<div>
				<button type="submit"  name="checkout">Checkout</button>
				</div>
            </div>
        </div>
    </div>
</div>
</div>	<?php }?>			
	
     </div>
   </div>
  </div>
</div>

@endsection