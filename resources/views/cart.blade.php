
@extends('layouts.dashboard')
@section('title', 'Cart')
@section('content')

<?php

$tavelerearray=array();

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

    <div class="row text-right">
        <!--<h4><a href="{{url('cart')}}">Checkout this trip</a></h4>-->
    </div>
	
	<?php if(isset($_SESSION['card_item']) && !empty($_SESSION['card_item'])){?>
<<<<<<< HEAD
	<form method="post" action="{{url('checkout')}}">
=======

>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
    <div class="" id="pageWrapper">
        <div id="" class="customtab">
            <!-- Nav tabs -->
           
            <div class="tab-content">
                <!-- flight-land-------------------Start --------------------------------------->
                <div role="tabpanel" class="tab-pane active" id="DesignTrip">
                    <input type="hidden" name="trip_id" id="trip_id"  value="<?php echo (!empty($_SESSION['card_item']))?$_SESSION['card_item']['trip_id']:'';?>">
                    <div class="panel panel-primary trip-design-flight">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Trip Flight</strong></h3>
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
<<<<<<< HEAD
																
=======
                                                                          
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
                                        <div class="form-group pdrow-group parent">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->name:$_SESSION['card_item']['flight_name'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                       <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->airline_departure_location:$_SESSION['card_item']['flight_number'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->airline_departure_date:$_SESSION['card_item']['departure_date'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->airline_departure_time:$_SESSION['card_item']['departure_time'];?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->airline_reserve_amount:'';?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                          <?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->airline_cost:'';?>
                                                    </div>
                                                  
                                                    <input type="hidden" name="trip_flight_id" value="<?php echo (count($tripdata['tripAirlines'])>0)?$tripdata['tripAirlines'][0]->id:'';?>">
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
				
				
				
				<!-- trip hotel here -->
				
				 <div role="tabpanel" class="tab-pane active" id="DesignTrip">
                  
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
                                                     <input type="hidden" name="trip_hotel_id" value="<?php echo (count($tripdata['tripHotels'])>0)?$tripdata['tripHotels'][0]->id:'';?>">
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
<<<<<<< HEAD
												
												$travlerid=array();
												 if(count($tripdata['tripTravelers'])>0){
													 foreach($tripdata['tripTravelers'] as $traveler){
													array_push($travlerid,$traveler->id);
=======
												 if(count($tripdata['tripTravelers'])>0){
													 foreach($tripdata['tripTravelers'] as $traveler){
												 
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
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
										 <input type="hidden" name="trip_traveler_id" value="<?php echo json_encode($travlerid);?>"> 
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
           <!-- <label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$<?php //echo $finaladd_on_amount;?></label>
            <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
        </div>
    </div>
<div class="panel-body">
    <div class="basic_info_view">   
        <div class="form-horizontal">
            <div class="trip-addons">
                <div class="form-group">
                   
                       <?php
						$i=1;
<<<<<<< HEAD
						
						foreach($final as $key=>$value){
							
=======
					//echo '<pre>';print_r($final);die;
						foreach($final as $key=>$value){
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
								//echo $value['add_on_detail']->addons_name;die;
						  //$addons=DB::select('select * from trip_addon where trip_id='.$trip_id.' and status="1" and id='.$value[0].'');
						 ?> 
					<div class="col-sm-12">
                        <div class="row number-group-row parent">
						<div class="addon">
							
							 <div class="col-sm-3">
                                <?php echo $i;?>
                            </div>
							
                            <div class="col-sm-3">
                                <?php echo (!empty($value['add_on_detail']))?$value['add_on_detail']->addons_name:'';?>
                            </div>
                            <div class="col-sm-3">
                           <?php echo (!empty($value['add_on_detail']))?$value['add_on_detail']->addons_detail:'';?>
                            </div>
                            <div class="col-sm-3">
                              $<?php echo (!empty($value['add_on_detail']))?$value['add_on_detail']->addons_cost:'';?>
                            </div>
                            <input type="hidden" name="add_on_id[{{$i}}]" value="<?php echo $value['add_on_detail']->id;?>">                  
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
												if(!empty($value['travler_info'])){
												foreach($value['travler_info'] as $travelerkey=>$traveler){
<<<<<<< HEAD
													array_push($tavelerearray,$travelerkey);
=======
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
													//$travelere=DB::select('select * from trip_traveler where trip_id='.$trip_id.' and status="1" and id='.$traveler.'');?>
                                                <div class="form-group pdrow-group">
                                                   
                                                    <div class="col-sm-12 travler">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                              <?php echo $j;?>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                 <?php echo $traveler[0]->first_name;?> <?php echo $traveler[0]->last_name;?>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <?php echo ($traveler[0]->gender==1)?'Male':'Female';?>
                                                            </div>
                                                            
                                                        </div>
                                                   <input type="hidden" name="add_on_traveler_id[{{$i}}][{{$travelerkey}}]" value="<?php echo (!empty($traveler[0]->id))?$traveler[0]->id:'';?>"> 
                                                </div>
												</div><?php $j++; } }
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
														// $flight_data= DB::table('trip_addon_airline')
																// ->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
																// ->where('trip_addon_airline.trip_id', '=', $trip_id)
																// ->where('trip_addon_airline.addon_id', '=', $value[0])
																// ->where('trip_addon_airline.status', '=', '1')
																// ->where('airlines.id', '=', $value[1])
																// ->get(); ?>

                                                <div class="form-group pdrow-group flightparent">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                               <?php echo (!empty($value['flight_data']))?$value['flight_data']->name:'';?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                 <?php echo (!empty($value['flight_data']))?$value['flight_data']->airline_departure_location:'';?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                              <?php echo (!empty($value['flight_data']))?$value['flight_data']->airline_departure_date:'';?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo (!empty($value['flight_data']))?$value['flight_data']->airline_departure_time:'';?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo (!empty($value['flight_data']))?$value['flight_data']->airline_reserve_amount:'';?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                 <?php echo (!empty($value['flight_data']))?$value['flight_data']->airline_cost:'';?>
                                                            </div>
                                                           <input type="hidden" name="add_on_flight_id[{{$i}}]" value="<?php echo (!empty($value['flight_data']))?$value['flight_data']->id:'';?>">
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
											  // $hote_data=DB::table('trip_addon_hotel')
															// ->where('trip_id', '=', $trip_id)
															// ->where('id', '=', $value[2])
															// ->where('status', '=', '1')
															// ->get(); ?>
                                                <div class="form-group pdrow-group hotleparent">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php echo $value['hote_data']->hotel_name;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php echo $value['hote_data']->hotel_type;?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                               <?php echo ($value['hote_data']->hotel_due_date!='')?$value['hote_data']->hotel_due_date:'';?>
                                                            </div>
                                                            
                                                            <div class="col-sm-2 hotel_cost" >
                                                                <label>$</label>
                                                                <label class="cost">
                                                                   <?php echo $value['hote_data']->hotel_reserve_amount;?>
                                                                </label>
                                                             </div>
                                                            <div class="col-sm-2 hotel_cost">
                                                                <label>$</label> 
                                                                <label class="cost"> <?php echo $value['hote_data']->hotel_solo_cost;?></label>
                                                            </div>                                                            
                                                            	<input type="hidden" name="add_on_hotel_id[{{$i}}]" value="<?php echo (!empty($value['hote_data']))?$value['hote_data']->id:'';?>">
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
				
<<<<<<< HEAD
=======
				
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
            </div>
        </div>
    </div>
</div>
</div>	<?php }?>


<!-- include activity-->

<div class="panel panel-primary addon-main">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>included Activities</strong></h3>
        <div class="panel-tools">
            <!--<label style="color: black">Total Cost: </label> <label class="total_addon_cost" style="color: black">$0</label>
            <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
        </div>
    </div>
    <div class="panel-body">
        <div class="basic_info_view">   
            <div class="form-horizontal">
                <div class="trip-addons">
                    <div class="form-group">
					 <?php
<<<<<<< HEAD
                            $id = 1;	
								$activityamount=0;	
								$activityflightamount=0;
								$activityhotelamount=0;	
                            ?>   
                            @if(!empty($tripIncludedActivities))
                           
                            @foreach ( $tripIncludedActivities AS $includedActivity)
								<?php $activityamount = $activityamount+$includedActivity['tripIncludedActivities']->activity_cost;?>
=======
                            $id = 1;
						// echo '<pre>';print_r($tripIncludedActivities);die;
                            ?>   
                            @if(count($tripIncludedActivities)>0)
                           
                            @foreach ( $tripIncludedActivities AS $includedActivity)
                            
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
                        <div class="col-sm-12">
                           
                            <div class="row number-group-row">
                                <div class="col-sm-1">
                                    {{$id}}     
                                </div>
                                <div class="col-sm-3">
                                    {{ isset($includedActivity['tripIncludedActivities']->activity_name) ? $includedActivity['tripIncludedActivities']->activity_name : 'N/A' }}
                                </div>
                                <div class="col-sm-3">
                                    {{ isset($includedActivity['tripIncludedActivities']->activity_detail) ? $includedActivity['tripIncludedActivities']->activity_detail : 'N/A' }}
                                </div>
                                <div class="col-sm-3">
                                    <label>${{ isset($includedActivity['tripIncludedActivities']->activity_cost) ? $includedActivity['tripIncludedActivities']->activity_cost : 'N/A' }}</label>
                                    <label class="addon_cost"> </label>
                                </div>
                                <!------ Radio button here--------------->
                            </div>
<<<<<<< HEAD
                          <input type="hidden" name="includedactivity_id[{{$id}}]" value="<?php echo $includedActivity['tripIncludedActivities']->id; ?>">
                        
=======
                          
                          <!--  <div class="row">
                                <div class="panel panel-primary traveler-list">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Travelers list</strong></h3>
                                        <div class="panel-tools">
                                            <a href="#" class="updown"><span class="clickable">
                                                    <i class="glyphicon glyphicon-chevron-up"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
                            <div class="row">
                                <div class="panel panel-primary trip-design-flight">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Select flight or provide your flight's details</strong></h3>
                                        <div class="panel-tools">
<<<<<<< HEAD
                                         
=======
                                           <!-- <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></span></a>-->
                                             <!--<a href="#"><span class="basic_info"><i class="fa fa-edit" aria-hidden="true" ></i></span></a>
                                            <a href="#"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
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
                                                <div class="addon-available-flights">
                                                    <div class="form-group pdrow-group">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-sm-3">
                                                                    <b>Airline Name</b>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <b>Departure Location</b>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <b>Departure Date</b>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <b>Departure Time</b>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <b>Reserve Amount</b>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <b>Cost</b>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
<<<<<<< HEAD
                                                    
                                                    @if(!empty($includedActivity['activity_flight']))
                                                  <?php $activityflightamount = $activityflightamount+$includedActivity['activity_flight']->airline_reserve_amount;?>
=======
                                                    <?php
                                                     // $sr = 1;
													 // $flight= !empty($_SESSION['card_item']['included_activity_flight'])?$_SESSION['card_item']['included_activity_flight']:'0';
													 // $includedActivityFlights = DB::table('trip_included_activity_airline')
																// ->where('airline_departure_date', '>', date('Y-m-d'))
																// ->where('trip_id', '=', $includedActivity->trip_id)
																// ->where('activity_id', '=', $includedActivity->id)
																// ->where('id', '=', $flight)
																// ->where('status', '=', '1')
																// ->get();
													 //echo '<pre>';print_r($tripdata['tripIncludedActivities']['includedActivityFlights']);die;
                                                    ?> 
                                                    @if(!empty($includedActivity['activity_flight']))
                                                  
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
													
													<div class="form-group pdrow-group">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-sm-3">
                                                                    {{ isset($includedActivity['activity_flight']->airline_name) ? $includedActivity['activity_flight']->airline_name : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    {{ isset($includedActivity['activity_flight']->airline_departure_location) ? $includedActivity['activity_flight']->airline_departure_location : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    {{ isset($includedActivity['activity_flight']->airline_departure_date) ? $includedActivity['activity_flight']->airline_departure_date : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_flight']->airline_departure_time) ? $includedActivity['activity_flight']->airline_departure_time : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_flight']->airline_reserve_amount) ? $includedActivity['activity_flight']->airline_reserve_amount : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_flight']->airline_cost) ? $includedActivity['activity_flight']->airline_cost : 'N/A' }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                <label>
<<<<<<< HEAD
                                                                  <input type="hidden" name="includedactivity_flight_id[{{$id}}]" value="<?php echo $includedActivity['activity_flight']->id; ?>">
=======
                                                                   <!-- { !!Form::radio('included_activity_flight', $airlines->name ,['class' => 'form-control included_activity_flight']) !!} -->
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
																  
                                                                </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel panel-primary trip-design-hotel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Hotels</strong></h3>
                                    <div class="panel-tools">
<<<<<<< HEAD
                                        
=======
                                        <!--<label style="color: black">Total Cost: </label> <label class="total_hotel_cost" style="color: black">$400</label>
                                        <a href="#" class="updown"><span class="clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></a>-->
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa

                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="basic_info_view">   
                                        <div class="form-horizontal">
                                            <div class="trip-addons">
                                                <div class="form-group pdrow-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                           
                                                            <div class="col-sm-3 text-right">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group pdrow-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                           
                                                            <div class="col-sm-3">
                                                                <b>Hotel Name</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Type</b>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <b>Due Date</b>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <b>Reserve Amount</b>
                                                            </div>
                                                            <div class="col-sm-1 ">
                                                                <b>Cost</b>
                                                            </div>

                                                           
                                                            <div class="col-sm-1 hotel_solo_cost">
                                                                <b>Solo Cost</b>
                                                            </div>

                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group pdrow-group">
<<<<<<< HEAD
                                                  
                                                    @if(!empty($includedActivity['activity_hotel']))
                                                 <?php $activityhotelamount = $activityhotelamount+$includedActivity['activity_hotel']->hotel_reserve_amount;?>
												<div class="form-group pdrow-group">
                                                        <div class="col-sm-12">
                                                            <div class="row">
																
=======
                                                  <?php
                                                     // $sr = 1;
													 // $includedActivityHotles = DB::table('trip_included_activity_hotel')
																		// ->where('trip_id', '=', $includedActivity->trip_id)
																		// ->where('hotel_due_date', '>', date('Y-m-d'))
																		// ->where('activity_id', '=', $includedActivity->id)
																		// ->where('id', '=', $_SESSION['card_item']['included_activity_hotel'])
																		// ->where('status', '=', '1')
																		// ->get();
														//echo '<pre>';print_r($tripdata['tripIncludedActivities']['includedActivityHotles']);die;
                                                     ?> 
                                                    @if(!empty($includedActivity['activity_hotel']))
                                                
												<div class="form-group pdrow-group">
                                                        <div class="col-sm-12">
                                                            <div class="row">
																<div class="col-sm-1">
                                                                   
                                                                </div>
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
																
																<div class="col-sm-3">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_name) ? $includedActivity['activity_hotel']->hotel_name : 'N/A' }}
                                                                </div>
																<div class="col-sm-2">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_type) ? $includedActivity['activity_hotel']->hotel_type : 'N/A' }}
                                                                </div>
																 <div class="col-sm-2">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_due_date) ? $includedActivity['activity_hotel']->hotel_due_date : 'N/A' }}
                                                                </div>
																<div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_reserve_amount) ? $includedActivity['activity_hotel']->hotel_reserve_amount : 'N/A' }}
                                                                </div>
																
																 <div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_cost) ? $includedActivity['activity_hotel']->hotel_cost : 'N/A' }}
                                                                </div>
																 <div class="col-sm-1">
                                                                    {{ isset($includedActivity['activity_hotel']->hotel_solo_cost) ? $includedActivity['activity_hotel']->hotel_solo_cost : 'N/A' }}
                                                                </div>
															
                                                                </div>
<<<<<<< HEAD
																  <input type="hidden" name="includedactivity_hotel_id[{{$id}}]" value="<?php echo $includedActivity['activity_hotel']->id; ?>">
=======
																
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
                                                            </div>
                                                        </div>                                                 
                                                   
                                                    @endif
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
                </div>
				<?php $id++; ?>
                        @endforeach
                        @endif
            </div>
        </div>
    </div>
	<div role="tabpanel" class="tab-pane" id="todo">
    <!--<form method="POST" name="trip-land-flight" action="/book/" id="trip-land-flight">          
    <br>-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Do/Packing listsfsdf</strong></h3>
            <div class="panel-tools">               
            </div>
        </div>
        <div class="panel-body">
            <div class="basic_info_view">   
                <div class="form-horizontal">
                    <div class="trip-addons">
                        <div class="form-group">
                            <?php
                                 $sr = 1;
//                                 echo "<pre>";print_r($tripdata['tripTodo']);die;
								 if(count($tripdata['to_do_packing'])>0){
								 
<<<<<<< HEAD
                            foreach($tripdata['to_do_packing'] AS $triptokey=>$tripTodo){							
=======
                            foreach($tripdata['to_do_packing'] AS $tripTodo){							
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
										
                            ?>
                           
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-1">
                                        {{$sr}}   
                                    </div>
                                    <div class="col-sm-9">
                                        {{$tripTodo[0]->todo_name}}  
                                    </div>
<<<<<<< HEAD
                                    <input type="hidden" name="packing_list[{{$triptokey}}]" value="{{$tripTodo[0]->id}}">
=======
                                    
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
                                </div>
                            </div>
								 <?php $sr++; } }?>
                            
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
<?php
$addontravelerarryacount= count($tavelerearray);
$trip_flight_amount= (count($tripdata['tripAirlines'])>0)? $tripdata['tripAirlines'][0]->airline_reserve_amount:'0';
$trip_hotel_amount= (count($tripdata['tripHotels'])>0)? $tripdata['tripHotels'][0]->hotel_reserve_amount:'0';	
$trip_traveler=  (count($tripdata['tripTravelers'])>0)? count($tripdata['tripTravelers']):'';
// trip amount add//
$trip_only_amount= 	($trip_flight_amount + $trip_hotel_amount) * $trip_traveler	;
// end here//
// addon amount add//
$tripandaddonamount= $finaladd_on_amount*$addontravelerarryacount;
// end here//

// includeactivity amount add//
//echo $activityhotelamount;die;
 $includedactivity= ($activityamount+$activityflightamount+$activityhotelamount) * $trip_traveler;
// end here//
$final_trip_amount= $trip_only_amount + $tripandaddonamount + $includedactivity;
?>
    <div class="form-group">
        <div class="col-sm-12 text-right">
            <div class="update-btn">
			<div class="panel-tools">
						
					   
						<label style="color: black">Trip Cost: </label>
					   <label class="total_addon_cost" style="color: black">$<?php echo $trip_only_amount;?></label></br>
					   
					   
						<label style="color: black">Add on Cost: </label>
					   <label class="total_addon_cost" style="color: black">$<?php echo $tripandaddonamount;?></label></br>
					   
					   <label style="color: black">Included Activity Cost: </label>
					   <label class="total_addon_cost" style="color: black">$<?php echo $includedactivity;?></label></br>
					   
					   <label style="color: black">Total Cost: </label>
					   <label class="total_addon_cost" style="color: black">$<?php echo $final_trip_amount;?></label>
              </div>
=======

    <div class="form-group">
        <div class="col-sm-12 text-right">
            <div class="update-btn">
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
            </div>
        </div>
    </div>
</div>
</div>
<<<<<<< HEAD
</div>
</div>

	<div>
			<button type="submit"  name="checkout">Pay Now</button>
	</div>
	
		<!--<div>
	<a href="{{url('cartremove')}}">Delete</a>
	</div>-->

	
  </div>
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	</div>
	
</form>	
	<?php }else{
=======



</div>

<!-- end here -->
			




<!--packing -->

<!--------------------------------------- todo Start ---------------------------------------------->

<!-- todo-------------------End ------------------------------------------------>
<!-- end here-->




</div>

		<div>
	<button type="submit"  name="checkout">Checkout</button>
	</div>
	
		<div>
	<a href="{{url('cartremove')}}">Delete</a>
	</div>

	
     </div>
	</div><?php }else{
>>>>>>> d1edb19d6cac9d07ea4ce1a99ef35b82f587f2fa
		?>
		<h1>CART IS EMPTY</h1>
		
<?php 	} ?>
  </div>
</div>

@endsection